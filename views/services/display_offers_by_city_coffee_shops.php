<script type="text/javascript"> 
	$(document).ready(function() { 
		
	$('#Display_Cities_Coffee_Shop').click(function(){
			var Country_ID = '<?php echo $Country_ID;?>';
			var Member = '<?php echo $Member;?>';
			var Ads_Cat ='<?php echo $Ads_Cat;?>';
			$.post('<?php echo __LINK_PATH;?>services/display_cities_coffee_shops/AJAX/Y/',{Country_ID:Country_ID,Member:Member,Ads_Cat:Ads_Cat},function(data){
				$('#Offers_By_City_Coffee_Shop').html(data);
			});
				
		});	
		
	
	$('.bg3').click(function(){
			var MID = $(this).attr('id');
			var City_ID = '<?php echo $City_ID;?>';
			var Country_ID = '<?php echo $Country_ID;?>';
			var Member = '<?php echo $Member;?>';
			var Ads_Cat ='<?php echo $Ads_Cat;?>';
			$.post('<?php echo __LINK_PATH;?>services/display_merchants_offers_discounts_coffee_shops/AJAX/Y/',{MID:MID,City_ID:City_ID,Country_ID:Country_ID,Member:Member,Ads_Cat:Ads_Cat},function(data){
				$('#Offers_By_City_Coffee_Shop').html(data);
			});
				
		});	
			
	$('.bg4').click(function(){
			var MID = $(this).attr('id');
			var City_ID = '<?php echo $City_ID;?>';
			var Country_ID = '<?php echo $Country_ID;?>';
			var Member = '<?php echo $Member;?>';
			var Ads_Cat ='<?php echo $Ads_Cat;?>';
			$.post('<?php echo __LINK_PATH;?>services/display_merchants_offers_discounts_coffee_shops/AJAX/Y/',{MID:MID,City_ID:City_ID,Country_ID:Country_ID,Member:Member,Ads_Cat:Ads_Cat},function(data){
				$('#Offers_By_City_Coffee_Shop').html(data);
			});
				
		});
		
	});
</script>
<div id="Offers_By_City_Coffee_Shop">
<div class="mobile-text1" style="overflow:auto; direction:ltr">
<?php
$Counter = 0;
if(count($Sender_Name_ID))
	{
		foreach($Sender_Name_ID as $Value)
			{
				if($Counter%2)
					{
						$Style = 'bg3';
						$Style_Div = 'mobile-bg1';
					}
				else
					{
						$Style = 'bg4';
						$Style_Div = 'mobile-bg2';
					}
				?>
				<div class="<?php echo $Style_Div;?>"><a href="#z" class="<?php echo $Style;?>" id="<?php echo $Value;?>"><?php echo $Sender_Name_Array[$Counter];?></a></div >
				<?php
				$Counter++;
			}
	}
else
	{
	?>
	<div>لا تـوجـد مـعـلـومـات حـالـيــا</div >
	<?php
	}
?>
</div>
<div class="mobile-back1"><a href="#z"><img alt="" src="<?php echo __SCRIPT_PATH;?>images/back1.png" width="39" height="14" border="0" id="Display_Cities_Coffee_Shop"/></a></div>
</div>