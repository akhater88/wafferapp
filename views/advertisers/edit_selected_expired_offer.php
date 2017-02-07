<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
if((is_array($results)) && (count($results)))
{
?>
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
		$Offer_Content = html_entity_decode($rows->Offer_Content,ENT_QUOTES,'UTF-8');
		$Offer_Content = stripslashes($Offer_Content);
		$Start_Date = date('d-m-Y',strtotime($rows->Start_Date));
		$End_Date = date('d-m-Y',strtotime($rows->End_Date));
	}
?>
<script type="text/javascript" src="<?php echo __SCRIPT_PATH;?>js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="<?php echo __SCRIPT_PATH;?>js/datepicker.js"></script>
<script type="text/javascript" src="<?php echo __SCRIPT_PATH;?>ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="<?php echo __SCRIPT_PATH;?>ckeditor/adapters/jquery.js"></script>
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
			var editor = $('#editor1').ckeditorGet();
			var Offer_Content = editor.getData();
			$.post('<?php echo __LINK_PATH;?>advertisers/submit_edit_offer/AJAX/Y/',{ID:ID,Offer_Title:Offer_Title,Start_Date:Start_Date,End_Date:End_Date,Offer_Content:Offer_Content,Time_Stamp:'<?php echo $Time_Stamp;?>'},function(data){
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
    	<td><div align="right"><input type="button" name="Sub_Menu_Btn" value="إرسـال" class="Submit_Main_BTN_Add"></div></td>
    	<td><div align="right">&nbsp;</div></td>
  </tr>
</table>
</div>
<?php
}
?>