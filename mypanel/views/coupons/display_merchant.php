<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="<?php echo __SCRIPT_PATH;?>js/jquery-1.4.2.min.js"></script>
<script type="text/javascript"> 
	$(document).ready(function() { 
		
		
	$('#Merchants').change(function(){
			var Merchant_ID = $(this).val();
			
			$.post('<?php echo __LINK_PATH;?>coupons/display_msgs/AJAX/Y/',{Merchant_ID:Merchant_ID},function(data){
					$('#Services_Div').html(data);
				});
				
		});	
		
	
	});
</script>
<?php
if(count($Merchant_ID_Array))
	{
	?>
	<table width="100%"  border="0" cellpadding="3" cellspacing="0" dir="ltr">
  <tr>
     <td width="88%">
	 <div align="right">
	 <select id="Merchants">
	  <option value="0" selected>--الـعـمـلاء--</option>
	 <?php
	 $Counter = 0;
	 foreach($Merchant_ID_Array as $value)
	 	{
			?>
			<option value="<?php echo $value;?>"><?php echo $Merchant_Sender_Name[$Counter];?></option>
			<?php
			$Counter++;
		}
	 ?>
	 </select>
	 </div>
	 </td>
	 <td width="12%"><div align="right">الـعـمـلاء</div></td>
  </tr>
</table>
	<?php
	
	}
?>
<div id="Services_Div"></div>