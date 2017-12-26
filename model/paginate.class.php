<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
class paginate
	{
		function __construct($Table,$Desired_Rows,$pagenum='',$sql,$Execute_Array=array())
			{
				$this->db = db::getInstance();
				$_SESSION['Errors'] = array();
				$this->Table = $Table;
				$this->Desired_Rows = $Desired_Rows;
				$this->sql = $sql;
				$this->pagenum = $pagenum;
				if(!(isset($this->pagenum))) 
					{ 
						$this->pagenum = 1; 
					} 
				$this->Execute_Array = $Execute_Array;
			}
			
		public function Records()
			{
				$stmt = $this->db->prepare($this->sql);
				$stmt->setFetchMode(PDO::FETCH_OBJ);
				if(count($this->Execute_Array))
					{
						$stmt->execute($this->Execute_Array);
					}
				else
					{
						$stmt->execute();
					}
				$count = $stmt->rowCount();
				return $count;
			}
		public function Calculate_Last($Count)
			{
				$Last = ceil($Count/$this->Desired_Rows);
				return $Last;
			}
		public function Paginate()
			{ 
				$Count = $this->Records();
				if($Count)
					{
						$Last = $this->Calculate_Last($Count);
						if ($this->pagenum < 1) 
							{ 
								$this->pagenum = 1; 
							} 
						elseif ($this->pagenum > $Last) 
							{ 
								$this->pagenum = $Last; 
							}
						$max = 'limit ' .($this->pagenum - 1) * $this->Desired_Rows.','.$this->Desired_Rows;
						$this->sql = $this->sql.' '.$max;
						$stmt = $this->db->prepare($this->sql);
						$stmt->setFetchMode(PDO::FETCH_OBJ);
						if(count($this->Execute_Array))
							{
								$stmt->execute($this->Execute_Array);
							}
						else
							{
								$stmt->execute();
							}
						$results = $stmt->fetchAll();
						return $results;
					}
				else
					{
						return false;
					}
			}
		function __destruct()
			{
				$this->db = NULL;
			}
		
	}
?>