<div class = " headerDiv">

  <a href= "Admin_Home_Page.php">
  <div class ="Home">
      HOME
  </div>

  </a>
  <img src = "<?php echo $_SESSION['image']; ?>" alt="adminphoto">
  <h3><?php echo $_SESSION['name'];?></h3> <!--#need Email of trainer please -->
</div>
<nav>
  <input type="submit" value="ADD" name ="add">  <!-- انكز الموقف يا عبدالله -->
  <input type="text" placeholder="Search" name="search input">  <!-- انكز الموقف يا عبدالله -->
</nav>
