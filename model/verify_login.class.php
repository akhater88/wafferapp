<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
class verify_login
	{
		function __construct()
			{
				$this->db = db::getInstance();
				//$_SESSION['Errors'] = array();
			}
		private function verify_username($user_name)
			{
				$sql = "SELECT ID FROM users WHERE user_name = ? AND Status='1'";
				$stmt = $this->db->prepare($sql);
				$stmt->execute(array($user_name));
				$count = $stmt->rowCount();
				return $count;
			}
		private function get_salt($user_name)
			{
				$sql = "SELECT Salt FROM users WHERE user_name = ? AND Status='1'";
				$stmt = $this->db->prepare($sql);
				$stmt->setFetchMode(PDO::FETCH_OBJ);
				$stmt->execute(array($user_name));
				$results = $stmt->fetch();
				$Salt = $results->Salt;
				return $Salt;
			}
		private function get_DB_pw($user_name)
			{
				$sql = "SELECT password FROM users WHERE user_name = ? AND Status='1'";
				$stmt = $this->db->prepare($sql);
				$stmt->setFetchMode(PDO::FETCH_OBJ);
				$stmt->execute(array($user_name));
				$results = $stmt->fetch();
				$password = $results->password;
				return $password;
			}
		public function getPasswordHash($salt,$password)
			{
				return hash('whirlpool',$salt.$password);
			}
		private function get_user_id($user_name,$Password)
			{
				$sql = "SELECT ID FROM users WHERE user_name = ? AND password = ? AND Status='1'";
				$stmt = $this->db->prepare($sql);
				$stmt->setFetchMode(PDO::FETCH_OBJ);
				$stmt->execute(array($user_name,$Password));
				$results = $stmt->fetch();
				$ID = $results->ID;
				return $ID;
			}
		public function verify_pw($user_name,$password,$remember='')
			{
				$Is_User = $this->verify_username($user_name);
				if($Is_User)
					{
						$Salt = $this->get_salt($user_name);
						$user_password = $this->getPasswordHash($Salt,$password);
						$DB_password = $this->get_DB_pw($user_name);
						if($user_password == $DB_password)
							{
								$sql ="SELECT First_Name, Last_Name,Level,Country FROM users WHERE user_name = ? AND password = ? AND  Status='1'";
								$stmt = $this->db->prepare($sql);
								$stmt->setFetchMode(PDO::FETCH_OBJ);
								$stmt->execute(array($user_name,$user_password));
								$results = $stmt->fetchAll();
								foreach($results as $rows)
									{
										$First_Name = $rows->First_Name;
										$Last_Name = $rows->Last_Name;
										$_SESSION['User_ID'] = $this->get_user_id($user_name,$user_password);
										$_SESSION['User_Name_Session'] = $First_Name.' '.$Last_Name;
										$_SESSION['User_level_Session'] =  $rows->Level;
										if($remember)
											{
											 	setcookie("UserName",$user_name, time()+60*60*24*30, "/","www.wafferapp.com");
												setcookie("PW",$user_password, time()+60*60*24*30, "/", "www.wafferapp.com");
											}
										
										switch($rows->Level)
											{
												case '1':
												$URL = __LINK_PATH_CMS.'index/welcome/';
												break;
												
												case '2':
												$URL = __LINK_PATH_CMS.'advertisers/home/';
												break;
												
												case '3':
												$URL = __LINK_PATH_CMS.'index/welcome/';
												$_SESSION['Default_Country'] = $rows->Country;
												break;
												
												case '4':
												$URL = __LINK_PATH_CMS.'index/welcome/';
												$_SESSION['Default_Country'] = $rows->Country;
												break;
												
												case '5':
												$URL = __LINK_PATH_CMS.'country_admin/sales_offer/';
												$_SESSION['Default_Country'] = $rows->Country;
												break;
												
												default:
												$URL = __LINK_PATH_CMS.'index/welcome/';
											}
										
									}
									?>
									<script language="javascript">
									window.location = '<?php echo $URL;?>';
									</script>
									<?
							}
						else
							{
							$_SESSION['Errors']['LogIn'] = 'خـطـأ فـي مـعـلـومـات التـسـجـيــل';
								?>
								<script language="javascript">
								window.location = '<?php echo __LINK_PATH;?>index/s/';
								</script>
								<?
							}
					}
				else
					{
					$_SESSION['Errors']['LogIn'] = 'خـطـأ فـي مـعـلـومـات التـسـجـيــل';
						?>
						<script language="javascript">
						window.location = '<?php echo __LINK_PATH;?>index/s/';
						</script>
						<?
					}
			}
		
		
		function __destruct()
			{
				$this->db = NULL;
			}
	}
?>