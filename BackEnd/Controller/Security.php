<?php
    class Security{
        public function isDangerous($array){
            $new_array=$array;
            $counter=0;
            foreach($array as $key => $string){
                $new_array[$key]=htmlspecialchars($string);
                $new_array[$key]=strip_tags($new_array[$key]);
                $counter++;
            }
            return $new_array;
        } 
        public function hashing_string($string,$date){
            return md5("redstar".$string.$date);
        }
        public function set_user_cookie($username,$Token){
           
           //if(!isset($_COOKIE["username"]) || !isset($_COOKIE["Token"])){
                
                setcookie("username", $username, time() + (86400 * 1),'/');
                setcookie("Token", $Token, time() + (86400 * 1),'/');
                //var_dump(getallheaders());
            //
            
            return true;
        }
        
    }

?>
