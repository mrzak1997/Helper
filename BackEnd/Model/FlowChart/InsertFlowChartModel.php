<?php

    class InsertFlowChartModel{
        public function insert_nodes($nodes_arr,$information){
            $config = new config();
            $Connection = $config->Conncetion();
            $ConnVar = $GLOBALS['ConnVar'];
            $conn = mysqli_connect($ConnVar["servername"], $ConnVar["username"], $ConnVar["password"],$ConnVar["database"]);
            
            $pre_varible = $nodes_arr[$information['project_name']];

            $true_size_flag=0;
            for($i=0;$i<sizeof($pre_varible);$i++){
                $insert_nodes_sql = "INSERT INTO chart_nodes(node_id,node_type,node_previous,node_next,project_id) 
                    VALUES('".$pre_varible[$i]['node_id']."','".$pre_varible[$i]['node_type']."','".$pre_varible[$i]['node_previous']."',
                    '".$pre_varible[$i]['node_next']."','".$information['project_id']."')";
                    if(mysqli_query($conn,$insert_nodes_sql)){
                        $true_size_flag++;
                    }
            }
            

            if($true_size_flag == sizeof($pre_varible)){
                return true;
            }else{
                return false;
            }
        }
        public function insert_project_name($username, $project_name){
            $config = new config();
            $Connection = $config->Conncetion();
            $ConnVar = $GLOBALS['ConnVar'];
            $conn = mysqli_connect($ConnVar["servername"], $ConnVar["username"], $ConnVar["password"],$ConnVar["database"]);
            
            $check_exits_project = "SELECT * FROM chart_project 
                WHERE project_name='".$project_name."' AND username='".$username."'";
            $result = mysqli_query($conn,$check_exits_project);
            if(mysqli_fetch_assoc($result)==0){
                
                $insert_Sql = "INSERT INTO chart_project (project_name,username) 
                VALUES('".$project_name."','".$username."')";
                 
                mysqli_query($conn,$insert_Sql);
                return mysqli_insert_id($conn);
            }
            mysqli_close($conn);
            return false;
        }
    }

?>