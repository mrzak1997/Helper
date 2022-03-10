<?php
    class GetMenuItems{
        public function getItems(){
            $config = new config();
    
            $Connection = $config->Conncetion();
            $ConnVar = $GLOBALS['ConnVar'];
            $conn = $GLOBALS['conn_db'];

            $items_sql = "SELECT * FROM menu_items";
            
            
            
            $result = mysqli_query($conn, $items_sql);

            $database_data=[];
            $all_data=[];
            if (mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)){
                    array_push($database_data,$row);
                    //var_dump($database_data);
                    if($row["parent_name"]==""){
                        //var_dump($row);
                        $new_arr["name"] = $row["name"];
                        $new_arr["icon"] = $row["icon"];
                        $new_arr["sub_items"] = [];
                        $new_arr["parent_name"] = $row["parent_name"];
                        
                        $maked_array = $this->makeItemResponse($new_arr);
        
                        array_push($all_data,$maked_array);
                        
                    }
                }
                //$database_data = $database_data[0][0];
                //var_dump($database_data);
                //var_dump($all_data);

                foreach($database_data as $key => $db_data){
                    if($db_data["parent_name"]!=""){
                        //var_dump($db_data);
                        for($i=0;$i < sizeof($all_data);$i++){
                            if($db_data["parent_name"] == $all_data[$i]['name']){
                                // echo "\n1.db =".$db_data["parent_name"];
                                // echo "\n2.data =".$all_data[$i]['name'];   
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
                
                //var_dump($all_data);
                return json_encode($all_data[0],JSON_UNESCAPED_UNICODE);
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