<?php

include "includes/header.php";

$sql = "SELECT * FROM `courses` ";
$result = $conn->query($sql);
$result = mysqli_fetch_all($result, MYSQLI_ASSOC);

// print_r($result);die;

if (isset($_POST["createcourse"])) {
    if (empty($_POST["name"]) ) {
        $_SESSION["createcourse-validation"]["name"] = "<div class='alert alert-danger m-0 error' role='alert'>
        Name is required
        </div>";
    }
    
    if (isset($_FILES["photo"]) && $_FILES["photo"]["error"] == 0) {
        
        if (in_array(explode(".", $_FILES["photo"]["name"])[1], ["jpg", "png", "jpeg"])) {
            
            $_FILES["photo"]["name"] = time() . "." . explode(".", $_FILES["photo"]["name"])[1];
            $path = getcwd() . "/images/courses/";
            move_uploaded_file($_FILES["photo"]["tmp_name"], $path . $_FILES["photo"]["name"]);
        } else {
            $_SESSION["createcourse-validation"]["photo"] = "<div class='alert alert-danger m-0 error' role='alert'>
            photo must be jpg or png or jpeg
            </div>";
        }
    }
    if (!isset($_FILES["photo"]) && $_FILES["photo"]["error"] == 4) {
        $_SESSION["createcourse-validation"]["photo"] = "<div class='alert alert-danger m-0 error' role='alert'>
        Photo is required
        </div>";
    }
    // print_r($_POST);
    // echo "<br>";
    // print_r($_FILES);
    if (!empty($_SESSION["createcourse-validation"])) {
        unset($_POST["createcourse"]);
        // unset($_SESSION["createcourse-validation"]);
        header("location:courses.php");
    } else {
        unset($_POST["createcourse"]);
        $name = $_POST["name"];
        $photo = $_FILES["photo"]["name"];
        $sql = "INSERT INTO courses (`name`,`photo`) VALUES('$name','$photo')";
        $conn->query($sql);

        header("location:courses.php");
    }
}

?>
<!--====== PAGE BANNER PART START ======-->

<section id="page-banner" class="pt-105 pb-110 bg_cover" data-overlay="8" style="background-image: url(images/page-banner-2.jpg)">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="page-banner-cont">
                    <h2>Our Courses</h2>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Courses</li>
                        </ol>
                    </nav>
                </div> <!-- page banner cont -->
            </div>
        </div> <!-- row -->
    </div> <!-- container -->
</section>

<!--====== PAGE BANNER PART ENDS ======-->

<!--====== COURSES PART START ======-->

