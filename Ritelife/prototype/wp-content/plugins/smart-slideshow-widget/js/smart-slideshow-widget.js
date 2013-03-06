
function module(number, mod){
	if(number >= 0){
		return number % mod;
	}
	else{
		var aux = number;
		while(aux < 0){
			aux = mod - Math.abs(aux);
		}
		return aux;
	}

}

var timer=new Array();
var it=new Array();

function showImages(widget_id, iteration, dly, cnt, mode, speed, automatic, reverse){
	var current = 'ssw_img_' + widget_id + '_' + module(iteration, cnt);
	var previous ='ssw_img_' + widget_id + '_' + module(iteration+1, cnt);
	
	if(reverse){
		previous ='ssw_img_' + widget_id + '_' + module(iteration-1, cnt);
	}
	
	var random = false;
	
	if(mode == 0){
		random = true;
		mode = Math.floor(Math.random()*10) + 1;
	}
	
	if(speed == '' || speed <= 0){
		speed = 800;
	}

	switch(mode){
		// Fade
		case 1:
			jQuery('#'+current).effect( 'fade', {}, speed );
			jQuery('#'+previous).fadeIn(speed);
			//new Effect.Fade(current);
			//new Effect.Appear(previous);
			break;
		// Curtain Up
		case 2:
			jQuery('#'+previous).fadeIn(speed);
			jQuery('#'+current).effect( 'fold', {}, speed );
			//new Effect.Appear(current);
			//new Effect.BlindUp(previous);
			break;
		// Double Blind
		case 3:	
			jQuery('#'+current).hide("slide", { direction: "up" }, speed);
			jQuery('#'+previous).show("slide", { direction: "up" }, speed);
			break;
		// Shrink
		case 4:	
			jQuery('#'+current).hide("scale", {percent: 1, scale: "box"}, speed);
			jQuery('#'+previous).show("scale", {percent: 100, scale: "box"}, speed);
			//new Effect.Shrink(current);
			//new Effect.Appear(previous);
			break;
		// Switch Off
		case 5:
			jQuery('#'+current).effect( "clip", {}, speed );	
			jQuery('#'+previous).fadeIn(speed);
			//new Effect.SwitchOff(current);
			//new Effect.Appear(previous, { delay: 0.35});
			break;
		// Bounce Down
		case 6:	
			jQuery('#'+current).hide("slide", { direction: "down" }, speed);
			jQuery('#'+previous).show("slide", { direction: "down" }, speed);
			//new Effect.SlideDownOut(current);
			//new Effect.SlideUpIn(previous, { delay: 0.2});
			break;
		// Slide Left
		case 7:
			jQuery('#'+current).hide("slide", { direction: "left" }, speed);
			jQuery('#'+previous).show("slide", { direction: "right" }, speed);	
			//new Effect.SlideLeftOut(current);
			//new Effect.SlideLeftIn(previous, { delay: 0.3});
			break;
		// Slide Right
		case 8:	
			jQuery('#'+current).hide("slide", { direction: "right" }, speed);
			jQuery('#'+previous).show("slide", { direction: "left" }, speed);
			//new Effect.SlideRightOut(current);
			//new Effect.SlideRightIn(previous, { delay: 0.2});
			break;
		// Slide Up
		case 9:	
			jQuery('#'+current).hide("slide", { direction: "up" }, speed);
			jQuery('#'+previous).show("slide", { direction: "down" }, speed);
			//new Effect.SlideUpOut(current);
			//new Effect.SlideUpIn(previous, { delay: 0.1});
			break;
		// Slide Down
		case 10:	
			jQuery('#'+current).hide("slide", { direction: "down" }, speed);
			jQuery('#'+previous).show("slide", { direction: "up" }, speed);
			//new Effect.SlideDownOut(current);
			//new Effect.SlideDownIn(previous, { delay: 0.1});
			break;
		
	}
	
	if(random){
		mode = 0;
	}
	
	if(!reverse){
		it[widget_id] = iteration + 1;
	}
	else{
		it[widget_id] = iteration - 1;
	}
	
	if(automatic){
		timer[widget_id] = setTimeout("showImages("+widget_id+", "+it[widget_id]+", "+dly+", "+cnt+", " + mode + ", " + speed + ", 1, 0)", dly);
	}
}

function runSlideshow(widget_id, mode, speed, notautorun){
	var count = jQuery('#ssw_counter_' + widget_id).html();
	var delay = jQuery('#ssw_delay_' + widget_id).html();
	delay = delay * 1000;

	jQuery('#ssw_img_' + widget_id + '_0').show();
	
	if(!notautorun){
		setTimeout("showImages(" + widget_id + ", 0, "+delay+", "+count+", " + mode + ", " + speed + ", 1, 0)", delay);
	}
}

function prevSlide(widget_id, mode, speed){
	var count = jQuery('#ssw_counter_' + widget_id).html();
	
	clearInterval(timer[widget_id]);
	showImages(widget_id, it[widget_id], 0, count, mode, speed, 0, 1);
}

function nextSlide(widget_id, mode, speed){
	var count = jQuery('#ssw_counter_' + widget_id).html();
	
	clearInterval(timer[widget_id]);
	showImages(widget_id, it[widget_id], 0, count, mode, speed, 0, 0);
}

jQuery(document).ready(function(){
	jQuery('.ssw_main').each(function(index){	
		jQuery(this).hover(function(){
			jQuery(this).children('.ssw_arrow').each(function(index){
				jQuery(this).fadeIn(800);
			});
		},
						function(){
			jQuery(this).children('.ssw_arrow').each(function(index){
				jQuery(this).fadeOut(500);
			});
		}
		);
	
	});

});

