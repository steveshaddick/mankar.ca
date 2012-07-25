<!-- begin mankar-footer -->
<div id="container2">
    <div class="extFaker">&nbsp;</div>
    <div class="divBottom">
        <p>Copyright &copy;<?php echo date('Y'); ?> Mankar Distributing Inc. &nbsp;&nbsp;All Rights Reserved.<br>
        phone: 647-309-7826&nbsp;&nbsp;&nbsp;fax: 888-510-2688&nbsp;&nbsp;&nbsp;<a href="mailto:&#105;&#110;&#102;&#111;&#064;&#109;&#097;&#110;&#107;&#097;&#114;&#046;&#099;&#097;">&#105;&#110;&#102;&#111;&#064;&#109;&#097;&#110;&#107;&#097;&#114;&#046;&#099;&#097;</a>
        </p>
    </div>
</div>

<?php
	
	switch ($mankarMain->lang) { 
		case LANGUAGE_ENGLISH :  
			$uaCode = 'UA-3959055-1';
			break;
		case LANGUAGE_FRENCH :  
			$uaCode = 'UA-3959055-3';
			break;
		case LANGUAGE_SPANISH :  
			$uaCode = 'UA-3959055-5';
			break;
	} 
?>
<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
try{ 
var pageTracker = _gat._getTracker("<?=$uaCode;?>");
pageTracker._initData();
pageTracker._trackPageview();
} catch(err) {} 
</script>
<!-- end mankar-footer -->