<?php

declare(strict_types=1);

function check_login_errors() {
  ini_set('display_errors', 1);
  error_reporting(E_ALL);
  
  if (isset($_SESSION["errors_login"])) {
    $errors = $_SESSION["errors_login"];

    echo "<br>";

    foreach($errors as $error) {
      echo "<p class='form-error'>" . $error . "</p>";
    }

    unset($_SESSION["errors_login"]);
  } else if (isset($_GET['login']) && $_GET['login'] === "success") {
    echo '<p class="text-center text-success">Login Success!</p>';
  }
}