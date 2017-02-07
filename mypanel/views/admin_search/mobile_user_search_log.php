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
		$('#Export').click(function(){
			
			var MyCoupons = 'This is an Excel file';
			window.location = '<?php echo __SCRIPT_PATH;?>Excel/Tests/export_mobile_users_to_excel.php/';
			
			});	
		$('.Del_Btn_Main').click(function(){
			var ID = $(this).attr('id'); 
			var Div = '#tr_'+ID;
			if (confirm("هــل تـريـد الإسـتـمـرار فـي عـمـلــيـة الـمـسسـح؟")) {
			$.post('<?php echo __LINK_PATH;?>admin_search/delete_selected_mobile_user/AJAX/Y/',{ID:ID,Page:'<?php echo $Page;?>',CID:'<?php echo $Country_ID;?>',Email:'<?php echo $ID;?>',Starts_Date:'<?php echo $Starts_Date;?>',End_Date:'<?php echo $End_Date;?>',Time_Stamp:'<?php echo $Time_Stamp;?>'},function(data){
				$(Div).remove();
				var Record_Number = '<?php echo $Total;?>';
				var Final_Record_Number = Record_Number - 1;
				$('#Record_Number').html(Final_Record_Number);
				});
			}
			});	
			
			
		$('.Paginate').click(function(){
			var Page = $(this).attr('id'); 
			$.post('<?php echo __LINK_PATH;?>admin_search/mobile_user_search_log/Level/6/AJAX/Y/',{Page:Page,CID:'<?php echo $Country_ID;?>',Email:'<?php echo $ID;?>',Starts_Date:'<?php echo $Starts_Date;?>',End_Date:'<?php echo $End_Date;?>',Time_Stamp:'<?php echo $Time_Stamp;?>'},function(data){
				$('#Container').html(data);
				$('#Product_Container').hide().delay(300).fadeIn();
				});
			});	
		jQuery.leave = function(){
			
			$.post('<?php echo __LINK_PATH;?>admin_search/mobile_user_search_log/Level/6/AJAX/Y/',{Page:'<?php echo $Page;?>',CID:'<?php echo $Country_ID;?>',Email:'<?php echo $ID;?>',Starts_Date:'<?php echo $Starts_Date;?>',End_Date:'<?php echo $End_Date;?>',Time_Stamp:'<?php echo $Time_Stamp;?>'},function(data){
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
.Paginate{
margin-right:5px;
cursor:pointer;
color:#0099FF;
}
.style5 {
				background-color: #D3D3D3;
				text-align: center;
				font-weight:bold;
}
</style>
<div align="center"><span id="Export" style="cursor:pointer "><img src="<?php echo __SCRIPT_PATH;?>images/Excel.jpg" width="40" height="40"></span></div>
<div id="Product_Container">
<?php
$Display = new sql();
$Color_Array = array('#F5F5F5','#CCDAE3');
		$Counter = 0;
		?>
		<div dir="rtl"><span>عــدد الـسـجـلات</span><span style="margin-right:10px " id="Record_Number"><?php echo $Total;?></span></div>
		<div style="line-height:12px ">&nbsp;</div>
		<table style=" width:100%; text-align:center; line-height:30px;" cellpadding="0" cellspacing="0" class="style1" dir="ltr">
		  <tr>
			<td width="10%" class="table-orange" style="height: 40px;">مـسـح</td>
			<td width="11%" class="table-orange" style="height: 40px;">تـعــديـل</td>
			<td width="14%" class="table-orange" style="height: 40px;">كـلـمــة الـسـر</td>
			<td width="17%" class="table-orange" style="height: 40px;">تـاريـخ الإدخــال</td>
			<td width="18%" class="table-orange" style="height: 40px;">الـبــلــد</td>
			<td width="30%" class="table-orange" style="height: 40px;">الـبـريـد الإلكـتـرونـي</td>
		  </tr>
		<?php
		foreach($results as $rows)
			{
				$sql_country = 'SELECT Name FROM '.$Table.' WHERE ID = ?';
				$Execute_Array = array($rows->Country_ID);
				$Country_Name = $Display->Display_Single_Info_Modified($sql_country,'Name',$Execute_Array);
				if($Counter % 2)
					{
						$Style = 'odd';
					}
				else
					{
						$Style = 'even';
					}
					?>
					 	<tr id="tr_<?php echo $rows->ID;?>">
						<td style="padding-top:4px;" class="table-orange2"><img style="cursor:pointer " src="<?php echo __SCRIPT_PATH;?>images/del.png" width="20" height="20" class="Del_Btn_Main" id="<?php echo $rows->ID;?>"></td>
						<td style="padding-top:4px;" class="table-orange2"><img style="cursor:pointer " src="<?php echo __SCRIPT_PATH;?>images/edit.png" width="20" height="20" onClick="$.editData('تـعـديـل مـعـلــومـات الـعـمـيــل','<?php echo __LINK_PATH;?>mobile_users/edit_selected_mobile_user/Member/<?php echo $rows->ID;?>/Page/<?php echo $Page;?>/AJAX/Y/',950,350)"></td>
						<td style="padding-top:4px;" class="table-orange2"><img style="cursor:pointer " src="<?php echo __SCRIPT_PATH;?>images/pw.png" onClick="$.editData('تـعـديـل كـلـمـة الـسـر','<?php echo __LINK_PATH;?>members/edit_pw/Member/<?php echo $rows->ID;?>/AJAX/Y/',950,200)" /></td>
						<td style="padding-top:4px;" class="table-orange2"><?php echo  date('d-m-Y',strtotime($rows->Time_Stamp));?></td>
						<td style="padding-top:4px;" class="table-orange2"><?php echo $Country_Name;?></td>
						<td style="padding-top:4px;" class="table-orange2"><?php echo $rows->Email;?></td>
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
				}//End footer
	//}//End original if statement
?>
</div>
</div>
</div>