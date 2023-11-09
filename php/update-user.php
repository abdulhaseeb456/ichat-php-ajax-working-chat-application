<?php
    session_start();
    include "config.php";

    if(isset($_SESSION['user_id'])) {
        $user = $_SESSION['user_id'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['changed_pass'];
        $cur_img = $_POST['cur_img'];

        if(!empty($name) && !empty($email) && !empty($password)) {
            if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $sql = "SELECT * FROM users WHERE user_id != {$_SESSION['user_id']}";
                $result = mysqli_query($conn, $sql) or die("QUERY_FAILED");
                if(mysqli_num_rows($result) > 0) {
                    while($row = mysqli_fetch_assoc($result)) {
                        if($row['user_email'] == $email) {
                            $out = "This email is in use";
                            break;
                        } else {
                            $out = false;
                        }
                    }
                } else {
                    $out = false;
                }
                if($out == false) {
                    if($_FILES['new_img_input']["name"] != "") {
                        $img_name = $_FILES['new_img_input']['name'];
                        $img_type = $_FILES['new_img_input']['type'];
                        $tmp_name = $_FILES['new_img_input']['tmp_name'];
                        $img_size = $_FILES['new_img_input']['size'];
                        
                        if($img_size <= 2097152) {
                            $img_explode = explode('.',$img_name);
                            $img_ext = end($img_explode);
            
                            $extensions = ["jpeg", "png", "jpg"];
                            if(in_array($img_ext, $extensions) === true){
                                $types = ["image/jpeg", "image/jpg", "image/png"];
                                if(in_array($img_type, $types) === true){
                                    $time = time();
                                    $new_img_name = "ICHAT-IMG-" . $time . ".".$img_ext;
                                    if(move_uploaded_file($tmp_name,"../uploaded-images/". $new_img_name)){
                                        unlink("../uploaded-images/" . $cur_img);
                                        $__sql = "UPDATE users SET user_name = '{$name}', user_email = '{$email}', user_pass = '{$password}', user_img = '{$new_img_name}' WHERE user_id = {$user}";
                                        if(mysqli_query($conn, $__sql)) {
                                            echo 1;
                                        } else {
                                            echo "Can't save changes";
                                        }
                                    }
                                } else {
                                    echo "Only PNG, JPG, JPEG formats are supported";
                                }
                            } else {
                                echo "Please choose an Image file";
                            }
                        } else {
                            echo "Image must be less than 2MB";
                        }
                    } else {
                        $_sql = "UPDATE users SET user_name = '{$name}', user_email = '{$email}', user_pass = '{$password}' WHERE user_id = {$user}";
                        if(mysqli_query($conn, $_sql)) {
                            echo 1;
                        } else {
                            echo "Can't save changes";
                        }
                    }
                } else {
                    echo $out;
                }
            } else {
                echo "Email is invalid";
            }
        } else {
            echo "All inputs are required";
        }
    } else {
        echo "ERR_OCCURED";
    }
?>