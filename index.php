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
    <title>Login to iChat</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <link rel="stylesheet" href="./assets/css/style.css">
  </head>
  <body>
    <div class="center">
      <h1>iChat | Login</h1>
      <form id="login-form">
        <div class="txt_field">
          <input type="text" required id="email">
          <span></span>
          <label>Username</label>
        </div>
        <div class="txt_field">
          <input type="password" required id="password">
          <span></span>
          <label>Password</label>
        </div>
        <div class="error-text"></div>
        <input type="submit" value="Login">
        <div class="signup_link">
          Not a member? <a href="./signup.php">Sign up</a>
        </div>
      </form>
    </div>

    <script src="./assets/js/jQuery.js"></script>
    <script src="./assets/js/index.js"></script>
  </body>
</html>
