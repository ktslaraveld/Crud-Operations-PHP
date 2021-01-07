<?php require("crud.php");
if (isset($_SESSION['emailAddress'])) { ?>
  <html lang="en">

  <head>
    <title>Add Country</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
    <?php

    $contryerr = "";
    $condiserr = "";
    $nameerr = "";
    $gendererr = "";
    $moberr = "";
    $emailerr = "";
    $mobnumerr = "";
    $emailvalerr = "";
    $suberr = "";
    $fileerr = "";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      if (empty($_POST["countryName"])) {
        $contryerr = "Counrty Name is required";
      } elseif (empty($_POST["countryDiscription"])) {
        $condiserr = "Counrty Discription is required";
      } elseif (empty($_POST["name"])) {
        $nameerr = "Your Name is required";
      } elseif (empty($_POST["gender"])) {
        $gendererr = "Gender is required";
      } elseif (empty($_POST["mobilenumber"])) {
        $moberr = "Mobile Number is required";
      } elseif (!is_numeric($_POST["mobilenumber"])) {
        $mobnumerr = "Please Enter The Numerical Value Only";
      } elseif (empty($_POST["email"])) {
        $emailerr = "Email is required";
      } elseif (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        $emailvalerr = "Please Enter The Valid Email Address";
        // $error="Invalid email format.Please Enter Valid Email Address"    
      } elseif (empty($_POST["subject"])) {
        $suberr = "Atleast One Subject Should Be Selected:";
      } elseif (empty($_FILES['uploadImage']['name'])) {
        $fileerr = "Please Upload Image File Here";
      } else {
        $crudOb = new Crud();
        $crudOb->addCountry();
      }
    }
    ?>
    <div class="container">
      <!--   
<a href="logoutsession.php" class="btn btn-info btn-lg">
          <span class="glyphicon glyphicon-log-out"></span> Log out
        </a> -->
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
        <h1>Add Record Here</h1>
        <p>Here You can add the details and store them for future use!</p>
      </div>
      <form method="post" name="form" enctype="multipart/form-data">
        <div class="form-group">
          <label for="countryName">Add Country:</label>
          <input type="text" class="form-control" value="<?php echo isset($_POST['countryName']) ? htmlspecialchars($_POST['countryName'], ENT_QUOTES) : ''; ?>" placeholder="Enter The Country Name" name="countryName">
          <span class="error">* <?php echo $contryerr; ?></span>
        </div>
        <div class="form-group">
          <label for="countryDiscription">Country Discription:</label>
          <input type="text" class="form-control" value="<?php echo isset($_POST['countryDiscription']) ? htmlspecialchars($_POST['countryDiscription'], ENT_QUOTES) : ''; ?>" placeholder="Enter The Country Discription" name="countryDiscription">
          <span class="error">* <?php echo $condiserr; ?></span>
        </div>
        <div class="form-group">
          <label>Select State From Here:</label><br>
          <select class="form-control" name="stateName">

            <option class="form-control" value="gujarat">Gujarat</option>
            <option class="form-control" value="rajasthan">Rajasthan</option>
          </select>
        </div>
        <div class="form-group">
          <label for="name">Your Name:</label>
          <input type="text" class="form-control" value="<?php echo isset($_POST['name']) ? htmlspecialchars($_POST['name'], ENT_QUOTES) : ''; ?>" placeholder="Enter Your Name" name="name">
          <span class="error">* <?php echo $nameerr; ?></span>
        </div>
        <div class="form-group">
          <label>Select Your Gender:</label><br>
          <input type="radio" name="gender" <?php if (isset($_POST['gender']) && $_POST['gender'] == "male") echo "checked"; ?> value="male">
          <label for="male">Male</label><br>
          <input type="radio" name="gender" <?php if (isset($_POST['gender']) && $_POST['gender'] == "female") echo "checked"; ?> value="female">
          <label for="female">Female</label><br>
          <span class="error">* <?php echo $gendererr; ?></span>
        </div>
        <div class="form-group">
          <label for="mobilenumber">Mobile Number:</label>
          <input type="text" class="form-control" value="<?php echo isset($_POST['mobilenumber']) ? htmlspecialchars($_POST['mobilenumber'], ENT_QUOTES) : ''; ?>" placeholder="Enter Mobile Number" name="mobilenumber">
          <span class="error">* <?php echo $moberr; ?> </span>
          <span class="error"><?php echo $mobnumerr ?></span>
        </div>
        <div class="form-group">
          <label for="email">Email:</label>
          <input type="text" class="form-control" value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email'], ENT_QUOTES) : ''; ?>" placeholder="Enter Your Email" name="email">
          <span class="error">* <?php echo $emailerr; ?></span>
          <span class="error"><?php echo $emailvalerr; ?></span>
        </div>

        <div class="form-group">
          <label for="php">Select Subjects:</label><br>
          <input type="checkbox" name="subject[]" value="php">
          <label for="subject"> PHP</label><br>
          <input type="checkbox" name="subject[]" value="python">
          <label for="subject"> PYTHON</label><br>
          <input type="checkbox" name="subject[]" value=".net">
          <label for="subject"> .NET</label><br>
          <span class="error">* <?php echo $suberr; ?></span>
        </div>
        <div class="form-group">
          <label>Upload Image Here:</label>
          <input class="form-control" type="file" name="uploadImage">
        </div>
        <div class="form-group">
          <input type="submit" name="submit" class="btn btn-primary" value="Submit"><span class="error">* <?php echo $fileerr; ?></span>
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
