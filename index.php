<?php
// connect to database
    include './includes/components/config.php';
//---------------------
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CODE-IT</title>
    <!-- css -->
        <?php include "./includes/css.php"?>
        <style>
            <?php include "./layout/css/index.css"?>
        </style>
    <!-- END css -->
</head>
<body>
    <?php include "./includes/components/nav.php"?>
    <section class="landing">
        <div class="container-fluid">
            <div class="row landRow gap-3 align-items-center justify-content-center">
                <div class="col-md-5 col-10 text">
                    <h3><i class="fa-solid fa-angle-left"></i><span>CODE-IT</span><i class="fa-solid fa-angle-right"></i></h3>
                    <p class=''>
                        Our platform offers free programming courses for various languages, created by experienced instructors and industry professionals. We provide interactive learning tools and accessible courses to all learners, regardless of their background. Our courses are completely free and available online to anyone. Our goal is to help learners achieve their programming goals and advance their career in the tech industry.
                    </p>
                    <div class="btnGroup row gap-3 justify-content-start ps-2">
                        <a href="./courses.php" class='btn col-5'>Take a look</a>
                        <a href="./login.php" class='btn col-5'>Log in</a>
                    </div>
                </div>
                <div class="col-md-6 d-md-block img text-center">
                    <img src="./layout/imgs/062.png" class='img-fluid' alt="landing">
                </div>
            </div>
        </div>
    </section>
    <?php
    include "./includes/components/footer.php"
    ?>
    <?php include "./includes/js.php"?>
</body>
</html>