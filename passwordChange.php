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

  $oldPass = "";
  $newPass = "";
  $renewPass = "";
  $crudOb = new Crud();
  $result = $crudOb->oldPassValidate();
  $row = mysqli_fetch_array($result);
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["oldPass"])) {
      $oldPass = "Current Password Is Required";
    } elseif ($row["password"] != $_POST["oldPass"]) {
      $oldPass = "Current Password Is Not Right";
    } elseif (empty($_POST["newPass"])) {
      $newPass = "Please Enter Your Password";
    } elseif (empty($_POST["renewPass"])) {
      $renewPass = "Please Re-Enter Your Password Correct";
    } elseif ($_POST["renewPass"] != $_POST["newPass"]) {
      $renewPass = "Please Re-Enter Your Password Correctly";
    } else {

      $crudOb = new Crud();
      $crudOb->changePassword();
    }
  }
  ?>

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
                  <div class="dropdown-divider"></div>
                  <a href="logoutsession.php" class="dropdown-item">Logout</a>
                </div>
              </li>
            </ul>
          </div>
        </nav>
        <h1>Change Your Password</h1>
        <p>Here You can Change Your Password!</p>
      </div>

      <form method="post">
        <div class="form-group">
          <label for="oldPass">Your Current Password</label>
          
          <input type="password" name="oldPass" class="form-control" autocomplete="off" value="<?php echo isset($_POST['oldPass']) ? htmlspecialchars($_POST['oldPass'], ENT_QUOTES) : ''; ?>">
          <span class="error">* <?php echo $oldPass; ?></span>
        </div>
        <div class="form-group">
          <label for="newPass">Enter Your New Password</label>
          <input type="password" name="newPass" class="form-control" autocomplete="off" value="<?php echo isset($_POST['newPass']) ? htmlspecialchars($_POST['newPass'], ENT_QUOTES) : ''; ?>">
          <span class="error">* <?php echo $newPass; ?></span>


        </div>
        <div class="form-group">
          <label for="renewPass">Re- Enter Your Password Correctly</label>
          <input type="password" name="renewPass" class="form-control" autocomplete="off" value="<?php echo isset($_POST['renewPass']) ? htmlspecialchars($_POST['renewPass'], ENT_QUOTES) : ''; ?>">
          <span class="error">* <?php echo $renewPass ?> </span>

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
