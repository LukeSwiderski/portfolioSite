<?php
require_once 'env.php';
require 'vendor/autoload.php';

$username = $_ENV['EMAIL_USERNAME'];
$password = $_ENV['EMAIL_PASSWORD'];

error_reporting(E_ALL);
ini_set('display_errors', 1);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = trim(htmlspecialchars($_POST["name"]));
  $email = trim(htmlspecialchars($_POST["email"]));
  $subject = trim(htmlspecialchars($_POST["subject"]));
  $message = trim(htmlspecialchars($_POST["message"]));

  if (!$email || !$name || !$subject || !$message) {
    echo 'Invalid input!';
    exit;
  }

  $mail = new PHPMailer(true);

  try {
    $mail->isSMTP(); 
    $mail->Host = 'smtp.gmail.com'; 
    $mail->SMTPAuth = true; 
    $mail->Username = $username;
    $mail->Password = $password; 
    $mail->SMTPSecure = 'tls'; 
    $mail->Port = 587; 

    $mail->setFrom($email, $name);
    $mail->addAddress($username, $name);
    $mail->Subject = $subject; 
    $mail->Body = $message; 

    $mail->send();
    echo 'Email sent successfully!';
  } catch (Exception $e) {
    echo 'Email failed: ' . $e->getMessage();
    // Log the error or send an alert to the administrator
  }
} else {
  echo 'Invalid request!';
}
