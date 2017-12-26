<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style>
.mydate{
display:none;
}
</style>
<script type="text/javascript" src="<?php echo __SCRIPT_PATH;?>js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="<?php echo __SCRIPT_PATH;?>js/datepicker.js"></script>
<link rel="stylesheet" href="<?php echo __SCRIPT_PATH;?>css/datepicker.css" type="text/css" />
<script type="text/javascript"> 
	$(document).ready(function() {
	
		
		$('#Merchants').change(function(){
			var Merchant_ID = $(this).val();
			
			$.post('<?php echo __LINK_PATH;?>country_admin/display_sales_men/AJAX/Y/',{Merchant_ID:Merchant_ID},function(data){
					$('#Sales_Div').html(data);
					if(Merchant_ID != '999')
						{
							$('#Enable_Date').attr('checked',false);
							$('.mydate').slideUp('slow');
							$('#Enable_Date').attr('disabled',true);
						}
				});
		});	
		
		
		
	});
</script>
<?php

if(count($MID))
	{
	?>
	<table width="100%"  border="0" cellpadding="5" dir="ltr">
	  <tr>
		 <td width="83%">
		 <div align="right">
		 <select id="Merchants">
		 <option value="0" selected>--الـعـمـلاء--</option>
		 <option value="999">--الـكـل--</option>
		 <?php
		 $Counter = 0;
		 foreach($MID as $value)
			{
			?>
			<option value="<?php echo $value;?>"><?php echo $Merchant_Sender_Name[$Counter];?></option>
			<?php
			$Counter++;
			}
		 ?>
		 </select>
		 </div></td>
		 <td width="17%"><div align="right">الـعـمـلاء</div></td>
	  </tr>
	</table>
<?php
	}
?>
<div id="Sales_Div"></div>