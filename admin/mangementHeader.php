<div class = " headerDiv">

  <a href= "Admin_Home_Page.php">
  <div class ="Home">
      HOME
  </div>

  </a>
  <img src = "<?php echo $_SESSION['image'];?>" alt="adminphoto">
  <h3><?php echo $_SESSION['name'];?></h3>
</div>
<nav>
  <input type="submit" value="ADD" name ="add" id = 'add'>

  <form action ='<?php echo $_SERVER["PHP_SELF"];?>' method="get">
    <input type="text" placeholder="Search" name="search" id = "search">
  </form>
</nav>
