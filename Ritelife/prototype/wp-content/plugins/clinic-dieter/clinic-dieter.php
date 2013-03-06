<?php
/*

Plugin Name: Clinic-Dieter Associatron
Description: Associate Dieters with Clinics
Version: 0.5
Author: Lionel Hutz
 
 */


/*
    USAGE - Add this to a page template. Each logged-in clinic user will see its associated users

        <?php
            if ( function_exists(cda_list_of_clinic_subscribers) ){ 
                echo '<h3>Subscribers: (' . cda_count_dieters() . ')</h3>';   
                cda_list_of_clinic_subscribers();   
            }
        ?>  

        To just print the count, use <?php echo cda_count_dieters(); ?>
 */



$plugin = plugin_basename(__FILE__); 


function cda_choose_a_clinic( $user ){
    global $wpdb;
    global $profileuser;

    $profile_user_id = $profileuser->ID;

    // only show form on Subscriber profile edit pages
    if ( in_array('dieter', $profileuser->roles) ){
        
            $all_clinics = $wpdb->get_results("SELECT user_id 
                FROM $wpdb->usermeta 
                WHERE meta_value
                LIKE '%clinic%'
                AND meta_key = 'wp_capabilities'", 'ARRAY_N'
            );

            // find clinic id equal to user's clinic usermeta field
            $current_users_clinic = get_user_meta($profile_user_id, 'clinic', true);
            ?>

            <h3>Clinic association</h3>

            <table class="form-table">
                <tr class="form-field">
                    <th>
                        Choose a clinic:
                    </th>

                    <td style="text-align:left">
                        <select id="cda_choose_clinic" name="clinic" id="cda_clinic">
                            <option value="">Choose</option>
                           
                           <?php foreach ( $all_clinics as $clinic ){
                                $clinic_info = get_userdata($clinic[0]);?>

                                <option value="<?php echo $clinic_info->ID; ?>"
                                    <?php if ( $current_users_clinic == $clinic_info->ID ){
                                        echo 'selected="selected"';
                                    }?>
                                >
                                    <?php echo $clinic_info->display_name; ?>
                                </option>

                            <?php } ?>

                        </select>
                    </td>
                </tr>
            </table>
    <?php    }
 } //end cda_choose_a_clinic()


add_action( 'show_user_profile', 'cda_choose_a_clinic' );
add_action( 'edit_user_profile', 'cda_choose_a_clinic' );



////////////////////// SAVE CLINIC TO USERMETA //////////////////////////////////

function cda_save_custom_user_profile_fields( $user_id ) {
    if ( !current_user_can( 'edit_user', $user_id ) )
        return FALSE;
    update_usermeta( $user_id, 'clinic', $_POST['clinic'] );
}

add_action( 'personal_options_update', 'cda_save_custom_user_profile_fields' );
add_action( 'edit_user_profile_update', 'cda_save_custom_user_profile_fields' );

////////////////////// END SAVE CLINIC TO USERMETA //////////////////////////////////



///////////// VERIFY WHETHER A GIVEN SUBSCRIBER BELONGS TO CLINIC //////////////
function cda_subscribes_to_clinic( $subscriber_id ){

    global $wpdb;
    global $current_user;

	$belongs = false;
   
    // check to see if $curauth has Clinic role
    if ( in_array('clinic', $current_user->roles) ){

        $subscribers = $wpdb->get_results("SELECT user_id 
            FROM $wpdb->usermeta 
            WHERE meta_value = '$current_user->ID'
            AND meta_key = 'clinic'", 'ARRAY_N');


        if ( !empty($subscribers) ){ 
			foreach ($subscribers as $subscriber) { 
				$subscriber_info = get_userdata($subscriber[0]); 
				if ( $subscriber_info->ID == $subscriber_id ) {
					$belongs = true;
					break;
				}
			}
		}
		
	}

	return $belongs;

}

////////////////////// GET LIST OF SUBSCRIBERS THAT BELONG TO A CLINIC  ///////////////
function cda_list_of_clinic_subscribers(){
    global $wpdb;
    global $current_user;
   
    // check to see if $curauth has Clinic role
    if ( in_array('clinic', $current_user->roles) ){

        $subscribers = $wpdb->get_results("SELECT user_id 
            FROM $wpdb->usermeta 
            WHERE meta_value = '$current_user->ID'
            AND meta_key = 'clinic'", 'ARRAY_N');
        

        if ( !empty($subscribers) ){ ?>
	<table id = "myTable" cellspacing="0" class="tablesorter">
	<thead>

		<tr>
			<th>Client Name</th>
			<th>Status</th>
			
		</tr>
	</thead>
	<tbody>
            <ul class="cda_subscribers">  
                <?php foreach ($subscribers as $subscriber) { 
                   
				$subscriber_info = get_userdata($subscriber[0]); 

				$detail_link = add_query_arg( 
							'client_id', 
							$subscriber_info->ID, 
							'http://ritelifedev.com/dieter-records/dieter-purchase-history/' 
						);

				$detail_link = add_query_arg( 	
							'client_name', 
							$subscriber_info->display_name, 
							$detail_link 
						);
		$activity =  $wpdb->get_results("SELECT `id` FROM wp_wpsc_purchase_logs WHERE FROM_UNIXTIME(`date`) > DATE_SUB(now(), INTERVAL 6 MONTH) AND `user_ID`= $subscriber_info->ID;")
		//$activity_count = mysql_num_rows($activity);
		?>

                    
			<tr>
			<td>
                        <a href="<?php echo $detail_link?>"><?php echo $subscriber_info->display_name; ?></a>
			</td>
			<td><?php if ($wpdb->num_rows > 0)
				{
					echo "Active";
				}else
				{
					echo "Inactive";
				}
			?>
				

			</td>
			</tr>
                    

<script>
			jQuery(document).ready(function($) {
    $("#myTable").tablesorter({sortList: [[0,0]]})
});
</script>
                <?php } ?>
	    </tbody>
            </table>
        <?php } else {
            echo 'No subscribers for this clinic.';
        } 
    } // end check for clinic role
}

////////////////////// END GET LIST OF SUBSCRIBERS THAT BELONG TO A CLINIC  ///////////////

function cda_count_dieters(){
    global $wpdb;
    global $current_user; 

    $subscribers = $wpdb->get_var("SELECT count(user_id) 
            FROM $wpdb->usermeta 
            WHERE meta_value = '$current_user->ID'
            AND meta_key = 'clinic'");

    return $subscribers;
}
