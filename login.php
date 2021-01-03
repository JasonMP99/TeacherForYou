<?php include("config/constants.php"); ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <!-- Important to make website responsive -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login - TeacherForYou</title>

        <!-- Link our CSS file -->
        <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="css/RegistrationLoginStyle.css">
        <link rel="stylesheet" type="text/css" href="css/style.css">
    </head>

<body>
    <!-- Navbar Section Starts Here -->
    <section class="navbar">
        <div class="container">

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
    <!-- Navbar Section Ends Here -->

<div class="login">

    <div class="container h-100">
        <div class="d-flex justify-content-center h-100">

            <div class="user_card">

                <div class="d-flex justify-content-center">
                    <div class="brand_logo_container">
                        <img src="images/logo.jpg" class="brand_logo" alt="Teachers For You logo">
                    </div>
                </div>

                <div class="d-flex justify-content-center form_container">

                    <?php
                    if (isset($_SESSION["login"])) {
                        echo $_SESSION["login"];
                        unset($_SESSION["login"]); //removes message
                    }
                    if (isset($_SESSION["no-login"])) {
                        echo $_SESSION["no-login"];
                        unset($_SESSION["no-login"]); //removes message
                    } ?>

                    <!-- login form starts here -->
                    <form method="post" action="login.php">
                        <div class="input-group mb-1">

                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>
                            <label for="username"></label><input type="text" name="username" placeholder="Username" id="username" class="form-control input_user" required>

                        </div>
                        <div class="input-group mb-2">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fas fa-key"></i></span>
                            </div>
                            <label for="password"></label><input type="password" name="password" placeholder="Password" id="password" class="form-control input_user" required>

                        </div>

                        <div class="d-flex justify-content-center mt-3 login_container">
                            <button type="submit" name="submit" id="login" class="btn login_btn">Sign in</button>
                        </div>

                    </form>

                </div>
                    <div class="mt-4">

                        <div class="d-flex justify-content-center links">
                            Don't have an account? <a href="register.php" class="ml-2">Sign Up</a>
                        </div>

                    </div>
            </div>
        </div>
    </div>
</div>
<?php include("partials-front/footer.php"); ?>
<?php
if (isset($_POST["submit"])) {
    $username = $_POST["username"];
    $password = md5($_POST["password"]);

    $sql = "SELECT * FROM teacher WHERE username= '$username' AND password='$password'";
    $res = mysqli_query($conn, $sql);

    $count = mysqli_num_rows($res);

    if ($count == 1) {
        $_SESSION['login'] = "<div class='success text-center'>Login successfully</div>";
        $_SESSION['username'] = $username;
        echo("<script>location.href = '".SITEURL."/teacher/manage-teacher.php';</script>");

    } else {
        $_SESSION['login'] = "<div class='error text-center'>Username or password is incorrect</div>";
        echo("<script>location.href = '".SITEURL."/login.php';</script>");

    }

}