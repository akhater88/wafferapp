<?php
				 /*** error reporting on ***/
				 define ('DEVELOPMENT_ENVIRONMENT',false);
				 //error_reporting(E_ALL);
				
				 /*** define the site path ***/
				 $site_path = realpath(dirname(__FILE__));
				 $Inner_Path = $site_path.'/';
 				 define ('__INNER_PATH', $Inner_Path);
				 define ('__SITE_PATH', $site_path);
				 define ('__COOKIE_PATH', 'http://www.wafferapp.com/');
				 define('__SCRIPT_PATH','http://www.wafferapp.com/includes/');
				 define('__LINK_PATH','http://www.wafferapp.com/');
				 define('__LINK_PATH_CMS','http://www.wafferapp.com/mypanel/');
				  define('__IMAGE_PATH','http://www.wafferapp.com/mypanel/includes/');
				 define('__CACHE','./cache/');
				 /*** include the init.php file ***/
				 include 'includes/init.php';
				 /*** load the router ***/
				
				?>