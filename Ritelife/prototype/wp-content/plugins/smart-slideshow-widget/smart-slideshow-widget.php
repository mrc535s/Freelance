<?php
/*
  Plugin Name: Smart Slideshow Widget
  Plugin URI: http://lamedalla.es/decarton/informatica/smart-slideshow-widget/
  Description: This plugin defines a widget for showing a slideshow of images, 100% Javascript (jQuery).
  Version: 2.7.4
  Author: Rubén Trujillo
  Author URI: http://lamedalla.es/decarton
  License: GPLv3
 */

/*
  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation; either version 3 of the License, or
  (at your option) any later version.

  This program is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
  GNU General Public License for more details.
 */

#### LOAD TRANSLATIONS ####
load_plugin_textdomain('smart-slideshow-widget', 'wp-content/plugins/smart-slideshow-widget/lang/', 'smart-slideshow-widget/lang/');
####
#### ADMIN OPTIONS ####

function SSWAdminMenu() {
    add_options_page('Smart Slideshow Widget', 'Smart Slideshow Widget', '10', 'SSWAdminMenu', 'SSWAdminContent');
}

add_action('admin_menu', 'SSWAdminMenu');

function SSWAdminContent() {
?>
    <div class="wrap">
        <h2><?php _e('"Smart Slideshow Widget" Options', 'smart-slideshow-widget') ?></h2>
        <br class="clear" />

        <p class="description" style="margin: 10px 0 40px 0;">
        <?php _e('This plugin will show a widget in the sidebar featuring a <strong>Slideshow</strong> of images you choose.', 'smart-slideshow-widget') ?><br/><br/>
<?php printf(__('All you have to do is to <a href="%s/wp-admin/widgets.php" title="Widget configuration page">add a new widget</a> of Smart Slideshow Widget to your sidebar and configure it: image folder, url, effect...', 'smart-slideshow-widget'), home_url()) ?>
        <br/><br/>
<?php _e('If you <strong>like it</strong>, consider posting a comment in the official plugin post at <strong>my blog</strong>, <a href="http://lamedalla.es/decarton" target="_blank" title="La Medalla de Cartón">La Medalla de Cartón</a> or making a donation.', 'smart-slideshow-widget') ?>
    <form action="https://www.paypal.com/cgi-bin/webscr" method="post">
        <input type="hidden" name="cmd" value="_s-xclick">
        <input type="hidden" name="encrypted" value="-----BEGIN PKCS7-----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-----END PKCS7-----
               ">
        <input type="image" src="https://www.paypal.com/en_US/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
        <img alt="" border="0" src="https://www.paypal.com/es_ES/i/scr/pixel.gif" width="1" height="1">
    </form>

</p>

</div>
<?php
    }

global $_IMAGE_FOLDER;

// Compare two images, the lower the modification date, the lower 
// the image is considered.
    function cmp($a, $b) {
        global $_IMAGE_FOLDER;
        if (filemtime($_IMAGE_FOLDER.'/'.$a) < filemtime($_IMAGE_FOLDER.'/'.$b)) {
            return -1;
        } else {
            return 1;
        }
    }

    function array_date_sort($image_array, $method) {
        usort($image_array, "cmp");

        if ($method == 'DESC') {
            return array_reverse($image_array);
        } else {
            return $image_array;
        }
    }

