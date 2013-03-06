<div class="wrap">
  <h2>News announcement scroll</h2>
  <?php
global $wpdb, $wp_version;

$gNewsAnnouncementtitle = get_option('gNewsAnnouncementtitle');
$gNewsAnnouncementwidth = get_option('gNewsAnnouncementwidth');
$gNewsAnnouncementfont = get_option('gNewsAnnouncementfont');
$gNewsAnnouncementheight = get_option('gNewsAnnouncementheight');
$gNewsAnnouncementfontsize = get_option('gNewsAnnouncementfontsize');
$gNewsAnnouncementslidedirection = get_option('gNewsAnnouncementslidedirection');
$gNewsAnnouncementfontweight = get_option('gNewsAnnouncementfontweight');
$gNewsAnnouncementslidetimeout = get_option('gNewsAnnouncementslidetimeout');
$gNewsAnnouncementfontcolor = get_option('gNewsAnnouncementfontcolor');
$gNewsAnnouncementtextalign = get_option('gNewsAnnouncementtextalign');
$gNewsAnnouncementtextvalign = get_option('gNewsAnnouncementtextvalign');
$gNewsAnnouncementnoannouncement = get_option('gNewsAnnouncementnoannouncement');
$gNewsAnnouncementorder = get_option('gNewsAnnouncementorder');
$gNewsAnnouncementtype = get_option('gNewsAnnouncementtype');

