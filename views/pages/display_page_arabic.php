<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
if($Member == '1')
	{
	?>
	<div style="width:750px">
    <?php
	}
else
	{
	?>
	<div style="width:950px">
    <?php
	}

foreach($results as $rows)
	{
		$Title = stripslashes($rows->Title);
		$Content = html_entity_decode($rows->Content,ENT_QUOTES,'UTF-8');
		$Content = stripslashes($Content);
	}
?>
<h2 class="art-postheader"><?php echo $Title;?></h2>
<?php echo $Content;?>
</div>

