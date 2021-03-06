<?php
    include "Security.php";
    include "MakeResponse.php";
    include "../Model/LoginFunctions.php";
    include "../Model/RegisterFunctions.php";
    include "../Model/tools/GetResponseMessage.php";
    include "../Model/UserInformation.php";
    include "../Model/CheckCookie.php";
    class Authentication{

        public function main($user){

            //if username and password be empty return 400
            if(!$this->isEmpty($user)){
                $Response["status_loc"]="login";
                $Response["status_number"]=400;
                $Response["Token"]=null;
                $Response["role"]=null;
                return $this->getResponseMessage($Response);
            }
            
            //this method checking $user not be Dangerous
            $Security = new Security();
            $user=$Security->isDangerous($user);
            //
            $CheckPasswordStatus = $this->CheckPasswordMethod($user);
            $CheckPasswordStatus["status_loc"]="login";
            return $this->getResponseMessage($CheckPasswordStatus); 

            ////sesion
        }
        public function getUserinformation($information){
            $UserInformation = new UserInformation();
            $MakeResponse = new MakeResponse();
            //$CheckCookie = new CheckCookie();
            
            //$session["active"] = $CheckCookie->CheckUserCookie();
            $session["active"]= $UserInformation->check_database_cookie_in_loginglog($information["username"]);
            if($session["active"]){
                return $MakeResponse->UserResponse($UserInformation->getUserinformation($information),$session);
            }
            return $MakeResponse->UserResponse(null,null);
            
        } 
        public function user_register($user,$user_optional){

            $RegisterFunctions=new RegisterFunctions();
            $Response_data["status_loc"]="register";
            if(!$this->isEmpty($user)){
                
                $Response_data["status_number"]=400;
                return $this->getResponseMessage($Response_data);
            }
            $user["firstname"] = $user_optional["firstname"];
            $user["lastname"]  =  $user_optional["lastname"];
            $user["gender"]    = $user_optional["gender"];
            
            $Security = new Security();
            $user=$Security->isDangerous($user);

            return $this->getResponseMessage($RegisterFunctions->main($user));            
        }
        private function isEmpty($user){
            foreach($user as $string){
                if($string == null){
                    return false;
                }
            }
            return true;
        }
        private function CheckPasswordMethod($user){
            $LoginFunctions = new LoginFunctions();
            return $LoginFunctions->CheckPassword($user);
        }
        private function getResponseMessage($Response_data){
            $GetResponseMessage = new GetResponseMessage();
            $MakeResponse = new MakeResponse();

            return $MakeResponse->globalResponse($GetResponseMessage ->GetResponse($Response_data)); 
        }
        
    }

?>