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
<script type="text/javascript" src="<?php echo __SCRIPT_PATH;?>js/jquery-ui.js"></script>
<link id="jquery_ui_theme_loader" type="text/css" href="<?php echo __SCRIPT_PATH;?>css/themes/base/jquery-ui.css" rel="stylesheet" />
<link type="text/css" href="<?php echo __SCRIPT_PATH;?>css/jquery.window.css" rel="stylesheet" />
<!--
<link type="text/css" href="http://www.softiletest.com/windows/css/jquery.codeview.css" rel="stylesheet" />
<link type="text/css" href="http://www.softiletest.com/windows/css/jquery.share.css" rel="stylesheet" />
!-->

<script type="text/javascript" src="<?php echo __SCRIPT_PATH;?>js/jquery.codeview.js"></script>
<script type="text/javascript" src="<?php echo __SCRIPT_PATH;?>js/jquery.share.js"></script>
<script type="text/javascript" src="<?php echo __SCRIPT_PATH;?>js/jquery.window.js"></script>
				
<script type="text/javascript" src="<?php echo __SCRIPT_PATH;?>js/common.js"></script>
<script type="text/javascript" src="<?php echo __SCRIPT_PATH;?>js/index.js"></script>	
<div>&nbsp;</div>
<script type="text/javascript"> 
	$(document).ready(function() { 
	
		jQuery.cleanUp = function() { 
			var classList = new Array('.Edit_Ads_Cat','#Add_Main_Menu');
			jQuery.each(classList , function(index, value){
				$(value).slideUp('slow');
			});
		}
		
		$('.Del_Btn').click(function(){
			if (confirm("هــل تـريـد الإسـتـمـرار فـي عـمـلــيـة الـمـسسـح؟")) {
			var ID = $(this).attr('id');
			$.post('<?php echo __LINK_PATH;?>ads/delete_selected_cat/AJAX/Y/',{ID:ID},function(data){
					$('#Container').html(data);
				});
			}
			});	
			
		$('.Paginate').click(function(){
			var Page = $(this).attr('id'); 
			$.post('<?php echo __LINK_PATH;?>ads/ads_cat/AJAX/Y/',{Page:Page},function(data){
				$('#Container').html(data);
				$('#Product_Container').hide().delay(300).fadeIn();
				});
			});	
			
		$('.Add_Main_Menu_Img').click(function(){
			$.cleanUp();
			$('#Add_Main_Menu').slideDown();
			});	
			
		$('.Show_Edit_Form').click(function(){
			$.cleanUp();
			var ID = $(this).attr('id'); 
			var Div = '#Edit_Ads_Cat_'+ID;
			$(Div).slideDown();
			});
			
		$('.Submit_Main_BTN_Edit').click(function(){
		
			var ID = $(this).attr('id'); 
			var Cat_Name_ID = '#Menu_Name_New_'+ID;
			var Cat_Name = $(Cat_Name_ID).val();
			if(Cat_Name == '')
				{
					alert('عـلـيـك إدراج إسـم الـقـائـمــة');
				}
			else
				{
					$.post('<?php echo __LINK_PATH;?>ads/submit_edit_cat/AJAX/Y/',{ID:ID,Cat_Name:Cat_Name,Time_Stamp:'<?php echo $Time_Stamp;?>'},function(data){
							setTimeout('$.fn.myFunction()',100);
						   $.fn.myFunction = function() { 
								$.getJSON('<?php echo __SCRIPT_PATH;?>json/<?php echo $Time_Stamp;?>.json',function(json){
								var Flag = json.flag;
								if(Flag == '1')
									{
										alert('عـلـيـك إضـافــة إســم المـصـنـف الـدعــائــي');
									}
								else if(Flag == '2')
									{
										alert('إســم الـمـصـنــف الـذي أدخـلـتـه مـوجــود');
									}
								else
									{
										
										alert('تـم الـتـعـديـل بـنـجـاح');
										$('#Container').html(data);
										
									}
								
								});
							}
						});
				}
			});	
			
		$('.Submit_Main_BTN_Add').click(function(){
			var Cat_Name = $('#Menu_Name_New').val();
			if(Cat_Name == '')
				{
					alert('عـلـيـك إدراج إسـم الـقـائـمــة');
				}
			else
				{
					$.post('<?php echo __LINK_PATH;?>ads/submit_add_cat/AJAX/Y/',{Cat_Name:Cat_Name,Time_Stamp:'<?php echo $Time_Stamp;?>'},function(data){
							setTimeout('$.fn.myFunction()',100);
						   $.fn.myFunction = function() { 
								$.getJSON('<?php echo __SCRIPT_PATH;?>json/<?php echo $Time_Stamp;?>.json',function(json){
								var Flag = json.flag;
								if(Flag == '1')
									{
										alert('عـلـيـك إضـافــة إســم المـصـنـف الـدعــائــي');
									}
								else if(Flag == '2')
									{
										alert('إســم الـمـصـنــف الـذي أدخـلـتـه مـوجــود');
									}
								else
									{
										
										alert('تـمـت الإضـافــة بـنـجــاح');
										$('#Container').html(data);
										
									}
								
								});
							}
						});
				}
			});	
			
	});
</script>
<div dir="rtl" class="Add_Main_Menu"><img style="cursor:pointer" src="<?php echo __SCRIPT_PATH;?>images/add.png" class="Add_Main_Menu_Img"/>&nbsp;<span>أضـف تـصـنـيـف دعـائـي جـديـد</span>
 <div id="Add_Main_Menu" style="display:none; position:relative; right:28px"><input name="Menu_Name_New" type="text" id="Menu_Name_New" dir="<?php echo $Dir;?>" size="30" />
 <input type="button" name="Sub_Menu_Btn" value="إرسـال" class="Submit_Main_BTN_Add"></div>
</div>
<div style="line-height:12px">&nbsp;</div>
<div id="Product_Container" style="margin-right:20px ">
<?php
if((is_array($results))&&(count($results)))
{
foreach($results as $rows)
	{
	?>
	<div>
	<div dir="rtl"><?php echo  $rows->Cat_Name;?>
	<span style="position:relative; right:10px; bottom:-5px"><img style="cursor:pointer " src="<?php echo __SCRIPT_PATH;?>images/edit.png" width="20" height="20" class="Show_Edit_Form" id="<?php echo $rows->ID;?>"></span>
	<span style="position:relative; right:20px; bottom:-5px"><img style="cursor:pointer " src="<?php echo __SCRIPT_PATH;?>images/del.png" width="20" height="20" class="Del_Btn" id="<?php echo $rows->ID;?>"></span>
	</div>
	<div style="line-height:15px ">&nbsp;</div>
	
	<div class="Edit_Ads_Cat" id="Edit_Ads_Cat_<?php echo $rows->ID;?>" style="display:none; position:relative; right:28px" dir="rtl"><input name="Menu_Name_New_<?php echo $rows->ID;?>" type="text" id="Menu_Name_New_<?php echo $rows->ID;?>" dir="<?php echo $Dir;?>" size="30" />
 	<input id="<?php echo $rows->ID;?>" type="button" name="Sub_Menu_Btn" value="إرسـال" class="Submit_Main_BTN_Edit">
	<div style="line-height:15px ">&nbsp;</div>
	</div>
	</div>
	
	<?php
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