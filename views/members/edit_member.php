<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<div id="Container">
<table style="width: 100%" cellspacing="0" cellpadding="0">
<tr>
<td valign="top" style="width: 658px">
<div id="header"><img alt="" src="<?php echo __SCRIPT_PATH;?>images/header1.jpg" width="571" height="251" /></div>

<div id="services-waffer">
	<table cellspacing="0" cellpadding="0">
		<tr>
			<td style="padding-right:3px;"><a onmouseover="document.services4.src='<?php echo __SCRIPT_PATH;?>images/services4-on.png'" onmouseout="services4.src='<?php echo __SCRIPT_PATH;?>images/services4-off.png'" href="#z">
			<img name="services4" border="0" src="<?php echo __SCRIPT_PATH;?>images/services4-off.png" width="106" height="90"/></a></td>
			<td style="padding-right:3px;"><a onmouseover="document.services3.src='<?php echo __SCRIPT_PATH;?>images/services3-on.png'" onmouseout="services3.src='<?php echo __SCRIPT_PATH;?>images/services3-off.png'" href="#z">
			<img name="services3" border="0" src="<?php echo __SCRIPT_PATH;?>images/services3-off.png" width="106" height="90"/></a></td>
			<td style="padding-right:3px;"><a onmouseover="document.services2.src='<?php echo __SCRIPT_PATH;?>images/services2-on.png'" onmouseout="services2.src='<?php echo __SCRIPT_PATH;?>images/services2-off.png'" href="#z">
			<img name="services2" border="0" src="<?php echo __SCRIPT_PATH;?>images/services2-off.png" width="106" height="90"/></a></td>
			<td><a onmouseover="document.services1.src='<?php echo __SCRIPT_PATH;?>images/services1-on.png'" onmouseout="services1.src='<?php echo __SCRIPT_PATH;?>images/services1-off.png'" href="sub1.htm">
			<img name="services1" border="0" src="<?php echo __SCRIPT_PATH;?>images/services1-off.png" width="106" height="90"/></a></td>
		</tr>
	</table>
</div>

<div id="test-all">
<div id="text-titles">
<table style="width: 100%" cellspacing="0" cellpadding="0">
<tr><td align="center" valign="middle">
				<img alt="" src="<?php echo __SCRIPT_PATH;?>images/how-work-tit.png" width="108" height="30" /></td></tr></table>
</div>
<div id="text-middle">
		
<div>&nbsp;</div>
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
		$('.Paginate').click(function(){
			var Page = $(this).attr('id'); 
			$.post('<?php echo __LINK_PATH;?>members/edit_member/AJAX/Y/',{Page:Page},function(data){
				$('#Container').html(data);
				$('#Product_Container').hide().delay(300).fadeIn();
				});
			});	
			
		$('.MyLevel').change(function(){
			var Level = $(this).val(); 
			$.post('<?php echo __LINK_PATH;?>members/edit_member_level/AJAX/Y/',{Level:Level},function(data){
				$('#Container').html(data);
				});
		});
		
		jQuery.leave = function(){
			$.post('<?php echo __LINK_PATH;?>members/edit_member/AJAX/Y/',function(data){
					$('#Container').html(data);
				})
			};	
		jQuery.editData = function(title,url,width,height){
			$.window({
			   title: title,
			   width: width,           // window width
			   height: height, 
			   url: url,         // window height
			  
			   onClose: function(wnd) { // a callback function while user click close button
				$.leave();// alert('close');
			   },
			   afterDrag: function(wnd) { // a callback function after window dragged
				  $.leave();
			   }
		});
		};
		$('.Del_Btn_Main').click(function(){
			var ID = $(this).attr('id'); 
			if (confirm("هــل تـريـد الإسـتـمـرار فـي عـمـلــيـة الـمـسسـح؟")) {
			$.post('<?php echo __LINK_PATH;?>members/delete_selected_member/AJAX/Y/',{ID:ID},function(data){
				$('#Container').html(data);
				});
			}
			});	
			
	});
