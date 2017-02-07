<script type="text/javascript"> 
	$(document).ready(function() { 
		
	var _elm = $('.mobile-text4')[0];
    if (_elm.clientHeight < _elm.scrollHeight) {
       $('.mobile-bg4').css({'width':'112px'});
	   $('.mobile-bg-inner4').css({'width':'112px'});
	  
    }
	
	$('#Display_Offers_Offer').click(function(){
			var Country_ID = '<?php echo $Country_ID;?>';
			var City_ID = '<?php echo $City_ID;?>';
			var Member = '<?php echo $Member;?>';
			$.post('<?php echo __LINK_PATH;?>store/display_offers_by_city_offer/AJAX/Y/',{Country_ID:Country_ID,City_ID:City_ID,Member:Member},function(data){
				$('#Offers_offer').html(data);
			});
				
		});	
		
			
	});
</script>
<div id="Offers_offer">
<div class="mobile-text4" style="overflow:auto; direction:ltr">
<div class="mobile-bg4"><a href="#z" class="bg1"><?php echo $Sender_Name;?></a></div >
<?php
$Counter = 0;
if(count($Offers_Array))
	{
		foreach($Offers_Array as $Value)
			{
			?>
			<div class="mobile-bg-inner4"><?php echo $Value;?><HR /></div >
			<?php
			}
	}
else
	{
	?>
	<div class="mobile-bg-inner4">لا تـوجـد عـروض حـالـيــا</div >
	<?php
	}
?>
</div>
<div class="mobile-back1"><a href="#z"><img alt="" src="<?php echo __SCRIPT_PATH;?>images/back1.png" width="39" height="14" border="0" id="Display_Offers_Offer"/></a></div>
</div>