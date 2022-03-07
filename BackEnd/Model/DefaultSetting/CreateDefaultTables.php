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
                `username` VARCHAR(30) NOT NULL , 
                `password` VARCHAR(300) NOT NULL ,
                `email` VARCHAR(150) NOT NULL , 
                `gender` VARCHAR(10) ,
                `phoneNumber` VARCHAR(15) , 
                `isActive` BOOLEAN NOT NULL ,
                `role` VARCHAR(30) NOT NULL,
                `imageLink` VARCHAR(400),
                `date` TIMESTAMP NOT NULL ,
                 PRIMARY KEY (`user_id`)) ENGINE = InnoDB";
                
            $CreateLoginlogTable = "CREATE TABLE IF NOT EXISTS " . $ConnVar["database"] . ".`loginLog` (
                `id` INT NOT NULL AUTO_INCREMENT ,
                `username` VARCHAR(30) NOT NULL ,
                `status` varchar(20) NOT NULL,
                `status_number` INT NOT NULL,
                `ip` varchar(30) NOT NULL,
                `isActive` BOOLEAN NOT NULL ,
                `date` TIMESTAMP NOT NULL , 
                PRIMARY KEY (`id`)) ENGINE = InnoDB";
                    
            $CreateRolePermitionTable = "CREATE TABLE IF NOT EXISTS " . $ConnVar["database"] . ".`rolePermition` (
                `id` INT NOT NULL AUTO_INCREMENT ,
                `role` VARCHAR(30) NOT NULL,
                `api_name` VARCHAR(30) NOT NULL,
                PRIMARY KEY (`id`)) ENGINE = InnoDB";

            $CreateResponseMessageTable = "CREATE TABLE IF NOT EXISTS " . $ConnVar["database"] . ".`response_Message` (
                `message_id` INT NOT NULL AUTO_INCREMENT ,
                `message_status` varchar(20) NOT NULL,
                `message_loc` varchar(30) NOT NULL,
                `message_number` INT,
                `message` varchar(300) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
                `date` TIMESTAMP NOT NULL , 
                PRIMARY KEY (`message_id`)) ENGINE = InnoDB";    

            $CreateChartProjectTable = "CREATE TABLE IF NOT EXISTS " . $ConnVar["database"] . ".`chart_project` (
                    `project_id` INT NOT NULL AUTO_INCREMENT ,
                    `project_name` varchar(100) NOT NULL,
                    `username` varchar(30) NOT NULL,
                    `date` TIMESTAMP NOT NULL , 
                    PRIMARY KEY (`project_id`)) ENGINE = InnoDB";  
            $CreateChartNodesTable = "CREATE TABLE IF NOT EXISTS " . $ConnVar["database"] . ".`chart_nodes` (
                `node_id` INT NOT NULL AUTO_INCREMENT ,
                `node_type` int NOT NULL,
                `node_previous` int NOT NULL,
                `node_next` int NOT NULL,
                `node_text` varchar(30),
                `project_name`  varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
                `date` TIMESTAMP NOT NULL , 
                PRIMARY KEY (`node_id`)) ENGINE = InnoDB"; 
            $CreateMenuTable = "CREATE TABLE IF NOT EXISTS " . $ConnVar["database"] . ".`menu_items` (
                    `item_id` INT NOT NULL AUTO_INCREMENT ,
                    `primary_item_name` varchar(30) NOT NULL,
                    `item_name` varchar(30) NOT NULL,
                    `item_image_link` varchar(500) NOT NULL,
                    `date` TIMESTAMP NOT NULL , 
                    PRIMARY KEY (`item_id`)) ENGINE = InnoDB"; 

            $sqls=[
                $Create_Database
                ,$CreateUserTable
                ,$CreateLoginlogTable
                ,$CreateRolePermitionTable
                ,$CreateResponseMessageTable
                ,$CreateChartProjectTable
                ,$CreateChartNodesTable
                ,$CreateMenuTable
            ];
            
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