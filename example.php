<?php
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/SMTP.php'; 
/**
 * Function to send SMS via Gmail
 * @param string $phoneNumber Recipient's phone number
 * @param string $carrierDomain Carrier's SMS gateway domain
 * @param string $message The message to be sent
 */
function sendSMSText($phoneNumber, $carrierDomain, $message) {
    $mail = new PHPMailer(true);

    try {
        // SMTP server configuration
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'dpips2024@gmail.com'; // Replace with your Gmail address
        $mail->Password = 'ijcf rsjc lqlr bvht';  // Replace with your Gmail app password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Message configuration
        $mail->setFrom('dpips2024@gmail.com', 'OTP'); // Replace with your name
        $mail->addAddress($phoneNumber . '@' . $carrierDomain); // Recipient's email (via SMS gateway)
        $mail->isHTML(false); // Text message only
        $mail->Body = $message;

        // Send the message
        $mail->send();
        echo "SMS sent successfully to $phoneNumber";
    } catch (Exception $e) {
        echo "Error: SMS could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}

// Example usage
$phoneNumber = '9943196841'; // Replace with the recipient's phone number
$carrierDomain = 'messaging.sprintpcs.comt'; // Replace with the carrier's SMS gateway domain (Verizon example)
$message = 'This is a test SMS message.';

sendSMSText($phoneNumber, $carrierDomain, $message);
?>
