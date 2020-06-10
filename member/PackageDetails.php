<?php
  require_once "memberConfig.php";
?>
<!DOCTYPE html>
<html>
<head>
	<title>Details</title>
	<link href="PackageDetails.css" rel="stylesheet">
	<meta charset="UTF-8">
</head>
<body>
	<div class="word1">
		Dates Shifts list
	</div><!--list of shifts and date-->
	<div class=" container1">
		<?php
		   if (isset($_GET['packageName'])){
		       $packageName = $_GET['packageName'];
		       include "../config.php";//config file connect to DB
		       $sql = "SELECT shiftwork.shiftNum, day, startTime, endTime
		         FROM shiftwork JOIN packageshift ON shiftwork.shiftNum = packageshift.shiftNum
		         AND packageshift.packageName = '$packageName';";
		       $stmt = $conn->query($sql);//execute the query
		       if ($stmt->num_rows >= 1) {//if there is a bill of that userName
		           //output the data
		           while($result = $stmt->fetch_assoc()) {//$result["something"] is the result of the query
		               $shiftNum = $result["shiftNum"];
		               $shiftDay = $today[$result["day"]];
		               $startTime  = date('g:i A' ,strtotime($result['startTime']));
		               $endTime = date('g:i A' ,strtotime($result['endTime']));
		               ?>
		                <div class="list1">
			                   <span><?php echo $shiftNum;?></span>
                         <span><?php echo $shiftDay;?></span>
                         <span><?php echo $startTime;?></span>
                         <span><?php echo $endTime;?></span>
		                     </div><?php
		           }
             }
		         ?>
	</div>
	<div class="word2">
		Trainers
	</div><!--list of trainer -->
	<div class=" container2">
		<?php
    $sql = "SELECT name FROM packageshift, trainershift, person
      WHERE packageshift.shiftNum = trainershift.shiftNum AND trainershift.trainerID = person.username
      AND packageshift.packageName = '$packageName';";
    $stmt = $conn->query($sql);//execute the query
    if ($stmt->num_rows >= 1) {//if there is a bill of that userName
        //output the data
        while($result = $stmt->fetch_assoc()) {//$result["something"] is the result of the query
          ?>
          <div class="list">
      			<span><?php echo $result['name'];?></span>
      		</div>
          <?php
        }
      }
          ?>
	</div>
	<div class="packageDetails">
		<h1>Submit select Package</h1>
		<table>
			<tr>
				<th>Package Name</th><!-- the package selected by  member -->
				<th>Package Cost</th><!-- the package cost -->
				<th>Offers & Discounts</th><!-- the package discount if found -->
			</tr><!--please bring this data from db or by programming and push them here-->
			<tr>
        <?php
        $sql = "SELECT discount, shiftCost FROM package WHERE packageName = '$packageName';";
        $stmt = $conn->query($sql);//execute the query
        if ($stmt->num_rows == 1) {//if there is only one package of that userName
            //output the data
            if($result = $stmt->fetch_assoc()) {//$result["something"] is the result of the query
              ?>
              <td><?php echo $packageName;?></td><!-- the package selected by  member which this  bill belong-->
              <td><?php echo $result['shiftCost'];?>$</td><!-- the package cost -->
              <td><?php echo $result['discount'];?>%</td><!-- the package discount if found -->
              <?php
            }
          }
         ?>
			</tr>
		</table>
		<form action="PackageDetails.php" method="get">
			<input name="select" type="submit" value="Select" onclick="return confirm('Are you sure?\nif you select this the prevoius package quata will be lost\nand you will pay its price')">
      <input id="packageName" name="packageName" type="hidden">
		</form><?php
            if(isset($_GET['select'])){
              //get the next month date from today date
              $date = date('Y-m-d', strtotime('+1 month'));
              //the query string
              $sql = "INSERT INTO bill (endOfTheGracePeriod, paied)
                  VALUES ('$date', false);";
              if ($conn->query($sql) === TRUE) {//execute the query
                //the query string
                $sql = "SELECT MAX(bill_ID) FROM bill;";
                //execute the query
                $stmt = $conn->query($sql);
                if($stmt->num_rows == 1) {
                  //output the data
                  if($result = $stmt->fetch_assoc()) {//$result["MAX(bill_ID)"] is the result of the query
                    $billID = $result["MAX(bill_ID)"];
                    $username = $_SESSION['userName'];
                    //the query string
                    $sql = "INSERT INTO memberbill (member, bill_ID) VALUES ('$username', $billID);";
                    if ($conn->query($sql) === TRUE) {//execute the query
                      //the query string
                      $sql = "INSERT INTO billpackage (packageName, bill_ID)
                          VALUES ('$packageName', $billID);";
                      if ($conn->query($sql) === TRUE) {//execute the query
                        echo "<script>alert('you selected this package Successfully');</script>";//inform the user that added Successfully
                      }
                    }
                  }
                }
              }
            }
            echo "<script>document.getElementById('packageName').value = '$packageName';</script>";
		        $stmt->close();//close the statement
		        mysqli_close($conn);//close the connection to the db
		      }else {
		        header("Location: SelectPackage_Page.php");//redirect to login page
		        exit();
		      }
		    ?>
	</div>
</body>
</html>