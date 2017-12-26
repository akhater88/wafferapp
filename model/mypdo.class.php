<?php
class mypdo
	{
		function __construct()
			{
				$this->db = db::getInstance();
				$this->sql = '';
				$this->stmt = '';
			}
		private function Prepare()
			{
				$this->sql = 'SELECT user_name FROM users WHERE name = :name';
				$this->stmt = $this->db->prepare($this->sql);
				$this->stmt->setFetchMode(PDO::FETCH_OBJ);
			}
		private function getPasswordSalt()
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

		//This function is used to verify login credentials:
		public function Create_Salt($password)
			{
				$x = $this->getPasswordHash($this->getPasswordSalt(),$password);
				return $x;
			}
		public function Insert()
			{
			
			}
		//To have more than one parameter, you can add a parameter to the method below in the
		//form of an array. Then put a foreach loop after you call the 'prepare' method.
		public function Retrieve()
			{
				$Name = 'softile';
				//$Status2 = '2';
				$this->Prepare();
				$this->stmt->bindParam(':name',$Name);
				//$this->stmt->bindParam(':Status2',$Status2);
				$this->stmt->execute();
				$results = $this->stmt->fetchAll();
				
				return $results;
				/*foreach ($this->db->query($sql) as $row)
					{
					print $row['FirstName'] .' - '. $row['LastName'] . '<br />';
					}*/



				


				//$result = $sth->fetch(PDO::FETCH_ASSOC);

				//return $result;
				//echo $obj->FirstName.'<br />';
    			//echo $obj->LastName.'<br />';

				//$yellow = $sth->fetchAll();
				//echo $yellow[0][1];
			}
		function __destruct()
			{
				$this->db = NULL;
			}
	}
?>