<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
class create_member
	{
		function __construct()
			{
				$this->db = db::getInstance();
				//$_SESSION['Errors'] = array();
			}
		public function getPasswordSalt()
			{
				return substr(str_pad(dechex(mt_rand()),8,'0',STR_PAD_LEFT ), -8);
				//return '10000';
			}
		// calculate the hash from a salt and a password
		public function getPasswordHash($salt,$password)
			{
				return hash('whirlpool',$salt.$password);
			}
		
		// compare a password to a hash
		public function comparePassword($password,$hash)
			{
				$salt = substr( $hash, 0, 8 );
				return $hash == getPasswordHash($salt,$password);
			}
		public function Insert($sql,$Execute_Array)
			{
				$stmt = $this->db->prepare($sql);
				$stmt->execute($Execute_Array);
			}
		public function Edit($First_Name,$Last_Name,$user_name,$Enc_PW='',$b_date,$Level,$Salt='',$Hidden_ID)
			{
				if($Enc_PW != NULL)
					{
						$sql = "UPDATE users SET First_Name = ?,Last_Name = ?, user_name = ?, password = ?,Level = ?, Salt = ? WHERE ID = ?";
						$stmt = $this->db->prepare($sql);
						$stmt->execute(array($First_Name,$Last_Name,$user_name,$Enc_PW,$Level,$Salt,$Hidden_ID));
					}
				else
					{
						$sql = "UPDATE users SET First_Name = ?,Last_Name = ?, user_name = ?,Level = ? WHERE ID = ?";
						$stmt = $this->db->prepare($sql);
						$stmt->execute(array($First_Name,$Last_Name,$user_name,$Level,$Hidden_ID));
					}
				
			}
		public function Display_Member_To_Edit($sql,$ID)
			{
				$stmt = $this->db->prepare($sql);
				$stmt->setFetchMode(PDO::FETCH_OBJ);
				$stmt->bindParam(':ID',$ID);
				$stmt->execute();
				$results = $stmt->fetchAll();
				return $results;
			}
		public function Display_Info($sql,$Execute_Array)
			{
				$stmt = $this->db->prepare($sql);
				$stmt->setFetchMode(PDO::FETCH_OBJ);
				$stmt->execute($Execute_Array);
				$results = $stmt->fetchAll();
				return $results;
			}
		public function Delete_Member($ID)
			{
				$sql = 'DELETE FROM users WHERE ID = ?';
				$stmt = $this->db->prepare($sql);
				$stmt->execute(array($ID));
			}
		function __destruct()
			{
				$this->db = NULL;
			}
	}
?>