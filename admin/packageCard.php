<div class = " container">
  <a href = <?php echo "'AdminPackageModification.php?packagename=$packageName'";?>><!--  VIP: here we should put link of package management page which admin add and delete from it-->
    <div class ="front">
      <h2><?php echo $packageName;?></h2>
      <h3><?php echo $totalCost;?> $</h3>
     </div>
     <div class ="back">
       <h2>discount:  <?php echo $discount;?> %</h2>
       <h3>package cost:  <?php echo $shiftCost;?> $</h3>
     </div>
   </a>
</div>
