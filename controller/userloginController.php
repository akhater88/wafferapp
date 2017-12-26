<?php
class userloginController extends baseController {

public function index() 
	{
		
	}
public function login() 
	{
	/*** set a template variable ***/
		$remember = @$_POST['remember'];
        $User_Name = $_POST['User_Name'];
		$PW = $_POST['PW'];
		$LogIn = new verify_login();
		
		$LogIn->verify_pw($User_Name,$PW,$remember);
	}
}

?>
