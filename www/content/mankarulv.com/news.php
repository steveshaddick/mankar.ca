<?php

  switch ($mankarMain->lang) { 
		case LANGUAGE_ENGLISH :  
      define('NEWS_HEADER', 'News');
			break;
		case LANGUAGE_FRENCH :  
      define('NEWS_HEADER', 'News');
			break;
		case LANGUAGE_SPANISH :  
      define('NEWS_HEADER', 'News');
			break;
	} 
	

	switch ($mankarMain->lang) { 
		case LANGUAGE_FRENCH :  echo "<p class='noLanguage'>".NO_FRENCH."</p>"; break;
		case LANGUAGE_SPANISH :  echo "<p class='noLanguage'>".NO_SPANISH."</p>"; break;
	}

  

?>
<div class="padContent">
  <?php
  if ($mankarMain->newsList) {
    ?>

    <h1 class="news"><?php echo NEWS_HEADER; ?></h1>

    <div class="newsPagerTop">
      <?php
      if ($mankarMain->lastNewsPage > 1) {
        ?>
        <span class="newsPrev"><a href="/news/<?php echo $mankarMain->lastNewsPage - 1; ?>">&laquo; Newer entries</a></span>
        <?php
      }
      ?>

      <?php
      if ($mankarMain->lastNewsPage < $mankarMain->totalNewsPages) {
        ?>
        <span class="newsNext"><a href="/news/<?php echo $mankarMain->lastNewsPage + 1; ?>">Older entries &raquo;</a></span>
        <?php
      }
      ?>
      <br class="clear" />
    </div>

    <?php      
    foreach ($mankarMain->newsList as $news) {
      ?>
      
      <div class="newsItem">

        <a class="newsTitle" href="/news/<?php echo $news['pretty_url'] ?>"><?php echo $news['title']; ?></a><br />
        <?php echo date("M jS, Y", strtotime($news['newsDate'])); ?><br />
        
        <div class="newsExcerpt">
          <?php
          if ($news['excerpt'] != '') {
            
            echo $news['excerpt'];
            ?>
            <br />
            <a class="newsTitle" href="/news/<?php echo $news['pretty_url'] ?>">Read more...</a>
            <?php
          } else {
            echo $news['body'];
          }
          ?>
        </div>
      </div>
      <?php
    }
    ?>

    <div class="newsPager">
      <?php
      if ($mankarMain->lastNewsPage > 1) {
        ?>
        <span class="newsPrev"><a href="/news/<?php echo $mankarMain->lastNewsPage - 1; ?>">&laquo; Newer entries</a></span>
        <?php
      }
      ?>

      <?php
      if ($mankarMain->lastNewsPage < $mankarMain->totalNewsPages) {
        ?>
        <span class="newsNext"><a href="/news/<?php echo $mankarMain->lastNewsPage + 1; ?>">Older entries &raquo;</a></span>
        <?php
      }
      ?>
    </div>

    <?php
  } else {
    ?>

    <div class="backButton news">
        <a href="/news/<?php echo $mankarMain->lastNewsPage; ?>"><span class="backArrow"><img src="/images/back-arrow.png" alt="" /></span>News</a>
    </div>

    <div class="newsItem">

      <h1 class="news"><?php echo $mankarMain->newsItem['title']; ?></h1>
      <?php echo date("M jS, Y", strtotime($mankarMain->newsItem['newsDate'])); ?><br />
      
      <div class="newsBody">
        <?php

        echo $mankarMain->newsItem['body'];

        ?>
      </div>
    </div>


    <?php
  }
  ?>
  

</div>