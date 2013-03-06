<?php
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

if(trim(@$_POST['gNews_id']) == "" )
{
	$sql = "insert into ".WP_G_NEWS_ANNOUNCEMENT
			. " set `gNews_text`='" . mysql_real_escape_string(trim($_POST['gNews_text']))
			. "', `gNews_order`='" . mysql_real_escape_string(trim($_POST['gNews_order']))
			. "', `gNews_status`='" . mysql_real_escape_string(trim($_POST['gNews_status']))
			. "', `gNews_type`='" . mysql_real_escape_string(trim($_POST['gNews_type']))
			. "', `gNews_expiration`='" . mysql_real_escape_string(trim($_POST['gNews_expiration']))
			. "', `gNews_date`=NOW();";
}
else
{
	$sql = "update ".WP_G_NEWS_ANNOUNCEMENT
			. " set `gNews_text`='" . mysql_real_escape_string(trim($_POST['gNews_text']))
			. "', `gNews_order`='" . mysql_real_escape_string(trim($_POST['gNews_order']))
			. "', `gNews_status`='" . mysql_real_escape_string(trim($_POST['gNews_status']))
			. "', `gNews_type`='" . mysql_real_escape_string(trim($_POST['gNews_type']))
			. "', `gNews_expiration`='" . mysql_real_escape_string(trim($_POST['gNews_expiration']))
			. "', `gNews_date`=NOW() where gNews_id=".$_POST['gNews_id'].";";

}
$wpdb->get_results($sql);
?>