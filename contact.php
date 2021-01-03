<?php include("partials-front/menu.php"); ?>

<div class="d-flex justify-content-center form_container">
    <form action="">

        <div class="input-group mb-1">
            <div class="input-group-append">
                <span class="input-group-text"><i class="fas fa-user"></i></span>
            </div>
            <label for="firstname"></label><input type="text"
                                                  name="firstname"
                                                  placeholder="Firstname"
                                                  id="firstname"
                                                  class="form-control input_user"
                                                  required>

        </div>

        <div class="input-group mb-1">

            <div class="input-group-append">
                <span class="input-group-text"><i class="fas fa-user"></i></span>
            </div>
            <label for="lastname"></label><input type="text" name="lastname" placeholder="Lastname"
                                                 id="lastname" class="form-control input_user" required>

        </div>

        <div class="input-group mb-1">

            <div class="input-group-append">
                <span class="input-group-text"><i class="fas fa-user"></i></span>
            </div>
            <label for="email"></label><input type="email" name="email" placeholder="E-Mail" id="email"
                                              class="form-control input_user" required>

        </div>

        <div class="input-group mb-1">
            <label for="subject">Subject</label>
            <textarea id="subject" name="subject" placeholder="Write something.." style="height:200px"></textarea>
        </div>
        <div class="d-flex justify-content-center mt-3 register_container">
            <button type="submit" name="submit" id="register" class="btn register_btn">Sign Up</button>
        </div>

    </form>
</div>

<?php include("partials-front/footer.php"); ?>
