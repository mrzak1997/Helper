<?php

    class CheckDatabasebeCreated{
        public function CheckDatabasebe(){
            $config = new config();
            $Connection = $config->Conncetion();
            $ConnVar = $GLOBALS['ConnVar'];
            $conn = $GLOBALS['conn'];

            $db_query = "CREATE DATABASE IF NOT EXISTS " . $ConnVar["database"] . "";
            if(mysqli_query($conn,$db_query)){
                mysqli_close($conn);
                
                //$GLOBALS['conn_db'] = mysqli_connect($ConnVar["servername"], $ConnVar["username"], $ConnVar["password"],$ConnVar["database"]);
            
                return true;
            }
            return false; 
        }
        public function CheckUserTablebeCreated(){

            $config = new config();
            $Connection = $config->Conncetion();
            $ConnVar = $GLOBALS['ConnVar'];
            $conn = mysqli_connect($ConnVar["servername"], $ConnVar["username"], $ConnVar["password"],$ConnVar["database"]);

            if(!isset($conn)){
                return false;
            }
            $CheckExistTable_sql = "SELECT COUNT(*) FROM information_schema.tables 
            WHERE table_schema = '".$ConnVar["database"]."' AND table_name = 'user'";
            
            $result = mysqli_query($conn, $CheckExistTable_sql);
            $row = mysqli_fetch_assoc($result);

            if($row["COUNT(*)"]=='1'){
                mysqli_close($conn);
                return true;
            }
            
            return false;
        }
    }

?>