<?php
include("../config/constants.php");
//get id of booking to be deleted
$id = $_GET["id"];


//create sql query
$sql = "SELECT teacher_id FROM bookings WHERE id=$id";
$sql2 = "DELETE FROM bookings WHERE id=$id";

//get teacher id
$res = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($res);
$teacher_id = $row["teacher_id"];

//execute delete
$res2 = mysqli_query($conn, $sql2);

//check if executed successfully
if ($res2 == TRUE) {
    $_SESSION['delete-booking'] = "<div class='success'>Booking Deleted</div>";

} else {
    $_SESSION['delete-booking'] = "<div class='error'>Error while deleting </div>";
}
echo("<script>location.href = '" . SITEURL . "teacher/bookings.php?id=$teacher_id';</script>");
?>
