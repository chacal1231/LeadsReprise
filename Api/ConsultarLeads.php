<?php
include '../Inc/conn.php';
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');
/*Consulta de Leads totales*/
$QueryLeadsTotal = $link->query("SELECT COUNT(*) AS Total FROM leads_facebook");
/*Consulta de Leads hoy*/
$QueryLeadsHoy = $link->query("SELECT COUNT(*) AS Total FROM leads_facebook WHERE DATE(FechaRegistro)=DATE(NOW())");
/*Consulta de Leads ayer*/
$QueryLeadsAyer = $link->query("SELECT COUNT(*) AS Total FROM leads_facebook WHERE DATE(FechaRegistro)=DATE(SUBDATE(NOW(),1))");
/*Consulta de Leads ayer*/
$QueryErrores = $link->query("SELECT COUNT(*) AS Total FROM registro_carga WHERE EstadoCarga='ERROR'");
/*Armo la respuesta*/
$Response = array('LeadsTotales'=>$QueryLeadsTotal->fetch_array()['Total'],'LeadsHoy'=>$QueryLeadsHoy->fetch_array()['Total'],'LeadsAyer'=>$QueryLeadsAyer->fetch_array()['Total'],'Errores'=>$QueryErrores->fetch_array()['Total']);
echo json_encode($Response);