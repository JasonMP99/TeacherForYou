<?php include("config/constants.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- Important to make website responsive -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - TeacherForYou</title>

    <!-- Link our CSS file -->
    <link rel="stylesheet" type="text/css"
          href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
          integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/RegistrationLoginStyle.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>

<!-- Navbar Section Starts Here -->
<section class="navbar">
    <div class="container">

        <div class=" menu text-right">
            <ul>
                <li>
                    <a href="index.php">Home</a>
                </li>
            </ul>
        </div>

        <div class="clearfix"></div>
    </div>
</section>
<div class="register">
    <div class="container h-100">

        <div class="d-flex justify-content-center h-100">

            <div class="user_card">

                <div class="d-flex justify-content-center">
                    <div class="brand_logo_container">
                        <img src="images/tfy-logo.png" class="brand_logo" alt="Teachers For You logo">
                    </div>
                </div>

                <div class="d-flex justify-content-center form_container">

                    <form method="post" action="register.php" enctype="multipart/form-data">

                        <div class="input-group mb-1">


                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>
                            <label for="firstname"></label><label for="firstname"></label><input type="text"
                                                                                                 name="firstname"
                                                                                                 placeholder="Firstname"
                                                                                                 id="firstname"
                                                                                                 class="form-control input_user"
                                                                                                 required>

                        </div>

                        <div class="input-group mb-1">

                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>
                            <label for="lastname"></label><input type="text" name="lastname" placeholder="Lastname"
                                                                 id="lastname" class="form-control input_user" required>

                        </div>

                        <div class="input-group mb-1">

                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>
                            <label for="username"></label></label><input type="text" name="username"
                                                                         placeholder="Username" id="username"
                                                                         class="form-control input_user" required>

                        </div>

                        <div class="input-group mb-1">

                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fas fa-key"></i></span>
                            </div>
                            <label for="password"></label><input type="password" name="password" placeholder="Password"
                                                                 id="password" class="form-control input_pass" required>

                        </div>

                        <div class="input-group mb-1">

                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>
                            <label for="email"></label><input type="email" name="email" placeholder="E-Mail" id="email"
                                                              class="form-control input_user" required>

                        </div>

                        <div class="input-group mb-1">

                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fas fa-phone"></i></span>
                            </div>
                            <label for="courses"></label><input type="text" name="courses" placeholder="Course"
                                                                id="courses" class="form-control input_user" required>

                        </div>

                        <div class="input-group mb-1">

                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fas fa-credit-card"></i></span>
                            </div>
                            <label for="payment"></label><input type="text" name="payment" placeholder="Payment"
                                                                id="payment" class="form-control input_user" required>

                        </div>

                        <div class="input-group mb-1">

                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fa fa-home"></i></span>
                            </div>
                            <label for="address"></label><input type="text" name="address" placeholder="Address"
                                                                id="address" class="form-control input_user" required>

                        </div>

                        <div class="d-flex justify-content-center mt-3 register_container">
                            <button type="submit" name="submit" id="register" class="btn register_btn">Sign Up</button>
                        </div>
                        <?php
                        if (isset($_SESSION["register"])) {
                            echo $_SESSION["register"];
                            unset($_SESSION["register"]); //removes message
                        }
                        if (isset($_SESSION["username-exists"])) {
                            echo $_SESSION["username-exists"];
                            unset($_SESSION["username-exists"]); //removes message
                        }
                        ?>

                    </form>
                </div>

                <div class="mt-4">


                    <div class="d-flex justify-content-center links">
                        You already have an account? <a href="login.php" class="ml-2">Sign In</a>
                    </div>


                </div>
            </div>
        </div>
    </div>
</div>

<?php include("partials-front/footer.php"); ?>

<?php
//process the value from from and save it in database
//check whether the submit button is clicked or not
if (isset($_POST["submit"])) {
    //button clicked
    //get data
    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $username = $_POST["username"];

    //check if username exists
    $sql_username = "SELECT * FROM teacher WHERE username='$username'";
    $res_username = mysqli_query($conn, $sql_username) or die(mysqli_error($conn));
    if ($res_username == TRUE) {
        $count = mysqli_num_rows($res_username);
        if ($count > 0) {
            $_SESSION["username-exists"] = "<div class='error text-center'>Username already exists</div>";
            echo("<script>location.href = '" . SITEURL . "register.php';</script>");
            die();
        }
    }

    $password = md5($_POST["password"]); // password encryption with md5
    $email = $_POST["email"];
    $courses = $_POST["courses"];
    $payment = $_POST["payment"];
    $address = $_POST["address"];

    //sql query to save into database
    $sql = "INSERT INTO teacher SET
            firstname='$firstname', 
            lastname= '$lastname',
            username='$username',
            password='$password',
            email='$email',
            courses='$courses',
            payment=$payment,
            address='$address'
            ";

    //execute query
    $res = mysqli_query($conn, $sql) or die(mysqli_error($conn));

    if ($res == TRUE) {
        $_SESSION["register"] = "<div class='success text-center'>Registered successfully</div>";
        $_SESSION["username"] = $username;
        echo("<script>location.href = '" . SITEURL . "/teacher/manage-teacher.php';</script>");

    } else {
        $_SESSION["register"] = "<div class='error text-center'>Error while registering</div>";
        echo("<script>location.href = '" . SITEURL . "/register.php';</script>");
    }
}
?>
