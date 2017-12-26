<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<div align="right" style="width:900px; font-size:15px; font-weight:bold ">
<div>&nbsp;</div>
<style>
.mydate{
display:none;
}
</style>
<script type="text/javascript" src="<?php echo __SCRIPT_PATH;?>js/jquery-1.4.2.min.js"></script>
<script type="text/javascript"> 
	$(document).ready(function() {
	
		$('#Start_Day').keyup(function() {
			 var Info = $(this).val();
			 if(Info.length >= '2')
			 	{
					$('#Start_Month').focus();
				}
		});
		
		$('#Start_Month').keyup(function() {
			 var Info = $(this).val();
			 if(Info.length >= '2')
			 	{
					$('#Start_Year').focus();
				}
		});
		
		$('#End_Day').keyup(function() {
			 var Info = $(this).val();
			 if(Info.length >= '2')
			 	{
					$('#End_Month').focus();
				}
		});
		
		$('#End_Month').keyup(function() {
			 var Info = $(this).val();
			 if(Info.length >= '2')
			 	{
					$('#End_Year').focus();
				}
		});
		
		$('#Country').change(function(){
			var CID = $(this).val();
			$.post('<?php echo __LINK_PATH;?>admin_search/display_companies/AJAX/Y/',{CID:CID},function(data){
					$('#Company_Div').html(data);
				});
		});	
		
		$('#Enable_Date').click(function(){
			$('#Start_Day').val('');
			$('#Start_Month').val('');
			$('#Start_Year').val('');
			$('#End_Day').val('');
			$('#End_Month').val('');
			$('#End_Year').val('');
			
			if($('#Enable_Date').attr('checked'))
				{
					$('.mydate').slideDown('slow');
				}
			else
				{
					$('.mydate').slideUp('slow');
				}
			
		});	
		
		
			
	});
</script>
<?php
$Today = date('d-m-Y');
?>
<div dir="rtl"><span><input id="Enable_Date" name="Enable_Date" type="checkbox" value=""></span><span style="margin-right:12px ">تـمـكـيــن الـبـحـث عـن طـريــق الــتـاريــخ</span></div>
<div style="line-height:15px ">&nbsp;</div>
<div class="mydate">
<table width="100%"  border="0" cellpadding="5" dir="ltr">
	<tr>
    	<td width="79%"><div align="right">(dd-mm-yyyy)&nbsp;
    	  <input class="My_Start_Date" name="Start_Day" type="text" id="Start_Day" dir="<?php echo $Dir;?>" size="2" maxlength="2">
    	-<input class="My_Start_Date" name="Start_Month" type="text" id="Start_Month" dir="<?php echo $Dir;?>" size="2" maxlength="2">
    	-<input class="My_Start_Date" name="Start_Year" type="text" id="Start_Year" dir="<?php echo $Dir;?>" size="4" maxlength="4">
    	</div></td>
    	<td width="21%"><div align="right">تـاريـخ بـدء الإشـتـراك</div></td>
  	</tr>
	<tr>
    	<td width="79%"><div align="right">(dd-mm-yyyy)&nbsp;
    	  <input class="My_Start_Date" name="End_Day" type="text" id="End_Day" dir="<?php echo $Dir;?>" size="2" maxlength="2">
    	-<input class="My_Start_Date" name="End_Month" type="text" id="End_Month" dir="<?php echo $Dir;?>" size="2" maxlength="2">
    	-<input class="My_Start_Date" name="End_Year" type="text" id="End_Year" dir="<?php echo $Dir;?>" size="4" maxlength="4">
    	</div></td>
    	<td width="21%"><div align="right">تـاريـخ إنـتـهـاء الإشـتـراك</div></td>
  	</tr>
</table>
</div>
<table width="100%"  border="0" cellpadding="5" dir="ltr">
  <tr>
     <td width="79%"><div align="right">
	   <select id="Country">
	 <option value="0" selected>--الــبـلــد--</option>
	 <option value="999">--الـكـل--</option>
	 <?php
	 foreach($results_country as $rows)
	 	{
		?>
		<option value="<?php echo $rows->ID;?>"><?php echo $rows->Name;?></option>
		<?php
		}
	 ?>
	 </select>
	 </div></td>
	 <td width="21%"><div align="right">الــبـلــد</div></td>
  </tr>
</table>
<div id="Company_Div"></div>
</div>