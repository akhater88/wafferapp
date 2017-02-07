<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
foreach($results as $rows)
	{
		$Title = stripslashes($rows->News_Title);
		$Newsletter_Content = html_entity_decode($rows->Newsletter_Content,ENT_QUOTES,'UTF-8');
		$Newsletter_Content = stripslashes($Newsletter_Content);
	}
?>
<div class="inner-title"><?php echo $Title;?></div>
<div id="line"><img alt="" src="<?php echo __SCRIPT_PATH;?>images/line.gif" width="600" height="1" /></div>
<?php echo $Newsletter_Content;?>

