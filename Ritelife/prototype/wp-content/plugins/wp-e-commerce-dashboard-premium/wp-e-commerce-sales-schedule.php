<?php

/*
 This program is free software; you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, version 2.

 This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.
*/



// Debug output
function debugging_fixme () {
	$settings = get_option ( 'ses_wpscd_csv_schedule' );
	foreach ( array_keys ($settings) as $schedule_id ) {
		if ( $timestamp = wp_next_scheduled('ses_wpscd_cron_export', array((int)$schedule_id)) ) {
			error_log ( "$schedule_id => ".date ( 'Y-m-d H:i', $timestamp ) );
		} else { 
			error_log ( "$schedule_id => Unscheduled" );
		}
	}
}
//add_action ( 'admin_footer', 'debugging_fixme' );



function ses_wpscd_wp_cron_schedules( $schedules ) {

	$schedules['weekly'] = Array ( 'interval' => 604800, 'display' => 'Weekly' );
	return $schedules;

}

add_filter ( 'cron_schedules', 'ses_wpscd_wp_cron_schedules' );



function ses_wpscd_csv_export_switch() {

	// Check if we need to update a schedule and call function
	if ( isset ( $_POST['ses-wpscd-schedule-method'] ) ) {
		ses_wpscd_csv_export_update_schedule();
	}

	// Check if we need to cancel a schedule and call function
	if ( isset ( $_REQUEST['action'] ) && $_REQUEST['action'] == 'pause_schedule' ) {
		ses_wpscd_csv_export_pause_schedule($_REQUEST['schedule_id']);
	}

	if ( isset ( $_REQUEST['action'] ) && $_REQUEST['action'] == 'restart_schedule' ) {
		ses_wpscd_csv_export_restart_schedule($_REQUEST['schedule_id']);
	}

    if ( isset ( $_REQUEST['action'] ) && 'delete_schedule' == $_REQUEST['action'] ) {
        ses_wpscd_csv_export_delete_schedule($_REQUEST['schedule_id']);
    }

	if ( isset ( $_REQUEST['action'] ) && $_REQUEST['action'] == 'edit_schedule' ) {
		ses_wpscd_csv_export_edit_schedule_form();
	} else {
		ses_wpscd_csv_export_list_schedules();
	}

}



function ses_wpscd_csv_export_list_schedules() {

	// Upgrade pre-multi-cron settings here
	ses_wpscd_csv_export_upgrade_old_schedules();

	// Retrieve settings
	$settings = get_option ( 'ses_wpscd_csv_schedule' );

	?>
	<div class="wrap">
		<h2><?php _e("Scheduled Sales Export", 'ses_wpscd'); ?></h2><?php

	if ( ! defined ( 'WPSC_VERSION' ) || WPSC_VERSION < 3.8 ) {
		$base_url = 'admin.php?page=ses_wpscd_csv_export_switch';
	} else {
		$base_url = 'index.php?page=ses_wpscd_csv_export_switch';
	}
	
	if ( is_array ( $settings ) && count ( $settings ) ) {
		echo "<ul>";
		foreach  ( $settings as $schedule_id => $schedule ) {
			if ( ! is_numeric ( $schedule_id ) )
				continue;
			if ( isset ( $schedule['ses-wpscd-schedule-name'] ) ) {
				$name = $schedule['ses-wpscd-schedule-name'];
			} else { 
				$name = __('Unnamed schedule', 'ses_wpscd');
			}
			echo '<li><a href="index.php?page=ses_wpscd_csv_export_switch&action=edit_schedule&schedule_id='.esc_attr($schedule_id).'">'.esc_html($name).'</a>';
			if ( wp_next_scheduled('ses_wpscd_cron_export', array((int)$schedule_id)) ) {
				echo ' <a href="'.wp_nonce_url ( $base_url.'&action=pause_schedule&schedule_id='.esc_attr($schedule_id), 'ses-wpscd-pauseschedule' ).'"><img src="'.WP_PLUGIN_URL.'/wp-e-commerce-dashboard-premium/img/pause.png" alt="'.__('pause','ses_wpscd').'"></a>';
			} else {
				echo ' <a href="'.wp_nonce_url ( $base_url.'&action=restart_schedule&schedule_id='.esc_attr($schedule_id), 'ses-wpscd-restartschedule' ).'"><img src="'.WP_PLUGIN_URL.'/wp-e-commerce-dashboard-premium/img/play.png" alt="'.__('restart','ses_wpscd').'"></a>';
			}
			echo ' <a href="'.wp_nonce_url ( $base_url.'&action=delete_schedule&schedule_id='.esc_attr($schedule_id), 'ses-wpscd-deleteschedule' ).'"><img src="'.WP_PLUGIN_URL.'/wp-e-commerce-dashboard-premium/img/delete.png" alt="'.__('delete','ses_wpscd').'"></a><br/>';


			echo '</li>';
		}
		echo "</ul>";
	}  else {
		echo __('No schedules configured yet.', 'ses_wpscd').'</br>';
	}
	echo '<a href="index.php?page=ses_wpscd_csv_export_switch&action=edit_schedule">Add a schedule</a>';

	?>
		</div><?php
	
}


