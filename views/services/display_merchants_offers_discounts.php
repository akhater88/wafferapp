<script type="text/javascript"> 
	$(document).ready(function() { 
	
	var _elm = $('.mobile-text2')[0];
    if (_elm.clientHeight < _elm.scrollHeight) {
       $('.mobile-bg2').css({'width':'112px'});
	   $('.mobile-bg-inner2').css({'width':'112px'});
	  
    }
	
	$('#Display_Offers_By_Cities').click(function(){
			var Country_ID = '<?php echo $Country_ID;?>';
			var City_ID = '<?php echo $City_ID;?>';
			var Member = '<?php echo $Member;?>';
			var Ads_Cat ='<?php echo $Ads_Cat;?>';
			$.post('<?php echo __LINK_PATH;?>services/display_offers_by_city/AJAX/Y/',{Country_ID:Country_ID,City_ID:City_ID,Member:Member,Ads_Cat:Ads_Cat},function(data){
				$('#Offers_content').html(data);
			});
				
		});	
		
			
	});
</script>
<div id="Offers_content">
<div class="mobile-text2" style="overflow:auto; direction:ltr">
<div class="mobile-bg2"><a href="#z" class="bg1" style="text-decoration:none; font-weight:bold "><?php echo $Sender_Name;?></a></div >
<?php
$Counter = 0;
if(count($Offers_Array))
	{
		foreach($Offers_Array as $Value)
			{
				if($Counter%2)
					{
						$BG = 'bg_grid1';
					}
				else
					{
						$BG = 'bg_grid2';
					}
			?>
			<div class="mobile-bg-inner2" id="<?php echo $BG;?>"><?php echo $Value;?></div >
			<?php
			$Counter++;
			}
	}
else
	{
	?>
	<div class="mobile-bg-inner2">لا تـوجـد مـعـلـومـات حـالـيــا</div >
	<?php
	}
?>
</div>
<div class="mobile-back1"><a href="#z"><img alt="" src="<?php echo __SCRIPT_PATH;?>images/back1.png" width="39" height="14" border="0" id="Display_Offers_By_Cities"/></a></div>
</div>