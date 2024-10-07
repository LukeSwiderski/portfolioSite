<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('log_errors', 1);
ini_set('error_log', '/Applications/XAMPP/xamppfiles/logs/php_error_log');

require_once '../env.php';
require '../vendor/autoload.php';
require_once 'email_model.inc.php';

function logMessage($message) {
  $timestamp = date('Y-m-d H:i:s');
  $logFile = __DIR__ . '/email_script.log';
  file_put_contents($logFile, "[$timestamp] $message\n", FILE_APPEND);
}

logMessage("Script started");

$username = $_ENV['EMAIL_USERNAME'];
$password = $_ENV['EMAIL_PASSWORD'];

function generateMessage($venue, $address, $city, $state, $zip, $month, $date, $startTime, $endTime, $messageType, $messageArea = '') {
  $htmlMessage = '';
  $date = date('F jS', strtotime($month . '/' . $date));
  $start_time = date('g:i A', strtotime($startTime));
  $end_time = date('g:i A', strtotime($endTime));
  $address = htmlspecialchars($address, ENT_QUOTES, 'UTF-8');
  $city = htmlspecialchars($city, ENT_QUOTES, 'UTF-8');
  $state = htmlspecialchars($state, ENT_QUOTES, 'UTF-8');
  $zip = htmlspecialchars($zip, ENT_QUOTES, 'UTF-8');
  $fullAddress = "$address, $city, $state $zip";

  if ($messageType == 1) {
    $plainMessage = "Hi friends, just writing to let you know I'll be playing at $venue on $date from $start_time-$end_time. Have a great day!";
    $subject = "$venue on $date";
  } else if ($messageType == 2) {
    $plainMessage = "Reminder: I'll be playing at $venue on $date from $start_time-$end_time! Hope to see you there!";
    $subject = "Reminder: $venue on $date";
  } else {
    $plainMessage = $messageArea;
    $subject = 'Hello Friends';
  }

$htmlMessage = <<<EOD
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Luke's Gig Announcement</title>
    <!--[if !mso]><!-->
    <style type="text/css">
        @media only screen and (max-width: 480px) {
            .mobile-text { font-size: 18px !important; }
            .mobile-heading { font-size: 22px !important; }
            .mobile-container { padding: 10px !important; }
        }
    </style>
    <!--<![endif]-->
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333333; margin: 0; padding: 0;">
    <div class="mobile-container" style="max-width: 600px; margin: 0 auto; padding: 20px;">
        <img src="https://via.placeholder.com/600x300.png?text=Luke's+Promotional+Photo" alt="Luke's Promotional Photo" style="max-width: 100%; height: auto; width: 100%; max-width: 600px;">
        
        <h1 class="mobile-heading" style="font-size: 24px; color: #333333; margin-bottom: 20px;">
            {$subject}
        </h1>
        
        <p class="mobile-text" style="font-size: 16px; margin-bottom: 15px;">
            {$plainMessage}
        </p>
        
        <p class="mobile-text" style="font-size: 16px; margin-bottom: 15px; font-style: italic; margin-top: 10px;">
            Venue Address: {$fullAddress}
        </p>
        
        <p class="mobile-text" style="font-size: 16px; margin-top: 20px; font-weight: bold;">
            Best, Luke
        </p>
    </div>
</body>
</html>
EOD;
  return [
    "plainMessage" => $plainMessage,
    "htmlMessage" => $htmlMessage,
    "subject" => $subject
  ];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  logMessage("POST request received");
  $data = json_decode(file_get_contents('php://input'), true);
  logMessage("Decoded JSON data: " . print_r($data, true));

  if (!isset($data['venue'], $data['address'], $data['city'], $data['state'], $data['zip'], $data['month'], $data['date'], $data['startTime'], $data['endTime'], $data['messageType'])) {
    echo json_encode(['error' => 'Invalid request data']);
    exit;
  }

  $messageData = generateMessage($data['venue'], $data['address'], $data['city'], $data['state'], $data['zip'], $data['month'], $data['date'], $data['startTime'], $data['endTime'], $data['messageType'], $data['plainMessage'] ?? '');
  logMessage("Message generated: " . print_r($messageData, true));

  if (isset($data['action']) && $data['action'] === 'send') {
    logMessage("Sending email requested");
    
    $recipient = new Recipient($pdo);
    $activeRecipients = $recipient->getRecipients();
    logMessage("Active recipients: " . print_r($activeRecipients, true));

    try {
      $mail = new PHPMailer\PHPMailer\PHPMailer(true);
      $mail->isSMTP();
      $mail->Host = 'smtp.gmail.com';
      $mail->SMTPAuth = true;
      $mail->Username = $username;
      $mail->Password = $password;
      $mail->SMTPSecure = 'tls';
      $mail->Port = 587;
      $mail->SMTPDebug = 2;
      $mail->Debugoutput = function($str, $level) {
        logMessage("SMTP ($level): $str");
      };

      $mail->setFrom($username, 'Luke');

      foreach ($activeRecipients as ['email' => $email, 'name' => $name]) {
        $mail->addAddress($email, $name);
      }
      
      $mail->Subject = $messageData['subject'];
      $mail->Body = $messageData['htmlMessage'];
      $mail->AltBody = $messageData['plainMessage'];

      logMessage("PHPMailer configured, about to send");

      if (!$mail->send()) {
        $error = $mail->ErrorInfo;
        logMessage("Error sending email: " . $error);
        echo json_encode(['error' => 'Error sending email: ' . $error]);
      } else {
        logMessage("Email sent successfully!");
        echo json_encode(['success' => true, 'message' => 'Email sent successfully!']);
      }
    } catch (Exception $e) {
      logMessage("Exception caught: " . $e->getMessage());
      echo json_encode(['error' => 'Error sending email: ' . $e->getMessage()]);
    }
  } else {
    echo json_encode(['success' => true, 'messageData' => $messageData]);
  }
} else {
  echo json_encode(['error' => 'Invalid request method']);
}