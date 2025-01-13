<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="main.css">
    <title>Weather App - Luke Swiderski</title>
    <style>
        .project-section {
            padding: 4rem 0;
        }
        .tech-stack {
            display: inline-block;
            padding: 0.5rem 1rem;
            margin: 0.5rem;
            background-color: #f8f9fa;
            border-radius: 20px;
            font-size: 0.9rem;
        }
        .demo-screenshot {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
            margin: 1rem 0;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            display: block;
            margin-left: auto;
            margin-right: auto;
            width: 1000px;
        }

        #demo-video {
          padding: 60px 0;
        }

        #demo-video .ratio {
          box-shadow: 0 4px 8px rgba(0,0,0,0.1);
          border-radius: 8px;
          overflow: hidden;
        }
    </style>
</head>
<body>
    <?php include 'header.php'; ?>

    <div class="container">
        <div class="project-section">
            <h1 class="display-4 mb-4">Weather App</h1>
            <p class="lead">A full-stack weather application built with Node.js and Express, integrating multiple external APIs for comprehensive weather data.</p>
            
            <img src="./assets/Weather.jpg" alt="Weather App Interface" class="demo-screenshot">

            <div class="row mt-5">
                <div class="col-md-6">
                    <h2>Features</h2>
                    <ul class="list-unstyled">
                        <li>✓ Real-time weather data retrieval</li>
                        <li>✓ Location-based forecasts using geocoding</li>
                        <li>✓ Multiple API integration</li>
                        <li>✓ Server-side processing</li>
                        <li>✓ Responsive user interface</li>
                    </ul>
                </div>
                <div class="col-md-6">
                    <h2>Tech Stack</h2>
                    <div>
                        <span class="tech-stack">Node.js</span>
                        <span class="tech-stack">Express</span>
                        <span class="tech-stack">Position Stack API</span>
                        <span class="tech-stack">Tomorrow.io API</span>
                        <span class="tech-stack">RESTful APIs</span>
                    </div>
                </div>
            </div>

            <div class="mt-5">
                <h2>Project Description</h2>
                <p>This weather application was developed as a learning project to explore Node.js and Express framework capabilities. It demonstrates the implementation of a full-stack application with multiple API integrations.  I was originally following a tutorial I found online, but soon discovered the APIs used in the tutorial no loner existed.  So I had to find and implement the data sources on my own.</p>
                
                <p>Key technical aspects include:</p>
                <ul>
                    <li>Integration of Position Stack API for precise location geocoding</li>
                    <li>Weather data retrieval using Tomorrow.io API</li>
                    <li>Backend server implementation with Express</li>
                    <li>Multiple API endpoint handling and data processing</li>
                    <li>Asynchronous JavaScript operations</li>
                </ul>

                <p>This project served as a practical introduction to building full-stack applications, handling API integrations, and managing server-side operations.</p>
            </div>

            <div class="mt-5">
                <h2>Project Links</h2>
                <div class="d-flex gap-3">
                    <a href="https://github.com/LukeSwiderski/Node-weather-website" class="btn btn-dark">View on GitHub</a>
                    <a href="https://sunny-mulberry-brachiosaurus.glitch.me/" class="btn btn-primary">Try Live Demo</a>
                </div>
            </div>
        </div>
    </div>

    <?php include 'footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>