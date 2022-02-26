<?php

    class MakeResponse{
        public function LoginResponse($Response){
            $answer["Response"] = (object) array(
                "Status" => $Response["Status"],
                "StatusNumber" => $Response["StatusNumber"],
                "Token" => $Response["Token"],
                "role" => $Response["role"],
                "ResponseMessage" => $Response["ResponseMessage"]
            );
            header('Content-Type: application/json; charset=utf-8');
            return json_encode($answer);
        }
    }

?>