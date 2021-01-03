<?php include("partials/menu.php"); ?>

    <!-- main section start -->
    <div class="main-content">
        <div class="wrapper">
            <h1> Manage Teacher </h1>

            <br/>

            <?php
            if (isset($_SESSION["register"])) {
                echo $_SESSION["register"];
                unset($_SESSION["register"]); //removes message
            }
            if (isset($_SESSION["login"])) {
                echo $_SESSION["login"];
                unset($_SESSION["login"]); //removes message
            }
            if (isset($_SESSION["delete"])) {
                echo $_SESSION["delete"];
                unset($_SESSION["delete"]); //removes message
            }
            if (isset($_SESSION["update"])) {
                echo $_SESSION["update"];
                unset($_SESSION["update"]); //removes message
            }
            if (isset($_SESSION["user-not-found"])) {
                echo $_SESSION["user-not-found"];
                unset($_SESSION["user-not-found"]); //removes message
            }
            if (isset($_SESSION["change-pwd"])) {
                echo $_SESSION["change-pwd"];
                unset($_SESSION["change-pwd"]); //removes message
            }
            if (isset($_SESSION["username"])) {
                $username = $_SESSION["username"];
            }
            ?>


            <br/>
            <br/>
            <br/>

            <table class="tbl-full">
                <tr>
                    <th>Id</th>
                    <th>First name</th>
                    <th>Last name</th>
                    <th>Username</th>
                    <th>Action</th>
                </tr>
                <?php
                $sql = "SELECT * FROM teacher WHERE username='$username'";
                $res = mysqli_query($conn, $sql);

                if ($res == TRUE) {
                    $count = mysqli_num_rows($res);

                    if ($count > 0) {
                        $rows = mysqli_fetch_assoc($res);
                        //get data
                        $id = $rows["id"];
                        $firstname = $rows["firstname"];
                        $lastname = $rows["lastname"];
                        $username = $rows["username"];
                    }
                }
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
                        <a href="<?php echo SITEURL; ?>teacher/bookings.php?id=<?php echo $id; ?>"
                               class="btn-booking">Bookings</a>
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <!-- main section end -->

<?php include("partials/footer.php"); ?>