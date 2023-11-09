<?php
    include "config.php";

    if(isset($_POST['msg_id'])) {
        if(isset($_POST['receiver'])) {
            $sql = "UPDATE messages SET deletedBy_receiver = 'true' WHERE msg_id = {$_POST['msg_id']}";
            if(mysqli_query($conn, $sql)) {
                echo 1;
            } else {
                echo "ERR:OCCURED";
            }
        } else {
            $sql = "UPDATE messages SET deletedBy_sender = 'true' WHERE msg_id = {$_POST['msg_id']}";
            if(mysqli_query($conn, $sql)) {
                echo 1;
            } else {
                echo "ERR:OCCURED";
            }
        }
    } else {
        echo "ERR:OCCURED";
    }
?>