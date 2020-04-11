<?php
  require_once("adminConfig.php");
?>
<!DOCTYPE html>
<html>
<head>
<title> Members Management </title>

</head>
<link rel="stylesheet" href="stylecontainerOFMember.css">

<body>

  <div class = " headerDiv">
        <a href= "Admin_Home_Page.php">
    <div class ="Home">
        HOME
    </div>

    </a>
    <img src = "<?php echo $_SESSION['image']; ?>" alt="adminphoto">
    <h3><?php echo ucwords($_SESSION['name']);?><h3>
  </div>
  <nav>
    <input type="submit" value="ADD" name ="add">  <!-- انكز الموقف يا عبدالله -->
    <input type="text" placeholder="Search" name="search input">  <!-- انكز الموقف يا عبدالله -->
  </nav>
  
<?php
  include "../config.php";//config file connect to DB
  $sql = "SELECT name, username, phoneNumber, image FROM person WHERE permission = 3;";//the query string
  $stmt = $conn->query($sql);//execute the query
  if ($stmt->num_rows >= 1) {//if there is a user of that data
    //output the data
    while($result = $stmt->fetch_assoc()) {//$result["something"] is the result of the query
      //variables to get the result
      $memberName = ucwords($result['name']);
      $memberUserName = $result['username'];
      $memberPhone = $result['phoneNumber'];
      $memberImage = constant("personeImage").$result['image'];

      //show member card
      echo "<div class = ' container'>
             <a href = 'https://www.facebook.com'>
             <!--VIP: here we should put link of member page which admin add and delete from it-->

          <div class ='front'>
              <img src = '$memberImage' alt=' memberPhoto'>  <!-- اختار الصورة ن فضلك-->
              <h2>$memberUserName</h2>

          </div>

          <div class ='back'>
             <header>$memberName</header> <!--#need Email of user please -->
             <h3 > date of training</h3>
               <time>10:00 Am </time>  <time> 12:00 Am</time><!--#End like 3Am  -->

          </div>
             </a>
      </div>
          ";
    }
  }

  $stmt->close();//close the statement
  mysqli_close($conn);//close the connection to the db
?>

</body>

</html>
