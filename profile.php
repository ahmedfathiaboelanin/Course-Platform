<?php
// connect to database
    include './includes/components/config.php';
//---------------------
    if(!isLogged()){
        header("location: ./index.php");
        exit();
    }
// edit
    if($_SERVER["REQUEST_METHOD"]==="POST" && $_GET['sec']==="edit"){
        $fname=$_POST['fname'];
        $lname=$_POST['lname'];
        $pass=$_POST['pass'];
        $id=$_SESSION['info']['id'];
        $email =$_SESSION['info']['username'];
        $q="UPDATE `users` SET `fname`='$fname',`lname`='$lname',`pass`='$pass' WHERE id=$id";
        $stmt=mysqli_query($con,$q);

        // ---------------------
        if(!empty($_FILES['img']['name']) && $_FILES['img']['error'] == 0){
            $folder = "layout/uploaded/$email/";
            if(!file_exists($folder)){
                mkdir($folder,0777,true);
            }
            $dest=$folder.$_FILES['img']['name'];
            move_uploaded_file($_FILES['img']['tmp_name'],$dest);
            if(file_exists($_SESSION['info']['img'])){
                unlink($_SESSION['info']['img']);
            }
            $imgAdd=true;
        }
        if($imgAdd==true){
            $query = "UPDATE users SET img='$dest' WHERE id=$id";
            $res= mysqli_query($con,$query);
        }

        $q="SELECT * FROM users WHERE id=$id";
        $stmt=mysqli_query($con,$q);
        $row=mysqli_fetch_assoc($stmt);
        $_SESSION['info']=$row;

        header('location: profile.php');
        // ----------------------

        // $row=mysqli_fetch_all($stmt,MYSQLI_ASSOC);
    }
// --------------------------
// get comments from database
    $id=$_SESSION['info']['id'];
    $commentQ="SELECT * FROM `comments` WHERE user_id =$id";
    $commentStmt=mysqli_query($con,$commentQ);
    $commentRow=mysqli_fetch_all($commentStmt,MYSQLI_ASSOC);
    // echo "<pre class='text-light'>";
    // print_r($commentRow);
    // echo "</pre>";
// ------------------------
// Get fav courses from db
    $favQ="SELECT * FROM `fav_courses` WHERE user_id = $id";
    $favStmt=mysqli_query($con,$favQ);
    $favRow=mysqli_fetch_all($favStmt,MYSQLI_ASSOC);
// ------------------------
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <!-- css -->
        <?php 
        include "./includes/css.php"
        ?>
        <style>
            <?php include "./layout/css/profile.css"?>
        </style>
    <!-- END css -->
