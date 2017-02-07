<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
class enc
	{
		function __construct()
			{
				$this->db = db::getInstance();
				$_SESSION['Credentials'] = array();
			}
		private function Initiate($sql,$Field,$Execute_Array='')
			{
				$stmt = $this->db->prepare($sql);
				$stmt->setFetchMode(PDO::FETCH_OBJ);
				if(is_array($Execute_Array))
					{
						$stmt->execute($Execute_Array);
					}
				else
					{
						$stmt->execute();
					}
				$results = $stmt->fetchAll();
				foreach($results as $rows)
					{
						return $rows->$Field;
					}
			}
		public function Encrypt($string)
			{
				$sql = "SELECT My_Key FROM application WHERE ID = ?";
				$Execute_Array = array('1');
				$Field = 'My_Key';
				$key = $this->Initiate($sql,$Field,$Execute_Array);
				$result = ''; 
				for($i=0; $i<strlen($string); $i++) 
					{ 
						$char = substr($string, $i, 1); 
						$keychar = substr($key, ($i % strlen($key))-1, 1); 
						$char = chr(ord($char)+ord($keychar)); 
						$result.=$char; 
					} 
				
				return base64_encode($result);  
			}
		public function Decrypt($string) 
			{ 
				$sql = "SELECT My_Key FROM application WHERE ID = ?";
				$Execute_Array = array('1');
				$Field = 'My_Key';
				$key = $this->Initiate($sql,$Field,$Execute_Array);
				$result = ''; 
				$string = base64_decode($string); 
				
				for($i=0; $i<strlen($string); $i++) 
					{ 
						$char = substr($string, $i, 1); 
						$keychar = substr($key, ($i % strlen($key))-1, 1); 
						$char = chr(ord($char)-ord($keychar)); 
						$result.=$char; 
					} 
				return $result; 
			}
		
		function __destruct()
			{
				$this->db = NULL;
			}
	}
?>