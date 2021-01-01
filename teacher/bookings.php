<?php include("partials/menu.php"); ?>

<!-- main section start -->
<div class="main-content">
    <div class="wrapper">
        <h1> Bookings </h1>
        <br/>
        <br/>
        <?php
        if (isset($_GET["id"])) {
            $id = $_GET["id"];
        } ?>
        <table class="tbl-full">
            <tr>
                <th>Booking id</th>
                <th>Full name</th>
                <th>Email</th>
                <th>Username</th>
                <th>Action</th>
            </tr>
            <?php
            $sql = "SELECT * FROM bookings WHERE teacher_id=$id";
            $res = mysqli_query($conn, $sql);

            if ($res == TRUE) {
                $count = mysqli_num_rows($res);

                if ($count > 0) {
                    $rows = mysqli_fetch_assoc($res);
                    //get data
                    $id = $rows["id"];
                    $firstname = $rows["fullname"];
                    $lastname = $rows["lastname"];
                    $username = $rows["username"];

                    //display
                    ?>
                    <tr>
                        <td><?php echo $id ?></td>
                        <td><?php echo $firstname ?></td>
                        <td><?php echo $lastname ?></td>
                        <td><?php echo $username ?></td>
                        <td>
                            <a href="<?php echo SITEURL; ?>teacher/update-password.php?id=<?php echo $id; ?>"
                               class="btn-primary">Change Password</a>
                            <a href="<?php echo SITEURL; ?>teacher/update-teacher.php?id=<?php echo $id; ?>"
                               class="btn-secondary">Update</a>
                            <a href="<?php echo SITEURL; ?>teacher/delete-teacher.php?id=<?php echo $id; ?>"
                               class="btn-danger">Delete</a>
                        </td>
                    </tr>
                    <?php
                }
            }


            ?>
        </table>

    </div>
</div>
<!-- main section end -->
<?php include("partials/footer.php"); ?>
