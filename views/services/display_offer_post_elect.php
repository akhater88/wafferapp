<script type="text/javascript"> 
	$(document).ready(function() { 
	$('.Elect').click(function(){
			var Country_ID = $(this).attr('id');
			var Member = '<?php echo $Member;?>';
			var Ads_Cat = $(this).attr('ref');
			$.post('<?php echo __LINK_PATH;?>services/display_cities_elect/AJAX/Y/',{Country_ID:Country_ID,Member:Member,Ads_Cat:Ads_Cat},function(data){
				$('#Elect_Div').html(data);
			});
				
		});
		
	$('#Display_Country_Elect').click(function(){
			var Member = '<?php echo $Member;?>';
			var Ads_Cat = '<?php echo $Ads_Cat;?>';
			$.post('<?php echo __LINK_PATH;?>services/display_offer_post_elect/AJAX/Y/',{Member:Member,Ads_Cat:Ads_Cat},function(data){
				$('#Elect_Div').html(data);
			});
				
		});	
			
	});
</script>
<div id="Elect_Div">
			<div class="mobile-text1"><br/><br/>الرجاء اختيار الدولة:
				<table style="width: 100%; margin-top:30px;" cellpadding="0" cellspacing="0" class="style1">
				<tr>
				<td valign="top" align="center" style="width: 70px">
				<img alt="" src="<?php echo __SCRIPT_PATH;?>images/sudia.png" width="60" height="74" class="Elect" id="19" ref="9" /></td>
				<td valign="top" align="center">
				<img alt="" src="<?php echo __SCRIPT_PATH;?>images/jordan.png" width="42" height="73"  class="Elect" id="18" ref="9" /></td>
				</tr>
				</table>
			</div>
			<div class="mobile-back1"><a href="#z"><img alt="" src="<?php echo __SCRIPT_PATH;?>images/back1.png" width="39" height="14" border="0" /></a></div>
		</div>