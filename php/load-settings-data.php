<?php
    session_start();
    include "config.php";

    if(isset($_SESSION['user_id'])) {
        $sql = "SELECT * FROM users WHERE user_id = {$_SESSION['user_id']}";
        $row = mysqli_fetch_assoc(mysqli_query($conn, $sql));
        echo "1,{$row['user_name']},{$row['user_email']},{$row['user_pass']},{$row['user_img']}";
    } else {
        echo "404 Not Found!";
    }
?>