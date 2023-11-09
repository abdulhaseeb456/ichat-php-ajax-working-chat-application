<?php
    session_start();
    include "config.php";
    if(isset($_SESSION['user_id'])) {
        $me = $_SESSION['user_id'];
        $sql = "UPDATE messages SET msg_status = 'received' WHERE receiver = {$me} AND msg_status = 'not-seen'";
        if(mysqli_query($conn, $sql)) {
            echo 1;
        } else {
            echo "Q:FAILED";
        }
    } else {
        echo "ERR:OCCURED";
    }
?>