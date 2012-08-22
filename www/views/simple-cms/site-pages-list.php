<?php

$sitePages = $cms->getSitePagesList();

?>

<h2>Site Pages</h2>

<?php
if (count($sitePages) > 0) 
	{ ?>
    
    <table>
    <tr>
    <td width="300px">Page</td><td width="50px"></td>
    </tr>
    
    
    <?php
    foreach ($sitePages as $sitePage)
    {?>
        <tr>
        <td><a href="/simple-cms/site-pages/edit/<?php echo $sitePage['pretty_url']; ?>"><?php echo $sitePage['pretty_url']; ?></a></td>
        </tr>
    <?php } ?>
    
    </table>
    <br />
   <table border="1">
	    <tr>
		    <td width="50px"><a href="/simple-cms/site-pages/list/0">|&lt;</a></td>
		    <td width="50px"><a href="/simple-cms/site-pages/list/<?php if ($cms->currentDataPage > 0) { echo $cms->currentDataPage-1; } else {echo 0; }?>">&lt;</a></td>
		    <td width="150px">Page <?php echo $cms->currentDataPage+1; ?> of <?php echo $cms->totalDataPages; ?></td>
		    <td width="50px"><a href="/simple-cms/site-pages/list/<?php if ($cms->currentDataPage < ($cms->totalDataPages-1)) { echo $cms->currentDataPage+1; } else {echo $cms->totalDataPages-1; }?>">&gt;</a></td>
		    <td width="50px"><a href="/simple-cms/site-pages/list/<?php echo $cms->totalDataPages-1; ?>">&gt;|</a></td>
		</tr>
    </table>
<?php }  else {?>
	No site pages for some reason.
<?php } ?>