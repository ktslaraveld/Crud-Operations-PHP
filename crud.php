<?php
session_start();

require("connection.php"); //File Required For Connection 


class Crud

{

  public function addCountry()

  {
    $connection = new Connection();
    $conn = $connection->connectionFunction();

    //Getting Values From Form 
    $countryName = $_POST['countryName'];
    $countryDiscription = $_POST['countryDiscription'];
    $name = $_POST['name'];
    $gender = $_POST['gender'];
    $mobilenumber = $_POST['mobilenumber'];
    $email = $_POST['email'];
    $stateName = $_POST['stateName'];
    $imageName = $_FILES['uploadImage']['name'];
    $Path = "Uploads/" . basename($imageName);

    move_uploaded_file($_FILES["uploadImage"]["tmp_name"], $Path); //Upload Image To Folder

    //Get Values From Checkbox
    $sub = $_POST['subject'];
    $subject = implode(',', $sub);

    //Start Connection To Database

    //Insert Data Into Database
    $sql = "INSERT INTO countrymaster (countryName, countryDiscription, name , gender, mobilenumber, email, stateName,subject,image_name) VALUES
    ('$countryName', '$countryDiscription', '$name', '$gender', '$mobilenumber', '$email' ,'$stateName','$subject','$imageName')";
    $conn->query($sql);


    //Session For Successful Inserted Record
    $_SESSION['response'] = "Record Inserted Successfully!";
    $_SESSION['time'] = time();

    header('Location: viewCountry.php'); //Redirect Page 
  }

  public function viewCountry()

  {
    $connection = new Connection();
    $conn = $connection->connectionFunction();
    //Start Connection To Database



    //Select All Records From Database
    $query = "SELECT * from countrymaster";
    $result = $conn->query($query);
    return $result; //Return All Records In Array
  }

  public function updateCountry()

  {
    $connection = new Connection();
    $conn = $connection->connectionFunction();
    //Start The Session
    //Start Connection To Database

    $oldimage = $_POST['img1']; //Get Old Image Name
    unlink("Uploads/" . $oldimage); //Delete Old Image

    $subject = "";
    foreach ($_POST['subject'] as $i) {
      $subject .= $i . ",";
    }

    $imageName = $_FILES['uploadImage']['name']; //Get The Name Of New Image
    $Path = "Uploads/" . basename($imageName);  //Set Path Of New image
    move_uploaded_file($_FILES["uploadImage"]["tmp_name"], $Path); //Set New Image To File Directory


    //Select The Prticular row from The Database which will be chnaged
    $query = "UPDATE countrymaster set countryId='" . $_POST['countryId'] . "', countryName='" . $_POST['countryName'] . "', countryDiscription='" . $_POST['countryDiscription'] . "',name='" . $_POST['name'] . "',gender='" . $_POST['gender'] . "',mobilenumber='" . $_POST['mobilenumber'] . "',email='" . $_POST['email'] . "',subject='" . $subject .  "',image_name='" . $imageName . "'  WHERE countryId='" . $_POST['countryId'] . "'";
    $conn->query($query);


    //Session For Successfull Updated Record 
    $_SESSION['response'] = "Record Updated Successfully!";
    header('Location: viewCountry.php');
  }

  public function deleteCountry()

  {
    $connection = new Connection();
    $conn = $connection->connectionFunction();
    //Start The Session
    //Start Connection To Database

    //Delete The Perticular Row
    $sql = "DELETE FROM countrymaster WHERE countryId='" . $_GET["countryId"] . "'";
    $conn->query($sql);

    //Session For Successfully Deleted Record
    $_SESSION['responseDelete'] = "Record Deleted Successfully!";
    header('Location: viewCountry.php');
  }

  public function editCountry()

  {
    $connection = new Connection();
    $conn = $connection->connectionFunction();

    //Start Connection To Database



    // Select The Perticular Row
    $query = "SELECT * FROM countrymaster WHERE countryId='" . $_GET['countryId'] . "'";
    $result = $conn->query($query);
    return $result;
  }

