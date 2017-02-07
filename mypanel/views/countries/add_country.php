<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<div id="Container">
<?php
if(isset($_SESSION['Arabic']))
	{
		$Dir = 'rtl';
		$Lang = 'ar';
	}
else
	{
		$Dir = 'ltr';
		$Lang = 'eng';
	}
$Time_Stamp = date('m_d_Y').time();
$Display = new sql();
?>
<style>
.Paginate{
margin-right:5px;
cursor:pointer;
color:#0099FF;
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
.Submit_New_City{
width:80px;
height:25px;
background-color:#000066;
color:#FFFFFF;
cursor:pointer;
}
.Submit_City_Edit{
width:80px;
height:25px;
background-color:#000066;
color:#FFFFFF;
cursor:pointer;
}
.Submit_Main_BTN_Edit{
width:80px;
height:25px;
background-color:#000066;
color:#FFFFFF;
cursor:pointer;
}
.Submit_Main_BTN_Add{
width:80px;
height:25px;
background-color:#000066;
color:#FFFFFF;
cursor:pointer;
}

</style>
<script type="text/javascript" src="<?php echo __SCRIPT_PATH;?>js/jquery-1.4.2.min.js"></script>
<div>&nbsp;</div>
<script type="text/javascript"> 
	$(document).ready(function() { 
	
		jQuery.cleanUp = function() { 
			var classList = new Array('.Edit_Ads_Cat','#Add_Main_Menu','.Add_New_City','.Edit_Selected_City');
			jQuery.each(classList , function(index, value){
				$(value).slideUp('slow');
			});
		}
		
		$('.Del_Btn').click(function(){
			if (confirm("هــل تـريـد الإسـتـمـرار فـي عـمـلــيـة الـمـسسـح؟")) {
			var ID = $(this).attr('id');
			$.post('<?php echo __LINK_PATH;?>countries/delete_selected_country/AJAX/Y/',{ID:ID},function(data){
					$('#Container').html(data);
				});
			}
			});	
			
		$('.Del_Btn_City').click(function(){
			if (confirm("هــل تـريـد الإسـتـمـرار فـي عـمـلــيـة الـمـسسـح؟")) {
			var ID = $(this).attr('id');
			$.post('<?php echo __LINK_PATH;?>countries/delete_selected_city/AJAX/Y/',{ID:ID},function(data){
					$('#Container').html(data);
				});
			}
			});
			
		$('.Paginate').click(function(){
			var Page = $(this).attr('id'); 
			$.post('<?php echo __LINK_PATH;?>countries/add_country/AJAX/Y/',{Page:Page},function(data){
				$('#Container').html(data);
				$('#Product_Container').hide().delay(300).fadeIn();
				});
			});	
			
		$('.Add_Main_Menu_Img').click(function(){
			$.cleanUp();
			$('#Add_Main_Menu').slideDown();
			});	
			
		$('.Add_City').click(function(){
			$.cleanUp();
			var ID = $(this).attr('id'); 
			var Div = '#Add_New_City_'+ID;
			$(Div).slideDown();
			});  
			
		$('.Show_Edit_City').click(function(){
			$.cleanUp();
			var ID = $(this).attr('id'); 
			var Div = '#Edit_Selected_City_'+ID;
			$(Div).slideDown();
			});  
			
			
		$('.Show_Edit_Form').click(function(){
			$.cleanUp();
			var ID = $(this).attr('id'); 
			var Div = '#Edit_Ads_Cat_'+ID;
			$(Div).slideDown();
			});  
			
		$('.Submit_City_Edit').click(function(){
			var ID = $(this).attr('id');
			var Name_Tag = '#City_Name_Edit_'+ID;
			var Name = $(Name_Tag).val();
			$.post('<?php echo __LINK_PATH;?>countries/submit_edit_city/AJAX/Y/',{ID:ID,Name:Name,Time_Stamp:'<?php echo $Time_Stamp;?>'},function(data){
							setTimeout('$.fn.myFunction()',100);
						   $.fn.myFunction = function() { 
								$.getJSON('<?php echo __SCRIPT_PATH;?>json/<?php echo $Time_Stamp;?>.json',function(json){
								var Flag = json.flag;
								if(Flag == '1')
									{
										alert('عـلـيـك إضـافـة إسـم الـمـديـنــة');
									}
								else if(Flag == '2')
									{
										alert('إسـم الـمـديـنــة مـوجــود');
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
			
		$('.Submit_New_City').click(function(){
			var ID = $(this).attr('id');
			var Name_Tag = '#City_Name_'+ID;
			var Name = $(Name_Tag).val();
			$.post('<?php echo __LINK_PATH;?>countries/submit_new_city/AJAX/Y/',{ID:ID,Name:Name,Time_Stamp:'<?php echo $Time_Stamp;?>'},function(data){
							setTimeout('$.fn.myFunction()',100);
						   $.fn.myFunction = function() { 
								$.getJSON('<?php echo __SCRIPT_PATH;?>json/<?php echo $Time_Stamp;?>.json',function(json){
								var Flag = json.flag;
								if(Flag == '1')
									{
										alert('عـلـيـك إضـافـة إسـم الـمـديـنــة');
									}
								else if(Flag == '2')
									{
										alert('إسـم الـمـديـنــة مـوجــود');
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
			
		$('.Submit_Main_BTN_Edit').click(function(){
			var ID = $(this).attr('id');
			var Name_Tag = '#Name_'+ID;
			var Name = $(Name_Tag).val();
			$.post('<?php echo __LINK_PATH;?>countries/submit_edit_country/AJAX/Y/',{ID:ID,Name:Name,Time_Stamp:'<?php echo $Time_Stamp;?>'},function(data){
							setTimeout('$.fn.myFunction()',100);
						   $.fn.myFunction = function() { 
								$.getJSON('<?php echo __SCRIPT_PATH;?>json/<?php echo $Time_Stamp;?>.json',function(json){
								var Flag = json.flag;
								if(Flag == '1')
									{
										alert('عـلـيـك إضـافـة إسـم الـبـلــد');
									}
								else if(Flag == '2')
									{
										alert('إسـم الـبـلـد مـوجــود');
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
			
		$('.Submit_Main_BTN_Add').click(function(){
			var Name = $('#Name').val();
			$.post('<?php echo __LINK_PATH;?>countries/submit_new_country/AJAX/Y/',{Name:Name,Time_Stamp:'<?php echo $Time_Stamp;?>'},function(data){
							setTimeout('$.fn.myFunction()',100);
						   $.fn.myFunction = function() { 
								$.getJSON('<?php echo __SCRIPT_PATH;?>json/<?php echo $Time_Stamp;?>.json',function(json){
								var Flag = json.flag;
								if(Flag == '1')
									{
										alert('عـلـيـك إضـافـة إسـم الـبـلــد');
									}
								else if(Flag == '2')
									{
										alert('إسـم الـبـلـد مـوجــود');
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
<div dir="rtl" class="Add_Main_Menu"><img style="cursor:pointer" src="<?php echo __SCRIPT_PATH;?>images/add.png" class="Add_Main_Menu_Img"/>&nbsp;<span>أضـف بـلــد جـديــد</span>
 <div id="Add_Main_Menu" style="display:none; position:relative; right:28px"><input name="Name" type="text" id="Name" dir="<?php echo $Dir;?>" size="30" />
 <input type="button" name="Sub_Menu_Btn" value="إرسـال" class="Submit_Main_BTN_Add"></div>
</div>
<div style="line-height:12px">&nbsp;</div>
<div id="Product_Container">
<?php
if((is_array($results))&&(count($results)))
{
	$Color_Array = array('#CCDAE3','#F5F5F5');
	$Counter = 0;
foreach($results as $rows)
	{
	?>
	<div style="background-color:<?php echo $Color_Array[$Counter];?>; padding:5px ">
	<div dir="rtl"><?php echo  $rows->Name;?>
	<span style="position:relative; right:10px; bottom:-5px"><img style="cursor:pointer " src="<?php echo __SCRIPT_PATH;?>images/edit.png" width="20" height="20" class="Show_Edit_Form" id="<?php echo $rows->ID;?>"></span>
	<span style="position:relative; right:20px; bottom:-5px"><img style="cursor:pointer " src="<?php echo __SCRIPT_PATH;?>images/del.png" width="20" height="20" class="Del_Btn" id="<?php echo $rows->ID;?>"></span>
	<span style="position:relative; right:30px; bottom:-5px"><img style="cursor:pointer " src="<?php echo __SCRIPT_PATH;?>images/add.png" width="20" height="20" id="<?php echo $rows->ID;?>" class="Add_City"></span>
	</div>
	
	<div style="line-height:15px ">&nbsp;</div>
	
	<div class="Edit_Ads_Cat" id="Edit_Ads_Cat_<?php echo $rows->ID;?>" style="display:none; position:relative; right:28px" dir="rtl"><input id="Name_<?php echo $rows->ID;?>" type="text" name="Name_<?php echo $rows->ID;?>" dir="<?php echo $Dir;?>" size="30" />
 	<input id="<?php echo $rows->ID;?>" type="button" name="Sub_Menu_Btn" value="إرسـال" class="Submit_Main_BTN_Edit">
	<div style="line-height:15px ">&nbsp;</div>
	</div>
	
	<div class="Add_New_City" id="Add_New_City_<?php echo $rows->ID;?>" style="display:none; position:relative; right:28px" dir="rtl"><span>إسـم الـمـديـنــة</span>&nbsp;<span><input id="City_Name_<?php echo $rows->ID;?>" type="text" name="City_Name_<?php echo $rows->ID;?>" dir="<?php echo $Dir;?>" size="30" /></span>
 	&nbsp;<span><input id="<?php echo $rows->ID;?>" type="button" name="Sub_Menu_Btn" value="إرسـال" class="Submit_New_City"></span>
	<div style="line-height:15px ">&nbsp;</div>
	</div>
	<div style="margin-right:30px ">
	<?php
	$sql = 'SELECT ID,City_Name FROM '.$Table_City.' WHERE CID = ? AND Status = ?';
	$Execute_Array = array($rows->ID,'1');
	$results_city = $Display->Display_Info($sql,$Execute_Array);
	if(count($results_city))
		{
		?>
		<div>هـذا الـبـلــد يـحـتـوي عـلـى الـمـدن الـتـالـيــة</div>
		<?php
			foreach($results_city as $rows_city)
				{
				?>
				<div style="margin-right:20px ">
					<div dir="rtl">
					<?php echo $rows_city->City_Name;?>
					<span style="position:relative; right:10px; bottom:-5px"><img style="cursor:pointer " src="<?php echo __SCRIPT_PATH;?>images/edit.png" width="20" height="20" class="Show_Edit_City" id="<?php echo $rows_city->ID;?>"></span>
					<span style="position:relative; right:20px; bottom:-5px"><img style="cursor:pointer " src="<?php echo __SCRIPT_PATH;?>images/del.png" width="20" height="20" class="Del_Btn_City" id="<?php echo $rows_city->ID;?>"></span>
					</div>
					
					<div style="line-height:15px ">&nbsp;</div>
	
					<div class="Edit_Selected_City" id="Edit_Selected_City_<?php echo $rows_city->ID;?>" style="display:none; position:relative; right:28px" dir="rtl"><span>إسـم الـمـديـنــة</span>&nbsp;<span><input id="City_Name_Edit_<?php echo $rows_city->ID;?>" type="text" name="City_Name_Edit_<?php echo $rows_city->ID;?>" dir="<?php echo $Dir;?>" size="30" /></span>&nbsp;
					<span><input id="<?php echo $rows_city->ID;?>" type="button" name="Sub_Menu_Btn" value="إرسـال" class="Submit_City_Edit"></span>
					<div style="line-height:15px ">&nbsp;</div>
					</div>
	
				</div>
				<?php
				}
		}
	?>
	</div>
	<div style="line-height:15px ">&nbsp;</div>
	</div>
	
	<?php
	$Counter++;
	if($Counter > 1)
		{
			$Counter = 0;
		}
	}
?>
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
		<div dir="rtl" style="border-top:1px solid #CCCCCC">
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
}	
?>
</div>
</div>