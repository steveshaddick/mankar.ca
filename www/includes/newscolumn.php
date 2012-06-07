<!-- begin mankar-newscolumn-->
<div class="col3">
    <?php include('includes/'.$lang.'/tradeshowapplet.php'); ?>
    <h2 class="rightHeading"><img src="http://www.mankar.ca/pics/arrow-bullet.png">Recent Posts</h2>
    <div class="divRightBox">
      <ul>
        <?php wp_get_archives('type=postbypost&limit=3'); ?>
      </ul>
      <?php get_links_list(); ?>
    </div>
    <h2 class="rightHeading"><img src="http://www.mankar.ca/pics/arrow-bullet.png">Categories</h2>
    <div class="divRightBox">
      <ul>
        <?php wp_list_categories(); ?>
      </ul>
    </div>
    <h2 class="rightHeading"><img src="http://www.mankar.ca/pics/arrow-bullet.png">Posts by Date</h2>
    <div class="divRightBox">
      <ul>
        <?php wp_get_archives('type=monthly'); ?>
      </ul>
    </div>
  </div>
<!-- end mankar-newscolumn-->