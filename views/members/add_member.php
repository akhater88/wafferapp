<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
$Form = new forms();
$URL = new url();
$S = $URL->getPar('add');
if($S != 's')
	{
		unset($_SESSION['Errors']);
		unset($_SESSION['First_Name']);
		unset($_SESSION['Last_Name']);
		unset($_SESSION['user_name']);
		unset($_SESSION['password']);
		unset($_SESSION['password_2']);
		//unset($_SESSION['mobile']);
		unset($_SESSION['Level']);
	}
?>
<div align="center" style="width:900px; line-height:25px; font-size:15px; font-weight:bold ">
<div>&nbsp;</div>
<?php
if(!isset($_SESSION['Errors']) && ($S == 'v'))
	{
	?>
	<div align="right" class="Success">لـقـد تـم إدخـال مـعـلـومـاتـك بـنـجـاح</div>
	<?php
	}

?>
<form action="<?php echo __LINK_PATH;?>members/submit" method="post">
<table width="100%"  border="0">
  <tr>
    <td width="62%">
	<div align="right" class="Errors">
	<?php
	if(isset($_SESSION['Errors']['First_Name']))
		{
			echo $_SESSION['Errors']['First_Name'];
		}
	?>
	</div>
	</td>
    <td width="19%"><div align="right"><?php $Form->Text_Field_Table('First_Name','Arabic','50','','');?></div></td>
    <td width="19%"><div align="right">: الإســم</div></td>
  </tr>
  <tr>
    <td>
	<div align="right" class="Errors">
	<?php
	if(isset($_SESSION['Errors']['Last_Name']))
		{
			echo $_SESSION['Errors']['Last_Name'];
		}
	?>
	</div>
	</td>
    <td><div align="right"><?php $Form->Text_Field_Table('Last_Name','Arabic','50','','');?></div></td>
    <td><div align="right">: إسـم الـعـائـلــة</div></td>
  </tr>
  <tr>
    <td>
	<div align="right" class="Errors">
	<?php
	if(isset($_SESSION['Errors']['user_name']))
		{
			echo $_SESSION['Errors']['user_name'];
		}
	?>
	</div>
	</td>
    <td><div align="right"><?php $Form->Text_Field_Table('user_name','Arabic','50','','');?></div></td>
    <td><div align="right">: إســم الـمسـتـخـدم</div></td>
  </tr>
  <tr>
    <td>
	<div align="right" class="Errors">
	<?php
	if(isset($_SESSION['Errors']['password']))
		{
			echo $_SESSION['Errors']['password'];
		}
	?>
	</div>
	</td>
    <td><div align="right"><?php $Form->Text_Field_Table('password','Arabic','50','password','');?></div></td>
    <td><div align="right">: كـلـمـة الـسـر</div></td>
  </tr>
  <tr>
    <td>
	<div align="right" class="Errors">
	<?php
	if(isset($_SESSION['Errors']['password_2']))
		{
			echo $_SESSION['Errors']['password_2'];
		}
	?>
	</div>
	</td>
    <td><div align="right"><?php $Form->Text_Field_Table('password_2','Arabic','50','password','');?></div></td>
    <td><div align="right">: تأكـيـد كـلـمـة الـسر</div></td>
  </tr>
 
   <tr>
    <td>
	<div align="right" class="Errors">
	<?php
	if(isset($_SESSION['Errors']['Level']))
		{
			echo $_SESSION['Errors']['Level'];
		}
	?>
	</div>
	</td>
    <td><div align="right"><?php $Form->Drop_Down_Table('user_level','Level','Level','Arabic','1');?></div></td>
    <td><div align="right">: الـصـلاحـيـات</div></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><div align="right"><input type="submit" name="Submit" value="إرسـال" class="Submit_BTN"></div></td>
    <td>&nbsp;</td>
  </tr>
</table>
</form>
</div>