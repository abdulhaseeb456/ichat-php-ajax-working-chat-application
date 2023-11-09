<?php
    session_start();
    include 'config.php';

    if(isset($_SESSION['user_id'])) {
        $receiver = $_POST['receiver'];
        $sender = $_SESSION['user_id'];
        
        $sql = "SELECT * FROM messages WHERE sender = {$sender} AND receiver = {$receiver} AND deletedBy_sender = 'false' OR sender = {$receiver} AND receiver = {$sender} AND deletedBy_receiver = 'false'";
        $result = mysqli_query($conn, $sql) or die(0);
        $output = "";

        if(mysqli_num_rows($result) > 0) {
            function convertURLs($string) {
                $url = '/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/';   
                return preg_replace($url, '<a href="$0" target="_blank" title="$0">$0</a>', $string);

            }
            while($row = mysqli_fetch_assoc($result)) {
                // $row['message'] = convert_uudecode($row['message']);
                $myString = $row['message'];
                $row['message'] = convertURLs($myString);
                if($row['sender'] == $sender) {
                    if($row['type'] == "text") {
                        if($row['msg_status'] == "not-seen") {
                            $output .= "
                            <div class='outgoing-chat'>
                            <div class='chat' data-msg-id='{$row['msg_id']}' data-type='out' data-status='{$row['msg_status']}'>{$row['message']}
                            <div class='chat-time'>{$row['msg_time']} <img src='assets/images/check-single.png' class='tick'></div>
                            </div>
                        </div>";
                        } else if($row['msg_status'] == "seen") {
                            $output .= "
                            <div class='outgoing-chat'>
                            <div class='chat' data-msg-id='{$row['msg_id']}' data-type='out' data-status='{$row['msg_status']}'>{$row['message']}
                            <div class='chat-time'>{$row['msg_time']} <img src='assets/images/check-double-dark.png' class='tick'></div>
                            </div>
                        </div>";
                        } else if($row['msg_status'] == "received") {
                            $output .= "
                            <div class='outgoing-chat'>
                            <div class='chat' data-msg-id='{$row['msg_id']}' data-type='out' data-status='{$row['msg_status']}'>{$row['message']}
                            <div class='chat-time'>{$row['msg_time']} <img src='assets/images/check-double.png' class='tick'></div>
                            </div>
                        </div>";
                        }
                    } else {
                        if($row['msg_status'] == "not-seen") {
                            $output .= "<div class='outgoing-img'>
                            <div class='chat' data-msg-id='{$row['msg_id']}' data-type='out' data-status='{$row['msg_status']}'>
                                <img src='sent-images/{$row['message']}'>
                                <div class='chat-time'>{$row['msg_time']} <img class='tick' src='assets/images/check-single.png'></div>
                            </div>
                        </div>";
                        } else if($row['msg_status'] == "seen") {
                            $output .= "<div class='outgoing-img'>
                            <div class='chat' data-msg-id='{$row['msg_id']}' data-type='out' data-status='{$row['msg_status']}'>
                                <img src='sent-images/{$row['message']}'>
                                <div class='chat-time'>{$row['msg_time']} <img class='tick' src='assets/images/check-double-dark.png'></div>
                            </div>
                        </div>";
                        } else if($row['msg_status'] == "received") {
                            $output .= "<div class='outgoing-img'>
                            <div class='chat' data-msg-id='{$row['msg_id']}' data-type='out' data-status='{$row['msg_status']}'>
                                <img src='sent-images/{$row['message']}'>
                                <div class='chat-time'>{$row['msg_time']} <img class='tick' src='assets/images/check-double.png'></div>
                            </div>
                        </div>";
                        }
                    }
                } else {
                    if($row['type'] == "text") {
                        $output .= "<div class='incomming-chat'>
                        <div class='chat' data-msg-id='{$row['msg_id']}' data-type='incom'>{$row['message']}
                        <div class='chat-time'>{$row['msg_time']}</div>
                        </div>
                    </div>";
                    } else {
                        $output .= "<div class='incomming-img'>
                        <div class='chat' data-msg-id='{$row['msg_id']}' data-type='incom'>
                            <img src='sent-images/{$row['message']}'>
                            <div class='chat-time'>{$row['msg_time']}</div>
                        </div>
                    </div>";
                    }
                }
            }
        } else {
            $output .= "<p class='note'>Messages are end-to-end encrypted. Not even iChat can read your messages</p>";
        }
        echo $output;
    } else {
        echo 0;
    }
    mysqli_close($conn);
?>