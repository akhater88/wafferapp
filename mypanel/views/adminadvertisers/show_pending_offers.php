<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<div id="Container">
<div align="right" style="width:900px; line-height:25px; font-size:15px; font-weight:bold ">
<style>
.Paginate{
margin-right:5px;
cursor:pointer;
color:#0099FF;
}

</style>
<script type="text/javascript" src="<?php echo __SCRIPT_PATH;?>js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="<?php echo __SCRIPT_PATH;?>js/jquery-ui.js"></script>
<link id="jquery_ui_theme_loader" type="text/css" href="<?php echo __SCRIPT_PATH;?>css/themes/base/jquery-ui.css" rel="stylesheet" />
<link type="text/css" href="<?php echo __SCRIPT_PATH;?>css/jquery.window.css" rel="stylesheet" />

<script type="text/javascript" src="<?php echo __SCRIPT_PATH;?>js/jquery.codeview.js"></script>
<script type="text/javascript" src="<?php echo __SCRIPT_PATH;?>js/jquery.share.js"></script>
<script type="text/javascript" src="<?php echo __SCRIPT_PATH;?>js/jquery.window.js"></script>
				
<script type="text/javascript" src="<?php echo __SCRIPT_PATH;?>js/common.js"></script>
<script type="text/javascript" src="<?php echo __SCRIPT_PATH;?>js/index.js"></script>	
<script type="text/javascript"> 
	$(document).ready(function() { 
	
		$('.Paginate').click(function(){
			var Page = $(this).attr('id'); 
			var Country = '<?php echo $Country_ID;?>';
			$.post('<?php echo __LINK_PATH;?>adminadvertisers/show_pending_offers/AJAX/Y/',{Page:Page,Country:Country},function(data){
				$('#Container').html(data);
				$('#Product_Container').hide().delay(300).fadeIn();
				});
			});	
			
		jQuery.leave = function(){
			var Page = '<?php echo $Page;?>';
			var Country = '<?php echo $Country_ID;?>';
			$.post('<?php echo __LINK_PATH;?>adminadvertisers/show_pending_offers/Level/2/AJAX/Y/',{Page:Page,Country:Country},function(data){
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
<div style="line-height:15px ">&nbsp;</div>
<?php
if(count($Offer_ID_Array))
	{
		$Counter = 0;
		
		?>
		<table style=" width:100%; text-align:center; line-height:30px;" cellpadding="0" cellspacing="0" class="style1" dir="ltr">
		  <tr  class="odd">
		  	<td style="height: 40px;" class="table-orange">الـتـفـاصـيــل</td>
			<td style="height: 40px;" class="table-orange">تـاريـخ الإنشـاء</td>
		  	<td style="height: 40px;" class="table-orange">تـاريــخ الـبـدء</td>
		  	<td style="height: 40px;" class="table-orange">تـاريــخ الإدخــال</td>
			<td style="height: 40px;" class="table-orange">الـبـلــد</td>
			<td style="height: 40px;" class="table-orange">إسـم الـشـركــة</td>
		  </tr>
		<?php
		
		foreach($Offer_ID_Array as $value)
			{
				if($Counter%2)
					{
						$Style = 'odd';
					}
				else
					{
						$Style = 'even';
					}
			?>
			<tr>
		  	<td style="padding-top:4px;" class="table-orange2"><span style="cursor:pointer " onClick="$.editData('تـعـديـل مـعـلــومـات الـعـمـيــل','<?php echo __LINK_PATH;?>adminadvertisers/edit_selected_offer_from_pending/Member/<?php echo $value;?>/AJAX/Y/',950,600)"><img alt="" src="<?php echo __SCRIPT_PATH;?>images/details.jpg" width="80" height="24" class="style2" border="0" /></span></td>
		  	<td style="padding-top:4px;" class="table-orange2"><?php echo $Time_Stamp_Array[$Counter];?></td>
			<td style="padding-top:4px;" class="table-orange2"><?php echo $Start_Date_Array[$Counter];?></td>
		  	<td style="padding-top:4px;" class="table-orange2"><?php echo $Creation_Date_Array[$Counter];?></td>
			<td style="padding-top:4px;" class="table-orange2"><?php echo $Country_Array[$Counter];?></td>
			<td style="padding-top:4px;" class="table-orange2"><?php echo $First_Name_Array[$Counter];?></td>
		    </tr>
		  <?php
		  	$Counter++;
			}
		?>
		</table>
		
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