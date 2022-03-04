<?php

    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: *");
    
    include "..\config.php";
    include "..\Controller\DefaultSettings.php";
    include "..\Controller\Authentication.php";
    
    $Authentication = new Authentication();
    $json = file_get_contents('php://input');
    $data = json_decode($json);
    
    if((isset($data->username) && isset($data->password) && isset($data->email)   && isset($data->phone_number))
    || (isset($_POST["username"]) && isset($_POST["password"]) && isset($_POST["email"]) && isset($_POST["phone_number"]))){

        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }

        $user["ip"]=$ip;
        $user["username"] = isset($data->username) != null  ? $data->username : $_POST["username"];
        $user["password"] = isset($data->password) != null ? $data->password : $_POST["password"];
        $user["email"] = isset($data->email) != null  ? $data->email : $_POST["email"];
        $user["phoneNumber"] = isset($data->phone_number) != null ? $data->phone_number : $_POST["phone_number"];

        $user_optional["firstname"] = isset($data->firstname) != null ? $data->firstname : $_POST["firstname"];
        $user_optional["lastname"] = isset($data->lastname) != null ? $data->lastname : $_POST["lastname"];
        $user_optional["gender"] = isset($data->gender) != null ? $data->gender : $_POST["gender"];
        
        echo $Authentication->user_register($user,$user_optional);
    }else{
        echo "not found";
    }
    
?>