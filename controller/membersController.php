 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
$Allowed_Users = array('1');
validate_roles_new::validate($Allowed_Users);
class membersController extends baseController {
			
		public function index() 
			{
				
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
		public function edit_pw()
			{
				$URL = new url();
				$ID = $URL->getPar('Member');
				$this->registry->template->ID = $ID;
				$this->registry->template->show('members/edit_pw');
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
				$this->edit_member();
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
		public function edit_member_level()
			{
				$Display = new sql();
				$OID = $_SESSION['User_ID'];
				$Level = $_POST['Level'];
				$Level_Array = explode('|||',$Level);
				$Level = $Level_Array[0];
				$ID = $Level_Array[1];
				$sql = 'UPDATE users SET Level = ? WHERE ID = ?';
				$Execute_Array = array($Level,$ID);
				$Display->Execute($sql,$Execute_Array);
				$Action_Time = date('Y-m-d G:i:s');
				$Display->create_log($ID,'users','2',$Action_Time,$OID,'Edited user level');
				$this->edit_member();
			}
		public function edit_member()
			{
				$Display = new sql();
				$sql = 'SELECT * FROM users WHERE Status = ?';
				$Execute_Array = array('1');
				$pagenum  = @$_POST['Page'];
				$paginate = new paginate('users','10',$pagenum,$sql,$Execute_Array);
				$Count = $paginate->Records('users');
				$this->registry->template->Page = $pagenum;
				$this->registry->template->Count = $Count;
				$this->registry->template->Last = $paginate->Calculate_Last($Count);
				$results = $paginate->Paginate();
				$this->registry->template->results = $results;
				$sql = 'SELECT ID,Level FROM user_level WHERE Status = ?';
				$Execute_Array = array('1');
				$this->registry->template->results_level = $Display->Display_Info($sql,$Execute_Array);
				$this->registry->template->show('members/edit_member');
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
				$Counter = 0;
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
						elseif(strlen($password) < 6)
							{
								$myTweets = array("flag" => '17');
								$Display->Write_JSON($Time_Stamp,$myTweets);
							}
						elseif($password != $password_2)
							{
								$myTweets = array("flag" => '18');
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
								if($Amount != NULL)
									{
										$sql = 'INSERT INTO merchant_accounts (MID,Amount,Status) VALUES (?,?,?)';
										$Execute_Array = array($RID,$Amount,'1');
										$RID_3 = $Display->Execute($sql,$Execute_Array,'1','merchant_accounts');
										$Display->create_log($RID_3,'merchant_accounts','1',$Action_Time,$OID,'New amount added');
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
						elseif(!$Validate_Email)
							{
								$myTweets = array("flag" => '13');
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
						elseif($Country == '0')
							{
								$myTweets = array("flag" => '12');
								$Display->Write_JSON($Time_Stamp,$myTweets);
							}
						else
							{
								$myTweets = array("flag" => '0');
								$Display->Write_JSON($Time_Stamp,$myTweets);
								$create_member = new create_member();
								$Salt = $create_member->getPasswordSalt();
								$Enc_PW = $create_member->getPasswordHash($Salt,$password);
								$sql = 'INSERT INTO users (First_Name,user_name,password,Salt,Level,Country,Status) VALUES (?,?,?,?,?,?,?)';
								$Execute_Array = array($First_Name,$user_name,$Enc_PW,$Salt,$Level,$Country,'1');
								$RID = $Display->Execute($sql,$Execute_Array,'1','users');
								$Action_Time = date('Y-m-d G:i:s');
								$Display->create_log($RID,'users','1',$Action_Time,$OID,'New user created');
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
								$sql = 'INSERT INTO users (First_Name,user_name,password,Salt,Level,Status) VALUES (?,?,?,?,?,?)';
								$Execute_Array = array($First_Name,$user_name,$Enc_PW,$Salt,$Level,'1');
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
				if($Level)
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
				$this->registry->template->show('members/show_members_form');
				}
			}
		public function verify_type()
			{
				$Display = new sql();
				$Table = 'user_level';
				$sql = 'SELECT ID,Level FROM '.$Table.' WHERE Status = ?';
				$Execute_Array = array('1');
				$this->registry->template->results = $Display->Display_Info($sql,$Execute_Array);
				$this->registry->template->show('members/verify_type');
			}
		public function add() 
			{
				if($_SESSION['User_level_Session'] == '1')
					{
						$this->registry->template->show('members/add_member');
					}
				else
					{
					?>
					<script language="javascript">
					window.location = '<?php echo __LINK_PATH;?>/';
					</script>
					<?
					}
			}
		public function submit()
			{
				$First_Name = $_POST['First_Name'];
				$Last_Name = $_POST['Last_Name'];
				$user_name = $_POST['user_name'];
				$password = $_POST['password'];
				$password_2 = $_POST['password_2'];
				//$mobile = $_POST['mobile'];
				$Level = $_POST['Level'];
				$Validate = new validate();
				$Validate->Validate_Empty($First_Name,'First_Name','عـلـيـك تعـبـئـة خـانـة الإسـم');
				$Validate->Validate_Empty($Last_Name,'Last_Name','عـلـيـك تعـبـئـة خـانـة إسـم الـعـائـلــة');
				$Validate->Validate_Empty($user_name,'user_name','عـلـيـك إختـيـار إسـم مسـتـخـدم');
				if($user_name != NULL)
					{
						$Validate->Validate_Email($user_name,'user_name','الـبـريـد الإلكتـرونـي غـيـر صـحيـح');
						$Validate->Validate_Match($user_name,'user_name','الـبـريـد الإلكـترونـي مـحـجـوز');
					}
				$Validate->Validate_Empty($password,'password','عـليـك إخـتـيـار كلـمـة سـر');
				if($password != NULL)
					{
						$Validate->Validate_Len($password,'password','كلـمـة الـسر يجـب أن تكـون أكثـر مـن خمسـة حروف','6');
					}
				$Validate->Validate_Empty($password_2,'password_2','الـرجـاء تأكيـد كـلـمـة الـسر');
				if($password_2 != NULL)
					{
						$Validate->Validate_Compare($password_2,'password_2','كلـمـات الـسر غيـر متطايقـة',$password);
					}
				
				
				$Validate->Validate_NoneZero($Level,'Level','عـلـيـك إخـتيـار إسـم الـصلاحـيـة');
				if(count($_SESSION['Errors']))
					{
					$_SESSION['First_Name'] = $First_Name;
					$_SESSION['Last_Name'] = $Last_Name;
					$_SESSION['user_name'] = $user_name;
					$_SESSION['password'] = $password;
					$_SESSION['password_2'] = $password_2;
					//$_SESSION['mobile'] = $mobile;
					$_SESSION['Level'] = $Level;
					?>
					<script language="javascript">
					window.location = '<?php echo __LINK_PATH;?>members/add/s/';
					</script>
					<?
					}
				else
					{
						$create_member = new create_member();
						$Salt = $create_member->getPasswordSalt();
						$Enc_PW = $create_member->getPasswordHash($Salt,$password);
						$Status = '1';
						$Execute = new sql();
						$Execute_Array = (array(':First_Name'=>$First_Name,':Last_Name'=>$Last_Name,':user_name'=>$user_name,':password'=>$Enc_PW,':Level'=>$Level,':Salt'=>$Salt,':Status'=>$Status));
						$sql = "INSERT INTO users (First_Name,Last_Name,user_name,password,Level,Salt,Status) VALUES (:First_Name,:Last_Name,:user_name,:password,:Level,:Salt,:Status)";
						$Execute->Execute($sql,$Execute_Array);
						?>
						<script language="javascript">
						window.location = '<?php echo __LINK_PATH;?>members/add/v/';
						</script>
						<?
					}
			}
		public function edit()
			{
				$URL = new url();
				$pagenum  = $URL->getPar('Page');
				
				switch($_SESSION['User_level_Session'])
					{
						case '1':
						$sql = 'SELECT ID,First_Name,Last_Name,Level FROM users WHERE Status = ?';
						$Execute_Array = array('1');
						break;
						
						case '2':
						$My_ID = $_SESSION['User_ID'];
						$sql = 'SELECT ID,First_Name,Last_Name,Level FROM users WHERE Status = ? AND ID = ?';
						$Execute_Array = array('1',$My_ID);
						break;
						
						default:
						$My_ID = $_SESSION['User_ID'];
						$sql = 'SELECT ID,First_Name,Last_Name,Level FROM users WHERE Status = ? AND ID = ?';
						$Execute_Array = array('1',$My_ID);
					}
				
				$paginate = new paginate('users','10',$pagenum,$sql,$Execute_Array);
				$Count = $paginate->Records('users');
				$this->registry->template->Page = $pagenum;
				$this->registry->template->Count = $Count;
				$this->registry->template->Last = $paginate->Calculate_Last($Count);
				$result = $paginate->Paginate();
				$this->registry->template->results = $result;
				if($result)
					{
						$this->registry->template->show('members/edit_member');
						$this->registry->template->show('members/edit_member_paginate_footer');
					}
				else
					{
					?>
					<div align="right" class="Errors">لا يــوجـد عـنـدك مـستـخـدمـيـن</div>
					<?php
					}
			} 
		public function show_edit_selected()
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
				$this->registry->template->show('members/show_edit_selected');
			}
		public function edit_selected()
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
				$this->registry->template->show('members/edit_selected');
			}
		function submit_edit()
			{
				$Hidden_ID = $_POST['Hidden_ID'];
				$First_Name = $_POST['First_Name'];
				$Last_Name = $_POST['Last_Name'];
				$user_name = $_POST['user_name'];
				$password = $_POST['password'];
				$password_2 = $_POST['password_2'];
				//$mobile = $_POST['mobile'];
				$Level = $_POST['Level'];
				$Validate = new validate();
				$Validate->Validate_Empty($First_Name,'First_Name','عـلـيـك تعـبـئـة خـانـة الإسـم');
				$Validate->Validate_Empty($Last_Name,'Last_Name','عـلـيـك تعـبـئـة خـانـة إسـم الـعـائـلــة');
				$Validate->Validate_Empty($user_name,'user_name','عـلـيـك إختـيـار إسـم مسـتـخـدم');
				if($user_name != NULL)
					{
						$Validate->Validate_Email($user_name,'user_name','الـبـريـد الإلكتـرونـي غـيـر صـحيـح');
						$Validate->Validate_Match_Edit($user_name,'user_name',$Hidden_ID,'الـبـريـد الإلكـترونـي مـحـجـوز');
					}
				if($password != NULL)
					{
						$Validate->Validate_Len($password,'password','كلـمـة الـسر يجـب أن تكـون أكثـر مـن خمسـة حروف','6');
						$Validate->Validate_Compare($password_2,'password_2','كلـمـات الـسر غيـر متطايقـة',$password);
					}
				//$Validate->Validate_Empty($mobile,'mobile','الـرجـاء إدخـال رقـم الـمـوبايـل');
				/*if($mobile != NULL)
					{
						$Validate->Validate_Number($mobile,'mobile','رقـم الـمـوبايـل يجب أن يحتوي على أرقام فقط');
					}*/
				
				$Validate->Validate_NoneZero($Level,'Level','عـلـيـك إخـتيـار إسـم الـصلاحـيـة');
				if(count($_SESSION['Errors']))
					{
					?>
					<script language="javascript">
					window.location = '<?php echo __LINK_PATH;?>members/edit_selected/s/Member/<?php echo $Hidden_ID;?>';
					</script>
					<?
					}
				else
					{
						$create_member = new create_member();
						$b_date = date('Y-m-d');
						if($password != NULL)
							{
								$Salt = $create_member->getPasswordSalt();
								$Enc_PW = $create_member->getPasswordHash($Salt,$password);
								$create_member->Edit($First_Name,$Last_Name,$user_name,$Enc_PW,$b_date,$Level,$Salt,$Hidden_ID);
								
							}
						else
							{
								$create_member->Edit($First_Name,$Last_Name,$user_name,'',$b_date,$Level,'',$Hidden_ID);
								
							}
						
						
							
					?>
					<script language="javascript">
					window.location = '<?php echo __LINK_PATH;?>members/edit/v/';
					</script>
					<?
					}
			}
		function delete_selected()
			{
				if($_SESSION['User_level_Session'] == '1')
					{
						$URL = new url();
						$Member_ID  = $URL->getPar('Member');
						$create_member = new create_member();
						$create_member->Delete_Member($Member_ID);
						
						?>
						<script language="javascript">
						window.location = '<?php echo __LINK_PATH;?>members/edit/v/';
						</script>
						<?
					}
				else
					{
					?>
					<script language="javascript">
					window.location = '<?php echo __LINK_PATH;?>/members/edit/';
					</script>
					<?
					}
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
		window.location = '<?php echo __LINK_PATH;?>';
		</script>
		<?
	}
}

?>
