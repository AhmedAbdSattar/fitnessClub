<?php
  require_once("adminConfig.php");
?>
<!DOCTYPE html>
<html>
<head>
<meta charset utf-8>
 <title>Trainer Name & Shift Number</title> <!-- put trainer name and shift number-->
    <style>
     *{
       -webkit-box-sizing:border-box;
       -moz-box-sizing:border-box;
       -o-box-sizing:border-box;
       box-sizing:border-box;
       font-family:Snell Roundhand, cursive;
       }
       body{
       background-image:url("../photos/shift.jpg");
       background-repeat:no-repeat ;
       background-size:cover;
       }
     div{
       text-align:center;
       width:50%;
       padding:20px;
       border-radius:40% 40%;
       margin:auto ;
       margin-top:20%;
       color:white;
     }
     label,input{
       display:block;
       width:300px;
       font-size:30px;
       position:relative;
       margin:10px auto ;
       border-radius:20px;
       text-align:center ;
      text-shadow:0px 0px 10px #00E2E2 ,0px 0px 10px #1FC4C4 ,0px 0px 10px #00A0A0 ;

     }
     input{
       border:2px groove black ;
       text-shadow:none;
     }
     input:focus{
       background-color:aqua;
       box-shadow:0px 0px 10px #00E2E2 ,0px 0px 10px #1FC4C4 ,0px 0px 10px #00A0A0 ;
       color:black;
   }
    </style>
</head>
  <body>

        <div>
          <form method="get">
            <label id="trainerName">Trainer Name </label>
            <input type="hidden" id="trainerID" name="trainerID" required>
            <label id="shift">Shift Number</label>
            <input type="hidden" id="shiftnumber" name="shiftnumber" required>
            <input name="numberOfhour" id = "NOFH" placeholder="Number Of Hour" type="number" required>
          </form>
      </div>
      <?php
        if((!isset($_GET["shiftnumber"])) || (!isset($_GET["trainerID"]))){
          header("Location: Shift_Management.php");//redirect to shift management page
          exit();
        }
        include "../config.php";//config file connect to DB
        if (isset($_GET["numberOfhour"])) {
          $shiftNum = $_GET["shiftnumber"];
          $trainerID = $_GET["trainerID"];
          $hoursNum = $_GET["numberOfhour"];
          //the query string
          $sql = "UPDATE trainershift SET HoursNum = $hoursNum
            WHERE shiftNum = '$shiftNum' AND trainerID = '$trainerID';";
          if ($conn->query($sql) != TRUE) {//execute the query
            echo "<script>alert('Not Updated');</script>";//error message if not Updated
          }else {
            //inform the user that the data updated Successfully
            echo "<script>alert('Updated Successfully');</script>";
          }
        }
        $shiftNum = $_GET["shiftnumber"];
        $trainerID = $_GET["trainerID"];
        //the query string
        $sql = "SELECT HoursNum FROM trainershift
          WHERE shiftNum = '$shiftNum' AND trainerID = '$trainerID';";
        $stmt = $conn->query($sql);//execute the query
        if ($stmt->num_rows == 1) {//if there is only one user of that data
          //output the data
          if($result = $stmt->fetch_assoc()) {//$result["packageName"] is the result of the query
            $hoursNum = $result["HoursNum"];
            //show the value of hours worked on the textbox
            echo "<script>document.getElementById('NOFH').value = $hoursNum;</script>";
          }
        }
        echo "<script>";
        echo "document.getElementById('trainerName').innerHTML = '$trainerID';";
        echo "document.getElementById('shift').innerHTML = '$shiftNum';";
        echo "document.getElementById('trainerID').value = '$trainerID';";
        echo "document.getElementById('shiftnumber').value = '$shiftNum';";
        echo "</script>";

        $stmt->close();//close the statement
        mysqli_close($conn);//close the connection to the db
      ?>
  </body>
</html>
