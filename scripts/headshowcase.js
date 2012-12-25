define(["jquery", "DragDropHelpers", "Coordinate"], function($, DragDropHelpers, Coordinate)
{
	var targetNode; 
	var btnPrev, btnNext, speed, visibleHead, scroll, noOfHeads, currentHead, ul, draggedObject;
	//var eventHerlpers = EventHelpers;
	
	$.fn.headshowcase = function(param)
	{
	
		//btnprev and btnnext is required field
		btnPrev = param.btnPrev;
		btnNext = param.btnNext;
		
		speed = param.speed > 0 ? param.speed : 200;
		visibleHead = param.visibleHead > 0 ? param.visibleHead : 15;
		scroll = 1;
		
		//get the div where all heads are arranged
		var div = $(this);
		
		//all coding for headshowcaseinit here
		return this.each(function()
		{
			//getting the ul, li from the div
			 ul = $("ul", div);
			 var li = $("li", ul);
			 //get no of heads in the show case
			 noOfHeads = li.size();
			 
			 currentHead = 0;
			 
			 //visible headshowcase
			 div.css("visibility", "visible");
			 
			 //set css to make it like slider
			 li.css({overflow: "hidden", float: "left"});
			 ul.css({margin: "0", padding: "0", position: "relative", "list-style-type": "none", "z-index": "1"});
			 div.css({overflow: "hidden", position: "relative", "z-index": "2", left: "0px"});
			 
			 //width of the li
			 var liSize = width(li);
			 //size of the ul
			 var ulSize = noOfHeads * liSize;
			 //size of the div
			 var divSize = visibleHead * liSize;
			 
			 //adding css
			 li.css({width: li.width(), height: li.height()});
			 ul.css("width", ulSize+"px").css( "left", -( currentHead * liSize ) );
			 div.css("width", divSize+"px"); 
			 
			 //previous button execution
			 if(btnPrev)
			 {
				$(btnPrev).click(function() 
				{
					return slideHead(currentHead - scroll);
				});
			}

			//next button execution
			if(btnNext)
			{
				$(btnNext).click(function() 
				{
					return slideHead(currentHead + scroll);
				});
			}
			
			
			function slideHead(executedHead)
			{
				
				if(executedHead < 0 || executedHead > noOfHeads - visibleHead )
				{
					return;
				}
                else 
				{
					currentHead = executedHead;
					ul.animate({ left: -(executedHead * liSize) },'fast');
					$(btnPrev + "," + btnNext).removeClass("disabled");
					$( (currentHead - scroll < 0 && btnPrev) || (currentHead + scroll > noOfHeads - visibleHead && btnNext) || []).addClass("disabled");
				}

			}
			
		});
		
		function css(el, prop) 
		{
			return parseInt($.css(el[0], prop)) || 0;
		};
		function width(el) 
		{
			return  el[0].offsetWidth + css(el, 'marginLeft') + css(el, 'marginRight');
		};
		function height(el) 
		{
			return el[0].offsetHeight + css(el, 'marginTop') + css(el, 'marginBottom');
		};
		function dragStartEvent(event)
		{
		};
	};
	
	return{
		init:function(className){
			 $("." + className).headshowcase({
				btnNext: ".next",
				btnPrev: ".prev"
			});
			
			var li = $("li", ul);
			li.each(function()
			{
				var image = $("img", this)[0];				
				console.log(image);
				/*var image = $("img", this)[0];
				
				EventHelpers.addEvent(image, 'dragstart', dragStartEvent);
				function dragStartEvent(e) 
				{
					e.dataTransfer.effectAllowed = 'move';
					e.dataTransfer.setData("Files", e.target.getAttribute('id'));
					draggedObject = e.currentTarget;
					console.log("X: "+ EventHelpers.getMouseX(e) + " Y: "+ EventHelpers.getMouseY(e));
					return true;
				}*/
			});
		},
		getCurrentHead:function()
		{
			return currentHead;
		}/*,
		setWorkspace:function()
		{

			targetNode = document.getElementById('imageCanvas');
			
			EventHelpers.addEvent(targetNode, 'dragover', dragOverEvent);
			EventHelpers.addEvent(targetNode, 'drop', dropEvent);
			
			
			function dragOverEvent(e)
			{
				EventHelpers.preventDefault(e);
			}
			
			function dropEvent(e) 
			{
				var coords = DragDropHelpers.getEventCoords(e);
				this.innerHTML = e.dataTransfer.getData('Files');
				EventHelpers.preventDefault(e);
				
				var headImage = new Image();
				headImage.onload = function()
				{
					var mousePos = EventHelpers.getMousePos(targetNode, e);
					
					//console.log(mousePos);
					var canvasContext = targetNode.getContext('2d');
					canvasContext.drawImage(headImage, mousePos.x, mousePos.y, headImage.width, headImage.height);
					
					var data = e.dataTransfer.files;
				};
				
				headImage.src = draggedObject.src;
			}
			

				
		}*/
	};
	
});