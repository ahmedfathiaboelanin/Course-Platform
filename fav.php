<?php
// connect to database
    include './includes/components/config.php';
//---------------------
// get course from database
    if($_SERVER['REQUEST_METHOD']==='GET' && !empty($_GET['uId']) && is_numeric($_GET['uId']) && !empty($_GET['cId']) && is_numeric($_GET['cId'])){
        $cId=(int)$_GET['cId'];
        $uId=(int)$_GET['uId'];
        $user=$_SESSION['info']['id'];
        
        $q="SELECT * FROM `videos` WHERE course_id=$cId";
        $stmt = mysqli_query($con,$q);
        $row= mysqli_fetch_all($stmt,MYSQLI_ASSOC);
        if(empty($row)){
            header('location: ./courses.php');
            exit();
        }
        $favQ="SELECT * FROM fav_courses WHERE course_id=$cId && user_id=$user";
        $favStmt = mysqli_query($con,$favQ);
        $favRow= mysqli_fetch_assoc($favStmt);
        if(!empty($favRow)){
            header('location: ./courses.php');
            exit();
        }else{
            $q="INSERT INTO `fav_courses`(user_id, course_id) VALUES ($uId,$cId)";
            $stmt = mysqli_query($con,$q);
            header("location: ./course.php?id=$cId");
            exit();
        }
    }else{
        header('location: ./courses.php');
        exit();
    }
    
    
// -------------------------
?>