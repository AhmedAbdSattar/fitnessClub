
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
      <label> Trainer Name </label>
      <label>Shift Number</label>
      <input name="numberOfhour" id = "NOF" placeholder="Number Of Hour" required type="number" required>
      </div>
    
  </body>
</html>
