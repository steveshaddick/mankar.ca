<?php

switch ($mankarMain->lang) { 
	case LANGUAGE_ENGLISH :  
		define('NEXT_TRADESHOW', 'Our Next Tradeshow');
		define('RECENT_POSTS', 'Recent Posts');
		define('CATEGORIES', 'Categories');
		define('POSTS_BY_DATE', 'Posts by Date');
		define('MORE_POSTS', 'More...');
		define('LESS_POSTS', 'Less...');
		break;
	case LANGUAGE_FRENCH :  
		define('NEXT_TRADESHOW', 'Our Next Tradeshow');
		define('RECENT_POSTS', 'Recent Posts');
		define('CATEGORIES', 'Categories');
		define('POSTS_BY_DATE', 'Posts by Date');
		define('MORE_POSTS', 'More...');
		define('LESS_POSTS', 'Less...');
		break;
	case LANGUAGE_SPANISH :  
		define('NEXT_TRADESHOW', 'Our Next Tradeshow');
		define('RECENT_POSTS', 'Recent Posts');
		define('CATEGORIES', 'Categories');
		define('POSTS_BY_DATE', 'Posts by Date');
		define('MORE_POSTS', 'More...');
		define('LESS_POSTS', 'Less...');
		break;
} 
?>
	
	<?php
		$tradeshow = $mankarMain->nextTradeshow;
	?>
	<span class="sideColumnHeading"><?php echo NEXT_TRADESHOW; ?></span>
	<div class="rightBox">
		<?php
		if ($tradeshow['logo'] != '') {
        //TODO check for missing link
        	?>
        	<a href="<?php echo $tradeshow['showlink']?>" target="_blank"> <img class="imgTradeshow" src="<?php echo TRADESHOW_LOGO_LOCATION.$tradeshow['logo'];?>" /></a>
        	<?php
      	}
      	?>
      	<div class="tradeshowTitleWrapper">
      		<a class="tradeshowTitle" href="<?php echo $tradeshow['showlink'] ?>" target="_blank"><?php echo $tradeshow['showname']; ?></a><br />
      	</div>
      	<br class="clear" />
      	<div class="tradeshowDescription">
      		<?php echo date("M jS", strtotime($tradeshow['showstart'])); ?> - <?php echo date("M jS, Y", strtotime($tradeshow['showend'])); ?></i><br />
      		<?php echo $tradeshow['city'] . ", " . $tradeshow['province'] . ", " . $tradeshow['country']; ?><br class="clear" />
      	</div>
      	
      	<a class="moreShowsLink" href="/tradeshows" >
  		<?php
	   	switch ($mankarMain->lang) { 
			case LANGUAGE_ENGLISH : echo 'more shows &gt;'; break;
			case LANGUAGE_FRENCH : echo 'more shows &gt;'; break;
			case LANGUAGE_SPANISH : echo 'more shows &gt;'; break;
		} 
		?>
		</a>
  </div>
            
     <?php
		 //also found in header, sort of.  Maybe a better thing would be to resolve the include paths
		 if (!(strpos($_SERVER['SCRIPT_NAME'],"news") > 0)) {
			//require_once('news/wp-blog-header.php');
		 }
	 ?>
     
    <span class="sideColumnHeading"><?=RECENT_POSTS;?></span>
    <div class="divRightBox">
      <ul>
      <div id="topPosts">
       <?php //wp_get_archives('type=postbypost&limit=5'); ?>
      </div>
      
       <div id="CollapsiblePanelSide" class="CollapsiblePanel">
     
      	  <div id="CollapseContentSide" class="CollapsiblePanelContent">
		  	<?php //wp_get_archives('type=postbypost&limit=30'); ?>
          </div>
          	<?php //the text for the collapse tab is also set in SpryCollapsiblePanel.js ?>
           <div id="CollapseTabSide" class="CollapsiblePanelTab" tabindex="0"><a href="#" onclick="toggleTopPosts();" style="font-style:italic;"><?=MORE_POSTS;?></a></div>
        
        </div>
        
      </ul>
    </div>
<script type="text/javascript">

var topPosts = true;
function toggleTopPosts()
{

	if (topPosts) {
		topPosts = false;
		document.getElementById('topPosts').style.display = "none";
	} else {
		topPosts = true;
		document.getElementById('topPosts').style.display = "block";
	}
}
<!--
var CollapsiblePanelSide = new Spry.Widget.CollapsiblePanel("CollapsiblePanelSide", {contentIsOpen: false}, '<?=MORE_POSTS;?>','<?=LESS_POSTS;?>', "CollapseContentSide", "CollapseTabSide", 'onclick="toggleTopPosts();" style="font-style:italic;"');
//-->
</script>