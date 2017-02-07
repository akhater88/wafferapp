<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<div>&nbsp;</div>
<style>
.Search_Sales{
cursor:pointer;
}
</style>
<script type="text/javascript" src="<?php echo __SCRIPT_PATH;?>js/jquery-1.4.2.min.js"></script>
<script type="text/javascript"> 
	$(document).ready(function() {
		$('.Search_Sales').click(function(event){
			var CID = $('#Country').val();
			$.post('<?php echo __LINK_PATH;?>admin_search/country_search_log/AJAX/Y/',{CID:CID},function(data){
					$('#Display_Search_Results').html(data);
			});	
		});
	});
</script>
<div style="line-height:15px ">&nbsp;</div>
<table width="100%"  border="0" cellpadding="5" dir="ltr">
  <tr>
     <td width="88%"><div align="right">
	 <select id="Country">
	 <option value="0" selected>--الــبـلــد--</option>
	 <option value="999">--الـكـل--</option>
	 <?php
	 foreach($results_country as $rows)
	 	{
		?>
		<option value="<?php echo $rows->ID;?>"><?php echo $rows->Name;?></option>
		<?php
		}
	 ?>
	 </select>
	 </div></td>
	 <td width="12%"><div align="right">الــبـلــد</div></td>
  </tr>
   <tr>
     <td width="88%"><div align="right"><img alt="" src="<?php echo __SCRIPT_PATH;?>images/send.jpg" width="104" height="44" class="Search_Sales"></div></td>
	 <td width="12%"><div align="right">&nbsp;</div></td>
  </tr>
</table>
<div id="Display_Search_Results"></div>