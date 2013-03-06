<?php
/**
 *
 * ThemeBlvd WordPress Theme Framework
 * Theme Meta Box
 *
 * This class constructs each individual meta box
 * included with the current theme.
 *
 * @author  Jason Bobich
 *
 */

class themeblvd_meta_box {

    var $info;          //Information for specific meta box
    var $options;       //Options array for epecific meta box

    //Constructor
    function themeblvd_meta_box($info, $options) {

        $this->info = $info;
        $this->options = $options;

        //Run everything and finalize meta box
        add_action('admin_menu', array(&$this, 'create_meta_box'));
        add_action('save_post', array(&$this, 'save_data'));

    }

    function create_meta_box() {

        $id = $this->info['id'];
        $title = $this->info['title'];
        $page = $this->info['page'];
        $context = $this->info['context'];
        $priority = $this->info['priority'];

        foreach ($this->info['page'] as $area) {

            add_meta_box( $id, $title, array(&$this, 'display_meta_box'), $area, $context, $priority );
        
        }
    }

    function save_data() {

        global $post;
        if( isset($_POST['post_ID']) ){
            $post_id = $_POST['post_ID'];
        } else {
            $post_id = '';
        }

        $id = $this->info['id'];

        //Turn output buffering on
        ob_start();

        //echo "<pre>";
        //print_r($this->options);
        //echo "</pre>";

        

	foreach($this->options as $option) {

            // Verify
            if( isset($_POST[$id]) ){
                if ( !wp_verify_nonce( $_POST[$id], plugin_basename(__FILE__) )) {
                    return $post_id;
                }
            }

            if( isset($_POST['post_type']) ){
                if ( 'page' == $_POST['post_type'] ) {

                    if ( !current_user_can( 'edit_page', $post_id )) {

                        return $post_id;

                    } else {

                        if ( !current_user_can( 'edit_post', $post_id )) {
                            return $post_id;
                        }
                    }
                }
            }

            //Save or Update option
            if( isset($option['id']) && isset($_POST[$option['id']]) ){

                $data = $_POST[$option['id']];
            
                if(!get_post_meta($post_id, $option['id'])) {

                    add_post_meta($post_id, $option['id'], $data, true);

                } elseif($data != get_post_meta($post_id, $option['id'], true)) {

                    update_post_meta($post_id, $option['id'], $data);

                } elseif(!$data) {

                    delete_post_meta($post_id, $option['id'], get_post_meta($post_id, $option['id'], true));

                }
                
            }

	}

    }


