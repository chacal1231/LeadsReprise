<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');
ini_set('max_execution_time', 0);
ini_set('memory_limit', '-1');
date_default_timezone_set('America/Bogota');
/*Incluyo conexión a DB*/
include '../Inc/conn.php';
/*CRM*/
include 'CRM.php';
$CRM = new SugarCRM();
/*Fecha en UNIX Time*/
$Fecha = date('Y-m-d H:i:s');
$FechaFB = date('Y-m-d H:i:s',strtotime('-10 minutes',strtotime($Fecha)));
$FechaFiltro = date('Y-m-d H:i:s',strtotime('-1 hours',strtotime($Fecha)));
$d = DateTime::createFromFormat(
	'Y-m-d H:i:s',
	$FechaFB,
	new DateTimeZone('UTC')
);
if ($d === false) {
	die("Incorrect date string");
}
function VerificarCiudad($Ciudad){
	$retorno = $ciudad;
	$a = array("Ã¡", "á", "ÃƒÂ¡", "Á");
	$retorno = str_replace($a, "A", $retorno);
	$e = array("é", "É");
	$retorno = str_replace($e, "E", $retorno);
	$i = array("í","Í", "ÃƒÂ-", "Ã-");
	$retorno = str_replace($i, "I", $retorno);
	$o = array("ó", "Ó", "Ã³", "ÃƒÂ³");
	$retorno = str_replace($o, "O", $retorno);
	$u = array("ú", "Ú");
	$retorno = str_replace($u, "U", $retorno);
	$n = array("ñ", "Ñ", "Ã±");
	$retorno = str_replace($n, "N", $retorno);
	$retorno = strtoupper ( $retorno );
	$retornoFuncion = preg_replace("/[^A-Za-z0-9?!]/",'',$retorno);
	return $retornoFuncion;

}
/*Token de accesos*/
$QueryToken = $link->query("SELECT * FROM facebook");
$RowToken = $QueryToken->fetch_array();
$TokenSergioArboleda = $RowToken['Token'];  
/*Consulto los formularios*/
$QueryFormularios = $link->query("SELECT * FROM formularios_reprise");
$RowFormularios = $QueryFormularios->fetch_array();
/*Descargo la información de esos formularios*/
$LeadsResponse = array();
$LeadsOrganizados = array();
foreach ($QueryFormularios as $RowFormularios => $FormsDownload) {
	$LeadsDownload = json_decode(file_get_contents("https://graph.facebook.com/v8.0/".$FormsDownload['IdFormulario']."/leads?filtering=%5B%7B%22field%22%3A%20%22time_created%22%2C%22operator%22%3A%20%22GREATER_THAN_OR_EQUAL%22%2C%22value%22%3A".$d->getTimestamp()."%7D%5D&limit=100000&access_token=".$TokenSergioArboleda));
	/*Verifico que haya descargado correctamente*/
	if($http_response_header[0]=="HTTP/1.1 200 OK"){
		/*Proceso los leads y organizo*/
		$link->query("INSERT INTO registro_carga(IdFormulario,EstadoDescarga,EstadoCarga,Error,FechaCarga,FechaConsulta) VALUES('".$FormsDownload['IdFormulario']."','OK','','','".$Fecha."','".$FechaFiltro."')");
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
					print_r(json_encode($Leads->name));
				}
			}	
		}
		$Formularios[] = array('EstadoDescarga'=>'OK','TipoPrograma'=>$FormsDownload['TipoPrograma'],'NombreFormulario'=>$FormsDownload['NombrePrograma'],'IdFormulario'=>$FormsDownload['IdFormulario'],'CantidadLeads'=>count($LeadsOrganizados),'FechaConsulta'=>$Fecha,'Leads'=>$LeadsOrganizados);
		$LeadsOrganizados = array();
	}else{
		/*Hubo un error y lo reporto*/
		$link->query("INSERT INTO registro_carga(IdFormulario,EstadoCarga,EstadoDescarga,Error,FechaCarga,FechaConsulta) VALUES('".$FormsDownload['IdFormulario']."','ERROR','','".$http_response_header[0]."','".$Fecha."','".$FechaFiltro."')");
	}
}
/*Inserto todo a la DB*/
foreach ($Formularios as $InsertArray) {
	foreach ($InsertArray['Leads'] as $LeadsArray) {
		if(strtotime($LeadsArray['FechaRegistro'])>=strtotime($FechaFiltro)){
			if (!empty($LeadsArray['Telefono2'])){
				$Telefono2=$LeadsArray['Telefono2'];
			}else{
				$Telefono2="0";
			}
			/*Cargo*/
			$ResponseCRM = $CRM->sendDataCRM($LeadsArray['Nombres'],$LeadsArray['Apellidos'],$LeadsArray['Telefono1'],$Telefono2,$InsertArray['NombreFormulario'],$InsertArray['TipoPrograma'],$LeadsArray['Correo'],VerificarCiudad($LeadsArray['Ciudad']));
			if($ResponseCRM->id){
				$EstadoCargaLead = "OK";
				$link->query("UPDATE registro_carga SET EstadoCarga='OK' WHERE IdFormulario='".$InsertArray['IdFormulario']."' AND FechaConsulta='".$FechaFiltro."'");
			}else{
				$link->query("UPDATE registro_carga SET EstadoCarga='ERROR' WHERE IdFormulario='".$InsertArray['IdFormulario']."' AND FechaConsulta='".$FechaFiltro."'");
				$EstadoCargaLead = "ERROR";
			}
			/*Inserto a la DB*/
			$link->query("INSERT INTO leads_facebook(TipoPrograma,NombreFormulario,IdFormulario,IdLead,FechaRegistro,Nombres,Apellidos,Telefono1,Telefono2,Ciudad,Correo,EstadoCarga) VALUES('".$InsertArray['TipoPrograma']."','".$InsertArray['NombreFormulario']."','".$InsertArray['IdFormulario']."','".$LeadsArray['IdLead']."','".$LeadsArray['FechaRegistro']."','".$LeadsArray['Nombres']."','".$LeadsArray['Apellidos']."','".$LeadsArray['Telefono1']."','".$Telefono2."','".$LeadsArray['Ciudad']."','".$LeadsArray['Correo']."','".$EstadoCargaLead."')");
		}
	}	
}