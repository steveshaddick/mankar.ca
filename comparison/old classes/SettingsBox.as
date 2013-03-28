package classes
{
	import flash.display.Sprite;
	import caurina.transitions.Tweener;
	import flash.events.Event;
	
	/**
	* ...
	* @author Steve
	*/
	public class SettingsBox extends Sprite 
	{
		
		public var totalHeight:Number = 0;
		
		private var movBG:SettingsBoxBG = new SettingsBoxBG;
		private var unitSettings:Array = new Array();
		private var globalSettings:Array = new Array();
		
		
		public function SettingsBox():void 
		{
			this.addEventListener("onPlusMinus", plusMinusHandler);
			
			this.unitSettings['mankar'] = new Array();
			this.unitSettings['other'] = new Array();
			
			this.addChild(movBG);
			
			movBG.height = 20;
			this.totalHeight = 20;
		}
		
		public function addSetting(_setting:Setting, _scope:String, _unit:String=null):void 
		{
			
			this.addChild(_setting);
			
			switch(_scope) {
				case "unit":
				this.unitSettings[_unit].push(_setting);
				
				break;
				
				case "global":
				this.globalSettings.push(_setting);
				break;
			}
		}
		
		public function updateDisplay(_isShow:Boolean):void 
		{
			var xMankar:Number = 10;
			var xOther:Number = 305;
			var xGlobal:Number = 200;
			var yCount:Number = 0;
			
			var setting:Setting;
			
			if (_isShow){
				for each (setting in this.unitSettings['mankar']) 
				{
					setting.y = yCount;
					yCount += setting.height + 10;
					setting.show();
				}
				
				yCount = 0;
				for each (setting in this.unitSettings['other']) 
				{
					setting.y = yCount;
					yCount += setting.height + 10;
					setting.show();
				}
				
				yCount += 5;
				for each (setting in this.globalSettings) 
				{
					setting.y = yCount;
					yCount += setting.height + 10;
					setting.show();
				}
				
				this.totalHeight = yCount;
				Tweener.removeTweens(movBG);
				Tweener.addTween(movBG, { height:this.totalHeight, time:0.25, delay:0.25, transition:"easeOutSine" } );
			} else {
				for each (setting in this.unitSettings['mankar']) 
				{
					setting.hide();
				}
				for each (setting in this.unitSettings['other']) 
				{
					setting.hide();
				}
				for each (setting in this.globalSettings) 
				{
					setting.hide();
				}
				this.totalHeight = 20;
				Tweener.removeTweens(movBG);
				Tweener.addTween(movBG, { height:this.totalHeight, time:0.25, transition:"easeOutSine" } );
			}
		}
		private function plusMinusHandler(_event:Event):void 
		{
			var setting:Setting = Setting(_event.target);
			
			this.unitSettings['other'][setting.ref].setSmall(setting.isSmall);
			
		}
	}
	
}