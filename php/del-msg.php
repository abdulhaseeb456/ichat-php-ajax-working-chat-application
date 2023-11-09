<?php
    session_start();
    include "config.php";

    $sql = "SELECT * FROM messages WHERE deletedBy_sender = 'true' AND deletedBy_receiver = 'true'";
    $result = mysqli_query($conn, $sql) or die("query failed");
    if(mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            if($row['type'] == "text") {
                $_sql = "DELETE FROM messages WHERE deletedBy_sender = 'true' AND deletedBy_receiver = 'true'";
                if(mysqli_query($conn, $_sql)) {
                    echo 1;
                } else {
                    echo "ERR_OCCURED";
                }
            } else {
                unlink("../sent-images/" . $row['message']);
                $_sql = "DELETE FROM messages WHERE deletedBy_sender = 'true' AND deletedBy_receiver = 'true'";
                if(mysqli_query($conn, $_sql)) {
                    echo 1;
                } else {
                    echo "ERR_OCCURED";
                }
            }
        }
        
    } else {
        echo 1;
    }
?>