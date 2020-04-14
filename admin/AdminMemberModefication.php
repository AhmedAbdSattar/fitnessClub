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
      <input name="memberphone" id = 'memberPhone' placeholder="Member Phone" required type="tel"> <!-- adimn can`t modification-->
      <input name="password" id = 'password' placeholder="Member Password" required type="password">
    </form>
  </fieldset>
  <fieldset>
    <legend>Training time</legend>
    <form class="memberForm" id="member" name="member">
      <!--

                    <label  for = "start time"> START TIME :</label>
                    <input class = "time" type ="time" value =10:00 Am name = "start time">
                    <label  for = "End time"> END TIME :</label>
                    <input class = "time" type ="time" value =12:00 Am name = "end time">
-->
      <!-- in fact I cant make this list please help me :(-->
      <!-- اعتقد ان هذه صحيحة فقط اعمل loop :(-->
      <select id = 'packageList'>
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
    </form>
  </fieldset>
  <div class="container">
    <!-- dont forget form action-->
    <div>
      <input form="member" name="modify" type="submit" value="Modify">
    </div>
    <div>
      <input form="member" id = 'deleteButton' name="Delete" type="submit" value="Delete">
    </div>
    <div>
      <input form="member" id = 'addButton' name="Add" type="submit" value="Add">
    </div>
  </div>
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
    if(isset($_GET['username'])){
      //we didn't connect to DB because we already connected on line 38
      $username = $_GET['username'];
      //the query string
      $sql = "SELECT name, phoneNumber, image, packageName
        FROM person, memberbill, billpackage
        WHERE person.username = '$username' AND person.username = memberbill.member
        AND memberbill.bill_ID = billpackage.bill_ID
        HAVING MAX(memberbill.bill_ID)";

      $stmt = $conn->query($sql);//execute the query
      if ($stmt->num_rows == 1) {//if there is only one user of that data
        //output the data
        if($result = $stmt->fetch_assoc()) {//$result["something"] is the result of the query
          $memberName = ucwords($result["name"]);
          $phoneNumber = $result['phoneNumber'];
          $image = constant('personeImage'). $result["image"];//assign the image path
          $package = $result["packageName"];
          echo "<script>";
          echo "document.getElementById('username').disabled = true;";//disable the username bacuase it is not editable
          echo "document.getElementById('username').value = '$username';";//show the value of the username
          echo "document.getElementById('memberH1').innerHTML = '$memberName';";//show the value of the name on the header
          echo "document.getElementById('membername').value = '$memberName';";//show the value of the name on the textbox
          echo "document.getElementById('memberPhone').value = '$phoneNumber';";//show the value of the phoneNumber
          echo "document.getElementById('memberImage').src = '$image';";//change image source
          echo "document.getElementById('packageList').value = '$package';";//select the package
          echo "document.getElementById('password').placeholder = 'Password can not be changed';";//tell the user that he can't change password
          echo "document.getElementById('password').disabled = true;";//disable the password
          echo "document.getElementById('password').required = false;";//make the password not required
          echo "document.getElementById('addButton').disabled = 'disabled';";//disable add button
          echo "</script>";
        }
      }else {
        echo "<script>alert('error with the DataBase');</script>";
      }
    }

    if(isset($_GET['Delete'])){
      echo "<script>alert('Delete');</script>";
      $username = $_GET['username'];
      $sql = "DELETE FROM memberbill WHERE memberbill.member = '$username';";

      if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Deleted Successfully');</script>";
        echo '<script type="text/javascript">location.href = "member_management.php";</script>';
      }else {
        echo "<script>alert('Not Deleted');</script>";
      }
    }

    $stmt->close();//close the statement
    mysqli_close($conn);//close the connection to the db
  ?>
</body>
</html>
