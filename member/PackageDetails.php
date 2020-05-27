<!doctype html >
<html>
    <head>
        <title> Details </title>
        <link rel="stylesheet" href="PackageDetails.css">
        <meta charset="UTF-8">
    </head>

    <body>
        <div class="word1">Dates Shifts list</div> <!--list of shifts and date-->
        
                <div class=" container1">
                    <?php for ($i=0;$i<500;$i++){ ?>
                    <div class="list1">
                        <span>Number</span>
                        <span>Day</span>    
                        <span>Start time </span>
                        <span>End time</span>
                    </div>
                     <?php }?>
                </div>
                    
                    
       <div class="word2">Trainers</div><!--list of trainer -->
                <div class=" container2">
                                  <?php for ($i=0;$i<500;$i++){ ?>
                    <div class="list">
                        <span>Trainer name</span>
                    </div>
                    <?php }?>
                </div>
    <div class="packageDetails">
        <h1> Submit select Package <h1>
        <table>
            <tr>
                <th>Package Name</th> <!-- the package selected by  member -->
                <th>Package Cost</th> <!-- the package cost -->
                <th>Offers & Discounts</th><!-- the package discount if found -->
            </tr>
                            <!--please bring this data from db or by programming and push them here--> 
            <tr>
                <td>HAHAHA</td> <!-- the package selected by  member which this  bill belong-->
                <td>1000$</td> <!-- the package cost -->
                <td>no offer</td><!-- the package discount if found -->
            </tr>
        </table>
        <input type="button" value="Select">
    </div>
    </body>
</html>