</script>
<style>
.Add_Main_Menu
{
padding:5px;
color:#FF9900;
font-family:'Times New Roman', Times, serif; 
font-size:16px;
font-weight:bold;
background-color:#CCDAE3;
}
.Sub_Menu_Font
{
padding:5px;
color:#FF9900;
font-family:'Times New Roman', Times, serif; 
font-size:16px;
font-weight:bold;
}

.Submit_Main_BTN_Add{
width:80px;
height:25px;
background-color:#000066;
color:#FFFFFF;
cursor:pointer;
}
.Submit_Product_Edit{
width:80px;
height:25px;
background-color:#000066;
color:#FFFFFF;
cursor:pointer;
}
.Submit_Cat{
width:80px;
height:25px;
background-color:#000066;
color:#FFFFFF;
cursor:pointer;
}
.Paginate{
margin-right:5px;
cursor:pointer;
color:#0099FF;
}
.JSErrors{
font-family:"Times New Roman", Times, serif;
font-size:16px;
color:#FF0000;
}
.check_mark_main{
position:relative;
top:1px;
cursor:pointer;
}
.block_mark_main{
position:relative;
top:-3px;
cursor:pointer;
}
.Add_Product_Font{
padding:5px;
color:#FF9900;
font-family:'Times New Roman', Times, serif; 
font-size:16px;
font-weight:bold;
}
.style1 {
				border: 1px solid #c0c0c0;
}
.style4 {
				background-color: #636F93;
				text-align: center;
}
.style5 {
				background-color: #D3D3D3;
				text-align: center;
}
</style>
<div id="Product_Container">
<table style="width: 100%" class="style1" cellspacing="1" dir="ltr">
			<tr>
									<td width="88"  class="style5" style="height: 25px">
									مـسـح</td>
									<td width="88"  class="style5" style="height: 35px">
									تـعـديـل</td>
									<td width="157"  class="style5" style="height: 35px">
									الـتـصـنـيـف الإداري</td>
									<td width="157"  class="style5" style="height: 35px">
									كـلـمـة الـسـر</td>
									<td width="310"  class="style5" style="height: 35px">
									الإســم</td>
					</tr>
					<?php
$Display = new sql();
$sql = 'SELECT Level FROM user_level WHERE ID = ?';
$Counter = 0;
foreach($results as $rows)
	{
	$ID = $rows->ID;
	$Level_ID = $rows->Level;
	$Execute_Array = array($Level_ID);
	$Full_Name = $rows->First_Name.' '.$rows->Last_Name;
	if($Counter == 1)
		{
			$Style = 'style5';
		}
	else
		{
			$Style = 'style4';
		}
	?>
	<tr>
		<td class="<?php echo $Style;?>" style="height: 25px; width: 15px;">
		
		<?php
		if($_SESSION['User_level_Session'] == '1')
			{
			?>
			<img class="Del_Btn_Main" id="<?php echo $ID;?>" style="cursor:pointer " src="<?php echo __SCRIPT_PATH;?>images/del.png" width="25" height="25">
			<?php
			}
		else
			{
				echo '----';
			}
		?>
		</td>
		<td class="<?php echo $Style;?>" style="height: 25px; width: 15px;">
		
		<?php
		if($Level_ID == '2')
			{
			?>
			<img style="cursor:pointer " src="<?php echo __SCRIPT_PATH;?>images/edit.png" width="25" height="25" onClick="$.editData('تـعـديـل مـعـلـومـات الإداري','<?php echo __LINK_PATH;?>members/edit_selected/Member/<?php echo $ID;?>/Level/<?php echo $Level_ID;?>/AJAX/Y/',950,650)" />
			<?php
			}
		elseif(($Level_ID == '3')||($Level_ID == '4'))
			{
			?>
			<img style="cursor:pointer " src="<?php echo __SCRIPT_PATH;?>images/edit.png" width="25" height="25" onClick="$.editData('تـعـديـل مـعـلـومـات الإداري','<?php echo __LINK_PATH;?>members/edit_selected/Member/<?php echo $ID;?>/Level/<?php echo $Level_ID;?>/AJAX/Y/',950,300)" />
			<?php
			}
		else
			{
			?>
			<img style="cursor:pointer " src="<?php echo __SCRIPT_PATH;?>images/edit.png" width="25" height="25" onClick="$.editData('تـعـديـل مـعـلـومـات الإداري','<?php echo __LINK_PATH;?>members/edit_selected/Member/<?php echo $ID;?>/Level/<?php echo $Level_ID;?>/AJAX/Y/',950,300)" />
			<?php
			}
		?>
		
		</td>
		<td class="<?php echo $Style;?>">
		<select class="MyLevel" dir="<?php echo $Dir;?>">
		<?php
		foreach($results_level as $rows_level)
			{
				if($rows->Level == $rows_level->ID)
					{
					?>
					<option value="<?php echo $rows_level->ID.'|||'.$ID;?>" selected ><?php echo $rows_level->Level;?></option>
					<?php
					}
				else
					{
					?>
					<option value="<?php echo $rows_level->ID.'|||'.$ID;?>" ><?php echo $rows_level->Level;?></option>
					<?php
					}
			}
		?>
		</select>
		
		</td>
		<td class="<?php echo $Style;?>" style="height: 25px; width: 15px;"><img style="cursor:pointer " src="<?php echo __SCRIPT_PATH;?>images/pw.png" onClick="$.editData('تـعـديـل كـلـمـة الـسـر','<?php echo __LINK_PATH;?>members/edit_pw/Member/<?php echo $ID;?>/AJAX/Y/',950,200)" /></td>
		
		<td class="<?php echo $Style;?>" style="height: 25px; width: 15px;"><?php echo $Full_Name;?></td>
	</tr>
	<?php
	$Counter++;
	if($Counter > 1)
		{
			$Counter = 0;
		}
	}
