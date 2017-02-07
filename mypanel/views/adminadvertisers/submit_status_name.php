<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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
?>
<script type="text/javascript" src="<?php echo __SCRIPT_PATH;?>js/jquery-1.4.2.min.js"></script>
<script type="text/javascript"> 
	$(document).ready(function() { 
		
		$('#Reset_Date').click(function() {
			 $('#Start_Day').val('');
			  $('#Start_Month').val('');
			   $('#Start_Year').val('');
			    $('#End_Day').val('');
				 $('#End_Month').val('');
				  $('#End_Year').val('');
			
		});
		$('#Reset_Pub_Date').click(function() {
			 $('#Start_Day_2').val('');
			  $('#Start_Month_2').val('');
			   $('#Start_Year_2').val('');
		});
		$('#Reset_Pub_Date_End').click(function() {
			 $('#End_Day_2').val('');
				 $('#End_Month_2').val('');
				  $('#End_Year_2').val('');
		}); 
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
		
		$('#Start_Day_2').keyup(function() {
			 var Info = $(this).val();
			 if(Info.length >= '2')
			 	{
					$('#Start_Month_2').focus();
				}
		});
		
		$('#Start_Month_2').keyup(function() {
			 var Info = $(this).val();
			 if(Info.length >= '2')
			 	{
					$('#Start_Year_2').focus();
				}
		});
		
		$('#End_Day_2').keyup(function() {
			 var Info = $(this).val();
			 if(Info.length >= '2')
			 	{
					$('#End_Month_2').focus();
				}
		});
		
		$('#End_Month_2').keyup(function() {
			 var Info = $(this).val();
			 if(Info.length >= '2')
			 	{
					$('#End_Year_2').focus();
				}
		});
		
		$('.Submit_Search').click(function(){
			var Status = $('#Status').val();
			var Country_ID = $('#Country').val();
			var Merchants_ID = $('#Merchants').val();
			var City_ID = $('#Cities').val();
			var Category_ID = $('#Category').val();
			var Services_ID = $('#Services').val();
			var Start_Day_Val = $('#Start_Day').val();
			var Start_Month_Val = $('#Start_Month').val();
			var Start_Year_Val = $('#Start_Year').val();
			var End_Day_Val = $('#End_Day').val();
			var End_Month_Val = $('#End_Month').val();
			var End_Year_Val = $('#End_Year').val();
			
			var Start_Day_Val_2 = $('#Start_Day_2').val();
			var Start_Month_Val_2 = $('#Start_Month_2').val();
			var Start_Year_Val_2 = $('#Start_Year_2').val();
			var End_Day_Val_2 = $('#End_Day_2').val();
			var End_Month_Val_2 = $('#End_Month_2').val();
			var End_Year_Val_2 = $('#End_Year_2').val();
			
			if((Start_Day_Val != '') && (Start_Month_Val != '') && (Start_Year_Val != ''))
				{
					var Creation_Start_Date = $('#Start_Day').val()+'-'+$('#Start_Month').val()+'-'+$('#Start_Year').val();
				}
			else
				{
					var Creation_Start_Date = '';
				}
			if((End_Day_Val != '') && (End_Month_Val != '') && (End_Year_Val != ''))
				{
					var Creation_End_Date = $('#End_Day').val()+'-'+$('#End_Month').val()+'-'+$('#End_Year').val();
				}
			else
				{
					var Creation_End_Date = '';
				}
			
			if((Start_Day_Val_2 != '') && (Start_Month_Val_2 != '') && (Start_Year_Val_2 != ''))
				{
					var Start_Date = $('#Start_Day_2').val()+'-'+$('#Start_Month_2').val()+'-'+$('#Start_Year_2').val();
				}
			else
				{
					var Start_Date = '';
				}
			if((End_Day_Val_2 != '') && (End_Month_Val_2 != '') && (End_Year_Val_2 != ''))
				{
					var End_Date = $('#End_Day_2').val()+'-'+$('#End_Month_2').val()+'-'+$('#End_Year_2').val();
				}
			else
				{
					var End_Date = '';
				}
			
			
			$.post('<?php echo __LINK_PATH;?>adminadvertisers/submit_offer_search_results/AJAX/Y/',{Status:Status,Country_ID:Country_ID,Merchants_ID:Merchants_ID,City_ID:City_ID,Category_ID:Category_ID,Services_ID:Services_ID,Creation_Start_Date:Creation_Start_Date,Creation_End_Date:Creation_End_Date,Start_Date:Start_Date,End_Date:End_Date},function(data){
					$('#Search_Details').html(data);
					
				});
				
		});	
		
		
	});
