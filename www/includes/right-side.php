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
    
	$today = date( 'Y-m-d H:i:s' );
	$result = mysql_query("SELECT * FROM tradeshows WHERE showend >= '$today' ORDER BY showstart LIMIT 1");
	//lets make a loop and get all news from the database
	while($myrow = mysql_fetch_array($result))
		 {//begin of loop
		   //now print the results:
		   echo "<span class=\"sideColumnHeading\">";
		   echo NEXT_TRADESHOW;
		   echo ":</h4><div class=\"divRightBox\"> <a href=\"http://www.mankar.ca/tradeshows.php\" class=\"tradeShowTitle\">";
		   echo $myrow['showname'];
		   echo "</a><span class=\"tradeShowInfo\">";
			$starts = strtotime($myrow['showstart']);
			echo date("M jS", $starts);
		   echo " - ";
		   $ends = strtotime($myrow['showend']);
			echo date("M jS, Y", $ends);
		   echo "</span>";
		   echo "<br><span class=\"tradeShowInfo\">";
		   echo $myrow['city'];
		   echo ", ";
		   echo $myrow['province'];
		   echo ", ";
		   echo $myrow['country'];
		   echo "</span><br><a href=\"http://www.mankar.ca/tradeshows.php\" class=\"moreShowsLink\">";
		   switch ($mankarMain->lang) { 
				case LANGUAGE_ENGLISH : echo 'more shows...'; break;
				case LANGUAGE_FRENCH : echo 'more shows...'; break;
				case LANGUAGE_SPANISH : echo 'more shows...'; break;
			} 
		   echo "</a></div>";
		 }//end of loop
		 	?>
            
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