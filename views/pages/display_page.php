<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
foreach($results as $rows)
	{
		$Title = stripslashes($rows->Title);
		$Content = html_entity_decode($rows->Content,ENT_QUOTES,'UTF-8');
		$Content = stripslashes($Content);
	}
?>
<div id="text-titles">
<table style="width: 100%" cellspacing="0" cellpadding="0">
<tr><td align="center" valign="middle"><img alt="" src="<?php echo __SCRIPT_PATH;?>images/<?php echo $Image_Source;?>.png" /></td></tr></table>
</div>
<div id="text-middle">
<table style="width: 100%" cellspacing="0" cellpadding="0">
		<tr>
			<td><?php echo $Content;?></td>
		</tr>
		</table>

</div>

