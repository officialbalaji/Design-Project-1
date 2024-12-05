<?php
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/SMTP.php'; 

function generateOTP() {
    return rand(100000, 999999); ;
}
function sendOTP($recipientEmail) {
    $otp = generateOTP();
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'dpips2024@gmail.com';         
        $mail->Password   = 'olhi qudj ffnd ddri';          
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;
        $mail->setFrom('dpips2024@gmail.com', 'Passport System');
        $mail->addAddress($recipientEmail);
        $mail->isHTML(true);
        $mail->Subject = 'OTP!';
        $mail->Body = 'One-Time Password!<br>Your OTP code is : <b>' . htmlspecialchars($otp) . '</b><br><p>Do Not Send This OTP Code!</p>';
        $mail->send();
        echo "<script> alert('OTP sent to " . htmlspecialchars($recipientEmail) . "'); </script>";
        return $otp;
    } catch (Exception $e) {
        error_log("Mailer Error: " . $mail->ErrorInfo); // Log error for server admins
        echo "<script> alert('Error: Unable to send OTP. Please try again later.'); </script>";
    }
}
function sendEmail($recipientEmail, $sub, $msg){
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'dpips2024@gmail.com';         
        $mail->Password   = 'olhi qudj ffnd ddri';          
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;
        $mail->setFrom('dpips2024@gmail.com', 'Passport System');
        $mail->addAddress($recipientEmail);
        $mail->isHTML(true);
        $mail->Subject = $sub;
        $mail->Body = $msg;
        $mail->send();
    } catch (Exception $e) {
        error_log("Mailer Error: " . $mail->ErrorInfo); // Log error for server admins
        echo "<script> alert('Error: Unable to send the Mail. Please try again later.'); </script>";
    }
}

function emptyInputSignup($fname, $lname, $username, $email, $psw, $pswrepeat) {
    return empty($fname) || empty($lname) || empty($username) || empty($email) || empty($psw) || empty($pswrepeat);
}

function invalidUsername($username) {
    return !preg_match("/^[a-zA-Z0-9]*$/", $username);
}

function invalidEmail($email) {
    return !filter_var($email, FILTER_VALIDATE_EMAIL);
}

function pswMatch($psw, $pswrepeat) {
    return strcmp($psw, $pswrepeat) !== 0;
}

function usernameExists($conn, $username, $email) {
    $sql = "SELECT * FROM users WHERE uname = ? OR email = ?";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        return false; 
    }

    mysqli_stmt_bind_param($stmt, "ss", $username, $email);
    mysqli_stmt_execute($stmt);
    $resultData = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($resultData)) {
        return $row;
    } else {
        return false;
    }

    mysqli_stmt_close($stmt);
}

function createUser($conn, $fname, $lname, $email, $username, $psw) {
    $sql = "INSERT INTO users (fname, lname, uname, email, password) VALUES (?, ?, ?, ?, ?)";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        return false;
    }

    $hashedPsw = password_hash($psw, PASSWORD_DEFAULT);
    mysqli_stmt_bind_param($stmt, "sssss", $fname, $lname, $username, $email, $hashedPsw);
    if (mysqli_stmt_execute($stmt)) {
        return true;
    } else {
        return false;
    }

    mysqli_stmt_close($stmt);
}

function emptyInputLogin($username, $psw) {
    return empty($username) || empty($psw);
}

function loginUser($conn, $username, $psw) {
    $userExists = usernameExists($conn, $username, $username);

    if ($userExists === false) {
        return false; 
    }

    $hashedPsw = $userExists["password"];
    $checkPsw = password_verify($psw, $hashedPsw);

    if ($checkPsw === false) {
        return false;
    } else if ($checkPsw === true) {
        session_start();
        $_SESSION["username"] = $userExists["uname"];
        $_SESSION["email"] = $userExists["email"];
        $_SESSION["fname"] = $userExists["fname"];
        $_SESSION["lname"] = $userExists["lname"];        
        return true;
        

    }
}


