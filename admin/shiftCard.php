<div class = " container">
  <a href = <?php echo "'AdminShiftModefication.php?shiftnumber=$shiftNum'";?>><!--  VIP: here we should put link of package management page which admin add and delete from it-->
    <div class ="front">
      <h2><?php echo $shiftNum;?></h2>
      <h3><?php echo $shiftDay;?></h3>
     </div>
     <div class ="back">
       <h2>Max members: <?php echo $maxMember;?></h2>
       <time><?php echo $startTime;?></time> - <time><?php echo $endTime;?></time>
     </div>
   </a>
</div>
