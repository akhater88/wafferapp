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
			var Page = $(this).attr('id'); 
			var CID = '<?php echo $CID;?>'; 
			var Div = '#tr_'+ID;
			if (confirm("هــل تـريـد الإسـتـمـرار فـي عـمـلــيـة الـمـسسـح؟")) {
			$.post('<?php echo __LINK_PATH;?>admin_search/delete_selected_country_user/AJAX/Y/',{ID:ID,Page:Page,CID:CID},function(data){
				$(Div).remove();
				var Record_Number = '<?php echo $Total_Records;?>';
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
			var CID = '<?php echo $CID;?>';
			$.post('<?php echo __LINK_PATH;?>admin_search/country_search_log/AJAX/Y/',{Page:Page,CID:CID},function(data){
				$('#Container').html(data);
				$('#Product_Container').hide().delay(300).fadeIn();
				});
			});	
		jQuery.leave = function(){
		var Page = '<?php echo $Page;?>';
		var CID = '<?php echo $CID;?>';
			$.post('<?php echo __LINK_PATH;?>admin_search/country_search_log/Level/5/AJAX/Y/',{Page:Page,CID:CID},function(data){
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
</style>
<div id="Product_Container">
<?php
if(count($ID_Array)&& is_array($ID_Array))
	{
		$Color_Array = array('#F5F5F5','#CCDAE3');
		$Counter = 0;
		?>
		<div dir="rtl"><span>عــدد الـسـجـلات</span><span style="margin-right:10px " id="Record_Number"><?php echo $Total_Records;?></span></div>
		<div style="line-height:12px ">&nbsp;</div>
		<table style=" width:100%; text-align:center; line-height:30px;" cellpadding="0" cellspacing="0" class="style1" dir="ltr">
		  <tr>
			<td width="7%" class="table-orange" style="height: 40px;" >مـسـح</td>
			<td width="8%" class="table-orange" style="height: 40px;">تـعــديـل</td>
			<td width="14%" class="table-orange" style="height: 40px;">كـلـمــة الـسـر</td>
			<td width="17%" class="table-orange" style="height: 40px;">بـواسـطـة</td>
			<td width="15%" class="table-orange" style="height: 40px;">تـاريـخ الإدخــال</td>
			<td width="13%" class="table-orange" style="height: 40px;">الـبـلــد</td>
			<td width="26%" class="table-orange" style="height: 40px;">الـبـريـد الإلـكـتـرونــي</td>
		  </tr>
		<?php
		$Index = 0;
		foreach($ID_Array as $value)
			{
				
						?>
					 	<tr style="padding-top:4px;" class="table-orange2 " id="tr_<?php echo $ID_Array[$Index];?>">
						<td style="padding-top:4px;" class="table-orange2"><img style="cursor:pointer " src="<?php echo __SCRIPT_PATH;?>images/del.png" width="20" height="20" class="Del_Btn_Main" id="<?php echo $ID_Array[$Index];?>"></td>
						<td style="padding-top:4px;" class="table-orange2"><img style="cursor:pointer " src="<?php echo __SCRIPT_PATH;?>images/edit.png" width="20" height="20" onClick="$.editData('تـعـديـل مـعـلـومـات الإداري','<?php echo __LINK_PATH;?>members/edit_selected/Member/<?php echo $ID_Array[$Index];?>/Level/5/AJAX/Y/',950,300)"></td>
						<td style="padding-top:4px;" class="table-orange2"><img style="cursor:pointer " src="<?php echo __SCRIPT_PATH;?>images/pw.png" onClick="$.editData('تـعـديـل كـلـمـة الـسـر','<?php echo __LINK_PATH;?>members/edit_pw/Member/<?php echo $ID_Array[$Index];?>/AJAX/Y/',950,200)" /></td>
						<td style="padding-top:4px;" class="table-orange2"><?php echo $Full_Name[$Index];?></td>
						<td style="padding-top:4px;" class="table-orange2"><?php echo $Time_Stamp[$Index];?></td>
						<td style="padding-top:4px;" class="table-orange2"><?php echo $Country_Name[$Index];?></td>
						<td style="padding-top:4px;" class="table-orange2"><?php echo $Users[$Index];?></td>
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
</div>