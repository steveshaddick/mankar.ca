<?php
switch ($lang) { 
	case LANGUAGE_ENGLISH :  
		define('NAV_HOME', 'Home');
		define('NAV_PRODUCTS', 'Products');
		define('NAV_INFO', 'Information');
		define('NAV_COMPARISON', 'Comparison Tool');
		define('NAV_SUPPORT', 'User Support');
		define('NAV_NEWS', 'News');
		define('NAV_LINKS', 'Other Links');
		define('NAV_DEALERS', 'Dealers');
		define('NAV_TRADESHOWS', 'Tradeshows');
		break;
	case LANGUAGE_FRENCH :  
		define('NAV_HOME', 'Home');
		define('NAV_PRODUCTS', 'Produits');
		define('NAV_INFO', 'Information');
		define('NAV_COMPARISON', 'Comparison Tool');
		define('NAV_SUPPORT', 'User Support');
		define('NAV_NEWS', 'News');
		define('NAV_LINKS', 'Other Links');
		define('NAV_DEALERS', 'Dealers');
		define('NAV_TRADESHOWS', 'Tradeshows');		
		break;
	case LANGUAGE_SPANISH :  
		define('NAV_HOME', 'Home');
		define('NAV_PRODUCTS', 'Products');
		define('NAV_INFO', 'Information');
		define('NAV_COMPARISON', 'Comparison Tool');
		define('NAV_SUPPORT', 'User Support');
		define('NAV_NEWS', 'News');
		define('NAV_LINKS', 'Other Links');
		define('NAV_DEALERS', 'Dealers');
		define('NAV_TRADESHOWS', 'Tradeshows');
		break;
} 

?>

<div id="hdr">
    <div id="logo-picture"><a href="http://www.mankar.ca/"><img src="http://www.mankar.ca/images/mankar-logo.png" alt="Mankar Logo" border="0"></a></div>
      <div id="header-contact">
      	<div id="languages">
			<?php
				$query = "";
				foreach ($_GET as $key=>$value)
				{
					if ($key != "lang") {
						$query .= $key."=".$value."&";
					}
				} ?>
			<a href="<?php echo $baseUrl."?".$query."lang=".LANGUAGE_ENGLISH; ?>" <?php if ($lang == LANGUAGE_ENGLISH) { ?>class="languageSelected"<?php } ?>>English</a> |
            <a href="<?php echo $baseUrl."?".$query."lang=".LANGUAGE_FRENCH; ?>" <?php if ($lang == LANGUAGE_FRENCH) { ?>class="languageSelected"<?php } ?>>Fran&ccedil;ais</a> | 
            <a href="<?php echo $baseUrl."?".$query."lang=".LANGUAGE_SPANISH; ?>" <?php if ($lang == LANGUAGE_SPANISH) { ?>class="languageSelected"<?php } ?>>Espa&ntilde;ol</a>
        </div>
          <h1>Mankar Distributing Inc.</h1>
            phone: 647-309-7826&nbsp;&nbsp;&nbsp;fax: 888-510-2688&nbsp;&nbsp;&nbsp;<a href="mailto:&#105;&#110;&#102;&#111;&#064;&#109;&#097;&#110;&#107;&#097;&#114;&#046;&#099;&#097;">&#105;&#110;&#102;&#111;&#064;&#109;&#097;&#110;&#107;&#097;&#114;&#046;&#099;&#097;</a>
        </div>
	</div>
    <div style="clear:both; height:0px;"></div>
   <div id="top-navigation">
		<ul class="navlist">
          <li <?php if ((strpos($pageUrl,"index.php") !== false) && (strpos($_SERVER['SCRIPT_NAME'],"news") === false)) echo "class='navHighlight'"; ?>><a href="<?php echo getPrettyUrl('index.php'); ?>"><?=NAV_HOME;?></a></li>
          <li <?php if (strpos($pageUrl,"products.php") !== false) echo "class='navHighlight'"; ?>><a href="<?php echo getPrettyUrl('products.php'); ?>"><?=NAV_PRODUCTS;?></a></li>
          <li <?php if (strpos($pageUrl,"information.php") !== false) echo "class='navHighlight'"; ?>><a href="<?php echo getPrettyUrl('information.php'); ?>"><?=NAV_INFO;?></a>
          <li <?php if (strpos($pageUrl,"sprayer-comparison.php") !== false) echo "class='navHighlight'"; ?>><a href="<?php echo getPrettyUrl('sprayer-comparison.php'); ?>"><?=NAV_COMPARISON;?></a></li>
          <li <?php if (strpos($pageUrl,"support.php") !== false) echo "class='navHighlight'"; ?>><a href="<?php echo getPrettyUrl('support.php'); ?>"><?=NAV_SUPPORT;?></a></li>
          <li <?php if (strpos($_SERVER['SCRIPT_NAME'],"news")>0) echo "class='navHighlight'"; ?>><a href="http://www.mankar.ca/news/"><?=NAV_NEWS;?></a></li>
          <li <?php if (strpos($pageUrl,"links.php") !== false) echo "class='navHighlight'"; ?>><a href="<?php echo getPrettyUrl('links.php'); ?>"><?=NAV_LINKS;?></a></li>
          <li <?php if (strpos($pageUrl,"tradeshows.php") !== false) echo "class='navHighlight'"; ?>><a href="<?php echo getPrettyUrl('tradeshows.php'); ?>"><?=NAV_TRADESHOWS;?></a></li>
          <li <?php if (strpos($pageUrl,"dealers.php") !== false) echo "class='navHighlight'"; ?>><a href="<?php echo getPrettyUrl('dealers.php'); ?>"><?=NAV_DEALERS;?></a></li>
        </ul>
   </div>
  <div id="top-navigation-bottom">&nbsp;</div>