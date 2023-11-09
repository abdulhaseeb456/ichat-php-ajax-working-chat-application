<?php
    include 'config.php';
    session_start();
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, sha1($_POST['password']));


    $output = "";
    if(!empty($email) && !empty($password)) {
        if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $sql = "SELECT * FROM users WHERE user_email = '{$email}' AND user_pass = '{$password}'";
            $result = mysqli_query($conn, $sql) or die("Password incorrect!");
            if(mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                $_SESSION['user_id'] = $row['user_id'];
                $output = 1;
            } else {
                $output = "Password incorrect!";
            }
        } else {
            $output = "Email is not valid";
        }
    } else {
        $output = "Please fill in the fields";
    }

    echo $output;
?>