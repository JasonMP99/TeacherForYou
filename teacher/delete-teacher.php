<?php
include("../config/constants.php");
//get id of admin to be deleted
$id = $_GET["id"];

//create sql query
$sql = "DELETE FROM teacher WHERE id=$id";

//execute
$res = mysqli_query($conn, $sql);

//check if executed successfully
if ($res == TRUE) {
    session_destroy();
    header("location:".SITEURL."index.php");
} else {
    $_SESSION['delete'] = "<div class='error'>Error while deleting </div>";
    header("location:" . SITEURL . "teacher/update-teacher.php");

}
?>
