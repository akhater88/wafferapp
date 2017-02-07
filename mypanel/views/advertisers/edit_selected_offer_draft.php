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
		$Offer_Content = stripslashes($rows->Offer_Content);
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
		
	$('.Submit_Draft').click(function(){
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
			$.post('<?php echo __LINK_PATH;?>advertisers/submit_edit_offer_draft/AJAX/Y/',{ID:ID,Offer_Title:Offer_Title,Start_Date:Start_Date,End_Date:End_Date,Ads_Sub_Cat:Ads_Sub_Cat,Offer_Content:Offer_Content,SID_Values:SID_Values,Time_Stamp:'<?php echo $Time_Stamp;?>'},function(data){
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
			
			$.post('<?php echo __LINK_PATH;?>advertisers/submit_edit_offer_activate/AJAX/Y/',{ID:ID,Offer_Title:Offer_Title,Start_Date:Start_Date,End_Date:End_Date,Ads_Sub_Cat:Ads_Sub_Cat,Offer_Content:Offer_Content,SID_Values:SID_Values,Time_Stamp:'<?php echo $Time_Stamp;?>'},function(data){
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
.Submit_Main_BTN_Add{
width:80px;
height:25px;
background-color:#000066;
color:#FFFFFF;
cursor:pointer;
}
.Submit_Draft{
width:100px;
height:25px;
background-color:#000066;
color:#FFFFFF;
cursor:pointer;
}
</style>
<table width="100%">
   <tr>
    <td width="89%"><div align="right"><input name="Offer_Title" type="text" id="Offer_Title" size="30" dir="<?php echo $Dir;?>" value="<?php echo $Offer_Title;?>"></div></td>
    <td width="11%"><div align="right">إســم الـعـرض</div></td>
  </tr>
  <tr>
    <td width="89%"><div align="right"><textarea name="Offer_Content" cols="35" rows="5" id="Offer_Content" ><?php echo $Offer_Content;?></textarea>
    </div></td>
    <td width="11%"><div align="right">مــحـتـوى الـعـرض</div></td>
  </tr>
   <tr>
     <td colspan="2">&nbsp;</td>
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
    	<td><div align="right"><input type="button" name="Sub_Menu_Btn" value="إرسـال" class="Submit_Main_BTN_Add">&nbsp;&nbsp;&nbsp;<input type="button" name="Sub_Menu_Btn" value="حــفــظ كـمـســودة" class="Submit_Draft"></div></td>
    	<td><div align="right">&nbsp;</div></td>
  </tr>
</table>
