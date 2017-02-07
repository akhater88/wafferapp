<?php
$Allowed_Users = array('1','2','3','4','5');
validate_roles_new::validate($Allowed_Users);
class mymembershipController extends baseController {
public function index() 
	{
		
	}
public function welcome() 
	{
		$this->registry->template->show('mymembership/welcome');
	}
}

?>
