<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
/*  /usr/bin/lynx -source http://www.hirewebcompany.com/mymvc_test/newsletter/run_cron */
$Allowed_Users = array('1');
validate_roles_new::validate($Allowed_Users);
class cronController extends baseController {
			
		public function index() 
			{
				
			}
		public function update_expired_offers() //Sets expired offers to status 3
			{
				$Display = new sql();
				$Today = date('Y-m-d');
				$sql = 'UPDATE offers_english SET Status = ? WHERE End_Date <= ? AND Status != ?';
				$Execute_Array = array('3',$Today,'0');
				$Display->Execute($sql,$Execute_Array);
			}
		public function update_valid_offers() //Sets expired offers to status 1 to become active
			{
				$Display = new sql();
				$Today = date('Y-m-d');
				$sql = 'UPDATE offers_english SET Status = ? WHERE End_Date > ? AND Status = ?';
				$Execute_Array = array('1',$Today,'3');
				$Display->Execute($sql,$Execute_Array);
			}
}

?>
