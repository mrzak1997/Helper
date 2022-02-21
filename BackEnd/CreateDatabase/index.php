<?php

$ConnVar["servername"] = "localhost";
$ConnVar["username"] = "root";
$ConnVar["password"] = "";
$ConnVar["database"] = "traderhelper";

$conn = mysqli_connect($ConnVar["servername"], $ConnVar["username"], $ConnVar["password"]);

$sql = "CREATE DATABASE IF NOT EXISTS " . $ConnVar['database'] . "";


if (!mysqli_query($conn, $sql)) {
    echo "Connection is lost";
    return;
}

$CreateTable_Sql = "CREATE TABLE IF NOT EXISTS ".$ConnVar["database"].".`user` ( `user_id` INT NOT NULL AUTO_INCREMENT ,
`firstname` VARCHAR(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
 `lastname` VARCHAR(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
  `username` VARCHAR(30) NOT NULL , `password` VARCHAR(300) NOT NULL ,
   `email` VARCHAR(150) NOT NULL , `gender` VARCHAR(10) NOT NULL ,
    `phoneNumber` VARCHAR(15) NOT NULL , `isBlock` BOOLEAN NOT NULL ,
     `role` VARCHAR(30) NOT NULL , `imageLink` VARCHAR(400) NOT NULL ,
      `date` TIMESTAMP NOT NULL , PRIMARY KEY (`user_id`)) ENGINE = InnoDB";
      
if(!mysqli_query($conn,$CreateTable_Sql)){
    echo "Table not Create";
}else{
    echo "table created";
}

?>