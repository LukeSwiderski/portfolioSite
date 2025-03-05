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
    
    <!-- Open Source Journey Section -->
    <div id="article" class="project-grid">
      <h2 class="text-center fw-bold mb-4">My Open Source Journey</h2>
      
      <div class="mb-5">
        <p>Open source projects are a great way to gain real world experience. From setting up the development environment, learning a complex code base, to writing tests and figuring out merge conflicts, it necessitates all the skills required to work in a real world development team. This is the reason I chose to endeavor in open source.</p>
        
        <div class="collapse" id="journeyCollapse">
          
          <p>I originally chose Firefox because someone else I knew had some success writing patches. When I first looked at the documentation, I was pretty intimidated. There was a lot of terminology I wasn't familiar with, and a lot of technical dependencies that were very foreign to me.</p>
          
          <h3 class="mt-4 mb-3">First Steps and Challenges</h3>
          <p>Eventually I got the development environment up and running. Known bugs in the debugger software are posted publicly by Firefox. Just looking through the bug list and understanding what would be an appropriate choice for a beginner is a daunting task in itself. I decided to look for CSS bugs, because they might be simple, and might not require writing a test to go along with the patch. I made a list of possibly appropriate bugs and whittled it down from there.</p>
                            
          <h3 class="mb-3 mt-4">My First Bug Fix</h3>
          <p>The first bug I worked on involved some lines of text overlapping each other in the debugger. I learned how to make small changes, build Nightly, which is the developer version of the Firefox browser, and then view my changes in a freshly built version. After making what looked like the correct changes to fix the problem, I was ready to submit my patch.</p>
          
          <p>I was quite afraid submitting my first patch. What if it is wrong, or what if it doesn't submit properly? Is my commit message written properly? I didn't want to inconvenience the maintainers. Fortunately, my patch went through, and after some minor back and forth with the maintainer, my patch was accepted and merged into the code base.</p>
          
          <h3 class="mb-3 mt-4">Taking on JavaScript Bugs</h3>
          <p>Next I wanted to tackle a bug that involved JavaScript. Once again, I looked at the available bugs posted, made a list of possible candidates, and then ranked each bug by what would be the most simple. Unfortunately I erred in this estimation and spent about a month investigating a bug that was not skill appropriate for me.</p>
          
          <p>I was very comfortable with vanilla JavaScript at this time but not familiar with React or Redux, which the debugger uses extensively. To diagnose bugs in the debugger, you basically run the debugger on the debugger. The debugger is written in JavaScript and uses React for components and Redux to control the flow of data. I spent some time learning about React and Redux and was able to glean a lot about this particular bug, but a fix worthy of submitting continued to elude me.</p>

          <h3 class="mb-3 mt-4">Learning to Write Tests</h3>
          <p>I decided to go back to my bug list and found a bug that a lot of other "students" like myself had attempted to solve but gave up when confronted with writing tests. The code change to fix the bug was simple and already posted, but to submit the patch, automated "mochitests" were required, which are basically asynchronous functions that mimic a user using the debugger as intended. When you run them, it fires up a browser and you can see the mouse movements and all the GUI actions you might perform yourself.</p>
          
          <p>I thought, "If I can figure out how to write these tests, I can submit this patch, and be prepared to write more tests in the future for bugs whose code changes I figure out myself."</p>
          
          <p>Each debugger component has its own set of tests. So I was able to locate them in the code base and read the existing tests for that component. Unfortunately, it was completely opaque to me. The syntax was familiar, but what was happening in each test was not apparent.</p>
          
          <h3 class="mb-3 mt-4">Breaking Through Obstacles</h3>
          <p>I can see why so many others had given up at this point. I looked up the documentation for the mochitests. They describe what the tests do and are for, but the minutiae is not explained. I decided to look at every test in the debugger and make notes of which were the shortest. From there I was able to make small code changes and see what they did.</p>
          
          <p>I broke a lot of tests. I added lots of debugger statements and paused tests that were in the process of running, so I could stop and look around the GUI and see what they were doing. I spent several weeks doing this. After many instances, I began noticing patterns. I began to see familiar snippets that had been used in other tests, functions local to individual tests, and the general way the browser is manipulated inside the tests.</p>
          
          <h3 class="mb-3 mt-4">Writing My First Test</h3>
          <p>I started writing my own tests for my patch. I often would have to look up a similar test and borrow code for my own. At this point, I still didn't always understand the correct context of everything, but I was able to run the tests, pause them with debugger statements, and see if the browser was doing what I wanted. Often it was not, and I would spend a whole day trying to figure out how to make it do one small task.</p>
          
          <p>The other difficult issue was having an assertion fail and then having to figure out why. Gradually my first mochitest appeared to be working and all my assertions were passing. Before submitting, I brainstormed all the edge cases I could think of. When I couldn't come up with anymore I submitted my patch. The reviewer said it looked good and asked for one additional assertion, which I added, and my patch was landed! I felt very empowered by this patch. I had a long way to go still, but I didn't give up and I figured out how to write the tests on my own.</p>
          
          <h3 class="mb-3 mt-4">Tackling More Complex Bugs</h3>
          <p>The next bug I tackled involved the breakpoints pane expanding unexpectedly when selecting a call stack frame. It should remain closed, if the user has collapsed it. By reading the code and stepping through it with the debugger, I was able to understand why this was happening.</p>
          
          <p>I came up with two solutions that would fix the problem. Having read so many bugs, I realized there was a related bug. The breakpoints pane also expands unexpectedly when you click any of the "step" buttons. One solution made sense to me more than the other and would fix both bugs, so I decided to implement it.</p>
          
          <p>I realized that there were aspects of both React and Redux that I thought I understood, but really didn't. I had to spend some time making simple React Redux apps to better understand the flow of information. Once I did this, I was able to implement the solution. Then it was time to write tests. Empowered by my last bug, I drove right in. I still had days where I spent hours trying to figure out a small problem, but once again I was able to figure out the solution.</p>
          
          <h3 class="mb-3 mt-4">Growing Confidence</h3>
          <p>Though this account is brief, I worked on this bug for quite a while. Sometimes the maintainers are too busy to review your patch right away when you post it. I had a good deal of back and forth on this one. I wrote a lot of tests. I learned a lot about Redux and how data moves through the ecosystem.</p>
          
          <p>Eventually the maintainers approved my work and my patch landed. This bug empowered me to go back to the bug I failed to fix earlier on. Having some experience now, I wasn't as nervous to try different ideas. I ended up landing that patch and several others. I feel confident now to take on more difficult bugs.</p>
          
          <h3 class="mb-3 mt-4">Lessons Learned</h3>
          <p>Open source has taught me that I can solve problems in a complex code base. I can work within a team that has a defined system and succeed. I learned that everything might be hard at first, but through focus and persistence, you can figure it out!</p>
        </div>
        
        <div class="text-center mt-3">
          <button id="articleButton" class="btn btn-dark" type="button" data-bs-toggle="collapse" data-bs-target="#journeyCollapse" aria-expanded="false" aria-controls="journeyCollapse">
            Read Full Story
          </button>
        </div>
      </div>
    </div>


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
    <script>
      document.addEventListener('DOMContentLoaded', function() {
        const readMoreBtn = document.querySelector('[data-bs-target="#journeyCollapse"]');
        const journeyCollapse = document.getElementById('journeyCollapse');
        const journeySection = document.querySelector('.project-grid'); // Container element
        
        // Store the scroll position when collapsing
        let scrollPosition = 0;
        
        readMoreBtn.addEventListener('click', function() {
          // If we're about to collapse (it's currently shown)
          if (journeyCollapse.classList.contains('show')) {
            // Store current scroll position
            scrollPosition = window.scrollY;
          }
        });
        
        // After the collapse animation completes
        journeyCollapse.addEventListener('hidden.bs.collapse', function () {
          readMoreBtn.textContent = 'Read Full Story';
          
          // Restore the scroll position
          window.scrollTo({
            top: scrollPosition,
            behavior: 'instant' // Use 'smooth' for animated scrolling
          });
        });
        
        journeyCollapse.addEventListener('shown.bs.collapse', function () {
          readMoreBtn.textContent = 'Show Less';
        });
      });
    </script> 

</body>
</html>