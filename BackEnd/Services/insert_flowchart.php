<?php
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: *");

    include "..\config.php";
    include "..\Controller\Authentication.php";
    include '..\Controller\flowchart_management.php';
    
    $Authentication = new Authentication();
    $flowchart_management = new flowchart_management();

    $Response["status_loc"]="create_flowchart";
    $Response["Token"]=null;
    $Response["role"]=null;

    $json = file_get_contents('php://input');
    $data = json_decode($json);

        $nodes_arr["redstar"][0] = array(
            "node_previous"     => 3,
            "node_id"           => 4,
            "node_next"         => 5,
            "node_type"         => "X",
            "node_text"         => "text"
        );
        array_push($nodes_arr["redstar"],array(
            "node_previous"     => 4,
            "node_id"           => 5,
            "node_next"         => 6,
            "node_type"         => "Xxxxx",
            "node_text"         => "textxxx"
        ));
        $nodes_arr = json_encode($nodes_arr);

    if((isset($data->username) && isset($data->Token) && isset($data->nodes)) || 
    (isset($_COOKIE["username"]) && isset($_COOKIE["Token"]) && isset($_POST["nodes"]))){
       
        $nodes_arr = isset($data->username) != null  ? $data->nodes : $_POST["nodes"];

        $information["username"] = isset($data->username) != null  ? $data->username : $_COOKIE["username"];
        $information["Token"] = isset($data->password) != null ? $data->password : $_COOKIE["Token"];
  
        $auth_arr= json_decode($Authentication->getUserinformation($information),true);
        
        if(isset($auth_arr["Response"]["session_active"])){
            
            $nodes_arr = json_decode($nodes_arr,true);
            $information['project_name']=array_key_first($nodes_arr);
    
            echo $flowchart_management->main($nodes_arr,$information);

        }else{
            //eshkal dar etebar sanji dobareh vared shavid
            $Response["status_number"]=754;
            echo $flowchart_management->getResponseMessage($Response);
        }
    }else{
        //eshkar dar barsi etelaat
        $Response["status_number"]=753;
        echo $flowchart_management->getResponseMessage($Response);
    }

?>