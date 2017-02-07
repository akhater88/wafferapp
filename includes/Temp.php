<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script language="javascript">AC_FL_RunContent = 0;</script>
<script src="<?php echo __SCRIPT_PATH;?>js/AC_RunActiveContent.js" language="javascript"></script>
<script src="<?php echo __SCRIPT_PATH;?>js/MyScript.js" language="javascript"></script>
<link rel="stylesheet" href="<?php echo __SCRIPT_PATH;?>css/style.css" type="text/css" />
<link href="<?php echo __SCRIPT_PATH;?>css/login.css" media="screen, projection" rel="stylesheet" type="text/css"/>

<title>:: Home Page ::</title>
<script language="JavaScript" type="text/javascript">
		<!--
		
		  // see http://www.thesitewizard.com/archive/framebreak.shtml
		  // for an explanation of this script and how to use it on your
		  // own website
		  if (top.location != location) {
			top.location.href = document.location.href ;
		  }
		
		-->
		</script>
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-19037959-3']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
<script type="text/javascript" src="<?php echo __SCRIPT_PATH;?>js/jquery-1.4.2.min.js"></script>
<link rel="stylesheet" href="<?php echo __SCRIPT_PATH;?>css/nivo-slider.css" type="text/css" media="screen" /> 
<link rel="stylesheet" href="<?php echo __SCRIPT_PATH;?>css/slide.css" type="text/css" media="screen" />
<script type="text/javascript">
        $(document).ready(function() {
			$('#resend_password_link').click(function(event){
				$('#pw_recovery').slideDown('slow');
			
			});	
			
			$('#signin_submit2').click(function(event){
			var EmailPW = $('#EmailPW').val();
			var Time_Stamp = event.timeStamp;
			$.post('<?php echo __LINK_PATH;?>general/pw_recovery/AJAX/Y/',{EmailPW:EmailPW,Time_Stamp:Time_Stamp},function(data){
				$.getJSON('<?php echo __SCRIPT_PATH;?>json/'+Time_Stamp+'.json',function(json){
					var Flag = json.flag;
					if(Flag == '0')
						{
							alert('تـم إرســال مـعـلـومـات الـتـسـجـيـل إلـى بـريـدك الإلكـتـرونــي');
							$('#EmailPW').val('');
							$('#pw_recovery').slideUp('slow');
						}
					else
						{
							alert('لـم يـتـم الـعـثـور عـلـى بـريـدك الإلكـتـرونـي الـرجـاء مـراجـعــة إدارة الـمـوقــع');
							$('#EmailPW').val('');
							$('#pw_recovery').slideUp('slow');
						}
								
					});
					
				});
			});
            $(".signin").click(function(e) {          
				e.preventDefault();
                $("fieldset#signin_menu").toggle();
				$(".signin").toggleClass("menu-open");
				
            });
			
			$("fieldset#signin_menu").mouseup(function() {
				return false
			});
			$(document).mouseup(function(e) {
				if($(e.target).parent("a.signin").length==0) {
					$(".signin").removeClass("menu-open");
					$("fieldset#signin_menu").hide();
					$('#pw_recovery').hide();
				}
			});			
			
        
		});
</script>
</head>
<body>

<div class="body-all">
<div class="top-jeans">

<div id="wrapper">

<div id="logo"><img alt="" src="<?php echo __SCRIPT_PATH;?>images/logo-waffer.png" width="108" height="145" /></div>
<div id="jeans-top-pic"><img alt="" src="<?php echo __SCRIPT_PATH;?>images/top-jeans-pic.png" width="61" height="44" /></div>

<div id="top">
<div class="login-top">
  <div id="topnav" class="topnav"><img src="<?php echo __SCRIPT_PATH;?>images/contact-top.png" style="cursor:pointer; position:relative; top:5px; right:20px " onclick="RedirectModified('<?php echo __LINK_PATH;?>pages/contact_us/')"/><a href="login" class="signin"><span>تسجيل دخول</span></a></div>
  <fieldset id="signin_menu">
  	<form action="<?php echo __LINK_PATH;?>userlogin/login/AJAX/Y/" method="post" name="form1" id="form1">
      <label for="username">البريد الإلكتروني</label>
      <input id="User_Name" name="User_Name" value="" title="username" tabindex="4" type="text"/>
      <p>
        <label for="password">كلمة المرور</label>
        <input id="PW" name="PW" value="" title="password" tabindex="5" type="password"/>
      </p>
      <p class="remember">
        <input name="Submit" type="submit" id="signin_submit" tabindex="6" value="تسجيل دخول"/>
      </p>
      <p class="forgot"> <a href="#" id="resend_password_link">نسيت كلمة السر؟</a> </p>
	  <div id="pw_recovery" style=" display:none ">
	  <p style="font-size:12px ">الـبريـد الإلكـتـرونـي</p>
	  <p><input id="EmailPW" type="text" /></p>
	  <p><input type="button" id="signin_submit2" value="  إرســال  "/>
	  </p>
	  </div>
     
	</form>
  </fieldset>
