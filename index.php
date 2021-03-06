<html>

<head>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <style>
        .divider-text {
            position: relative;
            text-align: center;
            margin-top: 15px;
            margin-bottom: 15px;
        }

        .divider-text span {
            padding: 7px;
            font-size: 12px;
            position: relative;
            z-index: 2;
        }

        .divider-text:after {
            content: "";
            position: absolute;
            width: 100%;
            border-bottom: 1px solid #ddd;
            top: 55%;
            left: 0;
            z-index: 1;
        }

        .btn-facebook {
            background-color: #405D9D;
            color: #fff;
        }

        .btn-twitter {
            background-color: #42AEEC;
            color: #fff;
        }

        .card {
            padding-top: 147px;
            position: relative;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-orient: vertical;
            -webkit-box-direction: normal;
            -ms-flex-direction: column;
            flex-direction: column;
            min-width: 0;
            word-wrap: break-word;
            background-color: #fff;
            background-clip: border-box;
            border: 1px solid rgba(0, 0, 0, .125);
            border-radius: .25rem;
        }

        @media (min-width: 1200px) {
            .container {
                max-width: 1140px;
                padding-top: 50px;
            }
        }

        @media (min-width: 992px) {
            .container {
                padding-top: 50px;
                max-width: 960px;
            }
        }

        @media (min-width: 768px) {
            .container {
                max-width: 720px;
                padding-top: 50px;
            }
        }

        @media (min-width: 576px) {
            .container {
                max-width: 540px;
                padding-top: 50px;
            }
        }

        .error {
            color: #FF0000;
        }
        .input-group>.custom-select:not(:first-child), .input-group>.form-control:not(:first-child) {
    border-top-left-radius: 0;
    width: 319px;
    border-bottom-left-radius: 0;
}
    </style>
    <!------ Include the above in your HEAD tag ---------->
</head>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css">

<body>
    <?php
    require("crud.php");
    $nameer = "";
    $emailer = "";
    $mober = "";
    $passer = "";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["fullName"])) {
            $nameer = "Your name is required";
        } elseif (empty($_POST["emailAddress"])) {
            $emailer = "Email Address is required";
        } elseif (!filter_var($_POST["emailAddress"], FILTER_VALIDATE_EMAIL)) {
            $emailer = "Please Enter The Valid Email Address";
        }  elseif (empty($_POST["mobileNumber"])) {
            $mober = "Mobile Number  is required";
        } elseif (!is_numeric($_POST["mobileNumber"])) {
            $mober = "Please Enter The Numerical Value Only";
        }elseif (empty($_POST["password"])) {
            $passer = "Password Is Required";
        } elseif (strlen($_POST["password"]) <= '8') {
            $passer = "Your Password Must Contain At Least 8 Digits !";
        } elseif (!preg_match("#[0-9]+#", $_POST["password"])) {
            $passer = "Your Password Must Contain At Least 1 Number !";
        } elseif (!preg_match("#[A-Z]+#", $_POST["password"])) {
            $passer = "Your Password Must Contain At Least 1 Capital Letter !";
        } elseif (!preg_match("#[a-z]+#", $_POST["password"])) {
            $passer = "Your Password Must Contain At Least 1 Lowercase Letter !";
        } elseif (!preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $_POST["password"])) {
            $passer = "Your Password Must Contain At Least 1 Special Character !";
        } else {
            $crudOb = new Crud();
            $crudOb->register();
        }
    }
    ?>
    <div class="container">

        <div class="card bg-light">
            <article class="card-body mx-auto" style="max-width: 400px;">
                <h4 class="card-title mt-3 text-center">Create Account</h4>
                <p class="text-center">Register Here</p>

                <form method="post">
                    <div class="form-group input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"> <i class="fa fa-user"></i> </span>
                        </div>
                        <input name="fullName" class="form-control" value="<?php echo isset($_POST['fullName']) ? htmlspecialchars($_POST['fullName'], ENT_QUOTES) : ''; ?>" placeholder="Full name" type="text"><span class="error">* <?php echo $nameer; ?></span>
                    </div> <!-- form-group// -->
                    <div class="form-group input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"> <i class="fa fa-envelope"></i> </span>
                        </div>
                        <input name="emailAddress" class="form-control" value="<?php echo isset($_POST['emailAddress']) ? htmlspecialchars($_POST['emailAddress'], ENT_QUOTES) : ''; ?>" placeholder="Email address" type="email"><span class="error">* <?php echo $emailer; ?></span>
                    </div> <!-- form-group// -->
                    <div class="form-group input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"> <i class="fa fa-phone"></i> </span>
                        </div>

                        <input name="mobileNumber" class="form-control" value="<?php echo isset($_POST['mobileNumber']) ? htmlspecialchars($_POST['mobileNumber'], ENT_QUOTES) : ''; ?>" placeholder="Phone number" type="text"><span class="error">* <?php echo $mober; ?></span>
                    </div> <!-- form-group// -->

                    <div class="form-group input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
                        </div>
                        <input class="form-control" name="password" value="<?php echo isset($_POST['password']) ? htmlspecialchars($_POST['password'], ENT_QUOTES) : ''; ?>" placeholder="Create password" type="password"><span class="error">* <?php echo $passer; ?></span>
                    </div> <!-- form-group// -->
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block"> Create Account </button>
                    </div> <!-- form-group// -->
                    <p class="text-center">Already Have an account? <a href="login.php">Log In</a> </p>
                </form>
            </article>
        </div> <!-- card.// -->

    </div>
    <!--container end.//-->