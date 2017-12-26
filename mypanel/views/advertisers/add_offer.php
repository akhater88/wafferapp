<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<div id="Container"></div>
<div>&nbsp;</div>
<?php

if(isset($_SESSION['Arabic']))
	{
		$Dir = 'rtl';
		$Lang = 'ar';
		$Table = 'ads_sub_cat';
	}
else
	{
		$Dir = 'ltr';
		$Lang = 'eng';
		$Table = 'ads_sub_cat_english';
	}
$Today = date('d-m-Y');
$Time_Stamp = date('m_d_Y').time();
$Display = new sql();
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
	$('#Counter').keyup(function(){
			var ID = $('#Offer_Title').val();
			alert(ID);
			//$.post('<?php echo __LINK_PATH;?>advertisers/submit_new_pw/AJAX/Y/',{ID:ID,password:password,password_2:password_2,Time_Stamp:'<?php echo $Time_Stamp;?>'},function(data){
							
				//});
			});	
			
		
	$('.Submit_Draft').click(function(){
			var Offer_Title = $('#Offer_Title').val();
			var Start_Day_Val = $('#Start_Day').val();
			var Start_Month_Val = $('#Start_Month').val();
			var Start_Year_Val = $('#Start_Year').val();
			var End_Day_Val = $('#End_Day').val();
			var End_Month_Val = $('#End_Month').val();
			var End_Year_Val = $('#End_Year').val();
			if((Start_Day_Val != '') && (Start_Month_Val != '') && (Start_Year_Val != ''))
				{
					var Start_Date = $('#Start_Day').val()+'-'+$('#Start_Month').val()+'-'+$('#Start_Year').val();
				}
			else
				{
					var Start_Date = '';
				}
			if((End_Day_Val != '') && (End_Month_Val != '') && (End_Year_Val != ''))
				{
					var End_Date = $('#End_Day').val()+'-'+$('#End_Month').val()+'-'+$('#End_Year').val();
				}
			else
				{
					var End_Date = '';
				}
			
			var Ads_Sub_Cat = $('#Ads_Sub_Cat').val();
			//var City = $('#City').val();
			var SID_Values = '';
			var SID  = new Array();
			 $('[name=SID]:checked').each(function() {
			   SID.push($(this).val());
			 });
			$.each(SID, function(key,value) { 
			 SID_Values += value+',';
			});
			
			var Offer_Content = $('#Offer_Content').val();
			$.post('<?php echo __LINK_PATH;?>advertisers/submit_new_offer_draft/AJAX/Y/',{Offer_Title:Offer_Title,Start_Date:Start_Date,End_Date:End_Date,Ads_Sub_Cat:Ads_Sub_Cat,SID_Values:SID_Values,Offer_Content:Offer_Content,Time_Stamp:'<?php echo $Time_Stamp;?>'},function(data){
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
										//$('#Test').html(data);
									}
								
								});
							}
				});
				
		});	
			
			
	$('.Submit_Main_BTN_Add').click(function(){
			var Offer_Title = $('#Offer_Title').val();
			var Start_Day_Val = $('#Start_Day').val();
			var Start_Month_Val = $('#Start_Month').val();
			var Start_Year_Val = $('#Start_Year').val();
			var End_Day_Val = $('#End_Day').val();
			var End_Month_Val = $('#End_Month').val();
			var End_Year_Val = $('#End_Year').val();
			if((Start_Day_Val != '') && (Start_Month_Val != '') && (Start_Year_Val != ''))
				{
					var Start_Date = $('#Start_Day').val()+'-'+$('#Start_Month').val()+'-'+$('#Start_Year').val();
				}
			else
				{
					var Start_Date = '';
				}
			if((End_Day_Val != '') && (End_Month_Val != '') && (End_Year_Val != ''))
				{
					var End_Date = $('#End_Day').val()+'-'+$('#End_Month').val()+'-'+$('#End_Year').val();
				}
			else
				{
					var End_Date = '';
				}
			var Ads_Sub_Cat = $('#Ads_Sub_Cat').val();
			//var City = $('#City').val();
			var SID_Values = '';
			var SID  = new Array();
			 $('[name=SID]:checked').each(function() {
			   SID.push($(this).val());
			 });
			$.each(SID, function(key,value) { 
			 SID_Values += value+',';
			});
			
			var Offer_Content = $('#Offer_Content').val();
			$.post('<?php echo __LINK_PATH;?>advertisers/submit_new_offer/AJAX/Y/',{Offer_Title:Offer_Title,Start_Date:Start_Date,End_Date:End_Date,Ads_Sub_Cat:Ads_Sub_Cat,SID_Values:SID_Values,Offer_Content:Offer_Content,Time_Stamp:'<?php echo $Time_Stamp;?>'},function(data){
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
										//$('#Test').html(data);
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
.Submit_Draft{
cursor:pointer;
}
</style>
<table width="100%" dir="ltr">
   <tr>
    <td width="86%"><div align="right"><input name="Offer_Title" type="text" id="Offer_Title" size="30" dir="<?php echo $Dir;?>"></div></td>
    <td width="14%"><div align="right">إســم الـعـرض</div></td>
  </tr>
 
  <tr>
    <td width="86%"><div align="right"><textarea name="Offer_Content" cols="35" rows="5" id="Offer_Content" ></textarea>
    </div></td>
    <td width="14%"><div align="right">مــحـتـوى الـعـرض</div></td>
  </tr>

   <tr>
     <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
  		<td><div align="right">(dd-mm-yyyy)&nbsp;<input class="My_Start_Date" name="Start_Day" type="text" id="Start_Day" dir="<?php echo $Dir;?>" size="2" maxlength="2">
    	-<input class="My_Start_Date" name="Start_Month" type="text" id="Start_Month" dir="<?php echo $Dir;?>" size="2" maxlength="2">
    	-<input class="My_Start_Date" name="Start_Year" type="text" id="Start_Year" dir="<?php echo $Dir;?>" size="4" maxlength="4">
    	</div></td>
    	<td><div align="right">تـاريـخ بـدء الـعـرض</div></td>
  	</tr>
	<tr>
    	<td><div align="right">(dd-mm-yyyy)&nbsp;<input class="My_Start_Date" name="End_Day" type="text" id="End_Day" dir="<?php echo $Dir;?>" size="2" maxlength="2">
    	-<input class="My_Start_Date" name="End_Month" type="text" id="End_Month" dir="<?php echo $Dir;?>" size="2" maxlength="2">
    	-<input class="My_Start_Date" name="End_Year" type="text" id="End_Year" dir="<?php echo $Dir;?>" size="4" maxlength="4">
    	</div></td>
    	<td><div align="right">تـاريـخ إنـتـهـاء الـعـرض</div></td>
		
  </tr>
	
	<tr>
    	<td><div align="right">
		<select id="Ads_Sub_Cat" name="Ads_Sub_Cat">
		<option value="0" selected>--إخـتـر مـن الـقـائـمــة--</option>
		<?php
		foreach($results as $rows)
			{
			if(in_array($rows->ID,$Merchant_Services))
				{
				?>
				<option value="<?php echo $rows->ID;?>"><?php echo $rows->Sub_Cat_Name;?></option>
				<?php
				}
			}
		?>
		</select>
		</div></td>
    	<td><div align="right">الـفـئــة</div></td>
  	</tr>
	<tr>
    	<td><div  dir="rtl">
		
		<?php
		foreach($results_city as $rows)
			{
			?>
			<span><input class="CheckAll" name="SID" type="checkbox" value="<?php echo $rows->ID;?>"></span><span style="margin-right:12px "><?php echo $rows->City_Name;?></span>
			<?php
			}
		?>
		
		</div></td>
    	<td><div align="right">الـمـديـنــة</div></td>
  	</tr>
  <tr>
    	<td><div align="right"><img alt="" src="<?php echo __SCRIPT_PATH;?>images/send.jpg" width="104" height="44" class="Submit_Main_BTN_Add">&nbsp;&nbsp;&nbsp;<img alt="" src="<?php echo __SCRIPT_PATH;?>images/save.jpg" width="104" height="44" class="Submit_Draft"></div></td>
    	<td><div align="right">&nbsp;</div></td>
  </tr>
</table>
