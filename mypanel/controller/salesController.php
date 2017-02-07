 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
$Allowed_Users = array('3');
validate_roles_new::validate($Allowed_Users);
class salesController extends baseController {
			
		public function index() 
			{
				
			}
		public function edit_pw()
			{
				$URL = new url();
				$ID = $URL->getPar('Member');
				$this->registry->template->ID = $ID;
				$this->registry->template->show('sales/edit_pw');
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
						$Display->create_log($ID,'users','2',$Action_Time,$OID,'Edited users password');
					}
					
			}
		public function submit_members_edit()
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
				$Validate_Email = $validate->Validate_Email($user_name);
				$Starts_Date_Convert = date('Y-m-d',strtotime($Starts_Date));
				$End_Date_Convert = date('Y-m-d',strtotime($End_Date));
				$Counter = 0;
				if($Level == '2')
					{
						$Country = $_SESSION['Default_Country'];
						
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
						elseif($Starts_Date_Convert > $End_Date_Convert)
							{
								$myTweets = array("flag" => '12');
								$Display->Write_JSON($Time_Stamp,$myTweets);
							}
						elseif($Ads_Cat == '0')
							{
								$myTweets = array("flag" => '13');
								$Display->Write_JSON($Time_Stamp,$myTweets);
							}
						elseif($SID_Values == NULL)
							{
								$myTweets = array("flag" => '14');
								$Display->Write_JSON($Time_Stamp,$myTweets);
								
							}
						elseif($Country == '0')
							{
								$myTweets = array("flag" => '15');
								$Display->Write_JSON($Time_Stamp,$myTweets);
							}
						elseif(!$Validate_Email)
							{
								$myTweets = array("flag" => '16');
								$Display->Write_JSON($Time_Stamp,$myTweets);
							}
						elseif(strlen($user_name) < 4)
							{
								$myTweets = array("flag" => '17');
								$Display->Write_JSON($Time_Stamp,$myTweets);
							}
						elseif($Starts_Date_String > $End_Date_String)
							{
								$myTweets = array("flag" => '18');
								$Display->Write_JSON($Time_Stamp,$myTweets);
							}
						elseif($Item_Exists_Modified_JSON)
							{
								$myTweets = array("flag" => '19');
								$Display->Write_JSON($Time_Stamp,$myTweets);
							}
						elseif(($Amount != NULL)&&(!is_numeric($Amount)))
							{
								$myTweets = array("flag" => '20');
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
								$sql = 'UPDATE users SET First_Name = ?,Last_Name = ?,user_name = ?,Level = ?,Company_Name = ?,Phone_Number = ?,Cell_Phone = ?,Sender_Name = ?,Address = ?,Starts_Date = ?,End_Date = ?,Ads_Cat = ?,Country = ? WHERE ID = ?';
								$Execute_Array = array($First_Name,$Last_Name,$user_name,$Level,$Company_Name,$Phone_Number,$Cell_Phone,$Sender_Name,$Address,$Starts_Date,$End_Date,$Ads_Cat,$Country,$ID);
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
										$sql = 'UPDATE merchant_accounts SET Amount = ? WHERE MID = ?';
										$Execute_Array = array($Amount,$ID);
										$Display->Execute($sql,$Execute_Array);
									}
							}
					}
				else
					{
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
						elseif($user_name == NULL)
							{
								$myTweets = array("flag" => '3');
								$Display->Write_JSON($Time_Stamp,$myTweets);
								
							}
						elseif(!$Validate_Email)
							{
								$myTweets = array("flag" => '13');
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
						else
							{
								$myTweets = array("flag" => '0');
								$Display->Write_JSON($Time_Stamp,$myTweets);
								$create_member = new create_member();
								$Salt = $create_member->getPasswordSalt();
								$Enc_PW = $create_member->getPasswordHash($Salt,$password);
								$sql = 'UPDATE users SET First_Name = ?,Last_Name = ?,user_name = ?,Level = ? WHERE ID = ?';
								$Execute_Array = array($First_Name,$Last_Name,$user_name,$Level,$ID);
								$Display->Execute($sql,$Execute_Array);
								$Action_Time = date('Y-m-d G:i:s');
								$Display->create_log($ID,'users','2',$Action_Time,$OID,'user edited');
							}
					}
			}
		function edit_selected()
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
				$this->registry->template->show('sales/edit_selected');
			}
		public function edit_member()
			{
				$Display = new sql();
				$sql = 'SELECT * FROM users WHERE Status = ? AND Level = ?';
				$Execute_Array = array('1','2');
				$pagenum  = @$_POST['Page'];
				$paginate = new paginate('users','10',$pagenum,$sql,$Execute_Array);
				$Count = $paginate->Records('users');
				$this->registry->template->Page = $pagenum;
				$this->registry->template->Count = $Count;
				$this->registry->template->Last = $paginate->Calculate_Last($Count);
				$results = $paginate->Paginate();
				$this->registry->template->results = $results;
				$sql = 'SELECT ID,Level FROM user_level WHERE Status = ? AND ID = ?';
				$Execute_Array = array('1','2');
				$this->registry->template->results_level = $Display->Display_Info($sql,$Execute_Array);
				$this->registry->template->show('sales/edit_member');
			}
		private function send_email_to_admin($Company_Name,$Country,$Cat,$Sub_Cat_Array)
			{
				$Display = new sql();
				if(isset($_SESSION['Arabic']))
					{
						$Table_Cat = 'ads_cat';
						$Table_Sub = 'ads_sub_cat';
					}
				else
					{
						$Table_Cat = 'ads_cat_english';
						$Table_Sub = 'ads_sub_cat_english';
					}
				$sql = 'SELECT Cat_Name FROM '.$Table_Cat.' WHERE ID = ?';
				$Execute_Array = array($Cat);
				$Cat_Name = $Display->Display_Single_Info_Modified($sql,'Cat_Name',$Execute_Array);
				
				$sql = 'SELECT Name FROM country_english WHERE ID = ?';
				$Execute_Array = array($Country);
				$Country_Name = $Display->Display_Single_Info_Modified($sql,'Name',$Execute_Array);
				$Sub_Cat_Names = '';
				foreach($Sub_Cat_Array as $Value)
					{
						$sql = 'SELECT Sub_Cat_Name FROM '.$Table_Sub.' WHERE ID = ?';
						$Execute_Array = array($Value);
						$Sub_Cat_Names .= $Display->Display_Single_Info_Modified($sql,'Sub_Cat_Name',$Execute_Array);
						$Sub_Cat_Names .= '<BR />';
					}
				$my_mail = new my_mail();
				$body = '<div>This is to notify you that a new merchant was registered.</div>';
				$body .= '<div>Merchant company name : '.$Company_Name.'</div>';
				$body .= '<div>Country : '.$Country_Name.'</div>';
				$body .= '<div>Category : '.$Cat_Name.'</div>';
				$body .= '<div>Services : </div>';
				$body .= '<div style="margin-left:80px">'.$Sub_Cat_Names.'</div>';
				
				$my_mail->Send_SMTP($body,'mail.wafferapp.com','jor@wafferapp.com','FU{t?uMe7XaT','jor@wafferapp.com','Waffer Team','Waffer','hazem.a@softilesolutions.com','MR. Hazem');
			}
		public function submit_members_add()
			{
				$Display = new sql();
				$validate = new validate_new();
				$OID = $_SESSION['User_ID'];
				$Level = $_POST['Level'];
				$First_Name = $_POST['First_Name'];
				$user_name = $_POST['user_name'];
				$password = $_POST['password'];
				$password_2 = $_POST['password_2'];
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
				$Item_Exists_Modified_JSON = $validate->Item_Exists_Modified_JSON('users','user_name',$user_name);
				$Validate_Email = $validate->Validate_Email($user_name);
				$Starts_Date_Convert = date('Y-m-d',strtotime($Starts_Date));
				$End_Date_Convert = date('Y-m-d',strtotime($End_Date));
				$Counter = 0;
				if($Level == '2')
					{
						$Country = $_SESSION['Default_Country'];
						
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
						elseif($password == NULL)
							{
								$myTweets = array("flag" => '4');
								$Display->Write_JSON($Time_Stamp,$myTweets);
							}
						elseif($password_2 == NULL)
							{
								$myTweets = array("flag" => '5');
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
						elseif($Starts_Date_Convert > $End_Date_Convert)
							{
								$myTweets = array("flag" => '12');
								$Display->Write_JSON($Time_Stamp,$myTweets);
							}
						elseif($Ads_Cat == '0')
							{
								$myTweets = array("flag" => '13');
								$Display->Write_JSON($Time_Stamp,$myTweets);
							}
						elseif($SID_Values == NULL)
							{
								$myTweets = array("flag" => '14');
								$Display->Write_JSON($Time_Stamp,$myTweets);
								
							}
						elseif($Country == '0')
							{
								$myTweets = array("flag" => '15');
								$Display->Write_JSON($Time_Stamp,$myTweets);
							}
						elseif(!$Validate_Email)
							{
								$myTweets = array("flag" => '16');
								$Display->Write_JSON($Time_Stamp,$myTweets);
							}
						elseif(strlen($user_name) < 4)
							{
								$myTweets = array("flag" => '17');
								$Display->Write_JSON($Time_Stamp,$myTweets);
							}
						elseif(strlen($password) < 6)
							{
								$myTweets = array("flag" => '18');
								$Display->Write_JSON($Time_Stamp,$myTweets);
							}
						elseif($password != $password_2)
							{
								$myTweets = array("flag" => '19');
								$Display->Write_JSON($Time_Stamp,$myTweets);
							}
						elseif($Starts_Date_String > $End_Date_String)
							{
								$myTweets = array("flag" => '20');
								$Display->Write_JSON($Time_Stamp,$myTweets);
							}
						elseif($Item_Exists_Modified_JSON)
							{
								$myTweets = array("flag" => '21');
								$Display->Write_JSON($Time_Stamp,$myTweets);
							}
						elseif(($Amount != NULL)&&(!is_numeric($Amount)))
							{
								$myTweets = array("flag" => '22');
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
								$create_member = new create_member();
								$Salt = $create_member->getPasswordSalt();
								$Enc_PW = $create_member->getPasswordHash($Salt,$password);
								$sql = 'INSERT INTO users (First_Name,user_name,password,Salt,Level,Company_Name,Phone_Number,Cell_Phone,Sender_Name,Address,Starts_Date,End_Date,Ads_Cat,Country,Status) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)';
								$Execute_Array = array($First_Name,$user_name,$Enc_PW,$Salt,$Level,$Company_Name,$Phone_Number,$Cell_Phone,$Sender_Name,$Address,$Starts_Date,$End_Date,$Ads_Cat,$Country,'1');
								$RID = $Display->Execute($sql,$Execute_Array,'1','users');
								$Action_Time = date('Y-m-d G:i:s');
								$Display->create_log($RID,'users','1',$Action_Time,$OID,'New user created');
								foreach($SID_Values_Final as $Value)
									{
										$sql = 'INSERT INTO '.$Table_Merchants.' (MID,SID,Status) VALUES (?,?,?)';
										$Execute_Array = array($RID,$Value,'1');
										$RID_2 = $Display->Execute($sql,$Execute_Array,'1',$Table_Merchants);
										$Display->create_log($RID_2,$Table_Merchants,'1',$Action_Time,$OID,'New services added');
									}
								$this->send_email_to_admin($Company_Name,$Country,$Ads_Cat,$SID_Values_Final);
								if($Amount != NULL)
									{
										$sql = 'INSERT INTO merchant_accounts (MID,Amount,Status) VALUES (?,?,?)';
										$Execute_Array = array($RID,$Amount,'1');
										$RID_3 = $Display->Execute($sql,$Execute_Array,'1','merchant_accounts');
										$Display->create_log($RID_3,'merchant_accounts','1',$Action_Time,$OID,'New amount added');
									}
							}
					}
				else
					{
						
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
						elseif($user_name == NULL)
							{
								$myTweets = array("flag" => '3');
								$Display->Write_JSON($Time_Stamp,$myTweets);
								
							}
						elseif($password == NULL)
							{
								$myTweets = array("flag" => '4');
								$Display->Write_JSON($Time_Stamp,$myTweets);
							}
						elseif($password_2 == NULL)
							{
								$myTweets = array("flag" => '5');
								$Display->Write_JSON($Time_Stamp,$myTweets);
							}
						elseif(!$Validate_Email)
							{
								$myTweets = array("flag" => '13');
								$Display->Write_JSON($Time_Stamp,$myTweets);
							}
						elseif(strlen($user_name) < 4)
							{
								$myTweets = array("flag" => '14');
								$Display->Write_JSON($Time_Stamp,$myTweets);
							}
						elseif(strlen($password) < 6)
							{
								$myTweets = array("flag" => '15');
								$Display->Write_JSON($Time_Stamp,$myTweets);
							}
						elseif($password != $password_2)
							{
								$myTweets = array("flag" => '16');
								$Display->Write_JSON($Time_Stamp,$myTweets);
							}
						elseif($Item_Exists_Modified_JSON)
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
								$sql = 'INSERT INTO users (First_Name,Last_Name,user_name,password,Salt,Level,Status) VALUES (?,?,?,?,?,?,?)';
								$Execute_Array = array($First_Name,$Last_Name,$user_name,$Enc_PW,$Salt,$Level,'1');
								$RID = $Display->Execute($sql,$Execute_Array,'1','users');
								$Action_Time = date('Y-m-d G:i:s');
								$Display->create_log($RID,'users','1',$Action_Time,$OID,'New user created');
							}
					}
			}
		public function show_members_form()
			{
				$Display = new sql();
				$Level = $_POST['ID'];
				if($Level == '2')
				{
				$this->registry->template->Level = $Level;
				if(isset($_SESSION['Arabic']))
					{
						$Table = 'ads_cat';
						$Table_Country = 'country';
						$Table_Services = 'ads_sub_cat';
					}
				else
					{
						$Table = 'ads_cat_english';
						$Table_Country = 'country_english';
						$Table_Services = 'ads_sub_cat_english';
					}
				$sql = 'SELECT ID,Cat_Name FROM '.$Table.' WHERE Status = ?';
				$Execute_Array = array('1');
				$this->registry->template->results = $Display->Display_Info($sql,$Execute_Array);
				$sql = 'SELECT ID,Name FROM '.$Table_Country.' WHERE Status = ?';
				$this->registry->template->results_country = $Display->Display_Info($sql,$Execute_Array);
				$sql = 'SELECT ID,Sub_Cat_Name FROM '.$Table_Services.' WHERE Status = ?';
				$this->registry->template->results_services = $Display->Display_Info($sql,$Execute_Array);
				$this->registry->template->show('sales/show_members_form');
				}
			}
		public function verify_type()
			{
				$Display = new sql();
				$Table = 'user_level';
				$sql = 'SELECT ID,Level FROM '.$Table.' WHERE Status = ? AND ID = ?';
				$Execute_Array = array('1','2');
				$this->registry->template->results = $Display->Display_Info($sql,$Execute_Array);
				$this->registry->template->show('sales/verify_type');
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
