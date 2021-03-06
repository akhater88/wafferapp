<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
class verify_mobile_user
	{
		function __construct()
			{
				$this->Display = new sql();
			}
		private function verify_username($Email)
			{
				$sql = 'SELECT ID FROM mobile_users WHERE Email = ? AND Status != ?';
				$Execute_Array = array($Email,'0');
				$Total_Count = $this->Display->Total_Records($sql,$Execute_Array);
				return $Total_Count;
			}
		private function get_salt($Email)
			{
				$sql = 'SELECT Salt FROM mobile_users WHERE Email = ? AND Status != ?';
				$Execute_Array = array($Email,'0');
				$Salt = $this->Display->Display_Single_Info_Modified($sql,'Salt',$Execute_Array);
				return $Salt;
			}
		private function get_DB_pw($Email)
			{
				$sql = 'SELECT PW FROM mobile_users WHERE Email = ? AND Status != ?';
				$Execute_Array = array($Email,'0');
				$password = $this->Display->Display_Single_Info_Modified($sql,'PW',$Execute_Array);
				return $password;
			}
		public function getPasswordHash($salt,$password)
			{
				return hash('whirlpool',$salt.$password);
			}
		public function verify_pw($Email,$PW,$Time_Stamp)
			{
				$Is_User = $this->verify_username($Email);
				if($Is_User)
					{
						$Salt = $this->get_salt($Email);
						$user_password = $this->getPasswordHash($Salt,$PW);
						$DB_password = $this->get_DB_pw($Email);
						if($user_password == $DB_password)
							{
								$myTweets = array("flag" => '0');
								$this->Display->Write_JSON($Time_Stamp,$myTweets);
								$sql ='SELECT ID,Country_ID FROM mobile_users WHERE Email = ? AND PW = ? AND Status != ?';
								$Execute_Array = array($Email,$user_password,'0');
								$results = $this->Display->Display_Info($sql,$Execute_Array);
								foreach($results as $rows)
									{
										$_SESSION['Mobile_User_ID'] = $rows->ID;
										$_SESSION['Mobile_User_Country'] = $rows->Country_ID;
										$_SESSION['Mobile_User_Auth'] =  true;
										$_SESSION['Location_Indicator'] = __LINK_PATH;
									}
							}
						else
							{
								$_SESSION['Mobile_User_Auth'] =  false;
								$myTweets = array("flag" => '1');
								$this->Display->Write_JSON($Time_Stamp,$myTweets);
							}
					}
				else
					{
						$_SESSION['Mobile_User_Auth'] =  false;
						$myTweets = array("flag" => '1');
						$this->Display->Write_JSON($Time_Stamp,$myTweets);
					}
			}
		
		
		function __destruct()
			{
				
			}
	}
?>