// ---------------------------------------------------------
// Slideshow Navigation
// ---------------------------------------------------------

function paginate(idx, slide){
    return '<li><a href="" title="">#</a></li>';
}

// ---------------------------------------------------------
// jQuery
// ---------------------------------------------------------

jQuery.noConflict()(function($){

	$(document).ready(function() { 
		
		// ---------------------------------------------------------
		// Header Social Icons
		// ---------------------------------------------------------
		
		$("#header .social-icons a").tooltip({ effect: 'slide', position: 'bottom center', opacity: .5 });
		
		// ---------------------------------------------------------
		// Main Menu
		// ---------------------------------------------------------
		
		$('#main-menu .menu').superfish({
			dropShadows: false
		});
				
		// ---------------------------------------------------------
		// Headers
		// ---------------------------------------------------------
		
		$("h1").each(function(){
		
		    $(this).prepend("<span></span>");
		
		});
		
		$(".widget h2").each(function(){
		
		    $(this).prepend("<span></span>");
		
		});
		
		$("#footer h4").each(function(){
		
		    $(this).prepend("<span></span>");
		
		});
		
		$(".entry h1 span, .page h1 span").each(function(){
		
		    $(this).remove();
		
		});
		
		// ---------------------------------------------------------
		// Contact Form
		// ---------------------------------------------------------
		
		//If you need to translate form validation error messages, you can do so here.
		$.extend($.validator.messages, {
			required: 	"This field is required.",
			email: 		"Please enter a valid email address.",
			url: 		"Please enter a valid URL.",
			digits: 	"Please enter only digits."
		});
		
		//Define URL to PHP mail file
		url = $("meta[name=template_url]").attr('content') + "/sendmail.php";
		
		//Activate $ form validation
		$("#jaybich-contact").validate({
		
		    submitHandler: function() {
		
		        //Define data string
		        var datastring = $("#jaybich-contact").serialize();
		
		        //Submit form
		        $.ajax({
		            type: "POST",
		            url: url,
		            data: datastring,
		            success: function(){
		                    $('#jaybich-contact').slideUp();
		                    $('#sent').fadeIn();
		            }
		        });
		    }
		
		});
		
		// ---------------------------------------------------------
		// Comments Form
		// ---------------------------------------------------------
		
		$("#commentform .comment-form-author input").addClass('required');
		$("#commentform .comment-form-email input").addClass('required');
		$("#commentform .comment-form-comment textarea").addClass('required');
		$("#commentform").validate();
		
		$('.comment-body').each(function(){
			
			$(this).addClass('page');
			$(this).prepend('<div class="top"><!-- --></div>');
			$(this).append('<div class="bottom"><!-- --></div>');
			
		});
		
		// ---------------------------------------------------------
		// Portfolio Thumbnail
		// ---------------------------------------------------------
		
		$('.portfolio-box a.thumb').each(function(){
		    if(this.href.match(/\.(jpe?g|png|bmp|gif|tiff?)$/i)){
		        $(this).addClass('image');
		    } else {
		        $(this).addClass('video');
		    }
		});
		
		$('.portfolio-box a').hover(function() {
		
		    //Show darkenned hover over thumbnail image
		    $(this).find('img').stop(true, true).animate({opacity:0.5},400);
		
		}, function() {
		
		    //Hide darkenned hover over thumbnail image
		    $(this).find('img').stop(true, true).animate({opacity:1},400);
		
		});
		
		// ---------------------------------------------------------
		// Wordpress Gallery Lightbox Integration
		// ---------------------------------------------------------
		
		$('.gallery').addClass('block');
		
		$('.gallery').append('<div class="clear"></div>');
		
		$('.gallery-item a').each(function(){
		    if(this.href.match(/\.(jpe?g|png|bmp|gif|tiff?)$/i)){
		        $(this).attr('rel','lightbox[gallery]');
		        $(this).addClass('image-button');
		    }
		});
		
		$('.gallery-item a img').each(function(){
			$(this).addClass('pretty');
		});
		
		// ---------------------------------------------------------
		// Image Buttons
		// ---------------------------------------------------------
		
		$('.image-button img').hover(function() {
		
		    $(this).stop(true, true).animate({opacity:.75},100);
		
		}, function() {
		
		    $(this).stop(true, true).animate({opacity:1},100);
		
		});
		
		// ---------------------------------------------------------
		// Post Thumbnails
		// ---------------------------------------------------------
		
		$('a.post-thumb img').hover(function() {
		
		    $(this).stop(true, true).animate({opacity:.75},150);
		
		}, function() {
		
		    $(this).stop(true, true).animate({opacity:1},150);
		
		});
		
		// ---------------------------------------------------------
		// Tabs
		// ---------------------------------------------------------
		
		$(".themeblvd-tabs").each(function(){
		
		    $(this).find(".tab").hide();
		    $(this).find(".tab-menu li:first a").addClass("active").show();
		    $(this).find(".tab:first").show();
		
		});
		
		$(".themeblvd-tabs").each(function(){
		
		    $(this).find(".tab-menu a").click(function() {
		
		        $(this).parent().parent().find("a").removeClass("active");
		        $(this).addClass("active");
		        $(this).parent().parent().parent().parent().find(".tab").hide();
		        var activeTab = $(this).attr("href");
		        $(activeTab).fadeIn();
		        return false;
		
		    });
		
		});
		
		// ---------------------------------------------------------
		// Toggle
		// ---------------------------------------------------------
		
		$(".themeblvd-toggle").each(function(){
		
		    $(this).find(".box").hide();
		
		});
		
		$(".themeblvd-toggle").each(function(){
		
		    $(this).find(".trigger").click(function() {
		
		        $(this).toggleClass("active").next().stop(true, true).slideToggle("slow");
		
		        return false;
		
		    });
		
		});
		
		// ---------------------------------------------------------
		// Innititate Pretty Photo
		// ---------------------------------------------------------
		
		$("a[rel^='lightbox']").prettyPhoto({
		        theme: 'light_square', /* light_rounded / dark_rounded / light_square / dark_square / facebook */
		        show_title: false
		});
		
		// ---------------------------------------------------------
		// Main Menu Search
		// ---------------------------------------------------------
		
		$("#search-trigger").click(function(){ return false; });
		
		$('#search-popup-wrapper').each(function () {
		
		    var distance = 10;
		    var time = 250;
		    var hideDelay = 500;
		
		    var hideDelayTimer = null;
		
		    var beingShown = false;
		    var shown = false;
		    var trigger = $('#search-trigger', this);
		    var info = $('.search-popup-outer', this).css('opacity', 0);
		
		
		    $([trigger.get(0), info.get(0)]).mouseover(function () {
		        if (hideDelayTimer) clearTimeout(hideDelayTimer);
		        if (beingShown || shown) {
		            // don't trigger the animation again
		            return;
		        } else {
		            // reset position of info box
		            beingShown = true;
					
		            info.css({
		                bottom: 5,
		                right: -12,
		                display: 'block'
		            }).animate({
		                bottom: '+=' + distance + 'px',
		                opacity: 1,
		                filter: '' //IE Transparency Hack
		            }, time, 'swing', function() {
		                beingShown = false;
		                shown = true;
		            });
		        }
		
		        return false;
		        
		    }).mouseout(function () {
		    
		        if (hideDelayTimer) clearTimeout(hideDelayTimer);
		        hideDelayTimer = setTimeout(function () {
		            hideDelayTimer = null;
		            info.animate({
		                bottom: '+=' + distance + 'px',
		                opacity: 0,
		                filter: '' //IE Transparency Hack
		            }, time, 'swing', function () {
		                shown = false;
		                info.css('display', 'none');
		            });
		
		        }, hideDelay);
		
		        return false;
		    });
		});

	}); //End DOM Ready
	
}); //End jQuery

