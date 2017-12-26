<script type="text/javascript"> 
	$(document).ready(function() { 
	
	var _elm = $('.mobile-text13')[0];
    if (_elm.clientHeight < _elm.scrollHeight) {
       $('.mobile-bg13').css({'width':'112px'});
	   $('.mobile-bg-inner13').css({'width':'112px'});
	  
    }
	
	$('#Display_Offers_By_Cities_Access').click(function(){
			var Country_ID = '<?php echo $Country_ID;?>';
			var City_ID = '<?php echo $City_ID;?>';
			var Member = '<?php echo $Member;?>';
			var Ads_Cat ='<?php echo $Ads_Cat;?>';
			$.post('<?php echo __LINK_PATH;?>services/display_offers_by_city_access/AJAX/Y/',{Country_ID:Country_ID,City_ID:City_ID,Member:Member,Ads_Cat:Ads_Cat},function(data){
				$('#Offers_content_access').html(data);
			});
				
		});	
		
			
	});
</script>
<div id="Offers_content_access">
<div class="mobile-text13" style="overflow:auto; direction:ltr">
<div class="mobile-bg13"><a href="#z" class="bg1" style="text-decoration:none; font-weight:bold "><?php echo $Sender_Name;?></a></div >
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
			<div class="mobile-bg-inner13" id="<?php echo $BG;?>"><?php echo $Value;?></div >
			<?php
			$Counter++;
			}
	}
else
	{
	?>
	<div class="mobile-bg-inner13">لا تـوجـد مـعـلـومـات حـالـيــا</div >
	<?php
	}
?>
</div>
<div class="mobile-back1"><a href="#z"><img alt="" src="<?php echo __SCRIPT_PATH;?>images/back1.png" width="39" height="14" border="0" id="Display_Offers_By_Cities_Access"/></a></div>
</div>