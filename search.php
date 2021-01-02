<?php include("partials-front/menu.php"); ?>
    <!--         search Section Starts Here -->
    <section class="search text-center">
        <div class="container">

            <form action="<?php echo SITEURL; ?>search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Teacher or Course.." required>
                <input type="submit" name="submit" value="search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!--         search Section ends Here -->

    <!--  Course Starts Here -->
    <section class="teacher">
        <div class="container">
            <h2 class="text-center">Teachers</h2>
            <?php
            $search = $_POST["search"];

            $sql = "SELECT * FROM teacher WHERE courses LIKE '%$search%' OR firstname LIKE '%$search%' OR lastname LIKE '%$search%'";
            $res = mysqli_query($conn, $sql);

            $sn = 1; // sn to display rather than id

            if ($res == TRUE) {
                $count = mysqli_num_rows($res);

                if ($count > 0) {
                    while ($rows = mysqli_fetch_assoc($res)) {
                        //get data
                        $id = $rows["id"];
                        $firstname = $rows["firstname"];
                        $lastname = $rows["lastname"];
                        $email = $rows["email"];
                        $courses = $rows["courses"];
                        $payment = $rows["payment"];
                        $address = $rows["address"];

                        //display
                        ?>
                        <div class="teacher-box">
                            <div class="teacher-img">
                                <img src="images/teacher_icon.png" alt="iconS"
                                     class="img-responsive img-curve">
                            </div>

                            <div class="teacher-desc">
                                <h4><?php echo $firstname;
                                    echo " ";
                                    echo $lastname; ?></h4>
                                <p class="teacher-payment"><?php echo $payment; ?>/hour</p>
                                <p class="teacher-curses">
                                    <?php echo $courses; ?>
                                </p>
                                <p class="teacher-curses"><?php echo $email; ?></p>
                                <p class="teacher-curses"><?php echo $address; ?></p>
                                <br>

                                <a href="<?php echo SITEURL; ?>book-teacher.php?id=<?php echo $id; ?>"
                                   class="btn-primary">Book</a>
                            </div>
                        </div>
                        <?php
                    }
                } else {
                    ?>
                    <p class="text-center">No results found.</p>
                    <?php
                }
            }
            ?>

            <div class="clearfix"></div>

        </div>

        <!--        <p class="text-center">-->
        <!--            <a href="#">See All Foods</a>-->
        <!--        </p>-->
    </section>
    <!--        course Section Ends Here -->

<?php include("partials-front/footer.php"); ?>