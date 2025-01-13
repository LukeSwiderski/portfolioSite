<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="main.css">
    <title>Array Methods From Scratch - Luke Swiderski</title>
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
    </style>
</head>
<body>
    <?php include 'header.php'; ?>

    <div class="container">
        <div class="project-section">
            <h1 class="display-4 mb-4">Array Methods From Scratch</h1>
            <p class="lead">A deep dive into JavaScript fundamentals through implementing array methods from the ground up, using Test Driven Development principles.</p>
            
            <img src="./assets/Array-Methods.jpg" alt="Array Methods Project" class="demo-screenshot">

            <div class="row mt-5">
                <div class="col-md-6">
                    <h2>Features</h2>
                    <ul class="list-unstyled">
                        <li>✓ Custom implementations of core array methods</li>
                        <li>✓ Comprehensive test coverage using TinyTest</li>
                        <li>✓ Edge case handling based on MDN documentation</li>
                        <li>✓ Thorough documentation of each method</li>
                        <li>✓ Test-driven development approach</li>
                    </ul>
                </div>
                <div class="col-md-6">
                    <h2>Tech Stack</h2>
                    <div>
                        <span class="tech-stack">JavaScript</span>
                        <span class="tech-stack">TinyTest</span>
                        <span class="tech-stack">Test Driven Development</span>
                        <span class="tech-stack">MDN Web Docs</span>
                    </div>
                </div>
            </div>

            <div class="mt-5">
                <h2>Project Description</h2>
                <p>This project was a foundational learning experience in my programming journey, where I rebuilt JavaScript's native array methods from scratch. Using TinyTest, a lightweight testing framework, I ensured each implementation matched the official MDN documentation specifications.</p>
                
                <p>The project taught me several key programming concepts:</p>
                <ul>
                    <li>Deep understanding of JavaScript array operations</li>
                    <li>Test-Driven Development methodology</li>
                    <li>Edge case handling and robust error checking</li>
                    <li>Reading and implementing from technical documentation</li>
                    <li>Writing maintainable and well-tested code</li>
                </ul>

                <p>This exercise marked a significant milestone in my development journey, being the point where I first felt truly competent in writing code. The process of considering all possible edge cases while adhering to official documentation helped establish solid programming practices that I continue to use today.</p>
            </div>

            <div class="mt-5">
                <h2>Project Links</h2>
                <div class="d-flex gap-3">
                    <a href="https://github.com/LukeSwiderski/arrayTests/tree/master/example" class="btn btn-dark">View on GitHub</a>
                </div>
            </div>
        </div>
    </div>

    <?php include 'footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>