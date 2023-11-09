<?php
    session_start();
    include "config.php";

    if(isset($_POST['sender'])) {
        $sender = $_POST['sender'];
        $receiver = $_SESSION['user_id'];
    
        $sql = "UPDATE messages SET msg_status = 'seen' WHERE sender = {$sender} AND receiver = {$receiver}";
        $result = mysqli_query($conn, $sql) or die("Query falied");
        echo 1;
    } else {
        echo "ERROR UCCURED";
    }
?>