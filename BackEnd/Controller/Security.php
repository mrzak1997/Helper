<?php
    class Security{
        public function isDangerous($array){
            $new_array=$array;
            $counter=0;
            foreach($array as $string){
                $new_array[$counter]=htmlspecialchars($string);
                $new_array[$counter]=strip_tags($new_array[$counter]);
                $counter++;
            }
            return $new_array;
        } 
        public function hashing_string($string){
            return hash('sha256',"redstar".$string);
        }
        public function set_user_cookie($username,$Token){
           // setcookie("username", $username, time() + (86400 * 30), '/');
           // setcookie("Token", $Token, time() + (86400 * 30), '/');
           if(!isset($_COOKIE["username"]) || !isset($_COOKIE["Token"])){
                setcookie("username", $username, time() + (86400 * 1), '/');
                setcookie("Token", $Token, time() + (86400 * 1), '/');
            }
            return true;
        }
        
    }

?>