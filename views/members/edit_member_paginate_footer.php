<div align="right">
<table align="right" cellpadding="2" cellspacing="0" dir="rtl">
<tr>
<?php
if ($Page < 1) 
	{ 
		$Page = 1; 
	} 
elseif ($Page > $Last) 
	{ 
		$Page = $Last; 
	}
if($Last > 1)
	{
		for($i = 0; $i<$Last; $i++)
			{
				$next = $i+1;
				if($Page != $i+1)
				{
				?>
				<td><div style="margin-right:5px"><a href="<?php echo __LINK_PATH;?>members/edit/Page/<?php echo $next;?>"><?php echo $i+1;?></a></div></td>
				<?php
				}
			else
				{
				?>
				<td><div style="margin-right:5px "><?php echo $i+1;?></div></td>
				<?php
				}
				
			}
	}			
?>
</tr>
</table>
</div>
</div>