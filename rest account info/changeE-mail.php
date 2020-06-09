<?php require_once("../sessionConfig.php");?>
<!DOCTYPE html>
<html>
<head>
	<title>Change Account info</title>
	<link rel="stylesheet" type="text/css" href="changeE-mail.css">

</head>
<body>


		<center>
		<form name="changeE-mail" action="changeE-mail.php" method="post" class="myForm">

			<h1>Reset password</h1>
			<input class="filed" type="text" placeholder="name" id="name" name="name">
			<input class="filed" type="tel" maxlength="11" placeholder="phone number" id="phone" name="phone">
			<input class="filed" type="password" placeholder="Old password" name="oldPassword">
			<br>
			<input class="filed" type="password" placeholder="New Password" name="newPassword" id="password">
			<br>
			<input class="filed" type="password" placeholder="Conferm New Password" id="confirm_password">
			<br>
			<label>
				Password must be at least 5 characters
			</label>
			<input class="button1" type="submit" value="save changes" onclick="validatePassword();">
		</form>
		<script>
		var password = document.getElementById("password"),
		  confirm_password = document.getElementById("confirm_password");

		function validatePassword() {
		  if (password.value != confirm_password.value) {
		    confirm_password.setCustomValidity("Passwords Don't Match");
		  } else {
		    confirm_password.setCustomValidity("");
		  }
		}

		document.getElementById("name").value = "<?php echo $_SESSION['name'];?>";
		document.getElementById("phone").value = "<?php echo $_SESSION['phoneNumber'];?>";
		</script>
		</center>
<?php
	if ($_SERVER['REQUEST_METHOD']=='POST'){
		include "config.php";//config file connect to DB
		$username = $_SESSION['userName'];
		$oldPass = $_POST['oldPassword'];
		//the query string
		$sql = "SELECT username FROM person WHERE username = '$username' AND password = '$oldPass';";
		$stmt = $conn->query($sql);//execute the query
    if ($stmt->num_rows == 1) {//if there is only one user of that data
			$newPass = $_POST['newPassword'];
			$name = $_POST['name'];
			$phone = $_POST["phone"];
			//the query string
			$sql = "UPDATE person SET name = '$name', phoneNumber = '$phone',
							password = '$newPass' WHERE username = '$username';";
			if ($conn->query($sql) != TRUE) {//execute the query
				echo "<script>alert('Not Updated');</script>";//error message if not Updated
			}else {
				//inform the user that the data updated Successfully
				echo "<script>alert('Updated Successfully');</script>";
			}
		}else {
			echo "<script> alert('wrong old password'); </script>";//generate error in password
		}
		$stmt->close();//close the statement
		mysqli_close($conn);//close the connection to the db
	}
 ?>
</body>
</html>
<?php include_once "../footer/footer.php"; ?>
