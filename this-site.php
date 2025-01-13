<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="main.css">
    <title>Current Website Implementation - Luke Swiderski</title>
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
    </style>
</head>
<body>
    <?php include 'header.php'; ?>

    <div class="container">
        <div class="project-section">
            <h1 class="display-4 mb-4">Current Website Implementation</h1>
            <p class="lead">A modern full-stack website featuring secure authentication, email management system, interactive dashboard, and dynamic content management.</p>
            
            <img src="./assets/this-website.jpg" alt="Website Dashboard Interface" class="demo-screenshot">

            <div class="row mt-5">
                <div class="col-md-6">
                    <h2>Key Features</h2>
                    <ul class="list-unstyled">
                        <li>✓ Secure user authentication system</li>
                        <li>✓ Interactive tech stack showcase</li>
                        <li>✓ Email management dashboard</li>
                        <li>✓ Venue management system</li>
                        <li>✓ Secure contact form with Cloudflare protection</li>
                        <li>✓ Photo management functionality</li>
                        <li>✓ Session management and security</li>
                        <li>✓ Responsive design implementation</li>
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
                        <span class="tech-stack">Cloudflare Turnstile</span>
                        <span class="tech-stack">PDO</span>
                        <span class="tech-stack">Fetch API</span>
                    </div>
                </div>
            </div>

            <div class="mt-5">
                <h2>Core Components</h2>
                
                <h4 class="mt-4">Authentication System</h4>
                <p>Features secure session management, password hashing, and protection against session hijacking. Implements strict session cookie parameters and regular session ID regeneration for enhanced security.</p>

                <h4 class="mt-4">Dashboard Interface</h4>
                <p>A comprehensive admin panel providing venue management, email list management, and message composition functionality. Includes real-time updates using fetch and dynamic content loading.</p>

                <h4 class="mt-4">Email System</h4>
                <p>Implements PHPMailer for reliable email delivery, manages subscriber lists through MySQL, and includes status tracking. Features customizable templates and automated message generation for venue announcements.</p>

                <h4 class="mt-4">Contact Form</h4>
                <p>Protected by Cloudflare Turnstile for spam prevention, implements secure email handling, and includes input validation. Uses environment variables for sensitive configuration.</p>

                <h4 class="mt-4">Tech Stack Showcase</h4>
                <p>Interactive display of technical skills with detailed descriptions, implemented using vanilla JavaScript for smooth user interaction and dynamic content loading.</p>
            </div>

            <div class="mt-5">
                <h2>Technical Details</h2>
                <ul>
                    <li>PDO database abstraction for secure MySQL interactions</li>
                    <li>Prepared statements to prevent SQL injection</li>
                    <li>XSS protection through proper output escaping</li>
                    <li>MVC-like architecture separating concerns</li>
                    <li>Responsive design using Bootstrap framework</li>
                    <li>Custom JavaScript modules for specific functionality</li>
                    <li>Environment variable management for sensitive data</li>
                    <li>Error logging and handling system</li>
                </ul>
            </div>

            <div class="mt-5">
                <h2>Project Links</h2>
                <div class="d-flex gap-3">
                    <a href="https://github.com/LukeSwiderski/portfolioSite/tree/working-version" class="btn btn-dark">View on GitHub</a>
                </div>
            </div>
        </div>
    </div>

    <?php include 'footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>