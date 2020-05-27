<!doctype html >
<html>
    <head>
        <title> Details </title>
        <link rel="stylesheet" href="PackageSelect.css">
        <meta charset="UTF-8">
    </head>

    </style>
    <body>
      <div class ="start">  <span>  select Package <span> <div>
    <div class="container">
              <!-- looping here -->
              <?php for ($i=0;$i<500;$i++){ ?>
    <a href="PackageDetails.php"> <!-- the details package and submit selection-->
        <div class ="PackageCard">
            Package Name
            <br>
            <br>
            package cost
        </div>
    </a>
              <?php }?>
    </div>
        
    </body>
</html>
