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

function sendTestEmail($pdo, $messageData) {
  global $username, $password;
  
  // Get test recipients
  $stmt = $pdo->prepare('SELECT name, email FROM email_list WHERE test = 1');
  $stmt->execute();
  $testRecipients = $stmt->fetchAll(PDO::FETCH_ASSOC);
  
  if (empty($testRecipients)) {
      return ['error' => 'No test recipients found'];
  }

  try {
      $mail = new PHPMailer\PHPMailer\PHPMailer(true);
      $mail->isSMTP();
      $mail->Host = 'smtp.gmail.com';
      $mail->SMTPAuth = true;
      $mail->Username = $username;
      $mail->Password = $password;
      $mail->SMTPSecure = 'tls';
      $mail->Port = 587;
      
      // Add debug output
      $mail->SMTPDebug = 2;
      $mail->Debugoutput = function($str, $level) {
          logMessage("TEST EMAIL SMTP ($level): $str");
      };
      
      $mail->setFrom($username, 'Luke');
      $mail->isHTML(true);  // Enable HTML email
      
      // Clear any existing recipients
      $mail->clearAddresses();
      
      // Prepare results summary
      $results = [
          'successful' => 0,
          'failed' => 0,
          'failedDetails' => []
      ];

      // Process each recipient and track results
      foreach ($testRecipients as $recipient) {
          try {
              if (!filter_var($recipient['email'], FILTER_VALIDATE_EMAIL)) {
                  logMessage("Test email: Invalid email format for {$recipient['email']}");
                  $results['failed']++;
                  $results['failedDetails'][] = [
                      'email' => $recipient['email'],
                      'name' => $recipient['name'],
                      'error' => 'Invalid email format'
                  ];
                  continue;
              }
              $mail->addAddress($recipient['email'], $recipient['name']);
              $results['successful']++;
          } catch (Exception $e) {
              logMessage("Test email: Error adding recipient {$recipient['email']}: " . $e->getMessage());
              $results['failed']++;
              $results['failedDetails'][] = [
                  'email' => $recipient['email'],
                  'name' => $recipient['name'],
                  'error' => $e->getMessage()
              ];
              continue;
          }
      }
      
      $mail->Subject = '[TEST] ' . $messageData['subject'];
      $mail->Body = $messageData['htmlMessage'];
      $mail->AltBody = $messageData['plainMessage'];
      
      if (!$mail->send()) {
          logMessage("Test email send failed: " . $mail->ErrorInfo);
          return [
              'success' => true,
              'results' => [
                  'successful' => 0,
                  'failed' => count($testRecipients),
                  'failedDetails' => array_merge(
                      $results['failedDetails'],
                      [['email' => 'All recipients', 'name' => 'System', 'error' => $mail->ErrorInfo]]
                  )
              ]
          ];
      }
      
      logMessage("Test email sent successfully");
      return [
          'success' => true,
          'results' => $results
      ];
  } catch (Exception $e) {
      logMessage("Test email exception: " . $e->getMessage());
      return [
          'success' => false,
          'results' => [
              'successful' => 0,
              'failed' => count($testRecipients),
              'failedDetails' => [
                  ['email' => 'System Error', 'name' => 'System', 'error' => $e->getMessage()]
              ]
          ]
      ];
  }
}

logMessage("Script started");

$username = $_ENV['EMAIL_USERNAME'];
$password = $_ENV['EMAIL_PASSWORD'];

