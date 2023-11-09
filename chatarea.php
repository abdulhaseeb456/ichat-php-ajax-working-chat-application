<?php
    session_start();
    if(!isset($_SESSION['user_id'])) {
        header("location: http://localhost/ichat/index.php");
    } 
    else if (isset($_SESSION['user_id'])) {
        include 'PHP/config.php';
        $insert_Status = "UPDATE users SET user_status = 'Online' WHERE user_id = '{$_SESSION['user_id']}'";
        $res = mysqli_query($conn, $insert_Status) or die("Q failed");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="./assets/css/style.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <!-- Ion Icons -->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>


    <title>Chat with You Friends | iChat</title>
</head>
<body class="chatarea">
    <div class="page-loader">
        <i class="fas fa-users"></i>
    </div>
    <div class="wrapper">
        <div class="delete-popup">
            <ul>
                <li class="delete-for-everyone">Delete Everyone</li>
                <li class="delete-for-me">Delete For Me</li>
                <li class="cancel">Cancel</li>
            </ul>
        </div>
        <div class="profile-pop">
            <div class="profile-container">
                <div class="profile-img-cont">
                    <?php
                        $sql = "SELECT user_name, user_img FROM users WHERE user_id = {$_SESSION['user_id']}";
                        $row = mysqli_fetch_assoc(mysqli_query($conn, $sql));
                    ?>
                    <img src="uploaded-images/<?php echo $row['user_img']; ?>">
                </div>
                <div class="profile-det">
                    <div class="name"><?php echo $row['user_name']; ?></div>
                    <div class="prof-actions">
                        <a href="settings.php">
                            <i class="fa fa-pen prof-edit-btn" title="Edit Your Profile"></i>
                        </a>
                        <i class="fa fa-times prof-cancel-btn" title="Cancel"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="send-img-pop">
            <form class="send-img-container" id="send_img">
                <label for="send_img_input">
                    <i class="fa fa-cloud-upload-alt"></i>
                    <img src="">
                </label>
                <div class="error-text"></div>
                <div class="send-img-actions">
                    <i class="fa fa-times send-img-cancel-btn" title="Cancel"></i>
                    <button id="send_img_btn" type="submit">Send</button>
                </div>
                <input type="text" name="receiver" hidden class="user_id_holder">
                <input type="file" accep="image/*" name="img_upload" id="send_img_input" hidden>
            </form>
        </div>
        <div class="left-cont">
            <div class="left-cont-inner-left">
                <ul class="links">
                    <li title="View Profile" class="view-profile">
                        <img src="uploaded-images/<?php echo $row['user_img']; ?>">
                    </li>
                    <li title="Search users" class="search-btn">
                        <ion-icon name="search"></ion-icon>
                    </li>
                    <li title="View Notifications" class="notifications">
                        <div class="new-notifications-count">3</div>
                        <ion-icon name="notifications-outline"></ion-icon>
                    </li>
                    <a href="settings.php">
                    <li title="Open Settings">
                        <ion-icon name="settings-outline"></ion-icon>
                    </li>
                    </a>
                    <li title="Log Out" class="log-out">
                        <ion-icon name="log-out-outline"></ion-icon>
                    </li>
                </ul>
            </div>
            <!-- Users container is here -->
            <div class="users-cont friends">
                <div class="user-cont-header">
                    <h2>iChat</h2>
                    <div class="search-btn">
                        <ion-icon name="search-outline"></ion-icon>
                    </div>
                </div>
                <!-- Users list is here -->
                <div class="users-list">
                    <div class="user dummy">
                        <div class="user-img">
                            <img src="" alt="">
                            <div class="online-dot"></div>
                        </div>
                        <div class="user-details">
                            <div class="user-name">
                                <div class="name dummy"></div>
                                <div class="new-msg dummy"></div>
                            </div>
                            <div class="last-msg dummy"></div>
                        </div>
                    </div>
                    <div class="user dummy">
                        <div class="user-img">
                            <img src="" alt="">
                            <div class="online-dot"></div>
                        </div>
                        <div class="user-details">
                            <div class="user-name">
                                <div class="name dummy"></div>
                                <div class="new-msg dummy"></div>
                            </div>
                            <div class="last-msg dummy"></div>
                        </div>
                    </div>
                    <div class="user dummy">
                        <div class="user-img">
                            <img src="" alt="">
                            <div class="online-dot"></div>
                        </div>
                        <div class="user-details">
                            <div class="user-name">
                                <div class="name dummy"></div>
                                <div class="new-msg dummy"></div>
                            </div>
                            <div class="last-msg dummy"></div>
                        </div>
                    </div>
                    <div class="user dummy">
                        <div class="user-img">
                            <img src="" alt="">
                            <div class="online-dot"></div>
                        </div>
                        <div class="user-details">
                            <div class="user-name">
                                <div class="name dummy"></div>
                                <div class="new-msg dummy"></div>
                            </div>
                            <div class="last-msg dummy"></div>
                        </div>
                    </div>
                    <div class="user dummy">
                        <div class="user-img">
                            <img src="" alt="">
                            <div class="online-dot"></div>
                        </div>
                        <div class="user-details">
                            <div class="user-name">
                                <div class="name dummy"></div>
                                <div class="new-msg dummy"></div>
                            </div>
                            <div class="last-msg dummy"></div>
                        </div>
                    </div>
                    <div class="user dummy">
                        <div class="user-img">
                            <img src="" alt="">
                            <div class="online-dot"></div>
                        </div>
                        <div class="user-details">
                            <div class="user-name">
                                <div class="name dummy"></div>
                                <div class="new-msg dummy"></div>
                            </div>
                            <div class="last-msg dummy"></div>
                        </div>
                    </div>
                    <div class="user dummy">
                        <div class="user-img">
                            <img src="" alt="">
                            <div class="online-dot"></div>
                        </div>
                        <div class="user-details">
                            <div class="user-name">
                                <div class="name dummy"></div>
                                <div class="new-msg dummy"></div>
                            </div>
                            <div class="last-msg dummy"></div>
                        </div>
                    </div>
                </div>
                <!-- Users list ends here -->
            </div>
            <!-- Users container ends here -->
            <!-- --------------------------------------------- -->
            <!-- Users container searched is here -->
            <div class="users-cont searched">
                <div class="user-cont-header">
                    <input type="search" class="search-user" placeholder="Search your Friends..">
                </div>
                <!-- Users list is here -->
                <div class="users-list">
                    <div class="user dummy">
                        <div class="user-img">
                            <img src="" alt="">
                            <div class="online-dot"></div>
                        </div>
                        <div class="user-details">
                            <div class="user-name">
                                <div class="name dummy"></div>
                                <div class="new-msg dummy"></div>
                            </div>
                            <div class="last-msg dummy"></div>
                        </div>
                    </div>
                    <div class="user dummy">
                        <div class="user-img">
                            <img src="" alt="">
                            <div class="online-dot"></div>
                        </div>
                        <div class="user-details">
                            <div class="user-name">
                                <div class="name dummy"></div>
                                <div class="new-msg dummy"></div>
                            </div>
                            <div class="last-msg dummy"></div>
                        </div>
                    </div>
                    <div class="user dummy">
                        <div class="user-img">
                            <img src="" alt="">
                            <div class="online-dot"></div>
                        </div>
                        <div class="user-details">
                            <div class="user-name">
                                <div class="name dummy"></div>
                                <div class="new-msg dummy"></div>
                            </div>
                            <div class="last-msg dummy"></div>
                        </div>
                    </div>
                    <div class="user dummy">
                        <div class="user-img">
                            <img src="" alt="">
                            <div class="online-dot"></div>
                        </div>
                        <div class="user-details">
                            <div class="user-name">
                                <div class="name dummy"></div>
                                <div class="new-msg dummy"></div>
                            </div>
                            <div class="last-msg dummy"></div>
                        </div>
                    </div>
                    <div class="user dummy">
                        <div class="user-img">
                            <img src="" alt="">
                            <div class="online-dot"></div>
                        </div>
                        <div class="user-details">
                            <div class="user-name">
                                <div class="name dummy"></div>
                                <div class="new-msg dummy"></div>
                            </div>
                            <div class="last-msg dummy"></div>
                        </div>
                    </div>
                    <div class="user dummy">
                        <div class="user-img">
                            <img src="" alt="">
                            <div class="online-dot"></div>
                        </div>
                        <div class="user-details">
                            <div class="user-name">
                                <div class="name dummy"></div>
                                <div class="new-msg dummy"></div>
                            </div>
                            <div class="last-msg dummy"></div>
                        </div>
                    </div>
                    <div class="user dummy">
                        <div class="user-img">
                            <img src="" alt="">
                            <div class="online-dot"></div>
                        </div>
                        <div class="user-details">
                            <div class="user-name">
                                <div class="name dummy"></div>
                                <div class="new-msg dummy"></div>
                            </div>
                            <div class="last-msg dummy"></div>
                        </div>
                    </div>
                </div>
                <!-- Users list ends here -->
            </div>
            <!-- Users container searched ends here -->
        </div>
        <div class="right-cont">
            <div class="nothing">
                <h1>Welcome to iChat! <br><p>Continue chatting with your friends</p></h1>
            </div>
            <div class="right-cont-header">
                <div class="right-cont-user">
                    <div class="user-img">
                        <img src="">
                    </div>
                    <div class="user-details">
                        <div class="username dummy"></div>
                        <div class="user-status dummy"></div>
                    </div>
                </div>
            </div>
            <div class="messages">
                <div class="incomming-img">
                    <div class="chat">
                        <img src="images/team-03.jpg">
                        <div class="chat-time">12:31 PM</div>
                    </div>
                </div>
                <div class="outgoing-img">
                    <div class="chat">
                        <img src="images/team-03.jpg">
                        <div class="chat-time">12:31 PM <img class="tick" src="images/check-single.png"></div>
                    </div>
                </div>
            </div>
            <form class="right-cont-footer">
                <div class="type">Please type something else</div>
                <input type="text" spellcheck="false" class="message-input"placeholder="Type your messgae">
                <div class="send-btn msg" title="Send Message">
                    <ion-icon name="paper-plane-outline"></ion-icon>
                </div>
                <div class="send-btn smile" title="Send Emoji">
                    <ion-icon name="happy-outline"></ion-icon>
                </div>
                <div class="send-btn link" title="More">
                    <ion-icon name="unlink-outline"></ion-icon>
                </div>
                <div class="more-actions">
                    <div class="send-btn file" title="Send Image">
                        <ion-icon name="document-outline"></ion-icon>
                    </div>
                    <div class="send-btn vid" title="Send Video">
                        <ion-icon name="videocam-outline"></ion-icon>
                    </div>
                    <div class="send-btn img" title="Send Image">
                        <ion-icon name="camera-outline"></ion-icon>
                    </div>
                </div>
            </form>
        </div> 
    </div>

    <input type="text" hidden class="user_id_holder">
    
    <script src="./assets/js/jQuery.js"></script>
    <script src="./assets/js/index.js"></script>
</body>
</html>