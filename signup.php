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
        $fname=$_POST['fname'];
        $lname=$_POST['lname'];
        $user=$_POST['user'];
        $pass=$_POST['pass'];
        $repass = $_POST['repass'];
        if(empty($fname)){
            $error="<p class='alert alert-danger'>First Name can't be empty</p>";
        }elseif(empty($lname)){
            $error="<p class='alert alert-danger'>Last Name can't be empty</p>";
        }elseif(empty($user)){
            $error="<p class='alert alert-danger'>Username can't be empty</p>";
        }elseif(empty($pass)){
            $error="<p class='alert alert-danger'>Password can't be empty</p>";
        }else{
            if($pass !== $repass){
                $error="<p class='alert alert-danger'>Passwords are not the same</p>";
            }else{
                $q="SELECT * FROM users WHERE username='$user'";
                $stmt=mysqli_query($con,$q);
                $row=mysqli_fetch_assoc($stmt);
                if(empty($row)){
                    // insert
                    $q="INSERT INTO `users`(`fname`, `lname`, `username`, `pass`, `img`, `admin`) VALUES ('$fname','$lname','$user','$pass',null,0)";
                    $stmt=mysqli_query($con,$q);
                    $q="SELECT * FROM users WHERE username='$user'";
                    $stmt=mysqli_query($con,$q);
                    $row=mysqli_fetch_assoc($stmt);
                    $_SESSION['info']=$row;
                    header("location: ./profile.php");
                    exit();
                }else{
                    $error="<p class='alert alert-danger'>Username is already taken</p>";
                }
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
    <title>Signup</title>
    <!-- css -->
        <?php include "./includes/css.php"?>
        <style>
            <?php include "./layout/css/signup.css"?>
            <?php include "./layout/css/login.css"?>
        </style>
    <!-- END css -->
</head>
<body>
    <?php include "./includes/components/nav.php"?>
    <section class="login">
        <div class="container-fluid">
            <div class="row logRow align-items-center justify-content-center">
                <form action="" method='POST' class="form col-10 col-md-3">
                    <div class="user">
                        <img src="./layout/imgs/undraw_Male_avatar_g98d-removebg-preview.png" alt="" class='img-fluid'>
                    </div>
                    <input class='form-control' name='fname' type="text" placeholder='First name' required>
                    <input class='form-control' name='lname' type="text" placeholder='Last name' required>
                    <input class='form-control' name='user' type="text" placeholder='Username' required>
                    <input class='form-control' name='pass' type="password" placeholder='Password' required >
                    <input class='form-control' name='repass' type="password" placeholder='Repassword' required >
                    <?php if(!empty($error)){
                        echo $error;
                    }?>
                    <button class='btn'>Sign Up</button>
                    <a class='text-center' href="./login.php">Already Have Account 🤔?</a>
                </form>
                <div class="img col-10 col-md-4 d-md-flex d-none">
                    <img src="./layout/imgs/signup.png" class='img-fluid' alt="">
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