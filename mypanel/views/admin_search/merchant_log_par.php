<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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
			var Div = '#tr_'+ID; 
			if (confirm("هــل تـريـد الإسـتـمـرار فـي عـمـلــيـة الـمـسسـح؟")) {
			$.post('<?php echo __LINK_PATH;?>admin_search/delete_selected_member_merchant/Country_ID/<?php echo $Country_ID;?>/Company_ID/<?php echo $Company_ID;?>/Time_Stamp/<?php echo $Time_Stamp;?>/Starts_Date/<?php echo $Starts_Date;?>/End_Date/<?php echo $End_Date;?>/Page/<?php echo $Page;?>/AJAX/Y/',{ID:ID},function(data){
				$(Div).remove();
				var Record_Number = '<?php echo $Total;?>';
				var Final_Record_Number = Record_Number - 1;
				$('#Record_Number').html(Final_Record_Number);
				});
			}
			});	
			
		$('#MyUsers').change(function(){
			var Level = $(this).val();
			$.post('<?php echo __LINK_PATH;?>admin_search/display_search_results/AJAX/Y/',{Level:Level},function(data){
					$('#User_Info').html(data);
				});
		});	
			
		$('.Paginate').click(function(){
			var Page = $(this).attr('id'); 
			$.post('<?php echo __LINK_PATH;?>admin_search/merchant_log/AJAX/Y/',{Page:Page},function(data){
				$('#Container').html(data);
				$('#Product_Container').hide().delay(300).fadeIn();
				});
			});	
		jQuery.leave = function(){
			$.post('<?php echo __LINK_PATH;?>admin_search/display_search_results/Level/2/AJAX/Y/',function(data){
					$('#Container').html(data);
				})
			};	
		jQuery.editData = function(title,url,width,height){
			$.window({
			   title: title,
			   width: width,           // window width
			   height: height, 
			   url: url        // window height
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
<div id="Product_Container">
<?php
if(isset($_SESSION['Arabic']))
	{
		$Table_Country = 'country';
	}
else
	{
		$Table_Country = 'country_english';
	}
$Display = new sql();
if(count($results)&& is_array($results))
	{
		$Color_Array = array('#F5F5F5','#CCDAE3');
		$Counter = 0;
		?>
		<div dir="rtl"><span>عــدد الـسـجـلات</span><span style="margin-right:10px "><?php echo $Total;?></span></div>
		<div style="line-height:12px ">&nbsp;</div>
		<table width="100%"  border="0" cellpadding="5" cellspacing="0">
		  <tr style="background-color:#CCDAE3 ">
			<td width="5%"><div align="center">مـسـح</div></td>
			<td width="5%"><div align="center">تـعــديـل</div></td>
			<td width="11%"><div align="center">الـتـفـاصـيــل</div></td>
			<td width="12%"><div align="center">كـلـمــة الـسـر</div></td>
			<td width="24%"><div align="center">إسـم الـشـخص الـذي أدخـل الـمـعـلــومــة</div></td>
			<td width="10%"><div align="center">تـاريـخ الإدخــال</div></td>
			<td width="11%"><div align="center">الـبــلــد</div></td>
			<td width="22%"><div align="center">إســم الـشـركــة</div></td>
		  </tr>
		<?php
		foreach($results as $rows)
			{
				if($Counter % 2)
					{
						$Style = 'odd';
					}
				else
					{
						$Style = 'even';
					}
				$sql = 'SELECT Name FROM '.$Table_Country.' WHERE ID = ?';
				$Execute_Array = array($rows->Country);
				$Country_Name = $Display->Display_Single_Info_Modified($sql,'Name',$Execute_Array);
				
				$sql = 'SELECT RID,Time_Stamp,OID FROM logs WHERE Table_Name = ? AND Action = ? AND RID = ?';
				$Execute_Array = array('users','1',$rows->ID);
				$results_log = $Display->Display_Info($sql,$Execute_Array);
				foreach($results_log as $rows_log)
							{
								$sql_operator = 'SELECT First_Name FROM users WHERE ID = ?';
								$Execute_Array = array($rows_log->OID);
								$Operator_First_Name = $Display->Display_Single_Info_Modified($sql_operator,'First_Name',$Execute_Array);
								$Time_Stamp = $rows_log->Time_Stamp;
								if($Time_Stamp != NULL)
									{
										$Time_Stamp = date('d-m-Y',strtotime($Time_Stamp));
									}
								else
									{
										$Time_Stamp = '----';
									}
							}
						
					?>
					 	<tr class="<?php echo $Style;?>" id="tr_<?php echo $rows_log->RID;?>">
						<td><div align="center"><img style="cursor:pointer " src="<?php echo __SCRIPT_PATH;?>images/del.png" width="20" height="20" class="Del_Btn_Main" id="<?php echo $rows_log->RID;?>"></div></td>
						<td><div align="center"><img style="cursor:pointer " src="<?php echo __SCRIPT_PATH;?>images/edit.png" width="20" height="20" onClick="$.editData('تـعـديـل مـعـلــومـات الـعـمـيــل','<?php echo __LINK_PATH;?>members/edit_selected/Member/<?php echo $rows_log->RID;?>/Level/2/AJAX/Y/',950,650)"></div></td>
						<td><div align="center"><span style="cursor:pointer " onClick="$.editData('مـعـلــومــات الـعـمـيــل','<?php echo __LINK_PATH;?>members/show_edit_selected/Member/<?php echo $rows->ID;?>/Level/2/AJAX/Y/',950,500)">الـتـفـاصـيــل</span></div></td>
						<td><div align="center"><img style="cursor:pointer " src="<?php echo __SCRIPT_PATH;?>images/pw.png" onClick="$.editData('تـعـديـل كـلـمـة الـسـر','<?php echo __LINK_PATH;?>members/edit_pw/Member/<?php echo $rows->ID;?>/AJAX/Y/',950,200)" /></div></td>
						<td><div align="center"><?php echo $Operator_First_Name;?></div></td>
						<td><div align="center"><?php echo $Time_Stamp;?></div></td>
						<td><div align="center"><?php echo $Country_Name;?></div></td>
						<td><div align="center"><?php echo $rows->Company_Name;?></div></td>
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
	}//End original if statement
?>
</div>
</div>