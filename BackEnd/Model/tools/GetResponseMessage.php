<?php
    class GetResponseMessage{
        public function GetResponse($Response_data){
            $config = new config();
            $Connection = $config->Conncetion();
            $ConnVar = $GLOBALS['ConnVar'];
            $conn = $GLOBALS['conn_db'];

            $sql = "SELECT * FROM response_message WHERE message_number=".$Response_data['status_number']." AND message_loc='".$Response_data['status_loc']."'";
            
            $result = mysqli_query($conn,$sql);

            if (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                $Response["Status"]= isset($row["message_status"]) ? $row["message_status"] : null;
                $Response["StatusNumber"]= isset($row["message_number"])? $row["message_number"] : null ;
                $Response["Token"]= isset($Response_data["token"]) ? $Response_data["token"] : null ;
                $Response["role"]= isset($Response_data["role"]) ? $Response_data["role"] : null;
                $Response["ResponseMessage"]= isset($row["message"]) ? $row["message"] : null;

            }
            mysqli_close($conn);
            return $Response;

        }

    }

?>