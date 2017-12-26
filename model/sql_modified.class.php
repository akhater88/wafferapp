<?php
class sql_modified
	{
		function __construct()
			{
				$this->db = db::getInstance();
				//$_SESSION['Errors'] = array();
			}
		public function create_log($RID,$Table_Name,$Action,$Time_Stamp,$OID,$Log_Cat)
			{
				$sql = 'INSERT INTO logs (RID,Table_Name,Action,Time_Stamp,OID,Log_Cat) VALUES (?,?,?,?,?,?)';
				$Execute_Array = array($RID,$Table_Name,$Action,$Time_Stamp,$OID,$Log_Cat);
				$this->Execute($sql,$Execute_Array);
			}
		public function display_error($MSG,$Align='')
			{
				if($Align == NULL)
					{
						echo '<div align="right" class="Errors">'.$MSG.'</div>';
					}
				else
					{
						echo '<div align="left" class="Errors">'.$MSG.'</div>';
					}
			}
		public function Foreign_Key_Status_Many_To_Many($Table_Name,$First_Field_Value,$Secondary_Field_Value,$Message='')
			{
				$Main_Table = 'foreign_keys_many_to_many';
				if(!isset($_SESSION['Arabic']))
					{
						$Table_Name .= '_english';
					}
				
						$sql_sub = 'SELECT * FROM '.$Main_Table.' WHERE Table_Name = ?';
						$Execute_Array = array($Table_Name);
						$result = $this->Display_Info($sql_sub,$Execute_Array);
						if(count($result))
							{
								$Counter = 0;
								foreach($result as $rows)
									{
										$First_Field_Name = $rows->First_Field_Name;
										$Second_Field_Name = $rows->Second_Field_Name;
										$sql_options = 'SELECT ID FROM '.$Table_Name.' WHERE '.$First_Field_Name.' = ? AND '.$Second_Field_Name.' = ?';
										$Execute_Array = array($First_Field_Value,$Secondary_Field_Value);
										$Total_Records = $this->Total_Records($sql_options,$Execute_Array);
										if($Total_Records)
											{
												$Counter++;
											}
									}
								if($Counter)
									{
										if($Message != NULL)
											{
											?>
											<div align="right" class="Errors" style="font-weight:bold ">لا يـمـكـن مـسـح الـعـنـصـر الـمـخـتـار لإرتـبـاطـة بـجـداول أخــرى</div>
											<?php
											}
											return true;
									}
								else
									{
										return false;
									}
							}
						else
							{
								return false;
							}
					
			}
		
		public function Foreign_Key_Status($Secondary_Table,$Secondary_Field_Value,$Message='')
			{
				$Main_Table = 'foreign_keys';
				if(!isset($_SESSION['Arabic']))
					{
						$Secondary_Table .= '_english';
					}
				$sql = 'SELECT * FROM '.$Main_Table.' WHERE Secondary_Table = ?';
				$Execute_Array = array($Secondary_Table);
				$result = $this->Display_Info($sql,$Execute_Array);
				if(count($result))
					{
						$Counter = 0;
						foreach($result as $rows)
							{
								$Primary_Table = $rows->Primary_Table;
								$Primary_Field = $rows->Primary_Field;
								$sql_sub = 'SELECT * FROM '.$Primary_Table.' WHERE '.$Primary_Field.' = ? AND Status = ?';
								$Execute_Array = array($Secondary_Field_Value,'1');
								$Total_Sub_Records = $this->Total_Records($sql_sub,$Execute_Array);
								if($Total_Sub_Records)
									{
										$Counter++;
									}
							}
						
						if($Counter)
							{
								if($Message != NULL)
								{
								?>
								<div align="right" class="Errors" style="font-weight:bold ">لا يـمـكـن مـسـح الـعـنـصـر الـمـخـتـار لإرتـبـاطـة بـجـداول أخــرى</div>
								<?php
								}
								return true;
							}
						else
							{
								return false;
							}
					}
				else
					{
						return false;
					}
			}
		public function Delete_JSON($File_Name)
			{
				$JSON_Path = __INNER_PATH.'includes/json/'.$File_Name.'.json';
				@unlink($JSON_Path);
			}
		public function Write_JSON($File_Name,$myTweets)
			{
				$myJSONTweets = json_encode($myTweets);
				$JSON_Path = __INNER_PATH.'includes/json/'.$File_Name.'.json';
				ob_start();
				$fp = fopen($JSON_Path,'w');
				fwrite($fp,$myJSONTweets); 
				fclose($fp);
				ob_end_flush();
			}
		public function Export_JSON($myTweets)
			{
				$myJSONTweets = json_encode($myTweets);
				echo $myJSONTweets;
			}
		public function update_table_modified($Path_To_File)
			{
				if(file_exists($Path_To_File))
					{
						$time = time();
						touch($Path_To_File, $time);
					}
				else
					{
						ob_start();
						$fp = fopen($Path_To_File,'w');
						fwrite($fp, ob_get_contents()); 
						fclose($fp);
						ob_end_flush();
						chmod($Path_To_File, 0777);
					}
			}
		public function update_table()
			{
				$Page_Date = date('Y-m-d G:i:s');
				$sql = 'UPDATE updates SET TimeStamp = ? WHERE ID = ?';
				$Execute_Array = array($Page_Date,1);
				$this->Execute($sql,$Execute_Array);
			}
		public function Insert($sql,$Execute_Array,$Insert_ID='')
			{
				$stmt = $this->db->prepare($sql);
				$stmt->execute($Execute_Array);
				if($Insert_ID != NULL)
					{
						$sql = 'SELECT ID FROM offers ORDER BY ID DESC';
						$stmt = $this->db->prepare($sql);
						$stmt->setFetchMode(PDO::FETCH_OBJ);
						$stmt->execute();
						$results = $stmt->fetch();
						return $results->ID;
						
					}
			}
		public function Execute_Cache($sql,$Execute_Array,$Insert_ID='',$Table='')
			{
				$stmt = $this->db->prepare($sql);
				$stmt->execute($Execute_Array);
				if($Insert_ID != NULL)
					{
						$sql = 'SELECT ID FROM '.$Table.' ORDER BY ID DESC';
						$stmt = $this->db->prepare($sql);
						$stmt->setFetchMode(PDO::FETCH_OBJ);
						$stmt->execute();
						$results = $stmt->fetch();
						return $results->ID;
						
					}
				$this->update_table();
			}
		public function Execute_Cache_Polls($sql,$Execute_Array,$Insert_ID='',$Table='')
			{
				$stmt = $this->db->prepare($sql);
				$stmt->execute($Execute_Array);
				if($Insert_ID != NULL)
					{
						$sql = 'SELECT pollID FROM '.$Table.' ORDER BY pollID DESC LIMIT 1';
						$stmt = $this->db->prepare($sql);
						$stmt->setFetchMode(PDO::FETCH_OBJ);
						$stmt->execute();
						$results = $stmt->fetch();
						return $results->pollID;
						
					}
				$this->update_table();
			}
		public function Execute($sql,$Execute_Array,$Insert_ID='',$Table='')
			{
				$stmt = $this->db->prepare($sql);
				$stmt->execute($Execute_Array);
				if($Insert_ID != NULL)
					{
						$sql = 'SELECT ID FROM '.$Table.' ORDER BY ID DESC LIMIT 1';
						$stmt = $this->db->prepare($sql);
						$stmt->setFetchMode(PDO::FETCH_OBJ);
						$stmt->execute();
						$results = $stmt->fetch();
						return $results->ID;
						
					}
			}
		public function Total_Records($sql,$Execute_Array='')
			{
				$stmt = $this->db->prepare($sql);
				if(is_array($Execute_Array))
					{
						$stmt->execute($Execute_Array);
					}
				else
					{
						$stmt->execute();
					}
				
				$count = $stmt->rowCount();
				return $count;
			}
		public function If_Exists($sql,$Execute_Array)
			{
				$stmt = $this->db->prepare($sql);
				$stmt->execute($Execute_Array);
				$count = $stmt->rowCount();
				return $count;
			}
		public function Display_Info($sql,$Execute_Array='')
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
				return $results;
			}
		public function Display_Single_Info($sql,$Alias,$Execute_Array='')
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
				$results = $stmt->fetch();
				return $results->$Alias;
				
			}
		public function Display_Single_Info_Modified($sql,$Field,$Execute_Array='')
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
		public function Max_ID_Number($sql,$Alias,$Execute_Array='')
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
				
				$results = $stmt->fetch();
				return $results->$Alias;
			}
		
		function __destruct()
			{
				$this->db = NULL;
			}
	}
?>