function ses_wpscd_csv_export_delete_schedule ( $schedule_id ) {

    check_admin_referer ( 'ses-wpscd-deleteschedule' );

	$settings = get_option ( 'ses_wpscd_csv_schedule' );
    
    if ( ! isset ( $settings[$schedule_id] ) ) {
        echo '<div class="error">'.__('Unable to find schedule to delete', 'ses_wpscd').'</div>';
        return;
    } else {
        unset ( $settings[$schedule_id] );
        update_option ( 'ses_wpscd_csv_schedule', $settings );
    }

    $timestamp = wp_next_scheduled ( 'ses_wpscd_cron_export', array ( (int) $schedule_id ) );
    wp_unschedule_event ( $timestamp, 'ses_wpscd_cron_export', array ( (int) $schedule_id ) );

    ?>
		<div class="updated">
			<?php _e('Schedule deleted', 'ses_wpscd'); ?>
		</div>
    <?php
}

function ses_wpscd_csv_export_pause_schedule( $schedule_id ) {

	check_admin_referer( 'ses-wpscd-pauseschedule' );

	$timestamp = wp_next_scheduled('ses_wpscd_cron_export', array((int)$schedule_id));
	wp_unschedule_event ( $timestamp, 'ses_wpscd_cron_export', array((int)$schedule_id) );

	?>
		<div class="updated">
			<?php _e('Schedule paused', 'ses_wpscd'); ?>
		</div>
	<?php

}



function ses_wpscd_csv_export_restart_schedule( $schedule_id ) {

	check_admin_referer( 'ses-wpscd-restartschedule' );

	// Schedule the next export
	$next_run_time = ses_wpscd_schedule_next_run_time($schedule_id);

	?>
		<div class="updated">
			<?php printf( __('Schedule restarted - next export at %s', 'ses_wpscd'), date ( 'jS F Y H:i', $next_run_time ) ); ?>
		</div>
	<?php

}



function ses_wpscd_csv_export_update_schedule() {

	global $can_view_store_reports; 

	if ( ! $can_view_store_reports && ! current_user_can ( 'schedule_store_reports' ) )
		return;

	$settings = get_option ( 'ses_wpscd_csv_schedule' );

	// Adding / updating a schedule
	if ( isset ( $_POST['ses-wpscd-schedule-method'] ) ) {

		check_admin_referer( 'ses-wpscd-schedulesettings' );

		foreach ($_POST as $key => $value) {
			if ( strpos ( $key, 'ses-wpscd' ) === 0 || strpos ( $key, 'ses_wpscd' ) === 0 )
				$temp_settings[$key] = $value;
		}
		$temp_settings['ses-wpscd-last-export-time'] = time();

		if ( isset ( $_POST['schedule_id'] ) && is_numeric ( $_POST['schedule_id'] ) ) {
			$settings[$_POST['schedule_id']] = $temp_settings;
		} else { 
			$settings[] = $temp_settings;
			end($settings); $idx = key($settings);
			$_POST['schedule_id'] = $idx;
		}

		update_option('ses_wpscd_csv_schedule', $settings);

		// Clear any existing scheduled exports for this schedule
		if ( isset ( $_POST['schedule_id'] ) && is_numeric ( $_POST['schedule_id'] ) ) {
			wp_unschedule_event ( 'ses_wpscd_cron_export', array ((int)$_POST['schedule_id']) );
		}

		// Schedule the next export
		$next_run_time = ses_wpscd_schedule_next_run_time($_POST['schedule_id']);

		?>
			<div class="updated">
				<?php printf( __('Schedule updated - next export at %s', 'ses_wpscd'), date ( 'jS F Y H:i', $next_run_time ) ); ?>
			</div>
		<?php

	}

}



