<script type="text/javascript"> 
	$(document).ready(function() { 
		
	$('#Display_Cities_New').click(function(){
			var Country_ID = '<?php echo $Country_ID;?>';
			var Member = '<?php echo $Member;?>';
			$.post('<?php echo __LINK_PATH;?>store/display_cities_new/AJAX/Y/',{Country_ID:Country_ID,Member:Member},function(data){
				$('#Offers_By_City_New').html(data);
			});
				
		});	
		
	
	$('.bg7').click(function(){
			var MID = $(this).attr('id');
			var City_ID = '<?php echo $City_ID;?>';
			var Sub_Cat = '<?php echo $Sub_Cat;?>';
			var Country_ID = '<?php echo $Country_ID;?>';
			var Member = '<?php echo $Member;?>';
			$.post('<?php echo __LINK_PATH;?>store/display_merchants_offers_new/AJAX/Y/',{MID:MID,City_ID:City_ID,Sub_Cat:Sub_Cat,Country_ID:Country_ID,Member:Member},function(data){
				$('#Offers_By_City_New').html(data);
			});
				
		});	
			
	$('.bg8').click(function(){
			var MID = $(this).attr('id');
			var City_ID = '<?php echo $City_ID;?>';
			var Sub_Cat = '<?php echo $Sub_Cat;?>';
			var Country_ID = '<?php echo $Country_ID;?>';
			var Member = '<?php echo $Member;?>';
			$.post('<?php echo __LINK_PATH;?>store/display_merchants_offers_new/AJAX/Y/',{MID:MID,City_ID:City_ID,Sub_Cat:Sub_Cat,Country_ID:Country_ID,Member:Member},function(data){
				$('#Offers_By_City_New').html(data);
			});
				
		});
		
	});
</script>
<div id="Offers_By_City_New">
<div class="mobile-text1" style="overflow:auto; direction:ltr">
<?php
$Counter = 0;
if(count($Sender_Name_ID))
	{
		foreach($Sender_Name_ID as $Value)
			{
				if($Counter%2)
					{
						$Style = 'bg7';
						$Style_Div = 'mobile-bg1';
					}
				else
					{
						$Style = 'bg8';
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
	<div>لا تـوجـد عـروض حـالـيــا</div >
	<?php
	}
?>
</div>
<div class="mobile-back1"><a href="#z"><img alt="" src="<?php echo __SCRIPT_PATH;?>images/back1.png" width="39" height="14" border="0" id="Display_Cities_New"/></a></div>
</div>