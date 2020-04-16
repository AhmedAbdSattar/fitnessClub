<?php
  require_once("adminConfig.php");
?>
<!DOCTYPE html>
<html>
<head>
  <title>Admin@#trainername</title><!-- @ يجب وضع اسم المدرب بعد -->
  <meta charset="utf-8">
  <link href="styleOfAdminTrainerpage.css" rel="stylesheet">
</head>
<body>
  <div class="header">
    <img alt="trainerPhoto" id='trainerImage' src="../photos/PERSON.png">
    <h1 id='trainerH1'>#TRAINER NAME</h1>
  </div>
  <fieldset>
    <legend>Informations</legend>
    <form class="trainerForm" method="get">
      <input name="username" placeholder="Trainer Email" required type="email">
      <input name="trainername" placeholder="Trainer Name" required type="text">
      <input name="trainerpassword" placeholder="Trainer password" required type="password">
      <input name="trainerphone" placeholder="Trainer Phone" required type="text">
      <!--حاسب الليست اععععععععععععععععععععععععع-->
       <label for="cars">Choose shifts:</label>
       <input list="speakers" placeholder="select shift num" required>
        <datalist id="speakers">
          <?php
            include "../config.php";//config file connect to DB
            //the query string
            $sql = "SELECT shiftNum FROM shiftwork;";
            $stmt = $conn->query($sql);//execute the query
            if ($stmt->num_rows >= 1) {//if there is only one user of that data
              //output the data
              while($result = $stmt->fetch_assoc()) {//$result["shiftNum"] is the result of the query
                  $shiftNumber = $result["shiftNum"];
                  echo "<option value='$shiftNumber'>$shiftNumber</option>";
              }
            }
            //we didn't close the DB connection because we will close it at the end of the page
          ?>
      </datalist>
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
  </fieldset>
  <img class="background" src="../photos/Gym-GIF.GIF">
  <?php
      //we didn't open DB connection because we have one opened on line 28
      if(isset($_GET['username'])){//when enter the page from member_management page or click on a Button
        $username = $_GET['username'];//the trainer userName
        //the query string
        $sql = "SELECT person.name, person.phoneNumber, person.image, trainershift.shiftNum
          FROM person, trainershift
          WHERE person.username = '$username' AND person.username = trainershift.trainerID;";
        //execute the query
        $stmt = $conn->query($sql);
        if ($stmt->num_rows >= 1) {//if there is only one user of that data
          while ($result = $stmt->fetch_assoc()) {
            
          }
        }elseif(isset($_GET['Add'])){//if user click the add button

        }else{//the username dosen't exist in DB and add button didn't clicked
          echo "<script>alert('Error with DB');</script>";//error message
        }
        if(isset($_GET['modify'])){//if the user click on modify button

        }
        if(isset($_GET['Delete'])){//if the user click on delete button

        }
      }else{//if userName not set
        echo "<script>";
        //disable modify button
        echo "document.getElementById('modifyButton').disabled = 'disabled';";
        //disable delete button
        echo "document.getElementById('deleteButton').disabled = 'disabled';";
        echo "</script>";
      }
      $stmt->close();//close the statement
      mysqli_close($conn);//close the connection to the db
      ?>
</body>
</html>
