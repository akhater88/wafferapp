<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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
			var PW2 = $('#PW2').val();
			$('.MSG').remove();
			$.post('<?php echo __LINK_PATH;?>mobile_users/submit_new_account/AJAX/Y/',{Email:Email,PW:PW,PW2:PW2,Time_Stamp:'<?php echo $Time_Stamp;?>'},function(data){
					setTimeout('$.fn.myFunction()',100);
					$.fn.myFunction = function() { 
								$.getJSON('<?php echo __SCRIPT_PATH;?>json/<?php echo $Time_Stamp;?>.json',function(json){
								var Flag = json.flag;
								
								if(Flag == '1')
									{
										alert('الـرجـاء إدخـال كـلـمــة الـسـر');
									}
								else if(Flag == '2')
									{
										alert('كـلـمـتـا الـسـر غـيـر مـتـطـابـقـتـيـن');
									}
								else if(Flag == '3')
									{
										alert('كـلـمــة الـسـر يـجـب أن تـكــون أكـثـر مـن خـمـسـة حـروف');
									}
								else if(Flag == '4')
									{
										alert('لــم يـتـم الـعـثــور عـلـى حـسـاب لـك');
									}
								else
									{
										
										$('<div class="MSG"><div>لـقـد تـم إرســال مـعـلـومـات الـتسـجـيـل إلـى بـريـدك الإلـكـتـرونـي</div></div>').appendTo('#Message');
										
									}
								
								});
							}
				});
				
		});	
			
			
	});
</script>
<div align="right" id="Message" style="color:#009900 "></div>
<div style="line-height:15px ">&nbsp;</div>
<form action="<?php echo __LINK_PATH;?>mobile_users/log_in" method="post" name="form1" id="form1">
<table width="100%"  border="0" cellpadding="5" dir="ltr">
  <tr>
      <td width="79%"><div align="right"><input name="Email" type="text" id="Email" size="40">
      </div></td>
      <td width="21%"><div align="right">الـبـريـد الإلـكـتـرونــي</div></td>
  </tr>
  <tr>
    <td><div align="right"><input name="PW" type="password" id="PW" size="40">
    </div></td>
    <td><div align="right">كـلـمــة الـسـر</div></td>
  </tr>
   <tr>
    <td><div align="right"><input name="PW2" type="password" id="PW2" size="40">
    </div></td>
    <td><div align="right">تـأكـيـد كـلـمــة الـســر</div></td>
  </tr>
  <tr>
    <td><div align="right"><img alt="" src="<?php echo __SCRIPT_PATH;?>images/send.jpg" width="104" height="44" class="Submit_BTN" style="cursor:pointer "></div></td>
    <td><div align="right">&nbsp;</div></td>
  </tr>

</table>
</form>
