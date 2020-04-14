<?php
  session_start();
  if(isset($_SESSION['permission'])){//check if there is session or not
    switch ($_SESSION['permission']){
      case 1:
        header("Location: admin/Admin_Home_Page.php");//redirect to admin home page
        exit();
        break;
      case 2:
        echo "<script> alert('You have trainer permission'); </script>";
        break;
      case 3:
        echo "<script> alert('You have member permission'); </script>";
        header("Location: member/member_Home_page.php");//redirect to member home page
        exit();
        break;
      default:
        echo "<script> alert('You have no permission please call the admin'); </script>";
        break;
    }
  }
 ?>
<!DOCTYPE html>
<html>
<head>
<title>Gym Page</title>
</head>
<link rel="stylesheet" href="loginstyle.css">
<body>
<div class = "welcomediv">

  <h1 >m3lsh fitness club </h1>
  <h3>welcome dear customers <h3>
  <div class = "sign"> <a href = "formregisteration.php"> Sign Up </a></div>
</div>

</br>

<img class ="welcomephoto" src ='photos/banner.jpg'  >
</br>

<form action ='<?php echo $_SERVER["PHP_SELF"];?>' method="post">
​<div class="container">
    <div class="form-group">
      <label for="email">Email:</label> <br>
      <input type="email" class="form-control" name="email" placeholder="Enter email">
    </div>
    <div class="form-group">
      <label for="pwd">Password:</label> <br>
      <input type="password" class="form-control" name="pwd" placeholder="Enter password">
    </div>
    <div class="checkbox">
      <label><input type="checkbox"> Remember me</label>
    </div>
    <button type="submit" class="btn btn-default">Submit</button>
</div>
</form>
<?php
  if($_SERVER['REQUEST_METHOD']=='POST'){//if the user came to this page through POST request(he click on the login button)
    $userName = $_POST["email"];
    $password = sha1($_POST["pwd"]);//the password is encrypted

    include "config.php";//config file connect to DB
    $sql = "SELECT permission, name, image FROM person WHERE username = '$userName' AND password = '$password';";//the query string
    $stmt = $conn->query($sql);//execute the query
    if ($stmt->num_rows == 1) {//if there is only one user of that data
      //output the data
      if($result = $stmt->fetch_assoc()) {//$result["permission"] is the result of the query

        $_SESSION['permission'] = $result["permission"];//assign permission to the session
        $_SESSION['name'] = ucwords($result["name"]);//assign name to the session
        $_SESSION['image'] = constant('personeImage'). $result["image"];//assign the image path
        $_SESSION['userName'] = $_POST["email"];//assign userName to the session
        $_SESSION['last_login_timestamp'] = time();//store the login time

        //check for his permission and redirect to the next page
        switch ($_SESSION['permission']) {
          case 1:
            header("Location: admin/Admin_Home_Page.php");//redirect to admin home page
            exit();
            break;
          case 2:
            echo "<script> alert('You have trainer permission'); </script>";
            break;
          case 3:
            echo "<script> alert('You have member permission'); </script>";
            header("Location: member/member_Home_page.php");//redirect to member home page
            exit();
            break;
          default:
            echo "<script> alert('You have no permission please call the admin'); </script>";
            break;
        }
          }
    } else {
        echo "<script> alert('wrong password or user name'); </script>";//generate error in password or userName error
    }
    $stmt->close();//close the statement
    mysqli_close($conn);//close the connection to the db
  }
 ?>
</body>
</html>
