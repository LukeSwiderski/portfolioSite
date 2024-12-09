<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="main.css">
    <title>Email Service - Luke Swiderski</title>
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
    </style>
</head>
<body>
    <?php include 'header.php'; ?>

    <div class="container">
        <div class="project-section">
            <h1 class="display-4 mb-4">Email Service Project</h1>
            <p class="lead">A custom email management system for musicians to communicate with their audience.</p>
            
            <img src="/assets/dashboard.jpg" alt="Email Service Dashboard" class="demo-screenshot">

            <div class="row mt-5">
                <div class="col-md-6">
                    <h2>Features</h2>
                    <ul class="list-unstyled">
                        <li>✓ Automated email generation for gig announcements</li>
                        <li>✓ Subscriber list management</li>
                        <li>✓ Venue database integration</li>
                        <li>✓ Template-based email composition</li>
                        <li>✓ Photo attachment capabilities</li>
                    </ul>
                </div>
                <div class="col-md-6">
                    <h2>Tech Stack</h2>
                    <div>
                        <span class="tech-stack">PHP</span>
                        <span class="tech-stack">MySQL</span>
                        <span class="tech-stack">JavaScript</span>
                        <span class="tech-stack">Bootstrap</span>
                        <span class="tech-stack">PHPMailer</span>
                    </div>
                </div>
            </div>

            <div class="mt-5">
                <h2>Project Links</h2>
                <div class="d-flex gap-3">
                    <a href="https://github.com/LukeSwiderski/portfolioSite/tree/working-version" class="btn btn-dark">View on GitHub</a>
                    <a href="http://localhost/LukeSwiderski/demo/demo.php" class="btn btn-primary">Try Live Demo</a>
                </div>
            </div>
        </div>
    </div>

    <?php include 'footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>