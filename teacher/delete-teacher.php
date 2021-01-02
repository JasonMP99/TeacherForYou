<?php
include("../config/constants.php");
//get id of teacher to be deleted
$id = $_GET["id"];

//create sql queries to delete teacher and the bookings he has
$sql = "DELETE FROM teacher WHERE id=$id";
$sql2 = "DELETE FROM bookings WHERE teacher_id=$id";

//execute
$res = mysqli_query($conn, $sql);
$res2 = mysqli_query($conn, $sql2);

//check if executed successfully
if ($res == TRUE && $res2 == TRUE) {
    session_destroy();
    header("location:" . SITEURL . "index.php");
} else {
    $_SESSION['delete'] = "<div class='error'>Error while deleting </div>";
    header("location:" . SITEURL . "teacher/update-teacher.php");

}
?>
