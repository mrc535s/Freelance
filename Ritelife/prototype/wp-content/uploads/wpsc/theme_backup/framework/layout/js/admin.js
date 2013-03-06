//ThemeBlvd Framework JS
jQuery.noConflict()(function($){

    $(document).ready(function(){

        //Contact Form Builder
        $(document).ready(function(){
            $(".contact-form-builder tr:even").css("background-color", "#f2f2f2");
        });

        //Help box open
        $("a.jaybich-open").click(function(){
            $($(this).attr('href')).fadeIn('normal');
            return false;
		});

        //Help box close
        $('a.jaybich-close').click(function() {
            $($(this).attr('href')).fadeOut();
            return false;
        });

        //Clear uploaded file field
        $('a.themeblvd-file-remove').click(function() {
            $($(this).attr('href')).fadeOut();
            var field = $(this).parent().parent().find('input.upload');
            $(field).val('');
            return false;
        });

        //Theme Options tabs UI
        $(".themeblvd-tab").hide();
        $(".themeblvd-menu ul li:first").addClass("active").show();
        $(".themeblvd-tab:first").show();

        $(".themeblvd-menu ul li").click(function() {
            $(".themeblvd-menu ul li").removeClass("active");
            $(this).addClass("active");
            $(".themeblvd-tab").hide();
            $(".themeblvd-options-load").hide();
            var activeTab = $(this).find("a").attr("href");
            $(activeTab).fadeIn(); 
            return false;
        });
	    
        //Body font preview
		var body_fonts = new Array();
		
		body_fonts['arial'] = 'Arial, "Helvetica Neue", Helvetica, sans-serif';
		body_fonts['baskerville'] = 'Baskerville, "Times New Roman", Times, serif';
		body_fonts['cambria'] = 'Cambria, Georgia, Times, "Times New Roman", serif';
		body_fonts['century-gothic'] = '"Century Gothic", "Apple Gothic", sans-serif';
		body_fonts['consolas'] = 'Consolas, "Lucida Console", Monaco, monospace';
		body_fonts['copperplate-light'] = '"Copperplate Light", "Copperplate Gothic Light", serif';
		body_fonts['courier-new'] = '"Courier New", Courier, monospace';
		body_fonts['franklin'] = '"Franklin Gothic Medium", "Arial Narrow Bold", Arial, sans-serif';
		body_fonts['futura'] = 'Futura, "Century Gothic", AppleGothic, sans-serif';
		body_fonts['garamond'] = 'Garamond, "Hoefler Text", Times New Roman, Times, serif';
		body_fonts['geneva'] = 'Geneva, "Lucida Sans", "Lucida Grande", "Lucida Sans Unicode", Verdana, sans-serif';
		body_fonts['georgia'] = 'Georgia, Palatino," Palatino Linotype", Times, "Times New Roman", serif';
		body_fonts['gill-sans'] = '"Gill Sans", Calibri, "Trebuchet MS", sans-serif';
		body_fonts['helvetica'] = '"Helvetica Neue", Arial, Helvetica, sans-serif';
		body_fonts['impact'] = 'Impact, Haettenschweiler, "Arial Narrow Bold", sans-serif';
		body_fonts['lucida'] = '"Lucida Sans", "Lucida Grande", "Lucida Sans Unicode", sans-serif'
		body_fonts['palatino'] = 'Palatino, "Palatino Linotype", Georgia, Times, "Times New Roman", serif';
		body_fonts['tahoma'] = 'Tahoma, Geneva, Verdana';
		body_fonts['times'] = 'Times, "Times New Roman", Georgia, serif';
		body_fonts['trebuchet'] = '"Trebuchet MS", "Lucida Sans Unicode", "Lucida Grande", "Lucida Sans", Arial, sans-serif';
		body_fonts['verdana'] = 'Verdana, Geneva, Tahoma, sans-serif';
		
		$('#themeblvd_font_body_preview select').change(function() {
		  	
		  	var selected_body_font = $('#themeblvd_font_body_preview select option:selected').val();
		  	$('#themeblvd_font_body_preview .themeblvd-body-font-preview').css('font-family', body_fonts[selected_body_font] );
		  	
        });
        
        //Header font preview
		$('#themeblvd_font_headers_preview select').change(function() {

			$('.temp-header-font').remove();

		  	var selected_header_font = $('#themeblvd_font_headers_preview select option:selected').val();
		  	
		  	if(selected_header_font == 'none'){
		  		
		  		if(!selected_body_font){
		  			var selected_body_font = $('#themeblvd_font_body_preview select option:selected').val();
		  		}
		  		
		  		$('#themeblvd_font_headers_preview .themeblvd-header-font-preview').css('font-family', body_fonts[selected_body_font] );
		  		
		  	} else {
		  	
		  		var google_include = '<link href="http://fonts.googleapis.com/css?family=' + selected_header_font + '" rel="stylesheet" type="text/css" class="temp-header-font" />';
		  	
			  	$('#themeblvd_font_headers_preview').prepend(google_include);
			  	
			  	selected_header_font = selected_header_font.replace(/\+/g, " ");
			  	selected_header_font = selected_header_font.split(":");
			  	selected_header_font = selected_header_font[0];
			  	
			  	$('#themeblvd_font_headers_preview .themeblvd-header-font-preview').css('font-family', selected_header_font );
		  	
		  	}
		  	
        });

		
    });

});

//Update message
(function($){
    $.fn.themeblvdUpdate = function() {

        var $this = $(this);

        $this.fadeIn();
        window.setTimeout(function(){
            $this.fadeOut();
        }, 2000);

        return this;
    }
})(jQuery);


//Upload Option
(function ($) {
  uploadOption = {
    init: function () {
      
      // On Click
      $('.upload_button').live("click", function () {
        tb_show('', 'media-upload.php?type=image&amp;TB_iframe=1');
        return false;
      });
    }
  };
  $(document).ready(function () {
    uploadOption.init()
  })
})(jQuery);