<script type="text/javascript"> 
	$(document).ready(function() { 
		
	$('#Display_Country_Discount_Card').click(function(){
			var Member = '<?php echo $Member;?>';
			$.post('<?php echo __LINK_PATH;?>store/display_offer_post_discount_card/AJAX/Y/',{Member:Member},function(data){
				$('#Discounts_Card').html(data);
			});
				
		});	
		
	$('.Offers_discount_card').click(function(){
			var City_ID = $(this).attr('id');
			var Country_ID = '<?php echo $Country_ID;?>';
			var Member = '<?php echo $Member;?>';
			$.post('<?php echo __LINK_PATH;?>store/display_offers_by_city_discount_card/AJAX/Y/',{City_ID:City_ID,Country_ID:Country_ID,Member:Member},function(data){
				$('#Offers_By_City_Discount_Card').html(data);
			});
				
		});	
			
			
	});
</script>
<div id="Offers_By_City_Discount_Card">
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
						<td id="<?php echo $Value;?>" valign="top" align="center" style="width: 70px" class="Offers_discount_card">
						<img alt="" src="<?php echo __SCRIPT_PATH;?>images/bubble_2.png" />&nbsp;<?php echo $City_Name_Array[$Index];?></td>
						<?php
						}
					if($Counter == 2)
						{
						?>
						<td id="<?php echo $Value;?>" valign="top" align="center" class="Offers_discount_card">
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
		<div class="mobile-back1"><a href="#z"><img alt="" src="<?php echo __SCRIPT_PATH;?>images/back1.png" width="39" height="14" border="0" id="Display_Country_Discount_Card"/></a></div>
	</div>