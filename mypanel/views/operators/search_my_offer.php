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
		
		
	$('#Country').change(function(){
			var CID = $(this).val();
			$.post('<?php echo __LINK_PATH;?>operators/submit_country_name/AJAX/Y/',{CID:CID},function(data){
					$('#Merchant_Div').html(data);
				});
				
		});	
		
	
	});
</script>
<?php
if(count($Country_IDs))
	{
	?>
	<table width="100%"  border="0" cellpadding="3" cellspacing="0" dir="ltr">
  <tr>
     <td width="88%">
	 <div align="right">
	 <select id="Country">
	  <option value="0" selected>--الـبـلــد--</option>
	 <option value="999">--الـكــل--</option>
	 <?php
	 $Counter = 0;
	 foreach($Country_IDs as $value)
	 	{
			?>
			<option value="<?php echo $value;?>"><?php echo $Country_Names[$Counter];?></option>
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