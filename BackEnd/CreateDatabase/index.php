<?php

$ConnVar["servername"] = "localhost";
$ConnVar["username"] = "root";
$ConnVar["password"] = "";
$ConnVar["database"] = "traderhelper";

try {
    $conn = mysqli_connect($ConnVar["servername"], $ConnVar["username"], $ConnVar["password"]);

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
        `count` INT NOT NULL ,
        `isBlock` BOOLEAN NOT NULL ,
        `date` TIMESTAMP NOT NULL , 
        PRIMARY KEY (`id`)) ENGINE = InnoDB";

    $CreateRolePermitionTable = "CREATE TABLE IF NOT EXISTS " . $ConnVar["database"] . ".`rolePermition` (
        `id` INT NOT NULL AUTO_INCREMENT ,
        `role` VARCHAR(30) NOT NULL,
        `api_name` VARCHAR(30) NOT NULL,
        PRIMARY KEY (`id`)) ENGINE = InnoDB";


    if (!run_query($conn, $Create_Database, "Database not create", null) ||
        !run_query($conn, $CreateUserTable, null, null) ||
        !run_query($conn, $CreateLoginlogTable,null, null)||
        !run_query($conn, $CreateRolePermitionTable, "Table not Create", "table created")) {
        return;
    }
} catch (PDOException $e) {
    echo $e;
}
//Run query show error or successfull message after Create all table
function run_query($conn, $sql, $error_message, $successfull_message)
{
    if (mysqli_query($conn, $sql)) {
        echo $successfull_message;
        return true;
    }
    echo $error_message;
    return false;
}
