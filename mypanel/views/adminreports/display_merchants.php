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
<script type="text/javascript" src="<?php echo __SCRIPT_PATH;?>js/datepicker.js"></script>
<link rel="stylesheet" href="<?php echo __SCRIPT_PATH;?>css/datepicker.css" type="text/css" />
<script type="text/javascript"> 
	$(document).ready(function() {
		
		$('#Merchant_Drop_Down').change(function(){
			var MID = $(this).val();
			$.post('<?php echo __LINK_PATH;?>adminreports/display_category/AJAX/Y/',{MID:MID},function(data){
					$('#Category').html(data);
				});
				
		});	
		
		
		
	});
</script>
<?php
if(count($Sender_ID))
	{
	?>
	<table width="100%"  border="0" cellpadding="5" dir="ltr">
	<tr>
	<td width="79%">
	<div align="right">
	  <select id="Merchant_Drop_Down" dir="<?php echo $Dir;?>">
	<option value="0" selected>--Select a merchant--</option>
	<option value="999">--الـكــل--</option>
	<?php
	$Counter = 0;
	foreach($Sender_ID as $value)
		{
			?>
			<option value="<?php echo $value;?>"><?php echo $Sender_Name[$Counter];?></option>
			<?php
			$Counter++;
		}
	?>
	</select>
	</div>
	</td>
	<td width="21%"><div align="right">إسـم الـمـستـخـدم لـلـعـمـيــل</div></td>
	</tr>
	</table>
	<?php
	}
?>
<div id="Category"></div>