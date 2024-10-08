<?php
use PHPMailer\PHPMailer\PHPMailer;

require 'vendor/autoload.php';

function sendEmail($to, $subject, $body) {
    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';  // Use Gmail SMTP
        $mail->SMTPAuth = true;
        $mail->Username = 'your_gmail@gmail.com';  // Your Gmail address
        $mail->Password = 'your_gmail_password';   // Your Gmail app password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        $mail->setFrom('your_gmail@gmail.com', 'PHP App');
        $mail->addAddress($to);

        $mail->Subject = $subject;
        $mail->Body    = $body;

        $mail->send();
    } catch (Exception $e) {
        echo "Email could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>

