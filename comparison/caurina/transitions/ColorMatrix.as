/**
 * ColorMatrix class, which provides special color properties
 * called "_contrast", "_brightness", "_saturation"
 * using Tweener AS3 (http://code.google.com/p/tweener/).
 * 
 * Based on Mario Klingemanns awesome AS2 ColorMatrix v1.2
 * (http://www.quasimondo.com/archives/000565.php)
 * 
 * @author	Jens Krause [www.websector.de]
 * @date	08/28/07
 * @see		http://www.websector.de/blog/2007/08/28/tweener-as3-extension-for-color-properties-_brightness-_contrast-and-_saturation/
 * 
 */

package caurina.transitions
{
	import flash.filters.ColorMatrixFilter;
	
	public class ColorMatrix
	{	
		// 
		// Luminance conversion constants	
		private static const R_LUM:Number = 0.212671;
		private static const G_LUM:Number = 0.715160;
		private static const B_LUM: Number = 0.072169;
		//		
		// min / max values for special tween properties called "_contrast"		
		private static const MIN_CONTRAST: Number = -200;
		private static const MAX_CONTRAST: Number = 500;
		private static const STANDARD_CONTRAST: Number = 0;
		//		
		// min / max values for special tween properties called "_brightness"		
		private static const MIN_BRIGHTNESS: Number = -100;
		private static const MAX_BRIGHTNESS: Number = 100;
		private static const STANDARD_BRIGHTNESS: Number = 0;
		//		
		// min / max values for special tween properties called "_saturation"		
		private static const MIN_SATURATION: Number = -300;
		private static const MAX_SATURATION: Number = 300;						
		private static const STANDARD_SATURATION: Number = 100;
		//
		// standard matrix		
		private static const IDENTITY:Array = [	1,0,0,0,0,
												0,1,0,0,0,
												0,0,1,0,0,
												0,0,0,1,0 ];
		//
		// matrix	
		public var matrix:Array;		

		/**
		 * Constructor of ColorMatrix
		 *
		 * @param		mat			Object	A ColorMatrix instance or an array	
		 * 				
		 */		
		function ColorMatrix (mat:Object = null)
		{
			if (mat is ColorMatrix)
			{
				matrix = mat.matrix.concat();
			} 
			else if (mat is Array)
			{
				matrix = mat.concat();
			} 
			else 
			{
				reset();
			}			
		}
		
		/**
		 * Resets the matrix to its IDENTITY 
		 * 				
		 */			
		public function reset():void
		{
			matrix = IDENTITY.concat();
		}
		
		/**
		 * Clones the instance of ColorMatrix 
		 * 				
		 */			
		public function clone():ColorMatrix
		{
			return new ColorMatrix( matrix );
		}

		///////////////////////////////////////////////////////////
		// brightness
		///////////////////////////////////////////////////////////
		
		/**
		 * Calculate an average of particular indexes of its matrix
		 *
		 * @return		Number	Value of a brightness value for using Tweener
		 * 
		 */		
		public function getBrightness (): Number
		{
			// average of "brightness"-indexes within matrix
			var value: Number = (matrix[4] + matrix[9] + matrix[14]) / 3;
			// convert back to a "valid" tween property between min and max values
			if (value != 0) value = value * 100 / 255;
			return Math.round(value);
		}
		
		/**
		 * Changes matrix to alter brightness 
		 *
		 * @param		Number	Value of Tweeners brightness property
		 * 
		 */			
		public function setBrightness (value: Number):void
		{
			var brightness: Number = checkValue(MIN_BRIGHTNESS, MAX_BRIGHTNESS, value);
			// converts tween property to a valid value for the matrix
			brightness = 255 * brightness / 100;
			
			var mat:Array =  [	1,0,0,0, brightness,
						 		0,1,0,0, brightness,
						 		0,0,1,0, brightness,
								0,0,0,1, 0 	];
		
			concat(mat);			
		}

		///////////////////////////////////////////////////////////
		// contrast
		///////////////////////////////////////////////////////////
		/**
		 * Calculate an average of particular indexes of its matrix
		 *
		 * @return		Number		Value of a contrast value for using Tweener
		 * 
		 */			
		public function getContrast (): Number
		{
			// average of "contrast"-indexes within matrix
			var value: Number = (matrix[0] + matrix[6] + matrix[12]) / 3;
			// converts back to a "valid" tween property between min and max values
			value = (value - 1) * 100;
			return value;
		}
		
		/**
		 * Changes matrix to alter contrast 
		 *
		 * @param		Number		Value of Tweeners brightness property
		 * 
		 */	
		public function setContrast (value: Number):void
		{
			var contrast: Number = checkValue(MIN_CONTRAST, MAX_CONTRAST, value);
			// convert tween property to a valid value for the matrix
			contrast /= 100;
 			var scale: Number = contrast + 1;
            var offset : Number = 128 * (1 - scale);
  	           
            var mat: Array = [	scale, 	0, 		0, 		0, 	offset,
            					0, 		scale, 	0, 		0, 	offset, 
            					0, 		0, 		scale, 	0, 	offset, 
            					0, 		0, 		0, 		1, 	0		];
            								
			concat(mat);
		}

		///////////////////////////////////////////////////////////
		// saturation
		///////////////////////////////////////////////////////////
		/**
		 * Calculate an average of particular indexes of its matrix
		 *
		 * @return		Number		Value of a saturation value for using Tweener
		 * 
		 */		
		public function getSaturation (): Number
		{		
			// 
			// uses 3 "saturation"-indexes within matrix - once per color channel - ignore the others...
			var s1: Number = 1 - matrix[1] / G_LUM;
			var s2: Number = 1 - matrix[2] / B_LUM;
			var s5: Number = 1 - matrix[5] / R_LUM;
			// average of these "saturation"-indexes
			var value: Number;
			value = Math.round((s1 + s2 + s5) / 3);
			value *= 100;		
			
			return value;
		}		

		/**
		 * Changes matrix to alter contrast 
		 *
		 * @param		Number		Value of Tweeners saturation property
		 * 
		 */	
		public function setSaturation (value: Number): void
		{
			var saturation: Number = checkValue(MIN_SATURATION, MAX_SATURATION, value);			
			
			saturation /=  100;
			
			var isValue: Number = 1-saturation;
			
		    var irlum: Number = isValue * R_LUM;
			var iglum: Number = isValue * G_LUM;
			var iblum: Number = isValue	* B_LUM;
			
			var mat:Array =  [		irlum + saturation,	iglum, 				iblum, 				0, 0,
						  			irlum, 				iglum + saturation, iblum, 				0, 0,
						    		irlum, 				iglum, 				iblum + saturation, 0, 0,
						    		0, 					0, 					0, 					1, 0 ];
					
			concat(mat);
		}


		/**
		 * Concatenates the elements of a matrix specified in the parameter with the elements in an array and creates a new matrix
		 *
		 * @param		Array		Altered Matrix
		 * 
		 */			
		public function concat(mat:Array):void
		{		
			var temp:Array = new Array ();
			var i:Number = 0;
			
			for (var y:Number = 0; y < 4; y++ )
			{
				
				for (var x:Number = 0; x < 5; x++ )
				{
					temp[i + x] = 	mat[i] * matrix[x] + 
								   	mat[i+1] * matrix[x + 5] + 
								   	mat[i+2] * matrix[x + 10] + 
								   	mat[i+3] * matrix[x + 15] +
								   	(x == 4 ? mat[i+4] : 0);
				}
				i+=5;
			}
			
			matrix = temp;			
		}

		/**
		 * Instanciates a ColorMatrixFilter using ColorMatrix matrix
		 *
		 * @return		ColorMatrixFilter		ColorMatrixFilter using the matrix of a ColorMatrix instance
		 * 
		 */			
		public function get filter():ColorMatrixFilter
		{
			return new ColorMatrixFilter(matrix);
		}
		
		/**
		 * Helper method to check a value for min. and max. values within a specified range
		 *
		 * @param		Number		min. value of its range
 		 * @param		Number		max. value of its range
 		 * @param		Number		checked value
		 */			
		private function checkValue(minValue: Number, maxValue: Number, value: Number):Number 
		{
			return Math.min(maxValue, Math.max(minValue, value));
		}		
	}
}