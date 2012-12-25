$.fn.imageSelector = function( o ) 
{
	var btnPrev = o.btnPrev;
	var btnNext = o.btnNext;
	var btnGo = o.btnGo;
	var mouseWheel = o.mouseWheel;
	var auto = o.auto;

	var speed = 200;
	var easing = null;

	var vertical = false;
	var circular = false;
	var visible = 4;
	var start = 0;
	var scroll = 1;

	var beforeStart = null;
	var afterEnd = null;

	var div = $(this);
    return this.each(function() 
	{  
        var running = false, animCss = vertical?"top":"left", sizeCss = vertical?"height":"width";
        var ul = $("ul", div), tLi = $("li", ul), tl = tLi.size(), v = visible;

        if(circular) 
		{
            ul.prepend(tLi.slice(tl-v-1+1).clone())
              .append(tLi.slice(0,v).clone());
            start += v;
        }

        var li = $("li", ul), itemLength = li.size(), curr = start;
        div.css("visibility", "visible");

        li.css({overflow: "hidden", float: vertical ? "none" : "left"});
        ul.css({margin: "0", padding: "0", position: "relative", "list-style-type": "none", "z-index": "1"});
        div.css({overflow: "hidden", position: "relative", "z-index": "2", left: "0px"});

        var liSize = vertical ? height(li) : width(li);   
        var ulSize = liSize * itemLength;                   
        var divSize = liSize * v;                           

        li.css({width: li.width(), height: li.height()});
        ul.css(sizeCss, ulSize+"px").css(animCss, -(curr*liSize));

        div.css(sizeCss, divSize+"px");                    

        if(btnPrev)
            $(btnPrev).click(function() {
                return go(curr-scroll);
            });

        if(btnNext)
            $(btnNext).click(function() {
				console.log("btnNext");
                return go(curr+scroll);
            });

        if(btnGo)
            $.each(btnGo, function(i, val) {
                $(val).click(function() {
                    return go(circular ? visible+i : i);
                });
            });

        if(mouseWheel && div.mousewheel)
            div.mousewheel(function(e, d) {
                return d>0 ? go(curr-scroll) : go(curr+scroll);
            });

        if(auto)
            setInterval(function() {
                go(curr+scroll);
            }, auto+speed);

        function vis() {
            return li.slice(curr).slice(0,v);
        };

        function go(to) {
            if(!running) {

                if(beforeStart)
                    beforeStart.call(this, vis());

                if(circular) {           
                    if(to<=start-v-1) {          
                        ul.css(animCss, -((itemLength-(v*2))*liSize)+"px");
                        
                        curr = to==start-v-1 ? itemLength-(v*2)-1 : itemLength-(v*2)-scroll;
                    } else if(to>=itemLength-v+1) { 
                        ul.css(animCss, -( (v) * liSize ) + "px" );
                        curr = to==itemLength-v+1 ? v+1 : v+scroll;
                    } else curr = to;
                } else {                   
                    if(to<0 || to>itemLength-v) return;
                    else curr = to;
                }                          

                running = true;

                ul.animate(
                    animCss == "left" ? { left: -(curr*liSize) } : { top: -(curr*liSize) } , speed, easing,
                    function() {
                        if(afterEnd)
                            afterEnd.call(this, vis());
                        running = false;
                    }
                );
                
                if(!circular) {
                    $(btnPrev + "," + btnNext).removeClass("disabled");
                    $( (curr-scroll<0 && btnPrev)||(curr+scroll > itemLength-v && btnNext)||[]).addClass("disabled");
                }

            }
            return false;
        };
		
		function css(el, prop) {
			console.log("css");
			return parseInt($.css(el[0], prop)) || 0;
		};
		function width(el) {
			return  el[0].offsetWidth + css(el, 'marginLeft') + css(el, 'marginRight');
		};
		function height(el) {
			return el[0].offsetHeight + css(el, 'marginTop') + css(el, 'marginBottom');
		};
    });
};



