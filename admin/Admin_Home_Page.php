<?php
  require_once("adminConfig.php");
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="AdminHomeStyle.css">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="MenuBarStyle.css">
  <link rel="index" href="menuBar.html">
</head>

<body>

  <div class = " headerDiv">
    <img src = "<?php echo $_SESSION['image']; ?>" alt="adminphoto">
    <h3><?php echo $_SESSION['name'];?></h3>
  </div>
  


         <!-- تم وضع اللينك بنجاح-->
 <div class = "buttonDiv">

    <a href = "member_management.php"> <!-- لا تنسى حط لينك member-->
   <button type="submit" class="Memberbutton">Members</button>
    </a>

      <a href = "Trainer_management.php"><!-- لا تنسى حط لينك trainer-->
   <button type = "button" class = "Trainerbutton" >  Trainers </button>
     </a>

      <a href = "Package_Management.php"><!-- لا تنسى حط لينك package-->
    <button type = "button" class = "Packagebutton" >  Package Management </button>
      </a>

      <a href = "Shift_Management.php"><!-- لا تنسى حط لينك package-->
    <button type = "button" class = "shiftsbutton" >  shifts Management </button>
       </a>

   </div>

</body>

</html>
