<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<div align="right" style="width:900px; font-size:15px; font-weight:bold ">
<div>&nbsp;</div>
<script type="text/javascript" src="<?php echo __SCRIPT_PATH;?>js/jquery-1.4.2.min.js"></script>
<script type="text/javascript"> 
		$(document).ready(function() { 
		$('#Country').change(function(){
			var ID = $(this).val(); 
			$.post('<?php echo __LINK_PATH;?>operators/add_offer_step_two/AJAX/Y/',{ID:ID},function(data){
				$('#Merchant_Div').html(data);
				});
			});	
			
	});
</script>
<?php
if(count($Country_ID_Array))
	{
		?>
		<select id="Country">
		<option value="0" selected>--Select Country--</option>
		<option value="999">--الـكــل--</option>
		<?php
		$Counter = 0;
		foreach($Country_ID_Array as $value)
			{
			?>
			<option value="<?php echo $value;?>"><?php echo $Country_Name_Array[$Counter];?></option>
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