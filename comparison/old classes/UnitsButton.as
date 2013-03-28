package classes
{
	import fl.controls.RadioButton;
	import fl.controls.RadioButtonGroup;
	import flash.display.MovieClip;
	import flash.events.MouseEvent;
	import flash.text.TextField;
	import flash.text.TextFormat;
	import flash.events.Event;
	
	/**
	* ...
	* @author Steve
	*/
	public class UnitsButton extends MovieClip 
	{
		public var rdoMetric:RadioButton;
		public var rdoImperial:RadioButton;
		
		public var isMetric:Boolean = true;
		
		public function UnitsButton():void 
		{
			var tf:TextFormat = new TextFormat(); 
			//tf.color = 0x00FF00; 
			//tf.font = "Georgia"; 
			tf.size = 10; 
			rdoMetric.setStyle("textFormat", tf);
			rdoImperial.setStyle("textFormat", tf);
			
			rdoMetric.addEventListener(Event.CHANGE, changeHandler);
			
			rdoMetric.selected = true;
			
		}
		
		public function setMetric(_isMetric:Boolean = true):void 
		{
			if (_isMetric) {
				this.isMetric = true;
				rdoMetric.selected = true;
			} else {
				this.isMetric = false;
				rdoImperial.selected = true;
			}
		}
		
		private function changeHandler(_event:Event):void 
		{
			
			if (rdoMetric.selected) {
				this.isMetric = true;
			} else {
				this.isMetric = false;
			}
			
			this.dispatchEvent(new Event("onMetricChange", true));
		}
	}
	
}