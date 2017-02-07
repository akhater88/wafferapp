<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<div align="right" style="width:800px; font-size:15px; font-weight:bold ">
<div>&nbsp;</div>
<?php
foreach($results as $rows)
	{
		$Offer_Title = stripslashes($rows->Offer_Title);
		$Offer_Content = stripslashes(strip_tags($rows->Offer_Content));
		$Start_Date = date('d-m-Y',strtotime($rows->Start_Date));
		$End_Date = date('d-m-Y',strtotime($rows->End_Date));
	}
?>
<table width="95%"  border="0" cellpadding="3" cellspacing="0">
<tr style="background-color:#CCDAE3 ">
     	<td><div align="right" ><?php echo $Offer_Title;?></div></td>
		<td width="19%"><div align="right" style="font-size:18px ">إســم الـعـرض</div></td>
 </tr>
 <tr style="background-color:#F5F5F5 ">
	 	<td><div align="right"><?php echo $Offer_Content;?></div></td>
		<td width="19%"><div align="right" style="font-size:18px ">مـحـتـوى الـعـرض</div></td>
</tr>
 <tr style="background-color:#CCDAE3 ">
	 	<td><div align="right"><?php echo $Start_Date;?></div></td>
		<td width="19%"><div align="right" style="font-size:18px ">تـاريـخ الـبـدء</div></td>
</tr>
 <tr style="background-color:#F5F5F5 ">
  		<td width="81%"><div align="right"><?php echo $End_Date;?></div></td>
  		<td width="19%"><div align="right" style="font-size:18px ">تـاريـخ الإنـتـهــاء</div></td>
 </tr>

</table>

</div>