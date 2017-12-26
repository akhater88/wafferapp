<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<div align="center" style="width:900px; line-height:25px; font-size:15px; font-weight:bold ">
<script type="text/javascript" src="<?php echo __SCRIPT_PATH;?>js/jquery-1.4.2.min.js"></script>
<script type="text/javascript"> 
	$(document).ready(function() { 
	
		$('#Level').change(function(){
			var ID = $(this).val(); 
			$.post('<?php echo __LINK_PATH;?>sales/show_members_form/AJAX/Y/',{ID:ID},function(data){
				$('#Container').html(data);
			});
		});
			
	});
</script>
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
<table width="100%"  border="0" cellpadding="3" cellspacing="0">
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
