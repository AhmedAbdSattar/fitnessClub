<?php
  require_once("adminConfig.php");
  if (isset($_POST['logout'])){
    session_unset();//remove all session variables
    session_destroy();//destroy the session
    header("Location: ../login.php");//redirect to login page
    exit();
  }
?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="MenuBarStyle.css">
</head>
<body>

  <div class="navbar">
    <a href="Admin_Home_Page.php">Home</a>
    <form method="post" id="logoutForm">
      <input type="hidden" id='logout' name="logout">
    </form>
     <a href="../rest account info/changeE-mail.php">Account</a>
     <a onclick="linkFN()">logout</a>
     <script>
      function linkFN(){
        document.getElementById("logout").value = 'logout';
        document.getElementById("logoutForm").submit();
      }
     </script>
    <div class="dropdown">
      <button class="dropbtn">MANAGE
        <i class="fa fa-caret-down"></i>
      </button>
      <div class="dropdown-content">
      <a href = "member_management.php">Member Page</a>
      <a href = "Trainer_management.php" >Trainer Page</a>
      <a href = "Package_Management.php" >Packages Page</a>
      <a href="Shift_Management.php">shift page</a>
      </div>
    </div>
  </div>

</body>
</html>
