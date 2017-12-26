<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
$Allowed_Users = array('1');
validate_roles_new::validate($Allowed_Users);
class adsController extends baseController {
			
		public function index() 
			{
				
			}
		public function validate_ads()
			{
				$Display = new sql();
				$Current_Date = date('Y-m-d');
				$Current_Date_String = strtotime($Current_Date);
				if(isset($_SESSION['Arabic']))
					{
						$Table = 'offers';
					}
				else
					{
						$Table = 'offers_english';
					}
				$sql = 'SELECT ID,End_Date FROM '.$Table.' WHERE Status != ?';
				$Execute_Array = array('0');
				$results = $Display->Display_Info($sql,$Execute_Array);
				foreach($results as $rows)
					{
						$ID = $rows->ID;
						$End_Date = strtotime($rows->End_Date);
						if($Current_Date_String > $End_Date)
							{
								$sql = 'UPDATE '.$Table.' SET Status = ? WHERE ID = ?';
								$Execute_Array = array('3',$ID);
								$Display->Execute($sql,$Execute_Array);
							}
						if($Current_Date_String <= $End_Date)
							{
								$sql = 'UPDATE '.$Table.' SET Status = ? WHERE ID = ?';
								$Execute_Array = array('1',$ID);
								$Display->Execute($sql,$Execute_Array);
							}
					}
			}
		public function delete_selected_sub_cat()
			{
				$Display = new sql();
				$OID = $_SESSION['User_ID'];
				$ID = $_POST['ID'];
				if(isset($_SESSION['Arabic']))
					{
						$Table = 'ads_sub_cat';
					}
				else
					{
						$Table = 'ads_sub_cat_english';
					}
				$sql = 'UPDATE '.$Table.' SET Status = ? WHERE ID = ?';
				$Execute_Array = array('0',$ID);
				$Display->Execute($sql,$Execute_Array);
				$Action_Time = date('Y-m-d G:i:s');
				$Display->create_log($ID,$Table,'3',$Action_Time,$OID,'deleted sub ads category');
				$this->ads_sub_cat();
			}
		public function delete_selected_cat()
			{
				$Display = new sql();
				$OID = $_SESSION['User_ID'];
				$ID = $_POST['ID'];
				if(isset($_SESSION['Arabic']))
					{
						$Table = 'ads_cat';
					}
				else
					{
						$Table = 'ads_cat_english';
					}
				$sql = 'UPDATE '.$Table.' SET Status = ? WHERE ID = ?';
				$Execute_Array = array('0',$ID);
				$Display->Execute($sql,$Execute_Array);
				$Action_Time = date('Y-m-d G:i:s');
				$Display->create_log($ID,$Table,'3',$Action_Time,$OID,'deleted ads category');
				$this->ads_cat();
			}
		public function submit_edit_sub_cat()
			{
				$Display = new sql();
				$validate = new validate_new();
				$OID = $_SESSION['User_ID'];
				$ID = $_POST['ID'];
				$Cat_Name = $_POST['Cat_Name'];
				$Time_Stamp = $_POST['Time_Stamp'];
				if(isset($_SESSION['Arabic']))
					{
						$Table = 'ads_sub_cat';
					}
				else
					{
						$Table = 'ads_sub_cat_english';
					}
				$Item_Exists_Modified_JSON = $validate->Item_Exists_Edit_Modified_JSON('ads_sub_cat','Sub_Cat_Name',$ID,$Cat_Name);
				if($Cat_Name == NULL)
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
						$sql = 'UPDATE '.$Table.' SET Sub_Cat_Name = ? WHERE ID = ?';
						$Execute_Array = array($Cat_Name,$ID);
						$Display->Execute($sql,$Execute_Array);
						$Action_Time = date('Y-m-d G:i:s');
						$Display->create_log($ID,$Table,'2',$Action_Time,$OID,'updated sub ads category');
						$this->ads_sub_cat();
					}
			}
		public function submit_edit_cat()
			{
				$Display = new sql();
				$validate = new validate_new();
				$OID = $_SESSION['User_ID'];
				$ID = $_POST['ID'];
				$Cat_Name = $_POST['Cat_Name'];
				$Time_Stamp = $_POST['Time_Stamp'];
				if(isset($_SESSION['Arabic']))
					{
						$Table = 'ads_cat';
					}
				else
					{
						$Table = 'ads_cat_english';
					}
				$Item_Exists_Modified_JSON = $validate->Item_Exists_Edit_Modified_JSON('ads_cat','Cat_Name',$ID,$Cat_Name);
				if($Cat_Name == NULL)
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
						$sql = 'UPDATE '.$Table.' SET Cat_Name = ? WHERE ID = ?';
						$Execute_Array = array($Cat_Name,$ID);
						$Display->Execute($sql,$Execute_Array);
						$Action_Time = date('Y-m-d G:i:s');
						$Display->create_log($ID,$Table,'2',$Action_Time,$OID,'updated ads category');
						$this->ads_cat();
					}
			}
		public function ads_sub_cat()
			{
				if(isset($_SESSION['Arabic']))
					{
						$Table = 'ads_sub_cat';
					}
				else
					{
						$Table = 'ads_sub_cat_english';
					}
				$sql = 'SELECT * FROM '.$Table.' WHERE Status = ?';
				$Execute_Array = array('1');
				$pagenum  = @$_POST['Page'];
				$paginate = new paginate($Table,'15',$pagenum,$sql,$Execute_Array);
				$Count = $paginate->Records($Table);
				$this->registry->template->Page = $pagenum;
				$this->registry->template->Count = $Count;
				$this->registry->template->Last = $paginate->Calculate_Last($Count);
				$results = $paginate->Paginate();
				$this->registry->template->results = $results;
				$this->registry->template->show('ads/ads_sub_cat');
			}
		public function ads_cat()
			{
				if(isset($_SESSION['Arabic']))
					{
						$Table = 'ads_cat';
					}
				else
					{
						$Table = 'ads_cat_english';
					}
				$sql = 'SELECT * FROM '.$Table.' WHERE Status = ?';
				$Execute_Array = array('1');
				$pagenum  = @$_POST['Page'];
				$paginate = new paginate($Table,'15',$pagenum,$sql,$Execute_Array);
				$Count = $paginate->Records($Table);
				$this->registry->template->Page = $pagenum;
				$this->registry->template->Count = $Count;
				$this->registry->template->Last = $paginate->Calculate_Last($Count);
				$results = $paginate->Paginate();
				$this->registry->template->results = $results;
				$this->registry->template->show('ads/ads_cat');
			}
		public function submit_add_sub_cat()
			{
				$Display = new sql();
				$validate = new validate_new();
				$OID = $_SESSION['User_ID'];
				$Cat_Name = $_POST['Cat_Name'];
				$Time_Stamp = $_POST['Time_Stamp'];
				if(isset($_SESSION['Arabic']))
					{
						$Table = 'ads_sub_cat';
					}
				else
					{
						$Table = 'ads_sub_cat_english';
					}
				$Item_Exists_Modified_JSON = $validate->Item_Exists_Modified_JSON('ads_sub_cat','Sub_Cat_Name',$Cat_Name);
				if($Cat_Name == NULL)
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
						$sql = 'INSERT INTO '.$Table.' (Sub_Cat_Name,Status) VALUES (?,?)';
						$Execute_Array = array($Cat_Name,'1');
						$RID = $Display->Execute($sql,$Execute_Array,'1',$Table);
						$Action_Time = date('Y-m-d G:i:s');
						$Display->create_log($RID,$Table,'1',$Action_Time,$OID,'Inserted sub ads category');
						$this->ads_sub_cat();
					}
			}
		public function submit_add_cat()
			{
				$Display = new sql();
				$validate = new validate_new();
				$OID = $_SESSION['User_ID'];
				$Cat_Name = $_POST['Cat_Name'];
				$Time_Stamp = $_POST['Time_Stamp'];
				if(isset($_SESSION['Arabic']))
					{
						$Table = 'ads_cat';
					}
				else
					{
						$Table = 'ads_cat_english';
					}
				$Item_Exists_Modified_JSON = $validate->Item_Exists_Modified_JSON('ads_cat','Cat_Name',$Cat_Name);
				if($Cat_Name == NULL)
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
						$sql = 'INSERT INTO '.$Table.' (Cat_Name,Status) VALUES (?,?)';
						$Execute_Array = array($Cat_Name,'1');
						$RID = $Display->Execute($sql,$Execute_Array,'1',$Table);
						$Action_Time = date('Y-m-d G:i:s');
						$Display->create_log($RID,$Table,'1',$Action_Time,$OID,'Inserted ads category');
						$this->ads_cat();
					}
			}
}

?>
