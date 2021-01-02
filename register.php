<?php include("config/constants.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- Important to make website responsive -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - TeacherForYou</title>

    <!-- Link our CSS file -->
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
<!-- Navbar Section Starts Here -->
<section class="navbar">
    <div class="container">
        <div class="logo">
            <a href="#" title="Logo">
                <img src="images/logo.jpg" alt="TFU logo" class="img-responsive">
            </a>
        </div>

        <div class="menu text-right">
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
    <h1 class="text-center">Register</h1>
    <br/>
    <br/>

    <?php
    if (isset($_SESSION["register"])) {
        echo $_SESSION["register"];
        unset($_SESSION["register"]); //removes message
    }
    ?>

    <form action="" method="post" class="text-center">
        First name: <br>
        <input type="text" name="firstname" placeholder="Enter your first name" required>
        <br> <br>
        Last name: <br>
        <input type="text" name="lastname" placeholder="Enter your last name" required>
        <br> <br>
        Username: <br>
        <input type="text" name="username" placeholder="Enter your username" required>
        <br> <br>
        Password: <br>
        <input type="password" name="password" placeholder="Enter your password" required>
        <br> <br>
        Email: <br>
        <input type="email" name="email" placeholder="Enter your email" required>
        <br> <br>
        Courses: <br>
        <input type="text" name="curses" placeholder="Enter your curses" required>
        <br> <br>
        Payment: <br>
        <input type="number" name="payment" placeholder="Enter your payment" required>
        <br> <br>
        Address: <br>
        <input type="text" name="address" placeholder="Enter your address" required>
        <br> <br>

        <input type="submit" name="submit" value="Register" class="btn-primary" required>

    </form>
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
        $_SESSION["register"] = "<div class='success'>Registered successfully</div>";
        $_SESSION["username"] = $username;
        header("location:" . SITEURL . "teacher/manage-teacher.php");

    } else {
        $_SESSION["register"] = "<div class='error'>Error while registering</div>";
        header("location:" . SITEURL . "register.php");
    }
}
?>
