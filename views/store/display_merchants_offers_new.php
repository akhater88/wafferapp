<script type="text/javascript"> 
	$(document).ready(function() { 
		
	var _elm = $('.mobile-text1')[0];
    if (_elm.clientHeight < _elm.scrollHeight) {
       $('.mobile-bg1').css({'width':'112px'});
	   $('.mobile-bg-inner').css({'width':'112px'});
	  
    }
   
	
	$('#Display_Offers_New').click(function(){
			var Country_ID = '<?php echo $Country_ID;?>';
			var City_ID = '<?php echo $City_ID;?>';
			var Member = '<?php echo $Member;?>';
			$.post('<?php echo __LINK_PATH;?>store/display_offers_by_city_new/AJAX/Y/',{Country_ID:Country_ID,City_ID:City_ID,Member:Member},function(data){
				$('#Offers_new').html(data);
			});
				
		});	
		
			
	});
</script>
<div id="Offers_new">
<div class="mobile-text1" style="overflow:auto; direction:ltr">
<div class="mobile-bg1"><a href="#z" class="bg1" style="text-decoration:none; font-weight:bold "><?php echo $Sender_Name;?></a></div >
<?php
$Counter = 0;
if(count($Offers_Array))
	{
		foreach($Offers_Array as $Value)
			{
				if($Counter%2)
					{
						$BG = 'bg_grid1';
					}
				else
					{
						$BG = 'bg_grid2';
					}
			?>
			<div class="mobile-bg-inner" id="<?php echo $BG;?>"><?php echo $Value;?></div >
			<?php
			$Counter++;
			}
	}
else
	{
	?>
	<div class="mobile-bg-inner">لا تـوجـد عـروض حـالـيــا</div >
	<?php
	}
?>
</div>
<div class="mobile-back1"><a href="#z"><img alt="" src="<?php echo __SCRIPT_PATH;?>images/back1.png" width="39" height="14" border="0" id="Display_Offers_New"/></a></div>
</div>