
 <?php
 ob_start();

 include  "includes/header.php";

 unset($_SESSION);
 session_destroy();
 header("location:login.php");
include "includes/footer.php";
ob_end_flush();
 ?>