<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to iChat Settings pgae!</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <link rel="stylesheet" href="./assets/css/style.css">
</head>
<body>
    <div class="page-loader">
        <i class="fas fa-cog"></i>
    </div>
    <div class="container"> 
        <form class="inner-cont" id="update_form">
            <div class="user-profile-img">
                <div class="img-cont">
                    <img src="images/profile-pic.png">
                </div>
                <label for="new_img_input" class="camera">
                        <i class="fas fa-camera camera-icon"></i>
                </label>
                <input type="file" accept="image/*" id="new_img_input" name="new_img_input" hidden>
                <input type="text" name="cur_img" id="cur_img" hidden>
            </div>
            <div class="name field">
                <label for="name"><i class="fa fa-user icon"></i> Name</label>
                <input type="text" value="" name="name" id="name">
            </div>
            <div class="email field">
                <label for="email"><i class="fa fa-envelope icon"></i> Email</label>
                <input type="text" value="" name="email" id="email">
            </div>
            <div class="password field">
                <label for="name"><i class="fa fa-key icon"></i> Password</label>
                <input type="text" name="changed_pass" id="changed_pass" hidden>
                <input type="button" value="Change" class="change-btn">
            </div>
            <div class="error-text f">this is some error</div>
            <div class="save field">
                <label for="name"><i class="fa fa-cog icon"></i> Save Changes</label>
                <input type="submit" value="Save">
            </div>
            <!-- <div class="user-img-shown">
                <div class="img">
                    <img src="images/team-01.jpg">
                    <div class="cancel-icon" >
                        <i class="fas fa-times" id="d"></i>
                    </div>
                </div>  
            </div> -->
            <div class="change-password">
                <div class="pass-cont">
                    <div class="text">
                        <h2>Change Password!</h2>
                        <p>Enter you current password & then new password</p>
                    </div>
                    <div id="password_form">
                        <div class="field">
                            <label><i class="fa fa-clock"></i> Current Password</label>
                            <input type="password" id="cur_pass">
                        </div>
                        <div class="field">
                            <label><i class="fa fa-lock"></i> New Password</label>
                            <input type="password" id="new_pass">
                        </div>
                        <div class="error-text">_________</div>
                        <div class="save field">
                            <button type="button" class="back-btn">Back</button>
                            <button type="button" class="pass-change-btn">Change Password</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <script src="./assets/js/jQuery.js"></script>
    <script src="./assets/js/index.js"></script>
</body>
</html>