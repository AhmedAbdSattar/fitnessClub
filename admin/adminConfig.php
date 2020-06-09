<?php
  require_once("../sessionConfig.php");
  if($_SESSION['permission'] != 1){
    header("Location: ../login.php");//redirect to login page
    exit();
  }

  include_once("menuBar.php");
?>
