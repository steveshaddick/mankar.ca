package classes
{
	import fl.controls.ComboBox;
	import flash.display.MovieClip;
	import flash.events.Event;
	import flash.geom.Point;
	import flash.net.URLRequest;
	import flash.net.URLLoader;
	import caurina.transitions.Tweener;
	import flash.events.MouseEvent;
	import flash.display.StageAlign;
	import flash.display.Stage;
	import flash.text.TextField;
	import com.utils.meString3;
	import com.utils.meMath3;
	import flash.display.StageScaleMode;
	import flash.net.navigateToURL;
	
	/**
	* ...
	* @author Steve
	*/
	public class MankarComparison extends MovieClip 
	{
		public var movHeader:Header;
		public var movHeaderBG:MovieClip;
		public var movSettingsBG:MovieClip;
		public var movBottomLine:MovieClip;
		public var movSettingsButton:SettingsButton;
		public var movMoreSettingsButton:MoreSettingsButton;
		public var movUnitsButton:UnitsButton;
		public var movComparisonBox:ComparisonBox;
		public var picMankar:PicLoader3;
		public var picOther:PicLoader3;
		public var txtHelp:TextField;
		public var txtMankarProduct:TextField;
		public var txtOtherProduct:TextField;
		
		public var cmbMankar:ComboBox;
		public var cmbOther:ComboBox;
		public var movMoreSettingsBG:MovieClip;
		public var infoMankar:InfoDisplay;
		public var infoOther:InfoDisplay;
		
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
		private var xmlSettings:XML;
		
		private var mankarDone:Boolean = false;
		private var otherDone:Boolean = false;
		private var settingsDone:Boolean = false;
		
		private var allVariables:Array;
		
		private var displayText:Array = new Array();
		
		public function MankarComparison():void 
		{
			this.addEventListener(Event.ADDED_TO_STAGE, stageHandler);
			this.addEventListener("onSettingChange", settingChangeHandler);
			this.addEventListener("onMetricChange", metricChangeHandler);
			this.addEventListener("onShowHelp", showHelpHandler);
			this.addEventListener("onHideHelp", hideHelpHandler);
			
			cmbMankar.addEventListener(Event.CHANGE, productChangeHandler);
			cmbOther.addEventListener(Event.CHANGE, productChangeHandler);
			
			movComparisonBox.addEventListener("onPlusMinus", plusMinusHandler);
			boxSettings.addEventListener("onPlusMinus", plusMinusHandler);
			boxMoreSettings.addEventListener("onPlusMinus", plusMinusHandler);
			infoMankar.addEventListener("onPlusMinus", plusMinusHandler);
			
			movSettingsButton.addEventListener(MouseEvent.CLICK, settingsClickHandler);
			movMoreSettingsButton.addEventListener(MouseEvent.CLICK, moreSettingsClickHandler);
			
			cmbMankar.addItem({label:"Loading..."});
			cmbMankar.enabled = false;
			cmbOther.addItem( { label:"Loading..." } );
			cmbOther.enabled = false;
			
			infoMankar.setInfoPlusMinus(true);
			infoOther.setInfoPlusMinus(false);
			
			this.addChild(boxSettings);
			this.addChild(boxMoreSettings);
			boxSettings.x = 10;
			boxMoreSettings.x = 10;
			
			boxSettings.y = movSettingsButton.y + 20;
			movBottomLine.y = boxSettings.y + boxSettings.totalHeight + 2;
			movSettingsBG.height = movBottomLine.y - movSettingsBG.y;
			
			movMoreSettingsButton.y = boxSettings.y + boxSettings.totalHeight + 10;
			boxMoreSettings.y = movMoreSettingsButton.y + 25;
			
			movMoreSettingsButton.alpha = 0;
			movMoreSettingsButton.visible = false;
			
			this.setChildIndex(txtHelp, this.numChildren-1);
			txtHelp.visible = false;
		}
		
		private function stageHandler(_event:Event):void 
		{
			var ldrSettings:URLLoader = new URLLoader();
			var ldrMankar:URLLoader = new URLLoader();
			var ldrOther:URLLoader = new URLLoader();
			var then:Date = new Date();
			
			stage.align = StageAlign.TOP;
			stage.scaleMode=StageScaleMode.NO_SCALE;

			ldrSettings.addEventListener(Event.COMPLETE, this.onSettingsLoaded);
			ldrSettings.load(new URLRequest("comparison-settings.xml?cachekiller=" + then.getTime()));
			//ldrSettings.load(new URLRequest("comparison-settings.xml"));
			
			ldrMankar.addEventListener(Event.COMPLETE, this.onProductsLoaded);
			ldrMankar.load(new URLRequest("mankar-products.xml?cachekiller="+then.getTime()));
			//ldrMankar.load(new URLRequest("mankar-products.xml"));
			
			ldrOther.addEventListener(Event.COMPLETE, this.onProductsLoaded);
			ldrOther.load(new URLRequest("other-products.xml?cachekiller="+then.getTime()));
			//ldrOther.load(new URLRequest("other-products.xml"));
			
		}
		
		private function onSettingsLoaded(_event:Event):void 
		{
			this.xmlSettings = new XML(_event.target.data);
			
			if (String(this.xmlSettings.main.mankarproduct) != null) {
				txtMankarProduct.htmlText = "<b>"+this.xmlSettings.main.mankarproduct+"</b>";
				txtMankarProduct.width = txtMankarProduct.textWidth + 5;
			}
			if (String(this.xmlSettings.main.otherproduct) != null) {
				txtOtherProduct.htmlText = "<b>"+this.xmlSettings.main.otherproduct+"</b>";
				txtOtherProduct.width = txtOtherProduct.textWidth + 5;
			}
			movHeader.setHeading(this.xmlSettings.main);
			movUnitsButton.setHeading(this.xmlSettings.main);
			movUnitsButton.x = 610 - movUnitsButton.width;
			
			movSettingsButton.setHeading(String(this.xmlSettings.main.settings));
			movMoreSettingsButton.setHeading(this.xmlSettings.main.moresettings);
			movComparisonBox.setHeading(this.xmlSettings.main.comparison);
			
			displayText['show'] = this.xmlSettings.main.show;
			displayText['hide'] = this.xmlSettings.main.hide;
			
			for each (var setting:Object in this.xmlSettings.setting) {
				if ((String(setting.@scope) != "") && (String(setting.@ref) != ""))  {				
					
					switch (String(setting.@scope)) {
						case "unit":

						this.mankarSettings[setting.@ref] = new Setting(true);
						this.otherSettings[setting.@ref] = new Setting();
						
						if (setting.@location == "top") {
							boxSettings.addSetting(this.mankarSettings[setting.@ref], "unit", "mankar");
							boxSettings.addSetting(this.otherSettings[setting.@ref], "unit", "other");
						} else {
							boxMoreSettings.addSetting(this.mankarSettings[setting.@ref], "unit", "mankar");
							boxMoreSettings.addSetting(this.otherSettings[setting.@ref], "unit", "other");
						}
						
						this.mankarSettings[setting.@ref].setValues(setting);
						this.otherSettings[setting.@ref].setValues(setting);
						
						break;
						
						case "global":
						this.globalSettings[setting.@ref] = new Setting(true);
						
						if (setting.@location == "top") {
							boxSettings.addSetting(this.globalSettings[setting.@ref], "global");
						} else {
							boxMoreSettings.addSetting(this.globalSettings[setting.@ref], "global");
						}
						this.globalSettings[setting.@ref].setValues(setting);
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
			
			movComparisonBox.addComparisons(this.xmlSettings);
			
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
			var tmp:Object;
			var info:InfoDisplay;
			
			switch(String(xml.identifier[0])) {
				case "mankar":
				cmb = cmbMankar;
				info = infoMankar;
				mankarDone = true;
				break;
				
				case "other":
				cmb = cmbOther;
				info = infoOther;
				otherDone = true;
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
				if (String(product.picture) != "") {
					tmp.picture = product.picture[0];
				} else {
					tmp.picture = "";
				}
				if (String(product.info) != "") {
					tmp.info = product.info;
				} else {
					tmp.info = "";
				}
				cmb.addItem(tmp);
				i ++;
			}
			cmb.enabled = true;
			cmb.selectedIndex = defaultIndex;
			
			info.setInfo(cmb.selectedItem.picture,cmb.selectedItem.info);
			
			this.applyOverrides();
		}
		
		private function applyOverrides():void 
		{
			var setting:Object;
			
			if ((mankarDone) && (otherDone) && (settingsDone)) {
				for each (setting in cmbMankar.selectedItem.settings) {
					if (this.mankarSettings[setting.@ref] != null) {
						this.mankarSettings[setting.@ref].setValues(setting, true);
					} else if (this.globalSettings[setting.@ref] != null){
						this.globalSettings[setting.@ref].setValues(setting, true);
					}
				}
				for each (setting in cmbOther.selectedItem.settings) {
					if (this.otherSettings[setting.@ref] != null) {
						this.otherSettings[setting.@ref].setValues(setting, true);
					}
				}
				this.collectSettings();
				this.updateDisplay();
				
			}
		}
		
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
				if ((this.isMetric) || (String(obj.imperial) == "")) {
					this.allVariables['mankar'][obj.@ref] = meMath3.round(parseCalculation(meString3.stripSpaces(obj.metric), "mankar"),round);
					this.allVariables['other'][obj.@ref] = meMath3.round(parseCalculation(meString3.stripSpaces(obj.metric), "other"),round);
				} else {
					this.allVariables['mankar'][obj.@ref] = meMath3.round(parseCalculation(meString3.stripSpaces(obj.imperial), "mankar"),round);
					this.allVariables['other'][obj.@ref] = meMath3.round(parseCalculation(meString3.stripSpaces(obj.imperial), "other"),round);
				}
				
				
				//trace(this.allVariables['mankar'][obj.@ref]);
				//trace(this.allVariables['other'][obj.@ref]);
				//trace("-----------");
			}
			
			movComparisonBox.showComparisons(this.allVariables, this.isMetric);
			this.updateDisplay();
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
			var yCount:Number = 0;
			var yMoreSettings:Number = 0;
			var ySettings:Number = 0;
			
			if (infoMankar.height > infoOther.height){
				yCount = infoMankar.y + infoMankar.height + 5;
			} else {
				yCount = infoOther.y + infoOther.height + 5;
			}
			
			ySettings = yCount;
			Tweener.removeTweens(movSettingsButton);
			Tweener.addTween(movSettingsButton, { y:yCount, time:0.25, transition:"easeOutSine" } );
			Tweener.removeTweens(movUnitsButton);
			Tweener.addTween(movUnitsButton, { y:yCount, time:0.35, transition:"easeOutSine" } );
			
			yCount += 18;
			Tweener.removeTweens(movSettingsBG);
			Tweener.addTween(movSettingsBG, { y:yCount, time:0.35, transition:"easeOutSine" } );
			
			yCount += 1;
			Tweener.removeTweens(boxSettings);
			Tweener.addTween(boxSettings, { y:yCount, time:0.25, transition:"easeOutSine" } );
			
			if (this.isSettings) {
				movSettingsButton.setText(displayText['hide']);
				
				boxSettings.updateDisplay(true);
				yCount += boxSettings.totalHeight;
				
				movMoreSettingsButton.visible = true;
				Tweener.removeTweens(movMoreSettingsButton);
				Tweener.addTween(movMoreSettingsButton, { alpha: 1, y:yCount, time:0.75, transition:"easeOutSine" } );
				
				yCount += 20;
				boxMoreSettings.visible = true;
				Tweener.removeTweens(boxMoreSettings);
				Tweener.addTween(boxMoreSettings, { alpha: 1, y:yCount, time:0.75, transition:"easeOutSine" } );
				
				if (this.isMoreSettings) {
					movMoreSettingsButton.setText(displayText['hide']);
					boxMoreSettings.updateDisplay(true);
				} else {
					movMoreSettingsButton.setText(displayText['show']);
					boxMoreSettings.updateDisplay(false);
				}
				yCount += boxMoreSettings.totalHeight;

				Tweener.addTween(movSettingsBG, { height: yCount - ySettings-16, time:0.75, transition:"easeOutSine" } );
				
				yCount += 2;
				Tweener.removeTweens(movBottomLine);
				Tweener.addTween(movBottomLine, { y:yCount, time:0.5, transition:"easeOutSine" } );
				
				yCount += 20;
				Tweener.removeTweens(movComparisonBox);
				Tweener.addTween(movComparisonBox, { y:yCount, time:0.65, transition:"easeOutSine" } );
				
			} else {
				movSettingsButton.setText(displayText['show']);
				
				boxSettings.updateDisplay(false);
				yCount += boxSettings.totalHeight;

				Tweener.removeTweens(movMoreSettingsButton);
				Tweener.addTween(movMoreSettingsButton, { alpha: 0, y:yCount, time:0.75, transition:"easeOutSine", onComplete:function() { this.visible = false; } } );
				
				boxMoreSettings.updateDisplay(false);
				
				Tweener.removeTweens(boxMoreSettings);
				Tweener.addTween(boxMoreSettings, { alpha: 0, y:yCount, time:0.75, transition:"easeOutSine"} );
				
				Tweener.addTween(movSettingsBG, { height: yCount - ySettings-16, time:0.5, transition:"easeOutSine" } );
				
				yCount += 2;
				Tweener.removeTweens(movBottomLine);
				Tweener.addTween(movBottomLine, { y:yCount, time:0.5, transition:"easeOutSine" } );
				
				yCount += 20;
				Tweener.removeTweens(movComparisonBox);
				Tweener.addTween(movComparisonBox, { y:yCount, time:0.65, transition:"easeOutSine" } );
				
			}
			
			
			
			this.updateBrowser(yCount);
			
		}
		
		private function productChangeHandler(_event:Event):void 
		{
			var setting:Object;
			
			switch(_event.target) {
				case cmbMankar:
				for each (setting in this.xmlSettings.setting) {
					if ((String(setting.@scope) != "") && (String(setting.@ref) != ""))  {
						switch (String(setting.@scope)) {
							case "unit":
							case "internal":
							this.mankarSettings[setting.@ref].setValues(setting);
							break;
							
							case "global":
							this.globalSettings[setting.@ref].setValues(setting);
							break;
						}
					}
				}
				
				for each (setting in cmbMankar.selectedItem.settings) {
					if (this.mankarSettings[setting.@ref] != null) {
						this.mankarSettings[setting.@ref].setValues(setting, true);
					} else if (this.globalSettings[setting.@ref] != null) {
						this.globalSettings[setting.@ref].setValues(setting, true);
					}
					
					
				}
				infoMankar.setInfo(cmbMankar.selectedItem.picture, cmbMankar.selectedItem.info);
				infoOther.setSmall(false);
				break;
				
				case cmbOther:
				for each (setting in this.xmlSettings.setting) {
					if ((String(setting.@scope) != "") && (String(setting.@ref) != ""))  {
						switch (String(setting.@scope)) {
							case "unit":
							case "internal":
							this.otherSettings[setting.@ref].setValues(setting);
							break;
						}
					}
				}
				
				for each (setting in cmbOther.selectedItem.settings) {
					if (this.otherSettings[setting.@ref] != null) {
						this.otherSettings[setting.@ref].setValues(setting, true);
					}
				}
				infoOther.setInfo(cmbOther.selectedItem.picture, cmbOther.selectedItem.info);
				infoMankar.setSmall(false);
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
				case boxSettings:
				case boxMoreSettings:
				
				if (this.otherSettings[_event.target.ref] != null) {
					this.otherSettings[_event.target.ref].setSmall(_event.target.isSmall);
				}
				this.updateDisplay();
				break;
				
				case movComparisonBox:
				movComparisonBox.showComparisons(this.allVariables, this.isMetric);
				this.updateBrowser(movComparisonBox.y);
				break;
				
				case infoMankar:
				infoOther.setSmall(infoMankar.isSmall);
				this.updateDisplay();
				break;
			}
			
			
			
		}
		
		private function updateBrowser(_y:Number):void 
		{
			var pageHeight:Number = _y+movComparisonBox.height;
			var url:URLRequest = new URLRequest("javascript:resizeBrowser('"+pageHeight+"');");
			navigateToURL(url, "_self");
		}
		
		private function showHelpHandler(_event:Event):void 
		{
			var setting:Setting = Setting(_event.target);
			var pt:Point = setting.localToGlobal(setting.helpLocation);
			
			txtHelp.x = pt.x;
			txtHelp.y = pt.y;
			txtHelp.text = setting.objSetting.help;
			txtHelp.height = txtHelp.textHeight + 10;
			txtHelp.visible = true;
		}
		
		private function hideHelpHandler(_event:Event):void 
		{
			txtHelp.visible = false;
		}
	}
	
}