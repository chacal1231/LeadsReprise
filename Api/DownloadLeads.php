<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');
ini_set('max_execution_time', 0);
ini_set('memory_limit', '-1');
date_default_timezone_set('America/Bogota');
/*Incluyo conexión a DB*/
include '../inc/conn.php';
/*Fecha en UNIX Time*/
$Fecha = date('Y-m-d H:i:s');
$FechaFB = date('Y-m-d H:i:s',strtotime('-12 hour',strtotime($Fecha)));
$d = DateTime::createFromFormat(
	'Y-m-d H:i:s',
	$FechaFB,
	new DateTimeZone('UTC')
);w
if ($d === false) {
	die("Incorrect date string");
}
/*Token de accesos*/
$TokenSergioArboleda = "EAAlbwUiy9RoBAJdg5mZAYIuYZBXZA0PXmXeu0LzfrmkvsZADc5CZASYYsXvXgqmPjuycHHlZCojnTvVUhGdrIapGvfJpiOBZCK8ML42tZBFyePNsarTrm6mOOZARviknk849ZBzyhZCS90TqdunCBbV9DQWWiCa7P7XkJGZCJ3HKgjrXPlRkiebckLkv";  /*Vence el October 23, 2020*/
/*Hago la consulta al Graph para descargar todos los leads*/
$UrlFbGraph = "https://graph.facebook.com/v8.0/155385779255?fields=leadgen_forms.limit(1000)%7Bleads_count%2Cname%7D&access_token=".$TokenSergioArboleda;
/*Envío la consulta*/
$ConsultaSergioArboleda = (json_decode(file_get_contents($UrlFbGraph), true));
/*Recibo la petición*/
$CountLeads = 0;
$FormsArray = array();
/*Recibo la información de los formularios y los almaceno en un arreglo*/
foreach ($ConsultaSergioArboleda as $Valores) {
	if(!empty($Valores['data'])){
		foreach ($Valores['data'] as $IdForms) {
			$FormsArray[] = array('name'=>$IdForms['name'],'leads_count'=>$IdForms['leads_count'],'id_form'=>$IdForms['id']);
		}	
	}	
}
/*Descargo la información de esos leads*/
$LeadsResponse = array();
$LeadsOrganizados = array();
foreach ($FormsArray as $FormsDownload) {
	$LeadsDownload = json_decode(file_get_contents("https://graph.facebook.com/v8.0/".$FormsDownload['id_form']."/leads?filtering=%5B%7B%22field%22%3A%20%22time_created%22%2C%22operator%22%3A%20%22GREATER_THAN_OR_EQUAL%22%2C%22value%22%3A".$d->getTimestamp()."%7D%5D&limit=100000&access_token=".$TokenSergioArboleda));
	foreach ($LeadsDownload->data as $Response) {
		foreach ($Response->field_data as $Leads) {
			$LeadsOrganizados[$Response->id]['FechaRegistro']=date("Y-m-d H:i:s", strtotime($Response->created_time));
			if($Leads->name=="nombre" OR $Leads->name=="first_name"){
				$LeadsOrganizados[$Response->id]['Nombres']=$Leads->values[0];
			}
			else if($Leads->name=="apellido" OR $Leads->name=="last_name"){
				$LeadsOrganizados[$Response->id]['Apellidos']=$Leads->values[0];
			}
			else if($Leads->name=="número_de_teléfono" OR $Leads->name=="phone_number"){
				$LeadsOrganizados[$Response->id]['Telefono']=$Leads->values[0];
			}
			else if($Leads->name=="correo_electrónico" OR $Leads->name=="email" OR $Leads->name=="número_de_telefóno_2" OR $Leads->name=="número_de_teléfono_2" OR $Leads->name=="número_de_telefóno"){
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
	$Formularios[] = array('NombreFormulario'=>$FormsDownload['name'],'IdFormulario'=>$FormsDownload['id_form'],'CantidadLeads'=>count($LeadsOrganizados),'FechaConsulta'=>$Fecha,'Leads'=>$LeadsOrganizados);
	$LeadsOrganizados = array();
}
echo count($Formularios);
print_r(json_encode($Formularios));