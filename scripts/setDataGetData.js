var dragObject = new function () {
	var me = this;
	
	var targetNode; 
	var eventNoticeNode, dragEventNoticeNode;
	
	var dataTransferCommentString;
	var problemImage = null;
	var canvasContext = null;
	var draggedObject = null;
	
	me.init = function () {
	
		if (EventHelpers.hasPageLoadHappened(arguments)) {
			return;
		}	
		
		
		targetNode=document.getElementById('imageCanvas');
		targetNode.onmousemove = function (e) {
			var coords = DragDropHelpers.getEventCoords(e);
			//console.log(coords.x);
		};
		eventNoticeNode = document.getElementById('eventNotice');
		dragEventNoticeNode = document.getElementById('dragEventNotice');
		
		/* These are events for the draggable objects */
		var dragNodes = cssQuery('[draggable=true]');
		for (var i = 0; i < dragNodes.length; i++) {
			var  dragNode=dragNodes[i]
			EventHelpers.addEvent(dragNode, 'dragstart', dragStartEvent);
		}
		
		/* These are events for the object to be dropped */
		EventHelpers.addEvent(targetNode, 'dragover', dragOverEvent);
		EventHelpers.addEvent(targetNode, 'drop', dropEvent);
	}
	
	

	
	function dragStartEvent(e) {
		/*e.dataTransfer.setData('Text',
			sprintf('<img src="%s" alt="%s" /><br /><p class="caption">%s</p>',
				this.src, this.alt, this.alt
			)
		);*/
		
		e.dataTransfer.effectAllowed='move';
		e.dataTransfer.setData("Files", e.target.getAttribute('id'));
		//e.dataTransfer.setDragImage(e.target, 0, 0);
		//console.log(e.currentTarget.src);
		draggedObject = e.currentTarget;
		return true;
	}
	
	
	function dragOverEvent(e) {
		EventHelpers.preventDefault(e);
	}
	
	
	function dropEvent(e) {
		var coords = DragDropHelpers.getEventCoords(e);

		this.innerHTML = e.dataTransfer.getData('Files');
		
		EventHelpers.preventDefault(e);
		problemImage = new Image();
		problemImage.onload = function()
		{
			var mousePos = getMousePos(targetNode, e);
			console.log(e);
			canvasContext = targetNode.getContext('2d');
			canvasContext.drawImage(problemImage, mousePos.x, mousePos.y, problemImage.width, problemImage.height);
			
			var data = e.dataTransfer.files;
			console.log(data);
		};
		
		problemImage.src = draggedObject.src;
	}
	
	function getMousePos(canvas, evt) {
        var rect = canvas.getBoundingClientRect();
        return {
          x: evt.clientX - rect.left,
          y: evt.clientY - rect.top
        };
      }
	
	
	
	
	
}

// fixes visual cues in IE and Chrome 3.0 and lower.
DragDropHelpers.fixVisualCues=true;

EventHelpers.addPageLoadEvent('dragObject.init');
