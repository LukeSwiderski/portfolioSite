<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="main.css">
    <title>Projects - Luke Swiderski</title>
    <style>
      .project-card {
        border: 1px solid rgba(0,0,0,0.1);
        border-radius: 8px;
        margin-bottom: 2rem;
      }

      .project-card img {
        width: 100%;
        height: auto;
        border-top-left-radius: 8px;
        border-top-right-radius: 8px;
      }
      
      .project-card .card-body {
        padding: 1.5rem;
      }

      .project-grid {
        max-width: 1200px;
        margin: 4rem auto;
        padding: 0 2rem;
      }

      .project-title {
        font-size: 24px;
        font-weight: bold;
        margin-bottom: 1rem;
      }

      .project-description {
        color: #666;
        margin-bottom: 1.5rem;
        min-height: 75px;
      }

      section {
          padding: 60px 0;
      }
    </style>
</head>
<body>
    <?php include 'header.php'; ?>

    <!-- Main hero section -->
    <section id="hero" class="bg-light">
        <div class="container-lg">
            <div class="row align-items-center">
                <div class="col-md-5 text-center text-md-start offset-md-1">
                    <h1 class="display-4 fw-bold">Projects</h1>
                    <p>A showcase of my software development work, including open source contributions and personal projects.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Projects Grid -->
    <div class="project-grid">
        <div class="row g-4">
            <!-- Project cards remain exactly the same as previous version -->
            <!-- Open Source -->
            <div class="col-md-6">
                <div class="project-card">
                    <img src="./assets/firefox.jpg" alt="Open Source Project">
                    <div class="card-body">
                        <h2 class="project-title">Open Source</h2>
                        <p class="project-description">
                            Contributed to major projects like Mozilla Firefox and Google Chrome, successfully resolving various bugs.
                        </p>
                        <a href="http://localhost/LukeSwiderski/open-source.php" class="btn btn-dark">Learn More</a>
                    </div>
                </div>
            </div>

            <!-- Email App -->
            <div class="col-md-6">
                <div class="project-card">
                    <img src="./assets/dashboard.jpg" alt="Email App">
                    <div class="card-body">
                        <h2 class="project-title">Email App</h2>
                        <p class="project-description">
                            A custom email application for managing subscriber lists and sending automated notifications.
                        </p>
                        <a href="http://localhost/LukeSwiderski/email-service.php" class="btn btn-dark">Learn More</a>
                    </div>
                </div>
            </div>

            <!-- Blues Matrix -->
            <div class="col-md-6">
                <div class="project-card">
                    <img src="./assets/Blues-matrix.jpg" alt="Blues Matrix">
                    <div class="card-body">
                        <h2 class="project-title">Blues Matrix</h2>
                        <p class="project-description">
                            An interactive tool for exploring and learning blues scale patterns and progressions.
                        </p>
                        <a href="http://localhost/LukeSwiderski/blues-matrix.php" class="btn btn-dark">Learn More</a>
                    </div>
                </div>
            </div>

            <!-- Array Methods -->
            <div class="col-md-6">
                <div class="project-card">
                    <img src="./assets/Array-methods.jpg" alt="Array Methods">
                    <div class="card-body">
                        <h2 class="project-title">Array Methods</h2>
                        <p class="project-description">
                            A comprehensive guide to JavaScript array methods with interactive examples.
                        </p>
                        <a href="http://localhost/LukeSwiderski/array-methods.php" class="btn btn-dark">Learn More</a>
                    </div>
                </div>
            </div>

            <!-- Weather App -->
            <div class="col-md-6">
                <div class="project-card">
                    <img src="./assets/Weather.jpg" alt="Weather App">
                    <div class="card-body">
                        <h2 class="project-title">Weather App</h2>
                        <p class="project-description">
                            Real-time weather information application using modern web technologies.
                        </p>
                        <a href="http://localhost/LukeSwiderski/weather-app.php" class="btn btn-dark">Learn More</a>
                    </div>
                </div>
            </div>

            <!-- This Website -->
            <div class="col-md-6">
                <div class="project-card">
                    <img src="./assets/this-website.jpg" alt="Portfolio Website">
                    <div class="card-body">
                        <h2 class="project-title">This Website</h2>
                        <p class="project-description">
                            A showcase of my web development skills using PHP, MySQL, and Bootstrap.
                        </p>
                        <a href="http://localhost/LukeSwiderski/this-site.php" class="btn btn-dark">Learn More</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include 'footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>