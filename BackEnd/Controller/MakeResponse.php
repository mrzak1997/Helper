<?php

    class MakeResponse{
        public function LoginResponse($StatusValue,$log,$ResponseMessage){
            $answer["Response"] = (object) array(
                "Status" => $StatusValue,
                "StatusNumber" => $log["status_number"],
                "Token" => isset($log["token"]) ? $log["token"]:null,
                "role" => isset($log["role"] ) ? $log["role"]:null,
                "ResponseMessage" => $ResponseMessage
            );
            header('Content-Type: application/json; charset=utf-8');
            return json_encode($answer);
        }
    }

?>