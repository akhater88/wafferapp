 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
$Allowed_Users = array('1');
validate_roles_new::validate($Allowed_Users);
class admin_searchController extends baseController {
			
		public function index() 
			{
				
			}
		public function serach_users()
			{
				$Display = new sql();
				$sql = 'SELECT ID,Level FROM user_level WHERE Status = ?';
				$Execute_Array = array('1');
				$this->registry->template->results = $Display->Display_Info($sql,$Execute_Array);
				$this->registry->template->show('admin_search/serach_users');
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
				$paginate = new paginate('users','20',$pagenum,$sql,$Execute_Array);
				$Count = $paginate->Records('users');
				$this->registry->template->Page = $pagenum;
				$this->registry->template->Count = $Count;
				$this->registry->template->Last = $paginate->Calculate_Last($Count);
				$results = $paginate->Paginate();
				$this->registry->template->results = $results;
				$this->registry->template->show('admin_search/super_admin_log');
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
						if(!isset($Starts_Date))
							{
								$this->registry->template->Starts_Date = 'None';
								$this->registry->template->End_Date = 'None';
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
								$Starts_Date = date('Y-m-d',strtotime($Starts_Date));
								$End_Date = date('Y-m-d',strtotime($End_Date));
								$this->registry->template->Starts_Date = $Starts_Date;
								$this->registry->template->End_Date = $End_Date;
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
								$paginate = new paginate('users','20',$pagenum,$sql_paginate,$Execute_Array_Paginate);
								$Count = $paginate->Records('users');
								$this->registry->template->Page = $pagenum;
								$this->registry->template->Count = $Count;
								$this->registry->template->Last = $paginate->Calculate_Last($Count);
								$results = $paginate->Paginate();
								$this->registry->template->results = $results;
								$this->registry->template->show('admin_search/merchant_log');
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
								$paginate = new paginate('users','20',$pagenum,$sql_paginate,$Execute_Array_Paginate);
								$Count = $paginate->Records('users');
								$this->registry->template->Page = $pagenum;
								$this->registry->template->Count = $Count;
								$this->registry->template->Last = $paginate->Calculate_Last($Count);
								$results = $paginate->Paginate();
								$this->registry->template->results = $results;
								$this->registry->template->show('admin_search/merchant_log');
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
					}
				
			}
}

?>
