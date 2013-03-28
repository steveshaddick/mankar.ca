package com.utils{

	public class meString3{
		
		public function meString3(){
			
		}
		
		public static function trim(_str:String):String{
			var i:Number;
			while (true) {
				if (_str.charAt((_str.length-1)) == " " || _str.charAt((_str.length-1)) == "\n" || _str.charAt((_str.length-1)) == "\r") {
					_str = _str.substr(0, (_str.length-1));
				} else {
					break;
				}
			}
			i=0;
			while (true) {
				if (_str.charAt(i) == " " || _str.charAt(i) == "\n" || _str.charAt(i) == "\r") {
					_str = _str.substr((i+1), (_str.length-1));
				} else {
					break;
				}
				i++;
			}
			return _str;
		}
		
		public static function stripslashes(str:String):String {
			var stripSlashesRegExp = new RegExp("(\\\\([\"\'\\\\]))","gim");
			return str.replace(stripSlashesRegExp, "$2");
		}
		
		//from senocular
		public static function isValidEmail(email:String):Boolean {
			var emailExpression:RegExp = /^[a-z][\w.-]+@\w[\w.-]+\.[\w.-]*[a-z][a-z]$/i;
			return emailExpression.test(email);
		}
		
		//from punyblog
		public static function isValidURL(_url:String):Boolean{
			var urlExpression:RegExp = new RegExp("^http[s]?:\/\/((\d+\.\d+\.\d+\.\d+)|(([\w-]+\.)+([a-z,A-Z][\w-]*)))(:[1-9][0-9]*)?(\/([\w-.\/:%+@&=]+[\w- .\/?:%+@&=]*)?)?$","");
			//var urlExpression:RegExp = ^(http(s)?:\/\/)((\d+\.\d+\.\d+\.\d+)|(([\w-]+\.)+([a-z,A-Z][\w-]*)))(:[1-9][0-9]*)?(\/([\w-.\/:%+@&=]+[\w- .\/?:%+@&=]*)?)?$;
			return urlExpression.test(_url);
		}
		
		//removes "http://" if there and adds "www" if not there
		public static function prepareURL(_url:String):String {
			
			var re:RegExp = /http:\/\//;
			
			_url = _url.replace(re,"");
			
			if (_url.substring(0,3) != "www."){
				_url = "www." + _url;
			}
			
			return _url;
		}
		
		//adds commas to thousands
		public static function commaThousands(_num:Number):String {
			
			var tmp:String = _num.toFixed(0);
			var assembled:String;
			var decCheck:Number;
			var chunks:Array = new Array();
			var count:Number = 0;
			var dec:Number = 1;
			var i:int;
			
			if (_num > 1) {
				chunks[0] = "";
				for (i= tmp.length - 1; i >= 0; i--) {
					chunks[count] = tmp.charAt(i) + chunks[count];
					if (dec == 3)
					{
						count++;
						dec = 1;
						chunks[count] = "";
					} else {
						dec ++;
					}
				}
				
				assembled = "";
				for (i = chunks.length-1; i >=0; i--) {
					
					assembled += chunks[i];
					if ((chunks[i] != "") && (i > 0)){
						assembled += ",";
					}
				}
				
				decCheck = _num - Number(tmp);
				if (decCheck > 0)
					return assembled + String(decCheck).substr(1);
				else if (decCheck == 0)
					return assembled;
				else
					return "Error";
			} else {
				return String(_num);
			}
		}
		
		public static function stripSpaces(_str:String):String 
		{
			var original:Array=_str.split(" ");
			return(original.join(""));
		}
	
	}

}