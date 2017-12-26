<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<div id="Container">
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

<script type="text/javascript"> 
		$(document).ready(function() { 
		$('.Paginate').click(function(){
			var Page = $(this).attr('id'); 
			$.post('<?php echo __LINK_PATH;?>sales/edit_member/AJAX/Y/',{Page:Page},function(data){
				$('#Container').html(data);
				$('#Product_Container').hide().delay(300).fadeIn();
				});
			});	
		
		jQuery.leave = function(){
			var Page = '<?php echo $Page;?>';
			$.post('<?php echo __LINK_PATH;?>sales/edit_member/AJAX/Y/',{Page:Page},function(data){
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
</style>
<div id="Product_Container">
<table style=" width:100%; text-align:center; line-height:30px;" cellpadding="0" cellspacing="0" class="style1" dir="ltr">
  <tr>
    <td style="height: 40px;" class="table-orange">تـعـديـل</td>
	 <td style="height: 40px;" class="table-orange">الـتـصـنـيـف الإداري</td>
	  <td style="height: 40px;" class="table-orange">كـلـمـة الـسـر</td>
    <td style="height: 40px;" class="table-orange">الإســم</td>
  </tr>

<?php
$Display = new sql();
$sql = 'SELECT Level FROM user_level WHERE ID = ?';
foreach($results as $rows)
	{
	$ID = $rows->ID;
	$Level_ID = $rows->Level;
	$Execute_Array = array($Level_ID);
	$Full_Name = $rows->First_Name.' '.$rows->Last_Name;
	?>
	<tr>
		
		<td style="padding-top:4px;" class="table-orange2">
		
		<img style="cursor:pointer " src="<?php echo __SCRIPT_PATH;?>images/edit.gif" width="30" height="30" onClick="$.editData('تـعـديـل مـعـلـومـات الإداري','<?php echo __LINK_PATH;?>sales/edit_selected/Member/<?php echo $ID;?>/Level/<?php echo $Level_ID;?>/AJAX/Y/',950,650)" />
		
		</td>
		<td style="padding-top:4px;" class="table-orange2">
		
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
		<td style="padding-top:4px;" class="table-orange2"><img style="cursor:pointer " src="<?php echo __SCRIPT_PATH;?>images/pw.png" onClick="$.editData('تـعـديـل كـلـمـة الـسـر','<?php echo __LINK_PATH;?>sales/edit_pw/Member/<?php echo $ID;?>/AJAX/Y/',950,200)" /></td>
		<td style="padding-top:4px;" class="table-orange2"><?php echo $Full_Name;?></td>
	</tr>
	<?php
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