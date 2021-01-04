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
        }
        if (isset($_SESSION["delete-booking"])) {
            echo $_SESSION["delete-booking"];
            unset($_SESSION["delete-booking"]); //removes message
        }
        ?>
        <table class="tbl-full">
            <tr>
                <th>Booking id</th>
                <th>Full name</th>
                <th>Email</th>
                <th>Phone number</th>
                <th>Curse</th>
                <th>Date</th>
                <th>Hours</th>
                <th>Action</th>
            </tr>
            <?php
            $sql = "SELECT * FROM bookings WHERE teacher_id=$id";
            $res = mysqli_query($conn, $sql);

            if ($res == TRUE) {
                $count = mysqli_num_rows($res);

                if ($count > 0) {
                    while ($rows = mysqli_fetch_assoc($res)) {
                        //get data
                        $id = $rows["id"];
                        $teacher_id = $rows["teacher_id"];
                        $full_name = $rows["full_name"];
                        $email = $rows["email"];
                        $phone = $rows["phone"];
                        $course = $rows["course"];
                        $date = $rows["date"];
                        $hours = $rows["hours"];

                        //display
                        ?>
                        <tr>
                            <td><?php echo $id; ?></td>
                            <td><?php echo $full_name; ?></td>
                            <td><?php echo $email; ?></td>
                            <td><?php echo $phone; ?></td>
                            <td><?php echo $course; ?></td>
                            <td><?php echo $date; ?></td>
                            <td><?php echo $hours; ?></td>
                            <td>
                                <a href="<?php echo SITEURL; ?>teacher/delete-booking.php?id=<?php echo $id; ?>"
                                   class="btn-danger">Delete Booking</a>
                            </td>
                        </tr>
                        <?php
                    }
                }else{
                    ?>
                    <p class="text-center">No bookings found.</p>
                    <?php
                }
            }

            ?>
        </table>

    </div>
</div>
<!-- main section end -->
<?php include("partials/footer.php"); ?>
