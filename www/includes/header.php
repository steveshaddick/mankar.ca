<?php


?>

<div id="header">
    <div id="logo-picture">
    	<a class="logoLink" href="http://<?php echo $mankarMain->envPrefix . $mankarMain->superTypeUrl; ?>"><img src="/images/<?php echo $mankarMain->superTypeLogo; ?>" alt="<?php echo $mankarMain->superTypeName; ?> Logo" border="0"></a>
    	<span class="logoText">Ultra-Low Volume<br /><?php echo $mankarMain->superTypeSlug; ?></span>
    </div>
      
      <div id="header-contact">
      	
          <span class="companyName">Mankar Distributing Inc.</span>
            phone: 647-309-7826&nbsp;&nbsp;&nbsp;fax: 888-510-2688<br /><a href="mailto:&#105;&#110;&#102;&#111;&#064;&#109;&#097;&#110;&#107;&#097;&#114;&#046;&#099;&#097;">&#105;&#110;&#102;&#111;&#064;&#109;&#097;&#110;&#107;&#097;&#114;&#046;&#099;&#097;</a>
        </div>
	</div>
    <div style="clear:both; height:0px;"></div>
   <div id="top-navigation">
		<ul class="navlist">
          <li class="navListItem <?php if ($mankarMain->pageLocation[0] == 'home') echo 'navHighlight'; ?>"><a class="navLink" href="/"><?=NAV_HOME;?></a></li>
          <li class="navListItem <?php if ($mankarMain->pageLocation[0] == 'products') echo 'navHighlight'; ?>"><a class="navLink" href="/products"><?=NAV_PRODUCTS;?></a></li>
          <li class="navListItem <?php if ($mankarMain->pageLocation[0] == 'information') echo 'navHighlight'; ?>"><a class="navLink" href="/information"><?=NAV_INFO;?></a></li>
          <li class="navListItem <?php if ($mankarMain->pageLocation[0] == 'support') echo 'navHighlight'; ?>"><a class="navLink" href="/support"><?=NAV_SUPPORT;?></a></li>
          <li class="navListItem <?php if ($mankarMain->pageLocation[0] == 'news') echo 'navHighlight'; ?>"><a class="navLink" href="/news/"><?=NAV_NEWS;?></a></li>
          <li class="navListItem <?php if ($mankarMain->pageLocation[0] == 'tradeshows') echo 'navHighlight'; ?>"><a class="navLink" href="/tradeshows"><?=NAV_TRADESHOWS;?></a></li>
          <li class="navListItem <?php if ($mankarMain->pageLocation[0] == 'dealers') echo 'navHighlight'; ?>"><a class="navLink" href="/dealers"><?=NAV_DEALERS;?></a></li>
        </ul>
        <div id="languages">
			      <a class="localeLink <?php if ($mankarMain->lang == LANGUAGE_ENGLISH) { ?> selected <?php } ?>" href="<?php echo "/locale/lang/".LANGUAGE_ENGLISH; ?>">EN</a> |
            <a class="localeLink <?php if ($mankarMain->lang == LANGUAGE_FRENCH) { ?> selected <?php } ?>" href="<?php echo "/locale/lang/".LANGUAGE_FRENCH; ?>">FR</a> | 
            <a class="localeLink <?php if ($mankarMain->lang == LANGUAGE_SPANISH) { ?> selected <?php } ?>" href="<?php echo "/locale/lang/".LANGUAGE_SPANISH; ?>">ES</a>
        </div>
   </div>
  <div id="top-navigation-bottom">&nbsp;</div>