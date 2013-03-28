package classes
{
	import flash.display.MovieClip;
	import caurina.transitions.Tweener;
	
	/**
	* ...
	* @author Steve
	*/
	public class GlobalSettings extends MovieClip 
	{
		public var movBG:MovieClip;
		
		public var globalSettings:Array;
		public var internalSettings:Array;
		public var formulae:Array;
		public var totalHeight:Number = 0;
		public var movText:MovieClip;
		
		private var isMetric:Boolean;
		private var arrOrder:Array;
		
		public function GlobalSettings():void 
		{
			movBG.alpha = 0;
			movBG.height = 0;
			movText.alpha = 0;
		}
		
		public function addSettings(_xml:XML, _isMetric:Boolean = true):void 
		{
			
			var yHeight:Number = 0;
			
			this.isMetric = _isMetric;
			this.globalSettings = new Array();
			this.internalSettings = new Array();
			this.formulae = new Array();
			this.arrOrder = new Array();
			for each (var setting:Object in _xml.setting) {
				//trace(setting.@ref);
				
				if (setting.@scope == "global"){
					
					if (setting.@type != "combo"){
						this.globalSettings[setting.@ref] = new Setting();
						this.globalSettings[setting.@ref].setValues(setting);
					} else {
						this.globalSettings[setting.@ref] = new SettingCombo(setting);
					}
					
					this.addChild(this.globalSettings[setting.@ref]);
					this.globalSettings[setting.@ref].x = 20;
					this.globalSettings[setting.@ref].y = yHeight;
					yHeight += this.globalSettings[setting.@ref].height + 30;
					this.arrOrder.push(this.globalSettings[setting.@ref]);
				
				} else if (setting.@scope == "internal") {
					
					this.internalSettings[setting.@ref] = new InternalSetting();
					this.internalSettings[setting.@ref].setValues(setting);
				
				} else if (setting.@scope == "formula") {

					this.formulae.push(setting);

				}
				
			}
			
			this.totalHeight = yHeight;
		}
		
		public function showSettings():void 
		{
			
			var yHeight:Number = 35;

			for each (var setting:Object in this.arrOrder) {
				setting.y = yHeight;
				if (setting.isSmall){
					yHeight += setting.height;
				} else {
					yHeight += setting.height + 7;
				}
				
				setting.show();
			}
			

			this.totalHeight = yHeight;
			
			Tweener.removeTweens(movBG);
			Tweener.addTween(movBG, { alpha:0.75, height:totalHeight, time:0.25, delay:0.5, transition:"easeOutSine" } );
			Tweener.removeTweens(movText);
			Tweener.addTween(movText, { alpha:1,time:0.25, delay:0.5, transition:"easeOutSine" } );
		}
		
		public function hideSettings():void
		{
			
			for each (var setting:Object in this.globalSettings) {
				setting.hide();
			}
			
			Tweener.removeTweens(movBG);
			Tweener.addTween(movBG, { alpha:0, height:0, time:0.25, transition:"easeOutSine" } );
			Tweener.removeTweens(movText);
			Tweener.addTween(movText, { alpha:0, time:0.25, transition:"easeOutSine" } );
		}
		
		public function changeUnits(_isMetric:Boolean):void 
		{
			var obj:Object;
			
			this.isMetric = _isMetric;
			
			for each(obj in this.globalSettings) {
				obj.setUnits(_isMetric);
			}
			for each(obj in this.internalSettings) {
				obj.setUnits(_isMetric);
			}
		}
	}
	
}