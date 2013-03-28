package classes
{
	import flash.display.MovieClip;
	import flash.text.TextField;
	import caurina.transitions.Tweener;
	import flash.events.MouseEvent;
	import flash.events.Event;
	
	/**
	* ...
	* @author Steve
	*/
	public class Comparison extends MovieClip 
	{
		public var txtDescription:TextField;
		public var txtReference1:TextField;
		public var txtReference2:TextField;
		public var txtExplanation:TextField;
		public var movMankarBar:ChartBar;
		public var movOtherBar:ChartBar;
		public var movPlusMinus:PlusMinus;
		public var movAxis:MovieClip;
		
		public var objComparison:Object;
		public var ref:String;
		public var isSmall:Boolean = false;
		public var totalHeight:Number = 0;
		
		private var conversion:Number;
		private var isMetric:Boolean;
		
		
		public function Comparison(_comparison:Object):void 
		{
			this.objComparison = _comparison;
			this.ref = objComparison.@ref;
			this.visible = false;
			
			movPlusMinus.addEventListener(MouseEvent.CLICK, plusMinusHandler);
			
		}
		
		public function showComparison(_variables:Array, _ref:String, _isMetric:Boolean):void 
		{
			var str:String;
			var i:int;
			var maybeVar:Boolean = false;
			var isVar:Boolean = false;
			var start:Number = 0;
			var end:Number = 0;
			var parsed:Array = new Array();
			var chr:String;
			
			

			if ((_isMetric) || (String(this.objComparison.imperial.title) == "")) {
				txtDescription.text = this.objComparison.metric.title;
			} else {
				txtDescription.text = this.objComparison.imperial.title;
			}
			
			txtReference1.text = _variables['product']['mankar'] + ": ";
			if (this.objComparison.dollarsign == "1")
			{
				txtReference1.appendText("$");
			}
			txtReference1.appendText(_variables['mankar'][_ref]);
			if ((_isMetric) || (String(this.objComparison.imperial.units) == "")) {
				txtReference1.appendText(" " + this.objComparison.metric.units);
			} else {
				txtReference1.appendText(" " + this.objComparison.imperial.units);
			}

			txtReference2.text = _variables['product']['other'] + ": ";
			if (this.objComparison.dollarsign == "1")
			{
				txtReference2.appendText("$");
			}
			txtReference2.appendText(_variables['other'][_ref]);
			if ((_isMetric) || (String(this.objComparison.imperial.units) == "")) {
				txtReference2.appendText(" " + this.objComparison.metric.units);
			} else {
				txtReference2.appendText(" " + this.objComparison.imperial.units);
			}
			
			movMankarBar.setText(txtReference1.text);
			movOtherBar.setText(txtReference2.text);
			
			
			
			if ((_isMetric) || (String(this.objComparison.imperial.explanation) == "")) {
				str = this.objComparison.metric.explanation;
			} else {
				str = this.objComparison.imperial.explanation;
			}
			

			if (_variables['mankar'][_ref] >= _variables['other'][_ref]) {
				movMankarBar.setBar(1);
				movOtherBar.setBar(_variables['other'][_ref] / _variables['mankar'][_ref]);
			} else {
				movOtherBar.setBar(1);
				movMankarBar.setBar(_variables['mankar'][_ref] / _variables['other'][_ref]);
			}
			
			/*for (var p:String in _variables['mankar']) {
				trace(p);
			}*/
			
			
			/* another awesome parsing function*/
			i = 0;
			while (i < str.length) {
				chr = str.charAt(i);

				if (chr == "&") {
					if (maybeVar) {
						isVar = true;
						parsed.push(str.substring(start, end));
					} else {
						maybeVar = true;
					}
				} else {
					maybeVar = false;
				}
				
				if (isVar) {
					i++;
					
					parsed.push(_variables[str.substring(i, str.indexOf("#", i))][str.substring(str.indexOf("#", i) + 1, str.indexOf("&&", i))]);
					i = str.indexOf("&&", i) + 2;
					start = i;
					end = i;
					isVar = false;
					maybeVar = false;
				} else {
					end = i;
				}
				
				if (i == (str.length - 1)) {
					parsed.push(str.substring(start, end + 1));
				}
				i++;
			}
			
		

			txtExplanation.text = parsed.join("");
			
			txtExplanation.height = txtExplanation.textHeight + 10;
			
			this.visible = true;
			
			if (this.isSmall) {
				movAxis.visible = false;
				movMankarBar.visible = false;
				movOtherBar.visible = false;
				txtExplanation.visible = false;
				txtReference1.visible = false;
				txtReference2.visible = false;
				this.totalHeight = txtDescription.y + txtDescription.height + 5;
				movPlusMinus.setPlus(true);
				txtDescription.alpha = 0.5;
				
			} else {
				movAxis.visible = true;
				movMankarBar.visible = true;
				movOtherBar.visible = true;
				txtExplanation.visible = true;
				txtReference1.visible = true;
				txtReference2.visible = true;
				this.totalHeight = this.height;
				movPlusMinus.setPlus(false);
				txtDescription.alpha = 1;
			}
		}
		
		public function hideComparison():void 
		{
			this.visible = false;
		}
		
		private function plusMinusHandler(_event:MouseEvent):void 
		{
			if (this.isSmall) {
				this.isSmall = false;
			} else {
				this.isSmall = true;
			}
			
			this.dispatchEvent(new Event("onPlusMinus", true));
		}
	}
	
}