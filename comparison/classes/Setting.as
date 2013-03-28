package classes
{
	import flash.display.MovieClip;
	import flash.geom.ColorTransform;
	import flash.geom.Point;
	import flash.text.TextField;
	import com.utils.meString3;
	import fl.controls.Slider;
	import com.utils.meMath3;
	import flash.events.Event;
	import fl.events.SliderEvent;
	import flash.events.KeyboardEvent;
	import flash.ui.Keyboard;
	import flash.events.MouseEvent;
	import caurina.transitions.Tweener;
	import caurina.transitions.properties.ColorShortcuts;
	
	/**
	* ...
	* @author Steve
	*/
	public class Setting extends MovieClip
	{
		
		public var txtDescription:TextField;
		public var txtOption:TextField;
		public var sldSlider:Slider;
		public var txtMin:TextField;
		public var txtMax:TextField;
		public var movBG:MovieClip;
		public var movPlusMinus:PlusMinus;
		public var txtHelp:TextField;
		
		public var ref:String = "";
		public var value:Number = 0;
		public var isSmall:Boolean = false;
		public var helpLocation:Point = new Point( 0, 45);
		public var objSetting:Object;
		
		private var isMetric:Boolean = true;
		private var conversion:Number = 1;
		private var isHelp:Boolean = false;
		
		
		public function Setting(_isPlusMinus:Boolean = false):void 
		{
			sldSlider.addEventListener(Event.CHANGE, sliderHandler);
			sldSlider.addEventListener(SliderEvent.THUMB_DRAG, sliderHandler);
			txtOption.addEventListener(Event.CHANGE, textHandler);
			txtOption.addEventListener(KeyboardEvent.KEY_UP, keyHandler);
			txtOption.addEventListener(MouseEvent.MOUSE_UP, focusHandler);
			
			this.addEventListener(MouseEvent.ROLL_OVER, rollOverHandler);
			this.addEventListener(MouseEvent.ROLL_OUT, rollOutHandler);
			
			if (_isPlusMinus){
				movPlusMinus.addEventListener(MouseEvent.CLICK, plusMinusHandler);
			} else {
				movPlusMinus.visible = false;
			}
			
			txtOption.restrict = "0-9.";
			txtOption.selectable = true;
			
			this.alpha =0.75;
			
			this.alpha = 0;
			this.visible = false
			
			ColorShortcuts.init();
		}
		
		public function setValues(_setting:Object, _isOverride:Boolean = false):void 
		{
			var obj:Object;
			
			if (!_isOverride) {
				this.objSetting = new Object();
			}
			
			if (String(_setting.@ref) != "") {
				this.objSetting.ref = _setting.@ref;
				this.ref = _setting.@ref;
			}
			
			if (Number(_setting.conversion) != 0) {
				this.objSetting.conversion = Number(_setting.conversion);
				this.conversion = this.objSetting.conversion;
			}
			
			if (String(_setting.description) != "") {
				this.objSetting.description = _setting.description;
				txtDescription.text = this.objSetting.description
			}
			
			if (String(_setting.dollarsign) != "") {
				this.objSetting.dollarsign = _setting.dollarsign;
			}
			
			if (String(_setting.metric) != "") {
				this.objSetting.metric = _setting.metric;
			} else if (this.objSetting.metric == null) {
				this.objSetting.metric = "";
			}
			if (String(_setting.imperial) != "") {
				this.objSetting.imperial = _setting.imperial;
			}
			if (String(_setting.min) != "") {
				this.objSetting.min = Number(_setting.min);
			}
			if (String(_setting.max) != "") {
				this.objSetting.max = Number(_setting.max);
			}
			if (String(_setting.default) != "") {
				this.objSetting.default = Number(_setting.default);
			}
			if (String(_setting.inc) != "") {
				this.objSetting.inc = Number(_setting.inc);
			}
			if (String(_setting.round) != "") {
				this.objSetting.round = Number(_setting.round);
			} else if (this.objSetting.round == null) {
				this.objSetting.round = 1;
			}
			
			if (String(_setting.default != "")){
				this.value = Number(this.objSetting.default);
			}
			
			if (String(_setting.help) != "") {
				//trace(_setting.help);
				this.objSetting.help = _setting.help;
			}
			
			this.setUnits();
		}
		
		public function show() {
			
			this.visible = true;
			Tweener.removeTweens(this);
			Tweener.addTween(this, { alpha:1, time:0.25, delay:0.75, transition:"easeOutSine" } );
		}
		
		public function hide():void 
		{
			
			Tweener.removeTweens(this);
			Tweener.addTween(this, { alpha:0, time:0.25, transition:"easeOutSine", onComplete:function() { this.visible = false; } } );
		}
		
		public function setUnits(_isMetric:Boolean = true):void 
		{
			
			var needChange:Boolean = false;

			if (_isMetric) {
				if (!this.isMetric) {
					needChange = true;
				}
				this.isMetric = true;
			} else {
				
				this.isMetric = false;
			}
			
			if ((this.isMetric) || (this.conversion == 1)) {
				
				txtDescription.text = this.objSetting.description + " (" +this.objSetting.metric + ")";
				
				if (needChange) {
					//trace(this.ref +  " need change");
					this.value = meMath3.round(this.value / this.conversion, this.objSetting.round );
				}
				//trace("setting " +this.ref + ", "+this.objSetting.max);
				sldSlider.minimum = this.objSetting.min;
				sldSlider.maximum = this.objSetting.max;
				sldSlider.snapInterval = this.objSetting.inc;
			
			} else {

				txtDescription.text = this.objSetting.description + " (" +this.objSetting.imperial + ")";
				//trace(this.ref);
				//trace(this.value);
				this.value = meMath3.round(this.value * this.conversion,this.objSetting.round );
				//trace(this.value);
				//trace("");
				sldSlider.minimum = meMath3.round(this.objSetting.min* this.conversion,0);
				sldSlider.maximum = meMath3.round(this.objSetting.max * this.conversion, 0);
				//sldSlider.snapInterval = meMath3.round(this.objSetting.inc * this.conversion, this.objSetting.round );
				sldSlider.snapInterval = this.objSetting.inc;
			}
			
			if (this.value > sldSlider.maximum) {
				sldSlider.maximum = this.value;
			}
			if (this.value < sldSlider.minimum) {
				sldSlider.minimum = this.value;
			}
			
			sldSlider.value = this.value;
			txtOption.text = String(this.value);
			if (meString3.stripSpaces(this.objSetting.metric) == "$") {
				txtOption.text = this.value.toFixed(2);
			} else {
				txtOption.text = String(this.value);
			}
			

		}
		
		public function setSmall(_isSmall:Boolean):void 
		{
			this.isSmall = _isSmall;
			
			if (this.isSmall) {
				sldSlider.visible = false;
				txtOption.visible = false;
				movBG.height = 25;
				txtDescription.alpha = 0.5;
				movPlusMinus.setPlus(true);
				this.transform.colorTransform = new ColorTransform(1, 1, 1, 1, 0, 0, 0, 0);
				this.removeEventListener(MouseEvent.ROLL_OVER, rollOverHandler);
				this.removeEventListener(MouseEvent.ROLL_OUT, rollOutHandler);
				if (this.objSetting.help != null) {
					this.dispatchEvent(new Event("onHideHelp", true));
				}
				
			} else {
				sldSlider.visible = true;
				txtOption.visible = true;
				movBG.height = 50;
				txtDescription.alpha = 1;
				movPlusMinus.setPlus(false);
				this.addEventListener(MouseEvent.ROLL_OVER, rollOverHandler);
				this.addEventListener(MouseEvent.ROLL_OUT, rollOutHandler);
				
			}
			
		}

		private function sliderHandler(_event:Event):void 
		{
			this.value = sldSlider.value;
			txtOption.text = String(this.value);
			this.dispatchEvent(new Event("onSettingChange", true));
		}
		
		private function keyHandler(_event:KeyboardEvent):void 
		{
			if (_event.keyCode == Keyboard.ENTER) {
				this.textHandler(null);
			}
		}
		
		private function textHandler(_event:Event):void 
		{
			this.value = Number(txtOption.text);
			if (this.value > sldSlider.maximum) {
				this.value = sldSlider.maximum;
				txtOption.text = String(this.value);
			}
			if (this.value < sldSlider.minimum) {
				this.value = sldSlider.minimum;
				txtOption.text = String(this.value);
			}
			sldSlider.value = this.value;
			this.dispatchEvent(new Event("onSettingChange", true));
		}
		
		private function focusHandler(_event:MouseEvent):void 
		{

			txtOption.setSelection(0, txtOption.text.length);
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
		
		private function rollOverHandler(_event:MouseEvent):void 
		{
			Tweener.addTween(this, { _color_greenOffset:20, time:0.25, transition:"easeOutSine" } );
			if (this.objSetting.help != null) {
				this.dispatchEvent(new Event("onShowHelp", true));
			}
		}
		
		private function rollOutHandler(_event:MouseEvent):void 
		{
			Tweener.addTween(this, { _color_greenOffset:0, time:0.25, transition:"easeOutSine" } );
			if (this.objSetting.help != null) {
				this.dispatchEvent(new Event("onHideHelp", true));
			}
		}
	
	}
	
}