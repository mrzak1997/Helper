<?php
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Headers: *");
    
        include "..\config.php";
        include "..\Controller\DashboardUI.php";

        $DashboardUI = new DashboardUI();

        echo $DashboardUI->menu_item();
?>