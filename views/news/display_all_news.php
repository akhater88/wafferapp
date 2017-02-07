<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<div id="Container">
<style>
.Paginate{
padding-left:3px;
padding-right:3px;
cursor:pointer;
color:#0099FF;
}
</style>
<script type="text/javascript"> 
		$(document).ready(function() { 
		$('.Paginate').click(function(){
			var Page = $(this).attr('id'); 
			$.post('<?php echo __LINK_PATH;?>pages/display_all_news/AJAX/Y/',{Page:Page},function(data){
				$('#Container').html(data);
				$('#Product_Container').hide().delay(300).fadeIn();
				});
			});	
			
		});
	</script>
<div class="inner-title">Our News</div>
<div id="line"><img alt="" src="<?php echo __SCRIPT_PATH;?>images/line.gif" width="600" height="1" /></div>
<div id="Product_Container">
<?php
foreach($results as $rows)
	{
		$Title = stripslashes($rows->News_Title);
		$Newsletter_Intro = html_entity_decode($rows->Newsletter_Intro,ENT_QUOTES,'UTF-8');
		$Newsletter_Intro = stripslashes($Newsletter_Intro);
		?>
        <div style="cursor:pointer" onclick="RedirectModified('<?php echo __LINK_PATH;?>news/display_detailed_news/Member/<?php echo $rows->ID;?>/')"><?php echo $Title;?></div>
		<?php echo $Newsletter_Intro;?>
        <br />
        <?php
	}

// Footer paginations 

if ($Page < 1) 
	{ 
		$Page = 1; 
	} 
elseif ($Page > $Last) 
	{ 
		$Page = $Last; 
	}
if($Last > 1)
	{
		?>
		<div id="line"><img alt="" src="<?php echo __SCRIPT_PATH;?>images/line.gif" width="600" height="1" /></div>
		<div style="position:relative; top:-12px ">
		<?php
		for($i = 0; $i<$Last; $i++)
			{
				$next = $i+1;
				if($Page != $i+1)
				{
				?>
				<span class="Paginate" id="<?php echo $next;?>"><?php echo $i+1;?></span>
				<?php
				}
			else
				{
				?>
				<span style="margin-right:5px "><?php echo $i+1;?></span>
				<?php
				}
				
			}
			?>
			</div>
			<?php
	}			
?>
</div>
</div>