    function display_meta_box() {

        global $post;
        $options = $this->options;
        $custom = get_post_custom($post->ID);

        echo '<div class="themeblvd-meta-box">';

        wp_nonce_field( plugin_basename(__FILE__), $this->info['id'] );
        //echo '<input type="text" name="themeblvd_text_input" id="themeblvd_text_input" value="retriev option" />';

        foreach ($options as $value) {

            switch ( $value['type'] ) {
                
                ##############################################################
                # Description Block
                ##############################################################

                case 'description' :

                    if( isset($value['id']) ){
                        $id = $value['id'];
                    }

                    echo '<div class="themeblvd-entry">';

                    echo '<div class="themeblvd-description-block">';
                    echo $value['desc'];
                    echo '</div><!-- .themeblvd-description-block (end) -->';

                    if( isset($value['more-info']) ){
                        $this->more_info( $id, $value['more-info'] );
                    }

                    echo '</div><!-- .themeblvd-entry (end) -->';

                    break;

                ##############################################################
                # HTML Block
                ##############################################################

                case 'html-block' :

                    $id = $value['id'];

                    echo '<div class="themeblvd-entry">';
                    echo $value['desc'];

                    if( isset($value['more-info']) ){
                        $this->more_info( $id, $value['more-info'] );
                    }

                    echo '</div><!-- .themeblvd-entry (end) -->';

                    break;

                ##############################################################
                # Text Field
                ##############################################################

                case 'text' :

                    $id = $value['id'];

                    global $post;
                    
                    if( isset($value['upload']) && $value['upload'] == 'true'){
                        $uploadButton = '<a href="media-upload.php?post_id='.$post->ID.'&amp;type=image&amp;hijack_target=&amp;TB_iframe=true" id="" class="button thickbox" title="" onclick="return false;">Upload Media</a>';
                    }

                    if( isset($custom[$id]) ){
                        $currentValue = htmlspecialchars(stripslashes( $custom[$id][0] ));
                    } else {
                        $currentValue = htmlspecialchars(stripslashes( $value['std'] ));
                    }

                    echo '<div class="themeblvd-entry">';

                    echo '<h4>'.$value['name'].' ';
                    if( isset($uploadButton) ){
                        echo $uploadButton;
                    }
                    echo '</h4>';

                    echo '<div class="themeblvd-field">';
                    echo "<input name='$id' type='text' value='$currentValue' class='themeblvd-input' />";
                    echo '</div><!-- .themeblvd-field (end) -->';

                    echo '<div class="themeblvd-description">';
                    echo $value['desc'];
                    echo '</div><!-- .themeblvd-description (end) -->';

                    if( isset($value['more-info']) ){
                        $this->more_info( $id, $value['more-info'] );
                    }

                    echo '</div><!-- .themeblvd-entry (end) -->';

                    break;

                ##############################################################
                # Text Area
                ##############################################################

                case 'textarea' :

                    $id = $value['id'];

                    if( isset($custom[$id]) ){
                        $currentValue = htmlspecialchars(stripslashes( $custom[$id][0] ));
                    } else {
                        $currentValue = htmlspecialchars(stripslashes( $value['std'] ));
                    }

                    echo '<div class="themeblvd-entry">';

                    echo '<h4>'.$value['name'].'</h4>';

                    echo '<div class="themeblvd-field">';
                    echo "<textarea name='$id' cols='' rows='' class='themeblvd-textarea'>$currentValue</textarea>";
                    echo '</div><!-- .themeblvd-field (end) -->';

                    echo '<div class="themeblvd-description">';
                    echo $value['desc'];
                    echo '</div><!-- .themeblvd-description (end) -->';

                    if( isset($value['more-info']) ){
                        $this->more_info( $id, $value['more-info'] );
                    }

                    echo '</div><!-- .themeblvd-entry (end) -->';

                    break;

                ##############################################################
                # Select box
                ##############################################################

                case 'select' :

                    $id = $value['id'];
                    $drop_options = $value['data'];
                    $final_value = $custom[$id][0];
                    if(!$final_value) {
                        $final_value = $value['std'];
                    }

                    echo '<div class="themeblvd-entry">';

                    echo '<h4>'.$value['name'].'</h4>';

                    echo '<div class="themeblvd-field">';

                    //create drop down box
                    echo '<select name="' . $value['id'] . '">';
                    foreach($drop_options as $key => $entry) {

                        if($final_value == $entry['value']) {
                            $selected = " selected='selected'";
                        } else {
                            $selected = "";
                        }

                        echo "<option$selected value='". $entry['value'] ."'>" . $entry['name'] . "</option>";

                    }


                    echo '</select>';

                    echo '</div><!-- .themeblvd-field (end) -->';

                    echo '<div class="themeblvd-description">';
                    echo $value['desc'];
                    echo '</div><!-- .themeblvd-description (end) -->';

                    if( isset($value['more-info']) ){
                        $this->more_info( $id, $value['more-info'] );
                    }

                    echo '</div><!-- .themeblvd-entry (end) -->';

                    break;

                ##############################################################
                # Checkbox (group of checkboxes)
                ##############################################################

                case 'checkbox' :

                    $id = $value['id'];
                    $checkboxes = $value['data'];
                    $finalValue = $custom[$id][0];
                    if(!$finalValue) {
                        $finalValue = $value['std'];
                    }

                    echo '<div class="themeblvd-entry">';

                    echo '<h4>'.$value['name'].'</h4>';

                    echo '<div class="themeblvd-field">';

                    //create drop down box
                    foreach($checkboxes as $key => $entry) {

                        $newValue = $entry['value'];
                        $newName = $entry['name'];
                        $checked = '';

                        if( in_array($newValue, $finalValue) ) {
                           $checked = " checked='checked'";
                        }

                        echo "<p><input type='checkbox' name='".$id."[]' value='$newValue' class='themeblvd-checkbox'$checked />$newName</p>";

                    }

                    echo '</div><!-- .themeblvd-field (end) -->';

                    echo '<div class="themeblvd-description">';
                    echo $value['desc'];
                    echo '</div><!-- .themeblvd-description (end) -->';

                    if( isset($value['more-info']) ){
                        $this->more_info( $id, $value['more-info'] );
                    }

                    echo '</div><!-- .themeblvd-entry (end) -->';

                    break;

                ##############################################################
                # Radio Button - True or False
                ##############################################################

                case 'true_false_radio':

                    $id = $value['id'];

                    if( isset($custom[$id]) ){
                        $currentValue = $custom[$id][0];
                    } else {
                        $currentValue = $value['std'];
                    }

                    echo '<div class="themeblvd-entry">';

                    echo '<h4>'.$value['name'].'</h4>';

                    echo '<div class="themeblvd-field">';

                    if($currentValue == 'true') {

                        echo '<p><input class="themeblvd-radio" type="radio" name="'.$id.'" value="true" checked> ';
                        echo $value['option1'].'</p>';

                        echo '<p><input class="themeblvd-radio" type="radio" name="'.$id.'" value="false"> ';
                        echo $value['option2'].'</p>';

                    } else {

                        echo '<p><input class="themeblvd-radio" type="radio" name="'.$id.'" value="true"> ';
                        echo $value['option1'].'</p>';

                        echo '<p><input class="themeblvd-radio" type="radio" name="'.$id.'" value="false"  checked> ';
                        echo $value['option2'].'</p>';

                    }

                    echo '</div><!-- .themeblvd-field (end) -->';

                    echo '<div class="themeblvd-description">';
                    echo $value['desc'];
                    echo '</div><!-- .themeblvd-description (end) -->';

                    if( isset($value['more-info']) ){
                        $this->more_info( $id, $value['more-info'] );
                    }

                    echo '</div><!-- .themeblvd-entry (end) -->';

                    break;

                ##############################################################
                # Color Picker
                ##############################################################

                case 'color_picker' :

                    $id = $value['id'];

                    if( isset($custom[$id]) ){
                        $currentValue = $custom[$id][0];
                    } else {
                        $currentValue = $value['std'];
                    }

                    echo '<div class="themeblvd-entry">';

                    echo '<h4>'.$value['name'].'</h4>';

                    //Color Picker JS
                    echo '<script type="text/javascript">';
                    echo "(function($){";
                    echo "var initLayout = function() {";
                    echo "var hash = window.location.hash.replace('#', '');";
                    echo "$('#$id').ColorPicker({";
                    echo "onSubmit: function(hsb, hex, rgb, el) {";
                    echo "$(el).val(hex);";
                    echo "$(el).ColorPickerHide();";
                    echo "},";
                    echo "onBeforeShow: function () {";
                    echo "$(this).ColorPickerSetColor(this.value);";
                    echo "}";
                    echo "})";
                    echo ".bind('keyup', function(){";
                    echo "$(this).ColorPickerSetColor(this.value);";
                    echo "});";
                    echo "};";
                    echo "EYE.register(initLayout, 'init');";
                    echo "})(jQuery)";
                    echo '</script>';

                    echo '<div class="themeblvd-field">';
                    echo "<input name='$id' id='$id' type='text' value='$currentValue' class='themeblvd-input' />";

                    echo '</div><!-- .themeblvd-field (end) -->';

                    echo '<div class="themeblvd-description">';
                    echo $value['desc'];
                    echo '</div><!-- .themeblvd-description (end) -->';

                    if( isset($value['more-info']) ){
                        $this->more_info( $id, $value['more-info'] );
                    }

                    echo '</div><!-- .themeblvd-entry (end) -->';

                    break;

                ##############################################################
                # Checkbox list of Pages
                ##############################################################

                case 'page_list' :

                    $id = $value['id'];
                    $current_selected_pages = $custom[$id][0];
                    $entries = get_pages('title_li=&sort_column=menu_order');

                    echo '<div class="themeblvd-entry">';

                    echo '<h4>'.$value['name'].'</h4>';

                    echo '<div class="themeblvd-field">';

                    foreach ($entries as $key => $entry) {

                        $id = $entry->ID;
                        $title = $entry->post_title;

                        $checked = '';

                        //Find out which checkboxes were already selected
                        if($current_selected_pages) {

                            foreach ($current_selected_pages as $entry2)
                            {

                                if($entry2 == $id) {
                                    $checked = ' checked="checked" ';
                                }

                            }

                        }

                        echo '<p><input class="themeblvd-checkbox" type="checkbox" name="' . $value['id'] . '[]" value="' . $id . '"' . $checked . '> ' . $title . '</p>';

                    }

                    echo '</div><!-- .themeblvd-field (end) -->';

                    echo '<div class="themeblvd-description">';
                    echo $value['desc'];
                    echo '</div><!-- .themeblvd-description (end) -->';

                    if( isset($value['more-info']) ){
                        $this->more_info( $id, $value['more-info'] );
                    }

                    echo '</div><!-- .themeblvd-entry (end) -->';


                    break;

                ##############################################################
                # Checkbox list of Blog Categories
                ##############################################################

                case 'category_list' :

                    $id = $value['id'];
                    $current_selected_pages = $custom[$id][0];
                    $entries = get_categories('title_li=&orderby=name&hide_empty=0');

                    echo '<div class="themeblvd-entry">';

                    echo '<h4>'.$value['name'].'</h4>';

                    echo '<div class="themeblvd-field">';

                    foreach ($entries as $key => $entry) {

                        $id = $entry->term_id;
                        $title = $entry->name;

                        $checked = '';

                        //Find out which checkboxes were already selected
                        if($current_selected_pages) {

                            foreach ($current_selected_pages as $entry2)
                            {

                                if($entry2 == $id) {
                                    $checked = ' checked="checked" ';
                                }

                            }

                        }

                        echo '<p><input class="themeblvd-checkbox" type="checkbox" name="' . $value['id'] . '[]" value="' . $id . '"' . $checked . '> ' . $title . '</p>';

                    }

                    echo '</div><!-- .themeblvd-field (end) -->';

                    echo '<div class="themeblvd-description">';
                    echo $value['desc'];
                    echo '</div><!-- .themeblvd-description (end) -->';

                    if( isset($value['more-info']) ){
                        $this->more_info( $id, $value['more-info'] );
                    }

                    echo '</div><!-- .themeblvd-entry (end) -->';


                    break;

                ##############################################################
                # Dropdown of Pages
                ##############################################################

                case 'page_dropdown' :

                    $id = $value['id'];

                    if( isset($custom[$id]) ){
                        $currentValue = $custom[$id][0];
                    } else {
                        $currentValue = $value['std'];
                    }
                    
                    $entries = get_pages('title_li=&sort_column=menu_order');

                    echo '<div class="themeblvd-entry">';

                    echo '<h4>'.$value['name'].'</h4>';

                    echo '<div class="themeblvd-field">';

                    echo "<select name='$id' id='$id' value='$currentValue'>";

                        foreach ($entries as $key => $entry) {

                            $id = $entry->ID;
                            $title = $entry->post_title;

                            if ( $custom[$id][0] == $id) {
                                $selected = "selected='selected'";
                            } else {
                                $selected = "";
                            }

                            echo "<option $selected value='". $id."'>" . $title . "</option>";

                        }

                    echo "</select>";

                    echo '</div><!-- .themeblvd-field (end) -->';

                    echo '<div class="themeblvd-description">';
                    echo $value['desc'];
                    echo '</div><!-- .themeblvd-description (end) -->';

                    if( isset($value['more-info']) ){
                        $this->more_info( $id, $value['more-info'] );
                    }

                    echo '</div><!-- .themeblvd-entry (end) -->';

                    break;

                ##############################################################
                # Dropdown of Blog Categories
                ##############################################################

                case 'category_dropdown' :

                    $id = $value['id'];

                    if( isset($custom[$id]) ){
                        $currentValue = $custom[$id][0];
                    } else {
                        $currentValue = $value['std'];
                    }
                    
                    $select = 'All Categories';
                    $entries = get_categories('title_li=&orderby=name&hide_empty=0');

                    echo '<div class="themeblvd-entry">';

                    echo '<h4>'.$value['name'].'</h4>';

                    echo '<div class="themeblvd-field">';

                    echo "<select name='$id' id='$id' value='$currentValue'>";

                        echo '<option value="all">' . $select .'</option>';

                        foreach ($entries as $key => $entry) {

                            $id = $entry->term_id;
                            $title = $entry->name;

                            if ( $custom[$id][0] == $id) {
                                $selected = "selected='selected'";
                            } else {
                                $selected = "";
                            }

                            echo "<option $selected value='". $id."'>" . $title . "</option>";

                        }

                    echo "</select>";

                    echo '</div><!-- .themeblvd-field (end) -->';

                    echo '<div class="themeblvd-description">';
                    echo $value['desc'];
                    echo '</div><!-- .themeblvd-description (end) -->';

                    if( isset($value['more-info']) ){
                        $this->more_info( $id, $value['more-info'] );
                    }

                    echo '</div><!-- .themeblvd-entry (end) -->';

                    break;

                ##############################################################
                # Dropdown of Taxonomy Terms
                ##############################################################

                case 'taxo_dropdown' :

                    $id = $value['id'];

                    if ( $custom[$id][0] ) {
                        $currentValue = ( $custom[$id][0] );
                    } else {
                        $currentValue = $value['std'];
                    }
                    $select = 'All';
                    $entries = get_terms($value['taxo']);

                    echo '<div class="themeblvd-entry">';

                    echo '<h4>'.$value['name'].'</h4>';

                    echo '<div class="themeblvd-field">';

                    echo "<select name='$id' id='$id' value='$currentValue'>";

                        echo '<option value="all">'.$select.'</option>';

                        foreach ($entries as $key => $entry) {

                            $id = $entry->slug;
                            $title = $entry->name;

                            if ( $custom[$id][0] == $id) {
                                $selected = "selected='selected'";
                            } else {
                                $selected = "";
                            }

                            echo "<option $selected value='". $id."'>".$title."</option>";

                        }

                    echo "</select>";

                    echo '</div><!-- .themeblvd-field (end) -->';

                    echo '<div class="themeblvd-description">';
                    echo $value['desc'];
                    echo '</div><!-- .themeblvd-description (end) -->';

                    if( isset($value['more-info']) ){
                        $this->more_info( $id, $value['more-info'] );
                    }

                    echo '</div><!-- .themeblvd-entry (end) -->';

                    break;

                ##############################################################
                # Dropdown of Widget Areas
                ##############################################################

                case 'widgetarea_dropdown' :

                    $id = $value['id'];

                    if( isset($custom[$id]) ){
                        $currentValue = $custom[$id][0];
                    } else {
                        $currentValue = $value['std'];
                    }

                    global $wp_registered_sidebars;
                    $entries = $wp_registered_sidebars;

                    echo '<div class="themeblvd-entry">';

                    echo '<h4>'.$value['name'].'</h4>';

                    echo '<div class="themeblvd-field">';

                    echo "<select name='$id' id='$id' value='$currentValue'>";

                        foreach ($entries as $key => $entry) {

                            $id = $entry['id'];
                            $title = $entry['name'];

                            if ( $custom[$id][0] == $id) {
                                $selected = "selected='selected'";
                            } else {
                                $selected = "";
                            }

                            echo "<option $selected value='". $id."'>".$title."</option>";

                        }

                    echo "</select>";

                    echo '</div><!-- .themeblvd-field (end) -->';

                    echo '<div class="themeblvd-description">';
                    echo $value['desc'];
                    echo '</div><!-- .themeblvd-description (end) -->';

                    if( isset($value['more-info']) ){
                        $this->more_info( $id, $value['more-info'] );
                    }

                    echo '</div><!-- .themeblvd-entry (end) -->';

                    break;

            }

        }

        echo '</div><!-- .themeblvd-meta-box (end) -->';
    }

    function more_info($id, $text){

        echo '<div class="clear"></div>';
        echo "<div id='$id' class='help-box'>";
        echo $text;
        echo "<p><a href='#$id' class='jaybich-close'>";
        _e("Hide", "themeblvd");
        echo '</a></p>';
        echo '</div><!-- .help-box (end) -->';

    }
              
##################################################################
} # end themeblvd_metabox class
##################################################################