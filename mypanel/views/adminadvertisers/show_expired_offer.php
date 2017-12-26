<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<div id="Container">
<div align="center" style="width:900px; font-size:15px; font-weight:bold ">
<div>&nbsp;</div>
<script type="text/javascript" src="<?php echo __SCRIPT_PATH;?>js/jquery-1.4.2.min.js"></script>
<div align="right" style="width:900px; line-height:25px; font-size:15px; font-weight:bold ">
<div>&nbsp;</div>
<script type="text/javascript"> 
		$(document).ready(function() { 
		$('.Paginate').click(function(){
			var Page = $(this).attr('id'); 
			$.post('<?php echo __LINK_PATH;?>adminadvertisers/add_offer_start/AJAX/Y/',{Page:Page},function(data){
				$('#Container').html(data);
				$('#Product_Container').hide().delay(300).fadeIn();
				});
			});	
			
	});
</script>
<style>
.Paginate{
margin-right:5px;
cursor:pointer;
color:#0099FF;
}
</style>
<div id="Product_Container">
<table width="100%"  border="1" cellpadding="2" cellspacing="0" bordercolor="#333333">
  <tr bgcolor="#ACCBE3">
	 <td width="42%"><div align="center" style="font-size:16px ">إســم الـمـستـخـدم</div></td>
     <td width="58%"><div align="center" style="font-size:16px ">الإســم</div></td>
  </tr>

<?php
foreach($results as $rows)
	{
	$ID = $rows->ID;
	$user_name = $rows->user_name;
	$Full_Name = $rows->First_Name.' '.$rows->Last_Name;
	?>
	<tr>
		<td><div align="center"><?php echo $user_name;?></div></td>
		<td><div align="center" style="cursor:pointer; color:#0066FF " onClick="RedirectModified('<?php echo __LINK_PATH;?>adminadvertisers/show_expired_client_offers/Member/<?php echo $ID;?>/');"><?php echo $Full_Name;?></div></td>
	</tr>
	<?php
	}
?>
</table>
</div>
<!-- Footer paginations !-->
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
		<div dir="rtl">
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
?>
<!-- End of page divs !-->
</div>
</div>