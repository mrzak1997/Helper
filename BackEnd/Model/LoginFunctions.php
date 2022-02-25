<?php
    
    class LoginFunctions{

        public function CheckPassword($user){
            $config = new config();
            $Connection = $config->Conncetion();
            $ConnVar = $GLOBALS['ConnVar'];
            $conn = $GLOBALS['conn_db'];

            $Security = new Security();
            
            $login_sql = "SELECT * FROM user WHERE username='".$user['username']."' AND password='".$Security->hashing_string($user['password'])."'";
            
            $result = mysqli_query($conn, $login_sql);
            if (mysqli_num_rows($result) > 0) {
                //when isActive be 0 everything is ok
                $row = mysqli_fetch_assoc($result);

                if($row["isActive"]==="1"){
                    $log["status_number"]=200;
                    $log["status"]="successful";
                    $log["token"]=$row["password"];
                    $log["role"]=$row["role"];
                    $user["user_id"] = $row["user_id"];

                    $this->InsertLoginLog($log,$user);
                    return $log;
                }
                $log["status_number"]=405;
                return $log;
            }
            //if username be exist
            $login_sql_username = "SELECT * FROM user WHERE username='".$user['username']."'";
            $result = mysqli_query($conn, $login_sql_username);
            if (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                $log["status_number"]=450;
                $log["status"]="error";
                
                $user["user_id"] = $row["user_id"];

                $this->InsertLoginLog($log,$user);
                return $log;
            }
            $log["status_number"]=404;
            return $log;
            mysqli_close($conn);
        }

        public function InsertLoginLog($log,$user){
            $config = new config();
            $Connection = $config->Conncetion();
            $ConnVar = $GLOBALS['ConnVar'];
            $conn = $GLOBALS['conn_db'];
            
            $insert_Sql = "INSERT INTO loginlog (user_id,status,status_number,ip,count,isActive) 
            VALUES('".$user["user_id"]."','".$log["status"]."','".$log["status_number"]."','".$user["ip"]."',0,0)";
            mysqli_query($conn,$insert_Sql);
            
            mysqli_close($conn);
        }
        

    }


?>