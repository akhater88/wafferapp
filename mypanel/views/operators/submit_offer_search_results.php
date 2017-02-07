<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
 <div id="Container">
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
			var Status = '<?php echo $Status;?>';
			var Country_ID = '<?php echo $Country_ID;?>';
			var Merchants_ID = '<?php echo $Merchants_ID;?>';
			var City_ID = '<?php echo $City_ID;?>';
			var Category_ID = '<?php echo $Category_ID;?>';
			var Services_ID = '<?php echo $Services_ID;?>';
			var Creation_Start_Date = '<?php echo $Creation_Start_Date;?>';
			var Creation_End_Date = '<?php echo $Creation_End_Date;?>';
			var Start_Date = '<?php echo $Start_Date;?>';
			var End_Date = '<?php echo $End_Date;?>';
			
			$.post('<?php echo __LINK_PATH;?>operators/submit_offer_search_results/AJAX/Y/',{Page:Page,Status:Status,Country_ID:Country_ID,Merchants_ID:Merchants_ID,City_ID:City_ID,Category_ID:Category_ID,Services_ID:Services_ID,Creation_Start_Date:Creation_Start_Date,Creation_End_Date:Creation_End_Date,Start_Date:Start_Date,End_Date:End_Date},function(data){
				$('#Container').html(data);
				$('#Product_Container').hide().delay(300).fadeIn();
				});
			});	
			
		jQuery.leave = function(){
			var Page = '<?php echo $Page;?>';
			var Status = '<?php echo $Status;?>';
			var Country_ID = '<?php echo $Country_ID;?>';
			var Merchants_ID = '<?php echo $Merchants_ID;?>';
			var City_ID = '<?php echo $City_ID;?>';
			var Category_ID = '<?php echo $Category_ID;?>';
			var Services_ID = '<?php echo $Services_ID;?>';
			var Creation_Start_Date = '<?php echo $Creation_Start_Date;?>';
			var Creation_End_Date = '<?php echo $Creation_End_Date;?>';
			var Start_Date = '<?php echo $Start_Date;?>';
			var End_Date = '<?php echo $End_Date;?>';
			
			$.post('<?php echo __LINK_PATH;?>operators/submit_offer_search_results/AJAX/Y/',{Page:Page,Status:Status,Country_ID:Country_ID,Merchants_ID:Merchants_ID,City_ID:City_ID,Category_ID:Category_ID,Services_ID:Services_ID,Creation_Start_Date:Creation_Start_Date,Creation_End_Date:Creation_End_Date,Start_Date:Start_Date,End_Date:End_Date},function(data){
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
<div id="Product_Container">
<?php
if(count($Final_OID))
	{
		$Counter = 0;
		
		?>
		
		<table style=" width:100%; text-align:center; line-height:30px;" cellpadding="0" cellspacing="0" class="style1" dir="ltr">
		  <tr>
		  	<td style="width: 135px; height: 40px;" class="table-orange">الـتـفـاصـيــل</td>
			<td style="width: 135px; height: 40px;" class="table-orange">حـالــة الـعـرض</td>
		  	<td style="width: 135px; height: 40px;" class="table-orange">تـاريــخ الإنـتـهــاء</td>
		  	<td style="width: 135px; height: 40px;" class="table-orange">تـاريــخ الـبـدء</td>
			<td style="width: 135px; height: 40px;" class="table-orange">الـبـلــد</td>
			<td style="width: 135px; height: 40px;" class="table-orange">إسـم الـشـركــة</td>
			
		  </tr>
		<?php
		
		foreach($Final_OID as $value)
			{
				$Counter2 = 0;
				if($Counter%2)
					{
						$Style = 'odd';
					}
				else
					{
						$Style = 'even';
					}
			?>
			<tr class="<?php echo $Style;?>">
		  	<td style="width: 135px; padding-top:4px;" class="table-orange2"><span style="cursor:pointer " onClick="$.editData('تـعـديـل مـعـلــومـات الـعـمـيــل','<?php echo __LINK_PATH;?>operators/edit_selected_offer_from_pending/Member/<?php echo $value;?>/AJAX/Y/',950,600)"><img alt="" src="<?php echo __SCRIPT_PATH;?>images/details.jpg" width="80" height="24" class="style2" border="0" /></span></td>
		  	<td style="width: 135px; padding-top:4px;" class="table-orange2"><?php echo $Status_Array[$Counter];?></td>
			<td style="width: 135px; padding-top:4px;" class="table-orange2"><?php echo $End_Date_Array[$Counter];?></td>
			<td style="width: 135px; padding-top:4px;" class="table-orange2"><?php echo $Start_Date_Array[$Counter];?></td>
			<td style="width: 135px; padding-top:4px;" class="table-orange2"><?php echo $Country_Name_Array[$Counter];?></td>
			<td style="width: 135px; padding-top:4px;" class="table-orange2"><?php echo $Sender_Name_Array[$Counter];?></td>
			
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