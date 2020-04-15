<?php
  require_once("adminConfig.php");
?>
<!DOCTYPE html>
<html>
<head>
  <title>Admin@#membername</title><!-- @ يجب وضع اسم العميل بعد  -->
  <meta charset="utf-8">
  <link href="styleOfAdminMemberpage.css" rel="stylesheet"><!-- AM: admin member-->
</head>
<body>
  <div class="header">
    <img id = 'memberImage' alt="memberPhoto" src="../photos/PERSON.png">
    <h1 id = 'memberH1'>#MEMBER NAME</h1>
  </div>
  <fieldset>
    <legend>Informations</legend>
    <form class="memberForm" method="get">
      <input name="membername" id = 'membername' placeholder="Member Name" required type="text"> <!-- adimn can`t modification-->
      <input name="username" id = 'username' placeholder="Member Email" required type="email">
      <input name="memberphone" id = 'memberPhone' placeholder="Member Phone" required type="tel" maxlength="11"> <!-- adimn can`t modification-->
      <input name="password" id = 'password' placeholder="Member Password" required type="password">
      <select id = 'packageList' name = 'package'>
        <?php
          include "../config.php";//config file connect to DB
          //the query string
          $sql = "SELECT packageName FROM package;";
          $stmt = $conn->query($sql);//execute the query
          if ($stmt->num_rows >= 1) {//if there is only one user of that data
            //output the data
            while($result = $stmt->fetch_assoc()) {//$result["packageName"] is the result of the query
              $packageName = $result["packageName"];
              echo "<option value='$packageName'>$packageName</option>";
            }
          }
          //we didn't close the connection to DB because we will use it again
        ?>
      </select>

    <div class="container">
        <!-- dont forget form action-->
        <div>
          <input id = 'modifyButton' name="modify" type="submit" value="Modify">
        </div>

        <div>
          <input id = 'deleteButton' name="Delete" type="submit" value="Delete">
        </div>

        <div>
          <input id = 'addButton' name="Add" type="submit" value="Add">
        </div>
   </div>

    </form>
  </fieldset>

  <table>
    <tr>
      <th>Day</th>
      <th>attendance</th>
    </tr>
    <tr>
      <td>Saturday</td>
      <td><input checked disabled form="member" name="check box" type="checkbox"></td>
    </tr>
    <tr>
      <td>Sunday</td>
      <td><input checked disabled form="member" name="check box" type="checkbox"></td>
    </tr>
    <tr>
      <td>Monday</td>
      <td><input checked disabled form="member" name="check box" type="checkbox"></td>
    </tr>
    <tr>
      <td>Tuesday</td>
      <td><input checked disabled form="member" name="check box" type="checkbox"></td>
    </tr>
    <tr>
      <td>Wednesday</td>
      <td><input checked disabled form="member" name="check box" type="checkbox"></td>
    </tr>
    <tr>
      <td>Thursday</td>
      <td><input checked disabled form="member" name="check box" type="checkbox"></td>
    </tr>
    <tr>
      <td>Friday</td>
      <td><input checked disabled form="member" name="check box" type="checkbox"></td>
    </tr>
  </table>

  <?php
    if(isset($_GET['username'])){//when enter the page from member_management page
      //we didn't connect to DB because we already connected on line 38
      $username = $_GET['username'];
      //the query string
      $sql = "SELECT name, phoneNumber, image, packageName
        FROM person, memberbill, billpackage
        WHERE person.username = '$username' AND person.username = memberbill.member
        AND memberbill.bill_ID = billpackage.bill_ID
        HAVING MAX(memberbill.bill_ID)";
      //execute the query
      $stmt = $conn->query($sql);
      if ($stmt->num_rows == 1) {//if there is only one user of that data
        //output the data
        if($result = $stmt->fetch_assoc()) {//$result["something"] is the result of the query
          $memberName = ucwords($result["name"]);
          $phoneNumber = $result['phoneNumber'];
          $image = constant('personeImage'). $result["image"];//assign the image path
          $package = $result["packageName"];
          echo "<script>";
          //change page title
          echo "document.title = 'Admin@$memberName';";
          //disable the username bacuase it is not editable
          echo "document.getElementById('username').readOnly = true;";
          //show the value of the username
          echo "document.getElementById('username').value = '$username';";
          //show the value of the name on the header
          echo "document.getElementById('memberH1').innerHTML = '$memberName';";
          //show the value of the name on the textbox
          echo "document.getElementById('membername').value = '$memberName';";
          //show the value of the phoneNumber
          echo "document.getElementById('memberPhone').value = '$phoneNumber';";
          //change image source
          echo "document.getElementById('memberImage').src = '$image';";
          //select the package
          echo "document.getElementById('packageList').value = '$package';";
          //tell the user that he can't change password
          echo "document.getElementById('password').placeholder = 'Password can not be changed';";
          //disable the password
          echo "document.getElementById('password').disabled = true;";
          //make the password not required
          echo "document.getElementById('password').required = false;";
          //disable add button
          echo "document.getElementById('addButton').disabled = 'disabled';";
          echo "</script>";
        }
      }elseif (isset($_GET['Add'])){//if user click the add button
        $username = $_GET['username'];//get the username of the member
        $password = sha1($_GET["password"]);//the password is encrypted
        $memberName = $_GET['membername'];//get the phone number of the member
        $phoneNumber = $_GET['memberphone'];//get the phone number of the member
        $package = $_GET['package'];//get the package value of the member
        //the query string
        $sql = "SELECT username FROM person WHERE username = '$username'";
        //execute the query
        $stmt = $conn->query($sql);
        if($stmt->num_rows >= 1) {//if there is a user of that data
          echo "<script>alert('that email is already exists');</script>";//error message
        }else {
          //the query string
          $sql = "SELECT phoneNumber FROM person WHERE phoneNumber = '$phoneNumber'";
          //execute the query
          $stmt = $conn->query($sql);
          if($stmt->num_rows >= 1) {//if there is a user of that data
            echo "<script>alert('that phone number is already exists');</script>";//error message
          }else{
            //the query string
            $sql = "INSERT INTO person (name, username, password, phoneNumber)
              VALUES ('$memberName', '$username', '$password', '$phoneNumber');";
            if ($conn->query($sql) === TRUE) {//execute the query
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
                    //the query string
                    $sql = "INSERT INTO memberbill (member, bill_ID) VALUES ('$username', $billID);";
                    if ($conn->query($sql) === TRUE) {//execute the query
                      //the query string
                      $sql = "INSERT INTO billpackage (packageName, bill_ID)
                          VALUES ('$package', $billID);";
                      if ($conn->query($sql) === TRUE) {//execute the query
                        echo "<script>";
                        //change page title
                        echo "document.title = 'Admin@$memberName';";
                        //disable the username bacuase it is not editable
                        echo "document.getElementById('username').readOnly = true;";
                        //show the value of the username
                        echo "document.getElementById('username').value = '$username';";
                        //show the value of the name on the header
                        echo "document.getElementById('memberH1').innerHTML = '$memberName';";
                        //show the value of the name on the textbox
                        echo "document.getElementById('membername').value = '$memberName';";
                        //show the value of the phoneNumber
                        echo "document.getElementById('memberPhone').value = '$phoneNumber';";
                        //change image source
                        echo "document.getElementById('memberImage').src = '$image';";
                        //select the package
                        echo "document.getElementById('packageList').value = '$package';";
                        //tell the user that he can't change password
                        echo "document.getElementById('password').placeholder = 'Password can not be changed';";
                        //disable the password
                        echo "document.getElementById('password').disabled = true;";
                        //make the password not required
                        echo "document.getElementById('password').required = false;";
                        //disable add button
                        echo "document.getElementById('addButton').disabled = 'disabled';";
                        echo "</script>";
                        //inform the user that the member Added Successfully
                        echo "<script>alert('Added Successfully');</script>";
                      }
                    }
                  }
                }
              }
            }
          }
        }
      }else {
        echo "<script>alert('error with the DataBase');</script>";//error message
        exit();
      }



      if (isset($_GET['modify'])){//if the user click on modify button
        $username = $_GET['username'];//get the username of the member
        $memberName = $_GET['membername'];//get the phone number of the member
        $phoneNumber = $_GET['memberphone'];//get the phone number of the member
        $package = $_GET['package'];//get the package value of the member
        //the query string
        $sql = "UPDATE person SET name = '$memberName', phoneNumber = '$phoneNumber'
            WHERE username = '$username';";
        if ($conn->query($sql) != TRUE) {//execute the query
          echo "<script>alert('Not Updated');</script>";//error message if not Updated
        }else {
          //the query string that get the last bill id to change it's package
          $sql = "SELECT MAX(bill_ID) FROM memberbill WHERE member = '$username';";
          $stmt = $conn->query($sql);//execute the query
          if ($stmt->num_rows == 1) {//if there is only one user of that data
            //output the data
            if($result = $stmt->fetch_assoc()) {//$result["MAX(bill_ID)"] is the result of the query
              $billID = $result["MAX(bill_ID)"];
              //the query string
              $sql = "UPDATE billpackage SET packageName = '$package' WHERE bill_ID = $billID;";
              if ($conn->query($sql) != TRUE) {//execute the query
                echo "<script>alert('Not Updated');</script>";//error message if not Updated
              }else {
                //inform the user that the data updated Successfully
                echo "<script>alert('Updated Successfully');</script>";
              }
            }
          }
        }
      }

      if(isset($_GET['Delete'])){//if the user click on delete button
        $username = $_GET['username'];//get the username of the member
        //the query string
        $sql = "DELETE FROM memberbill WHERE memberbill.member = '$username';";
        if ($conn->query($sql) != TRUE) {//execute the query
          echo "<script>alert('Not Deleted');</script>";//error message if not deleted
        }else {
          //the query string
          $sql = "DELETE FROM memberattendance WHERE memberattendance.member = '$username';";
          if ($conn->query($sql) != TRUE) {//execute the query
            echo "<script>alert('Not Deleted');</script>";//error message if not deleted
          }else {
            //the query string
            $sql = "DELETE FROM person WHERE person.username = '$username';";
            if ($conn->query($sql) != TRUE) {//execute the query
              echo "<script>alert('Not Deleted');</script>";//error message if not deleted
            }else {
              //inform the user that deleted Successfully
              echo "<script>alert('Deleted Successfully');</script>";
              //redirect to member page
              echo '<script type="text/javascript">location.href = "member_management.php";</script>';
            }
          }
        }
      }
    }else {//if userName not set
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
  <img class ="background" src="../photos/Gym-GIF.GIF">
</body>
</html>
