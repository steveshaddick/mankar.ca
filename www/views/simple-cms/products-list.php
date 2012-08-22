<?php

$products = $cms->getProductsList();

?>
<h2>Products</h2>
<a href="/simple-cms/products/insert"><b>INSERT NEW PRODUCT</b></a><br /><br />
<?php
if (count($products) > 0) 
	{ ?>
    
    <table>
    <tr>
    <td width="200px">Product ID</td><td width="300px">Name</td><td width="50px"></td>
    </tr>
    
    
    <?php
    foreach ($products as $product)
    {?>
        <tr>
        <td><a href="/simple-cms/products/edit/<?php echo $product['product_id'];?>"><?php echo $product['product_id'];?></a></td>
        <td><a href="/simple-cms/products/edit/<?php echo $product['product_id'];?>"><?php echo $product['name'];?></a></td>
        <td><a href="#" onClick="checkSure('Are you sure you want to delete <?php echo $product['name'];?>?','/simple-cms/products/delete/<?php echo $product['product_id'];?>')">Delete</a></td>
        </tr>
    <?php } ?>
    
    </table>
    <br />
     <table border="1">
	    <tr>
		    <td width="50px"><a href="/simple-cms/products/list/0">|&lt;</a></td>
		    <td width="50px"><a href="/simple-cms/products/list/<?php if ($cms->currentDataPage > 0) { echo $cms->currentDataPage-1; } else {echo 0; }?>">&lt;</a></td>
		    <td width="150px">Page <?php echo $cms->currentDataPage+1; ?> of <?php echo $cms->totalDataPages; ?></td>
		    <td width="50px"><a href="/simple-cms/products/list/<?php if ($cms->currentDataPage < ($cms->totalDataPages-1)) { echo $cms->currentDataPage+1; } else {echo $cms->totalDataPages-1; }?>">&gt;</a></td>
		    <td width="50px"><a href="/simple-cms/products/list/<?php echo $cms->totalDataPages-1; ?>">&gt;|</a></td>
		</tr>
    </table>
<?php }  else {?>
	No products. Weird!
<?php } ?>