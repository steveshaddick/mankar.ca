<?php

$parts = $cms->getPartsList();

?>
<h2>Parts</h2>
<a href="/simple-cms/parts/insert"><b>INSERT NEW PART</b></a><br /><br />
<?php
if (count($parts) > 0) 
	{ ?>
    
    <table>
    <tr>
    <td width="150px">Part ID</td><td width="150px">Code</td><td width="300px">Name</td><td width="50px"></td>
    </tr>
    
    
    <?php
    foreach ($parts as $part)
    {?>
        <tr>
        <td><a href="/simple-cms/parts/edit/<?php echo $part['part_id']; ?>"><?php echo $part['part_id']; ?></a></td>
        <td><a href="/simple-cms/parts/edit/<?php echo $part['part_id']; ?>"><?php echo $part['part_code']; ?></a></td>
        <td><a href="/simple-cms/parts/edit/<?php echo $part['part_id']; ?>"><?php echo $part['name']; ?></a></td>
        <td><a href="#" onClick="checkSure('Are you sure you want to delete <?php echo $part['name']; ?>?','/simple-cms/parts/delete/<?php echo $part['part_id']; ?>')">Delete</a></td>
        </tr>
    <?php } ?>
    
    </table>
    <br />
    <table border="1">
	    <tr>
		    <td width="50px"><a href="/simple-cms/parts/list/0">|&lt;</a></td>
		    <td width="50px"><a href="/simple-cms/parts/list/<?php if ($cms->currentDataPage > 0) { echo $cms->currentDataPage-1; } else {echo 0; }?>">&lt;</a></td>
		    <td width="150px">Page <?php echo $cms->currentDataPage+1; ?> of <?php echo $cms->totalDataPages; ?></td>
		    <td width="50px"><a href="/simple-cms/parts/list/<?php if ($cms->currentDataPage < ($cms->totalDataPages-1)) { echo $cms->currentDataPage+1; } else {echo $cms->totalDataPages-1; }?>">&gt;</a></td>
		    <td width="50px"><a href="/simple-cms/parts/list/<?php echo $cms->totalDataPages-1; ?>">&gt;|</a></td>
		</tr>
    </table>
<?php }  else {?>
	No parts. Who knows?
<?php } ?>