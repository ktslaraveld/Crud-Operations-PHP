<?php require("crud.php");
if (isset($_SESSION['emailAddress'])) { ?>
  <html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
  </head>
  <?php

  $fullnameer = "";
  $emailer = "";
  $mobileer = "";
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["full_name"])) {
      $fullnameer = "Your Full Name Is Required";
    } elseif (empty($_POST["mobile_number"])) {
      $mobileer = "Mobile Number is required";
    } elseif (!is_numeric($_POST["mobile_number"])) {
      $mobileer = "Please Enter The Numerical Value Only";
    } elseif (empty($_POST["email_address"])) {
      $emailer = "Email is required";
    } elseif (!filter_var($_POST["email_address"], FILTER_VALIDATE_EMAIL)) {
      $emailer = "Please Enter The Valid Email Address";
      // $error="Invalid email format.Please Enter Valid Email Address"    
    } else {
      $crudOb = new Crud();
      $crudOb->updateProfile();
    }
  }
  ?>
  <?php
  $crudOb = new Crud();
  $result = $crudOb->editProfile();
  $i = 0;
  $row = mysqli_fetch_array($result); ?>

  <body>
    <div class="container">
      <div class="jumbotron text-center">
        <nav class="navbar navbar-expand-md navbar-light bg-light">

          <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div id="navbarCollapse" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
              <li class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Manage Records</a>
                <div class="dropdown-menu">
                  <a href="addCountry.php" class="dropdown-item">Add Record</a>
                  <a href="viewCountry.php" class="dropdown-item">View Record</a>

                </div>
              </li>
            </ul>
            <ul class="nav navbar-nav ml-auto">
              <li class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown"><?php echo $_SESSION["emailAddress"] ?></a>
                <div class="dropdown-menu dropdown-menu-right">
                  <a href="editProfile.php" class="dropdown-item">Edit Profile</a>
                  <a href="passwordChange.php" class="dropdown-item">Change Password</a>
                  <div class="dropdown-divider"></div>
                  <a href="logoutsession.php" class="dropdown-item">Logout</a>
                </div>
              </li>
            </ul>
          </div>
        </nav>
        <h1>EDIT Your Profile</h1>
        <p>Here You can Edit Your Profile</p>
      </div>

      <form method="post">
        <div class="form-group">
          <label for="full_name">Your Name:</label>
          <input type="hidden" name="register_id" class="form-control" value="<?php echo $row['register_id']; ?>">
          <input type="text" name="full_name" class="form-control" value="<?php echo $row['full_name']; ?>">
          <span class="error">* <?php echo $fullnameer; ?></span>
        </div>
        <div class="form-group">
          <label for="mobile_number">Mobile Number:</label>
          <input type="text" name="mobile_number" class="form-control" value="<?php echo $row['mobile_number']; ?>">
          <span class="error">* <?php echo $mobileer; ?></span>


        </div>
        <div class="form-group">
          <label for="email_address">Email:</label>
          <input type="text" name="email_address" class="form-control" value="<?php echo $row['email_address']; ?>">
          <span class="error">* <?php echo $emailer ?> </span>

        </div>
        <div class="form-group">
          <input type="submit" class="btn btn-primary" name="submit" value="Save Profile">
        </div>
      </form>
    </div>

    
    <!-- Script Start -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <!-- Script End  -->

  </body>

  </html>
<?php } else {

  header('Location:login.php');
}
