<?php require("crud.php");
if (isset($_SESSION['emailAddress'])) { ?>
  <!DOCTYPE html>
  <html lang="en">

  <head>
    <title>View Country</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
  </head>
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
        <span class="blinking">View Records !!</span>
        <p>Here You Can View Your Records</p>
      </div>
      <?php
      if (isset($_SESSION['response'])) {
      ?>
        <div class="alert alert-success" id="alert">
          <?php echo "<strong>" . $_SESSION['response'] . "</strong>"; ?>
          <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
      <?php
      } elseif (isset($_SESSION['responseDelete'])) { ?>
        <div class="alert alert-danger alert-dismissible" id="alert">
          <?php echo "<strong>" . $_SESSION['responseDelete'] . "</strong>"; ?>
          <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
      <?php }
      unset($_SESSION['responseDelete']);
      unset($_SESSION['response']);
      ?>



      <table class="table">
        <thead>
          <tr>
            <th>Country Id</th>
            <th>Country Name</th>
            <th>Country Discription</th>
            <th>State Name</th>
            <th>Your Name</th>
            <th>Gender</th>
            <th>Mobile Number</th>
            <th>Email</th>
            <th>Subject</th>
            <th>Image</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php

          $crudOb = new Crud();
          $result = $crudOb->viewCountry();
          $i = 0;
          while ($row = mysqli_fetch_array($result)) {
          ?>
            <tr>
              <td><?php echo $row["countryId"]; ?></td>
              <td><?php echo $row["countryName"]; ?></td>
              <td><?php echo $row["countryDiscription"]; ?></td>
              <td><?php echo $row["stateName"]; ?></td>
              <td><?php echo $row["name"]; ?></td>
              <td><?php echo $row["gender"]; ?></td>
              <td><?php echo $row["mobilenumber"]; ?></td>
              <td><?php echo $row["email"]; ?></td>
              <td><?php echo $row["subject"]; ?></td>
              <td><img src="<?php echo "Uploads/" . ($row['image_name']); ?>" /> </td>
              <td>
                <button class="btn btn-primary"><a href='delete.php?countryId=<?php echo $row["countryId"]; ?>' onclick="return checkDelete()">Delete</a></button>&emsp;
                <button class="btn btn-danger"><a href='editCountry.php?countryId=<?php echo $row["countryId"]; ?>'>Update</a></button>
              </td>
            </tr>
          <?php
            $i++;
          }
          ?>
        </tbody>
      </table>
      <script type="text/javascript">
        function checkDelete() {
          return confirm('Are you sure want to delete this record?');

        }
      </script>

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
