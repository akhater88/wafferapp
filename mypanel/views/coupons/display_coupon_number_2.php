<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<div align="right" style="width:900px; font-size:15px; font-weight:bold ">
<script type="text/javascript" src="<?php echo __SCRIPT_PATH;?>js/jquery-1.4.2.min.js"></script>
<script type="text/javascript"> 
	$(document).ready(function() { 
		$('.Paginate').click(function(){
			var Page = $(this).attr('id');
			var Offer_ID = '<?php echo $Offer_ID;?>';
			
			$.post('<?php echo __LINK_PATH;?>coupons/display_coupon_number/AJAX/Y/',{Page:Page,Offer_ID:Offer_ID},function(data){
				$('#Plot_Div').html(data);
				$('#Product_Container').hide().delay(300).fadeIn();
				});
			});	
		
		$('#Export').click(function(){
			
			var MyCoupons = 'This is an Excel file';
			window.location = '<?php echo __SCRIPT_PATH;?>Excel/Tests/export_coupon_to_excel.php/';
			
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
<?php
if(count($Coupon_Array))
	{
	?>
	<div style="line-height:15px ">&nbsp;</div>
	<div><span id="Export" style="cursor:pointer ">Export</span></div>
	<div id="Product_Container">
	<table width="100%"  border="0" cellpadding="3" cellspacing="0">
	<?php
	 $Counter = 0;
	 foreach($Coupon_Array as $value)
	 	{
			if($Counter%2)
				{
					$Class = 'odd';
				}
			else
				{
					$Class = 'even';
				}
			?>
			<tr class="<?php echo $Class;?>">
     			<td><div align="center"><?php echo $value;?></div></td>
			</tr>
			<?php
			$Counter++;
		}
	 ?>
	</table>
	<div style="line-height:12px">&nbsp;</div>
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
<div id="MyExcel"></div>
</div>