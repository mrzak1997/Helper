<?php
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: *");

    include "..\config.php";
    include "..\Controller\Authentication.php";
    
    
    $Authentication = new Authentication();
    
    $header_parameter = getallheaders();

    if(isset($header_parameter["username"]) && isset($header_parameter["Token"])){
            
        $information["username"] = isset($header_parameter["username"]) != null  ? $header_parameter["username"]:null;
        $information["Token"] = isset($header_parameter["Token"]) != null ? $header_parameter["Token"]:null;
        
        echo $Authentication->getUserinformation($information);
    }else{
        echo json_encode($answer["Response"] = (object) array(
            "status" => false
        ));
    }

?>
