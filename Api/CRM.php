<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');
ini_set('max_execution_time', 0);
ini_set('memory_limit', '-1');
date_default_timezone_set('America/Bogota');
/*CRM Request*/
class SugarCRM{
    private $url = "https://crmsa.crmsergioarboleda.com/service/v4_1/rest.php";
    public function restRequest($url, $method, $arguments){
        $curl = curl_init($url);
        if($method != ""){
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($curl,CURLOPT_SSL_VERIFYPEER, false);
            $post = array(
                "method" => $method,
                "input_type" => "JSON",
                "response_type" => "JSON",
                "rest_data" => json_encode($arguments),
            );
            curl_setopt($curl, CURLOPT_POSTFIELDS, $post);
        }else{
            $headers = array(
                'Accept: application/json',
                'Content-Type: application/json'            
            );
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($curl, CURLOPT_HEADER, 0);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        }


        $result = curl_exec($curl);
        curl_close($curl);
        return json_decode($result);
    }
    /*Login CRM*/
    public function logInCRM(){
        $args = array(
            'user_auth' => array(
                'user_name' => 'mktdigital',
                'password' => md5('Acceso**951'),
            ),
            'application_name' => "Python-API-Initiative",
            'name_value_list' => array());
        $result = $this->restRequest($this->url,"login",$args);
        return $result;
    }
    /*Enviar data*/
    public function sendDataCRM($Nombres,$Apellidos,$Telefono1,$Telefono2,$Programa,$TipoPrograma,$Correo,$Ciudad){
        $logIn = $this->logInCRM();
        $sessId = $logIn->id;
        $entryArgs = array(
            'session' => $sessId,
            'module_name' => 'Leads',
            'name_value_list' => array(
                array(
                    "name" => "first_name",
                    "value" => $Nombres
                ),
                array(
                    "name" => "last_name",
                    "value" => $Apellidos
                ),
                array(
                    "name" => "phone_mobile",
                    "value" => $Telefono1
                ),
                array(
                    "name" => "phone_other",
                    "value" => $Telefono2
                ),
                array(
                    "name" => "lead_source",
                    "value" => "Facebook"
                ),
                array(
                    "name" => "lead_source_description",
                    "value" => "Facebook_API_JDMV"
                ),  
                array(
                    "name" => "status",
                    "value" => "No Gestionado"
                ),
                array(
                    "name" => "d_programa_interes_c",
                    "value" => $Programa
                ),
                array(
                    "name" => "d_agno_periodo_c",
                    "value" => "2020-1"
                ),
                array(
                    "name" => "d_tipo_programa_c",
                    "value" => $TipoPrograma
                ),
                array(
                    "name" => "description",
                    "value" => "prueba lead desde facebook"
                ),
                array(
                    "name" => "email1",
                    "value" => $Correo
                ),
                array(
                    "name" => "d_ciudad_c",
                    "value" => $Ciudad
                ),
            ),
        );
        $rps = $this->restRequest($this->url,'set_entry',$entryArgs);
        return $rps;
    }
    public function GetDataCRM(){
        $logIn = $this->logInCRM();
        $sessId = $logIn->id;
        $entryArgs = array(
            'session' => $sessId,
            'module_name' => 'Leads',
            'related_module_query' => "lead_source_description='Facebook_API_JDMV'",
            
        );
        $rps = $this->restRequest($this->url,'get_entry_list',$entryArgs);
        return $rps;
    }
}