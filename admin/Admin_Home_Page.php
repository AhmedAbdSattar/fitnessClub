<?php
  require_once("adminConfig.php");
?>

<!DOCTYPE html>
<html>
<head>
 <meta charset="UTF-8">
 <link rel="stylesheet" href="AdminHomePageStyle.css">
</head>

<body>

  <div class = " headerDiv">
    <img src = "<?php echo $_SESSION['image']; ?>" alt="adminphoto">
    <h3><?php echo $_SESSION['name'];?><h3>
  </div>

         <!-- تم وضع اللينك بنجاح-->
 <div class = "buttonDiv">
  
    <a href = "member_management.php"> <!-- لا تنسى حط لينك member-->
   <button type="submit" class="Memberbutton" )>Members</button>
    </a>
    
      <a href = "Trainer_management.php"><!-- لا تنسى حط لينك trainer-->
   <button type = "button" class = "Trainerbutton" >  Trainers </button>
     </a>
      
      <a href = "Package_Management.php"><!-- لا تنسى حط لينك package-->
    <button type = "button" class = "Packagebutton" >  Package Management </button>
      </a>
      
      <a href = "shifts_management.php"><!-- لا تنسى حط لينك package-->
    <button type = "button" class = "shiftsbutton" >  shifts Management </button>
       </a>
      
   </div>

</body>

</html>
