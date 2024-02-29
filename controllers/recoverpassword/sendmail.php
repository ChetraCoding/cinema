<?php
// Import PHPMailer classes into the global namespace 
use PHPMailer\PHPMailer\PHPMailer; 
use PHPMailer\PHPMailer\Exception; 
// Include PHPMailer library files 
require 'PHPMailer/Exception.php'; 
require 'PHPMailer/PHPMailer.php'; 
require 'PHPMailer/SMTP.php'; 

// Create an instance of PHPMailer class 
$mail = new PHPMailer;

// SMTP configuration
$mail->isSMTP();
$mail->Host     = 'smtp.gmail.com';
$mail->SMTPAuth = true;
$mail->Username = $MAIL_USER;
$mail->Password = $MAIL_SECRET;
$mail->SMTPSecure = 'tls';
$mail->Port = 587;

// Sender info 
$mail->setFrom($MAIL_USER, $MAIL_NAME); 
$mail->addReplyTo($MAIL_USER, $MAIL_NAME); 

// Add a recipient
/*
 * $email : Come from file \controllers\recoverpassword\forgotpassword.controller.php | Line 11
 */
$mail->addAddress($email); 

// Add cc or bcc
// $mail->addCC('cc@example.com'); 
// $mail->addBCC('bcc@example.com'); 
 
// Email subject 
$mail->Subject = $MAIL_SUBJECT; 
 
// Set email format to HTML 
$mail->isHTML(true); 
 
// Email body content
/*
 * $pinCode : Come from file \controllers\recoverpassword\forgotpassword.controller.php | Line 12
 */
$mailContent = "
    <p>Hello,</p>
    <p>Your verification code: <span style='font-width: bold;'>$pinCode</span>.</p>
    <p>Do not share it with anyone.</p>
    <br>
    <p>Thank you!</p>
";
$mail->Body = $mailContent; 
 
// Send email 
if(!$mail->send()){ 
    echo 'Message could not be sent. Mailer Error: '.$mail->ErrorInfo; 
}else{ 
    echo 'Message has been sent.'; 
}