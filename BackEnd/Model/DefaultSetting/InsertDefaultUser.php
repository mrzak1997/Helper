<?php
    class InsertDefaultUser{
        public function InsertUser(){
            $config = new config();
            $Connection = $config->Conncetion();
            $ConnVar = $GLOBALS['ConnVar'];
            $conn = $GLOBALS['conn_db'];
            
            $insert_Sql = "INSERT INTO user (username,password,email,isBlock,role) 
                            VALUES('admin','5c6816859cf688bf1cd1ecc1db631faeb1e6130097d217bf878690e1b07cdd51','admin@gmail.com',0,'admin')";
            mysqli_query($conn,$insert_Sql);
            
            mysqli_close($conn);
    }
    }

?>