<?php
include '../Inc/conn.php';
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');
/*Inicio la sesion*/
session_start();
/*Ganancia tabla*/
$QueryErroresTabla = $link->query("SELECT * FROM registro_carga");
$RowErroresTabla = $QueryErroresTabla->fetch_array();
$Data = array();
/*Recorro la consulta*/
foreach ($QueryErroresTabla as $RowErroresTabla => $Response) {
	if($Response['EstadoCarga']=="OK"){
		$Boton = '<button class="btn btn-sm btn-success" type="button">OK</button>';
		
	}else{
		$Boton = '<button class="btn btn-sm btn-danger" type="button">ERROR</button>';
	}
	$Data[] = array('IdFormulario' => $Response['IdFormulario'],'Estado' => $Boton,"Error"=>$Response['Error'],"Fecha"=>$Response['FechaCarga']);
}
/*Devuelvo lo que necesito a DataTables*/
$results = array(
	"sEcho" => 1,
	"iTotalRecords" => count($Data),
	"iTotalDisplayRecords" => count($Data),
	"aaData"=>$Data);
echo json_encode($results);
?>