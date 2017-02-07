<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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
		
	$('.Submit_Main_BTN_Add').click(function(event){
			var ID = '<?php echo $Member_ID;?>';
			var Level = '<?php echo $Level;?>';
			var First_Name = $('#First_Name').val();
			var user_name = $('#user_name').val();
			var Company_Name = $('#Company_Name').val();
			var Phone_Number = $('#Phone_Number').val();
			var Cell_Phone = $('#Cell_Phone').val();
			var Sender_Name = $('#Sender_Name').val();
			var Address = $('#Address').val();
			var Starts_Date = $('#Starts_Date').val();
			var End_Date = $('#End_Date').val();
			var Ads_Cat = $('#Ads_Cat').val();
			var SID_Values = '';
			var SID  = new Array();
			 $('[name=SID]:checked').each(function() {
			   SID.push($(this).val());
			 });
			$.each(SID, function(key,value) { 
			 SID_Values += value+',';
			});
			
			var Country_Name = $('#Country_Name').val();
			var Amount = $('#Amount').val();
			
			var Time_Stamp = event.timeStamp;
			$.post('<?php echo __LINK_PATH;?>country_admin/submit_members_edit_details/AJAX/Y/',{ID:ID,Level:Level,First_Name:First_Name,user_name:user_name,Company_Name:Company_Name,Phone_Number:Phone_Number,Cell_Phone:Cell_Phone,Sender_Name:Sender_Name,Address:Address,Starts_Date:Starts_Date,End_Date:End_Date,Ads_Cat:Ads_Cat,Country_Name:Country_Name,SID_Values:SID_Values,Amount:Amount,Time_Stamp:Time_Stamp},function(data){
							setTimeout('$.fn.myFunction()',100);
						   $.fn.myFunction = function() { 
								$.getJSON('<?php echo __SCRIPT_PATH;?>json/'+Time_Stamp+'.json',function(json){
								var Flag = json.flag;
								
								if(Flag == '1')
									{
										alert('عـلـيـك إدراج الإسـم');
									}
								else if(Flag == '2')
									{
										alert('عـلـيـك إدراج إسـم الـعـائـلــة');
									}
								else if(Flag == '3')
									{
										alert('عـلـيـك إدراج إسـم الـمـسـتـخـدم');
									}
								else if(Flag == '4')
									{
										alert('عـلـيـك إدراج كـلـمـة الـسـر');
									}
								else if(Flag == '5')
									{
										alert('عـلـيـك تـأكـيـد كـلـمـة الـسـر');
									}
								else if(Flag == '6')
									{
										alert('عـلـيـك إدراج إسـم الـشـركــة');
									}
								else if(Flag == '7')
									{
										alert('عـلـيـك إدراج رقـم الـهـاتـف أو رقـم الـهـاتـف الـجـوال');
									}
								else if(Flag == '8')
									{
										alert('عـلـيـك إدراج إسـم الـمـرســل');
									}
								else if(Flag == '9')
									{
										alert('عـلـيــك إدراج الـعـنــوان');
									}
								else if(Flag == '10')
									{
										alert('عـلـيـك إدراج تـاريـخ بـدء الإشـتـراك');
									}
								else if(Flag == '11')
									{
										alert('عـلـيـك إدراج تـاريـخ إنـتـهـاء الإشـتـراك');
									}
								else if(Flag == '12')
									{
										alert('عـلـيـك إخـتـيـار الـتـصـنـيـف الـدعـائـي');
									}
								else if(Flag == '13')
									{
										alert('عـلـيــك إدراج الـخــدمــات');
									}
								else if(Flag == '14')
									{
										alert('عـلـيـك إخـتـيـار الـبـلـد');
									}
								else if(Flag == '15')
									{
										alert('إســم الـمـسـتـخـدم يـجـب أن يحـوي بـريـدا إلـكـترونـيــا');
									}
								else if(Flag == '16')
									{
										alert('إسـم الـمـستـخـدم يـجـب أن يـكـون أكـثـر مـن ثلاثـة حروف');
									}
								else if(Flag == '17')
									{
										alert('كـلـمـة الـسـر يـجـب أن تـكـون أكـثـر مـن خـمـسـة حـروف');
									}
								else if(Flag == '18')
									{
										alert('كـلـمتـا الـسـر غـيـر مـتـطـابـقـتـيـن');
									}
								else if(Flag == '19')
									{
										alert('تـاريـخ الـبـد يـجـب أن يـكـون أقـل مـن تـاريـخ الإنـتـهــاء');
									}
								else if(Flag == '20')
									{
										alert('إسـم الـمـسـتـخـدم مـأخـوذ');
									}
								else if(Flag == '21')
									{
										alert('الـمـبـلـغ الـمـدفـوع يـجـب أن يـحـوي أرقـامــا فـقـط');
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
foreach($results as $rows)
	{
		$First_Name = $rows->First_Name;
		$Last_Name = $rows->Last_Name;
		$user_name = $rows->user_name;
		$Level = $rows->Level;
		$Company_Name = $rows->Company_Name;
		$Phone_Number = $rows->Phone_Number;
		$Cell_Phone = $rows->Cell_Phone;
		$Sender_Name = $rows->Sender_Name;
		$Address = stripslashes($rows->Address);
		$Starts_Date = $rows->Starts_Date;
		$End_Date = $rows->End_Date;
		if($Starts_Date == NULL)
			{
				$Starts_Date = date('d-m-Y');
			}
		else
			{
				$Starts_Date = date('d-m-Y',strtotime($Starts_Date));
			}
		if($End_Date == NULL)
			{
				$End_Date = date('d-m-Y');
			}
		else
			{
				$End_Date = date('d-m-Y',strtotime($End_Date));
			}
		$Ads_Cat = $rows->Ads_Cat;
		$Country = $rows->Country;
	}
$Today = date('d-m-Y');
?>
<table width="100%"  border="0" cellpadding="3" cellspacing="0">
  <tr>
    <td width="83%">
	<div align="right"><input name="First_Name" type="text" id="First_Name" size="30" value="<?php echo $First_Name;?>" dir="<?php echo $Dir;?>"></div>
	</td>
    <td width="17%"><div align="right">الإســم</div></td>
  </tr>
   <tr>
    <td width="83%">
	<div align="right" dir="rtl"><span><input name="user_name" type="text" id="user_name" size="30" value="<?php echo $user_name;?>" dir="<?php echo $Dir;?>"></span>&nbsp;<span style="font-size:12px; color:#FF0000 ">إسـم الـمـستـخـدم يـجـب أن يـكـون البريد الإلـكـتـرونـي</span></div>
	</td>
    <td width="17%"><div align="right">إســم الـمــستـخـدم</div></td>
  </tr>
  
  <?php
  if($Level == '2')
  	{
	?>
	<tr>
    	<td width="83%"><div align="right"><input name="Company_Name" type="text" id="Company_Name" size="30" value="<?php echo $Company_Name;?>" dir="<?php echo $Dir;?>">
    	</div></td>
    	<td width="17%"><div align="right">إسـم الـشركــة</div></td>
  	</tr>
	<tr>
    	<td width="83%"><div align="right"><input name="Phone_Number" type="text" id="Phone_Number" size="30" value="<?php echo $Phone_Number;?>" dir="<?php echo $Dir;?>">
    	</div></td>
    	<td width="17%"><div align="right">رقـم الـهـاتـف</div></td>
  	</tr>
	<tr>
    	<td width="83%"><div align="right"><input name="Cell_Phone" type="text" id="Cell_Phone" size="30" value="<?php echo $Cell_Phone;?>" dir="<?php echo $Dir;?>">
    	</div></td>
    	<td width="17%"><div align="right">رقـم الـجـوال</div></td>
  	</tr>
	<tr>
    	<td width="83%"><div align="right"><input name="Sender_Name" type="text" id="Sender_Name" size="30" value="<?php echo $Sender_Name;?>" dir="<?php echo $Dir;?>">
    	</div></td>
    	<td width="17%"><div align="right">إسـم الـمـرســل</div></td>
  	</tr>
	<tr>
    	<td width="83%"><div align="right">
		<textarea id="Address" name="Address" cols="40" rows="8" dir="<?php echo $Dir;?>"><?php echo $Address;?></textarea>
    	</div></td>
    	<td width="17%"><div align="right">الـعــنــوان</div></td>
  	</tr>
	<tr>
    	<td width="83%"><div align="right"><input name="Starts_Date" type="text" id="Starts_Date" size="10" value="<?php echo $Starts_Date;?>" readonly dir="<?php echo $Dir;?>">
    	</div></td>
    	<td width="17%"><div align="right">تـاريـخ بـدء الإشـتـراك</div></td>
  	</tr>
	<tr>
    	<td width="83%"><div align="right"><input name="End_Date" type="text" id="End_Date" size="10" value="<?php echo $End_Date;?>" readonly dir="<?php echo $Dir;?>">
    	</div></td>
    	<td width="17%"><div align="right">تـاريـخ إنـتـهـاء الإشـتـراك</div></td>
  	</tr>
	<tr>
    	<td width="83%"><div align="right">
		<select id="Ads_Cat" name="Ads_Cat" dir="<?php echo $Dir;?>">
		<?php
		foreach($results_ads as $rows_ads)
			{
				if($rows_ads->ID == $Ads_Cat)
					{
					?>
					<option value="<?php echo $rows_ads->ID;?>" selected><?php echo $rows_ads->Cat_Name;?></option>
					<?php
					}
				else
					{
					?>
					<option value="<?php echo $rows_ads->ID;?>"><?php echo $rows_ads->Cat_Name;?></option>
					<?php
					}
			}
		?>
		</select>
    	</div></td>
    	<td width="17%"><div align="right">الـتـصـنـيـف الـدعـائــي</div></td>
  	</tr>
	<tr>
    	<td width="83%"><div dir="rtl">
		<?php
		foreach($results_services as $rows_services)
			{
				if(in_array($rows_services->ID,$Merchant_Services))
					{
					?>
					<span><input class="CheckAll" name="SID" type="checkbox" value="<?php echo $rows_services->ID;?>" checked></span><span style="margin-right:12px "><?php echo $rows_services->Sub_Cat_Name;?></span>
					<?php
					}
				else
					{
					?>
					<span><input class="CheckAll" name="SID" type="checkbox" value="<?php echo $rows_services->ID;?>"></span><span style="margin-right:12px "><?php echo $rows_services->Sub_Cat_Name;?></span>
					<?php
					}
			}
		?>
    	</div></td>
    	<td width="17%"><div align="right">الـخـدمــات</div></td>
  	</tr>
	<tr>
    	<td width="83%"><div align="right">
		<select id="Country_Name" name="Country_Name" dir="<?php echo $Dir;?>">
		<option value="0" selected>--إخـتـر مـن الـقـائـمــة--</option>
		<?php
		foreach($results_country as $rows_country)
			{
				if($rows_country->ID == $Country)
					{
					?>
					<option value="<?php echo $rows_country->ID;?>" selected><?php echo $rows_country->Name;?></option>
					<?php
					}
				else
					{
					?>
					<option value="<?php echo $rows_country->ID;?>"><?php echo $rows_country->Name;?></option>
					<?php
					}
			}
		?>
		</select>
    	</div></td>
    	<td width="17%"><div align="right">الـبـلــد</div></td>
  	</tr>
	<tr>
    	<td width="83%"><div align="right"><input name="Amount" type="text" id="Amount" size="8" dir="<?php echo $Dir;?>" value="<?php echo $Amount;?>">
    	</div></td>
    	<td width="17%"><div align="right">الـمـبـلــغ الـمـدفــوع</div></td>
  		</tr>
	<?php
	}
	if(($Level == '3')||($Level == '4') ||($Level == '5'))
		{
		?>
		<tr>
    	<td width="83%"><div align="right">
		<select id="Country_Name" name="Country_Name" dir="<?php echo $Dir;?>">
		<option value="0" selected>--إخـتـر مـن الـقـائـمــة--</option>
		<?php
		foreach($results_country as $rows_country)
			{
				if($rows_country->ID == $Country)
					{
					?>
					<option value="<?php echo $rows_country->ID;?>" selected><?php echo $rows_country->Name;?></option>
					<?php
					}
				else
					{
					?>
					<option value="<?php echo $rows_country->ID;?>"><?php echo $rows_country->Name;?></option>
					<?php
					}
			}
		?>
		</select>
    	</div></td>
    	<td width="17%"><div align="right">الـبـلــد</div></td>
  		</tr>
		<?php
		}
  ?>
  <tr>
    	<td width="83%"><div align="right"><img alt="" src="<?php echo __SCRIPT_PATH;?>images/send.jpg" width="104" height="44" class="Submit_Main_BTN_Add"></div></td>
    	<td width="17%"><div align="right">&nbsp;</div></td>
  	</tr>
</table>