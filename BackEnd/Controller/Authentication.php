<?php
    include "Security.php";
    include "MakeResponse.php";
    include "../Model/LoginFunctions.php";
    include "../Model/tools/GetResponseMessage.php";
    include "../Model/UserInformation.php";
    class Authentication{

        public function main($user){

            //if username and password be empty return 400
            if(!$this->isEmpty($user)){
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
            
            return $this->getResponseMessage($CheckPasswordStatus); 

            ////sesion
        }
        public function getUserinformation($information){
            $UserInformation = new UserInformation();
            $MakeResponse = new MakeResponse();

            $session["expire"] = False;

            return $MakeResponse->UserResponse($UserInformation->getUserinformation($information),$session);
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

            return $MakeResponse->LoginResponse($GetResponseMessage ->GetResponse($Response_data)); 
        }
        
    }

?>