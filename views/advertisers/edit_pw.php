<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<div id="Container"></div>
<div align="center" style="width:900px; font-size:15px; font-weight:bold ">
<div>&nbsp;</div>
<?php
$Time_Stamp = date('m_d_Y').time();
?>
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
			$('#Starts_Date').DatePickerHide();
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
			$('#End_Date').DatePickerHide();
		}
	});
		
	$('.Submit_Main_BTN_Add').click(function(){
			var ID = '<?php echo $ID;?>';
			var password = $('#password').val();
			var password_2 = $('#password_2').val();
			$.post('<?php echo __LINK_PATH;?>advertisers/submit_new_pw/AJAX/Y/',{ID:ID,password:password,password_2:password_2,Time_Stamp:'<?php echo $Time_Stamp;?>'},function(data){
							setTimeout('$.fn.myFunction()',100);
						   $.fn.myFunction = function() { 
								$.getJSON('<?php echo __SCRIPT_PATH;?>json/<?php echo $Time_Stamp;?>.json',function(json){
								var Flag = json.flag;
								 if(Flag == '1')
									{
										alert('كـلـمـة الـسـر يـجـب أن تـكـون أكـثـر مـن خـمـسـة حـروف');
									}
								else if(Flag == '2')
									{
										alert('كـلـمتـا الـسـر غـيـر مـتـطـابـقـتـيـن');
									}
								else if(Flag == '3')
									{
										alert('كـلـمـة الـسـر يـجـب أن تـكـون أكـثـر مـن خـمـسـة حـروف');
									}
								else
									{
										alert('تـمـت الإضـافــة بـنـجــاح');
									}
								
								});
							}
						});
			});	
		
	});
</script>
<style>
.Submit_Main_BTN_Add{
width:80px;
height:25px;
background-color:#000066;
color:#FFFFFF;
cursor:pointer;
}

</style>
<?php
if(isset($_SESSION['Arabic']))
	{
		$Dir = 'rtl';
	}
else
	{
		$Dir = 'ltr';
	}
$Today = date('d-m-Y');
?>
<table width="100%"  border="0" cellpadding="3" cellspacing="0">
   <tr>
    <td width="83%">
	<div align="right" dir="rtl"><span><input name="password" type="password" id="password" size="30" dir="<?php echo $Dir;?>"></span>&nbsp;<span style="font-size:12px; color:#FF0000 ">كـلـمـة الـسـر يـجـب أن تـكـون أكـثـر مـن خـمـسـة حـروف</span></div>
	</td>
    <td width="17%"><div align="right">كـلـمــة الـســر</div></td>
  </tr>
   <tr>
    <td width="83%">
	<div align="right"><input name="password_2" type="password" id="password_2" size="30" dir="<?php echo $Dir;?>">
	</div>
	</td>
    <td width="17%"><div align="right">تـأكـيـد كـلـمـة الـسـر</div></td>
  </tr>
  <tr>
    	<td width="83%"><div align="right"><input type="button" name="Sub_Menu_Btn" value="إرسـال" class="Submit_Main_BTN_Add"></div></td>
    	<td width="17%"><div align="right">&nbsp;</div></td>
  	</tr>
</table>
</div>