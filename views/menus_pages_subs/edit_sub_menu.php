<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<div id="Container">
<div align="right" style="width:900px; line-height:25px; font-size:15px; font-weight:bold ">
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
?>
<style>
.Submit_Edit_Main{
width:80px;
height:25px;
background-color:#000066;
color:#FFFFFF;
cursor:pointer;
}
.Submit_Edit_Sub_Add{
width:80px;
height:25px;
background-color:#000066;
color:#FFFFFF;
cursor:pointer;
}
.Submit_Edit_Sub_Sub{
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
.Submit_Main_BTN_Add{
width:80px;
height:25px;
background-color:#000066;
color:#FFFFFF;
cursor:pointer;
}
.Submit_Sub_Sub{
width:80px;
height:25px;
background-color:#000066;
color:#FFFFFF;
cursor:pointer;
}
.Submit_Edit_Sub{
width:80px;
height:25px;
background-color:#000066;
color:#FFFFFF;
cursor:pointer;
}
.Submit_Sub{
width:80px;
height:25px;
background-color:#000066;
color:#FFFFFF;
cursor:pointer;
}
.JSErrors{
font-family:"Times New Roman", Times, serif;
font-size:16px;
color:#FF0000;
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
<div align="right" style="width:900px; line-height:25px; font-size:15px; font-weight:bold ">
<div>&nbsp;</div>
<script type="text/javascript"> 
	$(document).ready(function() { 
	
		jQuery.cleanUp = function() { 
			var classList = new Array('.Sub_Sub_Menu_Field','.Sub_Menu_Field','.Add_Sub_Menu_Field_Class','#Add_Main_Menu','.Main_Menu_Field_Class','.Sub_Sub_Menu_Field_Class','.Sub_Menu_Field_Class');
			jQuery.each(classList , function(index, value){
				$(value).slideUp('slow');
			});
		}
		
		$(function() {
		$('.Sub_Menu_Arrange').sortable({ opacity: 0.6, cursor: 'move', update: function() {
			var order = $(this).sortable('serialize'); 
			
			$.post('<?php echo __LINK_PATH;?>menus_pages_subs/change_menu_order/AJAX/Y/', order, function(theResponse){
			$('#Container').html(theResponse);
			}); 															 
		}								  
		});
		});
		
		$(function() {
		$('.Sub_Sub_Menu_Arrange').sortable({ opacity: 0.6, cursor: 'move', update: function() {
			var Order = $(this).sortable('serialize');
			
			$.post('<?php echo __LINK_PATH;?>menus_pages_subs/change_sub_sub_menu_order/AJAX/Y/', Order, function(theResponse){
			$('#Container').html(theResponse);
			}); 															 
		}								  
		});
		});
		
		$(function() {
		$('.Main_Menu').sortable({ opacity: 0.6, cursor: 'move', update: function() {
			var Order = $(this).sortable('serialize');
			
			$.post('<?php echo __LINK_PATH;?>menus_pages_subs/change_main_menu_order/AJAX/Y/', Order, function(theResponse){
			$('#Container').html(theResponse);
			}); 															 
		}								  
		});
		});
			
		$('.Add_Main_Menu_Img').click(function(){
			$.cleanUp();
			$('#Add_Main_Menu').slideDown();
			});	
		
		$('.Sub_Menu').click(function(){
			var ID = $(this).attr('id');
			var Field = '#Sub_Menu_Field_'+ID;
			$.cleanUp();
			$(Field).fadeIn('slow');
			});	
		
		$('.Sub_Sub_Menu').click(function(){
			var ID = $(this).attr('id');
			var Field = '#Sub_Sub_Menu_Field_'+ID;
			$.cleanUp();
			$(Field).fadeIn('slow');
			});
			
		$('.Main_Menu_Class').click(function(){
			var ID = $(this).attr('id');
			$.cleanUp();
			var Main_Menu_Field = '#Main_Menu_Field_'+ID;
			$(Main_Menu_Field).fadeIn('slow').css({'right' : '505px'});
			});
		
		$('.Sub_Menu_Title').click(function(){
			var ID = $(this).attr('id');
			$.cleanUp();
			var Main_Menu_Field = '#Add_Sub_Menu_Field_'+ID;
			$(Main_Menu_Field).fadeIn('slow');
			
			});
			
		$('.Sub_Sub_Menu_Class').click(function(){
			var ID = $(this).attr('id');
			$.cleanUp();
			var Main_Menu_Field = '#Sub_Sub_Menu_Field_'+ID;
			$(Main_Menu_Field).fadeIn('slow').css({'right' : '260px'});
			});
			  
		$('.Sub_Menu_Class').click(function(){
			var ID = $(this).attr('id');
			$.cleanUp();
			var Main_Menu_Field = '#Sub_Menu_Field_'+ID;
			$(Main_Menu_Field).fadeIn('slow').css({'right' : '362px'});
			});
			
		$('.delete_sub').click(function(){
			if (confirm("هــل تـريـد الإسـتـمـرار فـي عـمـلــيـة الـمـسسـح؟")) {
			var ID = $(this).attr('id');
			$.post('<?php echo __LINK_PATH;?>menus_pages_subs/delete_selected_sub/AJAX/Y/',{ID:ID},function(data){
				alert('تـم مـسـح الـقـائـمــة الـفـرعـيــة');
				$('#Container').html(data);
				});
			}
			}); 
			
		$('.delete_sub_sub').click(function(){
			if (confirm("هــل تـريـد الإسـتـمـرار فـي عـمـلــيـة الـمـسسـح؟")) {
			var ID = $(this).attr('id');
			$.post('<?php echo __LINK_PATH;?>menus_pages_subs/delete_selected_sub_sub/AJAX/Y/',{ID:ID},function(data){
				alert('تـم مـسـح الـقـائـمــة الـفـرعـيــة');
				$('#Container').html(data);
				});
			}
			});
			
		$('.block_mark').click(function(){
			var ID = $(this).attr('id');
			$.post('<?php echo __LINK_PATH;?>menus_pages_subs/publish_selected_sub/AJAX/Y/',{ID:ID},function(data){
				alert('تـم نـشــرالـقـائـمــة الـفـرعـيــة');
				$('#Container').html(data);
				});
			});	
		
		$('.block_mark_sub_sub').click(function(){
			var ID = $(this).attr('id');
			$.post('<?php echo __LINK_PATH;?>menus_pages_subs/publish_selected_sub_sub/AJAX/Y/',{ID:ID},function(data){
				alert('تـم نـشــرالـقـائـمــة الـفـرعـيــة');
				$('#Container').html(data);
				});
			});	
			
		$('.check_mark').click(function(){
			var ID = $(this).attr('id');
			
			$.post('<?php echo __LINK_PATH;?>menus_pages_subs/block_selected_sub/AJAX/Y/',{ID:ID},function(data){
				alert('تـم حـجـب الـقـائـمــة الـفـرعـيــة');
				$('#Container').html(data);
				});
			
			});	
			
		$('.check_mark_sub_sub').click(function(){
			var ID = $(this).attr('id');
			
			$.post('<?php echo __LINK_PATH;?>menus_pages_subs/block_selected_sub_sub/AJAX/Y/',{ID:ID},function(data){
				alert('تـم حـجـب الـقـائـمــة الـفـرعـيــة');
				$('#Container').html(data);
				});
			
			});	
			
		$('.Submit_Edit_Sub_Sub').click(function(){
			var ID = $(this).attr('id');
			var Menu_Name_ID = '#Sub_Sub_Name_'+ID;
			var Menu_Name = $(Menu_Name_ID).val();
			$('.JSErrors').remove();
			if(Menu_Name == '')
				{
					alert('عـلـيـك إدراج إسـم الـقـائـمــة الـفـرعـيــة');
				}
			else
				{
					$.post('<?php echo __LINK_PATH;?>menus_pages_subs/submit_edit_sub_sub_menu/AJAX/Y/',{ID:ID,Menu_Name:Menu_Name},function(data){
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
										$('#Container').html(data);
										
									}
								
								});
							}
						});
				}
			});
			
		$('.Submit_Edit_Sub').click(function(){
			var ID = $(this).attr('id');
			var Menu_Name_ID = '#Sub_Name_'+ID;
			var Menu_Name = $(Menu_Name_ID).val();
			$('.JSErrors').remove();
			if(Menu_Name == '')
				{
					alert('عـلـيـك إدراج إسـم الـقـائـمــة الـفـرعـيــة');
				}
			else
				{
					$.post('<?php echo __LINK_PATH;?>menus_pages_subs/submit_edit_sub_menu/AJAX/Y/',{ID:ID,Menu_Name:Menu_Name},function(data){
							setTimeout('$.fn.myFunction()',100);
						   $.fn.myFunction = function() { 
								$.getJSON('<?php echo __SCRIPT_PATH;?>json/Sub_Menu_Exists.json',function(json){
								var Flag = json.flag;
								if(Flag == '1')
									{
										alert('الإسـم الـذي إخـتـرتـه مـوجــود');
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
			
		$('.Submit_Edit_Main').click(function(){
			var ID = $(this).attr('id');
			var Menu_Name_ID = '#Menu_Name_'+ID;
			var Menu_Name = $(Menu_Name_ID).val();
			$('.JSErrors').remove();
			if(Menu_Name == '')
				{
					alert('عـلـيـك إدراج إسـم الـقـائـمــة الـفـرعـيــة');
				}
			else
				{
					$.post('<?php echo __LINK_PATH;?>menus_pages_subs/edit_main_menu_name/AJAX/Y/',{ID:ID,Menu_Name:Menu_Name},function(data){
							setTimeout('$.fn.myFunction()',100);
						   $.fn.myFunction = function() { 
								$.getJSON('<?php echo __SCRIPT_PATH;?>json/Menu_V2_Exists.json',function(json){
								var Flag = json.flag;
								if(Flag == '1')
									{
										$('<span class="JSErrors">الإسـم الـذي إخـتـرتـه مـوجــود</span>').appendTo('.main_menu_msg');
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
			
		$('.Submit_Sub_Sub').click(function(){
			var ID = $(this).attr('id');
			var Sub_ID = '#Sub_Sub_Name_'+ID;
			var Sub_Menu = $(Sub_ID).val();
			$('.JSErrors').remove();
			if(Sub_Menu == '')
				{
					alert('عـلـيـك إدراج إسـم الـقـائـمــة الـفـرعـيــة');
				}
			else
				{
					$.post('<?php echo __LINK_PATH;?>menus_pages_subs/add_new_sub_sub_menu/AJAX/Y/',{ID:ID,Sub_Menu:Sub_Menu},function(data){
							setTimeout('$.fn.myFunction()',100);
						   $.fn.myFunction = function() { 
								$.getJSON('<?php echo __SCRIPT_PATH;?>json/Sub_Sub_Exists.json',function(json){
								var Flag = json.flag;
								if(Flag == '1')
									{
										$('<span class="JSErrors">الإسـم الـذي إخـتـرتـه مـوجــود</span>').appendTo('.sub_sub_menu_msg');
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
			
		$('.Submit_Sub').click(function(){
			var ID = $(this).attr('id');
			var Sub_ID = '#Sub_Name_'+ID;
			var Sub_Menu = $(Sub_ID).val();
			$('.JSErrors').remove();
			if(Sub_Menu == '')
				{
					alert('عـلـيـك إدراج إسـم الـقـائـمــة الـفـرعـيــة');
				}
			else
				{
					$.post('<?php echo __LINK_PATH;?>menus_pages_subs/add_new_sub_menu/AJAX/Y/',{ID:ID,Sub_Menu:Sub_Menu},function(data){
							setTimeout('$.fn.myFunction()',100);
						   $.fn.myFunction = function() { 
								$.getJSON('<?php echo __SCRIPT_PATH;?>json/Sub_Exists.json',function(json){
								var Flag = json.flag;
								if(Flag == '1')
									{
										$('<span class="JSErrors">الإسـم الـذي إخـتـرتـه مـوجــود</span>').appendTo('.sub_menu_msg');
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
		
		$('.check_mark_pages').click(function(){
			var ID = $(this).attr('id');
			
			$.post('<?php echo __LINK_PATH;?>menus_pages_subs/block_selected_page/AJAX/Y/',{ID:ID},function(data){
				alert('تـم حـجـب الـصـفـحــة');
				$('#Container').html(data);
				});
			
			});	
		
		$('.block_mark_pages').click(function(){
			var ID = $(this).attr('id');
			$.post('<?php echo __LINK_PATH;?>menus_pages_subs/publish_selected_page/AJAX/Y/',{ID:ID},function(data){
				alert('تـم نـشـرالـصـفـحــة');
				$('#Container').html(data);
				});
			});
			
		$('.Del_Btn').click(function(){
			if (confirm("هــل تـريـد الإسـتـمـرار فـي عـمـلــيـة الـمـسسـح؟")) {
			var ID = $(this).attr('id');
			var div = 'page_div_'+ID;
			var Sub = 'sub_'+ID;
			$.post('<?php echo __LINK_PATH;?>menus_pages_subs/delete_selected_page/AJAX/Y/',{ID:ID},function(data){
					$('#'+div).remove();
					$('#Container').html(data);
				});
			}
			});	
			
		$('.Del_Btn_Main').click(function(){
			if (confirm("هــل تـريـد الإسـتـمـرار فـي عـمـلــيـة الـمـسسـح؟")) {
			var ID = $(this).attr('id');
			$.post('<?php echo __LINK_PATH;?>menus_pages_subs/delete_selected_main_menu_item/AJAX/Y/',{ID:ID},function(data){
					alert('تـم مـسـح الـقـائـمـة بـنـجـاح');
					$('#Container').html(data);
				});
			}
			});  
			
		$('.check_mark_main').click(function(){
			var ID = $(this).attr('id');
			
			$.post('<?php echo __LINK_PATH;?>menus_pages_subs/block_selected_menu/AJAX/Y/',{ID:ID},function(data){
				alert('تـم حـجـب الـقـائـمــة');
				$('#Container').html(data);
				});
			
			});	
			
		$('.block_mark_main').click(function(){
			var ID = $(this).attr('id');
			$.post('<?php echo __LINK_PATH;?>menus_pages_subs/publish_selected_main/AJAX/Y/',{ID:ID},function(data){
				alert('تـم نـشـرالـقـائـمــة');
				$('#Container').html(data);
				});
			});		
		
		$('.Submit_BTN_Add').click(function(){
			
			var ID = $(this).attr('id');
			var Sub_Menu = $('#Sub_Name_'+ID).val();
			$('.JSErrors').remove();
			if(Sub_Menu == '')
				{
					alert('عـلـيـك إدراج إسـم الـقـائـمـة الـفـرعـيــة');
				}
			else
				{
					$.post('<?php echo __LINK_PATH;?>menus_pages_subs/add_new_sub_menu/AJAX/Y/',{ID:ID,Sub_Menu:Sub_Menu},function(data){
						setTimeout('$.fn.myFunction()',100);
						   $.fn.myFunction = function() { 
								$.getJSON('<?php echo __SCRIPT_PATH;?>json/Sub_Exists.json',function(json){
								var Flag = json.flag;
								if(Flag == '1')
									{
										alert('الإسـم الـذي إخـتـرتـه مـوجــود');
									}
								else
									{
										
										alert('تـمـت إضـافـة الـقـائـمـة الـفـرعـيـة بـنـجــاح');
										$('#Container').html(data);
										
									}
								
								});
							}
					});
				}
			});	
			
		$('.Submit_Main_BTN_Add').click(function(){
			var ID = $('#Menu_Name_New').val();
			$('.JSErrors').remove();
			if(ID == '')
				{
					alert('عـلـيـك إدراج إسـم الـقـائـمــة');
				}
			else
				{
					$.post('<?php echo __LINK_PATH;?>menus_pages_subs/add_main_menu_name/AJAX/Y/',{ID:ID},function(data){
							setTimeout('$.fn.myFunction()',100);
						   $.fn.myFunction = function() { 
								$.getJSON('<?php echo __SCRIPT_PATH;?>json/Menu_V2_Exists.json',function(json){
								var Flag = json.flag;
								if(Flag == '1')
									{
										$('<span class="JSErrors">الإسـم الـذي إخـتـرتـه مـوجــود</span>').appendTo('.main_menu_msg');
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
<div dir="rtl" class="Add_Main_Menu"><img style="cursor:pointer" src="<?php echo __SCRIPT_PATH;?>images/add.png" class="Add_Main_Menu_Img"/>&nbsp;<span>أضــف قـائـمـة جـديــدة</span>
 <div id="Add_Main_Menu" style="display:none; position:relative; right:28px"><input name="Menu_Name_New" type="text" id="Menu_Name_New" dir="<?php echo $Dir;?>" size="30" />
 <input type="button" name="Sub_Menu_Btn" value="إرسـال" class="Submit_Main_BTN_Add">&nbsp;<span class="main_menu_msg"></span></div>
</div>
<div style="line-height:12px">&nbsp;</div>
<div class="Main_Menu">
<?php
$Color_Array = array('#CCDAE3','#F5F5F5');
$Counter = 0;
if((is_array($results))&&(count($results)))
	{
		$menusfunction = new menusfunction();
		foreach($results as $rows)
			{
			?>
			<div id="Order_Main_<?php echo $rows->ID;?>" style=" padding-right:10px; padding-top:8px; background-color:<?php echo $Color_Array[$Counter];?> ">
			<div dir="rtl"><span><img class="Sub_Menu_Title" id="<?php echo $rows->ID;?>"  style="cursor:pointer " src="<?php echo __SCRIPT_PATH;?>images/add.png" width="20" height="20" /></span>&nbsp;<span>أضـف قـائـمـة فـرعـيـة جـديدة</span></div>
			<div class="Add_Sub_Menu_Field_Class" id="Add_Sub_Menu_Field_<?php echo $rows->ID;?>" style="display:none ">
			<span><input id="Sub_Name_<?php echo $rows->ID;?>" name="Sub_Name_<?php echo $rows->ID;?>" type="text" size="30" dir="<?php echo $Dir;?>"></span>&nbsp;<span><input type="button" id="<?php echo $rows->ID;?>" name="Sub_Menu_Btn" value="إرسـال" class="Submit_BTN_Add"></span>
			
			</div>
			<!-- Sub menu display !-->
			<div style="position:relative; right:-70px ">
			<?php
			$menusfunction->draw_menu_diagram_modified($rows->ID);
			//$menusfunction->IsSub($rows->ID);
			
			?>
			</div>
			<!-- End of sub menu display !-->
			<div style="line-height:10px ">&nbsp;</div>
			</div>
			<?php
			$Counter++;
			if($Counter > 1)
				{
					$Counter = 0;
				}
			} // Endo of menu for loop
	}
?>
</div>
</div>
</div>