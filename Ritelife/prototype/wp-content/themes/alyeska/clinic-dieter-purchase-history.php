<?php
/*
Template Name: Clinics Dieters Purchase Detail
*/
?>

<?php
/**
 *
 * Alyeska WordPress Theme
 * Standard Page
 *
 * This file displays each standard page.
 *
 * @author  Jason Bobich
 *
 */
?>
<?php if ( is_user_logged_in() ) : ?>
<?php include(TEMPLATEPATH."/header2.php");?>
<?php else: ?>
<?php include(TEMPLATEPATH."/header.php");?>
<?php endif; ?>

<?php if($themeblvd_sidebar == 'left') : ?>
	<?php get_sidebar(); ?>	
<?php endif; ?>

<div id="content">
	
	<?php themeblvd_breadcrumbs(); ?>
	
	<?php the_post(); ?>
	
	<?php if( $themeblvd_theme_hints == 'true' ) : ?>
        <?php echo themeblvd_theme_hints('page'); ?>
    <?php endif; ?>
	
	<?php if( get_post_meta($post->ID, 'themeblvd_pagetitle', true) != 'false' ) : ?>
	<h1><?php the_title(); ?></h1>
	<?php endif; ?>
	
	<div class="page">
		
		<div class="top"><!-- --></div>
			
