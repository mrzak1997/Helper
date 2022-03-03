<?php
    class Userinformation{
        public function getUserinformation($information){
            $config = new config();
            $Connection = $config->Conncetion();
            $ConnVar = $GLOBALS['ConnVar'];
            $conn = $GLOBALS['conn_db'];

            $Security = new Security();
            
            $login_sql = "SELECT * FROM user WHERE username='".$information['username']."' AND password='".$information['Token']."'";
            
            $result = mysqli_query($conn, $login_sql);
            $user_information=null;
            if (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                
                $user_information["firstname"] = $row["firstname"];
                $user_information["lastname"] = $row["lastname"];
                $user_information["username"] = $row["username"];
                $user_information["Token"] = $row["password"];
                $user_information["email"] = $row["email"];
                $user_information["gender"] = $row["gender"];
                $user_information["phoneNumber"] = $row["phoneNumber"];
                $user_information["isActive"] = $row["isActive"];
                $user_information["role"] = $row["role"];
                $user_information["imageLink"] = $row["imageLink"];
                ////    
                
            }
            mysqli_close($conn);
            return $user_information;

        }
        public function check_database_cookie_in_loginglog($username){
            $config = new config();
            $Connection = $config->Conncetion();
            $ConnVar = $GLOBALS['ConnVar'];
            $conn = $GLOBALS['conn_db'];

            date_default_timezone_set("Asia/Tehran");
            
            $login_sql = "SELECT * FROM loginlog WHERE username='".$username."' ORDER BY id DESC";
            
            $result = mysqli_query($conn, $login_sql);

            if (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                $date =date('Y-m-d', strtotime($row["date"]. ' + 1 days'));
                if( $row["isActive"]=="1" && 
                    $row["status"]=="successful" &&
                    date('Y-m-d') < $date ){
                    mysqli_close($conn);
                    return true;
                }
                mysqli_close($conn);
                return false;
            }
        }   
    }
?>