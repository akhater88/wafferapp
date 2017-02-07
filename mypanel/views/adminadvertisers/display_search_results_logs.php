<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<div>&nbsp;</div>
<?php
if(isset($_SESSION['Arabic']))
	{
		$Dir = 'rtl';
		$Lang = 'ar';
	}
else
	{
		$Dir = 'ltr';
		$Lang = 'eng';
	}

?>
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
			$(document).ready(function() { 
			
			$('#Start_Date').DatePicker({
			format:'d-m-Y',
			date: $('#Start_Date').val(),
			current: $('#Start_Date').val(),
			starts: 7,
			position: 'left',
			onBeforeShow: function(){
				$('#Start_Date').DatePickerSetDate($('#Start_Date').val(), true);
			},
			onChange: function(formated, dates){
				$('#Start_Date').val(formated);
			}
		});
			
		$('#End_Date').DatePicker({
			format:'d-m-Y',
			date: $('#End_Date').val(),
			current: $('#End_Date').val(),
			starts: 7,
			position: 'left',
			onBeforeShow: function(){
				$('#inputDate_2').DatePickerSetDate($('#End_Date').val(), true);
			},
			onChange: function(formated, dates){
				$('#End_Date').val(formated);
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
<div>&nbsp;</div>
<table width="100%"  border="1" cellpadding="2" cellspacing="0" bordercolor="#333333">
  <tr bgcolor="#ACCBE3">
  	<td width="14%"><div align="center" style="font-size:16px ">الـمـسـتـوى الإداري</div></td>
	 <td width="14%"><div align="center" style="font-size:16px ">إسـم الإداري</div></td>
	  <td width="30%"><div align="center" style="font-size:16px ">وصــف الـسـجـل</div></td>
	    <td width="13%"><div align="center" style="font-size:16px ">الـوقـت</div></td>
	  <td width="13%"><div align="center" style="font-size:16px ">الـتـاريـخ</div></td>
      <td width="16%"><div align="center" style="font-size:16px ">نـوع الـسـجـل</div></td>
  </tr>
 <?php
 $Display = new sql();
 foreach($results as $rows)
 	{
		$ID = $rows->ID;
		$RID = $rows->RID;
		$Table_Name = $rows->Table_Name;
		$Action = $rows->Action;
		$Time_Stamp = $rows->Time_Stamp;
		$OID = $rows->OID;
		$Log_Cat = stripslashes($rows->Log_Cat);
		
		$sql = 'SELECT Action_Name FROM actions WHERE ID = ?';
		$Execute_Array = array($Action);
		$Action_Name = $Display->Display_Single_Info_Modified($sql,'Action_Name',$Execute_Array);
		
		$Time_Stamp_Array = explode(' ',$Time_Stamp);
		$Date = date('d-m-Y',strtotime($Time_Stamp_Array[0]));
		$Time = $Time_Stamp_Array[1];
		//$Total_Time = $Date.' '.$Time;
		
		$sql = 'SELECT First_Name,Last_Name,Level FROM users WHERE ID = ?';
		$Execute_Array = array($OID);
		$results_user = $Display->Display_Info($sql,$Execute_Array);
		foreach($results_user as $rows_user)
			{
				$Full_Name = $rows_user->First_Name.' '.$rows_user->Last_Name;
				$Level = $rows_user->Level;
			}
			
		$sql = 'SELECT Level FROM user_level WHERE ID = ?';
		$Execute_Array = array($Level);
		$Level_Name = $Display->Display_Single_Info_Modified($sql,'Level',$Execute_Array);
		
		?>
		<tr>
			 <td><div align="center" style="font-size:16px "><?php echo $Level_Name;?></div></td>
			 <td><div align="center" style="font-size:16px "><?php echo $Full_Name;?></div></td>
			 <td><div align="center" style="font-size:16px; cursor:pointer; color:#0099FF " onClick="createWindowWithCallBack('مـعـلـومـات الـسـجــل','<?php echo __LINK_PATH;?>adminadvertisers/show_log_details/RecordId/<?php echo $RID;?>/LogId/<?php echo $ID;?>/AJAX/Y/',850,350)"><?php echo $Log_Cat;?></div></td>
			  <td><div align="center" style="font-size:16px "><?php echo $Time;?></div></td>
			 <td><div align="center" style="font-size:16px "><?php echo $Date;?></div></td>
			 <td><div align="center" style="font-size:16px "><?php echo $Action_Name;?></div></td>
		</tr>
		<?php
	}
 ?> 
 </table>