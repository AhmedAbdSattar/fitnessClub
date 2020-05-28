<?php
  require_once "memberConfig.php";
?>
<!DOCTYPE html>
<html>
<head>
	<title>Details</title>
	<link href="PackageSelect.css" rel="stylesheet">
	<meta charset="UTF-8">
</head>
<body>
	<div class="start">
		<span>select Package <span></span></span>
		<div>
			<span></span>
			<div class="container">
				<span><!-- looping here -->
				 <?php
          include "../config.php";//config file connect to DB
          $sql = "SELECT packageName, shiftCost, discount FROM package;";
          $stmt = $conn->query($sql);//execute the query
          if ($stmt->num_rows >= 1) {//if there is a bill of that userName
            //output the data
            while($result = $stmt->fetch_assoc()) {//$result["something"] is the result of the query
              $packageName = $result["packageName"];
              $totalCost = $result["shiftCost"] - ($result["shiftCost"]*$result["discount"]/100);
              ?>
              <a href="PackageDetails.php?packageName=<?php echo $packageName;?>"><!-- the details package and submit selection-->
       				<div class="PackageCard">
       					<span><?php echo $packageName;?><br>
       					<?php echo "$totalCost$";?></span>
       				</div>
             </a>
              <?php
            }
          }
          $stmt->close();//close the statement
          mysqli_close($conn);//close the connection to the db
              ?>
      </span>
			</div>
		</div>
	</div>
</body>
</html>
