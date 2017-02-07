<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
class verify_login_customer
	{
		function __construct()
			{
				$this->db = db::getInstance();
				//$_SESSION['Errors'] = array();
			}
		private function verify_username($user_name)
			{
				$sql = 'SELECT ID FROM customers WHERE Email = ?';
				$stmt = $this->db->prepare($sql);
				$stmt->execute(array($user_name));
				$count = $stmt->rowCount();
				return $count;
			}
		private function get_salt($user_name)
			{
				$sql = 'SELECT Salt FROM customers WHERE Email = ?';
				$stmt = $this->db->prepare($sql);
				$stmt->setFetchMode(PDO::FETCH_OBJ);
				$stmt->execute(array($user_name));
				$results = $stmt->fetch();
				$Salt = $results->Salt;
				return $Salt;
			}
		private function get_DB_pw($user_name)
			{
				$sql = 'SELECT Password FROM customers WHERE Email = ?';
				$stmt = $this->db->prepare($sql);
				$stmt->setFetchMode(PDO::FETCH_OBJ);
				$stmt->execute(array($user_name));
				$results = $stmt->fetch();
				$password = $results->Password;
				return $password;
			}
		public function getPasswordHash($salt,$password)
			{
				return hash('whirlpool',$salt.$password);
			}
		private function get_user_id($user_name,$Password)
			{
				$sql = 'SELECT ID FROM customers WHERE Email = ? AND Password = ?';
				$stmt = $this->db->prepare($sql);
				$stmt->setFetchMode(PDO::FETCH_OBJ);
				$stmt->execute(array($user_name,$Password));
				$results = $stmt->fetch();
				$ID = $results->ID;
				return $ID;
			}
		public function verify_pw($user_name,$password)
			{
				$Is_User = $this->verify_username($user_name);
				if($Is_User)
					{
						$Salt = $this->get_salt($user_name);
						$user_password = $this->getPasswordHash($Salt,$password);
						$DB_password = $this->get_DB_pw($user_name);
						if($user_password == $DB_password)
							{
								$sql = 'SELECT First_Name, Last_Name FROM customers WHERE Email = ? AND Password = ?';
								$stmt = $this->db->prepare($sql);
								$stmt->setFetchMode(PDO::FETCH_OBJ);
								$stmt->execute(array($user_name,$user_password));
								$results = $stmt->fetchAll();
								foreach($results as $rows)
									{
										$First_Name = $rows->First_Name;
										$Last_Name = $rows->Last_Name;
										$_SESSION['Customer_ID'] = $this->get_user_id($user_name,$user_password);
										$_SESSION['Customer_Name_Session'] = $First_Name.' '.$Last_Name;
									
									}
									?>
									<script language="javascript">
									window.location = '<?php echo __LINK_PATH;?>index/';
									</script>
									<?
							}
						else
							{
							$_SESSION['Errors']['LogIn'] = 'خـطـأ فـي مـعـلـومـات التـسـجـيــل';
								?>
								<script language="javascript">
								window.location = '<?php echo __LINK_PATH;?>index/E/s/';
								</script>
								<?
							}
					}
				else
					{
					$_SESSION['Errors']['LogIn'] = 'خـطـأ فـي مـعـلـومـات التـسـجـيــل';
						?>
						<script language="javascript">
						window.location = '<?php echo __LINK_PATH;?>index/E/s/';
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