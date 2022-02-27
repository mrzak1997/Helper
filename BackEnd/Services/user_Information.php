<?php
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: *");

    include "..\config.php";
    include "..\Controller\Authentication.php";
    
    $Authentication = new Authentication();
    
    $json = file_get_contents('php://input');
    $data = json_decode($json);

    if((isset($data->username) && isset($data->Token)) || 
        (isset($_POST["username"]) && isset($_POST["Token"]))){

        $information["username"] = isset($data->username) != null  ? $data->username : $_POST["username"];
        $information["Token"] = isset($data->Token) != null ? $data->Token : $_POST["Token"];
        echo $Authentication->getUserinformation($information);
    }else{
        echo "not found";
    }

?>