<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<div class="packages-text">أنـت مـشـتـرك فـي الـخـدمـات الـتـالـيــة:</div>
<div id="services-box">
<div class="services-tit"><?php echo $Ads_Cat_Name;?></div>
<div class="services-text">
<?php
if(count($Sub_Cat_Services))
	{
		
		foreach($Sub_Cat_Services as $value)
			{
				echo $value.'<BR />';
			}
		
	}
?>
</div>
</div>
<div id="date-box">
<table style="width: 100%" cellpadding="0" cellspacing="0" class="style1">
	<tr>
		<td style="width: 230px; padding-right:26px">تـاريـخ <span class="brown-color">بـدء</span> إشـتـراكـك</td>
		<td style="padding-right:15px"><?php echo $Starts_Date;?></td>
	</tr>
	<tr>
		<td style="width: 230px; padding-right:26px; padding-top:3px;">تـاريـخ <span class="brown-color">إنـتـهــاء</span> إشـتـراكـك</td>
		<td style="padding-right:15px;padding-top:3px;"><?php echo $End_Date;?></td>
	</tr>
</table>
</div>
<div id="num-box">
<table style="width: 100%" cellpadding="0" cellspacing="0" class="style1">
	<tr>
		<td class="table-White">
		<img alt="" src="images/arrow.jpg" width="3" height="5" /> عـدد الـرسـائـل <span class="brown-color">الـمـفـعـلــة</span></td>
		<td class="table-White2" style="width: 60px" align="left" ><span style="cursor:pointer " onClick="RedirectModified('<?php echo __LINK_PATH.'advertisers/active_offer/';?>')"><?php echo $Total_Active_Messages;?></span></td>
	</tr>
	<tr>
		<td class="table-White">
		<img alt="" src="images/arrow.jpg" width="3" height="5" /> عـدد الـرسـائـل <span class="brown-color">الـمـرجـعــة</span></td>
		<td class="table-White2" style="width: 60px" align="left" ><span style="cursor:pointer " onClick="RedirectModified('<?php echo __LINK_PATH.'advertisers/returned_offer/';?>')"><?php echo $Total_Returned_Messages;?></span></td>
	</tr>
	<tr>
		<td class="table-White">
		<img alt="" src="images/arrow.jpg" width="3" height="5" /> عـدد الـرسـائـل <span class="brown-color">الـمـنـتـهـيــة</span></td>
		<td class="table-White2" style="width: 60px" align="left" ><span style="cursor:pointer " onClick="RedirectModified('<?php echo __LINK_PATH.'advertisers/expired_offer/';?>')"><?php echo $Total_Expired_Messages;?></span></td>
	</tr>
	<tr>
		<td class="table-White">
		<img alt="" src="images/arrow.jpg" width="3" height="5" /> عـدد الـرسـائـل <span class="brown-color">قـيـد الـنـشـر</span></td>
		<td class="table-White2" style="width: 60px" align="left" ><span style="cursor:pointer " onClick="RedirectModified('<?php echo __LINK_PATH.'advertisers/pending_offer/';?>')"><?php echo $Total_Pending_Messages;?></span></td>
	</tr>
	</table>
	
	
</div>
