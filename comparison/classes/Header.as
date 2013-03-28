package classes
{
	import flash.display.MovieClip;
	import flash.text.TextField;
	
	/**
	* ...
	* @author Steve
	*/
	public class Header extends MovieClip 
	{
		public var txtText:TextField;
		
		public var movLogo:Logo;
		
		public function Header():void 
		{
			txtText.visible = false;
			txtText.x = 0;
			
		}
		public function setHeading(_xml:XMLList):void 
		{
			var width:Number;
			
			if (String(_xml.logo.@width) != "") {
				width = Number(_xml.logo.@width);
				txtText.x = width +6;
			}
			
			if (String(_xml.logo) != "") {
				movLogo.loadPic(_xml.logo, 0, width, NaN, false, "topleft");
			}
			
			if (String(_xml.tagline) != "") {
				txtText.visible = true;
				//trace(_xml.tagline);
				txtText.htmlText = _xml.tagline;
				txtText.width = txtText.textWidth + 10;
				
			}
		}
		
		
	}
	
}