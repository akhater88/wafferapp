<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript"> 
		$(document).ready(function() { 
		
			$('.HighLight').hover(
			  function () {
				$(this).css('text-decoration','underline');
			  }, 
			  function () {
				$(this).css('text-decoration','none');
			  }
			);
			
		});
</script>
<?php
if(isset($_SESSION['Arabic']))
	{
	?>
    <div class="inner-tit">أخـبـارنـا</div>
    <?php
	}
else
	{
	?>
    <div class="inner-tit">Our News</div>
    <?php
	}
?>

<div class="inner-line"><img alt="" src="<?php echo __SCRIPT_PATH;?>images/line-tit.gif" width="322" height="2" /></div>
<div id="inner-text">
<?php
foreach($results as $rows)
	{
		$Title = stripslashes($rows->News_Title);
		$Newsletter_Intro = html_entity_decode($rows->Newsletter_Intro,ENT_QUOTES,'UTF-8');
		$Newsletter_Intro = stripslashes($Newsletter_Intro);
		?>
        <div class="news-title-inner"><span class="HighLight" style="cursor:pointer" onclick="RedirectModified('<?php echo __LINK_PATH;?>news/display_detailed_news/Member/<?php echo $rows->ID;?>/')"><?php echo $Title;?></span></div>
        <div style="position:relative; top:-15px">
		<?php 
		echo $Newsletter_Intro;
		?>
        </div>
        <br />
		<br />
        <?php
	}
?>
</div>
