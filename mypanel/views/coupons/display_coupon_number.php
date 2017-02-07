<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<div align="right" style="width:200px; font-size:15px; font-weight:bold ">
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
	<div>&nbsp;</div>
	<div align="center"><span id="Export" style="cursor:pointer "><img src="<?php echo __SCRIPT_PATH;?>images/Excel.jpg" width="40" height="40"></span></div>
	<div style="line-height:15px ">&nbsp;</div>
	<div align="center">أرقـام الكـوبـونــات</div>
	<div style="line-height:15px ">&nbsp;</div>
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
	<?php
	}
?>
</div>