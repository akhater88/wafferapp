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
		
		
	$('#Category').change(function(){
			var Cat_ID = $(this).val();
			var Merchant_ID = $('#Merchants').val();
			$.post('<?php echo __LINK_PATH;?>adminadvertisers/submit_service_name/AJAX/Y/',{Cat_ID:Cat_ID,Merchant_ID:Merchant_ID},function(data){
					$('#Services_Div').html(data);
				});
				
		});	
		
	
	});
</script>
<?php
if(count($Cat_IDs))
	{
	?>
	<table width="100%"  border="0" cellpadding="3" cellspacing="0" dir="ltr">
  <tr>
     <td width="88%">
	 <div>
	 <select id="Category">
	  <option value="0" selected>--الـفـئــة--</option>
	 <option value="999">--الـكــل--</option>
	 <?php
	 $Counter = 0;
	 foreach($Cat_IDs as $value)
	 	{
			?>
			<option value="<?php echo $value;?>"><?php echo $Cat_Names[$Counter];?></option>
			<?php
			$Counter++;
		}
	 ?>
	 </select>
	 </div>
	 </td>
	 <td width="12%"><div>الـفـئــة</div></td>
  </tr>
</table>

	<?php
	
	}
?>
<div id="Services_Div"></div>
