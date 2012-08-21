<?php

$dealers = $cms->getDealersTable();

?>
<h2>Dealers</h2>
<a href="/simple-cms/dealers/insert"><b>INSERT NEW DEALER</b></a><br /><br />
<?php
if (count($dealers) > 0) 
	{ ?>
    
    <table>
    <tr>
    <td width="200px">Dealer ID</td><td width="300px">Name</td><td width="50px"></td>
    </tr>
    
    
    <?php
    foreach ($dealers as $dealer)
    {?>
        <tr>
        <td><a href="/simple-cms/dealers/edit/<?php echo $dealer['dealer_id']; ?>"><?php echo $dealer['dealer_id']; ?></a></td>
        <td><a href="/simple-cms/dealers/edit/<?php echo $dealer['dealer_id']; ?>"><?php echo $dealer['name']; ?></a></td>
        <td><a href="#" onClick="checkSure('Are you sure you want to delete <?php echo $dealer['name']; ?>?','/simple-cms/dealers/delete/<?php echo $dealer['dealer_id']; ?>')">Delete</a></td>
        </tr>
    <?php } ?>
    
    </table>
    <br />
    <table border="1">
	    <tr>
		    <td width="50px"><a href="/simple-cms/dealers/list/0">|&lt;</a></td>
		    <td width="50px"><a href="/simple-cms/dealers/list/<?php if ($cms->currentDataPage > 0) { echo $cms->currentDataPage-1; } else {echo 0; }?>">&lt;</a></td>
		    <td width="150px">Page <?php echo $cms->currentDataPage+1; ?> of <?php echo $cms->totalDataPages; ?></td>
		    <td width="50px"><a href="/simple-cms/dealers/list/<?php if ($cms->currentDataPage < ($cms->totalDataPages-1)) { echo $cms->currentDataPage+1; } else {echo $cms->totalDataPages-1; }?>">&gt;</a></td>
		    <td width="50px"><a href="/simple-cms/dealers/list/<?php echo $cms->totalDataPages-1; ?>">&gt;|</a></td>
		</tr>
    </table>
<?php }  else {?>
	No dealers.
<?php } ?>