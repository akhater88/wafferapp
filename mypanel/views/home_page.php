<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
$URL = @new url();
$S = $URL->getPar('home_page');
if($S != 's')
	{
		unset($_SESSION['Errors']);
	}

?>
<div>&nbsp;</div>
<div align="center">
<div class="Log_In_Box">

<div id="Log_In_Box_Body">
<?php
if(isset($_SESSION['Errors']) && ($S == 's'))
	{
	?>
	<div align="right" style=" position:absolute; font-size:16px; font-weight:bold; color:#FF0000; top:40px; right:180px "><?php echo $_SESSION['Errors']['LogIn'];?></div>
	<?php
	}
?>
<form action="<?php echo __LINK_PATH;?>index/login" method="post" name="form1" id="form1">
<div style="width:500px;position:relative; top:50px; line-height:25px ">
<div align="right" style="color:#000000; font-size:16px; font-weight:bold; margin-right:100px"><span><input name="User_Name" type="text" class="Arabic" id="User_Name" AUTOCOMPLETE="off">
</span>: إســم الـمـسـتـخـدم</div>
<div align="right" style="color:#000000; font-size:16px; font-weight:bold; margin-right:100px"><span style="margin-right:22px "><input name="PW" type="password" class="Arabic" id="PW" AUTOCOMPLETE="off">
</span>: كـلـمــة الـسـر</div>
<div style="margin-right:60px "><input class="Submit_BTN" type="submit" name="Submit" value="إرســال">
</div>
</div>
</form>

</div>

</div>
</div>

