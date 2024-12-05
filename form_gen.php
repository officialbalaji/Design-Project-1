<?php 
    session_start();
    if (!isset($_SESSION["forms"])||($_SESSION["forms"])==="") {
        $_SESSION['forms']="Form_Data";
        echo '<script>window.location.href = "forms.php";</script>';
    }
?>