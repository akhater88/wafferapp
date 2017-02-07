<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<div align="right" style="width:800px; font-size:15px; font-weight:bold ">
<div>&nbsp;</div>
<?php
$Display = new sql();
foreach($results as $rows)
	{
		$Full_Name = $rows->First_Name.' '.$rows->Last_Name;
		$user_name = $rows->user_name;
		$Level = $rows->Level;
		$Company_Name = stripslashes($rows->Company_Name);
		$Phone_Number = $rows->Phone_Number;
		$Cell_Phone = $rows->Cell_Phone;
		$Email = $rows->Email;
		$Start_Date = date('d-m-Y',strtotime($rows->Starts_Date));
		$End_Date = date('d-m-Y',strtotime($rows->End_Date));
		$Ads_Cat = $rows->Ads_Cat;
		$Country = $rows->Country;
		if(isset($_SESSION['Arabic']))
			{
				$Table_Cat = 'ads_cat';
				$Table_Country = 'country';
			}
		else
			{
				$Table_Cat = 'ads_cat_english';
				$Table_Country = 'country_english';
			}
			
		$sql = 'SELECT Cat_Name FROM '.$Table_Cat.' WHERE ID = ?';
		$Execute_Array = array($Ads_Cat);
		$Cat_Name = $Display->Display_Single_Info_Modified($sql,'Cat_Name',$Execute_Array);
		
		$sql = 'SELECT Name FROM '.$Table_Country.' WHERE ID = ?';
		$Execute_Array = array($Country);
		$Country_Name = $Display->Display_Single_Info_Modified($sql,'Name',$Execute_Array);
		
	}
?>
<table width="95%"  border="0" cellpadding="3" cellspacing="0">
<tr style="background-color:#CCDAE3 ">
     	<td><div align="right" ><?php echo $Full_Name;?></div></td>
		<td width="22%"><div align="right" style="font-size:18px ">الإســم</div></td>
 </tr>
 <tr style="background-color:#F5F5F5 ">
	 	<td><div align="right"><?php echo $user_name;?></div></td>
		<td width="22%"><div align="right" style="font-size:18px ">إسـم الـمـستـخـدم</div></td>
</tr>
<?php
if($Level == '2')
	{
	?>
	<tr style="background-color:#CCDAE3 ">
	 	<td><div align="right"><?php echo $Company_Name;?></div></td>
		<td width="22%"><div align="right" style="font-size:18px ">إسـم الـشـركـة</div></td>
	</tr>
	<tr style="background-color:#F5F5F5 ">
	 	<td><div align="right"><?php echo $Phone_Number;?></div></td>
		<td width="22%"><div align="right" style="font-size:18px ">رقــم الـهـاتـف</div></td>
	</tr>
	<tr style="background-color:#CCDAE3 ">
	 	<td><div align="right"><?php echo $Cell_Phone;?></div></td>
		<td width="22%"><div align="right" style="font-size:18px ">رقـم الـجـوال</div></td>
	</tr>
	<tr style="background-color:#F5F5F5 ">
	 	<td><div align="right"><?php echo $Email;?></div></td>
		<td width="22%"><div align="right" style="font-size:18px ">الـبـريـد الإلـكـتـرونـي</div></td>
	</tr>
 	<tr style="background-color:#CCDAE3 ">
	 	<td><div align="right"><?php echo $Start_Date;?></div></td>
		<td width="22%"><div align="right" style="font-size:18px ">تـاريـخ الـبـدء</div></td>
	</tr>
	 <tr style="background-color:#F5F5F5 ">
  		<td width="78%"><div align="right"><?php echo $End_Date;?></div></td>
  		<td width="22%"><div align="right" style="font-size:18px ">تـاريـخ الإنـتـهــاء</div></td>
	 </tr>
	  <tr style="background-color:#CCDAE3 ">
  		<td width="78%"><div align="right"><?php echo $Cat_Name;?></div></td>
  		<td width="22%"><div align="right" style="font-size:18px ">الـتـصـنـيـف الـدعـائـي</div></td>
	 </tr>
	  <tr style="background-color:#F5F5F5 ">
  		<td width="78%"><div align="right"><?php echo $Country_Name;?></div></td>
  		<td width="22%"><div align="right" style="font-size:18px ">الـبـلـد</div></td>
	 </tr>
	<?php
	}
?>
</table>

</div>