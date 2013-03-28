package classes
{
	import flash.display.MovieClip;
	import flash.text.TextField;
	import flash.events.Event;
	import flash.events.MouseEvent;
	
	/**
	* ...
	* @author Steve
	*/
	public class InfoDisplay extends MovieClip
	{
		public var movPic:PicLoader3;
		public var txtText:TextField;
		public var movPlusMinus:PlusMinus;
		
		public var isSmall:Boolean = false;
		
		private var picLoc:String;
		private var infoText:String;
		
		public function InfoDisplay():void 
		{
			txtText.text = "";
			txtText.visible = false;
			
		}
		
		public function setInfoPlusMinus(_isPlusMinus:Boolean = false ):void 
		{
			if (_isPlusMinus){
				movPlusMinus.addEventListener(MouseEvent.CLICK, plusMinusHandler);
			} else {
				movPlusMinus.visible = false;
			}
		}
		
		public function setInfo(_pic:String, _text:String):void 
		{
			if (_pic != "") {
				picLoc = _pic;
			} else {
				picLoc = "";
				movPic.unLoadPic();
			}
			
			if (_text != "") {
				infoText = _text;
			} else {
				infoText = "";
				txtText.text = "";
				txtText.visible = false;
			}
			
			this.setSmall(false);
		}
		
		public function setSmall(_isSmall:Boolean):void 
		{
			this.isSmall = _isSmall;
			
			if (this.isSmall) {
				movPic.unLoadPic();
				movPic.height = 15;
				txtText.htmlText = "...";
				movPlusMinus.setPlus(true);
				txtText.height = 15;
				
			} else {
				movPic.height = 126;
				movPlusMinus.setPlus(false);
				if (picLoc != ""){
					movPic.loadPic(picLoc, 0, 100, 125, true, "topleft");
				}
				if (infoText!= "") {
					//trace(infoText);
					txtText.htmlText = infoText;
					txtText.height = txtText.textHeight + 10;
					txtText.visible = true;
				} else {
					
				}
				
			}
			
		}
		
		private function plusMinusHandler(_event:MouseEvent):void 
		{
			if (this.isSmall) {
				this.setSmall(false);
			} else {
				this.setSmall(true);
			}
			
			this.dispatchEvent(new Event("onPlusMinus", true));
		}
	}
	
}