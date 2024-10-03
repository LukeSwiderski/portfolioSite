<?php

declare(strict_types=1);

class Venue {
  private $pdo;

  public function __construct($pdo) {
    $this->pdo = $pdo;
  }

  public function getVenues() {
    $sql = "SELECT venue_name, address, city, state, zip FROM venues";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }
}