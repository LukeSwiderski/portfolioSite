<?php 
  error_reporting(E_ALL);
  ini_set('display_errors', 1);

  function errorHandler($errno, $errstr, $errfile, $errline) {
    echo "<b>Error:</b> [$errno] $errstr<br>";
    echo "File: $errfile<br>";
    echo "Line: $errline<br>";
  }

  set_error_handler("errorHandler");
?>


<html lang="en">
<head>
  <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="main.css">
    <title>Dashboard</title>
    <style>
      section{
        padding: 60px 0;
      }
    </style>
</head>
<body>
  <?php 
    session_start();
    include 'header.php'; 
    if (!isset($_SESSION['username'])) {
      header('Location: login.php');
      exit;
    }
    include 'includes/dashboard_model.inc.php';
    include 'includes/dashboard_contr.inc.php';
    include 'includes/dbh.inc.php';
  ?>

  <h2 class="fw-bold text-center">Dashboard</h2>

  <!-- Message section -->

  <section id="message">
    <div class="text-center">
      <h1 class="fw-bold">Message</h1>
    </div>
    <div id="messageFormParent" class="row justify-content-center my-5">
      <div class="col-md-8">
        <form id="messageForm" action="includes/message.inc.php" method="POST">
          <div class="row mb-4 align-items-start">
            <div class="col-md-2 mb-3">
              <label for="venue-select" class="form-label fw-bold">Venues</label>
              <?php 
                $venueController = new VenueController(new Venue($pdo));
                $venues = $venueController->getVenues();
              ?>
              <?php 
                include "includes/dashboard_view.inc.php"; 
                displayVenues($venues);
              ?>
            </div>
            <div class="col-md-2 mb-3">
              <label for="month-select" class="form-label fw-bold">Month</label>
              <select class="form-select w-auto" id="month-select" name="month-select">
                <option value="">Select Month</option>
                <option value="1">January</option>
                <option value="2">February</option>
                <option value="3">March</option>
                <option value="4">April</option>
                <option value="5">May</option>
                <option value="6">June</option>
                <option value="7">July</option>
                <option value="8">August</option>
                <option value="9">September</option>
                <option value="10">October</option>
                <option value="11">November</option>
                <option value="12">December</option>
              </select>
            </div>
            <div class="col-md-2 mb-3">
            <label for="date-select" class="form-label fw-bold">Date</label>
            <select class="form-select w-auto" id="date-select" name="date-select">
              <option value="">Select Date</option>
            </select>
          </div>
          <div class="col-md-2 mb-3">
            <label for="start-select" class="form-label fw-bold">Start</label>
            <select class="form-select w-auto" id="start-select" name="start-select">
              <option value="">Select Start</option>
              <option value="09:00">9:00 AM</option>
              <option value="10:00">10:00 AM</option>
              <option value="11:00">11:00 AM</option>
              <option value="12:00">12:00 PM</option>
              <option value="13:00">1:00 PM</option>
              <option value="14:00">2:00 PM</option>
              <option value="15:00">3:00 PM</option>
              <option value="16:00">4:00 PM</option>
              <option value="17:00">5:00 PM</option>
              <option value="18:00">6:00 PM</option>
              <option value="19:00">7:00 PM</option>
              <option value="20:00">8:00 PM</option>
              <option value="21:00">9:00 PM</option>
              <option value="22:00">10:00 PM</option>
              <option value="23:00">11:00 PM</option>
            </select>
          </div>
          <div class="col-md-2 mb-3">
            <label for="end-select" class="form-label fw-bold">End</label>
            <select class="form-select w-auto" id="end-select" name="end-select">
              <option value="">Select End</option>
              <option value="09:00">9:00 AM</option>
              <option value="10:00">10:00 AM</option>
              <option value="11:00">11:00 AM</option>
              <option value="12:00">12:00 PM</option>
              <option value="13:00">1:00 PM</option>
              <option value="14:00">2:00 PM</option>
              <option value="15:00">3:00 PM</option>
              <option value="16:00">4:00 PM</option>
              <option value="17:00">5:00 PM</option>
              <option value="18:00">6:00 PM</option>
              <option value="19:00">7:00 PM</option>
              <option value="20:00">8:00 PM</option>
              <option value="21:00">9:00 PM</option>
              <option value="22:00">10:00 PM</option>
              <option value="23:00">11:00 PM</option>
            </select>
          </div>
          <div class="col-md-2 mb-3">
            <label for="message-select" class="form-label fw-bold">Message</label>
            <select class="form-select w-auto" id="message-select" name="message-select">
              <option value="">Select Message</option>
              <option value="new">New</option>
              <option value="reminder">Reminder</option>
              
            </select>
          </div>
        </div>
        <label for="message-area" class="form-label"></label>
        <div class="input-group mb-4 justify-content-center">
          <textarea name="message-area" id="message-area" rows="10" cols="80"></textarea>
        </div>
        <div class="mb-4 text-center">
          <button class="btn btn-dark" type="submit">Generate</button>
          <button class="btn btn-dark" type="submit">Submit</button>
          <button class="btn btn-dark" type="submit">Clear</button>
        </div>
      </form>
    </div>
  </div>
</section>

</body>
</html>
<script src="dashboard.js"></script>