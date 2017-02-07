<script type="text/javascript"> 
	$(document).ready(function() { 
		
	$('#Display_Country_Gift').click(function(){
			var Member = '<?php echo $Member;?>';
			var Ads_Cat = '<?php echo $Ads_Cat;?>';
			$.post('<?php echo __LINK_PATH;?>services/display_offer_post_gift/AJAX/Y/',{Member:Member,Ads_Cat:Ads_Cat},function(data){
				$('#Gifts_Div').html(data);
			});
				
		});	
		
	$('.Offers').click(function(){
			var City_ID = $(this).attr('id');
			var Country_ID = '<?php echo $Country_ID;?>';
			var Member = '<?php echo $Member;?>';
			var Ads_Cat = '<?php echo $Ads_Cat;?>';
			$.post('<?php echo __LINK_PATH;?>services/display_offers_by_city_gift/AJAX/Y/',{City_ID:City_ID,Country_ID:Country_ID,Member:Member,Ads_Cat:Ads_Cat},function(data){
				$('#Offers_By_City_Gift').html(data);
			});
				
		});	
			
			
	});
</script>
<div id="Offers_By_City_Gift">
<div class="mobile-text1"><br/><br/>الرجاء اختيار المدينة:
			<table style="width: 100%; margin-top:20px;" cellpadding="0" cellspacing="0" class="style1">
			<?php
			$Counter = 1;
			$Index = 0;
			foreach($City_ID_Array as $Value)
				{
					if($Counter == 1)
						{
						?>
						<tr>
						<td id="<?php echo $Value;?>" valign="top" align="center" style="width: 70px" class="Offers">
						<img alt="" src="<?php echo __SCRIPT_PATH;?>images/bubble_2.png" />&nbsp;<?php echo $City_Name_Array[$Index];?></td>
						<?php
						}
					if($Counter == 2)
						{
						?>
						<td id="<?php echo $Value;?>" valign="top" align="center" class="Offers">
						<img alt="" src="<?php echo __SCRIPT_PATH;?>images/bubble_2.png" />&nbsp;<?php echo $City_Name_Array[$Index];?></td>
						<?php
						}
					$Counter++;
					if($Counter > 2)
						{
						$Counter = 1;
						?>
						</tr>
						<tr><td colspan="2">&nbsp;</td></tr>
						<?php
						}
					$Index++;
				}
			?>
			
			</table>
		</div>
		<div class="mobile-back1"><a href="#z"><img alt="" src="<?php echo __SCRIPT_PATH;?>images/back1.png" width="39" height="14" border="0" id="Display_Country_Gift"/></a></div>
	</div>