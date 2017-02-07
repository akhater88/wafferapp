<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<div id="Container">
<div align="right" style="width:900px; font-size:15px; font-weight:bold ">
<div>&nbsp;</div>
<?php
$Dir = 'rtl';
$Time_Stamp = date('m_d_Y').time();
?>
<script type="text/javascript" src="<?php echo __SCRIPT_PATH;?>js/jquery-1.4.2.min.js"></script>
<script type="text/javascript"> 
	$(document).ready(function() { 
	
	$('.Paginate').click(function(){
			var Page = $(this).attr('id'); 
			$.post('<?php echo __LINK_PATH;?>adminprizes/add_prize/AJAX/Y/',{Page:Page},function(data){
				$('#Container').html(data);
				$('#Product_Container').hide().delay(300).fadeIn();
				});
			});	
			
	$('.Add_Main_Menu_Img').click(function(){
			$('.Edit_Div').slideUp('slow');
			$('#Add_Main_Menu').slideDown('slow');
			$('#Prize_Name').val('');
			$('#Points').val('');
		});  
		
	$('.Edit_BTN').click(function(){
			$('#Add_Main_Menu').slideUp();
			$('#Prize_Name').val('');
			$('#Points').val('');
			$('.Edit_Div').slideUp('slow');
			var ID = $(this).attr('id');
			var Div = $('#Edit_'+ID).slideDown('slow');
		});
	$('.delete_selected_prize').click(function(){
			if (confirm("هــل تـريـد الإسـتـمـرار فـي عـمـلــيـة الـمـسسـح؟")) {
			var ID = $(this).attr('id');
			$.post('<?php echo __LINK_PATH;?>adminprizes/delete_selected_prize/AJAX/Y/',{ID:ID},function(data){
				alert('تـم الـمـسـح بـنـجـاح');
				$('#Container').html(data);
				});
			}
			}); 
	$('.Edit_New_Prize').click(function(){
			var ID = $(this).attr('id');
			var Prize_Name = $('#Prize_Name_'+ID).val();
			var Points = $('#Points_'+ID).val();
			$.post('<?php echo __LINK_PATH;?>adminprizes/submit_edit_prize/AJAX/Y/',{ID:ID,Prize_Name:Prize_Name,Points:Points,Time_Stamp:'<?php echo $Time_Stamp;?>'},function(data){
					setTimeout('$.fn.myFunction()',100);
					$.fn.myFunction = function() { 
								$.getJSON('<?php echo __SCRIPT_PATH;?>json/<?php echo $Time_Stamp;?>.json',function(json){
								var Flag = json.flag;
								
								if(Flag == '1')
									{
										alert('عـلـيـك إدراج إسـم الـجـائـزة');
									}
								else if(Flag == '2')
									{
										alert('إســم الـجـائـزة مـوجــود');
									}
								else if(Flag == '3')
									{
										alert('يـجـب عـلـى الـنـقــاط أن تـحـوي أرقـامــا فـقـط');
									}
								
								else
									{
										
										alert('تـمـت الإضـافــة بـنـجــاح');
										$('#Container').html(data);
									}
								
								});
							}
				});
			});
			
	$('.Add_New_Prize').click(function(){
			var Prize_Name = $('#Prize_Name').val();
			var Points = $('#Points').val();
			$.post('<?php echo __LINK_PATH;?>adminprizes/submit_new_prize/AJAX/Y/',{Prize_Name:Prize_Name,Points:Points,Time_Stamp:'<?php echo $Time_Stamp;?>'},function(data){
					setTimeout('$.fn.myFunction()',100);
					$.fn.myFunction = function() { 
								$.getJSON('<?php echo __SCRIPT_PATH;?>json/<?php echo $Time_Stamp;?>.json',function(json){
								var Flag = json.flag;
								
								if(Flag == '1')
									{
										alert('عـلـيـك إدراج إسـم الـجـائـزة');
									}
								else if(Flag == '2')
									{
										alert('إســم الـجـائـزة مـوجــود');
									}
								else if(Flag == '3')
									{
										alert('يـجـب عـلـى الـنـقــاط أن تـحـوي أرقـامــا فـقـط');
									}
								
								else
									{
										
										alert('تـمـت الإضـافــة بـنـجــاح');
										$('#Container').html(data);
									}
								
								});
							}
				});
			});
	});
