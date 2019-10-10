<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../src/Exception.php';
require '../src/PHPMailer.php';
require '../src/SMTP.php';

if ($_POST) {
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->SMTPDebug = 2;                                       // Enable verbose debug output
        $mail->isSMTP();                                            // Set mailer to use SMTP
        $mail->Host       = 'smtp.gmail.com';                       // Specify main and backup SMTP servers
        $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
        $mail->Username   = 'robbedekienkea@gmail.com';             // SMTP username
        $mail->Password   = 'RobbedekienKea';                       // SMTP password
        $mail->SMTPSecure = 'ssl';                                  // Enable TLS encryption, `ssl` also accepted
        $mail->Port       = 465;                                    // TCP port to connect to

        //Recipients
        $mail->setFrom('robbedekienkea@gmail.com', 'HomeZ');
        $mail->addAddress('robbedekienkea@gmail.com', 'Robbe Dekien');     // Add a recipient

        // Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = 'HomeZ - Please Validate Email';
        $mail->Body    = "Welcome to HomeZ! <br>
                            Please validate your account using the following link:<br>
                            <a href='http://localhost/ProjectWebDevCph/validate?id={$_POST['id']}'>Validate account</a>";

        $mail->send();
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
