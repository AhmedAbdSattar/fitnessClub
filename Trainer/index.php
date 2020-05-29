<?php
	require_once "trainerConfig.php";
	if ((isset($_GET['hidenHeader'])) && (strcmp($_GET['hidenHeader'], 'logout') == 0)){
		session_unset();//remove all session variables
	  session_destroy();//destroy the session
		header("Refresh:0");//refresh the page
	}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
	<title>trainer</title>
	<style type="text/css">
	</style>
	<link rel="stylesheet" type="text/css" href="css/index.css">

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
</head>
<body>

	<form method="get" id="pageform" action='<?php echo $_SERVER["PHP_SELF"];?>'>
		<input type="hidden" id="hidenHeader" name="hidenHeader">
		<div class="header">
		  <a onclick="linkFN ('AllMembers')">All Members</a>
		  <a onclick="linkFN ('logout')">Log out</a>
		  <input type="text" placeholder="Search..." name="search" id="search">

		  <select id="shiftsList" onchange="document.getElementById('pageform').submit();" name="shiftsList">
		  	<option value="AllMembers">M3lsh Gym Working Shifts</option>
		  	<?php
					include "../config.php";//config file connect to DB
					$userName = $_SESSION['userName'];
					$sql = "SELECT trainershift.shiftNum, day, startTime, endTime
						FROM trainershift JOIN shiftwork
						ON trainershift.shiftNum = shiftwork.shiftNum AND trainershift.trainerID = '$userName'";
					$stmt = $conn->query($sql);//execute the query
					if ($stmt->num_rows > 0) {//if there is a shift
			      //output the data
			      while($result = $stmt->fetch_assoc()) {//$result["something"] is the result of the query
							$shiftNum = $result['shiftNum'];
							$shiftDay = $today[$result['day']];
							$startTime  = date('g:i A' ,strtotime($result['startTime']));
			        $endTime = date('g:i A' ,strtotime($result['endTime']));
							echo "<option value='$shiftNum'>$shiftNum : $shiftDay from $startTime to $endTime</option>";
						}
					}
				?>
		  </select>
		  <!--<a href="#reloud page"></a>-->
		</div>

	<br>
	<br>
	<br>

<center>
		<div id="myDIV" class="att">
	  		<h1>Attendance Member</h1>
	  		<input type="text" id="addedMemberName" placeholder="member user name..." name="addedMemberName" disabled>
	  		<span class="addBtn" id='addbutton'>Add</span> <!-- waiting until i stuted java script-->
		</div>
	</form>
	<ul id="myUL">
	<?php
		if ((isset($_GET['shiftsList'])) && (!(strcmp($_GET['shiftsList'], 'AllMembers') == 0))){//show members of one shift
			$shiftsList = $_GET['shiftsList'];
			echo "<script>document.getElementById('shiftsList').value = '$shiftsList';</script>";
			$sql;//generate the query string
			if (isset($_GET['search'])){
				$searchKey = $_GET['search'];
				echo "<script>document.getElementById('search').value = '$searchKey';</script>";
				$sql = "SELECT member FROM (SELECT memberbill.member, MAX(memberbill.bill_ID), smalljoin.shiftNum
					FROM memberbill, (SELECT packageshift.shiftNum, packageshift.packageName,
					billpackage.bill_ID FROM packageshift JOIN billpackage ON packageshift.packageName = billpackage.packageName) smalljoin
					WHERE memberbill.bill_ID = smalljoin.bill_ID GROUP BY memberbill.member
					HAVING smalljoin.shiftNum = '$shiftsList') bigjoin WHERE member LIKE '%$searchKey%';";
			}else {//if there is no search key
				$sql = "SELECT member FROM (SELECT memberbill.member, MAX(memberbill.bill_ID), smalljoin.shiftNum
					FROM memberbill, (SELECT packageshift.shiftNum, packageshift.packageName,
					billpackage.bill_ID FROM packageshift JOIN billpackage ON packageshift.packageName = billpackage.packageName) smalljoin
					WHERE memberbill.bill_ID = smalljoin.bill_ID GROUP BY memberbill.member
					HAVING smalljoin.shiftNum = '$shiftsList') bigjoin;";
			}
			$stmt = $conn->query($sql);//execute the query
	    if ($stmt->num_rows > 0) {//if there is a user
	      //output the data
	      while($result = $stmt->fetch_assoc()) {//$result["something"] is the result of the query
					$memberUserName = $result['member'];
					echo "<li onclick='listFN(" .'"'.$memberUserName.'"'. ")'>$memberUserName</li>";
				}
			}
			?>
			<script>
				//add onclick action to add button
				document.getElementById('addbutton').onclick = function() {document.getElementById('pageform').submit()};
				document.getElementById("addedMemberName").disabled = false;
				function listFN(member){
					if(confirm(member.concat(", is he attande?"))){
						document.getElementById("addedMemberName").value = member;
						document.getElementById("pageform").submit();
					}
				}
			</script>
			<?php
		}else{//show all members
			$sql;
			if (isset($_GET['search'])){
				$searchKey = $_GET['search'];
				echo "<script>document.getElementById('search').value = '$searchKey';</script>";
				$sql = "SELECT username FROM person WHERE permission = 3 AND username LIKE '%$searchKey%'";
			}else {
				$sql = "SELECT username FROM person WHERE permission = 3";
			}
			$stmt = $conn->query($sql);//execute the query
	    if ($stmt->num_rows > 0) {//if there is a user
	      //output the data
	      while($result = $stmt->fetch_assoc()) {//$result["something"] is the result of the query
					$memberUserName = $result['username'];
					echo "<li onclick='listFN(" .'"'.$memberUserName.'"'. ")'>$memberUserName</li>";
				}
			}
		}

		if (isset($_GET['addedMemberName'])){
			$addMember = $_GET['addedMemberName'];
			echo "<script>document.getElementById('addedMemberName').value = '$addMember';</script>";
			$shiftsList = $_GET['shiftsList'];
			$sql = "SELECT startTime FROM shiftwork WHERE shiftNum = '$shiftsList'";
			$stmt = $conn->query($sql);//execute the query
	    if ($stmt->num_rows > 0) {//if there is a user
	      //output the data
	      while($result = $stmt->fetch_assoc()) {//$result["something"] is the result of the query
					$attandDate = date("Y-m-d")." ".date('H:i:s' ,strtotime($result['startTime']));
					$sql = "INSERT INTO memberattendance (member, attData) VALUES ('$addMember', '$attandDate');";
					if ($conn->query($sql) === TRUE) {//execute the query
						echo "<script>alert('$attandDate added Successfully');</script>";
					}
				}
			}
		}

		$stmt->close();//close the statement
    mysqli_close($conn);//close the connection to the db
	?>
	</ul>

</center>
<script>
	function linkFN (name){
		document.getElementById("shiftsList").value = "AllMembers";
		document.getElementById("search").value = '';
		document.getElementById("hidenHeader").value = name;
		document.getElementById("pageform").submit();
	}
</script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.min.js" ></script>
		<script src="JS/java.js"></script>
</body>
</html>
