<?php
class CheckCookie{
    public function CheckUserCookie(){
        $config = new config();
        $Connection = $config->Conncetion();
        $ConnVar = $GLOBALS['ConnVar'];
        $conn = $GLOBALS['conn_db'];

        $Security = new Security();

        if(!isset($_COOKIE["username"]) || !isset($_COOKIE["Token"])){
            return false;
        }
        $user["username"] = $_COOKIE["username"];
        $user["Token"] = $_COOKIE["Token"];

        $user = $Security->isDangerous($user);
        $sql = "SELECT * FROM user WHERE username='".$user['username']."' AND password='".$user['Token']."'";
        
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            mysqli_close($conn);
            return true;
        }
        return false;
    }
}
?>