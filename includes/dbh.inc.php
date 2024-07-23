<?php

$dsn = "mysql:host=localhost;dbname=music_list";
$dbusername = "root";
$dbpassword = "";

try {
  $pdo = new PDO($dsn, $dbusername, $dbpassword);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  if ($pdo) {
    echo "Connection successful!";
  }
} catch (PDOException $e) {
  error_log($e->getMessage()); // Log the error instead of echoing it
  echo "Connection failed. Please check your credentials.";
}