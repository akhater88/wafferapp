<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<div id="Outter" align="right" style="width:900px; font-size:15px; font-weight:bold ">
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
$Today = date('d-m-Y');
$Time_Stamp = date('m_d_Y').time();
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
	jQuery.saveData = function(Target,ID){
			$('#Target').val(Target);
			$('#Target').attr('id',ID);
			};	
	$('.Selected_Item').hover(
	  function () {
		$(this).css({'background-color':'#CCDAE3'});
	  },
	  function () {
		$(this).css({'background-color':'#F5F5F5'});
	  }
	);
	
	$('#Outter').click(function () {
		$('#Results_Div').hide();
	});
	  
	$('.Submit_Main_BTN_Add').click(function () {
		var ID = $('.Target').attr('id');
		var Offer_Type = $('#Offer_Type').val();
		var Start_Date = $('#Start_Date').val();
		var End_Date = $('#End_Date').val();
		var City = $('#City').val();
		$.post('<?php echo __LINK_PATH;?>adminadvertisers/display_search_results/AJAX/Y/',{ID:ID,Offer_Type:Offer_Type,Start_Date:Start_Date,End_Date:End_Date,City:City,Time_Stamp:'<?php echo $Time_Stamp;?>'},function(data){
					setTimeout('$.fn.myFunction()',100);
					$.fn.myFunction = function() { 
								$.getJSON('<?php echo __SCRIPT_PATH;?>json/<?php echo $Time_Stamp;?>.json',function(json){
								var Flag = json.flag;
								
								if(Flag == '1')
									{
										//$('#Container').html('');
										alert('لا يــوجـد مـعـلـومـات عـن الـبـحـث الـمـطـلـوب');
										$('#Outter').html(data);
									}
								else
									{
										$('#Outter').html(data);
										//$('#Container').html(data);
									}
								
								});
							}
				});
		
	});
	
	$('#Target').keyup(function(){
			var First_Name = $(this).val();
			$.post('<?php echo __LINK_PATH;?>adminadvertisers/find_user/AJAX/Y/',{First_Name:First_Name},function(data){
					$('#Name_Result').html(data);
				});
		});	
	
	$('#Country').change(function(){
			var Country = $('#Country').val();
			$.post('<?php echo __LINK_PATH;?>adminadvertisers/display_city/AJAX/Y/',{Country:Country},function(data){
					$('#City_Section').html(data);
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
<table width="100%">
	<tr>
    	<td width="87%">
		<div align="right" style="position:	relative "><input class="Target" name="Target" type="text" id="Target" size="40" dir="<?php echo $Dir;?>" AUTOCOMPLETE="off"></div>
		<div id="Name_Result" style="position:absolute; right:185px; top:40px "></div>
		
		</td>
    	<td width="13%"><div align="right">إســم الـعـمـيــل</div></td>
  	</tr> 
   <tr>
    <td colspan="2"><div align="right">الـفـتـرة الـزمـنـيــة</div></td>
  </tr>
  <tr>
    	<td width="87%"><div align="right"><input name="Start_Date" type="text" id="Start_Date" size="10" value="<?php echo $Today;?>" readonly dir="<?php echo $Dir;?>"></div></td>
    	<td width="13%"><div align="right">مـن</div></td>
  </tr>
	<tr>
    	<td><div align="right"><input name="End_Date" type="text" id="End_Date" size="10" value="<?php echo $Today;?>" readonly dir="<?php echo $Dir;?>"></div></td>
    	<td><div align="right">إلـى</div></td>
  	</tr>
	<tr>
    	<td>
		<div align="right">
		<select id="Offer_Type" dir="<?php echo $Dir;?>">
		<option value="0" selected>--الـكـل--</option>
		<option value="1">الـعـروض الـساريـة</option>
		<option value="3">الـعـروض الـمـنـتـهـيـة</option>
		<option value="2">عـروض غـيـر مـفـعـلـة</option>
		</select>
		</div>
		</td>
    	<td><div align="right">نـوع الـعـرض</div></td>
  	</tr>
	<tr>
    	<td><div align="right">
		<select id="Country" name="Country" dir="<?php echo $Dir;?>">
		<option value="999" selected>--الـكـل--</option>
		<?php
		foreach($results_city as $rows)
			{
			?>
			<option value="<?php echo $rows->ID;?>"><?php echo $rows->Name;?></option>
			<?php
			}
		?>
		</select>
		</div></td>
    	<td><div align="right">الـبـلــد</div></td>
  	</tr>
	<tr>
		<td colspan="2" id="City_Section"></td>
	</tr>
  <tr>
    	<td><div align="right"><input type="button" name="Sub_Menu_Btn" value="إرسـال" class="Submit_Main_BTN_Add"></div></td>
    	<td><div align="right">&nbsp;</div></td>
  </tr>
</table>
<div id="Container"></div>