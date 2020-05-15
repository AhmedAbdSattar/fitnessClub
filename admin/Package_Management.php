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
  <?php
    include_once 'mangementHeader.php';

    include "../config.php";//config file connect to DB

    //the query string
    $sql;
    if(isset($_GET['search'])){
      $searchKey = $_GET['search'];
      $sql = "SELECT packageName, discount, shiftCost FROM package
        WHERE packageName LIKE '%$searchKey%' OR discount LIKE '%$searchKey%' OR shiftCost LIKE '%$searchKey%';";
      echo "<script>document.getElementById('search').value = '$searchKey';</script>";
    }else{
      $sql = "SELECT packageName, discount, shiftCost FROM package;";
    }

    $stmt = $conn->query($sql);//execute the query
    if ($stmt->num_rows >= 1) {//if there is a user of that data
      //output the data
      while($result = $stmt->fetch_assoc()) {//$result["something"] is the result of the query
        //variables to get the result
        $packageName = $result['packageName'];
        $discount = $result['discount'];
        $shiftCost = $result['shiftCost'];
        $totalCost = $shiftCost - (($discount/100)*$shiftCost);
        include 'packageCard.php';//print the package
      }
    }
    $stmt->close();//close the statement
    mysqli_close($conn);//close the connection to the db
  ?>

  <script>
    document.getElementById('add').onclick = function() {
     location.href = "AdminPackageModification.php";
    };
  </script>
</body>

</html>
