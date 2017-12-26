
<?php
$Time_Stamp = date('m_d_Y').time();
$Dislay =  new sql();

?>
<script type="text/javascript">
$(document).ready(function() {
		
	$('.get_card').click(function(){
		var ID = $(this).attr('id');
		
		if (confirm("هــل انت متاكد من العملية؟")) {
		$.post('<?php echo __LINK_PATH;?>mobile_users_functions/get_cards/AJAX/Y/',{ID:ID},function(data){
			$('#cards_list').html(data);
			
			});
		}
		});
});
</script>
<div id="cards_list">
<table style="width: 100%; border:0px; margin-top:20px; margin-bottom:20px; line-height:25px;" cellpadding="0" cellspacing="0">
	<tr>
		<td style=" border-left:1px #fff dotted; height: 25px; background-color:#8c8b8b; color:#fff; " align="center">
		الشعار</td>
		<td style="height: 25px; background-color:#8c8b8b; color:#fff;" align="center">فئات البطاقات</td>
		<td style="height: 25px; background-color:#8c8b8b; color:#fff;" align="center">
		عدد النقاط</td>
		<td style="height: 25px; background-color:#8c8b8b; color:#fff;" align="center">
		طلب</td>
	</tr>
	<?php 
	if(count($results)&& is_array($results))
	{
	foreach($results as $rows)
			{
				
	?>
	<tr>
		<td style="height: 60px; border-left:1px #8c8b8b dotted; border-bottom:1px #8c8b8b dotted; " align="center">
			<?php 
			$Display = new sql();
			$sql = "SELECT image_logo FROM Company WHERE ID = ? ";
			$Execute_Array = array($rows->company_ID);
			$image = $Display->Display_Single_Info($sql,'image_logo',$Execute_Array);
			?>
			<img alt="" src="<?php echo __IMAGE_PATH?>companyLogos/<?php echo $image?>" width="33" height="45" />
		</td>
		<td style="height: 60px; border-bottom:1px #8c8b8b dotted; border-left:1px #8c8b8b dotted;" align="center">
		<?php echo $rows->cat;?>
		</td>
		<td style="height: 60px; border-bottom:1px #8c8b8b dotted;border-left:1px #8c8b8b dotted; " align="center">
		<?php echo $rows->point?>
		</td>
		<td style="height: 60px; border-bottom:1px #8c8b8b dotted; " align="center">
		<?php 
		$point = $rows->point;
		$myfunction = new myfunctions();
		$isAva = $myfunction->checkpoint($point,$_SESSION['Mobile_User_ID']);
		if ($isAva)
		{
			$sql = "SELECT ID FROM cards_english WHERE cardCat_ID = ? AND Status = ?";
			$Execute_Array = array($rows->ID,'1');
			$totalRecords = $Display->Total_Records($sql,$Execute_Array);
			if ($totalRecords != 0)
			{
			?>
			<img class="get_card" alt="" id="<?php echo $rows->ID;?>" src="<?php echo __SCRIPT_PATH?>images/order-avilable.jpg" width="75" height="25" />
			<?php 
			}
			else {
				?>
				<img alt="" src="<?php echo __SCRIPT_PATH?>images/order-nonavilable.jpg" width="75" height="25" />
				<?php 
			}
			?>
		<?php 
		}
		else 
		{
		?>
		<img alt="" src="<?php echo __SCRIPT_PATH?>images/order-nonavilable.jpg" width="75" height="25" />
		<?php 
		}
		?>
		</td>
		
	</tr>
	<?php 
			}
	}
	?>
	
</table>
</div>