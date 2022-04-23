<?php
                                    require_once("../connection.php");
                                    
                                    $departid = "COM112";
                                    
                                    if(isset($_POST['CourseCode'])){
                                       $departid = mysqli_real_escape_string($con,$_POST['CourseCode']); // department id
                                    }
                                    
                                    $users_arr = array();
                                    
                                    if($departid != 0){
                                        $sql = "SELECT CourseTitle,CourseUnits FROM users WHERE CourseCode= '$departid'";
                                    
                                        $result = mysqli_query($con,$sql);
                                        
                                        while( $row = mysqli_fetch_array($result) ){
                                            $CourseName = $row['CourseTitle'];
                                            $CourseUnits = $row['CourseUnits'];
                                        
                                            $users_arr[] = array("CourseName" => $CourseName , "CourseUnits" => $CourseUnits );
                                        }
                                    }
                                    
                                    // encoding array to json format
                                    echo json_encode($users_arr); ?> 