<?php

declare(strict_types=1);

function displayVenues(array $venues) { 
?>
<select class="form-select w-auto" id="venue-select" name="venue-select">
  <option value="">Select Venue</option>
  <?php foreach ($venues as $venue) { ?>
    <option 
      value="<?php echo htmlspecialchars($venue['venue_name']); ?>"
      data-address="<?php echo htmlspecialchars($venue['address'] ?? ''); ?>"
      data-city="<?php echo htmlspecialchars($venue['city'] ?? ''); ?>"
      data-state="<?php echo htmlspecialchars($venue['state'] ?? ''); ?>"
      data-zip="<?php echo htmlspecialchars($venue['zip'] ?? ''); ?>"
    >
      <?php echo htmlspecialchars($venue['venue_name']); ?>
    </option>
  <?php } ?>
</select>
<?php 
}
?>