<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Bootstrap -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="main.css">
   <!-- Font Awesome -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Devicon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/devicon@2.10.1/devicon.min.css">
  <title>Luke Swiderski</title>
  <style>
    section{
      padding: 60px 0;
    }
  </style>
</head>
<body>

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
            <a href="#" class="fw-bold nav-link">Home</a>
          </li>
          <li class="nav-item">
            <a href="#about" class="fw-bold nav-link">About</a>
          </li>
          <li class="nav-item">
            <a href="#tech" class="fw-bold nav-link">Tech</a>
          </li>
          <li class="nav-item">
            <a href="#contact" class="fw-bold nav-link">Projects</a>
          </li>
          <li class="nav-item">
            <a href="#contact" class="fw-bold nav-link">Contact</a>
          </li>
          <li class="nav-item">
            <a href="#pricing" class="fw-bold nav-link">Resume</a>
          </li>
          <li class="nav-item">
            <a href="#pricing" class="fw-bold nav-link">Login</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
<!-- Main hero section -->
<section class="bg-light" id="hero">
  <div class="container-lg">
    <div class="row align-items-center">
      <div class="col-md-5 text-center text-md-start offset-md-1 mt-md-5">
        <h1 class="display-4 fw-bold">Software Developer</h1>
        <p>I'm Luke, a<strong> full-stack software developer </strong>working on web-apps, websites, and open-source projects such as <strong>Mozilla Firefox</strong>  and <strong>Google Chrome</strong>. </p>
        <a href="#projects" class="btn btn-dark btn-lg">View my work</a>
      </div>
    </div>
  </div>
</section>

<!-- About Me Section -->

<section id="about">
  <div class="container-lg mt-5">
    <div class="row align-items-center">
      <div class="col-md-5 text-center text-md-start offset-md-1 mt-md-5">
        <span>HEY, I'M LUKE 👋</span>
        <h2 class="fw-bold">About Me</h2>
        <p>I started programming in 2018 and have worked on websites for people, businesses, and myself.  I've made apps to make my own life easier and I've worked on open-source projects like Mozilla Firefox and Google Chrome, successfully fixing numerous bugs.</p>
        <a href="#About" class="btn btn-dark btn-lg">More about me</a>
      </div>
      <div class="col-md-5 text-center d-md-block">
        <img class="img-fluid rounded-4 mt-4" src="./assets/working.png" alt="Luke working">
      </div>
    </div>
  </div>
</section>

<!-- Tech Stack Section -->

<section id="tech" class="bg-light">
<div class="container-lg mt-3">
  <div class="text-center align-items-center justify-content-center">
      <h1 class="fw-bold">Tech Stack</h1>
      <p>Click for details</p>
  </div>
  <div id="cardRow" class="card-row">
    <!-- Cards get populated here -->
  </div>
  <div id="tech-paragraph" class="ml-5 mt-3">
    <!-- paragraph gets populated here -->
  </div>
</div>
</section>

<!-- Contact section -->

<section id="contact">
  <div class="text-center">
    <h1 class="fw-bold">Contact</h1>
    <div class="text-success mt-3 display-6" id="success-message">
      <!-- success-message -->
    </div>
  </div>
  <div id="contactFormParent" class="row justify-content-center my-5">
    <div class="col-lg-6">
      <form id="contactForm" action="contactform.php" method="POST">
        <label for="email" class="form-label">Email address:</label>
        <div class="mb-4 input-group">
          <span class="input-group-text">
            <i class="bi bi-envelope-fill"></i>
          </span>
          <input type="email" name="email" class="form-control" id="email" placeholder="e.g. yourname@example.com" required>
        </div>

        <label for="name" class="form-label">Name:</label>
        <div class="input-group mb-4">
          <span class="input-group-text">
            <i class="bi bi-person-fill"></i>
          </span>
          <input type="text" name="name" class="form-control" id="name" placeholder="e.g. John" required>
        </div>

        <label for="subject" class="form-label">Subject:</label>
        <div class="input-group mb-4">
          <span class="input-group-text">
            <i class="bi bi-tag-fill"></i>
          </span>
          <input type="text" name="subject" class="form-control" id="subject" placeholder="e.g. Feedback, Question, etc." required>
        </div>

        <div class="form-floating mb-4 mt-5">
          <textarea class="form-control" name="message" id="message" style="height: 140px" required></textarea>
          <label for="message">Your message...</label>
        </div>
        <div class="mb-4 text-center">
          <button class="btn btn-dark" type="submit">Send</button>
        </div>
      </form>
    </div>
  </div>
</section>

<script src="app.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>