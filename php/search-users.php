<?php

    include "config.php";
    session_start();

    $search_term = $_POST['search_term'];

    $sql = "SELECT * FROM users WHERE user_name LIKE '%{$search_term}%' AND user_id != {$_SESSION['user_id']}";
    $result = mysqli_query($conn, $sql) or die("Query failed");
    $output = "";
    if(mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            
            // Loading last message
            $sql2 = mysqli_query($conn, "SELECT * FROM messages WHERE sender = {$_SESSION['user_id']} AND receiver = {$row['user_id']} AND msg_restriction = 'shown' OR sender = {$row['user_id']} AND receiver = {$_SESSION['user_id']} AND msg_restriction = 'shown' ORDER BY msg_id DESC");
            if(mysqli_num_rows($sql2)) {
                $row2 = mysqli_fetch_assoc($sql2);
                if(strlen($row2['message']) > 30) {
                    $row2['message'] = substr($row2['message'], 0, 30) . "...";
                }
            } else {
                $row2['message'] = "Hey there I am using iChat";
            }

            // Loading new not seen messages numbers
            $sql3 = "SELECT * FROM messages WHERE receiver = {$_SESSION['user_id']} AND sender = {$row['user_id']} AND msg_status = 'not-seen' AND msg_restriction = 'shown'";
            $result3 = mysqli_query($conn, $sql3);
            $count = "";
            if(mysqli_num_rows($result3) == 0) {
                $count = "<div class='new-msg' style='display: none;'></div>";
                $last_msg = "<div class='last-msg'>{$row2['message']}</div>";
            } else {
                if($row2['sender'] == $row['user_id']) {
                    $a = mysqli_num_rows($result3);
                    $count = "<div class='new-msg'>{$a}</div>";
                    if($row2['msg_status'] == "seen") {
                        $last_msg = "<div class='last-msg'>{$row2['message']}</div>";
                    } else {
                        $last_msg = "<div class='last-msg' style='font-weight: 600;'>{$row2['message']}</div>";
                    }
                } else {
                    $last_msg = "<div class='last-msg'>{$row2['message']}</div>";
                    $count = "<div class='new-msg' style='display: none;'></div>";
                }
            }
            $act = "";
            if($row['user_status'] == "Online") {
                $act = "active";
            } else {
                $act = "";
            }
            $output .= "
                    <div class='user' data-id='{$row['user_id']}'>
                        <div class='user-img {$act}'>
                            <img src='uploaded-images/{$row['user_img']}'>
                        </div>
                        <div class='user-details'>
                            <div class='user-name'>
                                <div class='name'>{$row['user_name']}</div>
                                $count
                            </div>
                            {$last_msg}
                        </div>
                    </div>";
        }
    } else {
        if(strlen($search_term) > 8) {
            $search_term = substr($search_term, 0, 8) . "...";
        }
        $output .= "<h3 class='no-user-to-show-text'>NO USER FOUND FOR {$search_term}</h3>";
    }
    echo $output;
?>