<?php include("partials/menu.php"); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Change Password</h1>
        <br/>
        <br/>

        <?php
        if (isset($_GET["id"])) {
            $id = $_GET["id"];
        } ?>

        <?php
        if (isset($_SESSION["psw-not-match"])) {
            echo $_SESSION["psw-not-match"];
            unset($_SESSION["psw-not-match"]); //removes message
        } ?>
        <form action="" method="post">
            <table class="tbl-30">
                <tr>
                    <td>Current Password:</td>
                    <td><input type="password" name="current_password" placeholder="type your current password"></td>
                </tr>

                <tr>
                    <td>New Password:</td>
                    <td><input type="password" name="new_password" placeholder="type your new password"></td>
                </tr>

                <tr>
                    <td>Confirm Password:</td>
                    <td><input type="password" name="confirm_password" placeholder="retype new password"></td>
                </tr>

                <tr>
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <td colspan="2"><input type="submit" name="submit" placeholder="Change password"
                                           class="btn-secondary"></td>
                </tr>
            </table>
        </form>
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
                    $_SESSION["change-pwd"] = "<div class='success'>Password changed</div>";
                    header("location:" . SITEURL . "teacher/update-teacher.php");
                } else {
                    $_SESSION["change-pwd"] = "<div class='error'>Password did not change</div>";
                    header("location:" . SITEURL . "teacher/update-teacher.php");
                }
            } else {
                $_SESSION["psw-not-match"] = "<div class='success'>Password don't match</div>";
                header("location:" . SITEURL . "teacher/update-password.php");
            }
        } else {
            $_SESSION["user-not-found"] = "<div class='error'>User not found</div>";
            header("location:" . SITEURL . "teacher/update-teacher.php");
        }
    } else {

    }

}
?>

<?php include("partials/footer.php"); ?>
