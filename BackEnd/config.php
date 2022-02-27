<?php
include "../Model/DefaultSetting/CheckDatabasebeCreated.php";
class config
{
    public function Conncetion()
    {
        global $ConnVar;
        global $conn;
        global $conn_db;

        $ConnVar["servername"] = "localhost";
        $ConnVar["username"] = "root";
        $ConnVar["password"] = "";
        $ConnVar["database"] = "traderhelper";

        $CheckDatabaseCreated = new CheckDatabasebeCreated();
        try {
            $conn = mysqli_connect($ConnVar["servername"], $ConnVar["username"], $ConnVar["password"]);
            
            $conn_db = mysqli_connect($ConnVar["servername"], $ConnVar["username"], $ConnVar["password"],$ConnVar["database"]);
            
        } catch (Exception $e) {
            exit("Error: " . $e->getMessage());
        }
    }
}

?>