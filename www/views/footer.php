<!-- begin mankar-footer -->
<div id="container2">
    <div class="divBottom">
    	<p><i>When using any chemicals please follow label instructions and applicable local guidelines.</i><br>
    	Mankar®, Mafex®, Rofa®, and Mantis ULV® are registered trademarks of Mantis ULV-Sprühgeräte GmbH in Germany.<br>	
        Copyright &copy;<?php echo date('Y'); ?> Mankar Distributing Inc. &nbsp;&nbsp;All Rights Reserved.<br>
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
<script>
var _gaq = _gaq || [];
  _gaq.push(['_setAccount', '<?php echo $uaCode; ?>']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

function trackOutboundLink(category, action) { 
	try { 
		_gaq.push(['_trackEvent', category , action]); 
	} catch(err){}
}
</script>

<!-- end mankar-footer -->