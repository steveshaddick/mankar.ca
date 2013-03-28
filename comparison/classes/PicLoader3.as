/**
* ...
* @author Steve Shaddick
* @version 1.0
*/

package classes{
	import flash.display.MovieClip;
	import flash.display.Loader;
	import flash.net.URLRequest;
	import flash.events.Event;
	import flash.events.ProgressEvent;
	import flash.events.EventDispatcher;
	import flash.text.TextField;
	import flash.text.TextFieldAutoSize;
	import flash.events.IOErrorEvent;
	import flash.events.HTTPStatusEvent;
	import flash.events.SecurityErrorEvent;
	import flash.events.IEventDispatcher;
	import com.utils.meMath3;
	import flash.display.Bitmap;
	import flash.display.BitmapData;
	
	public class PicLoader3 extends MovieClip {
		
		public var loader:Loader;
		public var movLoading:MovieClip;
		

		public var picX:Number;
		public var picY:Number;
		public var picLoc:URLRequest;
		public var picId:Number;
		//public var isLoaded:Boolean;
		private var bmpPic:Bitmap;
		private var picWidth:Number = 200;
		private var picHeight:Number = 200;
		
		private var cropScale:Boolean = true;
		private var scaleWidth:Boolean = false;
		private var scaleHeight:Boolean = false;
		private var align:String = "centre";

		 //place the corresponding objects on the stage to use them
		 private var movMask:MovieClip;

		
		
		public function PicLoader3(){
			//this.movMask.swapDepths(500);
			if (movMask != null){
				this.mask = movMask;
			}
			
			this.loader = new Loader();
			//this.visible = false;
			//this.addChild(this.loader);
			if (movLoading != null)
				movLoading.visible = false;
				
		}
		
		public function loadPic(_picLoc:String, _picId:Number=0, _picWidth:Number=NaN, _picHeight:Number=NaN, _cropScale:Boolean = true, _align:String="centre"){
			
			var picListen:Object = new Object;

			this.cropScale = _cropScale;
			this.align = _align;
			if (movLoading != null)
				movLoading.scaleX = 0;
			if (this.cropScale){
				if (!isNaN(_picWidth)){
					this.scaleWidth = true;
				}
				if (!isNaN(_picHeight)){
					this.scaleHeight = true;
				}
			}
			
			if (!isNaN(_picWidth)){
				this.picWidth = _picWidth;
			}
			if (!isNaN(_picHeight)){
				this.picHeight = _picHeight;
			}
			
			if (this.mask != null){
				this.mask.width = this.picWidth;
				this.mask.height = this.picHeight;
				
				this.mask.x = 0;
				this.mask.y = 0;
			}
			
			this.picLoc = new URLRequest(_picLoc);
			this.picId = _picId;
			
			
			configureListeners(loader.contentLoaderInfo);
			
			/*this.loader.addEventListener(Event.INIT, initHandler);
			this.loader.addEventListener(Event.COMPLETE, completeHandler);
			this.loader.addEventListener(ProgressEvent.PROGRESS, progressHandler);
			this.loader.addEventListener(IOErrorEvent.IO_ERROR, httpStatusHandler);
			this.loader.addEventListener(HTTPStatusEvent.HTTP_STATUS, ioErrorHandler);
			this.loader.addEventListener(SecurityErrorEvent.SECURITY_ERROR, securityErrorHandler);*/
			if (this.bmpPic != null){
				this.removeChild(this.bmpPic);
				this.bmpPic = null;
			}
			if (this.loader != null){
				this.loader.unload();
			}
			this.loader.load(this.picLoc);
			
			if (movLoading != null)
				movLoading.visible = true;
			this.visible = true;
			
			
			
		}
		
		public function unLoadPic():void 
		{
			if (this.bmpPic != null){
				this.removeChild(this.bmpPic);
				this.bmpPic = null;
			}
		}
		
		public function reset(){
			this.visible = false;
			//this.loader.unload();
		}
		
		private function configureListeners(dispatcher:IEventDispatcher):void {
            dispatcher.addEventListener(Event.COMPLETE, completeHandler);
            dispatcher.addEventListener(HTTPStatusEvent.HTTP_STATUS, httpStatusHandler);
            dispatcher.addEventListener(Event.INIT, initHandler);
            dispatcher.addEventListener(IOErrorEvent.IO_ERROR, ioErrorHandler);
            dispatcher.addEventListener(ProgressEvent.PROGRESS, progressHandler);
        }

		
		private function initHandler(_event:Event) {
			
			var oldImageData: BitmapData = _event.target.content.bitmapData;
			if (this.bmpPic != null){
				this.removeChild(this.bmpPic);
			}
			
			this.bmpPic = new Bitmap( oldImageData , "auto", true);
			
			this.bmpPic.scaleX = 1;
			this.bmpPic.scaleY = 1;
			
			/*if (this.cropScale){
				if (this.bmpPic.width < this.bmpPic.height){
					this.scaleWidth = true;
					this.scaleHeight = false;
				}
				if (this.bmpPic.height > this.bmpPic.width){
					this.scaleWidth = false;
					this.scaleHeight = true;
				}
			}*/
			
			if (this.scaleWidth && this.scaleHeight){
				this.bmpPic.scaleX = (this.picWidth / this.bmpPic.width);
				this.bmpPic.scaleY = (this.picHeight / this.bmpPic.height);
				this.bmpPic.scaleX = Math.min(this.bmpPic.scaleX,this.bmpPic.scaleY);
				this.bmpPic.scaleY = this.bmpPic.scaleX;
				
			} else if (this.scaleWidth){
				this.bmpPic.scaleX = (this.picWidth / this.bmpPic.width);
				this.bmpPic.scaleY = this.bmpPic.scaleX;
			} else if (this.scaleHeight){
				this.bmpPic.scaleY = (this.picHeight / this.bmpPic.height);
				this.bmpPic.scaleX = this.bmpPic.scaleY;
			}
			
			
			switch (this.align){
				case "centre":
				this.bmpPic.x = -this.bmpPic.width/2;
				this.bmpPic.y = -this.bmpPic.height/2;
				break;
				
				case "top":
				this.bmpPic.x = -this.bmpPic.width/2;
				this.bmpPic.y = 0;
				break;
				
				case "bottom":
				this.bmpPic.x = -this.bmpPic.width/2;
				this.bmpPic.y = -this.bmpPic.height;
				break;
				
				case "topleft":
				this.bmpPic.x = 0;
				this.bmpPic.y = 0;
				break;
				
			}
			
			
			this.addChild(this.bmpPic);
			

		}
		
		private function progressHandler(_event:ProgressEvent){
			if (movLoading != null)
				movLoading.scaleX = (_event.bytesLoaded / _event.bytesTotal);
		}
		
		
		private function completeHandler(_event:Event) {
			if (movLoading != null)
				movLoading.visible = false;
	
			this.dispatchEvent(new Event("onPicLoaded"));
		}
		
		private function httpStatusHandler(_event:HTTPStatusEvent):void {

        }
		
		private function securityErrorHandler(_event:SecurityErrorEvent):void {
            trace("$$$ PICLOADER ERROR $$$ : "+ _event.text);
			this.visible = false;
        }


		
		private function ioErrorHandler(_event:IOErrorEvent):void {
            trace("$$$ PICLOADER ERROR $$$ : "+ _event.text);
			this.visible = false;
		}

	}
	
}

