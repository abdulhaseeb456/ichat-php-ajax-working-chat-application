<?php
    include "config.php";
    
    $msg_id = $_POST['msg_id'];
    if(isset($_POST['msg_id'])) {
        $sql = "SELECT * FROM messages WHERE msg_id = {$msg_id}";
        $result = mysqli_query($conn, $sql) or die("Query Failed");
        $row = mysqli_fetch_assoc($result);
        if(mysqli_num_rows($result) > 0) {
            if($row['type'] == "text") {
                $_sql = "DELETE FROM messages WHERE msg_id = {$msg_id} AND msg_status = 'not-seen'";
                if(mysqli_query($conn, $_sql)) {
                    echo 1;
                } else {
                    echo "ERR_OCCURED_DELETE_UNABLE";
                }
            } else {
                unlink("../sent-images/" . $row['message']);
                $_sql = "DELETE FROM messages WHERE msg_id = {$msg_id} AND msg_status = 'not-seen'";
                if(mysqli_query($conn, $_sql)) {
                    echo 1;
                } else {
                    echo "ERR_OCCURED_DELETE_UNABLE";
                }
            }
        } else {
            echo "Deleting";
        }
    } else {
        echo "ERR_OCCURED_NOT_FOUND";
    }
?>