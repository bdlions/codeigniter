define(["jquery"], function($){
	var Jcarousellite = function(){};
        Jcarousellite.carouselify = function()
	{
            var btnPrev= ".prev";
            var btnNext= ".next";

            var speed= 200;
            var easing= null;

            var vertical= false;
            var circular= true;
            var visible= 1;
            var start= 0;
            var scroll= 1;

            var beforeStart= null;
            var afterEnd= null;

            return $(".carousel").each(function() 
            {                       // Returns the element collection. Chainable.
                    var curr = start, running = false, animCss=vertical?"top":"left", sizeCss=vertical?"height":"width";
                    var div = $(this), ul = div.find("ul"), li = div.find("li"), itemLength = li.size();                       

                    div.css("visibility", "visible");

                    li.css("overflow", "hidden")                        // If the list item size is bigger than required
                            .css("float", vertical ? "none" : "left")     // Horizontal list
                            .children().css("overflow", "hidden");          // If the item within li overflows its size, hide'em

                    ul.css("margin", "0")                               // Browsers apply default margin 
                            .css("padding", "0")                            // and padding. It is reset here.
                            .css("position", "relative")                    // IE BUG - width as min-width
                            .css("list-style-type", "none")                 // We dont need any icons representing each list item.
                            .css("z-index", "1");                           // IE doesnt respect width. So z-index smaller than div

                    div.css("overflow", "hidden")                       // Overflows - works in FF
                            .css("position", "relative")                    // position relative and z-index for IE
                            .css("z-index", "2")                            // more than ul so that div displays on top of ul
                            .css("left", "0px");                            // after creating carousel show it on screen

                    var liSize = vertical ? height(li) : width(li);   // Full li size(incl margin)-Used for animation
                    var ulSize = liSize * itemLength;                   // size of full ul(total length, not just for the visible items)
                    var divSize = liSize * visible;                   // size of entire div(total length for just the visible items)

                    li.css("width", li.width())                         // inner li width. this is the box model width
                            .css("height", li.height());                    // inner li height. this is the box model height

                    ul.css(sizeCss, ulSize+"px")                        // Width of the UL is the full length for all the images
                            .css(animCss, -(curr*liSize));                  // Set the starting item

                    div.css(sizeCss, divSize+"px");                     // Width of the DIV. length of visible images

                    if(btnPrev) {
                            $(btnPrev).click(function() { 
                                    return go(curr-scroll); 
                            });
                    }

                    if(btnNext) {
                            $(btnNext).click(function() { 
                                    return go(curr+scroll); 
                            });
                    }

                    function go(to) {
                            if(!running) {
                                    running = true;
                                    if(beforeStart) beforeStart.call(this, vis());

                                    if(to<0 && curr==0) {                                               // If first, then goto last
                                            if(circular) curr=itemLength-visible; 
                                            else return;
                                    } else if(to>=itemLength-visible && curr+visible>=itemLength) { // If last, then goto first
                                            if(circular) curr = 0; 
                                            else return;
                                    } else curr = to;

                                    ul.animate(
                                            animCss == "left" ? { left: -(curr*liSize) } : { top: -(curr*liSize) } , speed, easing,
                                            function() {
                                                    ul.css(animCss, -(curr*liSize)+"px");    // For some reason the animation was not making left:0
                                                    if(afterEnd) afterEnd.call(this, vis());
                                                    running = false;
                                            }
                                    );
                            }
                            return false;
                    };
            });

            function css(el, prop) {
            return parseInt($.css(el.jquery ? el[0] : el,prop)) || 0;
            };
            function width(el) {
                    return  el[0].offsetWidth + css(el, 'marginLeft') + css(el, 'marginRight');
            };
            function height(el) {
                    return el[0].offsetHeight + css(el, 'marginTop') + css(el, 'marginBottom');
            };
	}
	return Jcarousellite;
});