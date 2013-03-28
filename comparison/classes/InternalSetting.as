package classes
{
	import com.utils.meMath3;
	
	/**
	* ...
	* @author Steve
	*/
	public class InternalSetting extends Object
	{
		public var ref:String = "";
		public var value:Number = 0;
		
		private var isMetric:Boolean = true;
		private var objSetting:Object;
		private var conversion:Number = 1;
		
		public function InternalSetting(_setting:Object):void 
		{
			this.setValues(_setting);
		}
		
		public function setValues(_setting:Object):void 
		{
			var obj:Object;
			
			this.objSetting = new Object();
			
			if (String(_setting.@ref) != "") {
				this.objSetting.ref = _setting.@ref;
				this.ref = _setting.@ref;
			}
			
			if (Number(_setting.conversion) != 0) {
				this.objSetting.conversion = Number(_setting.conversion);
				this.conversion = this.objSetting.conversion;
			}
			
			if (String(_setting.metric) != "") {
				this.objSetting.metric = _setting.metric;
			} else {
				this.objSetting.metric = "";
			}
			if (String(_setting.imperial) != "") {
				this.objSetting.imperial = _setting.imperial;
			}
			
			if (String(_setting.default) != "") {
				this.objSetting.default = Number(_setting.default);
			}
			
			if (String(_setting.round) != "") {
				this.objSetting.round = Number(_setting.round);
			} else {
				this.objSetting.round = 1;
			}
			
			this.value = Number(this.objSetting.default);
			
			this.setUnits();
		}
		
		public function setUnits(_isMetric:Boolean = true):void 
		{
			var needChange:Boolean = false;
			
			if (_isMetric) {
				if (!this.isMetric) {
					needChange = true;
				}
				this.isMetric = true;
			} else{
				this.isMetric = false;
			}
			
			if ((this.isMetric) || (this.conversion == 1)) {
				if (needChange){
					this.value = meMath3.round(this.value / this.conversion, this.objSetting.round);
				}
			} else {			
				this.value = meMath3.round(this.value * this.conversion, this.objSetting.round);				
			}
			

		}
	}
	
}