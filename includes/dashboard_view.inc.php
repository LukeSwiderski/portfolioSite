<?php

  declare(strict_types=1);

  function displayVenues(array $venues) { 
?>
<select class="form-select w-auto" id="venue-select" name="venue-select">
  <option value="">Select Venue</option>
  <?php foreach ($venues as $venue) { ?>
    <option value="<?php echo $venue['venue_name']; ?>"><?php echo $venue['venue_name']; ?></option>
  <?php } ?>
</select>
<?php 
  }
?>