</div>

<script src="<?php echo __SCRIPT_PATH;?>js/jquery.tipsy.js" type="text/javascript"></script>
<script type='text/javascript'>
    $(function() {
	  $('#forgot_username_link').tipsy({gravity: 'w'});   
    });
  </script>


<div class="menu">
	<table style="width: 100%;">
		<tr>
			<td style="width:123px" valign="top">
			<a onmouseover="document.facebook.src='<?php echo __SCRIPT_PATH;?>images/facebook-on.png'" onmouseout="document.facebook.src='<?php echo __SCRIPT_PATH;?>images/facebook-off.png'" href="http://www.facebook.com/WafferApp" target="_blank">
			<img name="facebook" border="0" src="<?php echo __SCRIPT_PATH;?>images/facebook-off.png" width="123" height="58"/></a></td>
			<td style="width:123px" valign="top">
			<a onmouseover="document.twitter.src='<?php echo __SCRIPT_PATH;?>images/twitter-on.png'" onmouseout="document.twitter.src='<?php echo __SCRIPT_PATH;?>images/twitter-off.png'" href="http://www.twitter.com/WafferApp" target="_blank">
			<img name="twitter" border="0" src="<?php echo __SCRIPT_PATH;?>images/twitter-off.png" width="123" height="58"/></a></td>
			<td align="right" valign="middle">
			<a onmouseover="document.NAME3.src='<?php echo __SCRIPT_PATH;?>images/a3len-on.png'" onmouseout="document.NAME3.src='<?php echo __SCRIPT_PATH;?>images/a3len-off.png'" href="<?php echo __LINK_PATH;?>pages/display_page/Member/2/">
			<img name="NAME3" border="0" src="<?php echo __SCRIPT_PATH;?>images/a3len-off.png" width="82" height="28"/></a></td>
			<td align="center" valign="middle" style="width:35px;"><img alt="" src="<?php echo __SCRIPT_PATH;?>images/menu-line.jpg" width="2" height="16" /></td>
			<td align="right" valign="middle" style="width:113px;">
			<a onmouseover="document.NAME2.src='<?php echo __SCRIPT_PATH;?>images/keef-on.png'" onmouseout="document.NAME2.src='<?php echo __SCRIPT_PATH;?>images/keef-off.png'" href="<?php echo __LINK_PATH;?>pages/display_page/Member/1/">
			<img name="NAME2" border="0" src="<?php echo __SCRIPT_PATH;?>images/keef-off.png" width="113" height="33"/></a></td>
			<td align="center" valign="middle" style="width:35px;"><img alt="" src="<?php echo __SCRIPT_PATH;?>images/menu-line.jpg" width="2" height="16" /></td>
			<td align="right" valign="middle" style="width:129px;">
			<a onmouseover="document.NAME1.src='<?php echo __SCRIPT_PATH;?>images/home-on.png'" onmouseout="document.NAME1.src='<?php echo __SCRIPT_PATH;?>images/home-off.png'" href="<?php echo __LINK_PATH;?>">
			<img name="NAME1" border="0" src="<?php echo __SCRIPT_PATH;?>images/home-off.png" width="129" height="28"/></a></td>
		</tr>
	</table>
</div>
</div>


<div id="content">
<table style="width: 100%" cellspacing="0" cellpadding="0">
<tr>
<td valign="top" style="width: 658px">
<div id="header">
<div class="slider-wrapper theme-default">
<div class="ribbon"></div>
<div id="slider" class="nivoSlider" style="left: 0px; top: 0px">
<?php
$myfunctions = new myfunctions();
$myfunctions->display_banner();
?>
</div>
</div>
 <script type="text/javascript" src="<?php echo __SCRIPT_PATH;?>js/jquery.nivo.slider.pack.js"></script>
    <script type="text/javascript">
    $(window).load(function() {
        $('#slider').nivoSlider();
    });
    </script>
