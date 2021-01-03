<?php include("config/constants.php") ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- Important to make website responsive -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book - TeacherForYou</title>

    <!-- Link our CSS file -->
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/RegistrationLoginStyle.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
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
<div class="booking">
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
                    if (isset($_GET["id"])) {
                        $id = $_GET["id"];
                    } ?>

                    <form method="post" action="book-teacher.php">

                        <div class="input-group mb-1">

                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>
                            <label for="full_name"></label><input type="text" name="full_name" placeholder="Full Name" id="full_name" class="form-control input_user" required>

                        </div>

                        <div class="input-group mb-1">

                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>
                            <label for="email"></label><input type="email" name="email" placeholder="E-Mail" id="email" class="form-control input_user" required>

                        </div>

                        <div class="input-group mb-1">

                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>
                            <label for="phone"></label><input type="text" name="phone" placeholder="Phone Number" id="phone" class="form-control input_user" required>

                        </div>

                        <div class="input-group mb-1">

                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>
                            <label for="course"></label><input type="text" name="course" placeholder="Course" id="course" class="form-control input_user" required>

                        </div>

                        <div class="input-group mb-1">

                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>
                            <label for="hours"></label><input type="number" name="hours" placeholder="Hours" id="hours" class="form-control input_user" required>

                        </div>

                        <div class="input-group mb-1">

                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>
                            <label for="date"></label><input type="date" name="date" placeholder="Date" id="hours" class="form-control input_user" required>

                        </div>

                        <input type="hidden" name="id" value="<?php echo $id; ?>">

                        <div class="d-flex justify-content-center mt-3 booking_container">
                            <button type="submit" name="submit" id="book" class="btn booking_btn">Book</button>
                        </div>

                    </form>
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
    $id = $_POST["id"];
    $full_name = $_POST["full_name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $course = $_POST["course"];
    $date = $_POST["date"];
    $hours = $_POST["hours"];

    //sql query to save into database
    $sql = "INSERT INTO bookings SET
            teacher_id=$id,
            full_name='$full_name',
            email='$email',
            phone=$phone,
            course='$course',
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
    echo("<script>location.href = '".SITEURL."/index.php';</script>");
}
?>
