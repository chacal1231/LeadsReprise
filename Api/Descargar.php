<?php
include '../Inc/conn.php';
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');
/*Obtengo tl token*/
if(isset($_POST['Proceso'])){
	$Proceso = $link->real_escape_string($_POST['Proceso']);
	$Data = $_POST['Data'];
	if($Proceso=="Descargar"){
		header('Content-type: application/json');
		header('Access-Control-Allow-Origin: *');
		ini_set('max_execution_time', 0);
		ini_set('memory_limit', '-1');
		date_default_timezone_set('America/Bogota');
		/*Incluyo conexión a DB*/
		include '../inc/conn.php';
		/*Consulta Formulario*/
		$QueryConsulta = $link->query("SELECT * FROM formularios_reprise WHERE IdFormulario='".$Data['IdFormulario']."'");
		$RowConsulta = $QueryConsulta->fetch_array();
		$Data['NombrePrograma'] = $RowConsulta['NombrePrograma'];
		$Data['TipoPrograma'] = $RowConsulta['TipoPrograma'];
		/*Token de accesos*/
		$QueryToken = $link->query("SELECT * FROM facebook");
		$RowToken = $QueryToken->fetch_array();
		$TokenSergioArboleda = $RowToken['Token'];
		/*Fecha*/
		$FechaFiltro = date('Y-m-d H:i:s',strtotime('-1 hours',strtotime($Data['FechaConsulta'])));
		$d = DateTime::createFromFormat(
			'Y-m-d H:i:s',
			$FechaFiltro,
			new DateTimeZone('UTC')
		);
		if ($d === false) {
			die("Incorrect date string");
		}
		/*Descargo los Leads*/
		$LeadsDownload = json_decode(file_get_contents("https://graph.facebook.com/v8.0/".$Data['IdFormulario']."/leads?filtering=%5B%7B%22field%22%3A%20%22time_created%22%2C%22operator%22%3A%20%22GREATER_THAN_OR_EQUAL%22%2C%22value%22%3A".$d->getTimestamp()."%7D%5D&limit=100000&access_token=".$TokenSergioArboleda));
		if($http_response_header[0]=="HTTP/1.1 200 OK"){
			/*Proceso los leads y organizo*/
			$link->query("UPDATE registro_carga SET EstadoDescarga='OK' WHERE IdFormulario='".$Data['IdFormulario']."' AND FechaCarga='".$Data['FechaCarga']."' AND FechaConsulta='".$Data['FechaConsulta']."'");
			print_r($link->error);
			foreach ($LeadsDownload->data as $Response) {
				foreach ($Response->field_data as $Leads) {
					$LeadsOrganizados[$Response->id]['IdLead']=$Response->id;
					$LeadsOrganizados[$Response->id]['FechaRegistro']=date("Y-m-d H:i:s", strtotime($Response->created_time));
					if($Leads->name=="nombre" OR $Leads->name=="first_name"){
						$LeadsOrganizados[$Response->id]['Nombres']=$Leads->values[0];
					}
					else if($Leads->name=="apellido" OR $Leads->name=="last_name"){
						$LeadsOrganizados[$Response->id]['Apellidos']=$Leads->values[0];
					}
					else if($Leads->name=="número_de_teléfono" OR $Leads->name=="phone_number" OR $Leads->name=="número_de_telefóno"){
						$LeadsOrganizados[$Response->id]['Telefono1']=$Leads->values[0];
					}
					else if($Leads->name=="número_de_telefóno_2" OR $Leads->name=="número_de_teléfono_2"){
						$LeadsOrganizados[$Response->id]['Telefono2']=$Leads->values[0];
					}
					else if($Leads->name=="correo_electrónico" OR $Leads->name=="email"){
						$LeadsOrganizados[$Response->id]['Correo']=$Leads->values[0];
					}
					else if($Leads->name=="ciudad" OR $Leads->name=="city"){
						$LeadsOrganizados[$Response->id]['Ciudad']=$Leads->values[0];
					}
					else{
						die('nuevos campos');
					}
				}	
			}
			if(!empty($LeadsOrganizados)){
				$Formularios[] = array('EstadoDescarga'=>'OK','TipoPrograma'=>$Data['TipoPrograma'],'NombreFormulario'=>$Data['NombrePrograma'],'IdFormulario'=>$Data['IdFormulario'],'CantidadLeads'=>count($LeadsOrganizados),'FechaConsulta'=>$Fecha,'Leads'=>$LeadsOrganizados);
				$LeadsOrganizados = array();
				/*inserto a la DB*/
				foreach ($Formularios as $InsertArray) {
					foreach ($InsertArray['Leads'] as $LeadsArray) {
						if(strtotime($LeadsArray['FechaRegistro'])>=strtotime($FechaFiltro) AND strtotime($LeadsArray['FechaRegistro'])<=strtotime($Data['FechaCarga'])){
							if (!empty($LeadsArray['Telefono2'])){
								$Telefono2=$LeadsArray['Telefono2'];
							}else{
								$Telefono2="0";
							}
							/*Inserto a la DB*/
							$link->query("INSERT INTO leads_facebook(TipoPrograma,NombreFormulario,IdFormulario,IdLead,FechaRegistro,Nombres,Apellidos,Telefono1,Telefono2,Ciudad,Correo,EstadoCarga) VALUES('".$InsertArray['TipoPrograma']."','".$InsertArray['NombreFormulario']."','".$InsertArray['IdFormulario']."','".$LeadsArray['IdLead']."','".$LeadsArray['FechaRegistro']."','".$LeadsArray['Nombres']."','".$LeadsArray['Apellidos']."','".$LeadsArray['Telefono1']."','".$Telefono2."','".$LeadsArray['Ciudad']."','".$LeadsArray['Correo']."','SIN CARGAR')");
						}
					}	
				}
			}
			echo json_encode(array('Estado'=>'OK'));
		}else{
			/*Hubo un error y lo reporto*/
			echo json_encode(array('Estado'=>'ERROR'));
		}
	}
}
