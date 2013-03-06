<div class="tool-box">
<?php
//select query
$data = $wpdb->get_results("select * from ".WP_G_NEWS_ANNOUNCEMENT." order by gNews_status desc,gNews_order");

//bad feedback
if ( empty($data) ) 
{ 
	echo "<div id='message' class='error'><p>No Announcement Available in Database! Creat New.</p></div>";
	return;
}
?>
<script language="javascript" type="text/javascript">
function _dealdelete(id)
{
	if(confirm("Do you want to delete this record?"))
	{
		document.frm.action="options-general.php?page=news-announcement-scroll/news-announcement-scroll.php&AC=DEL&rand=76mv1ojtlele176mv1ojtlele1&AID="+id;
		document.frm.submit();
	}
}	
</script>
<form name="frm" method="post">
<table width="100%" class="widefat" id="straymanage">
<thead>
    <tr>
        <th align="left">News</th>
        <th align="left">Order</th>
        <th align="left">Status</th>
        <th align="left">Type</th>
        <th align="left">Expiration</th>
        <th width="8%" align="left">Action</th>
    </tr>
<thead>
<tbody>
	<?php 
    $i = 0;
    foreach ( $data as $data ) { 
    ?>
    <tr class="<?php if ($i&1) { echo'alternate'; } else { echo ''; }?>">
        <td align="left"><?php echo(stripslashes($data->gNews_text)); ?></td>
        <td align="left"><?php echo(stripslashes($data->gNews_order)); ?></td>
        <td align="left"><?php echo(stripslashes($data->gNews_status)); ?></td>
        <td align="left"><?php echo(stripslashes($data->gNews_type)); ?></td>
        <td align="left"><?php echo($data->gNews_expiration); ?></td>
        <td align="left">
            <a href="options-general.php?page=news-announcement-scroll/news-announcement-scroll.php&AID=<?php echo $data->gNews_id?>">Edit</a> 
            &nbsp; 
            <a onClick="javascript:_dealdelete('<?php echo($data->gNews_id); ?>')" href="javascript:void(0);">Delete</a>        </td>
    </tr>
    <?php $i = $i+1; } ?>
</tbody>
</table>
<table cellspacing="3"><tr><td align="left">
<h2>Note</h2>
<p>In front end widget area, if you see any news content out of area or invisible, it because of height and width of the widget, so you should arrange width and height of the widget in widget configuration area to good look. In default I have fixed width: 180px and height: 100px.
</p>
<p>1. We disabled enter key from above text area, to break the line type &lt;br&gt;. <br />2. add your Announcement record by record <br />3. 0000-00-00 is equal to no expiration.</p>
<h2>About Plugin</h2>
Plug-in created by <a target="_blank" href='http://www.gopiplus.com/'>www.gopiplus.com</a><br> 
<a target="_blank" href='http://www.gopiplus.com/work/2011/01/01/news-announcement-scroll/'>Click here</a> to see live demo and tutorial. <br> 
<br>
</td>
</tr></table>
</form>
</div>
