<?php 
/*
Template Name: Recipes Categories
*/
?>
<?php if ( is_user_logged_in() ) : ?>
<?php include(TEMPLATEPATH."/header2.php");?>
<?php else: ?>
<?php include(TEMPLATEPATH."/header.php");?>
<?php endif; ?>

<div id="full-width-content">
	
	<?php themeblvd_breadcrumbs(); ?>
	
	<?php if( $themeblvd_theme_hints == 'true' ) : ?>
        <?php echo themeblvd_theme_hints('page-full-width'); ?>
    <?php endif; ?>
	
	<?php the_post(); ?>
	
	<?php if( get_post_meta($post->ID, 'themeblvd_pagetitle', true) != 'false' ) : ?>
	<h1><?php the_title(); ?></h1>
	<?php endif; ?>
	
	<div class="page">
		
		<div class="top"><!-- --></div>
			
			<img src="http://rite4life.com.au/prototype/wp-content/uploads/2011/12/recipes.jpg" /><br/><br/>

    <div class="themeblvd-tabs" style="min-height:200px;">
      <div class="tab-menu">
        <ul>
          <li><a href="#tab1" onclick="return false;" class="active">Beef/Pork/Lamb</a></li>
          <li><a href="#tab2" onclick="return false;" class="">Poultry</a></li>
          <li><a href="#tab3" onclick="return false;" class="">Fish/Seafood</a></li>
          <li><a href="#tab4" onclick="return false;" class="">Vegetables</a></li>
          <li><a href="#tab5" onclick="return false;" class="">Desserts</a></li>
          <li><a href="#tab6" onclick="return false;" class="">Other</a></li>
          
        </ul>
        <div class="clear"></div>
      </div>
      <!-- .tab-menu (end) -->


      <div class="tab-wrapper">
<!-- Beef/Pork/Lamb Tab -->
        <div class="tab" id="tab1" style="display: block; overflow:auto;">
          <?php query_posts('cat=17&posts_per_page=50'); ?>
          <?php if (have_posts()) : ?>
   <?php while (have_posts()) : the_post(); ?><div style="float:left; width:25%; height:220px;"> 
   <p style="text-align:center; width:194px;"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_post_thumbnail('large');?><br/><?php the_title(); ?></a></p></div>
   <?php endwhile; endif; wp_reset_query(); ?>
    </div>
        <!-- .tab (end) -->
        
<!-- Poultry Tab -->
          <div class="tab" id="tab2" style="display: none; overflow:auto;">
          <?php query_posts('cat=22&posts_per_page=50'); ?>
          <?php if (have_posts()) : ?>
   <?php while (have_posts()) : the_post(); ?><div style="float:left; width:25%; height:220px;"> 
   <p style="text-align:center; width:194px;"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_post_thumbnail('large');?><br/><?php the_title(); ?></a></p></div>
   <?php endwhile; endif; wp_reset_query(); ?>
</div>
        <!-- .tab (end) -->
      
      
<!-- Fish/Seafood Tab -->      
      <div class="tab" id="tab3" style="display: none; overflow:auto;">
          <?php query_posts('cat=20&posts_per_page=50'); ?>
         <?php if (have_posts()) : ?>
   <?php while (have_posts()) : the_post(); ?><div style="float:left; width:25%;  height:220px;"> 
   <p style="text-align:center; width:194px;"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_post_thumbnail('large');?><br/><?php the_title(); ?></a></p></div>
   <?php endwhile; endif; wp_reset_query(); ?>
      </div>  

<!-- .tab (end) -->
     
<!-- Vegetables Tab -->      
        <div class="tab" id="tab4" style="display: none; overflow:auto;">
          <?php query_posts('cat=21&posts_per_page=50'); ?>
         <?php if (have_posts()) : ?>
   <?php while (have_posts()) : the_post(); ?><div style="float:left; width:25%; height:220px;"> 
   <p style="text-align:center; width:194px;"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_post_thumbnail('large');?><br/><?php the_title(); ?></a></p></div>
   <?php endwhile; endif; wp_reset_query(); ?>
        </div><!-- .tab (end) -->
     
 <!-- Dessert Tab -->     
        <div class="tab" id="tab5" style="display: none; overflow:auto;">
         <?php query_posts('cat=19&posts_per_page=50'); ?>
         <?php if (have_posts()) : ?>
   <?php while (have_posts()) : the_post(); ?><div style="float:left; width:25%; height:220px;"> 
   <p style="text-align:center; width:194px;"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_post_thumbnail('large');?><br/><?php the_title(); ?></a></p><br/></div>
   <?php endwhile; endif; wp_reset_query(); ?>
        </div><!-- .tab (end) -->
 
<!-- Other Tab -->    
        <div class="tab" id="tab6" style="display: none; overflow:auto;">
          <?php query_posts('cat=18&posts_per_page=50'); ?>
         <?php if (have_posts()) : ?>
   <?php while (have_posts()) : the_post(); ?><div style="float:left; width:25%; height:220px;"> 
   <p style="text-align:center; width:194px;"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_post_thumbnail('large');?><br/><?php the_title(); ?></a></p></div>
   <?php endwhile; endif; wp_reset_query(); ?>
        </div><!-- .tab (end) -->
     





      <!-- .tab-wrapper (end) -->
      </div>
		
		<div class="clear"></div>
		
		<div class="bottom"><!-- --></div>
		
	</div><!-- .page (end) -->


	
</div><!-- #full-width-content (end) -->

<?php get_footer(); ?>