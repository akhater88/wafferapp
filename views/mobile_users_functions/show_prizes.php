
<?php
$Time_Stamp = date('m_d_Y').time();
$Dislay =  new sql();

?>
<script type="text/javascript">
$(document).ready(function() {
		
	
	 
	
	$('#company_ID').change(function(){
			var company_ID = $(this).val();
			$.post('<?php echo __LINK_PATH;?>mobile_users_functions/get_prize/AJAX/Y/',{company_ID:company_ID,Time_Stamp:'<?php echo $Time_Stamp;?>'},function(data){
				setTimeout('$.fn.myFunction()',100);
			    $.fn.myFunction = function() { 
						$.getJSON('<?php echo __SCRIPT_PATH;?>json/<?php echo $Time_Stamp;?>.json',function(json){
						var Flag = json.flag;
						if(Flag == '1')
							{
								alert('الرجاء اختيار اسم شركة');
								$('#Sub_Container').html('');
							}
						else
							{
								
							$('#Sub_Container').html(data);
										
							}
						
						});
					}
				});
			});



});


	
</script>
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
	$myfunctions->display_mobile_menu('3');
	?>
</div>

<div id="login-content">
<?php
$Counter = 0;
$sql = 'SELECT ID,Name,image_logo FROM Company WHERE Status = ?';
$Execute_Array = array('1');
$results = $Dislay->Display_Info($sql,$Execute_Array);
if(count($results))
	{
		?>
		<select name="company_ID" id="company_ID" style="height: 25px; border:1px #bebfc0 solid; width: 189px; font-family:Tahoma; font-size:14px;">

		<option value="0">اختار شركة</option>
		<?php
		foreach($results as $rows)
			{
			?>
			<option value="<?php echo $rows->ID;?>"><?php echo $rows->Name;?></option>
			<?php
			$Counter++;
			}
		?>
		</select>
		<?php
	}
?>

<div id="Sub_Container">
</div>
</div>
</div>