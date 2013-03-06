<?php

/*
Plugin Name: News announcement scroll
Plugin URI: http://www.gopiplus.com/work/2011/01/01/news-announcement-scroll/
Description: This plug-in will create a vertical scroll news or Announcement for your word press site, we can embed this in site sidebar, Multi language support.
Version: 4
Author: Gopi.R
Author URI: http://www.gopiplus.com/
Donate link: http://www.gopiplus.com/work/2011/01/01/news-announcement-scroll/
*/

/**
 *     News announcement scroll
 *     Copyright (C) 2011  www.gopiplus.com
 * 
 *     This program is free software: you can redistribute it and/or modify
 *     it under the terms of the GNU General Public License as published by
 *     the Free Software Foundation, either version 3 of the License, or
 *     (at your option) any later version.
 * 
 *     This program is distributed in the hope that it will be useful,
 *     but WITHOUT ANY WARRANTY; without even the implied warranty of
 *     MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *     GNU General Public License for more details.
 * 
 *     You should have received a copy of the GNU General Public License
 *     along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

global $wpdb, $wp_version;
define("WP_G_NEWS_ANNOUNCEMENT", $wpdb->prefix . "news_announcement");

function news_announcement()
{
	include_once("gAnnounce/gAnnounce.php");
}

function news_announcement_activation()
{
	global $wpdb;
	
	//set the table
	if($wpdb->get_var("show tables like '". WP_G_NEWS_ANNOUNCEMENT . "'") != WP_G_NEWS_ANNOUNCEMENT) 
	{
		$wpdb->query("
			CREATE TABLE IF NOT EXISTS `". WP_G_NEWS_ANNOUNCEMENT . "` (
			  `gNews_id` int(11) NOT NULL auto_increment,
			  `gNews_text`  TEXT CHARACTER SET utf8 COLLATE utf8_bin NOT NULL ,
			  `gNews_order` int(11) NOT NULL default '0',
			  `gNews_status` VARCHAR(3) NOT NULL default 'No',
			  `gNews_date` datetime NOT NULL default '0000-00-00 00:00:00',
			  `gNews_expiration` DATE NOT NULL default '0000-00-00',
			  PRIMARY KEY  (`gNews_id`) )
			");
	}
	
	$sSql = "ALTER TABLE ". WP_G_NEWS_ANNOUNCEMENT . " ADD `gNews_type` VARCHAR(100) NOT NULL"; 
	$wpdb->query($sSql);
	
	$IsSql = "INSERT INTO `". WP_G_NEWS_ANNOUNCEMENT . "` (`gNews_text`, `gNews_order`, `gNews_status` , `gNews_type` , `gNews_date` , `gNews_expiration` )"; 
	
	$sSql = $IsSql . " VALUES ('This plug-in will create a vertical scrolling announcement news', '1', 'Yes', 'widget', '0000-00-00', '0000-00-00');";
	$wpdb->query($sSql);
	$sSql = $IsSql . " VALUES ('Deze plug-in zal leiden tot een verticaal scrollen aankondiging nieuws', '2', 'Yes', 'widget', '0000-00-00', '0000-00-00');";
	$wpdb->query($sSql);
	$sSql = $IsSql . " VALUES ('Dieses Plug-in wird ein vertikales Scrollen Ankündigung news', '3', 'Yes', 'widget', '0000-00-00', '0000-00-00');";
	$wpdb->query($sSql);
	
	add_option('gNewsAnnouncementtitle', "Announcement");
	add_option('gNewsAnnouncementfont', 'verdana,arial,sans-serif');
	add_option('gNewsAnnouncementfontsize', '11px');
	add_option('gNewsAnnouncementfontweight', 'normal');
	add_option('gNewsAnnouncementfontcolor', '#000000');
	add_option('gNewsAnnouncementwidth', '180');
	add_option('gNewsAnnouncementheight', '100');
	add_option('gNewsAnnouncementslidedirection', '0');
	add_option('gNewsAnnouncementslidetimeout', '3000');
	add_option('gNewsAnnouncementtextalign', 'center');
	add_option('gNewsAnnouncementtextvalign', 'middle');
	add_option('gNewsAnnouncementnoannouncement ', 'No announcement available');
	add_option('gNewsAnnouncementorder', '0');
	add_option('gNewsAnnouncementtype', 'widget');
}

function news_announcement_admin_options() 
{
	?>
    <div class="wrap">
    <?php
    @$mainurl = get_option('siteurl')."/wp-admin/options-general.php?page=news-announcement-scroll/news-announcement-scroll.php";
    ?>
    <h2>News announcement scroll</h2>
    <?php
	global $wpdb;
    @$AID=@$_GET["AID"];
    @$AC=@$_GET["AC"];
    @$rand=$_GET["rand"];
    @$submittext = "Insert Announcement";
	if($AC <> "DEL" and trim(@$_POST['gNews_text']) <>"") { include_once("gAnnounce/gAnnounceins.php"); }
    if($AC=="DEL" && $rand == "76mv1ojtlele176mv1ojtlele1" && $AID > 0) { include_once("gAnnounce/gAnnouncedel.php"); }
    if($AID<>"" and $AC <> "DEL")
    {
        //select query
        $data = $wpdb->get_results("select * from ".WP_G_NEWS_ANNOUNCEMENT." where gNews_id=$AID limit 1");
        //bad feedback
        if ( empty($data) ) 
        {
            echo "";
            return;
        }
        $data = $data[0];
        //encode strings
        if ( !empty($data) ) $gNews_id_x = htmlspecialchars(stripslashes($data->gNews_id)); 
        if ( !empty($data) ) $gNews_text_x = htmlspecialchars(stripslashes($data->gNews_text));
        if ( !empty($data) ) $gNews_order_x = htmlspecialchars(stripslashes($data->gNews_order));
        if ( !empty($data) ) $gNews_status_x = htmlspecialchars(stripslashes($data->gNews_status));
		if ( !empty($data) ) $gNews_expiration_x = htmlspecialchars(stripslashes($data->gNews_expiration));
		if ( !empty($data) ) $gNews_type_x = htmlspecialchars(stripslashes($data->gNews_type));
        @$submittext = "Update Announcement";
    }
    ?>
    <?php include_once("gAnnounce/gAnnounceform.php"); ?>
    <?php include_once("gAnnounce/gAnnouncemanage.php"); ?>
</div>
    <?php
}

function widget_news_announcement($args) 
{
  extract($args);
  echo $before_widget;
  echo $before_title;
  echo get_option('gNewsAnnouncementtitle');
  echo $after_title;
  news_announcement();
  echo $after_widget;
}

function news_announcement_widget_control() 
{
	echo '<p>News announcement scroll.<br><br> To change the setting goto News announcement scroll link under setting menu.<br>';
	echo '<a href="options-general.php?page=news-announcement-scroll/setting.php">';
	echo 'click here</a></p>';
}


function news_announcement_plugins_loaded()
{
	if(function_exists('wp_register_sidebar_widget')) 
	{
		wp_register_sidebar_widget('News announcement scroll', 'News announcement scroll', 'widget_news_announcement');
	}
	
	if(function_exists('wp_register_widget_control')) 
	{
		wp_register_widget_control('News announcement scroll', array('News announcement scroll', 'widgets'), 'news_announcement_widget_control');
	} 
}

function news_announcement_add_to_menu() 
{
	add_options_page('News announcement scroll', 'News announcement scroll', 'manage_options', __FILE__, 'news_announcement_admin_options' );
	add_options_page('News announcement scroll', '', 'manage_options', 'news-announcement-scroll/setting.php','' );
}

if (is_admin()) 
{
	add_action('admin_menu', 'news_announcement_add_to_menu');
}

add_filter('the_content','news_show_filter');

function news_show_filter($content)
{
	return 	preg_replace_callback('/\[NEWS:(.*?)\]/sim','news_show_filter_callback',$content);
}

function news_show_filter_callback($matches) 
{
	global $wpdb;
	
	$scode = $matches[1];
	
	$nas =  "";
	$Ann = "";
	
	list($gNewsAnnouncementtype_main) = split("[:.-]", $scode);
	//[NEWS:TYPE=widget]
	
	list($gNewsAnnouncementtype_cap, $gNewsAnnouncementtype) = split('[=.-]', $scode);
	
	$sSql = "SELECT * from ". WP_G_NEWS_ANNOUNCEMENT . " where gNews_status='Yes' and (`gNews_expiration` >= NOW() or `gNews_expiration` = '0000-00-00')";
	
	if($gNewsAnnouncementtype <> "")
	{ 
		$sSql = $sSql . " and gNews_type='".$gNewsAnnouncementtype."'"; 
	}
	
	if( get_option('gNewsAnnouncementorder') == "1")
	{
		$sSql = $sSql . " ORDER BY rand()";
	}
	else
	{
		$sSql = $sSql . " ORDER BY gNews_order";
	}
	
	//echo $sSql;
	
	$data = $wpdb->get_results($sSql);
	
	$nas = $nas .'<script language="JavaScript" type="text/javascript">';
	$nas = $nas .'v_font="'.get_option('gNewsAnnouncementfont').'"; ';
	$nas = $nas .'v_fontSize="'.get_option('gNewsAnnouncementfontsize').'"; ';
	$nas = $nas .'v_fontSizeNS4="'.get_option('gNewsAnnouncementfontsize').'"; ';
	$nas = $nas .'v_fontWeight="'.get_option('gNewsAnnouncementfontweight').'"; ';
	$nas = $nas .'v_fontColor="'.get_option('gNewsAnnouncementfontcolor').'"; ';
	$nas = $nas .'v_textDecoration="none"; ';
	$nas = $nas .'v_fontColorHover="#FFFFFF"; ';
	$nas = $nas .'v_textDecorationHover="none"; ';
	$nas = $nas .'v_top=0;';
	$nas = $nas .'v_left=0;';
	$nas = $nas .'v_width='.get_option('gNewsAnnouncementwidth').'; ';
	$nas = $nas .'v_height='.get_option('gNewsAnnouncementheight').'; ';
	$nas = $nas .'v_paddingTop=0; ';
	$nas = $nas .'v_paddingLeft=0; ';
	$nas = $nas .'v_position="relative"; ';
	$nas = $nas .'v_timeout='.get_option('gNewsAnnouncementslidetimeout').'; ';
	$nas = $nas .'v_slideSpeed=1;';
	$nas = $nas .'v_slideDirection='.get_option('gNewsAnnouncementslidedirection').'; ';
	$nas = $nas .'v_pauseOnMouseOver=true; ';
	$nas = $nas .'v_slideStep=1; ';
	$nas = $nas .'v_textAlign="'.get_option('gNewsAnnouncementtextalign').'"; ';
	$nas = $nas .'v_textVAlign="'.get_option('gNewsAnnouncementtextvalign').'"; ';
	$nas = $nas .'v_bgColor="transparent"; ';
	$nas = $nas .'</script>';
	
	if ( ! empty($data) ) 
	{
		foreach ( $data as $data ) 
		{ 
			$Ann = $Ann . "['','".$data->gNews_text."',''],";
		}
		$Ann=substr($Ann,0,(strlen($Ann)-1));
	
		$nas = $nas .'<div>';
		$nas = $nas .'<script language="JavaScript" type="text/javascript">';
		$nas = $nas .'v_content=['.$Ann.']';
		$nas = $nas .'</script>';
		$nas = $nas .'<script language="JavaScript" src="'.get_option('siteurl').'/wp-content/plugins/news-announcement-scroll/gAnnounce/gAnnounce.js"></script>';
		$nas = $nas .'</div>';
	}
	return $nas;
}

function news_announcement_deactivate() 
{
	//	delete_option('gNewsAnnouncementtitle');
	//	delete_option('gNewsAnnouncementwidth');
	//	delete_option('gNewsAnnouncementfont');
	//	delete_option('gNewsAnnouncementheight');
	//	delete_option('gNewsAnnouncementfontsize');
	//	delete_option('gNewsAnnouncementslidedirection');
	//	delete_option('gNewsAnnouncementfontweight');
	//	delete_option('gNewsAnnouncementslidetimeout');
	//	delete_option('gNewsAnnouncementfontcolor');
	//	delete_option('gNewsAnnouncementtextalign');
	//	delete_option('gNewsAnnouncementtextvalign');
}


//function news_add_javascript_files() 
//{
//	if (!is_admin())
//	{
//		wp_enqueue_script( 'gAnnounce', get_option('siteurl').'/wp-content/plugins/news-announcement-scroll/gAnnounce/gAnnounce.js','','',true);
//	}	
//}
//
//add_action('init', 'news_add_javascript_files');

register_activation_hook(__FILE__, 'news_announcement_activation');
add_action("plugins_loaded", "news_announcement_plugins_loaded");
register_deactivation_hook( __FILE__, 'news_announcement_deactivate' );
?>