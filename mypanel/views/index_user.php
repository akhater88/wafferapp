<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
$URL = new url();
$S = $URL->getPar('index');
if($S != 's')
	{
		unset($_SESSION['Errors']);
	}

?>
<div>&nbsp;</div>
<div align="right">
<table width="80%"  border="0">
  <tr>
    <td width="85%"><div align="right" style=" font-family:'Times New Roman', Times, serif; font-size:16px; font-weight:bold; color:#0066FF "><?php echo $_SESSION['User_Name_Session'];?></div></td>
    <td width="15%"><div align="right" style=" font-family:'Times New Roman', Times, serif; font-size:16px; font-weight:bold; color:#0066FF ">تـم تـسـجـيـل دخــول</div></td>
  </tr>
</table>
</div>