</script>

<table width="100%"  border="0" cellpadding="3" cellspacing="0" dir="ltr">

	 <tr>
		<td colspan="2"><div>تـاريــخ الإنشــاء</div></td>
	  </tr>
	  <tr>
    	<td width="88%"><div>(dd-mm-yyyy)&nbsp;<input class="My_Start_Date" name="Start_Day" type="text" id="Start_Day" dir="<?php echo $Dir;?>" size="2" maxlength="2">
    	-<input class="My_Start_Date" name="Start_Month" type="text" id="Start_Month" dir="<?php echo $Dir;?>" size="2" maxlength="2">
    	-<input class="My_Start_Date" name="Start_Year" type="text" id="Start_Year" dir="<?php echo $Dir;?>" size="4" maxlength="4">
    	</div></td>
    	<td width="12%"><div>مـن</div></td>
  	</tr>
	<tr>
    	<td width="88%"><div>(dd-mm-yyyy)&nbsp;<input class="My_Start_Date" name="End_Day" type="text" id="End_Day" dir="<?php echo $Dir;?>" size="2" maxlength="2">
    	-<input class="My_Start_Date" name="End_Month" type="text" id="End_Month" dir="<?php echo $Dir;?>" size="2" maxlength="2">
    	-<input class="My_Start_Date" name="End_Year" type="text" id="End_Year" dir="<?php echo $Dir;?>" size="4" maxlength="4">
    	</div></td>
    	<td width="12%"><div>إلـى</div></td>
  	</tr>
	 
 
  <tr>
    	<td width="88%"><div>(dd-mm-yyyy)&nbsp;<input class="My_Start_Date" name="Start_Day_2" type="text" id="Start_Day_2" dir="<?php echo $Dir;?>" size="2" maxlength="2">
    	-<input class="My_Start_Date" name="Start_Month_2" type="text" id="Start_Month_2" dir="<?php echo $Dir;?>" size="2" maxlength="2">
    	-<input class="My_Start_Date" name="Start_Year_2" type="text" id="Start_Year_2" dir="<?php echo $Dir;?>" size="4" maxlength="4">
    	</div></td>
    	<td width="12%"><div>تـاريـخ نـشـر الـرسـالـة</div></td>
  	</tr>
	<tr>
    	<td width="88%"><div>(dd-mm-yyyy)&nbsp;<input class="My_Start_Date" name="End_Day_2" type="text" id="End_Day_2" dir="<?php echo $Dir;?>" size="2" maxlength="2">
    	-<input class="My_Start_Date" name="End_Month_2" type="text" id="End_Month_2" dir="<?php echo $Dir;?>" size="2" maxlength="2">
    	-<input class="My_Start_Date" name="End_Year_2" type="text" id="End_Year_2" dir="<?php echo $Dir;?>" size="4" maxlength="4">
    	</div></td>
    	<td width="12%"><div>تـاريـخ إنـتـهـاء الـرســالــة</div></td>
  	</tr>
	
	<tr>
  	 <td colspan="2"><div><span style="cursor:pointer; font-weight:bold; color:#0066FF " id="Reset_Date">مـسح تـاريـخ الإنشــاء</span><span style="cursor:pointer; font-weight:bold; color:#0066FF; margin-right:30px " id="Reset_Pub_Date">مـسح تـاريـخ الـنـشــر</span><span style="cursor:pointer; font-weight:bold; color:#0066FF; margin-right:30px " id="Reset_Pub_Date_End">مـسح تـاريـخ الإنـتـهــاء</span></div></td>
   </tr>
	<tr>
    	<td><div>
		<select id="Status">
		<option value="0" selected>--نـوع الـرسـالـة--</option>
		<option value="999">--الـكـل--</option>
		<option value="10">مـمـسـوح</option>
		<option value="1">مـنـشــور</option>
		<option value="2">قـيـد الإنـجــاز</option>
		<option value="3">مـنـتـهــي</option>
		<option value="4">مـسـودة</option>
		<option value="5">مـرجــع</option>
		</select>
		</div></td>
    	<td><div>نـوع الـرسـالـة</div></td>
  	</tr>
  <tr>
    	<td><div><img alt="" src="<?php echo __SCRIPT_PATH;?>images/send.jpg" width="104" height="44" class="Submit_Search"></div></td>
    	<td><div>&nbsp;</div></td>
  </tr>
</table>
<div id="Search_Details"></div>