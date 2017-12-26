<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<div align="right" style="width:900px; font-size:15px; font-weight:bold ">
<div>&nbsp;</div>
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
<script type="text/javascript" src="<?php echo __SCRIPT_PATH;?>js/jquery-1.4.2.min.js"></script>
<script type="text/javascript"> 
	$(document).ready(function() {
		$('#MyUsers').change(function(){
			var Level = $(this).val();
			
			$.post('<?php echo __LINK_PATH;?>admin_search/display_search_results/AJAX/Y/',{Level:Level},function(data){
					$('#User_Info').html(data);
				});
				
		});	
		
		
	});
</script>

<?php
if(count($results))
	{
	?>
	<select id="MyUsers">
	<option value="0">--Select a user--</option>
	<option value="6">Mobile User</option>
	<?php
	foreach($results as $rows)
		{
			?>
			<option value="<?php echo $rows->ID;?>"><?php echo $rows->Level;?></option>
			<?php
		}
	?>
	</select>
	<?php
	}
?>
<div id="User_Info"></div>
</div>