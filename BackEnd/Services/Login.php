<?php
    include "..\config.php";
    include "..\Controller\DefaultSettings.php";
    include "..\Controller\Authentication.php";
    
    $Authentication = new Authentication();

    if(isset($_POST["username"]) && isset($_POST["password"])){
        
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        
        $user["ip"]=$ip;
        $user["username"] = $_POST["username"];
        $user["password"] = $_POST["password"];

        echo $Authentication->main($user);
    }else{
        echo "not found";
    }
?>