function generateMessage($venue, $address, $city, $state, $zip, $month, $date, $startTime, $endTime, $messageType, $messageArea = '', $photo_id = null) {
    global $pdo;
    $htmlMessage = '';
    $date = date('F jS', strtotime($month . '/' . $date));
    $start_time = date('g:i A', strtotime($startTime));
    $end_time = date('g:i A', strtotime($endTime));
    $address = htmlspecialchars($address, ENT_QUOTES, 'UTF-8');
    $city = htmlspecialchars($city, ENT_QUOTES, 'UTF-8');
    $state = htmlspecialchars($state, ENT_QUOTES, 'UTF-8');
    $zip = htmlspecialchars($zip, ENT_QUOTES, 'UTF-8');
    $fullAddress = "$address, $city, $state $zip";

    // If messageArea is provided, use it as the custom message
    if (!empty($messageArea)) {
      $plainMessage = $messageArea;
      $subject = "$venue on $date";
    } else {
        // Otherwise use the template messages based on messageType
        if ($messageType == 1) {
            $plainMessage = "Hi friends, just writing to let you know I'll be playing at $venue on $date from $start_time-$end_time. Have a great day!";
            $subject = "$venue on $date";
        } else if ($messageType == 2) {
            $plainMessage = "Reminder: I'll be playing at $venue on $date from $start_time-$end_time! Hope to see you there!";
            $subject = "Reminder: $venue on $date";
        } else {
            $plainMessage = "I'll be playing at $venue on $date from $start_time-$end_time.";
            $subject = "$venue on $date";
        }
    }

    $photoHtml = '';
    if ($photo_id) {
        $stmt = $pdo->prepare('SELECT path FROM photos WHERE id = ?');
        $stmt->execute([$photo_id]);
        $photo = $stmt->fetch();
        if ($photo) {
            $fullPath = $photo['path'];
            $photoHtml = "<img src='{$fullPath}' alt='Event Photo' style='max-width: 600px; width: 100%; height: auto; margin-bottom: 20px;'>";
        }
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
         {$photoHtml}
        
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
        logMessage("Failed validation check");
        echo json_encode(['error' => 'Invalid request data']);
        exit;
    }

    logMessage("Passed validation check");

    $messageData = generateMessage($data['venue'], $data['address'], $data['city'], $data['state'], $data['zip'], $data['month'], $data['date'], $data['startTime'], $data['endTime'], $data['messageType'], $data['plainMessage'] ?? '', $data['photo_id'] ?? null);
    logMessage("Message generated: " . print_r($messageData, true));

    if (isset($data['action']) && !empty($data['action'])) {
        logMessage("Action is set: " . $data['action']);
        
        if ($data['action'] === 'send') {
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

                // Track successful and failed emails
                $successfulEmails = [];
                $failedEmails = [];

                foreach ($activeRecipients as $recipient) {
                    try {
                        // Clear recipients before adding new one to isolate potential errors
                        $mail->clearAddresses();
                        
                        // Validate email format before attempting to send
                        if (!filter_var($recipient['email'], FILTER_VALIDATE_EMAIL)) {
                            $failedEmails[] = [
                                'email' => $recipient['email'],
                                'name' => $recipient['name'],
                                'error' => 'Invalid email format'
                            ];
                            logMessage("Invalid email format: {$recipient['email']}");
                            continue;
                        }

                        $mail->addAddress($recipient['email'], $recipient['name']);
                        $mail->Subject = $messageData['subject'];
                        $mail->Body = $messageData['htmlMessage'];
                        $mail->AltBody = $messageData['plainMessage'];

                        if ($mail->send()) {
                            $successfulEmails[] = [
                                'email' => $recipient['email'],
                                'name' => $recipient['name']
                            ];
                            logMessage("Successfully sent to: {$recipient['email']}");
                        }
                    } catch (Exception $e) {
                        $failedEmails[] = [
                            'email' => $recipient['email'],
                            'name' => $recipient['name'],
                            'error' => $e->getMessage()
                        ];
                        logMessage("Failed to send to {$recipient['email']}: " . $e->getMessage());
                        // Continue with next recipient instead of stopping
                        continue;
                    }
                }

                // Log final results
                logMessage("Successfully sent to " . count($successfulEmails) . " recipients");
                if (!empty($failedEmails)) {
                    logMessage("Failed to send to " . count($failedEmails) . " recipients");
                    foreach ($failedEmails as $failure) {
                        logMessage("Failed recipient: {$failure['email']} - Error: {$failure['error']}");
                    }
                }

                // Return comprehensive results
                echo json_encode([
                    'success' => true,
                    'message' => 'Email sending completed',
                    'results' => [
                        'successful' => count($successfulEmails),
                        'failed' => count($failedEmails),
                        'failedDetails' => $failedEmails
                    ]
                ]);

            } catch (Exception $e) {
                logMessage("Major error in email sending process: " . $e->getMessage());
                echo json_encode([
                    'error' => 'Error in email sending process',
                    'details' => $e->getMessage()
                ]);
            }
        } else if ($data['action'] === 'test') {
            logMessage("Sending test email requested");
            $result = sendTestEmail($pdo, $messageData);
            echo json_encode($result);
        }
    } else {
        logMessage("About to send response");
        echo json_encode(['success' => true, 'messageData' => $messageData]);
        logMessage("Response sent");
    }
} else {
    echo json_encode(['error' => 'Invalid request method']);
}