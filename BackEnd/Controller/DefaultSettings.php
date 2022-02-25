<?php
header('Content-Type: text/html; charset=utf-8');

include "../Model/DefaultSetting/CreateDefaultTables.php";
include "../Model/DefaultSetting/InsertDefaultUser.php";

try {
    
    $CheckDatabsebeCreated = new CheckDatabasebeCreated();
    $CreateDefaultTables = new CreateDefaultTables();
    $InsertDefaultUser = new InsertDefaultUser();

    $Databse_checker= $CheckDatabsebeCreated->CheckDatabasebe();
    $Table_checker = $CheckDatabsebeCreated->CheckUserTablebeCreated();

    //if Database or user table be created with this if 
    if($Databse_checker && $Table_checker){
        return false;
    }
    if($CreateDefaultTables->CreatetTable()){
        $CreatedTableFalg = true;
        $InsertDefaultUser->InsertUser();
        echo "Default Settings Created";
    } 
    
} catch (PDOException $e) {
    //echo $e;
}
//Run query show error or successfull message after Create all table