<section id="courses-part" class="pt-120 pb-120 gray-bg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="courses-top-search">
                    <ul class="nav float-left" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="active" id="courses-grid-tab" data-toggle="tab" href="#courses-grid" role="tab" aria-controls="courses-grid" aria-selected="true"><i class="fa fa-th-large"></i></a>
                        </li>
                        <li class="nav-item">
                            <a id="courses-list-tab" data-toggle="tab" href="#courses-list" role="tab" aria-controls="courses-list" aria-selected="false"><i class="fa fa-th-list"></i></a>
                        </li>
                        <li class="nav-item">Showning 4 0f 24 Results</li>
                    </ul> <!-- nav -->

                    <div class="courses-search float-right">
                        <form action="#">
                            <input type="text" placeholder="Search">
                            <button type="button"><i class="fa fa-search"></i></button>
                        </form>
                    </div> <!-- courses search -->
                </div> <!-- courses top search -->
            </div>
        </div> <!-- row -->
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="courses-grid" role="tabpanel" aria-labelledby="courses-grid-tab">
                <div class="row">
                    <?php for ($i = 0; $i < count($result); $i++) { ?>
                        <div class="col-lg-4 col-md-6">
                            <div class="singel-course mt-30">
                                <div class="thum">
                                    <div class="image">
                                        <img src="images/course/cu-<?= $result[$i]["id"] ?>.jpg" alt="Course">
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
                                    <span>(20 Reviws)</span><br>
                                    <a href="courses-singel.php?id=<?= $result[$i]["id"] ?>&course=<?= $result[$i]["name"] ?>">
                                        <h4><?= $result[$i]["name"] ?></h4>
                                    </a>
                                    <div class="course-teacher">
                                        <div class="thum">
                                            <a href="#"><img src="images/course/teacher/t-1.jpg" alt="teacher"></a>
                                        </div>
                                        <div class="name">
                                            <a href="#">
                                                <h6>Mark anthem</h6>
                                            </a>
                                        </div>
                                        <div class="admin">
                                            <ul>
                                                <li><a href="#"><i class="fa fa-user"></i><span>31</span></a></li>
                                                <li><a href="#"><i class="fa fa-heart"></i><span>10</span></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- singel course -->
                        </div>
                    <?php } ?>
                    <?php if(isset($_POST["checkform"]) && $_POST["checkform"]  == "on"){?>
                    <div title="Add Course" class="addCourse" style="font-size:3rem ; align-self: end;cursor:pointer">
                        <i class="fa fa-plus-square-o" aria-hidden="true"></i>

                    </div>
                    <?php }?>

                </div> <!-- row -->
                <button type="button" id="createcoursebutton" class="btn btn-primary d-none" data-toggle="modal" data-target="#createcoursemodal" data-whatever="@mdo">Open modal for @mdo</button>



                <div class="modal fade" id="createcoursemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">New course</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form id="createcourseform" action="courses.php" method="post" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label for="create-name" class="col-form-label">Name:</label>
                                        <input type="text" class="form-control" name="name" id="create-name">
                                        <?= isset($_SESSION["createcourse-validation"]["name"]) ? $_SESSION["createcourse-validation"]["name"] : "" ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="file-name" class="col-form-label">Photo:</label>
                                        <input type="file" name="photo" class="form-control" id="file-name">
                                        <?= isset($_SESSION["createcourse-validation"]["photo"]) ? $_SESSION["createcourse-validation"]["photo"] : "" ?>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button form="createcourseform" type="submit" name="createcourse" class="btn btn-primary">Create</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="courses-list" role="tabpanel" aria-labelledby="courses-list-tab">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="singel-course mt-30">
                            <div class="row no-gutters">
                                <div class="col-md-6">
                                    <div class="thum">
                                        <div class="image">
                                            <img src="images/course/cu-1.jpg" alt="Course">
                                        </div>
                                        <div class="price">
                                            <span>Free</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="cont">
                                        <ul>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                        </ul>
                                        <span>(20 Reviws)</span>
                                        <a href="#">
                                            <h4>Learn basis javascirpt from start for beginner</h4>
                                        </a>
                                        <div class="course-teacher">
                                            <div class="thum">
                                                <a href="#"><img src="images/course/teacher/t-1.jpg" alt="teacher"></a>
                                            </div>
                                            <div class="name">
                                                <a href="#">
                                                    <h6>Mark anthem</h6>
                                                </a>
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
                            </div> <!--  row  -->
                        </div> <!-- singel course -->
                    </div>
                    <div class="col-lg-12">
                        <div class="singel-course mt-30">
                            <div class="row no-gutters">
                                <div class="col-md-6">
                                    <div class="thum">
                                        <div class="image">
                                            <img src="images/course/cu-2.jpg" alt="Course">
                                        </div>
                                        <div class="price">
                                            <span>Free</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="cont">
                                        <ul>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                        </ul>
                                        <span>(20 Reviws)</span>
                                        <a href="#">
                                            <h4>Learn basis javascirpt from start for beginner</h4>
                                        </a>
                                        <div class="course-teacher">
                                            <div class="thum">
                                                <a href="#"><img src="images/course/teacher/t-2.jpg" alt="teacher"></a>
                                            </div>
                                            <div class="name">
                                                <a href="#">
                                                    <h6>Mark anthem</h6>
                                                </a>
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
                            </div> <!--  row  -->
                        </div> <!-- singel course -->
                    </div>
                    <div class="col-lg-12">
                        <div class="singel-course mt-30">
                            <div class="row no-gutters">
                                <div class="col-md-6">
                                    <div class="thum">
                                        <div class="image">
                                            <img src="images/course/cu-3.jpg" alt="Course">
                                        </div>
                                        <div class="price">
                                            <span>Free</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="cont">
                                        <ul>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                        </ul>
                                        <span>(20 Reviws)</span>
                                        <a href="#">
                                            <h4>Learn basis javascirpt from start for beginner</h4>
                                        </a>
                                        <div class="course-teacher">
                                            <div class="thum">
                                                <a href="#"><img src="images/course/teacher/t-3.jpg" alt="teacher"></a>
                                            </div>
                                            <div class="name">
                                                <a href="#">
                                                    <h6>Mark anthem</h6>
                                                </a>
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
                            </div> <!--  row  -->
                        </div> <!-- singel course -->
                    </div>
                    <div class="col-lg-12">
                        <div class="singel-course mt-30">
                            <div class="row no-gutters">
                                <div class="col-md-6">
                                    <div class="thum">
                                        <div class="image">
                                            <img src="images/course/cu-4.jpg" alt="Course">
                                        </div>
                                        <div class="price">
                                            <span>Free</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="cont">
                                        <ul>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                        </ul>
                                        <span>(20 Reviws)</span>
                                        <a href="#">
                                            <h4>Learn basis javascirpt from start for beginner</h4>
                                        </a>
                                        <div class="course-teacher">
                                            <div class="thum">
                                                <a href="#"><img src="images/course/teacher/t-4.jpg" alt="teacher"></a>
                                            </div>
                                            <div class="name">
                                                <a href="#">
                                                    <h6>Mark anthem</h6>
                                                </a>
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
                            </div> <!--  row  -->
                        </div> <!-- singel course -->
                    </div>
                </div> <!-- row -->
            </div>
        </div> <!-- tab content -->
        <div class="row">
            <div class="col-lg-12">
                <nav class="courses-pagination mt-50">
                    <ul class="pagination justify-content-center">
                        <li class="page-item">
                            <a href="#" aria-label="Previous">
                                <i class="fa fa-angle-left"></i>
                            </a>
                        </li>
                        <li class="page-item"><a class="active" href="#">1</a></li>
                        <!-- <li class="page-item"><a href="#">2</a></li>
                            <li class="page-item"><a href="#">3</a></li> -->
                        <li class="page-item">
                            <a href="#" aria-label="Next">
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                    </ul>
                </nav> <!-- courses pagination -->
            </div>
        </div> <!-- row -->
    </div> <!-- container -->
</section>

<!--====== COURSES PART ENDS ======-->
<?php if (isset($_SESSION["createcourse-validation"])) { ?>    
    <script>
        $('#createcoursemodal').modal('show');
    </script>
<?php
}
unset($_SESSION["createroom-validation"]); 
?>



<?php 

include "includes/footer.php";
?>