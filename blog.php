<?php
// connect to database
    include './includes/components/config.php';
//---------------------
// get articles from database
    if(isset($_GET['per'])){
        $per = $_GET['per'];
    }else{
        $per = 3;
    }
    if(isset($_GET['page'])){
        $page = $_GET['page'];
    }else{
        $page = 1;
    }
    $start = ($per*$page) - $per;
    $q="SELECT title,author,date,img,id,cat_id FROM blogs order by date desc limit $start,$per";
    $stmt = mysqli_query($con,$q);
    $cRow= mysqli_fetch_all($stmt,MYSQLI_ASSOC);

    $q="SELECT title FROM blogs";
    $stmt = mysqli_query($con,$q);
    $c= mysqli_num_rows($stmt);
    $pages = ceil($c / $per);

    // search
        if($_SERVER["REQUEST_METHOD"]==="POST"){
            $term = $_POST['search'];
            if(!empty($term)){
                $q="SELECT title,author,date,img,id,cat_id FROM blogs WHERE title LIKE '%$term%'";
                $stmt = mysqli_query($con,$q);
                $cRow= mysqli_fetch_all($stmt,MYSQLI_ASSOC);

                $q="SELECT title FROM blogs";
                $stmt = mysqli_query($con,$q);
                $c= mysqli_num_rows($stmt);
                $pages = ceil($c / $per);
            }else{
                $q="SELECT title,author,date,img,id,cat_id FROM blogs";
                $stmt = mysqli_query($con,$q);
                $cRow= mysqli_fetch_all($stmt,MYSQLI_ASSOC);

                $q="SELECT title FROM blogs";
                $stmt = mysqli_query($con,$q);
                $c= mysqli_num_rows($stmt);
                $pages = ceil($c / $per);
            }
        }
    // ---------------
// -------------------------
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
            <?php include "./layout/css/blog.css"?>
        </style>
    <!-- END css -->
</head>
<body>
    <?php include "./includes/components/nav.php"?>
    <section class="blogs" style='min-height:100vh;'>
        <div class="container-fluid">
            <div class="row justify-content-center gap-5"  style='flex-wrap:wrap-reverse;'>         
                <div class="content grid col-sm-8 col-10">
                    <?php foreach($cRow as $data):?>
                        <?php 
                            $cid= $data['cat_id'];
                            $q="SELECT name FROM categories WHERE id = $cid";
                            $stmt = mysqli_query($con,$q);
                            $cRow= mysqli_fetch_assoc($stmt);
                        ?>
                    <div class="article row <?php echo $cRow['name']?> g-3">
                        <img src='<?php 
                            if(!empty($data['img'])){
                                echo $data['img'];
                            }else{
                                echo "./layout/imgs/courses/boot.png";
                            }
                        ?>' class="col-12 col-md-5 mb-1" alt=''>
                        <div dir='' class="text  col-12 col-md-7">
                            <p>Title : <?php echo $data['title']?></p>
                            <p>Author : <?php echo $data['author']?></p>
                            <p>Date : <?php echo $data['date']?></p>
                            <a href="./article.php?id=<?php echo $data['id']?>" class='btn'>Read more</a>
                        </div>
                    </div>
                    <?php endforeach;?>
                    <div class="pagination">
                        <?php for($i=1;$i<=$pages;$i++):?>
                            <a class='btn' href="?page=<?php echo $i?>&per=<?php echo $per?>"><?php echo $i?></a>
                        <?php endfor;?>
                    </div>
                </div>
                <div class='list col-sm-3 col-10'>
                    <ul>
                        <form action="" method='POST'>
                            <input type="search" name='search' placeholder='Search by Title' class='form-control'>
                            <button>Search</button>
                        </form>
                    </ul>
                    <img src="./layout/imgs/logo.webp" alt="">
                    <div class="social">
                        <a href="" style='background-color:#129AF6;'><i class="fa-brands fa-facebook-f"></i></a>
                        <a href="" style='background-color:#24C24A;'><i class="fa-brands fa-whatsapp"></i></a>
                        <a href="" style='background-color:#000;'><i class="fa-brands fa-github"></i></a>
                        <a href="" style='background-color:#518EF5;'><i class="fa-brands fa-linkedin-in"></i></a>
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