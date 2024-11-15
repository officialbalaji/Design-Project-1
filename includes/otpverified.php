<?php
    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';
    session_start();
    $fname = $_SESSION['user_data']['fn'];
    $lname = $_SESSION['user_data']['ln'];
    $email = $_SESSION['user_data']['email'];
    $username = $_SESSION['user_data']['u'];
    $psw = $_SESSION['user_data']['psw'];
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if($_SESSION['user_data']['otp']==$_POST["user_otp"]){
           
            if (createUser($conn, $fname, $lname, $email, $username, $psw)) {
                echo '<script>window.alert("You have successfully registered to the system. Now you can login to the system"); window.location.href = "../redirect.login.php";</script>';
                exit();
            } else {
                header("Location:../signup.php?error=stmtfailed");
                exit();
            }
        } else {
            echo '<script>window.alert("Wrong OTP!");</script>';
        }
    }
?>
<form method="post" action="otpverified.php">
        <label for="otp">Enter OTP:</label>
        <input type="text" name="user_otp" required>
        <button type="submit" name="verify_otp">Verify OTP</button>
</form>
