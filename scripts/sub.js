define( function() {
	function Sub(context)
	{
		var canvasContext = context;
		var centerX ;
		var centerY;
		var radius = 50;
		var cropImage;
		
		Sub.prototype.draw = function()
		{
			centerX = canvasContext.canvas.width / 2 ;
			centerY = canvasContext.canvas.height / 2 ;
			
			//saving default image
			var canvasImage = canvasContext.getImageData(0, 0, canvasContext.canvas.width, canvasContext.canvas.height);
			
			this.drawCircle();
			
			//set transparency 100% so that only circle portion will be visible
			Common.setTransparency(canvasContext, "255");
			
			//now we can see only circle portion is visible and other part is invisible
			//so we can crop the image
			cropImage = canvasContext.getImageData(centerX - radius, centerY - radius, radius * 2, radius * 2);
			
			//set transparency nothing so that we can draw the image again
			Common.setTransparency(canvasContext, "0");
			//draw the saved image
			canvasContext.putImageData( canvasImage , 0, 0);
			this.drawCircle();
			
			Common.setTransparency(canvasContext, 0.5);

		};
		
		Sub.prototype.drawCircle = function()
		{
			canvasContext.beginPath();
			canvasContext.arc(centerX , centerY , radius, 0, 2 * Math.PI, true);
			canvasContext.strokeStyle = "#000000";
			canvasContext.lineWidth = 2;
			canvasContext.closePath();
			context.stroke();
		};
		Sub.prototype.setSize = function(h)
		{
			radius = h;
		};

		Sub.prototype.getCroppedImage = function()
		{
			var pixel = cropImage.data;
		
			var r = 0, g = 1, b = 2, a = 3;
			for (var p = 0; p < pixel.length; p += 4)
			{
			  if (
				  pixel[ p + r ] == 255 &&
				  pixel[ p + g ] == 255 &&
				  pixel[ p + b ] == 255 &&
				  pixel[ p + a ] == 255
				  ) // if white then change alpha to 0
				{
					/*pixel[ p + r ] = 0;
					pixel[ p + g ] = 0;
					pixel[ p + b ] = 0;*/
					pixel[ p + a ] = 0;
				}
			}
			return cropImage;
		};
		Sub.prototype.fuck = function()
		{
			return "disum";
		}
	}
	
	
	return Sub;
});