</head>
<body>
    <?php 
        include "./includes/components/nav.php"
    ?>
    <section class='profile'>
        <div class="row">
            <div class="col-2 border-end d-flex  side collapse">
                <ul>
                    <li class=""><a href="profile.php"><i class="fa-solid fa-user-pen"></i></a></li>
                    <li class=""><a href="profile.php?sec=comments"><i class="fa-solid fa-comment"></i></a></li>
                    <!-- <li class=""><a href="profile.php"><i class="fa-solid fa-feather"></i><span class='det none'>liked Articles</span></a></li> -->
                    <li class=""><a href="profile.php?sec=courses"><i class="fa-solid fa-book-open-reader"></i></a></li>
                    <li class=""><a href="./logout.php"><i class="fa-solid fa-right-from-bracket"></i></a></li>
                </ul>
            </div>
            <div class="col left">
                <div class="container-fluid">
                    <?php if(isset($_GET["sec"]) && !empty($_GET["sec"]) && $_GET["sec"]==="edit"):?>
                        <div class="row profileRow gap-3 align-items-center justify-content-center">
                            <form class="col-10 col-md-5" enctype="multipart/form-data" method='POST' action=''>
                                <div class="userImg">
                                    <img src="<?php if(empty($_SESSION['info']['img'])){
                                        echo "./layout/imgs/users/AvatarMaker.png";
                                    }else{
                                        echo $_SESSION['info']['img'];
                                    }
                                        ?>" alt="" class='img-fluid'>
                                    <input type="file" name='img' id='img' style='display:none;'>
                                    <label for="img" class="upload"><i class="fa-solid fa-cloud-arrow-up"></i></label>
                                </div>
                                <div class="form-outline">
                                    <input name='fname' type="text" id="form1" class="form-control"value="<?php echo $_SESSION['info']['fname']?>" aria-label="readonly input example"/>
                                    <label class="form-label " for="form1">First name</label>
                                </div>
                                <div class="form-outline">
                                    <input name='lname' type="text" id="form4" class="form-control"value="<?php echo $_SESSION['info']['lname']?>" aria-label="readonly input example"/>
                                    <label class="form-label " for="form4">Last name</label>
                                </div>
                                <div class="form-outline">
                                    <input type="text" id="form2" class="form-control"value="<?php echo $_SESSION['info']['username']?>" aria-label="readonly input example" readonly/>
                                    <label class="form-label " for="form2">Username</label>
                                </div>
                                <div class="form-outline">
                                    <input name='pass' type="password" id="form3" class="form-control" value="<?php echo $_SESSION['info']['pass']?>" aria-label="readonly input example"/>
                                    <label class="form-label " for="form3">Password</label>
                                    <i class="fa-solid fa-eye" id='show'></i>
                                </div>
                                <button class='btn'>Submit</button>
                            </form>
                        </div>
                    <?php elseif(isset($_GET["sec"]) && !empty($_GET["sec"]) && $_GET["sec"]==="comments"):?>
                        <div class="row profileRow gap-3 align-items-center justify-content-center">
                            <table class="table col-10">
                                <thead>
                                    <tr>
                                    <th scope="col">Content</th>
                                    <th scope="col">Article</th>
                                    <th scope="col">Control</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($commentRow as $data):?>
                                        <tr>
                                            <td><?php echo $data['content']?></td>
                                            <td><?php 
                                                $a_id=$data['article_id'];
                                                $aQ="SELECT title FROM articles WHERE id=$a_id";
                                                $aStmt=mysqli_query($con,$aQ);
                                                $aRow=mysqli_fetch_column($aStmt);
                                                echo $aRow;
                                            ?></td>
                                            <td><a href="" class='btn btn-danger'>Delete</a></td>
                                        </tr>
                                    <?php endforeach;?>
                                </tbody>
                            </table>
                        </div>
                    <?php elseif(isset($_GET["sec"]) && !empty($_GET["sec"]) && $_GET["sec"]==="courses"):?>
                        <div class="row grid gap-3 justify-content-center">
                            <?php if(!empty($favRow)):?>
                                <?php foreach($favRow as $data):?>
                                    <?php 
                                        $courseId = $data["course_id"];
                                        $q="SELECT * FROM courses WHERE id = $courseId";
                                        $stmt = mysqli_query($con,$q);
                                        $course = mysqli_fetch_assoc($stmt);
                                    ?>
                                    <div class="course m-3 item">
                                        <div class="thumbnail">
                                            <img src="<?php echo $course["img"]?>" class='img-fluid' alt="">
                                        </div>
                                        <div class="caption">
                                            <span class='mb-1 d-inline-block'><?php echo $course["name"]?></span>
                                            <br>
                                            <!-- <span class='mb-1 d-inline-block'>Description : Back-end is a web application framework for building web applications.</span> -->
                                            <a href="./course.php?id=<?php echo $data["course_id"]?>" class='btn enroll'>Watch Now</a>
                                            <a href="./deleteCourse.php?id=<?php echo $data["course_id"]?>" class='btn btn-danger'>Delete</a>
                                        </div>
                                    </div>
                                <?php endforeach;?>
                            <?php else:?>
                                <div class="emptyCourse d-flex justify-content-center flex-column align-items-center">
                                    <img src="./layout/imgs/empty-removebg-preview.png" class='empty' alt="">
                                    <h1>No Courses Found</h1>
                                    <a class='btn' href="./courses.php">Check Our Courses</a>
                                </div>
                            <?php endif;?>
                    <?php else:?>
                        <div class="row profileRow gap-3 align-items-center justify-content-center">
                            <form class="col-10 col-md-5">
                                <div class="userImg">
                                    <img src="<?php if(empty($_SESSION['info']['img'])){
                                        echo "./layout/imgs/users/AvatarMaker.png";
                                    }else{
                                        echo $_SESSION['info']['img'];
                                    }
                                        ?>" alt="" class='img-fluid'>
                                </div>
                                <div class="form-outline">
                                    <input type="text" id="form1" class="form-control"value="<?php echo $_SESSION['info']['fname']." ".$_SESSION['info']['lname']?>" aria-label="readonly input example" readonly />
                                    <label class="form-label " for="form1">Full name</label>
                                </div>
                                <div class="form-outline">
                                    <input type="text" id="form2" class="form-control"value="<?php echo $_SESSION['info']['username']?>" aria-label="readonly input example" readonly />
                                    <label class="form-label " for="form2">Username</label>
                                </div>
                                <div class="form-outline">
                                    <input type="password" id="form3" class="form-control" value="<?php echo $_SESSION['info']['pass']?>" aria-label="readonly input example" readonly />
                                    <label class="form-label " for="form3">Password</label>
                                    <i class="fa-solid fa-eye" id='show'></i>
                                </div>
                                <a href="profile.php?sec=edit" class='btn'>Edit</a>
                            </form>
                        </div>
                    <?php endif;?>
                </div>
            </div>
        </div>
    </section>
    <script>
    </script>
    <?php include "./includes/js.php"?>
    <script src="./layout/js/func.js"></script>
</body>
</html>