<!DOCTYPE html>
<html>
<head>
<meta charset utf-8>
<link rel="stylesheet" href="ShiftMangementSyle.css" >

</head>
<body>

        <input type="text" name="filter" placeholder="Shift Number Search" >
        <input type="submit" name="ADD" value="ADD" form="shift">
        <input type="submit" name="DELETE" value="DELETE" form="shift">
        <input type="submit" name="UPDATE" value="UPDATE" form="shift">
        <!-- start table-->
     <table>
            <tbody>
                <tr>  <!-- start header row-->
                    <th>
                        Shift Num
                    </th>
                    
                    <th>
                        Day
                    </th>
                    
                    <th>
                        Start time
                    </th>
                    
                    <th>
                        End time
                    </th>
                  
                    <th>
                        Maxumim Number Of Members
                    </th>
                </tr>  <!-- end header row-->
                
                <!-- this just for experiment please enter the data -->
                
                <tr>  <!-- start table data row -->
                    <td>   1 </td><td>    saturday </td><td>  3pm  </td><td> 5pm  </td><td> 30   </td>
                </tr>
                
                 <tr>
                    <td>   1 </td><td>    saturday </td><td>  3pm  </td><td> 5pm  </td><td> 30   </td>
                </tr>
                   
                 <tr>
                    <td>   1 </td><td>    saturday </td><td>  3pm  </td><td> 5pm  </td><td> 30   </td>
                </tr> <!-- end table data row-->
                    
                    
            </tbody>
    </table>  <!-- end table-->

  <form id="shift">
        <!--  data of shifts-->
       <input type="text" class="Shift num" placeholder="Shift Number " required>
       <input type="text" class="Day" placeholder="DAY">
       <label for="start time"> Start time</label>
       <input type="time" class="start" >
       <label for="end time"> End time</label>
       <input type="time" class="end" >
       <input type="number" class="maxMember" placeholder="Maximum Number Of Member" required>
  </form>     


</body>
</html>