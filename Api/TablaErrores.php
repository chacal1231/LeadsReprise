<?php
include '../Inc/conn.php';
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');
/*Ganancia tabla*/
$QueryErroresTabla = $link->query("SELECT * FROM registro_carga");
$RowErroresTabla = $QueryErroresTabla->fetch_array();
$Data = array();
/*Recorro la consulta*/
foreach ($QueryErroresTabla as $RowErroresTabla => $Response) {
	if($Response['EstadoDescarga']=="OK"){
		$BotonDescarga = '<button class="btn btn-sm btn-success" type="button">OK</button>';
		
	}else{
		$BotonDescarga = '<button class="btn btn-sm btn-danger ErrorDescarga" type="button">ERROR</button>';
	}
	if($Response['EstadoCarga']=="OK"){
		$BotonCarga = '<button class="btn btn-sm btn-success" type="button">OK</button>';
		
	}elseif($Response['EstadoCarga']=="ERROR"){
		$BotonCarga = '<button class="btn btn-sm btn-danger ErrorCarga" type="button">ERROR</button>';
	}
	elseif($Response['EstadoCarga']==""){
		$BotonCarga = '<button class="btn btn-sm btn-info" type="button">NO LEADS</button>';
	}
	$Data[] = array('IdFormulario' => $Response['IdFormulario'],'EstadoDescarga' => $BotonDescarga,'EstadoCarga' => $BotonCarga,"Error"=>$Response['Error'],"FechaCarga"=>$Response['FechaCarga'],"FechaConsulta"=>$Response['FechaConsulta']);
}
/*Devuelvo lo que necesito a DataTables*/
$results = array(
	"sEcho" => 1,
	"iTotalRecords" => count($Data),
	"iTotalDisplayRecords" => count($Data),
	"aaData"=>$Data);
echo json_encode($results);
?>