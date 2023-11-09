<?php
    session_start();
    if(isset($_SESSION['user_id'])) {
        header("location: http://localhost/ichat/chatarea.php");
    }
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Sign up to continue chatting with your friends | iChat</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <link rel="stylesheet" href="./assets/css/style.css">

  </head>
  <body>
    <div class="center">
      <h1>iChat | Sign Up</h1>
      <form id="signup-form" method="POST">
        <label class="img-field" for="img-input">
            <img title="Click to select an Image" src="./assets/images/profile-pic.png" alt="">
            <i class="fas fa-camera"></i>
        </label>
        <input type="file" hidden id="img-input" name="uploadedImg" accept="image/*">
        <div class="name-field">
          <div class="txt_field">
            <input type="text" required name="fname">
            <span></span>
            <label>First Name</label>
          </div>
          <div class="txt_field">
            <input type="text" required name="lname">
            <span></span>
            <label>Last Name</label>
          </div>
        </div>
        <div class="txt_field">
          <input type="text" required name="email">
          <span></span>
          <label>Email</label>
        </div>
        <div class="txt_field">
          <input type="password" required name="password">
          <span></span>
          <label>Password</label>
        </div>
        <div class="error-text"></div>
        <input type="submit" value="Sign Up">
        <div class="signup_link">
          Have an account? <a href="./index.php">Sign In</a>
        </div>
      </form>
    </div>
  
    <script src="./assets/js/jQuery.js"></script>
    <script src="./assets/js/index.js"></script>

  </body>
</html>
