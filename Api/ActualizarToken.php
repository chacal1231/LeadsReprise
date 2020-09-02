<?php
include '../Inc/conn.php';
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');
/*Obtengo tl token*/
if(isset($_POST['Token'])){
	$Token = $link->real_escape_string($_POST['Token']);
	/*Actualizo*/
	$link->query("UPDATE facebook SET Token='".$Token."' WHERE Id='0'");
	if(empty($link->error)){
		echo json_encode(array('Estado'=>'OK'));
	}else{
		echo json_encode(array('Estado'=>'ERROR','Error'=>$link->error));
	}
}
