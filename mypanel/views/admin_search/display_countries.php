<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<div id="Country_Div">
<div align="right" style="width:900px; font-size:15px; font-weight:bold ">
<style>
.mydate{
display:none;
}
.Search_With_Country{
cursor:pointer;
}
</style>
<script type="text/javascript" src="<?php echo __SCRIPT_PATH;?>js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="<?php echo __SCRIPT_PATH;?>js/datepicker.js"></script>
<link rel="stylesheet" href="<?php echo __SCRIPT_PATH;?>css/datepicker.css" type="text/css" />
<script type="text/javascript"> 
	$(document).ready(function() {
			
		$('.Search_With_Country').click(function(event){
			var CID = $('#Country').val();
			var Email = $('#Email').val();
			var Time_Stamp = event.timeStamp;
			if($('#Enable_Date').attr('checked'))
				{
					var Starts_Date = $('#Start_Day').val()+'-'+$('#Start_Month').val()+'-'+$('#Start_Year').val();
					var End_Date = $('#End_Day').val()+'-'+$('#End_Month').val()+'-'+$('#End_Year').val();
					
				}
			else
				{
					var Starts_Date = '000000';
					var End_Date = '000000';
				}
			
			$.post('<?php echo __LINK_PATH;?>admin_search/mobile_user_search_log/AJAX/Y/',{CID:CID,Email:Email,Starts_Date:Starts_Date,End_Date:End_Date,Time_Stamp:Time_Stamp},function(data){
					setTimeout('$.fn.myFunction()',100);
						   $.fn.myFunction = function() { 
								$.getJSON('<?php echo __SCRIPT_PATH;?>json/'+Time_Stamp+'.json',function(json){
								var Flag = json.flag;
								
								if(Flag == '1')
									{
										alert('عـلـيــك إخـتـيــار الـبــلــد');
									}
								else if(Flag == '2')
									{
										alert('عـلـيـك إخـتـيـار الـبـريـد الإلكـتـرونـي');
									}
								else
									{
										
										$('#Display_Search_Results').html(data);
										
									}
								
								});
							}
				});
		});	
		
	});
</script>
<table style="width: 100%" class="style1" cellpadding="5" dir="ltr">
  <tr>
     <td width="79%"><div align="right">
	 <select id="Country">
	 <option value="0" selected>--الـبـلــد--</option>
	 <option value="999">--الـكـل--</option>
	 <?php
	 foreach($MyData as $key=>$value)
	 	{
			?>
			<option value="<?php echo $key;?>"><?php echo $value;?></option>
			<?php
		}
	 ?>
	 </select>
	 </div></td>
	 <td width="21%"><div align="right">الـبـلــد</div></td>
  </tr>
  <tr>
     <td width="79%"><div align="right"><img alt="" src="<?php echo __SCRIPT_PATH;?>images/send.jpg" width="104" height="44" class="Search_With_Country"></div></td>
	 <td width="21%"><div align="right">&nbsp;</div></td>
  </tr>
</table>
<div id="Display_Search_Results"></div>
</div>
</div>