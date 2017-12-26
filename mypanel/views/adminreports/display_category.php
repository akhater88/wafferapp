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
<style>
.Search_Sales{
cursor:pointer;
}
</style>
<script type="text/javascript" src="<?php echo __SCRIPT_PATH;?>js/jquery-1.4.2.min.js"></script>
<script type="text/javascript"> 
	$(document).ready(function() {
		$('.Search_Sales').click(function(event){
		 	var Country = $('#Country').val();
			var Sales_ID = $('#Sales_User').val();
			var MID = $('#Merchant_Drop_Down').val();
			var Cat_ID = $('#Cat_Drop_Down').val();
			var Sub_Cat_ID = $('#Sub_Cat_Drop_Down').val();
			
			var Start_Day_Val = $('#Start_Day').val();
			var Start_Month_Val = $('#Start_Month').val();
			var Start_Year_Val = $('#Start_Year').val();
			var End_Day_Val = $('#End_Day').val();
			var End_Month_Val = $('#End_Month').val();
			var End_Year_Val = $('#End_Year').val();
			if((Start_Day_Val != '') && (Start_Month_Val != '') && (Start_Year_Val != ''))
				{
					var Starts_Date = $('#Start_Day').val()+'-'+$('#Start_Month').val()+'-'+$('#Start_Year').val();
				}
			else
				{
					var Starts_Date = '';
				}
			if((End_Day_Val != '') && (End_Month_Val != '') && (End_Year_Val != ''))
				{
					var End_Date = $('#End_Day').val()+'-'+$('#End_Month').val()+'-'+$('#End_Year').val();
				}
			else
				{
					var End_Date = '';
				}
			var Time_Stamp = event.timeStamp;
			$.post('<?php echo __LINK_PATH;?>adminreports/display_sales_report/AJAX/Y/',{Country:Country,Sales_ID:Sales_ID,MID:MID,Cat_ID:Cat_ID,Sub_Cat_ID:Sub_Cat_ID,Starts_Date:Starts_Date,End_Date:End_Date,Time_Stamp:Time_Stamp},function(data){
					
					$.getJSON('<?php echo __SCRIPT_PATH;?>json/'+Time_Stamp+'.json',function(json){
					var Flag = json.flag;
					if(Flag == '1')
						{
							alert('عـلـيـك إخـتـيــار الـبـلــد');
						}
					else if(Flag == '2')
						{
							alert('عـلـيـك إخـتـيــار إسـم الـمـسـتـخدم للمبـيـعـات');
						}
					else if(Flag == '3')
						{
							alert('عـلـيـك إخـتـيــار إسـم الـمـسـتـخدم للعـمـيــل');
						}
					else if(Flag == '4')
						{
							alert('عـلـيـك إخـتـيـار الـفـئــة');
						}
					else if(Flag == '5')
						{
							alert('عـلـيـك إخـتـيـار الـخـدمــة');
						}
					else
						{
										
							$('#Display_Search_Results').html(data);
										
						}
								
					});
				});
				
		});	
		
	});
</script>
<?php
if(count($Cat_ID_Array))
	{
	?>
	<table width="100%"  border="0" cellpadding="5" dir="ltr">
	<tr>
	<td width="79%">
	<div align="right">
	  <select id="Cat_Drop_Down" dir="<?php echo $Dir;?>">
	<option value="0" selected>--Select a category--</option>
	<?php
	if($MID == '999')
		{
		?>
		<option value="999">--الـكــل--</option>
		<?php
		}
	$Counter = 0;
	foreach($Cat_ID_Array as $value)
		{
			?>
			<option value="<?php echo $value;?>"><?php echo $Cat_Name_Array[$Counter];?></option>
			<?php
			$Counter++;
		}
	?>
	</select>
	</div>
	</td>
	<td width="21%"><div align="right">إسـم الـفـئــة</div></td>
	</tr>
	<tr>
	<td width="79%">
	<div align="right">
	  <select id="Sub_Cat_Drop_Down" dir="<?php echo $Dir;?>">
	<option value="0" selected>--Select a sub category--</option>
	<?php
	if($MID == '999')
		{
		?>
		<option value="999">--الـكــل--</option>
		<?php
		}
	$Counter = 0;
	foreach($Sub_Cat_ID_Array as $value)
		{
			?>
			<option value="<?php echo $value;?>"><?php echo $Sub_Cat_Array[$Counter];?></option>
			<?php
			$Counter++;
		}
	?>
	</select>
	</div>
	</td>
	<td width="21%"><div align="right">إسـم الـخـدمــة</div></td>
	</tr>
	<tr>
	<td width="79%">
	<div align="right">
	<img alt="" src="<?php echo __SCRIPT_PATH;?>images/send.jpg" width="104" height="44" class="Search_Sales">
	  </div>
	</td>
	<td width="21%"><div align="right">&nbsp;</div></td>
	</tr>
	</table>
	<?php
	}
?>
<div id="Display_Search_Results"></div>
