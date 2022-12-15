<?php

include "includes/header.php";
$sql = "SELECT
  `grades_courses`.id, `grades`.grade, `courses`.name
FROM
   `grades_courses`
JOIN grades 
ON `grades_courses`.grade_id = `grades`.id 
join courses
ON `grades_courses`.course_id = `courses`.id 
ORDER by grade";
$result = $conn->query($sql);
$result = mysqli_fetch_all($result, MYSQLI_ASSOC);
// print_r($result);die;

$sqlco = "SELECT * FROM `courses` ";
$resultco = $conn->query($sqlco);
$resultco = mysqli_fetch_all($resultco, MYSQLI_ASSOC);

// print_r($result);die;


?>
<!--====== PAGE BANNER PART START ======-->

<section id="page-banner" class="pt-105 pb-110 bg_cover" data-overlay="8" style="background-image: url(images/page-banner-2.jpg)">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="page-banner-cont">
                    <h2>Learn <?= $_GET["course"] ?></h2>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                            <li class="breadcrumb-item"><a href="courses.php">Courses</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Learn <?= $_GET["course"] ?></li>
                        </ol>
                    </nav>
                </div> <!-- page banner cont -->
            </div>
        </div> <!-- row -->
    </div> <!-- container -->
</section>

<!--====== PAGE BANNER PART ENDS ======-->

<!--====== COURSES SINGEl PART START ======-->

