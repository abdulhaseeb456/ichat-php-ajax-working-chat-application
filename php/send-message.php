<?php
    session_start();
    include "config.php";
    date_default_timezone_set("Asia/Karachi");

    $receiver = $_POST['receiver'];
    $sender = $_SESSION['user_id'];
    $message = trim($_POST['message']);
    $msg_time = date("h:i A");
    $msg_status = "not-seen";
    $msg_restriction = "shown";

    if(!empty($message)){
        // $message = convert_uuencode($_POST['message']);
        $sql = mysqli_query($conn, "INSERT INTO messages (sender, receiver, message, msg_time, msg_status, type, deletedBy_sender, deletedBy_receiver)
                VALUES ({$sender}, {$receiver}, '{$message}', '{$msg_time}', '{$msg_status}', 'text', 'false', 'false')");
        echo 1;
    } else {
        echo "Please type something!";
    }
?>