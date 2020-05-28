<?php
  require_once "memberConfig.php";
?>
<!DOCTYPE html>
<html>
<head>
	<!-- BILL PAGE-->
	<meta charset="UTF-8">
	<link href="Bill_Style.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Reem+Kufi&display=swap" rel="stylesheet">
	<title>Pay Page</title><!-- member name here please developer :)-->
</head>
<body>
	<!-- الافتتاحية-->
	<div>
		<p class="p1">Welcome Sir on Money Page You Will Pay The blood of Your Heart :)</p>
		<p class="p2">اهلا بحضرتك فى صفحة النقود انت سوف تدفع دم قلبك :)</p>
	</div><!-- الافتتاحية-->
	<!--list of bills -->
	<span class="word">* List Of bills *</span>
  <?php
    $userName = $_SESSION['userName'];
    include "../config.php";
    $sql = "SELECT bill.bill_ID, endOfTheGracePeriod, paied FROM bill JOIN memberbill
      ON bill.bill_ID = memberbill.bill_ID AND memberbill.member = '$userName'
      ORDER BY bill.bill_ID DESC;";
    $stmt = $conn->query($sql);//execute the query
    if ($stmt->num_rows >= 1) {//if there is a bill of that userName
      //output the data
      while($result = $stmt->fetch_assoc()) {//$result["something"] is the result of the query
        ?>
        <div class="BillList">
          <a onclick="linkFN('<?php echo $result['bill_ID'];?>')">
          <div class="list">
            <label for="Name">bill id :</label> <!--here from db bring bill id-->
             <label><?php echo $result['bill_ID'];?></label>
             <label for="Name">end of the grace period :<?php echo date('jS F, Y' ,strtotime($result['endOfTheGracePeriod']));?></label>
             <input disabled type="checkbox" <?php echo ($result ['paied'] == 1) ? "checked": " "; ?>><!-- check box if bill paid or not-->
          </div>
          </a>
        </div>
        <?php
      }
    }
    $stmt->close();//close the statement
    mysqli_close($conn);//close the connection to the db
  ?>
  <form id="bill" action="BillDetails.php" method="post">
    <input type="hidden" name="bill_ID" id="bill_ID">
  </form>
  <script>
    function linkFN(billID){
      document.getElementById("bill_ID").value = billID;
      document.getElementById("bill").submit();
    }
  </script>

</body>
</html>
