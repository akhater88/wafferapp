<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
switch($Content_Title)
	{
		case 'statistics':
		$Page_Title = 'الاحصــــائيـــات';
		break;
		
		case 'members':
		$Page_Title = 'الإداريــون';
		break;
		
		case 'ads':
		$Content_Title_Parent = $URL->getPar('ads');
		if($Content_Title_Parent == 'ads_cat')
			{
				$Page_Title = 'الـتـصـنـيـف الـدعــائــي';
			}
		else
			{
				$Page_Title = 'الـتـصـنـيـف الـدعــائــي الـفـرعــي';
			}
		
		break;
		
		case 'countries':
		$Page_Title = 'الـبـلـدان';
		break;
		
		case 'adminprizes':
		$Page_Title = 'الـجـوائــز';
		break;
		
		case 'country_admin':
		$Content_Title_Parent = $URL->getPar('country_admin');
		if($Content_Title_Parent == 'sales_offer')
			{
				$Page_Title = 'الـصـفـحـة الـرئـيـسـيــة';
			}
		elseif($Content_Title_Parent == 'show_account')
			{
				$Page_Title = 'تـغـيــيـر الـمـعـلـومـات الـعـامــة';
			}  
		else
			{
				$Page_Title = 'تـغـيـيـر كـلـمــة الـســر';
			}
		
		break;
		
		case 'my_plain_images_banner':
		$Page_Title = 'صــور الـبـانــر';
		break;
		
		case 'adminadvertisers':
		$Content_Title_Parent = $URL->getPar('adminadvertisers');
		if($Content_Title_Parent == 'pending_offer')
			{
				$Page_Title = 'الـعـروض قـيـد الـمـوافـقــة';
			}
		else
			{
				$Page_Title = 'بـحـث الـعـروض';
			}
		
		break;
		
		case 'admin_search':
		$Page_Title = 'بـحـث الـمـسـتـخـدمـيــن';
		break;
		
		case 'adminreports':
		$Page_Title = 'تـقـاريـر الـمـبـيـعــات';
		break;
		
		case 'coupons':
		$Content_Title_Parent = $URL->getPar('coupons');
		if($Content_Title_Parent == 'step_one')
			{
				$Page_Title = 'عـرض الـكـوبـانـات';
			}
		elseif($Content_Title_Parent == 'merchants_coupon')
			{
				$Page_Title = 'عـرض الـكـوبـانـات';
			} 
		else
			{
				$Page_Title = 'بـحـث الـكـوبـانـات';
			}
		
		break;
		
		case 'sales':
		$Content_Title_Parent = $URL->getPar('sales');
		if($Content_Title_Parent == 'step_one')
			{
				$Page_Title = 'عـرض الـكـوبـانـات';
			}
		elseif($Content_Title_Parent == 'verify_type')
			{
				$Page_Title = 'إضـافــة عـمـيــل';
			} 
		else
			{
				$Page_Title = 'تـعـديــل عـمـيــل';
			}
		
		break;
		
		case 'index':
		if(isset($_SESSION['User_Name_Session']))
			{
				$Page_Title = 'اهلا بك '.$_SESSION['User_Name_Session'];
			}
		break;
		
		case 'advertisers':
		$Content_Title_Parent = $URL->getPar('advertisers');
		if($Content_Title_Parent == 'home')
			{
				$Page_Title = 'اهلا بك '.$_SESSION['User_Name_Session'];
			}
		elseif($Content_Title_Parent == 'show_account')
			{
				$Page_Title = 'تـغـيـيـر الـمـعـلـومـات الـعــامــة';
			}
		elseif($Content_Title_Parent == 'edit_pw')
			{
				$Page_Title = 'تـغـيـيـر كـلـمــة الـســر';
			}
		elseif($Content_Title_Parent == 'add_offer')
			{
				$Page_Title = 'إضـافــة عـرض';
			}  
		elseif($Content_Title_Parent == 'edit_offer')
			{
				$Page_Title = 'تـعـديـل عـرض';
			}
		elseif($Content_Title_Parent == 'active_offer')
			{
				$Page_Title = 'عـروض مـفـعـلــة';
			}
		elseif($Content_Title_Parent == 'pending_offer')
			{
				$Page_Title = 'عـروض قـيـد الإنـجــاز';
			} 
		elseif($Content_Title_Parent == 'returned_offer')
			{
				$Page_Title = 'عـروض مـرجـعــة';
			} 
		elseif($Content_Title_Parent == 'expired_offer')
			{
				$Page_Title = 'عـروض مـنـتـهـيــة';
			} 
		elseif($Content_Title_Parent == 'draft_offer')
			{
				$Page_Title = 'مـسـودة الـعـروض';
			} 
		else
			{
				$Page_Title = ' ';
			}
		
		break;
		
		case 'operators':
		$Content_Title_Parent = $URL->getPar('operators');
		if($Content_Title_Parent == 'add_offer_step_one')
			{
				$Page_Title = 'إضـافـة عـرض';
			}
		elseif($Content_Title_Parent == 'add_offer')
			{
				$Page_Title = 'إضـافـة عـرض';
			}
		elseif($Content_Title_Parent == 'pending_offer')
			{
				$Page_Title = 'عـروض قـيـد الـمـوافـقــة';
			}
		elseif($Content_Title_Parent == 'search_my_offer')
			{
				$Page_Title = 'بـحــث الـعــروض';
			}  
		else
			{
				$Page_Title = ' ';
			}
		
		break;
		
		default:
		$Page_Title = ' ';
	}
?>
<link rel="stylesheet" href="<?php echo __SCRIPT_PATH;?>css/style.css" type="text/css" />
<link rel="stylesheet" type="text/css" href="<?php echo __SCRIPT_PATH;?>css/menu.css" />
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
<script type="text/javascript" src="<?php echo __SCRIPT_PATH;?>js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="<?php echo __SCRIPT_PATH;?>js/menu.js"></script>
<script type="text/javascript" src="<?php echo __SCRIPT_PATH;?>js/MyScript.js"></script>
<title></title>
<style type="text/css">
.style1 {
				border-color: #c0c0c0;
				border-width: 0;
}
.style2 {
				border-width: 0px;
}
</style>
</head>
<body>
<div class="bg-top">
<div id="wrapper">
<div id="header"></div>
<div id="menu">
	<table style="width: 100%; height: 100%" cellpadding="0" cellspacing="0" class="style1">
		<tr>
			<td style="padding-left:10px;">
			<?php
			$myfunctions = new myfunctions();
			$myfunctions->check_credentials('1');
			?>
			</td>
			<td align="left" valign="middle" style="width:77px;padding-left:10px;">
			<a href="<?php echo __LINK_PATH;?>members/LogOff">
			<img alt="" src="<?php echo __SCRIPT_PATH;?>images/exit.jpg" width="77" height="29" class="style2" border="0" /></a></td>
		</tr>
	</table>
</div>
</div>
</div>

<div class="content-bg">
<div id="wrapper">
<div id="content-title"><?php echo $Page_Title;?></div>
<div id="content">
<?php
	$registry->router->loader();
?>
</div>
<div id="content-bottom"></div>
</div>
</div>


<div class="footer-bg">
Copyright © 2012 --- All Rights Reserved. <br/>
Powered By AK

</div>


</body>
</html>
