<?php

declare(strict_types=1);

function get_user(object $pdo, string $username) {
  $query = "SELECT * FROM users WHERE username = :username;";
  $stmt = $pdo->prepare($query);
  $stmt->bindParam(":username", $username);
  $stmt->execute();
  
  $result = $stmt->fetch(PDO::FETCH_ASSOC);
  return $result;
}

// function get_user(object $pdo, string $username, string $password) {
//   $query = "SELECT * FROM users WHERE username = :username;";
//   $stmt = $pdo->prepare($query);
//   $stmt->bindParam(":username", $username);
//   $stmt->execute();
  
//   $result = $stmt->fetch(PDO::FETCH_ASSOC);
//   var_dump($result); // Add this to see the query result
  
//   if ($result && password_verify($password, $result['pwd'])) {
//     // Login successful
//     return $result;
//   } else {
//     // Incorrect login info 5
//     return false;
//   }
// }