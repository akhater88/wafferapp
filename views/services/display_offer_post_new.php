<script type="text/javascript"> 
	$(document).ready(function() { 
	$('.Country_New').click(function(){
			var Country_ID = $(this).attr('id');
			var Member = '<?php echo $Member;?>';
			$.post('<?php echo __LINK_PATH;?>store/display_cities_new/AJAX/Y/',{Country_ID:Country_ID,Member:Member},function(data){
				$('#Discounts_New').html(data);
			});
				
		});	
		
	$('#Display_Country_New').click(function(){
			var Member = '<?php echo $Member;?>';
			$.post('<?php echo __LINK_PATH;?>store/display_offer_post_new/AJAX/Y/',{Member:Member},function(data){
				$('#Discounts_New').html(data);
			});
				
		});	
		
	$('.Offers').click(function(){
			var City_ID = $(this).attr('id');
			var Member = '<?php echo $Member;?>';
			$.post('<?php echo __LINK_PATH;?>store/display_offers_by_city/AJAX/Y/',{City_ID:City_ID,Member:Member},function(data){
				$('#Offers_By_City').html(data);
			});
				
		});	
			
			
	});
</script>
<div id="Discounts_New">
			<div class="mobile-text1"><br/><br/>الرجاء اختيار الدولة:
				<table style="width: 100%; margin-top:30px;" cellpadding="0" cellspacing="0" class="style1">
				<tr>
				<td valign="top" align="center" style="width: 70px">
				<img alt="" src="<?php echo __SCRIPT_PATH;?>images/sudia.png" width="60" height="74" class="Country_New" id="19" /></td>
				<td valign="top" align="center">
				<img alt="" src="<?php echo __SCRIPT_PATH;?>images/jordan.png" width="42" height="73"  class="Country_New" id="18" /></td>
				</tr>
				</table>
			</div>
			<div class="mobile-back1"><a href="#z"><img alt="" src="<?php echo __SCRIPT_PATH;?>images/back1.png" width="39" height="14" border="0" /></a></div>
		</div>