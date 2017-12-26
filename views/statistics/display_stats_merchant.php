<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<div align="right" style="width:900px; font-size:15px; font-weight:bold ">
<script type="text/javascript" src="<?php echo __SCRIPT_PATH;?>js/jquery-1.4.2.min.js"></script>
<script type="text/javascript"> 
	$(document).ready(function() { 
		
		
	$('#Messages').change(function(){
			var Message_ID = $(this).val();
			
			$.post('<?php echo __LINK_PATH;?>statistics/display_messages/AJAX/Y/',{Message_ID:Message_ID},function(data){
					$('#Messages_Div').html(data);
				});
				
		});	
		
	
	});
</script>
<?php
if(count($Sub_Cat_ID_Array))
	{
	?>
	<table width="100%"  border="0" cellpadding="3" cellspacing="0">
  <tr>
     <td width="88%">
	 <div align="right">
	 <select id="Messages">
	  <option value="0" selected>--الـخـدمــات--</option>
	 <?php
	 $Counter = 0;
	 foreach($Sub_Cat_ID_Array as $value)
	 	{
			?>
			<option value="<?php echo $value;?>"><?php echo $Sub_Cat_Name[$Counter];?></option>
			<?php
			$Counter++;
		}
	 ?>
	 </select>
	 </div>
	 </td>
	 <td width="12%"><div align="right">الـخـدمــات</div></td>
  </tr>
</table>
	<?php
	
	}
?>
<div id="Messages_Div"></div>
</div>