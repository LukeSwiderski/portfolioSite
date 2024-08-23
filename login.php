<?php
  ini_set('display_errors', 1);
  error_reporting(E_ALL);

  require_once 'includes/config_session.inc.php';
  require_once 'includes/login_view.inc.php';
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="main.css">
    <title>Login</title>
    <style>
      section{
        padding: 60px 0;
        height: 80vh;
      }


    </style>
  </head>
  <body>
    <?php include 'nav.php'; ?>
    

    <!-- Login section -->

    <section id="login">
      <div class="text-center">
        <h1 class="fw-bold">Login</h1>
      </div>
      <div id="loginFormParent" class="row justify-content-center my-5">
        <div class="col-md-4">
          <form id="loginForm" action="includes/login.inc.php" method="POST">
            <label for="username" class="form-label">Username</label>
            <div class="mb-4 input-group">
              <span class="input-group-text">
                <i class="bi"></i>
              </span>
              <input type="text" name="username" class="form-control" id="username" required>
            </div>

            <label for="name" class="form-label">Password</label>
            <div class="input-group mb-4">
              <span class="input-group-text">
                <i class="bi"></i>
              </span>
              <input type="password" name="password" class="form-control" id="password" required>
            </div>
            <div class="mb-4 text-center">
              <button class="btn btn-dark" type="submit">Submit</button>
            </div>
          </form>
        </div>
      </div>
    </section>

    <?php
    check_login_errors();
    ?>
    
    <!-- Footer -->
    <footer>
  <div id="footer" class="text-center bg-secondary text-light align-items-center">
    <p>Copyright © <span id="copyright-year"></span> Luke Swiderski</p>
  </div>
</footer>

    <script src="app.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>