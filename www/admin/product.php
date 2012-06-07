<title>Customer contacts</title>
<?php

//LAST UPDATE
// 27-09-2007


// load the configuration file.
include("config.php");
?>
<a href=index.php>Home</a>  || <a href=add_product.php>Add Product</a>  || <a href=tradeshows.php>Tradeshows</a><br><br><br>
<?php
        //load all news from the database and then OREDER them by newsid
        //you will notice that newlly added news will appeare first.
        //also you can OREDER by (dtime) instaed of (news id)
        $result = mysql_query("SELECT * FROM product_types ORDER BY type_id",$connect);
        //lets make a loop and get all news from the database
        while($myrow = mysql_fetch_array($result))
             {//begin of loop
               //now print the results:
               echo "<b>";
               echo $myrow['type'];
               echo "</b>";
//Now print products
$products = mysql_query("SELECT * from products pr LEFT JOIN product_photos ph ON pr.product_id = ph.product_id WHERE pr.type_id = $myrow[type_id] order by pr.name DESC",$connect);
//lets make a loop and get all news from the database
        while($productrow = mysql_fetch_array($products))
             {//begin of contact loop
               //now print the results:
               echo "<br><br>&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;<b>";
	    			echo $productrow['name'];
               echo "</b> <i>";
               echo $productrow['code'];
               echo "</i></a>&#160;&#160;";
               echo substr($productrow['description'], 0, 100);
               echo "...&#160;&#160;";
               echo "  || <a href=\"edit_product.php?product_id=$productrow[product_id]\">Edit</a>
                 ||<br><br>";
             }//end of contact loop
echo "<hr>";
             }//end of loop
?>
<!-- here you have the right to go Home or Add News. It's HTML not PHP -->
<br><br>
<a href=index.php>Home</a>  || 