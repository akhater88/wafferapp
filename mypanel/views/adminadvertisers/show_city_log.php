<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<div align="right" style="width:800px; font-size:15px; font-weight:bold ">
<div>&nbsp;</div>
<?php
foreach($results as $rows)
	{
		$City_Name = stripslashes($rows->City_Name);
	}
?>
<table width="95%"  border="0" cellpadding="3" cellspacing="0">
 	<tr style="background-color:#CCDAE3 ">
  		<td width="78%"><div align="right"><?php echo $City_Name;?></div></td>
  		<td width="22%"><div align="right" style="font-size:18px ">إسـم الـبـلــد</div></td>
	 </tr>

</table>

</div>