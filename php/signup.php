<?php
    include "config.php";

    session_start();
    $fname = mysqli_real_escape_string($conn, $_REQUEST['fname']);
    $lname = mysqli_real_escape_string($conn, $_REQUEST['lname']);
    $user_full_name = $fname . " " . $lname;
    $email = mysqli_real_escape_string($conn, $_REQUEST['email']);
    $password = mysqli_real_escape_string($conn, $_REQUEST['password']);

    

    if(!empty($fname) && !empty($lname) && !empty($email) && !empty($password)) {
        
        if(filter_var($email, FILTER_VALIDATE_EMAIL)){
            $emails = mysqli_query($conn, "SELECT * FROM users");
            if(mysqli_num_rows($emails) > 0) {
                $e_result = mysqli_fetch_assoc($emails);
                if($e_result['user_email'] != $email) {
                    if(strlen($password) >= 8) {
                        if(strlen($password) <= 16) {
                            if(isset($_FILES['uploadedImg'])){
                                $img_name = $_FILES['uploadedImg']['name'];
                                $img_type = $_FILES['uploadedImg']['type'];
                                $tmp_name = $_FILES['uploadedImg']['tmp_name'];
                                
                                $img_explode = explode('.',$img_name);
                                $img_ext = end($img_explode);
                
                                $extensions = ["jpeg", "png", "jpg"];
                                if($img_name == "") {
                                    echo "Please Choose an Image";
                                } else {
                                    if(in_array($img_ext, $extensions) === true){
                                        $types = ["image/jpeg", "image/jpg", "image/png"];
                                        if(in_array($img_type, $types) === true){
                                            $time = time();
                                            $new_img_name = $time."-".md5($img_name).".".$img_ext;
                                            if(move_uploaded_file($tmp_name,"../uploaded-images/". $new_img_name)){
                                                $status = "Online";
                                                $password = mysqli_real_escape_string($conn, sha1($_REQUEST['password']));
                                                date_default_timezone_set("Asia/Karachi");
                                                $join_date = date("F j,Y");
                                                $insert_query = mysqli_query($conn, "INSERT INTO users (user_name, user_email, user_pass, user_img, join_date, user_status)
                                                VALUES ('{$user_full_name}', '{$email}', '{$password}', '{$new_img_name}', '{$join_date}','{$status}')") or die("Insert Query FAILED");
                                                if($insert_query){  
                                                    $select_sql2 = mysqli_query($conn, "SELECT * FROM users WHERE user_email = '{$email}'");
                                                    if(mysqli_num_rows($select_sql2) > 0){
                                                        $row = mysqli_fetch_assoc($select_sql2);
                                                        $_SESSION['user_id'] = $row['user_id'];
                                                        echo 1;
                                                    }else{
                                                        echo "Session Creation Failed";
                                                    }
                                                }else{
                                                    echo "Something went wrong. Please try again!";
                                                }
                                            }
                                        } else {
                                            echo "Only PNG, JPG, JPEG formats are supported";
                                        }
                                    } else {
                                        echo "Please choose an Image file";
                                    }
                                }
                            }
                        } else {
                            echo "Password is too long!";
                        }
                    } else {
                        echo "Password is too short!";
                    }
                } else {
                    echo "Can't use this email!";
                }
            } else {
                if(strlen($password) >= 8) {
                    if(strlen($password) <= 16) {
                        if(isset($_FILES['uploadedImg'])){
                            $img_name = $_FILES['uploadedImg']['name'];
                            $img_type = $_FILES['uploadedImg']['type'];
                            $tmp_name = $_FILES['uploadedImg']['tmp_name'];
                            
                            $img_explode = explode('.',$img_name);
                            $img_ext = end($img_explode);
            
                            $extensions = ["jpeg", "png", "jpg"];
                            if($img_name == "") {
                                echo "Please Choose an Image";
                            } else {
                                if(in_array($img_ext, $extensions) === true){
                                    $types = ["image/jpeg", "image/jpg", "image/png"];
                                    if(in_array($img_type, $types) === true){
                                        $time = time();
                                        $new_img_name = $time."-".md5($img_name).".".$img_ext;
                                        if(move_uploaded_file($tmp_name,"../uploaded-images/". $new_img_name)){
                                            $status = "Online";
                                            $password = mysqli_real_escape_string($conn, sha1($_REQUEST['password']));
                                            date_default_timezone_set("Asia/Karachi");
                                            $join_date = date("F j,Y");
                                            $insert_query = mysqli_query($conn, "INSERT INTO users (user_name, user_email, user_pass, user_img, join_date, user_status)
                                            VALUES ('{$user_full_name}', '{$email}', '{$password}', '{$new_img_name}', '{$join_date}','{$status}')") or die("Insert Query FAILED");
                                            if($insert_query){  
                                                $select_sql2 = mysqli_query($conn, "SELECT * FROM users WHERE user_email = '{$email}'");
                                                if(mysqli_num_rows($select_sql2) > 0){
                                                    $row = mysqli_fetch_assoc($select_sql2);
                                                    $_SESSION['user_id'] = $row['user_id'];
                                                    echo 1;
                                                }else{
                                                    echo "Session Creation Failed";
                                                }
                                            }else{
                                                echo "Something went wrong. Please try again!";
                                            }
                                        }
                                    }else{
                                        echo "Only PNG, JPG, JPEG formats are supported";
                                    }
                                } else {
                                    echo "Please choose an Image file";
                                }
                            }
                        }
                    } else {
                        echo "Password is too long!";
                    }
                } else {
                    echo "Password is too short!";
                }
            }
        } else {
            echo "Email is not valid";
        }
    } else {
        echo "All input Fields are required!";
    }
    mysqli_close($conn);
?>