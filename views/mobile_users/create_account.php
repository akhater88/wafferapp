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
	$('.Submit_BTN').click(function(){
			var Email = $('#Email').val();
			var PW1 = $('#PW1').val();
			var PW2 = $('#PW2').val();
			var name = $('#name').val();
			$('.MSG').remove();
			$.post('<?php echo __LINK_PATH;?>mobile_users/submit_new_account/AJAX/Y/',{Email:Email,name:name,PW1:PW1,PW2:PW2,Time_Stamp:'<?php echo $Time_Stamp;?>'},function(data){
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
								else if(Flag == '5')
									{
										alert('ادخل الاسم');
									}
								else if(Flag == '6')
									{
										alert('لقد فمت بالتسجيل من قبل ارسلنا معلوماتك الى البريد الاكتروني');
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
<div id="Message" style="color:#009900 "></div>
<div style="line-height:15px ">&nbsp;</div>
<form action="<?php echo __LINK_PATH;?>mobile_users/log_in" method="post" name="form1" id="form1">
<table width="100%"  border="0" cellpadding="5">
   <tr>
     <td width="17%">الاسم</td>
      <td width="83%"><input name="name" type="text" id="name" size="40">
      </td>
    
  </tr>
  <tr>
   <td width="17%">الـبـريـد الإلـكـتـرونــي</td>
      <td width="83%"><input name="Email" type="text" id="Email" size="40">
      </td>
     
  </tr>
  <tr>
   <td>كـلـمــة الـسـر</td>
    <td><input name="PW1" type="password" id="PW1" size="40">
    </td>
   
  </tr>
   <tr>
   <td>تـأكـيـد كـلـمــة الـســر</td>
    <td><input name="PW2" type="password" id="PW2" size="40">
    </td>
    
  </tr>
  <tr>
  <td>&nbsp;</td>
    <td><input type="button" name="Button" value="    إرســال    " class="Submit_BTN"></td>
    
  </tr>

</table>
</form>
</div>
