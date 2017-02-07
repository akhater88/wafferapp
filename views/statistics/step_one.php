<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<div align="right" style="width:900px; font-size:15px; font-weight:bold ">
<script type="text/javascript" src="<?php echo __SCRIPT_PATH;?>js/jquery-1.4.2.min.js"></script>
<script type="text/javascript"> 
	$(document).ready(function() { 
		
		
	$('#Country').change(function(){
			var Country_ID = $(this).val();
			
			$.post('<?php echo __LINK_PATH;?>statistics/display_merchant/AJAX/Y/',{Country_ID:Country_ID},function(data){
					$('#Merchant_Div').html(data);
				});
				
		});	
		
	
	});
</script>
<?php
if(count($Country_ID_Array))
	{
	?>
	<table width="100%"  border="0" cellpadding="3" cellspacing="0">
  <tr>
     <td width="88%">
	 <div align="right">
	 <select id="Country">
	  <option value="0" selected>--الـبـلــد--</option>
	 <?php
	 $Counter = 0;
	 foreach($Country_ID_Array as $value)
	 	{
			?>
			<option value="<?php echo $value;?>"><?php echo $Country_Name[$Counter];?></option>
			<?php
			$Counter++;
		}
	 ?>
	 </select>
	 </div>
	 </td>
	 <td width="12%"><div align="right">الـبـلــد</div></td>
  </tr>
</table>
	<?php
	
	}
?>
<div id="Merchant_Div"></div>
</div>