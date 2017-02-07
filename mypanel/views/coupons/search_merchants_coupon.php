<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<div>&nbsp;</div>
<style>
.Submit_BTN{
cursor:pointer;
}
</style>
<script type="text/javascript" src="<?php echo __SCRIPT_PATH;?>js/jquery-1.4.2.min.js"></script>
<script type="text/javascript"> 
	$(document).ready(function() { 
		
	$('.Submit_BTN').click(function(){
			var Coupon_Number = $('#Coupon_Number').val();
			
			$.post('<?php echo __LINK_PATH;?>coupons/display_search_results_merchant/AJAX/Y/',{Coupon_Number:Coupon_Number},function(data){
					$('#Search_Results').html(data);
				});
				
		});	
		
	
	});
</script>
	<table width="100%"  border="0" cellpadding="3" cellspacing="0" dir="ltr">
	  <tr>
		 <td width="88%"><div align="right"><input id="Coupon_Number" name="Coupon_Number" type="text" size="40"></div></td>
		 <td width="12%"><div align="right">رقــم الـكـوبــون</div></td>
	  </tr>
 		<tr>
		 <td>
		 <div align="right"><img alt="" src="<?php echo __SCRIPT_PATH;?>images/send.jpg" width="104" height="44" class="Submit_BTN"></div>
		 </td>
		 <td><div align="right">&nbsp;</div></td>
  	</tr>
</table>
<div id="Search_Results"></div>