<section id="corses-singel" class="pt-90 pb-120 gray-bg">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="corses-singel-left mt-30">

                    <div class="course-terms">
                        <div class="accordion" id="accordionExample">
                            <?php for ($i = 0; $i < count($result); $i++) { ?>



                                <div class="card ">
                                    <div class="card-header grade" id="headingOne<?= $result[$i]['id'] ?>">
                                        <h2 class="mb-0">
                                            <button class="btn lessons btn-link" type="button" data-toggle="collapse" data-target="#collapseOne<?= $result[$i]['id'] ?>" data-id="<?= $result[$i]['id'] ?>" data-course="<?= $result[$i]['name'] ?>" data-grade="<?= $result[$i]['grade'] ?>" aria-expanded="true" aria-controls="collapseOne" style="color: #fff;text-decoration: none;font-size: 2rem;">
                                                <?= $result[$i]['grade'] ?>
                                            </button>
                                        </h2>
                                    </div>

                                    <div id="collapseOne<?= $result[$i]['id'] ?>" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                                        <div class="card-body lessons<?= $result[$i]['id'] ?>">

                                        </div>
                                    </div>
                                </div>





                            <?php } ?>

                <button type="button" id="createlessonbutton" class="btn btn-primary d-none" data-toggle="modal" data-target="#createlessonmodal" data-whatever="@mdo">Open modal for @mdo</button>



                <div class="modal fade" id="createlessonmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">New Lesson</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form id="createlessonform" action="courses.php" method="post" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label for="create-name" class="col-form-label">Name:</label>
                                        <input type="text" class="form-control" name="name" id="create-name">
                                        <?= isset($_SESSION["createlesson-validation"]["name"]) ? $_SESSION["createlesson-validation"]["name"] : "" ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="file-name" class="col-form-label">Photo:</label>
                                        <input type="file" name="photo" class="form-control" id="file-name">
                                        <?= isset($_SESSION["createlesson-validation"]["photo"]) ? $_SESSION["createlesson-validation"]["photo"] : "" ?>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button form="createlessonform" type="submit" name="createlesson" class="btn btn-primary">Create</button>
                            </div>
                        </div>
                    </div>
                </div>
                        </div>

                    </div> <!-- course terms -->


                </div> <!-- corses singel left -->

            </div>
            <div class="col-lg-4">
                <div class="row">
                    <div class="col-lg-12 col-md-6">
                        <div class="course-features mt-30">
                            <h4>Course Features </h4>
                            <ul>
                                <li><i class="fa fa-clock-o"></i>Duaration : <span>10 Hours</span></li>
                                <li><i class="fa fa-clone"></i>Leactures : <span>09</span></li>
                                <li><i class="fa fa-beer"></i>Quizzes : <span>05</span></li>
                                <li><i class="fa fa-user-o"></i>Students : <span>100</span></li>
                            </ul>
                            <div class="price-button pt-10">
                                <span>Price : <b>$25</b></span>
                                <a href="#" class="main-btn">Enroll Now</a>
                            </div>
                        </div> <!-- course features -->
                    </div>
                    <div class="col-lg-12 col-md-6">
                        <div class="You-makelike mt-30">
                            <h4>You make like </h4>
                            <?php for ($i = 0; $i < count($result); $i++) { ?>
                            <div class="singel-makelike mt-20">
                                <div class="image">
                                    <img src="images/your-make/y-1.jpg" alt="Image">
                                </div>
                                <div class="cont">
                                    <a href="#">
                                        <h4> <a href="courses-singel.php?id=<?=$resultco[$i]["id"]?>&course=<?=$resultco[$i]["name"]?>"><h4><?=$result[$i]["name"]?></h4></a></h4>
                                    </a>
                                    <ul>
                                        <li><a href="#"><i class="fa fa-user"></i>31</a></li>
                                        <li>$50</li>
                                    </ul>
                                </div>
                            </div>
                            <?php }?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- <div class="row">
                <div class="col-lg-8">
                    <div class="releted-courses pt-95">
                        <div class="title">
                            <h3>Releted Courses</h3>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="singel-course mt-30">
                                    <div class="thum">
                                        <div class="image">
                                            <img src="images/course/cu-2.jpg" alt="Course">
                                        </div>
                                        <div class="price">
                                            <span>Free</span>
                                        </div>
                                    </div>
                                    <div class="cont">
                                        <ul>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                        </ul>
                                        <span>(20 Reviws)</span>
                                        <a href="courses-singel.php"><h4>Learn basis javascirpt from start for beginner</h4></a>
                                        <div class="course-teacher">
                                            <div class="thum">
                                                <a href="#"><img src="images/course/teacher/t-2.jpg" alt="teacher"></a>
                                            </div>
                                            <div class="name">
                                                <a href="#"><h6>Mark anthem</h6></a>
                                            </div>
                                            <div class="admin">
                                                <ul>
                                                    <li><a href="#"><i class="fa fa-user"></i><span>31</span></a></li>
                                                    <li><a href="#"><i class="fa fa-heart"></i><span>10</span></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div> 
                            </div>
                            <div class="col-md-6">
                                <div class="singel-course mt-30">
                                    <div class="thum">
                                        <div class="image">
                                            <img src="images/course/cu-1.jpg" alt="Course">
                                        </div>
                                        <div class="price">
                                            <span>Free</span>
                                        </div>
                                    </div>
                                    <div class="cont">
                                        <ul>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                        </ul>
                                        <span>(20 Reviws)</span>
                                        <a href="courses-singel.php"><h4>Learn basis javascirpt from start for beginner</h4></a>
                                        <div class="course-teacher">
                                            <div class="thum">
                                                <a href="#"><img src="images/course/teacher/t-3.jpg" alt="teacher"></a>
                                            </div>
                                            <div class="name">
                                                <a href="#"><h6>Mark anthem</h6></a>
                                            </div>
                                            <div class="admin">
                                                <ul>
                                                    <li><a href="#"><i class="fa fa-user"></i><span>31</span></a></li>
                                                    <li><a href="#"><i class="fa fa-heart"></i><span>10</span></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div> 
                            </div>
                        </div>  
                    </div> 
                </div>
            </div>  -->
    </div> <!-- container -->
</section>

<!--====== COURSES SINGEl PART ENDS ======-->


<?php
include "includes/footer.php";
?>