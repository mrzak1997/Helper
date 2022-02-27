<?php
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: *");

    include "..\config.php";
    include "..\Controller\DefaultSettings.php";
    include "..\Controller\Authentication.php";
    
    $Authentication = new Authentication();
    
    $json = file_get_contents('php://input');
    $data = json_decode($json);

    if((isset($data->username) && isset($data->password)) || (isset($_POST["username"]) && isset($_POST["password"]))){
        
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        
        $user["ip"]=$ip;
        $user["username"] = isset($data->username) ?? isset($_POST["username"]);
        $user["password"] = isset($data->password) ?? isset($_POST["password"]);

        echo $Authentication->main($user);
    }else{
        echo "not found";
    }
?>
