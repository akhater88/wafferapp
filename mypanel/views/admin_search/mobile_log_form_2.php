<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<div align="right" style="width:900px; font-size:15px; font-weight:bold ">
<div>&nbsp;</div>
<style>
.mydate{
display:none;
}
.Search{
width:80px;
height:25px;
background-color:#000066;
color:#FFFFFF;
cursor:pointer;
}
</style>
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
			$('#inputDate_2').DatePickerSetDate($('#End_Date').val(), true);
		},
		onChange: function(formated, dates){
			$('#End_Date').val(formated);
			//$('#End_Date').DatePickerHide();
		}
	});
		$('#Email').change(function(){
			var ID = $(this).val();
			//$('#Company_Div').html('');
			if(ID == '999')
				{
					$('#Submit_No_Country').slideUp('slow');
					$('#Container_Mobile').data('');
					$('#Container_Mobile').slideUp('slow');
					$('#Enable_Date').attr('disabled',false);
					$.post('<?php echo __LINK_PATH;?>admin_search/display_countries/AJAX/Y/',{ID:ID},function(data){
							$('#Company_Div').html(data);
						});
				}
			else
				{
					$('#Enable_Date').attr('disabled',true);
					$('#Enable_Date').attr('checked',false);
					$('.mydate').slideUp('slow');
					$('#Country_Div').data('');
					$('#Country_Div').slideUp('slow');
					$('#Submit_No_Country').slideDown('slow');
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
		
		$('.Search').click(function(event){
			var Email = $('#Email').val();
			var Time_Stamp = event.timeStamp;
			
			if($('#Enable_Date').attr('checked'))
				{
					var Starts_Date = $('#Starts_Date').val();
					var End_Date = $('#End_Date').val();
				}
			else
				{
					var Starts_Date = '000000';
					var End_Date = '000000';
				}
			$.post('<?php echo __LINK_PATH;?>admin_search/display_specific_mobile_user/AJAX/Y/',{Email:Email,Time_Stamp:Time_Stamp},function(data){
					$('#Company_Div').html(data);
				});
			
		});	
		
		/*$("#Enable_Date").toggle(function()
		  { // first click hides login form, shows password recovery
		  	$('#Enable_Date').attr('checked');
			$('.mydate').slideDown('slow');
		  },
		  function()
		  { // next click shows login form, hides password recovery
		  //	$('#Enable_Date').attr('checked',false);
			$('.mydate').slideUp('slow');
		  });*/
			
	});
</script>
<?php
$Today = date('d-m-Y');
?>
<div dir="rtl"><span><input id="Enable_Date" name="Enable_Date" type="checkbox" value=""></span><span style="margin-right:12px ">تـمـكـيــن الـبـحـث عـن طـريــق الــتـاريــخ</span></div>
<div style="line-height:15px ">&nbsp;</div>
<div class="mydate">
<table width="100%"  border="0" cellpadding="5">
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
<table width="100%"  border="0" cellpadding="5">
  <tr>
     <td width="83%"><div align="right">
	 <select id="Email">
	 <option value="0" selected>--الـبـريـد الإلكـتـروني--</option>
	 <option value="999">--الـكـل--</option>
	 <?php
	 foreach($mobile_users as $rows)
	 	{
		?>
		<option value="<?php echo $rows->ID;?>"><?php echo $rows->Email;?></option>
		<?php
		}
	 ?>
	 </select>
	 </div></td>
	 <td width="17%"><div align="right">الـبـريـد الإلكـتـروني</div></td>
  </tr>
</table>
<div id="Submit_No_Country" style="display:none ">
<table width="100%"  border="0" cellpadding="5">
<tr>
     <td width="83%"><div align="right"><input type="button" name="Sub_Menu_Btn" value="إرسـال" class="Search"></div></td>
	 <td width="17%"><div align="right">&nbsp;</div></td>
  </tr>
</table>
</div>
<div id="Company_Div"></div>
</div>