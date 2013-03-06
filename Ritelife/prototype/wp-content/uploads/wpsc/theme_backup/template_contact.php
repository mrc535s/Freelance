<?php
/*

Template Name: Contact Form

Customizations:
On your theme options page, you can add up to three
additional fields to your contact form. However, if
you would like to add fields beyond that, you can do
so by adding them manually into the HTML in this file. 

Any form fields you add here will automatically be
registered with the sendmail.php and sent out in the 
email. Just make sure you give any manually added
fields a unique field name. 

Example:
<li>
    <label for="NEW FIELD NAME HERE">New Field</label>
    <input type="text" name="NEW FIELD NAME HERE" value="" class="required">
</li>

*/

$email = str_replace("@", "[ at ]", $themeblvd_email_address);
?>
<?php get_header(); ?>

<?php if($themeblvd_sidebar == 'left') : ?>
	<?php get_sidebar(); ?>	
<?php endif; ?>

<div id="content">
	
	<?php themeblvd_breadcrumbs(); ?>
	
	<?php if( $themeblvd_theme_hints == 'true' ) : ?>
        <?php echo themeblvd_theme_hints('page-contact'); ?>
    <?php endif; ?>
	
	<?php the_post(); ?>
	
	<?php if( get_post_meta($post->ID, 'themeblvd_pagetitle', true) != 'false' ) : ?>
	<h1><?php the_title(); ?></h1>
	<?php endif; ?>
	
	<div class="page">
		
		<div class="top"><!-- --></div>
			
		<!-- Page Content -->
        <?php the_content(); ?>

        <?php
        //Collect form fields from theme options page (if any)
        $form_fields = array(

            //Optional Field #1
            array(
                    "name" => $themeblvd_field_name_1,
                    "input" => $themeblvd_field_input_1,
                    "required" => $themeblvd_field_required_1,
                    "validation" => $themeblvd_field_validation_1
            ),

            //Optional Field #2
            array(
                    "name" => $themeblvd_field_name_2,
                    "input" => $themeblvd_field_input_2,
                    "required" => $themeblvd_field_required_2,
                    "validation" => $themeblvd_field_validation_2
            ),

            //Optional Field #3
            array(
                    "name" => $themeblvd_field_name_3,
                    "input" => $themeblvd_field_input_3,
                    "required" => $themeblvd_field_required_3,
                    "validation" => $themeblvd_field_validation_3
            ),
        );
        ?>

        <div id="contact" class="rounded-10">

            <form action="" method="post" id="jaybich-contact">
            <fieldset>
                <ol>
                    <li>
                        <label for="name" class="name"><?php _e('Your Name', 'themeblvd'); ?></label>
                        <input type="text" name="name" value="" class="required" />
                    </li>
                    <li>
                        <label for="email" class="name"><?php _e('Your E-mail', 'themeblvd'); ?></label>
                        <input type="text" name="email" value="" class="email required" />
                    </li>

                    <!-- Display additional custom user fields (if any) -->
                    <?php $i = 1; ?>

                    <?php foreach($form_fields as $field) : ?>

                        <?php if($field['name']) : ?>
                        <li>
                            <label for="user-field-<?php echo $i; ?>" class="name"><?php echo $field['name']; ?></label>
                            <?php
                            $validation = $field['validation'];
                            $required = '';
                            if($field['required'] == 'yes'){

                                    $required = " required";

                            }
                            ?>
                            <?php if($field['input'] == 'text-input') : ?>
                            <input type="input" name="user-field-<?php echo $i; ?>" value="" class="<?php echo $validation . $required; ?>" />
                            <input type="hidden" name="user-field-<?php echo $i; ?>-name" value="<?php echo $field['name']; ?>" />
                            <?php else : ?>
                            <textarea name="user-field-<?php echo $i; ?>" value="" class="<?php echo $validation . $required; ?>"></textarea>
                            <input type="hidden" name="user-field-<?php echo $i; ?>-name" value="<?php echo $field['name']; ?>" />
                            <?php endif; ?>

                        </li>

                            <?php $i++; ?>

                        <?php endif; ?>

                    <?php endforeach; ?>

                    <li>
                        <label for="message" class="name"><?php _e('Your Message', 'themeblvd'); ?></label>
                        <textarea name="message" class="required"></textarea>
                    </li>
                    <!-- Honeypot Captcha Spam Prevention from Bots (start) -->
                    <li class="honeypot">
                        <label for="checking" class="honeypot">If you want to submit this form, do not enter anything in this field</label>
                        <input type="text" name="checking" id="checking" class="honeypot" />
                    </li>
                    <!-- Honeypot Captcha Spam Prevention from Bots (end) -->
                    <li>
                        <input type="hidden" name="myemail" id="myemail" value="<?php echo $email; ?>" />
                        <input type="hidden" name="mysitename" id="mysitename" value="<?php bloginfo(); ?>" />
                        <label for="submit" class="name"></label>
                        <input id="submit" type="submit" value="Submit"/>
                        <input type="hidden" name="submitted" id="submitted" value="true" />
                    </li>
                </ol>
            </fieldset>
            </form>

            <div id="sent" style="display: none;">
            <h3>Your message has been sent!</h3>
            <p>We'll be in touch soon.</p>
            </div>

        </div><!-- #contact (end) -->
		
		
		
		
		
		<?php edit_post_link( __('Edit Page', 'themeblvd'), '<p>', '</p>' ); ?>
		
		<div class="clear"></div>
		
		<div class="bottom"><!-- --></div>
		
	</div><!-- .page (end) -->
	
</div><!-- #content (end) -->

<?php if($themeblvd_sidebar == 'right') : ?>
	<?php get_sidebar(); ?>	
<?php endif; ?>

<?php get_footer(); ?>