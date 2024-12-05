<?php

use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Include PHPMailer library
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/SMTP.php'; 

/**
 * Function to generate a random OTP
 */
function generateOTP() {
    return rand(100000, 999999);
}

/**
 * Function to send OTP via email-to-SMS gateway
 */
function sendOTP($recipientNumber, $carrierDomain) {
    $otp = generateOTP(); // Generate a random OTP

    $mail = new PHPMailer(true);
    try {
        // SMTP Configuration
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';          // SMTP server for Gmail
        $mail->SMTPAuth   = true;
        $mail->Username   = 'dpips2024@gmail.com';    // Your Gmail address
        $mail->Password   = 'ijcf rsjc lqlr bvht';     // Gmail app password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;
        $mail->SMTPDebug = SMTP::DEBUG_SERVER; // Show debug output
        $mail->Debugoutput = 'html'; // Format debug output

        // Email settings
        $mail->setFrom('dpips2024@gmail.com', 'OTP'); // Sender's email and name
        $recipientEmail = $recipientNumber . '@' . $carrierDomain; // Email-to-SMS gateway
        $mail->addAddress($recipientEmail);   // Recipient's email (via SMS gateway)

        $mail->isHTML(true);
        $mail->Subject = 'Your OTP Code'; // Email subject
        $mail->Body    = 'Your One-Time Password (OTP) is: <b>' . htmlspecialchars($otp) . '</b><br><p>Do not share this OTP with anyone.</p>'; // Email body

        $mail->send(); // Send the email
        echo "<script> alert('OTP sent to $recipientNumber'); </script>";
    } catch (Exception $e) {
        // Log and display errors
        error_log("Mailer Error: " . $mail->ErrorInfo);
        echo "<script> alert('Error: Unable to send OTP. Please try again later.'); </script>";
    }
}

// Example usage
$recipientNumber = '9943196841'; // Replace with recipient's phone number
$carrierDomain = 'vtext.com'; // Replace with the recipient's carrier domain
sendOTP($recipientNumber, $carrierDomain);

?>


<?php 

//$senderNumber = "9943196841"; // Not explicitly required for sending, it's the SIM in the modem.
//$recipientNumber = "7639087481"; $apiKey = "f90bc8dc6797";
?>