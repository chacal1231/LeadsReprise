<?php

class CRM{
   private $dataEXC = array(
        array("tipo_prog" => "Curso","program" => "Curso_Curso Certificado en Lean Six Sigma - Yellow Belt - Lean Expert", "id_form" =>"264984351592498"),
        array("tipo_prog" => "Curso","program" => "Curso_Curso_en_Derecho_Ambiental", "id_form" =>"293963748310830"),
        array("tipo_prog" => "Curso","program" => "Curso_Curso_en_Gestion_de_Proyectos_para_la_Habilitacion_y_Operacion_del_Catastro_Multiproposito", "id_form" =>"586258678672374"),
        array("tipo_prog" => "Curso","program" => "Curso_Curso_en_Gestion_Internacional_del_Talento", "id_form" =>"302931867414720"),
        array("tipo_prog" => "Diplomado","program" => "Diplomado_Diplomado en E-commerce y Negocios Digitales", "id_form" =>"202904004273167"),
        array("tipo_prog" => "Diplomado","program" => "Diplomado_Diplomado en Gestion Riesgo Operativo", "id_form" =>"266976621260232"),
        array("tipo_prog" => "Diplomado","program" => "Diplomado_Diplomado en Marketing digital", "id_form" =>"268536921147678"),
        array("tipo_prog" => "Diplomado","program" => "Diplomado_Diplomado en Metodos Estadisticos para el Analisis de Datos", "id_form" =>"1794478684025432"),
        array("tipo_prog" => "Diplomado","program" => "Diplomado_Diplomado en SARLAFT - Administracion del riesgo de lavado de activos y financiacion del terrorismo", "id_form" =>"2390489244381208"),
        array("tipo_prog" => "Diplomado","program" => "Diplomado_Diplomado en Visita medica profesional", "id_form" =>"1104099103071510"),
        array("tipo_prog" => "Diplomado","program" => "Diplomado_Diplomado_en_BLOCKCHAIN_Desarrollo_De_Aplicaciones_Descentralizadas_Sobre_Ethereum", "id_form" =>"654551875161570"),
        array("tipo_prog" => "Diplomado","program" => "Diplomado_Diplomado_en_Energia_Solar_Fotovoltaica", "id_form" =>"277401083382688"),
        array("tipo_prog" => "Diplomado","program" => "Diplomado_Diplomado_en_Excel_Empresarial_y_Aplicado", "id_form" =>"268844550981294"),
        array("tipo_prog" => "Diplomado","program" => "Diplomado_Diplomado_en_Gamificacion_en_las_Organizaciones", "id_form" =>"2937974469604350"),
        array("tipo_prog" => "Diplomado","program" => "Diplomado_Diplomado_en_Gestion_del_Riesgo_del_Credito", "id_form" =>"703645690209754"),
        array("tipo_prog" => "Diplomado","program" => "Diplomado_Diplomado_en_Inteligencia_Artificial", "id_form" =>"401153837468596"),
        array("tipo_prog" => "Diplomado","program" => "Diplomado_Diplomado_en_Modelamiento_Estadistico_Aplicado_con_Software_Libre", "id_form" =>"2628525524061847"),
        array("tipo_prog" => "Diplomado","program" => "Diplomado_diplomado_en_transformacion_digital_e_industria_4_0", "id_form" =>"637639930438957"),
        array("tipo_prog" => "Diplomado","program" => "Diplomado_En_R_y_Python_Para_El_Analisis_De_Datos", "id_form" =>"282164216238275"),
        array("tipo_prog" => "Especializacion Barranquilla","program" => "Especializacion Barranquilla_Especializacion en Derecho Constitucional BQ", "id_form" =>"2584326151845420"),
        array("tipo_prog" => "Especializacion Barranquilla","program" => "Especializacion Barranquilla_Especializacion en Derecho Penal BQ", "id_form" =>"4030955956977007"),
        array("tipo_prog" => "Especializacion Barranquilla","program" => "Especializacion Barranquilla_Especializacion en Derechos Humanos y Derecho Internacional Humanitario-BQ", "id_form" =>"275316753708427"),
        array("tipo_prog" => "Especializacion Barranquilla","program" => "Especializacion Barranquilla_Especializacion en Educacion-BQ", "id_form" =>"264268061497547"),
        array("tipo_prog" => "Especializacion Barranquilla","program" => "Especializacion Barranquilla_Especializacion en Gerencia Logistica BQ", "id_form" =>"300836601087867"),
        array("tipo_prog" => "Especializacion Barranquilla","program" => "Especializacion Barranquilla_Especializacion_en_Derecho_Laboral_y_Seguridad_Social_BQ", "id_form" =>"2675189306090061"),
        array("tipo_prog" => "Especializacion Barranquilla","program" => "Especializacion Barranquilla_Especializacion_en_Gerencia_Estrategica_de_Negocios_BQ", "id_form" =>"2530060437305613"),
        array("tipo_prog" => "Especializacion Barranquilla","program" => "Especializacion Barranquilla_Especializacion_en_Gerencia_Financiera_BQ", "id_form" =>"711461122963213"),
        array("tipo_prog" => "Especializacion","program" => "Especializacion_Especializacion en Comunicacion Estrategica", "id_form" =>"3021154007932230"),
        array("tipo_prog" => "Especializacion","program" => "Especializacion_Especializacion en Direccion y Gestion de Proyectos", "id_form" =>"401397704109954"),
        array("tipo_prog" => "Especializacion","program" => "Especializacion_Especializacion en Educacion", "id_form" =>"571895976827487"),
        array("tipo_prog" => "Especializacion","program" => "Especializacion_Especializacion en Gerencia de Marketing", "id_form" =>"302383507452668"),
        array("tipo_prog" => "Especializacion","program" => "Especializacion_Especializacion en Gerencia Estrategica de Negocios", "id_form" =>"2839132376214743"),
        array("tipo_prog" => "Especializacion","program" => "Especializacion_Especializacion en Seguridad de la Informacion e Informatica", "id_form" =>"1476683695837634"),
        array("tipo_prog" => "Maestria Barranquilla","program" => "Maestria Barranquilla_Maestria en Direccion y Gestion Tributaria BQ", "id_form" =>"2548391792158290"),
        array("tipo_prog" => "Maestria Barranquilla","program" => "Maestria Barranquilla_MBA - Maestria en Administracion de Negocios - Sede Barranquilla", "id_form" =>"3351999584824100"),
        array("tipo_prog" => "Maestria","program" => "Maestria_Executive MBA", "id_form" =>"1142156446154384"),
        array("tipo_prog" => "Maestria","program" => "Maestria_Maestria en Administracion Financiera - MAF", "id_form" =>"989803081455200"),
        array("tipo_prog" => "Maestria","program" => "Maestria_Maestria en Comercio Internacional - MCI", "id_form" =>"267139844381094"),
        array("tipo_prog" => "Maestria","program" => "Maestria_Maestria en Comunicacion", "id_form" =>"506205390125658"),
        array("tipo_prog" => "Maestria","program" => "Maestria_Maestria en Direccion y Gestion Tributaria - MDGT", "id_form" =>"870601523431393"),
        array("tipo_prog" => "Maestria","program" => "Maestria_Maestria en Economia Urbana y Regional", "id_form" =>"592498768071695"),
        array("tipo_prog" => "Maestria","program" => "Maestria_Maestria en Gestion de la Informacion y Tecnologias Geoespaciales", "id_form" =>"1546551415480520"),
        array("tipo_prog" => "Maestria","program" => "Maestria_Maestria en Gestion Energetica - MGE", "id_form" =>"267920614433931"),
        array("tipo_prog" => "Maestria","program" => "Maestria_Maestria en Historia", "id_form" =>"634704757133808"),
        array("tipo_prog" => "Maestria","program" => "Maestria_Maestria en Politica y Relaciones Internacionales", "id_form" =>"2616589408441727"),
        array("tipo_prog" => "Maestria","program" => "Maestria_Maestria Gerencia Comercial y Marketing - MGCM", "id_form" =>"3044819478905837"),
        array("tipo_prog" => "Maestria","program" => "Maestria_Maestria_en_Gestion_y_Optimizacion_de_la_Calidad", "id_form" =>"196271991733637"),
        array("tipo_prog" => "Maestria","program" => "Maestria_Maestria_en_Mitigacion_y_Adaptacion_para_el_Cambio_Climatico", "id_form" =>"657780744837831"),
        array("tipo_prog" => "Pre-Grado Barranquilla","program" => "Pre-Grado Barranquilla_Administracion de Empresas - Sede Barranquilla", "id_form" =>"848054675715201"),
        array("tipo_prog" => "Pre-Grado Barranquilla","program" => "Pre-Grado Barranquilla_Comunicacion Social y Periodismo - Sede Barranquilla", "id_form" =>"3086701491426428"),
        array("tipo_prog" => "Pre-Grado Barranquilla","program" => "Pre-Grado Barranquilla_Derecho - Sede Barranquilla", "id_form" =>"584406262501672"),
        array("tipo_prog" => "Pre-Grado Barranquilla","program" => "Pre-Grado Barranquilla_Filosofia y Humanidades - Sede Barranquilla", "id_form" =>"164584004792768"),
        array("tipo_prog" => "Pre-Grado Barranquilla","program" => "Pre-Grado Barranquilla_Marketing y Negocios Internacionales - Sede Barranquilla", "id_form" =>"559097781435517"),
        array("tipo_prog" => "Diplomado","program" => "Diplomado_Diplomado_en_sistemas_de_informacion_geografica_aplicado_al_ordenamiento_territorial", "id_form" =>"266378267809164"),
        array("tipo_prog" => "Curso","program" => "Curso_Curso_en_captura_proces_y_aplic_datos_prov_aeronaves_rem_trip", "id_form" =>"285538399250081")

       );
private $dataFB = null;
private $url = "https://crmsa.crmsergioarboleda.com/service/v4_1/rest.php";
private $urlFb = "https://graph.facebook.com/v7.0/";

public function restRequest($url, $method, $arguments){
    $curl = curl_init($url);
    if($method != ""){
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
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

public function getLeadFB($id){
    $url = $this->urlFb;
    $url .= $id."?";
    $url .= "access_token=EAAGa4PG2yp0BAFqLaXwqXUBLEw0mNUibOSbUEuNahD2RoywxpsIJJjO6KXQgslydUZBLcUH7ShUlIDMUxh5P9aT99PJNq7fyRD3dlarUTONohpEZA2ycvKXxbttrvEJW0GyU7GrvNZAIO5QIpNyQ2wwbSj2IVt5ZBCRyzDhTERiH5XbLjv07";
    $url .= "debug=all&format=json&method=get&pretty=0&suppress_http_code=1&transport=cors";

    $data = $this->restRequest($url,"",null);
    $fields = (array) $data->field_data;
    $obj = new stdClass();
    for($i = 0; $i < count($fields); $i++){
        $name = $fields[$i]->name;
        $obj->$name = $fields[$i]->values[0];
    }

    return $obj;
}

public function orderData($idForm){
    $data = $this->dataEXC;
    $centinela = false;
    $ids = "";
    for($i = 0;$i < count($data) && $centinela == false; $i++){
        $obj = (object) $data[$i];
        if($idForm == $obj->id_form){
            $centinela = true;
            return $data[$i];
        }
    }
    if($centinela == false){
        return null;
    }
}

public function getDataFb($data){
    $lead = $this->getLeadFB($data->leadgen_id);
    $dataProg = (object) $this->orderData($data->program);
    if($dataProg != null && $dataProg->id_form != null){
        $myfile = fopen("test/newfile.txt","w") or die("Unable to open file!");
        fwrite($myfile, json_encode($dataProg));
        fclose($myfile);
        $dataLead = new stdClass();
        $dataLead->lead = $lead;
        $dataLead->id_form = $dataProg->id_form;
        $dataLead->program = $dataProg->program; 
        $dataLead->tipo_prog = $dataProg->tipo_prog; 
        $this->dataFB = $dataLead;
        $this->sendDataCRM();

    }

}

public function sendDataCRM(){
    $logIn = $this->logInCRM();
    $sessId = $logIn->id;
    $entryArgs = array(
        'session' => $sessId,
        'module_name' => 'Leads',
        'name_value_list' => array(
            array(
                "name" => "first_name",
                "value" => $this->dataFB->lead->first_name
            ),
            array(
                "name" => "last_name",
                "value" => $this->dataFB->lead->last_name
            ),
            array(
                "name" => "phone_mobile",
                "value" => $this->dataFB->lead->phone_number
            ),
            array(
                "name" => "lead_source",
                "value" => "Facebook"
            ),
            array(
                "name" => "status",
                "value" => "No Gestionado"
            ),
            array(
                "name" => "d_programa_interes_c",
                "value" => $this->dataFB->program
            ),
            array(
                "name" => "d_agno_periodo_c",
                "value" => "2018-1"
            ),
            array(
                "name" => "d_tipo_programa_c",
                "value" => $this->dataFB->tipo_prog
            ),
            array(
                "name" => "description",
                "value" => "prueba lead desde facebook"
            ),
            array(
                "name" => "email1",
                "value" => $this->dataFB->lead->email
            ),
        ),
    );
    $rps = $this->restRequest($this->url,'set_entry',$entryArgs);
}
}

if($_REQUEST['hub_verify_token']){
    if ($_REQUEST['hub_verify_token'] === 'tokentest') {
        $consumer = new CRM();
        $data = json_decode(file_get_contents('php://input'));
        $rps = $consumer->getDataFb($data->entry[0]->changes[0]->value);
    }
}






?>