?>
</table>
</div>
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
<div class="text-bottom">
	<img alt="" src="<?php echo __SCRIPT_PATH;?>images/text-bottom.png" width="614" height="9" /></div>
</div>

</td>
<td valign="top" style="width: 288px">
<div id="download-bg">
<div class="download-icons">
<a onmouseover="document.iphone.src='<?php echo __SCRIPT_PATH;?>images/iphone-on.png'" onmouseout="document.iphone.src='<?php echo __SCRIPT_PATH;?>images/iphone-off.png'" href="#z">
<img name="iphone" border="0" src="<?php echo __SCRIPT_PATH;?>images/iphone-off.png" width="107" height="31"/></a>
</div>
<div class="download-icons">
<a onmouseover="document.android.src='<?php echo __SCRIPT_PATH;?>images/android-on.png'" onmouseout="document.android.src='<?php echo __SCRIPT_PATH;?>images/android-off.png'" href="#z">
<img name="android" border="0" src="<?php echo __SCRIPT_PATH;?>images/android-off.png" width="107" height="31"/></a>
</div>
<div class="download-icons">
<a onmouseover="document.ovi.src='<?php echo __SCRIPT_PATH;?>images/ovi-on.png'" onmouseout="document.ovi.src='<?php echo __SCRIPT_PATH;?>images/ovi-off.png'" href="#z">
<img name="ovi" border="0" src="<?php echo __SCRIPT_PATH;?>images/ovi-off.png" width="106" height="31"/></a>
</div>
<div class="download-icons">
<a onmouseover="document.blackberry.src='<?php echo __SCRIPT_PATH;?>images/blackberry-on.png'" onmouseout="document.blackberry.src='<?php echo __SCRIPT_PATH;?>images/blackberry-off.png'" href="#z">
<img name="blackberry" border="0" src="<?php echo __SCRIPT_PATH;?>images/blackberry-off.png" width="107" height="31"/></a>
</div>
</div>

<div id="right-menu">
<div id="menu-title">
	<img alt="" src="<?php echo __SCRIPT_PATH;?>images/inner-menu.png" width="159" height="36" /></div>
<div id="menu-middle">
<?php
$myfunctions = new myfunctions();
$myfunctions->check_credentials('1');
?>

</div>
<div class="menu-bottom"><img alt="" src="<?php echo __SCRIPT_PATH;?>images/right-menu-bottom.png" width="297" height="9" /></div>

</div>
</td>
</tr>
</table>

