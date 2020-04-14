<?php
  $conn = new mysqli("localhost", "root", "", "gym")
    OR
  die("<script> alert('can't connect to DB'); </script>" . $conn->connect_error);//open connection to DB or output error message
  define("personeImage","../photos/");//define constant
  $today = array('Saturday', 'Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday');
?>
