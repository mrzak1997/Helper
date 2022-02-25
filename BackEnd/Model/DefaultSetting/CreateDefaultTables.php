<?php
    class CreateDefaultTables{
        
        public function CreatetTable(){
            $config = new config();
            $Connection = $config->Conncetion();
            $ConnVar = $GLOBALS['ConnVar'];
            $conn = $GLOBALS['conn'];

            $Create_Database = "CREATE DATABASE IF NOT EXISTS " . $ConnVar['database'] . "";

            $CreateUserTable = "CREATE TABLE IF NOT EXISTS " . $ConnVar["database"] . ".`user` (
                `user_id` INT NOT NULL AUTO_INCREMENT ,
                `firstname` VARCHAR(30) CHARACTER SET utf8 COLLATE utf8_general_ci  ,
                `lastname` VARCHAR(30) CHARACTER SET utf8 COLLATE utf8_general_ci ,
                `username` VARCHAR(30) NOT NULL , `password` VARCHAR(300) NOT NULL ,
                `email` VARCHAR(150) NOT NULL , `gender` VARCHAR(10) ,
                `phoneNumber` VARCHAR(15) , `isBlock` BOOLEAN NOT NULL ,
                `role` VARCHAR(30) NOT NULL,
                `imageLink` VARCHAR(400),`date` TIMESTAMP NOT NULL ,
                 PRIMARY KEY (`user_id`)) ENGINE = InnoDB";
                
            $CreateLoginlogTable = "CREATE TABLE IF NOT EXISTS " . $ConnVar["database"] . ".`loginLog` (
                `id` INT NOT NULL AUTO_INCREMENT ,
                `user_id` INT NOT NULL,
                `status` varchar(20) NOT NULL,
                `status_number` INT NOT NULL,
                `ip` varchar(30) NOT NULL,
                `count` INT NOT NULL ,
                `isBlock` BOOLEAN NOT NULL ,
                `date` TIMESTAMP NOT NULL , 
                PRIMARY KEY (`id`)) ENGINE = InnoDB";
                    
            $CreateRolePermitionTable = "CREATE TABLE IF NOT EXISTS " . $ConnVar["database"] . ".`rolePermition` (
                `id` INT NOT NULL AUTO_INCREMENT ,
                `role` VARCHAR(30) NOT NULL,
                `api_name` VARCHAR(30) NOT NULL,
                PRIMARY KEY (`id`)) ENGINE = InnoDB";

            $sqls=[$Create_Database,$CreateUserTable,$CreateLoginlogTable,$CreateRolePermitionTable];
            
            foreach($sqls as $sql){
                if (!$this->run_query($conn, $sql)){
                    return false;
                }
            }
            mysqli_close($conn);
            return true;
            
        }
        
        private function run_query($conn, $sql)
        {
            if (mysqli_query($conn, $sql)) {
                return true;
            }
            mysqli_close($conn);
            return false;
        }

    }

?>