<?php
    
    class LoginFunctions{

        public function CheckPassword($user){
            $config = new config();
            $Security = new Security();
    
            $Connection = $config->Conncetion();
            $ConnVar = $GLOBALS['ConnVar'];
            $conn = $GLOBALS['conn_db'];

            date_default_timezone_set("Asia/Tehran");

            $last_user_date = $this->get_last_user_date($user['username']);
            $last_password = $Security->hashing_string($user['password'],$last_user_date);
            $new_password= $Security->hashing_string($user['password'],date('Y-m-d h:i:sa'));
            
            $login_sql = "SELECT * FROM user WHERE username='".$user['username']."' AND password='".$last_password."'";
            
            
            $result = mysqli_query($conn, $login_sql);
            if (mysqli_num_rows($result) > 0) {
                //when isActive be 0 everything is ok
                $row = mysqli_fetch_assoc($result);

                if($row["isActive"]==="1"){
                    $log["status_number"]=200;
                    $log["status"]="successful";
                    $log["token"]=$new_password;
                    $log["role"]=$row["role"];
                    $user["username"] = $row["username"];
                    $user['isActive'] = $row["isActive"];

                    //$Security->set_user_cookie($user['username'],$row["password"]);
                    if($last_password != $new_password){
                        $this->change_password_successful_login($user['username'],$last_password,$new_password);
                    }
                    $this->InsertLoginLog($log,$user);
                    return $log;
                }
                $user["username"] = $row["username"];
                $user['isActive'] = $row["isActive"];
                $log["status_number"]=405;
                $log["status"]="error";
                
                $this->InsertLoginLog($log,$user);
                return $log;
            }
            //if username be exist
            $login_sql_username = "SELECT * FROM user WHERE username='".$user['username']."'";
            $result = mysqli_query($conn, $login_sql_username);
            if (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                $log["status_number"]=450;
                $log["status"]="error";
                
                $user["username"] = $row["username"];
                $user['isActive'] = $row["isActive"];

                $this->InsertLoginLog($log,$user);
                return $log;
            }
            $log["status_number"]=404;
            return $log;
            mysqli_close($conn);
        }
        private function InsertLoginLog($log,$user){
            $config = new config();
            $Connection = $config->Conncetion();
            $ConnVar = $GLOBALS['ConnVar'];
            $conn = $GLOBALS['conn_db'];
            
            $insert_Sql = "INSERT INTO loginlog (username,status,status_number,ip,isActive) 
            VALUES('".$user["username"]."','".$log["status"]."','".$log["status_number"]."','".$user["ip"]."','".$user['isActive']."')";
            mysqli_query($conn,$insert_Sql);
            
            mysqli_close($conn);
        }
        private function get_last_user_date($username){
            $config = new config();
            $Connection = $config->Conncetion();
            $ConnVar = $GLOBALS['ConnVar'];
            $conn = $GLOBALS['conn_db'];

            $Security = new Security();
            
            $login_sql = "SELECT * FROM loginlog WHERE username='".$username."' And status='successful' ORDER BY id DESC";
            
            $result = mysqli_query($conn, $login_sql);

            if (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                //$date =date('Y-m-d', strtotime($row["date"]. ' + 1 days'));
                mysqli_close($conn);
                $date = new DateTime($row["date"]);
                return $date->format("Y-m-d h:i:sa");
            }
        }
        private function change_password_successful_login($username,$last_password,$new_password){
            $config = new config();
            $Connection = $config->Conncetion();
            $ConnVar = $GLOBALS['ConnVar'];
            $conn = $GLOBALS['conn_db'];
            
            
            $update_Sql = "UPDATE user SET password='".$new_password."' WHERE username='".$username."' AND password='".$last_password."'";
            
            mysqli_query($conn,$update_Sql);

            mysqli_close($conn);
        }
        

    }


?>