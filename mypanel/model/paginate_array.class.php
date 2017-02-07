<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
class paginate_array
	{
		function __construct($Array,$Desired_Rows,$pagenum='')
			{
				$this->Array = $Array;
				$this->Desired_Rows = $Desired_Rows;
				$this->pagenum = $pagenum;
				if(!(isset($this->pagenum)) || (!$this->pagenum))
					{ 
						$this->pagenum = 1; 
					} 
			}
			
		public function Records()
			{
				$count = count($this->Array);
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

						if($this->pagenum < 1) 
							{ 
								$this->pagenum = 1; 
							} 
						elseif ($this->pagenum > $Last) 
							{ 
								$this->pagenum = $Last; 
							}
						
						$Index = ($this->pagenum ) * $this->Desired_Rows;
						
						$results = array();
						$Index_Counter = 0;
						$Desired_Index = $Index - $this->Desired_Rows;
						
						if($Index > $Count)
							{
								$Limit = ($Count) % $this->Desired_Rows;
							}
						else
							{
								$Limit = $this->Desired_Rows;
							}
						
						foreach($this->Array as $value)
							{
								if($Index_Counter < $Limit)
									{
										$results[] = $this->Array[$Desired_Index];
										$Desired_Index++;
									}
								
								$Index_Counter++;
							}
						
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