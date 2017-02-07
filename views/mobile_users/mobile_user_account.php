<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<div style="width:900px; font-size:15px; font-weight:bold ">
<div>&nbsp;</div>
<?php
$Time_Stamp = date('m_d_Y').time();
?>
<script type="text/javascript" src="<?php echo __SCRIPT_PATH;?>js/jquery-1.4.2.min.js"></script>
<script type="text/javascript"> 
	$(document).ready(function() { 
	$('.Submit_BTN').click(function(){
			var Email = $('#Email').val();
			var PW = $('#PW').val();
			
			$.post('<?php echo __LINK_PATH;?>mobile_users/submit_log_in/AJAX/Y/',{Email:Email,PW:PW,Time_Stamp:'<?php echo $Time_Stamp;?>'},function(data){
					setTimeout('$.fn.myFunction()',100);
					$.fn.myFunction = function() { 
								$.getJSON('<?php echo __SCRIPT_PATH;?>json/<?php echo $Time_Stamp;?>.json',function(json){
								var Flag = json.flag;
								
								if(Flag == '1')
									{
										alert('خـطـأ فـي مـعـلـومـات الـدخــول');
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
<form action="<?php echo __LINK_PATH;?>mobile_users/log_in" method="post" name="form1" id="form1">
<table width="100%"  border="0" cellpadding="5">
  <tr>
      <td width="84%"><div align="right"><input name="Email" type="text" id="Email" size="40">
      </div></td>
      <td width="16%"><div align="right">الـبـريـد الإلـكـتـرونــي</div></td>
  </tr>
  <tr>
    <td><div align="right"><input name="PW" type="password" id="PW" size="40">
    </div></td>
    <td><div align="right">كـلـمــة الـسـر</div></td>
  </tr>
  <tr>
    <td><div align="right"><input type="button" name="Button" value="    إرســال    " class="Submit_BTN"></div></td>
    <td><div align="right">&nbsp;</div></td>
  </tr>
  <tr>
    <td><div align="right"><span style="cursor:pointer " onClick="RedirectModified('<?php echo __LINK_PATH;?>mobile_users/create_account/')">إضـغـط هـنــا للإشـتـراك</span></div></td>
    <td><div align="right">&nbsp;</div></td>
  </tr>
</table>
</form>
</div>
