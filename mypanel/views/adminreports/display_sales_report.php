<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<div id="Container">
<div align="right" style="width:900px; font-size:15px; font-weight:bold ">
<div>&nbsp;</div>
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
		
		$('.Del_Btn_Main').click(function(){
			var ID = $(this).attr('id');
			if (confirm("هــل تـريـد الإسـتـمـرار فـي عـمـلــيـة الـمـسسـح؟")) {
			$.post('<?php echo __LINK_PATH;?>adminreports/delete_selected_merchant/AJAX/Y/',{ID:ID,Starts_Date:'<?php echo $Starts_Date;?>',End_Date:'<?php echo $End_Date;?>',Country:'<?php echo $Country;?>',Sales_ID:'<?php echo $Sales_ID;?>',MID:'<?php echo $MID;?>',Cat_ID:'<?php echo $Cat_ID;?>',Sub_Cat_ID:'<?php echo $Sub_Cat_ID;?>',Time_Stamp:'<?php echo $Time_Stamp;?>'},function(data){
				$('#Container').html(data);
				});
			}
			});	
			
		jQuery.editData = function(title,url,width,height){
			$.window({
			   title: title,
			   width: width,           // window width
			   height: height, 
			   url: url         // window height
			  
		});
		};
	});
</script>
<style>
.Paginate{
margin-right:5px;
cursor:pointer;
color:#0099FF;
}
</style>
<div id="Product_Container">
<?php
if(count($Sender_Name_Array))
	{
		$Color_Array = array('#F5F5F5','#CCDAE3');
		$Counter = 0;
		?>
		<div style="line-height:12px ">&nbsp;</div>
		<table style=" width:100%; text-align:center; line-height:30px;" cellpadding="0" cellspacing="0" class="style1" dir="ltr">
		  <tr>
			<td width="8%" class="table-orange" style="height: 40px;">مـسـح</td>
			<td width="15%" class="table-orange" style="height: 40px;">الـتـفـاصـيــل</td>
			<td width="23%" class="table-orange" style="height: 40px;">بـواسـطـة</td>
			<td width="13%" class="table-orange" style="height: 40px;">الـمـبـلــغ الـمـدفــوع</td>
			<td width="15%" class="table-orange" style="height: 40px;">الـبـلــد</td>
			<td width="26%" class="table-orange" style="height: 40px;">إسـم الـمـسـتخـدم</td>
		  </tr>
		<?php
		$Index = 0;
		$Money_Paid = 0;
		foreach($Sender_Name_Array as $value)
			{
				$Money_Paid += $Amount_Array[$Index];
						?>
					 	<tr>
						<td style="padding-top:4px;" class="table-orange2"><img style="cursor:pointer " src="<?php echo __SCRIPT_PATH;?>images/del.png" width="20" height="20" class="Del_Btn_Main" id="<?php echo $MID_Array[$Index];?>"></td>
						<td style="padding-top:4px;" class="table-orange2"><span style="cursor:pointer " onClick="$.editData('مـعـلــومــات الـعـمـيــل','<?php echo __LINK_PATH;?>members/show_edit_selected/Member/<?php  echo $MID_Array[$Index];?>/Level/2/AJAX/Y/',950,500)"><img alt="" src="<?php echo __SCRIPT_PATH;?>images/details.jpg" width="80" height="24" class="style2" border="0" /></span></td>
						<td style="padding-top:4px;" class="table-orange2"><?php echo $Log_Creator[$Index];?></td>
						<td style="padding-top:4px;" class="table-orange2"><?php echo $Amount_Array[$Index];?></td>
						<td style="padding-top:4px;" class="table-orange2"><?php echo $Country_Name_Array[$Index];?></td>
						<td style="padding-top:4px;" class="table-orange2"><?php echo $value;?></td>
					  	</tr>
					  <?php
					  $Index++;
					  $Counter++;
						if($Counter > 1)
						{
							$Counter = 0;
						}
				
			}
			?>
  			</table>
			
			<div style="line-height:12px">&nbsp;</div>
			<div dir="rtl">عــدد الـعـمـلاء<span style="margin-right:30px "><?php echo count($Sender_Name_Array);?></span></div>
			<div dir="rtl">الـمـبـلــغ الإجـمــالـي<span style="margin-right:30px "><?php echo $Money_Paid.' JD ';?></span></div>
			<div dir="rtl">مجموع الخدمات<span style="margin-right:30px "><?php echo $Total_Services;?></span></div>
			
			<?php
	}//End original if statement
?>
</div>
</div>
</div>