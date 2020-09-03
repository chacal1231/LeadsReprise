<?php
include 'CRM.php';
$CRM = new SugarCRM();
echo json_encode($CRM->GetDataCRM());