<?php
  require_once("adminConfig.php");
?>
<!DOCTYPE html>
<html>
<head>
<title> Package Management </title>

</head>
<link rel="stylesheet" href="stylecontainerOFPackage.css">

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


<?php
include "../config.php";//config file connect to DB
$sql = ";";//the query string
$stmt = $conn->query($sql);//execute the query
if ($stmt->num_rows >= 1) {//if there is a user of that data
  //output the data
  while($result = $stmt->fetch_assoc()) {//$result["something"] is the result of the query
    //variables to get the result
  }
}
$stmt->close();//close the statement
mysqli_close($conn);//close the connection to the db
?>

                                                                              <!-- !!!!!!! السطر القادم مهم اتصرف انت :D-->
<div class = " container">
       <a href = "https://www.facebook.com"> <!-- VIP: here we should put link of package management page which admin add and delete from it -->

    <div class ="front">
        <h2> #Package Name </h2>
        <h3>#Package Num </h3>

    </div>

    <div class ="back">
       <p > discribe of package #0000000000000000000000000000000000000</p>

    </div>
      </a>
</div>

</body>

</html>
