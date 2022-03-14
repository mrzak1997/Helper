<?php
    class GetMenuItems{
        public function getItems(){
            $config = new config();
    
            $Connection = $config->Conncetion();
            $ConnVar = $GLOBALS['ConnVar'];
            $conn = mysqli_connect($ConnVar["servername"], $ConnVar["username"], $ConnVar["password"],$ConnVar["database"]);

            $items_sql = "SELECT * FROM menu_items";
            
            
            
            $result = mysqli_query($conn, $items_sql);

            $database_data=[];
            $all_data=[];
            if (mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)){
                    array_push($database_data,$row);
                    if($row["parent_name"]==""){
                        $new_arr["name"] = $row["name"];
                        $new_arr["icon"] = $row["icon"];
                        $new_arr["sub_items"] = [];
                        $new_arr["parent_name"] = $row["parent_name"];
                        
                        $maked_array = $this->makeItemResponse($new_arr);
        
                        array_push($all_data,$maked_array);
                        
                    }
                }
                //assigne subitem to parent
                foreach($database_data as $key => $db_data){
                    if($db_data["parent_name"]!=""){
                        for($i=0;$i < sizeof($all_data);$i++){
                            if($db_data["parent_name"] == $all_data[$i]['name']){

                                $new_arr["name"] = $db_data["name"];
                                $new_arr["icon"] = $db_data["icon"];
                                $new_arr["sub_items"] = "";
                                $new_arr["parent_name"] = $db_data["parent_name"];
                        
                                $maked_array = $this->makeItemResponse($new_arr);
        
                                array_push($all_data[$i]["sub_items"],$maked_array);
                            }
                        }
                    }
                }
                
                return json_encode($all_data,JSON_UNESCAPED_UNICODE);
            }
            mysqli_close($conn);

        }
        private function makeItemResponse($items){
            $arr=[
                "name" => $items['name'],
                "icon" => $items['icon'],
                "parent_name"=> $items['parent_name'],
                "sub_items" => $items['sub_items']
            ];
            return $arr;
        }
    }


?>