<?php
  require_once("adminConfig.php");
?>
<!DOCTYPE html>
<html>
<head>
  <title>Members Management</title>
  <link rel="stylesheet" href="stylecontainerOFMember.css">
  <link rel="stylesheet" href="../footer/footerStyle.css">

  </head>
<body>

  <?php
    include_once 'mangementHeader.php';

    include "../config.php";//config file connect to DB

    //the query string
    $sql;
    if(isset($_GET['search'])){
      $searchKey = $_GET['search'];
      $sql = "SELECT name, username, image, MIN(day), startTime, endTime
        FROM person, memberbill, billpackage, packageshift, shiftwork
        WHERE person.permission = 3 AND (person.name LIKE '%$searchKey%' OR person.username LIKE '%$searchKey%'
        OR shiftwork.day LIKE '%$searchKey%' OR shiftwork.startTime LIKE '%$searchKey%'
        OR shiftwork.endTime LIKE '%$searchKey%') AND (person.username = memberbill.member
        AND billpackage.bill_ID = memberbill.bill_ID AND packageshift.packageName = billpackage.packageName
        AND shiftwork.shiftNum = packageshift.shiftNum)
        GROUP BY person.username
        HAVING MAX(memberbill.bill_ID)
        ORDER BY person.username ASC;";
        echo "<script>document.getElementById('search').value = '$searchKey';</script>";
    }else {
      $sql = "SELECT name, username, image, MIN(day), startTime, endTime
        FROM person, memberbill, billpackage, packageshift, shiftwork
        WHERE person.permission = 3 AND person.username = memberbill.member AND billpackage.bill_ID = memberbill.bill_ID
        AND packageshift.packageName = billpackage.packageName AND shiftwork.shiftNum = packageshift.shiftNum
        GROUP BY person.username
        HAVING MAX(memberbill.bill_ID)
        ORDER BY person.username ASC;";
    }
    $stmt = $conn->query($sql);//execute the query

    if ($stmt->num_rows > 0) {//if there is a user
      //output the data
      while($result = $stmt->fetch_assoc()) {//$result["something"] is the result of the query
        $memberImage = constant('personeImage'). $result["image"];
        $memberUserName = $result['username'];
        $memberName = ucwords($result["name"]);
        $memberDay = $today[$result['MIN(day)']];
        $startTime  = date('g:i A' ,strtotime($result['startTime']));
        $endTime = date('g:i A' ,strtotime($result['endTime']));
        include 'memeberCard.php';//print member data
    }

    $stmt->close();//close the statement
    mysqli_close($conn);//close the connection to the db
  }
  ?>
<script>
  document.getElementById('add').onclick = function() {
   location.href = "AdminMemberModefication.php";
  };
</script>
</body>

</html>
<?php include_once "../footer/footer.php"; ?>
