<!doctype html>
<?php
 session_start();
ob_start();

if (isset($_SESSION["username"])) {
    header("location:home.php");
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

    <!--====== Style css ======-->
    <link rel="stylesheet" href="css/style.css">

    <!--====== Responsive css ======-->
    <link rel="stylesheet" href="css/responsive.css">


    <!--====== jquery ======-->
    <script src="./js/jquery-3.6.0.min.js"></script>

</head>

<body>

 <?php
$errors = [];
if (isset($_POST["login"])) {

    if (empty($_POST["username"])) {
        $errors["username"] = "<div class='alert alert-danger m-0 error' role='alert'>
        username is required
        </div><br>";
    }

    if (empty($_POST["password"])) {
        $errors["password"] = "<div class='alert alert-danger m-0 error' role='alert'>
        password is required
        </div><br>";
    }

    if (empty($errors)) {

        $username = $_POST["username"];
        $password = $_POST["password"];

        $conn = new mysqli('localhost', 'root', '', 'lms');
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } else {
            $sql = "SELECT * FROM `users` WHERE `username` = '$username' AND `password` = '$password'";
            $result = $conn->query($sql);

            $sql = "SELECT * FROM `users` WHERE `username` = '$username' AND `password` = '$password'";
            $result = $conn->query($sql);

            $result = $result->fetch_assoc();
            if ((!empty($result))) {

                $res = $conn->query($sql);
                $_SESSION["id"] = $result['id'];
                $_SESSION["username"] = $result['username'];

                $conn->close();

                header("location:home.php");

            } else {

                $error['conn'] = "<div class='alert alert-danger m-0 error' role='alert'>
               incorrect username or password
             </div><br>";

            }

        }
    }
}

?>


<div class="login-container">
<h2 class="text-center h2-reg">Log in to Mount Orange School</h2>
<form class="d-flex justify-content-center flex-column m-auto login" action="" method="post" >
 <?=isset($error['conn']) ? $error["conn"] : ""?>

 <div class="login-form-username form-group">
            <label for="username" class="sr-only">
                    Username
            </label>
            <input type="text" name="username" id="username" class="form-control form-control-lg" value="" placeholder="Username" autocomplete="username">
        </div>
  <?=isset($errors["username"]) ? $errors["username"] : ""?>

  <div class="login-form-password form-group">
    <label for="password" class="sr-only">Password</label>
    <input type="password" name="password" id="password" value="" class="form-control form-control-lg" placeholder="Password" autocomplete="current-password">
</div>
  <?=isset($errors["password"]) ? $errors["password"] : ""?>

<div class="login-form-submit form-group">
            <button class="btn btn-primary btn-lg" type="submit" name="login" id="loginbtn">Log in</button>
  </div>


 </form>

 <div class="login-divider"></div>

 <div class="login-instructions ">
            <h2 class="login-heading">Is this your first time here?</h2><br>
            <h5><span>To explore this site, log in with the role of:</span></h5><br>
            <p><a href="http://school.moodledemo.net/mod/page/view.php?id=46" class="btn btn-sm btn-primary">Student</a> - with the username <b>student </b>and password <b>moodle</b></p><br>
            <p><a href="http://school.moodledemo.net/mod/page/view.php?id=45" class="btn btn-sm btn-primary">Teacher</a> - with the username <b>teacher</b> and password <b>moodle</b></p><br>
            <p><a href="http://school.moodledemo.net/mod/page/view.php?id=47" class="btn btn-sm btn-primary">Manager</a> - with the username <b>manager</b> and password <b>moodle</b></p><br>
            <p></p><h5>Or explore one of our many&nbsp;</h5><br>
            <a href="http://school.moodledemo.net/mod/page/view.php?id=55" class="btn btn-sm btn-primary">Other accounts</a>

</div>
        <div class="login-divider"></div>


        <h2 class="login-heading">Some courses may allow guest access</h2>


        <form action="https://school.moodledemo.net/login/home.php" method="post" id="guestlogin">
            <input type="hidden" name="logintoken" value="vtCW7AhcEWnQdYlHpDWFalQYGwetpCIq">
            <input type="hidden" name="username" value="guest">
            <input type="hidden" name="password" value="guest">

        </form>

        <div class="login-divider"></div>
        <div class="d-flex">
            <div class="login-languagemenu">
                <div class="action-menu moodle-actionmenu" id="action-menu-0" data-enhance="moodle-core-actionmenu">

                        <div class="menubar d-flex " id="action-menu-0-menubar">



                </div>
            </div>
            <div class="divider border-left align-self-center mx-3"></div>

    </div>

</div>
<button class="btn btn-secondary" type="submit" id="loginguestbtn">Log in as a guest</button>
<?php
$errors = [];?>

<script>
  $(function() {
    setTimeout(function() {
      $('.error').remove();
    }, 2000);
  });

</script>

<?php
include "includes/footer.php";
?>