<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style>
#Submit{
width:100px;
height:25px;
background-color:#000066;
color:#FFFFFF;
cursor:pointer;
}
</style>
<script type="text/javascript"> 
	$(document).ready(function() { 
	
		$('#Submit').click(function(event){
			var Name = $('#Name').val();
			var Email = $('#Email').val();
			var Country = $('#Country').val();
			var MSG = $('#MSG').val();
			var Time_Stamp = event.timeStamp;
			
			$.post('<?php echo __LINK_PATH;?>pages/submit_request_form/AJAX/Y/',{Name:Name,Email:Email,Country:Country,MSG:MSG,Time_Stamp:Time_Stamp},function(data){
							$.getJSON('<?php echo __SCRIPT_PATH;?>json/'+Time_Stamp+'.json',function(json){
								var Flag = json.flag;
								if(Flag == '1')
									{
										alert('عـلـيـك إدراج الإســم');
									}
								else if(Flag == '2')
									{
										alert('عـلـيـك إدراج الـبـريـد الإلـكـتـرونــي');
									}
								else if(Flag == '3')
									{
										alert('الـبـريـد الإلـكـتـرونـي غـيـر صـالــح');
									}
								else if(Flag == '4')
									{
										alert('عـلـيـك إخـتـيـار الـبـلــد');
									}
								else if(Flag == '5')
									{
										alert('عـلـيـك إدراج نـص الـرســالــة');
									}
								else
									{
										alert('Your Email has been sent successfully');
										$('#Name').val('');
										$('#Email').val('');
										$('#Country').val('0');
										$('#MSG').val('');
									}
								
								});
					});
			});	
			
	});
</script>
<div id="text-titles">
<table style="width: 100%" cellspacing="0" cellpadding="0">
<tr><td align="center" valign="middle"><img alt="" src="<?php echo __SCRIPT_PATH;?>images/contacts.png" /></td></tr></table>
</div>
<div id="text-middle">
<table width="100%"  border="0" cellpadding="3" cellspacing="0">
  <tr>
   <td><div align="right">الإســم</div></td>
    <td><div align="right"><input id="Name" name="Name" type="text"></div></td>
   
  </tr>
 <tr>
   <td><div align="right">الـبـريـد الإلـكـتـرونــي</div></td>
    <td><div align="right"><input id="Email" name="Email" type="text"></div></td>
  
  </tr>
  <tr>
  <td><div align="right">الـبــلــد</div></td>
    <td><div align="right">
	<select id="Country">
	<option value="0" selected>--الـبــلــد--</option>
	<option value="1">الأردن</option>
	<option value="2">الـسـعـوديـة</option>
	</select>
	</div></td>
    
  </tr>
  <tr>
  <td><div align="right">نـص الـرســالــة</div></td>
    <td><div align="right"><textarea name="MSG" cols="36" rows="5" id="MSG" style="resize:none "></textarea></div></td>
    
  </tr>
  <tr>
   <td><div align="right">&nbsp;</div></td>
    <td><div align="right"><img id="Submit" src="<?php echo __SCRIPT_PATH;?>images/send.png" style="cursor:pointer " /></div></td>
   
  </tr>
   
</table>
</div>