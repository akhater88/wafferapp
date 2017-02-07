 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
$Allowed_Users = array('1');
validate_roles_new::validate($Allowed_Users);
class adminadvertisersController extends baseController {
			
		public function index() 
			{
				
			}
		public function find_user()
			{
				$Display = new sql();
				$First_Name = trim($_POST['First_Name']).'%';
				$sql = 'SELECT ID,First_Name,Last_Name FROM users WHERE First_Name LIKE ? OR Last_Name LIKE ? AND Status = ?';
				$Execute_Array = array($First_Name,$First_Name,'1');
				$this->registry->template->results = $Display->Display_Info($sql,$Execute_Array);
				$this->registry->template->show('adminadvertisers/find_user');
			}
		public function display_search_results()
			{
				$Display = new sql();
				$OID = $_SESSION['User_ID'];
				$Offer_Type = $_POST['Offer_Type'];
				$ID = $_POST['ID'];
				$Start_Date = date('Y-m-d',strtotime($_POST['Start_Date']));
				$End_Date = date('Y-m-d',strtotime($_POST['End_Date']));
				$Time_Stamp = $_POST['Time_Stamp'];
				$City = @$_POST['City'];
				if(isset($_SESSION['Arabic']))
					{
						$Table = 'offers';
					}
				else
					{
						$Table = 'offers_english';
					}
				switch($Offer_Type)
					{
						case '0':
						if($ID != 'Target')
							{
								if($City)
									{
										$sql = 'SELECT ID,Offer_Title,Offer_Content,Start_Date,End_Date,City,Status FROM '.$Table.' WHERE Status != ? AND Start_Date BETWEEN ? AND ? AND AID = ? AND City = ?';
										$Execute_Array = array('0',$Start_Date,$End_Date,$ID,$City);
										$results = $Display->Display_Info($sql,$Execute_Array);
									}
								else
									{
										$sql = 'SELECT ID,Offer_Title,Offer_Content,Start_Date,End_Date,City,Status FROM '.$Table.' WHERE Status != ? AND Start_Date BETWEEN ? AND ? AND AID = ?';
										$Execute_Array = array('0',$Start_Date,$End_Date,$ID);
										$results = $Display->Display_Info($sql,$Execute_Array);
									}
							}
						else
							{
								if($City)
									{
										$sql = 'SELECT ID,Offer_Title,Offer_Content,Start_Date,End_Date,City,Status FROM '.$Table.' WHERE Status != ? AND Start_Date BETWEEN ? AND ? AND City = ?';
										$Execute_Array = array('0',$Start_Date,$End_Date,$City);
										$results = $Display->Display_Info($sql,$Execute_Array);
									}
								else
									{
										$sql = 'SELECT ID,Offer_Title,Offer_Content,Start_Date,End_Date,City,Status FROM '.$Table.' WHERE Status != ? AND Start_Date BETWEEN ? AND ?';
										$Execute_Array = array('0',$Start_Date,$End_Date);
										$results = $Display->Display_Info($sql,$Execute_Array);
									}
							}
						break;
						
						case '1':
						if($ID != 'Target')
							{
								if($City)
									{
										$sql = 'SELECT ID,Offer_Title,Offer_Content,Start_Date,End_Date,City,Status FROM '.$Table.' WHERE Status = ? AND Start_Date BETWEEN ? AND ? AND AID = ? AND City';
										$Execute_Array = array('1',$Start_Date,$End_Date,$ID,$City);
										$results = $Display->Display_Info($sql,$Execute_Array);
									}
								else
									{
										$sql = 'SELECT ID,Offer_Title,Offer_Content,Start_Date,End_Date,City,Status FROM '.$Table.' WHERE Status = ? AND Start_Date BETWEEN ? AND ? AND AID = ?';
										$Execute_Array = array('1',$Start_Date,$End_Date,$ID);
										$results = $Display->Display_Info($sql,$Execute_Array);
									}
							}
						else
							{
								if($City)
									{
										$sql = 'SELECT ID,Offer_Title,Offer_Content,Start_Date,End_Date,City,Status FROM '.$Table.' WHERE Status = ? AND Start_Date BETWEEN ? AND ? AND City = ?';
										$Execute_Array = array('1',$Start_Date,$End_Date,$City);
										$results = $Display->Display_Info($sql,$Execute_Array);
									}
								else
									{
										$sql = 'SELECT ID,Offer_Title,Offer_Content,Start_Date,End_Date,City,Status FROM '.$Table.' WHERE Status = ? AND Start_Date BETWEEN ? AND ?';
										$Execute_Array = array('1',$Start_Date,$End_Date);
										$results = $Display->Display_Info($sql,$Execute_Array);
									}
							}
						break;
						
						case '2':
						if($ID != 'Target')
							{
								if($City)
									{
										$sql = 'SELECT ID,Offer_Title,Offer_Content,Start_Date,End_Date,City,Status FROM '.$Table.' WHERE Status = ? AND Start_Date BETWEEN ? AND ? AND AID = ? AND City = ?';
										$Execute_Array = array('2',$Start_Date,$End_Date,$ID,$City);
										$results = $Display->Display_Info($sql,$Execute_Array);
									}
								else
									{
										$sql = 'SELECT ID,Offer_Title,Offer_Content,Start_Date,End_Date,City,Status FROM '.$Table.' WHERE Status = ? AND Start_Date BETWEEN ? AND ? AND AID = ?';
										$Execute_Array = array('2',$Start_Date,$End_Date,$ID);
										$results = $Display->Display_Info($sql,$Execute_Array);
									}
							}
						else
							{
								if($City)
									{
										$sql = 'SELECT ID,Offer_Title,Offer_Content,Start_Date,End_Date,City,Status FROM '.$Table.' WHERE Status = ? AND Start_Date BETWEEN ? AND ? AND City = ?';
										$Execute_Array = array('2',$Start_Date,$End_Date,$City);
										$results = $Display->Display_Info($sql,$Execute_Array);
									}
								else
									{
										$sql = 'SELECT ID,Offer_Title,Offer_Content,Start_Date,End_Date,City,Status FROM '.$Table.' WHERE Status = ? AND Start_Date BETWEEN ? AND ?';
										$Execute_Array = array('2',$Start_Date,$End_Date);
										$results = $Display->Display_Info($sql,$Execute_Array);
									}
							}
						break;
						
						default:
						$results = array();
					}
				
				if(count($results))
					{
						$myTweets = array("flag" => '0');
						$Display->Write_JSON($Time_Stamp,$myTweets);
						$results = $Display->Display_Info($sql,$Execute_Array);
						$this->registry->template->results = $results;
						$this->search_offer();
						$this->registry->template->show('adminadvertisers/display_search_results');
					}
				else
					{
						$myTweets = array("flag" => '1');
						$Display->Write_JSON($Time_Stamp,$myTweets);
						$this->search_offer();
					}
				
			}
		public function show_log_details()
			{
				$Exceptions = array('ID','AID','OID','Status','user_name','password','Salt');
				$Display = new sql();
				$URL = new url();
				$RID = $URL->getPar('RecordId');
				$ID = $URL->getPar('LogId');
				$sql = 'SELECT Table_Name FROM logs WHERE ID = ?';
				$Execute_Array = array($ID);
				$Table_Name = $Display->Display_Single_Info_Modified($sql,'Table_Name',$Execute_Array);
				switch($Table_Name)
					{
						case 'offers_english':
						$sql = 'SELECT Offer_Title,Offer_Content,Start_Date,End_Date FROM '.$Table_Name.' WHERE ID = ?';
						$Execute_Array = array($RID);
						$this->registry->template->results = $Display->Display_Info($sql,$Execute_Array);
						$this->registry->template->show('adminadvertisers/show_offers_log');
						break;
						
						case 'offers':
						$sql = 'SELECT Offer_Title,Offer_Content,Start_Date,End_Date FROM '.$Table_Name.' WHERE ID = ?';
						$Execute_Array = array($RID);
						$this->registry->template->results = $Display->Display_Info($sql,$Execute_Array);
						$this->registry->template->show('adminadvertisers/show_offers_log');
						break;
						
						case 'users':
						$sql = 'SELECT First_Name,Last_Name,user_name,Level,Company_Name,Phone_Number,Cell_Phone,Email,Starts_Date,End_Date,Ads_Cat,Country FROM '.$Table_Name.' WHERE ID = ?';
						$Execute_Array = array($RID);
						$this->registry->template->results = $Display->Display_Info($sql,$Execute_Array);
						$this->registry->template->show('adminadvertisers/show_users_log');
						break;
						
						case 'ads_cat':
						$sql = 'SELECT Cat_Name FROM '.$Table_Name.' WHERE ID = ?';
						$Execute_Array = array($RID);
						$this->registry->template->results = $Display->Display_Info($sql,$Execute_Array);
						$this->registry->template->show('adminadvertisers/show_cat_log');
						break;
						
						case 'ads_cat_english':
						$sql = 'SELECT Cat_Name FROM '.$Table_Name.' WHERE ID = ?';
						$Execute_Array = array($RID);
						$this->registry->template->results = $Display->Display_Info($sql,$Execute_Array);
						$this->registry->template->show('adminadvertisers/show_cat_log');
						break;
						
						case 'city_english':
						$sql = 'SELECT City_Name FROM '.$Table_Name.' WHERE ID = ?';
						$Execute_Array = array($RID);
						$this->registry->template->results = $Display->Display_Info($sql,$Execute_Array);
						$this->registry->template->show('adminadvertisers/show_city_log');
						break;
						
						case 'city':
						$sql = 'SELECT City_Name FROM '.$Table_Name.' WHERE ID = ?';
						$Execute_Array = array($RID);
						$this->registry->template->results = $Display->Display_Info($sql,$Execute_Array);
						$this->registry->template->show('adminadvertisers/show_city_log');
						break;
						
						default:
						echo '';
					}
				/*$sql = 'SHOW COLUMNS FROM '.$Table_Name;
				$raw_column_data = $Display->Display_Info($sql);
				foreach($raw_column_data as $outer_key => $array){
                    foreach($array as $inner_key => $value){
                         
                        if ($inner_key === 'Field'){
                               if (!(int)$inner_key){
							   if(!in_array($value,$Exceptions))
							   		{
                                    	$column_names[] = $value;
									}
                                }
                            }
                    }
                }*/ 
				
				
				
			}
		public function serach_log()
			{
				$this->registry->template->show('adminadvertisers/serach_log');
			}
		public function display_search_results_logs()
			{
				$Display = new sql();
				$OID = $_SESSION['User_ID'];
				$Offer_Type = $_POST['Offer_Type'];
				$ID = $_POST['ID'];
				$Start_Date = date('Y-m-d',strtotime($_POST['Start_Date']));
				$End_Date = date('Y-m-d',strtotime($_POST['End_Date']));
				$Time_Stamp = $_POST['Time_Stamp'];
				$Table = 'logs';
				switch($Offer_Type)
					{
						case '0':
						if($ID != 'Target')
							{
								$sql = 'SELECT * FROM '.$Table.' WHERE Time_Stamp BETWEEN ? AND ? AND OID = ? ORDER BY Action';
								$Execute_Array = array($Start_Date,$End_Date,$ID);
								$results = $Display->Display_Info($sql,$Execute_Array);
							}
						else
							{
								$sql = 'SELECT * FROM '.$Table.' WHERE Time_Stamp BETWEEN ? AND ? ORDER BY Action';
								$Execute_Array = array($Start_Date,$End_Date);
								$results = $Display->Display_Info($sql,$Execute_Array);
							}
						break;
						
						default:
						if($ID != 'Target')
							{
								$sql = 'SELECT * FROM '.$Table.' WHERE Time_Stamp BETWEEN ? AND ? AND OID = ? AND Action = ?';
								$Execute_Array = array($Start_Date,$End_Date,$ID,$Offer_Type);
								$results = $Display->Display_Info($sql,$Execute_Array);
							}
						else
							{
								$sql = 'SELECT * FROM '.$Table.' WHERE Time_Stamp BETWEEN ? AND ? AND Action = ?';
								$Execute_Array = array($Start_Date,$End_Date,$Offer_Type);
								$results = $Display->Display_Info($sql,$Execute_Array);
							}
					}
					
				if(count($results))
					{
						$myTweets = array("flag" => '0');
						$Display->Write_JSON($Time_Stamp,$myTweets);
						$results = $Display->Display_Info($sql,$Execute_Array);
						$this->registry->template->results = $results;
						$this->registry->template->show('adminadvertisers/serach_log');
						$this->registry->template->show('adminadvertisers/display_search_results_logs');
					}
				else
					{
						$myTweets = array("flag" => '1');
						$Display->Write_JSON($Time_Stamp,$myTweets);
						$this->registry->template->show('adminadvertisers/serach_log');
					}
			}
		public function display_city()
			{
				$Display = new sql();
				$Country = $_POST['Country'];
				if(isset($_SESSION['Arabic']))
					{
						$Table = 'city';
					}
				else
					{
						$Table = 'city_english';
					}
				$sql = 'SELECT ID,City_Name FROM '.$Table.' WHERE CID = ? AND Status = ?';
				$Execute_Array = array($Country,'1');
				$this->registry->template->results = $Display->Display_Info($sql,$Execute_Array);
				$this->registry->template->show('adminadvertisers/display_city');
			}
		public function search_offer()
			{
				$Display = new sql();
				if(isset($_SESSION['Arabic']))
					{
						$Table = 'country';
					}
				else
					{
						$Table = 'country_english';
					}
				$sql_city = 'SELECT ID,Name FROM '.$Table.' WHERE Status = ?';
				$Execute_Array = array('1');
				$this->registry->template->results_city = $Display->Display_Info($sql_city,$Execute_Array);
				$this->registry->template->show('adminadvertisers/search_offer');
			}
		public function publish_selected_offer()
			{
				$Display = new sql();
				$OID = $_SESSION['User_ID'];
				$ID = $_POST['ID'];
				if(isset($_SESSION['Arabic']))
					{
						$Table = 'offers';
					}
				else
					{
						$Table = 'offers_english';
					}
				$sql = 'SELECT AID FROM '.$Table.' WHERE ID = ?';
				$Execute_Array = array($ID);
				$AID = $Display->Display_Single_Info_Modified($sql,'AID',$Execute_Array);
				$sql = 'UPDATE '.$Table.' SET Status = ? WHERE ID = ?';
				$Execute_Array = array('1',$ID);
				$Display->Execute($sql,$Execute_Array);
				$Action_Time = date('Y-m-d G:i:s');
				$Display->create_log($ID,$Table,'2',$Action_Time,$OID,'Publish a voucher');
				$this->show_client_offers_par($AID);
			}
		public function block_selected_offer()
			{
				$Display = new sql();
				$OID = $_SESSION['User_ID'];
				$ID = $_POST['ID'];
				if(isset($_SESSION['Arabic']))
					{
						$Table = 'offers';
					}
				else
					{
						$Table = 'offers_english';
					}
				$sql = 'SELECT AID FROM '.$Table.' WHERE ID = ?';
				$Execute_Array = array($ID);
				$AID = $Display->Display_Single_Info_Modified($sql,'AID',$Execute_Array);
				$sql = 'UPDATE '.$Table.' SET Status = ? WHERE ID = ?';
				$Execute_Array = array('2',$ID);
				$Display->Execute($sql,$Execute_Array);
				$Action_Time = date('Y-m-d G:i:s');
				$Display->create_log($ID,$Table,'2',$Action_Time,$OID,'Block a voucher');
				$this->show_client_offers_par($AID);
			}
		public function delete_selected_offer()
			{
				$Display = new sql();
				$OID = $_SESSION['User_ID'];
				$ID = $_POST['ID'];
				if(isset($_SESSION['Arabic']))
					{
						$Table = 'offers';
					}
				else
					{
						$Table = 'offers_english';
					}
				$sql = 'SELECT AID FROM '.$Table.' WHERE ID = ?';
				$Execute_Array = array($ID);
				$AID = $Display->Display_Single_Info_Modified($sql,'AID',$Execute_Array);
				$sql = 'UPDATE '.$Table.' SET Status = ? WHERE ID = ?';
				$Execute_Array = array('0',$ID);
				$Display->Execute($sql,$Execute_Array);
				$Action_Time = date('Y-m-d G:i:s');
				$Display->create_log($ID,$Table,'3',$Action_Time,$OID,'Deleted a voucher');
				$this->show_client_offers_par($AID);
			}
		public function delete_expired_selected_offer()
			{
				$Display = new sql();
				$OID = $_SESSION['User_ID'];
				$ID = $_POST['ID'];
				if(isset($_SESSION['Arabic']))
					{
						$Table = 'offers';
					}
				else
					{
						$Table = 'offers_english';
					}
				$sql = 'UPDATE '.$Table.' SET Status = ? WHERE ID = ?';
				$Execute_Array = array('0',$ID);
				$Display->Execute($sql,$Execute_Array);
				$Action_Time = date('Y-m-d G:i:s');
				$Display->create_log($ID,$Table,'3',$Action_Time,$OID,'Deleted a voucher');
				$this->edit_expired_offer();
			}
		public function edit_selected_expired_offer()
			{
				$Display = new sql();
				$URL = new url();
				$OID = $_SESSION['User_ID'];
				$ID = $URL->getPar('Member');
				$this->registry->template->ID = $ID;
				if(isset($_SESSION['Arabic']))
					{
						$Table = 'offers';
					}
				else
					{
						$Table = 'offers_english';
					}
				$sql = 'SELECT ID,Offer_Title,Offer_Content,Start_Date,End_Date FROM '.$Table.' WHERE ID = ?';
				$Execute_Array = array($ID);
				$this->registry->template->results = $Display->Display_Info($sql,$Execute_Array);
				$this->registry->template->show('adminadvertisers/edit_selected_expired_offer');
			}
		public function edit_selected_offer()
			{
				$Display = new sql();
				$URL = new url();
				$OID = $_SESSION['User_ID'];
				$ID = $URL->getPar('Member');
				$AID = $URL->getPar('AID');
				$this->registry->template->ID = $ID;
				if(isset($_SESSION['Arabic']))
					{
						$Table = 'offers';
						$Table_Cat = 'ads_sub_cat';
						$Table_City = 'city';
						$Table_Merchant_Services = 'merchant_services';
					}
				else
					{
						$Table = 'offers_english';
						$Table_Cat = 'ads_sub_cat_english';
						$Table_City = 'city_english';
						$Table_Merchant_Services = 'merchant_services_english';
					}
				$sql = 'SELECT Country FROM users WHERE ID = ?';
				$Execute_Array = array($AID);
				$CID = $Display->Display_Single_Info_Modified($sql,'Country',$Execute_Array);
				
				$sql_city = 'SELECT ID,City_Name FROM '.$Table_City.' WHERE CID = ? AND Status = ?';
				$Execute_Array = array($CID,'1');
				$this->registry->template->results_city = $Display->Display_Info($sql_city,$Execute_Array);
				
				$sql = 'SELECT ID,Sub_Cat_Name FROM '.$Table_Cat.' WHERE Status = ?';
				$Execute_Array = array('1');
				$this->registry->template->results_cat = $Display->Display_Info($sql,$Execute_Array);
				
				$sql = 'SELECT SID FROM '.$Table_Merchant_Services.' WHERE MID = ?';
				$Execute_Array = array($AID);
				$results =  $Display->Display_Info($sql,$Execute_Array);
				$Merchant_Services = array();
				foreach($results as $rows)
					{
						$Merchant_Services[] = $rows->SID;
					}
				$this->registry->template->Merchant_Services = $Merchant_Services;
				
				$sql = 'SELECT ID,Ads_Sub_Cat,Offer_Title,Offer_Content,Start_Date,End_Date,City FROM '.$Table.' WHERE ID = ?';
				$Execute_Array = array($ID);
				$this->registry->template->results = $Display->Display_Info($sql,$Execute_Array);
				$this->registry->template->show('adminadvertisers/edit_selected_offer');
			}
		public function edit_expired_offer()
			{
				$Display = new sql();
				$OID = $_SESSION['User_ID'];
				if(isset($_SESSION['Arabic']))
					{
						$Table = 'offers';
					}
				else
					{
						$Table = 'offers_english';
					}
				$sql = 'SELECT ID,Offer_Title,Start_Date,End_Date FROM '.$Table.' WHERE Status = ? AND AID = ? ORDER BY Start_Date DESC';
				$Execute_Array = array('2',$OID);
				$pagenum  = @$_POST['Page'];
				$paginate = new paginate($Table,'10',$pagenum,$sql,$Execute_Array);
				$Count = $paginate->Records($Table);
				$this->registry->template->Page = $pagenum;
				$this->registry->template->Count = $Count;
				$this->registry->template->Last = $paginate->Calculate_Last($Count);
				$results = $paginate->Paginate();
				$this->registry->template->results = $results;
				$this->registry->template->show('adminadvertisers/edit_expired_offer');
			}
		public function edit_offer()
			{
				$Display = new sql();
				$OID = $_SESSION['User_ID'];
				if(isset($_SESSION['Arabic']))
					{
						$Table = 'offers';
					}
				else
					{
						$Table = 'offers_english';
					}
				$sql = 'SELECT ID,Offer_Title,Start_Date,End_Date FROM '.$Table.' WHERE Status = ? AND AID = ? ORDER BY Start_Date DESC';
				$Execute_Array = array('1',$OID);
				$pagenum  = @$_POST['Page'];
				$paginate = new paginate($Table,'10',$pagenum,$sql,$Execute_Array);
				$Count = $paginate->Records($Table);
				$this->registry->template->Page = $pagenum;
				$this->registry->template->Count = $Count;
				$this->registry->template->Last = $paginate->Calculate_Last($Count);
				$results = $paginate->Paginate();
				$this->registry->template->results = $results;
				$this->registry->template->show('adminadvertisers/edit_offer');
			}
		public function show_expired_offer()
			{
				$Display = new sql();
				$sql = 'SELECT ID,First_Name,Last_Name,user_name FROM users WHERE Status = ? AND Level = ? ORDER BY BINARY First_Name';
				$Execute_Array = array('1','2');
				$pagenum  = @$_POST['Page'];
				$paginate = new paginate('users','20',$pagenum,$sql,$Execute_Array);
				$Count = $paginate->Records('users');
				$this->registry->template->Page = $pagenum;
				$this->registry->template->Count = $Count;
				$this->registry->template->Last = $paginate->Calculate_Last($Count);
				$results = $paginate->Paginate();
				$this->registry->template->results = $results;
				$this->registry->template->show('adminadvertisers/show_expired_offer');
			}
		public function add_offer_start()
			{
				$Display = new sql();
				$sql = 'SELECT ID,First_Name,Last_Name,user_name FROM users WHERE Status = ? AND Level = ? ORDER BY BINARY First_Name';
				$Execute_Array = array('1','2');
				$pagenum  = @$_POST['Page'];
				$paginate = new paginate('users','20',$pagenum,$sql,$Execute_Array);
				$Count = $paginate->Records('users');
				$this->registry->template->Page = $pagenum;
				$this->registry->template->Count = $Count;
				$this->registry->template->Last = $paginate->Calculate_Last($Count);
				$results = $paginate->Paginate();
				$this->registry->template->results = $results;
				$this->registry->template->show('adminadvertisers/add_offer_start');
			}
		public function add_offer()
			{
				$Display = new sql();
				$URL = new url();
				$ID = $URL->getPar('Member');
				$this->registry->template->ID = $ID;
				if(isset($_SESSION['Arabic']))
					{
						$Table = 'ads_sub_cat';
						$Table_City = 'city';
						$Table_Merchant_Services = 'merchant_services';
					}
				else
					{
						$Table = 'ads_sub_cat_english';
						$Table_City = 'city_english';
						$Table_Merchant_Services = 'merchant_services_english';
					}
				$sql = 'SELECT Country FROM users WHERE ID = ?';
				$Execute_Array = array($ID);
				$CID = $Display->Display_Single_Info_Modified($sql,'Country',$Execute_Array);
				
				$sql_city = 'SELECT ID,City_Name FROM '.$Table_City.' WHERE CID = ? AND Status = ?';
				$Execute_Array = array($CID,'1');
				$this->registry->template->results_city = $Display->Display_Info($sql_city,$Execute_Array);
				
				$sql = 'SELECT ID,Sub_Cat_Name FROM '.$Table.' WHERE Status = ?';
				$Execute_Array = array('1');
				$this->registry->template->results = $Display->Display_Info($sql,$Execute_Array);
				$sql = 'SELECT SID FROM '.$Table_Merchant_Services.' WHERE MID = ?';
				$Execute_Array = array($ID);
				$results =  $Display->Display_Info($sql,$Execute_Array);
				$Merchant_Services = array();
				foreach($results as $rows)
					{
						$Merchant_Services[] = $rows->SID;
					}
				$this->registry->template->Merchant_Services = $Merchant_Services;
				$this->registry->template->show('adminadvertisers/add_offer');
			}
		private function show_client_offers_par($AID)
			{
				$Display = new sql();
				$sql = 'SELECT First_Name,Last_Name FROM users WHERE ID = ?';
				$Execute_Array = array($AID);
				$results = $Display->Display_Info($sql,$Execute_Array);
				foreach($results as $rows)
					{
						$Full_Name = $rows->First_Name.' '.$rows->Last_Name;
					}
				$this->registry->template->Full_Name = $Full_Name;
				$this->registry->template->AID = $AID;
				if(isset($_SESSION['Arabic']))
					{
						$Table = 'offers';
					}
				else
					{
						$Table = 'offers_english';
					}
				$sql = 'SELECT ID,Offer_Title,Offer_Content,Start_Date,End_Date,Status FROM '.$Table.' WHERE Status != ? AND AID = ? ORDER BY Start_Date DESC';
				$Execute_Array = array('0',$AID);
				$pagenum  = @$_POST['Page'];
				$paginate = new paginate($Table,'20',$pagenum,$sql,$Execute_Array);
				$Count = $paginate->Records($Table);
				$this->registry->template->Page = $pagenum;
				$this->registry->template->Count = $Count;
				$this->registry->template->Last = $paginate->Calculate_Last($Count);
				$results = $paginate->Paginate();
				$this->registry->template->results = $results;
				$this->registry->template->show('adminadvertisers/show_client_offers');
			}
		
