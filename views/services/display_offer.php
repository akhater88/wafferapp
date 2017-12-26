<script type="text/javascript"> 
	$(document).ready(function() { 
		
	$('.Restaurants').click(function(){
			var Country_ID = $(this).attr('id');
			var Ads_Cat = $(this).attr('ref');
			var Member = '<?php echo $Member;?>';
			$.post('<?php echo __LINK_PATH;?>services/display_cities/AJAX/Y/',{Country_ID:Country_ID,Member:Member,Ads_Cat:Ads_Cat},function(data){
				$('#Discounts').html(data);
			});
				
		});	
			
	$('.Coffee_Shops').click(function(){
			var Country_ID = $(this).attr('id');
			var Member = '<?php echo $Member;?>';
			var Ads_Cat = $(this).attr('ref');
			$.post('<?php echo __LINK_PATH;?>services/display_cities_coffee_shops/AJAX/Y/',{Country_ID:Country_ID,Member:Member,Ads_Cat:Ads_Cat},function(data){
				$('#Coffee_Shops_Div').html(data);
			});
				
		}); 
			
	$('.Sport_Clubs').click(function(){
			var Country_ID = $(this).attr('id');
			var Member = '<?php echo $Member;?>';
			var Ads_Cat = $(this).attr('ref');
			$.post('<?php echo __LINK_PATH;?>services/display_cities_sport_clubs/AJAX/Y/',{Country_ID:Country_ID,Member:Member,Ads_Cat:Ads_Cat},function(data){
				$('#Sport_Clubs_Div').html(data);
			});
				
		}); 
		
	$('.Enter').click(function(){
			var Country_ID = $(this).attr('id');
			var Member = '<?php echo $Member;?>';
			var Ads_Cat = $(this).attr('ref');
			$.post('<?php echo __LINK_PATH;?>services/display_cities_enter/AJAX/Y/',{Country_ID:Country_ID,Member:Member,Ads_Cat:Ads_Cat},function(data){
				$('#Enter_Div').html(data);
			});
				
		}); 
		
	$('.Daily').click(function(){
			var Country_ID = $(this).attr('id');
			var Member = '<?php echo $Member;?>';
			var Ads_Cat = $(this).attr('ref');
			$.post('<?php echo __LINK_PATH;?>services/display_cities_daily/AJAX/Y/',{Country_ID:Country_ID,Member:Member,Ads_Cat:Ads_Cat},function(data){
				$('#Daily_Div').html(data);
			});
				
		}); 
		
	$('.Elect').click(function(){
			var Country_ID = $(this).attr('id');
			var Member = '<?php echo $Member;?>';
			var Ads_Cat = $(this).attr('ref');
			$.post('<?php echo __LINK_PATH;?>services/display_cities_elect/AJAX/Y/',{Country_ID:Country_ID,Member:Member,Ads_Cat:Ads_Cat},function(data){
				$('#Elect_Div').html(data);
			});
				
		});
		
	$('.Gifts').click(function(){
			var Country_ID = $(this).attr('id');
			var Member = '<?php echo $Member;?>';
			var Ads_Cat = $(this).attr('ref');
			$.post('<?php echo __LINK_PATH;?>services/display_cities_gift/AJAX/Y/',{Country_ID:Country_ID,Member:Member,Ads_Cat:Ads_Cat},function(data){
				$('#Gifts_Div').html(data);
			});
				
		});  
		
	$('.Travel').click(function(){
			var Country_ID = $(this).attr('id');
			var Member = '<?php echo $Member;?>';
			var Ads_Cat = $(this).attr('ref');
			$.post('<?php echo __LINK_PATH;?>services/display_cities_travel/AJAX/Y/',{Country_ID:Country_ID,Member:Member,Ads_Cat:Ads_Cat},function(data){
				$('#Travel_Div').html(data);
			});
				
		}); 
		
	$('.Haj').click(function(){
			var Country_ID = $(this).attr('id');
			var Member = '<?php echo $Member;?>';
			var Ads_Cat = $(this).attr('ref');
			$.post('<?php echo __LINK_PATH;?>services/display_cities_haj/AJAX/Y/',{Country_ID:Country_ID,Member:Member,Ads_Cat:Ads_Cat},function(data){
				$('#Haj_Div').html(data);
			});
				
		}); 
		
	$('.Clothes').click(function(){
			var Country_ID = $(this).attr('id');
			var Member = '<?php echo $Member;?>';
			var Ads_Cat = $(this).attr('ref');
			$.post('<?php echo __LINK_PATH;?>services/display_cities_clothes/AJAX/Y/',{Country_ID:Country_ID,Member:Member,Ads_Cat:Ads_Cat},function(data){
				$('#Clothes_Div').html(data);
			});
				
		}); 
		
	$('.Furn').click(function(){
			var Country_ID = $(this).attr('id');
			var Member = '<?php echo $Member;?>';
			var Ads_Cat = $(this).attr('ref');
			$.post('<?php echo __LINK_PATH;?>services/display_cities_furn/AJAX/Y/',{Country_ID:Country_ID,Member:Member,Ads_Cat:Ads_Cat},function(data){
				$('#Furn_Div').html(data);
			});
				
		}); 
		
	$('.Access').click(function(){
			var Country_ID = $(this).attr('id');
			var Member = '<?php echo $Member;?>';
			var Ads_Cat = $(this).attr('ref');
			$.post('<?php echo __LINK_PATH;?>services/display_cities_access/AJAX/Y/',{Country_ID:Country_ID,Member:Member,Ads_Cat:Ads_Cat},function(data){
				$('#Access_Div').html(data);
			});
				
		}); 
	});
