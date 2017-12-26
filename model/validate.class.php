<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
class validate
	{
		function __construct()
			{
				$this->db = db::getInstance();
				$_SESSION['Errors'] = array();
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
		public function Empty_Image($x,$MSG)
			{
				if($_FILES[$x]['name']== '')
					{
						$_SESSION['Errors']['Image'] = $MSG;
					}
			}
		public function ImageSize($x,$MSG)
			{
				
				$Size = $_FILES[$x]['size'];
				$Size = floor($Size/1000);
				if($Size > 2000)
					{
						$_SESSION['Errors']['Image'] = $MSG;
					}
			}
		//This funtion needs further testing as it is similar to the next function:
		public function Is_Image($x,$MSG)
			{
				$file_info = @getimagesize($_FILES[$x]['tmp_name']);
				if(empty($file_info))
					{
						$_SESSION['Errors']['Image'] = $MSG;
					}
			}
		public function Image_Width_And_Height($x,$Required_Width,$Required_Height,$MSG)
			{
				$temp = $_FILES[$x]['tmp_name'];
				list($width, $height, $type, $attr) = getimagesize($temp);
				if($Required_Height == NULL)
					{
						if($width != $Required_Width)
							{
								$_SESSION['Errors']['Image'] = $MSG;
							}
					}
				elseif($Required_Width == NULL)
					{
						if($height != $Required_Height)
							{
								$_SESSION['Errors']['Image'] = $MSG;
							}
					}
				else
					{
						if(($height != $Required_Height) && ($width != $Required_Width))
							{
								$_SESSION['Errors']['Image'] = $MSG;
							}
					}
			}
		public function Allowed_Images($x,$Valid_Types,$MSG)
			{
				$path_info = pathinfo($_FILES[$x]['name']);
				$FileExtention = strtolower($path_info['extension']);
				if(!in_array($FileExtention,$Valid_Types))
					{
						$_SESSION['Errors']['Image'] = $MSG;
					}
				
			}
		/************************************
		      Validation section:
		************************************/ 
		public function Item_Exists_Page($Value,$Target,$Menu_ID,$Sub_Menu_ID = '',$MSG)
			{
				$Display = new sql();
				$Table = 'pages';
				if(!isset($_SESSION['Arabic']))
					{
						$Table .= '_english';
					}
				if($Sub_Menu_ID != NULL)
					{
						$sql = 'SELECT ID FROM '.$Table.' WHERE Title LIKE ? AND Status != ? AND Menu_ID = ? AND Sub_Menu_ID = ?';
						$Execute_Array = array($Value,'0',$Menu_ID,$Sub_Menu_ID);
					}
				else
					{
						$sql = 'SELECT ID FROM '.$Table.' WHERE Title LIKE ? AND Status != ? AND Menu_ID = ?';
						$Execute_Array = array($Value,'0',$Menu_ID);
					}
				$Count = $Display->Total_Records($sql,$Execute_Array);
				if($Count)
					{
						$_SESSION['Errors'][$Target] = $MSG;
					}
			}
		public function Item_Exists_Sub_Menu($Table,$Field,$Value,$Target,$MID,$MSG)
			{
				$Display = new sql();
				if(!isset($_SESSION['Arabic']))
					{
						$Table .= '_english';
					}
				$sql = 'SELECT ID FROM '.$Table.' WHERE '.$Field.' LIKE ? AND Status != ? AND MID = ?';
				$Execute_Array = array($Value,'0',$MID);
				$Count = $Display->Total_Records($sql,$Execute_Array);
				if($Count)
					{
						$_SESSION['Errors'][$Target] = $MSG;
					}
			}
		public function Item_Exists($Table,$Field,$Value,$Target,$MSG)
			{
				$Display = new sql();
				if(!isset($_SESSION['Arabic']))
					{
						$Table .= '_english';
					}
				$sql = 'SELECT ID FROM '.$Table.' WHERE '.$Field.' LIKE ? AND Status != ?';
				$Execute_Array = array($Value,'0');
				$Count = $Display->Total_Records($sql,$Execute_Array);
				if($Count)
					{
						$_SESSION['Errors'][$Target] = $MSG;
					}
			}
		public function Item_Exists_Edit_Page($Value,$Target,$ID,$Menu_ID,$Sub_Menu_ID = '',$MSG)
			{
				$Display = new sql();
				$Table = 'pages';
				if(!isset($_SESSION['Arabic']))
					{
						$Table .= '_english';
					}
				if($Sub_Menu_ID != NULL)
					{
						$sql = 'SELECT ID FROM '.$Table.' WHERE Title LIKE ? AND Status != ? AND Menu_ID = ? AND Sub_Menu_ID = ? AND ID != ?';
						$Execute_Array = array($Value,'0',$Menu_ID,$Sub_Menu_ID,$ID);
					}
				else
					{
						$sql = 'SELECT ID FROM '.$Table.' WHERE Title LIKE ? AND Status != ? AND Menu_ID = ? AND ID != ?';
						$Execute_Array = array($Value,'0',$Menu_ID,$ID);
					}
				$Count = $Display->Total_Records($sql,$Execute_Array);
				if($Count)
					{
						$_SESSION['Errors'][$Target] = $MSG;
					}
			}
		public function Item_Exists_Edit_Sub_Menu($Table,$Field,$ID,$Value,$Target,$MID,$MSG)
			{
				$Display = new sql();
				if(!isset($_SESSION['Arabic']))
					{
						$Table .= '_english';
					}
				
				$sql = 'SELECT ID FROM '.$Table.' WHERE '.$Field.' LIKE ? AND ID != ? AND Status != ? AND MID = ?';
				$Execute_Array = array($Value,$ID,'0',$MID);
				$Count = $Display->Total_Records($sql,$Execute_Array);
				if($Count)
					{
						$_SESSION['Errors'][$Target] = $MSG;
					}
			}
		public function Item_Exists_Edit($Table,$Field,$ID,$Value,$Target,$MSG)
			{
				$Display = new sql();
				if(!isset($_SESSION['Arabic']))
					{
						$Table .= '_english';
					}
				
				$sql = 'SELECT ID FROM '.$Table.' WHERE '.$Field.' LIKE ? AND ID != ? AND Status != ?';
				$Execute_Array = array($Value,$ID,'0');
				$Count = $Display->Total_Records($sql,$Execute_Array);
				if($Count)
					{
						$_SESSION['Errors'][$Target] = $MSG;
					}
			}
		public function Item_Exists_Modified_JSON($Table,$Field,$Value,$Target)
			{
				$Display = new sql();
				if(!isset($_SESSION['Arabic']))
					{
						$Table .= '_english';
					}
				
				$sql = 'SELECT ID FROM '.$Table.' WHERE '.$Field.' = ? AND Status != ?';
				$Execute_Array = array($Value,$ID,'0');
				$Count = $Display->Total_Records($sql,$Execute_Array);
				if($Count)
					{
						$myTweets = array(
								"flag" => "1"
								);
								$myJSONTweets = json_encode($myTweets);
								$JSON_Path = __INNER_PATH.'includes/json/'.$Table.'.json';
								ob_start();
								$fp = fopen($JSON_Path,'w');
								fwrite($fp,$myJSONTweets); 
								fclose($fp);
								ob_end_flush();
					}
				else
					{
						$myTweets = array(
								"flag" => "0"
								);
								$myJSONTweets = json_encode($myTweets);
								$JSON_Path = __INNER_PATH.'includes/json/'.$Table.'.json';
								ob_start();
								$fp = fopen($JSON_Path,'w');
								fwrite($fp,$myJSONTweets); 
								fclose($fp);
								ob_end_flush();
					}
			}
		public function Item_Exists_Edit_Modified_JSON($Table,$Field,$ID,$Value,$Target)
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
						$myTweets = array(
								"flag" => "1"
								);
								$myJSONTweets = json_encode($myTweets);
								$JSON_Path = __INNER_PATH.'includes/json/'.$Table.'.json';
								$this->registry->template->JSON_Path = $JSON_Path;
								ob_start();
								$fp = fopen($JSON_Path,'w');
								fwrite($fp,$myJSONTweets); 
								fclose($fp);
								ob_end_flush();
					}
				else
					{
						$myTweets = array(
								"flag" => "0"
								);
								$myJSONTweets = json_encode($myTweets);
								$JSON_Path = __INNER_PATH.'includes/json/'.$Table.'.json';
								$this->registry->template->JSON_Path = $JSON_Path;
								ob_start();
								$fp = fopen($JSON_Path,'w');
								fwrite($fp,$myJSONTweets); 
								fclose($fp);
								ob_end_flush();
					}
			}
		public function Validate_Match($Value,$Target,$MSG)
			{
				$sql = 'SELECT user_name FROM users WHERE user_name = :user_name';
				$stmt = $this->db->prepare($sql);
				$stmt->setFetchMode(PDO::FETCH_OBJ);
				$stmt->bindParam(':user_name',$Value);
				$stmt->execute();
				$count = $stmt->rowCount();
				if($count)
					{
						$_SESSION['Errors'][$Target] = $MSG;
					}
			}
		
		public function Validate_Match_Edit($Value,$Target,$ID,$MSG)
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
						$_SESSION['Errors'][$Target] = $MSG;
					}
			}
		public function Validate_Email_Match_Edit_New($Value,$Target,$ID,$Table,$MSG)
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
						$_SESSION['Errors'][$Target] = $MSG;
					}
			}
		public function Validate_Empty($Value,$Target,$MSG)
			{
				$Value = strip_tags($Value);
				$Value = trim($Value);
				if($Value == NULL)
					{
						$_SESSION['Errors'][$Target] = $MSG;
					}
			}
		
		public function Validate_Compare($Value,$Target,$MSG,$Par)
			{
				if($Value != $Par)
					{
						$_SESSION['Errors'][$Target] = $MSG;
					}
			}
		public function Validate_Number($Value,$Target,$MSG)
			{
				if(!is_numeric($Value))
					{
						$_SESSION['Errors'][$Target] = $MSG;
					}
			}
		public function Validate_String($Value,$Target,$MSG)
			{
				if(is_numeric($Value))
					{
						$_SESSION['Errors'][$Target] = $MSG;
					}
			}
		public function Validate_Len($Value,$Target,$MSG,$STR)
			{
				if(strlen($Value) < $STR)
					{
						$_SESSION['Errors'][$Target] = $MSG;
					}
			}
		public function Validate_Email($Value,$Target,$MSG)
			{
				$Value_Array = explode('@',$Value);
				if(count($Value_Array)> 1)
					{
						   // First, we check that there's one @ symbol, 
						  // and that the lengths are right.
						  if (!ereg("^[^@]{1,64}@[^@]{1,255}$", $Value)) {
							// Email invalid because wrong number of characters 
							// in one section or wrong number of @ symbols.
							$_SESSION['Errors'][$Target] = $MSG;
						  }
						  // Split it into sections to make life easier
						  $email_array = explode("@", $Value);
						  $local_array = explode(".", $email_array[0]);
						  for ($i = 0; $i < sizeof($local_array); $i++) {
							if
						(!ereg("^(([A-Za-z0-9!#$%&'*+/=?^_`{|}~-][A-Za-z0-9!#$%&
						↪'*+/=?^_`{|}~\.-]{0,63})|(\"[^(\\|\")]{0,62}\"))$",
						$local_array[$i])) {
							  $_SESSION['Errors'][$Target] = $MSG;
							}
						  }
						  // Check if domain is IP. If not, 
						  // it should be valid domain name
						  if (!ereg("^\[?[0-9\.]+\]?$", $email_array[1])) {
							$domain_array = explode(".", $email_array[1]);
							if (sizeof($domain_array) < 2) {
								$_SESSION['Errors'][$Target] = $MSG; // Not enough parts to domain
							}
							for ($i = 0; $i < sizeof($domain_array); $i++) {
							  if
						(!ereg("^(([A-Za-z0-9][A-Za-z0-9-]{0,61}[A-Za-z0-9])|
						↪([A-Za-z0-9]+))$",
						$domain_array[$i])) {
								$_SESSION['Errors'][$Target] = $MSG;
							  }
							}
						  }
					}
				else
					{
						$_SESSION['Errors'][$Target] = $MSG;
					}
				
			}
		public function Validate_NoneZero($Value,$Target,$MSG)
			{
				if(!$Value)
					{
						$_SESSION['Errors'][$Target] = $MSG;
					}
			}
		
		public function Validate_TimeFormat($Value,$Target,$MSG)
			{
				$findme   = ":";
				$pos = strpos($Value,$findme);
				if(($pos != 1) && ($pos != 2))
					{
						$_SESSION['Errors'][$Target] = $MSG;
					}
			}
		public function Validate_TimeFormat_HHmm($Value,$Target,$MSG)
			{
				$findme   = ":";
				$pos = strpos($Value, $findme);
				if(($pos != 1) && ($pos != 2))
					{
						$_SESSION['Errors'][$Target] = $MSG;
					}
				else
					{
						$pos = explode(":",$Value);
						if(!is_numeric($pos[0]))
							{
								$_SESSION['Errors'][$Target] = $MSG;
							}
						if(!is_numeric($pos[1]))
							{
								$_SESSION['Errors'][$Target] = $MSG;
							}
						if($pos[1] > 59)
							{
								$_SESSION['Errors'][$Target] = $MSG;
							}
					}
			}
		public function Validate_URL($Value,$Target,$MSG)
			{
				$isValidURL = $this->isValidURL($Value);
				if(!$isValidURL)
					{
						$_SESSION['Errors'][$Target] = $MSG;
					}
			}
		public function Compare_Dates($From,$To,$Target,$MSG)
			{
				$From_Formatted = strtotime($From);
				$To_Formatted = strtotime($To);
				if($From_Formatted > $To_Formatted)
					{
						$_SESSION['Errors'][$Target] = $MSG;
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