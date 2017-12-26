<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript">
        $(document).ready(function() {
			$('#Level').change(function(){
			var ID = $(this).val(); 
			$.post('<?php echo __LINK_PATH;?>members/show_members_form/AJAX/Y/',{ID:ID},function(data){
				$('#Container').html(data);
			});
		});
        
		});
</script>
<table style="width: 100%" cellspacing="0" cellpadding="0">
<tr>
<td valign="top" style="width: 658px">
<div id="header"><img alt="" src="<?php echo __SCRIPT_PATH;?>images/header1.jpg" width="571" height="251" /></div>

<div id="services-waffer">
	<table cellspacing="0" cellpadding="0">
		<tr>
			<td style="padding-right:3px;"><a onmouseover="document.services4.src='<?php echo __SCRIPT_PATH;?>images/services4-on.png'" onmouseout="services4.src='<?php echo __SCRIPT_PATH;?>images/services4-off.png'" href="#z">
			<img name="services4" border="0" src="<?php echo __SCRIPT_PATH;?>images/services4-off.png" width="106" height="90"/></a></td>
			<td style="padding-right:3px;"><a onmouseover="document.services3.src='<?php echo __SCRIPT_PATH;?>images/services3-on.png'" onmouseout="services3.src='<?php echo __SCRIPT_PATH;?>images/services3-off.png'" href="#z">
			<img name="services3" border="0" src="<?php echo __SCRIPT_PATH;?>images/services3-off.png" width="106" height="90"/></a></td>
			<td style="padding-right:3px;"><a onmouseover="document.services2.src='<?php echo __SCRIPT_PATH;?>images/services2-on.png'" onmouseout="services2.src='<?php echo __SCRIPT_PATH;?>images/services2-off.png'" href="#z">
			<img name="services2" border="0" src="<?php echo __SCRIPT_PATH;?>images/services2-off.png" width="106" height="90"/></a></td>
			<td><a onmouseover="document.services1.src='<?php echo __SCRIPT_PATH;?>images/services1-on.png'" onmouseout="services1.src='<?php echo __SCRIPT_PATH;?>images/services1-off.png'" href="sub1.htm">
			<img name="services1" border="0" src="<?php echo __SCRIPT_PATH;?>images/services1-off.png" width="106" height="90"/></a></td>
		</tr>
	</table>
</div>

<div id="test-all">
<div id="text-titles">
<table style="width: 100%" cellspacing="0" cellpadding="0">
<tr><td align="center" valign="middle">
				<img alt="" src="<?php echo __SCRIPT_PATH;?>images/how-work-tit.png" width="108" height="30" /></td></tr></table>
</div>
<div id="text-middle">
	<?php
if(isset($_SESSION['Arabic']))
	{
		$Dir = 'rtl';
	}
else
	{
		$Dir = 'ltr';
	}
?>
<div>&nbsp;</div>
<table width="100%"  border="0" cellpadding="3" cellspacing="0" dir="ltr">
  <tr>
    <td width="86%">
	<div align="right">
	<select id="Level" dir="<?php echo $Dir;?>">
	<option value="0" selected>--إخـتـر مـن الـقـائـمــة--</option>
	<?php
	foreach($results as $rows)
		{
		?>
		<option value="<?php echo $rows->ID;?>"><?php echo $rows->Level;?></option>
		<?php
		}
	?>
	</select>
	</div>
	</td>
    <td width="14%"><div align="right">نــوع الإداري</div></td>
  </tr>
</table>
<div id="Container"></div>
</div>
<div class="text-bottom">
	<img alt="" src="<?php echo __SCRIPT_PATH;?>images/text-bottom.png" width="614" height="9" /></div>
</div>

</td>
<td valign="top" style="width: 288px">
<div id="download-bg">
<div class="download-icons">
<a onmouseover="document.iphone.src='<?php echo __SCRIPT_PATH;?>images/iphone-on.png'" onmouseout="document.iphone.src='<?php echo __SCRIPT_PATH;?>images/iphone-off.png'" href="#z">
<img name="iphone" border="0" src="<?php echo __SCRIPT_PATH;?>images/iphone-off.png" width="107" height="31"/></a>
</div>
<div class="download-icons">
<a onmouseover="document.android.src='<?php echo __SCRIPT_PATH;?>images/android-on.png'" onmouseout="document.android.src='<?php echo __SCRIPT_PATH;?>images/android-off.png'" href="#z">
<img name="android" border="0" src="<?php echo __SCRIPT_PATH;?>images/android-off.png" width="107" height="31"/></a>
</div>
<div class="download-icons">
<a onmouseover="document.ovi.src='<?php echo __SCRIPT_PATH;?>images/ovi-on.png'" onmouseout="document.ovi.src='<?php echo __SCRIPT_PATH;?>images/ovi-off.png'" href="#z">
<img name="ovi" border="0" src="<?php echo __SCRIPT_PATH;?>images/ovi-off.png" width="106" height="31"/></a>
</div>
<div class="download-icons">
<a onmouseover="document.blackberry.src='<?php echo __SCRIPT_PATH;?>images/blackberry-on.png'" onmouseout="document.blackberry.src='<?php echo __SCRIPT_PATH;?>images/blackberry-off.png'" href="#z">
<img name="blackberry" border="0" src="<?php echo __SCRIPT_PATH;?>images/blackberry-off.png" width="107" height="31"/></a>
</div>
</div>

<div id="right-menu">
<div id="menu-title">
	<img alt="" src="<?php echo __SCRIPT_PATH;?>images/inner-menu.png" width="159" height="36" /></div>
<div id="menu-middle">
<?php
$myfunctions = new myfunctions();
$myfunctions->check_credentials('1');
?>

</div>
<div class="menu-bottom"><img alt="" src="<?php echo __SCRIPT_PATH;?>images/right-menu-bottom.png" width="297" height="9" /></div>
</div>
</td>
</tr>
</table>