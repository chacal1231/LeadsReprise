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
    public function sendDataCRM(){
        $logIn = $this->logInCRM();
        $sessId = $logIn->id;

        $entryArgs = array(
 //Session id - retrieved from login call
            'session' => $sessId,
            'module_name' => 'Leads',
            'select_fields' => array('first_name','last_name'),
        );

        $rps = $this->restRequest($this->url,'get_entry_list',$entryArgs);
        return $rps;
    }
}


$CRM = new SugarCRM();
print_r(json_encode($CRM->sendDataCRM()));
