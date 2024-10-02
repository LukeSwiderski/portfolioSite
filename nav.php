<!-- navbar -->
<nav class="navbar sticky-top navbar-expand-md navbar-light bg-light">
  <div class="container-xxl">
      <!-- toggle button for mobile nav -->
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" 
      data-bs-target="#main-nav" aria-controls="main-nav" aria-expanded="false"
      aria-label="target-navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- nav bar links -->
    <div class="collapse navbar-collapse justify-content-center align-center" id="main-nav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a href="index.php#top" class="fw-bold nav-link">Home</a>
        </li>
        <li class="nav-item">
          <a href="index.php#about" class="fw-bold nav-link">About</a>
        </li>
        <li class="nav-item">
          <a href="index.php#tech" class="fw-bold nav-link">Tech</a>
        </li>
        <li class="nav-item">
          <a href="index.php#projects" class="fw-bold nav-link">Projects</a>
        </li>
        <li class="nav-item">
          <a href="index.php#contact" class="fw-bold nav-link">Contact</a>
        </li>
        <li class="nav-item">
          <a href="index.php#resume" class="fw-bold nav-link">Resume</a>
        </li>
        <li class="nav-item">
          <a href="dashboard.php" class="fw-bold nav-link">Dashboard</a>
        </li>
        <li class="nav-item">
          <?php
          if (isset($_SESSION['username'])) {
            echo '<a href="logout.php" class="fw-bold nav-link">Logout</a>';
          } else {
            echo '<a href="login.php" class="fw-bold nav-link">Login</a>';
          }
          ?>
        </li>
      </ul>
    </div>
  </div>
</nav>

