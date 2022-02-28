<?php
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: *");

    include "..\config.php";
    include "..\Controller\Authentication.php";
    
    $Authentication = new Authentication();
    
    if(isset($_GET["username"]) && isset($_GET["Token"])){
        $information["username"] = isset($_GET["username"]) != null  ? $_GET["username"]:null;
        $information["Token"] = isset($_GET["Token"]) != null ? $_GET["Token"]:null;
        
        echo $Authentication->getUserinformation($information);
    }else{
        echo "not found";
    }

?>