function ses_wpscd_csv_export_edit_schedule_form() {

	global $can_view_store_reports; 

	if ( ! $can_view_store_reports && ! current_user_can ( 'schedule_store_reports' ) )
		return;

	$settings = get_option ( 'ses_wpscd_csv_schedule' );

	// Get the settings if we're editing an existing schedule
	if ( isset ( $_REQUEST['schedule_id'] ) ) {

		$schedule_id = $_REQUEST['schedule_id'];
		if ( isset ( $settings[$schedule_id] ) ) {
			$schedule_settings = $settings[$schedule_id];
			$adding = FALSE;
		} else {
			$schedule_settings = Array();
			unset ( $schedule_id ) ;
			$adding = TRUE;
		}

	} else {

		$schedule_settings = Array();
		$adding = TRUE;

	}

	if ( isset ( $schedule_settings['ses-wpscd-schedule-folder'] ) && ! is_file ( $schedule_settings['ses-wpscd-schedule-folder'].'.htaccess' ) ) { 

		if ( isset ( $_REQUEST['fixhtaccess'] ) ) {
			ses_wpscd_create_htaccess( $schedule_settings['ses-wpscd-schedule-folder'] );
		} else { ?>
			<div class="error"><strong><?php _e('WARNING', 'ses_wpscd'); ?></strong>: <?php _e ( 'Your download folder does not appear to be protected, and your downloads may be available to site visitors, and search engines.', 'ses_wpscd'); ?> <a href="index.php?page=ses_wpscd_csv_export_schedule&fixhtaccess=true"><?php _e( '(Fix)', 'ses_wpscd' ); ?></a></div>
	<?php }

	}

	?>
	<div class="wrap">
		<h2><?php _e("Scheduled Sales Export", 'ses_wpscd'); ?></h2>
		<?php
		if ( isset ( $schedule_id ) && $next_scheduled = wp_next_scheduled('ses_wpscd_cron_export', array((int)$schedule_id) ) ) {
				?> <div class="updated">
				<?php _e('Next export: ', 'ses_wpscd'); echo date ( 'jS F Y H:i', $next_scheduled ) ;
				?> GMT</div><?php
		}
		?>
		<p>
		<?php
			if ( ! defined ( 'WPSC_VERSION' ) || WPSC_VERSION < 3.8 ) {
				$form_url = 'admin.php?page=ses_wpscd_csv_export_switch';
			} else {
				$form_url = 'index.php?page=ses_wpscd_csv_export_switch';
			}
		?>
		<form action="<?php esc_attr_e($form_url); ?>" method="POST" id="ses-wpscd-csv-schedule-setup">
		<?php if (function_exists('wp_nonce_field')) { wp_nonce_field('ses-wpscd-schedulesettings');} ?>
		<?php if ( ! $adding ) : ?>
			<input type="hidden" name="schedule_id" value="<?php esc_attr_e ( $schedule_id ); ?>">
		<?php endif; ?>
		<label for="ses-wpscd-schedule-name"><?php _e('Name: ', 'ses_wpscd'); ?></label>
		<input type="text" name="ses-wpscd-schedule-name" value="<?php if ( ! $adding && isset ( $schedule_settings['ses-wpscd-schedule-name'] ) ) esc_attr_e($schedule_settings['ses-wpscd-schedule-name']); else _e('Unnamed Schedule', 'ses_wpscd'); ?>"><br/>
		<label for="ses-wpscd-schedule-method"><?php _e('Schedule report and ', 'ses_wpscd'); ?></label>
		<select name="ses-wpscd-schedule-method" id="ses-wpscd-schedule-method">
		    <option value="email" <?php if ( ! $adding && $schedule_settings['ses-wpscd-schedule-method'] == 'email' ) echo "selected=\"selected\""; ?>><?php _e('Email to ...'); ?></option>
		    <option value="file" <?php if ( ! $adding && $schedule_settings['ses-wpscd-schedule-method'] == 'file' ) echo "selected=\"selected\""; ?>><?php _e('Save to file'); ?></option>
		</select>
		<span id="ses-wpscd-schedule-email" style="display: none;">
			<input id="ses-wpscd-schedule-email-address" name="ses-wpscd-schedule-email-address" <?php if ( ! $adding && isset ( $schedule_settings['ses-wpscd-schedule-email-address'] ) ) echo 'value="'.esc_attr($schedule_settings['ses-wpscd-schedule-email-address']).'"'; ?>><br/>
			<font color="#f00;"><strong><?php _e( 'Warning: ', 'ses_wpscd' ); ?></strong>Details are sent <strong>unencrypted</strong>. You take full responsibility for the security of information sent by email. If in doubt, schedule your report to a file and arrange to download it securely from there.</font>
		</span>
		<div id="ses-wpscd-schedule-file" style="display: none;">
			<br/>
			<?php _e('Your file will be stored here: ', 'ses_wpscd'); ?>

				<input name="ses-wpscd-schedule-folder" type="hidden" value="<?php esc_attr_e($schedule_settings['ses-wpscd-schedule-folder'] = ses_wpscd_schedule_folder(isset($schedule_id) ? $schedule_id : null )); ?>">
				<input name="ses-wpscd-schedule-filename" type="hidden" value="<?php esc_attr_e($schedule_settings['ses-wpscd-schedule-filename'] = ses_wpscd_schedule_filename(isset($schedule_id) ? $schedule_id : null)); ?>">

				<?php 
				if ( empty ( $schedule_settings['ses-wpscd-schedule-folder'] ) || empty ( $schedule_settings['ses-wpscd-schedule-filename'] ) ) {
					_e ( "We're sorry - we're unable to create a secure download location for your exports." ) ;
				} else {
					echo esc_html ( $schedule_settings['ses-wpscd-schedule-folder'] . $schedule_settings['ses-wpscd-schedule-filename'] ) ;
				}

			?>
		</div>
		</p>
		<p>
		<label for="ses-wpscd-schedule-freq"><?php _e('Report runs', 'ses_wpscd'); ?></label> 
		<select name="ses-wpscd-schedule-freq" id="ses-wpscd-schedule-freq">
			<option value="hourly" <?php if ( ! $adding && $schedule_settings['ses-wpscd-schedule-freq'] == 'hourly' ) echo "selected=\"selected\""; ?>><?php _e('Hourly', 'ses_wpscd'); ?></option>
			<option value="daily" <?php if ( ! $adding && $schedule_settings['ses-wpscd-schedule-freq'] == 'daily' ) echo "selected=\"selected\"";?>><?php _e('Daily', 'ses_wpscd'); ?></option>
			<option value="weekly" <?php if ( ! $adding && $schedule_settings['ses-wpscd-schedule-freq'] == 'weekly' ) echo "selected=\"selected\"";?>><?php _e('Weekly', 'ses_wpscd'); ?></option>
		</select>
		<span id="ses-wpscd-schedule-weekly" style="display: none;">
		every 
			<select name="ses-wpscd-schedule-day">
				<option value="0" <?php if ( ! $adding && $schedule_settings['ses-wpscd-schedule-day'] == 0 ) echo "selected=\"selected\""; ?>>Sunday</option>
				<option value="1" <?php if ( ! $adding && $schedule_settings['ses-wpscd-schedule-day'] == 1 ) echo "selected=\"selected\""; ?>>Monday</option>
				<option value="2" <?php if ( ! $adding && $schedule_settings['ses-wpscd-schedule-day'] == 2 ) echo "selected=\"selected\""; ?>>Tuesday</option>
				<option value="3" <?php if ( ! $adding && $schedule_settings['ses-wpscd-schedule-day'] == 3 ) echo "selected=\"selected\""; ?>>Wednesday</option>
				<option value="4" <?php if ( ! $adding && $schedule_settings['ses-wpscd-schedule-day'] == 4 ) echo "selected=\"selected\""; ?>>Thursday</option>
				<option value="5" <?php if ( ! $adding && $schedule_settings['ses-wpscd-schedule-day'] == 5 ) echo "selected=\"selected\""; ?>>Friday</option>
				<option value="6" <?php if ( ! $adding && $schedule_settings['ses-wpscd-schedule-day'] == 6 ) echo "selected=\"selected\""; ?>>Saturday</option>
			</select>
		</span>
		<span id="ses-wpscd-schedule-daily" style="display: none;">
		at
			<select name="ses-wpscd-schedule-hour">
				<option value="0" <?php if ( ! $adding && $schedule_settings['ses-wpscd-schedule-hour'] == 0 ) echo "selected=\"selected\""; ?>>00</option>
				<option value="1" <?php if ( ! $adding && $schedule_settings['ses-wpscd-schedule-hour'] == 1 ) echo "selected=\"selected\""; ?>>01</option>
				<option value="2" <?php if ( ! $adding && $schedule_settings['ses-wpscd-schedule-hour'] == 2 ) echo "selected=\"selected\""; ?>>02</option>
				<option value="3" <?php if ( ! $adding && $schedule_settings['ses-wpscd-schedule-hour'] == 3 ) echo "selected=\"selected\""; ?>>03</option>
				<option value="4" <?php if ( ! $adding && $schedule_settings['ses-wpscd-schedule-hour'] == 4 ) echo "selected=\"selected\""; ?>>04</option>
				<option value="5" <?php if ( ! $adding && $schedule_settings['ses-wpscd-schedule-hour'] == 5 ) echo "selected=\"selected\""; ?>>05</option>
				<option value="6" <?php if ( ! $adding && $schedule_settings['ses-wpscd-schedule-hour'] == 6 ) echo "selected=\"selected\""; ?>>06</option>
				<option value="7" <?php if ( ! $adding && $schedule_settings['ses-wpscd-schedule-hour'] == 7 ) echo "selected=\"selected\""; ?>>07</option>
				<option value="8" <?php if ( ! $adding && $schedule_settings['ses-wpscd-schedule-hour'] == 8 ) echo "selected=\"selected\""; ?>>08</option>
				<option value="9" <?php if ( ! $adding && $schedule_settings['ses-wpscd-schedule-hour'] == 9 ) echo "selected=\"selected\""; ?>>09</option>
				<option value="10" <?php if ( ! $adding && $schedule_settings['ses-wpscd-schedule-hour'] == 10 ) echo "selected=\"selected\""; ?>>10</option>
				<option value="11" <?php if ( ! $adding && $schedule_settings['ses-wpscd-schedule-hour'] == 11 ) echo "selected=\"selected\""; ?>>11</option>
				<option value="12" <?php if ( ! $adding && $schedule_settings['ses-wpscd-schedule-hour'] == 12 ) echo "selected=\"selected\""; ?>>12</option>
				<option value="13" <?php if ( ! $adding && $schedule_settings['ses-wpscd-schedule-hour'] == 13 ) echo "selected=\"selected\""; ?>>13</option>
				<option value="14" <?php if ( ! $adding && $schedule_settings['ses-wpscd-schedule-hour'] == 14 ) echo "selected=\"selected\""; ?>>14</option>
				<option value="15" <?php if ( ! $adding && $schedule_settings['ses-wpscd-schedule-hour'] == 15 ) echo "selected=\"selected\""; ?>>15</option>
				<option value="16" <?php if ( ! $adding && $schedule_settings['ses-wpscd-schedule-hour'] == 16 ) echo "selected=\"selected\""; ?>>16</option>
				<option value="17" <?php if ( ! $adding && $schedule_settings['ses-wpscd-schedule-hour'] == 17 ) echo "selected=\"selected\""; ?>>17</option>
				<option value="18" <?php if ( ! $adding && $schedule_settings['ses-wpscd-schedule-hour'] == 18 ) echo "selected=\"selected\""; ?>>18</option>
				<option value="19" <?php if ( ! $adding && $schedule_settings['ses-wpscd-schedule-hour'] == 19 ) echo "selected=\"selected\""; ?>>19</option>
				<option value="20" <?php if ( ! $adding && $schedule_settings['ses-wpscd-schedule-hour'] == 20 ) echo "selected=\"selected\""; ?>>20</option>
				<option value="21" <?php if ( ! $adding && $schedule_settings['ses-wpscd-schedule-hour'] == 21 ) echo "selected=\"selected\""; ?>>21</option>
				<option value="22" <?php if ( ! $adding && $schedule_settings['ses-wpscd-schedule-hour'] == 22 ) echo "selected=\"selected\""; ?>>22</option>
				<option value="23" <?php if ( ! $adding && $schedule_settings['ses-wpscd-schedule-hour'] == 23 ) echo "selected=\"selected\""; ?>>23</option>
			</select>
			:
			<select name="ses-wpscd-schedule-minute">
				<option value="0" <?php if ( ! $adding && $schedule_settings['ses-wpscd-schedule-minute'] == 0 ) echo "selected=\"selected\""; ?>>00</option>
				<option value="15" <?php if ( ! $adding && $schedule_settings['ses-wpscd-schedule-minute'] == 15 ) echo "selected=\"selected\""; ?>>15</option>
				<option value="30" <?php if ( ! $adding && $schedule_settings['ses-wpscd-schedule-minute'] == 30 ) echo "selected=\"selected\""; ?>>30</option>
				<option value="45" <?php if ( ! $adding && $schedule_settings['ses-wpscd-schedule-minute'] == 45 ) echo "selected=\"selected\""; ?>>45</option>
				<option value="55" <?php if ( ! $adding && $schedule_settings['ses-wpscd-schedule-minute'] == 55 ) echo "selected=\"selected\""; ?>>55</option>
			</select>
			GMT
		</span>
		</p>
		<p>
  			<label for='ses-wpscd-schedule-linesororders'><?php _e('Download:', 'ses_wpscd'); ?></label><br/>
  			<select id='ses-wpscd-schedule-linesororders' name='ses-wpscd-schedule-linesororders'>
				<option value="orders" <?php if ( ! $adding && $schedule_settings['ses-wpscd-schedule-linesororders'] == 'orders' ) echo 'selected="selected"'; ?>><?php _e('Orders', 'ses_wpscd'); ?></option>
				<option value="lines" <?php if ( ! $adding && $schedule_settings['ses-wpscd-schedule-linesororders'] == 'lines' ) echo 'selected="selected"'; ?>><?php _e('Order Lines', 'ses_wpscd'); ?></option>
  			</select>
			<br />
  			<label for='ses-wpscd-schedule-statuses'><?php _e('Order Statuses:', 'ses_wpscd'); ?></label>
			<br />
			<?php
			if ( isset ( $schedule_settings['ses-wpscd-schedule_status'] ) ) {
				ses_wpscd_order_status_filter('ses-wpscd-schedule-status', $schedule_settings['ses-wpscd-schedule-status']);
			} else {
				ses_wpscd_order_status_filter('ses-wpscd-schedule-status', array());
			} ?>
			<?php if ( ! $adding ) {
				ses_wpscd_csv_fields_selection( $schedule_id);
			} else {
				ses_wpscd_csv_fields_selection( FALSE );
			} ?>
		</p>
		<p>
		<?php if ( ! $adding ) { ?>
			<input type="submit" class="button-primary" value="<?php _e('Update and reschedule export', 'ses_wpscd'); ?>"></p>
		<?php } else { ?>
			<input type="submit" class="button-primary" value="<?php _e('Add and schedule export', 'ses_wpscd'); ?>"></p>
		<?php } ?>
		<?php _e ( '<strong>Note:</strong> The export is run via WordPress cron, and will run "close" to the time specified, but not necessarily at the exact minute. The export will pick up all results since it was last run. ', 'ses_wpscd' ); ?>
		</form>
		<script type="text/javascript">
			jQuery(document).ready(function(){

				if (jQuery('#ses-wpscd-schedule-freq').val() == 'hourly') {
					
				} else if ( jQuery('#ses-wpscd-schedule-freq').val() == 'daily') {
					jQuery('#ses-wpscd-schedule-daily').fadeIn();
				} else {
					jQuery('#ses-wpscd-schedule-daily').fadeIn();
					jQuery('#ses-wpscd-schedule-weekly').fadeIn();
				}

				jQuery('#ses-wpscd-schedule-freq').change(function(){
					if (jQuery(this).val() == 'hourly') {
						jQuery('#ses-wpscd-schedule-daily').fadeOut();
						jQuery('#ses-wpscd-schedule-weekly').fadeOut();
					} else if (jQuery(this).val() == 'daily') {
						jQuery('#ses-wpscd-schedule-daily').fadeIn();
						jQuery('#ses-wpscd-schedule-weekly').fadeOut();
					} else {
						jQuery('#ses-wpscd-schedule-weekly').fadeIn();
						jQuery('#ses-wpscd-schedule-daily').fadeIn();
					}
				});

				if (jQuery('#ses-wpscd-schedule-method').val() == 'file') {
					jQuery('#ses-wpscd-schedule-file').fadeIn();
				} else {
					jQuery('#ses-wpscd-schedule-email').fadeIn();
				}

				jQuery('#ses-wpscd-schedule-method').change(function(){
					if (jQuery(this).val() == 'file') {
						jQuery('#ses-wpscd-schedule-email').fadeOut();
						jQuery('#ses-wpscd-schedule-file').fadeIn();
					} else {
						jQuery('#ses-wpscd-schedule-file').fadeOut();
						jQuery('#ses-wpscd-schedule-email').fadeIn();
					}
				});

				jQuery(document).ready(function(){
					jQuery('#ses-wpscd-csv-choose-fields-button').click(function(){
						jQuery('#ses-wpscd-csv-choose-fields-button-span').fadeOut();
						jQuery('#ses-wpscd-csv-fields-selection').fadeIn();
					});
				});

			});
		</script>
	</div>
	<?php

}



?>
