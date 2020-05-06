<!doctype html >    
<html>
    <head>                               <!-- BILL PAGE--> 
       <meta charset="UTF-8">
       <link rel="stylesheet" href="Bill_Style.css">
       <link href="https://fonts.googleapis.com/css?family=Reem+Kufi&display=swap" rel="stylesheet">

       <title> #Member Name @M3lsh_FC</title> <!-- member name here please developer :)-->
    </head>
<body>
                                          <!-- الافتتاحية-->
        <div> <p class="p1"> Welcome Sir on Money Page You Will Pay  The blood of  Your Heart :) </p> <p class="p2">اهلا بحضرتك فى صفحة النقود انت سوف تدفع دم قلبك  :)  </p></div>
                                          <!-- الافتتاحية-->
    <!-- Table with pay details-->
        <h2> Please Check Details Of Bill  </h2>
        <label for ="bill cost "> Bill Value :</label>
        <input type="text" name="bill" value=" 100,000,000 $" disabled > <!-- you should bring the value :) m3lsh-->
        <!-- Start table contain to row-->
        <table>
          
            <tr>
                <th>Bill Id</th>
                <th>Member Name</th>
                <th>Member Email</th>
                <th>Package Name</th>
                <th>Package Cost</th>
                <th>Offers & Discounts</th>
                <th>Bill Value $</th>
                <th>paied</th>
            </tr>
                            <!--please bring this data from db or by programming--> 
            <tr>
                <td>2020E5</td>
                <td>Abdallah</td>
                <td>Absallah</td>
                <td>جومباز</td>
                <td>تلاتاشر الف جنيه</td>
                <td>no offer</td>
                <td>مليون الا 100</td>
                <td><input type="checkbox" name="check" checked disabled> <!-- هنشوف هل مدفوعة من قبل او لا--></td>
            </tr>
        </table>
        <!-- End table -->
        <!-- Now we start in credit card and print bill-->

              <form> <!-- start form-->
                      <input type="text" id="credit_card_number"maxlength="19" autocomplete="off" placeholder="Card Number" required/> <!-- card num-->
                      <input type="text" id="credit_card_owner" autocomplete="off" placeholder="Owner" required /> <!-- member name-->
                      <label for="fort_expiry_date">Fort Expiry Date :</label> <!-- تاريخ انتهاء البطاقة -->
                      <input type="month" for="fort_expiry_date" required>

                           <input type="text" id="cvc"maxlength="3" autocomplete="off" placeholder="Card security code" required/> <!-- رمز التحقق الخاص بالبنك-->
              </form>
                           <input type="submit" id="pay" value="Pay & Print"  />  <!-- start form-->
                                         

        
</body>
    
    
    
</html>