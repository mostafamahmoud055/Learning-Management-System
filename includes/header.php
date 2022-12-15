<!doctype html>
<?php
session_start();
if (!isset($_SESSION["username"])) {
  header("location:login.php");
}

$filename = basename($_SERVER['REQUEST_URI']);
ob_start(); 
$conn = new mysqli('localhost', 'root', '', 'lms');
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
} 


?>
<html lang="en">

<head>

  <!--====== Required meta tags ======-->
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!--====== Title ======-->
  <title>Sphinx - LMS Education</title>

  <!--====== Favicon Icon ======-->
  <link rel="shortcut icon" href="images/logo-2.png" type="image/png">

  <!--====== Slick css ======-->
  <link rel="stylesheet" href="css/slick.css">

  <!--====== Animate css ======-->
  <link rel="stylesheet" href="css/animate.css">

  <!--====== Nice Select css ======-->
  <link rel="stylesheet" href="css/nice-select.css">

  <!--====== Nice Number css ======-->
  <link rel="stylesheet" href="css/jquery.nice-number.min.css">

  <!--====== Magnific Popup css ======-->
  <link rel="stylesheet" href="css/magnific-popup.css">

  <!--====== Bootstrap css ======-->
  <link rel="stylesheet" href="css/bootstrap.min.css">

  <!--====== Fontawesome css ======-->
  <link rel="stylesheet" href="css/font-awesome.min.css">

  <!--====== Default css ======-->
  <link rel="stylesheet" href="css/default.css">


  <!--====== Responsive css ======-->
  <link rel="stylesheet" href="css/responsive.css">

  <!--====== Style css ======-->
  <link rel="stylesheet" href="css/style.css">

  <!--====== popper ======-->
  <script src="./js/popper.min.js"></script>

  <!--====== jquery ======-->
  <script src="./js/jquery-3.6.0.min.js"></script>



</head>

