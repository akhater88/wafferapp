<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<div id="Container"></div>
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
		$Starts_Date_Array = explode('-',$Start_Date);
		$Start_Year_Edit = $Starts_Date_Array[2];
		$Start_Month_Edit = $Starts_Date_Array[1];
		$Start_Day_Edit = $Starts_Date_Array[0];
		
		$End_Date_Array = explode('-',$End_Date);
		$End_Year_Edit = $End_Date_Array[2];
		$End_Month_Edit = $End_Date_Array[1];
		$End_Day_Edit = $End_Date_Array[0];
		$Ads_Sub_Cat = $rows->Ads_Sub_Cat;
	}
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
			var ID = '<?php echo $ID;?>';
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
			var SID_Values = '';
			var SID  = new Array();
			 $('[name=SID]:checked').each(function() {
			   SID.push($(this).val());
			 });
			$.each(SID, function(key,value) { 
			 SID_Values += value+',';
			});
			var Offer_Content = $('#Offer_Content').val();
			$.post('<?php echo __LINK_PATH;?>advertisers/submit_edit_offer/AJAX/Y/',{ID:ID,Offer_Title:Offer_Title,Start_Date:Start_Date,End_Date:End_Date,Ads_Sub_Cat:Ads_Sub_Cat,Offer_Content:Offer_Content,SID_Values:SID_Values,Time_Stamp:'<?php echo $Time_Stamp;?>'},function(data){
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
cursor:pointer;
}

</style>
<table width="100%" dir="ltr">
   <tr>
    <td width="79%"><div align="right"><?php echo $Offer_Title;?></div></td>
    <td width="21%"><div align="right">إســم الـعـرض</div></td>
  </tr>
 
   <tr>
    <td width="79%"><div align="right"><?php echo $Offer_Content;?>
    </div></td>
    <td width="21%"><div align="right">مــحـتـوى الـعـرض</div></td>
  </tr>
   <tr>
     <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    	<td width="79%"><div align="right">(dd-mm-yyyy)&nbsp;<?php echo $Start_Day_Edit;?>
    	-<?php echo $Start_Month_Edit;?>
		-<?php echo $Start_Year_Edit;?>
		</div></td>
    	<td width="21%"><div align="right">تـاريـخ بـدء الـرسـالــة</div></td>
  	</tr>
	<tr>
    	<td width="79%"><div align="right">(dd-mm-yyyy)&nbsp;<?php echo $End_Day_Edit;?>
    	-<?php echo $End_Month_Edit;?>
    	-<?php echo $End_Year_Edit;?>
    	</div></td>
    	<td width="21%"><div align="right">تـاريـخ إنـتـهـاء الـرســالــة</div></td>
  	</tr>
	<tr>
    	<td><div align="right">
		
		<?php
		foreach($results_cat as $rows)
			{
				if(in_array($rows->ID,$Merchant_Services))
				{
				
				if($Ads_Sub_Cat == $rows->ID)
					{
						echo $rows->Sub_Cat_Name.'<BR />';
							
					}
						
				}
			}
		?>
		
		</div></td>
    	<td><div align="right">الـفـئــة</div></td>
  	</tr>
	<tr>
    	<td><div align="right">
		<?php
		foreach($City_Name_Array as $Value)
			{
				echo $Value.'<BR />';
			}
		?>
		
		</div></td>
    	<td><div align="right">الـمـديـنــة</div></td>
  	</tr>
 
</table>
