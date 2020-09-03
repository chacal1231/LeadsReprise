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
if(isset($_POST['IdLead'])){
	$CRM = new SugarCRM();
	$IdLead = $link->real_escape_string($_POST['IdLead']);
	$QueryLead = $link->query("SELECT * FROM leads_facebook WHERE IdLead='".$IdLead."'");
	$RowLead = $QueryLead->fetch_array();
	$ResponseCRM = $CRM->sendDataCRM($RowLead['Nombres'],$RowLead['Apellidos'],$RowLead['Telefono1'],$RowLead['Telefono2'],$RowLead['NombreFormulario'],$RowLead['TipoPrograma'],$RowLead['Correo'],$RowLead['Ciudad']);
	if($ResponseCRM->id){
		$link->query("UPDATE leads_facebook SET EstadoCarga='OK' WHERE IdLead='".$RowLead['IdLead']."'");
		echo json_encode(array('Estado'=>'OK'));
	}else{
		$link->query("UPDATE leads_facebook SET EstadoCarga='ERROR' WHERE IdLead='".$RowLead['IdLead']."'");
		echo json_encode(array('Estado'=>'ERROR'));
	}
}