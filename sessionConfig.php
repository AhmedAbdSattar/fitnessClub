<?php
session_start();
if(!isset($_SESSION['permission'])){
  header("Location: ../login.php");//redirect to login page
  exit();
}
if (time()-$_SESSION['last_login_timestamp'] > (20)){//check time of the last activty in the page in 20 seconds
  session_unset();//remove all session variables
  session_destroy();//destroy the session
  header("Location: ../login.php");//redirect to login page
  exit();
}

$_SESSION['last_login_timestamp'] = time();
?>
