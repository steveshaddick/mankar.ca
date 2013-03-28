package classes
{
	import flash.display.MovieClip;
	import flash.events.MouseEvent;
	import caurina.transitions.Tweener;
	
	/**
	* ...
	* @author Steve
	*/
	public class PlusMinus extends MovieClip 
	{
		
		public var movPlus:MovieClip;
		public var movMinus:MovieClip;
		
		private var isPlus:Boolean = false;
		
		
		public function PlusMinus():void 
		{
			this.addEventListener(MouseEvent.ROLL_OVER, rollOverHandler);
			this.addEventListener(MouseEvent.ROLL_OUT, rollOutHandler);
			this.buttonMode = true;
			this.alpha = 0.5
			
			movPlus.visible = false;
			
		}
		
		public function setPlus(_isPlus:Boolean = false) {
			if (_isPlus) {
				movPlus.visible = true;
				movMinus.visible = false;
			} else {
				movPlus.visible = false;
				movMinus.visible = true;
			}
		}
		
		private function rollOverHandler(_event:MouseEvent):void 
		{
			Tweener.removeTweens(this);
			Tweener.addTween(this, { alpha:1, time:0.25, transition:"easeOutSine" } );
		}
		
		private function rollOutHandler(_event:MouseEvent):void 
		{
			Tweener.removeTweens(this);
			Tweener.addTween(this, { alpha:0.5, time:0.25, transition:"easeOutSine" } );
		}
	}
	
}