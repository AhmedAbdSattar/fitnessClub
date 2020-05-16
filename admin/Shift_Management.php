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
      $sql = "SELECT shiftNum, day, startTime, endTime, MaxMemberNumber FROM shiftwork
        WHERE shiftNum LIKE '%$searchKey%' OR day LIKE '%$searchKey%'
        OR startTime LIKE '%$searchKey%' OR endTime LIKE '%$searchKey%' OR MaxMemberNumber LIKE '%$searchKey%';";
      echo "<script>document.getElementById('search').value = '$searchKey';</script>";
    }else{
      $sql = "SELECT shiftNum, day, startTime, endTime, MaxMemberNumber FROM shiftwork;";
    }

    $stmt = $conn->query($sql);//execute the query
    if ($stmt->num_rows >= 1) {//if there is a user of that data
      //output the data
      while($result = $stmt->fetch_assoc()) {//$result["something"] is the result of the query
        //variables to get the result
        $shiftNum = $result['shiftNum'];
        $shiftDay = $today[$result['day']];
        $startTime = date('g:i A' ,strtotime($result['startTime']));
        $endTime = date('g:i A' ,strtotime($result['endTime']));
        $maxMember = $result['MaxMemberNumber'];
        include 'shiftCard.php';//print the package
      }
    }
    $stmt->close();//close the statement
    mysqli_close($conn);//close the connection to the db
  ?>
  <script>
    document.getElementById('add').onclick = function() {
     location.href = "AdminShiftModefication.php";
    };
  </script>
  </body>

  </html>
