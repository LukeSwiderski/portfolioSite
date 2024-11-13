<?php
require_once 'dbh.inc.php';
header('Content-Type: application/json');

function handleRequest($pdo) {
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        return getEmails($pdo);
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $data = json_decode(file_get_contents('php://input'), true);
        
        switch ($data['action']) {
            case 'add':
                return addEmail($pdo, $data['email']);
            case 'update':
                return updateEmail($pdo, $data['email']);
            case 'delete':
                return deleteEmail($pdo, $data['id']);
            default:
                return ['success' => false, 'error' => 'Invalid action'];
        }
    }

    return ['success' => false, 'error' => 'Invalid request method'];
}

function getEmails($pdo) {
    try {
        $stmt = $pdo->query('SELECT * FROM email_list ORDER BY name');
        $emails = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return ['success' => true, 'emails' => $emails];
    } catch (PDOException $e) {
        return ['success' => false, 'error' => 'Database error: ' . $e->getMessage()];
    }
}

function addEmail($pdo, $email) {
    try {
        // Check if email already exists
        $checkStmt = $pdo->prepare('SELECT id FROM email_list WHERE email = :email');
        $checkStmt->execute([':email' => $email['email']]);
        if ($checkStmt->fetch()) {
            return ['success' => false, 'error' => 'Email already exists'];
        }

        // Validate status
        $validStatuses = ['active', 'inactive', 'unsubscribed', 'pending'];
        if (!in_array($email['subscribe_status'], $validStatuses)) {
            return ['success' => false, 'error' => 'Invalid status'];
        }

        $stmt = $pdo->prepare(
            'INSERT INTO email_list (name, email, subscribe_status) 
             VALUES (:name, :email, :subscribe_status)'
        );
        
        $stmt->execute([
            ':name' => substr($email['name'], 0, 100), // Enforce varchar(100) limit
            ':email' => $email['email'],
            ':subscribe_status' => $email['subscribe_status']
        ]);
        
        return ['success' => true];
    } catch (PDOException $e) {
        return ['success' => false, 'error' => 'Database error: ' . $e->getMessage()];
    }
}

function updateEmail($pdo, $email) {
    try {
        // Validate status if provided
        if (isset($email['subscribe_status'])) {
            $validStatuses = ['active', 'inactive', 'unsubscribed', 'pending'];
            if (!in_array($email['subscribe_status'], $validStatuses)) {
                return ['success' => false, 'error' => 'Invalid status'];
            }
        }

        $sql = 'UPDATE email_list SET ';
        $params = [];
        
        // Only update provided fields
        if (isset($email['name'])) {
            $sql .= 'name = :name, ';
            $params[':name'] = substr($email['name'], 0, 100);
        }
        if (isset($email['email'])) {
            // Check if new email already exists for different ID
            $checkStmt = $pdo->prepare('SELECT id FROM email_list WHERE email = :email AND id != :id');
            $checkStmt->execute([
                ':email' => $email['email'],
                ':id' => $email['id']
            ]);
            if ($checkStmt->fetch()) {
                return ['success' => false, 'error' => 'Email already exists'];
            }
            $sql .= 'email = :email, ';
            $params[':email'] = $email['email'];
        }
        if (isset($email['subscribe_status'])) {
            $sql .= 'subscribe_status = :subscribe_status, ';
            $params[':subscribe_status'] = $email['subscribe_status'];
        }

        // Remove trailing comma and space
        $sql = rtrim($sql, ', ');
        
        $sql .= ' WHERE id = :id';
        $params[':id'] = $email['id'];

        $stmt = $pdo->prepare($sql);
        $stmt->execute($params);
        
        return ['success' => true];
    } catch (PDOException $e) {
        return ['success' => false, 'error' => 'Database error: ' . $e->getMessage()];
    }
}

function deleteEmail($pdo, $id) {
    try {
        $stmt = $pdo->prepare('DELETE FROM email_list WHERE id = :id');
        $stmt->execute([':id' => $id]);
        return ['success' => true];
    } catch (PDOException $e) {
        return ['success' => false, 'error' => 'Database error: ' . $e->getMessage()];
    }
}

// Execute request and send response
echo json_encode(handleRequest($pdo));