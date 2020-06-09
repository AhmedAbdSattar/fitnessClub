<?php
  require_once("adminConfig.php");
?>
<!DOCTYPE html>
<html>
<head>
	<title>Admin@#packageName</title><!-- @ يجب وضع اسم العميل بعد  -->
	<meta charset="utf-8">
	<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.12/css/bootstrap-multiselect.css" rel="stylesheet" type="text/css">
	<link href="styleOfAdminpackagepage.css" rel="stylesheet" type="text/css">
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js">
	</script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js">
	</script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js">
	</script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.12/js/bootstrap-multiselect.js">
	</script>
</head>
<body>
	<div class="header">
		<h1 id='packageH1'>#package NAME</h1>
	</div>
	<fieldset>
		<legend>Informations</legend>
		<form class="memberForm" id="member" name="member">
			<input autocomplete="off" name="packagename" id="packagename" placeholder="Package Name" required type="text"> <!-- adimn can`t modification-->
			 <input autocomplete="off" name="packagecost" id="packagecost" placeholder="Package Cost" required type="number"> <!-- adimn can`t modification-->
			 <input autocomplete="off" name="packagediscount" id="packagediscount" placeholder="Discount" required type="number"> <!-- adimn can`t modification-->
			 <select class="selectCountery" id='selectShift' name='selectShift[]' multiple="multiple" required>
				<?php
				include "../config.php";//config file connect to DB
				$packageShift = array();//trainer shift must be defined outside the if stmt
				if(isset($_GET['modify'])){//if the user click on modify button
					$packageName = $_GET['packagename'];
					$discount = $_GET["packagediscount"];
					$cost = $_GET["packagecost"];
					$packageShift = $_GET['selectShift'];
					//the query string
					$sql = "UPDATE package SET discount=$discount, shiftCost=$cost WHERE packageName='$packageName';";
					if ($conn->query($sql) != TRUE) {//execute the query
						echo "<script>alert('Not Updated');</script>";//error message if not Updated
					}else {
						//the query string
						$sql = "DELETE FROM packageshift WHERE packageName = '$packageName';";
						if ($conn->query($sql) != TRUE) {//execute the query
							echo "<script>alert('Not Updated');</script>";//error message if not Updated
						}else {
							$flag = TRUE;
							foreach ($packageShift as $value) {
								//the query string
								$sql = "INSERT INTO packageshift(shiftNum, packageName)
									VALUES ('$value', '$packageName');";
								if ($conn->query($sql) !== TRUE) {//execute the query
									echo "<script>alert('Error with DB');</script>";//error message
									$flag = false;
									break;
								}
							}
							if($flag){
								echo "<script>alert('Updated Successfully');</script>";//inform the user that trainer added Successfully
							}
						}
					}
				}elseif(isset($_GET['Delete'])){//if the user click on delete button
					$packageName = $_GET['packagename'];
					//the query string
					$sql = "DELETE FROM packageshift WHERE packageName = '$packageName';";
					if ($conn->query($sql) != TRUE) {//execute the query
						echo "<script>alert('Not Deleted');</script>";//error message if not Updated
					}else {
						//the query string
						$sql = "DELETE FROM package WHERE packageName = '$packageName';";
						if ($conn->query($sql) != TRUE) {//execute the query
							echo "<script>alert('Not Deleted');</script>";//error message if not Updated
						}else {
							echo "<script>alert('Deleted Successfully');</script>";//inform the user that trainer Deleted Successfully
							//redirect to package page
							echo '<script type="text/javascript">location.href = "Package_Management.php";</script>';
						}
					}
				}elseif(isset($_GET['Add'])){//if user click the add button
					$packageName = $_GET['packagename'];
					$discount = $_GET["packagediscount"];
					$cost = $_GET["packagecost"];
					$packageShift = $_GET['selectShift'];
					//the query string
					$sql = "SELECT packageName FROM package WHERE packageName = '$packageName';";
					//execute the query
					$stmt = $conn->query($sql);
					if($stmt->num_rows >= 1) {//if there is a user of that data
						echo "<script>alert('that package name is already exist');</script>";//error message
					}else {
						//the query string
						$sql = "INSERT INTO package(packageName, discount, shiftCost)
							VALUES ('$packageName', $discount, $cost);";
						if ($conn->query($sql) === TRUE) {//execute the query
							$flag = TRUE;
							foreach ($packageShift as $value) {
								//the query string
								$sql = "INSERT INTO packageshift(shiftNum, packageName) VALUES ('$value', '$packageName');";
								if ($conn->query($sql) !== TRUE) {//execute the query
									echo "<script>alert('Error with DB');</script>";//error message
									$flag = false;
									break;
								}
							}
							if($flag){
								echo "<script>alert('Added Successfully');</script>";//inform the user that trainer added Successfully
							}
						}
					}
				}
				if(isset($_GET['packagename'])){//when enter the page from package_management page or click on a Button
					$packageName = $_GET['packagename'];
					//the query string
					$sql = "SELECT discount, shiftCost FROM package WHERE packageName = '$packageName';";
					//execute the query
					$stmt = $conn->query($sql);
					if ($stmt->num_rows == 1) {//if there is only one package of that data
						if ($result = $stmt->fetch_assoc()) {
							$discount = $result["discount"];
							$cost = $result["shiftCost"];
							$sql = "SELECT shiftNum FROM packageshift WHERE packageName = '$packageName';";
							//execute the query
							$stmt = $conn->query($sql);
							if ($stmt->num_rows >= 1) {//if there is shifts
								while ($result = $stmt->fetch_assoc()) {
									array_push($packageShift, $result['shiftNum']);
								}
								echo "<script>";
								//change page title
								echo "document.title = 'Admin@$packageName';";
								//disable the packagename bacuase it is not editable
								echo "document.getElementById('packagename').readOnly = true;";
								//show the value of the packagename
								echo "document.getElementById('packagename').value = '$packageName';";
								//show the value of the name on the header
								echo "document.getElementById('packageH1').innerHTML = '$packageName';";
								//show the value of the packagecost
								echo "document.getElementById('packagecost').value = '$cost';";
								//show the value of the packagediscount
								echo "document.getElementById('packagediscount').value = '$discount';";
								echo "</script>";
							}else {
								echo "<script>alert('Error with DB');</script>";//error message
							}
						}
					}
				}
				$i = 0;//counter for the trainershift array
				//the query string
				$sql = "SELECT shiftNum FROM shiftwork;";
				$stmt = $conn->query($sql);//execute the query
				if ($stmt->num_rows >= 1) {//if there is only one user of that data
					//output the data
					while($result = $stmt->fetch_assoc()) {//$result["shiftNum"] is the result of the query
							$shiftNumber = $result["shiftNum"];
							if((isset($packageShift[$i])) && (strcmp($shiftNumber, $packageShift[$i]) == 0)){
								echo "<option value='$shiftNumber' selected>$shiftNumber</option>";
								$i++;
							}else {
								echo "<option value='$shiftNumber'>$shiftNumber</option>";
							}
					}
				}
				$stmt->close();//close the statement
				mysqli_close($conn);//close the connection to the db
				?>
			</select>
			<script type="text/javascript">
			     $(function(){
			       $('#selectShift').multiselect({
			         includeSelectAllOption: true
			       });
			     });
			</script>
			<div class="container">
				<div>
          <input id='modifyButton' name="modify" type="submit" value="Modify">
        </div>
        <div>
          <input id='deleteButton' name="Delete" type="submit" value="Delete">
        </div>
        <div>
          <input id='addButton' name="Add" type="submit" value="Add">
        </div>
      </div>
    </form>
		<?php
      if(isset($_GET['packagename'])){//when enter the page from package_management page or click on a Button
        //disable add button
        echo "<script>document.getElementById('addButton').disabled = 'disabled';</script>";
      }else{//if userName not set
        echo "<script>";
        //disable modify button
        echo "document.getElementById('modifyButton').disabled = 'disabled';";
        //disable delete button
        echo "document.getElementById('deleteButton').disabled = 'disabled';";
        echo "</script>";
      }
    ?>
	</fieldset><img class="background" src="../photos/dumbell_curl.GIF">
</body>
</html>
<?php include_once "../footer/footer.php"; ?>
