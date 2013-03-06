<?php
//Globals
global $themeblvd_footer_columns;
global $themeblvd_copyright;
global $themeblvd_theme_hints;
global $themeblvd_analytics;
?>

				<!-- FOOTER  (start) -->
				
				<div class="clear"></div>
				
				<?php if($themeblvd_footer_columns != 'hide') : ?>
				
				<div id="footer-top"><!-- --></div>
				
				<div id="footer">
					
					<div id="footer-inner">
					
						<?php if( $themeblvd_theme_hints == 'true' ) : ?>
				        	<?php echo themeblvd_theme_hints('footer'); ?>
				    	<?php endif; ?>
						
						<!-- Footer Widgets (start) -->

			            <?php themeblvd_widget_columns_display("footer", $themeblvd_footer_columns); ?>
			
			            <!-- Footer Widgets (end) -->
												
						<div class="clear"></div>
						
					</div><!-- #footer-inner (end) -->
					
				</div><!-- #footer (end) -->
				
				<div id="footer-bottom"><!-- --></div>
				
				<?php endif; ?>
				
				<!-- FOOTER (end) -->
				
				<div id="copyright">
					
					<div class="alignleft">
					
						<p><?php echo themeblvd_copyright(stripslashes($themeblvd_copyright)); ?></p>
					
					</div><!-- .left (end) -->
						
					<div class="alignright">
						
						<?php wp_nav_menu( array('container' => '', 'theme_location' => 'footer', 'fallback_cb' => '' ) ); ?>
												
					</div>
					
					<div class="clear"></div>
					
				</div><!-- #copyright (end) -->
				
			</div><!-- #main-inner (end) -->
			
		</div><!-- #main (end) -->
		
		<div id="main-bottom"><!-- --></div>
		
	</div><!-- #main-wrapper (end) -->
	
</div><!-- #wrapper (end) -->

<?php wp_footer(); ?>

<?php echo stripslashes($themeblvd_analytics); ?>

</body>
</html>