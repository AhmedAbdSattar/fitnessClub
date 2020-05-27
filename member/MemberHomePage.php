<?php
    if(isset($_POST['submit'])){
      
           header('location: Bill_Page.php'); 
     
   }
?>
<!doctype html >
<html>
    <head>
       <meta charset="UTF-8">
       <link rel="stylesheet" href="MemberStyle.css">
       <title>Fitness Club</title>  <!-- احضر اسم العميل-->
    </head>
    
    <body>
     <header>
      <img src="../photos/uu.jpg" alt="Member Img">
      <h2> Member Name</h2>
     </header>
     <nav>
      <a href="../login.php">Logout</a> <!--should log out-->
      <a href="">Account</a> <!--should go to account setting page-->
      <a href="" class ="help">help</a>  <!--should go to help page-->
     </nav>
  <div class="content"> <!-- Start content-->
      
     <section class="left" > <!-- Start left-->
      <div>
           <img src="../photos/poster4.gif" width="300px" height=1000px>
           <img src="../photos/VltF.gif" width="300px" height=1000px>
      </div>
     </section>              <!-- End left-->
     
     <?php  include "../footer/footer.php" ?>

     
     <section class="Center"> <!-- Start Center-->
       <h1>
       Select Your System Easy 
       </h1>
      <!-- Advertisement from facebook-->
      <iframe src="https://www.facebook.com/plugins/video.php?href=https%3A%2F%2Fwww.facebook.com%2F111113043777616%2Fvideos%2F187568902521077%2F&show_text=0&width=476"  scrolling="no"  allowTransparency="true" allowFullScreen="true"></iframe>
     
      <div class="MemberSelections"> <!-- Start Options which member will select from them -->
      <a href="Bill_Page.php"> <div> <br><br>Bills </div></a>
      <a href="SelectPackage_Page.php"> <div> <br><br> Packages </div></a>
      </div>    <!-- End Options which member will select from them -->
      
      
      <div class="Healty">
         <img src="../photos/AllHealty.png" width="100%" height=700px>
      </div>
     </section>        <!-- End Center-->
     
     
     
     
     <section class="right"> <!-- Start right-->
     <div>
         <img src="../photos/poster 2.gif" width="300px" height=1000px>
         <img src="../photos/poster3.gif" width="300px" height=1000px>
     </div>
     </section><!-- End right-->
     
 
  </div>  <!-- End content-->
    
    </body>
</html>