<body>

  <!--====== PRELOADER PART START ======-->

    <!-- <div class="preloader">
      <div class="loader rubix-cube">
        <div class="layer layer-1"></div>
        <div class="layer layer-2"></div>
        <div class="layer layer-3 color-1"></div>
        <div class="layer layer-4"></div>
        <div class="layer layer-5"></div>
        <div class="layer layer-6"></div>
        <div class="layer layer-7"></div>
        <div class="layer layer-8"></div>
      </div>
    </div> -->

  <!--====== PRELOADER PART START ======-->

  <!--====== HEADER PART START ======-->

  <header id="header-part">

    <div class="header-top d-none d-lg-block">
      <div class="container">
        <div class="row  align-items-center">
          <div class="col-lg-7">
            <div class="header-contact text-lg-left text-center">
              <ul class="d-flex">
                <li class="d-flex align-items-center"><img src="images/all-icon/map.png" alt="icon"><span>127 El Horreya Rd. EL SHALALAT, Alexandria, Egypt</span></li>
                <li class="d-flex align-items-center"><img src="images/all-icon/email.png" alt="icon"><span>Sphinx@sayegh1944.com</span></li>
              </ul>
            </div>
          </div>
          <div class="col-lg-5">
            <div class="header-opening-time text-lg-right text-center">
              <p>Opening Hours : Saturay to wednesday - 9 Am to 5 Pm</p>
            </div>
          </div>
        </div> <!-- row -->
      </div> <!-- container -->
    </div> <!-- header top -->

    <div class="header-logo-support pt-30 pb-30">
      <div class="container">
        <div class="row">
          <div class="col-lg-4 col-md-4">
            <div class="logo">
              <a href="home.php">
                <img src="images/logo.png" alt="Logo">
              </a>
            </div>
          </div>
          <div class="col-lg-8 col-md-8">
            <div class="support-button float-right d-none d-md-block">
              <div class="support float-left">
                <div class="icon">
                  <img src="images/all-icon/support.png" alt="icon">
                </div>
                <div class="cont">
                  <p>Need Help? call us free</p>
                  <span>123 456 789</span>
                </div>
              </div>

            </div>
          </div>
        </div> <!-- row -->
      </div> <!-- container -->
    </div> <!-- header logo support -->

    <div class="navigation">
      <div class="container">
        <div class="row align-items-baseline">
          <div class="col-md-8 col-sm-4 col-2">
            <nav class="navbar navbar-expand-xl">
              <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>

              <div class="collapse navbar-collapse sub-menu-bar" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                  <li class="nav-item">
                    <a class="<?= $filename == "home.php" ? "active" :"" ?>" href="home.php">Home</a>
                    <!-- <ul class="sub-menu">
                      <li><a class="active" href="home.php">Home 01</a></li>
                      <li><a href="index-3.php">Home 02</a></li>
                      <li><a href="index-4.php">Home 03</a></li>
                    </ul> -->
                  </li>
                  <li class="nav-item">
                    <a class="<?= $filename == "about.php" ? "active" :"" ?>" href="about.php">About us</a>
                  </li>
                  <li class="nav-item">
                    <a class="<?= $filename == "courses.php" ? "active" :"" ?>" href="courses.php">Courses</a>
                    <!-- <ul class="sub-menu">
                      <li><a href="courses.php">Courses</a></li>
                      <li><a href="courses-singel.php">Course Singel</a></li>
                    </ul> -->
                  </li>
                  <!-- <li class="nav-item">
                    <a href="events.php">Events</a>
                    <ul class="sub-menu">
                      <li><a href="events.php">Events</a></li>
                      <li><a href="events-singel.php">Event Singel</a></li>
                    </ul>
                  </li> -->
                  <li class="nav-item">
                    <a class="<?= $filename == "teachers.php" ? "active" :"" ?>" href="teachers.php">Our teachers</a>
                    <!-- <ul class="sub-menu">
                      <li><a href="teachers.php">teachers</a></li>
                      <li><a href="teachers-singel.php">teacher Singel</a></li>
                    </ul> -->
                  </li>
                  <li class="nav-item">
                    <a class="<?= $filename == "blog.php" ? "active" :"" ?>" href="blog.php">Blog</a>
                    <!-- <ul class="sub-menu">
                      <li><a href="blog.php">Blog</a></li>
                      <li><a href="blog-singel.php">Blog Singel</a></li>
                    </ul> -->
                  </li>
                  <!-- <li class="nav-item">
                    <a href="shop.php">Shop</a>
                    <ul class="sub-menu">
                      <li><a href="shop.php">Shop</a></li>
                      <li><a href="shop-singel.php">Shop Singel</a></li>
                    </ul>
                  </li> -->
                  <li class="nav-item">
                    <a class="<?= $filename == "contact.php" ? "active" :" " ?>" href="contact.php">Contact</a>
                    <!-- <ul class="sub-menu">
                      <li><a href="contact.php">Contact Us</a></li>
                      <li><a href="contact-2.php">Contact Us 2</a></li>
                    </ul> -->
                  </li>
                </ul>
              </div>
            </nav> <!-- nav -->
          </div>
          <div class="col-md-4 col-sm-8 col-10">
            <div class="right-icon text-left">
              <ul class="d-flex align-items-center">



                <div class="dropdown">
                  <a class="user btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <?= $_SESSION["username"] ?>
                  </a>

                  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                    <a class="dropdown-item" href="logout.php">logout</a>
                  </div>
                </div>

                <?php if($_SESSION["username"]=="teacher"){?>
                <li class="divider "></li>
                <li class="d-flex text-center" style="gap: 20px;">
                  <!----------------------------------------- edit-mode---------------------------- -->


                  <form id="editmodeform" action="" method="post" class="d-flex align-items-center editmode-switch-form">
                    <div class="input-group mode" style="align-items: end;gap: 5px;justify-content: center;margin-top: 5px;margin-left: 5px;">
                      <label for="editmode">Edit mode</label>
                      <label>
                        <input id="editmode" name="checkform" type="checkbox" <?= isset($_POST['checkform']) ? 'checked': ""?>>
                        <span class='check'></span>
                      </label>
                    </div>

                    <input type="submit" value="Setmode">

                  </form>


                  <!----------------------------------------- edit-mode------------------------------------- -->
                </li>
                <?php }?>
                <li class="divider "></li>
          
                  <div class="dropdown">
                    <button class="notify btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="fa fa-bell" aria-hidden="true"></i><span class="num">0</span>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                      <a class="dropdown-item" href="#">There is no notification</a>

                    </div>
                  </div>
           
              </ul>
            </div> <!-- right icon -->
          </div>
        </div> <!-- row -->
      </div> <!-- container -->
    </div>

  </header>