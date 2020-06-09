<?php
  require_once("adminConfig.php");
?>
<!DOCTYPE html>
<html>
<head>
  <title>Admin@#trainername</title><!-- @ يجب وضع اسم المدرب بعد -->
  <meta charset="utf-8">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.12/css/bootstrap-multiselect.css" type="text/css">
  <link href="styleOfAdminTrainer.css" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.12/js/bootstrap-multiselect.js"></script>
</head>
<body>
  <div class="header">
    <img alt="trainerPhoto" id='trainerImage' src="../photos/PERSON.png">
    <h1 id='trainerH1'>#TRAINER NAME</h1>
  </div>
  <fieldset>
    <legend>Informations</legend>
    <form class="trainerForm" method="get">
      <input name="username" id = "username" placeholder="Trainer Email" required type="email" autocomplete="off">
      <input name="trainername" id = "trainername" placeholder="Trainer Name" required type="text" autocomplete="off" >
      <input name="trainerpassword" id = "trainerpassword" placeholder="Trainer password" required type="password" autocomplete="off">
      <input name="trainerphone" id = "trainerphone" placeholder="Trainer Phone" required type="tel" maxlength="11" autocomplete="off">
      <!--new one-->
      <input name="totalworks" type="number" id="totalworks" placeholder="Total time of work in all shifts" readonly> <!-- here place for read total work if you want admin can to modify on it remove read only-->

        <select id='selectShift' name = 'selectShift[]' multiple = "multiple" required>
          <?php
            include "../config.php";//config file connect to DB
            $trainershift  = array();//trainer shift must be defined outside the if stmt
            if(isset($_GET['modify'])){//if the user click on modify button
              $username = $_GET['username'];//get the username of the member
              $trainerName = $_GET['trainername'];//get the phone number of the member
              $phoneNumber = $_GET['trainerphone'];//get the phone number of the member
              $trainershift = $_GET['selectShift'];//get the selected shifts
              //the query string
              $sql = "UPDATE person SET name = '$trainerName', phoneNumber = '$phoneNumber'
                WHERE username = '$username';";
              if ($conn->query($sql) != TRUE) {//execute the query
                echo "<script>alert('Not Updated');</script>";//error message if not Updated
              }else {
                //the query string
                $sql = "DELETE FROM trainershift WHERE trainerID = '$username';";
                if ($conn->query($sql) != TRUE) {//execute the query
                  echo "<script>alert('Not Updated');</script>";//error message if not Updated
                }else {
                  $flag = TRUE;
                  foreach ($trainershift as $value) {
                    //the query string
                    $sql = "INSERT INTO trainershift(trainerID, shiftNum)
                      VALUES ('$username', '$value');";
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
              $username = $_GET['username'];//the trainer userName
              //the query string
              $sql = "DELETE FROM trainershift WHERE trainerID = '$username';";
              if ($conn->query($sql) != TRUE) {//execute the query
                echo "<script>alert('Not Deleted');</script>";//error message if not deleted
              }else {
                //the query string
                $sql = "DELETE FROM person WHERE username = '$username';";
                if ($conn->query($sql) != TRUE) {//execute the query
                  echo "<script>alert('Not Deleted');</script>";//error message if not deleted
                }else {
                  //inform the user that deleted Successfully
                  echo "<script>alert('Deleted Successfully');</script>";
                  //redirect to trainer page
                  echo '<script type="text/javascript">location.href = "Trainer_management.php";</script>';
                }
              }
            }
            if(isset($_GET['username'])){//when enter the page from member_management page or click on a Button
              $username = $_GET['username'];//the trainer userName
              //the query string to get the trainer data
              $sql = "SELECT name, phoneNumber, image, SUM(trainershift.HoursNum)
                FROM person JOIN trainershift ON person.username = '$username'
                AND trainershift.trainerID = person.username;";
              //execute the query
              $stmt = $conn->query($sql);
              if ($stmt->num_rows == 1) {//if there is only one user of that data
                if ($result = $stmt->fetch_assoc()) {
                  $trainerName = ucwords($result["name"]);
                  $phoneNumber = $result['phoneNumber'];
                  $image = constant('personeImage'). $result["image"];//assign the image path
                  $hoursNum = $result['SUM(trainershift.HoursNum)'];
                  //the query string to get the trainer shift
                  $sql = "SELECT shiftNum FROM trainershift WHERE trainerID = '$username';";
                  //execute the query
                  $stmt = $conn->query($sql);
                  if ($stmt->num_rows >= 1) {//if there is shifts
                    while ($result = $stmt->fetch_assoc()) {
                      array_push($trainershift, $result['shiftNum']);
                    }
                    echo "<script>";
                    //change page title
                    echo "document.title = 'Admin@$trainerName';";
                    //disable the username bacuase it is not editable
                    echo "document.getElementById('username').readOnly = true;";
                    //show the value of the username
                    echo "document.getElementById('username').value = '$username';";
                    //show the value of the name on the header
                    echo "document.getElementById('trainerH1').innerHTML = '$trainerName';";
                    //show the value of the name on the textbox
                    echo "document.getElementById('trainername').value = '$trainerName';";
                    //show the value of the phoneNumber
                    echo "document.getElementById('trainerphone').value = '$phoneNumber';";
                    //change image source
                    echo "document.getElementById('trainerImage').src = '$image';";
                    //tell the user that he can't change password
                    echo "document.getElementById('trainerpassword').placeholder = 'Password can not be changed';";
                    //disable the password
                    echo "document.getElementById('trainerpassword').disabled = true;";
                    //make the password not required
                    echo "document.getElementById('trainerpassword').required = false;";
                    echo "</script>";
                    echo "<script>document.getElementById('totalworks').value = $hoursNum;</script>";
                  }else{
                    echo "<script>alert('Error with DB');</script>";//error message
                  }
                }
              }elseif(isset($_GET['Add'])){//if user click the add button
                $username = $_GET['username'];//get the username of the member
                $password = sha1($_GET["trainerpassword"]);//the password is encrypted
                $trainerName = $_GET['trainername'];//get the phone number of the member
                $phoneNumber = $_GET['trainerphone'];//get the phone number of the member
                $trainershift = $_GET['selectShift'];//get the selected shifts
                //the query string
                $sql = "SELECT username FROM person WHERE username = '$username'";
                //execute the query
                $stmt = $conn->query($sql);
                if($stmt->num_rows >= 1) {//if there is a user of that data
                  echo "<script>alert('that email is already exist');</script>";//error message
                }else {
                  //the query string
                  $sql = "SELECT phoneNumber FROM person WHERE phoneNumber = '$phoneNumber'";
                  //execute the query
                  $stmt = $conn->query($sql);
                  if($stmt->num_rows >= 1) {//if there is a user of that data
                    echo "<script>alert('that phone number is already exists');</script>";//error message
                  }else{
                    //the query string
                    $sql = "INSERT INTO person(name, username, password, permission,
                      phoneNumber) VALUES ('$trainerName', '$username', '$password', 2, '$phoneNumber');";
                    if ($conn->query($sql) === TRUE) {//execute the query
                      $flag = TRUE;
                      foreach ($trainershift as $value) {
                        //the query string
                        $sql = "INSERT INTO trainershift(trainerID, shiftNum)
                          VALUES ('$username', '$value');";
                        if ($conn->query($sql) !== TRUE) {//execute the query
                          echo "<script>alert('Error in DB ');</script>";//error message
                          $flag = false;
                          break;
                        }
                      }
                      if($flag){
                        echo "<script>alert('Added Successfully');</script>";//inform the user that trainer added Successfully
                        echo "<script>location.reload();</script>";//refresh the page to show the added data
                      }
                    }else {
                      echo "<script>alert('Error with DB');</script>";//error message
                    }
                  }
                }
              }
            }else{//the username dosen't exist in DB and add button didn't be clicked
                echo "<script>alert('Error with DB');</script>";//error message
              }
            $i = 0;//counter for the trainershift array
            //the query string
            $sql = "SELECT shiftNum FROM shiftwork;";
            $stmt = $conn->query($sql);//execute the query
            if ($stmt->num_rows >= 1) {//if there is only one user of that data
              //output the data
              while($result = $stmt->fetch_assoc()) {//$result["shiftNum"] is the result of the query
                  $shiftNumber = $result["shiftNum"];
                  if((isset($trainershift[$i])) && (strcmp($shiftNumber, $trainershift[$i]) == 0)){
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
      if(isset($_GET['username'])){//when enter the page from member_management page or click on a Button
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
  </fieldset>
  <img class="background" src="../photos/Gym-GIF.GIF">

</body>
</html>
<?php include_once "../footer/footer.php"; ?>
