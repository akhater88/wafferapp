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
<script type="text/javascript" src="<?php echo __SCRIPT_PATH;?>js/MyScript.js"></script>
<div align="right" style="width:300px; line-height:25px; font-size:15px; font-weight:bold ">
<div>&nbsp;</div>
<script type="text/javascript"> 
	$(document).ready(function() { 
			
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
			
			
	});
</script>
<?php
if(count($results))
	{
	?>
	<div style="line-height:10px ">&nbsp;</div>
	<div align="left" style=" position:relative; left:-30px">هـذه الـقـائـمـة تـحـتـوي عـلـى الـصـفـحـات الـتـالـيــة</div>
	<?php
		foreach($results as $rows)
			{
			?>
			<div align="left" style=" position:relative; left:180px "><?php echo stripslashes($rows->Title);?>
			<div style="position:absolute; left:-30px; top:2px"><img style="cursor:pointer " src="<?php echo __SCRIPT_PATH;?>images/edit.gif" width="20" height="20" onclick="createWindowWithCallBack('تـعــديــل الـصـفـحــة','<?php echo __LINK_PATH;?>menus_pages_subs/edit_selected_page/AJAX/Pop_Up/Member/<?php echo $rows->ID;?>',850,500)" /></div>
			<div class="Del_Btn" id="<?php echo $rows->ID;?>" style="position:absolute; left:-60px; top:2px"><img style="cursor:pointer " src="<?php echo __SCRIPT_PATH;?>images/del.gif" width="20" height="20"></div>
			<?php
			if($rows->Status == '1')
				{
				?>
				<div class="check_mark_pages" id="<?php echo $rows->ID;?>" style="position:absolute; left:-90px; top:2px"><img src="<?php echo __SCRIPT_PATH;?>images/Check_Mark.gif" width="20" height="20"/></div>
				<?php
				}
			else
				{
				?>
				<div class="block_mark_pages" id="<?php echo $rows->ID;?>" style="position:absolute; left:-90px; top:2px"><img src="<?php echo __SCRIPT_PATH;?>images/closed.jpg" width="20" height="20"/></div>
				<?php
				}
				?>
				</div>
				<?php
			}
	}
?>
</div>