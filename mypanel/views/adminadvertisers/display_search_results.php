<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<div>&nbsp;</div>
<?php
if(isset($_SESSION['Arabic']))
	{
		$Dir = 'rtl';
		$Lang = 'ar';
		$Table_City = 'city';
	}
else
	{
		$Dir = 'ltr';
		$Lang = 'eng';
		$Table_City = 'city_english';
	}
$Display = new sql();
?>
<script type="text/javascript" src="<?php echo __SCRIPT_PATH;?>js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="<?php echo __SCRIPT_PATH;?>js/datepicker.js"></script>
<link rel="stylesheet" href="<?php echo __SCRIPT_PATH;?>css/datepicker.css" type="text/css" />
<script type="text/javascript"> 
	$(document).ready(function() { 
			$(document).ready(function() { 
			
			
			$('#Start_Date').DatePicker({
			format:'d-m-Y',
			date: $('#Start_Date').val(),
			current: $('#Start_Date').val(),
			starts: 7,
			position: 'left',
			onBeforeShow: function(){
				$('#Start_Date').DatePickerSetDate($('#Start_Date').val(), true);
			},
			onChange: function(formated, dates){
				$('#Start_Date').val(formated);
			}
		});
	
			
		$('#End_Date').DatePicker({
			format:'d-m-Y',
			date: $('#End_Date').val(),
			current: $('#End_Date').val(),
			starts: 7,
			position: 'left',
			onBeforeShow: function(){
				$('#inputDate_2').DatePickerSetDate($('#End_Date').val(), true);
			},
			onChange: function(formated, dates){
				$('#End_Date').val(formated);
			}
		});
	});
</script>
<style>
.Paginate{
margin-right:5px;
cursor:pointer;
color:#0099FF;
}
</style>
<div align="center">
<table style="width:400px "  border="0" cellpadding="2" cellspacing="0">
	<tr>
		<td width="29%"><div align="right">غـيـر مـفـعـل</div></td>
		<td width="10%"><div align="center"><img src="<?php echo __SCRIPT_PATH;?>images/Blocked.png"></div></td>
		<td width="19%"><div align="right">مـفـعــل</div></td>
		<td width="10%"><div align="center"><img src="<?php echo __SCRIPT_PATH;?>images/Published.png"></div></td>
		<td width="19%"><div align="right">مـنـتـهـي</div></td>
		<td width="10%"><div align="center"><img src="<?php echo __SCRIPT_PATH;?>images/Expired.png"></div></td>
	</tr>
</table>
</div>
<div>&nbsp;</div>
<table width="100%"  border="1" cellpadding="2" cellspacing="0" bordercolor="#333333">
  <tr bgcolor="#ACCBE3">
  	<td width="10%"><div align="center" style="font-size:16px ">الـمـديـنــة</div></td>
	 <td width="11%"><div align="center" style="font-size:16px ">تـاريخ الإنتـهـاء</div></td>
	  <td width="10%"><div align="center" style="font-size:16px ">تـاريـخ الـبـدء</div></td>
	  <td width="33%"><div align="center" style="font-size:16px ">تـفـاصـيـل الـعـرض</div></td>
      <td width="36%"><div align="center" style="font-size:16px ">عـنـوان الـعـرض</div></td>
  </tr>
 <?php
 foreach($results as $rows)
 	{
		$Offer_Title = stripslashes($rows->Offer_Title);
		$Offer_Content = html_entity_decode($rows->Offer_Content,ENT_QUOTES,'UTF-8');
		$Offer_Content = stripslashes($Offer_Content);
		$Start_Date = date('Y-m-d',strtotime($rows->Start_Date));
		$End_Date = date('Y-m-d',strtotime($rows->End_Date));
		$City = $rows->City;
		$sql = 'SELECT City_Name FROM '.$Table_City.' WHERE ID = ?';
		$Execute_Array = array($City);
		$City_Name = $Display->Display_Single_Info_Modified($sql,'City_Name',$Execute_Array);
		$Status = $rows->Status;
		if($Status == '3')
			{
				$BG_Color = '#FFCC00';
			}
		elseif($Status == '2')
			{
				$BG_Color = '#FFFFFF';
			}
		else
			{
				$BG_Color = '#00CC66';
			}
		?>
		<tr>
			 <td><div align="center" style="font-size:16px "><?php echo $City_Name;?></div></td>
			 <td><div align="center" style="font-size:16px "><?php echo $End_Date;?></div></td>
			 <td><div align="center" style="font-size:16px "><?php echo $Start_Date;?></div></td>
			 <td><div align="center" style="font-size:16px "><?php echo $Offer_Content;?></div></td>
			 <td><div align="center" style="font-size:16px "><?php echo $Offer_Title;?></div></td>
		</tr>
		<?php
	}
 ?> 
 </table>