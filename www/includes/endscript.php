<!-- begin mankar-endscript -->
<?php

switch ($lang) {
	case LANGUAGE_ENGLISH:
		$trackingCode = 'UA-3959055-1';
		break;
	case LANGUAGE_FRENCH:
		$trackingCode = 'UA-3959055-3';
		break;
	
	case LANGUAGE_SPANISH:
	default:
		$trackingCode = 'UA-3959055-1';
		break;
}
?>
<script type="text/javascript">
	var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
	document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
	var pageTracker = _gat._getTracker("<?=$trackingCode?>");
	pageTracker._initData();
	pageTracker._trackPageview();
</script>
<!-- end mankar-endscript -->