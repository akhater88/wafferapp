<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<div>&nbsp;</div>
<style>
.mydate{
display:none;
}
.Search_mobile{
cursor:pointer;
}
</style>
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
		$('#Email').change(function(){
			var ID = $(this).val();
			//$('#Company_Div').html('');
			if(ID == '999')
				{
					$('#Submit_No_Country').slideUp('slow');
					$('#Container_Mobile').data('');
					$('#Container_Mobile').slideUp('slow');
					$('#Enable_Date').attr('disabled',false);
					$.post('<?php echo __LINK_PATH;?>admin_search/display_countries/AJAX/Y/',{ID:ID},function(data){
							$('#Company_Div').html(data);
						});
				}
			else
				{
					$('#Enable_Date').attr('disabled',true);
					$('#Enable_Date').attr('checked',false);
					$('.mydate').slideUp('slow');
					$('#Country_Div').data('');
					$('#Country_Div').slideUp('slow');
					$('#Submit_No_Country').slideDown('slow');
				}
		});	
		
		$('#Enable_Date').click(function(){
			$('#Start_Day').val('');
			$('#Start_Month').val('');
			$('#Start_Year').val('');
			$('#End_Day').val('');
			$('#End_Month').val('');
			$('#End_Year').val('');
			if($('#Enable_Date').attr('checked'))
				{
					$('.mydate').slideDown('slow');
				}
			else
				{
					$('.mydate').slideUp('slow');
				}
			
		});	
		
		$('.Search_mobile').click(function(event){
			var Email = $('#Email').val();
			var Time_Stamp = event.timeStamp;
			
			$.post('<?php echo __LINK_PATH;?>admin_search/display_specific_mobile_user/AJAX/Y/',{Email:Email,Time_Stamp:Time_Stamp},function(data){
					$('#Company_Div').html(data);
				});
			
		});	
		
		
	});
</script>
<?php
$Today = date('d-m-Y');
?>
<div dir="rtl"><span><input id="Enable_Date" name="Enable_Date" type="checkbox" value=""></span><span style="margin-right:12px ">تـمـكـيــن الـبـحـث عـن طـريــق الــتـاريــخ</span></div>
<div style="line-height:15px ">&nbsp;</div>
<div class="mydate">
<table width="100%"  border="0" cellpadding="5" dir="ltr">
	<tr>
    	<td width="79%"><div >
    	  <div align="right">(dd-mm-yyyy)&nbsp;
    	    <input class="My_Start_Date" name="Start_Day" type="text" id="Start_Day" dir="<?php echo $Dir;?>" size="2" maxlength="2">
    	-
    	<input class="My_Start_Date" name="Start_Month" type="text" id="Start_Month" dir="<?php echo $Dir;?>" size="2" maxlength="2">
    	-
    	<input class="My_Start_Date" name="Start_Year" type="text" id="Start_Year" dir="<?php echo $Dir;?>" size="4" maxlength="4">
    	  </div>
    	</div></td>
    	<td width="21%"><div >
    	  <div align="right">تـاريـخ بـدء الإشـتـراك</div>
    	</div></td>
  	</tr>
	<tr>
    	<td width="79%"><div >
    	  <div align="right">(dd-mm-yyyy)&nbsp;
    	    <input class="My_Start_Date" name="End_Day" type="text" id="End_Day" dir="<?php echo $Dir;?>" size="2" maxlength="2">
    	-
    	<input class="My_Start_Date" name="End_Month" type="text" id="End_Month" dir="<?php echo $Dir;?>" size="2" maxlength="2">
    	-
    	<input class="My_Start_Date" name="End_Year" type="text" id="End_Year" dir="<?php echo $Dir;?>" size="4" maxlength="4">
    	  </div>
    	</div></td>
    	<td width="21%"><div >
    	  <div align="right">تـاريـخ إنـتـهـاء الإشـتـراك</div>
    	</div></td>
  	</tr>
</table>
</div>
<table width="100%"  border="0" cellpadding="5" dir="ltr">
  <tr>
     <td width="79%"><div >
	   <div align="right">
	     <select id="Email">
	       <option value="0" selected>--الـبـريـد الإلكـتـروني--</option>
	       <option value="999">--الـكـل--</option>
	       <?php
	 foreach($mobile_users as $rows)
	 	{
		?>
		    <option value="<?php echo $rows->ID;?>"><?php echo $rows->Email;?></option>
		    <?php
		}
	 ?>
	       </select>
	     </div>
     </div></td>
	 <td width="21%"><div >
	   <div align="right">الـبـريـد الإلكـتـروني</div>
	 </div></td>
  </tr>
</table>
<div id="Submit_No_Country" style="display:none ">
<table width="100%"  border="0" cellpadding="5" dir="ltr">
<tr>
     <td width="79%"><div align="right"><img alt="" src="<?php echo __SCRIPT_PATH;?>images/send.jpg" width="104" height="44" class="Search_mobile"></div></td>
	 <td width="21%"><div >&nbsp;</div></td>
  </tr>
</table>
</div>
<div id="Company_Div"></div>