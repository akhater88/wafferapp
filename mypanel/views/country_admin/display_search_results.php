<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<div id="Container">
<div align="center" style="width:900px; font-size:15px; font-weight:bold ">
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
<script type="text/javascript" src="<?php echo __SCRIPT_PATH;?>js/datepicker.js"></script>
<link rel="stylesheet" href="<?php echo __SCRIPT_PATH;?>css/datepicker.css" type="text/css" />
<script type="text/javascript"> 
	$(document).ready(function() {
	jQuery.leave = function(){
			var Starts_Date = '<?php echo $Starts_Date;?>';
			var End_Date = '<?php echo $End_Date;?>';
			var Sales_Men = '<?php echo $Sales_Men;?>';
			var Merchant_ID = '<?php echo $Merchant_ID;?>';
			var Category = '<?php echo $Category;?>';
			var Services = '<?php echo $Services;?>';
			
			$.post('<?php echo __LINK_PATH;?>country_admin/display_search_results/AJAX/Y/',{Starts_Date:Starts_Date,End_Date:End_Date,Sales_Men:Sales_Men,Merchant_ID:Merchant_ID,Category:Category,Services:Services},function(data){
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
<div>&nbsp;</div>
<?php
if(count($MID_Array))
	{
	?>
	<table style=" width:100%; text-align:center; line-height:30px;" cellpadding="0" cellspacing="0" class="style1" dir="ltr">
	  <tr>
		<td style="height: 40px;" class="table-orange">الـتـفـاصـيــل</td>
		<td style="height: 40px;" class="table-orange">إسـم الـشـخـص الـذي أدخـل الـمـعـلـومــة</td>
		<td style="height: 40px;" class="table-orange">الـمـبـلـغ الـمـدفــوع</td>
		<td style="height: 40px;" class="table-orange">إسـم الـمـرســل</td>
	  </tr>
	
	<?php
	$Counter = 0;
		foreach($MID_Array as $value)
			{
				if($Counter%2)
					{
						$Class = 'odd';
					}
				else
					{
						$Class = 'even';
					}
				if($Amount_Array[$Counter] == NULL)
					{
						$Amount_Array[$Counter] = 0;
					}
			?>
			<tr class="<?php echo $Class;?>">
				<td style="padding-top:4px;" class="table-orange2"><span style=" cursor:pointer " onClick="$.editData('تـعـديـل مـعـلــومـات الـعـمـيــل','<?php echo __LINK_PATH;?>country_admin/edit_selected_merchant/Member/<?php echo $value;?>/Level/2/AJAX/Y/',950,650)"><img alt="" src="<?php echo __SCRIPT_PATH;?>images/details.jpg" width="80" height="24" class="style2" border="0" /></span></td>
				<td style="padding-top:4px;" class="table-orange2"><?php echo $Log_Creator[$Counter];?></td>
				<td style="padding-top:4px;" class="table-orange2"><?php echo $Amount_Array[$Counter];?></td>
				<td style="padding-top:4px;" class="table-orange2"><?php echo $MID_User_Name_Array[$Counter];?></td>
	  </tr>
			<?php
			$Counter++;
			}
		?>
  </table>
		<div>&nbsp;</div>
		<table width="100%"  border="0" cellpadding="3" cellspacing="0" dir="ltr">
		  <tr>
			<td width="86%"><div align="right"><?php echo count($MID_Array);?></div></td>
			<td width="14%"><div align="right">عـدد الـعـمـلاء</div></td>
		  </tr>
		  <tr>
			<td><div align="right"><?php echo $Total_Amount;?></div></td>
			<td><div align="right">الـمـبـلـغ الـمـدفــوع</div></td>
		  </tr>
		 <tr>
			<td><div align="right"><?php echo $Total_Services;?></div></td>
			<td><div align="right">مجموع الخدمات</div></td>
		  </tr>
  </table>

		<?php
	}
?>
</div>
</div>
