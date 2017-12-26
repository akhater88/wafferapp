<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<div style="width:900px; font-size:15px; font-weight:bold ">
<div>&nbsp;</div>
<?php
$Time_Stamp = date('m_d_Y').time();
?>
<script type="text/javascript" src="<?php echo __SCRIPT_PATH;?>js/jquery-1.4.2.min.js"></script>
<script type="text/javascript"> 
	$(document).ready(function() { 
	
	jQuery.read_ivalid_msg_2 = function(Time_Stamp_JSON){
				$.getJSON('<?php echo __SCRIPT_PATH;?>json/'+Time_Stamp_JSON+'.json',function(json){
					var MSG = json.MSG_3;
					$(MSG).appendTo('#Message_3');
				});
			}
			
	jQuery.read_ivalid_msg_1 = function(Time_Stamp_JSON){
				$.getJSON('<?php echo __SCRIPT_PATH;?>json/'+Time_Stamp_JSON+'.json',function(json){
					var MSG = json.MSG_2;
					$(MSG).appendTo('#Message_2');
				});
			}
			
	jQuery.read_valid_msg = function(Time_Stamp_JSON){
				$.getJSON('<?php echo __SCRIPT_PATH;?>json/'+Time_Stamp_JSON+'.json',function(json){
					var MSG = json.MSG;
					$(MSG).appendTo('#Message_1');
				});
			}
	jQuery.read_json = function(Time_Stamp_JSON){
				$.getJSON('<?php echo __SCRIPT_PATH;?>json/'+Time_Stamp_JSON+'.json',function(json){
					$.each(json,function(i,div){
					  $(div.Email).appendTo('#Message');
					});
					
				});
			}
			
	jQuery.read_json_failed = function(Time_Stamp_JSON){
				$.getJSON('<?php echo __SCRIPT_PATH;?>json/'+Time_Stamp_JSON+'.json',function(json){
					$.each(json,function(i,div){
					  $(div.Email).appendTo('#Failed_Message');
					});
					
				});
			}  
	jQuery.read_json_failed_invalid = function(Time_Stamp_JSON){
				$.getJSON('<?php echo __SCRIPT_PATH;?>json/'+Time_Stamp_JSON+'.json',function(json){
					$.each(json,function(i,div){
					  $(div.Email).appendTo('#Failed_Message_Invalid');
					});
					
				});
			}
			
	$('.Submit_BTN').click(function(){
			$('.MSG').remove();
			$('.MyList_Inner').remove();
			$('.MyList_Inner_Used').remove();
			$('.Failed_Message').remove();
			$('.MyList_Inner_Used_Invalid').remove();
			var Emails = $('#Emails').val();
			var MSG = $('#MSG').val();
			$.post('<?php echo __LINK_PATH;?>mobile_users_functions/submit_invitations/AJAX/Y/',{Emails:Emails,MSG:MSG,Time_Stamp:'<?php echo $Time_Stamp;?>'},function(data){
					setTimeout('$.fn.myFunction()',100);
					$.fn.myFunction = function() { 
								$.getJSON('<?php echo __SCRIPT_PATH;?>json/<?php echo $Time_Stamp;?>.json',function(json){
								var Flag = json.flag;
								
								if(Flag == '1')
									{
										alert('الـقـائـمــة فــارغــة');
									}
								else if(Flag == '2')
									{
										alert('لـم يـتـم الـعـثــور عـلـى أي بـريــد إلـكـتـرونـي صـالـح');
									}
								else
									{
										$('#Form').slideUp('slow');
										var Time_Stamp_MSG = 'Valid_MSG_'+'<?php echo $Time_Stamp;?>';
										$.read_valid_msg(Time_Stamp_MSG);
										
										var Time_Stamp_JSON = 'Valid_'+'<?php echo $Time_Stamp;?>';
										$.read_json(Time_Stamp_JSON);
										
										
										var Time_Stamp_JSON = 'MSG_2_'+'<?php echo $Time_Stamp;?>'; 
										$.read_ivalid_msg_1(Time_Stamp_JSON);
										
										var Time_Stamp_JSON = 'Invalid_'+'<?php echo $Time_Stamp;?>';
										$.read_json_failed(Time_Stamp_JSON);
										
										var Time_Stamp_JSON = 'MSG_3_'+'<?php echo $Time_Stamp;?>'; 
										$.read_ivalid_msg_2(Time_Stamp_JSON);
										
										var Time_Stamp_JSON = 'Invalid_Email_'+'<?php echo $Time_Stamp;?>';
										$.read_json_failed_invalid(Time_Stamp_JSON);
									}
								
								});
							}
				});
				
		});	
			
			
	});
</script>
<style>
textarea { 
    resize: none; 
}
</style>
<div style="line-height:15px ">&nbsp;</div>
<div id="Form">
<form action="<?php echo __LINK_PATH;?>mobile_users/log_in" method="post" name="form1" id="form1">
<table width="100%"  border="0" cellpadding="5">
  <tr>
      <td colspan="2"><div align="right" dir="rtl"><span> الـرجـاء إدخـال عـنـاويـن الـبـريـد الإلـكـتـرونـي عـلـى الـنـحـو الـتـالـي : </span><span style="margin:10px; font-size:11px; color:#FF0000 ">Email 1,Email 2, Email 3</span></div></td>
  </tr>
  <tr>
    <td colspan="2"><div align="right"><textarea id="Emails" cols="100" rows="10"></textarea></div></td>
   <tr/>
    <tr>
      <td colspan="2"><div align="right">الـرسـالــة الـمــراد إرفـاقـهــا إلــى أصـحـاب الـبـريـد الإلكـتـرونــي</div></td>
  	</tr>
	 <tr>
      <td colspan="2"><div align="right"><textarea id="MSG" cols="100" rows="5" dir="rtl"></textarea>
      </div></td>
  	</tr>
    
  <tr>
    <td colspan="2"><div align="right"><input type="button" name="Button" value="    إرســال    " class="Submit_BTN"></div></td>
  </tr>

</table>
</form>
</div>
<div align="right" id="Message_1" style="color:#009900 "></div>
<div align="right" id="Message" style="color:#009900 "></div>
<div style="line-height:15px ">&nbsp;</div>
<div align="right" id="Message_2" style="color:#009900 "></div>
<div align="right" id="Failed_Message" style="color:#FF0000 "></div>
<div style="line-height:15px ">&nbsp;</div>
<div align="right" id="Message_3" style="color:#009900 "></div>
<div align="right" id="Failed_Message_Invalid" style="color:#FF0000 "></div>
</div>

