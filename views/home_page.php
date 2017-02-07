<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<div id="content-1">

<table style="width: 100%" cellpadding="0" cellspacing="0" class="style1">
	<tr>
	<td valign="top" style="width:254px; background-image:url('<?php echo __SCRIPT_PATH;?>images/bd-td.jpg'); background-repeat:repeat-y;">
	<div id="red-box">
<div id="red-top-title"><img alt="" src="<?php echo __SCRIPT_PATH;?>images/latest-news.png" width="118" height="22" /></div>
<div id="red-middle">
<div class="newsticker-jcarousellite">
<ul>
<?php
$news_ticker = new myfunctions();
$news_ticker->news_ticker();
foreach($about_results as $rows)
	{
		$About_Title = stripslashes($rows->Title);
		$About_Content = html_entity_decode($rows->Content,ENT_QUOTES,'UTF-8');
		$About_Content = stripslashes($About_Content);
	}
foreach($results as $rows)
	{
		$Title = stripslashes($rows->Title);
		$Content = html_entity_decode($rows->Content,ENT_QUOTES,'UTF-8');
		$Content = stripslashes($Content);
	}
foreach($video_results as $rows)
		{
			$Video_Title = stripslashes($rows->Video_Title);
			$Embeded_ID = $rows->Embeded_ID;
		}
?>
</ul>
</div>
</div>

<div id="red-bottom"><img alt="" src="<?php echo __SCRIPT_PATH;?>images/bottom-red.png" width="254" height="19" /></div>
</div>
</td>
	<td valign="top">
	<div id="white-box">
<div class="text">
<?php echo $About_Content;?>
</div>
</div>
</td>
	</tr>
</table>
</div>
<div id="content-2">

<table style="width: 100%" cellpadding="0" cellspacing="0" class="style1">
	<tr>
	<td valign="top" style="width: 254px; background-image:url('<?php echo __SCRIPT_PATH;?>images/bd-td2.jpg'); background-repeat:repeat-y;">
	<div id="green-box">
<div id="green-top-title">
				<img alt="" src="<?php echo __SCRIPT_PATH;?>images/videos.png" width="139" height="22" /></div>
<div id="green-middle">
<a href="#z" class="video"><?php echo $Video_Title;?></a>
<div id="video"><iframe width="212" height="180" src="http://www.youtube.com/embed/<?php echo $Embeded_ID;?>" frameborder="0" allowfullscreen></iframe></div>
</div>

<div id="green-bottom"><img alt="" src="<?php echo __SCRIPT_PATH;?>images/bottom-green.png" width="254" height="19" /></div>
</div>
	</td>
	<td valign="top">
	<div id="gray-box">
<img alt="" src="<?php echo __SCRIPT_PATH;?>images/welcome.png" width="342" height="50" />
<div id="text-welcome"><?php echo $Content;?></div>
</div>
</td>
	</tr>
</table>

</div>




