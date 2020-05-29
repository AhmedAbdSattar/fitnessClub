<?php
  require_once("../sessionConfig.php");

  if($_SESSION['permission'] != 2){
    header("Location: ../login.php");//redirect to login page
    exit();
  }
?>
