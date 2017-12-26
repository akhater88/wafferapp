<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<div align="right" style="width:900px; font-size:15px; font-weight:bold ">
<div>&nbsp;</div>
<style>
.mydate{
display:none;
}
</style>
<script type="text/javascript" src="<?php echo __SCRIPT_PATH;?>js/jquery-1.4.2.min.js"></script>
<script type="text/javascript"> 
	$(document).ready(function() {
			
		$('.Search').click(function(event){
			var CID = $('#Country').val();
			var Company_ID = $('#Company').val();
			var Time_Stamp = event.timeStamp;
			var Start_Day_Val = $('#Start_Day').val();
			var Start_Month_Val = $('#Start_Month').val();
			var Start_Year_Val = $('#Start_Year').val();
			var End_Day_Val = $('#End_Day').val();
			var End_Month_Val = $('#End_Month').val();
			var End_Year_Val = $('#End_Year').val();
			if((Start_Day_Val != '') && (Start_Month_Val != '') && (Start_Year_Val != ''))
				{
					var Starts_Date = $('#Start_Day').val()+'-'+$('#Start_Month').val()+'-'+$('#Start_Year').val();
				}
			else
				{
					var Starts_Date = '';
				}
			if((End_Day_Val != '') && (End_Month_Val != '') && (End_Year_Val != ''))
				{
					var End_Date = $('#End_Day').val()+'-'+$('#End_Month').val()+'-'+$('#End_Year').val();
				}
			else
				{
					var End_Date = '';
				}
			
			$.post('<?php echo __LINK_PATH;?>admin_search/merchant_log/AJAX/Y/',{Company_ID:Company_ID,CID:CID,Starts_Date:Starts_Date,End_Date:End_Date,Time_Stamp:Time_Stamp},function(data){
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
										alert('عـلـيــك إخـتـيــار الـشــركــة');
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
<style>
.Search{
cursor:pointer;
}

</style>
<table style="width: 100%" class="style1" cellspacing="0" dir="ltr">
  <tr>
     <td width="79%"><div align="right">
	   <select id="Company">
	 <option value="0" selected>--الـشــركــة--</option>
	 <option value="999">--الـكـل--</option>
	 <?php
	 foreach($results_company as $rows)
	 	{
		if($rows->Company_Name != NULL)
			{
			?>
			<option value="<?php echo $rows->Company_Name;?>"><?php echo $rows->Company_Name;?></option>
			<?php
			}
		}
	 ?>
	 </select>
	 </div></td>
	 <td width="21%"><div align="right">الـشــركــة</div></td>
  </tr>
  <tr>
     <td width="79%"><div align="right"><img alt="" src="<?php echo __SCRIPT_PATH;?>images/send.jpg" width="104" height="44" class="Search"></div></td>
	 <td width="21%"><div align="right">&nbsp;</div></td>
  </tr>
</table>
<div id="Display_Search_Results"></div>
</div>