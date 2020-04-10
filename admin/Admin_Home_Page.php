<?php
  require_once("adminConfig.php");
?>

<!DOCTYPE html>
<html>
<head>
 <meta charset="UTF-8">

<style>
 * {
    -webkit-box-sizing:border-box ;
    -o-box-sizing:border-box ;
    box-sizing:border-box ;
}
  body
{
background-color:#00A5FF;
animation: color 20s ease-in-out 0s infinite alternate ;
  box-sizing:border-box;
   overflow-x:hidden ;
}

@keyframes color {

  0% ,50% , 75% ,100%{
    background-color:#00A5FF;
  }

  30% , 80%{
    background-color:#001B3A;
  }

 70% {
     background-color:#0F0E0E;
  }

}



.headerDiv
{
  position:relative;
  background-color :black;
  width:100%;
  padding :20px ;
  text-align :center ;
  border:2px solid #918B8B ;
  font-size:30px;
  color:white;
  text-shadow: 13px 5px 4px #232020;
  font-family:Arial , tahoma;

}
.headerDiv > img
{
  width:200px ;
  height:200px ;
  border-radius:50%;
  border:2px solid black ;
  box-shadow:7px 2px 2px #272121;
}
.buttonDiv
{
 width:100%;
 background-color:black;
 padding:30px ;
  border:2px solid #918B8B ;
  position:relative;
}
.buttonDiv button
{
 background-color:#241027;
 color:white;
 font-family:Console;
 width:300px;
 height:300px;
 border:2px solid white ;
 font-size:40px ;
 text-overflow:ellipsis;
 display:block;
 padding:30px ;
 text-align :center ;
 transform:rotate(-45deg);
 text-shadow:5px 2px 3px black;
 transition:.5s ease-in-out ;
 box-shadow:10px 10px 5px #292C29 ;

}
.Memberbutton
{
 position:absolute ;
 top:30px ;
 left:500px ;

}
.Trainerbutton
{
 position:relative ;
 top:320px ;
 left:953px;

}
.Packagebutton
{
 position:relative ;
 top:10px;

}
button:hover
{
 background-color:#3A1117;
 transform:rotate(0deg) scale(1.5,1) ;
 font-style:italic;
 box-shadow:10px 10px 5px #555B55 ;
}
a
{
 text-decoration:none;
}

</style>

</head>

<body>

  <div class = " headerDiv">
    <img src = "<?php echo $_SESSION['image']; ?>" alt="adminphoto">
    <h3><?php echo ucwords($_SESSION['name']);?><h3>
  </div>

         <!-- تم وضع اللينك بنجاح-->
 <div class = "buttonDiv">
    <a href = "member_management.php"> <!-- لا تنسى حط لينك member-->
   <button type="submit" class="Memberbutton" )>Members</button>
    </a>
      <a href = "Trainer_management.html"><!-- لا تنسى حط لينك trainer-->
   <button type = "button" class = "Trainerbutton" >  Trainers </button>
     </a>
      <a href = "Package_Management.html"><!-- لا تنسى حط لينك package-->
    <button type = "button" class = "Packagebutton" >  Package Management </button>
       </a>
   </div>

</body>

</html>
