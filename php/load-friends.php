<?php

    include "config.php";
    session_start();

    $_sql = "SELECT * FROM messages";
    $_result = mysqli_query($conn, $_sql);

    $my_friends = [];
    while($_row = mysqli_fetch_assoc($_result)) {
        if($_row['sender'] == $_SESSION['user_id']) {
            array_push($my_friends, $_row['receiver']);
        } else if($_row['receiver'] == $_SESSION['user_id']) {
            array_push($my_friends, $_row['sender']);
        }
    }
    $my_friends = array_keys(array_count_values($my_friends));
    $my_friends = implode(",", $my_friends);

    if (empty($my_friends)) {
        $my_friends = 0;
    }

    $sql = "SELECT * FROM users WHERE user_id IN($my_friends) AND user_id != {$_SESSION['user_id']}"; 

    $output = "";
    if(mysqli_query($conn, $sql)) {
        $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                $img = "";
                
                // Loading last message
                $sql2 = mysqli_query($conn, "SELECT * FROM messages WHERE sender = {$_SESSION['user_id']} AND receiver = {$row['user_id']} AND deletedBy_receiver = 'false' AND deletedBy_sender = 'false' OR sender = {$row['user_id']} AND receiver = {$_SESSION['user_id']} ORDER BY msg_id DESC");
                if(mysqli_num_rows($sql2)) {
                    $row2 = mysqli_fetch_assoc($sql2);
                    // $row2['message'] = convert_uudecode($row2['message']);
                    if($row2['msg_status'] == "not-seen") {
                        $img = "<img class='tick' src='assets/images/check-single.png'>";
                    } else if ($row2['msg_status'] == "received") {
                        $img = "<img class='tick' src='assets/images/check-double.png'>";
                    } else if($row2['msg_status'] == "seen") {
                        $img = "<img class='tick dark' src='assets/images/check-double-dark.png'>";
                    }
                    if($row2['type'] == "text") {
                        if(strlen($row2['message']) > 27) {
                            $row2['message'] = substr($row2['message'], 0, 27) . "...";
                        }
                    } else {
                        $row2['message'] = "<i class='fa fa-image'></i> Photo";
                    }
                } else {
                    $row2['message'] = "Hey there I am using iChat";
                }
    
                // Loading new not seen messages numbers
                $sql3 = "SELECT * FROM messages WHERE receiver = {$_SESSION['user_id']} AND sender = {$row['user_id']} AND msg_status != 'seen'";
                $result3 = mysqli_query($conn, $sql3);
                $count = "";
                if(mysqli_num_rows($result3) == 0) {
                    $count = "<div class='new-msg' style='display: none;'></div>";
                    $last_msg = "<div class='last-msg'>{$row2['message']} {$img}</div>";
                } else {
                    if($row2['sender'] == $row['user_id']) {
                        $a = mysqli_num_rows($result3);
                        $count = "<div class='new-msg'>{$a}</div>";
                        if($row2['msg_status'] == "seen") {
                            $last_msg = "<div class='last-msg'>{$row2['message']} {$img}</div>";
                        } else {
                            $last_msg = "<div class='last-msg' style='font-weight: 600;'>{$row2['message']}</div>";
                        }
                    } else {
                        $last_msg = "<div class='last-msg'>{$row2['message']} {$img}</div>";
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
            $output .= "<h3 class='no-user-to-show-text'>NO FRIEND TO SHOW!</h3>";
        }
    }  else {
        $output .= "<h3 class='no-user-to-show-text'>NO FRIEND TO SHOW!</h3>";
    }
    echo $output;
?>