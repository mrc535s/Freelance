<?php
/**
 *
 * ThemeBlvd WordPress Theme Framework
 * Admin Head
 *
 * This file contains everything that gets included in the
 * WordPress administrator's head when the theme is activated.
 *
 * @author  Jason Bobich
 *
 */

##############################################################
# Include JS/CSS files in WP admin head
##############################################################

function themeblvd_admin_enqueue() {
	
    $template_url = get_template_directory_uri();

    //CSS
    wp_enqueue_style('thickbox');
    wp_enqueue_style('theme_colorpicker_styles', $template_url.'/framework/layout/css/colorpicker.css', false, false, 'screen');
    wp_enqueue_style('theme_styles', $template_url.'/framework/layout/css/admin.css', false, false, 'screen');

    //JS
    wp_enqueue_script('jquery-ui-sortable');
    wp_enqueue_script('thickbox');
    wp_enqueue_script('media-upload');
    wp_enqueue_script('theme_colorpicker_script', $template_url . '/framework/layout/js/colorpicker.js', array('jquery'), false );
    wp_enqueue_script('theme_eye_script', $template_url . '/framework/layout/js/eye.js', array('jquery'), false );
    wp_enqueue_script('theme_script', $template_url . '/framework/layout/js/admin.js', array('jquery'), false );
    
}

add_action('admin_init', 'themeblvd_admin_enqueue');

##############################################################
# Include JS for saving theme options in WP admin head
##############################################################

function themeblvd_admin_head() {
	
	global $themeblvd_options;
	
	?>
	
	<script type="text/javascript">
	
		//Save Theme Options
		jQuery.noConflict()(function($){
		
			$(document).ready(function(){
			
				//Saved options message
				$.fn.position_it = function () {
					this.animate({"top":( $(window).height() - this.height() - 200 ) / 2+$(window).scrollTop() + "px"},100);
					this.css("left", 250 );
					return this;
				}
				
				$('#themeblvd-options-save').position_it();
				$('#themeblvd-options-reset').position_it();
				$(window).scroll(function() { 
				
					$('#themeblvd-options-save').position_it();
					$('#themeblvd-options-reset').position_it();
				
				});
			
				$('#themeblvd-options-form').submit(function(){
					
					$('.themeblvd-options-load').fadeIn();
					
					//Serializ data from submitted form
					function updated_values() {
						
						//Data from options form
						var serialized_values = $("#themeblvd-options-form").serialize();
						
						//Sortable Elements from options form					
						$(".themeblvd-sortable").each(function(){
						    serialized_values += '&' + $(this).sortable('serialize');
						});
						
						return serialized_values;
					}
					
					var serialized_return = updated_values();
					
					//WP AJAX URL
					var ajax_url = '<?php echo admin_url("admin-ajax.php"); ?>';
					
					//Setup Data for ajax call
					var data = {
						action: 'themeblvd_ajax_save',
						data: serialized_return
					};
					
					//Post data with ajax
					$.post(ajax_url, data, function(response) {
					
						var success = $('#themeblvd-options-save');
						var loading = $('.themeblvd-options-load');
						loading.fadeOut();  
						success.fadeIn();
						window.setTimeout(function(){
						   success.fadeOut();   	
						}, 2500);
						
						<?php
						//If new image URL's are inserted, show them.
						foreach($themeblvd_options as $option){
							
							if($option['type'] == 'upload'){
								
								?>
						//Image URL	
						var image_url = $('#<?php echo $option['id']; ?>').val();
						
						//Remove previous elements
						$('#<?php echo $option['id']; ?>_image img').remove();
						$('#<?php echo $option['id']; ?>_image .warning').remove();
						$('#<?php echo $option['id']; ?>_image').hide();
						
						//If there's an image url
						if(image_url){
							
							//Create HTML to be displayed
							var uploaded_image_display = '<img src="' + image_url + '" width="300" />';
							
							//Append that HTML
							$('#<?php echo $option['id']; ?>_image').prepend(uploaded_image_display);
							
							//Show the HTML
							$('#<?php echo $option['id']; ?>_image').show();

						} //end if(image_url)
									
								<?php
								
							} //end if($option['type'])
						
						} //end foreach($themeblvd_options)
						
						?>
						
					});
					
					return false; 
					
				});
			
			});
		});
		
	</script>
	<?php
}

add_action('admin_head', 'themeblvd_admin_head');

##############################################################
# Handle ajax save of theme options
##############################################################

add_action('wp_ajax_themeblvd_ajax_save', 'themeblvd_ajax_callback');

function themeblvd_ajax_callback(){
	
	$data = $_POST['data'];
	parse_str($data, $options);    
    
    foreach ($options as $key => $value) {
		
		if( is_array($value) ){
		
			//Update option containing array
			update_option( $key, $value );
		
		} else {
		
			//Update standard option
			update_option( $key, stripslashes($value) );
		
		}

	}
	
}
?>