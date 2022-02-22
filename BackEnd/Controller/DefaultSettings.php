<?php
header('Content-Type: text/html; charset=utf-8');

include "Model/CreateDefaultTables.php";

try {
    
    $CreateDefaultTables = new CreateDefaultTables();
    if($CreateDefaultTables->CreatetTable()){
        echo "Table Created";
    } else{
        echo "We have a Problem";
    }
    
} catch (PDOException $e) {
    echo $e;
}
//Run query show error or successfull message after Create all table

