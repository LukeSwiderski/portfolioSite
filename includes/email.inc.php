<?php

function generateMessage($venue, $month, $date, $startTime, $endTime, $messageType, $messageArea) {
  $plainMessage = '';
  $htmlMessage = '';
  $subject = '';
  $date = date('F jS', strtotime($month . '/' . $date));
  $start_time = date('g:i A', strtotime($startTime));
  $end_time = date('g:i A', strtotime($endTime));

  if ($messageType == 1) {
    $plainMessage = "Hi friends, just writing to let you know I'll be playing at $venue on $date from $start_time-$end_time. Have a great day!";
    $subject = "New Show: $venue on $date";
  } else if ($messageType == 2) {
    $plainMessage = "Reminder: I'll be playing at $venue on $date from $start_time-$end_time! Hope to see you there!";
    $subject = "Reminder: $venue on $date";
  } else {
    $plainMessage = $messageArea;
    $subject = 'Hello Friends';
  }

  $htmlMessage = "
    <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"600\" style=\"border-collapse: collapse; border: 1px solid #ddd;\">
      <tr>
        <td align=\"center\" valign=\"top\">
          <img src=\"../assets/LukeFlyer.png\" alt=\"Promotional Photo\" style=\"width: 100%; max-width: 600px; height: auto;\">
        </td>
      </tr>
      <tr>
        <td align=\"center\" valign=\"top\" style=\"padding: 20px; font-family: Arial, sans-serif; background-color: #f9f9f9;\">
          <h1 style=\"font-size: 24px; color: #333;\">$subject</h1>
          <p style=\"font-size: 18px; color: #666; line-height: 1.5;\">
            $plainMessage<br><br>
            Best, Luke
          </p>
        </td>
      </tr>
    </table>
  ";

  return [
    "plainMessage" => $plainMessage,
    "htmlMessage" => $htmlMessage,
    "subject" => $subject
  ];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $data = json_decode(file_get_contents('php://input'), true);

  if (isset($data['message'])) {
    $message = $data['message'];
    // Handle the submission of the generated message
    // For example, send an email using the message
    // ...
  } else {
    $venue = $data['venue'];       
    $month = $data['month'];
    $date = $data['date'];
    $startTime = $data['startTime'];
    $endTime = $data['endTime'];
    $messageType = $data['messageType'];
    $messageArea = $data['messageArea'] ?? '';  // Handle optional messageArea

    // Call the generateMessage function
    $messageData = generateMessage($venue, $month, $date, $startTime, $endTime, $messageType, $messageArea);
  
    // Return the message data as a JSON response
    header('Content-Type: application/json');
    echo json_encode($messageData);    
    exit;
  }
}