</script>
<div id="text-titles">
<table style="width: 100%" cellspacing="0" cellpadding="0">
<tr><td align="center" valign="middle">
				<img alt="" src="<?php echo __SCRIPT_PATH;?>images/<?php echo $Image_Name;?>.png" /></td></tr></table>
</div>
<div id="text-middle">
	<table style="width: 100%" cellpadding="0" cellspacing="0" class="style1">
		<tr>
		<td valign="top" align="right" style="width: 190px">
		<div id="mobile-sub1">
		<div class="mobile-title1">
						<img alt="" src="<?php echo __SCRIPT_PATH;?>images/sub1.png" width="38" height="43" /> </div>
		<div id="Discounts">
			<div class="mobile-text1"><br/><br/>الرجاء اختيار الدولة:
				<table style="width: 100%; margin-top:30px;" cellpadding="0" cellspacing="0" class="style1">
				<tr>
				<td valign="top" align="center" style="width: 70px">
				<img alt="" src="<?php echo __SCRIPT_PATH;?>images/sudia.png" width="60" height="74" class="Restaurants" id="19" ref="3" /></td>
				<td valign="top" align="center">
				<img alt="" src="<?php echo __SCRIPT_PATH;?>images/jordan.png" width="42" height="73"  class="Restaurants" id="18" ref="3" /></td>
				</tr>
				</table>
			</div>
			<div class="mobile-back1"><a href="#z"><img alt="" src="<?php echo __SCRIPT_PATH;?>images/back1.png" width="39" height="14" border="0" /></a></div>
		</div>
		
		</div>
		</td>
		<td valign="top" align="center" style="width: 190px">
		<div id="mobile-sub1">
		<div class="mobile-title1">
						<img alt="" src="<?php echo __SCRIPT_PATH;?>images/sub2.png" width="60" height="43" /></div>
		<div id="Coffee_Shops_Div">
		<div class="mobile-text1"><br/><br/>الرجاء اختيار الدولة:
				<table style="width: 100%; margin-top:30px;" cellpadding="0" cellspacing="0" class="style1">
				<tr>
				<td valign="top" align="center" style="width: 70px">
				<img alt="" src="<?php echo __SCRIPT_PATH;?>images/sudia.png" width="60" height="74" class="Coffee_Shops" id="19" ref="8" /></td>
				<td valign="top" align="center">
				<img alt="" src="<?php echo __SCRIPT_PATH;?>images/jordan.png" width="42" height="73"  class="Coffee_Shops" id="18" ref="8"/></td>
				</tr>
				</table>
			</div>
			<div class="mobile-back1"><a href="#z"><img alt="" src="<?php echo __SCRIPT_PATH;?>images/back1.png" width="39" height="14" border="0" /></a></div>
		</div>
		</div>
		</td>
		<td valign="top" align="left" style="width: 191px">
		<div id="mobile-sub1">
		<div class="mobile-title1">
						<img alt="" src="<?php echo __SCRIPT_PATH;?>images/sub3.png" width="75" height="43" /></div>
		<div id="Sport_Clubs_Div">
		<div class="mobile-text1"><br/><br/>الرجاء اختيار الدولة:
				<table style="width: 100%; margin-top:30px;" cellpadding="0" cellspacing="0" class="style1">
				<tr>
				<td valign="top" align="center" style="width: 70px">
				<img alt="" src="<?php echo __SCRIPT_PATH;?>images/sudia.png" width="60" height="74" class="Sport_Clubs" id="19" ref="15" /></td>
				<td valign="top" align="center">
				<img alt="" src="<?php echo __SCRIPT_PATH;?>images/jordan.png" width="42" height="73"  class="Sport_Clubs" id="18" ref="15" /></td>
				</tr>
				</table>
			</div>
			<div class="mobile-back1"><a href="#z"><img alt="" src="<?php echo __SCRIPT_PATH;?>images/back1.png" width="39" height="14" border="0" /></a></div>
		</div>
		</div>
		</td>
		</tr>
		<!-- Add more <tr> here !-->
		<tr>
		<td valign="top" align="right" style="width: 190px">
		<div id="mobile-sub1">
		<div class="mobile-title1">
						<img alt="" src="<?php echo __SCRIPT_PATH;?>images/sub4.png" width="66" height="43" /> </div>
		<div id="Enter_Div">
			<div class="mobile-text1"><br/><br/>الرجاء اختيار الدولة:
				<table style="width: 100%; margin-top:30px;" cellpadding="0" cellspacing="0" class="style1">
				<tr>
				<td valign="top" align="center" style="width: 70px">
				<img alt="" src="<?php echo __SCRIPT_PATH;?>images/sudia.png" width="60" height="74" class="Enter" id="19" ref="16" /></td>
				<td valign="top" align="center">
				<img alt="" src="<?php echo __SCRIPT_PATH;?>images/jordan.png" width="42" height="73"  class="Enter" id="18" ref="16" /></td>
				</tr>
				</table>
			</div>
			<div class="mobile-back1"><a href="#z"><img alt="" src="<?php echo __SCRIPT_PATH;?>images/back1.png" width="39" height="14" border="0" /></a></div>
		</div>
		
		</div>
		</td>
		<td valign="top" align="center" style="width: 190px">
		<div id="mobile-sub1">
		<div class="mobile-title1">
						<img alt="" src="<?php echo __SCRIPT_PATH;?>images/sub5.png" width="84" height="43" /></div>
		<div id="Daily_Div">
		<div class="mobile-text1"><br/><br/>الرجاء اختيار الدولة:
				<table style="width: 100%; margin-top:30px;" cellpadding="0" cellspacing="0" class="style1">
				<tr>
				<td valign="top" align="center" style="width: 70px">
				<img alt="" src="<?php echo __SCRIPT_PATH;?>images/sudia.png" width="60" height="74" class="Daily" id="19" ref="10" /></td>
				<td valign="top" align="center">
				<img alt="" src="<?php echo __SCRIPT_PATH;?>images/jordan.png" width="42" height="73"  class="Daily" id="18" ref="10"/></td>
				</tr>
				</table>
			</div>
			<div class="mobile-back1"><a href="#z"><img alt="" src="<?php echo __SCRIPT_PATH;?>images/back1.png" width="39" height="14" border="0" /></a></div>
		</div>
		</div>
		</td>
		<td valign="top" align="left" style="width: 191px">
		<div id="mobile-sub1">
		<div class="mobile-title1">
						<img alt="" src="<?php echo __SCRIPT_PATH;?>images/sub6.png" width="54" height="43" /></div>
		<div id="Elect_Div">
		<div class="mobile-text1"><br/><br/>الرجاء اختيار الدولة:
				<table style="width: 100%; margin-top:30px;" cellpadding="0" cellspacing="0" class="style1">
				<tr>
				<td valign="top" align="center" style="width: 70px">
				<img alt="" src="<?php echo __SCRIPT_PATH;?>images/sudia.png" width="60" height="74" class="Elect" id="19" ref="9" /></td>
				<td valign="top" align="center">
				<img alt="" src="<?php echo __SCRIPT_PATH;?>images/jordan.png" width="42" height="73"  class="Elect" id="18" ref="9" /></td>
				</tr>
				</table>
			</div>
			<div class="mobile-back1"><a href="#z"><img alt="" src="<?php echo __SCRIPT_PATH;?>images/back1.png" width="39" height="14" border="0" /></a></div>
		</div>
		</div>
		</td>
		</tr>
		<!-- Add more <tr> here !-->
		<tr>
		<td valign="top" align="right" style="width: 190px">
		<div id="mobile-sub1">
		<div class="mobile-title1">
						<img alt="" src="<?php echo __SCRIPT_PATH;?>images/sub7.png" width="71" height="42" /> </div>
		<div id="Gifts_Div">
			<div class="mobile-text1"><br/><br/>الرجاء اختيار الدولة:
				<table style="width: 100%; margin-top:30px;" cellpadding="0" cellspacing="0" class="style1">
				<tr>
				<td valign="top" align="center" style="width: 70px">
				<img alt="" src="<?php echo __SCRIPT_PATH;?>images/sudia.png" width="60" height="74" class="Gifts" id="19" ref="17" /></td>
				<td valign="top" align="center">
				<img alt="" src="<?php echo __SCRIPT_PATH;?>images/jordan.png" width="42" height="73"  class="Gifts" id="18" ref="17" /></td>
				</tr>
				</table>
			</div>
			<div class="mobile-back1"><a href="#z"><img alt="" src="<?php echo __SCRIPT_PATH;?>images/back1.png" width="39" height="14" border="0" /></a></div>
		</div>
		
		</div>
		</td>
		<td valign="top" align="center" style="width: 190px">
		<div id="mobile-sub1">
		<div class="mobile-title1">
						<img alt="" src="<?php echo __SCRIPT_PATH;?>images/sub9.png" width="72" height="44" /></div>
		<div id="Travel_Div">
		<div class="mobile-text1"><br/><br/>الرجاء اختيار الدولة:
				<table style="width: 100%; margin-top:30px;" cellpadding="0" cellspacing="0" class="style1">
				<tr>
				<td valign="top" align="center" style="width: 70px">
				<img alt="" src="<?php echo __SCRIPT_PATH;?>images/sudia.png" width="60" height="74" class="Travel" id="19" ref="11" /></td>
				<td valign="top" align="center">
				<img alt="" src="<?php echo __SCRIPT_PATH;?>images/jordan.png" width="42" height="73"  class="Travel" id="18" ref="11"/></td>
				</tr>
				</table>
			</div>
			<div class="mobile-back1"><a href="#z"><img alt="" src="<?php echo __SCRIPT_PATH;?>images/back1.png" width="39" height="14" border="0" /></a></div>
		</div>
		</div>
		</td>
		<td valign="top" align="left" style="width: 191px">
		<div id="mobile-sub1">
		<div class="mobile-title1">
						<img alt="" src="<?php echo __SCRIPT_PATH;?>images/sub8.png" width="45" height="45" /></div>
		<div id="Clothes_Div">
			<div class="mobile-text1"><br/><br/>الرجاء اختيار الدولة:
				<table style="width: 100%; margin-top:30px;" cellpadding="0" cellspacing="0" class="style1">
				<tr>
				<td valign="top" align="center" style="width: 70px">
				<img alt="" src="<?php echo __SCRIPT_PATH;?>images/sudia.png" width="60" height="74" class="Clothes" id="19" ref="13" /></td>
				<td valign="top" align="center">
				<img alt="" src="<?php echo __SCRIPT_PATH;?>images/jordan.png" width="42" height="73"  class="Clothes" id="18" ref="13" /></td>
				</tr>
				</table>
			</div>
			<div class="mobile-back1"><a href="#z"><img alt="" src="<?php echo __SCRIPT_PATH;?>images/back1.png" width="39" height="14" border="0" /></a></div>
		</div>
		</div>
		</td>
		</tr>
		<!-- Add more <tr> here !-->
		<tr>
		<td valign="top" align="right" style="width: 190px">
		<div id="mobile-sub1">
		<div class="mobile-title1">
						<img alt="" src="<?php echo __SCRIPT_PATH;?>images/sub10.png" width="50" height="42" /> </div>
		<div id="Haj_Div">
		<div class="mobile-text1"><br/><br/>الرجاء اختيار الدولة:
				<table style="width: 100%; margin-top:30px;" cellpadding="0" cellspacing="0" class="style1">
				<tr>
				<td valign="top" align="center" style="width: 70px">
				<img alt="" src="<?php echo __SCRIPT_PATH;?>images/sudia.png" width="60" height="74" class="Haj" id="19" ref="12" /></td>
				<td valign="top" align="center">
				<img alt="" src="<?php echo __SCRIPT_PATH;?>images/jordan.png" width="42" height="73"  class="Haj" id="18" ref="12" /></td>
				</tr>
				</table>
			</div>
			<div class="mobile-back1"><a href="#z"><img alt="" src="<?php echo __SCRIPT_PATH;?>images/back1.png" width="39" height="14" border="0" /></a></div>
		</div>
		</div>
		</td>
		<td valign="top" align="center" style="width: 190px">
		<div id="mobile-sub1">
		<div class="mobile-title1">
						<img alt="" src="<?php echo __SCRIPT_PATH;?>images/sub11.png" width="59" height="43" /></div>
		<div id="Furn_Div">
		<div class="mobile-text1"><br/><br/>الرجاء اختيار الدولة:
				<table style="width: 100%; margin-top:30px;" cellpadding="0" cellspacing="0" class="style1">
				<tr>
				<td valign="top" align="center" style="width: 70px">
				<img alt="" src="<?php echo __SCRIPT_PATH;?>images/sudia.png" width="60" height="74" class="Furn" id="19" ref="18" /></td>
				<td valign="top" align="center">
				<img alt="" src="<?php echo __SCRIPT_PATH;?>images/jordan.png" width="42" height="73"  class="Furn" id="18" ref="18"/></td>
				</tr>
				</table>
			</div>
			<div class="mobile-back1"><a href="#z"><img alt="" src="<?php echo __SCRIPT_PATH;?>images/back1.png" width="39" height="14" border="0" /></a></div>
		</div>
		</div>
		</td>
		<td valign="top" align="left" style="width: 191px">
		<div id="mobile-sub1">
		<div class="mobile-title1">
						<img alt="" src="<?php echo __SCRIPT_PATH;?>images/sub12.png" width="103" height="43" /></div>
		<div id="Access_Div">
		<div class="mobile-text1"><br/><br/>الرجاء اختيار الدولة:
				<table style="width: 100%; margin-top:30px;" cellpadding="0" cellspacing="0" class="style1">
				<tr>
				<td valign="top" align="center" style="width: 70px">
				<img alt="" src="<?php echo __SCRIPT_PATH;?>images/sudia.png" width="60" height="74" class="Access" id="19" ref="14" /></td>
				<td valign="top" align="center">
				<img alt="" src="<?php echo __SCRIPT_PATH;?>images/jordan.png" width="42" height="73"  class="Access" id="18" ref="14" /></td>
				</tr>
				</table>
			</div>
			<div class="mobile-back1"><a href="#z"><img alt="" src="<?php echo __SCRIPT_PATH;?>images/back1.png" width="39" height="14" border="0" /></a></div>
		</div>
		</div>
		</td>
		</tr>
	</table>
</div>