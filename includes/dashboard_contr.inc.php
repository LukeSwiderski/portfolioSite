<?php

declare(strict_types=1);

class VenueController {
  private $venueModel;

  public function __construct($venueModel) {
    $this->venueModel = $venueModel;
  }

  public function getVenues() {
    $venues = $this->venueModel->getVenues();
    return $venues;
  }
}