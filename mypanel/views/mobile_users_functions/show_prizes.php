<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<div id="Container">
<div align="right" style="width:900px; font-size:15px; font-weight:bold ">
<style>
.Paginate{
margin-right:5px;
cursor:pointer;
color:#0099FF;
}
</style>
<script type="text/javascript" src="<?php echo __SCRIPT_PATH;?>js/jquery-1.4.2.min.js"></script>
<script type="text/javascript"> 
	$(document).ready(function() { 
		$('.Paginate').click(function(){
			var Page = $(this).attr('id'); 
			$.post('<?php echo __LINK_PATH;?>mobile_users_functions/show_prizes/AJAX/Y/',{Page:Page},function(data){
				$('#Container').html(data);
				$('#Product_Container').hide().delay(300).fadeIn();
				});
			});	
	});
</script>
<div id="Product_Container">
<div style="line-height:15px ">&nbsp;</div>
<?php
if((is_array($results))&&(count($results)))
	{
		?>
		<table width="100%"  border="1" cellpadding="5" cellspacing="0" bordercolor="#333333">
		<tr bgcolor="#F5F5F5">
		  <td width="25%"><div align="center">حـجـز الـجـائـزة</div></td>
		  <td width="28%"><div align="center">عـدد الـنـقــاط الـمـطـلـوبــة</div></td>
		  <td width="47%"><div align="center">الـجـائــزة</div></td>
		</tr>
		<?php
		$Color_Array = array('#CCDAE3','#F5F5F5');
		$Counter = 0;
		foreach($results as $rows)
			{
				?>
				 <tr bgcolor="<?php echo $Color_Array[$Counter];?>">
				 <?php
				 if($Accum_Points >= $rows->Points)
				 	{
					?>
					<td><div align="center">حـجـز الـجـائـزة</div></td>
					<?php
					}
				else
					{
					?>
					<td><div align="center">----</div></td>
					<?php
					}
				 ?>
					
					<td><div align="center"><?php echo $rows->Points;?></div></td>
					<td><div align="center"><?php echo $rows->Prize_Name;?></div></td>
				</tr>
				<?php
				$Counter++;
				if($Counter > 1)
					{
						$Counter = 0;
					}
			}
			?>
	</table>
			<div style="line-height:12px">&nbsp;</div>
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
				?>
				<div dir="rtl" style="border-top:1px solid #CCCCCC">
				<?php
				for($i = 0; $i<$Last; $i++)
					{
						$next = $i+1;
						if($Page != $i+1)
						{
						?>
						<span class="Paginate" id="<?php echo $next;?>"><?php echo $i+1;?></span>
						<?php
						}
					else
						{
						?>
						<span style="margin-right:5px "><?php echo $i+1;?></span>
						<?php
						}
						
					}
					?>
	</div>
					<?php
			}
	}
?>
</div> <! -- End product container div !-->

</div><! -- End Container div !-->