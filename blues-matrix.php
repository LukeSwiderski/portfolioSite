<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="main.css">
    <title>Blues Matrix - Luke Swiderski</title>
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
            <h1 class="display-4 mb-4">Blues Matrix Project</h1>
            <p class="lead">An interactive web application designed to help musicians visualize and learn blues scale patterns through an innovative matrix interface.</p>

            <section id="demo-video" class="bg-light">
              <div class="container-lg">
                <div class="row justify-content-center">
                  <div class="col-lg-8">
                    <h2 class="text-center mb-4">Demo Video</h2>
                    <div class="ratio ratio-16x9">
                    <iframe 
                        src="https://www.youtube.com/embed/GvjNUynbQJ4"
                        title="Email Service Demo Video" 
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                        allowfullscreen>
                      </iframe>
                    </div>
                  </div>
                </div>
              </div>
            </section>

            <div class="row mt-5">
                <div class="col-md-6">
                    <h2>Features</h2>
                    <ul class="list-unstyled">
                        <li>✓ Interactive technique visualization</li>
                        <li>✓ Random pattern generation</li>
                        <li>✓ Customizable technique highlighting</li>
                        <li>✓ Multiple technique pattern support</li>
                        <li>✓ Beginner-friendly interface</li>
                    </ul>
                </div>
                <div class="col-md-6">
                    <h2>Tech Stack</h2>
                    <div>
                        <span class="tech-stack">HTML5</span>
                        <span class="tech-stack">CSS3</span>
                        <span class="tech-stack">JavaScript</span>
                    </div>
                </div>
            </div>

            <div class="mt-5">
                <h2>Project Description</h2>
                <p>The Blues Matrix is an educational tool designed to help musicians understand and visualize blues scale patterns. It presents chord progressions in a matrix format, making it easier to see the relationships between different notes and scale positions.</p>
                
                <p>This tool is particularly useful for:</p>
                <ul>
                    <li>Beginning musicians learning scale patterns</li>
                    <li>Intermediate players exploring new techniques</li>
                    <li>Teachers demonstrating chord progression concepts</li>
                    <li>Anyone interested in music theory visualization</li>
                </ul>
            </div>

            <div class="mt-5">
                <h2>Project Links</h2>
                <div class="d-flex gap-3">
                    <a href="https://github.com/LukeSwiderski/bluesMatrix" class="btn btn-dark">View on GitHub</a>
                    <a href="https://www.lukeswiderski.com/bluesMatrix/bluesMatrix.html" class="btn btn-primary">Try Live Demo</a>
                </div>
            </div>
        </div>
    </div>

    <?php include 'footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>