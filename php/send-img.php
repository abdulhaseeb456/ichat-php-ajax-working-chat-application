<?php
    session_start();
    include "config.php";
    date_default_timezone_set("Asia/Karachi");

    $receiver = $_POST['receiver'];
    $sender = $_SESSION['user_id'];
    $msg_time = date("h:i A");
    $msg_status = "not-seen";
    $msg_restriction = "shown";

    if(isset($_SESSION['user_id'])) {
        if(isset($_FILES['img_upload'])) {
            if($_FILES['img_upload']["name"] != "") {
                $img_name = $_FILES['img_upload']['name'];
                $img_type = $_FILES['img_upload']['type'];
                $tmp_name = $_FILES['img_upload']['tmp_name'];
                $img_size = $_FILES['img_upload']['size'];
                
                if($img_size <= 2097152) {
                    $img_explode = explode('.',$img_name);
                    $img_ext = end($img_explode);
    
                    $extensions = ["jpeg", "png", "jpg"];
                    if(in_array($img_ext, $extensions) === true){
                        $types = ["image/jpeg", "image/jpg", "image/png"];
                        if(in_array($img_type, $types) === true){
                            $time = time();
                            $new_img_name = "IMG-" . $time . ".".$img_ext;
                            if(move_uploaded_file($tmp_name,"../sent-images/". $new_img_name)){
                                $message = $new_img_name;
                                $sql = mysqli_query($conn, "INSERT INTO messages (sender, receiver, message, msg_time, msg_status, type, deletedBy_sender, deletedBy_receiver)
                                        VALUES ({$sender}, {$receiver}, '{$message}', '{$msg_time}', '{$msg_status}', 'image', 'false', 'false')");
                                echo 1;
                            } else {
                                echo "ERR_CANNOT_SEND";
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
                echo "Please Select an Image";
            }
        } else {
            echo "Please Selectj an Image";
        }
    } else {
        echo "ERR_NOT_FOUND";
    }
?>