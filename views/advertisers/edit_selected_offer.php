<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<div id="Container"></div>
<div align="right" style="width:900px; font-size:15px; font-weight:bold ">
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
$Display = new sql();
$Time_Stamp = date('m_d_Y').time();
foreach($results as $rows)
	{
		$Offer_Title = stripslashes($rows->Offer_Title);
		$Offer_Content = html_entity_decode($rows->Offer_Content,ENT_QUOTES,'UTF-8');
		$Offer_Content = stripslashes($Offer_Content);
		$Start_Date = date('d-m-Y',strtotime($rows->Start_Date));
		$End_Date = date('d-m-Y',strtotime($rows->End_Date));
		$Ads_Sub_Cat = $rows->Ads_Sub_Cat;
		$City = $rows->City;
	}
?>
<script type="text/javascript" src="<?php echo __SCRIPT_PATH;?>js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="<?php echo __SCRIPT_PATH;?>js/datepicker.js"></script>
<script type="text/javascript" src="<?php echo __SCRIPT_PATH;?>ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="<?php echo __SCRIPT_PATH;?>ckeditor/adapters/jquery.js"></script>
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
	
	$('#Counter').keyup(function(){
			var ID = $('#Offer_Title').val();
			alert(ID);
			//$.post('<?php echo __LINK_PATH;?>advertisers/submit_new_pw/AJAX/Y/',{ID:ID,password:password,password_2:password_2,Time_Stamp:'<?php echo $Time_Stamp;?>'},function(data){
							
				//});
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
		}
	});
		
	$('.Submit_Main_BTN_Add').click(function(){
			var ID = '<?php echo $ID;?>';
			var Offer_Title = $('#Offer_Title').val();
			var Start_Date = $('#Start_Date').val();
			var End_Date = $('#End_Date').val();
			var Ads_Sub_Cat = $('#Ads_Sub_Cat').val();
			var City = $('#City').val();
			var editor = $('#editor1').ckeditorGet();
			var Offer_Content = editor.getData();
			$.post('<?php echo __LINK_PATH;?>advertisers/submit_edit_offer/AJAX/Y/',{ID:ID,Offer_Title:Offer_Title,Start_Date:Start_Date,End_Date:End_Date,Ads_Sub_Cat:Ads_Sub_Cat,Offer_Content:Offer_Content,City:City,Time_Stamp:'<?php echo $Time_Stamp;?>'},function(data){
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
										alert('تـاريـخ إنـتـهــاء الـعــرض يـجـب أن يـكـون قـبـل تـاريـخ إنـتـهــاء إشـتـرائـك');
									}
								else
									{
										
										alert('تـمـت الإضـافــة بـنـجــاح');
										
									}
								
								});
							}
				});
				
		});	
			
			//Initiate ckeditor :
			var config = {
            toolbar:
            [
				['Link','Unlink'],
				['Maximize']
            ]
			
        }; 
		config.width = '600px';
		config.language = '<?php echo $Lang;?>';
		$('#editor1').ckeditor(config);
		CKEDITOR.instances.editor1.on( 'key', function( evt ){
			var editor = $('#editor1').ckeditorGet();
			var Offer_Content = editor.getData();
			var Content_Stripped = Offer_Content.replace(/<\/?[^>]+>/gi, ''); 
  			Content_Stripped = $.trim(Content_Stripped);
			var Offer_Content_Len = Content_Stripped.length +1;
			maximumLength = 100;
			$.showChar(Offer_Content_Len);
			if(Offer_Content_Len > maximumLength )
		   		{
					alert('الـمـحـتـوى يـجـب ألا يـتـجـاوز 100 حــرف');
				}
		});
		
		jQuery.showChar = function(Offer_Content_Len){
			$('#Counter').html(Offer_Content_Len);
			};	
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
<table width="100%">
   <tr>
    <td width="89%"><div align="right"><input name="Offer_Title" type="text" id="Offer_Title" size="30" dir="<?php echo $Dir;?>" value="<?php echo $Offer_Title;?>"></div></td>
    <td width="11%"><div align="right">إســم الـعـرض</div></td>
  </tr>
  <tr>
    <td colspan="2"><div align="right" style="position:relative ">مــحـتـوى الـعـرض&nbsp;&nbsp;&nbsp;&nbsp;<span style="color:#FF0000; font-size:11px ">يـجـب ألا يـتـجـاوز الـمـحـتـوى 100 كـلـمــة</span><span id="Counter" style="position:absolute; left:810px; top:38px; color:#FF0000 ">&nbsp;</span></div></td>
  </tr>
  <tr>
     <td colspan="2"><div align="right"><textarea id="editor1" name="Offer_Content"><?php echo $Offer_Content;?></textarea></div></td>
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
		foreach($results_services as $rows)
			{
				$sql = 'SELECT Sub_Cat_Name FROM '.$Table.' WHERE ID = ?';
				$Execute_Array = array($rows->SID);
				$Sub_Cat_Name = $Display->Display_Single_Info_Modified($sql,'Sub_Cat_Name',$Execute_Array);
				if($Ads_Sub_Cat == $rows->SID)
					{
					?>
					<option value="<?php echo $rows->SID;?>" selected><?php echo $Sub_Cat_Name;?></option>
					<?php
					}
				else
					{
					?>
					<option value="<?php echo $rows->SID;?>"><?php echo $Sub_Cat_Name;?></option>
					<?php
					}
			}
		?>
		</select>
		</div></td>
    	<td><div align="right">الـفـئــة</div></td>
  	</tr>
	<tr>
    	<td><div align="right">
		<select id="City" name="City">
		<?php
		foreach($results_city as $rows)
			{
				if($City == $rows->ID)
					{
					?>
					<option value="<?php echo $rows->ID;?>" selected><?php echo $rows->City_Name;?></option>
					<?php
					}
				else
					{
					?>
					<option value="<?php echo $rows->ID;?>"><?php echo $rows->City_Name;?></option>
					<?php
					}
			}
		?>
		</select>
		</div></td>
    	<td><div align="right">الـمـديـنــة</div></td>
  	</tr>
  <tr>
    	<td><div align="right"><input type="button" name="Sub_Menu_Btn" value="إرسـال" class="Submit_Main_BTN_Add"></div></td>
    	<td><div align="right">&nbsp;</div></td>
  </tr>
</table>
