<?php
class config
{
    public function Conncetion()
    {
        global $ConnVar;
        global $conn;
        $ConnVar["servername"] = "localhost";
        $ConnVar["username"] = "root";
        $ConnVar["password"] = "";
        $ConnVar["database"] = "traderhelper";

        try {
            $conn = mysqli_connect($ConnVar["servername"], $ConnVar["username"], $ConnVar["password"]);
        } catch (Exception $e) {
            exit("Error: " . $e->getMessage());
        }
    }
}

?>