<?php
    session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_SESSION["userName"] = $_POST['userName'];
    $_SESSION["email_id"] = $_POST['email_id'];
    $_SESSION["referrence"] = $_POST['referrence'];
    $_SESSION["password"] = $_POST['password'];
    $_SESSION["status"] = $_POST['userName'];
    echo "<script>window.location.href = 'update_status.php';</script>";
}
?>