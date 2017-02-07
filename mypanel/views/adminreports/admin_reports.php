<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
$Today = date('d-m-Y');
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
		
		$('#Enable_Date').click(function(){
			if($('#Enable_Date').attr('checked'))
				{
					$('.mydate').slideDown('slow');
				}
			else
				{
					$('.mydate').slideUp('slow');
				}
			
		});	
		
		$('#Country').change(function(){
			var CID = $(this).val();
			$.post('<?php echo __LINK_PATH;?>adminreports/display_sales/AJAX/Y/',{CID:CID},function(data){
					$('#Sales').html(data);
				});
				
		});	
		
	});
</script>
<div dir="rtl"><span><input id="Enable_Date" name="Enable_Date" type="checkbox" value=""></span><span style="margin-right:12px ">تـمـكـيــن الـبـحـث عـن طـريــق الــتـاريــخ</span></div>
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
<div style="line-height:15px ">&nbsp;</div>
<?php
if(count($Country_ID))
	{
	?>
	<table width="100%"  border="0" cellpadding="5" dir="ltr">
	<tr>
	<td width="79%">
	<div align="right">
	  <select id="Country" dir="<?php echo $Dir;?>">
	<option value="0" selected>--Select a country--</option>
	<option value="999">--الـكــل--</option>
	<?php
	$Counter = 0;
	foreach($Country_ID as $value)
		{
			?>
			<option value="<?php echo $value;?>"><?php echo $Country_Name[$Counter];?></option>
			<?php
			$Counter++;
		}
	?>
	</select>
	</div>
	</td>
	<td width="21%"><div align="right">إســم الـبـلــد</div></td>
	</tr>
	</table>
	<?php
	}
?>
<div id="Sales"></div>