<?php

$tradeshows = $cms->getTradeshowsList();

?>
<h2>Tradeshows</h2>
<a href="/simple-cms/tradeshows/insert"><b>INSERT NEW TRADESHOW</b></a><br /><br />
<?php
if (count($tradeshows) > 0) 
	{ ?>
    
    <table>
    <tr>
    <td width="200px">ID</td><td width="500px">Show</td><td width="50px"></td>
    </tr>
    
    
    <?php
    foreach ($tradeshows as $tradeshow)
    {?>
        <tr>
        <td><a href="/simple-cms/tradeshows/edit/<?php echo $tradeshow['showid'];?>"><?php echo $tradeshow['showid'];?></a></td>
        <td><a href="/simple-cms/tradeshows/edit/<?php echo $tradeshow['showid'];?>"><?php echo $tradeshow['showname'];?></a></td>
        <td><a href="#" onClick="checkSure('Are you sure you want to delete <?php echo $tradeshow['showname'];?>?','/simple-cms/tradeshows/delete/<?php echo $tradeshow['showid'];?>')">Delete</a></td>
        </tr>
    <?php } ?>
    
    </table>
    <br />
     <table border="1">
	    <tr>
		    <td width="50px"><a href="/simple-cms/tradeshows/list/0">|&lt;</a></td>
		    <td width="50px"><a href="/simple-cms/tradeshows/list/<?php if ($cms->currentDataPage > 0) { echo $cms->currentDataPage-1; } else {echo 0; }?>">&lt;</a></td>
		    <td width="150px">Page <?php echo $cms->currentDataPage+1; ?> of <?php echo $cms->totalDataPages; ?></td>
		    <td width="50px"><a href="/simple-cms/tradeshows/list/<?php if ($cms->currentDataPage < ($cms->totalDataPages-1)) { echo $cms->currentDataPage+1; } else {echo $cms->totalDataPages-1; }?>">&gt;</a></td>
		    <td width="50px"><a href="/simple-cms/tradeshows/list/<?php echo $cms->totalDataPages-1; ?>">&gt;|</a></td>
		</tr>
    </table>
<?php }  else {?>
	No tradeshows. Weird!
<?php } ?>