</div>
<div id="services-waffer">
	<table cellspacing="0" cellpadding="0">
		<tr>
			<td style="padding-right:3px;"><a onmouseover="document.services4.src='<?php echo __SCRIPT_PATH;?>images/services4-on.png'" onmouseout="services4.src='<?php echo __SCRIPT_PATH;?>images/services4-off.png'" href="<?php echo __LINK_PATH;?>services/display_offer/Member/4/">
			<img name="services4" border="0" src="<?php echo __SCRIPT_PATH;?>images/services4-off.png" width="106" height="90"/></a></td>
			<td style="padding-right:3px;"><a onmouseover="document.services3.src='<?php echo __SCRIPT_PATH;?>images/services3-on.png'" onmouseout="services3.src='<?php echo __SCRIPT_PATH;?>images/services3-off.png'" href="<?php echo __LINK_PATH;?>services/display_offer/Member/5/">
			<img name="services3" border="0" src="<?php echo __SCRIPT_PATH;?>images/services3-off.png" width="106" height="90"/></a></td>
			<td style="padding-right:3px;"><a onmouseover="document.services2.src='<?php echo __SCRIPT_PATH;?>images/services2-on.png'" onmouseout="services2.src='<?php echo __SCRIPT_PATH;?>images/services2-off.png'" href="<?php echo __LINK_PATH;?>services/display_offer/Member/6/">
			<img name="services2" border="0" src="<?php echo __SCRIPT_PATH;?>images/services2-off.png" width="106" height="90"/></a></td>
			<td><a onmouseover="document.services1.src='<?php echo __SCRIPT_PATH;?>images/services1-on.png'" onmouseout="services1.src='<?php echo __SCRIPT_PATH;?>images/services1-off.png'" href="<?php echo __LINK_PATH;?>services/display_offer/Member/7/">
			<img name="services1" border="0" src="<?php echo __SCRIPT_PATH;?>images/services1-off.png" width="106" height="90"/></a></td>
		</tr>
	</table>
</div>
<div id="test-all">
<?php
$registry->router->loader();
?>

<div class="text-bottom">
<img alt="" src="<?php echo __SCRIPT_PATH;?>images/text-bottom.png" width="614" height="9" /></div>
</div>
</td>
<td valign="top" style="width: 288px">
<div id="download-bg">
<div class="download-icons">
<a onmouseover="document.iphone.src='<?php echo __SCRIPT_PATH;?>images/iphone-on.png'" onmouseout="document.iphone.src='<?php echo __SCRIPT_PATH;?>images/iphone-off.png'" href="http://itunes.apple.com/jo/app/waffer/id518659562?mt=8" target="_blank">
<img name="iphone" border="0" src="<?php echo __SCRIPT_PATH;?>images/iphone-off.png" width="107" height="31"/></a>
</div>
<div class="download-icons">
<a onmouseover="document.android.src='<?php echo __SCRIPT_PATH;?>images/android-on.png'" onmouseout="document.android.src='<?php echo __SCRIPT_PATH;?>images/android-off.png'" href="https://play.google.com/store/apps/details?id=com.Waffer.Waffer&feature=search_result#?t=W251bGwsMSwyLDEsImNvbS5XYWZmZXIuV2FmZmVyIl0" target="_blank">
<img name="android" border="0" src="<?php echo __SCRIPT_PATH;?>images/android-off.png" width="107" height="31"/></a>
</div>
<div class="download-icons">
<a onmouseover="document.ovi.src='<?php echo __SCRIPT_PATH;?>images/ovi-on.png'" onmouseout="document.ovi.src='<?php echo __SCRIPT_PATH;?>images/ovi-off.png'" href="#z">
<img name="ovi" border="0" src="<?php echo __SCRIPT_PATH;?>images/ovi-off.png" width="106" height="31"/></a>
</div>
<div class="download-icons">
<a onmouseover="document.blackberry.src='<?php echo __SCRIPT_PATH;?>images/blackberry-on.png'" onmouseout="document.blackberry.src='<?php echo __SCRIPT_PATH;?>images/blackberry-off.png'" href="http://appworld.blackberry.com/webstore/content/107666/?lang=en" target="_blank">
<img name="blackberry" border="0" src="<?php echo __SCRIPT_PATH;?>images/blackberry-off.png" width="107" height="31"/></a>
</div>
</div>

