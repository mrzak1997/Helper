<?php
    class InsertDefaultDatas{
        public function main(){
            $this->InsertDefaultUser();
            $this->InsertDefaultResponseMessage();
            $this->InsertDefaultMenuItem();
        }
        private function InsertDefaultUser(){
            $config = new config();
            $Connection = $config->Conncetion();
            $ConnVar = $GLOBALS['ConnVar'];
            $conn = mysqli_connect($ConnVar["servername"], $ConnVar["username"], $ConnVar["password"],$ConnVar["database"]);

            
            date_default_timezone_set("Asia/Tehran");

            $insert_Sql = "INSERT INTO user (username,password,email,phoneNumber,isActive,role) 
                            VALUES('admin','".md5("redstaradmin".date('Y-m-d h:i:sa'))."','admin@gmail.com','09000000',1,'admin')";
            $log_Sql =  "INSERT INTO loginlog (username,status,status_number,ip,isActive) 
            VALUES('admin','successful','200','',1)";
            
            mysqli_query($conn,$insert_Sql);
            mysqli_query($conn,$log_Sql);

            mysqli_close($conn);
        }
        private function InsertDefaultMenuItem(){
            $config = new config();
            $Connection = $config->Conncetion();
            $ConnVar = $GLOBALS['ConnVar'];
            
            $menu_items = [
                1=>[
                    "parent_name" => ""
                    ,"name" => "فلوچارت"
                    ,"icon" => "table_chart"
                    ,"page_link" => ""
                ],
                2=>[
                    "parent_name" => "فلوچارت"
                    ,"name" => "ایجاد"
                    ,"icon" => "note_add"
                    ,"page_link" => "create-flowchart"
                ],
                3=>[
                    "parent_name" => "فلوچارت"
                    ,"name" => "ویرایش و حذف"
                    ,"icon" => "edit_attributes"
                    ,"page_link" => "edit-flowchart"
                ],
                4=>[
                    "parent_name" => "فلوچارت",
                    "name" => "نمایش",
                    "icon" => "list"
                    ,"page_link" => "show-flowchart"
                ]
            ];

            foreach($menu_items as $items_key => $item){
                $this->RunSql("INSERT INTO menu_items (parent_name,name,icon,page_link) 
                        VALUES('".$item["parent_name"]."','".$item["name"]."','".$item["icon"]."','".$item["page_link"]."')");
           
            }
        }
        private function InsertDefaultResponseMessage(){
            $DefaultDatas=[
                "login"=>[
                    1=>[
                        "loc_name" => "global",
                        "message_status" => "error",
                        "message_number" => 400,
                        "message" => "اطلاعات را کامل وارد کنید"
                    ],
                    2=>[
                        "loc_name" => "login",
                        "message_status" => "error",
                        "message_number" => 404,
                        "message" => "کاربر مورد نظر یافت نشد"
                    ],
                    3=>[
                        "loc_name" => "login",
                        "message_status" => "error",
                        "message_number" => 405,
                        "message" => "اکانت شما غیرفعال شده است"
                    ],
                    4=>[
                        "loc_name" => "login",
                        "message_status" => "error",
                        "message_number" => 450,
                        "message" => "کلمه عبور شما اشتباه می باشد"
                    ],
                    5=>[
                        "loc_name" => "login",
                        "message_status" => "successful",
                        "message_number" => 200,
                        "message" => "ورود شما با موفقیت انجام شد"
                    ],
                    6=>[
                        "loc_name" => "register",
                        "message_status" => "successful",
                        "message_number" => 201,
                        "message" => "ثبت نام شما با موفقیت انجام شد"
                    ],
                    7=>[
                        "loc_name" => "register",
                        "message_status" => "error",
                        "message_number" => 750,
                        "message" => "کاربر با این نام وجود دارد"
                    ],
                    8=>[
                        "loc_name" => "register",
                        "message_status" => "error",
                        "message_number" => 751,
                        "message" => " شماره همراه موجود است"
                    ],
                    9=>[
                        "loc_name" => "register",
                        "message_status" => "error",
                        "message_number" => 752,
                        "message" => " ایمیل موجود است"
                    ]
                ]
            ];

            foreach($DefaultDatas as $loc_name){
                foreach($loc_name as $item){
                        $this->RunSql("INSERT INTO response_message (message_status,message_loc,message_number,message) 
                                VALUES('".$item["message_status"]."','".$item["loc_name"]."','".$item["message_number"]."','".$item["message"]."')");
                   
                }
            }
        }
        private function RunSql($sql){
            $config = new config();
            $Connection = $config->Conncetion();
            $ConnVar = $GLOBALS['ConnVar'];
            $conn = mysqli_connect($ConnVar["servername"], $ConnVar["username"], $ConnVar["password"],$ConnVar["database"]);


            mysqli_query($conn,$sql);
            
            mysqli_close($conn);
        }
    }

?>