if (@$_POST['gNewsAnnouncementsubmit']) 
{	
	$gNewsAnnouncementtitle = stripslashes($_POST['gNewsAnnouncementtitle']);
	$gNewsAnnouncementwidth = stripslashes($_POST['gNewsAnnouncementwidth']);
	$gNewsAnnouncementfont = stripslashes($_POST['gNewsAnnouncementfont']);
	$gNewsAnnouncementheight = stripslashes($_POST['gNewsAnnouncementheight']);
	$gNewsAnnouncementfontsize = stripslashes($_POST['gNewsAnnouncementfontsize']);
	$gNewsAnnouncementslidedirection = stripslashes($_POST['gNewsAnnouncementslidedirection']);
	$gNewsAnnouncementfontweight = stripslashes($_POST['gNewsAnnouncementfontweight']);
	$gNewsAnnouncementslidetimeout = stripslashes($_POST['gNewsAnnouncementslidetimeout']);
	$gNewsAnnouncementfontcolor = stripslashes($_POST['gNewsAnnouncementfontcolor']);
	$gNewsAnnouncementtextalign = stripslashes($_POST['gNewsAnnouncementtextalign']);
	$gNewsAnnouncementtextvalign = stripslashes($_POST['gNewsAnnouncementtextvalign']);
	$gNewsAnnouncementnoannouncement = stripslashes($_POST['gNewsAnnouncementnoannouncement']);
	$gNewsAnnouncementorder = stripslashes($_POST['gNewsAnnouncementorder']);
	$gNewsAnnouncementtype = stripslashes($_POST['gNewsAnnouncementtype']);
	
	update_option('gNewsAnnouncementtitle', $gNewsAnnouncementtitle );
	update_option('gNewsAnnouncementwidth', $gNewsAnnouncementwidth );
	update_option('gNewsAnnouncementfont', $gNewsAnnouncementfont );
	update_option('gNewsAnnouncementheight', $gNewsAnnouncementheight );
	update_option('gNewsAnnouncementfontsize', $gNewsAnnouncementfontsize );
	update_option('gNewsAnnouncementslidedirection', $gNewsAnnouncementslidedirection );
	update_option('gNewsAnnouncementfontweight', $gNewsAnnouncementfontweight );
	update_option('gNewsAnnouncementslidetimeout', $gNewsAnnouncementslidetimeout );
	update_option('gNewsAnnouncementfontcolor', $gNewsAnnouncementfontcolor );
	update_option('gNewsAnnouncementtextalign', $gNewsAnnouncementtextalign );
	update_option('gNewsAnnouncementtextvalign', $gNewsAnnouncementtextvalign );
	update_option('gNewsAnnouncementnoannouncement', $gNewsAnnouncementnoannouncement );
	update_option('gNewsAnnouncementorder', $gNewsAnnouncementorder );
	update_option('gNewsAnnouncementtype', $gNewsAnnouncementtype );
}
?>
  <form name="form_gAnnounce" method="post" action="">
    <table width='99%' border='0' cellspacing='0' cellpadding='3'>
      <tr>
        <td width="24%">Title:</td>
        <td width="1%">&nbsp;</td>
        <td width="28%">Text Alignt (left/center/right/justify):</td>
        <td width="1%">&nbsp;</td>
        <td width="46%">Width (only number):</td>
      </tr>
      <tr>
        <td><input name='gNewsAnnouncementtitle' type='text' id='gNewsAnnouncementtitle'  value='<?php echo $gNewsAnnouncementtitle; ?>' size="30" maxlength="100" /></td>
        <td>&nbsp;</td>
        <td><input name='gNewsAnnouncementtextalign' type='text' id='gNewsAnnouncementtextalign'  value='<?php echo $gNewsAnnouncementtextalign; ?>' size="30" maxlength="8" /></td>
        <td>&nbsp;</td>
        <td><input name='gNewsAnnouncementwidth' type='text' id='gNewsAnnouncementwidth'  value='<?php echo $gNewsAnnouncementwidth; ?>' size="30" maxlength="3" /></td>
      </tr>
      <tr>
        <td>Font: </td>
        <td>&nbsp;</td>
        <td>Text Valign (top/middle/bottom):</td>
        <td>&nbsp;</td>
        <td>Height (only number):</td>
      </tr>
      <tr>
        <td><input name='gNewsAnnouncementfont'  type='text' id='gNewsAnnouncementfont' value='<?php echo $gNewsAnnouncementfont; ?>' size="30" /></td>
        <td>&nbsp;</td>
        <td><input name='gNewsAnnouncementtextvalign' type='text' id='gNewsAnnouncementtextvalign'  value='<?php echo $gNewsAnnouncementtextvalign; ?>' size="30" maxlength="6" /></td>
        <td>&nbsp;</td>
        <td><input name='gNewsAnnouncementheight' type='text' id='gNewsAnnouncementheight'  value='<?php echo $gNewsAnnouncementheight; ?>' size="30" maxlength="3" /></td>
      </tr>
      <tr>
        <td>Font Size(Ex:13px):</td>
        <td>&nbsp;</td>
        <td>Font Color (Ex: #000000):</td>
        <td>&nbsp;</td>
        <td>Slide Direction(0=down-up;1=up-down:)</td>
      </tr>
      <tr>
        <td><input name='gNewsAnnouncementfontsize' type='text' id='gNewsAnnouncementfontsize'  value='<?php echo $gNewsAnnouncementfontsize; ?>' size="30" maxlength="6" /></td>
        <td>&nbsp;</td>
        <td><input name='gNewsAnnouncementfontcolor' type='text' id='gNewsAnnouncementfontcolor'  value='<?php echo $gNewsAnnouncementfontcolor; ?>' size="30" maxlength="20" /></td>
        <td>&nbsp;</td>
        <td><input name='gNewsAnnouncementslidedirection' type='text' id='gNewsAnnouncementslidedirection'  value='<?php echo $gNewsAnnouncementslidedirection; ?>' size="30" maxlength="1" /></td>
      </tr>
      <tr>
        <td>Font Weight(blod/normal):</td>
        <td>&nbsp;</td>
        <td>No Announcement Text:</td>
        <td>&nbsp;</td>
        <td>Slide Timeout (1000=1 second):</td>
      </tr>
      <tr>
        <td><input name='gNewsAnnouncementfontweight' type='text' id='gNewsAnnouncementfontweight'  value='<?php echo $gNewsAnnouncementfontweight; ?>' size="30" maxlength="10" /></td>
        <td>&nbsp;</td>
        <td><input name='gNewsAnnouncementnoannouncement' type='text' id='gNewsAnnouncementnoannouncement'  value='<?php echo $gNewsAnnouncementnoannouncement; ?>' size="30" maxlength="200" /></td>
        <td>&nbsp;</td>
        <td><input name='gNewsAnnouncementslidetimeout' type='text' id='gNewsAnnouncementslidetimeout'  value='<?php echo $gNewsAnnouncementslidetimeout; ?>' size="30" maxlength="5" /></td>
      </tr>
      <tr>
        <td colspan="5">Announcement Order </td>
      </tr>
      <tr>
        <td colspan="5"><input name='gNewsAnnouncementorder' type='text' id='gNewsAnnouncementorder'  value='<?php echo $gNewsAnnouncementorder; ?>' size="10" maxlength="1" />
        ( 0 = Display order(it is available in manage page link), 1= Random Order) </td>
      </tr>
      <tr>
        <td colspan="5">Widget Type</td>
      </tr>
      <tr>
        <td colspan="5"><input name='gNewsAnnouncementtype' type='text' id='gNewsAnnouncementtype'  value='<?php echo $gNewsAnnouncementtype; ?>' size="30" maxlength="50" />
        (New feature, This is to group the announcement records.) </td>
      </tr>
      <tr>
        <td height="40" colspan="5" align="left" valign="bottom"><input name="gNewsAnnouncementsubmit" id="gNewsAnnouncementsubmit" lang="publish" class="button-primary" value="Update Setting" type="submit" /></td>
      </tr>
    </table>
  </form>
  <div align="right" style="padding-top:0px;padding-bottom:5px;">
    <input name="text_management1" lang="text_management" class="button-primary" onClick="location.href='options-general.php?page=news-announcement-scroll/news-announcement-scroll.php'" value="Go to - Text Management" type="button" />
    <input name="setting_management1" lang="setting_management" class="button-primary" onClick="location.href='options-general.php?page=news-announcement-scroll/setting.php'" value="Go to - Gallery Setting" type="button" />
  </div>
  <h2>Plugin configuration</h2>
	1. Drag and Drop the widget.<br> 
	2. Add the announcement in the posts or pages using short code.<br> 
	3. Add directly in to the theme using php code.<br> 
	<a target="_blank" href='http://www.gopiplus.com/work/2011/01/01/news-announcement-scroll/'>Click here</a> for configuration help and short code.<br> 
  <h2>About Plugin</h2>
  Plug-in created by <a target="_blank" href='http://www.gopiplus.com/'>www.gopiplus.com</a><br> 
  <a target="_blank" href='http://www.gopiplus.com/work/2011/01/01/news-announcement-scroll/'>Click here</a> to see live demo and tutorial.<br> 
  <br>
</div>
