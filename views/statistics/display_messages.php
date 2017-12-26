<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style>
.Submit_BTN{
width:80px;
height:25px;
background-color:#000066;
color:#FFFFFF;
cursor:pointer;
}
</style>
<div align="right" style="width:900px; font-size:15px; font-weight:bold ">
<script type="text/javascript" src="<?php echo __SCRIPT_PATH;?>js/jquery-1.4.2.min.js"></script>
<script type="text/javascript"> 
	$(document).ready(function() { 
		$('#Offer_Titles').change(function(){
			$('#MyButton').show();
		});	
		
	$('.Submit_BTN').click(function(){
			var Offer_ID = $('#Offer_Titles').val();
			
			$.post('<?php echo __LINK_PATH;?>statistics/display_plot/AJAX/Y/',{Offer_ID:Offer_ID},function(data){
					$('#Plot_Div').html(data);
				});
				
		});	
		
	
	});
</script>
<?php
if(count($Offer_ID_Array))
	{
	?>
	<table width="100%"  border="0" cellpadding="3" cellspacing="0">
  <tr>
     <td width="88%">
	 <div align="right">
	 <select id="Offer_Titles">
	  <option value="0" selected>--الـرســائــل--</option>
	 <?php
	 $Counter = 0;
	 foreach($Offer_ID_Array as $value)
	 	{
			?>
			<option value="<?php echo $value;?>"><?php echo $Offer_Name[$Counter];?></option>
			<?php
			$Counter++;
		}
	 ?>
	 </select>
	 </div>
	 </td>
	 <td width="12%"><div align="right">الـرســائــل</div></td>
  </tr>
 
</table>
<div id="MyButton" style="display:none ">
<table width="100%"  border="0" cellpadding="3" cellspacing="0">
	 <tr>
		 <td width="88%">
		 <div align="right"><input type="submit" name="Submit" value="إرسـال" class="Submit_BTN"></div>
		 </td>
		 <td width="12%"><div align="right">&nbsp;</div></td>
  	</tr>
</table>
</div>
	<?php
	
	}
?>
<div id="Plot_Div"></div>
</div>