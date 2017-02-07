<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<div id="Container"></div>
<div align="right" style="width:900px; font-size:15px; font-weight:bold ">
<div>&nbsp;</div>
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
$Time_Stamp = date('m_d_Y').time();
foreach($results as $rows)
	{
		$Offer_Title = stripslashes($rows->Offer_Title);
		$Offer_Content = strip_tags($rows->Offer_Content);
		$Offer_Content = stripslashes($Offer_Content);
		$Start_Date = date('d-m-Y',strtotime($rows->Start_Date));
		$End_Date = date('d-m-Y',strtotime($rows->End_Date));
		$Ads_Sub_Cat = $rows->Ads_Sub_Cat;
	}
?>
<script type="text/javascript" src="<?php echo __SCRIPT_PATH;?>js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="<?php echo __SCRIPT_PATH;?>js/datepicker.js"></script>
<link rel="stylesheet" href="<?php echo __SCRIPT_PATH;?>css/datepicker.css" type="text/css" />
<script type="text/javascript"> 
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
	
	/*$('#Counter').keyup(function(){
			var ID = $('#Offer_Title').val();
			alert(ID);
			//$.post('<?php echo __LINK_PATH;?>advertisers/submit_new_pw/AJAX/Y/',{ID:ID,password:password,password_2:password_2,Time_Stamp:'<?php echo $Time_Stamp;?>'},function(data){
							
				//});
			});	*/
			
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
		
	$('.Return_MSG').click(function(){
			$('#FlyBox').fadeIn('');
		});	
		
	$('.Close').click(function(){
			$('#FlyBox').fadeOut();
		}); 
		
	$('.Submit_Return').click(function(event){
			var Offer_ID = '<?php echo $ID;?>';
			var AID = '<?php echo $AID;?>';
			var MSGComments = $('#MSGComments').val();
			var Time_Stamp = event.timeStamp;
			
			$.post('<?php echo __LINK_PATH;?>adminadvertisers/submit_returned_email/AJAX/Y/',{Offer_ID:Offer_ID,AID:AID,MSGComments:MSGComments,Time_Stamp:Time_Stamp},function(data){
					$.getJSON('<?php echo __SCRIPT_PATH;?>json/'+Time_Stamp+'.json',function(json){
					var Flag = json.flag;
								
								if(Flag == '1')
									{
										alert('عـلـيــك إدراج سـبـب الإرجــاع');
									}
								else
									{
										
										alert('ـم إرســال الـبـريـد الإلكـتـرونــي');
										$('#FlyBox').fadeOut();
										
									}
								
								});
				});
				
		});	
		
	$('.Submit_Main_BTN_Add_Save').click(function(){
			var ID = '<?php echo $ID;?>';
			var Offer_Title = $('#Offer_Title').val();
			var Start_Date = $('#Start_Date').val();
			var End_Date = $('#End_Date').val();
			var Ads_Sub_Cat = $('#Ads_Sub_Cat').val();
			var SID_Values = '';
			var SID  = new Array();
			 $('[name=SID]:checked').each(function() {
			   SID.push($(this).val());
			 });
			$.each(SID, function(key,value) { 
			 SID_Values += value+',';
			});
			
			var Offer_Content = $('#Offer_Content').val();
			
			$.post('<?php echo __LINK_PATH;?>adminadvertisers/submit_edit_offer_save/AJAX/Y/',{ID:ID,Offer_Title:Offer_Title,Start_Date:Start_Date,End_Date:End_Date,Ads_Sub_Cat:Ads_Sub_Cat,Offer_Content:Offer_Content,SID_Values:SID_Values,Time_Stamp:'<?php echo $Time_Stamp;?>'},function(data){
					setTimeout('$.fn.myFunction()',100);
					$.fn.myFunction = function() { 
								$.getJSON('<?php echo __SCRIPT_PATH;?>json/<?php echo $Time_Stamp;?>.json',function(json){
								var Flag = json.flag;
								
								if(Flag == '1')
									{
										alert('عـلـيـك إدراج إسـم الـعـرض');
									}
								else if(Flag == '2')
									{
										alert('إسـم الـعـرض الـذي أدخـلـتـه مـوجـود');
									}
								else if(Flag == '3')
									{
										alert('مـحـتـوى الـعـرض فـارغ');
									}
								else if(Flag == '4')
									{
										alert('تـاريـخ الـبـدء يـجـب أن يـكـون أقـل مـن تـاريـخ إنـتـهـاء الـعـرض');
									}
								else if(Flag == '5')
									{
										alert('الـمـحـتـوى يـجـب ألا يـتـجـاوز 100 حــرف');
									}
								else if(Flag == '6')
									{
										alert('عـلـيـك إخـتـيـار الـفـئــة');
									}
								else if(Flag == '7')
									{
										alert('عـلـيـك إخـتـيـار الـمـديـنــة');
									}
								else if(Flag == '8')
									{
										alert('تـاريـخ الـبـدء و الإنـتـهــاء يـجـب أن يـكـونــا ضـمـن تـاريـخ إشـتـراكك');
									}
								else
									{
										
										alert('تـمـت الإضـافــة بـنـجــاح');
										
									}
								
								});
							}
				});
				
		});	
		
	$('.Submit_Main_BTN_Add').click(function(){
			var ID = '<?php echo $ID;?>';
			var Offer_Title = $('#Offer_Title').val();
			var Start_Date = $('#Start_Date').val();
			var End_Date = $('#End_Date').val();
			var Ads_Sub_Cat = $('#Ads_Sub_Cat').val();
			var SID_Values = '';
			var SID  = new Array();
			 $('[name=SID]:checked').each(function() {
			   SID.push($(this).val());
			 });
			$.each(SID, function(key,value) { 
			 SID_Values += value+',';
			});
			
			var Offer_Content = $('#Offer_Content').val();
			
			$.post('<?php echo __LINK_PATH;?>adminadvertisers/submit_edit_offer_draft/AJAX/Y/',{ID:ID,Offer_Title:Offer_Title,Start_Date:Start_Date,End_Date:End_Date,Ads_Sub_Cat:Ads_Sub_Cat,Offer_Content:Offer_Content,SID_Values:SID_Values,Time_Stamp:'<?php echo $Time_Stamp;?>'},function(data){
					setTimeout('$.fn.myFunction()',100);
					$.fn.myFunction = function() { 
								$.getJSON('<?php echo __SCRIPT_PATH;?>json/<?php echo $Time_Stamp;?>.json',function(json){
								var Flag = json.flag;
								
								if(Flag == '1')
									{
										alert('عـلـيـك إدراج إسـم الـعـرض');
									}
								else if(Flag == '2')
									{
										alert('إسـم الـعـرض الـذي أدخـلـتـه مـوجـود');
									}
								else if(Flag == '3')
									{
										alert('مـحـتـوى الـعـرض فـارغ');
									}
								else if(Flag == '4')
									{
										alert('تـاريـخ الـبـدء يـجـب أن يـكـون أقـل مـن تـاريـخ إنـتـهـاء الـعـرض');
									}
								else if(Flag == '5')
									{
										alert('الـمـحـتـوى يـجـب ألا يـتـجـاوز 100 حــرف');
									}
								else if(Flag == '6')
									{
										alert('عـلـيـك إخـتـيـار الـفـئــة');
									}
								else if(Flag == '7')
									{
										alert('عـلـيـك إخـتـيـار الـمـديـنــة');
									}
								else if(Flag == '8')
									{
										alert('تـاريـخ الـبـدء و الإنـتـهــاء يـجـب أن يـكـونــا ضـمـن تـاريـخ إشـتـراكك');
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
.Return_MSG{
cursor:pointer;
}
.Submit_Main_BTN_Add{
cursor:pointer;
}
.Submit_Main_BTN_Add_Save{
cursor:pointer;
}
.Submit_Return{
cursor:pointer;
}
</style>
<div id="Comments" style="position: relative ">
<table width="100%">
   <tr>
    <td width="89%"><div align="right"><input name="Offer_Title" type="text" id="Offer_Title" size="30" dir="<?php echo $Dir;?>" value="<?php echo $Offer_Title;?>"></div></td>
    <td width="11%"><div align="right">إســم الـعـرض</div></td>
  </tr>
   <tr>
     <td><div align="right"><textarea name="Offer_Content" cols="35" rows="5" id="Offer_Content" style="resize:none "><?php echo $Offer_Content;?></textarea></div>
	 <td><div align="right">وصـف الـعـرض</div></td>
  </tr>
 
  <tr>
    	<td><div align="right"><input name="Start_Date" type="text" id="Start_Date" size="10" readonly dir="<?php echo $Dir;?>" value="<?php echo $Start_Date;?>"></div></td>
    	<td><div align="right">تـاريـخ بـدء الـعـرض</div></td>
  </tr>
	<tr>
    	<td><div align="right"><input name="End_Date" type="text" id="End_Date" size="10" readonly dir="<?php echo $Dir;?>" value="<?php echo $End_Date;?>"></div></td>
    	<td><div align="right">تـاريـخ إنـتـهـاء الـعـرض</div></td>
  	</tr>
	<tr>
    	<td><div align="right">
		<select id="Ads_Sub_Cat" name="Ads_Sub_Cat">
		<?php
		foreach($results_cat as $rows)
			{
				if(in_array($rows->ID,$Merchant_Services))
				{
				if($Ads_Sub_Cat == $rows->ID)
							{
							?>
							<option value="<?php echo $rows->ID;?>" selected><?php echo $rows->Sub_Cat_Name;?></option>
							<?php
							}
						else
							{
							?>
							<option value="<?php echo $rows->ID;?>"><?php echo $rows->Sub_Cat_Name;?></option>
							<?php
							}
				}
			}
		?>
		</select>
		</div></td>
    	<td><div align="right">الـفـئــة</div></td>
  	</tr>
	<tr>
    	<td><div dir="rtl">
		<?php
		foreach($results_city as $rows)
			{
				if(in_array($rows->ID,$City_Array))
					{
					?>
					<span><input class="CheckAll" name="SID" type="checkbox" value="<?php echo $rows->ID;?>" checked></span><span style="margin-right:12px "><?php echo $rows->City_Name;?></span>
					<?php
					}
				else
					{
					?>
					<span><input class="CheckAll" name="SID" type="checkbox" value="<?php echo $rows->ID;?>"></span><span style="margin-right:12px "><?php echo $rows->City_Name;?></span>
					<?php
					}
			}
		?>
		
		</div></td>
    	<td><div align="right">الـمـديـنــة</div></td>
  	</tr>
  <tr>
    	<td><div align="right"><img alt="" src="<?php echo __SCRIPT_PATH;?>images/send.jpg" width="104" height="44" class="Submit_Main_BTN_Add_Save">
    	&nbsp;<img alt="" src="<?php echo __SCRIPT_PATH;?>images/undo.jpg" width="104" height="44" class="Return_MSG">&nbsp;<img alt="" src="<?php echo __SCRIPT_PATH;?>images/save.jpg" width="104" height="44" class="Submit_Main_BTN_Add"></div></td>
    	<td><div align="right">&nbsp;</div></td>
  </tr>
</table>

<div id="FlyBox" style="position:absolute; display:none; padding:5px; width:600px;background-color:#CCDAE3; top:130px; right:50px; border-top:30px solid #F5F5F5">
<div style="position:absolute; top:-25px; right:12px "><img style="cursor:pointer " src="<?php echo __SCRIPT_PATH;?>images/del.png" width="20" height="20" class="Close"></div>
	<table width="100%"  border="0" cellpadding="3" cellspacing="0">
	  <tr>
		<td><div align="right"><textarea id="MSGComments" name="MSGComments" cols="40" rows="5" style="resize:none " dir="rtl"></textarea></div></td>
		<td><div align="right">سـبـب الإرجــاع</div></td>
	  </tr>
	  <tr>
		<td><div align="right"><input type="button" name="Sub_Menu_Btn" value="إرســال" class="Submit_Return"></div></td>
		<td><div align="right">&nbsp;</div></td>
	  </tr>
	</table>

</div>
</div>