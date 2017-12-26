
<?php
$Time_Stamp = date('m_d_Y').time();
$Display =  new sql();

?>
<div id="text-titles">
<table style="width: 100%" cellspacing="0" cellpadding="0">
	<tr>
		<td align="center" valign="middle">
				<img alt="" src="<?php echo __SCRIPT_PATH?>images/my-account.png" width="64" height="26" />
		</td>
	</tr>
</table>
</div>
<div id="text-middle">

<div id="name-login">أهلا بك،<?php echo $_SESSION['Mobile_User_Name'];?></div>
<div id="login-tabs">
	<?php 
	$myfunctions = new myfunctions();
	$myfunctions->display_mobile_menu('4');
	?>
</div>
<div id="cards_list">
<table style="width: 100%; border:0px; margin-top:20px; margin-bottom:20px; line-height:25px;" cellpadding="0" cellspacing="0">
	<tr>
		<td style=" border-left:1px #fff dotted; height: 25px; background-color:#8c8b8b; color:#fff; " align="center">
		الشعار</td>
		<td style="height: 25px; background-color:#8c8b8b; color:#fff;" align="center">فئات البطاقات</td>
		<td style="height: 25px; background-color:#8c8b8b; color:#fff;" align="center">
		رقم البطاقة</td>
		<td style="height: 25px; background-color:#8c8b8b; color:#fff;" align="center">
		التاريخ</td>
	</tr>
	<?php 
	if(count($results)&& is_array($results))
	{
	foreach($results as $rows)
			{
				$sql = "SELECT * FROM cards_english WHERE ID = ? AND Status = ?";
				$Execute_Array_card = array($rows->CID,'2');
				$card_num = $Display->Display_Single_Info($sql,'card_num',$Execute_Array_card);
				$cardCat_ID = $Display->Display_Single_Info($sql,'cardCat_ID',$Execute_Array_card);
				$sql = "SELECT * FROM cardCat WHERE ID = ? AND Status != ?";
				$Execute_Array_cat = array($cardCat_ID,'0');
				$company_ID = $Display->Display_Single_Info($sql,'company_ID',$Execute_Array_cat);
				$cat = $Display->Display_Single_Info($sql,'cat',$Execute_Array_cat);
	?>
	<tr>
		<td style="height: 60px; border-left:1px #8c8b8b dotted; border-bottom:1px #8c8b8b dotted; " align="center">
			<?php 
			$Display = new sql();
			$sql = "SELECT image_logo FROM Company WHERE ID = ? ";
			$Execute_Array = array($company_ID);
			$image = $Display->Display_Single_Info($sql,'image_logo',$Execute_Array);
			?>
			<img alt="" src="<?php echo __IMAGE_PATH?>companyLogos/<?php echo $image?>" width="33" height="45" />
		</td>
		<td style="height: 60px; border-bottom:1px #8c8b8b dotted; border-left:1px #8c8b8b dotted;" align="center">
		<?php echo $cat;?>
		</td>
		<td style="height: 60px; border-bottom:1px #8c8b8b dotted;border-left:1px #8c8b8b dotted; " align="center">
		<?php echo $card_num?>
		</td>
		<td style="height: 60px; border-bottom:1px #8c8b8b dotted; " align="center">
		<?php echo $rows->date; ?>
		</td>
		
	</tr>
	<?php 
			}
	}
	?>
	
</table>
</div>
</div>
