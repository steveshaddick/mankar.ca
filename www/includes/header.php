<?php


?>

<div id="header">
    <div id="logo-picture">
    	<a href="http://www.mankar.ca/"><img src="/images/mankar-logo.png" alt="Mankar Logo" border="0"></a>
    	<span class="logoText">Ultra-Low Volume<br />Applicators</span>
    </div>
      
      <div id="header-contact">
      	
          <h1>Mankar Distributing Inc.</h1>
            phone: 647-309-7826&nbsp;&nbsp;&nbsp;fax: 888-510-2688<br /><a href="mailto:&#105;&#110;&#102;&#111;&#064;&#109;&#097;&#110;&#107;&#097;&#114;&#046;&#099;&#097;">&#105;&#110;&#102;&#111;&#064;&#109;&#097;&#110;&#107;&#097;&#114;&#046;&#099;&#097;</a>
        </div>
	</div>
    <div style="clear:both; height:0px;"></div>
   <div id="top-navigation">
		<ul class="navlist">
          <li <?php if ($mankarMain->pageLocation[0] == 'home') echo "class='navHighlight'"; ?>><a href="/"><?=NAV_HOME;?></a></li>
          <li <?php if ($mankarMain->pageLocation[0] == 'products') echo "class='navHighlight'"; ?>><a href="/products"><?=NAV_PRODUCTS;?></a></li>
          <li <?php if ($mankarMain->pageLocation[0] == 'support') echo "class='navHighlight'"; ?>><a href="/support"><?=NAV_SUPPORT;?></a></li>
          <li <?php if ($mankarMain->pageLocation[0] == 'news') echo "class='navHighlight'"; ?>><a href="/news/"><?=NAV_NEWS;?></a></li>
          <li <?php if ($mankarMain->pageLocation[0] == 'tradeshows') echo "class='navHighlight'"; ?>><a href="/tradeshows"><?=NAV_TRADESHOWS;?></a></li>
          <li <?php if ($mankarMain->pageLocation[0] == 'dealers') echo "class='navHighlight'"; ?>><a href="/dealers"><?=NAV_DEALERS;?></a></li>
        </ul>
        <div id="languages">
			<a href="<?php echo "/locale/lang/".LANGUAGE_ENGLISH; ?>" <?php if ($mankarMain->lang == LANGUAGE_ENGLISH) { ?>class="languageSelected"<?php } ?>>EN</a> |
            <a href="<?php echo "/locale/lang/".LANGUAGE_FRENCH; ?>" <?php if ($mankarMain->lang == LANGUAGE_FRENCH) { ?>class="languageSelected"<?php } ?>>FR</a> | 
            <a href="<?php echo "/locale/lang/".LANGUAGE_SPANISH; ?>" <?php if ($mankarMain->lang == LANGUAGE_SPANISH) { ?>class="languageSelected"<?php } ?>>ES</a>
        </div>
   </div>
  <div id="top-navigation-bottom">&nbsp;</div>