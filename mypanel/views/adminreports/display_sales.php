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
		
		$('#Sales_User').change(function(){
			var OID = $(this).val();
			$.post('<?php echo __LINK_PATH;?>adminreports/display_merchants/AJAX/Y/',{OID:OID},function(data){
					$('#Merchant').html(data);
				});
				
		});	
		
		
		
	});
</script>
<?php
if(count($User_ID_Array))
	{
	?>
	<table width="100%"  border="0" cellpadding="5" dir="ltr">
	<tr>
	<td width="79%">
	<div align="right">
	  <select id="Sales_User" dir="<?php echo $Dir;?>">
	<option value="0" selected>--Select a sales man--</option>
	<option value="999">--الـكــل--</option>
	<?php
	$Counter = 0;
	foreach($User_ID_Array as $value)
		{
			?>
			<option value="<?php echo $value;?>"><?php echo $User_Name[$Counter];?></option>
			<?php
			$Counter++;
		}
	?>
	</select>
	</div>
	</td>
	<td width="21%"><div align="right">إســم الـمـستـخـدم</div></td>
	</tr>
	</table>
	<?php
	}
?>
<div id="Merchant"></div>