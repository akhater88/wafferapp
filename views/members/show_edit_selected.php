<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<div align="center" style="width:900px; font-size:15px; font-weight:bold ">
<?php
$Time_Stamp = date('m_d_Y').time();
?>
<script type="text/javascript" src="<?php echo __SCRIPT_PATH;?>js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="<?php echo __SCRIPT_PATH;?>js/datepicker.js"></script>
<link rel="stylesheet" href="<?php echo __SCRIPT_PATH;?>css/datepicker.css" type="text/css" />
<script type="text/javascript"> 
	$(document).ready(function() { 
		
		
	});
</script>
<style>
.Submit_Main_BTN_Add{
width:80px;
height:25px;
background-color:#000066;
color:#FFFFFF;
cursor:pointer;
}

</style>
<?php
$Display = new sql();
if(isset($_SESSION['Arabic']))
	{
		$Dir = 'rtl';
		$Table_Country = 'country';
		$Table_Cat = 'ads_cat';
		
	}
else
	{
		$Dir = 'ltr';
		$Table_Country = 'country_english';
		$Table_Cat = 'ads_cat_english';
	}
foreach($results as $rows)
	{
		$First_Name = $rows->First_Name;
		$Last_Name = $rows->Last_Name;
		$user_name = $rows->user_name;
		$Level = $rows->Level;
		$Company_Name = $rows->Company_Name;
		$Phone_Number = $rows->Phone_Number;
		$Cell_Phone = $rows->Cell_Phone;
		$Sender_Name = $rows->Sender_Name;
		$Address = stripslashes($rows->Address);
		$Starts_Date = $rows->Starts_Date;
		$End_Date = $rows->End_Date;
		if($Starts_Date == NULL)
			{
				$Starts_Date = date('d-m-Y');
			}
		else
			{
				$Starts_Date = date('d-m-Y',strtotime($Starts_Date));
			}
		if($End_Date == NULL)
			{
				$End_Date = date('d-m-Y');
			}
		else
			{
				$End_Date = date('d-m-Y',strtotime($End_Date));
			}
		$Ads_Cat = $rows->Ads_Cat;
		$Country = $rows->Country;
		$sql = 'SELECT Name FROM '.$Table_Country.' WHERE ID = ?';
		$Execute_Array = array($Country);
		$Country_Name = $Display->Display_Single_Info_Modified($sql,'Name',$Execute_Array);
		
		$sql = 'SELECT Cat_Name FROM '.$Table_Cat.' WHERE ID = ?';
		$Execute_Array = array($Ads_Cat);
		$My_Cat_Name = $Display->Display_Single_Info_Modified($sql,'Cat_Name',$Execute_Array);
	}
$Today = date('d-m-Y');
?>
<table width="100%"  border="0" cellpadding="3" cellspacing="0">
  <tr>
    <td width="83%">
	<div align="right"><?php echo $First_Name;?></div>
	</td>
    <td width="17%"><div align="right">الإســم</div></td>
  </tr>
   <tr>
    <td width="83%">
	<div align="right" dir="rtl"><?php echo $user_name;?></div>
	</td>
    <td width="17%"><div align="right">إســم الـمــستـخـدم</div></td>
  </tr>
  
  <?php
  if($Level == '2')
  	{
	?>
	<tr>
    	<td width="83%"><div align="right"><?php echo $Company_Name;?></div></td>
    	<td width="17%"><div align="right">إسـم الـشركــة</div></td>
  	</tr>
	<tr>
    	<td width="83%"><div align="right"><?php echo $Phone_Number;?></div></td>
    	<td width="17%"><div align="right">رقـم الـهـاتـف</div></td>
  	</tr>
	<tr>
    	<td width="83%"><div align="right"><?php echo $Cell_Phone;?></div></td>
    	<td width="17%"><div align="right">رقـم الـجـوال</div></td>
  	</tr>
	<tr>
    	<td width="83%"><div align="right"><?php echo $Sender_Name;?></div></td>
    	<td width="17%"><div align="right">إسـم الـمـرســل</div></td>
  	</tr>
	<tr>
    	<td width="83%"><div align="right"><?php echo $Address;?></div></td>
    	<td width="17%"><div align="right">الـعــنــوان</div></td>
  	</tr>
	<tr>
    	<td width="83%"><div align="right"><?php echo $Starts_Date;?></div></td>
    	<td width="17%"><div align="right">تـاريـخ بـدء الإشـتـراك</div></td>
  	</tr>
	<tr>
    	<td width="83%"><div align="right"><?php echo $End_Date;?></div></td>
    	<td width="17%"><div align="right">تـاريـخ إنـتـهـاء الإشـتـراك</div></td>
  	</tr>
	<tr>
    	<td width="83%"><div align="right"><?php echo $My_Cat_Name;?></div></td>
    	<td width="17%"><div align="right">الـتـصـنـيـف الـدعـائــي</div></td>
  	</tr>
	<tr>
    	<td width="83%"><div dir="rtl">
		<?php
		foreach($results_services as $rows_services)
			{
				if(in_array($rows_services->ID,$Merchant_Services))
					{
					?>
					<span><input class="CheckAll" name="SID" type="checkbox" value="<?php echo $rows_services->ID;?>" checked readonly></span><span style="margin-right:12px "><?php echo $rows_services->Sub_Cat_Name;?></span>
					<?php
					}
				else
					{
					?>
					<span><input class="CheckAll" name="SID" type="checkbox" value="<?php echo $rows_services->ID;?>" readonly></span><span style="margin-right:12px "><?php echo $rows_services->Sub_Cat_Name;?></span>
					<?php
					}
			}
		?>
    	</div></td>
    	<td width="17%"><div align="right">الـخـدمــات</div></td>
  	</tr>
	<tr>
    	<td width="83%"><div align="right"><?php echo $Country_Name;?></div></td>
    	<td width="17%"><div align="right">الـبـلــد</div></td>
  	</tr>
	<tr>
    	<td width="83%"><div align="right"><?php echo $Amount;?>
    	</div></td>
    	<td width="17%"><div align="right">الـمـبـلــغ الـمـدفــوع</div></td>
  		</tr>
	<?php
	}
	if(($Level == '3')||($Level == '4') ||($Level == '5'))
		{
		?>
		<tr>
    	<td width="83%"><div align="right">
		<select id="Country_Name" name="Country_Name" dir="<?php echo $Dir;?>">
		<option value="0" selected>--إخـتـر مـن الـقـائـمــة--</option>
		<?php
		foreach($results_country as $rows_country)
			{
				if($rows_country->ID == $Country)
					{
					?>
					<option value="<?php echo $rows_country->ID;?>" selected><?php echo $rows_country->Name;?></option>
					<?php
					}
				else
					{
					?>
					<option value="<?php echo $rows_country->ID;?>"><?php echo $rows_country->Name;?></option>
					<?php
					}
			}
		?>
		</select>
    	</div></td>
    	<td width="17%"><div align="right">الـبـلــد</div></td>
  		</tr>
		<?php
		}
  ?>
</table>
</div>