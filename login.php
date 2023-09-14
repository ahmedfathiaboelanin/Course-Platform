<?php
// connect to database
    include './includes/components/config.php';
//---------------------
// ---------------------
    if(isLogged()){
        header("location: ./profile.php");
        exit();
    }
// ---------------------
// authentication
    if($_SERVER['REQUEST_METHOD']==='POST'){
        $user=$_POST['user'];
        $pass=$_POST['pass'];
        if(empty($user)){
            $error="<p class='alert alert-danger'>Username can't be empty</p>";
        }elseif(empty($pass)){
            $error="<p class='alert alert-danger'>Password can't be empty</p>";
        }else{
            $q="SELECT * FROM users WHERE username='$user' && pass='$pass'";
            $stmt=mysqli_query($con,$q);
            $row=mysqli_fetch_assoc($stmt);
            if(empty($row)){
                $error="<p class='alert alert-danger'>Email / Password is invalid</p>";
            }else{
                $_SESSION['info']=$row;
                header("location: ./profile.php");
                exit();
            }
        }
    }
// ------------------------
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- css -->
        <?php 
        include "./includes/css.php"
        ?>
        <style>
            <?php include "./layout/css/login.css"?>
        </style>
    <!-- END css -->
</head>
<body>
    <?php 
    include "./includes/components/nav.php"
    ?>
    <section class="login">
        <div class="container-fluid">
            <div class="row logRow align-items-center justify-content-center">
                <form action="" method='POST' class="form col-10 col-md-3">
                    <div class="user">
                        <img src="./layout/imgs/undraw_Male_avatar_g98d-removebg-preview.png" alt="" class='img-fluid'>
                    </div>
                    <input class='form-control' name='user' type="text" placeholder='Username' required>
                    <input class='form-control' name='pass' type="password" placeholder='Password' required >
                    <?php if(!empty($error)){
                        echo $error;
                    }?>
                    <button class='btn'>Log in</button>
                    <a class='text-center' href="./signup.php">Don't Have Account 🤔?</a>
                </form>
                <div class="img col-10 col-md-4 d-md-flex d-none">
                    <img src="./layout/imgs/undraw_Access_account_re_8spm-removebg-preview (1).png" class='img-fluid' alt="">
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