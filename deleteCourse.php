<?php
// connect to database
    include './includes/components/config.php';
//---------------------
// get course from database
    if($_SERVER['REQUEST_METHOD']==='GET' && !empty($_GET['id']) && is_numeric($_GET['id'])){
        $cId=(int)$_GET['id'];
        $user=$_SESSION['info']['id'];

        $q="SELECT * FROM `fav_courses` WHERE course_id =$cId and user_id =$user";
        $stmt = mysqli_query($con,$q);
        $row= mysqli_fetch_all($stmt,MYSQLI_ASSOC);
        if(empty($row)){
            header('location: ./profile.php?sec=courses');
            exit();
        }else{
            $q="DELETE FROM `fav_courses` WHERE course_id = $cId and user_id = $user";
            $stmt = mysqli_query($con,$q);
            header('location: ./profile.php?sec=courses');
            exit();
        }
    }else{
        header('location: ./profile.php?sec=courses');
        exit();
    }
    
    
// -------------------------
?>