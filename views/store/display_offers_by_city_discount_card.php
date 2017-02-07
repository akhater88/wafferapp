<script type="text/javascript"> 
	$(document).ready(function() { 
		
	$('#Display_Cities_Discount_Card').click(function(){
			var Country_ID = '<?php echo $Country_ID;?>';
			var Member = '<?php echo $Member;?>';
			$.post('<?php echo __LINK_PATH;?>store/display_cities_discount_card/AJAX/Y/',{Country_ID:Country_ID,Member:Member},function(data){
				$('#Offers_By_City_Discount_Card').html(data);
			});
				
		});	
		
	
	$('.bg3').click(function(){
			var MID = $(this).attr('id');
			var City_ID = '<?php echo $City_ID;?>';
			var Sub_Cat = '<?php echo $Sub_Cat;?>';
			var Country_ID = '<?php echo $Country_ID;?>';
			var Member = '<?php echo $Member;?>';
			$.post('<?php echo __LINK_PATH;?>store/display_merchants_offers_discounts_card/AJAX/Y/',{MID:MID,City_ID:City_ID,Sub_Cat:Sub_Cat,Country_ID:Country_ID,Member:Member},function(data){
				$('#Offers_By_City_Discount_Card').html(data);
			});
				
		});	
			
	$('.bg4').click(function(){
			var MID = $(this).attr('id');
			var City_ID = '<?php echo $City_ID;?>';
			var Sub_Cat = '<?php echo $Sub_Cat;?>';
			var Country_ID = '<?php echo $Country_ID;?>';
			var Member = '<?php echo $Member;?>';
			$.post('<?php echo __LINK_PATH;?>store/display_merchants_offers_discounts_card/AJAX/Y/',{MID:MID,City_ID:City_ID,Sub_Cat:Sub_Cat,Country_ID:Country_ID,Member:Member},function(data){
				$('#Offers_By_City_Discount_Card').html(data);
			});
				
		});
		
	});
</script>
<div id="Offers_By_City_Discount_Card">
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
	<div>لا تـوجـد بـطـاقـات خـصـم حـالـيــا</div >
	<?php
	}
?>
</div>
<div class="mobile-back1"><a href="#z"><img alt="" src="<?php echo __SCRIPT_PATH;?>images/back1.png" width="39" height="14" border="0" id="Display_Cities_Discount_Card"/></a></div>
</div>