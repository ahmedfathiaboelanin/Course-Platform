<?php
// connect to database
    include './includes/components/config.php';
//---------------------
// get courses from database
    if($_SERVER['REQUEST_METHOD']==="GET" && !empty($_GET['id']) && is_numeric($_GET['id'])){
        $id = $_GET['id'];
        $q="SELECT * FROM blogs WHERE id=$id";
        $stmt = mysqli_query($con,$q);
        $cRow= mysqli_fetch_assoc($stmt);
        $q="UPDATE `blogs` SET views= views + 1 WHERE id = $id";
        $stmt = mysqli_query($con,$q);
    }else{
        header("location: ./blog.php");
        exit();
    }
// -------------------------
// get hot articles from database
    $q="SELECT title,author,date,img,id,cat_id FROM blogs order by views desc limit 5";
    $stmt = mysqli_query($con,$q);
    $hotRow= mysqli_fetch_all($stmt,MYSQLI_ASSOC);
// -------------------------
// get comment from db
    $q="SELECT * FROM `comments` WHERE article_id = $id order by id desc limit 3";
    $stmt = mysqli_query($con,$q);
    $comment = mysqli_fetch_all($stmt,MYSQLI_ASSOC);
// ----------------------
// add comment
    if( $_SERVER['REQUEST_METHOD'] ==="POST"){
        if(isset($_SESSION['info']) && !empty($_SESSION['info'])){
            $cont = $_POST['content'];
            $uId = $_SESSION['info']['id'];
            if(!empty($cont)){
                $q="INSERT INTO `comments`(`content`, article_id, user_id) VALUES ('$cont',$id,$uId)";
                $stmt = mysqli_query($con,$q);
                header("location: ./article.php?id=$id");
                exit();
            }else{
                $commentError="<p class='alert alert-danger'>please write your comment</p>";
            }
        }else{
            header("location: ./login.php");
            exit();
        }
    }
// -----------
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Articles</title>
    <!-- css -->
        <?php include "./includes/css.php"?>
        <style>
            <?php include "./layout/css/article.css"?>
        </style>
    <!-- END css -->
</head>
<body>
    <?php include "./includes/components/nav.php"?>
    <section class="blogs" style='min-height:100vh'>
        <div class="container-fluid">
            <div class="row justify-content-center gap-5">
                <div class='list col-md-3 d-none d-md-flex'>
                    <img src="./layout/imgs/logo.webp" alt="">
                    <div class="social">
                        <a href="https://www.facebook.com/profile.php?id=100086581486734" style='background-color:#129AF6;'><i class="fa-brands fa-facebook-f"></i></a>
                        <a href="" style='background-color:#24C24A;'><i class="fa-brands fa-whatsapp"></i></a>
                        <a href="https://github.com/ahmedfathiaboelanin" style='background-color:#000;'><i class="fa-brands fa-github"></i></a>
                        <a href="https://www.linkedin.com/in/ahmed-fathi-1a4593247/" style='background-color:#518EF5;'><i class="fa-brands fa-linkedin-in"></i></a>
                    </div>
                    <div class="hots">
                        <div class='mt-1 fs-4' style='color:var(--text);'>HOT ARTICLES</div>
                        <?php foreach($hotRow as $data):?>
                            <div class="hot">
                                <img src="<?php
                                    if(!empty($data['img'])){
                                        echo $data['img'];
                                    }else{
                                        echo "./layout/imgs/logo.webp";
                                    }
                                ?>" alt="">
                                <a href="./article.php?id=<?php echo $data['id']?>" class='btn'><?php echo $data['title']?></a>
                            </div>
                        <?php endforeach;?>
                    </div>
                </div>
                <div dir='rtl' class="col-md-8 col-12 content">
                    <?php echo $cRow['content']?>
                </div>
                <div class='list listSm col-10 d-flex d-md-none'>
                    <img src="./layout/imgs/logo.webp" alt="">
                    <div class="social">
                        <a href="https://www.facebook.com/profile.php?id=100086581486734" style='background-color:#129AF6;'><i class="fa-brands fa-facebook-f"></i></a>
                        <a href="" style='background-color:#24C24A;'><i class="fa-brands fa-whatsapp"></i></a>
                        <a href="https://github.com/ahmedfathiaboelanin" style='background-color:#000;'><i class="fa-brands fa-github"></i></a>
                        <a href="https://www.linkedin.com/in/ahmed-fathi-1a4593247/" style='background-color:#518EF5;'><i class="fa-brands fa-linkedin-in"></i></a>
                    </div>
                    <div class="hots">
                        <div class='mt-1 fs-4' style='color:var(--text);'>HOT ARTICLES</div>
                        <?php foreach($hotRow as $data):?>
                            <div class="hot">
                                <img src="<?php
                                    if(!empty($data['img'])){
                                        echo $data['img'];
                                    }else{
                                        echo "./layout/imgs/logo.webp";
                                    }
                                ?>" alt="">
                                <a href="./article.php?id=<?php echo $data['id']?>" class='btn'><?php echo $data['title']?></a>
                            </div>
                        <?php endforeach;?>
                    </div>
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