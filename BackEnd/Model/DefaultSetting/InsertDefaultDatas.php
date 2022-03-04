<?php
    class InsertDefaultDatas{
        public function InsertDefaultUser(){
            $config = new config();
            $Connection = $config->Conncetion();
            $ConnVar = $GLOBALS['ConnVar'];
            $conn = $GLOBALS['conn_db'];
            
            date_default_timezone_set("Asia/Tehran");

            $insert_Sql = "INSERT INTO user (username,password,email,isActive,role) 
                            VALUES('admin','".md5("redstaradmin".date('Y-m-d h:i:sa'))."','admin@gmail.com',1,'admin')";
            $log_Sql =  "INSERT INTO loginlog (username,status,status_number,ip,isActive) 
            VALUES('admin','successful','200','',1)";
            
            mysqli_query($conn,$insert_Sql);
            mysqli_query($conn,$log_Sql);

            mysqli_close($conn);
        }
        public function InsertDefaultResponseMessage(){
            $DefaultDatas=[
                "login"=>[
                    1=>[
                        "loc_name" => "login",
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
                        "message" => "کلمه عبور شما درست نمی باشد"
                    ],
                    5=>[
                        "loc_name" => "login",
                        "message_status" => "successful",
                        "message_number" => 200,
                        "message" => "ورود شما با موفقیت انجام شد"
                    ]
                ]
            ];

            foreach($DefaultDatas as $loc_name){
                foreach($loc_name as $item){
                        $this->ResponseMessageSql("INSERT INTO response_message (message_status,message_loc,message_number,message) 
                                VALUES('".$item["message_status"]."','".$item["loc_name"]."','".$item["message_number"]."','".$item["message"]."')");
                   
                }
            }
        }
        private function ResponseMessageSql($sql){
            $config = new config();
            $Connection = $config->Conncetion();
            $ConnVar = $GLOBALS['ConnVar'];
            $conn = $GLOBALS['conn_db'];


            mysqli_query($conn,$sql);
            
            mysqli_close($conn);
        }
    }

?>