<?php

if (!isset($_SESSION["username"])) {
    $_SESSION["no-login"] = "<div class='error text-center'>Please login</div>";
    echo("<script>location.href = '".SITEURL."login.php';</script>");
}