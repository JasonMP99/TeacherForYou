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
    <!--        search Section Ends Here -->

    <!--     CAtegories Section Starts Here -->
    <!--    <section class="categories">-->
    <!--        <div class="container">-->
    <!--            <h2 class="text-center">Explore Foods</h2>-->
    <!---->
    <!--            <a href="category-foods.html">-->
    <!--                <div class="box-3 float-container">-->
    <!--                    <img src="images/pizza.jpg" alt="Pizza" class="img-responsive img-curve">-->
    <!---->
    <!--                    <h3 class="float-text text-white">Pizza</h3>-->
    <!--                </div>-->
    <!--            </a>-->
    <!---->
    <!--            <a href="#">-->
    <!--                <div class="box-3 float-container">-->
    <!--                    <img src="images/burger.jpg" alt="Burger" class="img-responsive img-curve">-->
    <!---->
    <!--                    <h3 class="float-text text-white">Burger</h3>-->
    <!--                </div>-->
    <!--            </a>-->
    <!---->
    <!--            <a href="#">-->
    <!--                <div class="box-3 float-container">-->
    <!--                    <img src="images/momo.jpg" alt="Momo" class="img-responsive img-curve">-->
    <!---->
    <!--                    <h3 class="float-text text-white">Momo</h3>-->
    <!--                </div>-->
    <!--            </a>-->
    <!---->
    <!--            <div class="clearfix"></div>-->
    <!--        </div>-->
    <!--    </section>-->
    <!-- Categories Section Ends Here -->

    <!-- teacher Section Starts Here -->
    <section class="teacher">
        <div class="container">
            <h2 class="text-center">Teachers</h2>
            <?php
            if (isset($_SESSION["booked"])) {
                echo $_SESSION["booked"];
                unset($_SESSION["booked"]); //removes message
            } ?>
            <?php
            $sql = "SELECT * FROM teacher";
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
                }
            }
            ?>

            <div class="clearfix"></div>

        </div>

        <!--        <p class="text-center">-->
        <!--            <a href="#">See All Foods</a>-->
        <!--        </p>-->
    </section>
    <!-- teacher Section Ends Here -->
<?php include("partials-front/footer.php"); ?>