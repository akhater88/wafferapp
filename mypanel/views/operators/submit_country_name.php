<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
if(isset($_SESSION['Arabic']))
	{
		$Dir = 'rtl';
		$Lang = 'ar';
	}
else
	{
		$Dir = 'ltr';
		$Lang = 'eng';
	}
?>
<script type="text/javascript" src="<?php echo __SCRIPT_PATH;?>js/jquery-1.4.2.min.js"></script>
<script type="text/javascript"> 
	$(document).ready(function() { 
		
		
	$('#Merchants').change(function(){
			var MID = $(this).val();
			var CID = $('#Country').val();
			$.post('<?php echo __LINK_PATH;?>operators/submit_city_name/AJAX/Y/',{MID:MID,CID:CID},function(data){
					$('#City_Div').html(data);
				});
				
		});	
		
	
	});
</script>
<?php
if(count($Merchant_IDs))
	{
	?>
	<table width="100%"  border="0" cellpadding="3" cellspacing="0" dir="ltr">
  <tr>
     <td width="88%">
	 <div align="right">
	 <select id="Merchants">
	  <option value="0" selected>--الـعـمـلاء--</option>
	 <option value="999">--الـكــل--</option>
	 <?php
	 $Counter = 0;
	 foreach($Merchant_IDs as $value)
	 	{
			?>
			<option value="<?php echo $value;?>"><?php echo $Merchant_User_Name[$Counter];?></option>
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
<div id="City_Div"></div>