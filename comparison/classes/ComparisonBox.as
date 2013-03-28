package classes
{
	import flash.display.MovieClip;
	import flash.text.TextField;
	
	/**
	* ...
	* @author Steve
	*/
	public class ComparisonBox extends MovieClip 
	{
		public var txtHeading:TextField;
		
		public var allComparisons:Array;
		
		private var isMetric:Boolean = true;
		
		public function ComparisonBox():void 
		{
			
		}
		
		public function setHeading(_text:String):void 
		{
			txtHeading.htmlText = "<b>" + _text + "</b>";
			txtHeading.width = txtHeading.textWidth + 10;
		}
		
		public function addComparisons(_xml:XML):void 
		{
			
			this.allComparisons = new Array();

			for each (var comparison:Object in _xml.comparison) {
				
				this.allComparisons.push(new Comparison(comparison));
				
				this.addChild(this.allComparisons[this.allComparisons.length-1]);
			}
		}
		
		public function showComparisons(_variables:Array, _isMetric:Boolean = true ):void 
		{
			var yHeight:Number = 25;
			this.isMetric = _isMetric;
		
			for each (var comparison:Object in this.allComparisons) {
				if (_variables['mankar'][comparison.ref] != null) {
					
					comparison.showComparison(_variables, comparison.ref, this.isMetric);
					comparison.y = yHeight;
					yHeight += comparison.totalHeight+15;
				} else {
					comparison.hideComparison();
				}
			}
			
			
		}
	}
	
}