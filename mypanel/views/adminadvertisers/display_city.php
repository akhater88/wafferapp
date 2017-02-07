
<?php

if(isset($_SESSION['Arabic']))
	{
		$Dir = 'rtl';
		$Lang = 'ar';
	}
else
	{
		$Dir = 'ltr';
		$Lang = 'eng';
	}
?>
<table width="100%">
	<tr>
    	<td><div align="right">
		<select id="City" name="City">
		<option value="0" selected>--إخـتـر مـن الـقـائـمــة--</option>
		<?php
		foreach($results as $rows)
			{
			?>
			<option value="<?php echo $rows->ID;?>"><?php echo $rows->City_Name;?></option>
			<?php
			}
		?>
		</select>
		</div></td>
   	  <td width="13%"><div align="right">الـمـديـنــة</div></td>
	</tr>
</table>  	
