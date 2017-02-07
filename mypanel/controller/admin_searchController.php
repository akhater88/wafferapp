 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
$Allowed_Users = array('1');
validate_roles_new::validate($Allowed_Users);
class admin_searchController extends baseController {
			
		public function index() 
			{
				
			}
		public function delete_selected_country_user()
			{
				$Display = new sql();
				$ID = $_POST['ID'];
				$Page = $_POST['Page'];
				$CID = $_POST['CID'];
				$sql = 'UPDATE users SET Status = ? WHERE ID = ?';
				$Execute_Array = array('0',$ID);
				$Display->Execute($sql,$Execute_Array);
				$this->country_search_log_par($CID,$Page);
			}
		public function country_search_log_par($CID,$Page)
			{
				$Display = new sql();
				$CID = $_POST['CID'];
				$this->registry->template->CID = $CID;
				if($CID == '999')
					{
						$sql_total = 'SELECT ID FROM users WHERE Status = ? AND Level = ?';
						$Execute_Array = array('1','5');
						$this->registry->template->Total_Records =  $Display->Total_Records($sql_total,$Execute_Array);
						$sql = 'SELECT ID,user_name,Country FROM users WHERE Status = ? AND Level = ?';
						
					}
				else
					{
						$sql_total = 'SELECT ID FROM users WHERE Status = ? AND Country = ? AND Level = ?';
						$Execute_Array = array('1',$CID,'5');
						$this->registry->template->Total_Records =  $Display->Total_Records($sql_total,$Execute_Array);
						$sql = 'SELECT ID,user_name,Country FROM users WHERE Status = ? AND Country = ? AND Level = ?';
						
					}
				if(isset($_SESSION['Arabic']))
					{
						$Table = 'country';
					}
				else
					{
						$Table = 'country_english';
					}
				//$results = $Display->Display_Info($sql,$Execute_Array);
				$pagenum  = @$_POST['Page'];
				$paginate = new paginate('users','50',$pagenum,$sql,$Execute_Array);
				$Count = $paginate->Records('users');
				$this->registry->template->Page = $pagenum;
				$this->registry->template->Count = $Count;
				$this->registry->template->Last = $paginate->Calculate_Last($Count);
				$results = $paginate->Paginate();
				
				$Time_Stamp = array();
				$Full_Name = array();
				if(is_array($results) && count($results))
					{
						foreach($results as $rows)
							{
								$sql_log = 'SELECT Time_Stamp,OID FROM logs WHERE Table_Name = ? AND RID = ? AND Action = ?';
								$Execute_Array = array('users',$rows->ID,'1');
								$results_log = $Display->Display_Info($sql_log,$Execute_Array);
								foreach($results_log as $rows_log)
									{
										$Time_Stamp_Convert = date('d-m-Y',strtotime($rows_log->Time_Stamp));
										$Time_Stamp[] = $Time_Stamp_Convert;
										$sql_name = 'SELECT First_Name FROM users WHERE ID = ?';
										$Execute_Array = array($rows_log->OID);
										$Full_Name_String =  $Display->Display_Single_Info_Modified($sql_name,'First_Name',$Execute_Array);
										$Full_Name[] = $Full_Name_String;
									}
								
								$sql_country = 'SELECT Name FROM '.$Table.' WHERE ID = ?';
								$Execute_Array = array($rows->Country);
								$Country_Name_String =  $Display->Display_Single_Info_Modified($sql_country,'Name',$Execute_Array);
								$ID_Array[] = $rows->ID;
								$Users[] = $rows->user_name;
								$Country_Name[] = $Country_Name_String;
								
							}
						$this->registry->template->Time_Stamp = $Time_Stamp;
						$this->registry->template->Full_Name = $Full_Name;
						$this->registry->template->ID_Array = $ID_Array;
						$this->registry->template->Users = $Users;
						$this->registry->template->Country_Name = $Country_Name;
						$this->registry->template->show('admin_search/country_search_log');
					}
				else
					{
						$this->registry->template->show('admin_search/no_results');
					}
				
				
			}
		public function delete_selected_sales()
			{
				$Display = new sql();
				$ID = $_POST['ID'];
				$Page = $_POST['Page'];
				$CID = $_POST['CID'];
				$sql = 'UPDATE users SET Status = ? WHERE ID = ?';
				$Execute_Array = array('0',$ID);
				$Display->Execute($sql,$Execute_Array);
				$this->sales_search_log_par($CID,$Page);
			}
		public function sales_search_log_par($CID,$Page)
			{
				$Display = new sql();
				$this->registry->template->CID = $CID;
				if($CID == '999')
					{
						$sql_total = 'SELECT ID FROM users WHERE Status = ? AND Level = ?';
						$Execute_Array = array('1','3');
						$this->registry->template->Total_Records =  $Display->Total_Records($sql_total,$Execute_Array);
						$sql = 'SELECT ID,user_name,Country FROM users WHERE Status = ? AND Level = ?';
						
					}
				else
					{
						$sql_total = 'SELECT ID FROM users WHERE Status = ? AND Country = ? AND Level = ?';
						$Execute_Array = array('1',$CID,'3');
						$this->registry->template->Total_Records =  $Display->Total_Records($sql_total,$Execute_Array);
						$sql = 'SELECT ID,user_name,Country FROM users WHERE Status = ? AND Country = ? AND Level = ?';
						
					}
				if(isset($_SESSION['Arabic']))
					{
						$Table = 'country';
					}
				else
					{
						$Table = 'country_english';
					}
				//$results = $Display->Display_Info($sql,$Execute_Array);
				$pagenum  = $Page;
				$paginate = new paginate('users','50',$pagenum,$sql,$Execute_Array);
				$Count = $paginate->Records('users');
				$this->registry->template->Page = $pagenum;
				$this->registry->template->Count = $Count;
				$this->registry->template->Last = $paginate->Calculate_Last($Count);
				$results = $paginate->Paginate();
				
				$Time_Stamp = array();
				$Full_Name = array();
				if(is_array($results) && count($results))
					{
						foreach($results as $rows)
							{
								$sql_log = 'SELECT Time_Stamp,OID FROM logs WHERE Table_Name = ? AND RID = ? AND Action = ?';
								$Execute_Array = array('users',$rows->ID,'1');
								$results_log = $Display->Display_Info($sql_log,$Execute_Array);
								foreach($results_log as $rows_log)
									{
										$Time_Stamp_Convert = date('d-m-Y',strtotime($rows_log->Time_Stamp));
										$Time_Stamp[] = $Time_Stamp_Convert;
										$sql_name = 'SELECT First_Name FROM users WHERE ID = ?';
										$Execute_Array = array($rows_log->OID);
										$Full_Name_String =  $Display->Display_Single_Info_Modified($sql_name,'First_Name',$Execute_Array);
										$Full_Name[] = $Full_Name_String;
									}
								
								$sql_country = 'SELECT Name FROM '.$Table.' WHERE ID = ?';
								$Execute_Array = array($rows->Country);
								$Country_Name_String =  $Display->Display_Single_Info_Modified($sql_country,'Name',$Execute_Array);
								$ID_Array[] = $rows->ID;
								$Users[] = $rows->user_name;
								$Country_Name[] = $Country_Name_String;
								
							}
						$this->registry->template->Time_Stamp = $Time_Stamp;
						$this->registry->template->Full_Name = $Full_Name;
						$this->registry->template->ID_Array = $ID_Array;
						$this->registry->template->Users = $Users;
						$this->registry->template->Country_Name = $Country_Name;
						$this->registry->template->show('admin_search/sales_search_log');
					}
				else
					{
						$this->registry->template->show('admin_search/no_results');
					}
				
				
			}
		public function country_search_log()
			{
				$Display = new sql();
				$CID = $_POST['CID'];
				$this->registry->template->CID = $CID;
				if($CID == '999')
					{
						$sql_total = 'SELECT ID FROM users WHERE Status = ? AND Level = ?';
						$Execute_Array = array('1','5');
						$this->registry->template->Total_Records =  $Display->Total_Records($sql_total,$Execute_Array);
						$sql = 'SELECT ID,user_name,Country FROM users WHERE Status = ? AND Level = ?';
						
					}
				else
					{
						$sql_total = 'SELECT ID FROM users WHERE Status = ? AND Country = ? AND Level = ?';
						$Execute_Array = array('1',$CID,'5');
						$this->registry->template->Total_Records =  $Display->Total_Records($sql_total,$Execute_Array);
						$sql = 'SELECT ID,user_name,Country FROM users WHERE Status = ? AND Country = ? AND Level = ?';
						
					}
				if(isset($_SESSION['Arabic']))
					{
						$Table = 'country';
					}
				else
					{
						$Table = 'country_english';
					}
				//$results = $Display->Display_Info($sql,$Execute_Array);
				$pagenum  = @$_POST['Page'];
				$paginate = new paginate('users','50',$pagenum,$sql,$Execute_Array);
				$Count = $paginate->Records('users');
				$this->registry->template->Page = $pagenum;
				$this->registry->template->Count = $Count;
				$this->registry->template->Last = $paginate->Calculate_Last($Count);
				$results = $paginate->Paginate();
				
				$Time_Stamp = array();
				$Full_Name = array();
				if(is_array($results) && count($results))
					{
						foreach($results as $rows)
							{
								$sql_log = 'SELECT Time_Stamp,OID FROM logs WHERE Table_Name = ? AND RID = ? AND Action = ?';
								$Execute_Array = array('users',$rows->ID,'1');
								$results_log = $Display->Display_Info($sql_log,$Execute_Array);
								foreach($results_log as $rows_log)
									{
										$Time_Stamp_Convert = date('d-m-Y',strtotime($rows_log->Time_Stamp));
										$Time_Stamp[] = $Time_Stamp_Convert;
										$sql_name = 'SELECT First_Name FROM users WHERE ID = ?';
										$Execute_Array = array($rows_log->OID);
										$Full_Name_String =  $Display->Display_Single_Info_Modified($sql_name,'First_Name',$Execute_Array);
										$Full_Name[] = $Full_Name_String;
									}
								
								$sql_country = 'SELECT Name FROM '.$Table.' WHERE ID = ?';
								$Execute_Array = array($rows->Country);
								$Country_Name_String =  $Display->Display_Single_Info_Modified($sql_country,'Name',$Execute_Array);
								$ID_Array[] = $rows->ID;
								$Users[] = $rows->user_name;
								$Country_Name[] = $Country_Name_String;
								
							}
						$this->registry->template->Time_Stamp = $Time_Stamp;
						$this->registry->template->Full_Name = $Full_Name;
						$this->registry->template->ID_Array = $ID_Array;
						$this->registry->template->Users = $Users;
						$this->registry->template->Country_Name = $Country_Name;
						$this->registry->template->show('admin_search/country_search_log');
					}
				else
					{
						$this->registry->template->show('admin_search/no_results');
					}
				
				
			}
		public function sales_search_log()
			{
				$Display = new sql();
				$CID = $_POST['CID'];
				$this->registry->template->CID = $CID;
				if($CID == '999')
					{
						$sql_total = 'SELECT ID FROM users WHERE Status = ? AND Level = ?';
						$Execute_Array = array('1','3');
						$this->registry->template->Total_Records =  $Display->Total_Records($sql_total,$Execute_Array);
						$sql = 'SELECT ID,user_name,Country FROM users WHERE Status = ? AND Level = ?';
						
					}
				else
					{
						$sql_total = 'SELECT ID FROM users WHERE Status = ? AND Country = ? AND Level = ?';
						$Execute_Array = array('1',$CID,'3');
						$this->registry->template->Total_Records =  $Display->Total_Records($sql_total,$Execute_Array);
						$sql = 'SELECT ID,user_name,Country FROM users WHERE Status = ? AND Country = ? AND Level = ?';
						
					}
				if(isset($_SESSION['Arabic']))
					{
						$Table = 'country';
					}
				else
					{
						$Table = 'country_english';
					}
				//$results = $Display->Display_Info($sql,$Execute_Array);
				$pagenum  = @$_POST['Page'];
				$paginate = new paginate('users','50',$pagenum,$sql,$Execute_Array);
				$Count = $paginate->Records('users');
				$this->registry->template->Page = $pagenum;
				$this->registry->template->Count = $Count;
				$this->registry->template->Last = $paginate->Calculate_Last($Count);
				$results = $paginate->Paginate();
				
				$Time_Stamp = array();
				$Full_Name = array();
				if(is_array($results) && count($results))
					{
						foreach($results as $rows)
							{
								$sql_log = 'SELECT Time_Stamp,OID FROM logs WHERE Table_Name = ? AND RID = ? AND Action = ?';
								$Execute_Array = array('users',$rows->ID,'1');
								$results_log = $Display->Display_Info($sql_log,$Execute_Array);
								foreach($results_log as $rows_log)
									{
										$Time_Stamp_Convert = date('d-m-Y',strtotime($rows_log->Time_Stamp));
										$Time_Stamp[] = $Time_Stamp_Convert;
										$sql_name = 'SELECT First_Name FROM users WHERE ID = ?';
										$Execute_Array = array($rows_log->OID);
										$Full_Name_String =  $Display->Display_Single_Info_Modified($sql_name,'First_Name',$Execute_Array);
										$Full_Name[] = $Full_Name_String;
									}
								
								$sql_country = 'SELECT Name FROM '.$Table.' WHERE ID = ?';
								$Execute_Array = array($rows->Country);
								$Country_Name_String =  $Display->Display_Single_Info_Modified($sql_country,'Name',$Execute_Array);
								$ID_Array[] = $rows->ID;
								$Users[] = $rows->user_name;
								$Country_Name[] = $Country_Name_String;
								
							}
						$this->registry->template->Time_Stamp = $Time_Stamp;
						$this->registry->template->Full_Name = $Full_Name;
						$this->registry->template->ID_Array = $ID_Array;
						$this->registry->template->Users = $Users;
						$this->registry->template->Country_Name = $Country_Name;
						$this->registry->template->show('admin_search/sales_search_log');
					}
				else
					{
						$this->registry->template->show('admin_search/no_results');
					}
				
				
			}
		public function delete_selected_mobile_user_single()
			{
				$Display = new sql();
				$ID = $_POST['ID'];
				$sql = 'UPDATE mobile_users SET Status = ? WHERE ID = ?';
				$Execute_Array = array('0',$ID);
				$Display->Execute($sql,$Execute_Array);
				$OID = $_SESSION['User_ID'];
				$Action_Time = date('Y-m-d G:i:s');
				$Display->create_log($ID,'users','3',$Action_Time,$OID,'Deleted mobile user');
				
				$this->display_specific_mobile_user_par($ID);
			}
		public function delete_selected_mobile_user()
			{
				$Display = new sql();
				$ID = $_POST['ID'];
				$Page = $_POST['Page'];
				$Country_ID = $_POST['CID'];
				$Email = $_POST['Email'];
				$Starts_Date = $_POST['Starts_Date'];
				$End_Date = $_POST['End_Date'];
				$Time_Stamp = $_POST['Time_Stamp'];
				$sql = 'UPDATE mobile_users SET Status = ? WHERE ID = ?';
				$Execute_Array = array('0',$ID);
				$Display->Execute($sql,$Execute_Array);
				$OID = $_SESSION['User_ID'];
				$Action_Time = date('Y-m-d G:i:s');
				$Display->create_log($ID,'users','3',$Action_Time,$OID,'Deleted mobile user');
				
				$this->mobile_user_search_log_par($Page,$Country_ID,$Email,$Starts_Date='',$End_Date='',$Time_Stamp);
			}
		public function serach_users()
			{
				$Display = new sql();
				$sql = 'SELECT ID,Level FROM user_level WHERE Status = ?';
				$Execute_Array = array('1');
				$this->registry->template->results = $Display->Display_Info($sql,$Execute_Array);
				$this->registry->template->show('admin_search/serach_users');
			}
		public function operator_log()
			{
				$Display = new sql();
				$Users_Array = array();
				$sql = 'SELECT COUNT(ID) AS Total FROM users WHERE Status = ? AND Level = ?';
				$Execute_Array = array('1','4');
				$this->registry->template->Total = $Display->Display_Single_Info_Modified($sql,'Total',$Execute_Array);
				
				$sql = 'SELECT ID,First_Name,user_name FROM users WHERE Status = ? AND Level = ?';
				
				//$sql = 'SELECT RID,Time_Stamp,OID FROM logs WHERE Table_Name = ? AND Action = ? AND RID = ?';
				//$Execute_Array = array('users','1');
				$pagenum  = @$_POST['Page'];
				$paginate = new paginate('users','50',$pagenum,$sql,$Execute_Array);
				$Count = $paginate->Records('users');
				$this->registry->template->Page = $pagenum;
				$this->registry->template->Count = $Count;
				$this->registry->template->Last = $paginate->Calculate_Last($Count);
				$results = $paginate->Paginate();
				if(is_array($results) && count($results))
					{
						$this->registry->template->results = $results;
						$this->registry->template->show('admin_search/operator_log');
					}
				else
					{
						$this->registry->template->show('admin_search/no_results');
					}
				
			}
		public function super_admin_log()
			{
				$Display = new sql();
				$Users_Array = array();
				$sql = 'SELECT COUNT(ID) AS Total FROM users WHERE Status = ? AND Level = ?';
				$Execute_Array = array('1','1');
				$this->registry->template->Total = $Display->Display_Single_Info_Modified($sql,'Total',$Execute_Array);
				
				$sql = 'SELECT ID,First_Name,user_name FROM users WHERE Status = ? AND Level = ?';
				
				//$sql = 'SELECT RID,Time_Stamp,OID FROM logs WHERE Table_Name = ? AND Action = ? AND RID = ?';
				//$Execute_Array = array('users','1');
				$pagenum  = @$_POST['Page'];
				$paginate = new paginate('users','50',$pagenum,$sql,$Execute_Array);
				$Count = $paginate->Records('users');
				$this->registry->template->Page = $pagenum;
				$this->registry->template->Count = $Count;
				$this->registry->template->Last = $paginate->Calculate_Last($Count);
				$results = $paginate->Paginate();
				if(is_array($results) && count($results))
					{
						$this->registry->template->results = $results;
						$this->registry->template->show('admin_search/super_admin_log');
					}
				else
					{
						$this->registry->template->show('admin_search/no_results');
					}
			}
		public function mobile_user_search_log_par($Page,$Country_ID,$ID,$Starts_Date='',$End_Date='',$Time_Stamp)
			{
				$Display = new sql();
				
				$this->registry->template->Country_ID = $Country_ID;
				$this->registry->template->ID = $ID;
				$this->registry->template->Time_Stamp = $Time_Stamp;
				$this->registry->template->Starts_Date = $Starts_Date;
				$this->registry->template->End_Date = $End_Date;
				
				if(!$Country_ID)
					{
						$myTweets = array("flag" => '1');
						$Display->Write_JSON($Time_Stamp,$myTweets);
					}
				elseif(!$ID)
					{
						$myTweets = array("flag" => '2');
						$Display->Write_JSON($Time_Stamp,$myTweets);
					}
				else
					{
						$myTweets = array("flag" => '0');
						$Display->Write_JSON($Time_Stamp,$myTweets);
						if(($Starts_Date == '000000') || ($Starts_Date == '1970-01-01') || ($Starts_Date == NULL))
							{
								
								if(($Country_ID == '999')&&($ID == '999'))
									{
										$sql = 'SELECT COUNT(ID) AS Total FROM mobile_users WHERE Status = ?';
										$Execute_Array = array('1');
										$sql_paginate = 'SELECT ID,Email,Country_ID,Time_Stamp FROM mobile_users WHERE Status = ?';
										$Execute_Array_Paginate = array('1');
										
									}
								elseif(($Country_ID == '999')&&($ID != '999'))
									{
										
										$sql = 'SELECT COUNT(ID) AS Total FROM mobile_users WHERE Status = ? ID = ?';
										$Execute_Array = array('1',$ID);
										$sql_paginate = 'SELECT ID,Email,Country_ID,Time_Stamp FROM mobile_users WHERE Status = ? AND ID = ?';
										$Execute_Array_Paginate = array('1',$ID);
									}
								elseif(($Country_ID != '999')&&($ID == '999'))
									{
										$sql = 'SELECT COUNT(ID) AS Total FROM mobile_users WHERE Status = ? AND Country_ID = ?';
										$Execute_Array = array('1',$Country_ID);
										$sql_paginate = 'SELECT ID,Email,Country_ID,Time_Stamp FROM mobile_users WHERE Status = ? AND Country_ID = ? ';
										$Execute_Array_Paginate = array('1',$Country_ID);
									}
								else
									{
										$sql = 'SELECT COUNT(ID) AS Total FROM mobile_users WHERE Status = ? AND Country_ID = ? AND ID = ?';
										$Execute_Array = array('1',$Country_ID,$ID);
										$sql_paginate = 'SELECT ID,Email,Country_ID,Time_Stamp FROM mobile_users WHERE Status = ? AND Country_ID = ? AND ID = ?';
										$Execute_Array_Paginate = array('1',$Country_ID,$ID);
									}
							}
						else
							{
								$Starts_Date = date('Y-m-d G:i:s',strtotime($Starts_Date));
								$End_Date = date('Y-m-d G:i:s',strtotime($End_Date));
								
								$this->registry->template->Starts_Date = $Starts_Date;
								$this->registry->template->End_Date = $End_Date;
								if(($Country_ID == '999')&&($ID == '999'))
									{
										$sql = 'SELECT COUNT(ID) AS Total FROM mobile_users WHERE Status = ? AND (Time_Stamp BETWEEN ? AND ? )';
										$Execute_Array = array('1',$Starts_Date,$End_Date);
										$sql_paginate = 'SELECT ID,Email,Country_ID,Time_Stamp FROM mobile_users WHERE Status = ? AND (Time_Stamp BETWEEN ? AND ? )';
										$Execute_Array_Paginate = array('1',$Starts_Date,$End_Date);
									}
								elseif(($Country_ID == '999')&&($ID != '999'))
									{
										$sql = 'SELECT COUNT(ID) AS Total FROM mobile_users WHERE Status = ? AND ID = ? AND (Time_Stamp BETWEEN ? AND ? )';
										$Execute_Array = array('1',$ID,$Starts_Date,$End_Date);
										$sql_paginate = 'SELECT ID,Email,Country_ID,Time_Stamp FROM mobile_users WHERE Status = ? AND ID = ? AND (Time_Stamp BETWEEN ? AND ? )';
										$Execute_Array_Paginate = array('1',$ID,$Starts_Date,$End_Date);
									}
								elseif(($Country_ID != '999')&&($ID == '999'))
									{
										$sql = 'SELECT COUNT(ID) AS Total FROM mobile_users WHERE Status = ? AND Country_ID = ? AND (Time_Stamp BETWEEN ? AND ? )';
										$Execute_Array = array('1',$Country_ID,$Starts_Date,$End_Date);
										$sql_paginate = 'SELECT ID,Email,Country_ID,Time_Stamp FROM mobile_users WHERE Status = ? AND Country_ID = ? AND (Time_Stamp BETWEEN ? AND ? )';
										$Execute_Array_Paginate = array('1',$Country_ID,$Starts_Date,$End_Date);
									}
								else
									{
										$sql = 'SELECT COUNT(ID) AS Total FROM mobile_users WHERE Status = ? AND Country_ID = ? AND ID = ? AND (Time_Stamp BETWEEN ? AND ? )';
										$Execute_Array = array('1',$Country_ID,$ID,$Starts_Date,$End_Date);
										$sql_paginate = 'SELECT ID,Email,Country_ID,Time_Stamp FROM mobile_users WHERE Status = ? AND Country_ID = ? AND ID = ? AND (Time_Stamp BETWEEN ? AND ? )';
										$Execute_Array_Paginate = array('1',$Country_ID,$ID,$Starts_Date,$End_Date);
									}
							}
								if(($Country_ID == '999')&&($ID != '999'))
									{
										$this->registry->template->Total = '1';
									}
								else
									{
										$this->registry->template->Total = $Display->Display_Single_Info_Modified($sql,'Total',$Execute_Array);
									}
								$pagenum  = $Page;
								$paginate = new paginate('mobile_users','50',$pagenum,$sql_paginate,$Execute_Array_Paginate);
								$Count = $paginate->Records('mobile_users');
								$this->registry->template->Page = $pagenum;
								$this->registry->template->Count = $Count;
								$this->registry->template->Last = $paginate->Calculate_Last($Count);
								$results = $paginate->Paginate();
								if(is_array($results) && count($results))
									{
										if(isset($_SESSION['Arabic']))
											{
												$this->registry->template->Table = 'country';
											}
										else
											{
												$this->registry->template->Table = 'country_english';
											}
										$this->registry->template->results = $results;
										$this->registry->template->show('admin_search/mobile_user_search_log');
									}
								else
									{
										$this->registry->template->show('admin_search/no_results');
									}
								
					}
				
			}
		public function display_specific_mobile_user_par($ID)
			{
				$Display = new sql();
				$this->registry->template->ID = $ID;
				if(isset($_SESSION['Arabic']))
					{
						$Table = 'country';
					}
				else
					{
						$Table = 'country_english';
					}
				$sql = 'SELECT Email,Country_ID,Time_Stamp FROM mobile_users WHERE ID = ?';
				$Execute_Array = array($ID);
				$results = $Display->Display_Info($sql,$Execute_Array);
				foreach($results as $rows)
					{
						$sql_country = 'SELECT Name FROM '.$Table.' WHERE ID = ?';
						$Execute_Array = array($rows->Country_ID);
						$Country_Name = $Display->Display_Single_Info_Modified($sql_country,'Name',$Execute_Array);
						
						$MyData['Email'] = $rows->Email;
						$MyData['Country_Name'] = $Country_Name;
						$MyData['Time_Stamp'] = $rows->Time_Stamp;
					}
				if(is_array($results) && count($results))
					{
						$this->registry->template->MyData = $MyData;
						$this->registry->template->show('admin_search/display_specific_mobile_user');
					}
				else
					{
						$this->registry->template->show('admin_search/no_results');
					}
				
			}
		public function display_specific_mobile_user()
			{
				$Display = new sql();
				$ID = $_POST['Email'];
				$this->registry->template->ID = $ID;
				if(isset($_SESSION['Arabic']))
					{
						$Table = 'country';
					}
				else
					{
						$Table = 'country_english';
					}
				$sql = 'SELECT Email,Country_ID,Time_Stamp FROM mobile_users WHERE ID = ?';
				$Execute_Array = array($ID);
				$results = $Display->Display_Info($sql,$Execute_Array);
				foreach($results as $rows)
					{
						$sql_country = 'SELECT Name FROM '.$Table.' WHERE ID = ?';
						$Execute_Array = array($rows->Country_ID);
						$Country_Name = $Display->Display_Single_Info_Modified($sql_country,'Name',$Execute_Array);
						
						$MyData['Email'] = $rows->Email;
						$MyData['Country_Name'] = $Country_Name;
						$MyData['Time_Stamp'] = $rows->Time_Stamp;
					}
				if(is_array($results) && count($results))
					{
						$this->registry->template->MyData = $MyData;
						$this->registry->template->show('admin_search/display_specific_mobile_user');
					}
				else
					{
						$this->registry->template->show('admin_search/no_results');
					}
				
			}
		public function mobile_user_search_log()
			{
				$Display = new sql();
				$Country_ID = $_POST['CID'];
				$ID = $_POST['Email'];
				$Starts_Date = @$_POST['Starts_Date'];
				$End_Date = @$_POST['End_Date'];
				$Time_Stamp = $_POST['Time_Stamp'];
				$this->registry->template->Country_ID = $Country_ID;
				$this->registry->template->ID = $ID;
				$this->registry->template->Time_Stamp = $Time_Stamp;
				$this->registry->template->Starts_Date = $Starts_Date;
				$this->registry->template->End_Date = $End_Date;
				
				if(!$Country_ID)
					{
						$myTweets = array("flag" => '1');
						$Display->Write_JSON($Time_Stamp,$myTweets);
					}
				elseif(!$ID)
					{
						$myTweets = array("flag" => '2');
						$Display->Write_JSON($Time_Stamp,$myTweets);
					}
				else
					{
						if(isset($_SESSION['Arabic']))
							{
								$Table = 'country';
								$this->registry->template->Table = $Table;
							}
						else
							{
								$Table = 'country_english';
								$this->registry->template->Table = $Table;
							}
						$myTweets = array("flag" => '0');
						$Display->Write_JSON($Time_Stamp,$myTweets);
						if(($Starts_Date == '000000') || ($Starts_Date == '1970-01-01') || ($Starts_Date == NULL))
							{
								
								if(($Country_ID == '999')&&($ID == '999'))
									{
										$sql = 'SELECT COUNT(ID) AS Total FROM mobile_users WHERE Status = ?';
										$Execute_Array = array('1');
										$sql_paginate = 'SELECT ID,Email,Country_ID,Time_Stamp FROM mobile_users WHERE Status = ? ORDER BY Time_Stamp DESC';
										$Execute_Array_Paginate = array('1');
										
									}
								elseif(($Country_ID == '999')&&($ID != '999'))
									{
										
										$sql = 'SELECT COUNT(ID) AS Total FROM mobile_users WHERE Status = ? ID = ?';
										$Execute_Array = array('1',$ID);
										$sql_paginate = 'SELECT ID,Email,Country_ID,Time_Stamp FROM mobile_users WHERE Status = ? AND ID = ?';
										$Execute_Array_Paginate = array('1',$ID);
									}
								elseif(($Country_ID != '999')&&($ID == '999'))
									{
										$sql = 'SELECT COUNT(ID) AS Total FROM mobile_users WHERE Status = ? AND Country_ID = ?';
										$Execute_Array = array('1',$Country_ID);
										$sql_paginate = 'SELECT ID,Email,Country_ID,Time_Stamp FROM mobile_users WHERE Status = ? AND Country_ID = ? ORDER BY Time_Stamp DESC';
										$Execute_Array_Paginate = array('1',$Country_ID);
									}
								else
									{
										$sql = 'SELECT COUNT(ID) AS Total FROM mobile_users WHERE Status = ? AND Country_ID = ? AND ID = ?';
										$Execute_Array = array('1',$Country_ID,$ID);
										$sql_paginate = 'SELECT ID,Email,Country_ID,Time_Stamp FROM mobile_users WHERE Status = ? AND Country_ID = ? AND ID = ?';
										$Execute_Array_Paginate = array('1',$Country_ID,$ID);
									}
							}
						else
							{
								$Starts_Date = date('Y-m-d G:i:s',strtotime($Starts_Date));
								$End_Date = date('Y-m-d G:i:s',strtotime($End_Date));
								
								$this->registry->template->Starts_Date = $Starts_Date;
								$this->registry->template->End_Date = $End_Date;
								if(($Country_ID == '999')&&($ID == '999'))
									{
										$sql = 'SELECT COUNT(ID) AS Total FROM mobile_users WHERE Status = ? AND (Time_Stamp BETWEEN ? AND ? )';
										$Execute_Array = array('1',$Starts_Date,$End_Date);
										$sql_paginate = 'SELECT ID,Email,Country_ID,Time_Stamp FROM mobile_users WHERE Status = ? AND (Time_Stamp BETWEEN ? AND ? ) ORDER BY Time_Stamp DESC';
										$Execute_Array_Paginate = array('1',$Starts_Date,$End_Date);
									}
								elseif(($Country_ID == '999')&&($ID != '999'))
									{
										$sql = 'SELECT COUNT(ID) AS Total FROM mobile_users WHERE Status = ? AND ID = ? AND (Time_Stamp BETWEEN ? AND ? )';
										$Execute_Array = array('1',$ID,$Starts_Date,$End_Date);
										$sql_paginate = 'SELECT ID,Email,Country_ID,Time_Stamp FROM mobile_users WHERE Status = ? AND ID = ? AND (Time_Stamp BETWEEN ? AND ? )';
										$Execute_Array_Paginate = array('1',$ID,$Starts_Date,$End_Date);
									}
								elseif(($Country_ID != '999')&&($ID == '999'))
									{
										$sql = 'SELECT COUNT(ID) AS Total FROM mobile_users WHERE Status = ? AND Country_ID = ? AND (Time_Stamp BETWEEN ? AND ? )';
										$Execute_Array = array('1',$Country_ID,$Starts_Date,$End_Date);
										$sql_paginate = 'SELECT ID,Email,Country_ID,Time_Stamp FROM mobile_users WHERE Status = ? AND Country_ID = ? AND (Time_Stamp BETWEEN ? AND ? ) ORDER BY Time_Stamp DESC';
										$Execute_Array_Paginate = array('1',$Country_ID,$Starts_Date,$End_Date);
									}
								else
									{
										$sql = 'SELECT COUNT(ID) AS Total FROM mobile_users WHERE Status = ? AND Country_ID = ? AND ID = ? AND (Time_Stamp BETWEEN ? AND ? )';
										$Execute_Array = array('1',$Country_ID,$ID,$Starts_Date,$End_Date);
										$sql_paginate = 'SELECT ID,Email,Country_ID,Time_Stamp FROM mobile_users WHERE Status = ? AND Country_ID = ? AND ID = ? AND (Time_Stamp BETWEEN ? AND ? ) ORDER BY Time_Stamp DESC';
										$Execute_Array_Paginate = array('1',$Country_ID,$ID,$Starts_Date,$End_Date);
									}
							}
								if(($Country_ID == '999')&&($ID != '999'))
									{
										$this->registry->template->Total = '1';
									}
								else
									{
										$this->registry->template->Total = $Display->Display_Single_Info_Modified($sql,'Total',$Execute_Array);
									}
								$_SESSION['Mobile_Users_Email'] = array();
								$_SESSION['Mobile_Users_Country'] = array();
								$results = $Display->Display_Info($sql_paginate,$Execute_Array_Paginate);
								foreach($results as $rows)
									{
										$sql_country = 'SELECT Name FROM '.$Table.' WHERE ID = ?';
										$Execute_Array = array($rows->Country_ID);
										$Country_Name = $Display->Display_Single_Info_Modified($sql_country,'Name',$Execute_Array);
										$_SESSION['Mobile_Users_Email'][] = $rows->Email;
					  					$_SESSION['Mobile_Users_Country'][] = $Country_Name;
									}
								$pagenum  = @$_POST['Page'];
								$paginate = new paginate('mobile_users','50',$pagenum,$sql_paginate,$Execute_Array_Paginate);
								$Count = $paginate->Records('mobile_users');
								$this->registry->template->Page = $pagenum;
								$this->registry->template->Count = $Count;
								$this->registry->template->Last = $paginate->Calculate_Last($Count);
								$results = $paginate->Paginate();
								if(is_array($results) && count($results))
									{
										
										$this->registry->template->results = $results;
										$this->registry->template->show('admin_search/mobile_user_search_log');
									}
								else
									{
										$this->registry->template->show('admin_search/no_results');
									}
								
					}
				
			}
		public function merchant_log()
			{
				$Display = new sql();
				$Country_ID = $_POST['CID'];
				$Company_ID = $_POST['Company_ID'];
				$Starts_Date = @$_POST['Starts_Date'];
				$End_Date = @$_POST['End_Date'];
				$Time_Stamp = $_POST['Time_Stamp'];
				$this->registry->template->Country_ID = $Country_ID;
				$this->registry->template->Company_ID = $Company_ID;
				$this->registry->template->Time_Stamp = $Time_Stamp;
				$this->registry->template->Starts_Date = $Starts_Date;
				$this->registry->template->End_Date = $End_Date;
				if(!$Country_ID)
					{
						$myTweets = array("flag" => '1');
						$Display->Write_JSON($Time_Stamp,$myTweets);
					}
				elseif(!$Company_ID)
					{
						$myTweets = array("flag" => '2');
						$Display->Write_JSON($Time_Stamp,$myTweets);
					}
				else
					{
						if(isset($_SESSION['Arabic']))
							{
								$Table_Country = 'country';
							}
						else
							{
								$Table_Country = 'country_english';
							}
						$myTweets = array("flag" => '0');
						$Display->Write_JSON($Time_Stamp,$myTweets);
						if(($Starts_Date == NULL) || ($End_Date == NULL))
							{
								if(($Country_ID == '999')&&($Company_ID == '999'))
									{
										$sql = 'SELECT COUNT(ID) AS Total FROM users WHERE Status = ? AND Level = ?';
										$Execute_Array = array('1','2');
										$sql_paginate = 'SELECT ID,First_Name,Company_Name,Phone_Number,Cell_Phone,Contact_Email,Country FROM users WHERE Status = ? AND Level = ? ORDER BY ID DESC';
										$Execute_Array_Paginate = array('1','2');
										
									}
								elseif(($Country_ID == '999')&&($Company_ID != '999'))
									{
										$sql = 'SELECT COUNT(ID) AS Total FROM users WHERE Status = ? AND Level = ? AND Company_Name = ?';
										$Execute_Array = array('1','2',$Company_ID);
										$sql_paginate = 'SELECT ID,First_Name,Company_Name,Phone_Number,Cell_Phone,Contact_Email,Country FROM users WHERE Status = ? AND Level = ? AND Company_Name = ? ORDER BY ID DESC';
										$Execute_Array_Paginate = array('1','2',$Company_ID);
										
									}
								elseif(($Country_ID != '999')&&($Company_ID == '999'))
									{
										$sql = 'SELECT COUNT(ID) AS Total FROM users WHERE Status = ? AND Level = ? AND Country = ?';
										$Execute_Array = array('1','2',$Country_ID);
										$sql_paginate = 'SELECT ID,First_Name,Company_Name,Phone_Number,Cell_Phone,Contact_Email,Country FROM users WHERE Status = ? AND Level = ? AND Country = ? ORDER BY ID DESC';
										$Execute_Array_Paginate = array('1','2',$Country_ID);
									}
								else
									{
										$sql = 'SELECT COUNT(ID) AS Total FROM users WHERE Status = ? AND Level = ? AND Country = ? AND Company_Name = ?';
										$Execute_Array = array('1','2',$Country_ID,$Company_ID);
										$sql_paginate = 'SELECT ID,First_Name,Company_Name,Phone_Number,Cell_Phone,Contact_Email,Country FROM users WHERE Status = ? AND Level = ? AND Country = ? AND Company_Name = ? ORDER BY ID DESC';
										$Execute_Array_Paginate = array('1','2',$Country_ID,$Company_ID);
									}
							}
						else
							{
								$Starts_Date = date('Y-m-d',strtotime($Starts_Date));
								$End_Date = date('Y-m-d',strtotime($End_Date));
								$this->registry->template->Starts_Date = $Starts_Date;
								$this->registry->template->End_Date = $End_Date;
								if(($Country_ID == '999')&&($Company_ID == '999'))
									{
										$sql = 'SELECT COUNT(ID) AS Total FROM users WHERE Status = ? AND Level = ? AND (Starts_Date <= ? AND End_Date >= ?)';
										$Execute_Array = array('1','2',$Starts_Date,$End_Date);
										$sql_paginate = 'SELECT ID,First_Name,Company_Name,Phone_Number,Cell_Phone,Contact_Email,Country FROM users WHERE Status = ? AND Level = ? AND (Starts_Date <= ? AND End_Date >= ?) ORDER BY ID DESC';
										$Execute_Array_Paginate = array('1','2',$Starts_Date,$End_Date);
										
									}
								elseif(($Country_ID == '999')&&($Company_ID != '999'))
									{
										$sql = 'SELECT COUNT(ID) AS Total FROM users WHERE Status = ? AND Level = ? AND Company_Name = ? AND (Starts_Date <= ? AND End_Date >= ?)';
										$Execute_Array = array('1','2',$Company_ID,$Starts_Date,$End_Date);
										$sql_paginate = 'SELECT ID,First_Name,Company_Name,Phone_Number,Cell_Phone,Contact_Email,Country FROM users WHERE Status = ? AND Level = ? AND Company_Name = ? AND (Starts_Date <= ? AND End_Date >= ?) ORDER BY ID DESC';
										$Execute_Array_Paginate = array('1','2',$Company_ID,$Starts_Date,$End_Date);
									}
								elseif(($Country_ID != '999')&&($Company_ID == '999'))
									{
										$sql = 'SELECT COUNT(ID) AS Total FROM users WHERE Status = ? AND Level = ? AND Country = ? AND (Starts_Date <= ? AND End_Date >= ?)';
										$Execute_Array = array('1','2',$Country_ID,$Starts_Date,$End_Date);
										$sql_paginate = 'SELECT ID,First_Name,Company_Name,Phone_Number,Cell_Phone,Contact_Email,Country FROM users WHERE Status = ? AND Level = ? AND Country = ? AND (Starts_Date <= ? AND End_Date >= ?) ORDER BY ID DESC';
										$Execute_Array_Paginate = array('1','2',$Country_ID,$Starts_Date,$End_Date);
									}
								else
									{
										$sql = 'SELECT COUNT(ID) AS Total FROM users WHERE Status = ? AND Level = ? AND Country = ? AND Company_Name = ? AND (Starts_Date <= ? AND End_Date >= ?)';
										$Execute_Array = array('1','2',$Country_ID,$Company_ID,$Starts_Date,$End_Date);
										$sql_paginate = 'SELECT ID,First_Name,Company_Name,Phone_Number,Cell_Phone,Contact_Email,Country FROM users WHERE Status = ? AND Level = ? AND Country = ? AND Company_Name = ? AND (Starts_Date <= ? AND End_Date >= ?) ORDER BY ID DESC';
										$Execute_Array_Paginate = array('1','2',$Country_ID,$Company_ID,$Starts_Date,$End_Date);
									}
							}
								$this->registry->template->Total = $Display->Display_Single_Info_Modified($sql,'Total',$Execute_Array);
								$_SESSION['Merchant_Name'] = array();
								$_SESSION['Merchant_Country_Name'] = array();
								$_SESSION['Merchant_Company_Name'] = array();
								$_SESSION['Merchant_Phone_Number'] = array();
								$_SESSION['Merchant_Cell_Number'] = array();
								$_SESSION['Merchant_Contact_Email'] = array();
								$results = $Display->Display_Info($sql_paginate,$Execute_Array_Paginate);
								foreach($results as $rows)
									{
										$sql = 'SELECT Name FROM '.$Table_Country.' WHERE ID = ?';
										$Execute_Array = array($rows->Country);
										$Country_Name = $Display->Display_Single_Info_Modified($sql,'Name',$Execute_Array);
										$_SESSION['Merchant_Name'][] = $rows->First_Name;
										$_SESSION['Merchant_Country_Name'][] = $Country_Name;
										$_SESSION['Merchant_Company_Name'][] = $rows->Company_Name;
										$_SESSION['Merchant_Phone_Number'][] = $rows->Phone_Number;
										$_SESSION['Merchant_Cell_Number'][] = $rows->Cell_Phone;
										$_SESSION['Merchant_Contact_Email'][] = $rows->Contact_Email;
									}
								
								$pagenum  = @$_POST['Page'];
								$paginate = new paginate('users','50',$pagenum,$sql_paginate,$Execute_Array_Paginate);
								$Count = $paginate->Records('users');
								$this->registry->template->Page = $pagenum;
								$this->registry->template->Count = $Count;
								$this->registry->template->Last = $paginate->Calculate_Last($Count);
								$results = $paginate->Paginate();
								if(is_array($results) && count($results))
									{
										$this->registry->template->results = $results;
										$this->registry->template->show('admin_search/merchant_log');
									}
								else
									{
										$this->registry->template->show('admin_search/no_results');
									}
								
					}
				
			}
		public function merchant_log_Par($Country_ID,$Company_ID,$Time_Stamp,$Page,$Starts_Date='',$End_Date='')
			{
				$Display = new sql();
				if(!$Country_ID)
					{
						$myTweets = array("flag" => '1');
						$Display->Write_JSON($Time_Stamp,$myTweets);
					}
				elseif(!$Company_ID)
					{
						$myTweets = array("flag" => '2');
						$Display->Write_JSON($Time_Stamp,$myTweets);
					}
				else
					{
						$myTweets = array("flag" => '0');
						$Display->Write_JSON($Time_Stamp,$myTweets);
						if($Starts_Date == NULL)
							{
								if(($Country_ID == '999')&&($Company_ID == '999'))
									{
										$sql = 'SELECT COUNT(ID) AS Total FROM users WHERE Status = ? AND Level = ?';
										$Execute_Array = array('1','2');
										$sql_paginate = 'SELECT ID,Company_Name,Country FROM users WHERE Status = ? AND Level = ?';
										$Execute_Array_Paginate = array('1','2');
									}
								elseif(($Country_ID == '999')&&($Company_ID != '999'))
									{
										$sql = 'SELECT COUNT(ID) AS Total FROM users WHERE Status = ? AND Level = ? AND Company_Name = ?';
										$Execute_Array = array('1','2',$Company_ID);
										$sql_paginate = 'SELECT ID,Company_Name,Country FROM users WHERE Status = ? AND Level = ? AND Company_Name = ?';
										$Execute_Array_Paginate = array('1','2',$Company_ID);
										
									}
								elseif(($Country_ID != '999')&&($Company_ID == '999'))
									{
										$sql = 'SELECT COUNT(ID) AS Total FROM users WHERE Status = ? AND Level = ? AND Country = ?';
										$Execute_Array = array('1','2',$Country_ID);
										$sql_paginate = 'SELECT ID,Company_Name,Country FROM users WHERE Status = ? AND Level = ? AND Country = ? ';
										$Execute_Array_Paginate = array('1','2',$Country_ID);
									}
								else
									{
										$sql = 'SELECT COUNT(ID) AS Total FROM users WHERE Status = ? AND Level = ? AND Country = ? AND Company_ID = ?';
										$Execute_Array = array('1','2',$Country_ID,$Company_ID);
										$sql_paginate = 'SELECT ID,Company_Name,Country FROM users WHERE Status = ? AND Level = ? AND Country = ? AND Company_ID = ?';
										$Execute_Array_Paginate = array('1','2',$Country_ID,$Company_ID);
									}
							}
						else
							{
								if(($Country_ID == '999')&&($Company_ID == '999'))
									{
										$sql = 'SELECT COUNT(ID) AS Total FROM users WHERE Status = ? AND Level = ? AND (Starts_Date >= ? AND End_Date <= ?)';
										$Execute_Array = array('1','2',$Starts_Date,$End_Date);
										$sql_paginate = 'SELECT ID,Company_Name,Country FROM users WHERE Status = ? AND Level = ? AND (Starts_Date >= ? AND End_Date <= ?)';
										$Execute_Array_Paginate = array('1','2',$Starts_Date,$End_Date);
										$sql_paginate_2 = 'SELECT ID,Company_Name,Country FROM users WHERE Status = "1" AND Level = "2" AND (Starts_Date <= '.$Starts_Date.' AND End_Date >= '.$End_Date.')';
										$sql_test = 'INSERT INTO test (Par) VALUES (?)';
										$X = array($sql_paginate_2);
										$Display->Execute($sql_test,$X);
									}
								elseif(($Country_ID == '999')&&($Company_ID != '999'))
									{
										$sql = 'SELECT COUNT(ID) AS Total FROM users WHERE Status = ? AND Level = ? AND Company_ID = ? AND (Starts_Date >= ? AND End_Date <= ?)';
										$Execute_Array = array('1','2',$Company_ID,$Starts_Date,$End_Date);
										$sql_paginate = 'SELECT ID,Company_Name,Country FROM users WHERE Status = ? AND Level = ? AND Company_ID = ? AND (Starts_Date >= ? AND End_Date <= ?)';
										$Execute_Array_Paginate = array('1','2',$Company_ID,$Starts_Date,$End_Date);
									}
								elseif(($Country_ID != '999')&&($Company_ID == '999'))
									{
										$sql = 'SELECT COUNT(ID) AS Total FROM users WHERE Status = ? AND Level = ? AND Country = ? AND (Starts_Date >= ? AND End_Date <= ?)';
										$Execute_Array = array('1','2',$Country_ID,$Starts_Date,$End_Date);
										$sql_paginate = 'SELECT ID,Company_Name,Country FROM users WHERE Status = ? AND Level = ? AND Country = ? AND (Starts_Date >= ? AND End_Date <= ?)';
										$Execute_Array_Paginate = array('1','2',$Country_ID,$Starts_Date,$End_Date);
									}
								else
									{
										$sql = 'SELECT COUNT(ID) AS Total FROM users WHERE Status = ? AND Level = ? AND Country = ? AND Company_ID = ? AND (Starts_Date >= ? AND End_Date <= ?)';
										$Execute_Array = array('1','2',$Country_ID,$Company_ID,$Starts_Date,$End_Date);
										$sql_paginate = 'SELECT ID,Company_Name,Country FROM users WHERE Status = ? AND Level = ? AND Country = ? AND Company_ID = ? AND (Starts_Date >= ? AND End_Date <= ?)';
										$Execute_Array_Paginate = array('1','2',$Country_ID,$Company_ID,$Starts_Date,$End_Date);
									}
							}
								$this->registry->template->Total = $Display->Display_Single_Info_Modified($sql,'Total',$Execute_Array);
								$pagenum  = @$_POST['Page'];
								$paginate = new paginate('users','50',$pagenum,$sql_paginate,$Execute_Array_Paginate);
								$Count = $paginate->Records('users');
								$this->registry->template->Page = $pagenum;
								$this->registry->template->Count = $Count;
								$this->registry->template->Last = $paginate->Calculate_Last($Count);
								$results = $paginate->Paginate();
								if(is_array($results) && count($results))
									{
										$this->registry->template->results = $results;
										$this->registry->template->show('admin_search/merchant_log');
									}
								else
									{
										$this->registry->template->show('admin_search/no_results');
									}
								
					}
				
			}
		public function delete_selected_member_merchant()
			{
				$Display = new sql();
				$URL = new url();
				$OID = $_SESSION['User_ID'];
				$ID = $_POST['ID'];
				$sql = 'UPDATE users SET Status = ? WHERE ID = ?';
				$Execute_Array = array('0',$ID);
				$Display->Execute($sql,$Execute_Array);
				
				$sql = 'SELECT ID From offers_english WHERE AID = ? AND Status = ?';
				$Execute_Array = array($ID,'1');
				$results = $Display->Display_Info($sql,$Execute_Array);
				foreach($results as $rows)
					{
						$sql_del = 'DELETE FROM city_offers_english WHERE OID = ?';
						$Execute_Array = array($rows->ID);
						$Display->Execute($sql_del,$Execute_Array);
						
						$sql_cop = 'DELETE FROM coupons WHERE MSG_ID = ?';
						$Display->Execute($sql_cop,$Execute_Array);
					}
					
				$sql = 'DELETE FROM offers_english WHERE AID = ?';
				$Execute_Array = array($ID);
				$Display->Execute($sql,$Execute_Array);
						
				$sql = 'DELETE FROM merchant_services_english WHERE MID = ?';
				$Execute_Array = array($ID);
				$Display->Execute($sql,$Execute_Array);
				
				$Action_Time = date('Y-m-d G:i:s');
				$Display->create_log($ID,'users','3',$Action_Time,$OID,'Deleted user');
				
				$Country_ID = $URL->getPar('Country_ID');
				$Company_ID = $URL->getPar('Company_ID');
				$Starts_Date = $URL->getPar('Starts_Date');
				$End_Date = $URL->getPar('End_Date');
				$Time_Stamp = $URL->getPar('Time_Stamp');
				$Page = $URL->getPar('Page');
				
				if($Starts_Date == 'None')
					{
						$this->merchant_log_Par($Country_ID,$Company_ID,$Time_Stamp,$Page);
					}
				else
					{
						$this->merchant_log_Par($Country_ID,$Company_ID,$Time_Stamp,$Page,$Starts_Date='',$End_Date='');
					}
				
			}
		public function delete_selected_member()
			{
				$Display = new sql();
				$OID = $_SESSION['User_ID'];
				$ID = $_POST['ID'];
				$sql = 'UPDATE users SET Status = ? WHERE ID = ?';
				$Execute_Array = array('0',$ID);
				$Display->Execute($sql,$Execute_Array);
				
				$Action_Time = date('Y-m-d G:i:s');
				$Display->create_log($ID,'users','3',$Action_Time,$OID,'Deleted user');
				$this->display_search_results_par('1');
			}
		public function display_countries()
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
				$sql = 'SELECT DISTINCT(Country_ID) FROM mobile_users WHERE Status = ?';
				$Execute_Array = array('1');
				$results_country = $Display->Display_Info($sql,$Execute_Array);
				foreach($results_country as $rows)
					{
						$sql_country = 'SELECT Name FROM '.$Table.' WHERE ID = ?';
						$Execute_Array = array($rows->Country_ID);
						$Country_Name = $Display->Display_Single_Info_Modified($sql_country,'Name',$Execute_Array);
						$MyData[$rows->Country_ID] = $Country_Name;
					}
				$this->registry->template->MyData = $MyData;
				$this->registry->template->show('admin_search/display_countries');
			}
		public function display_companies()
			{
				$Display = new sql();
				$CID = $_POST['CID'];
				if($CID == '999')
					{
						$sql = 'SELECT ID,Company_Name FROM users WHERE Status = ?';
						$Execute_Array = array('1');
					}
				else
					{
						$sql = 'SELECT ID,Company_Name FROM users WHERE Country = ? AND Status = ?';
						$Execute_Array = array($CID,'1');
					}
				$this->registry->template->results_company = $Display->Display_Info($sql,$Execute_Array);
				$this->registry->template->show('admin_search/display_companies');
			}
		public function country_log()
			{
				$Display = new sql();
				if(isset($_SESSION['Arabic']))
					{
						$Table_Country = 'country';
					}
				else
					{
						$Table_Country = 'country_english';
					}
				$sql = 'SELECT ID,Name FROM '.$Table_Country.' WHERE Status = ?';
				$Execute_Array = array('1');
				$this->registry->template->results_country = $Display->Display_Info($sql,$Execute_Array);
				$this->registry->template->show('admin_search/country_log');
			}
		public function sales_form()
			{
				$Display = new sql();
				if(isset($_SESSION['Arabic']))
					{
						$Table_Country = 'country';
					}
				else
					{
						$Table_Country = 'country_english';
					}
				$sql = 'SELECT ID,Name FROM '.$Table_Country.' WHERE Status = ?';
				$Execute_Array = array('1');
				$this->registry->template->results_country = $Display->Display_Info($sql,$Execute_Array);
				$this->registry->template->show('admin_search/sales_form');
			}
		public function merchant_log_form()
			{
				$Display = new sql();
				if(isset($_SESSION['Arabic']))
					{
						$Table_Country = 'country';
					}
				else
					{
						$Table_Country = 'country_english';
					}
				$sql = 'SELECT ID,Name FROM '.$Table_Country.' WHERE Status = ?';
				$Execute_Array = array('1');
				$this->registry->template->results_country = $Display->Display_Info($sql,$Execute_Array);
				$this->registry->template->show('admin_search/merchant_log_form');
			}
		public function mobile_log_form()
			{
				$Display = new sql();
				$sql = 'SELECT ID,Email FROM mobile_users WHERE Status = ?';
				$Execute_Array = array('1');
				$this->registry->template->mobile_users = $Display->Display_Info($sql,$Execute_Array);
				
				$this->registry->template->show('admin_search/mobile_log_form');
			}
		public function display_search_results_par($Level)
			{
				switch($Level)
					{
						case '1':
						$this->super_admin_log();
						break;
						
						case '2':
						$this->merchant_log_form();
						break;
						
						case '3':
						$this->sales_form();
						break;
						
						case '4':
						$this->operator_log();
						break;
						
						case '5':
						$this->country_log();
						break;
						
						case '6':
						$this->mobile_log_form();
						break;
					}
				
			}
		public function display_search_results()
			{
				$URL = new url();
				$Level = @$_POST['Level'];
				if($Level == NULL)
					{
						$Level = $URL->getPar('Level');
					}
				switch($Level)
					{
						case '1':
						$this->super_admin_log();
						break;
						
						case '2':
						$this->merchant_log_form();
						break;
						
						case '3':
						$this->sales_form();
						break;
						
						case '4':
						$this->operator_log();
						break;
						
						case '5':
						$this->country_log();
						break;
						
						case '6':
						$this->mobile_log_form();
						break;
					}
				
			}
}

?>
