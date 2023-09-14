<?php
// connect to database
    include './includes/components/config.php';
//---------------------
// get courses from database
    $q="SELECT CS.id as courseId,CS.cat_id as courseCat,CS.name as courseName,CS.img as courseImg,Cat.id as catId,Cat.name as catName,Cat.img as catImg FROM courses as CS JOIN categories as Cat on CS.cat_id=Cat.id ";
    $stmt = mysqli_query($con,$q);
    $cRow= mysqli_fetch_all($stmt,MYSQLI_ASSOC);
    
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
            <?php include "./layout/css/courses.css"?>
        </style>
    <!-- END css -->
</head>
<body>
    <?php include "./includes/components/nav.php"?>
    <section class="courses pt-3">
        <div class="container-fluid">
            <div class="row justify-content-center gap-5">
                <div class="col-sm-10 col-10 courseSec">
                    <div class='list'>
                        <ul>
                            <li data-filter='*' class='btn btn-outline my-2 active'>All</li>
                            <li data-filter='.Basics' class='btn btn-outline my-2'>Basics</li>
                            <li data-filter='.Frontend' class='btn btn-outline my-2'>Front-end</li>
                            <li data-filter='.Backend' class='btn btn-outline my-2'>Back-end</li>
                            <li data-filter='.Fullstack' class='btn btn-outline my-2'>FullStack</li>
                        </ul>
                    </div>
                    <div class="gallery">
                        <div class="row grid gap-3 justify-content-center">
                            <?php foreach($cRow as $data):?>
                                <div class="course m-3 <?php echo $data["catName"]?> item">
                                    <div class="thumbnail">
                                        <img src="<?php echo $data["courseImg"]?>" class='img-fluid' alt="">
                                    </div>
                                    <div class="caption">
                                        <span class='mb-1 d-inline-block'><?php echo $data["courseName"]?></span>
                                        <br>
                                        <!-- <span class='mb-1 d-inline-block'>Description : Back-end is a web application framework for building web applications.</span> -->
                                        <a href="./course.php?id=<?php echo $data["courseId"]?>" class='btn'>Enroll Now</a>
                                    </div>
                                </div>
                            <?php endforeach;?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php
    include "./includes/components/footer.php"
    ?>
    <?php include "./includes/js.php"?>
    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <script src="./layout/js/isotope.pkgd.min.js"></script>
    <script>
        var $grid = $('.grid').isotope({
        // options
        });
        // filter items on button click
        $('.list').on( 'click', 'li', function() {
        var filterValue = $(this).attr('data-filter');
        $grid.isotope({ filter: filterValue });
        });
        
        let btns = document.querySelectorAll(".list li");
        for (let i = 0; i < btns.length; i++) { 
            btns[i].onclick = function () { 
                for (let j = 0; j < btns.length; j++) {
                    btns[j].classList.remove("active");
                }
                btns[i].classList.add("active");
            }
        }
    </script>
</body>
</html>