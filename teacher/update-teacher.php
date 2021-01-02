<?php include("partials/menu.php"); ?>

    <div class="main-content">
        <div class="wrapper">
            <h1>Update</h1>

            <?php
            $id = $_GET["id"];

            $sql = "SELECT * FROM teacher WHERE id=$id";

            $res = mysqli_query($conn, $sql);

            if ($res == TRUE) {
                $count = mysqli_num_rows($res);

                if ($count == 1) {
                    $row = mysqli_fetch_assoc($res);
                    $firstname = $row["firstname"];
                    $lastname = $row["lastname"];
                    $username = $row["username"];
                    $email = $row["email"];
                    $courses = $row["courses"];
                    $payment = $row["payment"];
                    $address = $row["address"];


                } else {
                    header("location:" . SITEURL . "teacher/update-teacher.php");
                }
            }

            ?>

            <form action="" method="post">
                First name: <br>
                <input type="text" name="firstname" placeholder="<?php echo $firstname; ?>" required>
                <br> <br>
                Last name: <br>
                <input type="text" name="lastname" placeholder="<?php echo $lastname; ?>" required>
                <br> <br>
                Username: <br>
                <input type="text" name="username" placeholder="<?php echo $username; ?>" required>
                <br> <br>
                Email: <br>
                <input type="email" name="email" placeholder="<?php echo $email; ?>" required>
                <br> <br>
                Courses: <br>
                <input type="text" name="courses" placeholder="<?php echo $courses; ?>" required>
                <br> <br>
                Payment: <br>
                <input type="number" name="payment" placeholder="<?php echo $payment; ?>" required>
                <br> <br>
                Address: <br>
                <input type="text" name="address" placeholder="<?php echo $address; ?>" required>
                <br> <br>
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <input type="submit" name="submit" value="Update" class="btn-primary" required>
            </form>

        </div>
    </div>

<?php
//get values from form
if (isset($_POST["submit"])) {
    $id = $_POST["id"];
    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $username = $_POST["username"];
    $email = $_POST["email"];
    $courses = $_POST["courses"];
    $payment = $_POST["payment"];
    $address = $_POST["address"];

//sql query to update
    $sql = "UPDATE teacher SET
            firstname='$firstname', 
            lastname= '$lastname',
            username='$username',
            email='$email',
            courses='$courses',
            payment=$payment,
            address='$address'
            WHERE id ='$id'";

    $res = mysqli_query($conn, $sql);

    if ($res == TRUE) {
        $_SESSION["update"] = "<div class='success'>Updated successfully</div>";
    } else {
        $_SESSION["update"] = "<div class='error'>Error while updating</div>";
    }
    header("location:" . SITEURL . "teacher/manage-teacher.php");
}
?>


<?php include("partials/footer.php"); ?>