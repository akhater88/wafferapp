<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<div id="Container"></div>
<?php
$Time_Stamp = date('m_d_Y').time();
?>
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
		
		
	$('.Submit_Main_BTN_Add').click(function(){
			var Level = '<?php echo $Level;?>';
			var First_Name = $('#First_Name').val();
			var user_name = $('#user_name').val();
			var password = $('#password').val();
			var password_2 = $('#password_2').val();
			var Company_Name = $('#Company_Name').val();
			var Phone_Number = $('#Phone_Number').val();
			var Cell_Phone = $('#Cell_Phone').val();
			var Sender_Name = $('#Sender_Name').val();
			var Address = $('#Address').val();
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
			$.post('<?php echo __LINK_PATH;?>sales/submit_members_add/AJAX/Y/',{Level:Level,First_Name:First_Name,user_name:user_name,password:password,password_2:password_2,Company_Name:Company_Name,Phone_Number:Phone_Number,Cell_Phone:Cell_Phone,Sender_Name:Sender_Name,Address:Address,Starts_Date:Starts_Date,End_Date:End_Date,Ads_Cat:Ads_Cat,Country_Name:Country_Name,SID_Values:SID_Values,Amount:Amount,Time_Stamp:'<?php echo $Time_Stamp;?>'},function(data){
							setTimeout('$.fn.myFunction()',100);
						   $.fn.myFunction = function() { 
								$.getJSON('<?php echo __SCRIPT_PATH;?>json/<?php echo $Time_Stamp;?>.json',function(json){
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
										alert('تـاريـخ إنـتـهـاء الإشـتـراك يـجـب أن يكـون أكـبـر مـن تـاريـخ بـدء الإشـتـراك');
									}
								else if(Flag == '13')
									{
										alert('عـلـيـك إخـتـيـار الـتـصـنـيـف الـدعـائـي');
									}
								else if(Flag == '14')
									{
										alert('عـلـيــك إدراج الـخــدمــات');
									}
								else if(Flag == '15')
									{
										alert('عـلـيـك إخـتـيـار الـبـلـد');
									}
								else if(Flag == '16')
									{
										alert('إســم الـمـسـتـخـدم يـجـب أن يحـوي بـريـدا إلـكـترونـيــا');
									}
								else if(Flag == '17')
									{
										alert('إسـم الـمـستـخـدم يـجـب أن يـكـون أكـثـر مـن ثلاثـة حروف');
									}
								else if(Flag == '18')
									{
										alert('كـلـمـة الـسـر يـجـب أن تـكـون أكـثـر مـن خـمـسـة حـروف');
									}
								else if(Flag == '19')
									{
										alert('كـلـمتـا الـسـر غـيـر مـتـطـابـقـتـيـن');
									}
								else if(Flag == '20')
									{
										alert('تـاريـخ الـبـد يـجـب أن يـكـون أقـل مـن تـاريـخ الإنـتـهــاء');
									}
								else if(Flag == '21')
									{
										alert('إسـم الـمـسـتـخـدم مـأخـوذ');
									}
								else if(Flag == '22')
									{
										alert('الـمـبـلـغ الـمـدفـوع يـجـب أن يـحـوي أرقـامــا فـقـط');
									}
								else
									{
										
										alert('تـمـت الإضـافــة بـنـجــاح');
										$('#First_Name').val('');
										$('#user_name').val('');
										$('#password').val('');
										$('#password_2').val('');
										$('#Company_Name').val('');
										$('#Phone_Number').val('');
										$('#Cell_Phone').val('');
										$('#Sender_Name').val('');
										$('#Address').val('');
										$('#Start_Day').val('');
										$('#Start_Month').val('');
										$('#Start_Year').val('');
										$('#End_Day').val('');
										$('#End_Month').val('');
										$('#End_Year').val('');
										$('#Ads_Cat').val('');
										$('.CheckAll').attr('checked',false);
										$('#Country_Name').val('');
										$('#Amount').val('');
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
$Today = date('d-m-Y');
?>
<table width="100%"  border="0" cellpadding="3" cellspacing="0" dir="ltr">
  <tr>
    <td width="83%">
	<div align="right"><input name="First_Name" type="text" id="First_Name" size="30" dir="<?php echo $Dir;?>"></div>
	</td>
    <td width="17%"><div align="right">الإســم</div></td>
  </tr>
 
   <tr>
    <td width="83%">
	<div align="right" dir="rtl"><span><input name="user_name" type="text" id="user_name" size="30" dir="<?php echo $Dir;?>"></span>&nbsp;<span style="font-size:12px; color:#FF0000 ">إسـم الـمـستـخـدم يـجـب أن يـكـون البريد الإلـكـتـرونـي</span></div>
	</td>
    <td width="17%"><div align="right">إســم الـمــستـخـدم</div></td>
  </tr>
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
  <?php
  if($Level == '2')
  	{
	?>
	<tr>
    	<td width="83%"><div align="right"><input name="Company_Name" type="text" id="Company_Name" size="30" dir="<?php echo $Dir;?>">
    	</div></td>
    	<td width="17%"><div align="right">إسـم الـشركــة</div></td>
  	</tr>
	<tr>
    	<td width="83%"><div align="right"><input name="Phone_Number" type="text" id="Phone_Number" size="30" dir="<?php echo $Dir;?>">
    	</div></td>
    	<td width="17%"><div align="right">رقـم الـهـاتـف</div></td>
  	</tr>
	<tr>
    	<td width="83%"><div align="right"><input name="Cell_Phone" type="text" id="Cell_Phone" size="30" dir="<?php echo $Dir;?>">
    	</div></td>
    	<td width="17%"><div align="right">رقـم الـجـوال</div></td>
  	</tr>
	<tr>
    	<td width="83%"><div align="right"><input name="Sender_Name" type="text" id="Sender_Name" size="30" dir="<?php echo $Dir;?>">
    	</div></td>
    	<td width="17%"><div align="right">إسـم الـمـرســل</div></td>
  	</tr>
	<tr>
    	<td width="83%"><div align="right">
		<textarea id="Address" name="Address" cols="40" rows="8" dir="<?php echo $Dir;?>"></textarea>
    	</div></td>
    	<td width="17%"><div align="right">الـعــنــوان</div></td>
  	</tr>
	 <tr>
    	<td width="83%"><div align="right">(dd-mm-yyyy)&nbsp;<input class="My_Start_Date" name="Start_Day" type="text" id="Start_Day" dir="<?php echo $Dir;?>" size="2" maxlength="2">
    	-<input class="My_Start_Date" name="Start_Month" type="text" id="Start_Month" dir="<?php echo $Dir;?>" size="2" maxlength="2">
    	-<input class="My_Start_Date" name="Start_Year" type="text" id="Start_Year" dir="<?php echo $Dir;?>" size="4" maxlength="4">
    	</div></td>
    	<td width="17%"><div align="right">تـاريـخ بـدء الإشـتـراك</div></td>
  	</tr>
	<tr>
    	<td width="83%"><div align="right">(dd-mm-yyyy)&nbsp;<input class="My_Start_Date" name="End_Day" type="text" id="End_Day" dir="<?php echo $Dir;?>" size="2" maxlength="2">
    	-<input class="My_Start_Date" name="End_Month" type="text" id="End_Month" dir="<?php echo $Dir;?>" size="2" maxlength="2">
    	-<input class="My_Start_Date" name="End_Year" type="text" id="End_Year" dir="<?php echo $Dir;?>" size="4" maxlength="4">
    	</div></td>
    	<td width="17%"><div align="right">تـاريـخ إنـتـهـاء الإشـتـراك</div></td>
  	</tr>
	
	<tr>
    	<td width="83%"><div align="right">
		<select id="Ads_Cat" name="Ads_Cat" dir="<?php echo $Dir;?>">
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
	<tr>
    	<td width="83%"><div dir="rtl">
		<?php
		foreach($results_services as $rows_services)
			{
			?>
			<span><input class="CheckAll" name="SID" type="checkbox" value="<?php echo $rows_services->ID;?>"></span><span style="margin-right:12px "><?php echo $rows_services->Sub_Cat_Name;?></span>
			<?php
			}
		?>
    	</div></td>
    	<td width="17%"><div align="right">الـخـدمــات</div></td>
  	</tr>
	<tr>
    	<td width="83%"><div align="right"><input name="Amount" type="text" id="Amount" size="8" dir="<?php echo $Dir;?>">
    	</div></td>
    	<td width="17%"><div align="right">الـمـبـلــغ الـمـدفــوع</div></td>
  		</tr>
	<?php
	}
  ?>
  <tr>
    	<td width="83%"><div align="right"><img alt="" src="<?php echo __SCRIPT_PATH;?>images/send.jpg" width="104" height="44" class="Submit_Main_BTN_Add"></div></td>
    	<td width="17%"><div align="right">&nbsp;</div></td>
  	</tr>
</table>
