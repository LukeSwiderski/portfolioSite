<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="main.css">
    <title>Dashboard</title>
    <style>
      section{
        padding: 60px 0;
      }
    </style>
  </head>
</head>
<body>
  <?php 
    session_start();
    include 'header.php'; 
    if (!isset($_SESSION['username'])) {
      header('Location: login.php');
      exit;
    }
  ?>

  <h2 class="fw-bold text-center">Dashboard</h2>

  <!-- Message section -->

  <section id="message">
      <div class="text-center">
        <h1 class="fw-bold">Message</h1>
      </div>
      <div id="messageFormParent" class="row justify-content-center my-5">
        <div class="col-md-4">
        <div class="row mb-4">
                <div class="col-md-2">
                    <label for="dropdown1" class="form-label fw-bold">Venues</label>
                    <select class="form-select" name="dropdown1">
                        <option value="">The Back Porch</option>
                        <option value="option1">Cody's Sumter</option>
                        <option value="option2">Edna's</option>
                        <option value="option3">Holy Sh'mokes</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <label for="dropdown1" class="form-label fw-bold">Month</label>
                    <select class="form-select" name="dropdown2">
                        <option value="">Jan</option>
                        <option value="option1">Option 1</option>
                        <option value="option2">Option 2</option>
                        <option value="option3">Option 3</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <label for="dropdown1" class="form-label fw-bold">Date</label>
                    <select class="form-select" name="dropdown3">
                        <option value="">Select Option 3</option>
                        <option value="option1">Option 1</option>
                        <option value="option2">Option 2</option>
                        <option value="option3">Option 3</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <label for="dropdown1" class="form-label fw-bold">Start</label>
                    <select class="form-select" name="dropdown4">
                        <option value="">Select Option 4</option>
                        <option value="option1">Option 1</option>
                        <option value="option2">Option 2</option>
                        <option value="option3">Option 3</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <label for="dropdown1" class="form-label fw-bold">End</label>
                    <select class="form-select" name="dropdown5">
                        <option value="">Select Option 5</option>
                        <option value="option1">Option 1</option>
                        <option value="option2">Option 2</option>
                        <option value="option3">Option 3</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <label for="dropdown1" class="form-label fw-bold">Message</label>
                    <select class="form-select" name="dropdown6">
                        <option value="">Select Option 6</option>
                        <option value="option1">Option 1</option>
                        <option value="option2">Option 2</option>
                        <option value="option3">Option 3</option>
                    </select>
                </div>
            </div>
          <form id="messageForm" action="includes/message.inc.php" method="POST">
            <label for="name" class="form-label"></label>
            <div class="input-group mb-4 justify-content-center">
              <span class="input-group-text">
                <i class="bi"></i>
              </span>
              <textarea name="description" rows="5" cols="60"></textarea>
            </div>
            <div class="mb-4 text-center">
              <button class="btn btn-dark" type="submit">Preview</button>
              <button class="btn btn-dark" type="submit">Submit</button>
              <button class="btn btn-dark" type="submit">Clear</button>
            </div>
          </form>
        </div>
      </div>
    </section>

</body>
</html>