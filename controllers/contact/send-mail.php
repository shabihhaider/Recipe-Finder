<?php
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if (isset($_POST['submit'])) {
    
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);
    //require('PHPMailer/src/SMTP.php');

    try {
        //Server settings
        //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->Username   = 'blagattv72@gmail.com';                     //SMTP username
        $mail->Password   = 'clqhwjngfbevuiao';                               //SMTP password
        
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption
        $mail->Port = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
        
        //Recipients
        $mail->setFrom('blagattv72@gmail.com', 'Tlash Recipe');
        $mail->addAddress('blagattv72@gmail.com', 'Tlash Recipe');     //Add a recipient
        
        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Team of Tlash Recipe';
        $mail->Body    = '<h3>Hello, there</h3>
        <h4>Full Name: '.$name.' </h4>
        <h4>Email: '.$email.' </h4>
        <h4>Message: '.$message.' </h4>
        ';
        
        if ($mail->send()) {
            $_SESSION['status'] = "Thank you for Contact Us - Team of Tlash Recipe";
            header("Location: {$_SERVER['HTTP_REFERER']}");
            exit();
        } else {
            $_SESSION['status'] = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            header("Location: {$_SERVER['HTTP_REFERER']}");
            exit();
        }
        
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
} else {
    header('Location: index.php');
    exit(0);
}