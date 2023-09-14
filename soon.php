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
    <title>Coming Soon</title>
    <!-- css -->
        <?php include "./includes/css.php"?>
        <style>
            <?php include "./layout/css/soon.css"?>
        </style>
    <!-- END css -->
</head>
<body>
    <?php include "./includes/components/nav.php"?>
    <section class='soon'>
        <img src="./layout/imgs/soon.png" alt="">
        <h1>Coming Soon</h1>
        <div class="btns">
            <a href="./courses.php" class='btn btn-info'>Go to course page <i class="fa-solid fa-book-open-reader"></i></a>
            <a href="./index.php" class='btn btn-info'>Go home page <i class="fa-solid fa-house"></i></a>
        </div>
    </section>
    <?php
    include "./includes/components/footer.php"
    ?>
    <?php include "./includes/js.php"?>
</body>
</html>