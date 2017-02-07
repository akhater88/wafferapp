<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style>
.Search{
cursor:pointer;
}
</style>
<script type="text/javascript" src="<?php echo __SCRIPT_PATH;?>js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="<?php echo __SCRIPT_PATH;?>js/datepicker.js"></script>
<link rel="stylesheet" href="<?php echo __SCRIPT_PATH;?>css/datepicker.css" type="text/css" />
<script type="text/javascript"> 
	$(document).ready(function() {
	
		$('#Sales_Men').change(function(){
			var Sales_ID = $(this).val();
			var Merchant_ID = $('#Merchants').val();
			$.post('<?php echo __LINK_PATH;?>country_admin/display_category/AJAX/Y/',{Sales_ID:Sales_ID,Merchant_ID:Merchant_ID},function(data){
					$('#Cat_Div').html(data);
				});
		});	
		
		$('.Search').click(function(event){
		    var Sales_Men = $('#Sales_Men').val();
			var Merchant_ID = $('#Merchants').val();
			var Category = $('#Category').val();
			var Services = $('#Services').val();
			if($('#Enable_Date').attr('checked'))
				{
					var Starts_Date = $('#Starts_Date').val();
					var End_Date = $('#End_Date').val();
				}
			else
				{
					var Starts_Date = '000000';
					var End_Date = '000000';
				}
			var Time_Stamp = event.timeStamp;
			$.post('<?php echo __LINK_PATH;?>country_admin/display_search_results/AJAX/Y/',{Sales_Men:Sales_Men,Merchant_ID:Merchant_ID,Category:Category,Services:Services,Starts_Date:Starts_Date,End_Date:End_Date,Time_Stamp:Time_Stamp},function(data){
					$('#Search_Results').html(data);
				});
		});	
	});
</script>
<?php
if(count($Cat_ID_Array))
	{
	?>
	<table width="100%"  border="0" cellpadding="5" dir="ltr">
	  <tr>
		 <td width="83%">
		 <div align="right">
		 <select id="Category">
		 <option value="0" selected>--الـفـئــة--</option>
		 <?php
		 if($MID == '999')
		 	{
			?>
		 	<option value="999">--الـكـل--</option>
		 	<?php
			}
		 $Counter = 0;
		 foreach($Cat_ID_Array as $value)
			{
			?>
			<option value="<?php echo $value;?>"><?php echo $Cat_Name_Array[$Counter];?></option>
			<?php
			$Counter++;
			}
		 ?>
		 </select>
		 </div></td>
		 <td width="17%"><div align="right">الـفـئــة</div></td>
	  </tr>
	</table>
<?php
	}
if(count($Sub_Cat_ID_Array))
	{
	?>
	<table width="100%"  border="0" cellpadding="5" dir="ltr">
	  <tr>
		 <td width="83%">
		 <div align="right">
		 <select id="Services">
		 <option value="0" selected>--الـخـدمـات--</option>
		 <?php
		 if($MID == '999')
		 	{
			?>
		 	<option value="999">--الـكـل--</option>
		 	<?php
			}
		 $Counter = 0;
		 foreach($Sub_Cat_ID_Array as $value)
			{
			?>
			<option value="<?php echo $value;?>"><?php echo $Sub_Cat_Name_Array[$Counter];?></option>
			<?php
			$Counter++;
			}
		 ?>
		 </select>
		 </div></td>
		 <td width="17%"><div align="right">الـخـدمـات</div></td>
	  </tr>
	</table>
<?php
	}
?>
<table width="100%"  border="0" cellpadding="5" dir="ltr">
	  <tr>
		 <td width="83%"><div align="right"><img alt="" src="<?php echo __SCRIPT_PATH;?>images/send.jpg" width="104" height="44" class="Search"></div></td>
		  <td width="17%"><div align="right">&nbsp;</div></td>
		 </tr>
</table>
<div id="Search_Results"></div>