		public function show_client_offers()
			{
				$Display = new sql();
				$URL = new url();
				$AID = $URL->getPar('Member');
				$sql = 'SELECT First_Name,Last_Name FROM users WHERE ID = ?';
				$Execute_Array = array($AID);
				$results = $Display->Display_Info($sql,$Execute_Array);
				foreach($results as $rows)
					{
						$Full_Name = $rows->First_Name.' '.$rows->Last_Name;
					}
				$this->registry->template->Full_Name = $Full_Name;
				$this->registry->template->AID = $AID;
				if(isset($_SESSION['Arabic']))
					{
						$Table = 'offers';
					}
				else
					{
						$Table = 'offers_english';
					}
				$sql = 'SELECT ID,Offer_Title,Offer_Content,Start_Date,End_Date,Status FROM '.$Table.' WHERE Status != ? AND AID = ? ORDER BY Start_Date DESC';
				$Execute_Array = array('0',$AID);
				$pagenum  = @$_POST['Page'];
				$paginate = new paginate($Table,'20',$pagenum,$sql,$Execute_Array);
				$Count = $paginate->Records($Table);
				$this->registry->template->Page = $pagenum;
				$this->registry->template->Count = $Count;
				$this->registry->template->Last = $paginate->Calculate_Last($Count);
				$results = $paginate->Paginate();
				$this->registry->template->results = $results;
				$this->registry->template->show('adminadvertisers/show_client_offers');
			}
		public function submit_edit_offer()
			{
				$Display = new sql();
				$validate = new validate_new();
				if(isset($_SESSION['Arabic']))
					{
						$Table = 'offers';
					}
				else
					{
						$Table = 'offers_english';
					}
				$OID = $_SESSION['User_ID'];
				$ID = $_POST['ID'];
				$Offer_Title = trim(strip_tags($_POST['Offer_Title']));
				$Offer_Content = $_POST['Offer_Content'];
				$City = $_POST['City'];
				$Time_Stamp = $_POST['Time_Stamp'];
				$Start_Date = $_POST['Start_Date'];
				$End_Date = $_POST['End_Date'];
				$Ads_Sub_Cat = $_POST['Ads_Sub_Cat'];
				$Starts_Date_String = strtotime($Start_Date);
				$End_Date_String = strtotime($End_Date);
				$Offer_Content_Stripped = trim(strip_tags($Offer_Content));
				$Offer_Content_Stripped_Length = strlen($Offer_Content_Stripped);
				$Item_Exists_Modified_JSON = $validate->Item_Exists_Edit_Modified_JSON_Edit('offers','Offer_Title',$ID,$Offer_Title,$OID);
				if($Offer_Title == NULL)
					{
						$myTweets = array("flag" => '1');
						$Display->Write_JSON($Time_Stamp,$myTweets);
					}
				elseif($Item_Exists_Modified_JSON)
					{
						$myTweets = array("flag" => '2');
						$Display->Write_JSON($Time_Stamp,$myTweets);
					}
				elseif($Offer_Content_Stripped == NULL)
					{
						$myTweets = array("flag" => '3');
						$Display->Write_JSON($Time_Stamp,$myTweets);
					}
				elseif($Starts_Date_String > $End_Date_String)
					{
						$myTweets = array("flag" => '4');
						$Display->Write_JSON($Time_Stamp,$myTweets);
					}
				elseif($Offer_Content_Stripped_Length > 500)
					{
						$myTweets = array("flag" => '5');
						$Display->Write_JSON($Time_Stamp,$myTweets);
					}
				elseif(!$Ads_Sub_Cat)
					{
						$myTweets = array("flag" => '6');
						$Display->Write_JSON($Time_Stamp,$myTweets);
					}
				elseif(!$City)
					{
						$myTweets = array("flag" => '7');
						$Display->Write_JSON($Time_Stamp,$myTweets);
					}
				else
					{
						$myTweets = array("flag" => '0');
						$Display->Write_JSON($Time_Stamp,$myTweets);
						$Start_Date = date('Y-m-d',strtotime($Start_Date));
						$End_Date = date('Y-m-d',strtotime($End_Date));
						$Offer_Content = htmlentities($Offer_Content,ENT_QUOTES,'UTF-8');
						$sql = 'UPDATE '.$Table.' SET Ads_Sub_Cat=?,Offer_Title = ?,Offer_Content = ?,Start_Date = ?,End_Date = ?, City = ? WHERE ID = ?';
						$Execute_Array = array($Ads_Sub_Cat,$Offer_Title,$Offer_Content,$Start_Date,$End_Date,$City,$ID);
						$Display->Execute($sql,$Execute_Array);
						$Action_Time = date('Y-m-d G:i:s');
						$Display->create_log($ID,$Table,'2',$Action_Time,$OID,'Edited a voucher');
					}
			}
		public function submit_new_offer()
			{
				$Display = new sql();
				$validate = new validate_new();
				if(isset($_SESSION['Arabic']))
					{
						$Table = 'offers';
					}
				else
					{
						$Table = 'offers_english';
					}
				$AID = $_POST['ID'];
				$OID = $_SESSION['User_ID'];
				$Offer_Title = trim(strip_tags($_POST['Offer_Title']));
				$Offer_Content = $_POST['Offer_Content'];
				$Ads_Sub_Cat = $_POST['Ads_Sub_Cat'];
				$City = $_POST['City'];
				$Time_Stamp = $_POST['Time_Stamp'];
				$Start_Date = $_POST['Start_Date'];
				$End_Date = $_POST['End_Date'];
				$Starts_Date_String = strtotime($Start_Date);
				$End_Date_String = strtotime($End_Date);
				$Offer_Content_Stripped = trim(strip_tags($Offer_Content));
				$Offer_Content_Stripped_Length = strlen($Offer_Content_Stripped);
				$Item_Exists_Modified_JSON = $validate->Item_Exists_Modified_JSON('offers','Offer_Title',$Offer_Title);
				if($Offer_Title == NULL)
					{
						$myTweets = array("flag" => '1');
						$Display->Write_JSON($Time_Stamp,$myTweets);
					}
				elseif($Item_Exists_Modified_JSON)
					{
						$myTweets = array("flag" => '2');
						$Display->Write_JSON($Time_Stamp,$myTweets);
					}
				elseif($Offer_Content_Stripped == NULL)
					{
						$myTweets = array("flag" => '3');
						$Display->Write_JSON($Time_Stamp,$myTweets);
					}
				elseif($Starts_Date_String > $End_Date_String)
					{
						$myTweets = array("flag" => '4');
						$Display->Write_JSON($Time_Stamp,$myTweets);
					}
				elseif($Offer_Content_Stripped_Length > 500)
					{
						$myTweets = array("flag" => '5');
						$Display->Write_JSON($Time_Stamp,$myTweets);
					}
				elseif(!$Offer_Content_Stripped_Length)
					{
						$myTweets = array("flag" => '3');
						$Display->Write_JSON($Time_Stamp,$myTweets);
					}
				elseif(!$Ads_Sub_Cat)
					{
						$myTweets = array("flag" => '6');
						$Display->Write_JSON($Time_Stamp,$myTweets);
					}
				elseif(!$City)
					{
						$myTweets = array("flag" => '7');
						$Display->Write_JSON($Time_Stamp,$myTweets);
					}
				else
					{
						$myTweets = array("flag" => '0');
						$Display->Write_JSON($Time_Stamp,$myTweets);
						$Start_Date = date('Y-m-d',strtotime($Start_Date));
						$End_Date = date('Y-m-d',strtotime($End_Date));
						$Offer_Content = htmlentities($Offer_Content,ENT_QUOTES,'UTF-8');
						$sql = 'INSERT INTO '.$Table.' (AID,Ads_Sub_Cat,Offer_Title,Offer_Content,Start_Date,End_Date,City,Status) VALUES (?,?,?,?,?,?,?,?)';
						$Execute_Array = array($AID,$Ads_Sub_Cat,$Offer_Title,$Offer_Content,$Start_Date,$End_Date,$City,'2');
						$RID = $Display->Execute($sql,$Execute_Array,'1',$Table);
						$Action_Time = date('Y-m-d G:i:s');
						$Display->create_log($RID,$Table,'1',$Action_Time,$OID,'added new voucher');
					}
			}
		public function edit_pw()
			{
				$this->registry->template->ID =  $_SESSION['User_ID'];
				$this->registry->template->show('adminadvertisers/edit_pw');
			}
		public function submit_new_pw()
			{
				$Display = new sql();
				$OID = $_SESSION['User_ID'];
				$ID = $_POST['ID'];
				$password = $_POST['password'];
				$password_2 = $_POST['password_2'];
				$Time_Stamp = $_POST['Time_Stamp'];
				$Display->Delete_JSON($Time_Stamp);
				if($password == NULL)
					{
						$myTweets = array("flag" => '1');
						$Display->Write_JSON($Time_Stamp,$myTweets);
					}
				elseif($password != $password_2)
					{
						$myTweets = array("flag" => '2');
						$Display->Write_JSON($Time_Stamp,$myTweets);
					}
				elseif(strlen($password) < 6)
					{
						$myTweets = array("flag" => '3');
						$Display->Write_JSON($Time_Stamp,$myTweets);
					}
				else
					{
						$myTweets = array("flag" => '0');
						$Display->Write_JSON($Time_Stamp,$myTweets);
						$create_member = new create_member();
						$Salt = $create_member->getPasswordSalt();
						$Enc_PW = $create_member->getPasswordHash($Salt,$password);
						$sql = 'UPDATE users SET password = ?,Salt = ? WHERE ID = ?';
						$Execute_Array = array($Enc_PW,$Salt,$ID);
						$Display->Execute($sql,$Execute_Array);
						$Action_Time = date('Y-m-d G:i:s');
						$Display->create_log($ID,'users','2',$Action_Time,$OID,'Edited user password');
					}
					
			}
		function show_account()
			{
				$Display = new sql();
				$OID = $_SESSION['User_ID'];
				$sql = 'SELECT First_Name,Last_Name,Company_Name,Phone_Number,Cell_Phone,Email FROM users WHERE ID = ?';
				$Execute_Array = array($OID);
				$this->registry->template->Member_ID = $OID;
				$this->registry->template->results = $Display->Display_Info($sql,$Execute_Array);
				$this->registry->template->show('adminadvertisers/show_account');
			}
		public function submit_members_edit()
			{
				$Display = new sql();
				$validate = new validate_new();
				$OID = $_SESSION['User_ID'];
				$ID = $_POST['ID'];
				$First_Name = $_POST['First_Name'];
				$Last_Name = $_POST['Last_Name'];
				$Company_Name = $_POST['Company_Name'];
				$Phone_Number = $_POST['Phone_Number'];
				$Cell_Phone = $_POST['Cell_Phone'];
				$Email = $_POST['Email'];
				$Time_Stamp = $_POST['Time_Stamp'];
				$Display->Delete_JSON($Time_Stamp);
				$Validate_Email = $validate->Validate_Email($Email);
				
				if($First_Name == NULL)
					{
						$myTweets = array("flag" => '1');
						$Display->Write_JSON($Time_Stamp,$myTweets);
								
					}
				elseif($Last_Name == NULL)
					{
						$myTweets = array("flag" => '2');
						$Display->Write_JSON($Time_Stamp,$myTweets);
								
					}
				elseif($Company_Name == NULL)
					{
						$myTweets = array("flag" => '6');
						$Display->Write_JSON($Time_Stamp,$myTweets);
					}
				elseif(($Phone_Number == NULL)&&($Cell_Phone == NULL))
					{
						$myTweets = array("flag" => '7');
						$Display->Write_JSON($Time_Stamp,$myTweets);
					}
				elseif($Email == NULL)
					{
						$myTweets = array("flag" => '8');
						$Display->Write_JSON($Time_Stamp,$myTweets);
					}
						
				elseif(!$Validate_Email)
					{
						$myTweets = array("flag" => '13');
						$Display->Write_JSON($Time_Stamp,$myTweets);
					}
				else
					{
						$myTweets = array("flag" => '0');
						$Display->Write_JSON($Time_Stamp,$myTweets);
						$Starts_Date = date('Y-m-d',strtotime($Starts_Date));
						$End_Date = date('Y-m-d',strtotime($End_Date));
						$sql = 'UPDATE users SET First_Name = ?,Last_Name = ?,Company_Name = ?,Phone_Number = ?,Cell_Phone = ?,Email = ? WHERE ID = ?';
						$Execute_Array = array($First_Name,$Last_Name,$Company_Name,$Phone_Number,$Cell_Phone,$Email,$ID);
						$Display->Execute($sql,$Execute_Array);
						$Action_Time = date('Y-m-d G:i:s');
						$Display->create_log($ID,'users','2',$Action_Time,$OID,'user edited');
					}
					
			}
}

?>
