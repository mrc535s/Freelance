<script language="javascript" type="text/javascript" src="<?php echo get_option('siteurl'); ?>/wp-content/plugins/news-announcement-scroll/gAnnounce/gAnnounceform.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo get_option('siteurl'); ?>/wp-content/plugins/news-announcement-scroll/gAnnounce/noenter.js"></script>
<style type="text/css">
<!--
.style1 {
	color: #993300;
	font-style: italic;
}
-->
</style>
<form name="gAnnouncefrm" method="post" action="<?php echo @$mainurl; ?>"  onSubmit="return _gAnnounce()">
  <table width="98%" border="0" cellspacing="2" cellpadding="0">
    <tr>
      <td colspan="4"><textarea name="gNews_text" cols="115" rows="6" id="txt_news"><?php echo @$gNews_text_x; ?></textarea></td>
    </tr>
    <tr>
      <td width="128">Display Order :</td>
      <td width="162">Display Status :</td>
      <td width="376">Type (This to group the announcement) :</td>
      <td width="598">Expiration Date (YYYY-MM-DD) : </td>
    </tr>
    <tr>
      <td><input name="gNews_order" value="<?php echo @$gNews_order_x; ?>" type="text" id="txt_order" size="10" maxlength="3" /></td>
      <td><select name="gNews_status" style="width:70px" id="txt_status">
        <option value="">Select</option>
        <option value='Yes' <?php if(@$gNews_status_x=='Yes') { echo 'selected' ; } ?>>Yes</option>
        <option value='No' <?php if(@$gNews_status_x=='No') { echo 'selected' ; } ?>>No</option>
      </select></td>
      <td><input name="gNews_type" type="text" id="gNews_type" maxlength="10" value="<?php echo @$gNews_type_x; ?>" /></td>
      <td>
        <input name="gNews_expiration" type="text" id="txt_expiration" maxlength="10" value="<?php echo @$gNews_expiration_x; ?>" /> 
      </td>
    </tr>
    <tr>
      <td height="50" colspan="4"><input name="publish" lang="publish" class="button-primary" value="<?php echo @$submittext?>" type="submit" /></td>
    </tr>
  </table>
  <input name="gNews_id" id="gNews_id" type="hidden" value="<?php echo @$gNews_id_x; ?>">
</form>
<div align="right" style="padding-top:0px;padding-bottom:5px;"> 
<input name="text_management1" lang="text_management" class="button-primary" onClick="location.href='options-general.php?page=news-announcement-scroll/news-announcement-scroll.php'" value="Go to - Text Management" type="button" />
<input name="setting_management1" lang="setting_management" class="button-primary" onClick="location.href='options-general.php?page=news-announcement-scroll/setting.php'" value="Go to - Gallery Setting" type="button" />
<input name="Help" lang="publish" class="button-primary" onclick="_gHelp()" value="Help" type="button" />
</div>