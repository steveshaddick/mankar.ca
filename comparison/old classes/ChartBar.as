package classes
{
	import flash.display.MovieClip;
	import flash.events.MouseEvent;
	import flash.text.TextField;
	import caurina.transitions.Tweener;
	import caurina.transitions.properties.ColorShortcuts;
	
	/**
	* ...
	* @author Steve
	*/
	public class ChartBar extends MovieClip
	{
		public var txtText:TextField;
		public var movBar:MovieClip;
		
		public function ChartBar():void 
		{
			txtText.visible = false;
			this.addEventListener(MouseEvent.ROLL_OVER, rollOverHandler);
			this.addEventListener(MouseEvent.ROLL_OUT, rollOutHandler);
			
			movBar.scaleY = 0;
			
			ColorShortcuts.init();
		}
		
		public function setText(_text:String):void 
		{
			txtText.text = _text;
			txtText.width = txtText.textWidth +5;
		}
		
		public function setBar(_yScale:Number):void 
		{

			Tweener.removeTweens(movBar);
			Tweener.addTween(movBar, { scaleY : _yScale, time:0.5, transition:"easeOutSine" } );
		}
		
		private function rollOverHandler(_event:MouseEvent):void 
		{
			txtText.visible = true;
			txtText.x = mouseX;
			txtText.y = mouseY - txtText.height;
			this.addEventListener(MouseEvent.MOUSE_MOVE, mouseMoveHandler);
			
			Tweener.removeTweens(movBar);
			Tweener.addTween(movBar, { _brightness:0.33, time:0.15, transition:"easeOutSine" } );
		}
		
		private function rollOutHandler(_event:MouseEvent):void 
		{
			txtText.visible = false;
			this.removeEventListener(MouseEvent.MOUSE_MOVE, mouseMoveHandler);
			
			Tweener.removeTweens(movBar);
			Tweener.addTween(movBar, { _brightness:0, time:0.15, transition:"easeOutSine" } );
		}
		
		private function mouseMoveHandler(_event:MouseEvent):void 
		{
			txtText.x = mouseX;
			txtText.y = mouseY +- txtText.height;
		}
	}
	
}