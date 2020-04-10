<?php
	session_start();
	if(isset($_SESSION['permission'])){
		header("Location: member/member_Home_page.php");//redirect to login page
    exit();
	}
 ?>

<!DOCTYPE html>
	<!-- برجاء العلم ان هذه صفحة bootstrap وانا مليش دعوة بالكود -->
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://fonts.googleapis.com/css?family=Roboto:400,700" rel="stylesheet">
<title>Sign up Form</title> <!-- لعبت هنا  -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<!-- ده ستايل ملناش دعوة بس انا فاهمه مش كاتبه اوك -->
<style type="text/css">
	body {
	/* لعبت هنا*/
		color: #fff;
		background: url("photos/gymicon.jpg");
		background-position : top left;
		background-size: 300px 300px;
		background-repeat:no-repeat ;
		font-family: 'Roboto', sans-serif;
	}
    .form-control {
        min-height: 41px;
		box-shadow: none;
		border-color: #e1e4e5;
	}
    .form-control:focus {
		border-color: #5fcaba;
	}
    .form-control, .btn {
        border-radius: 3px;
    }
	.signup-form {
		width: 400px;
		margin: 0 auto;
		padding: 5px 0;
	}
    .signup-form form {
		color: #9ba5a8;
		border-color:#2B2929;
    	margin-bottom: 15px;
        background: #fff;
        box-shadow: 30px 40px 30px #827676;
        padding: 30px;


    }
	.signup-form h2 {
		color: #333;
		font-weight: bold;
        margin-top: 0;
    }
    .signup-form hr {
        margin: 0 -30px 20px;
    }
	.signup-form .form-group {
		margin-bottom: 20px;
	}
    .signup-form label {
		font-weight: normal;
		font-size: 13px;
	}
    .signup-form .btn {
        font-size: 16px;
        font-weight: bold;
		background: #5fcaba;
		border: none;
		min-width: 140px;
    }
	.signup-form .btn:hover, .signup-form .btn:focus {
		background: #3fc0ad;
        outline: none !important;
	}
	.signup-form a {
		color: #fff;
		text-decoration: underline;
	}
    .signup-form a:hover {
		text-decoration: none;
	}
	.signup-form form a {
		color: #5fcaba;
		text-decoration: none;
	}
	.signup-form form a:hover {
		text-decoration: underline;
	}
</style>
</head>
<body>
<div class="signup-form">
    <form action='<?php echo $_SERVER["PHP_SELF"];?>' method="post">
		<h2> Admin Sign Up</h2> <!-- لعبت هنا  -->
		<p>Hello There, I Am 505a Robot.</p> <!-- لعبت هنا  -->
		<hr>
        <div class="form-group">
        	<input type="text" class="form-control" name="name" placeholder="Name" required="required">
        </div>
        <div class="form-group">
        	<input type="email" class="form-control" name="email" placeholder="Email Address" required="require">
        </div>
				<div class="form-group">
        	<input type="tel" class="form-control" name="phone" placeholder="Phone" maxlength="11">
        </div>
		<div class="form-group">
            <input type="password" class="form-control" id = "password" name="password" placeholder="Password" required="required">
        </div>
		<div class="form-group">
            <input type="password" class="form-control" id = "confirm_password" name="confirm_password" placeholder="Confirm Password" required="required">
        </div>
		<div class="form-group">
            <button type="submit" class="btn btn-primary btn-block btn-lg" name="submit" onclick="validatePassword();">Sign Up</button>
        </div>
		<p class="small text-center">By clicking the Sign Up button, you agree to our <br><a href="#">Terms &amp; Conditions</a>, and <a href="#">Privacy Policy</a>.</p> <!--تقريبا المفروض فى حاجه تتحط هنا ههه-->
    </form>
	<div class="text-center">Already have an account? <a href="login.php">Login here</a></div> <!-- وديه على صفحة البتاع معلش --><!-- لعبت هنا  -->

</div>

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
</script>
<?php
	if(isset($_POST["submit"])){
		include "config.php";//config file connect to DB
		$userName = $_POST["email"];
		$phone = $_POST["phone"];
		$sql = "SELECT name FROM person WHERE username = '$userName' OR phoneNumber = '$phone';";//the query string
		$stmt = $conn->query($sql);//execute the query
		if ($stmt->num_rows >= 1) {//if there is a user of that data
			//output the data
      while ($result = $stmt->fetch_assoc()) {//$result["permission"] is the result of the query
				if($userName === $result["username"]){
					echo "<script> alert('that email is already exist'); </script>";
				}
				if($phone === $result["phoneNumber"]){
					echo "<script> alert('that phone number is already exist'); </script>";
				}
			}
			$stmt->close();//close the statement
			mysqli_close($conn);//close the connection to the db
			exit();
		}

		$sql = "INSERT INTO person (name, username, password, phoneNumber)
						VALUES (?, ?, ?, ?);";

		//prepare and bind
		$stmt = $conn->prepare($sql);
		$stmt->bind_param("ssss", $name, $userName, $password, $phone);

		//set parameters
		$name = $_POST["name"];
		$userName = $_POST["email"];
		$password = sha1($_POST["password"]);//the password is encrypted
		$phone = $_POST["phone"];
		if($stmt->execute()){//execute the statement
			//set session parameters
			$_SESSION['permission'] = 3;//assign permission to the session
			$_SESSION['name'] = $name;//assign name to the session
			$_SESSION['userName'] = $userName;//assign userName to the session
			$_SESSION['image'] = constant('personeImage'). 'PERSON.png';//assign image to the session
			$_SESSION['last_login_timestamp'] = time();//store the login time

			$stmt->close();//close the statement
			mysqli_close($conn);//close the connection to the db
			//redirect to the member home page but by js because of some problems with output the data
			echo '<script type="text/javascript">location.href = "member/member_Home_page.php";</script>';
		  exit();
		}else {
			echo "<script> alert('error with DB'); </script>";
		}
	}
?>

</body>
</html>
