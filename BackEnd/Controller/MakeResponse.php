<?php

    class MakeResponse{
        public function globalResponse($Response){
            if($Response == null){
                $answer["Response"] = (object) array(
                    "status" => "error",
                );
            }else{
                $answer["Response"] = (object) array(
                    "Status"          => $Response["Status"],
                    "StatusNumber"    => $Response["StatusNumber"],
                    "Token"           => $Response["Token"],
                    "role"            => $Response["role"],
                    "ResponseMessage" => $Response["ResponseMessage"]
                );
            }
            header('Content-Type: application/json; charset=utf-8');
            return json_encode($answer);
        }
        public function UserResponse($user_information,$session){
            if($user_information == null){
                $answer["Response"] = (object) array(
                    "status" => "error",
                );
            }else{
                 $answer["Response"] = (object) array(
                     "firstname"=>    $user_information["firstname"]  
                     ,"lastname"=>    $user_information["lastname"]  
                     ,"username"=>    $user_information["username"] 
                     ,"Token"=>       $user_information["Token"] 
                     ,"email"=>       $user_information["email"] 
                     ,"gender"=>      $user_information["gender"] 
                     ,"phoneNumber"=> $user_information["phoneNumber"]
                     ,"isActive"=>    $user_information["isActive"] 
                     ,"role"=>        $user_information["role"] 
                     ,"imageLink"=>   $user_information["imageLink"]
                     ,"session_active"=>   $session["active"] 
                 );
            }
            header('Content-Type: application/json; charset=utf-8');
            return json_encode($answer);
        }
        
    }

?>