package com.utils{
	
	public class meMath3{
	
		public function meMath3(){
			
		}
		public static function rand(min:Number, max:Number):Number {
			return Math.floor(min +(Math.random() * (max - min + 1)));
		}
		
		public static function round(_num:Number, _decimals:Number){
			return Math.round(_num * (Math.pow(10,_decimals)))/(Math.pow(10,_decimals));
		}
	
	}

}