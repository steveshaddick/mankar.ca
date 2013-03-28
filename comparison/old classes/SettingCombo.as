package classes
{
	import fl.controls.ComboBox;
	import flash.display.MovieClip;
	import flash.text.TextField;
	import flash.text.TextFormat;
	import caurina.transitions.Tweener;

	/**
	* ...
	* @author Steve
	*/
	public class SettingCombo extends MovieClip 
	{
		public var txtDescription:TextField;
		public var cmbCombo:ComboBox;
		
		public var value:*;
		public var ref:String;
		
		public function SettingCombo(_setting:Object):void 
		{
			var myFormat:TextFormat = new TextFormat();
			myFormat.font = "Verdana11";
			myFormat.size = 11;
			myFormat.color = 0x333333;
			
			cmbCombo.setStyle("textFormat", myFormat);
			cmbCombo.setStyle("embedFonts", true);
			
			for each (var tmp:Object in _setting.option) {
				cmbCombo.addItem(tmp);
			}
			cmbCombo.selectedIndex = 0;
			this.value = cmbCombo.selectedItem.data;
			this.ref = _setting.@ref;
			
			this.alpha = 0;
			this.visible = false
			cmbCombo.visible = false;
		}
		
		public function setValues():void 
		{
			
		}
		
		public function show() {
			Tweener.removeTweens(this);
			Tweener.addTween(this, { alpha:1, time:0.25, delay:1.25, transition:"easeOutSine", onComplete:function() { this.visible = true; cmbCombo.visible = true; } } );
		}
		
		public function hide():void 
		{
			this.visible = false;
			cmbCombo.visible = false;
			Tweener.removeTweens(this);
			Tweener.addTween(this, { alpha:0, time:0.25, transition:"easeOutSine"} );
		}

	}
	
}