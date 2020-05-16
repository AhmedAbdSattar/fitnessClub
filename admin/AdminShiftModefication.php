<?php
  require_once("adminConfig.php");
?>
<!DOCTYPE html>
<html>
<head>
<meta charset utf-8>
 <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">
 <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.12/css/bootstrap-multiselect.css" rel="stylesheet" type="text/css">
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js">
	</script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js">
	</script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js">
	</script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.12/js/bootstrap-multiselect.js">
	</script>
<link rel="stylesheet" href="stylecontainerOFShift.css">
</head>
<body>
      <div class="header">
        <h1 id='shiftH1'>#Shift NAME</h1>
      </div>


<fieldset>
  <legend>Shifts Information</legend>
  <form id="shift" method="get">
        <!--  data of shifts-->
       <input name="shiftnumber" id="shiftnumber" type="text" class="Shift num" placeholder="Shift Number" required>
       <select  id="day" name="day" class="Day" required>
         <?php
          include "../config.php";//config file connect to DB
          foreach ($today as $key => $value) {
            echo "<option value='$key'>$value</option>";
          }
         ?>
       </select>
       <label class ="time" for="start time">Start time</label>
       <input name="startTime" id="startTime" type="time" class="start" required>
       <label class ="time" for="end time">End time</label>
       <input name="endTime" id="endTime" type="time" class="end" required>
       <input name = "maxMember" id="maxMember" type="number" class="maxMember" placeholder="Maximum Number Of Member" required>
        <input type="submit" name="add" id="add" value="ADD" form="shift">
        <input type="submit" name="delete" id="delete" value="DELETE" form="shift">
        <input type="submit" name="update" id="update" value="UPDATE" form="shift">
    </form>


    <div class="Word">Trainer List</div> <!--as Span :)-->
    <div class="TrainerList">
     <!--here you can play :)-->
     <?php
     if (isset($_GET['shiftnumber'])) {
       $shiftNum = $_GET['shiftnumber'];
       //the query string
       $sql = "SELECT trainerID FROM trainershift WHERE shiftNum = '$shiftNum';";
       $stmt = $conn->query($sql);//execute the query
       if ($stmt->num_rows >= 1) {//if there is a user of that data
         //output the data
         while($result = $stmt->fetch_assoc()) {//$result["something"] is the result of the query
           $trainerID = $result["trainerID"];
           ?>
           <a href="<?php echo 'TrainerShift.php?shiftnumber='.$shiftNum.'&trainerID='.$trainerID;?>"> <!--here we will take link of page-->
             <div class="list">
             <label for="Name"><?php echo $trainerID;?></label> <!-- should bring Trainers that in this shift-->
             </div>
           </a>
     <?php
         }
       }
     }?>
     <!--end play-->
    </div>


    <?php
      if(isset($_GET['delete'])){
        $shiftNum = $_GET['shiftnumber'];
        //the query string
        $sql = "DELETE FROM packageshift WHERE shiftNum = '$shiftNum';";
        if ($conn->query($sql) != TRUE) {//execute the query
          echo "<script>alert('Not Deleted');</script>";//error message if not deleted
        }else {
          //the query string
          $sql = "DELETE FROM trainershift WHERE shiftNum = '$shiftNum';";
          if ($conn->query($sql) != TRUE) {//execute the query
            echo "<script>alert('Not Deleted');</script>";//error message if not deleted
          }else {
            //the query string
            $sql = "DELETE FROM shiftwork WHERE shiftNum = '$shiftNum';";
            if ($conn->query($sql) != TRUE) {//execute the query
              echo "<script>alert('Not Deleted');</script>";//error message if not deleted
            }else {
              echo "<script>alert('Deleted Successfully');</script>";//inform the user that deleted Successfully
              echo '<script type="text/javascript">location.href = "Shift_Management.php";</script>';//redirect to the shift page
            }
          }
        }
      }elseif (isset($_GET['update'])) {
        $shiftNum = $_GET['shiftnumber'];
        $shiftDay = $_GET['day'];
        $startTime = date('g:i A' ,strtotime($_GET['startTime']));
        $endTime = date('g:i A' ,strtotime($_GET['endTime']));
        $maxMember = $_GET['maxMember'];
        //the query string
        $sql = "UPDATE shiftwork SET day = $shiftDay, startTime = '$startTime',
          endTime = '$endTime', MaxMemberNumber = $maxMember WHERE shiftNum = '$shiftNum';";
        if ($conn->query($sql) != TRUE) {//execute the query
          echo "<script>alert('Not Updated');</script>";//error message if not Updated
        }else {
          //inform the user that the data updated Successfully
          echo "<script>alert('Updated Successfully');</script>";
        }
      }elseif (isset($_GET['add'])) {
        $shiftNum = $_GET['shiftnumber'];
        $shiftDay = $_GET['day'];
        $startTime = date('g:i A' ,strtotime($_GET['startTime']));
        $endTime = date('g:i A' ,strtotime($_GET['endTime']));
        $maxMember = $_GET['maxMember'];
        //the query string
        $sql = "SELECT shiftNum FROM shiftwork WHERE shiftNum = '$shiftNum';";
        //execute the query
        $stmt = $conn->query($sql);
        if($stmt->num_rows >= 1) {//if there is a user of that data
          echo "<script>alert('that shift is already exist');</script>";//error message
        }else {
          //the query string
          $sql = "INSERT INTO shiftwork(shiftNum, day, startTime, endTime, MaxMemberNumber)
            VALUES ('$shiftNum', $shiftDay, '$startTime', '$endTime', $maxMember);";
          if ($conn->query($sql) !== TRUE) {//execute the query
            echo "<script>alert('Error with DB');</script>";//error message
          }else {
            echo "<script>alert('Added Successfully');</script>";//inform the user that trainer added Successfully
          }
        }
      }
      if (isset($_GET['shiftnumber'])) {
        $shiftNum = $_GET['shiftnumber'];
        //the query string
        $sql = "SELECT day, startTime, endTime, MaxMemberNumber FROM shiftwork
          WHERE shiftNum = '$shiftNum';";
        //execute the query
        $stmt = $conn->query($sql);
        if ($stmt->num_rows == 1) {//if there is only one shift of that data
          //output the data
          if($result = $stmt->fetch_assoc()) {//$result["something"] is the result of the query
            $shiftDay = $result['day'];
            $startTime = $result['startTime'];
            $endTime = $result['endTime'];
            $maxMember = $result['MaxMemberNumber'];
            echo "<script>";
            //change page title
            echo "document.title = 'Admin@$shiftNum';";
            //disable the shiftnumber bacuase it is not editable
            echo "document.getElementById('shiftnumber').readOnly = true;";
            //show the value of the shiftnumber
            echo "document.getElementById('shiftnumber').value = '$shiftNum';";
            //show the value of the shiftNum on the header
            echo "document.getElementById('shiftH1').innerHTML = '$shiftNum';";
            //show the value of the start time
            echo "document.getElementById('startTime').value = '$startTime';";
            //show the value of the end time
            echo "document.getElementById('endTime').value = '$endTime';";
            //select the day
            echo "document.getElementById('day').selectedIndex = $shiftDay;";
            //show the value of the maxMember
            echo "document.getElementById('maxMember').value = $maxMember;";
            //disable add button
            echo "document.getElementById('add').disabled = 'disabled';";
            echo "</script>";
          }
        }else{
          echo "<script>alert('Error with DB');</script>";//error message
        }
        $stmt->close();//close the statement
      }else{
        echo "<script>";
        //disable modify button
        echo "document.getElementById('update').disabled = 'disabled';";
        //disable delete button
        echo "document.getElementById('delete').disabled = 'disabled';";
        echo "</script>";
      }
      mysqli_close($conn);//close the connection to the db
    ?>
</fieldset>
</body>
</html>
