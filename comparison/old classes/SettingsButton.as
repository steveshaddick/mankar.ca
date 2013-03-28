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
		public var movBG:MovieClip;
		
		public function SettingsButton():void 
		{
			this.addEventListener(MouseEvent.ROLL_OUT, rollOutHandler);
			this.addEventListener(MouseEvent.ROLL_OVER, rollOverHandler);
			
			this.buttonMode = true;
			this.mouseChildren = false;
			
			txtText.alpha = 0.5;
			movBG.scaleY = 0;
		}
		
		public function setText(_text:String):void 
		{
			txtText.text = _text;
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