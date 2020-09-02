<?php
include '../Inc/conn.php';
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');
$Data = $_GET['Data'];
/*Consulto los Leads*/
$QueryLeads = $link->query("SELECT * FROM leads_facebook WHERE EstadoCarga='ERROR' AND IdFormulario='".$Data['IdFormulario']."'");
$RowLeads = $QueryLeads->fetch_array();
foreach ($QueryLeads as $RowLeads => $value) {
	$DataResponse[] = array('FechaRegistro'=>$value['FechaRegistro'],'IdLead'=>$value['IdLead']);
}
echo json_encode(array('Data'=>$DataResponse));