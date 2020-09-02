<?php
include '../Inc/conn.php';
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');
/*Obtengo tl token*/
if(isset($_POST['TipoPrograma'])){
	$TipoPrograma = $link->real_escape_string($_POST['TipoPrograma']);
	$NombrePrograma = $link->real_escape_string($_POST['NombrePrograma']);
	$IdFormulario = $link->real_escape_string($_POST['IdFormulario']);
	/*Actualizo*/
	$link->query("INSERT INTO formularios_reprise(TipoPrograma,NombrePrograma,IdFormulario) VALUES('".$TipoPrograma."','".$NombrePrograma."','".$IdFormulario."')");
	if(empty($link->error)){
		echo json_encode(array('Estado'=>'OK'));
	}else{
		echo json_encode(array('Estado'=>'ERROR','Error'=>$link->error));
	}
}
