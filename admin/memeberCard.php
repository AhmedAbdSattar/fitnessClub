<div class = ' container'>
       <a href = 'https://www.facebook.com'>
       <!--VIP: here we should put link of member page which admin add and delete from it-->

    <div class ='front'>
        <img src = '<?php echo $memberImage;?>' alt=' memberPhoto'>  <!-- اختار الصورة ن فضلك-->
        <h2><?php echo $memberUserName;?></h2>

    </div>

    <div class ='back'>
       <header><?php echo $memberName;?></header> <!--#need Email of user please -->
       <h3 ><?php echo $memberDay;?></h3>
         <time><?php echo $startTime;?></time> - <time><?php echo $endTime;?></time><!--#End like 3Am  -->
    </div>
       </a>
</div>
