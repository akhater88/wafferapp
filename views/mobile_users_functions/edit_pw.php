<div id="text-titles">
<table style="width: 100%" cellspacing="0" cellpadding="0">
	<tr>
		<td align="center" valign="middle">
				<img alt="" src="<?php echo __SCRIPT_PATH?>images/my-account.png" width="64" height="26" />
		</td>
	</tr>
</table>
</div>
<div id="text-middle">

<?php
$Time_Stamp = date('m_d_Y').time();
?>
<script type="text/javascript" src="<?php echo __SCRIPT_PATH;?>js/jquery-1.4.2.min.js"></script>
<script type="text/javascript"> 
	$(document).ready(function() { 
		
		
	$('.Submit_Main_BTN_Add').click(function(){
			
			var password = $('#password').val();
			var password_2 = $('#password_2').val();
			$.post('<?php echo __LINK_PATH;?>mobile_users_functions/submit_new_pw/AJAX/Y/',{password:password,password_2:password_2,Time_Stamp:'<?php echo $Time_Stamp;?>'},function(data){
							setTimeout('$.fn.myFunction()',100);
						   $.fn.myFunction = function() { 
								$.getJSON('<?php echo __SCRIPT_PATH;?>json/<?php echo $Time_Stamp;?>.json',function(json){
								var Flag = json.flag;
								 if(Flag == '1')
									{
										alert('كـلـمـة الـسـر يـجـب أن تـكـون أكـثـر مـن خـمـسـة حـروف');
									}
								else if(Flag == '2')
									{
										alert('كـلـمتـا الـسـر غـيـر مـتـطـابـقـتـيـن');
									}
								else if(Flag == '3')
									{
										alert('كـلـمـة الـسـر يـجـب أن تـكـون أكـثـر مـن خـمـسـة حـروف');
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

<?php
$Dir = 'rtl';
$Today = date('d-m-Y');
?>
<div id="name-login">أهلا بك،<?php echo $_SESSION['Mobile_User_Name'];?></div>
<div id="login-tabs">
	<?php 
	$myfunctions = new myfunctions();
	$myfunctions->display_mobile_menu('5');
	?>
</div>

<table width="100%"  border="0" cellpadding="3" cellspacing="0">
   <tr>
   <td width="30%">كـلـمــة الـســر</td>
    <td width="70%">
	<input name="password" type="password" id="password" style="border:1px #bebfc0 solid; " size="30" dir="<?php echo $Dir;?>">&nbsp;<span style="font-size:12px; color:#FF0000 ">كـلـمـة الـسـر يـجـب أن تـكـون أكـثـر مـن خـمـسـة حـروف</span>
	</td>
    
  </tr>
   <tr>
      <td width="30%">تـأكـيـد كـلـمـة الـسـر</td>
    <td width="70%">
	<input name="password_2" type="password" id="password_2"  style="border:1px #bebfc0 solid; " size="30" dir="<?php echo $Dir;?>">
	
	</td>
 
  </tr>
  <tr>
    	<td width="30%"><div align="right"><img alt="" src="<?php echo __SCRIPT_PATH?>images/sent-form.jpg" width="75" height="25"   class="Submit_Main_BTN_Add"></div></td>
    	<td width="70%"><div align="right">&nbsp;</div></td>
  	</tr>
</table>
</div>