</script>
<style>
.Add_New_Prize{
width:80px;
height:25px;
background-color:#000066;
color:#FFFFFF;
cursor:pointer;
}
.Edit_New_Prize{
width:80px;
height:25px;
background-color:#000066;
color:#FFFFFF;
cursor:pointer;
}
.Add_Main_Menu
{
padding:5px;
color:#FF9900;
font-family:'Times New Roman', Times, serif; 
font-size:16px;
font-weight:bold;
background-color:#CCDAE3;
}
.Paginate{
margin-right:5px;
cursor:pointer;
color:#0099FF;
}
.Container_Odd
{
padding:5px;
font-family:'Times New Roman', Times, serif; 
font-size:16px;
font-weight:bold;
background-color:#CCDAE3;
}
.Container_Even
{
padding:5px;
font-family:'Times New Roman', Times, serif; 
font-size:16px;
font-weight:bold;
background-color:#F5F5F5;
}
</style>
<div dir="rtl" class="Add_Main_Menu"><img style="cursor:pointer" src="<?php echo __SCRIPT_PATH;?>images/add.png" class="Add_Main_Menu_Img"/>&nbsp;<span>أضــف جـائـزة جـديـدة</span>
 <div id="Add_Main_Menu" style="display:none; position:relative; right:28px">
 <table width="100%"  border="0" cellpadding="5" dir="ltr">
  <tr>
    <td width="87%"><div align="right"><input name="Prize_Name" type="text" id="Prize_Name" dir="<?php echo $Dir;?>" size="30" /></div></td>
    <td width="13%"><div align="right" style="color:#000000 ">إســم الـجـائـزة</div></td>
  </tr>
   <tr>
    <td><div align="right"><input name="Points" type="text" id="Points" dir="<?php echo $Dir;?>" size="6" /></div></td>
    <td><div align="right" style="color:#000000 ">عــدد النـقــاط</div></td>
  </tr>
   <tr>
    <td><div align="right"><input type="button" name="Sub_Menu_Btn" value="إرسـال" class="Add_New_Prize"></div></td>
    <td><div align="right">&nbsp;</div></td>
  </tr>
</table>
</div>
</div>
<div style="line-height:12px">&nbsp;</div>
<div id="Product_Container">
<?php
if(count($results) && is_array($results))
	{
		$Index = 1;
		foreach($results as $rows)
			{
				if($Index % 2) 
					{
						$Class = 'Container_Odd';
					} 
				else 
					{
						$Class = 'Container_Even';
					}
				?>
				<div style="padding:5px " class="<?php echo $Class;?>">
				<span style="color:#009900; position:relative; top:5px "><img style="cursor:pointer " class="delete_selected_prize" id="<?php echo $rows->ID;?>" src="<?php echo __SCRIPT_PATH;?>images/del.png" height="20" width="20">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
				<span style="color:#009900; position:relative; top:5px "><img style="cursor:pointer " class="Edit_BTN" id="<?php echo $rows->ID;?>" src="<?php echo __SCRIPT_PATH;?>images/edit.png" height="20" width="20">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
				<span style="color:#009900 ">(<?php echo $rows->Points;?>)&nbsp;&nbsp;&nbsp;&nbsp;</span>
				<span><?php echo stripslashes($rows->Prize_Name);?></span>
				<div style="line-height:15px ">&nbsp;</div>
				<div class="Edit_Div" id="Edit_<?php echo $rows->ID;?>" style="display:none ">
				 <table width="100%"  border="0" cellpadding="5" dir="ltr">
				  <tr>
					<td width="87%"><div align="right"><input name="Prize_Name_<?php echo $rows->ID;?>" type="text" id="Prize_Name_<?php echo $rows->ID;?>" dir="<?php echo $Dir;?>" size="30" value="<?php echo stripslashes($rows->Prize_Name);?>" /></div></td>
					<td width="13%"><div align="right" style="color:#000000 ">إســم الـجـائـزة</div></td>
				  </tr>
				   <tr>
					<td><div align="right"><input name="Points_<?php echo $rows->ID;?>" type="text" id="Points_<?php echo $rows->ID;?>" dir="<?php echo $Dir;?>" size="6" value="<?php echo $rows->Points;?>" /></div></td>
					<td><div align="right" style="color:#000000 ">عــدد النـقــاط</div></td>
				  </tr>
				   <tr>
					<td><div align="right"><input id="<?php echo $rows->ID;?>" type="button" name="Sub_Menu_Btn" value="إرسـال" class="Edit_New_Prize"></div></td>
					<td><div align="right">&nbsp;</div></td>
				  </tr>
				</table>
				</div>
				</div>
				<?php
				$Index++;
			}
	}
?>
</div>
<div style="line-height:12px">&nbsp;</div>
<!-- Footer paginations !-->
<?php
if ($Page < 1) 
	{ 
		$Page = 1; 
	} 
elseif ($Page > $Last) 
	{ 
		$Page = $Last; 
	}
if($Last > 1)
	{
		?>
		<div dir="rtl">
		<?php
		for($i = 0; $i<$Last; $i++)
			{
				$next = $i+1;
				if($Page != $i+1)
				{
				?>
				<span class="Paginate" id="<?php echo $next;?>"><?php echo $i+1;?></span>
				<?php
				}
			else
				{
				?>
				<span style="margin-right:5px "><?php echo $i+1;?></span>
				<?php
				}
				
			}
			?>
			</div>
			<?php
	}			
?>
<!-- End of page divs !-->
</div>
</div>