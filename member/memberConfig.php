<?php
  require_once("../sessionConfig.php");

  if($_SESSION['permission'] != 3){
    header("Location: ../login.php");//redirect to login page
    exit();
  }

  if (isset($_POST['log']) && strcmp($_POST['log'], 'logout') == 0){
    session_unset();//remove all session variables
    session_destroy();//destroy the session
    header("Location: ../login.php");//redirect to login page
    exit();
  }

  include_once "NavBar.html";
?>
