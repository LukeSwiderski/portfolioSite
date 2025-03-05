<?php
  require_once 'includes/config_session.inc.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="main.css">
    <title>About Me - Luke Swiderski</title>
    <style>
      section {
        padding: 60px 0;
      }
      
      .about-image {
        width: 100%;
        max-width: 500px;
        height: auto;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        margin-bottom: 2rem;
      }

      @media (max-width: 768px) {
        .about-image {
          max-width: 100%;
          margin-left: auto;
          margin-right: auto;
          display: block;
        }
      }

      .section-content {
        margin-bottom: 2rem;
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
                    <h1 class="display-4 fw-bold">About Me</h1>
                    <p>Beyond coding and development, I'm a musician, lifelong learner, and enthusiast of many things. Here's a bit more about who I am outside of programming.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Music Section -->
    <section id="music">
        <div class="container-lg">
            <div class="row align-items-center">
                <div class="col-md-6 section-content">
                    <h2 class="fw-bold mb-4">Music & Performance</h2>
                    <p>Music has been a central part of my life since I was young. I've spent years performing as a musician, specializing in blues and classic rock. This creative outlet not only brings me joy but also influences how I approach problem-solving in software development - both require a balance of technical skill and creative expression.</p>
                    <p>I regularly perform at local venues, collaborating with other musicians and building a community through music. These experiences have taught me the value of practice, improvisation, and working harmoniously with others - skills that translate surprisingly well to coding and team projects.</p>
                </div>
                <div class="col-md-6">
                    <img src="http://lukeswiderski.com/test-photos/LukeAtBackPorch.jpg" alt="Luke performing music" class="about-image">
                </div>
            </div>
        </div>
    </section>

    <!-- Learning & Growth Section -->
    <section id="learning" class="bg-light">
        <div class="container-lg">
            <div class="row align-items-center">
                <div class="col-md-6 order-md-2 section-content">
                    <h2 class="fw-bold mb-4">Continuous Learning</h2>
                    <p>My journey from music to software development exemplifies my passion for learning and growth. I believe in the power of continuous education and challenging myself to master new skills. This mindset led me to explore programming and eventually transition into tech while maintaining my musical pursuits.</p>
                    <p>I'm particularly interested in the intersection of creativity and technology, always looking for ways to merge these two worlds. Whether it's creating music-related applications or finding creative solutions to technical challenges, I enjoy bringing different aspects of my experience together.</p>
                </div>
                <div class="col-md-6 order-md-1">
                    <img src="http://lukeswiderski.com/test-photos/luke-laptop.jpg" alt="Luke at work" class="about-image">
                </div>
            </div>
        </div>
    </section>

    <!-- Saltwater Fishing -->
    <section id="fishing">
        <div class="container-lg">
            <div class="row align-items-center">
                <div class="col-md-6 section-content">
                    <h2 class="fw-bold mb-4">Saltwater Fishing</h2>
                    <p>When not programming or playing music, you'll find me somewhere on the Florida coast with a line in the water!</p>
                    <p>Whether surf-casting the Atlantic, cruising the Gulf marsh in my mudboat, or just lip grippin some golf-course large-mouth, I love it all!  Say, what's the tide doing right now?</p>
                </div>
                <div class="col-md-6">
                    <img src="http://lukeswiderski.com/test-photos/luke-fishing.jpg" alt="Luke fishing at the beach" class="about-image">
                </div>
            </div>
        </div>
    </section>

    <?php include 'footer.php'; ?>
    
    <script src="app.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>