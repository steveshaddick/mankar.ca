<?php


$productTypes = $cms->getProductTypesList();

?>
<h2>Product Types</h2>
<a href="/simple-cms/product_types/insert"><b>INSERT NEW PRODUCT TYPE</b></a><br /><br />
<?php
if (count($productTypes) > 0) 
	{ ?>
    
    <table>
    <tr>
    <td width="200px">Product Type ID</td><td width="300px">Name</td><td width="50px"></td>
    </tr>
    
    
    <?php
    foreach ($productTypes as $productType)
    {?>
        <tr>
        <td><a href="/simple-cms/product_types/edit/<?php echo $productType['type_id']; ?>"><?php echo $productType['type_id']; ?></a></td>
        <td><a href="/simple-cms/product_types/edit/<?php echo $productType['type_id']; ?>"><?php echo $productType['name']; ?></a></td>
        <td><a href="#" onClick="checkSure('Are you sure you want to delete <?php echo $productType['name']; ?>?','/simple-cms/product_types/delete/<?php echo $productType['type_id']; ?>')">Delete</a></td>
        </tr>
    <?php } ?>
    
    </table>
    <br />
    <table border="1">
	    <tr>
		    <td width="50px"><a href="/simple-cms/product_types/list/0">|&lt;</a></td>
		    <td width="50px"><a href="/simple-cms/product_types/list/<?php if ($cms->currentDataPage > 0) { echo $cms->currentDataPage-1; } else {echo 0; }?>">&lt;</a></td>
		    <td width="150px">Page <?php echo $cms->currentDataPage+1; ?> of <?php echo $cms->totalDataPages; ?></td>
		    <td width="50px"><a href="/simple-cms/product_types/list/<?php if ($cms->currentDataPage < ($cms->totalDataPages-1)) { echo $cms->currentDataPage+1; } else {echo $cms->totalDataPages-1; }?>">&gt;</a></td>
		    <td width="50px"><a href="/simple-cms/product_types/list/<?php echo $cms->totalDataPages-1; ?>">&gt;|</a></td>
		</tr>
    </table>
<?php }  else {?>
	No product types. Something isn't right.
<?php } ?>