// ---------------------------------------------------------
// Twitter Widget
// ---------------------------------------------------------

(function(jQuery) {
	/*
		jquery.twitter.js v1.5
		Last updated: 08 July 2009

		Created by Damien du Toit
		http://coda.co.za/blog/2008/10/26/jquery-plugin-for-twitter

		Licensed under a Creative Commons Attribution-Non-Commercial 3.0 Unported License
		http://creativecommons.org/licenses/by-nc/3.0/
	*/

	jQuery.fn.getTwitter = function(options) {

		jQuery.fn.getTwitter.defaults = {
			userName: null,
			numTweets: 5,
			loaderText: "Loading tweets...",
			slideIn: true,
			slideDuration: 750,
			showHeading: true,
			headingText: "Latest Tweets",
			showProfileLink: true,
			showTimestamp: true
		};

		var o = jQuery.extend({}, jQuery.fn.getTwitter.defaults, options);

		return this.each(function() {
			var c = jQuery(this);

			// hide container element, remove alternative content, and add class
			c.hide().empty().addClass("twitted");

			// add heading to container element
			if (o.showHeading) {
				c.append("<h2>"+o.headingText+"</h2>");
			}

			// add twitter list to container element
			var twitterListHTML = "<ul id=\"twitter_update_list\"><li></li></ul>";
			c.append(twitterListHTML);

			var tl = jQuery("#twitter_update_list");

			// hide twitter list
			tl.hide();

			// add preLoader to container element
			var preLoaderHTML = jQuery("<p class=\"preLoader\">"+o.loaderText+"</p>");
			c.append(preLoaderHTML);

			// add Twitter profile link to container element
			if (o.showProfileLink) {
				var profileLinkHTML = "<p class=\"profileLink\"><a href=\"http://twitter.com/"+o.userName+"\">http://twitter.com/"+o.userName+"</a></p>";
				c.append(profileLinkHTML);
			}

			// show container element
			c.show();

			jQuery.getScript("http://twitter.com/javascripts/blogger.js");
			jQuery.getScript("http://twitter.com/statuses/user_timeline/"+o.userName+".json?callback=twitterCallback2&count="+o.numTweets, function() {
				// remove preLoader from container element
				jQuery(preLoaderHTML).remove();

				// remove timestamp and move to title of list item
				if (!o.showTimestamp) {
					tl.find("li").each(function() {
						var timestampHTML = jQuery(this).children("a");
						var timestamp = timestampHTML.html();
						timestampHTML.remove();
						jQuery(this).attr("title", timestamp);
					});
				}

				// show twitter list
				if (o.slideIn) {
					// a fix for the jQuery slide effect
					// Hat-tip: http://blog.pengoworks.com/index.cfm/2009/4/21/Fixing-jQuerys-slideDown-effect-ie-Jumpy-Animation
					var tlHeight = tl.data("originalHeight");

					// get the original height
					if (!tlHeight) {
						tlHeight = tl.show().height();
						tl.data("originalHeight", tlHeight);
						tl.hide().css({height: 0});
					}

					tl.show().animate({height: tlHeight}, o.slideDuration);
				}
				else {
					tl.show();
				}

				// add unique class to first list item
				tl.find("li:first").addClass("firstTweet");

				// add unique class to last list item
				tl.find("li:last").addClass("lastTweet");
			});
		});
	};
})(jQuery);