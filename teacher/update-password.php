<?php include("partials/menu.php"); ?>

<div class="update-password">
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
                    } ?>

                    <?php
                    if (isset($_SESSION["psw-not-match"])) {
                        echo $_SESSION["psw-not-match"];
                        unset($_SESSION["psw-not-match"]); //removes message
                    } ?>

                    <form method="post" action="update-password.php">

                        <div class="input-group mb-1">

                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fas fa-key"></i></span>
                            </div>
                            <label for="current_password"></label><input type="password" name="current_password" placeholder="Current Password" id="current_password" class="form-control input_user" required>

                        </div>

                        <div class="input-group mb-1">

                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fas fa-key"></i></span>
                            </div>
                            <label for="new_password"></label><input type="password" name="new_password" placeholder="New Password" id="new_password" class="form-control input_user" required>

                        </div>

                        <div class="input-group mb-1">

                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fas fa-key"></i></span>
                            </div>
                            <label for="confirm_password"></label><input type="password" name="confirm_password" placeholder="Confirm Password" id="confirm_password" class="form-control input_user" required>

                        </div>

                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <td colspan="2">

                        <div class="d-flex justify-content-center mt-3 update_container">
                            <button type="submit" name="submit" id="update" class="btn update_btn">Change password</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
//get values from from
if (isset($_POST["submit"])) {
    $id = $_POST["id"];
    $current_password = md5($_POST["current_password"]);
    $new_password = md5($_POST["new_password"]);
    $confirm_password = md5($_POST["confirm_password"]);

//sql query to update
    $sql = "SELECT * FROM teacher WHERE id= $id AND password='$current_password'";

    $res = mysqli_query($conn, $sql);

    if ($res == TRUE) {
        $count = mysqli_num_rows($res);
        if ($count == 1) {
            if ($new_password == $confirm_password) {
                $sql2 = "UPDATE teacher SET password='$new_password' WHERE id= $id ";
                $res2 = mysqli_query($conn, $sql2);
                if ($res2 == TRUE) {
                    $_SESSION["change-pwd"] = "<div class='success text-center'>Password changed</div>";
                    echo("<script>location.href = '".SITEURL."/teacher/manage-teacher.php';</script>");
                } else {
                    $_SESSION["change-pwd"] = "<div class='error text-center'>Password did not change</div>";
                    echo("<script>location.href = '".SITEURL."/teacher/manage-teacher.php';</script>");
                }
            } else {
                $_SESSION["psw-not-match"] = "<div class='error text-center'>Password don't match</div>";
                echo("<script>location.href = '".SITEURL."/teacher/update-password.php';</script>");
            }
        } else {
            $_SESSION["user-not-found"] = "<div class='error text-center'>User not found</div>";
            echo("<script>location.href = '".SITEURL."/teacher/manage-teacher.php';</script>");
        }
    } else {

    }

}
?>

<?php include("partials/footer.php"); ?>
