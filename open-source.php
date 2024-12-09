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
    <title>Open Source Contributions - Luke Swiderski</title>
    <style>
      .project-card {
        border: 1px solid rgba(0,0,0,0.1);
        border-radius: 8px;
        margin-bottom: 2rem;
      }

      .project-card img {
        width: 100%;
        height: 300px;
        object-fit: cover;
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
                    <h1 class="display-4 fw-bold">Open Source Contributions</h1>
                    <p>A showcase of my contributions to major open source projects including Mozilla Firefox and Google Chrome.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Projects Grid -->
    <div class="project-grid">
        <div class="row g-4">
            <!-- DOM Mutation Breakpoints -->
            <div class="col-md-6">
                <div class="project-card">
                    <img src="./assets/open-source/DOM.jpg" alt="DOM Mutation Breakpoints">
                    <div class="card-body">
                        <h2 class="project-title">DOM Mutation Breakpoints Icon</h2>
                        <p class="project-description">
                            Added an icon to indicate when DOM mutation breakpoints are disabled in the Firefox debugger inspector.
                        </p>
                        <div class="d-flex gap-2">
                            <a href="https://bugzilla.mozilla.org/show_bug.cgi?id=1581213" class="btn btn-dark">View Bug</a>
                            <a href="https://phabricator.services.mozilla.com/D157122" class="btn btn-outline-dark">View Code</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Event Listener Breakpoints -->
            <div class="col-md-6">
                <div class="project-card">
                    <img src="./assets/open-source/keyboardEvents.jpg" alt="Event Listener Breakpoints">
                    <div class="card-body">
                        <h2 class="project-title">Keyboard Composition Events</h2>
                        <p class="project-description">
                            Added keyboard composition events to the Firefox debugger's event listener breakpoints system.
                        </p>
                        <div class="d-flex gap-2">
                            <a href="https://bugzilla.mozilla.org/show_bug.cgi?id=1764248" class="btn btn-dark">View Bug</a>
                            <a href="https://phabricator.services.mozilla.com/D153627" class="btn btn-outline-dark">View Code</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Breakpoints Pane -->
            <div class="col-md-6">
                <div class="project-card">
                    <img src="./assets/open-source/breakpoints.jpg" alt="Breakpoints Pane Fix">
                    <div class="card-body">
                        <h2 class="project-title">Breakpoints Pane Behavior</h2>
                        <p class="project-description">
                            Fixed unexpected breakpoints pane expansion when selecting callstack frames or toggling event listener breakpoints.
                        </p>
                        <div class="d-flex gap-2">
                            <a href="https://bugzilla.mozilla.org/show_bug.cgi?id=1696157" class="btn btn-dark">View Bug</a>
                            <a href="https://phabricator.services.mozilla.com/D149994" class="btn btn-outline-dark">View Code</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Add/Edit Log Scrolling -->
            <div class="col-md-6">
                <div class="project-card">
                    <img src="./assets/open-source/scrollToLog.jpg" alt="Log Point Scrolling">
                    <div class="card-body">
                        <h2 class="project-title">Log Point Line Scrolling</h2>
                        <p class="project-description">
                            Implemented automatic scrolling to bring breakpoint lines into view when adding or editing log points from the sidebar.
                        </p>
                        <div class="d-flex gap-2">
                            <a href="https://bugzilla.mozilla.org/show_bug.cgi?id=1695896" class="btn btn-dark">View Bug</a>
                            <a href="https://phabricator.services.mozilla.com/D146202" class="btn btn-outline-dark">View Code</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Breakpoints Pane Stepping -->
            <div class="col-md-6">
                <div class="project-card">
                    <img src="./assets/open-source/resumeStepping.jpg" alt="Breakpoints Pane Stepping Fix">
                    <div class="card-body">
                        <h2 class="project-title">Breakpoints Pane During Stepping</h2>
                        <p class="project-description">
                            Fixed the breakpoints pane unexpectedly expanding when stepping or resuming the debugger.
                        </p>
                        <div class="d-flex gap-2">
                            <a href="https://bugzilla.mozilla.org/show_bug.cgi?id=1755337" class="btn btn-dark">View Bug</a>
                            <a href="https://phabricator.services.mozilla.com/D149994" class="btn btn-outline-dark">View Code</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Debugger Line -->
            <div class="col-md-6">
                <div class="project-card">
                    <img src="./assets/open-source/inlinePreview.jpg" alt="Debugger Line Fix">
                    <div class="card-body">
                        <h2 class="project-title">Inline Preview Overlap</h2>
                        <p class="project-description">
                            Resolved issues with inline previews overlapping the debugger line in the Firefox editor.
                        </p>
                        <div class="d-flex gap-2">
                            <a href="https://bugzilla.mozilla.org/show_bug.cgi?id=1576192" class="btn btn-dark">View Bug</a>
                            <a href="https://phabricator.services.mozilla.com/D69397" class="btn btn-outline-dark">View Code</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Chrome Settings -->
            <div class="col-md-6">
                <div class="project-card">
                    <img src="./assets/open-source/chromeSettings.jpg" alt="Chrome Settings Fix">
                    <div class="card-body">
                        <h2 class="project-title">Chrome DevTools Settings</h2>
                        <p class="project-description">
                            Fixed overlapping elements in the Chrome DevTools debugger settings interface.
                        </p>
                        <div class="d-flex gap-2">
                            <a href="https://bugs.chromium.org/p/chromium/issues/detail?id=1133677" class="btn btn-dark">View Bug</a>
                            <a href="https://chromium-review.googlesource.com/c/devtools/devtools-frontend/+/2491926" class="btn btn-outline-dark">View Code</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include 'footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>