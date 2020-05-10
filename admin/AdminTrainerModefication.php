<?php
  require_once("adminConfig.php");
?>
<!DOCTYPE html>
<html>
<head>
  <title>Admin@#trainername</title><!-- @ يجب وضع اسم المدرب بعد -->
  <meta charset="utf-8">
  <link href="styleOfAdminTrainer.css" rel="stylesheet">

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
                 <!-- فى ملف index.js تعرف تختار الاوبشن-->
                   <div style=index.css>
                          <span class="multi-select">select shift num</span>
                   <div>
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
        //the query string to get the trainer data
        $sql = "SELECT name, phoneNumber, image FROM person
          WHERE person.username = '$username';";
        //execute the query
        $stmt = $conn->query($sql);
        if ($stmt->num_rows == 1) {//if there is only one user of that data
          if ($result = $stmt->fetch_assoc()) {
            $trainerName = ucwords($result["name"]);
            $phoneNumber = $result['phoneNumber'];
            $image = constant('personeImage'). $result["image"];//assign the image path
            $shiftNumber  = array();

            //the query string to get the trainer shift
            $sql = "SELECT shiftNum FROM trainershift WHERE trainerID = '$username';";
            //execute the query
            $stmt = $conn->query($sql);
            if ($stmt->num_rows >= 1) {//if there is shifts
              while ($result = $stmt->fetch_assoc()) {
                array_push($shiftNumber, $result['shiftNum']);
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
              //disable add button
              echo "document.getElementById('addButton').disabled = 'disabled';";

              //select from the list
              echo "var multi =label: 'New York', new SelectPure('.multi-select', {";
              echo "options: [";
              foreach ($shiftNumber as $value) {
                echo "{ label: '$value', value: '$value',},";
              }
              echo '],
                  multiple: true,
                  icon: "fa fa-times",
                  placeholder: "-Please select-",
                  onChange: value => { console.log(value); },
                  classNames: {
                  select: "select-pure__select",
                  dropdownShown: "select-pure__select--opened",
                  multiselect: "select-pure__select--multiple",
                  label: "select-pure__label",
                  placeholder: "select-pure__placeholder",
                  dropdown: "select-pure__options",
                  option: "select-pure__option",
                  autocompleteInput: "select-pure__autocomplete",
                  selectedLabel: "select-pure__selected-label",
                  selectedOption: "select-pure__option--selected",
                  placeholderHidden: "select-pure__placeholder--hidden",
                  optionHidden: "select-pure__option--hidden",
                  }
                });';
              echo "</script>";
            }else{
              echo "<script>alert('Error with DB');</script>";//error message
            }
          }
        }elseif(isset($_GET['Add'])){//if user click the add button

        }else{//the username dosen't exist in DB and add button didn't be clicked
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
     <script src="bundle.min.js"></script>
     <script src="index.js"></script>
</html>
