<script type="text/javascript"> 
	$(document).ready(function() { 
		
	$('.Country').click(function(){
			var Country_ID = $(this).attr('id');
			var Member = '<?php echo $Member;?>';
			$.post('<?php echo __LINK_PATH;?>store/display_cities/AJAX/Y/',{Country_ID:Country_ID,Member:Member},function(data){
				$('#Discounts').html(data);
			});
				
		});	
			
	$('.Country_Discount_Card').click(function(){
			var Country_ID = $(this).attr('id');
			var Member = '<?php echo $Member;?>';
			$.post('<?php echo __LINK_PATH;?>store/display_cities_discount_card/AJAX/Y/',{Country_ID:Country_ID,Member:Member},function(data){
				$('#Discounts_Card').html(data);
			});
				
		}); 
			
	$('.Country_Offers').click(function(){
			var Country_ID = $(this).attr('id');
			var Member = '<?php echo $Member;?>';
			$.post('<?php echo __LINK_PATH;?>store/display_cities_offer/AJAX/Y/',{Country_ID:Country_ID,Member:Member},function(data){
				$('#Discounts_Offer').html(data);
			});
				
		}); 
	$('.Country_New').click(function(){
			var Country_ID = $(this).attr('id');
			var Member = '<?php echo $Member;?>';
			$.post('<?php echo __LINK_PATH;?>store/display_cities_new/AJAX/Y/',{Country_ID:Country_ID,Member:Member},function(data){
				$('#Discounts_New').html(data);
			});
				
		});  
	});
</script>
<div id="text-titles">
<table style="width: 100%" cellspacing="0" cellpadding="0">
<tr><td align="center" valign="middle">
				<img alt="" src="<?php echo __SCRIPT_PATH;?>images/<?php echo $Image_Name;?>.png" /></td></tr></table>
</div>
<div id="text-middle">
	<table style="width: 100%" cellpadding="0" cellspacing="0" class="style1">
		<tr>
		<td valign="top" align="right" style="width: 190px">
		<div id="mobile-sub1">
		<div class="mobile-title1">
						<img alt="" src="<?php echo __SCRIPT_PATH;?>images/sales.png" width="47" height="42" /> </div>
		<div id="Discounts">
			<div class="mobile-text1"><br/><br/>الرجاء اختيار الدولة:
				<table style="width: 100%; margin-top:30px;" cellpadding="0" cellspacing="0" class="style1">
				<tr>
				<td valign="top" align="center" style="width: 70px">
				<img alt="" src="<?php echo __SCRIPT_PATH;?>images/sudia.png" width="60" height="74" class="Country" id="19" /></td>
				<td valign="top" align="center">
				<img alt="" src="<?php echo __SCRIPT_PATH;?>images/jordan.png" width="42" height="73"  class="Country" id="18" /></td>
				</tr>
				</table>
			</div>
			<div class="mobile-back1"><a href="#z"><img alt="" src="<?php echo __SCRIPT_PATH;?>images/back1.png" width="39" height="14" border="0" /></a></div>
		</div>
		
		</div>
		</td>
		<td valign="top" align="center" style="width: 190px">
		<div id="mobile-sub1">
		<div class="mobile-title1">
						<img alt="" src="<?php echo __SCRIPT_PATH;?>images/offers-card.png" width="72" height="42" /></div>
		<div id="Discounts_Card">
		<div class="mobile-text1"><br/><br/>الرجاء اختيار الدولة:
				<table style="width: 100%; margin-top:30px;" cellpadding="0" cellspacing="0" class="style1">
				<tr>
				<td valign="top" align="center" style="width: 70px">
				<img alt="" src="<?php echo __SCRIPT_PATH;?>images/sudia.png" width="60" height="74" class="Country_Discount_Card" id="19" /></td>
				<td valign="top" align="center">
				<img alt="" src="<?php echo __SCRIPT_PATH;?>images/jordan.png" width="42" height="73"  class="Country_Discount_Card" id="18" /></td>
				</tr>
				</table>
			</div>
			<div class="mobile-back1"><a href="#z"><img alt="" src="<?php echo __SCRIPT_PATH;?>images/back1.png" width="39" height="14" border="0" /></a></div>
		</div>
		</div>
		</td>
		<td valign="top" align="left" style="width: 191px">
		<div id="mobile-sub1">
		<div class="mobile-title1">
						<img alt="" src="<?php echo __SCRIPT_PATH;?>images/offers.png" width="43" height="43" /></div>
		<div id="Discounts_Offer">
		<div class="mobile-text1"><br/><br/>الرجاء اختيار الدولة:
				<table style="width: 100%; margin-top:30px;" cellpadding="0" cellspacing="0" class="style1">
				<tr>
				<td valign="top" align="center" style="width: 70px">
				<img alt="" src="<?php echo __SCRIPT_PATH;?>images/sudia.png" width="60" height="74" class="Country_Offers" id="19" /></td>
				<td valign="top" align="center">
				<img alt="" src="<?php echo __SCRIPT_PATH;?>images/jordan.png" width="42" height="73"  class="Country_Offers" id="18" /></td>
				</tr>
				</table>
			</div>
			<div class="mobile-back1"><a href="#z"><img alt="" src="<?php echo __SCRIPT_PATH;?>images/back1.png" width="39" height="14" border="0" /></a></div>
		</div>
		</div>
		</td>
		</tr>
		
		<tr>
		<td valign="top" align="right" style="width: 190px">&nbsp;
		</td>
		<td valign="top" align="center" style="width: 190px">
		<div id="mobile-sub1">
		<div class="mobile-title1">&nbsp;&nbsp;
						<img alt="" src="<?php echo __SCRIPT_PATH;?>images/new.png" width="61" height="42" /></div>
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
		</td>
		<td valign="top" align="left" style="width: 191px">&nbsp;
		</td>
		</tr>

	</table>
</div>