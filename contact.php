<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact</title>
    <!-- css -->
        <?php include "./includes/css.php"?>
        <style>
            <?php include "./layout/css/contact.css"?>
        </style>
    <!-- END css -->
</head>
<body>
    <?php include "./includes/components/nav.php"?>
    <section class="contact">
        <div class="container">
            <div class="row justify-content-center">
                <form class="col-10 col-md-8">
                    <input required type="text" placeholder='Full name' name='name'class='form-control'>
                    <input required type="email" placeholder='Email' name='name'class='form-control'>
                    <input required type="text" placeholder='Subject' name='name'class='form-control'>
                    <textarea placeholder='Message' name="" id="" cols="30" rows="10" class='form-control'></textarea>
                    <button class='btn'>Send</button>
                </form>
            </div>
        </div>
    </section>
    <?php include "./includes/components/footer.php"?>
    <?php include "./includes/js.php"?>
<body>
    
</body>
</html>