<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
$Allowed_Users = array('5');
validate_roles_new::validate($Allowed_Users);
class country_adminController extends baseController {
			
		public function index() 
			{
				
			}
		public function edit_pw()
			{
				$this->registry->template->ID =  $_SESSION['User_ID'];
				$this->registry->template->show('country_admin/edit_pw');
			}
		public function submit_members_edit_details()
			{
				$Display = new sql();
				$validate = new validate_new();
				$ID = $_POST['ID'];
				$OID = $_SESSION['User_ID'];
				$Level = $_POST['Level'];
				$First_Name = $_POST['First_Name'];
				$user_name = $_POST['user_name'];
				$Company_Name = $_POST['Company_Name'];
				$Phone_Number = $_POST['Phone_Number'];
				$Cell_Phone = $_POST['Cell_Phone'];
				$Sender_Name = $_POST['Sender_Name'];
				$Address = strip_tags($_POST['Address']);
				$Starts_Date = $_POST['Starts_Date'];
				$End_Date = $_POST['End_Date'];
				$Ads_Cat = $_POST['Ads_Cat'];
				$Country = $_POST['Country_Name'];
				$SID_Values = trim(@$_POST['SID_Values']);
				$Amount = trim(@$_POST['Amount']);
				$Time_Stamp = $_POST['Time_Stamp'];
				$Display->Delete_JSON($Time_Stamp);
				$Item_Exists_Edit_Modified_JSON = $validate->Item_Exists_Edit_Modified_JSON('users','user_name',$ID,$user_name);
				$Counter = 0;
				$Validate_Email = $validate->Validate_Email($user_name);
				if($Level == '2')
					{
						
						$Starts_Date_String = strtotime($Starts_Date);
						$End_Date_String = strtotime($End_Date);
						
						if($First_Name == NULL)
							{
								$myTweets = array("flag" => '1');
								$Display->Write_JSON($Time_Stamp,$myTweets);
								
							}
						elseif($user_name == NULL)
							{
								$myTweets = array("flag" => '3');
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
						elseif($Sender_Name == NULL)
							{
								$myTweets = array("flag" => '8');
								$Display->Write_JSON($Time_Stamp,$myTweets);
							}
						elseif($Address == NULL)
							{
								$myTweets = array("flag" => '9');
								$Display->Write_JSON($Time_Stamp,$myTweets);
							}
						elseif($Starts_Date == NULL)
							{
								$myTweets = array("flag" => '10');
								$Display->Write_JSON($Time_Stamp,$myTweets);
							}
						elseif($End_Date == NULL)
							{
								$myTweets = array("flag" => '11');
								$Display->Write_JSON($Time_Stamp,$myTweets);
							}
						elseif($Ads_Cat == '0')
							{
								$myTweets = array("flag" => '12');
								$Display->Write_JSON($Time_Stamp,$myTweets);
							}
						elseif($SID_Values == NULL)
							{
								$myTweets = array("flag" => '13');
								$Display->Write_JSON($Time_Stamp,$myTweets);
								
							}
						elseif($Country == '0')
							{
								$myTweets = array("flag" => '14');
								$Display->Write_JSON($Time_Stamp,$myTweets);
							}
						elseif(!$Validate_Email)
							{
								$myTweets = array("flag" => '15');
								$Display->Write_JSON($Time_Stamp,$myTweets);
							}
						elseif(strlen($user_name) < 4)
							{
								$myTweets = array("flag" => '16');
								$Display->Write_JSON($Time_Stamp,$myTweets);
							}
						elseif($Starts_Date_String > $End_Date_String)
							{
								$myTweets = array("flag" => '19');
								$Display->Write_JSON($Time_Stamp,$myTweets);
							}
						elseif($Item_Exists_Modified_JSON)
							{
								$myTweets = array("flag" => '20');
								$Display->Write_JSON($Time_Stamp,$myTweets);
							}
						elseif(($Amount != NULL)&&(!is_numeric($Amount)))
							{
								$myTweets = array("flag" => '21');
								$Display->Write_JSON($Time_Stamp,$myTweets);
							}
						else
							{
								if(isset($_SESSION['Arabic']))
									{
										$Table_Merchants = 'merchant_services';
									}
								else
									{
										$Table_Merchants = 'merchant_services_english';
									}
								$SID_Values = explode(',',$SID_Values);
								foreach($SID_Values as $Value)
									{
										if($Value != NULL)
											{
												$SID_Values_Final[] = $Value;
											}
									}
								$myTweets = array("flag" => '0');
								$Display->Write_JSON($Time_Stamp,$myTweets);
								$Starts_Date = date('Y-m-d',strtotime($Starts_Date));
								$End_Date = date('Y-m-d',strtotime($End_Date));
								$sql = 'UPDATE users SET First_Name = ?,user_name = ?,Level = ?,Company_Name = ?,Phone_Number = ?,Cell_Phone = ?,Sender_Name = ?,Address = ?,Starts_Date = ?,End_Date = ?,Ads_Cat = ?,Country = ? WHERE ID = ?';
								$Execute_Array = array($First_Name,$user_name,$Level,$Company_Name,$Phone_Number,$Cell_Phone,$Sender_Name,$Address,$Starts_Date,$End_Date,$Ads_Cat,$Country,$ID);
								$Display->Execute($sql,$Execute_Array);
								$Action_Time = date('Y-m-d G:i:s');
								$Display->create_log($ID,'users','2',$Action_Time,$OID,'user edited');
								
								$sql = 'DELETE FROM '.$Table_Merchants.' WHERE MID = ?';
								$Execute_Array = array($ID);
								$Display->Execute($sql,$Execute_Array);
								
								foreach($SID_Values_Final as $Value)
									{
										$sql = 'INSERT INTO '.$Table_Merchants.' (MID,SID,Status) VALUES (?,?,?)';
										$Execute_Array = array($ID,$Value,'1');
										$RID_2 = $Display->Execute($sql,$Execute_Array,'1',$Table_Merchants);
										$Display->create_log($RID_2,$Table_Merchants,'1',$Action_Time,$OID,'New services added');
									}
									
								if($Amount != NULL)
									{
										$sql = 'SELECT ID FROM merchant_accounts WHERE MID = ? AND Status = ?';
										$Execute_Array = array($ID,'1');
										$Total_Records = $Display->Total_Records($sql,$Execute_Array);
										if($Total_Records)
											{
												$sql = 'UPDATE merchant_accounts SET Amount = ? WHERE MID = ?';
												$Execute_Array = array($Amount,$ID);
												$Display->Execute($sql,$Execute_Array);
											}
										else
											{
												$sql = 'INSERT INTO merchant_accounts (MID,Amount,Status) VALUES (?,?,?)';
												$Execute_Array = array($ID,$Amount,'1');
												$RID_3 = $Display->Execute($sql,$Execute_Array,'1','merchant_accounts');
												$Display->create_log($RID_3,'merchant_accounts','1',$Action_Time,$OID,'New amount added');
											}
									}
							}
					}
				elseif(($Level == '3')||($Level == '4') ||($Level == '5'))
					{
						if($First_Name == NULL)
							{
								$myTweets = array("flag" => '1');
								$Display->Write_JSON($Time_Stamp,$myTweets);
								
							}
						elseif($user_name == NULL)
							{
								$myTweets = array("flag" => '3');
								$Display->Write_JSON($Time_Stamp,$myTweets);
								
							}
						elseif(strlen($user_name) < 4)
							{
								$myTweets = array("flag" => '14');
								$Display->Write_JSON($Time_Stamp,$myTweets);
							}
						elseif($Item_Exists_Edit_Modified_JSON)
							{
								$myTweets = array("flag" => '18');
								$Display->Write_JSON($Time_Stamp,$myTweets);
							}
						elseif($Country == '0')
							{
								$myTweets = array("flag" => '12');
								$Display->Write_JSON($Time_Stamp,$myTweets);
							}
						elseif(!$Validate_Email)
							{
								$myTweets = array("flag" => '15');
								$Display->Write_JSON($Time_Stamp,$myTweets);
							}
						else
							{
								$myTweets = array("flag" => '0');
								$Display->Write_JSON($Time_Stamp,$myTweets);
								$create_member = new create_member();
								$Salt = $create_member->getPasswordSalt();
								$Enc_PW = $create_member->getPasswordHash($Salt,$password);
								$sql = 'UPDATE users SET First_Name = ?,user_name = ?,Level = ?,Country = ? WHERE ID = ?';
								$Execute_Array = array($First_Name,$user_name,$Level,$Country,$ID);
								$Display->Execute($sql,$Execute_Array);
								$Action_Time = date('Y-m-d G:i:s');
								$Display->create_log($ID,'users','2',$Action_Time,$OID,'user edited');
							}
					}
				else
					{
						if($First_Name == NULL)
							{
								$myTweets = array("flag" => '1');
								$Display->Write_JSON($Time_Stamp,$myTweets);
								
							}
						elseif($user_name == NULL)
							{
								$myTweets = array("flag" => '3');
								$Display->Write_JSON($Time_Stamp,$myTweets);
								
							}
						elseif(strlen($user_name) < 4)
							{
								$myTweets = array("flag" => '14');
								$Display->Write_JSON($Time_Stamp,$myTweets);
							}
						elseif(!$Validate_Email)
							{
								$myTweets = array("flag" => '15');
								$Display->Write_JSON($Time_Stamp,$myTweets);
							}
						elseif($Item_Exists_Edit_Modified_JSON)
							{
								$myTweets = array("flag" => '18');
								$Display->Write_JSON($Time_Stamp,$myTweets);
							}
						else
							{
								$myTweets = array("flag" => '0');
								$Display->Write_JSON($Time_Stamp,$myTweets);
								$create_member = new create_member();
								$Salt = $create_member->getPasswordSalt();
								$Enc_PW = $create_member->getPasswordHash($Salt,$password);
								$sql = 'UPDATE users SET First_Name = ?,user_name = ?,Level = ? WHERE ID = ?';
								$Execute_Array = array($First_Name,$user_name,$Level,$ID);
								$Display->Execute($sql,$Execute_Array);
								$Action_Time = date('Y-m-d G:i:s');
								$Display->create_log($ID,'users','2',$Action_Time,$OID,'user edited');
							}
					}
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
				$sql = 'SELECT First_Name,user_name,Company_Name,Phone_Number,Cell_Phone FROM users WHERE ID = ?';
				$Execute_Array = array($OID);
				$this->registry->template->Member_ID = $OID;
				$this->registry->template->results = $Display->Display_Info($sql,$Execute_Array);
				$this->registry->template->show('country_admin/show_account');
			}
		public function submit_members_edit()
			{
				$Display = new sql();
				$validate = new validate_new();
				$OID = $_SESSION['User_ID'];
				$ID = $_POST['ID'];
				$First_Name = $_POST['First_Name'];
				$user_name = $_POST['user_name'];
				$Phone_Number = $_POST['Phone_Number'];
				$Cell_Phone = $_POST['Cell_Phone'];
				$Time_Stamp = $_POST['Time_Stamp'];
				$Display->Delete_JSON($Time_Stamp);
				$Validate_Email = $validate->Validate_Email($user_name);
				
				if($First_Name == NULL)
					{
						$myTweets = array("flag" => '1');
						$Display->Write_JSON($Time_Stamp,$myTweets);
								
					}
				elseif(($Phone_Number == NULL)&&($Cell_Phone == NULL))
					{
						$myTweets = array("flag" => '7');
						$Display->Write_JSON($Time_Stamp,$myTweets);
					}
				elseif($user_name == NULL)
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
						$sql = 'UPDATE users SET First_Name = ?,user_name = ?,Phone_Number = ?,Cell_Phone = ? WHERE ID = ?';
						$Execute_Array = array($First_Name,$user_name,$Phone_Number,$Cell_Phone,$ID);
						$Display->Execute($sql,$Execute_Array);
						$Action_Time = date('Y-m-d G:i:s');
						$Display->create_log($ID,'users','2',$Action_Time,$OID,'user edited');
					}
					
			}
		
