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
			$.post('<?php echo __LINK_PATH;?>operators/show_client_offers/AJAX/Y/',{Page:Page},function(data){
				$('#Container').html(data);
				$('#Product_Container').hide().delay(300).fadeIn();
				});
			});	
		jQuery.leave = function(){
			$.post('<?php echo __LINK_PATH;?>operators/show_client_offers/Member/<?php echo $AID;?>/AJAX/Y/',function(data){
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
			
			$.post('<?php echo __LINK_PATH;?>operators/block_selected_offer/AJAX/Y/',{ID:ID},function(data){
				alert('تـم حـجــب الـعـرض');
				$('#Container').html(data);
				});
			
			}); 
	$('.block_mark_pages').click(function(){
			var ID = $(this).attr('id'); 
			
			$.post('<?php echo __LINK_PATH;?>operators/publish_selected_offer/AJAX/Y/',{ID:ID},function(data){
				alert('تـم تـفـعـيـل الـعـرض');
				$('#Container').html(data);
				});
			
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
<?php
if((is_array($results))&&(count($results)))
	{
?>
<div id="Product_Container">
<table width="100%"  border="1" cellpadding="2" cellspacing="0" bordercolor="#333333">
  <tr bgcolor="#ACCBE3">
	<td width="14%"><div align="center" style="font-size:16px ">نـشــر</div></td>
   <td width="14%"><div align="center" style="font-size:16px ">تـاريـخ الإنـتـهــاء</div></td>
	 <td width="15%"><div align="center" style="font-size:16px ">تـاريـخ الـبـدء</div></td>
	 <td width="30%"><div align="center" style="font-size:16px ">مـحـتـوى الـعـرض</div></td>
     <td width="27%"><div align="center" style="font-size:16px ">إســم الـعـرض</div></td>
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
			echo 'مـنـتـهـي';
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