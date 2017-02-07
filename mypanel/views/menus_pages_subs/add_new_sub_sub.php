<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
if(isset($_SESSION['Arabic']))
	{
		$Dir = 'rtl';
	}
else
	{
		$Dir = 'ltr';
	}

?>
<style>
.Submit_Edit_Sub_Add{
width:80px;
height:25px;
background-color:#000066;
color:#FFFFFF;
cursor:pointer;
}
</style>
<script type="text/javascript" src="<?php echo __SCRIPT_PATH;?>js/jquery-1.4.2.min.js"></script>
<script type="text/javascript"> 
	$(document).ready(function() { 
		$('.Submit_Edit_Sub_Add').click(function(){
					var ID = $(this).attr('id');
					var Sub_Name = $('#Sub_Name').val();
					if(Sub_Name == '')
						{
							alert('عـلـيـك إدراج إسـم الـقـائـمــة الـفـرعـيــة');
						}
					else
						{
							$.post('<?php echo __LINK_PATH;?>menus_pages_subs/submit_new_sub_sub_menu/AJAX/Y/',{ID:ID,Sub_Name:Sub_Name},function(data){
									setTimeout('$.fn.myFunction()',100);
								   $.fn.myFunction = function() { 
										$.getJSON('<?php echo __SCRIPT_PATH;?>json/Sub_Sub_Menu_Exists.json',function(json){
										var Flag = json.flag;
										if(Flag == '1')
											{
												alert('الإسـم الـذي إخـتـرتـه مـوجــود');
											}
										else
											{
												
												alert('تـمـت الإضـافــة بـنـجــاح');
												window.location = '<?php echo __LINK_PATH;?>menus_pages_subs/edit_sub_menu/';
												
											}
										
										});
									}
								});
						}
					});
			});
</script>
<table width="100%"  border="0" cellspacing="3">
  <tr>
    <td width="67%"><div align="right"><input id="Sub_Name" name="Sub_Name" type="text" size="30" dir="<?php echo $Dir;?>">
    </div></td>
    <td width="33%"><div align="right" style="font-family:'Times New Roman', Times, serif; font-size:15px; font-weight:bold ">إسـم الـقـائـمـة الـتشـعـبـيــة</div></td>
  </tr>
  <tr>
    <td><div align="right"><input type="button" id="<?php echo $Member;?>" name="<?php echo $Member;?>" value="إرسـال" class="Submit_Edit_Sub_Add" style="cursor:pointer "></div></td>
    <td>&nbsp;</td>
  </tr>
</table>
