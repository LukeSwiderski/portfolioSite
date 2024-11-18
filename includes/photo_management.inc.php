<?php
require_once 'dbh.inc.php';
header('Content-Type: application/json');

function handleRequest($pdo) {
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        return getPhotos($pdo);
    }
    return ['success' => false, 'error' => 'Invalid request method'];
}

function getPhotos($pdo) {
  try {
      $stmt = $pdo->query('SELECT * FROM photos ORDER BY created_at DESC');
      $photos = $stmt->fetchAll(PDO::FETCH_ASSOC);
      
      $baseUrl = 'http://' . $_SERVER['HTTP_HOST'] . '/LukeSwiderski/';
      foreach ($photos as &$photo) {
          $photo['path'] = $baseUrl . $photo['path'];
      }
      
      return ['success' => true, 'photos' => $photos];
  } catch (PDOException $e) {
      return ['success' => false, 'error' => 'Database error: ' . $e->getMessage()];
  }
}
echo json_encode(handleRequest($pdo));