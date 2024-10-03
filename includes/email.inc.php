<?php

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
  $plainMessage = '';
  $htmlMessage = '';
  $subject = '';
  $date = date('F jS', strtotime($month . '/' . $date));
  $start_time = date('g:i A', strtotime($startTime));
  $end_time = date('g:i A', strtotime($endTime));
  $fullAddress = "$address, $city, $state $zip";

  if ($messageType == 1) {
    $plainMessage = "Hi friends, just writing to let you know I'll be playing at $venue on $date from $start_time-$end_time. The venue is located at $fullAddress. Have a great day!";
    $subject = "$venue on $date";
  } else if ($messageType == 2) {
    $plainMessage = "Reminder: I'll be playing at $venue on $date from $start_time-$end_time! The venue is located at $fullAddress. Hope to see you there!";
    $subject = "Reminder: $venue on $date";
  } else {
    $plainMessage = $messageArea;
    $subject = 'Hello Friends';
  }

  $htmlMessage = <<<EOD
    <table border="0" cellpadding="0" cellspacing="0" width="600" style="border-collapse: collapse; border: 1px solid #ddd;">
      <tr>
        <td align="center" valign="top">
          <img src="https://via.placeholder.com/600x400.png?text=Luke's+Promotional+Photo" alt="Promotional Photo" style="width: 100%; max-width: 600px; height: auto;">
        </td>
      </tr>
      <tr>
        <td align="center" valign="top" style="padding: 20px; font-family: Arial, sans-serif; background-color: #f9f9f9;">
          <h1 style="font-size: 24px; color: #333;">{$subject}</h1>
          <p style="font-size: 18px; color: #666; line-height: 1.5;">
            {$plainMessage}<br><br>
            Venue Address: {$fullAddress}<br><br>
            Best, Luke
          </p>
        </td>
      </tr>
    </table>
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