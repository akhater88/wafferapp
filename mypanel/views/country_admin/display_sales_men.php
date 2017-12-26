<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php $Today = date('d-m-Y');?>
<script type="text/javascript" src="<?php echo __SCRIPT_PATH;?>js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="<?php echo __SCRIPT_PATH;?>js/datepicker.js"></script>
<link rel="stylesheet" href="<?php echo __SCRIPT_PATH;?>css/datepicker.css" type="text/css" />
<script type="text/javascript"> 
	$(document).ready(function() {
		
		$('#Starts_Date').DatePicker({
		format:'d-m-Y',
		date: $('#Starts_Date').val(),
		current: $('#Starts_Date').val(),
		starts: 7,
		position: 'left',
		onBeforeShow: function(){
			$('#Starts_Date').DatePickerSetDate($('#Starts_Date').val(), true);
		},
		onChange: function(formated, dates){
			$('#Starts_Date').val(formated);
			//$('#Starts_Date').DatePickerHide();
		}
	});
	
	$('#End_Date').DatePicker({
		format:'d-m-Y',
		date: $('#End_Date').val(),
		current: $('#End_Date').val(),
		starts: 7,
		position: 'left',
		onBeforeShow: function(){
			$('#End_Date').DatePickerSetDate($('#End_Date').val(), true);
		},
		onChange: function(formated, dates){
			$('#End_Date').val(formated);
			//$('#End_Date').DatePickerHide();
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
		
		$('#Sales_Men').change(function(){
			var Sales_ID = $(this).val();
			var Merchant_ID = $('#Merchants').val();
			$.post('<?php echo __LINK_PATH;?>country_admin/display_category/AJAX/Y/',{Sales_ID:Sales_ID,Merchant_ID:Merchant_ID},function(data){
					$('#Cat_Div').html(data);
				});
		});	
		
			
	});
</script>
<div dir="rtl"><span><input id="Enable_Date" name="Enable_Date" type="checkbox" value=""></span><span style="margin-right:12px ">تـمـكـيــن الـبـحـث عـن طـريــق الــتـاريــخ</span></div>
<div style="line-height:15px ">&nbsp;</div>
<div class="mydate">
<table width="100%"  border="0" cellpadding="5" dir="ltr">
	<tr>
    	<td width="83%"><div align="right"><input name="Starts_Date" type="text" id="Starts_Date" size="10" value="<?php echo $Today;?>" readonly dir="<?php echo $Dir;?>">
    	</div></td>
    	<td width="17%"><div align="right">تـاريـخ بـدء الإشـتـراك</div></td>
  	</tr>
	<tr>
    	<td width="83%"><div align="right"><input name="End_Date" type="text" id="End_Date" size="10" value="<?php echo $Today;?>" readonly dir="<?php echo $Dir;?>">
    	</div></td>
    	<td width="17%"><div align="right">تـاريـخ إنـتـهـاء الإشـتـراك</div></td>
  	</tr>
</table>
</div>
	<table width="100%"  border="0" cellpadding="5" dir="ltr">
	  <tr>
		 <td width="83%">
		 <div align="right">
		 <input id="Sales_Men" name="Sales_Men" type="text" value="<?php echo $Sales_User_Name;?>" readonly>
		 </div></td>
		 <td width="17%"><div align="right">الـمـبـيـعــات</div></td>
	  </tr>
	</table>

<div id="Cat_Div"></div>