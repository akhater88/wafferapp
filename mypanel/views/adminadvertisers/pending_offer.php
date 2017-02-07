<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<div align="right" style="width:900px; font-size:15px; font-weight:bold ">
<div>&nbsp;</div>
<script type="text/javascript" src="<?php echo __SCRIPT_PATH;?>js/jquery-1.4.2.min.js"></script>
<script type="text/javascript"> 
		$(document).ready(function() { 
		
		$('#Country').change(function(){
			var Country = $(this).val();
			$.post('<?php echo __LINK_PATH;?>adminadvertisers/show_pending_offers/AJAX/Y/',{Country:Country},function(data){
				$('#Container').html(data);
				});
			});	
		
	});
</script>
<?php
$Counter = 0;
if(count($Country_ID))
	{
		?>
		<select id="Country">
		<option value="0" selected>--إخـتـر الـبـلــد--</option>
		<option value="999">--الـكــل--</option>
		<?php
		foreach($Country_ID as $value)
			{
			?>
			<option value="<?php echo $value;?>"><?php echo $Country_Name[$Counter];?></option>
			<?php
			$Counter++;
			}
		?>
		</select>
		<?php
	}
?>
<div id="Container"></div>
</div>