<div id="right-menu">
<div id="menu-title"><img alt="" src="<?php echo __SCRIPT_PATH;?>images/fe2at-waffer.png" width="137" height="36" /></div>
<div id="menu-middle">
	<table style="width: 100%" cellspacing="0" cellpadding="0">
		<tr>
			<td valign="top" style="width: 86px">
			<a onmouseover="document.icon1.src='<?php echo __SCRIPT_PATH;?>images/mta3em-on.png'" onmouseout="icon1.src='<?php echo __SCRIPT_PATH;?>images/mta3em-off.png'" href="<?php echo __LINK_PATH;?>store/display_offer/Member/3/">
			<img name="icon1" border="0" src="<?php echo __SCRIPT_PATH;?>images/mta3em-off.png" width="80" height="72"/></a></td>
			<td valign="top" align="center" style="width: 86px">
			<a onmouseover="document.icon2.src='<?php echo __SCRIPT_PATH;?>images/cofe-on.png'" onmouseout="icon2.src='<?php echo __SCRIPT_PATH;?>images/cofe-off.png'" href="<?php echo __LINK_PATH;?>store/display_offer/Member/8/">
			<img name="icon2" border="0" src="<?php echo __SCRIPT_PATH;?>images/cofe-off.png" width="80" height="72"/></a></td>
			<td valign="top" align="left">
			<a onmouseover="document.icon3.src='<?php echo __SCRIPT_PATH;?>images/sport-on.png'" onmouseout="icon3.src='<?php echo __SCRIPT_PATH;?>images/sport-off.png'" href="<?php echo __LINK_PATH;?>store/display_offer/Member/15/">
			<img name="icon3" border="0" src="<?php echo __SCRIPT_PATH;?>images/sport-off.png" width="80" height="72"/></a></td>
		</tr>
		<tr>
			<td valign="top" style="width: 86px; padding-top:14px;">
			<a onmouseover="document.icon4.src='<?php echo __SCRIPT_PATH;?>images/game-on.png'" onmouseout="icon4.src='<?php echo __SCRIPT_PATH;?>images/game-off.png'" href="<?php echo __LINK_PATH;?>store/display_offer/Member/16/">
			<img name="icon4" border="0" src="<?php echo __SCRIPT_PATH;?>images/game-off.png" width="80" height="72"/></a>
			</td>
			<td valign="top" align="center" style="width: 86px; padding-top:14px;">
			<a onmouseover="document.icon5.src='<?php echo __SCRIPT_PATH;?>images/daily-on.png'" onmouseout="icon5.src='<?php echo __SCRIPT_PATH;?>images/daily-off.png'" href="<?php echo __LINK_PATH;?>store/display_offer/Member/10/">
			<img name="icon5" border="0" src="<?php echo __SCRIPT_PATH;?>images/daily-off.png" width="80" height="72"/></a>
			</td>
			<td valign="top" align="left" style="padding-top:14px;">
			<a onmouseover="document.icon6.src='<?php echo __SCRIPT_PATH;?>images/electronic-on.png'" onmouseout="icon6.src='<?php echo __SCRIPT_PATH;?>images/electronic-off.png'" href="<?php echo __LINK_PATH;?>store/display_offer/Member/9/">
			<img name="icon6" border="0" src="<?php echo __SCRIPT_PATH;?>images/electronic-off.png" width="80" height="72"/></a>
			</td>
		</tr>
		<tr>
			<td valign="top" style="width: 86px; padding-top:14px;">
			<a onmouseover="document.icon7.src='<?php echo __SCRIPT_PATH;?>images/gifts-on.png'" onmouseout="icon7.src='<?php echo __SCRIPT_PATH;?>images/gifts-off.png'" href="<?php echo __LINK_PATH;?>store/display_offer/Member/17/">
			<img name="icon7" border="0" src="<?php echo __SCRIPT_PATH;?>images/gifts-off.png" width="80" height="72"/></a>
			</td>
			<td valign="top" align="center" style="width: 86px; padding-top:14px;">
			<a onmouseover="document.icon8.src='<?php echo __SCRIPT_PATH;?>images/clouth-on.png'" onmouseout="icon8.src='<?php echo __SCRIPT_PATH;?>images/clouth-off.png'" href="<?php echo __LINK_PATH;?>store/display_offer/Member/13/">
			<img name="icon8" border="0" src="<?php echo __SCRIPT_PATH;?>images/clouth-off.png" width="80" height="72"/></a>
			</td>
			<td valign="top" align="left" style="padding-top:14px;">
			<a onmouseover="document.icon9.src='<?php echo __SCRIPT_PATH;?>images/travel-on.png'" onmouseout="icon9.src='<?php echo __SCRIPT_PATH;?>images/travel-off.png'" href="<?php echo __LINK_PATH;?>store/display_offer/Member/11/">
			<img name="icon9" border="0" src="<?php echo __SCRIPT_PATH;?>images/travel-off.png" width="80" height="72"/></a>
			</td>
		</tr>
		<tr>
			<td valign="top" style="width: 86px; padding-top:14px;">
			<a onmouseover="document.icon10.src='<?php echo __SCRIPT_PATH;?>images/umrah-on.png'" onmouseout="icon10.src='<?php echo __SCRIPT_PATH;?>images/umrah-off.png'" href="<?php echo __LINK_PATH;?>store/display_offer/Member/12/">
			<img name="icon10" border="0" src="<?php echo __SCRIPT_PATH;?>images/umrah-off.png" width="80" height="72"/></a>
			</td>
			<td valign="top" align="center" style="width: 86px; padding-top:14px;">
			<a onmouseover="document.icon11.src='<?php echo __SCRIPT_PATH;?>images/furniture-on.png'" onmouseout="icon11.src='<?php echo __SCRIPT_PATH;?>images/furniture-off.png'" href="<?php echo __LINK_PATH;?>store/display_offer/Member/18/">
			<img name="icon11" border="0" src="<?php echo __SCRIPT_PATH;?>images/furniture-off.png" width="80" height="72"/></a>
			</td>
			<td valign="top" align="left" style="padding-top:14px;">
			<a onmouseover="document.icon12.src='<?php echo __SCRIPT_PATH;?>images/shop-on.png'" onmouseout="icon12.src='<?php echo __SCRIPT_PATH;?>images/shop-off.png'" href="<?php echo __LINK_PATH;?>store/display_offer/Member/14/">
			<img name="icon12" border="0" src="<?php echo __SCRIPT_PATH;?>images/shop-off.png" width="80" height="72"/></a>
			</td>
		</tr>
	</table>
