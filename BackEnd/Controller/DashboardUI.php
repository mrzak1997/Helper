<?php
    include "../Model/DashboardUI/GetMenuItems.php";
    class DashboardUI{
        public function menu_item(){
            $GetMenuItems = new GetMenuItems();
            return $GetMenuItems->getItems();
        }
    }
?>