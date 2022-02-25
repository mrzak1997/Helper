<?php
    include "Security.php";
    include "MakeResponse.php";
    include "../Model/LoginFunctions.php";
   
    class Authentication{

        public function main($user){

            $MakeResponse = new MakeResponse();

            //if username and password be empty return 400
            if(!$this->isEmpty($user)){
                $log["status_number"]=400;
                return $MakeResponse->LoginResponse("erorr",$log,"Data is empty");// isempty
            }
            
            //this method checking $user not be Dangerous
            $Security = new Security();
            $user=$Security->isDangerous($user);

            //
            $CheckPasswordStatus = $this->CheckPasswordMethod($user);
            
            if($CheckPasswordStatus["status_number"] == 404)  return $MakeResponse->LoginResponse("erorr",$CheckPasswordStatus,"Not Found"); //not found
            if($CheckPasswordStatus["status_number"] == 405)  return $MakeResponse->LoginResponse("erorr",$CheckPasswordStatus,"user is Blocked"); //isBlock Loooog
            if($CheckPasswordStatus["status_number"] == 450)  return $MakeResponse->LoginResponse("erorr",$CheckPasswordStatus,"username exist but password is not correct"); //username exist but not correct password Loooog
            if($CheckPasswordStatus["status_number"] == 200)  return $MakeResponse->LoginResponse("successful",$CheckPasswordStatus,"Successful login"); //successfull login Loooog


            ////sesion
        } 
        private function isEmpty($user){
            foreach($user as $string){
                if($string == null){
                    return false;
                }
            }
            return true;
        }
        private function bestPassword($password){

        }
        private function CheckPasswordMethod($user){
            $LoginFunctions = new LoginFunctions();
            return $LoginFunctions->CheckPassword($user);
        }
        
    }

?>