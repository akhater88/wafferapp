<?php
//session_set_cookie_params(time()+3600,'/',__COOKIE_PATH,false,true); 
session_start();
date_default_timezone_set('Asia/Amman');
 /*** include the controller class ***/
 include __SITE_PATH . '/application/' . 'controller_base.class.php';

 /*** include the registry class ***/
 include __SITE_PATH . '/application/' . 'registry.class.php';

 /*** include the router class ***/
 include __SITE_PATH . '/application/' . 'router.class.php';

 /*** include the template class ***/
 include __SITE_PATH . '/application/' . 'template.class.php';
 
 include __SITE_PATH . '/application/' . 'error_status.class.php';

 /*** auto load model classes ***/ 
    function __autoload($class_name) {
    $filename = strtolower($class_name) . '.class.php';
    $file = __SITE_PATH . '/model/' . $filename;

    if (file_exists($file) == false)
    {
        return false;
    }
  include ($file);
}

 /*** a new registry object ***/
$registry = new registry;
$registry->router = new router($registry);
/*** set the controller path ***/
$registry->router->setPath (__SITE_PATH . '/controller');
/*** load up the template ***/
$registry->template = new template($registry);

$URL = new url();
$AJAX  = $URL->getPar('AJAX');
$Content_Title = $URL->getPar('mypanel');
if($AJAX == 'Y')
	{
		ob_start();
		//header('Transfer-Encoding: chunked');
		$registry->router->loader();
		ob_end_flush();
	}
elseif($AJAX == 'Pop_Up')
	{
	?>
	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
	<?php
		ob_start();
		$registry->router->loader();
		ob_end_flush();
	}
else
	{
		include('Temp.php');
	}
?>