  public function register()

  {
    $connection = new Connection();
    $conn = $connection->connectionFunction();
    //Get Values From Register Form
    $fullName = $_POST['fullName'];
    $emailAddress = $_POST['emailAddress'];
    $mobileNumber = $_POST['mobileNumber'];
    $password = $_POST['password'];

    //start The Connection



    //Insert The Record To The Database registermaster Table  
    $query = "INSERT INTO registermaster  (full_name,email_address,mobile_number,password) VALUES
    ('$fullName', '$emailAddress', '$mobileNumber', '$password')";
    $conn->query($query);

    //Start The Session //(ELSE)Create The Session For Perticular User

    $_SESSION["emailAddress"] = $emailAddress;

    if (isset($_SESSION['emailAddress'])) {
      Header('Location: addCountry.php');
    }
  }

  public function login()

  {
    $connection = new Connection();
    $conn = $connection->connectionFunction();

    if (isset($_POST['emailAddress'])) {   //Check emailAddress var 


      //Get Values From Login Form
      $emailAddress = $_POST['emailAddress'];
      $password = $_POST['password'];


      //Start The Database Connection




      //Check The Email And Password From The databasr To Match 
      $row = mysqli_query($conn, "SELECT * FROM registermaster WHERE email_address='$emailAddress' AND password='$password'");



      //(IF)Code when Email Or password is incorrect 
      if (mysqli_num_rows($row) < 1) {
        if ($emailAddress != "" && $password != "") {
          $sign = "You have Enter Wrong Email Id Or Password";
          return $sign;
        }
      } else {
        //Start The Session //(ELSE)Create The Session For Perticular User

        $_SESSION["emailAddress"] = $emailAddress;

        if (isset($_SESSION['emailAddress'])) {
          Header('Location: addCountry.php');
        }
      }
    }
  }

  public function editProfile()

  {
    $connection = new Connection();
    $conn = $connection->connectionFunction();

    //Start Connection To Database



    //Select Records From Register Table To Edit Profile 
    $query = "SELECT register_id,full_name,email_address,mobile_number FROM registermaster WHERE email_address='" . $_SESSION["emailAddress"] . "'";

    $result = $conn->query($query);
    return $result; //Return Result In Array
  }

  public function updateProfile()

  {
    $connection = new Connection();
    $conn = $connection->connectionFunction();

    //Start Connection To Database



    //Update Records In The Register Table
    $query = "UPDATE registermaster set register_id='" . $_POST['register_id'] . "', full_name='" . $_POST['full_name'] . "', mobile_number='" . $_POST['mobile_number'] . "',email_address='" . $_POST['email_address'] . "'  WHERE register_id='" . $_POST['register_id'] . "'";
    $conn->query($query);

    unset($_SESSION['emailAddress']); //Unset Older Email Session
    $_SESSION['emailAddress'] = $_POST['email_address']; //Create New Sessin For New Email Address


    //Session For Edit Profile
    $_SESSION['response'] = "Your Profile Is Updated Successfully!";
    Header('Location: viewCountry.php');
  }
  public function oldPassValidate()

  {
    $connection = new Connection();
    $conn = $connection->connectionFunction();

    //Start Connection To Database



    //Select The Password For The User
    $query = "SELECT password FROM registermaster WHERE email_address='" . $_SESSION["emailAddress"] . "'";
    $result = $conn->query($query);
    return $result;
  }

  public function changePassword()

  {
    $connection = new Connection();
    $conn = $connection->connectionFunction();

    //Start Connection To Database


    //Set New  Password For The User In The Database
    $query = "UPDATE registermaster set password='" . $_POST['renewPass'] . "'  WHERE email_address='" . $_SESSION["emailAddress"] . "'";
    $conn->query($query);

    //Session For Successfully Changed Password
    $_SESSION['response'] = "Your Password Is Changed Successfully!";
    Header('Location: viewCountry.php');
  }
}
