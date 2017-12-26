<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<div id="text-titles">
<table style="width: 100%" cellspacing="0" cellpadding="0">
<tr><td align="center" valign="middle"><img alt="" src="<?php echo __SCRIPT_PATH;?>images/contacts.png" /></td></tr></table>
</div>
<?php
$Time_Stamp = date('m_d_Y').time();
?>
<script type="text/javascript" src="<?php echo __SCRIPT_PATH;?>js/jquery-1.4.2.min.js"></script>
<script type="text/javascript"> 
	$(document).ready(function() { 
	$('.Submit_BTN').click(function(){
			var Email = $('#Email').val();
			var PW1 = $('#PW1').val();
			
			$.post('<?php echo __LINK_PATH;?>mobile_users/submit_log_in/AJAX/Y/',{Email:Email,PW1:PW1,Time_Stamp:'<?php echo $Time_Stamp;?>'},function(data){
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
										
										window.location = '<?php echo __LINK_PATH;?>mobile_users_functions/invite_friends';
										
									}
								
								});
							}
				});
				
		});	
			
			
	});
</script>
<div id="text-middle">
<form action="<?php echo __LINK_PATH;?>mobile_users/submit_log_in" method="post" name="form1" id="form1">
<table width="100%"  border="0" cellpadding="5">
  <tr>
 	  <td width="16%"><div align="right">الـبـريـد الإلـكـتـرونــي</div></td>
      <td width="84%"><div align="right"><input name="Email" type="text" id="Email" size="40">
      </div></td>
      
  </tr>
  <tr>
  <td><div align="right">كـلـمــة الـسـر</div></td>
    <td><div align="right"><input name="PW1" type="password" id="PW1" size="40">
    </div></td>
    
  </tr>
  <tr>
    <td><div align="right">
    <input type="hidden" name="Time_Stamp" value="<?php echo $Time_Stamp;?>">
    <input type="submit" name="Button" value="    إرســال    " ></div></td>
    <td><div align="right">&nbsp;</div></td>
  </tr>
  <tr>
    <td><div align="right"><span style="cursor:pointer " onClick="RedirectModified('<?php echo __LINK_PATH;?>mobile_users/create_account/')">إضـغـط هـنــا للإشـتـراك</span></div></td>
    <td><div align="right">&nbsp;</div></td>
  </tr>
</table>
</form>
</div>
