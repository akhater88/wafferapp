<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
class validate_new
	{
		function __construct()
			{
				$this->db = db::getInstance();
				//$_SESSION['Errors'] = array();
			}
		/************************************
			   Verify form validity
		************************************/
		public function Is_Valid_Form($Token)
			{
				$Token_Age = time() - $_SESSION['Token_Time'];
				if((!isset($_SESSION['Token'])) || ($Token != $_SESSION['Token']) || ($Token_Age > 180))
					{
						$_SESSION['Errors']['General'] = 'Invalid Form';
					}
			}
		/************************************
		      Image validation section:
		************************************/ 
		public function Empty_Image($x)
			{
				if($_FILES[$x]['name']== '')
					{
						return true;
					}
				else
					{
						return false;
					}
			}
		public function ImageSize($x)
			{
				
				$Size = $_FILES[$x]['size'];
				$Size = floor($Size/1000);
				if($Size > 2000)
					{
						return true;
					}
				else
					{
						return false;
					}
			}
		//This funtion needs further testing as it is similar to the next function:
		public function Is_Image($x)
			{
				$file_info = @getimagesize($_FILES[$x]['tmp_name']);
				if(empty($file_info))
					{
						return true;
					}
				else
					{
						return false;
					}
			}
		public function Image_Width_And_Height($x,$Required_Width,$Required_Height)
			{
				$temp = $_FILES[$x]['tmp_name'];
				list($width, $height, $type, $attr) = getimagesize($temp);
				if($Required_Height == NULL)
					{
						if($width != $Required_Width)
							{
								return true;
							}
						else
							{
								return false;
							}
					}
				elseif($Required_Width == NULL)
					{
						if($height != $Required_Height)
							{
								return true;
							}
						else
							{
								return false;
							}
					}
				else
					{
						if(($height != $Required_Height) && ($width != $Required_Width))
							{
								return true;
							}
						else
							{
								return false;
							}
					}
			}
		public function Allowed_Images($x,$Valid_Types)
			{
				$path_info = pathinfo($_FILES[$x]['name']);
				$FileExtention = strtolower($path_info['extension']);
				if(!in_array($FileExtention,$Valid_Types))
					{
						return true;
					}
				else
					{
						return false;
					}
				
			}
		/************************************
		      Validation section:
		************************************/ 
		public function Item_Exists_Page($Value,$Menu_ID,$Sub_Menu_ID = '')
			{
				$Display = new sql();
				$Table = 'pages';
				if(!isset($_SESSION['Arabic']))
					{
						$Table .= '_english';
					}
				if($Sub_Menu_ID != NULL)
					{
						$sql = 'SELECT ID FROM '.$Table.' WHERE Title = ? AND Status != ? AND Menu_ID = ? AND Sub_Menu_ID = ?';
						$Execute_Array = array($Value,'0',$Menu_ID,$Sub_Menu_ID);
					}
				else
					{
						$sql = 'SELECT ID FROM '.$Table.' WHERE Title = ? AND Status != ? AND Menu_ID = ?';
						$Execute_Array = array($Value,'0',$Menu_ID);
					}
				$Count = $Display->Total_Records($sql,$Execute_Array);
				if($Count)
					{
						return true;
					}
				else
					{
						return false;
					}
			}
		public function Item_Exists_Sub_Sub_Menu($Table,$Field,$Value,$MID,$SMID)
			{
				$Display = new sql();
				if(!isset($_SESSION['Arabic']))
					{
						$Table .= '_english';
					}
				$sql = 'SELECT ID FROM '.$Table.' WHERE '.$Field.' = ? AND Status != ? AND MID = ? AND SMID = ?';
				$Execute_Array = array($Value,'0',$MID,$SMID);
				$Count = $Display->Total_Records($sql,$Execute_Array);
				if($Count)
					{
						return true;
					}
				else
					{
						return false;
					}
			}
		public function Item_Exists_Sub_Menu($Table,$Field,$Value,$MID)
			{
				$Display = new sql();
				if(!isset($_SESSION['Arabic']))
					{
						$Table .= '_english';
					}
				$sql = 'SELECT ID FROM '.$Table.' WHERE '.$Field.' = ? AND Status != ? AND MID = ?';
				$Execute_Array = array($Value,'0',$MID);
				$Count = $Display->Total_Records($sql,$Execute_Array);
				if($Count)
					{
						return true;
					}
				else
					{
						return false;
					}
			}
		public function Item_Exists($Table,$Field,$Value)
			{
				$Display = new sql();
				if(!isset($_SESSION['Arabic']))
					{
						$Table .= '_english';
					}
				$sql = 'SELECT ID FROM '.$Table.' WHERE '.$Field.' = ? AND Status != ?';
				$Execute_Array = array($Value,'0');
				$Count = $Display->Total_Records($sql,$Execute_Array);
				if($Count)
					{
						return true;
					}
				else
					{
						return false;
					}
			}
		public function Item_Exists_Edit_Page($Value,$ID,$Menu_ID,$Sub_Menu_ID = '')
			{
				$Display = new sql();
				$Table = 'pages';
				if(!isset($_SESSION['Arabic']))
					{
						$Table .= '_english';
					}
				if($Sub_Menu_ID != NULL)
					{
						$sql = 'SELECT ID FROM '.$Table.' WHERE Title = ? AND Status != ? AND Menu_ID = ? AND Sub_Menu_ID = ? AND ID != ?';
						$Execute_Array = array($Value,'0',$Menu_ID,$Sub_Menu_ID,$ID);
					}
				else
					{
						$sql = 'SELECT ID FROM '.$Table.' WHERE Title = ? AND Status != ? AND Menu_ID = ? AND ID != ?';
						$Execute_Array = array($Value,'0',$Menu_ID,$ID);
					}
				$Count = $Display->Total_Records($sql,$Execute_Array);
				if($Count)
					{
						return true;
					}
				else
					{
						return false;
					}
			}
		public function Item_Exists_Edit_Sub_Sub_Menu($Table,$Field,$ID,$Value,$MID,$SMID)
			{
				$Display = new sql();
				if(!isset($_SESSION['Arabic']))
					{
						$Table .= '_english';
					}
				
				$sql = 'SELECT ID FROM '.$Table.' WHERE '.$Field.' = ? AND ID != ? AND Status != ? AND MID = ? AND SMID = ?';
				$Execute_Array = array($Value,$ID,'0',$MID,$SMID);
				$Count = $Display->Total_Records($sql,$Execute_Array);
				if($Count)
					{
						return true;
					}
				else
					{
						return false;
					}
			}
		public function Item_Exists_Edit_Sub_Menu($Table,$Field,$ID,$Value,$MID)
			{
				$Display = new sql();
				if(!isset($_SESSION['Arabic']))
					{
						$Table .= '_english';
					}
				
				$sql = 'SELECT ID FROM '.$Table.' WHERE '.$Field.' = ? AND ID != ? AND Status != ? AND MID = ?';
				$Execute_Array = array($Value,$ID,'0',$MID);
				$Count = $Display->Total_Records($sql,$Execute_Array);
				if($Count)
					{
						return true;
					}
				else
					{
						return false;
					}
			}
		public function Item_Exists_Edit($Table,$Field,$ID,$Value)
			{
				$Display = new sql();
				if(!isset($_SESSION['Arabic']))
					{
						$Table .= '_english';
					}
				
				$sql = 'SELECT ID FROM '.$Table.' WHERE '.$Field.' = ? AND ID != ? AND Status != ?';
				$Execute_Array = array($Value,$ID,'0');
				$Count = $Display->Total_Records($sql,$Execute_Array);
				if($Count)
					{
						return true;
					}
				else
					{
						return false;
					}
			}
		public function Item_Exists_Modified_JSON($Table,$Field,$Value)
			{
				$Display = new sql();
				$Exceptions = array('users');
				if((!isset($_SESSION['Arabic']))&&(!in_array($Table,$Exceptions)))
					{
						$Table .= '_english';
					}
				
				$sql = 'SELECT ID FROM '.$Table.' WHERE '.$Field.' = ? AND Status != ?';
				$Execute_Array = array($Value,'0');
				$Count = $Display->Total_Records($sql,$Execute_Array);
				if($Count)
					{
						return true;
					}
				else
					{
						return false;
					}
			}
		public function Item_Exists_City_Edit($Table,$Field,$Value,$CID,$ID)
			{
				$Display = new sql();
				if(!isset($_SESSION['Arabic']))
					{
						$Table .= '_english';
					}
				
				$sql = 'SELECT ID FROM '.$Table.' WHERE '.$Field.' = ? AND Status != ? AND CID = ? AND ID != ?';
				$Execute_Array = array($Value,'0',$CID,$ID);
				$Count = $Display->Total_Records($sql,$Execute_Array);
				if($Count)
					{
						return true;
					}
				else
					{
						return false;
					}
			}
		public function Item_Exists_City($Table,$Field,$Value,$CID)
			{
				$Display = new sql();
				if(!isset($_SESSION['Arabic']))
					{
						$Table .= '_english';
					}
				
				$sql = 'SELECT ID FROM '.$Table.' WHERE '.$Field.' = ? AND Status != ? AND CID = ?';
				$Execute_Array = array($Value,'0',$CID);
				$Count = $Display->Total_Records($sql,$Execute_Array);
				if($Count)
					{
						return true;
					}
				else
					{
						return false;
					}
			}
		public function Item_Exists_Edit_Modified_JSON_Edit($Table,$Field,$ID,$Value,$AID)
			{
				$Display = new sql();
				if(!isset($_SESSION['Arabic']))
					{
						$Table .= '_english';
					}
				
				$sql = 'SELECT ID FROM '.$Table.' WHERE '.$Field.' = ? AND ID != ? AND Status != ? AND AID = ?';
				$Execute_Array = array($Value,$ID,'0',$AID);
				$Count = $Display->Total_Records($sql,$Execute_Array);
				if($Count)
					{
						return true;
					}
				else
					{
						return false;
					}
			}
		public function Item_Exists_Edit_Modified_JSON($Table,$Field,$ID,$Value)
			{
				$Display = new sql();
				$Exceptions = array('users');
				if((!isset($_SESSION['Arabic']))&&(!in_array($Table,$Exceptions)))
					{
						$Table .= '_english';
					}
				
				$sql = 'SELECT ID FROM '.$Table.' WHERE '.$Field.' = ? AND ID != ? AND Status != ?';
				$Execute_Array = array($Value,$ID,'0');
				$Count = $Display->Total_Records($sql,$Execute_Array);
				if($Count)
					{
						return true;
					}
				else
					{
						return false;
					}
			}
		public function Validate_Match($Value)
			{
				$sql = 'SELECT user_name FROM users WHERE user_name = :user_name';
				$stmt = $this->db->prepare($sql);
				$stmt->setFetchMode(PDO::FETCH_OBJ);
				$stmt->bindParam(':user_name',$Value);
				$stmt->execute();
				$count = $stmt->rowCount();
				if($count)
					{
						return true;
					}
				else
					{
						return false;
					}
			}
		
		public function Validate_Match_Edit($Value,$ID)
			{
				$sql = 'SELECT user_name FROM users WHERE user_name = :user_name AND ID != :ID';
				$stmt = $this->db->prepare($sql);
				$stmt->setFetchMode(PDO::FETCH_OBJ);
				$stmt->bindParam(':user_name',$Value);
				$stmt->bindParam(':ID',$ID);
				$stmt->execute();
				$count = $stmt->rowCount();
				if($count)
					{
						return true;
					}
				else
					{
						return false;
					}
			}
		public function Validate_Email_Match_Edit_New($Value,$ID,$Table)
			{
				$sql = 'SELECT ID FROM '.$Table.' WHERE Email = :Email AND ID != :ID';
				$stmt = $this->db->prepare($sql);
				$stmt->setFetchMode(PDO::FETCH_OBJ);
				$stmt->bindParam(':Email',$Value);
				$stmt->bindParam(':ID',$ID);
				$stmt->execute();
				$count = $stmt->rowCount();
				if($count)
					{
						return true;
					}
				else
					{
						return false;
					}
			}
		public function Validate_Empty($Value)
			{
				$Value = strip_tags($Value);
				$Value = trim($Value);
				if($Value == NULL)
					{
						return true;
					}
				else
					{
						return false;
					}
			}
		
		public function Validate_Compare($Value,$Par)
			{
				if($Value != $Par)
					{
						return true;
					}
				else
					{
						return false;
					}
			}
		public function Validate_Number($Value)
			{
				if(!is_numeric($Value))
					{
						return true;
					}
				else
					{
						return false;
					}
			}
		public function Validate_String($Value)
			{
				if(is_numeric($Value))
					{
						return true;
					}
				else
					{
						return false;
					}
			}
		public function Validate_Len($Value,$STR)
			{
				if(strlen($Value) < $STR)
					{
						return true;
					}
				else
					{
						return false;
					}
			}
		public function Validate_Email($Value)
			{
				 if(eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $Value))
					{
						return true;
					}
				else
					{
						return false;
					}
				
				
			}
		public function Validate_NoneZero($Value)
			{
				if(!$Value)
					{
						 return true;
					}
				else
					{
						return false;
					}
			}
		
		public function Validate_TimeFormat($Value)
			{
				$findme   = ":";
				$pos = strpos($Value,$findme);
				if(($pos != 1) && ($pos != 2))
					{
						return true;
					}
				else
					{
						return false;
					}
			}
		
		public function Validate_URL($Value)
			{
				$isValidURL = $this->isValidURL($Value);
				if(!$isValidURL)
					{
						 return true;
					}
				else
					{
						return false;
					}
			}
		public function Compare_Dates($From,$To)
			{
				$From_Formatted = strtotime($From);
				$To_Formatted = strtotime($To);
				if($From_Formatted > $To_Formatted)
					{
						return true;
					}
				else
					{
						return false;
					}
			}
			
		private function isValidURL($url)
			{
				$pattern = '/^(([\w]+:)?\/\/)?(([\d\w]|%[a-fA-f\d]{2,2})+(:([\d\w]|%[a-fA-f\d]{2,2})+)?@)?([\d\w][-\d\w]{0,253}[\d\w]\.)+[\w]{2,4}(:[\d]+)?(\/([-+_~.\d\w]|%[a-fA-f\d]{2,2})*)*(\?(&amp;?([-+_~.\d\w]|%[a-fA-f\d]{2,2})=?)*)?(#([-+_~.\d\w]|%[a-fA-f\d]{2,2})*)?$/';
				return preg_match($pattern, $url);
				//return preg_match('|^http(s)?://[a-z0-9-]+(.[a-z0-9-]+)*(:[0-9]+)?(/.*)?$|i', $url);
			}
		function __destruct()
			{
				$this->db = NULL;
			}
		
	}
?>