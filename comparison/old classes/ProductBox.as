package classes
{
	import flash.display.MovieClip;
	import fl.controls.ComboBox;
	import flash.net.URLRequest;
	import flash.net.URLLoader;
	import flash.events.Event;
	import flash.text.TextField;
	import caurina.transitions.Tweener;
	
	/**
	* ...
	* @author Steve
	*/
	public class ProductBox extends MovieClip 
	{
		
		public var cmbProduct:ComboBox;
		public var movAllSettingsBG:MovieClip;
		
		public var objProduct:Object;
		public var settingsHeight:Number = 20;
		public var totalHeight:Number = 0;
		public var allSettings:Array;
		
		
		
		private var isSettings:Boolean = false;
		private var isCombo:Boolean = false;
		private var isMetric:Boolean;
		
		private var arrOrder:Array;
		
		
		
		
		public function ProductBox():void 
		{
			cmbProduct.enabled = false;
			cmbProduct.addEventListener(Event.CHANGE, comboHandler);
			
		}
		
		public function loadCombo(_file:String):void 
		{
			var ldr:URLLoader = new URLLoader();
			
			cmbProduct.removeAll();

			cmbProduct.addItem({label:"Loading..."});
			
			ldr.addEventListener(Event.COMPLETE, this.onComboLoaded);
			ldr.load(new URLRequest(_file));
		}
		
		public function addSettings(_xml:XML, _isMetric:Boolean=true) {
			
			var yHeight:Number = 80;
			
			this.allSettings = new Array();
			this.arrOrder = new Array();
			
			this.isMetric = _isMetric;
			
			for each (var setting:Object in _xml.setting) {
				if (setting.@scope == "unit"){
					this.allSettings[setting.@ref] = new Setting();
					this.allSettings[setting.@ref].setValues(setting);
					
					this.addChild(this.allSettings[setting.@ref]);
					
					this.allSettings[setting.@ref].alpha = 0;
					this.allSettings[setting.@ref].y = yHeight;
					yHeight += this.allSettings[setting.@ref].height + 7;
					
					this.arrOrder.push(this.allSettings[setting.@ref]);
					
				}
			}
			
			settingsHeight = (yHeight - movSettingsBG.y) + 10;
			totalHeight = movSettingsBG.y + settingsHeight;
			this.isSettings = true;
			
			if (this.isCombo) {
				this.applyOverrides();
			}
			
		}
		
		public function showSettings():void
		{
			var yHeight:Number = 80;
			
			for each (var setting:Object in this.arrOrder) {
				setting.y = yHeight;
				if (setting.isSmall){
					yHeight += setting.height;
				} else {
					yHeight += setting.height + 7;
				}
				
				setting.show();
			}
			
			settingsHeight = (yHeight - movSettingsBG.y) + 5;
			totalHeight = movSettingsBG.y + settingsHeight;
			
			Tweener.removeTweens(movSettingsBG);
			Tweener.addTween(movSettingsBG, { height:settingsHeight, time:0.25, delay:0.25, transition:"easeOutSine" } );
		}
		
		public function hideSettings():void
		{
			
			for each (var setting:Object in this.allSettings) {
				setting.hide();
			}
			
			Tweener.removeTweens(movSettingsBG);
			Tweener.addTween(movSettingsBG, { height:20, time:0.25, transition:"easeOutSine" } );
		}
		
		public function changeUnits(_isMetric:Boolean):void 
		{
			this.isMetric = _isMetric;
			
			for each(var setting:Object in this.allSettings) {
				setting.setUnits(_isMetric);
			}
		}
		
		private function onComboLoaded(_event:Event):void 
		{
			var xml:XML = new XML(_event.target.data);
			var tmp:Object;
			
			cmbProduct.removeAll();
			
			for each (var product:Object in xml.product) {
				tmp = new Object;
				tmp.label = product.label;
				tmp.data = product.data;
				tmp.settings = new Array();
				
				for each (var setting:Object in product.setting) {
					tmp.settings[setting.@ref] = new Object;
					tmp.settings[setting.@ref] = setting;
				}
				
				cmbProduct.addItem(tmp);
			}
			cmbProduct.enabled = true;
			cmbProduct.selectedIndex = 0;
			this.objProduct = cmbProduct.selectedItem;
			
			this.isCombo = true;

			
			if (this.isSettings) {
				this.applyOverrides();
			}
		}
		
		private function applyOverrides():void 
		{
			
			for each (var setting:Object in cmbProduct.selectedItem.settings) {
				if (this.allSettings[setting.@ref] != null){
					this.allSettings[setting.@ref].setValues(setting);
				}
			}
			
			this.dispatchEvent(new Event("onOverrides", true));
		}
		
		private function comboHandler(_event:Event):void 
		{
			this.objProduct = cmbProduct.selectedItem;
			this.dispatchEvent(new Event("onProductChange", true));
		}
	}
	
}