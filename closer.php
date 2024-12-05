<?php 
    session_start();
    if (isset($_SESSION["forms"])||($_SESSION["forms"])!=="") {
        $_SESSION["forms"]="";
    }
    if (isset($_SESSION["onetimepassword"])||($_SESSION["onetimepassword"])==="otp_createUser") {
        $_SESSION["onetimepassword"]="";
        $_SESSION['user_data']['fn']="";
        $_SESSION['user_data']['ln']="";
        $_SESSION['user_data']['email']="";
        $_SESSION['user_data']['u']="";
        $_SESSION['user_data']['psw']="";
        $_SESSION["otp"]="";
    }
    if (isset($_SESSION["onetimepassword"])||($_SESSION["onetimepassword"])==="otp_form") {
        $_SESSION["onetimepassword"]="";
        if (isset($_SESSION["forms"])||($_SESSION["forms"])==="") {
            $_SESSION["forms"]="";
        }
    }
    echo "<script>window.location.href='index.php';</script>";

?>