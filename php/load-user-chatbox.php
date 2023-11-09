<?php

    include "config.php";

    if(isset($_POST['user_id'])) {
        $user_id = $_POST['user_id'];
        $sql = "SELECT * FROM users WHERE user_id = {$user_id}";
        $result = mysqli_query($conn, $sql) or die("QUERY:ERR:OCCURED");
        if(mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);

            if($row['user_status'] == "Online") {
                $status = "Online Now!";
            } else {
                $arr = explode("^", $row['user_status']);

                $current_time = time();
                $last_seen = $arr[1];
    
                // Time difference cal is here
                $time_diff = $current_time - $last_seen;
                
                $seconds = $time_diff;
                $minutes = round($seconds / 60);
                $hours = round($seconds / 3600);
                $days = round($seconds / 84600);
                $weeks = round($seconds / 604800);
                $months = round($seconds / 2629440);
                $years = round($seconds / 31553280);
    
                if($seconds < 60) {
                    $status = "Last seen &bull; " . $seconds . " seconds ago.";
                } else if($minutes <= 60) {
                    if($minutes < 10) {
                        $status = "Last seen &bull; " . $minutes . " minutes ago.";
                    } else {
                        $status = "Last seen today at " . $arr[0];
                    }
                } else if ($hours <= 24) {
                    if($hours == 1) {
                        $status = "Last seen &bull;" . "1 hour ago.";
                    } else if($hours < 24) {
                        $status = "Last seen today at " . $arr[0];
                    } else if($hours > 24 && $hours < 48) {
                        $status = "Last seen yesterday at " . $arr[0];
                    }
                } else if($days < 7) {
                    if($days == 1) {
                        $status = "Last seen &bull; {$days} day ago.";
                    } else {
                        $status = "Last seen &bull; {$days} days ago.";
                    }
                } else if($weeks < 4.3) {
                    if($weeks == 1) {
                        $status = "Last seen &bull; {$weeks} week ago.";
                    } else {
                        $status = "Last seen &bull; {$weeks} weeks ago.";
                    }
                }
            }
            
            echo "      <div class='user-img'>
                            <img src='uploaded-images/{$row['user_img']}'>
                        </div>
                        <div class='user-details'>
                            <div class='username'>{$row['user_name']}</div>
                            <div class='user-status'>{$status}</div>
                        </div>";
        } else { //Last seen {$text} at {$arr[0]} &bull; {$status}
            echo "AN ERROR OCCURED";
        }
    } else {
        echo "AN ERROR OCCURED";
    }
?>