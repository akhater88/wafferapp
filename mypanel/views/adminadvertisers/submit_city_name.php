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
		
		
	$('#Cities').change(function(){
			var City_ID = $(this).val();
			var Merchant_ID = $('#Merchants').val();
			$.post('<?php echo __LINK_PATH;?>adminadvertisers/submit_category_name/AJAX/Y/',{City_ID:City_ID,Merchant_ID:Merchant_ID},function(data){
					$('#Category_Div').html(data);
				});
				
		});	
		
	
	});
</script>
<?php
if(count($City_IDs))
	{
	?>
	<table width="100%"  border="0" cellpadding="3" cellspacing="0" dir="ltr">
  <tr>
     <td width="88%">
	 <div >
	 <select id="Cities">
	  <option value="0" selected>--الـمـديـنــة--</option>
	 <option value="999">--الـكــل--</option>
	 <?php
	 $Counter = 0;
	 foreach($City_IDs as $value)
	 	{
			?>
			<option value="<?php echo $value;?>"><?php echo $City_Names[$Counter];?></option>
			<?php
			$Counter++;
		}
	 ?>
	 </select>
	 </div>
	 </td>
	 <td width="12%"><div >الـمـديـنــة</div></td>
  </tr>
</table>

	<?php
	
	}
?>
<div id="Category_Div"></div>