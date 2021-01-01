<?php

if (!isset($_SESSION["username"])) {
    $_SESSION["no-login"] = "<div class='error text-center'>Please login</div>";
    header("location:" . SITEURL . "teacher/login.php");
}