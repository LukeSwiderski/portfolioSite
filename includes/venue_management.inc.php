<?php
require_once 'dbh.inc.php';
header('Content-Type: application/json');

function handleRequest($pdo) {
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        return getVenues($pdo);
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $data = json_decode(file_get_contents('php://input'), true);
        
        switch ($data['action']) {
            case 'add':
                return addVenue($pdo, $data['venue']);
            case 'update':
                return updateVenue($pdo, $data['venue']);
            case 'delete':
                return deleteVenue($pdo, $data['venue_id']);
            default:
                return ['success' => false, 'error' => 'Invalid action'];
        }
    }

    return ['success' => false, 'error' => 'Invalid request method'];
}

function getVenues($pdo) {
    try {
        $stmt = $pdo->query('SELECT * FROM venues ORDER BY venue_name');
        $venues = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return ['success' => true, 'venues' => $venues];
    } catch (PDOException $e) {
        return ['success' => false, 'error' => 'Database error: ' . $e->getMessage()];
    }
}

function addVenue($pdo, $venue) {
    try {
        $stmt = $pdo->prepare(
            'INSERT INTO venues (venue_name, address, city, state, zip) 
             VALUES (:venue_name, :address, :city, :state, :zip)'
        );
        
        $stmt->execute([
            ':venue_name' => $venue['venue_name'],
            ':address' => $venue['address'],
            ':city' => $venue['city'],
            ':state' => $venue['state'],
            ':zip' => $venue['zip']
        ]);
        
        return ['success' => true];
    } catch (PDOException $e) {
        return ['success' => false, 'error' => 'Database error: ' . $e->getMessage()];
    }
}

function updateVenue($pdo, $venue) {
  try {
      $stmt = $pdo->prepare(
          'UPDATE venues 
           SET venue_name = :venue_name, 
               address = :address, 
               city = :city, 
               state = :state, 
               zip = :zip
           WHERE venue_id = :venue_id'
      );
      
      $stmt->execute([
          ':venue_id' => $venue['venue_id'],
          ':venue_name' => $venue['venue_name'],
          ':address' => $venue['address'],
          ':city' => $venue['city'],
          ':state' => $venue['state'],
          ':zip' => $venue['zip']
      ]);
      
      return ['success' => true];
  } catch (PDOException $e) {
      return ['success' => false, 'error' => 'Database error: ' . $e->getMessage()];
  }
}

function deleteVenue($pdo, $venueId) {
    try {
        $stmt = $pdo->prepare('DELETE FROM venues WHERE venue_id = :venue_id');
        $stmt->execute([':venue_id' => $venueId]);
        return ['success' => true];
    } catch (PDOException $e) {
        return ['success' => false, 'error' => 'Database error: ' . $e->getMessage()];
    }
}

// Execute request and send response
echo json_encode(handleRequest($pdo));