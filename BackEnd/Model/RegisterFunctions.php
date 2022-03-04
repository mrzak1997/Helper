<?php

    class RegisterFunctions{
        public function main($user)
        {
            
            //exist user
            if($this->checking_exist('username',$user["username"])){
                $log["status_number"]=750;
                return $log;
            }
            //exist phone number
            if($this->checking_exist('phoneNumber',$user["phoneNumber"])){
                $log["status_number"]=751;
                return $log;
            }
            //exist email
            if($this->checking_exist('email',$user["email"])){
                $log["status_number"]=752;
                return $log;
            }


            $user["token"] = $this->create_user_Token($user);

            return $this->insert_new_user($user);
            
        }
        private function checking_exist($key,$value)
        {   
            $config = new config();
            $Security = new Security();
    
            $Connection = $config->Conncetion();
            $ConnVar = $GLOBALS['ConnVar'];
            $conn = $GLOBALS['conn_db'];

            $sql_exist = "SELECT * FROM user WHERE ".$key."='".$value."'";
            
            $result = mysqli_query($conn, $sql_exist);
            
            if (mysqli_num_rows($result) > 0) {
                mysqli_close($conn);
                return true;
            }
            
            mysqli_close($conn);
            return false;
        }
        private function create_user_Token($user)
        {
            $Security = new Security();
            date_default_timezone_set("Asia/Tehran");
            return $Security->hashing_string($user['password'],date('Y-m-d h:i:sa'));
        }
        private function insert_new_user($user)
        {
            $config = new config();
            $Connection = $config->Conncetion();
            $ConnVar = $GLOBALS['ConnVar'];
            $conn = $GLOBALS['conn_db'];
            
            date_default_timezone_set("Asia/Tehran");
            
            $insert_Sql = "INSERT INTO user (firstname,lastname,username,password,email,gender,phoneNumber,isActive,role,imageLink) 
                            VALUES('".$user['firstname']."','".$user['lastname']."','".$user['username']."','".$user["token"]."',
                            '".$user["email"]."','".$user['gender']."','".$user['phoneNumber']."',1,'user','')";
            
            $log_Sql =  "INSERT INTO loginlog (username,status,status_number,ip,isActive) 
            VALUES('".$user['username']."','successful','200','".$user["ip"]."',1)";
            
            if(mysqli_query($conn,$insert_Sql) && mysqli_query($conn,$log_Sql)){
                mysqli_close($conn);

                $log["status_number"]=700;
                $log["token"]=$user["token"];
                $log["role"]='user';

                return $log;
            }
        }
        
    }

?>