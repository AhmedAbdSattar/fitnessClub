<?php
session_start();
require('db.php');

$username="";
$errors = array(); 


if (isset($_POST['login_user'])) {
  $username = mysqli_real_escape_string($conn, $_POST['username']);
  $pwd = mysqli_real_escape_string($conn, $_POST['pwd']);


  if (count($errors) == 0) {
    $query = "SELECT * FROM login WHERE uname='$username' AND pwd='$pwd'";
    $results = mysqli_query($conn, $query);
    if (mysqli_num_rows($results) == 1) {
      $_SESSION['uname'] = $username;
      header("location:home.php");
    }else {
      array_push($errors, "<div class='alert alert-warning'><b>Wrong username/password combination</b></div>");

    }
  }
}

?>





<!DOCTYPE html>
<html>
<head>
	<title>gym management</title>
	<meta charset="utf-8">

    <link rel="stylesheet" href="login-1.css">
    <link rel="stylesheet" href="normalize.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" >
  
</head>
<body>
  <body>
    <div class="middle">
        <a class="btn" href="#">
            <i class="fab fa-facebook-f"></i>
        </a>
        <a class="btn" href="#">
            <i class="fab fa-twitter"></i>
        </a>
        <a class="btn" href="#">
            <i class="fab fa-google"></i>
        </a>
        <a class="btn" href="#">
            <i class="fab fa-youtube"></i>
        </a>
        <a class="btn" href="#">
            <i class="fab fa-instagram"></i>
        </a>
    
    </div>
    
    
    <div class="card">
        <div class="front">
            <img src="h6.jpg">
            <h3>hema khafagy</h3>
        </div>
        <div class="back">
            <p>front-end</p>
        </div>

    </div>
        <div class="card">
        <div class="front">
            <img src="a2.jpg">
            <h3>Ahmed hassen</h3>
        </div>
        <div class="back">
            <p>front-end</p>
        </div>

    </div>
        <div class="card">
        <div class="front">
            <img src="a3.jpg">
            <h3>Ahmed gamal</h3>
        </div>
        <div class="back">
            <p>back-end</p>
        </div>

    </div>
        <div class="card">
        <div class="front">
            <img src="a4.jpg">
            <h3>ismail ibrahim</h3>
        </div>
        <div class="back">
            <p>data_base</p>
        </div>

    </div>
        <div class="card">
        <div class="front">
            <img src="a5.jpg">
            <h3>Ahmed kamal</h3>
        </div>
        <div class="back">
            <p>back-end</p>
        </div>

    </div>
        <div class="card">
        <div class="front">
            <img src="a6.jpg">
            <h3>Abd_elsattar</h3>
        </div>
        <div class="back">
            <p>front-end</p>
        </div>

    </div>
        <div class="card">
        <div class="front">
            <img src="a7.jpg">
            <h3>Abdallh mohamed</h3>
        </div>
        <div class="back">
            <p>back-end</p>
        </div>

    </div>
     <div class="img">
    <img class="im" src="j1.jpg">
    </div>
    
<form class="box" action="" method="post">
    <input type="text" class="form-control mb-2 mr-sm-2" name="username" placeholder="USERNAME" required> <br/>
    <input type="password" class="form-control mb-2 mr-sm-2" name="pwd" placeholder="PASSWORD" required> <br/>
    <input  type="submit"  name="login_user"></button>
</form>

    <div class="column">
        <div class="column1">
        <h2>GYM manangment system</h2>
        Sometimes, no matter how important your goals are to you, it's a struggle to bring your best effort to your gym session (or work up the motivation to make it happen at all). But whether you're trying to lose weight, train for a race, keep your stress in check, or any of the other worthwhile reasons to make fitness a part of your life, staying consistent is key, even when you really, really, really don't feel like it. When you're struggling to remember why it's worth all the effort, these 14 fitness quotes will give you the push you need. Consider these gems of fitness inspiration the antidote to your temporarily unenthusiastic fitness 'tude—or save them for any time you need a little extra boost to get you moving, mind, body, and soul.
        <h2>How Fitness Centers and Gyms Can Use These Tools</h2>
Now that you know how text message marketing works, you can see how to make it work for you. A single text seems so simple, but can be the essential element that makes your fitness center a prime destination for members. It can generate new leads, cultivate interest and bring at risk members back from the brink.

Here are some ways to promote your fitness center or gym and drive sign-ups.

Put Keywords in Plain Sight
Whether on a sign in the gym’s window or across social media channels, putting your unique keyword where potential members can find it will create an easy point of entry. They simply text one word and, in return, get all the info they need and more.
            </div>
    </div>
    


</body>
</html>