</div>
<div class="menu-bottom"><img alt="" src="<?php echo __SCRIPT_PATH;?>images/right-menu-bottom.png" width="297" height="9" /></div>
</div>
</td>
</tr>
</table>
</div>
</div>
</div>

<div class="footer-all">
<div class="footer-jeans">
<center>
<div id="footer-content" style="height: 100%">
	<table cellspacing="0" cellpadding="0" style="float:right; margin-bottom:12px;">
		<tr>
			<td style="width:150px">
			<div class="footer-titles"><img alt="" src="<?php echo __SCRIPT_PATH;?>images/menu-1.png" width="77" height="21" /></div>
			<img alt="" src="<?php echo __SCRIPT_PATH;?>images/arrow-footer.png" width="3" height="10" />&nbsp;
			<a href="<?php echo __LINK_PATH;?>" class="footer">الصفحة الرئيسية</a> <br/>
			<img alt="" src="<?php echo __SCRIPT_PATH;?>images/arrow-footer.png" width="3" height="10" />&nbsp;
<a href="<?php echo __LINK_PATH;?>pages/display_page/Member/1/" class="footer">كيف يعمل وفر %</a><br/>
			<img alt="" src="<?php echo __SCRIPT_PATH;?>images/arrow-footer.png" width="3" height="10" />&nbsp;
<a href="<?php echo __LINK_PATH;?>pages/display_page/Member/2/" class="footer">أعلن معنا</a><br/>
			
			</td>
			<td style="width:150px">
			<div class="footer-titles">
				<img alt="" src="<?php echo __SCRIPT_PATH;?>images/menu-2.png" width="85" height="21" /></div>
			<img alt="" src="<?php echo __SCRIPT_PATH;?>images/arrow-footer.png" width="3" height="10" />&nbsp;
<a href="<?php echo __LINK_PATH;?>services/display_offer/Member/7/" class="footer">عروض </a><br/>
			<img alt="" src="<?php echo __SCRIPT_PATH;?>images/arrow-footer.png" width="3" height="10" />&nbsp;
<a href="<?php echo __LINK_PATH;?>services/display_offer/Member/6/" class="footer">وصل حديثا</a><br/>
			<img alt="" src="<?php echo __SCRIPT_PATH;?>images/arrow-footer.png" width="3" height="10" />&nbsp;
<a href="<?php echo __LINK_PATH;?>services/display_offer/Member/5/" class="footer">تنزيلات</a><br/>
			<img alt="" src="<?php echo __SCRIPT_PATH;?>images/arrow-footer.png" width="3" height="10" />&nbsp;
