<?php
  require_once("adminConfig.php");
?>

<!DOCTYPE html>
<html>
<head>
  <title> trainers Management </title>
  <link rel="stylesheet" href="stylecontainerOFTrainer.css">
</head>

<body>
<?php
  include_once 'mangementHeader.php';//pageHader

  include "../config.php";//config file connect to DB

  //the query string
  $sql;
  if(isset($_GET['search'])){
    $searchKey = $_GET['search'];
    $sql = "SELECT name, username, image, MIN(day), startTime, endTime
      FROM person, trainershift, shiftwork
      WHERE person.permission = 2 AND (person.name LIKE '%$searchKey%' OR person.username LIKE '%$searchKey%'
      OR shiftwork.day LIKE '%$searchKey%' OR shiftwork.startTime LIKE '%$searchKey%'
      OR shiftwork.endTime LIKE '%$searchKey%') AND (person.username = trainershift.trainerID
      AND trainershift.shiftNum = shiftwork.shiftNum)
      GROUP BY person.username ORDER BY person.username ASC;";
    echo "<script>document.getElementById('search').value = '$searchKey';</script>";
  }else {
    $sql = "SELECT name, username, image, MIN(day), startTime, endTime
      FROM person, trainershift, shiftwork
      WHERE person.permission = 2 AND person.username = trainershift.trainerID AND trainershift.shiftNum = shiftwork.shiftNum
      GROUP BY person.username ORDER BY person.username ASC;";
  }

  $stmt = $conn->query($sql);//execute the query
  if ($stmt->num_rows > 0) {//if there is a user
    //output the data
    while($result = $stmt->fetch_assoc()) {//$result["something"] is the result of the query
      $trainerName = ucwords($result["name"]);
      $trainerUserName = $result['username'];
      $trainerImage = constant('personeImage'). $result["image"];
      $trainerDay = $today[$result['MIN(day)']];
      $startTime = date('g:i A' ,strtotime($result['startTime']));
      $endTime = date('g:i A' ,strtotime($result['endTime']));
      include 'trainerCard.php';//print trainer
    }
    $stmt->close();//close the statement
    mysqli_close($conn);//close the connection to the db
  }
?>
</body>
</html>
