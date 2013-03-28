package classes
{
	import fl.controls.ComboBox;
	import flash.display.MovieClip;
	import flash.events.Event;
	import flash.net.URLRequest;
	import flash.net.URLLoader;
	import caurina.transitions.Tweener;
	import flash.events.MouseEvent;
	import flash.display.StageAlign;
	import flash.display.Stage;
	import steve.utils.meString3;
	import steve.utils.meMath3;
	import flash.display.StageScaleMode;
	import flash.net.navigateToURL;
	
	/**
	* ...
	* @author Steve
	*/
	public class MankarComparison extends MovieClip 
	{
		public var movHeader:MovieClip;
		public var movHeaderBG:MovieClip;
		public var movSettingsBG:MovieClip;
		public var movBottomLine:MovieClip;
		public var movSettingsButton:SettingsButton;
		public var movMoreSettingsButton:SettingsButton;
		public var movUnitsButton:UnitsButton;
		public var movComparisonBox:ComparisonBox;
		public var picMankar:PicLoader3;
		public var picOther:PicLoader3;
		
		public var cmbMankar:ComboBox;
		public var cmbOther:ComboBox;
		public var movMoreSettingsBG:MovieClip;
		
		private var mankarSettings:Array = new Array();
		private var otherSettings:Array = new Array();
		private var globalSettings:Array = new Array();
		private var allFormulae:Array = new Array();
		private var topSettings:Array = new Array();
		private var moreSettings:Array = new Array();
		private var allComparisons:Array = new Array();
		
		private var boxSettings:SettingsBox = new SettingsBox();
		private var boxMoreSettings:SettingsBox = new SettingsBox();
		
		private var isSettings:Boolean = true;
		private var isMoreSettings:Boolean = false;
		private var isMetric:Boolean = true;
		private var moreSettingsHeight:Number = 0;
		
		private var mankarDone:Boolean = false;
		private var otherDone:Boolean = false;
		private var settingsDone:Boolean = false;
		
		private var allVariables:Array;
		
		public function MankarComparison():void 
		{
			this.addEventListener(Event.ADDED_TO_STAGE, stageHandler);
			this.addEventListener("onSettingChange", settingChangeHandler);
			this.addEventListener("onSettingsAdded", sizeMoreSettings);
			this.addEventListener("onMetricChange", metricChangeHandler);
			movMankar.addEventListener("onPlusMinus", plusMinusHandler);
			
			cmbMankar.addEventListener(Event.CHANGE, productChangeHandler);
			cmbOther.addEventListener(Event.CHANGE, productChangeHandler);
			
			movOther.addEventListener("onPlusMinus", plusMinusHandler);
			movMoreSettings.addEventListener("onPlusMinus", plusMinusHandler);
			movComparisonBox.addEventListener("onPlusMinus", plusMinusHandler);
			
			movSettingsButton.addEventListener(MouseEvent.CLICK, settingsClickHandler);
			movMoreSettingsButton.addEventListener(MouseEvent.CLICK, moreSettingsClickHandler);
			
			cmbMankar.addItem({label:"Loading..."});
			cmbMankar.enabled = false;
			cmbOther.addItem( { label:"Loading..." } );
			cmbOther.enabled = false;
			
			this.addChild(boxSettings);
			this.addChild(boxMoreSettings);
			
			boxSettings.y = movSettingsButton.y + 25;
			movBottomLine.y = boxSettings.totalHeight + 2;
			movSettingsBG.height = movBottomLine.y - movSettingsBG.y;
			
			movMoreSettingsButton.y = boxSettings.totalHeight + 10;
			boxMoreSettings.y = movMoreSettingsButton.y + 25;
			
			movMoreSettingsButton.alpha = 0;
			movMoreSettingsButton.visible = false;
			
		}
		
		private function stageHandler(_event:Event):void 
		{
			var ldrSettings:URLLoader = new URLLoader();
			var ldrMankar:URLLoader = new URLLoader();
			var ldrOther:URLLoader = new URLLoader();
			
			stage.align = StageAlign.TOP;
			stage.scaleMode=StageScaleMode.NO_SCALE;

			ldrSettings.addEventListener(Event.COMPLETE, this.onSettingsLoaded);
			ldrSettings.load(new URLRequest("comparison-settings.xml"));
			
			ldrMankar.addEventListener(Event.COMPLETE, this.onProductsLoaded);
			ldrMankar.load(new URLRequest("mankar-products.xml"));
			
			ldrOther.addEventListener(Event.COMPLETE, this.onProductsLoaded);
			ldrOther.load(new URLRequest("other-products.xml"));
			
		}
		
		private function onSettingsLoaded(_event:Event):void 
		{
			var xml:XML = new XML(_event.target.data);
			
			

			for each (var setting:Object in _xml.setting) {
				if ((String(setting.@scope) != "") && (String(setting.@ref) != ""))  {				
					
					switch (setting.@scope) {
						case "unit":
						this.mankarSettings[setting.@ref] = new Setting(setting);
						this.otherSettings[setting.@ref] = new Setting(setting);
						
						if (setting.@location == "top") {
							boxSettings.addSetting(this.mankarSettings[setting.@ref], "unit", "mankar");
							boxSettings.addSetting(this.otherSettings[setting.@ref], "unit", "other");
						} else {
							boxMoreSettings.addSetting(this.mankarSettings[setting.@ref], "unit", "mankar");
							boxMoreSettings.addSetting(this.otherSettings[setting.@ref], "unit", "other");
						}
						break;
						
						case "global":
						this.globalSettings[setting.@ref] = new Setting(setting);
						
						if (setting.@location == "top") {
							boxSettings.addSetting(this.globalSettings[setting.@ref], "global");
						} else {
							boxMoreSettings.addSetting(this.globalSettings[setting.@ref], "global");
						}
						break;
						
						case "internal":
						this.mankarSettings[setting.@ref] = new InternalSetting(setting);
						this.otherSettings[setting.@ref] = new InternalSetting(setting);
						break;
						
						case "formula":
						this.allFormulae.push(setting);
						break;
					}
					
				}
			}
			
			for each (var comparison:Object in _xml.comparison) {
				this.allComparisons.push(new Comparison(comparison));
			}
			
			this.settingsDone = true;

			this.applyOverrides();
		}
		
		private function onProductsLoaded(_event:Event):void 
		{
			var xml:XML = new XML(_event.target.data);
			var cmb:ComboBox;
			var pic:PicLoader3;
			var i:Number = 0;
			var defaultIndex:Number = 0;
			var done:Boolean;
			
			switch(xml.identifier[0]) {
				case "mankar":
				cmb = cmbMankar;
				pic = picMankar;
				done = mankarDone;
				break;
				
				case "other":
				cmb = cmbOther;
				pic = picOther;
				done = otherDone;
				break;
			}
			
			cmb.removeAll();
			for each (var product:Object in xml.product) {
				tmp = new Object;
				tmp.label = product.label;
				tmp.data = product.data;
				tmp.settings = new Array();
				if (product.@default == "yes") {
					defaultIndex = i;
				}
				for each (var setting:Object in product.setting) {
					tmp.settings[setting.@ref] = new Object;
					tmp.settings[setting.@ref] = setting;
				}
				
				cmb.addItem(tmp);
				i ++;
			}
			cmb.enabled = true;
			cmb.selectedIndex = defaultIndex;
			
			if (cmb.selectedItem.picture[0] != null){
				pic.loadPic(cmb.selectedItem.picture[0]);
			}
			
			done = true;
			
			this.applyOverrides();
		}
		
		private function applyOverrides():void 
		{
			var setting:Object;
			
			if ((mankarDone) && (otherDone) && (settingsDone)) {
				for each (setting in cmbMankar.selectedItem.settings) {
					if (this.mankarSettings[setting.@ref] != null) {
						this.mankarSettings[setting.@ref].setValues(setting);
					} else if (this.globalSettings[setting.@ref] != null){
						this.globalSettings[setting.@ref].setValues(setting);
					}
				}
				for each (setting in cmbOther.selectedItem.settings) {
					if (this.otherSettings[setting.@ref] != null) {
						this.otherSettings[setting.@ref].setValues(setting);
					}
				}
				
				this.collectSettings();
				this.updateDisplay();
				
			}
		}
		
		/*private function initDisplay():void 
		{
			var xMankar:Number = 10;
			var xOther:Number = 305;
			var xGlobal:Number = 200;
			
			var ref:String;
			var setting:Setting;
			
			var newTop:Array = new Array();
			var newBottom:Array = new Array();
			
			for each (ref in this.topSettings) {
				if (this.mankarSettings[ref] != null){
					setting = Setting(this.mankarSettings[ref]);
					setting.x = xMankar;
					this.addChild(setting);
					
					setting = Setting(this.otherSettings[ref]);
					setting.x = xOther;
					this.addChild(setting);
					
					yCount += setting.height + 10;
				}
			}
			for each (ref in this.topSettings) {
				if (this.globalSettings[ref] != null){
					setting = Setting(this.mankarSettings[ref]);
					setting.x = xGlobal;
					this.addChild(setting);
				}
			}
			for each (ref in this.moreSettings) {
				if (this.mankarSettings[ref] != null){
					setting = Setting(this.mankarSettings[ref]);
					setting.x = xMankar;
					this.addChild(setting);
					
					setting = Setting(this.otherSettings[ref]);
					setting.x = xOther;
					this.addChild(setting);
					
					yCount += setting.height + 10;
				}
			}
			for each (ref in this.moreSettings) {
				if (this.globalSettings[ref] != null){
					setting = Setting(this.globalSettings[ref]);
					setting.x = xGlobal;
					this.addChild(setting);
				}
			}
		
			
		}
		
		private function initialShow():void {
			if ((mankarDone) && (otherDone) && (settingsDone)) {
				this.removeEventListener("onOverrides", overridesHandler);
				
				for each (var setting:Object in movMankar.objProduct.settings) {
					if (this.globalSettings[setting.@ref] != null){
						this.globalSettings[setting.@ref].setValues(setting);
					}
				}
				this.collectSettings();
			
				this.showSettings();
	
			}
		}*/
		
		private function collectSettings():void 
		{
			var obj:Object;
			var round:Number;

			this.allVariables = new Array();
			
			this.allVariables['mankar'] = new Array();
			this.allVariables['other'] = new Array();
			this.allVariables['product'] = new Array();

			this.allVariables['product']['mankar'] = cmbMankar.selectedItem.label;
			this.allVariables['product']['other'] = cmbOther.selectedItem.label;
			
			for each (obj in this.mankarSettings) {
				this.allVariables['mankar'][obj.ref] = obj.value;
			}
			for each (obj in this.otherSettings) {
				this.allVariables['other'][obj.ref] = obj.value;
			}
			for each (obj in this.globalSettings) {
				this.allVariables['mankar'][obj.ref] = obj.value;
				this.allVariables['other'][obj.ref] = obj.value;
			}

			for each (obj in this.allFormulae) {
				
				if (String(obj.round) != "") {
					round = Number(obj.round);
				} else {
					round = 1;
				}

				//trace(obj.@ref);
				
				this.allVariables['mankar'][obj.@ref] = meMath3.round(parseCalculation(meString3.stripSpaces(obj.formula), "mankar"),round);
				this.allVariables['other'][obj.@ref] = meMath3.round(parseCalculation(meString3.stripSpaces(obj.formula), "other"),round);
				
				//trace(this.allVariables['mankar'][obj.@ref]);
				//trace(this.allVariables['other'][obj.@ref]);
				//trace("-----------");
			}
			
			movComparisonBox.showComparisons(this.allVariables, this.isMetric);
		}
		
		/* this here is the shit */
		private function parseCalculation(_str:String, _side:String):Number 
		{
			var str:String = _str;
			var chr:String;
			var chrcode:Number;
			var start:Number = 0;
			var end:Number = 0;
			var isNumber:Boolean = false;
			var isName:Boolean = false;
			var calc:Array = new Array();
			var i:int;
			var total:Number;
			var brackets:Number = 0;
				

			for (i=0; i < str.length; i++) {
				
				chr = str.charAt(i);
				chrcode = str.charCodeAt(i);

				if (chr == "(") {
					calc.push(parseCalculation(_str.substr(i + 1), _side));
					brackets ++;
					isName = false;
					isNumber = false;
				} else if (chr == ")") {
					if (brackets == 0){
						i = str.length - 1;
						//trace("jump out");
					} else {
						brackets --;
						start = i + 2;
						end = i;
					}
				}
				
				if (brackets == 0){
				
					if (!isNaN(Number(chr))){
						if (!isName){
							isNumber = true;
						}
						end = i;
					}

					if (((chrcode >= 65) && (chrcode <= 90)) || ((chrcode >= 97) && (chrcode <= 122))) {

						isNumber = false;
						isName = true;
						end = i;
					}
					
					if (((chr == "*") || (chr == "/") || (chr == "-") || (chr == "+")) && (i > 0)) {
						if (isName) {

							calc.push(this.allVariables[_side][str.substring(start, end+1)]);
							start = i+1;
							end = i;
							isName = false;
						} else if (isNumber) {
							calc.push(Number(str.substring(start, end+1)));
							start = i+1;
							end = i;
							isNumber = false;
						}
						calc.push(chr);
					}

					if ((isName) && ( i == str.length - 1)) {
						calc.push(this.allVariables[_side][str.substring(start, end+1)]);
					}
					if ((isNumber) && ( i == str.length - 1)) {
						calc.push(Number(str.substring(start, end+1)));
					}
				}
			}
			//trace(calc);
			
			i = 1;
			total = calc[0];
			while (i < calc.length) {
				
				switch(calc[i]) {
					case "*":
					total *= calc[i +1];
					i += 2;
					break;
					
					case "/":
					total /= calc[i +1];
					i += 2;
					break;
					
					case "-":
					total -= calc[i +1];
					i += 2;
					break;
					
					case "+":
					total += calc[i +1];
					i += 2;
					break;
					
					default:
					i++;
					break;
				}
			}

			return total;
		}
		
		private function updateDisplay():void 
		{
			var yCount:Number = 180;
			var yMoreSettings:Number = 0;
			
			if (this.isSettings) {
				movSettingsButton.setText("hide");
				
				boxSettings.updateDisplay(true);
				yCount = boxSettings.totalHeight + boxSettings.y;
				
				movMoreSettingsButton.visible = true;
				Tweener.removeTweens(movMoreSettingsButton);
				Tweener.addTween(movMoreSettingsButton, { alpha: 1, y:yCount, time:0.75, transition:"easeOutSine" } );
				
				yCount += 25;
				boxMoreSettings.visible = true;
				Tweener.removeTweens(boxMoreSettings);
				Tweener.addTween(boxMoreSettings, { alpha: 1, y:yCount, time:0.75, transition:"easeOutSine" } );
				
				if (this.isMoreSettings) {
					movMoreSettingsButton.setText("hide");
					boxMoreSettings.updateDisplay(true);
				} else {
					movMoreSettingsButton.setText("show");
					boxMoreSettings.updateDisplay(false);
				}
				yCount += boxMoreSettings.totalHeight;
				
				Tweener.removeTweens(movBottomLine);
				Tweener.addTween(movBottomLine, { y:yCount, time:0.5, transition:"easeOutSine" } );
				
				yCount += 20;
				Tweener.removeTweens(movComparisonBox);
				Tweener.addTween(movComparisonBox, { y:yCount, time:0.65, transition:"easeOutSine" } );
				
			} else {
				movSettingsButton.setText("show");
				
				boxSettings.updateDisplay(false);
				yCount = boxSettings.totalHeight + boxSettings.y;

				Tweener.removeTweens(movMoreSettingsButton);
				Tweener.addTween(movMoreSettingsButton, { alpha: 0, y:yCount, time:0.75, delay:0.25, transition:"easeOutSine", onComplete:function() { this.visible = false; } } );
				
				yCount += 25;
				Tweener.removeTweens(boxMoreSettings);
				Tweener.addTween(boxMoreSettings, { alpha: 0, y:yCount, time:0.75, delay:0.25, transition:"easeOutSine", onComplete:function() { this.visible = false; } } );
				
				yCount += 2;
				Tweener.removeTweens(movBottomLine);
				Tweener.addTween(movBottomLine, { y:yCount, time:0.5, delay:0.25, transition:"easeOutSine" } );
				
				yCount += 20;
				Tweener.removeTweens(movComparisonBox);
				Tweener.addTween(movComparisonBox, { y:yCount, time:0.65, delay:0.25, transition:"easeOutSine" } );
			}
			
			this.updateBrowser();
			
		}
		
		/*private function showSettings():void 
		{
			var moreSettingsY:Number; 
			
			this.isSettings = true;
			movSettingsButton.setText("hide");

			movMoreSettingsButton.visible = true;
			
			movMankar.showSettings();
			movOther.showSettings();
			
			moreSettingsY = movMankar.y + movMankar.totalHeight;
			
			Tweener.removeTweens(movMoreSettingsButton);
			Tweener.addTween(movMoreSettingsButton, { alpha: 1, y:moreSettingsY, time:0.75, transition:"easeOutSine" } );
			Tweener.removeTweens(movMoreSettings);
			Tweener.addTween(movMoreSettings, { y:moreSettingsY+movMoreSettingsButton.height +2, time:0.75, transition:"easeOutSine" } );
			
			if (isMoreSettings){
				this.showMoreSettings();
			} else {
			
				Tweener.removeTweens(movSettingsBG);
				Tweener.addTween(movSettingsBG, { height:movMankar.settingsHeight+15, time:0.75, transition:"easeOutQuad" } );
				
				Tweener.removeTweens(movBottomLine);
				Tweener.addTween(movBottomLine, { y:moreSettingsY + movMoreSettingsButton.height +2, time:0.5, transition:"easeOutSine" } );
				
				Tweener.removeTweens(movComparisonBox);
				Tweener.addTween(movComparisonBox, { y:moreSettingsY + movMoreSettingsButton.height +15, time:0.55, transition:"easeOutSine" } );
			}
			
			
			var pageHeight:Number = moreSettingsY + movMoreSettingsButton.height +15 +movComparisonBox.height;
			var url:URLRequest = new URLRequest("javascript:resizeBrowser('"+pageHeight+"');");
			navigateToURL(url, "_self");
			
		}
		
		private function hideSettings():void 
		{
			this.isSettings = false;
			movSettingsButton.setText("show");
			
			movMankar.hideSettings();
			movOther.hideSettings();
			
			Tweener.removeTweens(movSettingsBG);
			Tweener.addTween(movSettingsBG, { height:5, time:0.5, delay:0.25, transition:"easeOutSine" } );
			
			Tweener.removeTweens(movBottomLine);
			Tweener.addTween(movBottomLine, { y:movSettingsBG.y + 7, time:0.5, delay:0.25, transition:"easeOutQuad" } );
			
			Tweener.removeTweens(movMoreSettingsButton);
			Tweener.addTween(movMoreSettingsButton, { alpha: 0, y:movSettingsBG.y, time:0.5, delay:0.25, transition:"easeOutSine", onComplete:function() { this.visible = false } } );
			Tweener.removeTweens(movMoreSettings);
			Tweener.addTween(movMoreSettings, { y:movSettingsBG.y, time:0.5, transition:"easeOutSine" } );
			
			Tweener.removeTweens(movComparisonBox);
			Tweener.addTween(movComparisonBox, { y:movSettingsBG.y + 27, time:0.65, delay:0.25, transition:"easeOutSine" } );
			
			movMoreSettings.hideSettings();
			
			var pageHeight:Number = movSettingsBG.y + 27 +movComparisonBox.height;
			var url:URLRequest = new URLRequest("javascript:resizeBrowser('"+pageHeight+"');");
			navigateToURL(url, "_self");
			
		}
		
		private function showMoreSettings() {
			
			var settingsHeight:Number; 
			var settingsHeightY:Number;
			
			movMoreSettings.showSettings();
			
			settingsHeight = (movMankar.y + movMankar.totalHeight + 10 + movMoreSettings.totalHeight) - movSettingsBG.y;
			settingsHeightY = settingsHeight + movSettingsBG.y;
			
			Tweener.removeTweens(movSettingsBG);
			Tweener.addTween(movSettingsBG, { height:settingsHeight+10, time:0.75, transition:"easeOutSine" } );
			
			Tweener.removeTweens(movBottomLine);
			Tweener.addTween(movBottomLine, { y:settingsHeightY + 12, time:0.5, transition:"easeOutSine" } );
			
			Tweener.removeTweens(movComparisonBox);
			Tweener.addTween(movComparisonBox, { y:settingsHeightY + 27, time:0.65, transition:"easeOutSine" } );
			
		}
		
		private function hideMoreSettings() {
			

			movMoreSettings.hideSettings();
			
			Tweener.removeTweens(movSettingsBG);
			Tweener.addTween(movSettingsBG, { height:movMankar.settingsHeight+15, time:1, transition:"easeOutSine" } );
			
			Tweener.removeTweens(movBottomLine);
			Tweener.addTween(movBottomLine, { y:movMankar.y + movMankar.totalHeight+ movMoreSettingsButton.height +2, time:0.5, transition:"easeOutSine" } );
			
			Tweener.removeTweens(movComparisonBox);
			Tweener.addTween(movComparisonBox, { y:movMankar.y + movMankar.totalHeight  + movMoreSettingsButton.height +15, time:0.65, transition:"easeOutSine" } );
		}
		
		private function sizeMoreSettings(_event:Event = null):void 
		{
			
			var yHeight:Number;
			
			movMoreSettingsButton.y = movMankar.y + movMankar.height + 15;
			movMoreSettings.y = movMoreSettingsButton.y + movMoreSettingsButton.height + 2;
			
		}*/
		
		private function productChangeHandler(_event:Event):void 
		{
			switch(_event.target) {
				case cmbMankar:
				for each (var setting:Object in cmbMankar.selectedItem.settings) {
					if (this.mankarSettings[setting.@ref] != null) {
						this.mankarSettings[setting.@ref].setValues(setting);
					} else if (this.globalSettings[setting.@ref] != null) {
						this.gloablSettings[setting.@ref].setValues(setting);
					}
					if (cmbMankar.selectedItem.picture[0] != null){
						picMankar.loadPic(cmbMankar.selectedItem.picture[0]);
					} else {
						picMankar.unLoadPic();
					}
				}
				break;
				
				case cmbOther:
				for each (var setting:Object in cmbOther.selectedItem.settings) {
					if (this.otherSettings[setting.@ref] != null) {
						this.otherSettings[setting.@ref].setValues(setting);
					}
					if (cmbOther.selectedItem.picture[0] != null){
						picOther.loadPic(cmbOther.selectedItem.picture[0]);
					} else {
						picOther.unLoadPic();
					}
				}
				break;
			}
			
			this.collectSettings();
		}
		
		private function settingChangeHandler(_event:Event):void 
		{
			this.collectSettings();
		}
		
		private function settingsClickHandler(_event:MouseEvent):void 
		{
			if (this.isSettings) {
				this.isSettings = false;
			} else {
				this.isSettings = true;
			}
			
			this.updateDisplay();
		}
		private function moreSettingsClickHandler(_event:MouseEvent):void 
		{
			if (this.isMoreSettings) {
				this.isMoreSettings = false;
			} else {
				this.isMoreSettings = true;
			}
			
			this.updateDisplay();
		}
		
		
		
		private function metricChangeHandler(_event:Event):void 
		{
			var setting:Setting;
			
			if (movUnitsButton.isMetric) {
				this.isMetric = true;
			} else {
				this.isMetric = false;
			}
			
			for each(setting in this.mankarSettings) {
				setting.setUnits(this.isMetric);
			}
			for each(setting in this.otherSettings) {
				setting.setUnits(this.isMetric);
			}
			for each(setting in this.globalSettings) {
				setting.setUnits(this.isMetric);
			}
			
			this.collectSettings();
		}
		
		private function plusMinusHandler(_event:Event):void 
		{
			switch (_event.currentTarget) 
			{
				case movComparisonBox:
				movComparisonBox.showComparisons(this.allVariables, this.isMetric);
				
				break;
			}
			
			this.updateBrowser();
			
		}
		
		private function updateBrowser():void 
		{
			var pageHeight:Number = movComparisonBox.y+movComparisonBox.height;
			var url:URLRequest = new URLRequest("javascript:resizeBrowser('"+pageHeight+"');");
			//navigateToURL(url, "_self");
		}
	}
	
}