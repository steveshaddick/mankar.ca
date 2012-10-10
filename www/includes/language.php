<?php


define('NO_ENGLISH', "<p class='noLanguage'>We're sorry, this section is not yet available in English.</p>");
define('NO_FRENCH', "<p class='noLanguage'>Nous sommes d&eacute;sol&eacute;s, cette section n'est pas encore disponible en fran&ccedil;ais.</p>");
define('NO_SPANISH', "<p class='noLanguage'>Lo sentimos mucho, esta p&aacute;gina no es disponible en espa&ntilde;ol.</p>");

switch ($mankarMain->lang) { 
	case LANGUAGE_ENGLISH :  
		define('NAV_BENEFITS', 'Benefits');
		define('NAV_TECHNOLOGY', 'Technology');
		define('NAV_COSTSHARE', 'Government Cost-Share');
		define('NAV_APPLICATION', 'Areas of Application');
		define('NAV_TIPS', 'Tips');
		define('NAV_MANUALS', 'Manuals');
		define('NAV_PARTS', 'Parts');
		break;
	case LANGUAGE_FRENCH :  
		define('NAV_BENEFITS', 'Benefits');
		define('NAV_TECHNOLOGY', 'Technology');
		define('NAV_COSTSHARE', 'Government Cost-Share');
		define('NAV_APPLICATION', 'Areas of Application');	
		define('NAV_TIPS', 'Tips');
		define('NAV_MANUALS', 'Manuals');
		define('NAV_PARTS', 'Parts');
		break;
	case LANGUAGE_SPANISH :  
		define('NAV_BENEFITS', 'Benefits');
		define('NAV_TECHNOLOGY', 'Technology');
		define('NAV_COSTSHARE', 'Government Cost-Share');
		define('NAV_APPLICATION', 'Areas of Application');
		define('NAV_TIPS', 'Tips');
		define('NAV_MANUALS', 'Manuals');
		define('NAV_PARTS', 'Parts');
		break;
} 


switch ($mankarMain->lang) { 
	case LANGUAGE_ENGLISH :  
		define('NAV_HOME', 'Home');
		define('NAV_PRODUCTS', 'Products');
		define('NAV_OTHER_PRODUCTS', 'Other Products');
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
		define('NAV_OTHER_PRODUCTS', 'Other Products');
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
		define('NAV_OTHER_PRODUCTS', 'Other Products');
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