<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
$Allowed_Users = array('1');
validate_roles_new::validate($Allowed_Users);
class countriesController extends baseController {
			
		public function index() 
			{
				
			}
		public function delete_selected_city()
			{
				$Display = new sql();
				$validate = new validate_new();
				$OID = $_SESSION['User_ID'];
				if(isset($_SESSION['Arabic']))
					{
						$Table = 'city';
					}
				else
					{
						$Table = 'city_english';
					}
				$ID = $_POST['ID'];
				$sql = 'UPDATE '.$Table.' SET Status = ? WHERE ID = ?';
				$Execute_Array = array('0',$ID);
				$Display->Execute($sql,$Execute_Array);
				$Action_Time = date('Y-m-d G:i:s');
				$Display->create_log($ID,$Table,'3',$Action_Time,$OID,'Deleted a city');
				$this->add_country();
			}
		public function delete_selected_country()
			{
				$Display = new sql();
				$validate = new validate_new();
				$OID = $_SESSION['User_ID'];
				if(isset($_SESSION['Arabic']))
					{
						$Table = 'country';
						$Table_City = 'city';
					}
				else
					{
						$Table = 'country_english';
						$Table_City = 'city_english';
					}
				$ID = $_POST['ID'];
				$sql = 'UPDATE '.$Table.' SET Status = ? WHERE ID = ?';
				$Execute_Array = array('0',$ID);
				$Display->Execute($sql,$Execute_Array);
				
				$sql = 'UPDATE '.$Table_City.' SET Status = ? WHERE CID = ?';
				$Execute_Array = array('0',$ID);
				$Display->Execute($sql,$Execute_Array);
				
				$Action_Time = date('Y-m-d G:i:s');
				$Display->create_log($ID,$Table,'3',$Action_Time,$OID,'Deleted a country');
				$this->add_country();
			}
		public function submit_edit_city()
			{
				$Display = new sql();
				$validate = new validate_new();
				$OID = $_SESSION['User_ID'];
				if(isset($_SESSION['Arabic']))
					{
						$Table = 'city';
					}
				else
					{
						$Table = 'city_english';
					}
				$ID = $_POST['ID'];
				$City_Name = $_POST['Name'];
				$Time_Stamp = $_POST['Time_Stamp'];
				$sql = 'SELECT CID FROM '.$Table.' WHERE ID = ?';
				$Execute_Array = array($ID);
				$CID = $Display->Display_Single_Info_Modified($sql,'CID',$Execute_Array);
				$Item_Exists_City_Edit = $validate->Item_Exists_City_Edit('city','City_Name',$City_Name,$CID,$ID);
				if($City_Name == NULL)
					{
						$myTweets = array("flag" => '1');
						$Display->Write_JSON($Time_Stamp,$myTweets);
					}
				elseif($Item_Exists_City_Edit)
					{
						$myTweets = array("flag" => '2');
						$Display->Write_JSON($Time_Stamp,$myTweets);
					}
				else
					{
						$myTweets = array("flag" => '0');
						$Display->Write_JSON($Time_Stamp,$myTweets);
						$sql = 'UPDATE '.$Table.' SET City_Name = ? WHERE ID = ?';
						$Execute_Array = array($City_Name,$ID);
						$Display->Execute($sql,$Execute_Array);
						$Action_Time = date('Y-m-d G:i:s');
						$Display->create_log($ID,$Table,'2',$Action_Time,$OID,'Edited a city');
						$this->add_country();
					}
			}
		public function submit_new_city()
			{
				$Display = new sql();
				$validate = new validate_new();
				$OID = $_SESSION['User_ID'];
				if(isset($_SESSION['Arabic']))
					{
						$Table = 'city';
					}
				else
					{
						$Table = 'city_english';
					}
				$CID = $_POST['ID'];
				$City_Name = $_POST['Name'];
				$Time_Stamp = $_POST['Time_Stamp'];
				$Item_Exists_City = $validate->Item_Exists_City('city','City_Name',$City_Name,$CID);
				if($City_Name == NULL)
					{
						$myTweets = array("flag" => '1');
						$Display->Write_JSON($Time_Stamp,$myTweets);
					}
				elseif($Item_Exists_City)
					{
						$myTweets = array("flag" => '2');
						$Display->Write_JSON($Time_Stamp,$myTweets);
					}
				else
					{
						$myTweets = array("flag" => '0');
						$Display->Write_JSON($Time_Stamp,$myTweets);
						$sql = 'INSERT INTO '.$Table.' (CID,City_Name,Status) VALUES (?,?,?)';
						$Execute_Array = array($CID,$City_Name,'1');
						$RID = $Display->Execute($sql,$Execute_Array,'1',$Table);
						$Action_Time = date('Y-m-d G:i:s');
						$Display->create_log($RID,$Table,'1',$Action_Time,$OID,'Added a new city');
						$this->add_country();
					}
			}
		public function submit_edit_country()
			{
				$Display = new sql();
				$validate = new validate_new();
				$OID = $_SESSION['User_ID'];
				if(isset($_SESSION['Arabic']))
					{
						$Table = 'country';
					}
				else
					{
						$Table = 'country_english';
					}
				$ID = $_POST['ID'];
				$Name = $_POST['Name'];
				$Time_Stamp = $_POST['Time_Stamp'];
				$Item_Exists_Modified_JSON = $validate->Item_Exists_Edit_Modified_JSON('country','Name',$ID,$Name);
				if($Name == NULL)
					{
						$myTweets = array("flag" => '1');
						$Display->Write_JSON($Time_Stamp,$myTweets);
					}
				elseif($Item_Exists_Modified_JSON)
					{
						$myTweets = array("flag" => '2');
						$Display->Write_JSON($Time_Stamp,$myTweets);
					}
				else
					{
						$myTweets = array("flag" => '0');
						$Display->Write_JSON($Time_Stamp,$myTweets);
						$sql = 'UPDATE '.$Table.' SET Name = ? WHERE ID = ?';
						$Execute_Array = array($Name,$ID);
						$Display->Execute($sql,$Execute_Array);
						$Action_Time = date('Y-m-d G:i:s');
						$Display->create_log($ID,$Table,'2',$Action_Time,$OID,'Edited a country');
						$this->add_country();
					}
			}
		public function submit_new_country()
			{
				$Display = new sql();
				$validate = new validate_new();
				$OID = $_SESSION['User_ID'];
				if(isset($_SESSION['Arabic']))
					{
						$Table = 'country';
					}
				else
					{
						$Table = 'country_english';
					}
				$Name = $_POST['Name'];
				$Time_Stamp = $_POST['Time_Stamp'];
				$Item_Exists_Modified_JSON = $validate->Item_Exists_Modified_JSON('country','Name',$Name);
				if($Name == NULL)
					{
						$myTweets = array("flag" => '1');
						$Display->Write_JSON($Time_Stamp,$myTweets);
					}
				elseif($Item_Exists_Modified_JSON)
					{
						$myTweets = array("flag" => '2');
						$Display->Write_JSON($Time_Stamp,$myTweets);
					}
				else
					{
						$myTweets = array("flag" => '0');
						$Display->Write_JSON($Time_Stamp,$myTweets);
						$sql = 'INSERT INTO '.$Table.' (Name,Status) VALUES (?,?)';
						$Execute_Array = array($Name,'1');
						$RID = $Display->Execute($sql,$Execute_Array,'1',$Table);
						$Action_Time = date('Y-m-d G:i:s');
						$Display->create_log($RID,$Table,'1',$Action_Time,$OID,'Added new country');
						$this->add_country();
					}
				
			}
		public function add_country()
			{
				$Display = new sql();
				if(isset($_SESSION['Arabic']))
					{
						$Table = 'country';
						$this->registry->template->Table_City = 'city';
					}
				else
					{
						$Table = 'country_english';
						$this->registry->template->Table_City = 'city_english';
					}
				$sql = 'SELECT ID,Name FROM '.$Table.' WHERE Status = ? ORDER BY BINARY Name';
				$Execute_Array = array('1');
				$pagenum  = @$_POST['Page'];
				$paginate = new paginate($Table,'10',$pagenum,$sql,$Execute_Array);
				$Count = $paginate->Records($Table);
				$this->registry->template->Page = $pagenum;
				$this->registry->template->Count = $Count;
				$this->registry->template->Last = $paginate->Calculate_Last($Count);
				$results = $paginate->Paginate();
				$this->registry->template->results = $results;
				$this->registry->template->show('countries/add_country');
			}
		
}

?>