<a href="<?php echo __LINK_PATH;?>services/display_offer/Member/4/" class="footer">بطاقات خصم</a><br/>

			</td>
			<td style="width:110px">
			<div class="footer-titles">
				<img alt="" src="<?php echo __SCRIPT_PATH;?>images/menu-3.png" width="72" height="21" /></div>
			<img alt="" src="<?php echo __SCRIPT_PATH;?>images/arrow-footer.png" width="3" height="10" />&nbsp;
<a href="<?php echo __LINK_PATH;?>store/display_offer/Member/3/" class="footer">مطاعم </a><br/>
			<img alt="" src="<?php echo __SCRIPT_PATH;?>images/arrow-footer.png" width="3" height="10" />&nbsp;
<a href="<?php echo __LINK_PATH;?>store/display_offer/Member/8/" class="footer">كوفي شوب</a><br/>
			<img alt="" src="<?php echo __SCRIPT_PATH;?>images/arrow-footer.png" width="3" height="10" />&nbsp;
<a href="<?php echo __LINK_PATH;?>store/display_offer/Member/15/" class="footer">نوادي رياضية</a><br/>
			<img alt="" src="<?php echo __SCRIPT_PATH;?>images/arrow-footer.png" width="3" height="10" />&nbsp;
<a href="<?php echo __LINK_PATH;?>store/display_offer/Member/16/" class="footer">مراكز تسلية</a><br/>
			</td>
			<td style="width:120px; padding-top:25px;">
			<img alt="" src="<?php echo __SCRIPT_PATH;?>images/arrow-footer.png" width="3" height="10" />&nbsp;
<a href="<?php echo __LINK_PATH;?>store/display_offer/Member/10/" class="footer">مشتريات يومية </a><br/>
			<img alt="" src="<?php echo __SCRIPT_PATH;?>images/arrow-footer.png" width="3" height="10" />&nbsp;
<a href="<?php echo __LINK_PATH;?>store/display_offer/Member/9/" class="footer">الكترونيات</a><br/>
			<img alt="" src="<?php echo __SCRIPT_PATH;?>images/arrow-footer.png" width="3" height="10" />&nbsp;
<a href="<?php echo __LINK_PATH;?>store/display_offer/Member/17/" class="footer">هدايا وألعاب</a><br/>
			<img alt="" src="<?php echo __SCRIPT_PATH;?>images/arrow-footer.png" width="3" height="10" />&nbsp;
<a href="<?php echo __LINK_PATH;?>store/display_offer/Member/13/" class="footer">ملابس</a><br/>
			</td>
<td style="width:120px; padding-top:25px;">
			<img alt="" src="<?php echo __SCRIPT_PATH;?>images/arrow-footer.png" width="3" height="10" />&nbsp;
<a href="<?php echo __LINK_PATH;?>store/display_offer/Member/11/" class="footer">سياحة وسفر </a><br/>
			<img alt="" src="<?php echo __SCRIPT_PATH;?>images/arrow-footer.png" width="3" height="10" />&nbsp;
<a href="<?php echo __LINK_PATH;?>store/display_offer/Member/12/" class="footer">حج وعمرة</a><br/>
			<img alt="" src="<?php echo __SCRIPT_PATH;?>images/arrow-footer.png" width="3" height="10" />&nbsp;
<a href="<?php echo __LINK_PATH;?>store/display_offer/Member/18/" class="footer">مفروشات</a><br/>
			<img alt="" src="<?php echo __SCRIPT_PATH;?>images/arrow-footer.png" width="3" height="10" />&nbsp;
<a href="<?php echo __LINK_PATH;?>store/display_offer/Member/14/" class="footer">اكسسوارات وتجميل</a><br/>
			</td>

			<td style="width:230px; padding-left:10px; padding-top:75px" align="left" valign="bottom">
			<map name="FPMap0" id="FPMap0">
			<area href="http://www.facebook.com/WafferApp" target="_blank" shape="rect" coords="32, 0, 59, 25" />
			<area href="#z" shape="rect" target="_blank" coords="2, 2, 30, 28" />
			</map>
			<img alt="" src="<?php echo __SCRIPT_PATH;?>images/socialmedia.png" width="60" height="29" usemap="#FPMap0" border="0" /></td>
		</tr>
	</table>
	
<div id="softile">Copyright © 2012 <a href="#z" class="soft">wafferapp.com</a> , All rights reserved.Powered By :
<a href="http://www.softilesolutions.com/" style="font-size: 11px" target="_blank">
						Softile Solutions
					</a>
 </div>
</div>
</center>
</div>
</div>


</div>
</body>
</html>
