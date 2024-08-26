<header>
  <div class="d-flex flex-column">
    <div>
      <?php include 'nav.php'; ?>
    </div>
    <div class="mt-auto text-end p-2 bg-light">
      <?php if (isset($_SESSION['username'])): ?>
        <span class="text-success fw-light fs-6">Logged in as: <?php echo $_SESSION['username']; ?></span>
      <?php endif; ?>
    </div>
  </div>
</header>
