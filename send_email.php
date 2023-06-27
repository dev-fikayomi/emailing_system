
<?php
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Retrieve form data
$recipientEmail = $_POST['recipient_email'];
$senderEmail = $_POST['sender_email'];
$senderName = $_POST['sender_name'];
$subject = $_POST['subject'];
$message = $_POST['message'];

// Create a new PHPMailer instance
$mail = new PHPMailer(true);

try {
    // Enable SMTP debugging if needed
    // $mail->SMTPDebug = SMTP::DEBUG_SERVER;

    // Set up SMTP configuration
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'oyinsanmipeter@gmail.com';
    $mail->Password = 'afffgopdkkweaguo';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    // Disable SSL certificate verification
    $mail->SMTPOptions = array(
        'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        )
    );

    // Set up email headers and content
    $mail->setFrom($senderEmail, $senderName);
    $mail->addAddress($recipientEmail);
    $mail->Subject = $subject;
    $mail->Body = $message;

    // Send the email
    $success = $mail->send();

    // Redirect back to index.html with status query parameter
    if ($success) {
        echo '<script>
            alert("Email sent successfully.");
            window.location.href = "index.php#successModal";
          </script>';
    } else {
        header('Location: index.php?status=error');
    }
    exit;
} catch (Exception $e) {
        echo '<script>
alert("Error sending email: ' . $mail->ErrorInfo . '");
window.location.href = "index.php#errorModal";
</script>';
}
?>
