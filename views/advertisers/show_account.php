<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<div align="center" style="width:900px; font-size:15px; font-weight:bold ">
<?php
$Time_Stamp = date('m_d_Y').time();
?>
<script type="text/javascript" src="<?php echo __SCRIPT_PATH;?>js/jquery-1.4.2.min.js"></script>
<script type="text/javascript"> 
	$(document).ready(function() { 
	$('.Submit_Main_BTN_Add').click(function(){
			var ID = '<?php echo $Member_ID;?>';
			var First_Name = $('#First_Name').val();
			
			var Company_Name = $('#Company_Name').val();
			var Phone_Number = $('#Phone_Number').val();
			var Cell_Phone = $('#Cell_Phone').val();
			var user_name = $('#user_name').val();
			
			$.post('<?php echo __LINK_PATH;?>advertisers/submit_members_edit/AJAX/Y/',{ID:ID,First_Name:First_Name,Company_Name:Company_Name,Phone_Number:Phone_Number,Cell_Phone:Cell_Phone,user_name:user_name,Time_Stamp:'<?php echo $Time_Stamp;?>'},function(data){
							setTimeout('$.fn.myFunction()',100);
						   $.fn.myFunction = function() { 
								$.getJSON('<?php echo __SCRIPT_PATH;?>json/<?php echo $Time_Stamp;?>.json',function(json){
								var Flag = json.flag;
								
								if(Flag == '1')
									{
										alert('عـلـيـك إدراج الإسـم');
									}
								else if(Flag == '2')
									{
										alert('عـلـيـك إدراج إسـم الـعـائـلــة');
									}
				
								else if(Flag == '6')
									{
										alert('عـلـيـك إدراج إسـم الـشـركــة');
									}
								else if(Flag == '7')
									{
										alert('عـلـيـك إدراج رقـم الـهـاتـف أو رقـم الـهـاتـف الـجـوال');
									}
								else if(Flag == '8')
									{
										alert('عـلـيـك إدراج إسـم الـمـسـتـخـدم');
									}
								
								else if(Flag == '13')
									{
										alert('إســم الـمـسـتـخـدم يـجـب أن يحـوي بـريـدا إلـكـترونـيــا');
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
<style>
.Submit_Main_BTN_Add{
width:80px;
height:25px;
background-color:#000066;
color:#FFFFFF;
cursor:pointer;
}

</style>
<?php
if(isset($_SESSION['Arabic']))
	{
		$Dir = 'rtl';
	}
else
	{
		$Dir = 'ltr';
	}
foreach($results as $rows)
	{
		$First_Name = $rows->First_Name;
		$Company_Name = $rows->Company_Name;
		$Phone_Number = $rows->Phone_Number;
		$Cell_Phone = $rows->Cell_Phone;
		$user_name = $rows->user_name;
	}
$Today = date('d-m-Y');
?>
<table width="100%"  border="0" cellpadding="3" cellspacing="0">
  <tr>
    <td width="83%">
	<div align="right"><input name="First_Name" type="text" id="First_Name" size="30" value="<?php echo $First_Name;?>" dir="<?php echo $Dir;?>"></div>
	</td>
    <td width="17%"><div align="right">الإســم</div></td>
  </tr>
   <tr>
    	<td width="83%"><div align="right"><input name="user_name" type="text" id="user_name" size="30" value="<?php echo $user_name;?>" dir="<?php echo $Dir;?>">
    	</div></td>
    	<td width="17%"><div align="right">إســم الـمــستـخـدم</div></td>
  	</tr>
  
	<tr>
    	<td width="83%"><div align="right"><input name="Company_Name" type="text" id="Company_Name" size="30" value="<?php echo $Company_Name;?>" dir="<?php echo $Dir;?>">
    	</div></td>
    	<td width="17%"><div align="right">إسـم الـشركــة</div></td>
  	</tr>
	<tr>
    	<td width="83%"><div align="right"><input name="Phone_Number" type="text" id="Phone_Number" size="30" value="<?php echo $Phone_Number;?>" dir="<?php echo $Dir;?>">
    	</div></td>
    	<td width="17%"><div align="right">رقـم الـهـاتـف</div></td>
  	</tr>
	<tr>
    	<td width="83%"><div align="right"><input name="Cell_Phone" type="text" id="Cell_Phone" size="30" value="<?php echo $Cell_Phone;?>" dir="<?php echo $Dir;?>">
    	</div></td>
    	<td width="17%"><div align="right">رقـم الـجـوال</div></td>
  	</tr>
	
	
  <tr>
    	<td width="83%"><div align="right"><input type="button" name="Sub_Menu_Btn" value="إرسـال" class="Submit_Main_BTN_Add"></div></td>
    	<td width="17%"><div align="right">&nbsp;</div></td>
  	</tr>
</table>
</div>