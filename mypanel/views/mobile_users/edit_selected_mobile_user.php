<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<div style="width:900px; font-size:15px; font-weight:bold ">
<div>&nbsp;</div>
<style>
.Submit{
cursor:pointer;
}
</style>
<script type="text/javascript" src="<?php echo __SCRIPT_PATH;?>js/jquery-1.4.2.min.js"></script>
<script type="text/javascript"> 
	$(document).ready(function() { 
	$('.Submit').click(function(event){
			var ID = '<?php echo $Member;?>';
			var Email = $('#Email').val();
			var PW = $('#PW').val();
			var PW2 = $('#PW2').val();
			var Country_Menu = $('#Country_Menu').val();
			var Time_Stamp = event.timeStamp;
			
			$.post('<?php echo __LINK_PATH;?>mobile_users/submit_edit_account/AJAX/Y/',{ID:ID,Email:Email,PW:PW,PW2:PW2,Country_Menu:Country_Menu,Time_Stamp:Time_Stamp},function(data){
					
								$.getJSON('<?php echo __SCRIPT_PATH;?>json/'+Time_Stamp+'.json',function(json){
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
										
										alert('تـم الـتـعـديـل بـنـجــاح');
										
									}
								
								});
							
				});
				
		});	
			
			
	});
</script>
<div align="right" id="Message" style="color:#009900 "></div>
<div style="line-height:15px ">&nbsp;</div>
<form action="<?php echo __LINK_PATH;?>mobile_users/log_in" method="post" name="form1" id="form1">
<table width="100%"  border="0" cellpadding="5">
  <tr>
      <td width="83%"><div align="right"><input name="Email" type="text" id="Email" size="40" value="<?php echo $MyData['Email'];?>">
      </div></td>
      <td width="17%"><div align="right">الـبـريـد الإلـكـتـرونــي</div></td>
  </tr>
  <tr>
      <td width="83%"><div align="right">
	  <select id="Country_Menu">
	  <?php
	  foreach($MyData_Country as $key=>$value)
	  	{
			if($value == $MyData['Country_ID'])
				{
				?>
				<option value="<?php echo $key;?>" selected><?php echo $value;?></option>
				<?php
				}
			else
				{
				?>
				<option value="<?php echo $key;?>"><?php echo $value;?></option>
				<?php
				}
		}
	  ?>
	  </select>
      </div></td>
      <td width="17%"><div align="right">الـبـلــد</div></td>
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
    <td><div align="right"><img alt="" src="<?php echo __SCRIPT_PATH;?>images/send.jpg" width="104" height="44" class="Submit"></div></td>
    <td><div align="right">&nbsp;</div></td>
  </tr>

</table>
</form>
</div>
