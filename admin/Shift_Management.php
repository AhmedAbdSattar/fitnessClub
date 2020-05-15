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
        <h1 id='packageH1'>#Shift NAME</h1>
      </div>
      
        
<fieldset>
  <legend> Shifts Information</legend>
  <form id="shift">
        <!--  data of shifts-->
       <input type="text" class="Shift num" placeholder="Shift Number " required>
       <select  id="day" class="Day" required>
        <option value="Saturday"> Saturday</option>
        <option value="Sunday"> Sunday</option>
        <option value="Monday"> Monday</option>
        <option value="Tuesday"> Tuesday</option>
        <option value="Wednesday"> Wednesday</option>
        <option value="Thursday"> Thursday</option>
        <option value="Friday"> Friday</option>
       </select>
       <label class ="time" for="start time"> Start time</label>
       <input type="time" class="start" >
       <label class ="time" for="end time"> End time</label>
       <input type="time" class="end" >
       <input type="number" class="maxMember" placeholder="Maximum Number Of Member" required>
       <select class="selectCountery" id='selectTrainer'  multiple="multiple" required>
      <option> asdfsd </option> <option> asdfsd </option> <option> afsfasdf </option>
       </select>
  </form>
        <input type="submit" name="ADD" value="ADD" form="shift">
        <input type="submit" name="DELETE" value="DELETE" form="shift">
        <input type="submit" name="UPDATE" value="UPDATE" form="shift">
</fieldset>


<script type="text/javascript">
			     $(function(){
			       $('#selectTrainer').multiselect({
			         includeSelectAllOption: true
			       });
			     });
</script>
</body>
</html>