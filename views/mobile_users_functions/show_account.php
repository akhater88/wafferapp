
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
	$myfunctions->display_mobile_menu('1');
	?>
</div>
<div id="login-content">مجموع النقاط الحالية :- <span class="color1"><?php echo $Accum_Points?></span><br />مجموع النقاط المستخدمة:-<span class="color2"><?php echo $All_Points-$Accum_Points?></span>

<table style="width: 100%; border:0px; margin-top:20px; margin-bottom:20px; line-height:25px;" cellpadding="0" cellspacing="0">
	<tr>
		<td style="height: 25px; background-color:#2771c1; color:#fff;" colspan="2" align="center" valign="middle">الأصدقـــــــــــــــــــــاء</td>
	</tr>
	<tr>
		<td style=" border-left:1px #fff dotted; height: 25px; width: 285px; background-color:#8c8b8b; color:#fff;" align="center" valign="middle">تمّ التّحميل<br/><?php echo $total_active?></td>
		<td style="height: 25px; width: 285px; background-color:#8c8b8b; color:#fff;" align="center" valign="middle">لم يتم التّحميل <br/><?php echo $total_inactive?></td>
	</tr>
	<tr>
		<td style="width: 285px; height: 22px;border-left:1px #8c8b8b dotted; border-bottom:1px #8c8b8b dotted;" align="center" valign="top">
		<table style="width: 100%; border:0px; margin-top:20px; margin-bottom:20px; line-height:25px;" cellpadding="0" cellspacing="0">
			<?php 
				foreach ($result_active as $rows)
				{
				?>
				<tr>
					<td style="width: 285px; height: 22px; border-bottom:1px #8c8b8b dotted;" align="center" valign="middle">
					<?php echo $rows->Email;?>
					</td>
				</tr>
				<?php 
				}
				?>
		</table>
		</td>
		<td style="height: 22px; border-bottom:1px #8c8b8b dotted;" align="center" valign="top">
			<table style="width: 100%; border:0px; margin-top:20px; margin-bottom:20px; line-height:25px;" cellpadding="0" cellspacing="0">
				<?php 
				foreach ($result_inactive as $rows)
				{
				?>
				<tr>
					<td style="height: 22px; border-bottom:1px #8c8b8b dotted;" align="center" valign="middle">
					<?php echo $rows->Email;?>
					</td>
				</tr>
				<?php 
				}
				?>
			</table>
		</td>
	</tr>
	
	</table>
</div>
</div>






