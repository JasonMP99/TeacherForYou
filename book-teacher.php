<?php include("config/constants.php") ?>

<html>
<head>
    <title>Book -TeacherForYou</title>
    <link rel="stylesheet" href="css/teacher.css">
</head>
<body>
<div class="register">
    <h1 class="text-center">Book teacher</h1>
    <br/>
    <br/>
    <?php
    $id = $_GET["id"];
    ?>

    <form action="" method="post" class="text-center">
        Full name: <br>
        <input type="text" name="full_name" placeholder="Enter your name" required>
        <br> <br>
        Email: <br>
        <input type="email" name="email" placeholder="Enter your email" required>
        <br> <br>
        Phone number: <br>
        <input type="text" name="phone" placeholder="Enter phone number" required>
        <br> <br>
        Course: <br>
        <input type="text" name="curse" placeholder="Enter curse" required>
        <br> <br>
        Hours: <br>
        <input type="number" name="hours" placeholder="Enter hours" required>
        <br> <br>
        Date: <br>
        <input type="date" name="date" placeholder="Enter date" required>
        <br> <br>
        <input type="submit" name="submit" value="Book" class="btn-primary" required>

    </form>
</div>

<?php include("partials-front/footer.php"); ?>

<?php
//process the value from from and save it in database
//check whether the submit button is clicked or not
if (isset($_POST["submit"])) {
    //button clicked
    //get data
    $full_name = $_POST["full_name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $curse = $_POST["curse"];
    $date = $_POST["date"];
    $hours = $_POST["hours"];

    //sql query to save into database
    $sql = "INSERT INTO bookings SET
            teacher_id=$id,
            full_name='$full_name',
            email='$email',
            phone=$phone,
            curse='$curse',
            date='$date',
            hours=$hours
            ";

    //execute query
    $res = mysqli_query($conn, $sql) or die(mysqli_error($conn));

    if ($res == TRUE) {
        $_SESSION["booked"] = "<div class='success'>Booked successfully</div>";
    } else {
        $_SESSION["booked"] = "<div class='error'>Error while registering</div>";
    }
    header("location:" . SITEURL . "/index.php");
}
?>
