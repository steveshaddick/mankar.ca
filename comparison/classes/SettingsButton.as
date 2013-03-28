package classes
{
	import flash.display.MovieClip;
	import flash.events.MouseEvent;
	import flash.text.TextField;
	import caurina.transitions.Tweener;
	
	/**
	* ...
	* @author Steve
	*/
	public class SettingsButton extends MovieClip 
	{
		public var txtText:TextField;
		public var movHit:MovieClip;
		public var txtHeading:TextField;
		public var movBG:MovieClip;
		
		public function SettingsButton():void 
		{
			movHit.addEventListener(MouseEvent.ROLL_OUT, rollOutHandler);
			movHit.addEventListener(MouseEvent.ROLL_OVER, rollOverHandler);
			
			movHit.buttonMode = true;
			
			txtText.alpha = 0.5;
			movBG.scaleY = 0;
		}
		
		public function setHeading(_text:String) {
			txtHeading.htmlText = "<b>"+_text+"</b>";
			txtHeading.width = txtHeading.textWidth + 5;
			txtText.x = txtHeading.x + txtHeading.width;
			movBG.width = txtHeading.width;
			movHit.width = txtText.x + txtText.width;
		}
		
		public function setText(_text:String):void 
		{
			txtText.htmlText = _text;
			txtText.width = txtText.textWidth + 5;
		}
		
		private function rollOutHandler(_event:MouseEvent):void 
		{
			Tweener.removeTweens(txtText);
			Tweener.removeTweens(movBG);
			Tweener.addTween(txtText, { alpha:0.5, time:0.25 } );
			Tweener.addTween(movBG, { scaleY:0, time:0.5, transition:"easeOutSine" } );
		}
		
		private function rollOverHandler(_event:MouseEvent):void 
		{
			Tweener.removeTweens(txtText);
			Tweener.removeTweens(movBG);
			Tweener.addTween(txtText, { alpha:1, time:0.25 } );
			Tweener.addTween(movBG, { scaleY:1, time:0.5, transition:"easeOutSine" } );
		}
	}
	
}