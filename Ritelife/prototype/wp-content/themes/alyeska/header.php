<?php
//General Layout
global $themeblvd_layout_body_style;
global $themeblvd_layout_body_shape;
global $themeblvd_layout_skin_color;
global $themeblvd_layout_skin_texture;
global $themeblvd_layout_menu_color;
global $themeblvd_layout_menu_shape;
global $themeblvd_layout_menu_search;


//General Options
global $themeblvd_custom_css;

//Logo
global $themeblvd_logo;
global $themeblvd_logo_image;

//Fonts
global $themeblvd_font_headers;
global $themeblvd_font_body;
global $themeblvd_font_size;

//SEO
global $themeblvd_seo_plugin;

//Theme Hints
global $themeblvd_theme_hints;
?>
<!DOCTYPE html>   
<html lang="en"> 
<head>
 <?php remove_role( 'subscriber' ); ?>
    <meta charset="<?php bloginfo('charset'); ?>" />

    <?php if ( get_option('blog_public') == 1 && $themeblvd_seo_plugin == 'true') : ?>
        <!-- ThemeBlvd SEO -->
        <?php global $seo; $seo->themeblvd_head(); ?>
    <?php else : ?>
        <!-- Default Title  -->
        <title><?php themeblvd_title(); ?></title>
    <?php endif; ?>

    <!-- CORE CSS -->
    <link rel="stylesheet" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
    
    <!-- Sortable Table CSS -->
    
    
    <!-- HEADER STYLE -->
    <link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/layout/css/skin/<?php echo $themeblvd_layout_skin_texture; ?>-<?php echo $themeblvd_layout_skin_color; ?>.css" />
    
    <!-- BODY SHAPE -->
    <link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/layout/css/shape/<?php echo $themeblvd_layout_body_shape; ?>-<?php echo $themeblvd_layout_body_style; ?>.css" />
    
    <!-- OVERALL STYLE -->
    <link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/layout/css/style/<?php echo $themeblvd_layout_body_style; ?>.css" />
    
    <!-- Font -->
    <?php themeblvd_font($themeblvd_font_headers, $themeblvd_font_body, $themeblvd_font_size); ?>
    
    <!-- Custom CSS -->
    <style type="text/css">
    <?php if( get_background_image() || get_background_color() ) : ?>
    #wrapper, body { background-color: transparent; background-image: none; }
    <?php endif; ?>
    <?php echo $themeblvd_custom_css; ?>
    </style>
    
    <!-- WP HEADER STUFF -->
    <?php wp_enqueue_script("jquery"); ?>
    <?php wp_head(); ?>
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
    
    <!-- JS -->
	<script src="<?php bloginfo('template_directory'); ?>/layout/js/tools.js"></script>
	<script src="<?php bloginfo('template_directory'); ?>/layout/js/easing.js"></script>
    <script src="<?php bloginfo('template_directory'); ?>/layout/plugins/prettyphoto/js/jquery.prettyPhoto.js"></script>
    <script src="<?php bloginfo('template_directory'); ?>/layout/js/swfobject.js"></script>
    <script src="<?php bloginfo('template_directory'); ?>/layout/js/cycle.js"></script>
    <script src="<?php bloginfo('template_directory'); ?>/layout/js/nivo.js"></script>
    <script src="<?php bloginfo('template_directory'); ?>/layout/js/accordion.js"></script>
    <script src="<?php bloginfo('template_directory'); ?>/layout/js/superfish.js"></script>
    <script src="<?php bloginfo('template_directory'); ?>/layout/js/validate.js"></script>
    <script src="<?php bloginfo('template_directory'); ?>/layout/js/custom.js"></script>
   	<script src="<?php bloginfo('template_directory'); ?>/layout/js/jquery.tablesorter.js"></script>

    <!-- Comments -->
    <?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>

    <!-- Meta Tags (for js) -->
    <meta name="template_url" content="<?php echo get_template_directory_uri(); ?>" />

<!-- GOOGLE ANALYTICS -->
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-26175360-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
	
</head>

<body <?php body_class(); ?>>

<div id="wrapper">

	<div id="header-wrapper">
		
		<?php if( $themeblvd_theme_hints == 'true' ) : ?>
        	<?php echo themeblvd_theme_hints('header'); ?>
    	<?php endif; ?>
		
		<div id="header">
			
			<?php if($themeblvd_logo == 'text') : ?>
	
	        <h1 id="logo-text">
	            <a href="<?php bloginfo('url'); ?>" title="<?php bloginfo('title'); ?>">
	                <?php bloginfo('title'); ?>
	            </a>
	        </h1>
	
	        <?php else : ?>
	
	        <a href="<?php bloginfo('url'); ?>" title="<?php bloginfo('title'); ?>" id="logo">
	            <?php if($themeblvd_logo_image) : ?>
	            <img src="<?php echo $themeblvd_logo_image; ?>" alt="<?php bloginfo('title'); ?>" />
	            <?php else : ?>
	            <img src="<?php bloginfo('template_directory'); ?>/layout/images/shared/logo.png" alt="<?php bloginfo('title'); ?>" />
	            <?php endif; ?>
	        </a>
	
	        <?php endif; ?>
			<div style="position:absolute; top:56px; left:270px;"><h2 style="color:#0C3775; display:inline;"><?php bloginfo('description'); ?></h2></div> 
			<?php echo alyeska_social(); ?><div style="position:absolute; right:25px; top:91px;"><a href="<?php bloginfo('url'); ?>/centre-business-opportunity"><img src="http://rite4life.com.au/prototype/wp-content/uploads/2011/09/centre.png" /></a></div>
						
			<div class="clear"></div>
			
		</div><!-- #header (end) -->
		
	</div><!-- #header-wrapper (end) -->

	<div id="main-wrapper">
		
		<div id="main-top"><!-- --></div>
		
		<div id="main-menu">
			
			<div id="menu-inner" class="<?php echo $themeblvd_layout_menu_shape; ?>-<?php echo $themeblvd_layout_menu_color; ?>">
			
				<div class="menu-left"><!-- --></div>
				
				<div class="menu-middle">
					
					<div class="menu-middle-inner">
					
						<?php wp_nav_menu( array('container' => '', 'theme_location' => 'primary', 'fallback_cb' => 'themeblvd_menu_fallback' ) ); ?>
						
						<?php if($themeblvd_layout_menu_search == 'show') : ?>
						
							<div id="search-popup-wrapper">

								<a href="#" title="" id="search-trigger">Search</a>
								
								<div class="search-popup-outer">
									<div class="search-popup">
									    <div class="search-popup-inner">
									        <form method="get" action="<?php bloginfo('url'); ?>">
									            <fieldset>
									                <input type="text" class="search-input" name="s" onblur="if (this.value == '') {this.value = '<?php _e('Search', 'themeblvd'); ?>';}" onfocus="if(this.value == '<?php _e('Search', 'themeblvd'); ?>') {this.value = '';}" value="<?php _e('Search', 'themeblvd'); ?>" />
									                <input type="submit" class="submit" value="" />
									            </fieldset>
									        </form>
									    </div><!-- .search-popup-inner (end) -->
									</div><!-- .search-popup (end) -->
								</div><!-- .search-popup-outer (end) -->
								
							</div><!-- #search-popup-wrapper (end) -->

						
						<?php endif; ?>
						
					</div><!-- .menu-middle-inner (end) -->
					
				</div><!-- .menu-middle (end) -->
				
				<div class="menu-right"><!-- --></div>
			
			</div><!-- #menu-inner (end) -->
			
		</div><!-- #main-menu (end) -->
		
		<div id="main">
			
			<div id="main-inner">