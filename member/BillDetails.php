<?php
  require_once "memberConfig.php";
?>
<!DOCTYPE html>
<html>
<head>
	<title>Details</title>
	<link href="Bill_Style.css" rel="stylesheet">
	<meta charset="UTF-8">
</head>
<body>
	<span class="word">Bill Details :)</span>
	<table>
		<tr>
			<th>Bill Id</th><!-- the id of selected bill-->
			<th>Member Name</th><!-- the Name of member which this  bill belong-->
			<th>Package Name</th><!-- the package selected by  member which this  bill belong-->
			<th>Package Cost</th><!-- the package cost -->
			<th>Offers & Discounts</th><!-- the package discount if found -->
			<th>Bill Value $</th><!-- total value-->
			<th>paied</th><!--if package paid or not-->
		</tr><!--please bring this data from db or by programming and push them here-->
		<tr>
			<td id="bill">2020E5</td><!-- the id of selected bill-->
			<td id="memberName">Abdallah</td><!-- the Name of member which this  bill belong-->
			<td id="packageName">HAHAHA</td><!-- the package selected by  member which this  bill belong-->
			<td id="cost">1000$</td><!-- the package cost -->
			<td id="discount">no offer</td><!-- the package discount if found -->
			<td id="totalCost">1000$</td><!-- total value-->
			<td><input disabled name="check" type="checkbox" id="paied"> <!-- هنشوف هل مدفوعة من قبل او لا--></td><!--if package paid or not-->
		</tr>
	</table><span class="word">If u want pay this bill now</span><br>
	<br>
	<!-- bank card part-->
	<form method="post" action="BillDetails.php">
		<!-- start form-->
    <input type="hidden" name="bill_ID" id="bill_ID">
		<input autocomplete="off" id="credit_card_number" maxlength="19" placeholder="Card Number" type="text"> <!-- card num-->
		 <input autocomplete="off" id="credit_card_owner" placeholder="Owner" required="" type="text"> <!-- member name-->
		 <label for="fort_expiry_date">Fort Expiry Date :</label> <!-- تاريخ انتهاء البطاقة -->
		 <input required="" type="month"> <input autocomplete="off" id="cvc" maxlength="3" placeholder="Card security code" type="text"> <!-- رمز التحقق الخاص بالبنك-->
		<input id="pay" type="submit" value="Pay & Print"> <!-- start form-->
	</form>
  <?php
    if (isset($_POST['bill_ID'])){
      $billID = $_POST['bill_ID'];

      include "../config.php";//config file connect to DB
      $sql = "SELECT person.name, billpackage.packageName, package.shiftCost, package.discount, bill.paied
        FROM bill, billpackage, package, memberbill, person
        WHERE bill.bill_ID = $billID AND bill.bill_ID = billpackage.bill_ID
        AND billpackage.packageName = package.packageName AND bill.bill_ID = memberbill.bill_ID
        AND memberbill.member = person.username;";
        $stmt = $conn->query($sql);//execute the query
      if ($stmt->num_rows == 1) {//if there is only one user of that data
        //output the data
        if($result = $stmt->fetch_assoc()) {//$result["permission"] is the result of the query
          $memberName = $result["name"];
          $packageName = $result["packageName"];
          $cost = $result["shiftCost"];
          $discount = $result["discount"];
          $totalCost = $cost - ($cost*$discount/100);
          $paied = $result["paied"];
          ?>
          <script>
            document.getElementById('bill_ID').value = '<?php echo $billID;?>';
            document.getElementById('bill').innerHTML = '<?php  echo $billID;?>';
            document.getElementById('memberName').innerHTML = '<?php  echo $memberName;?>';
            document.getElementById('packageName').innerHTML = '<?php  echo $packageName;?>';
            document.getElementById('cost').innerHTML = '<?php  echo $cost;?>$';
            document.getElementById('discount').innerHTML = '<?php  echo $discount;?>%';
            document.getElementById('totalCost').innerHTML = '<?php  echo $totalCost;?>$';
            document.getElementById("myCheck").checked = <?php echo ($paied == 1)? "true" : "false";?>;
          </script>
          <?php
        }
      }else {
        header("Location: Bill_Page.php");//redirect to Bill_Page page
        exit();
      }
      echo "<script></script>";
    }else {
      header("Location: Bill_Page.php");//redirect to Bill_Page page
      exit();
    }
   ?>
</body>
</html>
<?php include_once "../footer/footer.php"; ?>
