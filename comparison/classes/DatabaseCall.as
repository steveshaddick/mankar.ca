/**
* ...
* @author Default
* @version 0.1
*/

package classes{
	
	//import XML;
	import flash.events.Event;
	import flash.net.URLLoader;
	import flash.net.URLRequest;
	import flash.net.URLRequestMethod;
	import flash.net.URLVariables;
	//import Date;
	
	public class DatabaseCall {
		
		private var xmlData:XML;
		private var loader:URLLoader = new URLLoader();
		private var phpFile:String;
		private var func:Function;
		private var then:Date = new Date();
		
		private const PHP_LOC:String = "http://www.mankar.ca/";
		
		public function DatabaseCall(){
		}
		
		public function sendRequest(_file:String, _func:Function = null, _vars:URLVariables = null):void{
			
			var request:URLRequest = new URLRequest(PHP_LOC+_file+"?cacheKiller=" + (then.getTime()));
			var variables:URLVariables = new URLVariables();
			
			if (_vars != null){
				variables = _vars;
			}
			
			request.method = URLRequestMethod.POST;
			request.data = variables;
			
			trace("--> sending "+_file);
			
			this.func = _func;
			this.phpFile = _file;
			this.loader.addEventListener(Event.COMPLETE, this.onLoaded);
			this.loader.load(request);
		}
		
		private function onLoaded(_event:Event):void{
			var now:Date = new Date();
			trace("<-- received "+this.phpFile+" in "+ (now.getTime() - then.getTime()));
			
			//trace(this.loader.data);
			
			this.xmlData = new XML(this.loader.data);
			
			if (this.xmlData.error != undefined){
				trace("$$$ ERROR $$$ : "+ this.xmlData.error.@query);
			}
			this.func(this.xmlData);
		}
	}
	
}