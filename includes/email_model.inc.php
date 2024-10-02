<?php

require_once 'dbh.inc.php';

class Recipient {
  private $pdo;

  public function __construct(PDO $pdo) {
      $this->pdo = $pdo;
  }

  public function getRecipients() {
      $stmt = $this->pdo->prepare('
          SELECT id, name, email 
          FROM email_list 
          WHERE subscribe_status = "active"
      ');
      $stmt->execute();
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }
}