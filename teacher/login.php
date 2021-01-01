<?php include("../config/constants.php") ?>

    <html>
    <head>
        <title>Login -TeacherForYou</title>
        <link rel="stylesheet" href="../css/teacher.css">
    </head>
<body>
    <div class="login">
        <h1 class="text-center">Login</h1>
        <br>


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
        <form action="" method="post" class="text-center">
            <br>
            Username:<br>
            <input type="text" name="username" placeholder="enter username">
            <br>
            <br>
            Password:<br>
            <input type="password" name="password" placeholder="enter password">
            <br>
            <br>
            <input type="submit" name="submit" value="Login" class="btn-primary">
            <br>
            <br>
        </form>
    </div>
<?php include("partials/footer.php"); ?>
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
        header("location:" . SITEURL . "teacher/manage-teacher.php");
    } else {
        $_SESSION['login'] = "<div class='error text-center'>Username or password is incorrect</div>";
        header("location:" . SITEURL . "teacher/login.php");
    }

}