####
#### WIDGET SMART SLIDESHOW WIDGET
    /**
     * SmartSlideshowWidget Class
     */

    class SmartSlideshowWidget extends WP_Widget {

        var $avail_modes;

        /** constructor */
        function SmartSlideshowWidget() {
            parent::WP_Widget(false, $name = 'Smart Slideshow Widget', $widget_options = array('description' => __('A new slideshow widget for your sidebar.', 'smart-slideshow-widget')));

            // Define transition efect modes
            $this->avail_modes = array();

            $this->avail_modes[1] = __('Fade', 'smart-slideshow-widget');
            $this->avail_modes[2] = __('Curtain up', 'smart-slideshow-widget');
            $this->avail_modes[3] = __('Double blind', 'smart-slideshow-widget');
            $this->avail_modes[4] = __('Shrink', 'smart-slideshow-widget');
            $this->avail_modes[5] = __('Switch Off', 'smart-slideshow-widget');
            $this->avail_modes[6] = __('Bounce Down', 'smart-slideshow-widget');
            $this->avail_modes[7] = __('Slide Left', 'smart-slideshow-widget');
            $this->avail_modes[8] = __('Slide Right', 'smart-slideshow-widget');
            $this->avail_modes[9] = __('Slide Up', 'smart-slideshow-widget');
            $this->avail_modes[10] = __('Slide Down', 'smart-slideshow-widget');

            $this->avail_modes[0] = __('Random', 'smart-slideshow-widget');


            $this->avail_orders = array();

            $this->avail_orders[0] = __('Regular', 'smart-slideshow-widget');
            $this->avail_orders[1] = __('Random', 'smart-slideshow-widget');
            $this->avail_orders[2] = __('Reverse', 'smart-slideshow-widget');
            $this->avail_orders[3] = __('By date (ascending)', 'smart-slideshow-widget');
            $this->avail_orders[4] = __('By date (descending)', 'smart-slideshow-widget');
        }

        /** @see WP_Widget::widget */
        function widget($args, $instance) {
            extract($args);
            $title = apply_filters('widget_title', $instance['title']);
            $img_folder = $instance['img_folder'];
            $img_url = $instance['img_url'];
            $mode = $instance['mode'];
            $delay = $instance['delay'];
            $speed = $instance['speed'];
            $order = $instance['order'];
            $style = $instance['style'];
            $link = $instance['link'];
            $link_dest = $instance['link_dest'];
            $buttons = $instance['buttons'];
            $notautorun = $instance['notautorun'];

            if ($speed == '') {
                $speed = 800;
            }
            if ($notautorun == '') {
                $notautorun = 0;
            }
?>
<?php echo $before_widget; ?>
<?php if ($title)
                echo $before_title . $title . $after_title; ?>

            <!-- Start of the widget's content -->
<?php
            if ($img_folder[0] != '/') {
                // It's a relative path
                $img_folder = WP_CONTENT_DIR . '/' . $img_folder;
                global $_IMAGE_FOLDER;
                $_IMAGE_FOLDER = $img_folder;
            }

            $output = '';
            $max_height = 0;
            $max_width = 0;
            $images = array();

            $count = 0;

            if ($handle = opendir($img_folder)) {
                while (false !== ($file = readdir($handle))) {
                    if ($file != "." && $file != ".." && !preg_match('/^\./', $file) &&
                            preg_match("/\.(bmp|jpeg|gif|png|jpg)$/i", $file)) {

                        $images[$count] = $file;
                        $count = $count + 1;
                    }
                }

                closedir($handle);
            }

            sort($images);

            $count = 0;

            $output .= '<div class="ssw_main" id="ssw_main_' . $this->number . '" style="position: relative; top: 0; left: 0; padding:0 0 0 0;margin:0; height: XXXXpx; width:ZZZZpx;border:0;background:0;">';

            // Display previous and next slide buttons
            if ($buttons) {
                $output .= '<div class="ssw_arrow ssw_left_arrow" style="position:absolute;top:YYYYpx;left:0;" onclick="prevSlide(' . $this->number . ', ' . $mode . ', ' . $speed . ');" /></div>';

                $output .= '<div class="ssw_arrow ssw_right_arrow" style="position:absolute;top:YYYYpx;right:0;" onclick="nextSlide(' . $this->number . ', ' . $mode . ', ' . $speed . ');" /></div>';
            }

            // Modify the array:
            // 0: random
            if ($order == 1) {
                shuffle($images);
            }
            // 2: reverse
            else if ($order == 2) {
                $images = array_reverse($images);
            }
            // 3: date order, ascending
            else if ($order == 3) {
                $images = array_date_sort($images, 'ASC');
            }
            // 4: date order, descending
            else if ($order == 4) {
                $images = array_date_sort($images, 'DESC');
            }
            // 1: regular
            else {
                // Nothing
            }

            // Concatenate the widget HTML code
            foreach ($images as $file) {

                list($width, $height, $type, $attr) = getimagesize($img_folder . '/' . $file);

                if ($height > $max_height) {
                    $max_height = $height;
                }

                if ($width > $max_width) {
                    $max_width = $width;
                }

                $output .= '<div id="ssw_img_' . $this->number . '_' . $count . '" class="ssw_image_element" style="display:none;width: ' . $width . 'px; height: ' . $height . 'px; ' . $style . '">';

                if ($link != "") {
                    if ($link_dest) {
                        $destination = 'target="_blank"';
                    } else {
                        $destination = '';
                    }
                    $output .= '<a href="' . $link . '" ' . $destination . ' style="border: none;">';
                }
                $output .= '<img src="' . $img_url . '/' . $file . '" alt="" width="' . $width . '" height="' . $height . '" />';
                if ($link != "") {
                    $output .= '</a>';
                }
                $output .= '</div>';
                $count = $count + 1;
            }
            $output .= '</div>';
            $output .= '<span id="ssw_counter_' . $this->number . '" style="display:none">' . $count . '</span>';
            $output .= '<span id="ssw_delay_' . $this->number . '" style="display:none">' . $delay . '</span>';
            $output .= '<script type="text/javascript">it[' . $this->number . ']=0;runSlideshow(' . $this->number . ', ' . $mode . ', ' . $speed . ', ' . $notautorun . ');</script>';

            // Set height/width to max image height/width
            $output = str_replace("XXXX", $max_height, $output);
            $output = str_replace("YYYY", ($max_height / 2) - 12, $output);
            $output = str_replace("ZZZZ", $max_width, $output);

            // Print the widget
            echo $output;
?>		
            <!-- End of the widget's content -->
<?php echo $after_widget; ?>
<?php
        }

        /** @see WP_Widget::update */
        function update($new_instance, $old_instance) {
            $instance = $old_instance;
            $instance['title'] = strip_tags($new_instance['title']);
            $instance['img_folder'] = $new_instance['img_folder'];
            $instance['img_url'] = $new_instance['img_url'];
            $instance['mode'] = $new_instance['mode'];
            $instance['delay'] = $new_instance['delay'];
            $instance['speed'] = $new_instance['speed'];
            $instance['order'] = $new_instance['order'];
            $instance['style'] = $new_instance['style'];
            $instance['link'] = $new_instance['link'];
            $instance['link_dest'] = $new_instance['link_dest'];
            $instance['buttons'] = $new_instance['buttons'];
            $instance['notautorun'] = $new_instance['notautorun'];

            return $instance;
        }

        /** @see WP_Widget::form */
        function form($instance) {
            $title = esc_attr($instance['title']);
            $img_folder = esc_attr($instance['img_folder']);
            $img_url = esc_attr($instance['img_url']);
            $mode = esc_attr($instance['mode']);
            $delay = esc_attr($instance['delay']);
            $speed = esc_attr($instance['speed']);
            $order = esc_attr($instance['order']);
            $style = esc_attr($instance['style']);
            $link = esc_attr($instance['link']);
            $link_dest = esc_attr($instance['link_dest']);
            $buttons = esc_attr($instance['buttons']);
            $notautorun = esc_attr($instance['notautorun']);
?>
            <p>
                <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title', 'smart-slideshow-widget'); ?>:</label>
                <input type="text" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $title; ?>" />
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('img_folder'); ?>"><?php _e('Image folder', 'smart-slideshow-widget'); ?>:</label>
            </p>
            <p class="description" style="font-size: x-small"><?php _e('Folder where you have stored the images. Relatives are considered to <code>wp-content</code> folder of your Wordpress installation.', 'smart-slideshow-widget') ?></p>
            <p>
                <input type="text" class="widefat" id="<?php echo $this->get_field_id('img_folder'); ?>" name="<?php echo $this->get_field_name('img_folder'); ?>" value="<?php echo $img_folder; ?>" />
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('img_url'); ?>"><?php _e('Image URL', 'smart-slideshow-widget'); ?>:</label>
            </p>
            <p class="description" style="font-size: x-small"><?php _e('URL for the folder where you have stored the images, a full URL starting with <code>http://</code>.', 'smart-slideshow-widget') ?></p>
            <p>
                <input type="text" class="widefat" id="<?php echo $this->get_field_id('img_url'); ?>" name="<?php echo $this->get_field_name('img_url'); ?>" value="<?php echo $img_url; ?>" />

            </p>
            <p>
                <label for="<?php echo $this->get_field_id('mode'); ?>"><?php _e('Effect', 'smart-slideshow-widget'); ?>:</label>
            </p>
            <p class="description" style="font-size: x-small;"><?php _e('The effect between image transitions.', 'smart-slideshow-widget'); ?></p>
            <p>
                <select name="<?php echo $this->get_field_name('mode'); ?>" id="<?php echo $this->get_field_id('mode'); ?>">
<?php for ($i = 1; $i < count($this->avail_modes); $i++) { ?>
                        <option value="<?php echo $i ?>" <?php if ($mode == $i) {
                    echo "selected";
                } ?>>
        <?php echo $this->avail_modes[$i] ?>
                </option>
            <?php } ?>

        <option value="0" <?php if ($mode == 0) {
                echo "selected";
            } ?>>
            <?php echo $this->avail_modes[0] ?>
        </option>
    </select>
</p>
<p>
    <label for="<?php echo $this->get_field_id('delay'); ?>"><?php _e('Delay', 'smart-slideshow-widget'); ?>:</label>
</p>
<p class="description" style="font-size: x-small"><?php _e('The delay (in seconds) between image transitions.', 'smart-slideshow-widget'); ?></p> 
<p>
    <input type="text" id="<?php echo $this->get_field_id('delay'); ?>" name="<?php echo $this->get_field_name('delay'); ?>" value="<?php echo $delay; ?>" size="4" /> <?php _e('seconds', 'smart-slideshow-widget') ?>
</p>
<p>
    <label for="<?php echo $this->get_field_id('speed'); ?>"><?php _e('Animation speed', 'smart-slideshow-widget'); ?>:</label>
</p>
<p class="description" style="font-size: x-small"><?php _e('The speed for the selected transition (in mili seconds).', 'smart-slideshow-widget'); ?></p> 
<p>
    <input type="text" id="<?php echo $this->get_field_id('speed'); ?>" name="<?php echo $this->get_field_name('speed'); ?>" value="<?php echo $speed; ?>" size="4" /> <?php _e('miliseconds', 'smart-slideshow-widget') ?>
</p>
<p>
    <label for="<?php echo $this->get_field_id('order'); ?>"><?php _e('Order', 'smart-slideshow-widget'); ?>:</label>
</p>
<p class="description" style="font-size: x-small;"><?php _e('The order of the images displayed.', 'smart-slideshow-widget'); ?></p>
<p>
    <select name="<?php echo $this->get_field_name('order'); ?>" id="<?php echo $this->get_field_id('order'); ?>">
        <?php for ($i = 0; $i < count($this->avail_orders); $i++) {
 ?>
                <option value="<?php echo $i ?>" <?php if ($order == $i) {
                    echo "selected";
                } ?>>
<?php echo $this->avail_orders[$i] ?>
                </option>
<?php } ?>
        </select>
    </p>
    <p>
        <label for="<?php echo $this->get_field_id('style'); ?>"><?php _e('Custom Style', 'smart-slideshow-widget'); ?>:</label>
    </p>
    <p class="description" style="font-size: x-small;"><?php _e('Sets a current style for the images shown in the slideshow.', 'smart-slideshow-widget') ?><?php _e('If you need to use quotes, use doubles instead of single (<code>"</code> and not <code>\'</code>).', 'smart-slideshow-widget') ?></p>
    <p>
        <input type="text" class="widefat" id="<?php echo $this->get_field_id('style'); ?>" name="<?php echo $this->get_field_name('style'); ?>" value="<?php echo $style; ?>" />
    </p>
    <p>
        <label for="<?php echo $this->get_field_id('link'); ?>"><?php _e('Link for images', 'smart-slideshow-widget'); ?>:</label>
    </p>
    <p class="description" style="font-size: x-small;"><?php _e('Defines a link for the slideshow images.', 'smart-slideshow-widget') ?></p>
    <p>
        <input type="checkbox" id="<?php echo $this->get_field_id('link_dest'); ?>" name="<?php echo $this->get_field_name('link_dest'); ?>" value="1" <?php if ($link_dest) { ?>checked="checked"<?php } ?> />&nbsp;<small><label for="<?php echo $this->get_field_id('link_dest'); ?>"><?php _e('Open link on a new window/tab', 'smart-slideshow-widget'); ?>.</label></small>
        <input type="text" class="widefat" id="<?php echo $this->get_field_id('link'); ?>" name="<?php echo $this->get_field_name('link'); ?>" value="<?php echo $link; ?>" />

    </p>
    <p>
        <input type="checkbox" id="<?php echo $this->get_field_id('buttons'); ?>" name="<?php echo $this->get_field_name('buttons'); ?>" value="1" <?php if ($buttons) { ?>checked="checked"<?php } ?> />&nbsp;<label for="<?php echo $this->get_field_id('buttons'); ?>"><?php _e('Show previous/next slide buttons', 'smart-slideshow-widget'); ?>:</label>
    </p>
    <p class="description" style="font-size: x-small;"><?php _e('Display previous and next slide controls.', 'smart-slideshow-widget') ?></p>
    <p>
        <input type="checkbox" id="<?php echo $this->get_field_id('notautorun'); ?>" name="<?php echo $this->get_field_name('notautorun'); ?>" value="1" <?php if ($notautorun) { ?>checked="checked"<?php } ?> />&nbsp;<label for="<?php echo $this->get_field_id('notautorun'); ?>"><?php _e('Do not autorun', 'smart-slideshow-widget'); ?>:</label>
    </p>
    <p class="description" style="font-size: x-small;"><?php _e('Do not run the slideshow automatically, only using the built in controls.', 'smart-slideshow-widget') ?></p>

<?php
        }

    }

    // class SmartSlideshowWidget
// register SmartSlideshowWidget widget
    add_action('widgets_init', create_function('', 'return register_widget("SmartSlideshowWidget");'));

####

    function sswEnqueueScripts() {
        wp_enqueue_script('jquery');
        wp_enqueue_script('jQuery-UI-Effects', WP_PLUGIN_URL . '/smart-slideshow-widget/js/jquery-ui.min.js');
        wp_enqueue_script('SSW', WP_PLUGIN_URL . '/smart-slideshow-widget/js/smart-slideshow-widget.js');
    }

    function sswAddHeaderLinks() {
        echo '<link rel="stylesheet" type="text/css" href="' . WP_PLUGIN_URL . '/smart-slideshow-widget/css/smart-slideshow-widget.css" media="screen" />' . "\n";
        echo '<script type="text/javascript">var blogUrl = \'' . get_bloginfo('wpurl') . '\'</script>' . "\n";
    }

    add_action('init', 'sswEnqueueScripts');
    add_action('wp_head', 'sswAddHeaderLinks');
?>