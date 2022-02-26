<?php
    class GetResponseMessage{
        public function GetResponse($Response_data){
            $config = new config();
            $Connection = $config->Conncetion();
            $ConnVar = $GLOBALS['ConnVar'];
            $conn = $GLOBALS['conn_db'];

            $sql = "SELECT * FROM response_message WHERE message_number=".$Response_data['status_number']."";
            
            $result = mysqli_query($conn,$sql);

            if (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                $Response["Status"]= $row["message_status"];
                $Response["StatusNumber"]= $row["message_number"];
                $Response["Token"]= isset($Response["Token"]) ? $Response["Token"]:null;
                $Response["role"]= isset($Response["role"]) ? $Response["role"]:null;
                $Response["ResponseMessage"]= $row["message"];

            }
            mysqli_close($conn);
            return $Response;

        }

    }

?>