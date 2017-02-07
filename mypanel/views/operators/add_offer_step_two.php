<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<div align="right" style="width:900px; font-size:15px; font-weight:bold ">
<div>&nbsp;</div>
<script type="text/javascript" src="<?php echo __SCRIPT_PATH;?>js/jquery-1.4.2.min.js"></script>
<script type="text/javascript"> 
		$(document).ready(function() { 
		$('#Merchants').change(function(){
			var ID = $(this).val(); 
			window.location = '<?php echo __LINK_PATH;?>operators/add_offer/Member/'+ID+'/';
			});	
			
	});
</script>
<?php
if(count($Merchant_ID_Array))
	{
		?>
		<select id="Merchants">
		<option value="0" selected>--Select Merchant--</option>
		<?php
		$Counter = 0;
		foreach($Merchant_ID_Array as $value)
			{
			?>
			<option value="<?php echo $value;?>"><?php echo $Merchant_Name_Array[$Counter];?></option>
			<?php
			$Counter++;
			}
		?>
		</select>
		<?php
	}
?>
<div id="Merchant_Div"></div>
</div>