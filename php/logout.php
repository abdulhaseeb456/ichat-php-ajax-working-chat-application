<?php
    session_start();
    include "config.php";
    date_default_timezone_set("Asia/Karachi");
    $last_seen = date("h:i A");
    $time = time();

    $sql = "UPDATE users SET user_status = '{$last_seen}^{$time}' WHERE user_id = {$_SESSION['user_id']}";
    if(mysqli_query($conn, $sql)) {
        if(session_unset()) {
            session_destroy();
            echo 1;
        }
        else {
            echo 0;
        }
    } else {
        echo "Query Failed";
    }
?>