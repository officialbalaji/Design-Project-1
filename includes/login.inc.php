<?php
if (isset($_POST["login"])) {
    $username = $_POST["uname"];
    $psw = $_POST["psw"];

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    if (emptyInputLogin($username, $psw)) {
        echo '<script>window.alert("Please Fill the all the fields to login"); window.location.href = "../redirect.login.php";</script>';
        echo("loginfailed");
        exit();
    }

    if (loginUser($conn, $username, $psw)) {
        $fname = $_SESSION["fname"];
        $lname = $_SESSION["lname"];
        $uname = $_SESSION["username"];
        $email = $_SESSION["email"];

        if($uname === 'admin'){
            echo '<script>alert("Welcome System admin!"); window.location.href = "../admin/register.php?login=success";</script>';

        } elseif ($uname === 'fcontroller')

        {
            echo '<script>window.alert("Welcome Flight controller!"); window.location.href = "../fcontroller/flightManage.php?login=success";</script>';
        }

        else{
            echo '<script>window.alert("Login Successfull!"); window.location.href = "../index.php?login=success";</script>';
        }
        
        exit();

    } else {
        echo '<script>window.alert("Login Failed!"); window.location.href = "../redirect.login.php";</script>';
        exit();
    }
} else {
    header("Location:../index.php");
}


