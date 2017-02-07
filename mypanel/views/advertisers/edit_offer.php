<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
if((is_array($results)) && (count($results)))
{
?>
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
<div class="content-edit-offers">
<div id="content-edit">
	<table cellpadding="0" cellspacing="0" class="style1">
		<tr>
			<td style="padding-left:35px;"><img alt="" src="<?php echo __SCRIPT_PATH;?>images/finished-icon.jpg" width="114" height="53" /></td>
			<td style="padding-left:35px;"><img alt="" src="<?php echo __SCRIPT_PATH;?>images/active-icon.jpg" width="114" height="53" /></td>
			<td style="padding-left:35px;"><img alt="" src="<?php echo __SCRIPT_PATH;?>images/back-icon.jpg" width="114" height="53" /></td>
			<td style="padding-left:35px;"><img alt="" src="<?php echo __SCRIPT_PATH;?>images/draft-icon.jpg" width="114" height="53" /></td>
			<td><img alt="" src="<?php echo __SCRIPT_PATH;?>images/non-icon.jpg" width="114" height="53" /></td>
		</tr>
	</table>
</div>
<div id="Product_Container">
<table style=" width:100%; text-align:center; line-height:30px;" cellpadding="0" cellspacing="0" class="style1">
	<tr>
		<td style="height: 40px; padding-right:10px;" class="table-orange" align="right">عنـ<span lang="ar-jo">ــــــــ</span>وان العرض </td>
		<td style="height: 40px; width: 150px;" class="table-orange">تـاريــخ الـبـدء</td>
		<td style="height: 40px; width: 150px;" class="table-orange">تـاريـخ الإنـتـهــاء</td>
		<td style="height: 40px; width: 90px;" class="table-orange">تعديـل</td>
		<td style="height: 40px; width: 90px;" class="table-orange">مســح</td>
	</tr>

<?php
foreach($results as $rows)
	{
		$ID = $rows->ID;
		$Offer_Title = stripslashes($rows->Offer_Title);
		$Start_Date = date('d-m-Y',strtotime($rows->Start_Date));
		$End_Date = date('d-m-Y',strtotime($rows->End_Date));
		$Status = $rows->Status;
		switch($Status)
		{
			
			case '5':
			$Style = 'padding-top:4px; width: 150px;" class="table-orange3 td-back';
			
			break;
			
			case '4':
			$Style = 'padding-top:4px; width: 150px;" class="table-orange3 td-draft';
			
			break;
			
			case '3':
			$Style = 'padding-top:4px; width: 150px;" class="table-orange3 td-finished';
			break;
			
			case '2':
			$Style = 'padding-top:4px; width: 150px; height: 40px;" class="table-orange3';
			break;
			
			default:
			$Style = 'padding-top:4px; width: 150px;" class="table-orange3 td-active';
			
		}
	
	?>
	<tr>
		<td style="padding-top:4px; padding-right:10px; height: 40px;" valign="top" align="right" class="table-orange3"><?php echo $Offer_Title;?></td>
		<td style="<?php echo $Style;?>"><?php echo $Start_Date;?></td>
		<td style="<?php echo $Style;?>"><?php echo $End_Date;?></td>
		<td style="padding-top:4px; width: 90px; height: 40px;" class="table-orange3">
		<img style="cursor:pointer " src="<?php echo __SCRIPT_PATH;?>images/edit-icon.jpg" width="30" height="28" onClick="$.editData('تـعـديـل الـعـرض','<?php echo __LINK_PATH;?>advertisers/edit_selected_offer/Member/<?php echo $ID;?>/AJAX/Y/',950,580)" />
		</td>
		<td style="padding-top:4px; width: 90px; height: 40px;" class="table-orange2"><img class="Del_Btn_Main" id="<?php echo $ID;?>" style="cursor:pointer " src="<?php echo __SCRIPT_PATH;?>images/delete-icon.jpg" width="30" height="32"></td>
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
<?php
}
?>
</div>