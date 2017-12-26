<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<div id="Container_Mobile">
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
			$.post('<?php echo __LINK_PATH;?>admin_search/delete_selected_mobile_user_single/AJAX/Y/',{ID:ID},function(data){
				$(Div).remove();
				
				});
			}
			});	
			
			
		jQuery.leave = function(){
			$.post('<?php echo __LINK_PATH;?>admin_search/display_specific_mobile_user/AJAX/Y/',{Email:'<?php echo $ID;?>'},function(data){
					$('#Container_Mobile').html(data);
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
<div id="Product_Container">

		<div style="line-height:12px ">&nbsp;</div>
		<table style=" width:100%; text-align:center; line-height:30px;" cellpadding="0" cellspacing="0" class="style1" dir="ltr">
		  <tr>
			<td width="10%" class="table-orange" style="height: 40px;">مـسـح</td>
			<td width="10%" class="table-orange" style="height: 40px;">تـعــديـل</td>
			<td width="14%" class="table-orange" style="height: 40px;">كـلـمــة الـسـر</td>
			<td width="18%" class="table-orange" style="height: 40px;">تـاريـخ الإدخــال</td>
			<td width="18%" class="table-orange" style="height: 40px;">الـبــلــد</td>
			<td width="30%" class="table-orange" style="height: 40px;">الـبـريـد الإلكـتـرونـي</td>
		  </tr>
		 	<tr id="tr_<?php echo $ID;?>">
						<td style="padding-top:4px;" class="table-orange2"><img style="cursor:pointer " src="<?php echo __SCRIPT_PATH;?>images/del.png" width="20" height="20" class="Del_Btn_Main" id="<?php echo $ID;?>"></td>
						<td style="padding-top:4px;" class="table-orange2"><img style="cursor:pointer " src="<?php echo __SCRIPT_PATH;?>images/edit.png" width="20" height="20" onClick="$.editData('تـعـديـل مـعـلــومـات الـعـمـيــل','<?php echo __LINK_PATH;?>mobile_users/edit_selected_mobile_user/Member/<?php echo $ID;?>/AJAX/Y/',950,350)"></td>
						<td style="padding-top:4px;" class="table-orange2"><img style="cursor:pointer " src="<?php echo __SCRIPT_PATH;?>images/pw.png" onClick="$.editData('تـعـديـل كـلـمـة الـسـر','<?php echo __LINK_PATH;?>members/edit_pw/Member/<?php echo $ID;?>/AJAX/Y/',950,200)" /></td>
						<td style="padding-top:4px;" class="table-orange2"><?php echo  date('d-m-Y',strtotime($MyData['Time_Stamp']));?></td>
						<td style="padding-top:4px;" class="table-orange2"><?php echo $MyData['Country_Name'];?></td>
						<td style="padding-top:4px;" class="table-orange2"><?php echo $MyData['Email'];?></td>
					  	</tr>
					
  			</table>
			
			

</div>
</div>
</div>