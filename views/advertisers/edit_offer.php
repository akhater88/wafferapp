<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
if((is_array($results)) && (count($results)))
{
?>
<div id="Container">
<div align="center" style="width:900px; font-size:15px; font-weight:bold ">
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
<div align="right" style="width:900px; line-height:25px; font-size:15px; font-weight:bold ">
<div>&nbsp;</div>
<script type="text/javascript"> 
		$(document).ready(function() { 
		$('.Paginate').click(function(){
			var Page = $(this).attr('id'); 
			$.post('<?php echo __LINK_PATH;?>advertisers/edit_offer/AJAX/Y/',{Page:Page},function(data){
				$('#Container').html(data);
				$('#Product_Container').hide().delay(300).fadeIn();
				});
			});	
			
		jQuery.leave = function(){
			$.post('<?php echo __LINK_PATH;?>advertisers/edit_offer/AJAX/Y/',function(data){
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
			$.post('<?php echo __LINK_PATH;?>advertisers/delete_selected_offer/AJAX/Y/',{ID:ID},function(data){
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
</style>
<div align="center">
<table style="width:400px "  border="0" cellpadding="2" cellspacing="0">
	<tr>
		<td width="29%"><div align="right">غـيـر مـفـعـل</div></td>
		<td width="10%"><div align="center"><img src="<?php echo __SCRIPT_PATH;?>images/Blocked.png"></div></td>
		<td width="19%"><div align="right">مـفـعــل</div></td>
		<td width="10%"><div align="center"><img src="<?php echo __SCRIPT_PATH;?>images/Published.png"></div></td>
		<td width="19%"><div align="right">مـنـتـهـي</div></td>
		<td width="10%"><div align="center"><img src="<?php echo __SCRIPT_PATH;?>images/Expired.png"></div></td>
	</tr>
</table>
</div>
<div>&nbsp;</div>
<div id="Product_Container">
<table width="100%"  border="1" cellpadding="2" cellspacing="0" bordercolor="#333333">
  <tr bgcolor="#ACCBE3">
  	<td width="10%"><div align="center">مـسـح</div></td>
    <td width="10%"><div align="center">تـعـديـل</div></td>
	 <td width="15%"><div align="center" style="font-size:16px ">تـاريخ الإنتـهـاء</div></td>
	  <td width="15%"><div align="center" style="font-size:16px ">تـاريـخ الـبـدء</div></td>
    <td width="50%"><div align="center" style="font-size:16px ">عـنـوان الـعـرض</div></td>
  </tr>

<?php
foreach($results as $rows)
	{
		$ID = $rows->ID;
		$Offer_Title = stripslashes($rows->Offer_Title);
		$Start_Date = date('d-m-Y',strtotime($rows->Start_Date));
		$End_Date = date('d-m-Y',strtotime($rows->End_Date));
		$Status = $rows->Status;
		if($Status == '3')
			{
				$BG_Color = '#FFCC00';
			}
		elseif($Status == '2')
			{
				$BG_Color = '#FFFFFF';
			}
		else
			{
				$BG_Color = '#00CC66';
			}
	?>
	<tr>
		<td>
		<div align="center">
		<img class="Del_Btn_Main" id="<?php echo $ID;?>" style="cursor:pointer " src="<?php echo __SCRIPT_PATH;?>images/del.gif" width="30" height="30">
		</div></td>
		<td>
		<div align="center">
		<img style="cursor:pointer " src="<?php echo __SCRIPT_PATH;?>images/edit.gif" width="30" height="30" onClick="$.editData('تـعـديـل الـعـرض','<?php echo __LINK_PATH;?>advertisers/edit_selected_offer/Member/<?php echo $ID;?>/AJAX/Y/',950,580)" />
		</div>
		</td>
		<td style="background-color:<?php echo $BG_Color;?> "><div align="center"><?php echo $End_Date;?></div></td>
		<td style="background-color:<?php echo $BG_Color;?> "><div align="center"><?php echo $Start_Date;?></div></td>
		<td><div align="center"><?php echo $Offer_Title;?></div></td>
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
</div>
<?php
}
?>