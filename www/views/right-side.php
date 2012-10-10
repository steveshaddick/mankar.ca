<?php

switch ($mankarMain->lang) { 
	case LANGUAGE_ENGLISH :  
		define('NEXT_TRADESHOW', 'Our Next Tradeshow');
		define('RECENT_POSTS', 'Recent News');
		define('CATEGORIES', 'Categories');
		define('POSTS_BY_DATE', 'Posts by Date');
		define('MORE_POSTS', 'More...');
		define('LESS_POSTS', 'Less...');
		break;
	case LANGUAGE_FRENCH :  
		define('NEXT_TRADESHOW', 'Our Next Tradeshow');
		define('RECENT_POSTS', 'Recent News');
		define('CATEGORIES', 'Categories');
		define('POSTS_BY_DATE', 'Posts by Date');
		define('MORE_POSTS', 'More...');
		define('LESS_POSTS', 'Less...');
		break;
	case LANGUAGE_SPANISH :  
		define('NEXT_TRADESHOW', 'Our Next Tradeshow');
		define('RECENT_POSTS', 'Recent News');
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
        	<a href="<?php echo $tradeshow['website']?>" target="_blank"> <img class="imgTradeshow" src="<?php echo TRADESHOW_LOGO_LOCATION.$tradeshow['logo'];?>" /></a>
        	<?php
      	}
      	?>
      	<div class="tradeshowTitleWrapper">
      		<a class="tradeshowTitle" href="<?php echo $tradeshow['website'] ?>" target="_blank"><?php echo $tradeshow['showname']; ?></a><br />
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
		$recentNews = $mankarMain->getRecentNews();
	?>
	<span class="sideColumnHeading"><?php echo RECENT_POSTS; ?></span>
     <div class="rightBox">

     	<?php
     	foreach ($recentNews as $news) {
     		?>

     		<div class="recentNews">
				<a class="recentNewsTitle" href="/news/<?php echo $news['pretty_url'] ?>"><?php echo $news['title']; ?></a><br />
				<span class="recentNewsDate"><?php echo date('F j, Y', strtotime($news['newsDate'])); ?></span>
     		</div>

     		<?php
     	}
     	?>

      	<a class="moreShowsLink" href="/news" >
  		<?php
	   	switch ($mankarMain->lang) { 
			case LANGUAGE_ENGLISH : echo 'more news &gt;'; break;
			case LANGUAGE_FRENCH : echo 'more news &gt;'; break;
			case LANGUAGE_SPANISH : echo 'more news &gt;'; break;
		} 
		?>
		</a>
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