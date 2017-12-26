<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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
			$.post('<?php echo __LINK_PATH;?>adminadvertisers/show_client_offers/Member/<?php echo $AID;?>/AJAX/Y/',{Page:Page},function(data){
				$('#Container').html(data);
				$('#Product_Container').hide().delay(300).fadeIn();
				});
			});	
		jQuery.leave = function(){
			var Page = '<?php echo $Page;?>';
			$.post('<?php echo __LINK_PATH;?>adminadvertisers/show_client_offers/Member/<?php echo $AID;?>/AJAX/Y/',{Page:Page},function(data){
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
	
	$('.check_mark_pages').click(function(){
			var ID = $(this).attr('id'); 
			
			$.post('<?php echo __LINK_PATH;?>adminadvertisers/block_selected_offer/AJAX/Y/',{ID:ID},function(data){
				alert('تـم حـجــب الـعـرض');
				$('#Container').html(data);
				});
			
			}); 
	$('.block_mark_pages').click(function(){
			var ID = $(this).attr('id'); 
			
			$.post('<?php echo __LINK_PATH;?>adminadvertisers/publish_selected_offer/AJAX/Y/',{ID:ID},function(data){
				alert('تـم تـفـعـيـل الـعـرض');
				$('#Container').html(data);
				});
			
			});
	$('.Del_Btn_Main').click(function(){
			var ID = $(this).attr('id'); 
			var Page = '<?php echo $Page;?>';
			if (confirm("هــل تـريـد الإسـتـمـرار فـي عـمـلــيـة الـمـسسـح؟")) {
			$.post('<?php echo __LINK_PATH;?>adminadvertisers/delete_selected_offer/AJAX/Y/',{ID:ID,Page:Page},function(data){
				$('#Container').html(data);
				});
			}
			});	
	});
</script>
<style>
.Paginate{
margin-right:5px;
cursor:pointer;
color:#0099FF;
}
</style>
<div align="right"><span><?php echo $Full_Name;?></span>&nbsp;<span>الــعـروض الـخـاصـة بـالـعـمـيــل</span></div>
<div dir="rtl" class="Add_Main_Menu"><img style="cursor:pointer" src="<?php echo __SCRIPT_PATH;?>images/add.png" onClick="$.editData('إضـافـة عـرض','<?php echo __LINK_PATH;?>adminadvertisers/add_offer/Member/<?php echo $AID;?>/AJAX/Y/',950,590)"/>&nbsp;<span>أضــف عـرض جـديـد لـهـذا الـمـستـخـدم</span></div>
<div>&nbsp;</div>
<div align="center">
<table style="width:650px "  border="0" cellpadding="2" cellspacing="0">
	<tr>
		<td width="100"><div align="right">تـم إرجـاعــه</div></td>
		<td width="36"><div align="center"><img src="<?php echo __SCRIPT_PATH;?>images/Returned.png"></div></td>
		<td width="76"><div align="right">مـسودة</div></td>
		<td width="36"><div align="center"><img src="<?php echo __SCRIPT_PATH;?>images/Draft.png"></div></td>
		<td width="95"><div align="right">غـيـر مـفـعـل</div></td>
		<td width="36"><div align="center"><img src="<?php echo __SCRIPT_PATH;?>images/Blocked.png"></div></td>
		<td width="77"><div align="right">مـفـعــل</div></td>
		<td width="36"><div align="center"><img src="<?php echo __SCRIPT_PATH;?>images/Published.png"></div></td>
		<td width="82"><div align="right">مـنـتـهـي</div></td>
		<td width="36" ><div align="center"><img src="<?php echo __SCRIPT_PATH;?>images/Expired.png"></div></td>
	</tr>
</table>
</div>
<div>&nbsp;</div>
<?php
if((is_array($results))&&(count($results)))
	{
?>
<div id="Product_Container">
<table width="100%"  border="1" cellpadding="2" cellspacing="0" bordercolor="#333333">
  <tr bgcolor="#ACCBE3">
   <td width="9%"><div align="center" style="font-size:16px ">مـســح</div></td>
    <td width="9%"><div align="center" style="font-size:16px ">تـعـديــل</div></td>
	<td width="9%"><div align="center" style="font-size:16px ">نـشــر</div></td>
   <td width="12%"><div align="center" style="font-size:16px ">تـاريـخ الإنـتـهــاء</div></td>
	 <td width="12%"><div align="center" style="font-size:16px ">تـاريـخ الـبـدء</div></td>
	 <td width="26%"><div align="center" style="font-size:16px ">مـحـتـوى الـعـرض</div></td>
     <td width="23%"><div align="center" style="font-size:16px ">إســم الـعـرض</div></td>
  </tr>

<?php
foreach($results as $rows)
	{
	$ID = $rows->ID;
	$Offer_Title = stripslashes($rows->Offer_Title);
	$Offer_Content = html_entity_decode($rows->Offer_Content,ENT_QUOTES,'UTF-8');
	$Offer_Content = stripslashes($Offer_Content);
	$Start_Date = date('d-m-Y',strtotime($rows->Start_Date));
	$End_Date = date('d-m-Y',strtotime($rows->End_Date));
	$Status = $rows->Status;
	switch($Status)
		{
			
			case '5':
			$BG_Color = '#CCCCCC';
			$Status_Name = 'تـم إرجـاعــه';
			break;
			
			case '4':
			$BG_Color = '#0099FF';
			$Status_Name = 'مـسودة';
			break;
			
			case '3':
			$BG_Color = '#FFCC00';
			$Status_Name = 'مـنـتـهـي';
			break;
			
			case '2':
			$BG_Color = '#FFFFFF';
			break;
			
			default:
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
		<img style="cursor:pointer " src="<?php echo __SCRIPT_PATH;?>images/edit.gif" width="30" height="30" onClick="$.editData('تـعـديـل الـعـرض','<?php echo __LINK_PATH;?>adminadvertisers/edit_selected_offer/Member/<?php echo $ID;?>/AID/<?php echo  $AID;?>/Page/<?php echo $Page;?>/AJAX/Y/',950,590)" />
		</div>
		</td>
		<td>
		<div align="center">
		<?php
		if($Status == '1')
			{
			?>
			<img src="<?php echo __SCRIPT_PATH;?>images/Check_Mark.png" width="20" height="20" class="check_mark_pages" id="<?php echo $ID;?>"/>
			<?php
			}
		elseif($Status == '2')
			{
			?>
			<img src="<?php echo __SCRIPT_PATH;?>images/closed.png" width="20" height="20" class="block_mark_pages" id="<?php echo $ID;?>"/>
			<?php
			}
			else
			{
			echo $Status_Name;
			}
			?>
			</div>
			</td>
		<td style="background-color:<?php echo $BG_Color;?> "><div align="center"><?php echo $End_Date;?></div></td>
		<td style="background-color:<?php echo $BG_Color;?> "><div align="center"><?php echo $Start_Date;?></div></td>
		
		<td><div align="center"><?php echo $Offer_Content;?></div></td>
		<td><div align="center"><?php echo $Offer_Title;?></div></td>
	</tr>
	<?php
	}
?>
</table>
</div>
<div>&nbsp;</div>
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