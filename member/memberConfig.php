<?php
  require_once("../sessionConfig.php");

  if($_SESSION['permission'] != 3){
    header("Location: ../login.php");//redirect to login page
    exit();
  }
?>