<?php //show purchase history for current user
		
	global $current_user, $wpdb, $table_prefix;

	get_currentuserinfo();

	$user_roles = $current_user->roles;
	$user_role = array_shift($user_roles);

	if ( $user_role == 'clinic' ) {
		$target_user_id = $_GET["client_id"];
		$target_name = $_GET["client_name"];

		if ( ! cda_subscribes_to_clinic( $target_user_id ) ) {
			die ("Unauthorized");
		}
	}
	else {
		$target_user_id = $current_user->ID;
		$target_name 	= $current_user->display_name;
	}
	

	echo '<h3>Purchase History</h3>';

	
	echo "<div style='width:200px; padding:10px;'>";    
	echo "Customer Sales Log - $target_name";

	
	echo '</div>';
	
	$grand_total = 0;
	
	if(is_numeric($current_user->ID) && ($current_user->ID > 0)) {		
		$sql = "SELECT p.`id`, c.`name`, p.`date`, p.`totalprice`, p.`processed`, p.`sessionid`, c.`quantity` FROM `".WPSC_TABLE_PURCHASE_LOGS."` AS p, `".WPSC_TABLE_CART_CONTENTS."` AS c WHERE p.`id`=c.`purchaseid` AND p.`user_ID`=$target_user_id ORDER BY `date` DESC";
        $purchase_log = $wpdb->get_results($sql,ARRAY_A);	
				
		
		if($purchase_log != null) {	// this user has made some purchase 
			echo "<div style='margin-top: 10px; padding:10px; border-style:solid; border-width:1px; border-color:#DDD;'>";
	echo "<span>To: <input type='text' id='mindate' /> From: <input type='text' id='maxdate' />  <input style='margin:10px 10px 10px 10px;' type='button' onclick = 'showAll();' value='Show All' /></span>";
	echo "</div>";
	echo "<script>

jQuery(document).ready(function() {
    jQuery.datepicker.setDefaults({ dateFormat: 'dd/mm/yy' });
    jQuery('#mindate').val('');
    jQuery('#maxdate').val('');
    jQuery('#mindate, #maxdate')
        .datepicker()
        .on('input keyup change', filter);
});

function showAll()
{
	jQuery('#mindate').val('');
	jQuery('#maxdate').val('');
	filter();
}

//FILTERS TABLE BASED ON DATES ENTERED IN FIELDS

function filter(){
    jQuery('tr').show();
    var datefields = jQuery('table.widefat tr td:nth-child(3)');
    datefields.each(function(){
        var evdate = pdate(jQuery(this).html());
        var mindate = pdate(jQuery('#mindate').val());
        if (mindate)
            if (evdate < mindate)
                jQuery(this).parent().hide();
        var maxdate = pdate(jQuery('#maxdate').val());
        if (maxdate)
            if (evdate > maxdate)
                jQuery(this).parent().hide();
    });
	getNewTotal();

}

//GETS NEW TOTAL EACH TIME NEW DATE IS SELECTED
function getNewTotal()
{
	var itemTotal = jQuery('table.widefat tr td:nth-child(4)');
	var newTotal = 0.0;
	var thisTotal;
	itemTotal.each(function(){
        if ( jQuery(this).is(':visible') ) {
		thisTotal = jQuery(this).text();
		var conTotal = Number(thisTotal.replace(/[^0-9\.]+/g,''));
    		newTotal = newTotal + conTotal;
	} 
	
	
    });
	jQuery('#total').html('<strong>$' + newTotal.toFixed(2) + '</strong>');
	
}


function pdate(str){
    if (!isValidDate(str))
        return false;
    var parts = str.split('/');
    return new Date(parts[2], parts[1]-1, parts[0]);
}


//VALIDATES DATE ENTERED
function isValidDate(date)
{    
    parts = date.split('/');
    if (parts.length != 3)
        return false;
    else if (parts[0] == '' || /[^0-9]/.test(parts[0]) || parts[1] == '' || /[^0-9]/.test(parts[1]) || parts[2] == '' || /[^0-9]/.test(parts[2]))
        return false;
    
    day = parts[0];
    month = parts[1];
    year = parts[2];
    
    if (year >= 1800 && year <= 2200) //define the limits of valid dates
    {
        if (day > 0 && day <= 31 && month > 0 && month <= 12)
        {  
            if ((month == 4 || month == 6 || month == 9 || month == 11) && day > 30)
                return false;
            if (month == 2)
            {
                if (year%4 == 0 && (year%100 != 0 || year%400==0))
                {
                    if (day > 29)
                        return false; 
                }
                else if (day > 28)
                    return false;
            }
            return true;
        }
        else
            return false;
    }
    else
        return false;
}

  </script>";
echo "<div style='clear:both;padding:10px'>";
			echo "<table class='widefat' id='itemTable' style='width:100%'>";			
			foreach((array)$purchase_log as $purchase) {	
				
				$sql = "SELECT * FROM `".WPSC_TABLE_DOWNLOAD_STATUS."` WHERE `purchid`=".$purchase['id']." AND `active` IN ('1') ORDER BY `datetime` DESC";
				
				$products = $wpdb->get_results($sql,ARRAY_A) ;			
				$isOrderAccepted = $purchase['processed'];
				
				foreach ((array)$products as $product){					
					if($isOrderAccepted > 1){
						if($product['uniqueid'] == null) {  
							$links = get_option('siteurl')."?downloadid=".$product['id'];
						} else {
							$links = get_option('siteurl')."?downloadid=".$product['uniqueid'];
						}																				
						$download_count = $product['downloads'];
					}
				}	

										
				echo '<tr>';
				echo '<td>'.$purchase['name'].'</td>';
				echo '<td>  &nbsp;&nbsp; x'.$purchase['quantity'].'&nbsp;&nbsp;&nbsp;&nbsp;</td>';
				echo '<td>'.date("d/m/Y",$purchase['date']).'</td>';
				echo '<td>'.nzshpcrt_currency_display( $purchase['totalprice'], 1, false, false, false ).'</td>';		        
				$grand_total += $purchase['totalprice'];
				echo '</tr>';							
			}
			echo '<tr>';
			echo "<td colspan='4'><strong>Total Spent</strong></td>";
			echo "<td id='total'><strong>".nzshpcrt_currency_display( $grand_total, 1, false, false, false ).'</strong></td>';
			echo '</tr>';
			echo '</table>';	
		} else
		{			
			echo 'No transactions found.';			
		}        
		echo '</div>';
		echo '<div style="clear:both;"></div>';
	} else {		
		echo 'You must be logged in to use this page.';
	}
?>
		
		
		

		<div style="background: none #DDD;padding:10px">
		   NOTE: Taxes and shipping not included above
		</div>	
		
		<div class="clear"></div>
		
		<div class="bottom"></div>
		
	</div><!-- .page (end) -->
	
</div><!-- #content (end) -->

<?php if($themeblvd_sidebar == 'right') : ?>
	<?php get_sidebar(); ?>	
<?php endif; ?> 

<?php get_footer(); ?>