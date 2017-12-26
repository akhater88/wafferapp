<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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
		/*$('#Level').change(function(){
			var ID = $(this).val(); 
			$.post('<?php echo __LINK_PATH;?>members/show_members_form/AJAX/Y/',{ID:ID},function(data){
				$('#Container').html(data);
			});
		});*/
			
	});
</script>
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
	<div align="right"><input name="First_Name" type="text" id="First_Name" size="30"></div>
	</td>
    <td width="17%"><div align="right">الإســم</div></td>
  </tr>
   <tr>
    <td width="83%">
	<div align="right"><input name="Last_Name" type="text" id="Last_Name" size="30"></div>
	</td>
    <td width="17%"><div align="right">إســم الـعـائـلــة</div></td>
  </tr>
   <tr>
    <td width="83%">
	<div align="right"><input name="user_name" type="text" id="user_name" size="30"></div>
	</td>
    <td width="17%"><div align="right">إســم الـمــستـخـدم</div></td>
  </tr>
   <tr>
    <td width="83%">
	<div align="right"><input name="password" type="password" id="password" size="30">
	</div>
	</td>
    <td width="17%"><div align="right">كـلـمــة الـســر</div></td>
  </tr>
   <tr>
    <td width="83%">
	<div align="right"><input name="password_2" type="password" id="password_2" size="30">
	</div>
	</td>
    <td width="17%"><div align="right">تـأكـيـد كـلـمـة الـسـر</div></td>
  </tr>
  <?php
  if($Level == '2')
  	{
	?>
	<tr>
    	<td width="83%"><div align="right"><input name="Company_Name" type="text" id="Company_Name" size="30">
    	</div></td>
    	<td width="17%"><div align="right">إسـم الـشركــة</div></td>
  	</tr>
	<tr>
    	<td width="83%"><div align="right"><input name="Phone_Number" type="text" id="Phone_Number" size="30">
    	</div></td>
    	<td width="17%"><div align="right">رقـم الـهـاتـف</div></td>
  	</tr>
	<tr>
    	<td width="83%"><div align="right"><input name="Cell_Phone" type="text" id="Cell_Phone" size="30">
    	</div></td>
    	<td width="17%"><div align="right">رقـم الـجـوال</div></td>
  	</tr>
	<tr>
    	<td width="83%"><div align="right"><input name="Email" type="text" id="Email" size="30">
    	</div></td>
    	<td width="17%"><div align="right">الـبـريـد الإلـكـتـرونــي</div></td>
  	</tr>
	<tr>
    	<td width="83%"><div align="right"><input name="Starts_Date" type="text" id="Starts_Date" size="10" value="<?php echo $Today;?>" readonly>
    	</div></td>
    	<td width="17%"><div align="right">تـاريـخ بـدء الإشـتـراك</div></td>
  	</tr>
	<tr>
    	<td width="83%"><div align="right"><input name="End_Date" type="text" id="End_Date" size="10" value="<?php echo $Today;?>" readonly>
    	</div></td>
    	<td width="17%"><div align="right">تـاريـخ إنـتـهـاء الإشـتـراك</div></td>
  	</tr>
	<tr>
    	<td width="83%"><div align="right">
		<select id="Ads_Cat">
		<option value="0" selected>--إخـتـر مـن الـقـائـمــة--</option>
		<?php
		foreach($results as $rows)
			{
			?>
			<option value="<?php echo $rows->ID;?>"><?php echo $rows->Cat_Name;?></option>
			<?php
			}
		?>
		</select>
    	</div></td>
    	<td width="17%"><div align="right">الـتـصـنـيـف الـدعـائــي</div></td>
  	</tr>
	<?php
	}
  ?>
</table>
