<h2><?php echo $view->title; ?></h2>
<a href="/simple-cms/<?php echo $view->section; ?>/insert"><b>INSERT</b></a><br /><br />
<?php
if (count($view->data) > 0) 
	{ ?>
    
    <table>
    <tr>
        <?php if ($view->showDelete) { ?><td width="200px">ID</td><?php } ?>
        <?php
        foreach ($view->items as $item) {
            ?>
            <td width="<?php echo $item[2]; ?>px"><?php echo $item[0]; ?></td>
            <?php
        }
        ?>
        <?php if ($view->showDelete) { ?><td width="50px"></td><?php } ?>
    </tr>
    
    
    <?php
    foreach ($view->data as $data)
    {?>
        <tr>
        <?php if ($view->showDelete) { ?><td><a href="/simple-cms/<?php echo $view->section; ?>/edit/<?php echo $data[$view->id]; ?>"><?php echo $data[$view->id];?></a></td><?php } ?>
        <?php
        foreach ($view->items as $item) {
            ?>
            <td><a href="/simple-cms/<?php echo $view->section; ?>/edit/<?php echo $data[$view->id]; ?>"><?php echo $data[$item[1]];?></a></td>
            <?php
        }
        ?>
        <?php if ($view->showDelete) { ?><td><a href="#" onClick="checkSure('Are you sure you want to delete <?php echo $data[$view->items[0][1]]; ?>?','/simple-cms/<?php echo $view->section; ?>/delete/<?php echo $data[$view->id];?>')">Delete</a></td><?php } ?>
        </tr>
    <?php } ?>
    
    </table>
    <br />
     <table border="1">
	    <tr>
		    <td width="50px"><a href="/simple-cms/<?php echo $view->section; ?>/list/0">|&lt;</a></td>
		    <td width="50px"><a href="/simple-cms/<?php echo $view->section; ?>/list/<?php if ($cms->currentDataPage > 0) { echo $cms->currentDataPage-1; } else {echo 0; }?>">&lt;</a></td>
		    <td width="150px">Page <?php echo $cms->currentDataPage+1; ?> of <?php echo $cms->totalDataPages; ?></td>
		    <td width="50px"><a href="/simple-cms/<?php echo $view->section; ?>/list/<?php if ($cms->currentDataPage < ($cms->totalDataPages-1)) { echo $cms->currentDataPage+1; } else {echo $cms->totalDataPages-1; }?>">&gt;</a></td>
		    <td width="50px"><a href="/simple-cms/<?php echo $view->section; ?>/list/<?php echo $cms->totalDataPages-1; ?>">&gt;|</a></td>
		</tr>
    </table>
<?php }  else {?>
	Nothing. Weird!
<?php } ?>