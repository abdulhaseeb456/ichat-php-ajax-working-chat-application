<?php
    session_start();
    include "config.php";

    if(isset($_SESSION['user_id'])) {
        $new_pass = $_POST['new_pass'];
        $cur_pass = $_POST['cur_pass'];
        if(!empty($new_pass) && !empty($cur_pass)) {
            $cur_pass = sha1($_POST['cur_pass']);
            $sql = "SELECT user_id, user_pass FROM users WHERE user_id = {$_SESSION['user_id']}";
            $result = mysqli_query($conn, $sql) or die("QuErY Failed");
            $row = mysqli_fetch_assoc($result);
            if($row['user_pass'] == $cur_pass) {
                if(strlen($new_pass) <= 8) {
                    echo "New password is too short";
                } else if(strlen($new_pass) > 16) {
                    echo "New password is very long";
                } else {
                    $pass = sha1($_POST['new_pass']);
                    echo "1,$pass";
                }
            } else {
                echo "Current password is incorect";
            }
        } else {
            echo "Type you passwords plz!";
        }
    }
?>