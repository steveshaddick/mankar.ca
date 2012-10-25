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
		define('NAV_BENEFITS', 'Avantages');
		define('NAV_TECHNOLOGY', 'Technologie');
		define('NAV_COSTSHARE', 'Partage des Coûts');
		define('NAV_APPLICATION', 'Domaines D\'application');	
		define('NAV_TIPS', 'Conseils');
		define('NAV_MANUALS', 'Manuels');
		define('NAV_PARTS', 'Pièces');
		break;
	case LANGUAGE_SPANISH :  
		define('NAV_BENEFITS', 'Beneficios');
		define('NAV_TECHNOLOGY', 'Tecnología');
		define('NAV_COSTSHARE', 'Government Cost-Share');
		define('NAV_APPLICATION', 'Campos de Aplicación');
		define('NAV_TIPS', 'Consejo');
		define('NAV_MANUALS', 'Manuales');
		define('NAV_PARTS', 'Piezas');
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
		define('NAV_HOME', 'Accueil');
		define('NAV_PRODUCTS', 'Produits');
		define('NAV_OTHER_PRODUCTS', 'Autres Produits');
		define('NAV_INFO', 'Information');
		define('NAV_COMPARISON', 'Comparaison');
		define('NAV_SUPPORT', 'Support');
		define('NAV_NEWS', 'News');
		define('NAV_LINKS', 'Other Links');
		define('NAV_DEALERS', 'Concessionnaires');
		define('NAV_TRADESHOWS', 'Foires');		
		break;
	case LANGUAGE_SPANISH :  
		define('NAV_HOME', 'Inicio');
		define('NAV_PRODUCTS', 'Productos');
		define('NAV_OTHER_PRODUCTS', 'Otros Productos');
		define('NAV_INFO', 'Información');
		define('NAV_COMPARISON', 'Comparación');
		define('NAV_SUPPORT', 'Servicio al Cliente');
		define('NAV_NEWS', 'Noticias');
		define('NAV_LINKS', 'Other Links');
		define('NAV_DEALERS', 'Distribuidores');
		define('NAV_TRADESHOWS', 'Exposiciones');
		break;
} 

?>