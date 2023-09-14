<?php
// connect to database
    include './includes/components/config.php';
//---------------------
// get course from database
    if($_SERVER['REQUEST_METHOD']==='GET' && !empty($_GET['id']) && is_numeric($_GET['id'])){
        $id=(int)$_GET['id'];
        if(isset($_SESSION['info']) && !empty($_SESSION['info'])){
            $user=$_SESSION['info']['id'];
            $favQ="SELECT * FROM fav_courses WHERE course_id=$id && user_id	=$user";
            $favStmt = mysqli_query($con,$favQ);
            $favRow= mysqli_fetch_assoc($favStmt);
        }
        $q="SELECT * FROM `videos` WHERE course_id=$id";
        $stmt = mysqli_query($con,$q);
        $row= mysqli_fetch_all($stmt,MYSQLI_ASSOC);
        if(empty($row)){
            header('location: ./soon.php');
            exit();
        }
    }else{
        header('location: ./courses.php');
        exit();
    }
    
    
// -------------------------
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Courses</title>
    <!-- css -->
        <?php include "./includes/css.php"?>
        <style>
            <?php include "./layout/css/video.css"?>
        </style>
    <!-- END css -->
</head>
<body>
    <?php include "./includes/components/nav.php"?>
    <section class="courses py-0">
        <div class="row">
            <ul class="btnList col-sm-3 d-none d-sm-flex flex-column gap-1">
                <?php foreach($row as $data):?>
                <li class='w-100 btn' data-url='<?php echo $data['url']?>' data-title='<?php echo $data['title']?>'>Lesson 1</li>
                <?php endforeach;?>
            </ul>
            <ul class="btnList minList d-sm-none d-flex flex-column gap-1">
                <i class="fa-solid fa-xmark" id='close'></i>
                <?php foreach($row as $data):?>
                <li class='w-100 btn' data-url='<?php echo $data['url']?>' data-title='<?php echo $data['title']?>'>Lesson 1</li>
                <?php endforeach;?>
            </ul>
            <div class="col container video text-center">
                <iframe id="frame" width="727" height="409" 
                src="<?php echo $row[0]['url']?>" 
                title="Isotope plugin jquery | portfolio filter gallery | 
                image gallery filter javascript in Hindi 2021" 
                frameborder="0" allow="accelerometer; autoplay; 
                clipboard-write; encrypted-media; gyroscope; 
                picture-in-picture; web-share" 
                allowfullscreen></iframe>
                <h3 id='title' class='mb-3'><?php echo $row[0]['title']?></h3>
                <i class="fa-solid fa-angle-right d-sm-none" id='arrow'></i>
                <?php if(isset($_SESSION['info']) && !empty($_SESSION['info'])):?>
                    <?php if(empty($favRow)):?>
                        <a href="./fav.php?cId=<?php echo $id?>&uId=<?php echo $user?>" class='btn btn-primary d-block text-center w-50 '>Add to favorites list</a>
                    <?php else:?>
                        <p class='btn btn-success d-block text-center w-50 '>This course has been added</p>
                        <a href="./deleteCourse.php?id=<?php echo $id?>" class='btn btn-danger d-block text-center w-50 '>Delete from favorites list</a>
                    <?php endif;?>
                <?php else:?>
                    <a href="./login.php" class='btn btn-primary d-block text-center w-50 '>Add to favorites list</a>
                <?php endif;?>
            </div>
        </div>
    </section>
    <?php
    // include "./includes/components/footer.php"
    ?>
    <?php include "./includes/js.php"?>
    <script>
        let btns = document.querySelectorAll(".btnList li");
        let minBtns = document.querySelectorAll(".minList li");
        let side = document.querySelector(".minList");
        btns[0].classList.add("active");
        for (let i = 0; i < btns.length; i++) { 
            btns[i].textContent=`Lesson ${i+1}`
            btns[i].onclick = function () { 
                for (let j = 0; j < btns.length; j++) {
                    btns[j].classList.remove("active");
                }
                btns[i].classList.add("active");
                let frame = document.getElementById("frame");
                frame.src = btns[i].getAttribute("data-url");
                document.getElementById("title").textContent=btns[i].getAttribute("data-title")
            }
        }
        minBtns[0].classList.add("active");
        for (let i = 0; i < minBtns.length; i++) { 
            minBtns[i].textContent=`Lesson ${i+1}`
            minBtns[i].onclick = function () { 
                for (let j = 0; j < minBtns.length; j++) {
                    minBtns[j].classList.remove("active");
                }
                minBtns[i].classList.add("active");
                let frame = document.getElementById("frame");
                frame.src = minBtns[i].getAttribute("data-url");
                document.getElementById("title").textContent=minBtns[i].getAttribute("data-title");
                side.classList.toggle("show");
            }
        }
        document.getElementById("close").onclick = function () {
            side.classList.toggle("show");
        }
        document.getElementById("arrow").onclick = function () {
                side.classList.toggle("show");
        }
    </script>
</body>
</html>