		public function edit_selected_merchant()
			{
				$Display = new sql();
				$URL = new url();
				$Member_ID  = $URL->getPar('Member');
				$Level  = $URL->getPar('Level');
				$sql = 'SELECT * FROM users WHERE ID = ?';
				$Execute_Array = array($Member_ID);
				$this->registry->template->Member_ID = $Member_ID;
				$this->registry->template->Level = $Level;
				$this->registry->template->results = $Display->Display_Info($sql,$Execute_Array);
				if(isset($_SESSION['Arabic']))
					{
						$Table = 'ads_cat';
						$Table_Country = 'country';
						$Table_Services = 'ads_sub_cat';
						$Table_Merchant_Services = 'merchant_services';
					}
				else
					{
						$Table = 'ads_cat_english';
						$Table_Country = 'country_english';
						$Table_Services = 'ads_sub_cat_english';
						$Table_Merchant_Services = 'merchant_services_english';
					}
				$sql = 'SELECT ID,Cat_Name FROM '.$Table.' WHERE Status = ?';
				$Execute_Array = array('1');
				$this->registry->template->results_ads = $Display->Display_Info($sql,$Execute_Array);
				$sql = 'SELECT ID,Name FROM '.$Table_Country.' WHERE Status = ?';
				$this->registry->template->results_country = $Display->Display_Info($sql,$Execute_Array);
				$sql = 'SELECT ID,Sub_Cat_Name FROM '.$Table_Services.' WHERE Status = ?';
				$this->registry->template->results_services = $Display->Display_Info($sql,$Execute_Array);
				$sql = 'SELECT SID FROM '.$Table_Merchant_Services.' WHERE MID = ?';
				$Execute_Array = array($Member_ID);
				$results =  $Display->Display_Info($sql,$Execute_Array);
				$Merchant_Services = array();
				foreach($results as $rows)
					{
						$Merchant_Services[] = $rows->SID;
					}
				$this->registry->template->Merchant_Services = $Merchant_Services;
				$sql = 'SELECT Amount FROM merchant_accounts WHERE MID = ? AND Status = ?';
				$Execute_Array = array($Member_ID,'1');
				$this->registry->template->Amount = $Display->Display_Single_Info_Modified($sql,'Amount',$Execute_Array);
				$this->registry->template->show('country_admin/edit_selected_merchant');
			}
		public function display_search_results()
			{
				$Display = new sql();
				$Starts_Date = @$_POST['Starts_Date'];
				$End_Date = @$_POST['End_Date'];
				$Sales_Men = $_POST['Sales_Men'];
				$Merchant_ID = $_POST['Merchant_ID'];
				$Category = $_POST['Category'];
				$Services = $_POST['Services'];
				$Current_Country = $_SESSION['Default_Country'];
				
				$this->registry->template->Starts_Date = $Starts_Date;
				$this->registry->template->End_Date = $End_Date;
				$this->registry->template->Sales_Men = $Sales_Men;
				$this->registry->template->Merchant_ID = $Merchant_ID;
				$this->registry->template->Category = $Category;
				$this->registry->template->Services = $Services;
				
				if(isset($_SESSION['Arabic']))
					{
						$Table = 'country';
						$Table_Offers = 'offers';
						$Table_Services = 'merchant_services';
					}
				else
					{
						$Table = 'country_english';
						$Table_Offers = 'offers_english';
						$Table_Services = 'merchant_services_english';
					}
					
				$MID_Array = array();
				$MID_User_Name_Array = array();
				$Log_Creator = array();
				$Amount_Array = array();
				$Merchants_Not_Filtered = array();
				$Merchant_ID_Filtered = array();
				$MID_Array_1 = array();
				$Total_Amount = 0;
				$Total_Services = 0;
				if(($Starts_Date == '000000') || ($Starts_Date == '1970-01-01') || ($Starts_Date == NULL))
					{
						if(($Merchant_ID == '999')&&($Category == '999')&&($Services == '999'))
							{
								$sql = 'SELECT ID,Sender_Name,Ads_Cat FROM users WHERE Level = ? AND Status = ? AND Country = ?';
								$Execute_Array = array('2','1',$Current_Country);
								$results = $Display->Display_Info($sql,$Execute_Array);
								foreach($results as $rows)
									{
										$sql_log = 'SELECT OID FROM logs WHERE RID = ? AND Table_Name = ?';
										$Execute_Array = array($rows->ID,'users');
										$OID = $Display->Display_Single_Info_Modified($sql_log,'OID',$Execute_Array);
										
										$sql_name = 'SELECT First_Name FROM users WHERE ID = ?';
										$Execute_Array = array($OID);
										$Log_Creator[] = $Display->Display_Single_Info_Modified($sql_name,'First_Name',$Execute_Array);
										
										$sql_account = 'SELECT Amount FROM merchant_accounts WHERE MID = ? AND Status = ?';
										$Execute_Array = array($rows->ID,'1');
										$Amount =  $Display->Display_Single_Info_Modified($sql_account,'Amount',$Execute_Array);
										$Total_Amount += $Amount;
										$Amount_Array[] =  $Amount;
										
										$MID_Array[] = $rows->ID;
										$MID_User_Name_Array[] = $rows->Sender_Name;
									}
							}
						
						if(($Merchant_ID != '999')&&($Category == '999')&&($Services == '999'))
							{
								$sql = 'SELECT ID,Sender_Name,Ads_Cat FROM users WHERE ID = ?';
								$Execute_Array = array($MID);
								$results = $Display->Display_Info($sql,$Execute_Array);
								foreach($results as $rows)
									{
										$sql_log = 'SELECT OID FROM logs WHERE RID = ? AND Table_Name = ?';
										$Execute_Array = array($rows->ID,'users');
										$OID = $Display->Display_Single_Info_Modified($sql_log,'OID',$Execute_Array);
										
										$sql_name = 'SELECT First_Name FROM users WHERE ID = ?';
										$Execute_Array = array($OID);
										$Log_Creator[] = $Display->Display_Single_Info_Modified($sql_name,'First_Name',$Execute_Array);
										
										$sql_account = 'SELECT Amount FROM merchant_accounts WHERE MID = ? AND Status = ?';
										$Execute_Array = array($rows->ID,'1');
										$Amount =  $Display->Display_Single_Info_Modified($sql_account,'Amount',$Execute_Array);
										$Amount_Array[] =  $Amount;
										$Total_Amount += $Amount;
										$MID_Array[] = $rows->ID;
										$MID_User_Name_Array[] = $rows->Sender_Name;
									}
							}
						if(($Merchant_ID == '999')&&($Category != '999')&&($Services == '999'))
							{
								$sql = 'SELECT ID,Sender_Name FROM users WHERE Level = ? AND Status = ? AND Ads_Cat = ? AND Country = ?';
								$Execute_Array = array('2','1',$Category,$Current_Country);
								$results = $Display->Display_Info($sql,$Execute_Array);
								foreach($results as $rows)
									{
										$sql_log = 'SELECT OID FROM logs WHERE RID = ? AND Table_Name = ?';
										$Execute_Array = array($rows->ID,'users');
										$OID = $Display->Display_Single_Info_Modified($sql_log,'OID',$Execute_Array);
										
										$sql_name = 'SELECT First_Name FROM users WHERE ID = ?';
										$Execute_Array = array($OID);
										$Log_Creator[] = $Display->Display_Single_Info_Modified($sql_name,'First_Name',$Execute_Array);
										
										$sql_account = 'SELECT Amount FROM merchant_accounts WHERE MID = ? AND Status = ?';
										$Execute_Array = array($rows->ID,'1');
										$Amount =  $Display->Display_Single_Info_Modified($sql_account,'Amount',$Execute_Array);
										$Amount_Array[] =  $Amount;
										$Total_Amount += $Amount;
										
										$MID_Array[] = $rows->ID;
										$MID_User_Name_Array[] = $rows->Sender_Name;
									}
							}
						if(($Merchant_ID != '999')&&($Category != '999')&&($Services == '999'))
							{
								$sql = 'SELECT ID,Sender_Name,Ads_Cat FROM users WHERE ID = ?';
								$Execute_Array = array($MID);
								$results = $Display->Display_Info($sql,$Execute_Array);
								foreach($results as $rows)
									{
										$sql_log = 'SELECT OID FROM logs WHERE RID = ? AND Table_Name = ?';
										$Execute_Array = array($rows->ID,'users');
										$OID = $Display->Display_Single_Info_Modified($sql_log,'OID',$Execute_Array);
										
										$sql_name = 'SELECT First_Name FROM users WHERE ID = ?';
										$Execute_Array = array($OID);
										$Log_Creator[] = $Display->Display_Single_Info_Modified($sql_name,'First_Name',$Execute_Array);
										
										$sql_account = 'SELECT Amount FROM merchant_accounts WHERE MID = ? AND Status = ?';
										$Execute_Array = array($rows->ID,'1');
										$Amount =  $Display->Display_Single_Info_Modified($sql_account,'Amount',$Execute_Array);
										$Amount_Array[] =  $Amount;
										$Total_Amount += $Amount;
										
										$MID_Array[] = $rows->ID;
										$MID_User_Name_Array[] = $rows->Sender_Name;
									}
							}
						if(($Merchant_ID == '999')&&($Category == '999')&&($Services != '999'))
							{
								
								$sql = 'SELECT ID FROM users WHERE Level = ? AND Status = ? AND Country = ?';
								$Execute_Array = array('2','1',$Current_Country);
								$results = $Display->Display_Info($sql,$Execute_Array);
								foreach($results as $rows)
									{
										$Merchants_Not_Filtered[] = $rows->ID;
									}
								$sql = 'SELECT MID FROM '.$Table_Services.' WHERE SID = ? AND Status = ?';
								$Execute_Array = array($Services,'1');
								$results = $Display->Display_Info($sql,$Execute_Array);
								foreach($results as $rows)
									{
										if(in_array($rows->MID,$Merchants_Not_Filtered))
											{
												$Merchant_ID_Filtered[] = $rows->MID;
											}
									}
								foreach($Merchant_ID_Filtered as $value)
									{
										$sql_log = 'SELECT OID FROM logs WHERE RID = ? AND Table_Name = ?';
										$Execute_Array = array($value,'users');
										$OID = $Display->Display_Single_Info_Modified($sql_log,'OID',$Execute_Array);
										
										$sql_name = 'SELECT First_Name FROM users WHERE ID = ?';
										$Execute_Array = array($OID);
										$Log_Creator[] = $Display->Display_Single_Info_Modified($sql_name,'First_Name',$Execute_Array);
										
										$sql_account = 'SELECT Amount FROM merchant_accounts WHERE MID = ? AND Status = ?';
										$Execute_Array = array($value,'1');
										$Amount =  $Display->Display_Single_Info_Modified($sql_account,'Amount',$Execute_Array);
										$Amount_Array[] =  $Amount;
										$Total_Amount += $Amount;
										$MID_Array[] = $value;
										
										$sql_name = 'SELECT Sender_Name FROM users WHERE ID = ?';
										$Execute_Array = array($value);
										$MID_User_Name_Array[] = $Display->Display_Single_Info_Modified($sql_name,'Sender_Name',$Execute_Array);
									}
							}  
						if(($Merchant_ID != '999')&&($Category == '999')&&($Services != '999'))
							{
								$sql = 'SELECT MID FROM '.$Table_Services.' WHERE SID = ? AND Status = ?';
								$Execute_Array = array($Services,'1');
								$results = $Display->Display_Info($sql,$Execute_Array);
								foreach($results as $rows)
									{
										if($rows->MID == $Merchant_ID)
											{
												$MID_Array_1[] = $rows->MID;
											}
									}
								foreach($MID_Array_1 as $value)
									{
										$sql_log = 'SELECT OID FROM logs WHERE RID = ? AND Table_Name = ?';
										$Execute_Array = array($value,'users');
										$OID = $Display->Display_Single_Info_Modified($sql_log,'OID',$Execute_Array);
										
										$sql_name = 'SELECT First_Name FROM users WHERE ID = ?';
										$Execute_Array = array($OID);
										$Log_Creator[] = $Display->Display_Single_Info_Modified($sql_name,'First_Name',$Execute_Array);
										
										$sql_account = 'SELECT Amount FROM merchant_accounts WHERE MID = ? AND Status = ?';
										$Execute_Array = array($value,'1');
										$Amount =  $Display->Display_Single_Info_Modified($sql_account,'Amount',$Execute_Array);
										$Amount_Array[] =  $Amount;
										$Total_Amount += $Amount;
										$MID_Array[] = $value;
										
										$sql_name = 'SELECT Sender_Name FROM users WHERE ID = ?';
										$Execute_Array = array($value);
										$MID_User_Name_Array[] = $Display->Display_Single_Info_Modified($sql_name,'Sender_Name',$Execute_Array);
									}
							}
						if(($Merchant_ID == '999')&&($Category != '999')&&($Services != '999'))
							{
								$sql = 'SELECT ID FROM users WHERE Level = ? AND Status = ? AND Ads_Cat = ? AND Country = ?';
								$Execute_Array = array('2','1',$Category,$Current_Country);
								$results = $Display->Display_Info($sql,$Execute_Array);
								foreach($results as $rows)
									{
										$Merchants_Not_Filtered[] = $rows->ID;
									}
								$sql = 'SELECT MID FROM '.$Table_Services.' WHERE SID = ? AND Status = ?';
								$Execute_Array = array($Services,'1');
								$results = $Display->Display_Info($sql,$Execute_Array);
								foreach($results as $rows)
									{
										if(in_array($rows->MID,$Merchants_Not_Filtered))
											{
												$Merchant_ID_Filtered[] = $rows->MID;
											}
									}
								foreach($Merchant_ID_Filtered as $value)
									{
										$sql_log = 'SELECT OID FROM logs WHERE RID = ? AND Table_Name = ?';
										$Execute_Array = array($value,'users');
										$OID = $Display->Display_Single_Info_Modified($sql_log,'OID',$Execute_Array);
										
										$sql_name = 'SELECT First_Name FROM users WHERE ID = ?';
										$Execute_Array = array($OID);
										$Log_Creator[] = $Display->Display_Single_Info_Modified($sql_name,'First_Name',$Execute_Array);
										
										$sql_account = 'SELECT Amount FROM merchant_accounts WHERE MID = ? AND Status = ?';
										$Execute_Array = array($value,'1');
										$Amount =  $Display->Display_Single_Info_Modified($sql_account,'Amount',$Execute_Array);
										$Amount_Array[] =  $Amount;
										$Total_Amount += $Amount;
										$MID_Array[] = $value;
										
										$sql_name = 'SELECT Sender_Name FROM users WHERE ID = ?';
										$Execute_Array = array($value);
										$MID_User_Name_Array[] = $Display->Display_Single_Info_Modified($sql_name,'Sender_Name',$Execute_Array);
									}
							}
						foreach($MID_Array as $value)
							{
								$sql = 'SELECT ID FROM '.$Table_Services.' WHERE MID = ? AND Status = ?';
								$Execute_Array = array($value,'1');
								$Total_Records = $Display->Total_Records($sql,$Execute_Array);
								$Total_Services += $Total_Records;
							}
						$this->registry->template->Total_Services = $Total_Services;
						$this->registry->template->MID_Array = $MID_Array;
						$this->registry->template->MID_User_Name_Array = $MID_User_Name_Array;
						$this->registry->template->Log_Creator = $Log_Creator;
						$this->registry->template->Amount_Array = $Amount_Array;
						$this->registry->template->Total_Amount = $Total_Amount;
						$this->registry->template->show('country_admin/display_search_results');
					}
				else
					{
						$Starts_Date = date('Y-m-d G:i:s',strtotime($Starts_Date));
						$End_Date = date('Y-m-d G:i:s',strtotime($End_Date));
						$Logs_Array = array();
						if(($Merchant_ID == '999')&&($Category == '999')&&($Services == '999'))
							{
								$sql_log = 'SELECT RID FROM logs WHERE Table_Name = ? AND Action = ? AND (Time_Stamp BETWEEN ? AND ? )';
								$Execute_Array = array('users','1',$Starts_Date,$End_Date);
								$results = $Display->Display_Info($sql_log,$Execute_Array);
								foreach($results as $rows_logs)
									{
										$Logs_Array[] = $rows_logs->RID;
									}
								$sql = 'SELECT ID,Sender_Name,Ads_Cat FROM users WHERE Level = ? AND Status = ? AND Country = ?';
								$Execute_Array = array('2','1',$Current_Country);
								$results = $Display->Display_Info($sql,$Execute_Array);
								foreach($results as $rows)
									{
										if(in_array($rows->ID,$Logs_Array))
											{
												$sql_log = 'SELECT OID FROM logs WHERE RID = ? AND Table_Name = ?';
												$Execute_Array = array($rows->ID,'users');
												$OID = $Display->Display_Single_Info_Modified($sql_log,'OID',$Execute_Array);
												
												$sql_name = 'SELECT First_Name FROM users WHERE ID = ?';
												$Execute_Array = array($OID);
												$Log_Creator[] = $Display->Display_Single_Info_Modified($sql_name,'First_Name',$Execute_Array);
												
												$sql_account = 'SELECT Amount FROM merchant_accounts WHERE MID = ? AND Status = ?';
												$Execute_Array = array($rows->ID,'1');
												$Amount =  $Display->Display_Single_Info_Modified($sql_account,'Amount',$Execute_Array);
												$Total_Amount += $Amount;
												$Amount_Array[] =  $Amount;
												
												$MID_Array[] = $rows->ID;
												$MID_User_Name_Array[] = $rows->Sender_Name;
											}
									}
							}
						
						if(($Merchant_ID != '999')&&($Category == '999')&&($Services == '999'))
							{
								
								$sql = 'SELECT ID,Sender_Name,Ads_Cat FROM users WHERE ID = ?';
								$Execute_Array = array($MID);
								$results = $Display->Display_Info($sql,$Execute_Array);
								foreach($results as $rows)
									{
										$sql_log = 'SELECT OID FROM logs WHERE RID = ? AND Table_Name = ?';
										$Execute_Array = array($rows->ID,'users');
										$OID = $Display->Display_Single_Info_Modified($sql_log,'OID',$Execute_Array);
												
										$sql_name = 'SELECT First_Name FROM users WHERE ID = ?';
										$Execute_Array = array($OID);
										$Log_Creator[] = $Display->Display_Single_Info_Modified($sql_name,'First_Name',$Execute_Array);
												
										$sql_account = 'SELECT Amount FROM merchant_accounts WHERE MID = ? AND Status = ?';
										$Execute_Array = array($rows->ID,'1');
										$Amount =  $Display->Display_Single_Info_Modified($sql_account,'Amount',$Execute_Array);
										$Amount_Array[] =  $Amount;
										$Total_Amount += $Amount;
										$MID_Array[] = $rows->ID;
										$MID_User_Name_Array[] = $rows->Sender_Name;
											
									}
							}
						if(($Merchant_ID == '999')&&($Category != '999')&&($Services == '999'))
							{
								$sql_log = 'SELECT RID FROM logs WHERE Table_Name = ? AND Action = ? AND (Time_Stamp BETWEEN ? AND ? )';
								$Execute_Array = array('users','1',$Starts_Date,$End_Date);
								$results = $Display->Display_Info($sql_log,$Execute_Array);
								foreach($results as $rows_logs)
									{
										$Logs_Array[] = $rows_logs->RID;
									}
								$sql = 'SELECT ID,Sender_Name FROM users WHERE Level = ? AND Status = ? AND Ads_Cat = ? AND Country = ?';
								$Execute_Array = array('2','1',$Category,$Current_Country);
								$results = $Display->Display_Info($sql,$Execute_Array);
								foreach($results as $rows)
									{
										if(in_array($rows->ID,$Logs_Array))
											{
												$sql_log = 'SELECT OID FROM logs WHERE RID = ? AND Table_Name = ?';
												$Execute_Array = array($rows->ID,'users');
												$OID = $Display->Display_Single_Info_Modified($sql_log,'OID',$Execute_Array);
												
												$sql_name = 'SELECT First_Name FROM users WHERE ID = ?';
												$Execute_Array = array($OID);
												$Log_Creator[] = $Display->Display_Single_Info_Modified($sql_name,'First_Name',$Execute_Array);
												
												$sql_account = 'SELECT Amount FROM merchant_accounts WHERE MID = ? AND Status = ?';
												$Execute_Array = array($rows->ID,'1');
												$Amount =  $Display->Display_Single_Info_Modified($sql_account,'Amount',$Execute_Array);
												$Amount_Array[] =  $Amount;
												$Total_Amount += $Amount;
												
												$MID_Array[] = $rows->ID;
												$MID_User_Name_Array[] = $rows->Sender_Name;
											}
									}
							}
						if(($Merchant_ID != '999')&&($Category != '999')&&($Services == '999'))
							{
								
								$sql = 'SELECT ID,Sender_Name,Ads_Cat FROM users WHERE ID = ?';
								$Execute_Array = array($MID);
								$results = $Display->Display_Info($sql,$Execute_Array);
								foreach($results as $rows)
									{
										
												$sql_log = 'SELECT OID FROM logs WHERE RID = ? AND Table_Name = ?';
												$Execute_Array = array($rows->ID,'users');
												$OID = $Display->Display_Single_Info_Modified($sql_log,'OID',$Execute_Array);
												
												$sql_name = 'SELECT First_Name FROM users WHERE ID = ?';
												$Execute_Array = array($OID);
												$Log_Creator[] = $Display->Display_Single_Info_Modified($sql_name,'First_Name',$Execute_Array);
												
												$sql_account = 'SELECT Amount FROM merchant_accounts WHERE MID = ? AND Status = ?';
												$Execute_Array = array($rows->ID,'1');
												$Amount =  $Display->Display_Single_Info_Modified($sql_account,'Amount',$Execute_Array);
												$Amount_Array[] =  $Amount;
												$Total_Amount += $Amount;
												
												$MID_Array[] = $rows->ID;
												$MID_User_Name_Array[] = $rows->Sender_Name;
											
									}
							}
						if(($Merchant_ID == '999')&&($Category == '999')&&($Services != '999'))
							{
								
								$sql_log = 'SELECT RID FROM logs WHERE Table_Name = ? AND Action = ? AND (Time_Stamp BETWEEN ? AND ? )';
								$Execute_Array = array('users','1',$Starts_Date,$End_Date);
								$results = $Display->Display_Info($sql_log,$Execute_Array);
								foreach($results as $rows_logs)
									{
										$Logs_Array[] = $rows_logs->RID;
									}
								$sql = 'SELECT ID FROM users WHERE Level = ? AND Status = ? AND Country = ?';
								$Execute_Array = array('2','1',$Current_Country);
								$results = $Display->Display_Info($sql,$Execute_Array);
								foreach($results as $rows)
									{
										if(in_array($rows->ID,$Logs_Array))
											{
												$Merchants_Not_Filtered[] = $rows->ID;
											}
									}
								$sql = 'SELECT MID FROM '.$Table_Services.' WHERE SID = ? AND Status = ?';
								$Execute_Array = array($Services,'1');
								$results = $Display->Display_Info($sql,$Execute_Array);
								foreach($results as $rows)
									{
										if(in_array($rows->MID,$Merchants_Not_Filtered))
											{
												$Merchant_ID_Filtered[] = $rows->MID;
											}
									}
								foreach($Merchant_ID_Filtered as $value)
									{
										$sql_log = 'SELECT OID FROM logs WHERE RID = ? AND Table_Name = ?';
										$Execute_Array = array($value,'users');
										$OID = $Display->Display_Single_Info_Modified($sql_log,'OID',$Execute_Array);
										
										$sql_name = 'SELECT First_Name FROM users WHERE ID = ?';
										$Execute_Array = array($OID);
										$Log_Creator[] = $Display->Display_Single_Info_Modified($sql_name,'First_Name',$Execute_Array);
										
										$sql_account = 'SELECT Amount FROM merchant_accounts WHERE MID = ? AND Status = ?';
										$Execute_Array = array($value,'1');
										$Amount =  $Display->Display_Single_Info_Modified($sql_account,'Amount',$Execute_Array);
										$Amount_Array[] =  $Amount;
										$Total_Amount += $Amount;
										$MID_Array[] = $value;
										
										$sql_name = 'SELECT Sender_Name FROM users WHERE ID = ?';
										$Execute_Array = array($value);
										$MID_User_Name_Array[] = $Display->Display_Single_Info_Modified($sql_name,'Sender_Name',$Execute_Array);
									}
							}  
						if(($Merchant_ID != '999')&&($Category == '999')&&($Services != '999'))
							{
								$sql = 'SELECT MID FROM '.$Table_Services.' WHERE SID = ? AND Status = ?';
								$Execute_Array = array($Services,'1');
								$results = $Display->Display_Info($sql,$Execute_Array);
								foreach($results as $rows)
									{
										if($rows->MID == $Merchant_ID)
											{
												$MID_Array_1[] = $rows->MID;
											}
									}
								foreach($MID_Array_1 as $value)
									{
										$sql_log = 'SELECT OID FROM logs WHERE RID = ? AND Table_Name = ?';
										$Execute_Array = array($value,'users');
										$OID = $Display->Display_Single_Info_Modified($sql_log,'OID',$Execute_Array);
										
										$sql_name = 'SELECT First_Name FROM users WHERE ID = ?';
										$Execute_Array = array($OID);
										$Log_Creator[] = $Display->Display_Single_Info_Modified($sql_name,'First_Name',$Execute_Array);
										
										$sql_account = 'SELECT Amount FROM merchant_accounts WHERE MID = ? AND Status = ?';
										$Execute_Array = array($value,'1');
										$Amount =  $Display->Display_Single_Info_Modified($sql_account,'Amount',$Execute_Array);
										$Amount_Array[] =  $Amount;
										$Total_Amount += $Amount;
										$MID_Array[] = $value;
										
										$sql_name = 'SELECT Sender_Name FROM users WHERE ID = ?';
										$Execute_Array = array($value);
										$MID_User_Name_Array[] = $Display->Display_Single_Info_Modified($sql_name,'Sender_Name',$Execute_Array);
									}
							}
						if(($Merchant_ID == '999')&&($Category != '999')&&($Services != '999'))
							{
								$sql_log = 'SELECT RID FROM logs WHERE Table_Name = ? AND Action = ? AND (Time_Stamp BETWEEN ? AND ? )';
								$Execute_Array = array('users','1',$Starts_Date,$End_Date);
								$results = $Display->Display_Info($sql_log,$Execute_Array);
								foreach($results as $rows_logs)
									{
										$Logs_Array[] = $rows_logs->RID;
									}
								$sql = 'SELECT ID FROM users WHERE Level = ? AND Status = ? AND Ads_Cat = ? AND Country = ?';
								$Execute_Array = array('2','1',$Category,$Current_Country);
								$results = $Display->Display_Info($sql,$Execute_Array);
								foreach($results as $rows)
									{
										if(in_array($rows->ID,$Logs_Array))
											{
												$Merchants_Not_Filtered[] = $rows->ID;
											}
									}
								$sql = 'SELECT MID FROM '.$Table_Services.' WHERE SID = ? AND Status = ?';
								$Execute_Array = array($Services,'1');
								$results = $Display->Display_Info($sql,$Execute_Array);
								foreach($results as $rows)
									{
										if(in_array($rows->MID,$Merchants_Not_Filtered))
											{
												$Merchant_ID_Filtered[] = $rows->MID;
											}
									}
								foreach($Merchant_ID_Filtered as $value)
									{
										$sql_log = 'SELECT OID FROM logs WHERE RID = ? AND Table_Name = ?';
										$Execute_Array = array($value,'users');
										$OID = $Display->Display_Single_Info_Modified($sql_log,'OID',$Execute_Array);
										
										$sql_name = 'SELECT First_Name FROM users WHERE ID = ?';
										$Execute_Array = array($OID);
										$Log_Creator[] = $Display->Display_Single_Info_Modified($sql_name,'First_Name',$Execute_Array);
										
										$sql_account = 'SELECT Amount FROM merchant_accounts WHERE MID = ? AND Status = ?';
										$Execute_Array = array($value,'1');
										$Amount =  $Display->Display_Single_Info_Modified($sql_account,'Amount',$Execute_Array);
										$Amount_Array[] =  $Amount;
										$Total_Amount += $Amount;
										$MID_Array[] = $value;
										
										$sql_name = 'SELECT Sender_Name FROM users WHERE ID = ?';
										$Execute_Array = array($value);
										$MID_User_Name_Array[] = $Display->Display_Single_Info_Modified($sql_name,'Sender_Name',$Execute_Array);
									}
							}
						
						foreach($MID_Array as $value)
							{
								$sql = 'SELECT ID FROM '.$Table_Services.' WHERE MID = ? AND Status = ?';
								$Execute_Array = array($value,'1');
								$Total_Records = $Display->Total_Records($sql,$Execute_Array);
								$Total_Services += $Total_Records;
							}
						$this->registry->template->Total_Services = $Total_Services;
						$this->registry->template->MID_Array = $MID_Array;
						$this->registry->template->MID_User_Name_Array = $MID_User_Name_Array;
						$this->registry->template->Log_Creator = $Log_Creator;
						$this->registry->template->Amount_Array = $Amount_Array;
						$this->registry->template->Total_Amount = $Total_Amount;
						$this->registry->template->show('country_admin/display_search_results');
					}
			}
		public function display_category($MID)
			{
				$Display = new sql();
				$Admin_Country = $_SESSION['Default_Country'];
				//$MID = $_POST['Merchant_ID'];
				$this->registry->template->MID = $MID; 
				if(isset($_SESSION['Arabic']))
					{
						$Table = 'ads_cat';
						$Table_Serives = 'merchant_services';
						$Table_Sub_Cat = 'ads_sub_cat';
					}
				else
					{
						$Table = 'ads_cat_english';
						$Table_Serives = 'merchant_services_english';
						$Table_Sub_Cat = 'ads_sub_cat_english';
					}
				$Cat_ID_Array = array();
				$Cat_Name_Array = array();
				
				$Sub_Cat_ID_Array = array();
				$Sub_Cat_Name_Array = array();
				
				if($MID =='999')
					{
						$sql = 'SELECT ID,Cat_Name FROM '.$Table.' WHERE Status = ?';
						$Execute_Array = array('1');
						$results = $Display->Display_Info($sql,$Execute_Array);
						foreach($results as $rows)
							{
								$Cat_ID_Array[] = $rows->ID;
								$Cat_Name_Array[] = $rows->Cat_Name;
							}
						$sql_sub = 'SELECT ID,Sub_Cat_Name FROM '.$Table_Sub_Cat.' WHERE Status = ?';
						$Execute_Array = array('1');
						$results = $Display->Display_Info($sql_sub,$Execute_Array);
						foreach($results as $rows)
							{
								$Sub_Cat_ID_Array[] = $rows->ID;
								$Sub_Cat_Name_Array[] = $rows->Sub_Cat_Name;
							}
					}
				else
					{
						$sql = 'SELECT Ads_Cat FROM users WHERE ID = ?';
						$Execute_Array = array($MID);
						$Ads_Cat = $Display->Display_Single_Info_Modified($sql,'Ads_Cat',$Execute_Array);
						$Cat_ID_Array[] = $Ads_Cat;
						
						$sql = 'SELECT Cat_Name FROM '.$Table.' WHERE ID = ?';
						$Execute_Array = array($Ads_Cat);
						$Ads_Cat_Name = $Display->Display_Single_Info_Modified($sql,'Cat_Name',$Execute_Array);
						$Cat_Name_Array[] = $Ads_Cat_Name;
						
						$sql = 'SELECT SID FROM '.$Table_Serives.' WHERE MID = ? AND Status = ?';
						$Execute_Array = array($MID,'1');
						$results = $Display->Display_Info($sql,$Execute_Array);
						foreach($results as $rows)
							{
								$Sub_Cat_ID_Array[] = $rows->SID;
								$sql_sub = 'SELECT Sub_Cat_Name FROM '.$Table_Sub_Cat.' WHERE ID = ?';
								$Execute_Array = array($rows->SID);
								$Sub_Cat_Name = $Display->Display_Single_Info_Modified($sql_sub,'Sub_Cat_Name',$Execute_Array);
								$Sub_Cat_Name_Array[] = $Sub_Cat_Name;
							}
					}
				if(count($Cat_ID_Array))
					{
						$this->registry->template->Sub_Cat_ID_Array = $Sub_Cat_ID_Array;
						$this->registry->template->Sub_Cat_Name_Array = $Sub_Cat_Name_Array;
						$this->registry->template->Cat_ID_Array = $Cat_ID_Array;
						$this->registry->template->Cat_Name_Array = $Cat_Name_Array;
						$this->registry->template->show('country_admin/display_category');
					}
				else
					{
						$this->registry->template->show('admin_search/no_results');
					}
			}
		public function display_sales_men()
			{
				$Display = new sql();
				$Admin_Country = $_SESSION['Default_Country'];
				$MID = $_POST['Merchant_ID'];
				$this->registry->template->MID = $MID;
				$Sales_ID = array();
				$Sales_User_Name = array();
				$Sales_Men_ID_Original = array();
				$Offer_ID_Array = array();
				if(isset($_SESSION['Arabic']))
					{
						$Table = 'offers';
					}
				else
					{
						$Table = 'offers_english';
					}
				
				if($MID == '999')
					{
						$Sales_ID = '999';
						$Sales_User_Name = 'الـكــل';
						
						/*$sql = 'SELECT ID FROM users WHERE Level = ? AND Status = ? AND Country = ?';
						$Execute_Array = array('2','1',$Admin_Country);
						$results = $Display->Display_Info($sql,$Execute_Array);
						foreach($results as $rows)
							{
								$Sales_Men_ID_Original[] = $rows->ID;
							}
						
						$sql = 'SELECT RID,OID FROM logs WHERE Table_Name = ? AND Action = ?';
						$Execute_Array = array('users','1');
						$results = $Display->Display_Info($sql,$Execute_Array);
						foreach($results as $rows)
							{
								$sql_level = 'SELECT Level FROM users WHERE ID = ?';
								$Execute_Array = array( $rows->OID);
								$Level = $Display->Display_Single_Info_Modified($sql_level,'Level',$Execute_Array);
								if(in_array($rows->RID,$Sales_Men_ID_Original) && $Level == '3')
									{
										$sql_users = 'SELECT user_name FROM users WHERE ID = ?';
										$Execute_Array = array($rows->OID);
										$Sales_ID[] = $rows->OID;
										$Sales_User_Name[] = $Display->Display_Single_Info_Modified($sql_users,'user_name',$Execute_Array);
									}
							}*/
					}
				else
					{
						$Sales_Men_ID_Original[] = $MID;
						$sql = 'SELECT RID,OID FROM logs WHERE Table_Name = ? AND Action = ?';
						$Execute_Array = array('users','1');
						$results = $Display->Display_Info($sql,$Execute_Array);
						foreach($results as $rows)
							{
								$sql_level = 'SELECT Level FROM users WHERE ID = ?';
								$Execute_Array = array( $rows->OID);
								$Level = $Display->Display_Single_Info_Modified($sql_level,'Level',$Execute_Array);
								if(in_array($rows->RID,$Sales_Men_ID_Original) && $Level == '3')
									{
										$sql_users = 'SELECT user_name FROM users WHERE ID = ?';
										$Execute_Array = array($rows->OID);
										$Sales_ID = $rows->OID;
										$Sales_User_Name = $Display->Display_Single_Info_Modified($sql_users,'user_name',$Execute_Array);
									}
							}
					}
				if($Sales_ID)
					{
						$this->registry->template->Sales_ID = $Sales_ID;
						$this->registry->template->Sales_User_Name = $Sales_User_Name;
						$this->registry->template->show('country_admin/display_sales_men');
						$this->display_category($MID);
					}
				else
					{
						$this->registry->template->show('admin_search/no_results');
					}
				
			}
		public function sales_offer()
			{
				$Display = new sql();
				$Admin_Country = $_SESSION['Default_Country'];
				
				$MID = array();
				$Merchant_Sender_Name = array();
				
				$sql = 'SELECT ID,Sender_Name FROM users WHERE Level = ? AND Status = ? AND Country = ?';
				$Execute_Array = array('2','1',$Admin_Country);
				$results = $Display->Display_Info($sql,$Execute_Array);
				foreach($results as $rows)
					{
						$MID[] = $rows->ID;
						$Merchant_Sender_Name[] = $rows->Sender_Name;
					}
				
				$this->registry->template->MID = $MID;
				$this->registry->template->Merchant_Sender_Name = $Merchant_Sender_Name;
				$this->registry->template->show('country_admin/sales_offer');
			}
		function LogOff()
			{
				$Display = new sql();
				$OID = $_SESSION['User_ID'];
				$Action_Time = date('Y-m-d G:i:s');
				$Display->create_log($OID,'users','5',$Action_Time,$OID,'logged off');
				session_unset();
				session_destroy();
				?>
				<script language="javascript">
				window.location = '<?php echo __VISITOR_PATH;?>';
				</script>
				<?
			}
		
}

?>
