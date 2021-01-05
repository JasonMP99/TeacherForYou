<?php include("partials/menu.php"); ?>

    <div class="update-teacher">
    <div class="container h-100">

        <div class="d-flex justify-content-center h-100">

            <div class="user_card">

                <div class="d-flex justify-content-center">
                    <div class="brand_logo_container">
                        <img src="../images/tfy-logo.png" class="brand_logo" alt="Teachers For You logo">
                    </div>
                </div>

                <div class="d-flex justify-content-center form_container">

                    <?php
                    if (isset($_GET["id"])) {
                        $id = $_GET["id"];
                    }
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

                    <form method="post" action="update-teacher.php">
                        <div class="input-group mb-1">

                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>
                            <label for="firstname"></label><input type="text" name="firstname"
                                                                  placeholder="<?php echo $firstname; ?>"
                                                                  id="firstname" class="form-control input_user"
                                                                  required>

                        </div>

                        <div class="input-group mb-1">

                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>
                            <label for="lastname"></label><input type="text" name="lastname"
                                                                 placeholder="<?php echo $lastname; ?>"
                                                                 id="lastname" class="form-control input_user" required>

                        </div>

                        <div class="input-group mb-1">

                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fas fa-user-circle"></i></span>
                            </div>
                            <label for="username"></label><input type="text" name="username"
                                                                 placeholder="<?php echo $username; ?>"
                                                                 id="username" class="form-control input_user" required>

                        </div>

                        <div class="input-group mb-1">

                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                            </div>
                            <label for="email"></label><input type="email" name="email"
                                                              placeholder="<?php echo $email; ?>" id="email"
                                                              class="form-control input_user" required>

                        </div>

                        <div class="input-group mb-1">

                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fas fa-book"></i></span>
                            </div>
                            <label for="courses"></label><input type="text" name="courses"
                                                                placeholder="<?php echo $courses; ?>"
                                                                id="courses" class="form-control input_user" required>

                        </div>

                        <div class="input-group mb-1">

                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fas fa-credit-card"></i></span>
                            </div>
                            <label for="payment"></label><input type="text" name="payment"
                                                                placeholder="<?php echo $payment; ?>"
                                                                id="payment" class="form-control input_user" required>

                        </div>

                        <div class="input-group mb-1">

                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fa fa-home"></i></span>
                            </div>
                            <label for="address"></label><input type="text" name="address"
                                                                placeholder="<?php echo $address; ?>"
                                                                id="address" class="form-control input_user" required>

                        </div>

                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <td colspan="2">

                            <div class="d-flex justify-content-center mt-3 update_container">
                                <button type="submit" name="submit" id="update" class="btn update_btn">Update</button>
                            </div>
                            <?php
                            if (isset($_SESSION["username-exists"])) {
                                echo $_SESSION["username-exists"];
                                unset($_SESSION["username-exists"]); //removes message
                            } ?>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php
//get values from form
if (isset($_POST["submit"])) {
    $id = $_POST["id"];
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
            echo("<script>location.href = '" . SITEURL . "teacher/update-teacher.php?id=$id';</script>");
            die();
        }
    }
    $email = $_POST["email"];
    $courses = $_POST["courses"];
    $payment = $_POST["payment"];
    $address = $_POST["address"];

    $sql = "SELECT * FROM teacher WHERE id= $id";

    $res = mysqli_query($conn, $sql);

    if ($res == TRUE) {
        $count = mysqli_num_rows($res);
        if ($count == 1) {
            $sql2 = "UPDATE teacher SET
            firstname='$firstname', 
            lastname= '$lastname',
            username='$username',
            email='$email',
            courses='$courses',
            payment='$payment',
            address='$address'
            WHERE id= $id ";

            $res2 = mysqli_query($conn, $sql2);
            if ($res2 == TRUE) {
                $_SESSION["update"] = "<div class='success'>Updated successfully</div>";
                $_SESSION["username"] = $username;
                echo("<script>location.href = '" . SITEURL . "/teacher/manage-teacher.php';</script>");
            } else {
                $_SESSION["update"] = "<div class='error'>Error while updating</div>";
                echo("<script>location.href = '" . SITEURL . "/teacher/update-teacher.php';</script>");
            }
        } else {
            $_SESSION["user-not-found"] = "<div class='error'>User not found</div>";
            echo("<script>location.href = '" . SITEURL . "/teacher/update-teacher.php';</script>");
        }
    }
}
?>

<?php include("partials/footer.php"); ?>