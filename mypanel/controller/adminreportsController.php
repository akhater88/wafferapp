 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
$Allowed_Users = array('1');
validate_roles_new::validate($Allowed_Users);
class adminreportsController extends baseController {
			
		public function index() 
			{
				
			}
		public function display_sales_report()
			{
				$Display = new sql();
				$Starts_Date = @$_POST['Starts_Date'];
				$End_Date = @$_POST['End_Date'];
				$Country = $_POST['Country'];
				$Sales_ID = $_POST['Sales_ID'];
				$MID = $_POST['MID'];
				$Cat_ID = $_POST['Cat_ID'];
				$Sub_Cat_ID = $_POST['Sub_Cat_ID'];
				$Time_Stamp = $_POST['Time_Stamp'];
				
				$this->registry->template->Starts_Date = $Starts_Date;
				$this->registry->template->End_Date = $End_Date;
				$this->registry->template->Country = $Country;
				$this->registry->template->Sales_ID = $Sales_ID;
				$this->registry->template->MID = $MID;
				$this->registry->template->Cat_ID = $Cat_ID;
				$this->registry->template->Sub_Cat_ID = $Sub_Cat_ID;
				$this->registry->template->Time_Stamp = $Time_Stamp;
				
				if(!$Country)
					{
						$myTweets = array("flag" => '1');
						$Display->Write_JSON($Time_Stamp,$myTweets);
					}
				elseif(!$Sales_ID)
					{
						$myTweets = array("flag" => '2');
						$Display->Write_JSON($Time_Stamp,$myTweets);
					}
				elseif(!$MID)
					{
						$myTweets = array("flag" => '3');
						$Display->Write_JSON($Time_Stamp,$myTweets);
					}
				elseif(!$Cat_ID)
					{
						$myTweets = array("flag" => '4');
						$Display->Write_JSON($Time_Stamp,$myTweets);
					}
				elseif(!$Sub_Cat_ID)
					{
						$myTweets = array("flag" => '5');
						$Display->Write_JSON($Time_Stamp,$myTweets);
					}
				else
					{
						$myTweets = array("flag" => '0');
						$Display->Write_JSON($Time_Stamp,$myTweets);
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
						if(($Starts_Date == NULL) || ($End_Date == NULL))
							{
								if(($Country == '999')&&($Sales_ID == '999')&&($MID == '999')&&($Cat_ID == '999'))
									{
										$MID_Array = array();
										$Sender_Name_Array = array();
										$Country_Name_Array = array();
										$Amount_Array = array();
										$Log_Creator = array();
										if($Sub_Cat_ID == '999')
											{
												$sql = 'SELECT ID,Sender_Name,Country FROM users WHERE Status = ? AND Level = ?';
												$Execute_Array = array('1','2');
												$results = $Display->Display_Info($sql,$Execute_Array);
												foreach($results as $rows)
													{
														$sql_country = 'SELECT Name FROM '.$Table.' WHERE ID = ?';
														$Execute_Country = array($rows->Country);
														$Country_Name = $Display->Display_Single_Info_Modified($sql_country,'Name',$Execute_Country);
														$Country_Name_Array[] = $Country_Name;
														
														$sql_account = 'SELECT Amount FROM merchant_accounts WHERE MID = ? AND Status = ?';
														$Execute_Account = array($rows->ID,'1');
														$Amount = $Display->Display_Single_Info_Modified($sql_account,'Amount',$Execute_Account);
														$Amount_Array[] = sprintf('%.2f',$Amount);
														
														$sql_log = 'SELECT OID FROM logs WHERE Table_Name = ? AND Action = ? AND RID = ?';
														$Execute_log = array('users','1',$rows->ID);
														$OID = $Display->Display_Single_Info_Modified($sql_log,'OID',$Execute_log);
														
														$sql_oid = 'SELECT First_Name FROM users WHERE ID = ?';
														$Execute_oid = array($OID);
														$Creator_First_Name = $Display->Display_Single_Info_Modified($sql_oid,'First_Name',$Execute_oid);
														
														$Log_Creator[] = $Creator_First_Name;
														$MID_Array[] = $rows->ID;
														$Sender_Name_Array[] = $rows->Sender_Name;
														
													}
											}
										else
											{
												$sql_offer = 'SELECT AID FROM '.$Table_Offers.' WHERE Status = ? AND Ads_Sub_Cat = ?';
												$Execute_Offers = array('1',$Sub_Cat_ID);
												$results_offers = $Display->Display_Info($sql_offer,$Execute_Offers);
												$AID_Array = array();
												foreach($results_offers as $rows_offers)
													{
														$AID_Array[] = $rows_offers->AID;
													}
												$sql = 'SELECT ID,Sender_Name,Country FROM users WHERE Status = ? AND Level = ?';
												$Execute_Array = array('1','2');
												$results = $Display->Display_Info($sql,$Execute_Array);
												foreach($results as $rows)
													{
														
														if(in_array($rows->ID,$AID_Array))
																	{
																		
																		$sql_country = 'SELECT Name FROM '.$Table.' WHERE ID = ?';
																		$Execute_Country = array($rows->Country);
																		$Country_Name = $Display->Display_Single_Info_Modified($sql_country,'Name',$Execute_Country);
																		$Country_Name_Array[] = $Country_Name;
																		
																		$sql_account = 'SELECT Amount FROM merchant_accounts WHERE MID = ? AND Status = ?';
																		$Execute_Account = array($rows->ID,'1');
																		$Amount = $Display->Display_Single_Info_Modified($sql_account,'Amount',$Execute_Account);
																		$Amount_Array[] = sprintf('%.2f',$Amount);
																		
																		$sql_log = 'SELECT OID FROM logs WHERE Table_Name = ? AND Action = ? AND RID = ?';
																		$Execute_log = array('users','1',$rows->ID);
																		$OID = $Display->Display_Single_Info_Modified($sql_log,'OID',$Execute_log);
																		
																		$sql_oid = 'SELECT First_Name FROM users WHERE ID = ?';
																		$Execute_oid = array($OID);
																		$Creator_First_Name = $Display->Display_Single_Info_Modified($sql_oid,'First_Name',$Execute_oid);
																		
																		$Log_Creator[] = $Creator_First_Name;
																		$MID_Array[] = $rows->ID;
																		$Sender_Name_Array[] = $rows->Sender_Name;
																	}
															}
											}
										
										$this->registry->template->MID_Array = $MID_Array;
										$this->registry->template->Sender_Name_Array = $Sender_Name_Array;
										$this->registry->template->Country_Name_Array = $Country_Name_Array;
										$this->registry->template->Amount_Array = $Amount_Array;
										$this->registry->template->Log_Creator = $Log_Creator;
									}
								elseif(($Country != '999')&&($Sales_ID == '999')&&($MID == '999')&&($Cat_ID == '999'))
									{
										$MID_Array = array();
										$Sender_Name_Array = array();
										$Country_Name_Array = array();
										$Amount_Array = array();
										$Log_Creator = array();
										if($Sub_Cat_ID == '999')
											{
												$sql = 'SELECT ID,Sender_Name,Country FROM users WHERE Status = ? AND Level = ? AND Country = ?';
												$Execute_Array = array('1','2',$Country);
												$results = $Display->Display_Info($sql,$Execute_Array);
												foreach($results as $rows)
													{
														$sql_country = 'SELECT Name FROM '.$Table.' WHERE ID = ?';
														$Execute_Country = array($rows->Country);
														$Country_Name = $Display->Display_Single_Info_Modified($sql_country,'Name',$Execute_Country);
														$Country_Name_Array[] = $Country_Name;
														
														$sql_account = 'SELECT Amount FROM merchant_accounts WHERE MID = ? AND Status = ?';
														$Execute_Account = array($rows->ID,'1');
														$Amount = $Display->Display_Single_Info_Modified($sql_account,'Amount',$Execute_Account);
														$Amount_Array[] = sprintf('%.2f',$Amount);
														
														$sql_log = 'SELECT OID FROM logs WHERE Table_Name = ? AND Action = ? AND RID = ? ';
														$Execute_log = array('users','1',$rows->ID);
														$OID = $Display->Display_Single_Info_Modified($sql_log,'OID',$Execute_log);
														
														$sql_oid = 'SELECT First_Name FROM users WHERE ID = ?';
														$Execute_oid = array($OID);
														$Creator_First_Name = $Display->Display_Single_Info_Modified($sql_oid,'First_Name',$Execute_oid);
														
														$Log_Creator[] = $Creator_First_Name;
														$MID_Array[] = $rows->ID;
														$Sender_Name_Array[] = $rows->Sender_Name;
													}
											}
										else
											{
												$sql_offer = 'SELECT AID FROM '.$Table_Offers.' WHERE Status = ? AND Ads_Sub_Cat = ?';
												$Execute_Offers = array('1',$Sub_Cat_ID);
												$results_offers = $Display->Display_Info($sql_offer,$Execute_Offers);
												$AID_Array = array();
												foreach($results_offers as $rows_offers)
													{
														$AID_Array[] = $rows_offers->AID;
													}
													$sql = 'SELECT ID,Sender_Name,Country FROM users WHERE Status = ? AND Level = ? AND Country = ?';
													$Execute_Array = array('1','2',$Country);
													$results = $Display->Display_Info($sql,$Execute_Array);
													foreach($results as $rows)
														{
															
															if(in_array($rows->ID,$AID_Array))
																{
																	$sql_country = 'SELECT Name FROM '.$Table.' WHERE ID = ?';
																	$Execute_Country = array($rows->Country);
																	$Country_Name = $Display->Display_Single_Info_Modified($sql_country,'Name',$Execute_Country);
																	$Country_Name_Array[] = $Country_Name;
																	
																	$sql_account = 'SELECT Amount FROM merchant_accounts WHERE MID = ? AND Status = ?';
																	$Execute_Account = array($rows->ID,'1');
																	$Amount = $Display->Display_Single_Info_Modified($sql_account,'Amount',$Execute_Account);
																	$Amount_Array[] = sprintf('%.2f',$Amount);
																	
																	$sql_log = 'SELECT OID FROM logs WHERE Table_Name = ? AND Action = ? AND RID = ? ';
																	$Execute_log = array('users','1',$rows->ID);
																	$OID = $Display->Display_Single_Info_Modified($sql_log,'OID',$Execute_log);
																	
																	$sql_oid = 'SELECT First_Name FROM users WHERE ID = ?';
																	$Execute_oid = array($OID);
																	$Creator_First_Name = $Display->Display_Single_Info_Modified($sql_oid,'First_Name',$Execute_oid);
																	
																	$Log_Creator[] = $Creator_First_Name;
																	$MID_Array[] = $rows->ID;
																	$Sender_Name_Array[] = $rows->Sender_Name;
																}
														}
											}
										
										$this->registry->template->MID_Array = $MID_Array;
										$this->registry->template->Sender_Name_Array = $Sender_Name_Array;
										$this->registry->template->Country_Name_Array = $Country_Name_Array;
										$this->registry->template->Amount_Array = $Amount_Array;
										$this->registry->template->Log_Creator = $Log_Creator;
									}
								elseif(($Country == '999')&&($Sales_ID != '999')&&($MID == '999')&&($Cat_ID == '999'))
									{
										$MID_Array = array();
										$Sender_Name_Array = array();
										$MID_Array_Non_Filtered = array();
										$Country_Name_Array = array();
										$Amount_Array = array();
										$Log_Creator = array();
										if($Sub_Cat_ID == '999')
											{
												$sql = 'SELECT RID FROM logs WHERE Table_Name = ? AND Action = ? AND OID = ?';
												$Execute_Array = array('users','1',$Sales_ID);
												$results = $Display->Display_Info($sql,$Execute_Array);
												foreach($results as $rows)
													{
														$MID_Array_Non_Filtered[] = $rows->RID;
													}
												$sql_users = 'SELECT ID,Sender_Name,Country FROM users WHERE Status = ? AND Level = ?';
												$Execute_Array = array('1','2');
												$results = $Display->Display_Info($sql_users,$Execute_Array);
												foreach($results as $rows)
													{
														if(in_array($rows->ID,$MID_Array_Non_Filtered))
															{
																$sql_country = 'SELECT Name FROM '.$Table.' WHERE ID = ?';
																$Execute_Country = array($rows->Country);
																$Country_Name = $Display->Display_Single_Info_Modified($sql_country,'Name',$Execute_Country);
																$Country_Name_Array[] = $Country_Name;
																
																$sql_account = 'SELECT Amount FROM merchant_accounts WHERE MID = ? AND Status = ?';
																$Execute_Account = array($rows->ID,'1');
																$Amount = $Display->Display_Single_Info_Modified($sql_account,'Amount',$Execute_Account);
																$Amount_Array[] = sprintf('%.2f',$Amount);
																
																$sql_log = 'SELECT OID FROM logs WHERE Table_Name = ? AND Action = ? AND RID = ? ';
																$Execute_log = array('users','1',$rows->ID);
																$OID = $Display->Display_Single_Info_Modified($sql_log,'OID',$Execute_log);
																
																$sql_oid = 'SELECT First_Name FROM users WHERE ID = ?';
																$Execute_oid = array($OID);
																$Creator_First_Name = $Display->Display_Single_Info_Modified($sql_oid,'First_Name',$Execute_oid);
																
																$Log_Creator[] = $Creator_First_Name;
																$MID_Array[] = $rows->ID;
																$Sender_Name_Array[] = $rows->Sender_Name;
															} 
													}
											}
										else
											{
												$sql_offer = 'SELECT AID FROM '.$Table_Offers.' WHERE Status = ? AND Ads_Sub_Cat = ?';
												$Execute_Offers = array('1',$Sub_Cat_ID);
												$results_offers = $Display->Display_Info($sql_offer,$Execute_Offers);
												$AID_Array = array();
												foreach($results_offers as $rows_offers)
													{
														$AID_Array[] = $rows_offers->AID;
													}
												$sql = 'SELECT RID FROM logs WHERE Table_Name = ? AND Action = ? AND OID = ?';
												$Execute_Array = array('users','1',$Sales_ID);
												$results = $Display->Display_Info($sql,$Execute_Array);
												foreach($results as $rows)
													{
														$MID_Array_Non_Filtered[] = $rows->RID;
													}
												$sql_users = 'SELECT ID,Sender_Name,Country FROM users WHERE Status = ? AND Level = ?';
												$Execute_Array = array('1','2');
												$results = $Display->Display_Info($sql_users,$Execute_Array);
												foreach($results as $rows)
													{
														if(in_array($rows->ID,$MID_Array_Non_Filtered))
															{
																if(in_array($rows->ID,$AID_Array))
																	{
																		$sql_country = 'SELECT Name FROM '.$Table.' WHERE ID = ?';
																		$Execute_Country = array($rows->Country);
																		$Country_Name = $Display->Display_Single_Info_Modified($sql_country,'Name',$Execute_Country);
																		$Country_Name_Array[] = $Country_Name;
																		
																		$sql_account = 'SELECT Amount FROM merchant_accounts WHERE MID = ? AND Status = ?';
																		$Execute_Account = array($rows->ID,'1');
																		$Amount = $Display->Display_Single_Info_Modified($sql_account,'Amount',$Execute_Account);
																		$Amount_Array[] = sprintf('%.2f',$Amount);
																		
																		$sql_log = 'SELECT OID FROM logs WHERE Table_Name = ? AND Action = ? AND RID = ? ';
																		$Execute_log = array('users','1',$rows->ID);
																		$OID = $Display->Display_Single_Info_Modified($sql_log,'OID',$Execute_log);
																		
																		$sql_oid = 'SELECT First_Name FROM users WHERE ID = ?';
																		$Execute_oid = array($OID);
																		$Creator_First_Name = $Display->Display_Single_Info_Modified($sql_oid,'First_Name',$Execute_oid);
																		
																		$Log_Creator[] = $Creator_First_Name;
																		$MID_Array[] = $rows->ID;
																		$Sender_Name_Array[] = $rows->Sender_Name;
																	}
															} 
													}
											}
										
										$this->registry->template->MID_Array = $MID_Array;
										$this->registry->template->Sender_Name_Array = $Sender_Name_Array;
										$this->registry->template->Country_Name_Array = $Country_Name_Array;
										$this->registry->template->Amount_Array = $Amount_Array;
										$this->registry->template->Log_Creator = $Log_Creator;
									}
								elseif(($Country != '999')&&($Sales_ID != '999')&&($MID == '999')&&($Cat_ID == '999'))
									{
										$MID_Array_Non_Filtered = array();
										$MID_Array = array();
										$Sender_Name_Array = array();
										$Country_Name_Array = array();
										$Amount_Array = array();
										$Log_Creator = array();
										if($Sub_Cat_ID == '999')
											{
												$sql = 'SELECT RID FROM logs WHERE Table_Name = ? AND Action = ? AND OID = ?';
												$Execute_Array = array('users','1',$Sales_ID);
												$results = $Display->Display_Info($sql,$Execute_Array);
												foreach($results as $rows)
													{
														$MID_Array_Non_Filtered[] = $rows->RID;
													}
												$sql_users = 'SELECT ID,Sender_Name,Country FROM users WHERE Status = ? AND Level = ? AND Country = ?';
												$Execute_Array = array('1','2',$Country);
												$results = $Display->Display_Info($sql_users,$Execute_Array);
												foreach($results as $rows)
													{
														if(in_array($rows->ID,$MID_Array_Non_Filtered))
															{
																$sql_country = 'SELECT Name FROM '.$Table.' WHERE ID = ?';
																$Execute_Country = array($rows->Country);
																$Country_Name = $Display->Display_Single_Info_Modified($sql_country,'Name',$Execute_Country);
																$Country_Name_Array[] = $Country_Name;
																
																$sql_account = 'SELECT Amount FROM merchant_accounts WHERE MID = ? AND Status = ?';
																$Execute_Account = array($rows->ID,'1');
																$Amount = $Display->Display_Single_Info_Modified($sql_account,'Amount',$Execute_Account);
																$Amount_Array[] = sprintf('%.2f',$Amount);
																
																$sql_log = 'SELECT OID FROM logs WHERE Table_Name = ? AND Action = ? AND RID = ? ';
																$Execute_log = array('users','1',$rows->ID);
																$OID = $Display->Display_Single_Info_Modified($sql_log,'OID',$Execute_log);
																
																$sql_oid = 'SELECT First_Name FROM users WHERE ID = ?';
																$Execute_oid = array($OID);
																$Creator_First_Name = $Display->Display_Single_Info_Modified($sql_oid,'First_Name',$Execute_oid);
																
																$Log_Creator[] = $Creator_First_Name;
														
																$MID_Array[] = $rows->ID;
																$Sender_Name_Array[] = $rows->Sender_Name;
															} 
													}
											}
										else
											{
												$sql_offer = 'SELECT AID FROM '.$Table_Offers.' WHERE Status = ? AND Ads_Sub_Cat = ?';
												$Execute_Offers = array('1',$Sub_Cat_ID);
												$results_offers = $Display->Display_Info($sql_offer,$Execute_Offers);
												$AID_Array = array();
												foreach($results_offers as $rows_offers)
													{
														$AID_Array[] = $rows_offers->AID;
													}
												$sql = 'SELECT RID FROM logs WHERE Table_Name = ? AND Action = ? AND OID = ?';
												$Execute_Array = array('users','1',$Sales_ID);
												$results = $Display->Display_Info($sql,$Execute_Array);
												foreach($results as $rows)
													{
														$MID_Array_Non_Filtered[] = $rows->RID;
													}
												$sql_users = 'SELECT ID,Sender_Name,Country FROM users WHERE Status = ? AND Level = ? AND Country = ?';
												$Execute_Array = array('1','2',$Country);
												$results = $Display->Display_Info($sql_users,$Execute_Array);
												foreach($results as $rows)
													{
														if(in_array($rows->ID,$MID_Array_Non_Filtered))
															{
																if(in_array($rows->ID,$AID_Array))
																	{
																		$sql_country = 'SELECT Name FROM '.$Table.' WHERE ID = ?';
																		$Execute_Country = array($rows->Country);
																		$Country_Name = $Display->Display_Single_Info_Modified($sql_country,'Name',$Execute_Country);
																		$Country_Name_Array[] = $Country_Name;
																		
																		$sql_account = 'SELECT Amount FROM merchant_accounts WHERE MID = ? AND Status = ?';
																		$Execute_Account = array($rows->ID,'1');
																		$Amount = $Display->Display_Single_Info_Modified($sql_account,'Amount',$Execute_Account);
																		$Amount_Array[] = sprintf('%.2f',$Amount);
																		
																		$sql_log = 'SELECT OID FROM logs WHERE Table_Name = ? AND Action = ? AND RID = ? ';
																		$Execute_log = array('users','1',$rows->ID);
																		$OID = $Display->Display_Single_Info_Modified($sql_log,'OID',$Execute_log);
																		
																		$sql_oid = 'SELECT First_Name FROM users WHERE ID = ?';
																		$Execute_oid = array($OID);
																		$Creator_First_Name = $Display->Display_Single_Info_Modified($sql_oid,'First_Name',$Execute_oid);
																		
																		$Log_Creator[] = $Creator_First_Name;
																
																		$MID_Array[] = $rows->ID;
																		$Sender_Name_Array[] = $rows->Sender_Name;
																	}
															} 
													}
											}
										
										$this->registry->template->MID_Array = $MID_Array;
										$this->registry->template->Sender_Name_Array = $Sender_Name_Array;
										$this->registry->template->Country_Name_Array = $Country_Name_Array;
										$this->registry->template->Amount_Array = $Amount_Array;
										$this->registry->template->Log_Creator = $Log_Creator;
									}
								elseif(($Country == '999')&&($Sales_ID == '999')&&($MID != '999')&&($Cat_ID == '999'))
									{
										$MID_Array = array();
										$Sender_Name_Array = array();
										$Country_Name_Array = array();
										$Amount_Array = array();
										$Log_Creator = array();
										if($Sub_Cat_ID == '999')
											{
												$sql = 'SELECT Sender_Name,Country FROM users WHERE ID = ?';
												$Execute_Array = array($MID);
												$results = $Display->Display_Info($sql,$Execute_Array);
												foreach($results as $rows)
													{
														$sql_country = 'SELECT Name FROM '.$Table.' WHERE ID = ?';
														$Execute_Country = array($rows->Country);
														$Country_Name = $Display->Display_Single_Info_Modified($sql_country,'Name',$Execute_Country);
														$Country_Name_Array[] = $Country_Name;
														
														$sql_account = 'SELECT Amount FROM merchant_accounts WHERE MID = ? AND Status = ?';
														$Execute_Account = array($MID,'1');
														$Amount = $Display->Display_Single_Info_Modified($sql_account,'Amount',$Execute_Account);
														$Amount_Array[] = sprintf('%.2f',$Amount);
														
														$sql_log = 'SELECT OID FROM logs WHERE Table_Name = ? AND Action = ? AND RID = ?';
														$Execute_log = array('users','1',$MID);
														$OID = $Display->Display_Single_Info_Modified($sql_log,'OID',$Execute_log);
														
														$sql_oid = 'SELECT First_Name FROM users WHERE ID = ?';
														$Execute_oid = array($OID);
														$Creator_First_Name = $Display->Display_Single_Info_Modified($sql_oid,'First_Name',$Execute_oid);
														
														$Log_Creator[] = $Creator_First_Name;
														
														$MID_Array[] = $MID;
														$Sender_Name_Array[] = $rows->Sender_Name;
													}
											}
										else
											{
												$sql_offer = 'SELECT AID FROM '.$Table_Offers.' WHERE Status = ? AND Ads_Sub_Cat = ?';
												$Execute_Offers = array('1',$Sub_Cat_ID);
												$results_offers = $Display->Display_Info($sql_offer,$Execute_Offers);
												$AID_Array = array();
												foreach($results_offers as $rows_offers)
													{
														$AID_Array[] = $rows_offers->AID;
													}
												$sql = 'SELECT Sender_Name,Country FROM users WHERE ID = ?';
												$Execute_Array = array($MID);
												$results = $Display->Display_Info($sql,$Execute_Array);
												foreach($results as $rows)
													{
														if(in_array($MID,$AID_Array))
															{
																$sql_country = 'SELECT Name FROM '.$Table.' WHERE ID = ?';
																$Execute_Country = array($rows->Country);
																$Country_Name = $Display->Display_Single_Info_Modified($sql_country,'Name',$Execute_Country);
																$Country_Name_Array[] = $Country_Name;
																
																$sql_account = 'SELECT Amount FROM merchant_accounts WHERE MID = ? AND Status = ?';
																$Execute_Account = array($MID,'1');
																$Amount = $Display->Display_Single_Info_Modified($sql_account,'Amount',$Execute_Account);
																$Amount_Array[] = sprintf('%.2f',$Amount);
																
																$sql_log = 'SELECT OID FROM logs WHERE Table_Name = ? AND Action = ? AND RID = ?';
																$Execute_log = array('users','1',$MID);
																$OID = $Display->Display_Single_Info_Modified($sql_log,'OID',$Execute_log);
																
																$sql_oid = 'SELECT First_Name FROM users WHERE ID = ?';
																$Execute_oid = array($OID);
																$Creator_First_Name = $Display->Display_Single_Info_Modified($sql_oid,'First_Name',$Execute_oid);
																
																$Log_Creator[] = $Creator_First_Name;
																
																$MID_Array[] = $MID;
																$Sender_Name_Array[] = $rows->Sender_Name;
															}
													}
											}
										
										$this->registry->template->MID_Array = $MID_Array;
										$this->registry->template->Sender_Name_Array = $Sender_Name_Array;
										$this->registry->template->Country_Name_Array = $Country_Name_Array;
										$this->registry->template->Amount_Array = $Amount_Array;
										$this->registry->template->Log_Creator = $Log_Creator;
									}
								elseif(($Country != '999')&&($Sales_ID == '999')&&($MID != '999')&&($Cat_ID == '999'))
									{
										$MID_Array = array();
										$Sender_Name_Array = array();
										$Country_Name_Array = array();
										$Amount_Array = array();
										$Log_Creator = array();
										if($Sub_Cat_ID == '999')
											{
												$sql = 'SELECT Sender_Name,Country FROM users WHERE ID = ?';
												$Execute_Array = array($MID);
												$results = $Display->Display_Info($sql,$Execute_Array);
												foreach($results as $rows)
													{
														$sql_country = 'SELECT Name FROM '.$Table.' WHERE ID = ?';
														$Execute_Country = array($rows->Country);
														$Country_Name = $Display->Display_Single_Info_Modified($sql_country,'Name',$Execute_Country);
														$Country_Name_Array[] = $Country_Name;
														
														$sql_account = 'SELECT Amount FROM merchant_accounts WHERE MID = ? AND Status = ?';
														$Execute_Account = array($MID,'1');
														$Amount = $Display->Display_Single_Info_Modified($sql_account,'Amount',$Execute_Account);
														$Amount_Array[] = sprintf('%.2f',$Amount);
														
														$sql_log = 'SELECT OID FROM logs WHERE Table_Name = ? AND Action = ? AND RID = ? ';
														$Execute_log = array('users','1',$MID);
														$OID = $Display->Display_Single_Info_Modified($sql_log,'OID',$Execute_log);
														
														$sql_oid = 'SELECT First_Name FROM users WHERE ID = ?';
														$Execute_oid = array($OID);
														$Creator_First_Name = $Display->Display_Single_Info_Modified($sql_oid,'First_Name',$Execute_oid);
														
														$Log_Creator[] = $Creator_First_Name;
														
														$MID_Array[] = $MID;
														$Sender_Name_Array[] = $rows->Sender_Name;
													}
											}
										else
											{
												$sql_offer = 'SELECT AID FROM '.$Table_Offers.' WHERE Status = ? AND Ads_Sub_Cat = ?';
												$Execute_Offers = array('1',$Sub_Cat_ID);
												$results_offers = $Display->Display_Info($sql_offer,$Execute_Offers);
												$AID_Array = array();
												foreach($results_offers as $rows_offers)
													{
														$AID_Array[] = $rows_offers->AID;
													}
												$sql = 'SELECT Sender_Name,Country FROM users WHERE ID = ?';
												$Execute_Array = array($MID);
												$results = $Display->Display_Info($sql,$Execute_Array);
												foreach($results as $rows)
													{
														
														if(in_array($MID,$AID_Array))
															{
																$sql_country = 'SELECT Name FROM '.$Table.' WHERE ID = ?';
																$Execute_Country = array($rows->Country);
																$Country_Name = $Display->Display_Single_Info_Modified($sql_country,'Name',$Execute_Country);
																$Country_Name_Array[] = $Country_Name;
																
																$sql_account = 'SELECT Amount FROM merchant_accounts WHERE MID = ? AND Status = ?';
																$Execute_Account = array($MID,'1');
																$Amount = $Display->Display_Single_Info_Modified($sql_account,'Amount',$Execute_Account);
																$Amount_Array[] = sprintf('%.2f',$Amount);
																
																$sql_log = 'SELECT OID FROM logs WHERE Table_Name = ? AND Action = ? AND RID = ? ';
																$Execute_log = array('users','1',$MID);
																$OID = $Display->Display_Single_Info_Modified($sql_log,'OID',$Execute_log);
																
																$sql_oid = 'SELECT First_Name FROM users WHERE ID = ?';
																$Execute_oid = array($OID);
																$Creator_First_Name = $Display->Display_Single_Info_Modified($sql_oid,'First_Name',$Execute_oid);
																
																$Log_Creator[] = $Creator_First_Name;
																
																$MID_Array[] = $MID;
																$Sender_Name_Array[] = $rows->Sender_Name;
															}
													}
											}
										
										$this->registry->template->MID_Array = $MID_Array;
										$this->registry->template->Sender_Name_Array = $Sender_Name_Array;
										$this->registry->template->Country_Name_Array = $Country_Name_Array;
										$this->registry->template->Amount_Array = $Amount_Array;
										$this->registry->template->Log_Creator = $Log_Creator;
									}
								elseif(($Country == '999')&&($Sales_ID != '999')&&($MID != '999')&&($Cat_ID == '999'))
									{
										$MID_Array = array();
										$Sender_Name_Array = array();
										$Country_Name_Array = array();
										$Amount_Array = array();
										$Log_Creator = array();
										if($Sub_Cat_ID == '999')
											{
												$sql = 'SELECT Sender_Name,Country FROM users WHERE ID = ?';
												$Execute_Array = array($MID);
												$results = $Display->Display_Info($sql,$Execute_Array);
												foreach($results as $rows)
													{
														$sql_country = 'SELECT Name FROM '.$Table.' WHERE ID = ?';
														$Execute_Country = array($rows->Country);
														$Country_Name = $Display->Display_Single_Info_Modified($sql_country,'Name',$Execute_Country);
														$Country_Name_Array[] = $Country_Name;
														
														$sql_account = 'SELECT Amount FROM merchant_accounts WHERE MID = ? AND Status = ?';
														$Execute_Account = array($MID,'1');
														$Amount = $Display->Display_Single_Info_Modified($sql_account,'Amount',$Execute_Account);
														$Amount_Array[] = sprintf('%.2f',$Amount);
														
														$sql_log = 'SELECT OID FROM logs WHERE Table_Name = ? AND Action = ? AND RID = ?';
														$Execute_log = array('users','1',$MID);
														$OID = $Display->Display_Single_Info_Modified($sql_log,'OID',$Execute_log);
														
														$sql_oid = 'SELECT First_Name FROM users WHERE ID = ?';
														$Execute_oid = array($OID);
														$Creator_First_Name = $Display->Display_Single_Info_Modified($sql_oid,'First_Name',$Execute_oid);
														
														$Log_Creator[] = $Creator_First_Name;
														$MID_Array[] = $MID;
														$Sender_Name_Array[] = $rows->Sender_Name;
													}
											}
										else
											{
												$sql_offer = 'SELECT AID FROM '.$Table_Offers.' WHERE Status = ? AND Ads_Sub_Cat = ?';
												$Execute_Offers = array('1',$Sub_Cat_ID);
												$results_offers = $Display->Display_Info($sql_offer,$Execute_Offers);
												$AID_Array = array();
												foreach($results_offers as $rows_offers)
													{
														$AID_Array[] = $rows_offers->AID;
													}
												$sql = 'SELECT Sender_Name,Country FROM users WHERE ID = ?';
												$Execute_Array = array($MID);
												$results = $Display->Display_Info($sql,$Execute_Array);
												foreach($results as $rows)
													{
														if(in_array($MID,$AID_Array))
															{
																$sql_country = 'SELECT Name FROM '.$Table.' WHERE ID = ?';
																$Execute_Country = array($rows->Country);
																$Country_Name = $Display->Display_Single_Info_Modified($sql_country,'Name',$Execute_Country);
																$Country_Name_Array[] = $Country_Name;
																
																$sql_account = 'SELECT Amount FROM merchant_accounts WHERE MID = ? AND Status = ?';
																$Execute_Account = array($MID,'1');
																$Amount = $Display->Display_Single_Info_Modified($sql_account,'Amount',$Execute_Account);
																$Amount_Array[] = sprintf('%.2f',$Amount);
																
																$sql_log = 'SELECT OID FROM logs WHERE Table_Name = ? AND Action = ? AND RID = ?';
																$Execute_log = array('users','1',$MID);
																$OID = $Display->Display_Single_Info_Modified($sql_log,'OID',$Execute_log);
																
																$sql_oid = 'SELECT First_Name FROM users WHERE ID = ?';
																$Execute_oid = array($OID);
																$Creator_First_Name = $Display->Display_Single_Info_Modified($sql_oid,'First_Name',$Execute_oid);
																
																$Log_Creator[] = $Creator_First_Name;
																$MID_Array[] = $MID;
																$Sender_Name_Array[] = $rows->Sender_Name;
															}
													}
											}
										
										$this->registry->template->MID_Array = $MID_Array;
										$this->registry->template->Sender_Name_Array = $Sender_Name_Array;
										$this->registry->template->Country_Name_Array = $Country_Name_Array;
										$this->registry->template->Amount_Array = $Amount_Array;
										$this->registry->template->Log_Creator = $Log_Creator;
									}
								elseif(($Country != '999')&&($Sales_ID != '999')&&($MID != '999')&&($Cat_ID == '999'))
									{
										$MID_Array = array();
										$Sender_Name_Array = array();
										$Country_Name_Array = array();
										$Amount_Array = array();
										$Log_Creator = array();
										if($Sub_Cat_ID == '999')
											{
												$sql = 'SELECT Sender_Name,Country FROM users WHERE ID = ?';
												$Execute_Array = array($MID);
												$results = $Display->Display_Info($sql,$Execute_Array);
												foreach($results as $rows)
													{
														$sql_country = 'SELECT Name FROM '.$Table.' WHERE ID = ?';
														$Execute_Country = array($rows->Country);
														$Country_Name = $Display->Display_Single_Info_Modified($sql_country,'Name',$Execute_Country);
														$Country_Name_Array[] = $Country_Name;
														
														$sql_account = 'SELECT Amount FROM merchant_accounts WHERE MID = ? AND Status = ?';
														$Execute_Account = array($MID,'1');
														$Amount = $Display->Display_Single_Info_Modified($sql_account,'Amount',$Execute_Account);
														$Amount_Array[] = sprintf('%.2f',$Amount);
														
														$sql_log = 'SELECT OID FROM logs WHERE Table_Name = ? AND Action = ? AND RID = ? ';
														$Execute_log = array('users','1',$MID);
														$OID = $Display->Display_Single_Info_Modified($sql_log,'OID',$Execute_log);
														
														$sql_oid = 'SELECT First_Name FROM users WHERE ID = ?';
														$Execute_oid = array($OID);
														$Creator_First_Name = $Display->Display_Single_Info_Modified($sql_oid,'First_Name',$Execute_oid);
														
														$Log_Creator[] = $Creator_First_Name;
														$MID_Array[] = $MID;
														$Sender_Name_Array[] = $rows->Sender_Name;
													}
											}
										else
											{
												$sql_offer = 'SELECT AID FROM '.$Table_Offers.' WHERE Status = ? AND Ads_Sub_Cat = ?';
												$Execute_Offers = array('1',$Sub_Cat_ID);
												$results_offers = $Display->Display_Info($sql_offer,$Execute_Offers);
												$AID_Array = array();
												foreach($results_offers as $rows_offers)
													{
														$AID_Array[] = $rows_offers->AID;
													}
												$sql = 'SELECT Sender_Name,Country FROM users WHERE ID = ?';
												$Execute_Array = array($MID);
												$results = $Display->Display_Info($sql,$Execute_Array);
												foreach($results as $rows)
													{
														
														if(in_array($MID,$AID_Array))
															{
																$sql_country = 'SELECT Name FROM '.$Table.' WHERE ID = ?';
																$Execute_Country = array($rows->Country);
																$Country_Name = $Display->Display_Single_Info_Modified($sql_country,'Name',$Execute_Country);
																$Country_Name_Array[] = $Country_Name;
																
																$sql_account = 'SELECT Amount FROM merchant_accounts WHERE MID = ? AND Status = ?';
																$Execute_Account = array($MID,'1');
																$Amount = $Display->Display_Single_Info_Modified($sql_account,'Amount',$Execute_Account);
																$Amount_Array[] = sprintf('%.2f',$Amount);
																
																$sql_log = 'SELECT OID FROM logs WHERE Table_Name = ? AND Action = ? AND RID = ? ';
																$Execute_log = array('users','1',$MID);
																$OID = $Display->Display_Single_Info_Modified($sql_log,'OID',$Execute_log);
																
																$sql_oid = 'SELECT First_Name FROM users WHERE ID = ?';
																$Execute_oid = array($OID);
																$Creator_First_Name = $Display->Display_Single_Info_Modified($sql_oid,'First_Name',$Execute_oid);
																
																$Log_Creator[] = $Creator_First_Name;
																$MID_Array[] = $MID;
																$Sender_Name_Array[] = $rows->Sender_Name;
															}
													}
											}
										
										$this->registry->template->MID_Array = $MID_Array;
										$this->registry->template->Sender_Name_Array = $Sender_Name_Array;
										$this->registry->template->Country_Name_Array = $Country_Name_Array;
										$this->registry->template->Amount_Array = $Amount_Array;
										$this->registry->template->Log_Creator = $Log_Creator;
									}
								elseif(($Country == '999')&&($Sales_ID == '999')&&($MID == '999')&&($Cat_ID != '999'))
									{
										$MID_Array = array();
										$Sender_Name_Array = array();
										$Country_Name_Array = array();
										$Amount_Array = array();
										$Log_Creator = array();
										if($Sub_Cat_ID == '999')
											{
												$sql = 'SELECT ID,Sender_Name,Country FROM users WHERE Level = ? AND Status = ? AND Ads_Cat = ?';
												$Execute_Array = array('2','1',$Cat_ID);
												$results = $Display->Display_Info($sql,$Execute_Array);
												foreach($results as $rows)
													{
														$sql_country = 'SELECT Name FROM '.$Table.' WHERE ID = ?';
														$Execute_Country = array($rows->Country);
														$Country_Name = $Display->Display_Single_Info_Modified($sql_country,'Name',$Execute_Country);
														$Country_Name_Array[] = $Country_Name;
														
														$sql_account = 'SELECT Amount FROM merchant_accounts WHERE MID = ? AND Status = ?';
														$Execute_Account = array($rows->ID,'1');
														$Amount = $Display->Display_Single_Info_Modified($sql_account,'Amount',$Execute_Account);
														$Amount_Array[] = sprintf('%.2f',$Amount);
														
														$sql_log = 'SELECT OID FROM logs WHERE Table_Name = ? AND Action = ? AND RID = ? ';
														$Execute_log = array('users','1',$rows->ID);
														$OID = $Display->Display_Single_Info_Modified($sql_log,'OID',$Execute_log);
														
														$sql_oid = 'SELECT First_Name FROM users WHERE ID = ?';
														$Execute_oid = array($OID);
														$Creator_First_Name = $Display->Display_Single_Info_Modified($sql_oid,'First_Name',$Execute_oid);
														
														$Log_Creator[] = $Creator_First_Name;
														$MID_Array[] = $rows->ID;
														$Sender_Name_Array[] = $rows->Sender_Name;
													}
											}
										else
											{
												$sql_offer = 'SELECT AID FROM '.$Table_Offers.' WHERE Status = ? AND Ads_Sub_Cat = ?';
												$Execute_Offers = array('1',$Sub_Cat_ID);
												$results_offers = $Display->Display_Info($sql_offer,$Execute_Offers);
												$AID_Array = array();
												foreach($results_offers as $rows_offers)
													{
														$AID_Array[] = $rows_offers->AID;
													}
												$sql = 'SELECT ID,Sender_Name,Country FROM users WHERE Level = ? AND Status = ? AND Ads_Cat = ?';
												$Execute_Array = array('2','1',$Cat_ID);
												$results = $Display->Display_Info($sql,$Execute_Array);
												foreach($results as $rows)
													{
														
														if(in_array($rows->ID,$AID_Array))
															{
																$sql_country = 'SELECT Name FROM '.$Table.' WHERE ID = ?';
																$Execute_Country = array($rows->Country);
																$Country_Name = $Display->Display_Single_Info_Modified($sql_country,'Name',$Execute_Country);
																$Country_Name_Array[] = $Country_Name;
																
																$sql_account = 'SELECT Amount FROM merchant_accounts WHERE MID = ? AND Status = ?';
																$Execute_Account = array($rows->ID,'1');
																$Amount = $Display->Display_Single_Info_Modified($sql_account,'Amount',$Execute_Account);
																$Amount_Array[] = sprintf('%.2f',$Amount);
																
																$sql_log = 'SELECT OID FROM logs WHERE Table_Name = ? AND Action = ? AND RID = ? ';
																$Execute_log = array('users','1',$rows->ID);
																$OID = $Display->Display_Single_Info_Modified($sql_log,'OID',$Execute_log);
																
																$sql_oid = 'SELECT First_Name FROM users WHERE ID = ?';
																$Execute_oid = array($OID);
																$Creator_First_Name = $Display->Display_Single_Info_Modified($sql_oid,'First_Name',$Execute_oid);
																
																$Log_Creator[] = $Creator_First_Name;
																$MID_Array[] = $rows->ID;
																$Sender_Name_Array[] = $rows->Sender_Name;
															}
													}
											}
										
										$this->registry->template->MID_Array = $MID_Array;
										$this->registry->template->Sender_Name_Array = $Sender_Name_Array;
										$this->registry->template->Country_Name_Array = $Country_Name_Array;
										$this->registry->template->Amount_Array = $Amount_Array;
										$this->registry->template->Log_Creator = $Log_Creator;
									}
								elseif(($Country != '999')&&($Sales_ID == '999')&&($MID == '999')&&($Cat_ID != '999'))
									{
										$MID_Array = array();
										$Sender_Name_Array = array();
										$Country_Name_Array = array();
										$Amount_Array = array();
										$Log_Creator = array();
										if($Sub_Cat_ID == '999')
											{
												$sql = 'SELECT ID,Sender_Name,Country FROM users WHERE Level = ? AND Status = ? AND Ads_Cat = ? AND Country = ?';
												$Execute_Array = array('2','1',$Cat_ID,$Country);
												$results = $Display->Display_Info($sql,$Execute_Array);
												foreach($results as $rows)
													{
														$sql_country = 'SELECT Name FROM '.$Table.' WHERE ID = ?';
														$Execute_Country = array($rows->Country);
														$Country_Name = $Display->Display_Single_Info_Modified($sql_country,'Name',$Execute_Country);
														$Country_Name_Array[] = $Country_Name;
														
														$sql_account = 'SELECT Amount FROM merchant_accounts WHERE MID = ? AND Status = ?';
														$Execute_Account = array($rows->ID,'1');
														$Amount = $Display->Display_Single_Info_Modified($sql_account,'Amount',$Execute_Account);
														$Amount_Array[] = sprintf('%.2f',$Amount);
														
														$sql_log = 'SELECT OID FROM logs WHERE Table_Name = ? AND Action = ? AND RID = ? ';
														$Execute_log = array('users','1',$rows->ID);
														$OID = $Display->Display_Single_Info_Modified($sql_log,'OID',$Execute_log);
														
														$sql_oid = 'SELECT First_Name FROM users WHERE ID = ?';
														$Execute_oid = array($OID);
														$Creator_First_Name = $Display->Display_Single_Info_Modified($sql_oid,'First_Name',$Execute_oid);
														
														$Log_Creator[] = $Creator_First_Name;
														$MID_Array[] = $rows->ID;
														$Sender_Name_Array[] = $rows->Sender_Name;
													}
											}
										else
											{
												$sql_offer = 'SELECT AID FROM '.$Table_Offers.' WHERE Status = ? AND Ads_Sub_Cat = ?';
												$Execute_Offers = array('1',$Sub_Cat_ID);
												$results_offers = $Display->Display_Info($sql_offer,$Execute_Offers);
												$AID_Array = array();
												foreach($results_offers as $rows_offers)
													{
														$AID_Array[] = $rows_offers->AID;
													}
												$sql = 'SELECT ID,Sender_Name,Country FROM users WHERE Level = ? AND Status = ? AND Ads_Cat = ? AND Country = ?';
												$Execute_Array = array('2','1',$Cat_ID,$Country);
												$results = $Display->Display_Info($sql,$Execute_Array);
												foreach($results as $rows)
													{
														
														if(in_array($rows->ID,$AID_Array))
															{
																$sql_country = 'SELECT Name FROM '.$Table.' WHERE ID = ?';
																$Execute_Country = array($rows->Country);
																$Country_Name = $Display->Display_Single_Info_Modified($sql_country,'Name',$Execute_Country);
																$Country_Name_Array[] = $Country_Name;
																
																$sql_account = 'SELECT Amount FROM merchant_accounts WHERE MID = ? AND Status = ?';
																$Execute_Account = array($rows->ID,'1');
																$Amount = $Display->Display_Single_Info_Modified($sql_account,'Amount',$Execute_Account);
																$Amount_Array[] = sprintf('%.2f',$Amount);
																
																$sql_log = 'SELECT OID FROM logs WHERE Table_Name = ? AND Action = ? AND RID = ? ';
																$Execute_log = array('users','1',$rows->ID);
																$OID = $Display->Display_Single_Info_Modified($sql_log,'OID',$Execute_log);
																
																$sql_oid = 'SELECT First_Name FROM users WHERE ID = ?';
																$Execute_oid = array($OID);
																$Creator_First_Name = $Display->Display_Single_Info_Modified($sql_oid,'First_Name',$Execute_oid);
																
																$Log_Creator[] = $Creator_First_Name;
																$MID_Array[] = $rows->ID;
																$Sender_Name_Array[] = $rows->Sender_Name;
															}
													}
											}
										
										$this->registry->template->MID_Array = $MID_Array;
										$this->registry->template->Sender_Name_Array = $Sender_Name_Array;
										$this->registry->template->Country_Name_Array = $Country_Name_Array;
										$this->registry->template->Amount_Array = $Amount_Array;
										$this->registry->template->Log_Creator = $Log_Creator;
									}
								elseif(($Country == '999')&&($Sales_ID != '999')&&($MID == '999')&&($Cat_ID != '999'))
									{
										$MID_Array = array();
										$Sender_Name_Array = array();
										$MID_Array_Non_Filtered = array();
										$Country_Name_Array = array();
										$Amount_Array = array();
										$Log_Creator = array();
										if($Sub_Cat_ID == '999')
											{
												$sql = 'SELECT RID FROM logs WHERE Table_Name = ? AND Action = ? AND OID = ?';
												$Execute_Array = array('users','1',$Sales_ID);
												$results = $Display->Display_Info($sql,$Execute_Array);
												foreach($results as $rows)
													{
														$MID_Array_Non_Filtered[] = $rows->RID;
													}
												$sql_users = 'SELECT ID,Sender_Name,Country FROM users WHERE Status = ? AND Level = ? AND Ads_Cat = ?';
												$Execute_Array = array('1','2',$Cat_ID);
												$results = $Display->Display_Info($sql_users,$Execute_Array);
												foreach($results as $rows)
													{
														if(in_array($rows->ID,$MID_Array_Non_Filtered))
															{
																$sql_country = 'SELECT Name FROM '.$Table.' WHERE ID = ?';
																$Execute_Country = array($rows->Country);
																$Country_Name = $Display->Display_Single_Info_Modified($sql_country,'Name',$Execute_Country);
																$Country_Name_Array[] = $Country_Name;
																
																$sql_account = 'SELECT Amount FROM merchant_accounts WHERE MID = ? AND Status = ?';
																$Execute_Account = array($rows->ID,'1');
																$Amount = $Display->Display_Single_Info_Modified($sql_account,'Amount',$Execute_Account);
																$Amount_Array[] = sprintf('%.2f',$Amount);
																
																$sql_log = 'SELECT OID FROM logs WHERE Table_Name = ? AND Action = ? AND RID = ? ';
																$Execute_log = array('users','1',$rows->ID);
																$OID = $Display->Display_Single_Info_Modified($sql_log,'OID',$Execute_log);
																
																$sql_oid = 'SELECT First_Name FROM users WHERE ID = ?';
																$Execute_oid = array($OID);
																$Creator_First_Name = $Display->Display_Single_Info_Modified($sql_oid,'First_Name',$Execute_oid);
																
																$Log_Creator[] = $Creator_First_Name;
														
																$MID_Array[] = $rows->ID;
																$Sender_Name_Array[] = $rows->Sender_Name;
															} 
													}
											}
										else
											{
												$sql_offer = 'SELECT AID FROM '.$Table_Offers.' WHERE Status = ? AND Ads_Sub_Cat = ?';
												$Execute_Offers = array('1',$Sub_Cat_ID);
												$results_offers = $Display->Display_Info($sql_offer,$Execute_Offers);
												$AID_Array = array();
												foreach($results_offers as $rows_offers)
													{
														$AID_Array[] = $rows_offers->AID;
													}
												$sql = 'SELECT RID FROM logs WHERE Table_Name = ? AND Action = ? AND OID = ?';
												$Execute_Array = array('users','1',$Sales_ID);
												$results = $Display->Display_Info($sql,$Execute_Array);
												foreach($results as $rows)
													{
														$MID_Array_Non_Filtered[] = $rows->RID;
													}
												$sql_users = 'SELECT ID,Sender_Name,Country FROM users WHERE Status = ? AND Level = ? AND Ads_Cat = ?';
												$Execute_Array = array('1','2',$Cat_ID);
												$results = $Display->Display_Info($sql_users,$Execute_Array);
												foreach($results as $rows)
													{
														if(in_array($rows->ID,$MID_Array_Non_Filtered))
															{
																
																if(in_array($rows->ID,$AID_Array))
																	{
																		$sql_country = 'SELECT Name FROM '.$Table.' WHERE ID = ?';
																		$Execute_Country = array($rows->Country);
																		$Country_Name = $Display->Display_Single_Info_Modified($sql_country,'Name',$Execute_Country);
																		$Country_Name_Array[] = $Country_Name;
																		
																		$sql_account = 'SELECT Amount FROM merchant_accounts WHERE MID = ? AND Status = ?';
																		$Execute_Account = array($rows->ID,'1');
																		$Amount = $Display->Display_Single_Info_Modified($sql_account,'Amount',$Execute_Account);
																		$Amount_Array[] = sprintf('%.2f',$Amount);
																		
																		$sql_log = 'SELECT OID FROM logs WHERE Table_Name = ? AND Action = ? AND RID = ? ';
																		$Execute_log = array('users','1',$rows->ID);
																		$OID = $Display->Display_Single_Info_Modified($sql_log,'OID',$Execute_log);
																		
																		$sql_oid = 'SELECT First_Name FROM users WHERE ID = ?';
																		$Execute_oid = array($OID);
																		$Creator_First_Name = $Display->Display_Single_Info_Modified($sql_oid,'First_Name',$Execute_oid);
																		
																		$Log_Creator[] = $Creator_First_Name;
																
																		$MID_Array[] = $rows->ID;
																		$Sender_Name_Array[] = $rows->Sender_Name;
																	}
															} 
													}
											}
										
										$this->registry->template->MID_Array = $MID_Array;
										$this->registry->template->Sender_Name_Array = $Sender_Name_Array;
										$this->registry->template->Country_Name_Array = $Country_Name_Array;
										$this->registry->template->Amount_Array = $Amount_Array;
										$this->registry->template->Log_Creator = $Log_Creator;
									}
								elseif(($Country != '999')&&($Sales_ID != '999')&&($MID == '999')&&($Cat_ID != '999'))
									{
										$MID_Array = array();
										$Sender_Name_Array = array();
										$MID_Array_Non_Filtered = array();
										$Country_Name_Array = array();
										$Amount_Array = array();
										$Log_Creator = array();
										if($Sub_Cat_ID == '999')
											{
												$sql = 'SELECT RID FROM logs WHERE Table_Name = ? AND Action = ? AND OID = ?';
												$Execute_Array = array('users','1',$Sales_ID);
												$results = $Display->Display_Info($sql,$Execute_Array);
												foreach($results as $rows)
													{
														$MID_Array_Non_Filtered[] = $rows->RID;
													}
												$sql_users = 'SELECT ID,Sender_Name,Country FROM users WHERE Status = ? AND Level = ? AND Ads_Cat = ? AND Country = ?';
												$Execute_Array = array('1','2',$Cat_ID,$Country);
												$results = $Display->Display_Info($sql_users,$Execute_Array);
												foreach($results as $rows)
													{
														if(in_array($rows->ID,$MID_Array_Non_Filtered))
															{
																$sql_country = 'SELECT Name FROM '.$Table.' WHERE ID = ?';
																$Execute_Country = array($rows->Country);
																$Country_Name = $Display->Display_Single_Info_Modified($sql_country,'Name',$Execute_Country);
																$Country_Name_Array[] = $Country_Name;
																
																$sql_account = 'SELECT Amount FROM merchant_accounts WHERE MID = ? AND Status = ?';
																$Execute_Account = array($rows->ID,'1');
																$Amount = $Display->Display_Single_Info_Modified($sql_account,'Amount',$Execute_Account);
																$Amount_Array[] = sprintf('%.2f',$Amount);
																
																$sql_log = 'SELECT OID FROM logs WHERE Table_Name = ? AND Action = ? AND RID = ? ';
																$Execute_log = array('users','1',$rows->ID);
																$OID = $Display->Display_Single_Info_Modified($sql_log,'OID',$Execute_log);
																
																$sql_oid = 'SELECT First_Name FROM users WHERE ID = ?';
																$Execute_oid = array($OID);
																$Creator_First_Name = $Display->Display_Single_Info_Modified($sql_oid,'First_Name',$Execute_oid);
																
																$Log_Creator[] = $Creator_First_Name;
																$MID_Array[] = $rows->ID;
																$Sender_Name_Array[] = $rows->Sender_Name;
															} 
													}
											}
										else
											{
												$sql_offer = 'SELECT AID FROM '.$Table_Offers.' WHERE Status = ? AND Ads_Sub_Cat = ?';
												$Execute_Offers = array('1',$Sub_Cat_ID);
												$results_offers = $Display->Display_Info($sql_offer,$Execute_Offers);
												$AID_Array = array();
												foreach($results_offers as $rows_offers)
													{
														$AID_Array[] = $rows_offers->AID;
													}
												$sql = 'SELECT RID FROM logs WHERE Table_Name = ? AND Action = ? AND OID = ?';
												$Execute_Array = array('users','1',$Sales_ID);
												$results = $Display->Display_Info($sql,$Execute_Array);
												foreach($results as $rows)
													{
														$MID_Array_Non_Filtered[] = $rows->RID;
													}
												$sql_users = 'SELECT ID,Sender_Name,Country FROM users WHERE Status = ? AND Level = ? AND Ads_Cat = ? AND Country = ?';
												$Execute_Array = array('1','2',$Cat_ID,$Country);
												$results = $Display->Display_Info($sql_users,$Execute_Array);
												foreach($results as $rows)
													{
														if(in_array($rows->ID,$MID_Array_Non_Filtered))
															{
																
																if(in_array($rows->ID,$AID_Array))
																	{
																		$sql_country = 'SELECT Name FROM '.$Table.' WHERE ID = ?';
																		$Execute_Country = array($rows->Country);
																		$Country_Name = $Display->Display_Single_Info_Modified($sql_country,'Name',$Execute_Country);
																		$Country_Name_Array[] = $Country_Name;
																		
																		$sql_account = 'SELECT Amount FROM merchant_accounts WHERE MID = ? AND Status = ?';
																		$Execute_Account = array($rows->ID,'1');
																		$Amount = $Display->Display_Single_Info_Modified($sql_account,'Amount',$Execute_Account);
																		$Amount_Array[] = sprintf('%.2f',$Amount);
																		
																		$sql_log = 'SELECT OID FROM logs WHERE Table_Name = ? AND Action = ? AND RID = ? ';
																		$Execute_log = array('users','1',$rows->ID);
																		$OID = $Display->Display_Single_Info_Modified($sql_log,'OID',$Execute_log);
																		
																		$sql_oid = 'SELECT First_Name FROM users WHERE ID = ?';
																		$Execute_oid = array($OID);
																		$Creator_First_Name = $Display->Display_Single_Info_Modified($sql_oid,'First_Name',$Execute_oid);
																		
																		$Log_Creator[] = $Creator_First_Name;
																		$MID_Array[] = $rows->ID;
																		$Sender_Name_Array[] = $rows->Sender_Name;
																	}
															} 
													}
											}
										
										$this->registry->template->MID_Array = $MID_Array;
										$this->registry->template->Sender_Name_Array = $Sender_Name_Array;
										$this->registry->template->Country_Name_Array = $Country_Name_Array;
										$this->registry->template->Amount_Array = $Amount_Array;
										$this->registry->template->Log_Creator = $Log_Creator;
									}
								elseif(($Country == '999')&&($Sales_ID == '999')&&($MID != '999')&&($Cat_ID != '999'))
									{
										$MID_Array = array();
										$Sender_Name_Array = array();
										$Country_Name_Array = array();
										$Amount_Array = array();
										$Log_Creator = array();
										if($Sub_Cat_ID == '999')
											{
												$sql = 'SELECT Sender_Name,Country FROM users WHERE ID = ?';
												$Execute_Array = array($MID);
												$results = $Display->Display_Info($sql,$Execute_Array);
												foreach($results as $rows)
													{
														$sql_country = 'SELECT Name FROM '.$Table.' WHERE ID = ?';
														$Execute_Country = array($rows->Country);
														$Country_Name = $Display->Display_Single_Info_Modified($sql_country,'Name',$Execute_Country);
														$Country_Name_Array[] = $Country_Name;
														
														$sql_account = 'SELECT Amount FROM merchant_accounts WHERE MID = ? AND Status = ?';
														$Execute_Account = array($MID,'1');
														$Amount = $Display->Display_Single_Info_Modified($sql_account,'Amount',$Execute_Account);
														$Amount_Array[] = sprintf('%.2f',$Amount);
														
														$sql_log = 'SELECT OID FROM logs WHERE Table_Name = ? AND Action = ? AND RID = ?';
														$Execute_log = array('users','1',$MID);
														$OID = $Display->Display_Single_Info_Modified($sql_log,'OID',$Execute_log);
														
														$sql_oid = 'SELECT First_Name FROM users WHERE ID = ?';
														$Execute_oid = array($OID);
														$Creator_First_Name = $Display->Display_Single_Info_Modified($sql_oid,'First_Name',$Execute_oid);
														
														$Log_Creator[] = $Creator_First_Name;
														$MID_Array[] = $MID;
														$Sender_Name_Array[] = $rows->Sender_Name;
													}
											}
										else
											{
												$sql_offer = 'SELECT AID FROM '.$Table_Offers.' WHERE Status = ? AND Ads_Sub_Cat = ?';
												$Execute_Offers = array('1',$Sub_Cat_ID);
												$results_offers = $Display->Display_Info($sql_offer,$Execute_Offers);
												$AID_Array = array();
												foreach($results_offers as $rows_offers)
													{
														$AID_Array[] = $rows_offers->AID;
													}
												$sql = 'SELECT Sender_Name,Country FROM users WHERE ID = ?';
												$Execute_Array = array($MID);
												$results = $Display->Display_Info($sql,$Execute_Array);
												foreach($results as $rows)
													{
														
														if(in_array($MID,$AID_Array))
															{
																$sql_country = 'SELECT Name FROM '.$Table.' WHERE ID = ?';
																$Execute_Country = array($rows->Country);
																$Country_Name = $Display->Display_Single_Info_Modified($sql_country,'Name',$Execute_Country);
																$Country_Name_Array[] = $Country_Name;
																
																$sql_account = 'SELECT Amount FROM merchant_accounts WHERE MID = ? AND Status = ?';
																$Execute_Account = array($MID,'1');
																$Amount = $Display->Display_Single_Info_Modified($sql_account,'Amount',$Execute_Account);
																$Amount_Array[] = sprintf('%.2f',$Amount);
																
																$sql_log = 'SELECT OID FROM logs WHERE Table_Name = ? AND Action = ? AND RID = ?';
																$Execute_log = array('users','1',$MID);
																$OID = $Display->Display_Single_Info_Modified($sql_log,'OID',$Execute_log);
																
																$sql_oid = 'SELECT First_Name FROM users WHERE ID = ?';
																$Execute_oid = array($OID);
																$Creator_First_Name = $Display->Display_Single_Info_Modified($sql_oid,'First_Name',$Execute_oid);
																
																$Log_Creator[] = $Creator_First_Name;
																$MID_Array[] = $MID;
																$Sender_Name_Array[] = $rows->Sender_Name;
															}
													}
											}
										
										$this->registry->template->MID_Array = $MID_Array;
										$this->registry->template->Sender_Name_Array = $Sender_Name_Array;
										$this->registry->template->Country_Name_Array = $Country_Name_Array;
										$this->registry->template->Amount_Array = $Amount_Array;
										$this->registry->template->Log_Creator = $Log_Creator;
									}
								elseif(($Country != '999')&&($Sales_ID == '999')&&($MID != '999')&&($Cat_ID != '999'))
									{
										$MID_Array = array();
										$Sender_Name_Array = array();
										$Country_Name_Array = array();
										$Amount_Array = array();
										$Log_Creator = array();
										if($Sub_Cat_ID == '999')
											{
												$sql = 'SELECT Sender_Name,Country FROM users WHERE ID = ?';
												$Execute_Array = array($MID);
												$results = $Display->Display_Info($sql,$Execute_Array);
												foreach($results as $rows)
													{
														$sql_country = 'SELECT Name FROM '.$Table.' WHERE ID = ?';
														$Execute_Country = array($rows->Country);
														$Country_Name = $Display->Display_Single_Info_Modified($sql_country,'Name',$Execute_Country);
														$Country_Name_Array[] = $Country_Name;
														
														$sql_account = 'SELECT Amount FROM merchant_accounts WHERE MID = ? AND Status = ?';
														$Execute_Account = array($MID,'1');
														$Amount = $Display->Display_Single_Info_Modified($sql_account,'Amount',$Execute_Account);
														$Amount_Array[] = sprintf('%.2f',$Amount);
														
														$sql_log = 'SELECT OID FROM logs WHERE Table_Name = ? AND Action = ? AND RID = ? ';
														$Execute_log = array('users','1',$MID);
														$OID = $Display->Display_Single_Info_Modified($sql_log,'OID',$Execute_log);
														
														$sql_oid = 'SELECT First_Name FROM users WHERE ID = ?';
														$Execute_oid = array($OID);
														$Creator_First_Name = $Display->Display_Single_Info_Modified($sql_oid,'First_Name',$Execute_oid);
														
														$Log_Creator[] = $Creator_First_Name;
														$MID_Array[] = $MID;
														$Sender_Name_Array[] = $rows->Sender_Name;
													}
											}
										else
											{
												$sql_offer = 'SELECT AID FROM '.$Table_Offers.' WHERE Status = ? AND Ads_Sub_Cat = ?';
												$Execute_Offers = array('1',$Sub_Cat_ID);
												$results_offers = $Display->Display_Info($sql_offer,$Execute_Offers);
												$AID_Array = array();
												foreach($results_offers as $rows_offers)
													{
														$AID_Array[] = $rows_offers->AID;
													}
												$sql = 'SELECT Sender_Name,Country FROM users WHERE ID = ?';
												$Execute_Array = array($MID);
												$results = $Display->Display_Info($sql,$Execute_Array);
												foreach($results as $rows)
													{
														
														if(in_array($MID,$AID_Array))
															{
																$sql_country = 'SELECT Name FROM '.$Table.' WHERE ID = ?';
																$Execute_Country = array($rows->Country);
																$Country_Name = $Display->Display_Single_Info_Modified($sql_country,'Name',$Execute_Country);
																$Country_Name_Array[] = $Country_Name;
																
																$sql_account = 'SELECT Amount FROM merchant_accounts WHERE MID = ? AND Status = ?';
																$Execute_Account = array($MID,'1');
																$Amount = $Display->Display_Single_Info_Modified($sql_account,'Amount',$Execute_Account);
																$Amount_Array[] = sprintf('%.2f',$Amount);
																
																$sql_log = 'SELECT OID FROM logs WHERE Table_Name = ? AND Action = ? AND RID = ? ';
																$Execute_log = array('users','1',$MID);
																$OID = $Display->Display_Single_Info_Modified($sql_log,'OID',$Execute_log);
																
																$sql_oid = 'SELECT First_Name FROM users WHERE ID = ?';
																$Execute_oid = array($OID);
																$Creator_First_Name = $Display->Display_Single_Info_Modified($sql_oid,'First_Name',$Execute_oid);
																
																$Log_Creator[] = $Creator_First_Name;
																$MID_Array[] = $MID;
																$Sender_Name_Array[] = $rows->Sender_Name;
															}
													}
											}
										
										$this->registry->template->MID_Array = $MID_Array;
										$this->registry->template->Sender_Name_Array = $Sender_Name_Array;
										$this->registry->template->Country_Name_Array = $Country_Name_Array;
										$this->registry->template->Amount_Array = $Amount_Array;
										$this->registry->template->Log_Creator = $Log_Creator;
									}
								elseif(($Country == '999')&&($Sales_ID != '999')&&($MID != '999')&&($Cat_ID != '999'))
									{
										$MID_Array = array();
										$Sender_Name_Array = array();
										$Country_Name_Array = array();
										$Amount_Array = array();
										$Log_Creator = array();
										if($Sub_Cat_ID == '999')
											{
												$sql = 'SELECT Sender_Name,Country FROM users WHERE ID = ?';
												$Execute_Array = array($MID);
												$results = $Display->Display_Info($sql,$Execute_Array);
												foreach($results as $rows)
													{
														$sql_country = 'SELECT Name FROM '.$Table.' WHERE ID = ?';
														$Execute_Country = array($rows->Country);
														$Country_Name = $Display->Display_Single_Info_Modified($sql_country,'Name',$Execute_Country);
														$Country_Name_Array[] = $Country_Name;
														
														$sql_account = 'SELECT Amount FROM merchant_accounts WHERE MID = ? AND Status = ?';
														$Execute_Account = array($MID,'1');
														$Amount = $Display->Display_Single_Info_Modified($sql_account,'Amount',$Execute_Account);
														$Amount_Array[] = sprintf('%.2f',$Amount);
														
														$sql_log = 'SELECT OID FROM logs WHERE Table_Name = ? AND Action = ? AND RID = ?';
														$Execute_log = array('users','1',$MID);
														$OID = $Display->Display_Single_Info_Modified($sql_log,'OID',$Execute_log);
														
														$sql_oid = 'SELECT First_Name FROM users WHERE ID = ?';
														$Execute_oid = array($OID);
														$Creator_First_Name = $Display->Display_Single_Info_Modified($sql_oid,'First_Name',$Execute_oid);
														
														$Log_Creator[] = $Creator_First_Name;
														$MID_Array[] = $MID;
														$Sender_Name_Array[] = $rows->Sender_Name;
													}
											}
										else
											{
												$sql_offer = 'SELECT AID FROM '.$Table_Offers.' WHERE Status = ? AND Ads_Sub_Cat = ?';
												$Execute_Offers = array('1',$Sub_Cat_ID);
												$results_offers = $Display->Display_Info($sql_offer,$Execute_Offers);
												$AID_Array = array();
												foreach($results_offers as $rows_offers)
													{
														$AID_Array[] = $rows_offers->AID;
													}
												$sql = 'SELECT Sender_Name,Country FROM users WHERE ID = ?';
												$Execute_Array = array($MID);
												$results = $Display->Display_Info($sql,$Execute_Array);
												foreach($results as $rows)
													{
														
														if(in_array($MID,$AID_Array))
															{
																$sql_country = 'SELECT Name FROM '.$Table.' WHERE ID = ?';
																$Execute_Country = array($rows->Country);
																$Country_Name = $Display->Display_Single_Info_Modified($sql_country,'Name',$Execute_Country);
																$Country_Name_Array[] = $Country_Name;
																
																$sql_account = 'SELECT Amount FROM merchant_accounts WHERE MID = ? AND Status = ?';
																$Execute_Account = array($MID,'1');
																$Amount = $Display->Display_Single_Info_Modified($sql_account,'Amount',$Execute_Account);
																$Amount_Array[] = sprintf('%.2f',$Amount);
																
																$sql_log = 'SELECT OID FROM logs WHERE Table_Name = ? AND Action = ? AND RID = ?';
																$Execute_log = array('users','1',$MID);
																$OID = $Display->Display_Single_Info_Modified($sql_log,'OID',$Execute_log);
																
																$sql_oid = 'SELECT First_Name FROM users WHERE ID = ?';
																$Execute_oid = array($OID);
																$Creator_First_Name = $Display->Display_Single_Info_Modified($sql_oid,'First_Name',$Execute_oid);
																
																$Log_Creator[] = $Creator_First_Name;
																$MID_Array[] = $MID;
																$Sender_Name_Array[] = $rows->Sender_Name;
															}
													}
											}
										
										$this->registry->template->MID_Array = $MID_Array;
										$this->registry->template->Sender_Name_Array = $Sender_Name_Array;
										$this->registry->template->Country_Name_Array = $Country_Name_Array;
										$this->registry->template->Amount_Array = $Amount_Array;
										$this->registry->template->Log_Creator = $Log_Creator;
									}
								else
									{
										$MID_Array = array();
										$Sender_Name_Array = array();
										$Country_Name_Array = array();
										$Amount_Array = array();
										$Log_Creator = array();
										if($Sub_Cat_ID == '999')
											{
												$sql = 'SELECT ID,Sender_Name,Country FROM users WHERE Status = ? AND Level = ?';
												$Execute_Array = array('1','2');
												$results = $Display->Display_Info($sql,$Execute_Array);
												foreach($results as $rows)
													{
														$sql_country = 'SELECT Name FROM '.$Table.' WHERE ID = ?';
														$Execute_Country = array($rows->Country);
														$Country_Name = $Display->Display_Single_Info_Modified($sql_country,'Name',$Execute_Country);
														$Country_Name_Array[] = $Country_Name;
														
														$sql_account = 'SELECT Amount FROM merchant_accounts WHERE MID = ? AND Status = ?';
														$Execute_Account = array($rows->ID,'1');
														$Amount = $Display->Display_Single_Info_Modified($sql_account,'Amount',$Execute_Account);
														$Amount_Array[] = sprintf('%.2f',$Amount);
														
														$sql_log = 'SELECT OID FROM logs WHERE Table_Name = ? AND Action = ? AND RID = ?';
														$Execute_log = array('users','1',$rows->ID);
														$OID = $Display->Display_Single_Info_Modified($sql_log,'OID',$Execute_log);
														
														$sql_oid = 'SELECT First_Name FROM users WHERE ID = ?';
														$Execute_oid = array($OID);
														$Creator_First_Name = $Display->Display_Single_Info_Modified($sql_oid,'First_Name',$Execute_oid);
														
														$Log_Creator[] = $Creator_First_Name;
														$MID_Array[] = $rows->ID;
														$Sender_Name_Array[] = $rows->Sender_Name;
													}
											}
										else
											{
												$sql_offer = 'SELECT AID FROM '.$Table_Offers.' WHERE Status = ? AND Ads_Sub_Cat = ?';
												$Execute_Offers = array('1',$Sub_Cat_ID);
												$results_offers = $Display->Display_Info($sql_offer,$Execute_Offers);
												$AID_Array = array();
												foreach($results_offers as $rows_offers)
													{
														$AID_Array[] = $rows_offers->AID;
													}
												$sql = 'SELECT ID,Sender_Name,Country FROM users WHERE Status = ? AND Level = ?';
												$Execute_Array = array('1','2');
												$results = $Display->Display_Info($sql,$Execute_Array);
												foreach($results as $rows)
													{
														
														if(in_array($rows->ID,$AID_Array))
															{
																$sql_country = 'SELECT Name FROM '.$Table.' WHERE ID = ?';
																$Execute_Country = array($rows->Country);
																$Country_Name = $Display->Display_Single_Info_Modified($sql_country,'Name',$Execute_Country);
																$Country_Name_Array[] = $Country_Name;
																
																$sql_account = 'SELECT Amount FROM merchant_accounts WHERE MID = ? AND Status = ?';
																$Execute_Account = array($rows->ID,'1');
																$Amount = $Display->Display_Single_Info_Modified($sql_account,'Amount',$Execute_Account);
																$Amount_Array[] = sprintf('%.2f',$Amount);
																
																$sql_log = 'SELECT OID FROM logs WHERE Table_Name = ? AND Action = ? AND RID = ?';
																$Execute_log = array('users','1',$rows->ID);
																$OID = $Display->Display_Single_Info_Modified($sql_log,'OID',$Execute_log);
																
																$sql_oid = 'SELECT First_Name FROM users WHERE ID = ?';
																$Execute_oid = array($OID);
																$Creator_First_Name = $Display->Display_Single_Info_Modified($sql_oid,'First_Name',$Execute_oid);
																
																$Log_Creator[] = $Creator_First_Name;
																$MID_Array[] = $rows->ID;
																$Sender_Name_Array[] = $rows->Sender_Name;
															}
													}
											}
										
										$this->registry->template->MID_Array = $MID_Array;
										$this->registry->template->Sender_Name_Array = $Sender_Name_Array;
										$this->registry->template->Country_Name_Array = $Country_Name_Array;
										$this->registry->template->Amount_Array = $Amount_Array;
										$this->registry->template->Log_Creator = $Log_Creator;
									}
								
							}
						else
							{
								$Starts_Date = date('Y-m-d',strtotime($Starts_Date));
								$End_Date = date('Y-m-d',strtotime($End_Date));
								
								if(($Country == '999')&&($Sales_ID == '999')&&($MID == '999')&&($Cat_ID == '999'))
									{
										$MID_Array = array();
										$Sender_Name_Array = array();
										$Country_Name_Array = array();
										$Amount_Array = array();
										$Log_Creator = array();
										if($Sub_Cat_ID == '999')
											{
												$sql = 'SELECT ID,Sender_Name,Country FROM users WHERE Status = ? AND Level = ? AND (Starts_Date <= ? AND End_Date >= ?)';
												$Execute_Array = array('1','2',$Starts_Date,$End_Date);
												$results = $Display->Display_Info($sql,$Execute_Array);
												foreach($results as $rows)
													{
														$sql_country = 'SELECT Name FROM '.$Table.' WHERE ID = ?';
														$Execute_Country = array($rows->Country);
														$Country_Name = $Display->Display_Single_Info_Modified($sql_country,'Name',$Execute_Country);
														$Country_Name_Array[] = $Country_Name;
														
														$sql_account = 'SELECT Amount FROM merchant_accounts WHERE MID = ? AND Status = ?';
														$Execute_Account = array($rows->ID,'1');
														$Amount = $Display->Display_Single_Info_Modified($sql_account,'Amount',$Execute_Account);
														$Amount_Array[] = sprintf('%.2f',$Amount);
														
														$sql_log = 'SELECT OID FROM logs WHERE Table_Name = ? AND Action = ? AND RID = ?';
														$Execute_log = array('users','1',$rows->ID);
														$OID = $Display->Display_Single_Info_Modified($sql_log,'OID',$Execute_log);
														
														$sql_oid = 'SELECT First_Name FROM users WHERE ID = ?';
														$Execute_oid = array($OID);
														$Creator_First_Name = $Display->Display_Single_Info_Modified($sql_oid,'First_Name',$Execute_oid);
														
														$Log_Creator[] = $Creator_First_Name;
														$MID_Array[] = $rows->ID;
														$Sender_Name_Array[] = $rows->Sender_Name;
														
													}
											}
										else
											{
												$sql_offer = 'SELECT AID FROM '.$Table_Offers.' WHERE Status = ? AND Ads_Sub_Cat = ?';
												$Execute_Offers = array('1',$Sub_Cat_ID);
												$results_offers = $Display->Display_Info($sql_offer,$Execute_Offers);
												$AID_Array = array();
												foreach($results_offers as $rows_offers)
													{
														$AID_Array[] = $rows_offers->AID;
													}
												$sql = 'SELECT ID,Sender_Name,Country FROM users WHERE Status = ? AND Level = ? AND (Starts_Date <= ? AND End_Date >= ?)';
												$Execute_Array = array('1','2',$Starts_Date,$End_Date);
												$results = $Display->Display_Info($sql,$Execute_Array);
												foreach($results as $rows)
													{
														
														if(in_array($rows->ID,$AID_Array))
																	{
																		
																		$sql_country = 'SELECT Name FROM '.$Table.' WHERE ID = ?';
																		$Execute_Country = array($rows->Country);
																		$Country_Name = $Display->Display_Single_Info_Modified($sql_country,'Name',$Execute_Country);
																		$Country_Name_Array[] = $Country_Name;
																		
																		$sql_account = 'SELECT Amount FROM merchant_accounts WHERE MID = ? AND Status = ?';
																		$Execute_Account = array($rows->ID,'1');
																		$Amount = $Display->Display_Single_Info_Modified($sql_account,'Amount',$Execute_Account);
																		$Amount_Array[] = sprintf('%.2f',$Amount);
																		
																		$sql_log = 'SELECT OID FROM logs WHERE Table_Name = ? AND Action = ? AND RID = ?';
																		$Execute_log = array('users','1',$rows->ID);
																		$OID = $Display->Display_Single_Info_Modified($sql_log,'OID',$Execute_log);
																		
																		$sql_oid = 'SELECT First_Name FROM users WHERE ID = ?';
																		$Execute_oid = array($OID);
																		$Creator_First_Name = $Display->Display_Single_Info_Modified($sql_oid,'First_Name',$Execute_oid);
																		
																		$Log_Creator[] = $Creator_First_Name;
																		$MID_Array[] = $rows->ID;
																		$Sender_Name_Array[] = $rows->Sender_Name;
																	}
															}
											}
										
										$this->registry->template->MID_Array = $MID_Array;
										$this->registry->template->Sender_Name_Array = $Sender_Name_Array;
										$this->registry->template->Country_Name_Array = $Country_Name_Array;
										$this->registry->template->Amount_Array = $Amount_Array;
										$this->registry->template->Log_Creator = $Log_Creator;
									}
								elseif(($Country != '999')&&($Sales_ID == '999')&&($MID == '999')&&($Cat_ID == '999'))
									{
										$MID_Array = array();
										$Sender_Name_Array = array();
										$Country_Name_Array = array();
										$Amount_Array = array();
										$Log_Creator = array();
										if($Sub_Cat_ID == '999')
											{
												$sql = 'SELECT ID,Sender_Name,Country FROM users WHERE Status = ? AND Level = ? AND Country = ? AND (Starts_Date <= ? AND End_Date >= ?)';
												$Execute_Array = array('1','2',$Country,$Starts_Date,$End_Date);
												$results = $Display->Display_Info($sql,$Execute_Array);
												foreach($results as $rows)
													{
														$sql_country = 'SELECT Name FROM '.$Table.' WHERE ID = ?';
														$Execute_Country = array($rows->Country);
														$Country_Name = $Display->Display_Single_Info_Modified($sql_country,'Name',$Execute_Country);
														$Country_Name_Array[] = $Country_Name;
														
														$sql_account = 'SELECT Amount FROM merchant_accounts WHERE MID = ? AND Status = ?';
														$Execute_Account = array($rows->ID,'1');
														$Amount = $Display->Display_Single_Info_Modified($sql_account,'Amount',$Execute_Account);
														$Amount_Array[] = sprintf('%.2f',$Amount);
														
														$sql_log = 'SELECT OID FROM logs WHERE Table_Name = ? AND Action = ? AND RID = ? ';
														$Execute_log = array('users','1',$rows->ID);
														$OID = $Display->Display_Single_Info_Modified($sql_log,'OID',$Execute_log);
														
														$sql_oid = 'SELECT First_Name FROM users WHERE ID = ?';
														$Execute_oid = array($OID);
														$Creator_First_Name = $Display->Display_Single_Info_Modified($sql_oid,'First_Name',$Execute_oid);
														
														$Log_Creator[] = $Creator_First_Name;
														$MID_Array[] = $rows->ID;
														$Sender_Name_Array[] = $rows->Sender_Name;
													}
											}
										else
											{
												$sql_offer = 'SELECT AID FROM '.$Table_Offers.' WHERE Status = ? AND Ads_Sub_Cat = ?';
												$Execute_Offers = array('1',$Sub_Cat_ID);
												$results_offers = $Display->Display_Info($sql_offer,$Execute_Offers);
												$AID_Array = array();
												foreach($results_offers as $rows_offers)
													{
														$AID_Array[] = $rows_offers->AID;
													}
													$sql = 'SELECT ID,Sender_Name,Country FROM users WHERE Status = ? AND Level = ? AND Country = ? AND (Starts_Date <= ? AND End_Date >= ?)';
													$Execute_Array = array('1','2',$Country,$Starts_Date,$End_Date);
													$results = $Display->Display_Info($sql,$Execute_Array);
													foreach($results as $rows)
														{
															
															if(in_array($rows->ID,$AID_Array))
																{
																	$sql_country = 'SELECT Name FROM '.$Table.' WHERE ID = ?';
																	$Execute_Country = array($rows->Country);
																	$Country_Name = $Display->Display_Single_Info_Modified($sql_country,'Name',$Execute_Country);
																	$Country_Name_Array[] = $Country_Name;
																	
																	$sql_account = 'SELECT Amount FROM merchant_accounts WHERE MID = ? AND Status = ?';
																	$Execute_Account = array($rows->ID,'1');
																	$Amount = $Display->Display_Single_Info_Modified($sql_account,'Amount',$Execute_Account);
																	$Amount_Array[] = sprintf('%.2f',$Amount);
																	
																	$sql_log = 'SELECT OID FROM logs WHERE Table_Name = ? AND Action = ? AND RID = ? ';
																	$Execute_log = array('users','1',$rows->ID);
																	$OID = $Display->Display_Single_Info_Modified($sql_log,'OID',$Execute_log);
																	
																	$sql_oid = 'SELECT First_Name FROM users WHERE ID = ?';
																	$Execute_oid = array($OID);
																	$Creator_First_Name = $Display->Display_Single_Info_Modified($sql_oid,'First_Name',$Execute_oid);
																	
																	$Log_Creator[] = $Creator_First_Name;
																	$MID_Array[] = $rows->ID;
																	$Sender_Name_Array[] = $rows->Sender_Name;
																}
														}
											}
										
										$this->registry->template->MID_Array = $MID_Array;
										$this->registry->template->Sender_Name_Array = $Sender_Name_Array;
										$this->registry->template->Country_Name_Array = $Country_Name_Array;
										$this->registry->template->Amount_Array = $Amount_Array;
										$this->registry->template->Log_Creator = $Log_Creator;
									}
								elseif(($Country == '999')&&($Sales_ID != '999')&&($MID == '999')&&($Cat_ID == '999'))
									{
										$MID_Array = array();
										$Sender_Name_Array = array();
										$MID_Array_Non_Filtered = array();
										$Country_Name_Array = array();
										$Amount_Array = array();
										$Log_Creator = array();
										if($Sub_Cat_ID == '999')
											{
												$sql = 'SELECT RID FROM logs WHERE Table_Name = ? AND Action = ? AND OID = ?';
												$Execute_Array = array('users','1',$Sales_ID);
												$results = $Display->Display_Info($sql,$Execute_Array);
												foreach($results as $rows)
													{
														$MID_Array_Non_Filtered[] = $rows->RID;
													}
												$sql_users = 'SELECT ID,Sender_Name,Country FROM users WHERE Status = ? AND Level = ? AND (Starts_Date <= ? AND End_Date >= ?)';
												$Execute_Array = array('1','2',$Starts_Date,$End_Date);
												$results = $Display->Display_Info($sql_users,$Execute_Array);
												foreach($results as $rows)
													{
														if(in_array($rows->ID,$MID_Array_Non_Filtered))
															{
																$sql_country = 'SELECT Name FROM '.$Table.' WHERE ID = ?';
																$Execute_Country = array($rows->Country);
																$Country_Name = $Display->Display_Single_Info_Modified($sql_country,'Name',$Execute_Country);
																$Country_Name_Array[] = $Country_Name;
																
																$sql_account = 'SELECT Amount FROM merchant_accounts WHERE MID = ? AND Status = ?';
																$Execute_Account = array($rows->ID,'1');
																$Amount = $Display->Display_Single_Info_Modified($sql_account,'Amount',$Execute_Account);
																$Amount_Array[] = sprintf('%.2f',$Amount);
																
																$sql_log = 'SELECT OID FROM logs WHERE Table_Name = ? AND Action = ? AND RID = ? ';
																$Execute_log = array('users','1',$rows->ID);
																$OID = $Display->Display_Single_Info_Modified($sql_log,'OID',$Execute_log);
																
																$sql_oid = 'SELECT First_Name FROM users WHERE ID = ?';
																$Execute_oid = array($OID);
																$Creator_First_Name = $Display->Display_Single_Info_Modified($sql_oid,'First_Name',$Execute_oid);
																
																$Log_Creator[] = $Creator_First_Name;
																$MID_Array[] = $rows->ID;
																$Sender_Name_Array[] = $rows->Sender_Name;
															} 
													}
											}
										else
											{
												$sql_offer = 'SELECT AID FROM '.$Table_Offers.' WHERE Status = ? AND Ads_Sub_Cat = ?';
												$Execute_Offers = array('1',$Sub_Cat_ID);
												$results_offers = $Display->Display_Info($sql_offer,$Execute_Offers);
												$AID_Array = array();
												foreach($results_offers as $rows_offers)
													{
														$AID_Array[] = $rows_offers->AID;
													}
												$sql = 'SELECT RID FROM logs WHERE Table_Name = ? AND Action = ? AND OID = ?';
												$Execute_Array = array('users','1',$Sales_ID);
												$results = $Display->Display_Info($sql,$Execute_Array);
												foreach($results as $rows)
													{
														$MID_Array_Non_Filtered[] = $rows->RID;
													}
												$sql_users = 'SELECT ID,Sender_Name,Country FROM users WHERE Status = ? AND Level = ? AND (Starts_Date <= ? AND End_Date >= ?)';
												$Execute_Array = array('1','2',$Starts_Date,$End_Date);
												$results = $Display->Display_Info($sql_users,$Execute_Array);
												foreach($results as $rows)
													{
														if(in_array($rows->ID,$MID_Array_Non_Filtered))
															{
																if(in_array($rows->ID,$AID_Array))
																	{
																		$sql_country = 'SELECT Name FROM '.$Table.' WHERE ID = ?';
																		$Execute_Country = array($rows->Country);
																		$Country_Name = $Display->Display_Single_Info_Modified($sql_country,'Name',$Execute_Country);
																		$Country_Name_Array[] = $Country_Name;
																		
																		$sql_account = 'SELECT Amount FROM merchant_accounts WHERE MID = ? AND Status = ?';
																		$Execute_Account = array($rows->ID,'1');
																		$Amount = $Display->Display_Single_Info_Modified($sql_account,'Amount',$Execute_Account);
																		$Amount_Array[] = sprintf('%.2f',$Amount);
																		
																		$sql_log = 'SELECT OID FROM logs WHERE Table_Name = ? AND Action = ? AND RID = ? ';
																		$Execute_log = array('users','1',$rows->ID);
																		$OID = $Display->Display_Single_Info_Modified($sql_log,'OID',$Execute_log);
																		
																		$sql_oid = 'SELECT First_Name FROM users WHERE ID = ?';
																		$Execute_oid = array($OID);
																		$Creator_First_Name = $Display->Display_Single_Info_Modified($sql_oid,'First_Name',$Execute_oid);
																		
																		$Log_Creator[] = $Creator_First_Name;
																		$MID_Array[] = $rows->ID;
																		$Sender_Name_Array[] = $rows->Sender_Name;
																	}
															} 
													}
											}
										
										$this->registry->template->MID_Array = $MID_Array;
										$this->registry->template->Sender_Name_Array = $Sender_Name_Array;
										$this->registry->template->Country_Name_Array = $Country_Name_Array;
										$this->registry->template->Amount_Array = $Amount_Array;
										$this->registry->template->Log_Creator = $Log_Creator;
									}
								elseif(($Country != '999')&&($Sales_ID != '999')&&($MID == '999')&&($Cat_ID == '999'))
									{
										$MID_Array_Non_Filtered = array();
										$MID_Array = array();
										$Sender_Name_Array = array();
										$Country_Name_Array = array();
										$Amount_Array = array();
										$Log_Creator = array();
										if($Sub_Cat_ID == '999')
											{
												$sql = 'SELECT RID FROM logs WHERE Table_Name = ? AND Action = ? AND OID = ?';
												$Execute_Array = array('users','1',$Sales_ID);
												$results = $Display->Display_Info($sql,$Execute_Array);
												foreach($results as $rows)
													{
														$MID_Array_Non_Filtered[] = $rows->RID;
													}
												$sql_users = 'SELECT ID,Sender_Name,Country FROM users WHERE Status = ? AND Level = ? AND Country = ? AND (Starts_Date <= ? AND End_Date >= ?)';
												$Execute_Array = array('1','2',$Country,$Starts_Date,$End_Date);
												$results = $Display->Display_Info($sql_users,$Execute_Array);
												foreach($results as $rows)
													{
														if(in_array($rows->ID,$MID_Array_Non_Filtered))
															{
																$sql_country = 'SELECT Name FROM '.$Table.' WHERE ID = ?';
																$Execute_Country = array($rows->Country);
																$Country_Name = $Display->Display_Single_Info_Modified($sql_country,'Name',$Execute_Country);
																$Country_Name_Array[] = $Country_Name;
																
																$sql_account = 'SELECT Amount FROM merchant_accounts WHERE MID = ? AND Status = ?';
																$Execute_Account = array($rows->ID,'1');
																$Amount = $Display->Display_Single_Info_Modified($sql_account,'Amount',$Execute_Account);
																$Amount_Array[] = sprintf('%.2f',$Amount);
																
																$sql_log = 'SELECT OID FROM logs WHERE Table_Name = ? AND Action = ? AND RID = ? ';
																$Execute_log = array('users','1',$rows->ID);
																$OID = $Display->Display_Single_Info_Modified($sql_log,'OID',$Execute_log);
																
																$sql_oid = 'SELECT First_Name FROM users WHERE ID = ?';
																$Execute_oid = array($OID);
																$Creator_First_Name = $Display->Display_Single_Info_Modified($sql_oid,'First_Name',$Execute_oid);
																
																$Log_Creator[] = $Creator_First_Name;
														
																$MID_Array[] = $rows->ID;
																$Sender_Name_Array[] = $rows->Sender_Name;
															} 
													}
											}
										else
											{
												$sql_offer = 'SELECT AID FROM '.$Table_Offers.' WHERE Status = ? AND Ads_Sub_Cat = ?';
												$Execute_Offers = array('1',$Sub_Cat_ID);
												$results_offers = $Display->Display_Info($sql_offer,$Execute_Offers);
												$AID_Array = array();
												foreach($results_offers as $rows_offers)
													{
														$AID_Array[] = $rows_offers->AID;
													}
												$sql = 'SELECT RID FROM logs WHERE Table_Name = ? AND Action = ? AND OID = ?';
												$Execute_Array = array('users','1',$Sales_ID);
												$results = $Display->Display_Info($sql,$Execute_Array);
												foreach($results as $rows)
													{
														$MID_Array_Non_Filtered[] = $rows->RID;
													}
												$sql_users = 'SELECT ID,Sender_Name,Country FROM users WHERE Status = ? AND Level = ? AND Country = ? AND (Starts_Date <= ? AND End_Date >= ?)';
												$Execute_Array = array('1','2',$Country,$Starts_Date,$End_Date);
												$results = $Display->Display_Info($sql_users,$Execute_Array);
												foreach($results as $rows)
													{
														if(in_array($rows->ID,$MID_Array_Non_Filtered))
															{
																if(in_array($rows->ID,$AID_Array))
																	{
																		$sql_country = 'SELECT Name FROM '.$Table.' WHERE ID = ?';
																		$Execute_Country = array($rows->Country);
																		$Country_Name = $Display->Display_Single_Info_Modified($sql_country,'Name',$Execute_Country);
																		$Country_Name_Array[] = $Country_Name;
																		
																		$sql_account = 'SELECT Amount FROM merchant_accounts WHERE MID = ? AND Status = ?';
																		$Execute_Account = array($rows->ID,'1');
																		$Amount = $Display->Display_Single_Info_Modified($sql_account,'Amount',$Execute_Account);
																		$Amount_Array[] = sprintf('%.2f',$Amount);
																		
																		$sql_log = 'SELECT OID FROM logs WHERE Table_Name = ? AND Action = ? AND RID = ? ';
																		$Execute_log = array('users','1',$rows->ID);
																		$OID = $Display->Display_Single_Info_Modified($sql_log,'OID',$Execute_log);
																		
																		$sql_oid = 'SELECT First_Name FROM users WHERE ID = ?';
																		$Execute_oid = array($OID);
																		$Creator_First_Name = $Display->Display_Single_Info_Modified($sql_oid,'First_Name',$Execute_oid);
																		
																		$Log_Creator[] = $Creator_First_Name;
																
																		$MID_Array[] = $rows->ID;
																		$Sender_Name_Array[] = $rows->Sender_Name;
																	}
															} 
													}
											}
										
										$this->registry->template->MID_Array = $MID_Array;
										$this->registry->template->Sender_Name_Array = $Sender_Name_Array;
										$this->registry->template->Country_Name_Array = $Country_Name_Array;
										$this->registry->template->Amount_Array = $Amount_Array;
										$this->registry->template->Log_Creator = $Log_Creator;
									}
								elseif(($Country == '999')&&($Sales_ID == '999')&&($MID != '999')&&($Cat_ID == '999'))
									{
										$MID_Array = array();
										$Sender_Name_Array = array();
										$Country_Name_Array = array();
										$Amount_Array = array();
										$Log_Creator = array();
										if($Sub_Cat_ID == '999')
											{
												$sql = 'SELECT Sender_Name,Country FROM users WHERE ID = ? AND (Starts_Date <= ? AND End_Date >= ?)';
												$Execute_Array = array($MID,$Starts_Date,$End_Date);
												$results = $Display->Display_Info($sql,$Execute_Array);
												foreach($results as $rows)
													{
														$sql_country = 'SELECT Name FROM '.$Table.' WHERE ID = ?';
														$Execute_Country = array($rows->Country);
														$Country_Name = $Display->Display_Single_Info_Modified($sql_country,'Name',$Execute_Country);
														$Country_Name_Array[] = $Country_Name;
														
														$sql_account = 'SELECT Amount FROM merchant_accounts WHERE MID = ? AND Status = ?';
														$Execute_Account = array($MID,'1');
														$Amount = $Display->Display_Single_Info_Modified($sql_account,'Amount',$Execute_Account);
														$Amount_Array[] = sprintf('%.2f',$Amount);
														
														$sql_log = 'SELECT OID FROM logs WHERE Table_Name = ? AND Action = ? AND RID = ?';
														$Execute_log = array('users','1',$MID);
														$OID = $Display->Display_Single_Info_Modified($sql_log,'OID',$Execute_log);
														
														$sql_oid = 'SELECT First_Name FROM users WHERE ID = ?';
														$Execute_oid = array($OID);
														$Creator_First_Name = $Display->Display_Single_Info_Modified($sql_oid,'First_Name',$Execute_oid);
														
														$Log_Creator[] = $Creator_First_Name;
														
														$MID_Array[] = $MID;
														$Sender_Name_Array[] = $rows->Sender_Name;
													}
											}
										else
											{
												$sql_offer = 'SELECT AID FROM '.$Table_Offers.' WHERE Status = ? AND Ads_Sub_Cat = ?';
												$Execute_Offers = array('1',$Sub_Cat_ID);
												$results_offers = $Display->Display_Info($sql_offer,$Execute_Offers);
												$AID_Array = array();
												foreach($results_offers as $rows_offers)
													{
														$AID_Array[] = $rows_offers->AID;
													}
												$sql = 'SELECT Sender_Name,Country FROM users WHERE ID = ? AND (Starts_Date <= ? AND End_Date >= ?)';
												$Execute_Array = array($MID,$Starts_Date,$End_Date);
												$results = $Display->Display_Info($sql,$Execute_Array);
												foreach($results as $rows)
													{
														if(in_array($MID,$AID_Array))
															{
																$sql_country = 'SELECT Name FROM '.$Table.' WHERE ID = ?';
																$Execute_Country = array($rows->Country);
																$Country_Name = $Display->Display_Single_Info_Modified($sql_country,'Name',$Execute_Country);
																$Country_Name_Array[] = $Country_Name;
																
																$sql_account = 'SELECT Amount FROM merchant_accounts WHERE MID = ? AND Status = ?';
																$Execute_Account = array($MID,'1');
																$Amount = $Display->Display_Single_Info_Modified($sql_account,'Amount',$Execute_Account);
																$Amount_Array[] = sprintf('%.2f',$Amount);
																
																$sql_log = 'SELECT OID FROM logs WHERE Table_Name = ? AND Action = ? AND RID = ?';
																$Execute_log = array('users','1',$MID);
																$OID = $Display->Display_Single_Info_Modified($sql_log,'OID',$Execute_log);
																
																$sql_oid = 'SELECT First_Name FROM users WHERE ID = ?';
																$Execute_oid = array($OID);
																$Creator_First_Name = $Display->Display_Single_Info_Modified($sql_oid,'First_Name',$Execute_oid);
																
																$Log_Creator[] = $Creator_First_Name;
																
																$MID_Array[] = $MID;
																$Sender_Name_Array[] = $rows->Sender_Name;
															}
													}
											}
										
										$this->registry->template->MID_Array = $MID_Array;
										$this->registry->template->Sender_Name_Array = $Sender_Name_Array;
										$this->registry->template->Country_Name_Array = $Country_Name_Array;
										$this->registry->template->Amount_Array = $Amount_Array;
										$this->registry->template->Log_Creator = $Log_Creator;
									}
								elseif(($Country != '999')&&($Sales_ID == '999')&&($MID != '999')&&($Cat_ID == '999'))
									{
										$MID_Array = array();
										$Sender_Name_Array = array();
										$Country_Name_Array = array();
										$Amount_Array = array();
										$Log_Creator = array();
										if($Sub_Cat_ID == '999')
											{
												$sql = 'SELECT Sender_Name,Country FROM users WHERE ID = ? AND (Starts_Date <= ? AND End_Date >= ?)';
												$Execute_Array = array($MID,$Starts_Date,$End_Date);
												$results = $Display->Display_Info($sql,$Execute_Array);
												foreach($results as $rows)
													{
														$sql_country = 'SELECT Name FROM '.$Table.' WHERE ID = ?';
														$Execute_Country = array($rows->Country);
														$Country_Name = $Display->Display_Single_Info_Modified($sql_country,'Name',$Execute_Country);
														$Country_Name_Array[] = $Country_Name;
														
														$sql_account = 'SELECT Amount FROM merchant_accounts WHERE MID = ? AND Status = ?';
														$Execute_Account = array($MID,'1');
														$Amount = $Display->Display_Single_Info_Modified($sql_account,'Amount',$Execute_Account);
														$Amount_Array[] = sprintf('%.2f',$Amount);
														
														$sql_log = 'SELECT OID FROM logs WHERE Table_Name = ? AND Action = ? AND RID = ? ';
														$Execute_log = array('users','1',$MID);
														$OID = $Display->Display_Single_Info_Modified($sql_log,'OID',$Execute_log);
														
														$sql_oid = 'SELECT First_Name FROM users WHERE ID = ?';
														$Execute_oid = array($OID);
														$Creator_First_Name = $Display->Display_Single_Info_Modified($sql_oid,'First_Name',$Execute_oid);
														
														$Log_Creator[] = $Creator_First_Name;
														
														$MID_Array[] = $MID;
														$Sender_Name_Array[] = $rows->Sender_Name;
													}
											}
										else
											{
												$sql_offer = 'SELECT AID FROM '.$Table_Offers.' WHERE Status = ? AND Ads_Sub_Cat = ?';
												$Execute_Offers = array('1',$Sub_Cat_ID);
												$results_offers = $Display->Display_Info($sql_offer,$Execute_Offers);
												$AID_Array = array();
												foreach($results_offers as $rows_offers)
													{
														$AID_Array[] = $rows_offers->AID;
													}
												$sql = 'SELECT Sender_Name,Country FROM users WHERE ID = ? AND (Starts_Date <= ? AND End_Date >= ?)';
												$Execute_Array = array($MID,$Starts_Date,$End_Date);
												$results = $Display->Display_Info($sql,$Execute_Array);
												foreach($results as $rows)
													{
														
														if(in_array($MID,$AID_Array))
															{
																$sql_country = 'SELECT Name FROM '.$Table.' WHERE ID = ?';
																$Execute_Country = array($rows->Country);
																$Country_Name = $Display->Display_Single_Info_Modified($sql_country,'Name',$Execute_Country);
																$Country_Name_Array[] = $Country_Name;
																
																$sql_account = 'SELECT Amount FROM merchant_accounts WHERE MID = ? AND Status = ?';
																$Execute_Account = array($MID,'1');
																$Amount = $Display->Display_Single_Info_Modified($sql_account,'Amount',$Execute_Account);
																$Amount_Array[] = sprintf('%.2f',$Amount);
																
																$sql_log = 'SELECT OID FROM logs WHERE Table_Name = ? AND Action = ? AND RID = ? ';
																$Execute_log = array('users','1',$MID);
																$OID = $Display->Display_Single_Info_Modified($sql_log,'OID',$Execute_log);
																
																$sql_oid = 'SELECT First_Name FROM users WHERE ID = ?';
																$Execute_oid = array($OID);
																$Creator_First_Name = $Display->Display_Single_Info_Modified($sql_oid,'First_Name',$Execute_oid);
																
																$Log_Creator[] = $Creator_First_Name;
																
																$MID_Array[] = $MID;
																$Sender_Name_Array[] = $rows->Sender_Name;
															}
													}
											}
										
										$this->registry->template->MID_Array = $MID_Array;
										$this->registry->template->Sender_Name_Array = $Sender_Name_Array;
										$this->registry->template->Country_Name_Array = $Country_Name_Array;
										$this->registry->template->Amount_Array = $Amount_Array;
										$this->registry->template->Log_Creator = $Log_Creator;
									}
								elseif(($Country == '999')&&($Sales_ID != '999')&&($MID != '999')&&($Cat_ID == '999'))
									{
										$MID_Array = array();
										$Sender_Name_Array = array();
										$Country_Name_Array = array();
										$Amount_Array = array();
										$Log_Creator = array();
										if($Sub_Cat_ID == '999')
											{
												$sql = 'SELECT Sender_Name,Country FROM users WHERE ID = ? AND (Starts_Date <= ? AND End_Date >= ?)';
												$Execute_Array = array($MID,$Starts_Date,$End_Date);
												$results = $Display->Display_Info($sql,$Execute_Array);
												foreach($results as $rows)
													{
														$sql_country = 'SELECT Name FROM '.$Table.' WHERE ID = ?';
														$Execute_Country = array($rows->Country);
														$Country_Name = $Display->Display_Single_Info_Modified($sql_country,'Name',$Execute_Country);
														$Country_Name_Array[] = $Country_Name;
														
														$sql_account = 'SELECT Amount FROM merchant_accounts WHERE MID = ? AND Status = ?';
														$Execute_Account = array($MID,'1');
														$Amount = $Display->Display_Single_Info_Modified($sql_account,'Amount',$Execute_Account);
														$Amount_Array[] = sprintf('%.2f',$Amount);
														
														$sql_log = 'SELECT OID FROM logs WHERE Table_Name = ? AND Action = ? AND RID = ?';
														$Execute_log = array('users','1',$MID);
														$OID = $Display->Display_Single_Info_Modified($sql_log,'OID',$Execute_log);
														
														$sql_oid = 'SELECT First_Name FROM users WHERE ID = ?';
														$Execute_oid = array($OID);
														$Creator_First_Name = $Display->Display_Single_Info_Modified($sql_oid,'First_Name',$Execute_oid);
														
														$Log_Creator[] = $Creator_First_Name;
														$MID_Array[] = $MID;
														$Sender_Name_Array[] = $rows->Sender_Name;
													}
											}
										else
											{
												$sql_offer = 'SELECT AID FROM '.$Table_Offers.' WHERE Status = ? AND Ads_Sub_Cat = ?';
												$Execute_Offers = array('1',$Sub_Cat_ID);
												$results_offers = $Display->Display_Info($sql_offer,$Execute_Offers);
												$AID_Array = array();
												foreach($results_offers as $rows_offers)
													{
														$AID_Array[] = $rows_offers->AID;
													}
												$sql = 'SELECT Sender_Name,Country FROM users WHERE ID = ? AND (Starts_Date <= ? AND End_Date >= ?)';
												$Execute_Array = array($MID,$Starts_Date,$End_Date);
												$results = $Display->Display_Info($sql,$Execute_Array);
												foreach($results as $rows)
													{
														if(in_array($MID,$AID_Array))
															{
																$sql_country = 'SELECT Name FROM '.$Table.' WHERE ID = ?';
																$Execute_Country = array($rows->Country);
																$Country_Name = $Display->Display_Single_Info_Modified($sql_country,'Name',$Execute_Country);
																$Country_Name_Array[] = $Country_Name;
																
																$sql_account = 'SELECT Amount FROM merchant_accounts WHERE MID = ? AND Status = ?';
																$Execute_Account = array($MID,'1');
																$Amount = $Display->Display_Single_Info_Modified($sql_account,'Amount',$Execute_Account);
																$Amount_Array[] = sprintf('%.2f',$Amount);
																
																$sql_log = 'SELECT OID FROM logs WHERE Table_Name = ? AND Action = ? AND RID = ?';
																$Execute_log = array('users','1',$MID);
																$OID = $Display->Display_Single_Info_Modified($sql_log,'OID',$Execute_log);
																
																$sql_oid = 'SELECT First_Name FROM users WHERE ID = ?';
																$Execute_oid = array($OID);
																$Creator_First_Name = $Display->Display_Single_Info_Modified($sql_oid,'First_Name',$Execute_oid);
																
																$Log_Creator[] = $Creator_First_Name;
																$MID_Array[] = $MID;
																$Sender_Name_Array[] = $rows->Sender_Name;
															}
													}
											}
										
										$this->registry->template->MID_Array = $MID_Array;
										$this->registry->template->Sender_Name_Array = $Sender_Name_Array;
										$this->registry->template->Country_Name_Array = $Country_Name_Array;
										$this->registry->template->Amount_Array = $Amount_Array;
										$this->registry->template->Log_Creator = $Log_Creator;
									}
								elseif(($Country != '999')&&($Sales_ID != '999')&&($MID != '999')&&($Cat_ID == '999'))
									{
										$MID_Array = array();
										$Sender_Name_Array = array();
										$Country_Name_Array = array();
										$Amount_Array = array();
										$Log_Creator = array();
										if($Sub_Cat_ID == '999')
											{
												$sql = 'SELECT Sender_Name,Country FROM users WHERE ID = ? AND (Starts_Date <= ? AND End_Date >= ?)';
												$Execute_Array = array($MID,$Starts_Date,$End_Date);
												$results = $Display->Display_Info($sql,$Execute_Array);
												foreach($results as $rows)
													{
														$sql_country = 'SELECT Name FROM '.$Table.' WHERE ID = ?';
														$Execute_Country = array($rows->Country);
														$Country_Name = $Display->Display_Single_Info_Modified($sql_country,'Name',$Execute_Country);
														$Country_Name_Array[] = $Country_Name;
														
														$sql_account = 'SELECT Amount FROM merchant_accounts WHERE MID = ? AND Status = ?';
														$Execute_Account = array($MID,'1');
														$Amount = $Display->Display_Single_Info_Modified($sql_account,'Amount',$Execute_Account);
														$Amount_Array[] = sprintf('%.2f',$Amount);
														
														$sql_log = 'SELECT OID FROM logs WHERE Table_Name = ? AND Action = ? AND RID = ? ';
														$Execute_log = array('users','1',$MID);
														$OID = $Display->Display_Single_Info_Modified($sql_log,'OID',$Execute_log);
														
														$sql_oid = 'SELECT First_Name FROM users WHERE ID = ?';
														$Execute_oid = array($OID);
														$Creator_First_Name = $Display->Display_Single_Info_Modified($sql_oid,'First_Name',$Execute_oid);
														
														$Log_Creator[] = $Creator_First_Name;
														$MID_Array[] = $MID;
														$Sender_Name_Array[] = $rows->Sender_Name;
													}
											}
										else
											{
												$sql_offer = 'SELECT AID FROM '.$Table_Offers.' WHERE Status = ? AND Ads_Sub_Cat = ?';
												$Execute_Offers = array('1',$Sub_Cat_ID);
												$results_offers = $Display->Display_Info($sql_offer,$Execute_Offers);
												$AID_Array = array();
												foreach($results_offers as $rows_offers)
													{
														$AID_Array[] = $rows_offers->AID;
													}
												$sql = 'SELECT Sender_Name,Country FROM users WHERE ID = ? AND (Starts_Date <= ? AND End_Date >= ?)';
												$Execute_Array = array($MID,$Starts_Date,$End_Date);
												$results = $Display->Display_Info($sql,$Execute_Array);
												foreach($results as $rows)
													{
														
														if(in_array($MID,$AID_Array))
															{
																$sql_country = 'SELECT Name FROM '.$Table.' WHERE ID = ?';
																$Execute_Country = array($rows->Country);
																$Country_Name = $Display->Display_Single_Info_Modified($sql_country,'Name',$Execute_Country);
																$Country_Name_Array[] = $Country_Name;
																
																$sql_account = 'SELECT Amount FROM merchant_accounts WHERE MID = ? AND Status = ?';
																$Execute_Account = array($MID,'1');
																$Amount = $Display->Display_Single_Info_Modified($sql_account,'Amount',$Execute_Account);
																$Amount_Array[] = sprintf('%.2f',$Amount);
																
																$sql_log = 'SELECT OID FROM logs WHERE Table_Name = ? AND Action = ? AND RID = ? ';
																$Execute_log = array('users','1',$MID);
																$OID = $Display->Display_Single_Info_Modified($sql_log,'OID',$Execute_log);
																
																$sql_oid = 'SELECT First_Name FROM users WHERE ID = ?';
																$Execute_oid = array($OID);
																$Creator_First_Name = $Display->Display_Single_Info_Modified($sql_oid,'First_Name',$Execute_oid);
																
																$Log_Creator[] = $Creator_First_Name;
																$MID_Array[] = $MID;
																$Sender_Name_Array[] = $rows->Sender_Name;
															}
													}
											}
										
										$this->registry->template->MID_Array = $MID_Array;
										$this->registry->template->Sender_Name_Array = $Sender_Name_Array;
										$this->registry->template->Country_Name_Array = $Country_Name_Array;
										$this->registry->template->Amount_Array = $Amount_Array;
										$this->registry->template->Log_Creator = $Log_Creator;
									}
								elseif(($Country == '999')&&($Sales_ID == '999')&&($MID == '999')&&($Cat_ID != '999'))
									{
										$MID_Array = array();
										$Sender_Name_Array = array();
										$Country_Name_Array = array();
										$Amount_Array = array();
										$Log_Creator = array();
										if($Sub_Cat_ID == '999')
											{
												$sql = 'SELECT ID,Sender_Name,Country FROM users WHERE Level = ? AND Status = ? AND Ads_Cat = ? AND (Starts_Date <= ? AND End_Date >= ?)';
												$Execute_Array = array('2','1',$Cat_ID,$Starts_Date,$End_Date);
												$results = $Display->Display_Info($sql,$Execute_Array);
												foreach($results as $rows)
													{
														$sql_country = 'SELECT Name FROM '.$Table.' WHERE ID = ?';
														$Execute_Country = array($rows->Country);
														$Country_Name = $Display->Display_Single_Info_Modified($sql_country,'Name',$Execute_Country);
														$Country_Name_Array[] = $Country_Name;
														
														$sql_account = 'SELECT Amount FROM merchant_accounts WHERE MID = ? AND Status = ?';
														$Execute_Account = array($rows->ID,'1');
														$Amount = $Display->Display_Single_Info_Modified($sql_account,'Amount',$Execute_Account);
														$Amount_Array[] = sprintf('%.2f',$Amount);
														
														$sql_log = 'SELECT OID FROM logs WHERE Table_Name = ? AND Action = ? AND RID = ? ';
														$Execute_log = array('users','1',$rows->ID);
														$OID = $Display->Display_Single_Info_Modified($sql_log,'OID',$Execute_log);
														
														$sql_oid = 'SELECT First_Name FROM users WHERE ID = ?';
														$Execute_oid = array($OID);
														$Creator_First_Name = $Display->Display_Single_Info_Modified($sql_oid,'First_Name',$Execute_oid);
														
														$Log_Creator[] = $Creator_First_Name;
														$MID_Array[] = $rows->ID;
														$Sender_Name_Array[] = $rows->Sender_Name;
													}
											}
										else
											{
												$sql_offer = 'SELECT AID FROM '.$Table_Offers.' WHERE Status = ? AND Ads_Sub_Cat = ?';
												$Execute_Offers = array('1',$Sub_Cat_ID);
												$results_offers = $Display->Display_Info($sql_offer,$Execute_Offers);
												$AID_Array = array();
												foreach($results_offers as $rows_offers)
													{
														$AID_Array[] = $rows_offers->AID;
													}
												$sql = 'SELECT ID,Sender_Name,Country FROM users WHERE Level = ? AND Status = ? AND Ads_Cat = ? AND (Starts_Date <= ? AND End_Date >= ?)';
												$Execute_Array = array('2','1',$Cat_ID,$Starts_Date,$End_Date);
												$results = $Display->Display_Info($sql,$Execute_Array);
												foreach($results as $rows)
													{
														
														if(in_array($rows->ID,$AID_Array))
															{
																$sql_country = 'SELECT Name FROM '.$Table.' WHERE ID = ?';
																$Execute_Country = array($rows->Country);
																$Country_Name = $Display->Display_Single_Info_Modified($sql_country,'Name',$Execute_Country);
																$Country_Name_Array[] = $Country_Name;
																
																$sql_account = 'SELECT Amount FROM merchant_accounts WHERE MID = ? AND Status = ?';
																$Execute_Account = array($rows->ID,'1');
																$Amount = $Display->Display_Single_Info_Modified($sql_account,'Amount',$Execute_Account);
																$Amount_Array[] = sprintf('%.2f',$Amount);
																
																$sql_log = 'SELECT OID FROM logs WHERE Table_Name = ? AND Action = ? AND RID = ? ';
																$Execute_log = array('users','1',$rows->ID);
																$OID = $Display->Display_Single_Info_Modified($sql_log,'OID',$Execute_log);
																
																$sql_oid = 'SELECT First_Name FROM users WHERE ID = ?';
																$Execute_oid = array($OID);
																$Creator_First_Name = $Display->Display_Single_Info_Modified($sql_oid,'First_Name',$Execute_oid);
																
																$Log_Creator[] = $Creator_First_Name;
																$MID_Array[] = $rows->ID;
																$Sender_Name_Array[] = $rows->Sender_Name;
															}
													}
											}
										
										$this->registry->template->MID_Array = $MID_Array;
										$this->registry->template->Sender_Name_Array = $Sender_Name_Array;
										$this->registry->template->Country_Name_Array = $Country_Name_Array;
										$this->registry->template->Amount_Array = $Amount_Array;
										$this->registry->template->Log_Creator = $Log_Creator;
									}
								elseif(($Country != '999')&&($Sales_ID == '999')&&($MID == '999')&&($Cat_ID != '999'))
									{
										$MID_Array = array();
										$Sender_Name_Array = array();
										$Country_Name_Array = array();
										$Amount_Array = array();
										$Log_Creator = array();
										if($Sub_Cat_ID == '999')
											{
												$sql = 'SELECT ID,Sender_Name,Country FROM users WHERE Level = ? AND Status = ? AND Ads_Cat = ? AND Country = ? AND (Starts_Date <= ? AND End_Date >= ?)';
												$Execute_Array = array('2','1',$Cat_ID,$Country,$Starts_Date,$End_Date);
												$results = $Display->Display_Info($sql,$Execute_Array);
												foreach($results as $rows)
													{
														$sql_country = 'SELECT Name FROM '.$Table.' WHERE ID = ?';
														$Execute_Country = array($rows->Country);
														$Country_Name = $Display->Display_Single_Info_Modified($sql_country,'Name',$Execute_Country);
														$Country_Name_Array[] = $Country_Name;
														
														$sql_account = 'SELECT Amount FROM merchant_accounts WHERE MID = ? AND Status = ?';
														$Execute_Account = array($rows->ID,'1');
														$Amount = $Display->Display_Single_Info_Modified($sql_account,'Amount',$Execute_Account);
														$Amount_Array[] = sprintf('%.2f',$Amount);
														
														$sql_log = 'SELECT OID FROM logs WHERE Table_Name = ? AND Action = ? AND RID = ? ';
														$Execute_log = array('users','1',$rows->ID);
														$OID = $Display->Display_Single_Info_Modified($sql_log,'OID',$Execute_log);
														
														$sql_oid = 'SELECT First_Name FROM users WHERE ID = ?';
														$Execute_oid = array($OID);
														$Creator_First_Name = $Display->Display_Single_Info_Modified($sql_oid,'First_Name',$Execute_oid);
														
														$Log_Creator[] = $Creator_First_Name;
														$MID_Array[] = $rows->ID;
														$Sender_Name_Array[] = $rows->Sender_Name;
													}
											}
										else
											{
												$sql_offer = 'SELECT AID FROM '.$Table_Offers.' WHERE Status = ? AND Ads_Sub_Cat = ?';
												$Execute_Offers = array('1',$Sub_Cat_ID);
												$results_offers = $Display->Display_Info($sql_offer,$Execute_Offers);
												$AID_Array = array();
												foreach($results_offers as $rows_offers)
													{
														$AID_Array[] = $rows_offers->AID;
													}
												$sql = 'SELECT ID,Sender_Name,Country FROM users WHERE Level = ? AND Status = ? AND Ads_Cat = ? AND Country = ? AND (Starts_Date <= ? AND End_Date >= ?)';
												$Execute_Array = array('2','1',$Cat_ID,$Country,$Starts_Date,$End_Date);
												$results = $Display->Display_Info($sql,$Execute_Array);
												foreach($results as $rows)
													{
														
														if(in_array($rows->ID,$AID_Array))
															{
																$sql_country = 'SELECT Name FROM '.$Table.' WHERE ID = ?';
																$Execute_Country = array($rows->Country);
																$Country_Name = $Display->Display_Single_Info_Modified($sql_country,'Name',$Execute_Country);
																$Country_Name_Array[] = $Country_Name;
																
																$sql_account = 'SELECT Amount FROM merchant_accounts WHERE MID = ? AND Status = ?';
																$Execute_Account = array($rows->ID,'1');
																$Amount = $Display->Display_Single_Info_Modified($sql_account,'Amount',$Execute_Account);
																$Amount_Array[] = sprintf('%.2f',$Amount);
																
																$sql_log = 'SELECT OID FROM logs WHERE Table_Name = ? AND Action = ? AND RID = ? ';
																$Execute_log = array('users','1',$rows->ID);
																$OID = $Display->Display_Single_Info_Modified($sql_log,'OID',$Execute_log);
																
																$sql_oid = 'SELECT First_Name FROM users WHERE ID = ?';
																$Execute_oid = array($OID);
																$Creator_First_Name = $Display->Display_Single_Info_Modified($sql_oid,'First_Name',$Execute_oid);
																
																$Log_Creator[] = $Creator_First_Name;
																$MID_Array[] = $rows->ID;
																$Sender_Name_Array[] = $rows->Sender_Name;
															}
													}
											}
										
										$this->registry->template->MID_Array = $MID_Array;
										$this->registry->template->Sender_Name_Array = $Sender_Name_Array;
										$this->registry->template->Country_Name_Array = $Country_Name_Array;
										$this->registry->template->Amount_Array = $Amount_Array;
										$this->registry->template->Log_Creator = $Log_Creator;
									}
								elseif(($Country == '999')&&($Sales_ID != '999')&&($MID == '999')&&($Cat_ID != '999'))
									{
										$MID_Array = array();
										$Sender_Name_Array = array();
										$MID_Array_Non_Filtered = array();
										$Country_Name_Array = array();
										$Amount_Array = array();
										$Log_Creator = array();
										if($Sub_Cat_ID == '999')
											{
												$sql = 'SELECT RID FROM logs WHERE Table_Name = ? AND Action = ? AND OID = ?';
												$Execute_Array = array('users','1',$Sales_ID);
												$results = $Display->Display_Info($sql,$Execute_Array);
												foreach($results as $rows)
													{
														$MID_Array_Non_Filtered[] = $rows->RID;
													}
												$sql_users = 'SELECT ID,Sender_Name,Country FROM users WHERE Status = ? AND Level = ? AND Ads_Cat = ? AND (Starts_Date <= ? AND End_Date >= ?)';
												$Execute_Array = array('1','2',$Cat_ID,$Starts_Date,$End_Date);
												$results = $Display->Display_Info($sql_users,$Execute_Array);
												foreach($results as $rows)
													{
														if(in_array($rows->ID,$MID_Array_Non_Filtered))
															{
																$sql_country = 'SELECT Name FROM '.$Table.' WHERE ID = ?';
																$Execute_Country = array($rows->Country);
																$Country_Name = $Display->Display_Single_Info_Modified($sql_country,'Name',$Execute_Country);
																$Country_Name_Array[] = $Country_Name;
																
																$sql_account = 'SELECT Amount FROM merchant_accounts WHERE MID = ? AND Status = ?';
																$Execute_Account = array($rows->ID,'1');
																$Amount = $Display->Display_Single_Info_Modified($sql_account,'Amount',$Execute_Account);
																$Amount_Array[] = sprintf('%.2f',$Amount);
																
																$sql_log = 'SELECT OID FROM logs WHERE Table_Name = ? AND Action = ? AND RID = ? ';
																$Execute_log = array('users','1',$rows->ID);
																$OID = $Display->Display_Single_Info_Modified($sql_log,'OID',$Execute_log);
																
																$sql_oid = 'SELECT First_Name FROM users WHERE ID = ?';
																$Execute_oid = array($OID);
																$Creator_First_Name = $Display->Display_Single_Info_Modified($sql_oid,'First_Name',$Execute_oid);
																
																$Log_Creator[] = $Creator_First_Name;
														
																$MID_Array[] = $rows->ID;
																$Sender_Name_Array[] = $rows->Sender_Name;
															} 
													}
											}
										else
											{
												$sql_offer = 'SELECT AID FROM '.$Table_Offers.' WHERE Status = ? AND Ads_Sub_Cat = ?';
												$Execute_Offers = array('1',$Sub_Cat_ID);
												$results_offers = $Display->Display_Info($sql_offer,$Execute_Offers);
												$AID_Array = array();
												foreach($results_offers as $rows_offers)
													{
														$AID_Array[] = $rows_offers->AID;
													}
												$sql = 'SELECT RID FROM logs WHERE Table_Name = ? AND Action = ? AND OID = ?';
												$Execute_Array = array('users','1',$Sales_ID);
												$results = $Display->Display_Info($sql,$Execute_Array);
												foreach($results as $rows)
													{
														$MID_Array_Non_Filtered[] = $rows->RID;
													}
												$sql_users = 'SELECT ID,Sender_Name,Country FROM users WHERE Status = ? AND Level = ? AND Ads_Cat = ? AND (Starts_Date <= ? AND End_Date >= ?)';
												$Execute_Array = array('1','2',$Cat_ID,$Starts_Date,$End_Date);
												$results = $Display->Display_Info($sql_users,$Execute_Array);
												foreach($results as $rows)
													{
														if(in_array($rows->ID,$MID_Array_Non_Filtered))
															{
																
																if(in_array($rows->ID,$AID_Array))
																	{
																		$sql_country = 'SELECT Name FROM '.$Table.' WHERE ID = ?';
																		$Execute_Country = array($rows->Country);
																		$Country_Name = $Display->Display_Single_Info_Modified($sql_country,'Name',$Execute_Country);
																		$Country_Name_Array[] = $Country_Name;
																		
																		$sql_account = 'SELECT Amount FROM merchant_accounts WHERE MID = ? AND Status = ?';
																		$Execute_Account = array($rows->ID,'1');
																		$Amount = $Display->Display_Single_Info_Modified($sql_account,'Amount',$Execute_Account);
																		$Amount_Array[] = sprintf('%.2f',$Amount);
																		
																		$sql_log = 'SELECT OID FROM logs WHERE Table_Name = ? AND Action = ? AND RID = ? ';
																		$Execute_log = array('users','1',$rows->ID);
																		$OID = $Display->Display_Single_Info_Modified($sql_log,'OID',$Execute_log);
																		
																		$sql_oid = 'SELECT First_Name FROM users WHERE ID = ?';
																		$Execute_oid = array($OID);
																		$Creator_First_Name = $Display->Display_Single_Info_Modified($sql_oid,'First_Name',$Execute_oid);
																		
																		$Log_Creator[] = $Creator_First_Name;
																
																		$MID_Array[] = $rows->ID;
																		$Sender_Name_Array[] = $rows->Sender_Name;
																	}
															} 
													}
											}
										
										$this->registry->template->MID_Array = $MID_Array;
										$this->registry->template->Sender_Name_Array = $Sender_Name_Array;
										$this->registry->template->Country_Name_Array = $Country_Name_Array;
										$this->registry->template->Amount_Array = $Amount_Array;
										$this->registry->template->Log_Creator = $Log_Creator;
									}
								elseif(($Country != '999')&&($Sales_ID != '999')&&($MID == '999')&&($Cat_ID != '999'))
									{
										$MID_Array = array();
										$Sender_Name_Array = array();
										$MID_Array_Non_Filtered = array();
										$Country_Name_Array = array();
										$Amount_Array = array();
										$Log_Creator = array();
										if($Sub_Cat_ID == '999')
											{
												$sql = 'SELECT RID FROM logs WHERE Table_Name = ? AND Action = ? AND OID = ?';
												$Execute_Array = array('users','1',$Sales_ID);
												$results = $Display->Display_Info($sql,$Execute_Array);
												foreach($results as $rows)
													{
														$MID_Array_Non_Filtered[] = $rows->RID;
													}
												$sql_users = 'SELECT ID,Sender_Name,Country FROM users WHERE Status = ? AND Level = ? AND Ads_Cat = ? AND Country = ? AND (Starts_Date <= ? AND End_Date >= ?)';
												$Execute_Array = array('1','2',$Cat_ID,$Country,$Starts_Date,$End_Date);
												$results = $Display->Display_Info($sql_users,$Execute_Array);
												foreach($results as $rows)
													{
														if(in_array($rows->ID,$MID_Array_Non_Filtered))
															{
																$sql_country = 'SELECT Name FROM '.$Table.' WHERE ID = ?';
																$Execute_Country = array($rows->Country);
																$Country_Name = $Display->Display_Single_Info_Modified($sql_country,'Name',$Execute_Country);
																$Country_Name_Array[] = $Country_Name;
																
																$sql_account = 'SELECT Amount FROM merchant_accounts WHERE MID = ? AND Status = ?';
																$Execute_Account = array($rows->ID,'1');
																$Amount = $Display->Display_Single_Info_Modified($sql_account,'Amount',$Execute_Account);
																$Amount_Array[] = sprintf('%.2f',$Amount);
																
																$sql_log = 'SELECT OID FROM logs WHERE Table_Name = ? AND Action = ? AND RID = ? ';
																$Execute_log = array('users','1',$rows->ID);
																$OID = $Display->Display_Single_Info_Modified($sql_log,'OID',$Execute_log);
																
																$sql_oid = 'SELECT First_Name FROM users WHERE ID = ?';
																$Execute_oid = array($OID);
																$Creator_First_Name = $Display->Display_Single_Info_Modified($sql_oid,'First_Name',$Execute_oid);
																
																$Log_Creator[] = $Creator_First_Name;
																$MID_Array[] = $rows->ID;
																$Sender_Name_Array[] = $rows->Sender_Name;
															} 
													}
											}
										else
											{
												$sql_offer = 'SELECT AID FROM '.$Table_Offers.' WHERE Status = ? AND Ads_Sub_Cat = ?';
												$Execute_Offers = array('1',$Sub_Cat_ID);
												$results_offers = $Display->Display_Info($sql_offer,$Execute_Offers);
												$AID_Array = array();
												foreach($results_offers as $rows_offers)
													{
														$AID_Array[] = $rows_offers->AID;
													}
												$sql = 'SELECT RID FROM logs WHERE Table_Name = ? AND Action = ? AND OID = ?';
												$Execute_Array = array('users','1',$Sales_ID);
												$results = $Display->Display_Info($sql,$Execute_Array);
												foreach($results as $rows)
													{
														$MID_Array_Non_Filtered[] = $rows->RID;
													}
												$sql_users = 'SELECT ID,Sender_Name,Country FROM users WHERE Status = ? AND Level = ? AND Ads_Cat = ? AND Country = ? AND (Starts_Date <= ? AND End_Date >= ?)';
												$Execute_Array = array('1','2',$Cat_ID,$Country,$Starts_Date,$End_Date);
												$results = $Display->Display_Info($sql_users,$Execute_Array);
												foreach($results as $rows)
													{
														if(in_array($rows->ID,$MID_Array_Non_Filtered))
															{
																
																if(in_array($rows->ID,$AID_Array))
																	{
																		$sql_country = 'SELECT Name FROM '.$Table.' WHERE ID = ?';
																		$Execute_Country = array($rows->Country);
																		$Country_Name = $Display->Display_Single_Info_Modified($sql_country,'Name',$Execute_Country);
																		$Country_Name_Array[] = $Country_Name;
																		
																		$sql_account = 'SELECT Amount FROM merchant_accounts WHERE MID = ? AND Status = ?';
																		$Execute_Account = array($rows->ID,'1');
																		$Amount = $Display->Display_Single_Info_Modified($sql_account,'Amount',$Execute_Account);
																		$Amount_Array[] = sprintf('%.2f',$Amount);
																		
																		$sql_log = 'SELECT OID FROM logs WHERE Table_Name = ? AND Action = ? AND RID = ? ';
																		$Execute_log = array('users','1',$rows->ID);
																		$OID = $Display->Display_Single_Info_Modified($sql_log,'OID',$Execute_log);
																		
																		$sql_oid = 'SELECT First_Name FROM users WHERE ID = ?';
																		$Execute_oid = array($OID);
																		$Creator_First_Name = $Display->Display_Single_Info_Modified($sql_oid,'First_Name',$Execute_oid);
																		
																		$Log_Creator[] = $Creator_First_Name;
																		$MID_Array[] = $rows->ID;
																		$Sender_Name_Array[] = $rows->Sender_Name;
																	}
															} 
													}
											}
										
										$this->registry->template->MID_Array = $MID_Array;
										$this->registry->template->Sender_Name_Array = $Sender_Name_Array;
										$this->registry->template->Country_Name_Array = $Country_Name_Array;
										$this->registry->template->Amount_Array = $Amount_Array;
										$this->registry->template->Log_Creator = $Log_Creator;
									}
								elseif(($Country == '999')&&($Sales_ID == '999')&&($MID != '999')&&($Cat_ID != '999'))
									{
										$MID_Array = array();
										$Sender_Name_Array = array();
										$Country_Name_Array = array();
										$Amount_Array = array();
										$Log_Creator = array();
										if($Sub_Cat_ID == '999')
											{
												$sql = 'SELECT Sender_Name,Country FROM users WHERE ID = ? AND (Starts_Date <= ? AND End_Date >= ?)';
												$Execute_Array = array($MID,$Starts_Date,$End_Date);
												$results = $Display->Display_Info($sql,$Execute_Array);
												foreach($results as $rows)
													{
														$sql_country = 'SELECT Name FROM '.$Table.' WHERE ID = ?';
														$Execute_Country = array($rows->Country);
														$Country_Name = $Display->Display_Single_Info_Modified($sql_country,'Name',$Execute_Country);
														$Country_Name_Array[] = $Country_Name;
														
														$sql_account = 'SELECT Amount FROM merchant_accounts WHERE MID = ? AND Status = ?';
														$Execute_Account = array($MID,'1');
														$Amount = $Display->Display_Single_Info_Modified($sql_account,'Amount',$Execute_Account);
														$Amount_Array[] = sprintf('%.2f',$Amount);
														
														$sql_log = 'SELECT OID FROM logs WHERE Table_Name = ? AND Action = ? AND RID = ?';
														$Execute_log = array('users','1',$MID);
														$OID = $Display->Display_Single_Info_Modified($sql_log,'OID',$Execute_log);
														
														$sql_oid = 'SELECT First_Name FROM users WHERE ID = ?';
														$Execute_oid = array($OID);
														$Creator_First_Name = $Display->Display_Single_Info_Modified($sql_oid,'First_Name',$Execute_oid);
														
														$Log_Creator[] = $Creator_First_Name;
														$MID_Array[] = $MID;
														$Sender_Name_Array[] = $rows->Sender_Name;
													}
											}
										else
											{
												$sql_offer = 'SELECT AID FROM '.$Table_Offers.' WHERE Status = ? AND Ads_Sub_Cat = ?';
												$Execute_Offers = array('1',$Sub_Cat_ID);
												$results_offers = $Display->Display_Info($sql_offer,$Execute_Offers);
												$AID_Array = array();
												foreach($results_offers as $rows_offers)
													{
														$AID_Array[] = $rows_offers->AID;
													}
												$sql = 'SELECT Sender_Name,Country FROM users WHERE ID = ?  AND (Starts_Date <= ? AND End_Date >= ?)';
												$Execute_Array = array($MID,$Starts_Date,$End_Date);
												$results = $Display->Display_Info($sql,$Execute_Array);
												foreach($results as $rows)
													{
														
														if(in_array($MID,$AID_Array))
															{
																$sql_country = 'SELECT Name FROM '.$Table.' WHERE ID = ?';
																$Execute_Country = array($rows->Country);
																$Country_Name = $Display->Display_Single_Info_Modified($sql_country,'Name',$Execute_Country);
																$Country_Name_Array[] = $Country_Name;
																
																$sql_account = 'SELECT Amount FROM merchant_accounts WHERE MID = ? AND Status = ?';
																$Execute_Account = array($MID,'1');
																$Amount = $Display->Display_Single_Info_Modified($sql_account,'Amount',$Execute_Account);
																$Amount_Array[] = sprintf('%.2f',$Amount);
																
																$sql_log = 'SELECT OID FROM logs WHERE Table_Name = ? AND Action = ? AND RID = ?';
																$Execute_log = array('users','1',$MID);
																$OID = $Display->Display_Single_Info_Modified($sql_log,'OID',$Execute_log);
																
																$sql_oid = 'SELECT First_Name FROM users WHERE ID = ?';
																$Execute_oid = array($OID);
																$Creator_First_Name = $Display->Display_Single_Info_Modified($sql_oid,'First_Name',$Execute_oid);
																
																$Log_Creator[] = $Creator_First_Name;
																$MID_Array[] = $MID;
																$Sender_Name_Array[] = $rows->Sender_Name;
															}
													}
											}
										
										$this->registry->template->MID_Array = $MID_Array;
										$this->registry->template->Sender_Name_Array = $Sender_Name_Array;
										$this->registry->template->Country_Name_Array = $Country_Name_Array;
										$this->registry->template->Amount_Array = $Amount_Array;
										$this->registry->template->Log_Creator = $Log_Creator;
									}
								elseif(($Country != '999')&&($Sales_ID == '999')&&($MID != '999')&&($Cat_ID != '999'))
									{
										$MID_Array = array();
										$Sender_Name_Array = array();
										$Country_Name_Array = array();
										$Amount_Array = array();
										$Log_Creator = array();
										if($Sub_Cat_ID == '999')
											{
												$sql = 'SELECT Sender_Name,Country FROM users WHERE ID = ?  AND (Starts_Date <= ? AND End_Date >= ?)';
												$Execute_Array = array($MID,$Starts_Date,$End_Date);
												$results = $Display->Display_Info($sql,$Execute_Array);
												foreach($results as $rows)
													{
														$sql_country = 'SELECT Name FROM '.$Table.' WHERE ID = ?';
														$Execute_Country = array($rows->Country);
														$Country_Name = $Display->Display_Single_Info_Modified($sql_country,'Name',$Execute_Country);
														$Country_Name_Array[] = $Country_Name;
														
														$sql_account = 'SELECT Amount FROM merchant_accounts WHERE MID = ? AND Status = ?';
														$Execute_Account = array($MID,'1');
														$Amount = $Display->Display_Single_Info_Modified($sql_account,'Amount',$Execute_Account);
														$Amount_Array[] = sprintf('%.2f',$Amount);
														
														$sql_log = 'SELECT OID FROM logs WHERE Table_Name = ? AND Action = ? AND RID = ? ';
														$Execute_log = array('users','1',$MID);
														$OID = $Display->Display_Single_Info_Modified($sql_log,'OID',$Execute_log);
														
														$sql_oid = 'SELECT First_Name FROM users WHERE ID = ?';
														$Execute_oid = array($OID);
														$Creator_First_Name = $Display->Display_Single_Info_Modified($sql_oid,'First_Name',$Execute_oid);
														
														$Log_Creator[] = $Creator_First_Name;
														$MID_Array[] = $MID;
														$Sender_Name_Array[] = $rows->Sender_Name;
													}
											}
										else
											{
												$sql_offer = 'SELECT AID FROM '.$Table_Offers.' WHERE Status = ? AND Ads_Sub_Cat = ?';
												$Execute_Offers = array('1',$Sub_Cat_ID);
												$results_offers = $Display->Display_Info($sql_offer,$Execute_Offers);
												$AID_Array = array();
												foreach($results_offers as $rows_offers)
													{
														$AID_Array[] = $rows_offers->AID;
													}
												$sql = 'SELECT Sender_Name,Country FROM users WHERE ID = ? AND (Starts_Date <= ? AND End_Date >= ?)';
												$Execute_Array = array($MID,$Starts_Date,$End_Date);
												$results = $Display->Display_Info($sql,$Execute_Array);
												foreach($results as $rows)
													{
														
														if(in_array($MID,$AID_Array))
															{
																$sql_country = 'SELECT Name FROM '.$Table.' WHERE ID = ?';
																$Execute_Country = array($rows->Country);
																$Country_Name = $Display->Display_Single_Info_Modified($sql_country,'Name',$Execute_Country);
																$Country_Name_Array[] = $Country_Name;
																
																$sql_account = 'SELECT Amount FROM merchant_accounts WHERE MID = ? AND Status = ?';
																$Execute_Account = array($MID,'1');
																$Amount = $Display->Display_Single_Info_Modified($sql_account,'Amount',$Execute_Account);
																$Amount_Array[] = sprintf('%.2f',$Amount);
																
																$sql_log = 'SELECT OID FROM logs WHERE Table_Name = ? AND Action = ? AND RID = ? ';
																$Execute_log = array('users','1',$MID);
																$OID = $Display->Display_Single_Info_Modified($sql_log,'OID',$Execute_log);
																
																$sql_oid = 'SELECT First_Name FROM users WHERE ID = ?';
																$Execute_oid = array($OID);
																$Creator_First_Name = $Display->Display_Single_Info_Modified($sql_oid,'First_Name',$Execute_oid);
																
																$Log_Creator[] = $Creator_First_Name;
																$MID_Array[] = $MID;
																$Sender_Name_Array[] = $rows->Sender_Name;
															}
													}
											}
										
										$this->registry->template->MID_Array = $MID_Array;
										$this->registry->template->Sender_Name_Array = $Sender_Name_Array;
										$this->registry->template->Country_Name_Array = $Country_Name_Array;
										$this->registry->template->Amount_Array = $Amount_Array;
										$this->registry->template->Log_Creator = $Log_Creator;
									}
								elseif(($Country == '999')&&($Sales_ID != '999')&&($MID != '999')&&($Cat_ID != '999'))
									{
										$MID_Array = array();
										$Sender_Name_Array = array();
										$Country_Name_Array = array();
										$Amount_Array = array();
										$Log_Creator = array();
										if($Sub_Cat_ID == '999')
											{
												$sql = 'SELECT Sender_Name,Country FROM users WHERE ID = ? AND (Starts_Date <= ? AND End_Date >= ?)';
												$Execute_Array = array($MID,$Starts_Date,$End_Date);
												$results = $Display->Display_Info($sql,$Execute_Array);
												foreach($results as $rows)
													{
														$sql_country = 'SELECT Name FROM '.$Table.' WHERE ID = ?';
														$Execute_Country = array($rows->Country);
														$Country_Name = $Display->Display_Single_Info_Modified($sql_country,'Name',$Execute_Country);
														$Country_Name_Array[] = $Country_Name;
														
														$sql_account = 'SELECT Amount FROM merchant_accounts WHERE MID = ? AND Status = ?';
														$Execute_Account = array($MID,'1');
														$Amount = $Display->Display_Single_Info_Modified($sql_account,'Amount',$Execute_Account);
														$Amount_Array[] = sprintf('%.2f',$Amount);
														
														$sql_log = 'SELECT OID FROM logs WHERE Table_Name = ? AND Action = ? AND RID = ?';
														$Execute_log = array('users','1',$MID);
														$OID = $Display->Display_Single_Info_Modified($sql_log,'OID',$Execute_log);
														
														$sql_oid = 'SELECT First_Name FROM users WHERE ID = ?';
														$Execute_oid = array($OID);
														$Creator_First_Name = $Display->Display_Single_Info_Modified($sql_oid,'First_Name',$Execute_oid);
														
														$Log_Creator[] = $Creator_First_Name;
														$MID_Array[] = $MID;
														$Sender_Name_Array[] = $rows->Sender_Name;
													}
											}
										else
											{
												$sql_offer = 'SELECT AID FROM '.$Table_Offers.' WHERE Status = ? AND Ads_Sub_Cat = ?';
												$Execute_Offers = array('1',$Sub_Cat_ID);
												$results_offers = $Display->Display_Info($sql_offer,$Execute_Offers);
												$AID_Array = array();
												foreach($results_offers as $rows_offers)
													{
														$AID_Array[] = $rows_offers->AID;
													}
												$sql = 'SELECT Sender_Name,Country FROM users WHERE ID = ? AND (Starts_Date <= ? AND End_Date >= ?)';
												$Execute_Array = array($MID,$Starts_Date,$End_Date);
												$results = $Display->Display_Info($sql,$Execute_Array);
												foreach($results as $rows)
													{
														
														if(in_array($MID,$AID_Array))
															{
																$sql_country = 'SELECT Name FROM '.$Table.' WHERE ID = ?';
																$Execute_Country = array($rows->Country);
																$Country_Name = $Display->Display_Single_Info_Modified($sql_country,'Name',$Execute_Country);
																$Country_Name_Array[] = $Country_Name;
																
																$sql_account = 'SELECT Amount FROM merchant_accounts WHERE MID = ? AND Status = ?';
																$Execute_Account = array($MID,'1');
																$Amount = $Display->Display_Single_Info_Modified($sql_account,'Amount',$Execute_Account);
																$Amount_Array[] = sprintf('%.2f',$Amount);
																
																$sql_log = 'SELECT OID FROM logs WHERE Table_Name = ? AND Action = ? AND RID = ?';
																$Execute_log = array('users','1',$MID);
																$OID = $Display->Display_Single_Info_Modified($sql_log,'OID',$Execute_log);
																
																$sql_oid = 'SELECT First_Name FROM users WHERE ID = ?';
																$Execute_oid = array($OID);
																$Creator_First_Name = $Display->Display_Single_Info_Modified($sql_oid,'First_Name',$Execute_oid);
																
																$Log_Creator[] = $Creator_First_Name;
																$MID_Array[] = $MID;
																$Sender_Name_Array[] = $rows->Sender_Name;
															}
													}
											}
										
										$this->registry->template->MID_Array = $MID_Array;
										$this->registry->template->Sender_Name_Array = $Sender_Name_Array;
										$this->registry->template->Country_Name_Array = $Country_Name_Array;
										$this->registry->template->Amount_Array = $Amount_Array;
										$this->registry->template->Log_Creator = $Log_Creator;
									}
								else
									{
										$MID_Array = array();
										$Sender_Name_Array = array();
										$Country_Name_Array = array();
										$Amount_Array = array();
										$Log_Creator = array();
										if($Sub_Cat_ID == '999')
											{
												$sql = 'SELECT ID,Sender_Name,Country FROM users WHERE Status = ? AND Level = ? AND (Starts_Date <= ? AND End_Date >= ?)';
												$Execute_Array = array('1','2',$Starts_Date,$End_Date);
												$results = $Display->Display_Info($sql,$Execute_Array);
												foreach($results as $rows)
													{
														$sql_country = 'SELECT Name FROM '.$Table.' WHERE ID = ?';
														$Execute_Country = array($rows->Country);
														$Country_Name = $Display->Display_Single_Info_Modified($sql_country,'Name',$Execute_Country);
														$Country_Name_Array[] = $Country_Name;
														
														$sql_account = 'SELECT Amount FROM merchant_accounts WHERE MID = ? AND Status = ?';
														$Execute_Account = array($rows->ID,'1');
														$Amount = $Display->Display_Single_Info_Modified($sql_account,'Amount',$Execute_Account);
														$Amount_Array[] = sprintf('%.2f',$Amount);
														
														$sql_log = 'SELECT OID FROM logs WHERE Table_Name = ? AND Action = ? AND RID = ?';
														$Execute_log = array('users','1',$rows->ID);
														$OID = $Display->Display_Single_Info_Modified($sql_log,'OID',$Execute_log);
														
														$sql_oid = 'SELECT First_Name FROM users WHERE ID = ?';
														$Execute_oid = array($OID);
														$Creator_First_Name = $Display->Display_Single_Info_Modified($sql_oid,'First_Name',$Execute_oid);
														
														$Log_Creator[] = $Creator_First_Name;
														$MID_Array[] = $rows->ID;
														$Sender_Name_Array[] = $rows->Sender_Name;
													}
											}
										else
											{
												$sql_offer = 'SELECT AID FROM '.$Table_Offers.' WHERE Status = ? AND Ads_Sub_Cat = ?';
												$Execute_Offers = array('1',$Sub_Cat_ID);
												$results_offers = $Display->Display_Info($sql_offer,$Execute_Offers);
												$AID_Array = array();
												foreach($results_offers as $rows_offers)
													{
														$AID_Array[] = $rows_offers->AID;
													}
												$sql = 'SELECT ID,Sender_Name,Country FROM users WHERE Status = ? AND Level = ? AND (Starts_Date <= ? AND End_Date >= ?)';
												$Execute_Array = array('1','2',$Starts_Date,$End_Date);
												$results = $Display->Display_Info($sql,$Execute_Array);
												foreach($results as $rows)
													{
														
														if(in_array($rows->ID,$AID_Array))
															{
																$sql_country = 'SELECT Name FROM '.$Table.' WHERE ID = ?';
																$Execute_Country = array($rows->Country);
																$Country_Name = $Display->Display_Single_Info_Modified($sql_country,'Name',$Execute_Country);
																$Country_Name_Array[] = $Country_Name;
																
																$sql_account = 'SELECT Amount FROM merchant_accounts WHERE MID = ? AND Status = ?';
																$Execute_Account = array($rows->ID,'1');
																$Amount = $Display->Display_Single_Info_Modified($sql_account,'Amount',$Execute_Account);
																$Amount_Array[] = sprintf('%.2f',$Amount);
																
																$sql_log = 'SELECT OID FROM logs WHERE Table_Name = ? AND Action = ? AND RID = ?';
																$Execute_log = array('users','1',$rows->ID);
																$OID = $Display->Display_Single_Info_Modified($sql_log,'OID',$Execute_log);
																
																$sql_oid = 'SELECT First_Name FROM users WHERE ID = ?';
																$Execute_oid = array($OID);
																$Creator_First_Name = $Display->Display_Single_Info_Modified($sql_oid,'First_Name',$Execute_oid);
																
																$Log_Creator[] = $Creator_First_Name;
																$MID_Array[] = $rows->ID;
																$Sender_Name_Array[] = $rows->Sender_Name;
															}
													}
											}
										
										$this->registry->template->MID_Array = $MID_Array;
										$this->registry->template->Sender_Name_Array = $Sender_Name_Array;
										$this->registry->template->Country_Name_Array = $Country_Name_Array;
										$this->registry->template->Amount_Array = $Amount_Array;
										$this->registry->template->Log_Creator = $Log_Creator;
									}
								
							}
						if(count($MID_Array))
							{
								$Total_Services = 0;
								foreach($MID_Array as $value)
									{
										$sql = 'SELECT ID FROM '.$Table_Services.' WHERE MID = ? AND Status = ?';
										$Execute_Array = array($value,'1');
										$Total_Records = $Display->Total_Records($sql,$Execute_Array);
										$Total_Services += $Total_Records;
									}
								$this->registry->template->Total_Services = $Total_Services;
								$this->registry->template->show('adminreports/display_sales_report');
							}
						else
							{
								$this->registry->template->show('admin_search/no_results');
							}
					}
			}
		public function display_category()
			{
				$Display = new sql();
				$MID = $_POST['MID'];
				$this->registry->template->MID = $MID;
				if(isset($_SESSION['Arabic']))
					{
						$Table = 'ads_cat';
						$Table_Merchants = 'merchant_services';
						$Table_Sub_Cat = 'ads_sub_cat';
					}
				else
					{
						$Table = 'ads_cat_english';
						$Table_Merchants = 'merchant_services_english';
						$Table_Sub_Cat = 'ads_sub_cat_english';
					}
				$Sub_Cat_Array = array();
				$Sub_Cat_ID_Array = array();
				if($MID == '999')
					{
						$sql = 'SELECT Ads_Cat FROM users WHERE Status = ? AND Level = ?';
						$Execute_Array = array('1','2');
						$sql_merchant = 'SELECT ID,Sub_Cat_Name FROM '.$Table_Sub_Cat.' WHERE Status = ?';
						$Execute_Array_Merchant = array('1');
						$results_merchants = $Display->Display_Info($sql_merchant,$Execute_Array_Merchant);
						foreach($results_merchants as $rows)
							{
								$Sub_Cat_Array[] = $rows->Sub_Cat_Name;
								$Sub_Cat_ID_Array[] = $rows->ID;
							}
					}
				else
					{
						$sql = 'SELECT Ads_Cat FROM users WHERE ID = ? AND Status = ?';
						$Execute_Array = array($MID,'1');
						$sql_merchant = 'SELECT SID FROM '.$Table_Merchants.' WHERE MID = ? AND Status = ?';
						$Execute_Array_Merchant = array($MID,'1');
						$results_merchants = $Display->Display_Info($sql_merchant,$Execute_Array_Merchant);
						foreach($results_merchants as $rows)
							{
								$sql_cat_sub_name = 'SELECT Sub_Cat_Name FROM '.$Table_Sub_Cat.' WHERE ID = ? AND Status = ?';
								$Execute_Array_M = array($rows->SID,'1');
								$Sub_Cat_Name = $Display->Display_Single_Info_Modified($sql_cat_sub_name,'Sub_Cat_Name',$Execute_Array_M);
								
								$Sub_Cat_Array[] = $Sub_Cat_Name;
								$Sub_Cat_ID_Array[] = $rows->SID;
							}
					}
				
				$Cat_ID_Array = array();
				$Cat_Name_Array = array();
				
				$results = $Display->Display_Info($sql,$Execute_Array);
				if(count($results))
					{
						foreach($results as $rows)
							{
								$sql_cat = 'SELECT Cat_Name FROM '.$Table.' WHERE ID = ?';
								$Execute_Array = array($rows->Ads_Cat);
								$Cat_Name = $Display->Display_Single_Info_Modified($sql_cat,'Cat_Name',$Execute_Array);
								
								$Cat_ID_Array[] = $rows->Ads_Cat;
								$Cat_Name_Array[] = $Cat_Name;
							}
						$this->registry->template->Cat_ID_Array = $Cat_ID_Array;
						$this->registry->template->Cat_Name_Array = $Cat_Name_Array;
						$this->registry->template->Sub_Cat_Array = $Sub_Cat_Array;
						$this->registry->template->Sub_Cat_ID_Array = $Sub_Cat_ID_Array;
						$this->registry->template->show('adminreports/display_category');
					}
				else
					{
						$this->registry->template->show('admin_search/no_results');
					}
			}
		public function display_merchants()
			{
				$Display = new sql();
				$OID = $_POST['OID'];
				if($OID == '999')
					{
						$sql = 'SELECT RID FROM logs WHERE Table_Name = ? AND Action = ?';
						$Execute_Array = array('users','1');
						
					}
				else
					{
						$sql = 'SELECT RID FROM logs WHERE Table_Name = ? AND Action = ? AND OID = ?';
						$Execute_Array = array('users','1',$OID);
					}
				
				$results = $Display->Display_Info($sql,$Execute_Array);
				$Sender_ID = array();
				$Sender_Name = array();
				if(count($results))
					{
						foreach($results as $rows)
							{
								$sql_merchants = 'SELECT Sender_Name FROM users WHERE Level = ? AND Status = ? AND ID = ?';
								$sql_merchants_2 = 'SELECT Sender_Name FROM users WHERE Level = "2" AND Status = "1" AND ID = '.$rows->RID;
								$Execute_Array = array('2','1',$rows->RID);
								$results_merchants = $Display->Display_Info($sql_merchants,$Execute_Array);
								foreach($results_merchants as $rows_merchants)
									{
										$Sender_ID[] = $rows->RID;
										$Sender_Name[] = $rows_merchants->Sender_Name;
									}
							}
						$this->registry->template->Sender_ID = $Sender_ID;
						$this->registry->template->Sender_Name = $Sender_Name;
						$this->registry->template->show('adminreports/display_merchants');
					}
				else
					{
						$this->registry->template->show('admin_search/no_results');
					}
			}
		public function display_sales()
			{
				$Display = new sql();
				$CID = $_POST['CID'];
				if($CID == '999')
					{
						$sql = 'SELECT ID,user_name FROM users WHERE Level = ? AND Status = ?';
						$Execute_Array = array('3','1');
						
					}
				else
					{
						$sql = 'SELECT ID,user_name FROM users WHERE Level = ? AND Status = ? AND Country = ?';
						$Execute_Array = array('3','1',$CID);
					}
				$User_ID_Array = array();
				$User_Name = array();
				$results = $Display->Display_Info($sql,$Execute_Array);
				foreach($results as $rows)
					{
						$User_ID_Array[] = $rows->ID;
						$User_Name[] = $rows->user_name;
					}
				
				$this->registry->template->User_ID_Array = $User_ID_Array;
				$this->registry->template->User_Name = $User_Name;
				$this->registry->template->show('adminreports/display_sales');
			}
		public function admin_reports()
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
				$sql = 'SELECT ID,Name FROM '.$Table.' WHERE Status = ?';
				$Execute_Array = array('1');
				$results = $Display->Display_Info($sql,$Execute_Array);
				$Country_ID = array();
				$Country_Name = array();
				foreach($results as $rows)
					{
						$Country_ID[] = $rows->ID;
						$Country_Name[] = $rows->Name;
					}
				$this->registry->template->Country_ID = $Country_ID;
				$this->registry->template->Country_Name = $Country_Name;
				$this->registry->template->show('adminreports/admin_reports');
			}
		public function delete_selected_merchant()
			{
				$Display = new sql();
				$ID = $_POST['ID'];
				$Starts_Date = @$_POST['Starts_Date'];
				$End_Date = @$_POST['End_Date'];
				$Country = $_POST['Country'];
				$Sales_ID = $_POST['Sales_ID'];
				$MID = $_POST['MID'];
				$Cat_ID = $_POST['Cat_ID'];
				$Sub_Cat_ID = $_POST['Sub_Cat_ID'];
				$Time_Stamp = $_POST['Time_Stamp'];
				$sql = 'UPDATE users SET Status = ? WHERE ID = ?';
				$Execute_Array = array('0',$ID);
				$Display->Execute($sql,$Execute_Array);
				$this->display_sales_report_par($Starts_Date,$End_Date,$Country,$Sales_ID,$MID,$Cat_ID,$Sub_Cat_ID,$Time_Stamp);
			}
		public function display_sales_report_par($Starts_Date='',$End_Date='',$Country,$Sales_ID,$MID,$Cat_ID,$Sub_Cat_ID,$Time_Stamp)
			{
				$Display = new sql();
				$Starts_Date = @$_POST['Starts_Date'];
				$End_Date = @$_POST['End_Date'];
				$Country = $_POST['Country'];
				$Sales_ID = $_POST['Sales_ID'];
				$MID = $_POST['MID'];
				$Cat_ID = $_POST['Cat_ID'];
				$Sub_Cat_ID = $_POST['Sub_Cat_ID'];
				$Time_Stamp = $_POST['Time_Stamp'];
				
				$this->registry->template->Starts_Date = $Starts_Date;
				$this->registry->template->End_Date = $End_Date;
				$this->registry->template->Country = $Country;
				$this->registry->template->Sales_ID = $Sales_ID;
				$this->registry->template->MID = $MID;
				$this->registry->template->Cat_ID = $Cat_ID;
				$this->registry->template->Sub_Cat_ID = $Sub_Cat_ID;
				
				if(!$Country)
					{
						$myTweets = array("flag" => '1');
						$Display->Write_JSON($Time_Stamp,$myTweets);
					}
				elseif(!$Sales_ID)
					{
						$myTweets = array("flag" => '2');
						$Display->Write_JSON($Time_Stamp,$myTweets);
					}
				elseif(!$MID)
					{
						$myTweets = array("flag" => '3');
						$Display->Write_JSON($Time_Stamp,$myTweets);
					}
				elseif(!$Cat_ID)
					{
						$myTweets = array("flag" => '4');
						$Display->Write_JSON($Time_Stamp,$myTweets);
					}
				elseif(!$Sub_Cat_ID)
					{
						$myTweets = array("flag" => '5');
						$Display->Write_JSON($Time_Stamp,$myTweets);
					}
				else
					{
						$myTweets = array("flag" => '0');
						$Display->Write_JSON($Time_Stamp,$myTweets);
						if(isset($_SESSION['Arabic']))
							{
								$Table = 'country';
								$Table_Offers = 'offers';
							}
						else
							{
								$Table = 'country_english';
								$Table_Offers = 'offers_english';
							}
						if(($Starts_Date == '000000') || ($Starts_Date == '1970-01-01') || ($Starts_Date == NULL))
							{
								if(($Country == '999')&&($Sales_ID == '999')&&($MID == '999')&&($Cat_ID == '999'))
									{
										$MID_Array = array();
										$Sender_Name_Array = array();
										$Country_Name_Array = array();
										$Amount_Array = array();
										$Log_Creator = array();
										if($Sub_Cat_ID == '999')
											{
												$sql = 'SELECT ID,Sender_Name,Country FROM users WHERE Status = ? AND Level = ?';
												$Execute_Array = array('1','2');
												$results = $Display->Display_Info($sql,$Execute_Array);
												foreach($results as $rows)
													{
														$sql_country = 'SELECT Name FROM '.$Table.' WHERE ID = ?';
														$Execute_Country = array($rows->Country);
														$Country_Name = $Display->Display_Single_Info_Modified($sql_country,'Name',$Execute_Country);
														$Country_Name_Array[] = $Country_Name;
														
														$sql_account = 'SELECT Amount FROM merchant_accounts WHERE MID = ? AND Status = ?';
														$Execute_Account = array($rows->ID,'1');
														$Amount = $Display->Display_Single_Info_Modified($sql_account,'Amount',$Execute_Account);
														$Amount_Array[] = sprintf('%.2f',$Amount);
														
														$sql_log = 'SELECT OID FROM logs WHERE Table_Name = ? AND Action = ? AND RID = ?';
														$Execute_log = array('users','1',$rows->ID);
														$OID = $Display->Display_Single_Info_Modified($sql_log,'OID',$Execute_log);
														
														$sql_oid = 'SELECT First_Name FROM users WHERE ID = ?';
														$Execute_oid = array($OID);
														$Creator_First_Name = $Display->Display_Single_Info_Modified($sql_oid,'First_Name',$Execute_oid);
														
														$Log_Creator[] = $Creator_First_Name;
														$MID_Array[] = $rows->ID;
														$Sender_Name_Array[] = $rows->Sender_Name;
														
													}
											}
										else
											{
												$sql_offer = 'SELECT AID FROM '.$Table_Offers.' WHERE Status = ? AND Ads_Sub_Cat = ?';
												$Execute_Offers = array('1',$Sub_Cat_ID);
												$results_offers = $Display->Display_Info($sql_offer,$Execute_Offers);
												$AID_Array = array();
												foreach($results_offers as $rows_offers)
													{
														$AID_Array[] = $rows_offers->AID;
													}
												$sql = 'SELECT ID,Sender_Name,Country FROM users WHERE Status = ? AND Level = ?';
												$Execute_Array = array('1','2');
												$results = $Display->Display_Info($sql,$Execute_Array);
												foreach($results as $rows)
													{
														
														if(in_array($rows->ID,$AID_Array))
																	{
																		
																		$sql_country = 'SELECT Name FROM '.$Table.' WHERE ID = ?';
																		$Execute_Country = array($rows->Country);
																		$Country_Name = $Display->Display_Single_Info_Modified($sql_country,'Name',$Execute_Country);
																		$Country_Name_Array[] = $Country_Name;
																		
																		$sql_account = 'SELECT Amount FROM merchant_accounts WHERE MID = ? AND Status = ?';
																		$Execute_Account = array($rows->ID,'1');
																		$Amount = $Display->Display_Single_Info_Modified($sql_account,'Amount',$Execute_Account);
																		$Amount_Array[] = sprintf('%.2f',$Amount);
																		
																		$sql_log = 'SELECT OID FROM logs WHERE Table_Name = ? AND Action = ? AND RID = ?';
																		$Execute_log = array('users','1',$rows->ID);
																		$OID = $Display->Display_Single_Info_Modified($sql_log,'OID',$Execute_log);
																		
																		$sql_oid = 'SELECT First_Name FROM users WHERE ID = ?';
																		$Execute_oid = array($OID);
																		$Creator_First_Name = $Display->Display_Single_Info_Modified($sql_oid,'First_Name',$Execute_oid);
																		
																		$Log_Creator[] = $Creator_First_Name;
																		$MID_Array[] = $rows->ID;
																		$Sender_Name_Array[] = $rows->Sender_Name;
																	}
															}
											}
										
										$this->registry->template->MID_Array = $MID_Array;
										$this->registry->template->Sender_Name_Array = $Sender_Name_Array;
										$this->registry->template->Country_Name_Array = $Country_Name_Array;
										$this->registry->template->Amount_Array = $Amount_Array;
										$this->registry->template->Log_Creator = $Log_Creator;
									}
								elseif(($Country != '999')&&($Sales_ID == '999')&&($MID == '999')&&($Cat_ID == '999'))
									{
										$MID_Array = array();
										$Sender_Name_Array = array();
										$Country_Name_Array = array();
										$Amount_Array = array();
										$Log_Creator = array();
										if($Sub_Cat_ID == '999')
											{
												$sql = 'SELECT ID,Sender_Name,Country FROM users WHERE Status = ? AND Level = ? AND Country = ?';
												$Execute_Array = array('1','2',$Country);
												$results = $Display->Display_Info($sql,$Execute_Array);
												foreach($results as $rows)
													{
														$sql_country = 'SELECT Name FROM '.$Table.' WHERE ID = ?';
														$Execute_Country = array($rows->Country);
														$Country_Name = $Display->Display_Single_Info_Modified($sql_country,'Name',$Execute_Country);
														$Country_Name_Array[] = $Country_Name;
														
														$sql_account = 'SELECT Amount FROM merchant_accounts WHERE MID = ? AND Status = ?';
														$Execute_Account = array($rows->ID,'1');
														$Amount = $Display->Display_Single_Info_Modified($sql_account,'Amount',$Execute_Account);
														$Amount_Array[] = sprintf('%.2f',$Amount);
														
														$sql_log = 'SELECT OID FROM logs WHERE Table_Name = ? AND Action = ? AND RID = ? ';
														$Execute_log = array('users','1',$rows->ID);
														$OID = $Display->Display_Single_Info_Modified($sql_log,'OID',$Execute_log);
														
														$sql_oid = 'SELECT First_Name FROM users WHERE ID = ?';
														$Execute_oid = array($OID);
														$Creator_First_Name = $Display->Display_Single_Info_Modified($sql_oid,'First_Name',$Execute_oid);
														
														$Log_Creator[] = $Creator_First_Name;
														$MID_Array[] = $rows->ID;
														$Sender_Name_Array[] = $rows->Sender_Name;
													}
											}
										else
											{
												$sql_offer = 'SELECT AID FROM '.$Table_Offers.' WHERE Status = ? AND Ads_Sub_Cat = ?';
												$Execute_Offers = array('1',$Sub_Cat_ID);
												$results_offers = $Display->Display_Info($sql_offer,$Execute_Offers);
												$AID_Array = array();
												foreach($results_offers as $rows_offers)
													{
														$AID_Array[] = $rows_offers->AID;
													}
													$sql = 'SELECT ID,Sender_Name,Country FROM users WHERE Status = ? AND Level = ? AND Country = ?';
													$Execute_Array = array('1','2',$Country);
													$results = $Display->Display_Info($sql,$Execute_Array);
													foreach($results as $rows)
														{
															
															if(in_array($rows->ID,$AID_Array))
																{
																	$sql_country = 'SELECT Name FROM '.$Table.' WHERE ID = ?';
																	$Execute_Country = array($rows->Country);
																	$Country_Name = $Display->Display_Single_Info_Modified($sql_country,'Name',$Execute_Country);
																	$Country_Name_Array[] = $Country_Name;
																	
																	$sql_account = 'SELECT Amount FROM merchant_accounts WHERE MID = ? AND Status = ?';
																	$Execute_Account = array($rows->ID,'1');
																	$Amount = $Display->Display_Single_Info_Modified($sql_account,'Amount',$Execute_Account);
																	$Amount_Array[] = sprintf('%.2f',$Amount);
																	
																	$sql_log = 'SELECT OID FROM logs WHERE Table_Name = ? AND Action = ? AND RID = ? ';
																	$Execute_log = array('users','1',$rows->ID);
																	$OID = $Display->Display_Single_Info_Modified($sql_log,'OID',$Execute_log);
																	
																	$sql_oid = 'SELECT First_Name FROM users WHERE ID = ?';
																	$Execute_oid = array($OID);
																	$Creator_First_Name = $Display->Display_Single_Info_Modified($sql_oid,'First_Name',$Execute_oid);
																	
																	$Log_Creator[] = $Creator_First_Name;
																	$MID_Array[] = $rows->ID;
																	$Sender_Name_Array[] = $rows->Sender_Name;
																}
														}
											}
										
										$this->registry->template->MID_Array = $MID_Array;
										$this->registry->template->Sender_Name_Array = $Sender_Name_Array;
										$this->registry->template->Country_Name_Array = $Country_Name_Array;
										$this->registry->template->Amount_Array = $Amount_Array;
										$this->registry->template->Log_Creator = $Log_Creator;
									}
								elseif(($Country == '999')&&($Sales_ID != '999')&&($MID == '999')&&($Cat_ID == '999'))
									{
										$MID_Array = array();
										$Sender_Name_Array = array();
										$MID_Array_Non_Filtered = array();
										$Country_Name_Array = array();
										$Amount_Array = array();
										$Log_Creator = array();
										if($Sub_Cat_ID == '999')
											{
												$sql = 'SELECT RID FROM logs WHERE Table_Name = ? AND Action = ? AND OID = ?';
												$Execute_Array = array('users','1',$Sales_ID);
												$results = $Display->Display_Info($sql,$Execute_Array);
												foreach($results as $rows)
													{
														$MID_Array_Non_Filtered[] = $rows->RID;
													}
												$sql_users = 'SELECT ID,Sender_Name,Country FROM users WHERE Status = ? AND Level = ?';
												$Execute_Array = array('1','2');
												$results = $Display->Display_Info($sql_users,$Execute_Array);
												foreach($results as $rows)
													{
														if(in_array($rows->ID,$MID_Array_Non_Filtered))
															{
																$sql_country = 'SELECT Name FROM '.$Table.' WHERE ID = ?';
																$Execute_Country = array($rows->Country);
																$Country_Name = $Display->Display_Single_Info_Modified($sql_country,'Name',$Execute_Country);
																$Country_Name_Array[] = $Country_Name;
																
																$sql_account = 'SELECT Amount FROM merchant_accounts WHERE MID = ? AND Status = ?';
																$Execute_Account = array($rows->ID,'1');
																$Amount = $Display->Display_Single_Info_Modified($sql_account,'Amount',$Execute_Account);
																$Amount_Array[] = sprintf('%.2f',$Amount);
																
																$sql_log = 'SELECT OID FROM logs WHERE Table_Name = ? AND Action = ? AND RID = ? ';
																$Execute_log = array('users','1',$rows->ID);
																$OID = $Display->Display_Single_Info_Modified($sql_log,'OID',$Execute_log);
																
																$sql_oid = 'SELECT First_Name FROM users WHERE ID = ?';
																$Execute_oid = array($OID);
																$Creator_First_Name = $Display->Display_Single_Info_Modified($sql_oid,'First_Name',$Execute_oid);
																
																$Log_Creator[] = $Creator_First_Name;
																$MID_Array[] = $rows->ID;
																$Sender_Name_Array[] = $rows->Sender_Name;
															} 
													}
											}
										else
											{
												$sql_offer = 'SELECT AID FROM '.$Table_Offers.' WHERE Status = ? AND Ads_Sub_Cat = ?';
												$Execute_Offers = array('1',$Sub_Cat_ID);
												$results_offers = $Display->Display_Info($sql_offer,$Execute_Offers);
												$AID_Array = array();
												foreach($results_offers as $rows_offers)
													{
														$AID_Array[] = $rows_offers->AID;
													}
												$sql = 'SELECT RID FROM logs WHERE Table_Name = ? AND Action = ? AND OID = ?';
												$Execute_Array = array('users','1',$Sales_ID);
												$results = $Display->Display_Info($sql,$Execute_Array);
												foreach($results as $rows)
													{
														$MID_Array_Non_Filtered[] = $rows->RID;
													}
												$sql_users = 'SELECT ID,Sender_Name,Country FROM users WHERE Status = ? AND Level = ?';
												$Execute_Array = array('1','2');
												$results = $Display->Display_Info($sql_users,$Execute_Array);
												foreach($results as $rows)
													{
														if(in_array($rows->ID,$MID_Array_Non_Filtered))
															{
																if(in_array($rows->ID,$AID_Array))
																	{
																		$sql_country = 'SELECT Name FROM '.$Table.' WHERE ID = ?';
																		$Execute_Country = array($rows->Country);
																		$Country_Name = $Display->Display_Single_Info_Modified($sql_country,'Name',$Execute_Country);
																		$Country_Name_Array[] = $Country_Name;
																		
																		$sql_account = 'SELECT Amount FROM merchant_accounts WHERE MID = ? AND Status = ?';
																		$Execute_Account = array($rows->ID,'1');
																		$Amount = $Display->Display_Single_Info_Modified($sql_account,'Amount',$Execute_Account);
																		$Amount_Array[] = sprintf('%.2f',$Amount);
																		
																		$sql_log = 'SELECT OID FROM logs WHERE Table_Name = ? AND Action = ? AND RID = ? ';
																		$Execute_log = array('users','1',$rows->ID);
																		$OID = $Display->Display_Single_Info_Modified($sql_log,'OID',$Execute_log);
																		
																		$sql_oid = 'SELECT First_Name FROM users WHERE ID = ?';
																		$Execute_oid = array($OID);
																		$Creator_First_Name = $Display->Display_Single_Info_Modified($sql_oid,'First_Name',$Execute_oid);
																		
																		$Log_Creator[] = $Creator_First_Name;
																		$MID_Array[] = $rows->ID;
																		$Sender_Name_Array[] = $rows->Sender_Name;
																	}
															} 
													}
											}
										
										$this->registry->template->MID_Array = $MID_Array;
										$this->registry->template->Sender_Name_Array = $Sender_Name_Array;
										$this->registry->template->Country_Name_Array = $Country_Name_Array;
										$this->registry->template->Amount_Array = $Amount_Array;
										$this->registry->template->Log_Creator = $Log_Creator;
									}
								elseif(($Country != '999')&&($Sales_ID != '999')&&($MID == '999')&&($Cat_ID == '999'))
									{
										$MID_Array_Non_Filtered = array();
										$MID_Array = array();
										$Sender_Name_Array = array();
										$Country_Name_Array = array();
										$Amount_Array = array();
										$Log_Creator = array();
										if($Sub_Cat_ID == '999')
											{
												$sql = 'SELECT RID FROM logs WHERE Table_Name = ? AND Action = ? AND OID = ?';
												$Execute_Array = array('users','1',$Sales_ID);
												$results = $Display->Display_Info($sql,$Execute_Array);
												foreach($results as $rows)
													{
														$MID_Array_Non_Filtered[] = $rows->RID;
													}
												$sql_users = 'SELECT ID,Sender_Name,Country FROM users WHERE Status = ? AND Level = ? AND Country = ?';
												$Execute_Array = array('1','2',$Country);
												$results = $Display->Display_Info($sql_users,$Execute_Array);
												foreach($results as $rows)
													{
														if(in_array($rows->ID,$MID_Array_Non_Filtered))
															{
																$sql_country = 'SELECT Name FROM '.$Table.' WHERE ID = ?';
																$Execute_Country = array($rows->Country);
																$Country_Name = $Display->Display_Single_Info_Modified($sql_country,'Name',$Execute_Country);
																$Country_Name_Array[] = $Country_Name;
																
																$sql_account = 'SELECT Amount FROM merchant_accounts WHERE MID = ? AND Status = ?';
																$Execute_Account = array($rows->ID,'1');
																$Amount = $Display->Display_Single_Info_Modified($sql_account,'Amount',$Execute_Account);
																$Amount_Array[] = sprintf('%.2f',$Amount);
																
																$sql_log = 'SELECT OID FROM logs WHERE Table_Name = ? AND Action = ? AND RID = ? ';
																$Execute_log = array('users','1',$rows->ID);
																$OID = $Display->Display_Single_Info_Modified($sql_log,'OID',$Execute_log);
																
																$sql_oid = 'SELECT First_Name FROM users WHERE ID = ?';
																$Execute_oid = array($OID);
																$Creator_First_Name = $Display->Display_Single_Info_Modified($sql_oid,'First_Name',$Execute_oid);
																
																$Log_Creator[] = $Creator_First_Name;
														
																$MID_Array[] = $rows->ID;
																$Sender_Name_Array[] = $rows->Sender_Name;
															} 
													}
											}
										else
											{
												$sql_offer = 'SELECT AID FROM '.$Table_Offers.' WHERE Status = ? AND Ads_Sub_Cat = ?';
												$Execute_Offers = array('1',$Sub_Cat_ID);
												$results_offers = $Display->Display_Info($sql_offer,$Execute_Offers);
												$AID_Array = array();
												foreach($results_offers as $rows_offers)
													{
														$AID_Array[] = $rows_offers->AID;
													}
												$sql = 'SELECT RID FROM logs WHERE Table_Name = ? AND Action = ? AND OID = ?';
												$Execute_Array = array('users','1',$Sales_ID);
												$results = $Display->Display_Info($sql,$Execute_Array);
												foreach($results as $rows)
													{
														$MID_Array_Non_Filtered[] = $rows->RID;
													}
												$sql_users = 'SELECT ID,Sender_Name,Country FROM users WHERE Status = ? AND Level = ? AND Country = ?';
												$Execute_Array = array('1','2',$Country);
												$results = $Display->Display_Info($sql_users,$Execute_Array);
												foreach($results as $rows)
													{
														if(in_array($rows->ID,$MID_Array_Non_Filtered))
															{
																if(in_array($rows->ID,$AID_Array))
																	{
																		$sql_country = 'SELECT Name FROM '.$Table.' WHERE ID = ?';
																		$Execute_Country = array($rows->Country);
																		$Country_Name = $Display->Display_Single_Info_Modified($sql_country,'Name',$Execute_Country);
																		$Country_Name_Array[] = $Country_Name;
																		
																		$sql_account = 'SELECT Amount FROM merchant_accounts WHERE MID = ? AND Status = ?';
																		$Execute_Account = array($rows->ID,'1');
																		$Amount = $Display->Display_Single_Info_Modified($sql_account,'Amount',$Execute_Account);
																		$Amount_Array[] = sprintf('%.2f',$Amount);
																		
																		$sql_log = 'SELECT OID FROM logs WHERE Table_Name = ? AND Action = ? AND RID = ? ';
																		$Execute_log = array('users','1',$rows->ID);
																		$OID = $Display->Display_Single_Info_Modified($sql_log,'OID',$Execute_log);
																		
																		$sql_oid = 'SELECT First_Name FROM users WHERE ID = ?';
																		$Execute_oid = array($OID);
																		$Creator_First_Name = $Display->Display_Single_Info_Modified($sql_oid,'First_Name',$Execute_oid);
																		
																		$Log_Creator[] = $Creator_First_Name;
																
																		$MID_Array[] = $rows->ID;
																		$Sender_Name_Array[] = $rows->Sender_Name;
																	}
															} 
													}
											}
										
										$this->registry->template->MID_Array = $MID_Array;
										$this->registry->template->Sender_Name_Array = $Sender_Name_Array;
										$this->registry->template->Country_Name_Array = $Country_Name_Array;
										$this->registry->template->Amount_Array = $Amount_Array;
										$this->registry->template->Log_Creator = $Log_Creator;
									}
								elseif(($Country == '999')&&($Sales_ID == '999')&&($MID != '999')&&($Cat_ID == '999'))
									{
										$MID_Array = array();
										$Sender_Name_Array = array();
										$Country_Name_Array = array();
										$Amount_Array = array();
										$Log_Creator = array();
										if($Sub_Cat_ID == '999')
											{
												$sql = 'SELECT Sender_Name,Country FROM users WHERE ID = ?';
												$Execute_Array = array($MID);
												$results = $Display->Display_Info($sql,$Execute_Array);
												foreach($results as $rows)
													{
														$sql_country = 'SELECT Name FROM '.$Table.' WHERE ID = ?';
														$Execute_Country = array($rows->Country);
														$Country_Name = $Display->Display_Single_Info_Modified($sql_country,'Name',$Execute_Country);
														$Country_Name_Array[] = $Country_Name;
														
														$sql_account = 'SELECT Amount FROM merchant_accounts WHERE MID = ? AND Status = ?';
														$Execute_Account = array($MID,'1');
														$Amount = $Display->Display_Single_Info_Modified($sql_account,'Amount',$Execute_Account);
														$Amount_Array[] = sprintf('%.2f',$Amount);
														
														$sql_log = 'SELECT OID FROM logs WHERE Table_Name = ? AND Action = ? AND RID = ?';
														$Execute_log = array('users','1',$MID);
														$OID = $Display->Display_Single_Info_Modified($sql_log,'OID',$Execute_log);
														
														$sql_oid = 'SELECT First_Name FROM users WHERE ID = ?';
														$Execute_oid = array($OID);
														$Creator_First_Name = $Display->Display_Single_Info_Modified($sql_oid,'First_Name',$Execute_oid);
														
														$Log_Creator[] = $Creator_First_Name;
														
														$MID_Array[] = $MID;
														$Sender_Name_Array[] = $rows->Sender_Name;
													}
											}
										else
											{
												$sql_offer = 'SELECT AID FROM '.$Table_Offers.' WHERE Status = ? AND Ads_Sub_Cat = ?';
												$Execute_Offers = array('1',$Sub_Cat_ID);
												$results_offers = $Display->Display_Info($sql_offer,$Execute_Offers);
												$AID_Array = array();
												foreach($results_offers as $rows_offers)
													{
														$AID_Array[] = $rows_offers->AID;
													}
												$sql = 'SELECT Sender_Name,Country FROM users WHERE ID = ?';
												$Execute_Array = array($MID);
												$results = $Display->Display_Info($sql,$Execute_Array);
												foreach($results as $rows)
													{
														if(in_array($MID,$AID_Array))
															{
																$sql_country = 'SELECT Name FROM '.$Table.' WHERE ID = ?';
																$Execute_Country = array($rows->Country);
																$Country_Name = $Display->Display_Single_Info_Modified($sql_country,'Name',$Execute_Country);
																$Country_Name_Array[] = $Country_Name;
																
																$sql_account = 'SELECT Amount FROM merchant_accounts WHERE MID = ? AND Status = ?';
																$Execute_Account = array($MID,'1');
																$Amount = $Display->Display_Single_Info_Modified($sql_account,'Amount',$Execute_Account);
																$Amount_Array[] = sprintf('%.2f',$Amount);
																
																$sql_log = 'SELECT OID FROM logs WHERE Table_Name = ? AND Action = ? AND RID = ?';
																$Execute_log = array('users','1',$MID);
																$OID = $Display->Display_Single_Info_Modified($sql_log,'OID',$Execute_log);
																
																$sql_oid = 'SELECT First_Name FROM users WHERE ID = ?';
																$Execute_oid = array($OID);
																$Creator_First_Name = $Display->Display_Single_Info_Modified($sql_oid,'First_Name',$Execute_oid);
																
																$Log_Creator[] = $Creator_First_Name;
																
																$MID_Array[] = $MID;
																$Sender_Name_Array[] = $rows->Sender_Name;
															}
													}
											}
										
										$this->registry->template->MID_Array = $MID_Array;
										$this->registry->template->Sender_Name_Array = $Sender_Name_Array;
										$this->registry->template->Country_Name_Array = $Country_Name_Array;
										$this->registry->template->Amount_Array = $Amount_Array;
										$this->registry->template->Log_Creator = $Log_Creator;
									}
								elseif(($Country != '999')&&($Sales_ID == '999')&&($MID != '999')&&($Cat_ID == '999'))
									{
										$MID_Array = array();
										$Sender_Name_Array = array();
										$Country_Name_Array = array();
										$Amount_Array = array();
										$Log_Creator = array();
										if($Sub_Cat_ID == '999')
											{
												$sql = 'SELECT Sender_Name,Country FROM users WHERE ID = ?';
												$Execute_Array = array($MID);
												$results = $Display->Display_Info($sql,$Execute_Array);
												foreach($results as $rows)
													{
														$sql_country = 'SELECT Name FROM '.$Table.' WHERE ID = ?';
														$Execute_Country = array($rows->Country);
														$Country_Name = $Display->Display_Single_Info_Modified($sql_country,'Name',$Execute_Country);
														$Country_Name_Array[] = $Country_Name;
														
														$sql_account = 'SELECT Amount FROM merchant_accounts WHERE MID = ? AND Status = ?';
														$Execute_Account = array($MID,'1');
														$Amount = $Display->Display_Single_Info_Modified($sql_account,'Amount',$Execute_Account);
														$Amount_Array[] = sprintf('%.2f',$Amount);
														
														$sql_log = 'SELECT OID FROM logs WHERE Table_Name = ? AND Action = ? AND RID = ? ';
														$Execute_log = array('users','1',$MID);
														$OID = $Display->Display_Single_Info_Modified($sql_log,'OID',$Execute_log);
														
														$sql_oid = 'SELECT First_Name FROM users WHERE ID = ?';
														$Execute_oid = array($OID);
														$Creator_First_Name = $Display->Display_Single_Info_Modified($sql_oid,'First_Name',$Execute_oid);
														
														$Log_Creator[] = $Creator_First_Name;
														
														$MID_Array[] = $MID;
														$Sender_Name_Array[] = $rows->Sender_Name;
													}
											}
										else
											{
												$sql_offer = 'SELECT AID FROM '.$Table_Offers.' WHERE Status = ? AND Ads_Sub_Cat = ?';
												$Execute_Offers = array('1',$Sub_Cat_ID);
												$results_offers = $Display->Display_Info($sql_offer,$Execute_Offers);
												$AID_Array = array();
												foreach($results_offers as $rows_offers)
													{
														$AID_Array[] = $rows_offers->AID;
													}
												$sql = 'SELECT Sender_Name,Country FROM users WHERE ID = ?';
												$Execute_Array = array($MID);
												$results = $Display->Display_Info($sql,$Execute_Array);
												foreach($results as $rows)
													{
														
														if(in_array($MID,$AID_Array))
															{
																$sql_country = 'SELECT Name FROM '.$Table.' WHERE ID = ?';
																$Execute_Country = array($rows->Country);
																$Country_Name = $Display->Display_Single_Info_Modified($sql_country,'Name',$Execute_Country);
																$Country_Name_Array[] = $Country_Name;
																
																$sql_account = 'SELECT Amount FROM merchant_accounts WHERE MID = ? AND Status = ?';
																$Execute_Account = array($MID,'1');
																$Amount = $Display->Display_Single_Info_Modified($sql_account,'Amount',$Execute_Account);
																$Amount_Array[] = sprintf('%.2f',$Amount);
																
																$sql_log = 'SELECT OID FROM logs WHERE Table_Name = ? AND Action = ? AND RID = ? ';
																$Execute_log = array('users','1',$MID);
																$OID = $Display->Display_Single_Info_Modified($sql_log,'OID',$Execute_log);
																
																$sql_oid = 'SELECT First_Name FROM users WHERE ID = ?';
																$Execute_oid = array($OID);
																$Creator_First_Name = $Display->Display_Single_Info_Modified($sql_oid,'First_Name',$Execute_oid);
																
																$Log_Creator[] = $Creator_First_Name;
																
																$MID_Array[] = $MID;
																$Sender_Name_Array[] = $rows->Sender_Name;
															}
													}
											}
										
										$this->registry->template->MID_Array = $MID_Array;
										$this->registry->template->Sender_Name_Array = $Sender_Name_Array;
										$this->registry->template->Country_Name_Array = $Country_Name_Array;
										$this->registry->template->Amount_Array = $Amount_Array;
										$this->registry->template->Log_Creator = $Log_Creator;
									}
								elseif(($Country == '999')&&($Sales_ID != '999')&&($MID != '999')&&($Cat_ID == '999'))
									{
										$MID_Array = array();
										$Sender_Name_Array = array();
										$Country_Name_Array = array();
										$Amount_Array = array();
										$Log_Creator = array();
										if($Sub_Cat_ID == '999')
											{
												$sql = 'SELECT Sender_Name,Country FROM users WHERE ID = ?';
												$Execute_Array = array($MID);
												$results = $Display->Display_Info($sql,$Execute_Array);
												foreach($results as $rows)
													{
														$sql_country = 'SELECT Name FROM '.$Table.' WHERE ID = ?';
														$Execute_Country = array($rows->Country);
														$Country_Name = $Display->Display_Single_Info_Modified($sql_country,'Name',$Execute_Country);
														$Country_Name_Array[] = $Country_Name;
														
														$sql_account = 'SELECT Amount FROM merchant_accounts WHERE MID = ? AND Status = ?';
														$Execute_Account = array($MID,'1');
														$Amount = $Display->Display_Single_Info_Modified($sql_account,'Amount',$Execute_Account);
														$Amount_Array[] = sprintf('%.2f',$Amount);
														
														$sql_log = 'SELECT OID FROM logs WHERE Table_Name = ? AND Action = ? AND RID = ?';
														$Execute_log = array('users','1',$MID);
														$OID = $Display->Display_Single_Info_Modified($sql_log,'OID',$Execute_log);
														
														$sql_oid = 'SELECT First_Name FROM users WHERE ID = ?';
														$Execute_oid = array($OID);
														$Creator_First_Name = $Display->Display_Single_Info_Modified($sql_oid,'First_Name',$Execute_oid);
														
														$Log_Creator[] = $Creator_First_Name;
														$MID_Array[] = $MID;
														$Sender_Name_Array[] = $rows->Sender_Name;
													}
											}
										else
											{
												$sql_offer = 'SELECT AID FROM '.$Table_Offers.' WHERE Status = ? AND Ads_Sub_Cat = ?';
												$Execute_Offers = array('1',$Sub_Cat_ID);
												$results_offers = $Display->Display_Info($sql_offer,$Execute_Offers);
												$AID_Array = array();
												foreach($results_offers as $rows_offers)
													{
														$AID_Array[] = $rows_offers->AID;
													}
												$sql = 'SELECT Sender_Name,Country FROM users WHERE ID = ?';
												$Execute_Array = array($MID);
												$results = $Display->Display_Info($sql,$Execute_Array);
												foreach($results as $rows)
													{
														if(in_array($MID,$AID_Array))
															{
																$sql_country = 'SELECT Name FROM '.$Table.' WHERE ID = ?';
																$Execute_Country = array($rows->Country);
																$Country_Name = $Display->Display_Single_Info_Modified($sql_country,'Name',$Execute_Country);
																$Country_Name_Array[] = $Country_Name;
																
																$sql_account = 'SELECT Amount FROM merchant_accounts WHERE MID = ? AND Status = ?';
																$Execute_Account = array($MID,'1');
																$Amount = $Display->Display_Single_Info_Modified($sql_account,'Amount',$Execute_Account);
																$Amount_Array[] = sprintf('%.2f',$Amount);
																
																$sql_log = 'SELECT OID FROM logs WHERE Table_Name = ? AND Action = ? AND RID = ?';
																$Execute_log = array('users','1',$MID);
																$OID = $Display->Display_Single_Info_Modified($sql_log,'OID',$Execute_log);
																
																$sql_oid = 'SELECT First_Name FROM users WHERE ID = ?';
																$Execute_oid = array($OID);
																$Creator_First_Name = $Display->Display_Single_Info_Modified($sql_oid,'First_Name',$Execute_oid);
																
																$Log_Creator[] = $Creator_First_Name;
																$MID_Array[] = $MID;
																$Sender_Name_Array[] = $rows->Sender_Name;
															}
													}
											}
										
										$this->registry->template->MID_Array = $MID_Array;
										$this->registry->template->Sender_Name_Array = $Sender_Name_Array;
										$this->registry->template->Country_Name_Array = $Country_Name_Array;
										$this->registry->template->Amount_Array = $Amount_Array;
										$this->registry->template->Log_Creator = $Log_Creator;
									}
								elseif(($Country != '999')&&($Sales_ID != '999')&&($MID != '999')&&($Cat_ID == '999'))
									{
										$MID_Array = array();
										$Sender_Name_Array = array();
										$Country_Name_Array = array();
										$Amount_Array = array();
										$Log_Creator = array();
										if($Sub_Cat_ID == '999')
											{
												$sql = 'SELECT Sender_Name,Country FROM users WHERE ID = ?';
												$Execute_Array = array($MID);
												$results = $Display->Display_Info($sql,$Execute_Array);
												foreach($results as $rows)
													{
														$sql_country = 'SELECT Name FROM '.$Table.' WHERE ID = ?';
														$Execute_Country = array($rows->Country);
														$Country_Name = $Display->Display_Single_Info_Modified($sql_country,'Name',$Execute_Country);
														$Country_Name_Array[] = $Country_Name;
														
														$sql_account = 'SELECT Amount FROM merchant_accounts WHERE MID = ? AND Status = ?';
														$Execute_Account = array($MID,'1');
														$Amount = $Display->Display_Single_Info_Modified($sql_account,'Amount',$Execute_Account);
														$Amount_Array[] = sprintf('%.2f',$Amount);
														
														$sql_log = 'SELECT OID FROM logs WHERE Table_Name = ? AND Action = ? AND RID = ? ';
														$Execute_log = array('users','1',$MID);
														$OID = $Display->Display_Single_Info_Modified($sql_log,'OID',$Execute_log);
														
														$sql_oid = 'SELECT First_Name FROM users WHERE ID = ?';
														$Execute_oid = array($OID);
														$Creator_First_Name = $Display->Display_Single_Info_Modified($sql_oid,'First_Name',$Execute_oid);
														
														$Log_Creator[] = $Creator_First_Name;
														$MID_Array[] = $MID;
														$Sender_Name_Array[] = $rows->Sender_Name;
													}
											}
										else
											{
												$sql_offer = 'SELECT AID FROM '.$Table_Offers.' WHERE Status = ? AND Ads_Sub_Cat = ?';
												$Execute_Offers = array('1',$Sub_Cat_ID);
												$results_offers = $Display->Display_Info($sql_offer,$Execute_Offers);
												$AID_Array = array();
												foreach($results_offers as $rows_offers)
													{
														$AID_Array[] = $rows_offers->AID;
													}
												$sql = 'SELECT Sender_Name,Country FROM users WHERE ID = ?';
												$Execute_Array = array($MID);
												$results = $Display->Display_Info($sql,$Execute_Array);
												foreach($results as $rows)
													{
														
														if(in_array($MID,$AID_Array))
															{
																$sql_country = 'SELECT Name FROM '.$Table.' WHERE ID = ?';
																$Execute_Country = array($rows->Country);
																$Country_Name = $Display->Display_Single_Info_Modified($sql_country,'Name',$Execute_Country);
																$Country_Name_Array[] = $Country_Name;
																
																$sql_account = 'SELECT Amount FROM merchant_accounts WHERE MID = ? AND Status = ?';
																$Execute_Account = array($MID,'1');
																$Amount = $Display->Display_Single_Info_Modified($sql_account,'Amount',$Execute_Account);
																$Amount_Array[] = sprintf('%.2f',$Amount);
																
																$sql_log = 'SELECT OID FROM logs WHERE Table_Name = ? AND Action = ? AND RID = ? ';
																$Execute_log = array('users','1',$MID);
																$OID = $Display->Display_Single_Info_Modified($sql_log,'OID',$Execute_log);
																
																$sql_oid = 'SELECT First_Name FROM users WHERE ID = ?';
																$Execute_oid = array($OID);
																$Creator_First_Name = $Display->Display_Single_Info_Modified($sql_oid,'First_Name',$Execute_oid);
																
																$Log_Creator[] = $Creator_First_Name;
																$MID_Array[] = $MID;
																$Sender_Name_Array[] = $rows->Sender_Name;
															}
													}
											}
										
										$this->registry->template->MID_Array = $MID_Array;
										$this->registry->template->Sender_Name_Array = $Sender_Name_Array;
										$this->registry->template->Country_Name_Array = $Country_Name_Array;
										$this->registry->template->Amount_Array = $Amount_Array;
										$this->registry->template->Log_Creator = $Log_Creator;
									}
								elseif(($Country == '999')&&($Sales_ID == '999')&&($MID == '999')&&($Cat_ID != '999'))
									{
										$MID_Array = array();
										$Sender_Name_Array = array();
										$Country_Name_Array = array();
										$Amount_Array = array();
										$Log_Creator = array();
										if($Sub_Cat_ID == '999')
											{
												$sql = 'SELECT ID,Sender_Name,Country FROM users WHERE Level = ? AND Status = ? AND Ads_Cat = ?';
												$Execute_Array = array('2','1',$Cat_ID);
												$results = $Display->Display_Info($sql,$Execute_Array);
												foreach($results as $rows)
													{
														$sql_country = 'SELECT Name FROM '.$Table.' WHERE ID = ?';
														$Execute_Country = array($rows->Country);
														$Country_Name = $Display->Display_Single_Info_Modified($sql_country,'Name',$Execute_Country);
														$Country_Name_Array[] = $Country_Name;
														
														$sql_account = 'SELECT Amount FROM merchant_accounts WHERE MID = ? AND Status = ?';
														$Execute_Account = array($rows->ID,'1');
														$Amount = $Display->Display_Single_Info_Modified($sql_account,'Amount',$Execute_Account);
														$Amount_Array[] = sprintf('%.2f',$Amount);
														
														$sql_log = 'SELECT OID FROM logs WHERE Table_Name = ? AND Action = ? AND RID = ? ';
														$Execute_log = array('users','1',$rows->ID);
														$OID = $Display->Display_Single_Info_Modified($sql_log,'OID',$Execute_log);
														
														$sql_oid = 'SELECT First_Name FROM users WHERE ID = ?';
														$Execute_oid = array($OID);
														$Creator_First_Name = $Display->Display_Single_Info_Modified($sql_oid,'First_Name',$Execute_oid);
														
														$Log_Creator[] = $Creator_First_Name;
														$MID_Array[] = $rows->ID;
														$Sender_Name_Array[] = $rows->Sender_Name;
													}
											}
										else
											{
												$sql_offer = 'SELECT AID FROM '.$Table_Offers.' WHERE Status = ? AND Ads_Sub_Cat = ?';
												$Execute_Offers = array('1',$Sub_Cat_ID);
												$results_offers = $Display->Display_Info($sql_offer,$Execute_Offers);
												$AID_Array = array();
												foreach($results_offers as $rows_offers)
													{
														$AID_Array[] = $rows_offers->AID;
													}
												$sql = 'SELECT ID,Sender_Name,Country FROM users WHERE Level = ? AND Status = ? AND Ads_Cat = ?';
												$Execute_Array = array('2','1',$Cat_ID);
												$results = $Display->Display_Info($sql,$Execute_Array);
												foreach($results as $rows)
													{
														
														if(in_array($rows->ID,$AID_Array))
															{
																$sql_country = 'SELECT Name FROM '.$Table.' WHERE ID = ?';
																$Execute_Country = array($rows->Country);
																$Country_Name = $Display->Display_Single_Info_Modified($sql_country,'Name',$Execute_Country);
																$Country_Name_Array[] = $Country_Name;
																
																$sql_account = 'SELECT Amount FROM merchant_accounts WHERE MID = ? AND Status = ?';
																$Execute_Account = array($rows->ID,'1');
																$Amount = $Display->Display_Single_Info_Modified($sql_account,'Amount',$Execute_Account);
																$Amount_Array[] = sprintf('%.2f',$Amount);
																
																$sql_log = 'SELECT OID FROM logs WHERE Table_Name = ? AND Action = ? AND RID = ? ';
																$Execute_log = array('users','1',$rows->ID);
																$OID = $Display->Display_Single_Info_Modified($sql_log,'OID',$Execute_log);
																
																$sql_oid = 'SELECT First_Name FROM users WHERE ID = ?';
																$Execute_oid = array($OID);
																$Creator_First_Name = $Display->Display_Single_Info_Modified($sql_oid,'First_Name',$Execute_oid);
																
																$Log_Creator[] = $Creator_First_Name;
																$MID_Array[] = $rows->ID;
																$Sender_Name_Array[] = $rows->Sender_Name;
															}
													}
											}
										
										$this->registry->template->MID_Array = $MID_Array;
										$this->registry->template->Sender_Name_Array = $Sender_Name_Array;
										$this->registry->template->Country_Name_Array = $Country_Name_Array;
										$this->registry->template->Amount_Array = $Amount_Array;
										$this->registry->template->Log_Creator = $Log_Creator;
									}
								elseif(($Country != '999')&&($Sales_ID == '999')&&($MID == '999')&&($Cat_ID != '999'))
									{
										$MID_Array = array();
										$Sender_Name_Array = array();
										$Country_Name_Array = array();
										$Amount_Array = array();
										$Log_Creator = array();
										if($Sub_Cat_ID == '999')
											{
												$sql = 'SELECT ID,Sender_Name,Country FROM users WHERE Level = ? AND Status = ? AND Ads_Cat = ? AND Country = ?';
												$Execute_Array = array('2','1',$Cat_ID,$Country);
												$results = $Display->Display_Info($sql,$Execute_Array);
												foreach($results as $rows)
													{
														$sql_country = 'SELECT Name FROM '.$Table.' WHERE ID = ?';
														$Execute_Country = array($rows->Country);
														$Country_Name = $Display->Display_Single_Info_Modified($sql_country,'Name',$Execute_Country);
														$Country_Name_Array[] = $Country_Name;
														
														$sql_account = 'SELECT Amount FROM merchant_accounts WHERE MID = ? AND Status = ?';
														$Execute_Account = array($rows->ID,'1');
														$Amount = $Display->Display_Single_Info_Modified($sql_account,'Amount',$Execute_Account);
														$Amount_Array[] = sprintf('%.2f',$Amount);
														
														$sql_log = 'SELECT OID FROM logs WHERE Table_Name = ? AND Action = ? AND RID = ? ';
														$Execute_log = array('users','1',$rows->ID);
														$OID = $Display->Display_Single_Info_Modified($sql_log,'OID',$Execute_log);
														
														$sql_oid = 'SELECT First_Name FROM users WHERE ID = ?';
														$Execute_oid = array($OID);
														$Creator_First_Name = $Display->Display_Single_Info_Modified($sql_oid,'First_Name',$Execute_oid);
														
														$Log_Creator[] = $Creator_First_Name;
														$MID_Array[] = $rows->ID;
														$Sender_Name_Array[] = $rows->Sender_Name;
													}
											}
										else
											{
												$sql_offer = 'SELECT AID FROM '.$Table_Offers.' WHERE Status = ? AND Ads_Sub_Cat = ?';
												$Execute_Offers = array('1',$Sub_Cat_ID);
												$results_offers = $Display->Display_Info($sql_offer,$Execute_Offers);
												$AID_Array = array();
												foreach($results_offers as $rows_offers)
													{
														$AID_Array[] = $rows_offers->AID;
													}
												$sql = 'SELECT ID,Sender_Name,Country FROM users WHERE Level = ? AND Status = ? AND Ads_Cat = ? AND Country = ?';
												$Execute_Array = array('2','1',$Cat_ID,$Country);
												$results = $Display->Display_Info($sql,$Execute_Array);
												foreach($results as $rows)
													{
														
														if(in_array($rows->ID,$AID_Array))
															{
																$sql_country = 'SELECT Name FROM '.$Table.' WHERE ID = ?';
																$Execute_Country = array($rows->Country);
																$Country_Name = $Display->Display_Single_Info_Modified($sql_country,'Name',$Execute_Country);
																$Country_Name_Array[] = $Country_Name;
																
																$sql_account = 'SELECT Amount FROM merchant_accounts WHERE MID = ? AND Status = ?';
																$Execute_Account = array($rows->ID,'1');
																$Amount = $Display->Display_Single_Info_Modified($sql_account,'Amount',$Execute_Account);
																$Amount_Array[] = sprintf('%.2f',$Amount);
																
																$sql_log = 'SELECT OID FROM logs WHERE Table_Name = ? AND Action = ? AND RID = ? ';
																$Execute_log = array('users','1',$rows->ID);
																$OID = $Display->Display_Single_Info_Modified($sql_log,'OID',$Execute_log);
																
																$sql_oid = 'SELECT First_Name FROM users WHERE ID = ?';
																$Execute_oid = array($OID);
																$Creator_First_Name = $Display->Display_Single_Info_Modified($sql_oid,'First_Name',$Execute_oid);
																
																$Log_Creator[] = $Creator_First_Name;
																$MID_Array[] = $rows->ID;
																$Sender_Name_Array[] = $rows->Sender_Name;
															}
													}
											}
										
										$this->registry->template->MID_Array = $MID_Array;
										$this->registry->template->Sender_Name_Array = $Sender_Name_Array;
										$this->registry->template->Country_Name_Array = $Country_Name_Array;
										$this->registry->template->Amount_Array = $Amount_Array;
										$this->registry->template->Log_Creator = $Log_Creator;
									}
								elseif(($Country == '999')&&($Sales_ID != '999')&&($MID == '999')&&($Cat_ID != '999'))
									{
										$MID_Array = array();
										$Sender_Name_Array = array();
										$MID_Array_Non_Filtered = array();
										$Country_Name_Array = array();
										$Amount_Array = array();
										$Log_Creator = array();
										if($Sub_Cat_ID == '999')
											{
												$sql = 'SELECT RID FROM logs WHERE Table_Name = ? AND Action = ? AND OID = ?';
												$Execute_Array = array('users','1',$Sales_ID);
												$results = $Display->Display_Info($sql,$Execute_Array);
												foreach($results as $rows)
													{
														$MID_Array_Non_Filtered[] = $rows->RID;
													}
												$sql_users = 'SELECT ID,Sender_Name,Country FROM users WHERE Status = ? AND Level = ? AND Ads_Cat = ?';
												$Execute_Array = array('1','2',$Cat_ID);
												$results = $Display->Display_Info($sql_users,$Execute_Array);
												foreach($results as $rows)
													{
														if(in_array($rows->ID,$MID_Array_Non_Filtered))
															{
																$sql_country = 'SELECT Name FROM '.$Table.' WHERE ID = ?';
																$Execute_Country = array($rows->Country);
																$Country_Name = $Display->Display_Single_Info_Modified($sql_country,'Name',$Execute_Country);
																$Country_Name_Array[] = $Country_Name;
																
																$sql_account = 'SELECT Amount FROM merchant_accounts WHERE MID = ? AND Status = ?';
																$Execute_Account = array($rows->ID,'1');
																$Amount = $Display->Display_Single_Info_Modified($sql_account,'Amount',$Execute_Account);
																$Amount_Array[] = sprintf('%.2f',$Amount);
																
																$sql_log = 'SELECT OID FROM logs WHERE Table_Name = ? AND Action = ? AND RID = ? ';
																$Execute_log = array('users','1',$rows->ID);
																$OID = $Display->Display_Single_Info_Modified($sql_log,'OID',$Execute_log);
																
																$sql_oid = 'SELECT First_Name FROM users WHERE ID = ?';
																$Execute_oid = array($OID);
																$Creator_First_Name = $Display->Display_Single_Info_Modified($sql_oid,'First_Name',$Execute_oid);
																
																$Log_Creator[] = $Creator_First_Name;
														
																$MID_Array[] = $rows->ID;
																$Sender_Name_Array[] = $rows->Sender_Name;
															} 
													}
											}
										else
											{
												$sql_offer = 'SELECT AID FROM '.$Table_Offers.' WHERE Status = ? AND Ads_Sub_Cat = ?';
												$Execute_Offers = array('1',$Sub_Cat_ID);
												$results_offers = $Display->Display_Info($sql_offer,$Execute_Offers);
												$AID_Array = array();
												foreach($results_offers as $rows_offers)
													{
														$AID_Array[] = $rows_offers->AID;
													}
												$sql = 'SELECT RID FROM logs WHERE Table_Name = ? AND Action = ? AND OID = ?';
												$Execute_Array = array('users','1',$Sales_ID);
												$results = $Display->Display_Info($sql,$Execute_Array);
												foreach($results as $rows)
													{
														$MID_Array_Non_Filtered[] = $rows->RID;
													}
												$sql_users = 'SELECT ID,Sender_Name,Country FROM users WHERE Status = ? AND Level = ? AND Ads_Cat = ?';
												$Execute_Array = array('1','2',$Cat_ID);
												$results = $Display->Display_Info($sql_users,$Execute_Array);
												foreach($results as $rows)
													{
														if(in_array($rows->ID,$MID_Array_Non_Filtered))
															{
																
																if(in_array($rows->ID,$AID_Array))
																	{
																		$sql_country = 'SELECT Name FROM '.$Table.' WHERE ID = ?';
																		$Execute_Country = array($rows->Country);
																		$Country_Name = $Display->Display_Single_Info_Modified($sql_country,'Name',$Execute_Country);
																		$Country_Name_Array[] = $Country_Name;
																		
																		$sql_account = 'SELECT Amount FROM merchant_accounts WHERE MID = ? AND Status = ?';
																		$Execute_Account = array($rows->ID,'1');
																		$Amount = $Display->Display_Single_Info_Modified($sql_account,'Amount',$Execute_Account);
																		$Amount_Array[] = sprintf('%.2f',$Amount);
																		
																		$sql_log = 'SELECT OID FROM logs WHERE Table_Name = ? AND Action = ? AND RID = ? ';
																		$Execute_log = array('users','1',$rows->ID);
																		$OID = $Display->Display_Single_Info_Modified($sql_log,'OID',$Execute_log);
																		
																		$sql_oid = 'SELECT First_Name FROM users WHERE ID = ?';
																		$Execute_oid = array($OID);
																		$Creator_First_Name = $Display->Display_Single_Info_Modified($sql_oid,'First_Name',$Execute_oid);
																		
																		$Log_Creator[] = $Creator_First_Name;
																
																		$MID_Array[] = $rows->ID;
																		$Sender_Name_Array[] = $rows->Sender_Name;
																	}
															} 
													}
											}
										
										$this->registry->template->MID_Array = $MID_Array;
										$this->registry->template->Sender_Name_Array = $Sender_Name_Array;
										$this->registry->template->Country_Name_Array = $Country_Name_Array;
										$this->registry->template->Amount_Array = $Amount_Array;
										$this->registry->template->Log_Creator = $Log_Creator;
									}
								elseif(($Country != '999')&&($Sales_ID != '999')&&($MID == '999')&&($Cat_ID != '999'))
									{
										$MID_Array = array();
										$Sender_Name_Array = array();
										$MID_Array_Non_Filtered = array();
										$Country_Name_Array = array();
										$Amount_Array = array();
										$Log_Creator = array();
										if($Sub_Cat_ID == '999')
											{
												$sql = 'SELECT RID FROM logs WHERE Table_Name = ? AND Action = ? AND OID = ?';
												$Execute_Array = array('users','1',$Sales_ID);
												$results = $Display->Display_Info($sql,$Execute_Array);
												foreach($results as $rows)
													{
														$MID_Array_Non_Filtered[] = $rows->RID;
													}
												$sql_users = 'SELECT ID,Sender_Name,Country FROM users WHERE Status = ? AND Level = ? AND Ads_Cat = ? AND Country = ?';
												$Execute_Array = array('1','2',$Cat_ID,$Country);
												$results = $Display->Display_Info($sql_users,$Execute_Array);
												foreach($results as $rows)
													{
														if(in_array($rows->ID,$MID_Array_Non_Filtered))
															{
																$sql_country = 'SELECT Name FROM '.$Table.' WHERE ID = ?';
																$Execute_Country = array($rows->Country);
																$Country_Name = $Display->Display_Single_Info_Modified($sql_country,'Name',$Execute_Country);
																$Country_Name_Array[] = $Country_Name;
																
																$sql_account = 'SELECT Amount FROM merchant_accounts WHERE MID = ? AND Status = ?';
																$Execute_Account = array($rows->ID,'1');
																$Amount = $Display->Display_Single_Info_Modified($sql_account,'Amount',$Execute_Account);
																$Amount_Array[] = sprintf('%.2f',$Amount);
																
																$sql_log = 'SELECT OID FROM logs WHERE Table_Name = ? AND Action = ? AND RID = ? ';
																$Execute_log = array('users','1',$rows->ID);
																$OID = $Display->Display_Single_Info_Modified($sql_log,'OID',$Execute_log);
																
																$sql_oid = 'SELECT First_Name FROM users WHERE ID = ?';
																$Execute_oid = array($OID);
																$Creator_First_Name = $Display->Display_Single_Info_Modified($sql_oid,'First_Name',$Execute_oid);
																
																$Log_Creator[] = $Creator_First_Name;
																$MID_Array[] = $rows->ID;
																$Sender_Name_Array[] = $rows->Sender_Name;
															} 
													}
											}
										else
											{
												$sql_offer = 'SELECT AID FROM '.$Table_Offers.' WHERE Status = ? AND Ads_Sub_Cat = ?';
												$Execute_Offers = array('1',$Sub_Cat_ID);
												$results_offers = $Display->Display_Info($sql_offer,$Execute_Offers);
												$AID_Array = array();
												foreach($results_offers as $rows_offers)
													{
														$AID_Array[] = $rows_offers->AID;
													}
												$sql = 'SELECT RID FROM logs WHERE Table_Name = ? AND Action = ? AND OID = ?';
												$Execute_Array = array('users','1',$Sales_ID);
												$results = $Display->Display_Info($sql,$Execute_Array);
												foreach($results as $rows)
													{
														$MID_Array_Non_Filtered[] = $rows->RID;
													}
												$sql_users = 'SELECT ID,Sender_Name,Country FROM users WHERE Status = ? AND Level = ? AND Ads_Cat = ? AND Country = ?';
												$Execute_Array = array('1','2',$Cat_ID,$Country);
												$results = $Display->Display_Info($sql_users,$Execute_Array);
												foreach($results as $rows)
													{
														if(in_array($rows->ID,$MID_Array_Non_Filtered))
															{
																
																if(in_array($rows->ID,$AID_Array))
																	{
																		$sql_country = 'SELECT Name FROM '.$Table.' WHERE ID = ?';
																		$Execute_Country = array($rows->Country);
																		$Country_Name = $Display->Display_Single_Info_Modified($sql_country,'Name',$Execute_Country);
																		$Country_Name_Array[] = $Country_Name;
																		
																		$sql_account = 'SELECT Amount FROM merchant_accounts WHERE MID = ? AND Status = ?';
																		$Execute_Account = array($rows->ID,'1');
																		$Amount = $Display->Display_Single_Info_Modified($sql_account,'Amount',$Execute_Account);
																		$Amount_Array[] = sprintf('%.2f',$Amount);
																		
																		$sql_log = 'SELECT OID FROM logs WHERE Table_Name = ? AND Action = ? AND RID = ? ';
																		$Execute_log = array('users','1',$rows->ID);
																		$OID = $Display->Display_Single_Info_Modified($sql_log,'OID',$Execute_log);
																		
																		$sql_oid = 'SELECT First_Name FROM users WHERE ID = ?';
																		$Execute_oid = array($OID);
																		$Creator_First_Name = $Display->Display_Single_Info_Modified($sql_oid,'First_Name',$Execute_oid);
																		
																		$Log_Creator[] = $Creator_First_Name;
																		$MID_Array[] = $rows->ID;
																		$Sender_Name_Array[] = $rows->Sender_Name;
																	}
															} 
													}
											}
										
										$this->registry->template->MID_Array = $MID_Array;
										$this->registry->template->Sender_Name_Array = $Sender_Name_Array;
										$this->registry->template->Country_Name_Array = $Country_Name_Array;
										$this->registry->template->Amount_Array = $Amount_Array;
										$this->registry->template->Log_Creator = $Log_Creator;
									}
								elseif(($Country == '999')&&($Sales_ID == '999')&&($MID != '999')&&($Cat_ID != '999'))
									{
										$MID_Array = array();
										$Sender_Name_Array = array();
										$Country_Name_Array = array();
										$Amount_Array = array();
										$Log_Creator = array();
										if($Sub_Cat_ID == '999')
											{
												$sql = 'SELECT Sender_Name,Country FROM users WHERE ID = ?';
												$Execute_Array = array($MID);
												$results = $Display->Display_Info($sql,$Execute_Array);
												foreach($results as $rows)
													{
														$sql_country = 'SELECT Name FROM '.$Table.' WHERE ID = ?';
														$Execute_Country = array($rows->Country);
														$Country_Name = $Display->Display_Single_Info_Modified($sql_country,'Name',$Execute_Country);
														$Country_Name_Array[] = $Country_Name;
														
														$sql_account = 'SELECT Amount FROM merchant_accounts WHERE MID = ? AND Status = ?';
														$Execute_Account = array($MID,'1');
														$Amount = $Display->Display_Single_Info_Modified($sql_account,'Amount',$Execute_Account);
														$Amount_Array[] = sprintf('%.2f',$Amount);
														
														$sql_log = 'SELECT OID FROM logs WHERE Table_Name = ? AND Action = ? AND RID = ?';
														$Execute_log = array('users','1',$MID);
														$OID = $Display->Display_Single_Info_Modified($sql_log,'OID',$Execute_log);
														
														$sql_oid = 'SELECT First_Name FROM users WHERE ID = ?';
														$Execute_oid = array($OID);
														$Creator_First_Name = $Display->Display_Single_Info_Modified($sql_oid,'First_Name',$Execute_oid);
														
														$Log_Creator[] = $Creator_First_Name;
														$MID_Array[] = $MID;
														$Sender_Name_Array[] = $rows->Sender_Name;
													}
											}
										else
											{
												$sql_offer = 'SELECT AID FROM '.$Table_Offers.' WHERE Status = ? AND Ads_Sub_Cat = ?';
												$Execute_Offers = array('1',$Sub_Cat_ID);
												$results_offers = $Display->Display_Info($sql_offer,$Execute_Offers);
												$AID_Array = array();
												foreach($results_offers as $rows_offers)
													{
														$AID_Array[] = $rows_offers->AID;
													}
												$sql = 'SELECT Sender_Name,Country FROM users WHERE ID = ?';
												$Execute_Array = array($MID);
												$results = $Display->Display_Info($sql,$Execute_Array);
												foreach($results as $rows)
													{
														
														if(in_array($MID,$AID_Array))
															{
																$sql_country = 'SELECT Name FROM '.$Table.' WHERE ID = ?';
																$Execute_Country = array($rows->Country);
																$Country_Name = $Display->Display_Single_Info_Modified($sql_country,'Name',$Execute_Country);
																$Country_Name_Array[] = $Country_Name;
																
																$sql_account = 'SELECT Amount FROM merchant_accounts WHERE MID = ? AND Status = ?';
																$Execute_Account = array($MID,'1');
																$Amount = $Display->Display_Single_Info_Modified($sql_account,'Amount',$Execute_Account);
																$Amount_Array[] = sprintf('%.2f',$Amount);
																
																$sql_log = 'SELECT OID FROM logs WHERE Table_Name = ? AND Action = ? AND RID = ?';
																$Execute_log = array('users','1',$MID);
																$OID = $Display->Display_Single_Info_Modified($sql_log,'OID',$Execute_log);
																
																$sql_oid = 'SELECT First_Name FROM users WHERE ID = ?';
																$Execute_oid = array($OID);
																$Creator_First_Name = $Display->Display_Single_Info_Modified($sql_oid,'First_Name',$Execute_oid);
																
																$Log_Creator[] = $Creator_First_Name;
																$MID_Array[] = $MID;
																$Sender_Name_Array[] = $rows->Sender_Name;
															}
													}
											}
										
										$this->registry->template->MID_Array = $MID_Array;
										$this->registry->template->Sender_Name_Array = $Sender_Name_Array;
										$this->registry->template->Country_Name_Array = $Country_Name_Array;
										$this->registry->template->Amount_Array = $Amount_Array;
										$this->registry->template->Log_Creator = $Log_Creator;
									}
								elseif(($Country != '999')&&($Sales_ID == '999')&&($MID != '999')&&($Cat_ID != '999'))
									{
										$MID_Array = array();
										$Sender_Name_Array = array();
										$Country_Name_Array = array();
										$Amount_Array = array();
										$Log_Creator = array();
										if($Sub_Cat_ID == '999')
											{
												$sql = 'SELECT Sender_Name,Country FROM users WHERE ID = ?';
												$Execute_Array = array($MID);
												$results = $Display->Display_Info($sql,$Execute_Array);
												foreach($results as $rows)
													{
														$sql_country = 'SELECT Name FROM '.$Table.' WHERE ID = ?';
														$Execute_Country = array($rows->Country);
														$Country_Name = $Display->Display_Single_Info_Modified($sql_country,'Name',$Execute_Country);
														$Country_Name_Array[] = $Country_Name;
														
														$sql_account = 'SELECT Amount FROM merchant_accounts WHERE MID = ? AND Status = ?';
														$Execute_Account = array($MID,'1');
														$Amount = $Display->Display_Single_Info_Modified($sql_account,'Amount',$Execute_Account);
														$Amount_Array[] = sprintf('%.2f',$Amount);
														
														$sql_log = 'SELECT OID FROM logs WHERE Table_Name = ? AND Action = ? AND RID = ? ';
														$Execute_log = array('users','1',$MID);
														$OID = $Display->Display_Single_Info_Modified($sql_log,'OID',$Execute_log);
														
														$sql_oid = 'SELECT First_Name FROM users WHERE ID = ?';
														$Execute_oid = array($OID);
														$Creator_First_Name = $Display->Display_Single_Info_Modified($sql_oid,'First_Name',$Execute_oid);
														
														$Log_Creator[] = $Creator_First_Name;
														$MID_Array[] = $MID;
														$Sender_Name_Array[] = $rows->Sender_Name;
													}
											}
										else
											{
												$sql_offer = 'SELECT AID FROM '.$Table_Offers.' WHERE Status = ? AND Ads_Sub_Cat = ?';
												$Execute_Offers = array('1',$Sub_Cat_ID);
												$results_offers = $Display->Display_Info($sql_offer,$Execute_Offers);
												$AID_Array = array();
												foreach($results_offers as $rows_offers)
													{
														$AID_Array[] = $rows_offers->AID;
													}
												$sql = 'SELECT Sender_Name,Country FROM users WHERE ID = ?';
												$Execute_Array = array($MID);
												$results = $Display->Display_Info($sql,$Execute_Array);
												foreach($results as $rows)
													{
														
														if(in_array($MID,$AID_Array))
															{
																$sql_country = 'SELECT Name FROM '.$Table.' WHERE ID = ?';
																$Execute_Country = array($rows->Country);
																$Country_Name = $Display->Display_Single_Info_Modified($sql_country,'Name',$Execute_Country);
																$Country_Name_Array[] = $Country_Name;
																
																$sql_account = 'SELECT Amount FROM merchant_accounts WHERE MID = ? AND Status = ?';
																$Execute_Account = array($MID,'1');
																$Amount = $Display->Display_Single_Info_Modified($sql_account,'Amount',$Execute_Account);
																$Amount_Array[] = sprintf('%.2f',$Amount);
																
																$sql_log = 'SELECT OID FROM logs WHERE Table_Name = ? AND Action = ? AND RID = ? ';
																$Execute_log = array('users','1',$MID);
																$OID = $Display->Display_Single_Info_Modified($sql_log,'OID',$Execute_log);
																
																$sql_oid = 'SELECT First_Name FROM users WHERE ID = ?';
																$Execute_oid = array($OID);
																$Creator_First_Name = $Display->Display_Single_Info_Modified($sql_oid,'First_Name',$Execute_oid);
																
																$Log_Creator[] = $Creator_First_Name;
																$MID_Array[] = $MID;
																$Sender_Name_Array[] = $rows->Sender_Name;
															}
													}
											}
										
										$this->registry->template->MID_Array = $MID_Array;
										$this->registry->template->Sender_Name_Array = $Sender_Name_Array;
										$this->registry->template->Country_Name_Array = $Country_Name_Array;
										$this->registry->template->Amount_Array = $Amount_Array;
										$this->registry->template->Log_Creator = $Log_Creator;
									}
								elseif(($Country == '999')&&($Sales_ID != '999')&&($MID != '999')&&($Cat_ID != '999'))
									{
										$MID_Array = array();
										$Sender_Name_Array = array();
										$Country_Name_Array = array();
										$Amount_Array = array();
										$Log_Creator = array();
										if($Sub_Cat_ID == '999')
											{
												$sql = 'SELECT Sender_Name,Country FROM users WHERE ID = ?';
												$Execute_Array = array($MID);
												$results = $Display->Display_Info($sql,$Execute_Array);
												foreach($results as $rows)
													{
														$sql_country = 'SELECT Name FROM '.$Table.' WHERE ID = ?';
														$Execute_Country = array($rows->Country);
														$Country_Name = $Display->Display_Single_Info_Modified($sql_country,'Name',$Execute_Country);
														$Country_Name_Array[] = $Country_Name;
														
														$sql_account = 'SELECT Amount FROM merchant_accounts WHERE MID = ? AND Status = ?';
														$Execute_Account = array($MID,'1');
														$Amount = $Display->Display_Single_Info_Modified($sql_account,'Amount',$Execute_Account);
														$Amount_Array[] = sprintf('%.2f',$Amount);
														
														$sql_log = 'SELECT OID FROM logs WHERE Table_Name = ? AND Action = ? AND RID = ?';
														$Execute_log = array('users','1',$MID);
														$OID = $Display->Display_Single_Info_Modified($sql_log,'OID',$Execute_log);
														
														$sql_oid = 'SELECT First_Name FROM users WHERE ID = ?';
														$Execute_oid = array($OID);
														$Creator_First_Name = $Display->Display_Single_Info_Modified($sql_oid,'First_Name',$Execute_oid);
														
														$Log_Creator[] = $Creator_First_Name;
														$MID_Array[] = $MID;
														$Sender_Name_Array[] = $rows->Sender_Name;
													}
											}
										else
											{
												$sql_offer = 'SELECT AID FROM '.$Table_Offers.' WHERE Status = ? AND Ads_Sub_Cat = ?';
												$Execute_Offers = array('1',$Sub_Cat_ID);
												$results_offers = $Display->Display_Info($sql_offer,$Execute_Offers);
												$AID_Array = array();
												foreach($results_offers as $rows_offers)
													{
														$AID_Array[] = $rows_offers->AID;
													}
												$sql = 'SELECT Sender_Name,Country FROM users WHERE ID = ?';
												$Execute_Array = array($MID);
												$results = $Display->Display_Info($sql,$Execute_Array);
												foreach($results as $rows)
													{
														
														if(in_array($MID,$AID_Array))
															{
																$sql_country = 'SELECT Name FROM '.$Table.' WHERE ID = ?';
																$Execute_Country = array($rows->Country);
																$Country_Name = $Display->Display_Single_Info_Modified($sql_country,'Name',$Execute_Country);
																$Country_Name_Array[] = $Country_Name;
																
																$sql_account = 'SELECT Amount FROM merchant_accounts WHERE MID = ? AND Status = ?';
																$Execute_Account = array($MID,'1');
																$Amount = $Display->Display_Single_Info_Modified($sql_account,'Amount',$Execute_Account);
																$Amount_Array[] = sprintf('%.2f',$Amount);
																
																$sql_log = 'SELECT OID FROM logs WHERE Table_Name = ? AND Action = ? AND RID = ?';
																$Execute_log = array('users','1',$MID);
																$OID = $Display->Display_Single_Info_Modified($sql_log,'OID',$Execute_log);
																
																$sql_oid = 'SELECT First_Name FROM users WHERE ID = ?';
																$Execute_oid = array($OID);
																$Creator_First_Name = $Display->Display_Single_Info_Modified($sql_oid,'First_Name',$Execute_oid);
																
																$Log_Creator[] = $Creator_First_Name;
																$MID_Array[] = $MID;
																$Sender_Name_Array[] = $rows->Sender_Name;
															}
													}
											}
										
										$this->registry->template->MID_Array = $MID_Array;
										$this->registry->template->Sender_Name_Array = $Sender_Name_Array;
										$this->registry->template->Country_Name_Array = $Country_Name_Array;
										$this->registry->template->Amount_Array = $Amount_Array;
										$this->registry->template->Log_Creator = $Log_Creator;
									}
								else
									{
										$MID_Array = array();
										$Sender_Name_Array = array();
										$Country_Name_Array = array();
										$Amount_Array = array();
										$Log_Creator = array();
										if($Sub_Cat_ID == '999')
											{
												$sql = 'SELECT ID,Sender_Name,Country FROM users WHERE Status = ? AND Level = ?';
												$Execute_Array = array('1','2');
												$results = $Display->Display_Info($sql,$Execute_Array);
												foreach($results as $rows)
													{
														$sql_country = 'SELECT Name FROM '.$Table.' WHERE ID = ?';
														$Execute_Country = array($rows->Country);
														$Country_Name = $Display->Display_Single_Info_Modified($sql_country,'Name',$Execute_Country);
														$Country_Name_Array[] = $Country_Name;
														
														$sql_account = 'SELECT Amount FROM merchant_accounts WHERE MID = ? AND Status = ?';
														$Execute_Account = array($rows->ID,'1');
														$Amount = $Display->Display_Single_Info_Modified($sql_account,'Amount',$Execute_Account);
														$Amount_Array[] = sprintf('%.2f',$Amount);
														
														$sql_log = 'SELECT OID FROM logs WHERE Table_Name = ? AND Action = ? AND RID = ?';
														$Execute_log = array('users','1',$rows->ID);
														$OID = $Display->Display_Single_Info_Modified($sql_log,'OID',$Execute_log);
														
														$sql_oid = 'SELECT First_Name FROM users WHERE ID = ?';
														$Execute_oid = array($OID);
														$Creator_First_Name = $Display->Display_Single_Info_Modified($sql_oid,'First_Name',$Execute_oid);
														
														$Log_Creator[] = $Creator_First_Name;
														$MID_Array[] = $rows->ID;
														$Sender_Name_Array[] = $rows->Sender_Name;
													}
											}
										else
											{
												$sql_offer = 'SELECT AID FROM '.$Table_Offers.' WHERE Status = ? AND Ads_Sub_Cat = ?';
												$Execute_Offers = array('1',$Sub_Cat_ID);
												$results_offers = $Display->Display_Info($sql_offer,$Execute_Offers);
												$AID_Array = array();
												foreach($results_offers as $rows_offers)
													{
														$AID_Array[] = $rows_offers->AID;
													}
												$sql = 'SELECT ID,Sender_Name,Country FROM users WHERE Status = ? AND Level = ?';
												$Execute_Array = array('1','2');
												$results = $Display->Display_Info($sql,$Execute_Array);
												foreach($results as $rows)
													{
														
														if(in_array($rows->ID,$AID_Array))
															{
																$sql_country = 'SELECT Name FROM '.$Table.' WHERE ID = ?';
																$Execute_Country = array($rows->Country);
																$Country_Name = $Display->Display_Single_Info_Modified($sql_country,'Name',$Execute_Country);
																$Country_Name_Array[] = $Country_Name;
																
																$sql_account = 'SELECT Amount FROM merchant_accounts WHERE MID = ? AND Status = ?';
																$Execute_Account = array($rows->ID,'1');
																$Amount = $Display->Display_Single_Info_Modified($sql_account,'Amount',$Execute_Account);
																$Amount_Array[] = sprintf('%.2f',$Amount);
																
																$sql_log = 'SELECT OID FROM logs WHERE Table_Name = ? AND Action = ? AND RID = ?';
																$Execute_log = array('users','1',$rows->ID);
																$OID = $Display->Display_Single_Info_Modified($sql_log,'OID',$Execute_log);
																
																$sql_oid = 'SELECT First_Name FROM users WHERE ID = ?';
																$Execute_oid = array($OID);
																$Creator_First_Name = $Display->Display_Single_Info_Modified($sql_oid,'First_Name',$Execute_oid);
																
																$Log_Creator[] = $Creator_First_Name;
																$MID_Array[] = $rows->ID;
																$Sender_Name_Array[] = $rows->Sender_Name;
															}
													}
											}
										
										$this->registry->template->MID_Array = $MID_Array;
										$this->registry->template->Sender_Name_Array = $Sender_Name_Array;
										$this->registry->template->Country_Name_Array = $Country_Name_Array;
										$this->registry->template->Amount_Array = $Amount_Array;
										$this->registry->template->Log_Creator = $Log_Creator;
									}
										
							}
						else
							{
								$Starts_Date = date('Y-m-d',strtotime($Starts_Date));
								$End_Date = date('Y-m-d',strtotime($End_Date));
								
								if(($Country == '999')&&($Sales_ID == '999')&&($MID == '999')&&($Cat_ID == '999'))
									{
										$MID_Array = array();
										$Sender_Name_Array = array();
										$Country_Name_Array = array();
										$Amount_Array = array();
										$Log_Creator = array();
										if($Sub_Cat_ID == '999')
											{
												$sql = 'SELECT ID,Sender_Name,Country FROM users WHERE Status = ? AND Level = ? AND (Starts_Date <= ? AND End_Date >= ?)';
												$Execute_Array = array('1','2',$Starts_Date,$End_Date);
												$results = $Display->Display_Info($sql,$Execute_Array);
												foreach($results as $rows)
													{
														$sql_country = 'SELECT Name FROM '.$Table.' WHERE ID = ?';
														$Execute_Country = array($rows->Country);
														$Country_Name = $Display->Display_Single_Info_Modified($sql_country,'Name',$Execute_Country);
														$Country_Name_Array[] = $Country_Name;
														
														$sql_account = 'SELECT Amount FROM merchant_accounts WHERE MID = ? AND Status = ?';
														$Execute_Account = array($rows->ID,'1');
														$Amount = $Display->Display_Single_Info_Modified($sql_account,'Amount',$Execute_Account);
														$Amount_Array[] = sprintf('%.2f',$Amount);
														
														$sql_log = 'SELECT OID FROM logs WHERE Table_Name = ? AND Action = ? AND RID = ?';
														$Execute_log = array('users','1',$rows->ID);
														$OID = $Display->Display_Single_Info_Modified($sql_log,'OID',$Execute_log);
														
														$sql_oid = 'SELECT First_Name FROM users WHERE ID = ?';
														$Execute_oid = array($OID);
														$Creator_First_Name = $Display->Display_Single_Info_Modified($sql_oid,'First_Name',$Execute_oid);
														
														$Log_Creator[] = $Creator_First_Name;
														$MID_Array[] = $rows->ID;
														$Sender_Name_Array[] = $rows->Sender_Name;
														
													}
											}
										else
											{
												$sql_offer = 'SELECT AID FROM '.$Table_Offers.' WHERE Status = ? AND Ads_Sub_Cat = ?';
												$Execute_Offers = array('1',$Sub_Cat_ID);
												$results_offers = $Display->Display_Info($sql_offer,$Execute_Offers);
												$AID_Array = array();
												foreach($results_offers as $rows_offers)
													{
														$AID_Array[] = $rows_offers->AID;
													}
												$sql = 'SELECT ID,Sender_Name,Country FROM users WHERE Status = ? AND Level = ? AND (Starts_Date <= ? AND End_Date >= ?)';
												$Execute_Array = array('1','2',$Starts_Date,$End_Date);
												$results = $Display->Display_Info($sql,$Execute_Array);
												foreach($results as $rows)
													{
														
														if(in_array($rows->ID,$AID_Array))
																	{
																		
																		$sql_country = 'SELECT Name FROM '.$Table.' WHERE ID = ?';
																		$Execute_Country = array($rows->Country);
																		$Country_Name = $Display->Display_Single_Info_Modified($sql_country,'Name',$Execute_Country);
																		$Country_Name_Array[] = $Country_Name;
																		
																		$sql_account = 'SELECT Amount FROM merchant_accounts WHERE MID = ? AND Status = ?';
																		$Execute_Account = array($rows->ID,'1');
																		$Amount = $Display->Display_Single_Info_Modified($sql_account,'Amount',$Execute_Account);
																		$Amount_Array[] = sprintf('%.2f',$Amount);
																		
																		$sql_log = 'SELECT OID FROM logs WHERE Table_Name = ? AND Action = ? AND RID = ?';
																		$Execute_log = array('users','1',$rows->ID);
																		$OID = $Display->Display_Single_Info_Modified($sql_log,'OID',$Execute_log);
																		
																		$sql_oid = 'SELECT First_Name FROM users WHERE ID = ?';
																		$Execute_oid = array($OID);
																		$Creator_First_Name = $Display->Display_Single_Info_Modified($sql_oid,'First_Name',$Execute_oid);
																		
																		$Log_Creator[] = $Creator_First_Name;
																		$MID_Array[] = $rows->ID;
																		$Sender_Name_Array[] = $rows->Sender_Name;
																	}
															}
											}
										
										$this->registry->template->MID_Array = $MID_Array;
										$this->registry->template->Sender_Name_Array = $Sender_Name_Array;
										$this->registry->template->Country_Name_Array = $Country_Name_Array;
										$this->registry->template->Amount_Array = $Amount_Array;
										$this->registry->template->Log_Creator = $Log_Creator;
									}
								elseif(($Country != '999')&&($Sales_ID == '999')&&($MID == '999')&&($Cat_ID == '999'))
									{
										$MID_Array = array();
										$Sender_Name_Array = array();
										$Country_Name_Array = array();
										$Amount_Array = array();
										$Log_Creator = array();
										if($Sub_Cat_ID == '999')
											{
												$sql = 'SELECT ID,Sender_Name,Country FROM users WHERE Status = ? AND Level = ? AND Country = ? AND (Starts_Date <= ? AND End_Date >= ?)';
												$Execute_Array = array('1','2',$Country,$Starts_Date,$End_Date);
												$results = $Display->Display_Info($sql,$Execute_Array);
												foreach($results as $rows)
													{
														$sql_country = 'SELECT Name FROM '.$Table.' WHERE ID = ?';
														$Execute_Country = array($rows->Country);
														$Country_Name = $Display->Display_Single_Info_Modified($sql_country,'Name',$Execute_Country);
														$Country_Name_Array[] = $Country_Name;
														
														$sql_account = 'SELECT Amount FROM merchant_accounts WHERE MID = ? AND Status = ?';
														$Execute_Account = array($rows->ID,'1');
														$Amount = $Display->Display_Single_Info_Modified($sql_account,'Amount',$Execute_Account);
														$Amount_Array[] = sprintf('%.2f',$Amount);
														
														$sql_log = 'SELECT OID FROM logs WHERE Table_Name = ? AND Action = ? AND RID = ? ';
														$Execute_log = array('users','1',$rows->ID);
														$OID = $Display->Display_Single_Info_Modified($sql_log,'OID',$Execute_log);
														
														$sql_oid = 'SELECT First_Name FROM users WHERE ID = ?';
														$Execute_oid = array($OID);
														$Creator_First_Name = $Display->Display_Single_Info_Modified($sql_oid,'First_Name',$Execute_oid);
														
														$Log_Creator[] = $Creator_First_Name;
														$MID_Array[] = $rows->ID;
														$Sender_Name_Array[] = $rows->Sender_Name;
													}
											}
										else
											{
												$sql_offer = 'SELECT AID FROM '.$Table_Offers.' WHERE Status = ? AND Ads_Sub_Cat = ?';
												$Execute_Offers = array('1',$Sub_Cat_ID);
												$results_offers = $Display->Display_Info($sql_offer,$Execute_Offers);
												$AID_Array = array();
												foreach($results_offers as $rows_offers)
													{
														$AID_Array[] = $rows_offers->AID;
													}
													$sql = 'SELECT ID,Sender_Name,Country FROM users WHERE Status = ? AND Level = ? AND Country = ? AND (Starts_Date <= ? AND End_Date >= ?)';
													$Execute_Array = array('1','2',$Country,$Starts_Date,$End_Date);
													$results = $Display->Display_Info($sql,$Execute_Array);
													foreach($results as $rows)
														{
															
															if(in_array($rows->ID,$AID_Array))
																{
																	$sql_country = 'SELECT Name FROM '.$Table.' WHERE ID = ?';
																	$Execute_Country = array($rows->Country);
																	$Country_Name = $Display->Display_Single_Info_Modified($sql_country,'Name',$Execute_Country);
																	$Country_Name_Array[] = $Country_Name;
																	
																	$sql_account = 'SELECT Amount FROM merchant_accounts WHERE MID = ? AND Status = ?';
																	$Execute_Account = array($rows->ID,'1');
																	$Amount = $Display->Display_Single_Info_Modified($sql_account,'Amount',$Execute_Account);
																	$Amount_Array[] = sprintf('%.2f',$Amount);
																	
																	$sql_log = 'SELECT OID FROM logs WHERE Table_Name = ? AND Action = ? AND RID = ? ';
																	$Execute_log = array('users','1',$rows->ID);
																	$OID = $Display->Display_Single_Info_Modified($sql_log,'OID',$Execute_log);
																	
																	$sql_oid = 'SELECT First_Name FROM users WHERE ID = ?';
																	$Execute_oid = array($OID);
																	$Creator_First_Name = $Display->Display_Single_Info_Modified($sql_oid,'First_Name',$Execute_oid);
																	
																	$Log_Creator[] = $Creator_First_Name;
																	$MID_Array[] = $rows->ID;
																	$Sender_Name_Array[] = $rows->Sender_Name;
																}
														}
											}
										
										$this->registry->template->MID_Array = $MID_Array;
										$this->registry->template->Sender_Name_Array = $Sender_Name_Array;
										$this->registry->template->Country_Name_Array = $Country_Name_Array;
										$this->registry->template->Amount_Array = $Amount_Array;
										$this->registry->template->Log_Creator = $Log_Creator;
									}
								elseif(($Country == '999')&&($Sales_ID != '999')&&($MID == '999')&&($Cat_ID == '999'))
									{
										$MID_Array = array();
										$Sender_Name_Array = array();
										$MID_Array_Non_Filtered = array();
										$Country_Name_Array = array();
										$Amount_Array = array();
										$Log_Creator = array();
										if($Sub_Cat_ID == '999')
											{
												$sql = 'SELECT RID FROM logs WHERE Table_Name = ? AND Action = ? AND OID = ?';
												$Execute_Array = array('users','1',$Sales_ID);
												$results = $Display->Display_Info($sql,$Execute_Array);
												foreach($results as $rows)
													{
														$MID_Array_Non_Filtered[] = $rows->RID;
													}
												$sql_users = 'SELECT ID,Sender_Name,Country FROM users WHERE Status = ? AND Level = ? AND (Starts_Date <= ? AND End_Date >= ?)';
												$Execute_Array = array('1','2',$Starts_Date,$End_Date);
												$results = $Display->Display_Info($sql_users,$Execute_Array);
												foreach($results as $rows)
													{
														if(in_array($rows->ID,$MID_Array_Non_Filtered))
															{
																$sql_country = 'SELECT Name FROM '.$Table.' WHERE ID = ?';
																$Execute_Country = array($rows->Country);
																$Country_Name = $Display->Display_Single_Info_Modified($sql_country,'Name',$Execute_Country);
																$Country_Name_Array[] = $Country_Name;
																
																$sql_account = 'SELECT Amount FROM merchant_accounts WHERE MID = ? AND Status = ?';
																$Execute_Account = array($rows->ID,'1');
																$Amount = $Display->Display_Single_Info_Modified($sql_account,'Amount',$Execute_Account);
																$Amount_Array[] = sprintf('%.2f',$Amount);
																
																$sql_log = 'SELECT OID FROM logs WHERE Table_Name = ? AND Action = ? AND RID = ? ';
																$Execute_log = array('users','1',$rows->ID);
																$OID = $Display->Display_Single_Info_Modified($sql_log,'OID',$Execute_log);
																
																$sql_oid = 'SELECT First_Name FROM users WHERE ID = ?';
																$Execute_oid = array($OID);
																$Creator_First_Name = $Display->Display_Single_Info_Modified($sql_oid,'First_Name',$Execute_oid);
																
																$Log_Creator[] = $Creator_First_Name;
																$MID_Array[] = $rows->ID;
																$Sender_Name_Array[] = $rows->Sender_Name;
															} 
													}
											}
										else
											{
												$sql_offer = 'SELECT AID FROM '.$Table_Offers.' WHERE Status = ? AND Ads_Sub_Cat = ?';
												$Execute_Offers = array('1',$Sub_Cat_ID);
												$results_offers = $Display->Display_Info($sql_offer,$Execute_Offers);
												$AID_Array = array();
												foreach($results_offers as $rows_offers)
													{
														$AID_Array[] = $rows_offers->AID;
													}
												$sql = 'SELECT RID FROM logs WHERE Table_Name = ? AND Action = ? AND OID = ?';
												$Execute_Array = array('users','1',$Sales_ID);
												$results = $Display->Display_Info($sql,$Execute_Array);
												foreach($results as $rows)
													{
														$MID_Array_Non_Filtered[] = $rows->RID;
													}
												$sql_users = 'SELECT ID,Sender_Name,Country FROM users WHERE Status = ? AND Level = ? AND (Starts_Date <= ? AND End_Date >= ?)';
												$Execute_Array = array('1','2',$Starts_Date,$End_Date);
												$results = $Display->Display_Info($sql_users,$Execute_Array);
												foreach($results as $rows)
													{
														if(in_array($rows->ID,$MID_Array_Non_Filtered))
															{
																if(in_array($rows->ID,$AID_Array))
																	{
																		$sql_country = 'SELECT Name FROM '.$Table.' WHERE ID = ?';
																		$Execute_Country = array($rows->Country);
																		$Country_Name = $Display->Display_Single_Info_Modified($sql_country,'Name',$Execute_Country);
																		$Country_Name_Array[] = $Country_Name;
																		
																		$sql_account = 'SELECT Amount FROM merchant_accounts WHERE MID = ? AND Status = ?';
																		$Execute_Account = array($rows->ID,'1');
																		$Amount = $Display->Display_Single_Info_Modified($sql_account,'Amount',$Execute_Account);
																		$Amount_Array[] = sprintf('%.2f',$Amount);
																		
																		$sql_log = 'SELECT OID FROM logs WHERE Table_Name = ? AND Action = ? AND RID = ? ';
																		$Execute_log = array('users','1',$rows->ID);
																		$OID = $Display->Display_Single_Info_Modified($sql_log,'OID',$Execute_log);
																		
																		$sql_oid = 'SELECT First_Name FROM users WHERE ID = ?';
																		$Execute_oid = array($OID);
																		$Creator_First_Name = $Display->Display_Single_Info_Modified($sql_oid,'First_Name',$Execute_oid);
																		
																		$Log_Creator[] = $Creator_First_Name;
																		$MID_Array[] = $rows->ID;
																		$Sender_Name_Array[] = $rows->Sender_Name;
																	}
															} 
													}
											}
										
										$this->registry->template->MID_Array = $MID_Array;
										$this->registry->template->Sender_Name_Array = $Sender_Name_Array;
										$this->registry->template->Country_Name_Array = $Country_Name_Array;
										$this->registry->template->Amount_Array = $Amount_Array;
										$this->registry->template->Log_Creator = $Log_Creator;
									}
								elseif(($Country != '999')&&($Sales_ID != '999')&&($MID == '999')&&($Cat_ID == '999'))
									{
										$MID_Array_Non_Filtered = array();
										$MID_Array = array();
										$Sender_Name_Array = array();
										$Country_Name_Array = array();
										$Amount_Array = array();
										$Log_Creator = array();
										if($Sub_Cat_ID == '999')
											{
												$sql = 'SELECT RID FROM logs WHERE Table_Name = ? AND Action = ? AND OID = ?';
												$Execute_Array = array('users','1',$Sales_ID);
												$results = $Display->Display_Info($sql,$Execute_Array);
												foreach($results as $rows)
													{
														$MID_Array_Non_Filtered[] = $rows->RID;
													}
												$sql_users = 'SELECT ID,Sender_Name,Country FROM users WHERE Status = ? AND Level = ? AND Country = ? AND (Starts_Date <= ? AND End_Date >= ?)';
												$Execute_Array = array('1','2',$Country,$Starts_Date,$End_Date);
												$results = $Display->Display_Info($sql_users,$Execute_Array);
												foreach($results as $rows)
													{
														if(in_array($rows->ID,$MID_Array_Non_Filtered))
															{
																$sql_country = 'SELECT Name FROM '.$Table.' WHERE ID = ?';
																$Execute_Country = array($rows->Country);
																$Country_Name = $Display->Display_Single_Info_Modified($sql_country,'Name',$Execute_Country);
																$Country_Name_Array[] = $Country_Name;
																
																$sql_account = 'SELECT Amount FROM merchant_accounts WHERE MID = ? AND Status = ?';
																$Execute_Account = array($rows->ID,'1');
																$Amount = $Display->Display_Single_Info_Modified($sql_account,'Amount',$Execute_Account);
																$Amount_Array[] = sprintf('%.2f',$Amount);
																
																$sql_log = 'SELECT OID FROM logs WHERE Table_Name = ? AND Action = ? AND RID = ? ';
																$Execute_log = array('users','1',$rows->ID);
																$OID = $Display->Display_Single_Info_Modified($sql_log,'OID',$Execute_log);
																
																$sql_oid = 'SELECT First_Name FROM users WHERE ID = ?';
																$Execute_oid = array($OID);
																$Creator_First_Name = $Display->Display_Single_Info_Modified($sql_oid,'First_Name',$Execute_oid);
																
																$Log_Creator[] = $Creator_First_Name;
														
																$MID_Array[] = $rows->ID;
																$Sender_Name_Array[] = $rows->Sender_Name;
															} 
													}
											}
										else
											{
												$sql_offer = 'SELECT AID FROM '.$Table_Offers.' WHERE Status = ? AND Ads_Sub_Cat = ?';
												$Execute_Offers = array('1',$Sub_Cat_ID);
												$results_offers = $Display->Display_Info($sql_offer,$Execute_Offers);
												$AID_Array = array();
												foreach($results_offers as $rows_offers)
													{
														$AID_Array[] = $rows_offers->AID;
													}
												$sql = 'SELECT RID FROM logs WHERE Table_Name = ? AND Action = ? AND OID = ?';
												$Execute_Array = array('users','1',$Sales_ID);
												$results = $Display->Display_Info($sql,$Execute_Array);
												foreach($results as $rows)
													{
														$MID_Array_Non_Filtered[] = $rows->RID;
													}
												$sql_users = 'SELECT ID,Sender_Name,Country FROM users WHERE Status = ? AND Level = ? AND Country = ? AND (Starts_Date <= ? AND End_Date >= ?)';
												$Execute_Array = array('1','2',$Country,$Starts_Date,$End_Date);
												$results = $Display->Display_Info($sql_users,$Execute_Array);
												foreach($results as $rows)
													{
														if(in_array($rows->ID,$MID_Array_Non_Filtered))
															{
																if(in_array($rows->ID,$AID_Array))
																	{
																		$sql_country = 'SELECT Name FROM '.$Table.' WHERE ID = ?';
																		$Execute_Country = array($rows->Country);
																		$Country_Name = $Display->Display_Single_Info_Modified($sql_country,'Name',$Execute_Country);
																		$Country_Name_Array[] = $Country_Name;
																		
																		$sql_account = 'SELECT Amount FROM merchant_accounts WHERE MID = ? AND Status = ?';
																		$Execute_Account = array($rows->ID,'1');
																		$Amount = $Display->Display_Single_Info_Modified($sql_account,'Amount',$Execute_Account);
																		$Amount_Array[] = sprintf('%.2f',$Amount);
																		
																		$sql_log = 'SELECT OID FROM logs WHERE Table_Name = ? AND Action = ? AND RID = ? ';
																		$Execute_log = array('users','1',$rows->ID);
																		$OID = $Display->Display_Single_Info_Modified($sql_log,'OID',$Execute_log);
																		
																		$sql_oid = 'SELECT First_Name FROM users WHERE ID = ?';
																		$Execute_oid = array($OID);
																		$Creator_First_Name = $Display->Display_Single_Info_Modified($sql_oid,'First_Name',$Execute_oid);
																		
																		$Log_Creator[] = $Creator_First_Name;
																
																		$MID_Array[] = $rows->ID;
																		$Sender_Name_Array[] = $rows->Sender_Name;
																	}
															} 
													}
											}
										
										$this->registry->template->MID_Array = $MID_Array;
										$this->registry->template->Sender_Name_Array = $Sender_Name_Array;
										$this->registry->template->Country_Name_Array = $Country_Name_Array;
										$this->registry->template->Amount_Array = $Amount_Array;
										$this->registry->template->Log_Creator = $Log_Creator;
									}
								elseif(($Country == '999')&&($Sales_ID == '999')&&($MID != '999')&&($Cat_ID == '999'))
									{
										$MID_Array = array();
										$Sender_Name_Array = array();
										$Country_Name_Array = array();
										$Amount_Array = array();
										$Log_Creator = array();
										if($Sub_Cat_ID == '999')
											{
												$sql = 'SELECT Sender_Name,Country FROM users WHERE ID = ? AND (Starts_Date <= ? AND End_Date >= ?)';
												$Execute_Array = array($MID,$Starts_Date,$End_Date);
												$results = $Display->Display_Info($sql,$Execute_Array);
												foreach($results as $rows)
													{
														$sql_country = 'SELECT Name FROM '.$Table.' WHERE ID = ?';
														$Execute_Country = array($rows->Country);
														$Country_Name = $Display->Display_Single_Info_Modified($sql_country,'Name',$Execute_Country);
														$Country_Name_Array[] = $Country_Name;
														
														$sql_account = 'SELECT Amount FROM merchant_accounts WHERE MID = ? AND Status = ?';
														$Execute_Account = array($MID,'1');
														$Amount = $Display->Display_Single_Info_Modified($sql_account,'Amount',$Execute_Account);
														$Amount_Array[] = sprintf('%.2f',$Amount);
														
														$sql_log = 'SELECT OID FROM logs WHERE Table_Name = ? AND Action = ? AND RID = ?';
														$Execute_log = array('users','1',$MID);
														$OID = $Display->Display_Single_Info_Modified($sql_log,'OID',$Execute_log);
														
														$sql_oid = 'SELECT First_Name FROM users WHERE ID = ?';
														$Execute_oid = array($OID);
														$Creator_First_Name = $Display->Display_Single_Info_Modified($sql_oid,'First_Name',$Execute_oid);
														
														$Log_Creator[] = $Creator_First_Name;
														
														$MID_Array[] = $MID;
														$Sender_Name_Array[] = $rows->Sender_Name;
													}
											}
										else
											{
												$sql_offer = 'SELECT AID FROM '.$Table_Offers.' WHERE Status = ? AND Ads_Sub_Cat = ?';
												$Execute_Offers = array('1',$Sub_Cat_ID);
												$results_offers = $Display->Display_Info($sql_offer,$Execute_Offers);
												$AID_Array = array();
												foreach($results_offers as $rows_offers)
													{
														$AID_Array[] = $rows_offers->AID;
													}
												$sql = 'SELECT Sender_Name,Country FROM users WHERE ID = ? AND (Starts_Date <= ? AND End_Date >= ?)';
												$Execute_Array = array($MID,$Starts_Date,$End_Date);
												$results = $Display->Display_Info($sql,$Execute_Array);
												foreach($results as $rows)
													{
														if(in_array($MID,$AID_Array))
															{
																$sql_country = 'SELECT Name FROM '.$Table.' WHERE ID = ?';
																$Execute_Country = array($rows->Country);
																$Country_Name = $Display->Display_Single_Info_Modified($sql_country,'Name',$Execute_Country);
																$Country_Name_Array[] = $Country_Name;
																
																$sql_account = 'SELECT Amount FROM merchant_accounts WHERE MID = ? AND Status = ?';
																$Execute_Account = array($MID,'1');
																$Amount = $Display->Display_Single_Info_Modified($sql_account,'Amount',$Execute_Account);
																$Amount_Array[] = sprintf('%.2f',$Amount);
																
																$sql_log = 'SELECT OID FROM logs WHERE Table_Name = ? AND Action = ? AND RID = ?';
																$Execute_log = array('users','1',$MID);
																$OID = $Display->Display_Single_Info_Modified($sql_log,'OID',$Execute_log);
																
																$sql_oid = 'SELECT First_Name FROM users WHERE ID = ?';
																$Execute_oid = array($OID);
																$Creator_First_Name = $Display->Display_Single_Info_Modified($sql_oid,'First_Name',$Execute_oid);
																
																$Log_Creator[] = $Creator_First_Name;
																
																$MID_Array[] = $MID;
																$Sender_Name_Array[] = $rows->Sender_Name;
															}
													}
											}
										
										$this->registry->template->MID_Array = $MID_Array;
										$this->registry->template->Sender_Name_Array = $Sender_Name_Array;
										$this->registry->template->Country_Name_Array = $Country_Name_Array;
										$this->registry->template->Amount_Array = $Amount_Array;
										$this->registry->template->Log_Creator = $Log_Creator;
									}
								elseif(($Country != '999')&&($Sales_ID == '999')&&($MID != '999')&&($Cat_ID == '999'))
									{
										$MID_Array = array();
										$Sender_Name_Array = array();
										$Country_Name_Array = array();
										$Amount_Array = array();
										$Log_Creator = array();
										if($Sub_Cat_ID == '999')
											{
												$sql = 'SELECT Sender_Name,Country FROM users WHERE ID = ? AND (Starts_Date <= ? AND End_Date >= ?)';
												$Execute_Array = array($MID,$Starts_Date,$End_Date);
												$results = $Display->Display_Info($sql,$Execute_Array);
												foreach($results as $rows)
													{
														$sql_country = 'SELECT Name FROM '.$Table.' WHERE ID = ?';
														$Execute_Country = array($rows->Country);
														$Country_Name = $Display->Display_Single_Info_Modified($sql_country,'Name',$Execute_Country);
														$Country_Name_Array[] = $Country_Name;
														
														$sql_account = 'SELECT Amount FROM merchant_accounts WHERE MID = ? AND Status = ?';
														$Execute_Account = array($MID,'1');
														$Amount = $Display->Display_Single_Info_Modified($sql_account,'Amount',$Execute_Account);
														$Amount_Array[] = sprintf('%.2f',$Amount);
														
														$sql_log = 'SELECT OID FROM logs WHERE Table_Name = ? AND Action = ? AND RID = ? ';
														$Execute_log = array('users','1',$MID);
														$OID = $Display->Display_Single_Info_Modified($sql_log,'OID',$Execute_log);
														
														$sql_oid = 'SELECT First_Name FROM users WHERE ID = ?';
														$Execute_oid = array($OID);
														$Creator_First_Name = $Display->Display_Single_Info_Modified($sql_oid,'First_Name',$Execute_oid);
														
														$Log_Creator[] = $Creator_First_Name;
														
														$MID_Array[] = $MID;
														$Sender_Name_Array[] = $rows->Sender_Name;
													}
											}
										else
											{
												$sql_offer = 'SELECT AID FROM '.$Table_Offers.' WHERE Status = ? AND Ads_Sub_Cat = ?';
												$Execute_Offers = array('1',$Sub_Cat_ID);
												$results_offers = $Display->Display_Info($sql_offer,$Execute_Offers);
												$AID_Array = array();
												foreach($results_offers as $rows_offers)
													{
														$AID_Array[] = $rows_offers->AID;
													}
												$sql = 'SELECT Sender_Name,Country FROM users WHERE ID = ? AND (Starts_Date <= ? AND End_Date >= ?)';
												$Execute_Array = array($MID,$Starts_Date,$End_Date);
												$results = $Display->Display_Info($sql,$Execute_Array);
												foreach($results as $rows)
													{
														
														if(in_array($MID,$AID_Array))
															{
																$sql_country = 'SELECT Name FROM '.$Table.' WHERE ID = ?';
																$Execute_Country = array($rows->Country);
																$Country_Name = $Display->Display_Single_Info_Modified($sql_country,'Name',$Execute_Country);
																$Country_Name_Array[] = $Country_Name;
																
																$sql_account = 'SELECT Amount FROM merchant_accounts WHERE MID = ? AND Status = ?';
																$Execute_Account = array($MID,'1');
																$Amount = $Display->Display_Single_Info_Modified($sql_account,'Amount',$Execute_Account);
																$Amount_Array[] = sprintf('%.2f',$Amount);
																
																$sql_log = 'SELECT OID FROM logs WHERE Table_Name = ? AND Action = ? AND RID = ? ';
																$Execute_log = array('users','1',$MID);
																$OID = $Display->Display_Single_Info_Modified($sql_log,'OID',$Execute_log);
																
																$sql_oid = 'SELECT First_Name FROM users WHERE ID = ?';
																$Execute_oid = array($OID);
																$Creator_First_Name = $Display->Display_Single_Info_Modified($sql_oid,'First_Name',$Execute_oid);
																
																$Log_Creator[] = $Creator_First_Name;
																
																$MID_Array[] = $MID;
																$Sender_Name_Array[] = $rows->Sender_Name;
															}
													}
											}
										
										$this->registry->template->MID_Array = $MID_Array;
										$this->registry->template->Sender_Name_Array = $Sender_Name_Array;
										$this->registry->template->Country_Name_Array = $Country_Name_Array;
										$this->registry->template->Amount_Array = $Amount_Array;
										$this->registry->template->Log_Creator = $Log_Creator;
									}
								elseif(($Country == '999')&&($Sales_ID != '999')&&($MID != '999')&&($Cat_ID == '999'))
									{
										$MID_Array = array();
										$Sender_Name_Array = array();
										$Country_Name_Array = array();
										$Amount_Array = array();
										$Log_Creator = array();
										if($Sub_Cat_ID == '999')
											{
												$sql = 'SELECT Sender_Name,Country FROM users WHERE ID = ? AND (Starts_Date <= ? AND End_Date >= ?)';
												$Execute_Array = array($MID,$Starts_Date,$End_Date);
												$results = $Display->Display_Info($sql,$Execute_Array);
												foreach($results as $rows)
													{
														$sql_country = 'SELECT Name FROM '.$Table.' WHERE ID = ?';
														$Execute_Country = array($rows->Country);
														$Country_Name = $Display->Display_Single_Info_Modified($sql_country,'Name',$Execute_Country);
														$Country_Name_Array[] = $Country_Name;
														
														$sql_account = 'SELECT Amount FROM merchant_accounts WHERE MID = ? AND Status = ?';
														$Execute_Account = array($MID,'1');
														$Amount = $Display->Display_Single_Info_Modified($sql_account,'Amount',$Execute_Account);
														$Amount_Array[] = sprintf('%.2f',$Amount);
														
														$sql_log = 'SELECT OID FROM logs WHERE Table_Name = ? AND Action = ? AND RID = ?';
														$Execute_log = array('users','1',$MID);
														$OID = $Display->Display_Single_Info_Modified($sql_log,'OID',$Execute_log);
														
														$sql_oid = 'SELECT First_Name FROM users WHERE ID = ?';
														$Execute_oid = array($OID);
														$Creator_First_Name = $Display->Display_Single_Info_Modified($sql_oid,'First_Name',$Execute_oid);
														
														$Log_Creator[] = $Creator_First_Name;
														$MID_Array[] = $MID;
														$Sender_Name_Array[] = $rows->Sender_Name;
													}
											}
										else
											{
												$sql_offer = 'SELECT AID FROM '.$Table_Offers.' WHERE Status = ? AND Ads_Sub_Cat = ?';
												$Execute_Offers = array('1',$Sub_Cat_ID);
												$results_offers = $Display->Display_Info($sql_offer,$Execute_Offers);
												$AID_Array = array();
												foreach($results_offers as $rows_offers)
													{
														$AID_Array[] = $rows_offers->AID;
													}
												$sql = 'SELECT Sender_Name,Country FROM users WHERE ID = ? AND (Starts_Date <= ? AND End_Date >= ?)';
												$Execute_Array = array($MID,$Starts_Date,$End_Date);
												$results = $Display->Display_Info($sql,$Execute_Array);
												foreach($results as $rows)
													{
														if(in_array($MID,$AID_Array))
															{
																$sql_country = 'SELECT Name FROM '.$Table.' WHERE ID = ?';
																$Execute_Country = array($rows->Country);
																$Country_Name = $Display->Display_Single_Info_Modified($sql_country,'Name',$Execute_Country);
																$Country_Name_Array[] = $Country_Name;
																
																$sql_account = 'SELECT Amount FROM merchant_accounts WHERE MID = ? AND Status = ?';
																$Execute_Account = array($MID,'1');
																$Amount = $Display->Display_Single_Info_Modified($sql_account,'Amount',$Execute_Account);
																$Amount_Array[] = sprintf('%.2f',$Amount);
																
																$sql_log = 'SELECT OID FROM logs WHERE Table_Name = ? AND Action = ? AND RID = ?';
																$Execute_log = array('users','1',$MID);
																$OID = $Display->Display_Single_Info_Modified($sql_log,'OID',$Execute_log);
																
																$sql_oid = 'SELECT First_Name FROM users WHERE ID = ?';
																$Execute_oid = array($OID);
																$Creator_First_Name = $Display->Display_Single_Info_Modified($sql_oid,'First_Name',$Execute_oid);
																
																$Log_Creator[] = $Creator_First_Name;
																$MID_Array[] = $MID;
																$Sender_Name_Array[] = $rows->Sender_Name;
															}
													}
											}
										
										$this->registry->template->MID_Array = $MID_Array;
										$this->registry->template->Sender_Name_Array = $Sender_Name_Array;
										$this->registry->template->Country_Name_Array = $Country_Name_Array;
										$this->registry->template->Amount_Array = $Amount_Array;
										$this->registry->template->Log_Creator = $Log_Creator;
									}
								elseif(($Country != '999')&&($Sales_ID != '999')&&($MID != '999')&&($Cat_ID == '999'))
									{
										$MID_Array = array();
										$Sender_Name_Array = array();
										$Country_Name_Array = array();
										$Amount_Array = array();
										$Log_Creator = array();
										if($Sub_Cat_ID == '999')
											{
												$sql = 'SELECT Sender_Name,Country FROM users WHERE ID = ? AND (Starts_Date <= ? AND End_Date >= ?)';
												$Execute_Array = array($MID,$Starts_Date,$End_Date);
												$results = $Display->Display_Info($sql,$Execute_Array);
												foreach($results as $rows)
													{
														$sql_country = 'SELECT Name FROM '.$Table.' WHERE ID = ?';
														$Execute_Country = array($rows->Country);
														$Country_Name = $Display->Display_Single_Info_Modified($sql_country,'Name',$Execute_Country);
														$Country_Name_Array[] = $Country_Name;
														
														$sql_account = 'SELECT Amount FROM merchant_accounts WHERE MID = ? AND Status = ?';
														$Execute_Account = array($MID,'1');
														$Amount = $Display->Display_Single_Info_Modified($sql_account,'Amount',$Execute_Account);
														$Amount_Array[] = sprintf('%.2f',$Amount);
														
														$sql_log = 'SELECT OID FROM logs WHERE Table_Name = ? AND Action = ? AND RID = ? ';
														$Execute_log = array('users','1',$MID);
														$OID = $Display->Display_Single_Info_Modified($sql_log,'OID',$Execute_log);
														
														$sql_oid = 'SELECT First_Name FROM users WHERE ID = ?';
														$Execute_oid = array($OID);
														$Creator_First_Name = $Display->Display_Single_Info_Modified($sql_oid,'First_Name',$Execute_oid);
														
														$Log_Creator[] = $Creator_First_Name;
														$MID_Array[] = $MID;
														$Sender_Name_Array[] = $rows->Sender_Name;
													}
											}
										else
											{
												$sql_offer = 'SELECT AID FROM '.$Table_Offers.' WHERE Status = ? AND Ads_Sub_Cat = ?';
												$Execute_Offers = array('1',$Sub_Cat_ID);
												$results_offers = $Display->Display_Info($sql_offer,$Execute_Offers);
												$AID_Array = array();
												foreach($results_offers as $rows_offers)
													{
														$AID_Array[] = $rows_offers->AID;
													}
												$sql = 'SELECT Sender_Name,Country FROM users WHERE ID = ? AND (Starts_Date <= ? AND End_Date >= ?)';
												$Execute_Array = array($MID,$Starts_Date,$End_Date);
												$results = $Display->Display_Info($sql,$Execute_Array);
												foreach($results as $rows)
													{
														
														if(in_array($MID,$AID_Array))
															{
																$sql_country = 'SELECT Name FROM '.$Table.' WHERE ID = ?';
																$Execute_Country = array($rows->Country);
																$Country_Name = $Display->Display_Single_Info_Modified($sql_country,'Name',$Execute_Country);
																$Country_Name_Array[] = $Country_Name;
																
																$sql_account = 'SELECT Amount FROM merchant_accounts WHERE MID = ? AND Status = ?';
																$Execute_Account = array($MID,'1');
																$Amount = $Display->Display_Single_Info_Modified($sql_account,'Amount',$Execute_Account);
																$Amount_Array[] = sprintf('%.2f',$Amount);
																
																$sql_log = 'SELECT OID FROM logs WHERE Table_Name = ? AND Action = ? AND RID = ? ';
																$Execute_log = array('users','1',$MID);
																$OID = $Display->Display_Single_Info_Modified($sql_log,'OID',$Execute_log);
																
																$sql_oid = 'SELECT First_Name FROM users WHERE ID = ?';
																$Execute_oid = array($OID);
																$Creator_First_Name = $Display->Display_Single_Info_Modified($sql_oid,'First_Name',$Execute_oid);
																
																$Log_Creator[] = $Creator_First_Name;
																$MID_Array[] = $MID;
																$Sender_Name_Array[] = $rows->Sender_Name;
															}
													}
											}
										
										$this->registry->template->MID_Array = $MID_Array;
										$this->registry->template->Sender_Name_Array = $Sender_Name_Array;
										$this->registry->template->Country_Name_Array = $Country_Name_Array;
										$this->registry->template->Amount_Array = $Amount_Array;
										$this->registry->template->Log_Creator = $Log_Creator;
									}
								elseif(($Country == '999')&&($Sales_ID == '999')&&($MID == '999')&&($Cat_ID != '999'))
									{
										$MID_Array = array();
										$Sender_Name_Array = array();
										$Country_Name_Array = array();
										$Amount_Array = array();
										$Log_Creator = array();
										if($Sub_Cat_ID == '999')
											{
												$sql = 'SELECT ID,Sender_Name,Country FROM users WHERE Level = ? AND Status = ? AND Ads_Cat = ? AND (Starts_Date <= ? AND End_Date >= ?)';
												$Execute_Array = array('2','1',$Cat_ID,$Starts_Date,$End_Date);
												$results = $Display->Display_Info($sql,$Execute_Array);
												foreach($results as $rows)
													{
														$sql_country = 'SELECT Name FROM '.$Table.' WHERE ID = ?';
														$Execute_Country = array($rows->Country);
														$Country_Name = $Display->Display_Single_Info_Modified($sql_country,'Name',$Execute_Country);
														$Country_Name_Array[] = $Country_Name;
														
														$sql_account = 'SELECT Amount FROM merchant_accounts WHERE MID = ? AND Status = ?';
														$Execute_Account = array($rows->ID,'1');
														$Amount = $Display->Display_Single_Info_Modified($sql_account,'Amount',$Execute_Account);
														$Amount_Array[] = sprintf('%.2f',$Amount);
														
														$sql_log = 'SELECT OID FROM logs WHERE Table_Name = ? AND Action = ? AND RID = ? ';
														$Execute_log = array('users','1',$rows->ID);
														$OID = $Display->Display_Single_Info_Modified($sql_log,'OID',$Execute_log);
														
														$sql_oid = 'SELECT First_Name FROM users WHERE ID = ?';
														$Execute_oid = array($OID);
														$Creator_First_Name = $Display->Display_Single_Info_Modified($sql_oid,'First_Name',$Execute_oid);
														
														$Log_Creator[] = $Creator_First_Name;
														$MID_Array[] = $rows->ID;
														$Sender_Name_Array[] = $rows->Sender_Name;
													}
											}
										else
											{
												$sql_offer = 'SELECT AID FROM '.$Table_Offers.' WHERE Status = ? AND Ads_Sub_Cat = ?';
												$Execute_Offers = array('1',$Sub_Cat_ID);
												$results_offers = $Display->Display_Info($sql_offer,$Execute_Offers);
												$AID_Array = array();
												foreach($results_offers as $rows_offers)
													{
														$AID_Array[] = $rows_offers->AID;
													}
												$sql = 'SELECT ID,Sender_Name,Country FROM users WHERE Level = ? AND Status = ? AND Ads_Cat = ? AND (Starts_Date <= ? AND End_Date >= ?)';
												$Execute_Array = array('2','1',$Cat_ID,$Starts_Date,$End_Date);
												$results = $Display->Display_Info($sql,$Execute_Array);
												foreach($results as $rows)
													{
														
														if(in_array($rows->ID,$AID_Array))
															{
																$sql_country = 'SELECT Name FROM '.$Table.' WHERE ID = ?';
																$Execute_Country = array($rows->Country);
																$Country_Name = $Display->Display_Single_Info_Modified($sql_country,'Name',$Execute_Country);
																$Country_Name_Array[] = $Country_Name;
																
																$sql_account = 'SELECT Amount FROM merchant_accounts WHERE MID = ? AND Status = ?';
																$Execute_Account = array($rows->ID,'1');
																$Amount = $Display->Display_Single_Info_Modified($sql_account,'Amount',$Execute_Account);
																$Amount_Array[] = sprintf('%.2f',$Amount);
																
																$sql_log = 'SELECT OID FROM logs WHERE Table_Name = ? AND Action = ? AND RID = ? ';
																$Execute_log = array('users','1',$rows->ID);
																$OID = $Display->Display_Single_Info_Modified($sql_log,'OID',$Execute_log);
																
																$sql_oid = 'SELECT First_Name FROM users WHERE ID = ?';
																$Execute_oid = array($OID);
																$Creator_First_Name = $Display->Display_Single_Info_Modified($sql_oid,'First_Name',$Execute_oid);
																
																$Log_Creator[] = $Creator_First_Name;
																$MID_Array[] = $rows->ID;
																$Sender_Name_Array[] = $rows->Sender_Name;
															}
													}
											}
										
										$this->registry->template->MID_Array = $MID_Array;
										$this->registry->template->Sender_Name_Array = $Sender_Name_Array;
										$this->registry->template->Country_Name_Array = $Country_Name_Array;
										$this->registry->template->Amount_Array = $Amount_Array;
										$this->registry->template->Log_Creator = $Log_Creator;
									}
								elseif(($Country != '999')&&($Sales_ID == '999')&&($MID == '999')&&($Cat_ID != '999'))
									{
										$MID_Array = array();
										$Sender_Name_Array = array();
										$Country_Name_Array = array();
										$Amount_Array = array();
										$Log_Creator = array();
										if($Sub_Cat_ID == '999')
											{
												$sql = 'SELECT ID,Sender_Name,Country FROM users WHERE Level = ? AND Status = ? AND Ads_Cat = ? AND Country = ? AND (Starts_Date <= ? AND End_Date >= ?)';
												$Execute_Array = array('2','1',$Cat_ID,$Country,$Starts_Date,$End_Date);
												$results = $Display->Display_Info($sql,$Execute_Array);
												foreach($results as $rows)
													{
														$sql_country = 'SELECT Name FROM '.$Table.' WHERE ID = ?';
														$Execute_Country = array($rows->Country);
														$Country_Name = $Display->Display_Single_Info_Modified($sql_country,'Name',$Execute_Country);
														$Country_Name_Array[] = $Country_Name;
														
														$sql_account = 'SELECT Amount FROM merchant_accounts WHERE MID = ? AND Status = ?';
														$Execute_Account = array($rows->ID,'1');
														$Amount = $Display->Display_Single_Info_Modified($sql_account,'Amount',$Execute_Account);
														$Amount_Array[] = sprintf('%.2f',$Amount);
														
														$sql_log = 'SELECT OID FROM logs WHERE Table_Name = ? AND Action = ? AND RID = ? ';
														$Execute_log = array('users','1',$rows->ID);
														$OID = $Display->Display_Single_Info_Modified($sql_log,'OID',$Execute_log);
														
														$sql_oid = 'SELECT First_Name FROM users WHERE ID = ?';
														$Execute_oid = array($OID);
														$Creator_First_Name = $Display->Display_Single_Info_Modified($sql_oid,'First_Name',$Execute_oid);
														
														$Log_Creator[] = $Creator_First_Name;
														$MID_Array[] = $rows->ID;
														$Sender_Name_Array[] = $rows->Sender_Name;
													}
											}
										else
											{
												$sql_offer = 'SELECT AID FROM '.$Table_Offers.' WHERE Status = ? AND Ads_Sub_Cat = ?';
												$Execute_Offers = array('1',$Sub_Cat_ID);
												$results_offers = $Display->Display_Info($sql_offer,$Execute_Offers);
												$AID_Array = array();
												foreach($results_offers as $rows_offers)
													{
														$AID_Array[] = $rows_offers->AID;
													}
												$sql = 'SELECT ID,Sender_Name,Country FROM users WHERE Level = ? AND Status = ? AND Ads_Cat = ? AND Country = ? AND (Starts_Date <= ? AND End_Date >= ?)';
												$Execute_Array = array('2','1',$Cat_ID,$Country,$Starts_Date,$End_Date);
												$results = $Display->Display_Info($sql,$Execute_Array);
												foreach($results as $rows)
													{
														
														if(in_array($rows->ID,$AID_Array))
															{
																$sql_country = 'SELECT Name FROM '.$Table.' WHERE ID = ?';
																$Execute_Country = array($rows->Country);
																$Country_Name = $Display->Display_Single_Info_Modified($sql_country,'Name',$Execute_Country);
																$Country_Name_Array[] = $Country_Name;
																
																$sql_account = 'SELECT Amount FROM merchant_accounts WHERE MID = ? AND Status = ?';
																$Execute_Account = array($rows->ID,'1');
																$Amount = $Display->Display_Single_Info_Modified($sql_account,'Amount',$Execute_Account);
																$Amount_Array[] = sprintf('%.2f',$Amount);
																
																$sql_log = 'SELECT OID FROM logs WHERE Table_Name = ? AND Action = ? AND RID = ? ';
																$Execute_log = array('users','1',$rows->ID);
																$OID = $Display->Display_Single_Info_Modified($sql_log,'OID',$Execute_log);
																
																$sql_oid = 'SELECT First_Name FROM users WHERE ID = ?';
																$Execute_oid = array($OID);
																$Creator_First_Name = $Display->Display_Single_Info_Modified($sql_oid,'First_Name',$Execute_oid);
																
																$Log_Creator[] = $Creator_First_Name;
																$MID_Array[] = $rows->ID;
																$Sender_Name_Array[] = $rows->Sender_Name;
															}
													}
											}
										
										$this->registry->template->MID_Array = $MID_Array;
										$this->registry->template->Sender_Name_Array = $Sender_Name_Array;
										$this->registry->template->Country_Name_Array = $Country_Name_Array;
										$this->registry->template->Amount_Array = $Amount_Array;
										$this->registry->template->Log_Creator = $Log_Creator;
									}
								elseif(($Country == '999')&&($Sales_ID != '999')&&($MID == '999')&&($Cat_ID != '999'))
									{
										$MID_Array = array();
										$Sender_Name_Array = array();
										$MID_Array_Non_Filtered = array();
										$Country_Name_Array = array();
										$Amount_Array = array();
										$Log_Creator = array();
										if($Sub_Cat_ID == '999')
											{
												$sql = 'SELECT RID FROM logs WHERE Table_Name = ? AND Action = ? AND OID = ?';
												$Execute_Array = array('users','1',$Sales_ID);
												$results = $Display->Display_Info($sql,$Execute_Array);
												foreach($results as $rows)
													{
														$MID_Array_Non_Filtered[] = $rows->RID;
													}
												$sql_users = 'SELECT ID,Sender_Name,Country FROM users WHERE Status = ? AND Level = ? AND Ads_Cat = ? AND (Starts_Date <= ? AND End_Date >= ?)';
												$Execute_Array = array('1','2',$Cat_ID,$Starts_Date,$End_Date);
												$results = $Display->Display_Info($sql_users,$Execute_Array);
												foreach($results as $rows)
													{
														if(in_array($rows->ID,$MID_Array_Non_Filtered))
															{
																$sql_country = 'SELECT Name FROM '.$Table.' WHERE ID = ?';
																$Execute_Country = array($rows->Country);
																$Country_Name = $Display->Display_Single_Info_Modified($sql_country,'Name',$Execute_Country);
																$Country_Name_Array[] = $Country_Name;
																
																$sql_account = 'SELECT Amount FROM merchant_accounts WHERE MID = ? AND Status = ?';
																$Execute_Account = array($rows->ID,'1');
																$Amount = $Display->Display_Single_Info_Modified($sql_account,'Amount',$Execute_Account);
																$Amount_Array[] = sprintf('%.2f',$Amount);
																
																$sql_log = 'SELECT OID FROM logs WHERE Table_Name = ? AND Action = ? AND RID = ? ';
																$Execute_log = array('users','1',$rows->ID);
																$OID = $Display->Display_Single_Info_Modified($sql_log,'OID',$Execute_log);
																
																$sql_oid = 'SELECT First_Name FROM users WHERE ID = ?';
																$Execute_oid = array($OID);
																$Creator_First_Name = $Display->Display_Single_Info_Modified($sql_oid,'First_Name',$Execute_oid);
																
																$Log_Creator[] = $Creator_First_Name;
														
																$MID_Array[] = $rows->ID;
																$Sender_Name_Array[] = $rows->Sender_Name;
															} 
													}
											}
										else
											{
												$sql_offer = 'SELECT AID FROM '.$Table_Offers.' WHERE Status = ? AND Ads_Sub_Cat = ?';
												$Execute_Offers = array('1',$Sub_Cat_ID);
												$results_offers = $Display->Display_Info($sql_offer,$Execute_Offers);
												$AID_Array = array();
												foreach($results_offers as $rows_offers)
													{
														$AID_Array[] = $rows_offers->AID;
													}
												$sql = 'SELECT RID FROM logs WHERE Table_Name = ? AND Action = ? AND OID = ?';
												$Execute_Array = array('users','1',$Sales_ID);
												$results = $Display->Display_Info($sql,$Execute_Array);
												foreach($results as $rows)
													{
														$MID_Array_Non_Filtered[] = $rows->RID;
													}
												$sql_users = 'SELECT ID,Sender_Name,Country FROM users WHERE Status = ? AND Level = ? AND Ads_Cat = ? AND (Starts_Date <= ? AND End_Date >= ?)';
												$Execute_Array = array('1','2',$Cat_ID,$Starts_Date,$End_Date);
												$results = $Display->Display_Info($sql_users,$Execute_Array);
												foreach($results as $rows)
													{
														if(in_array($rows->ID,$MID_Array_Non_Filtered))
															{
																
																if(in_array($rows->ID,$AID_Array))
																	{
																		$sql_country = 'SELECT Name FROM '.$Table.' WHERE ID = ?';
																		$Execute_Country = array($rows->Country);
																		$Country_Name = $Display->Display_Single_Info_Modified($sql_country,'Name',$Execute_Country);
																		$Country_Name_Array[] = $Country_Name;
																		
																		$sql_account = 'SELECT Amount FROM merchant_accounts WHERE MID = ? AND Status = ?';
																		$Execute_Account = array($rows->ID,'1');
																		$Amount = $Display->Display_Single_Info_Modified($sql_account,'Amount',$Execute_Account);
																		$Amount_Array[] = sprintf('%.2f',$Amount);
																		
																		$sql_log = 'SELECT OID FROM logs WHERE Table_Name = ? AND Action = ? AND RID = ? ';
																		$Execute_log = array('users','1',$rows->ID);
																		$OID = $Display->Display_Single_Info_Modified($sql_log,'OID',$Execute_log);
																		
																		$sql_oid = 'SELECT First_Name FROM users WHERE ID = ?';
																		$Execute_oid = array($OID);
																		$Creator_First_Name = $Display->Display_Single_Info_Modified($sql_oid,'First_Name',$Execute_oid);
																		
																		$Log_Creator[] = $Creator_First_Name;
																
																		$MID_Array[] = $rows->ID;
																		$Sender_Name_Array[] = $rows->Sender_Name;
																	}
															} 
													}
											}
										
										$this->registry->template->MID_Array = $MID_Array;
										$this->registry->template->Sender_Name_Array = $Sender_Name_Array;
										$this->registry->template->Country_Name_Array = $Country_Name_Array;
										$this->registry->template->Amount_Array = $Amount_Array;
										$this->registry->template->Log_Creator = $Log_Creator;
									}
								elseif(($Country != '999')&&($Sales_ID != '999')&&($MID == '999')&&($Cat_ID != '999'))
									{
										$MID_Array = array();
										$Sender_Name_Array = array();
										$MID_Array_Non_Filtered = array();
										$Country_Name_Array = array();
										$Amount_Array = array();
										$Log_Creator = array();
										if($Sub_Cat_ID == '999')
											{
												$sql = 'SELECT RID FROM logs WHERE Table_Name = ? AND Action = ? AND OID = ?';
												$Execute_Array = array('users','1',$Sales_ID);
												$results = $Display->Display_Info($sql,$Execute_Array);
												foreach($results as $rows)
													{
														$MID_Array_Non_Filtered[] = $rows->RID;
													}
												$sql_users = 'SELECT ID,Sender_Name,Country FROM users WHERE Status = ? AND Level = ? AND Ads_Cat = ? AND Country = ? AND (Starts_Date <= ? AND End_Date >= ?)';
												$Execute_Array = array('1','2',$Cat_ID,$Country,$Starts_Date,$End_Date);
												$results = $Display->Display_Info($sql_users,$Execute_Array);
												foreach($results as $rows)
													{
														if(in_array($rows->ID,$MID_Array_Non_Filtered))
															{
																$sql_country = 'SELECT Name FROM '.$Table.' WHERE ID = ?';
																$Execute_Country = array($rows->Country);
																$Country_Name = $Display->Display_Single_Info_Modified($sql_country,'Name',$Execute_Country);
																$Country_Name_Array[] = $Country_Name;
																
																$sql_account = 'SELECT Amount FROM merchant_accounts WHERE MID = ? AND Status = ?';
																$Execute_Account = array($rows->ID,'1');
																$Amount = $Display->Display_Single_Info_Modified($sql_account,'Amount',$Execute_Account);
																$Amount_Array[] = sprintf('%.2f',$Amount);
																
																$sql_log = 'SELECT OID FROM logs WHERE Table_Name = ? AND Action = ? AND RID = ? ';
																$Execute_log = array('users','1',$rows->ID);
																$OID = $Display->Display_Single_Info_Modified($sql_log,'OID',$Execute_log);
																
																$sql_oid = 'SELECT First_Name FROM users WHERE ID = ?';
																$Execute_oid = array($OID);
																$Creator_First_Name = $Display->Display_Single_Info_Modified($sql_oid,'First_Name',$Execute_oid);
																
																$Log_Creator[] = $Creator_First_Name;
																$MID_Array[] = $rows->ID;
																$Sender_Name_Array[] = $rows->Sender_Name;
															} 
													}
											}
										else
											{
												$sql_offer = 'SELECT AID FROM '.$Table_Offers.' WHERE Status = ? AND Ads_Sub_Cat = ?';
												$Execute_Offers = array('1',$Sub_Cat_ID);
												$results_offers = $Display->Display_Info($sql_offer,$Execute_Offers);
												$AID_Array = array();
												foreach($results_offers as $rows_offers)
													{
														$AID_Array[] = $rows_offers->AID;
													}
												$sql = 'SELECT RID FROM logs WHERE Table_Name = ? AND Action = ? AND OID = ?';
												$Execute_Array = array('users','1',$Sales_ID);
												$results = $Display->Display_Info($sql,$Execute_Array);
												foreach($results as $rows)
													{
														$MID_Array_Non_Filtered[] = $rows->RID;
													}
												$sql_users = 'SELECT ID,Sender_Name,Country FROM users WHERE Status = ? AND Level = ? AND Ads_Cat = ? AND Country = ? AND (Starts_Date <= ? AND End_Date >= ?)';
												$Execute_Array = array('1','2',$Cat_ID,$Country,$Starts_Date,$End_Date);
												$results = $Display->Display_Info($sql_users,$Execute_Array);
												foreach($results as $rows)
													{
														if(in_array($rows->ID,$MID_Array_Non_Filtered))
															{
																
																if(in_array($rows->ID,$AID_Array))
																	{
																		$sql_country = 'SELECT Name FROM '.$Table.' WHERE ID = ?';
																		$Execute_Country = array($rows->Country);
																		$Country_Name = $Display->Display_Single_Info_Modified($sql_country,'Name',$Execute_Country);
																		$Country_Name_Array[] = $Country_Name;
																		
																		$sql_account = 'SELECT Amount FROM merchant_accounts WHERE MID = ? AND Status = ?';
																		$Execute_Account = array($rows->ID,'1');
																		$Amount = $Display->Display_Single_Info_Modified($sql_account,'Amount',$Execute_Account);
																		$Amount_Array[] = sprintf('%.2f',$Amount);
																		
																		$sql_log = 'SELECT OID FROM logs WHERE Table_Name = ? AND Action = ? AND RID = ? ';
																		$Execute_log = array('users','1',$rows->ID);
																		$OID = $Display->Display_Single_Info_Modified($sql_log,'OID',$Execute_log);
																		
																		$sql_oid = 'SELECT First_Name FROM users WHERE ID = ?';
																		$Execute_oid = array($OID);
																		$Creator_First_Name = $Display->Display_Single_Info_Modified($sql_oid,'First_Name',$Execute_oid);
																		
																		$Log_Creator[] = $Creator_First_Name;
																		$MID_Array[] = $rows->ID;
																		$Sender_Name_Array[] = $rows->Sender_Name;
																	}
															} 
													}
											}
										
										$this->registry->template->MID_Array = $MID_Array;
										$this->registry->template->Sender_Name_Array = $Sender_Name_Array;
										$this->registry->template->Country_Name_Array = $Country_Name_Array;
										$this->registry->template->Amount_Array = $Amount_Array;
										$this->registry->template->Log_Creator = $Log_Creator;
									}
								elseif(($Country == '999')&&($Sales_ID == '999')&&($MID != '999')&&($Cat_ID != '999'))
									{
										$MID_Array = array();
										$Sender_Name_Array = array();
										$Country_Name_Array = array();
										$Amount_Array = array();
										$Log_Creator = array();
										if($Sub_Cat_ID == '999')
											{
												$sql = 'SELECT Sender_Name,Country FROM users WHERE ID = ? AND (Starts_Date <= ? AND End_Date >= ?)';
												$Execute_Array = array($MID,$Starts_Date,$End_Date);
												$results = $Display->Display_Info($sql,$Execute_Array);
												foreach($results as $rows)
													{
														$sql_country = 'SELECT Name FROM '.$Table.' WHERE ID = ?';
														$Execute_Country = array($rows->Country);
														$Country_Name = $Display->Display_Single_Info_Modified($sql_country,'Name',$Execute_Country);
														$Country_Name_Array[] = $Country_Name;
														
														$sql_account = 'SELECT Amount FROM merchant_accounts WHERE MID = ? AND Status = ?';
														$Execute_Account = array($MID,'1');
														$Amount = $Display->Display_Single_Info_Modified($sql_account,'Amount',$Execute_Account);
														$Amount_Array[] = sprintf('%.2f',$Amount);
														
														$sql_log = 'SELECT OID FROM logs WHERE Table_Name = ? AND Action = ? AND RID = ?';
														$Execute_log = array('users','1',$MID);
														$OID = $Display->Display_Single_Info_Modified($sql_log,'OID',$Execute_log);
														
														$sql_oid = 'SELECT First_Name FROM users WHERE ID = ?';
														$Execute_oid = array($OID);
														$Creator_First_Name = $Display->Display_Single_Info_Modified($sql_oid,'First_Name',$Execute_oid);
														
														$Log_Creator[] = $Creator_First_Name;
														$MID_Array[] = $MID;
														$Sender_Name_Array[] = $rows->Sender_Name;
													}
											}
										else
											{
												$sql_offer = 'SELECT AID FROM '.$Table_Offers.' WHERE Status = ? AND Ads_Sub_Cat = ?';
												$Execute_Offers = array('1',$Sub_Cat_ID);
												$results_offers = $Display->Display_Info($sql_offer,$Execute_Offers);
												$AID_Array = array();
												foreach($results_offers as $rows_offers)
													{
														$AID_Array[] = $rows_offers->AID;
													}
												$sql = 'SELECT Sender_Name,Country FROM users WHERE ID = ?  AND (Starts_Date <= ? AND End_Date >= ?)';
												$Execute_Array = array($MID,$Starts_Date,$End_Date);
												$results = $Display->Display_Info($sql,$Execute_Array);
												foreach($results as $rows)
													{
														
														if(in_array($MID,$AID_Array))
															{
																$sql_country = 'SELECT Name FROM '.$Table.' WHERE ID = ?';
																$Execute_Country = array($rows->Country);
																$Country_Name = $Display->Display_Single_Info_Modified($sql_country,'Name',$Execute_Country);
																$Country_Name_Array[] = $Country_Name;
																
																$sql_account = 'SELECT Amount FROM merchant_accounts WHERE MID = ? AND Status = ?';
																$Execute_Account = array($MID,'1');
																$Amount = $Display->Display_Single_Info_Modified($sql_account,'Amount',$Execute_Account);
																$Amount_Array[] = sprintf('%.2f',$Amount);
																
																$sql_log = 'SELECT OID FROM logs WHERE Table_Name = ? AND Action = ? AND RID = ?';
																$Execute_log = array('users','1',$MID);
																$OID = $Display->Display_Single_Info_Modified($sql_log,'OID',$Execute_log);
																
																$sql_oid = 'SELECT First_Name FROM users WHERE ID = ?';
																$Execute_oid = array($OID);
																$Creator_First_Name = $Display->Display_Single_Info_Modified($sql_oid,'First_Name',$Execute_oid);
																
																$Log_Creator[] = $Creator_First_Name;
																$MID_Array[] = $MID;
																$Sender_Name_Array[] = $rows->Sender_Name;
															}
													}
											}
										
										$this->registry->template->MID_Array = $MID_Array;
										$this->registry->template->Sender_Name_Array = $Sender_Name_Array;
										$this->registry->template->Country_Name_Array = $Country_Name_Array;
										$this->registry->template->Amount_Array = $Amount_Array;
										$this->registry->template->Log_Creator = $Log_Creator;
									}
								elseif(($Country != '999')&&($Sales_ID == '999')&&($MID != '999')&&($Cat_ID != '999'))
									{
										$MID_Array = array();
										$Sender_Name_Array = array();
										$Country_Name_Array = array();
										$Amount_Array = array();
										$Log_Creator = array();
										if($Sub_Cat_ID == '999')
											{
												$sql = 'SELECT Sender_Name,Country FROM users WHERE ID = ?  AND (Starts_Date <= ? AND End_Date >= ?)';
												$Execute_Array = array($MID,$Starts_Date,$End_Date);
												$results = $Display->Display_Info($sql,$Execute_Array);
												foreach($results as $rows)
													{
														$sql_country = 'SELECT Name FROM '.$Table.' WHERE ID = ?';
														$Execute_Country = array($rows->Country);
														$Country_Name = $Display->Display_Single_Info_Modified($sql_country,'Name',$Execute_Country);
														$Country_Name_Array[] = $Country_Name;
														
														$sql_account = 'SELECT Amount FROM merchant_accounts WHERE MID = ? AND Status = ?';
														$Execute_Account = array($MID,'1');
														$Amount = $Display->Display_Single_Info_Modified($sql_account,'Amount',$Execute_Account);
														$Amount_Array[] = sprintf('%.2f',$Amount);
														
														$sql_log = 'SELECT OID FROM logs WHERE Table_Name = ? AND Action = ? AND RID = ? ';
														$Execute_log = array('users','1',$MID);
														$OID = $Display->Display_Single_Info_Modified($sql_log,'OID',$Execute_log);
														
														$sql_oid = 'SELECT First_Name FROM users WHERE ID = ?';
														$Execute_oid = array($OID);
														$Creator_First_Name = $Display->Display_Single_Info_Modified($sql_oid,'First_Name',$Execute_oid);
														
														$Log_Creator[] = $Creator_First_Name;
														$MID_Array[] = $MID;
														$Sender_Name_Array[] = $rows->Sender_Name;
													}
											}
										else
											{
												$sql_offer = 'SELECT AID FROM '.$Table_Offers.' WHERE Status = ? AND Ads_Sub_Cat = ?';
												$Execute_Offers = array('1',$Sub_Cat_ID);
												$results_offers = $Display->Display_Info($sql_offer,$Execute_Offers);
												$AID_Array = array();
												foreach($results_offers as $rows_offers)
													{
														$AID_Array[] = $rows_offers->AID;
													}
												$sql = 'SELECT Sender_Name,Country FROM users WHERE ID = ? AND (Starts_Date <= ? AND End_Date >= ?)';
												$Execute_Array = array($MID,$Starts_Date,$End_Date);
												$results = $Display->Display_Info($sql,$Execute_Array);
												foreach($results as $rows)
													{
														
														if(in_array($MID,$AID_Array))
															{
																$sql_country = 'SELECT Name FROM '.$Table.' WHERE ID = ?';
																$Execute_Country = array($rows->Country);
																$Country_Name = $Display->Display_Single_Info_Modified($sql_country,'Name',$Execute_Country);
																$Country_Name_Array[] = $Country_Name;
																
																$sql_account = 'SELECT Amount FROM merchant_accounts WHERE MID = ? AND Status = ?';
																$Execute_Account = array($MID,'1');
																$Amount = $Display->Display_Single_Info_Modified($sql_account,'Amount',$Execute_Account);
																$Amount_Array[] = sprintf('%.2f',$Amount);
																
																$sql_log = 'SELECT OID FROM logs WHERE Table_Name = ? AND Action = ? AND RID = ? ';
																$Execute_log = array('users','1',$MID);
																$OID = $Display->Display_Single_Info_Modified($sql_log,'OID',$Execute_log);
																
																$sql_oid = 'SELECT First_Name FROM users WHERE ID = ?';
																$Execute_oid = array($OID);
																$Creator_First_Name = $Display->Display_Single_Info_Modified($sql_oid,'First_Name',$Execute_oid);
																
																$Log_Creator[] = $Creator_First_Name;
																$MID_Array[] = $MID;
																$Sender_Name_Array[] = $rows->Sender_Name;
															}
													}
											}
										
										$this->registry->template->MID_Array = $MID_Array;
										$this->registry->template->Sender_Name_Array = $Sender_Name_Array;
										$this->registry->template->Country_Name_Array = $Country_Name_Array;
										$this->registry->template->Amount_Array = $Amount_Array;
										$this->registry->template->Log_Creator = $Log_Creator;
									}
								elseif(($Country == '999')&&($Sales_ID != '999')&&($MID != '999')&&($Cat_ID != '999'))
									{
										$MID_Array = array();
										$Sender_Name_Array = array();
										$Country_Name_Array = array();
										$Amount_Array = array();
										$Log_Creator = array();
										if($Sub_Cat_ID == '999')
											{
												$sql = 'SELECT Sender_Name,Country FROM users WHERE ID = ? AND (Starts_Date <= ? AND End_Date >= ?)';
												$Execute_Array = array($MID,$Starts_Date,$End_Date);
												$results = $Display->Display_Info($sql,$Execute_Array);
												foreach($results as $rows)
													{
														$sql_country = 'SELECT Name FROM '.$Table.' WHERE ID = ?';
														$Execute_Country = array($rows->Country);
														$Country_Name = $Display->Display_Single_Info_Modified($sql_country,'Name',$Execute_Country);
														$Country_Name_Array[] = $Country_Name;
														
														$sql_account = 'SELECT Amount FROM merchant_accounts WHERE MID = ? AND Status = ?';
														$Execute_Account = array($MID,'1');
														$Amount = $Display->Display_Single_Info_Modified($sql_account,'Amount',$Execute_Account);
														$Amount_Array[] = sprintf('%.2f',$Amount);
														
														$sql_log = 'SELECT OID FROM logs WHERE Table_Name = ? AND Action = ? AND RID = ?';
														$Execute_log = array('users','1',$MID);
														$OID = $Display->Display_Single_Info_Modified($sql_log,'OID',$Execute_log);
														
														$sql_oid = 'SELECT First_Name FROM users WHERE ID = ?';
														$Execute_oid = array($OID);
														$Creator_First_Name = $Display->Display_Single_Info_Modified($sql_oid,'First_Name',$Execute_oid);
														
														$Log_Creator[] = $Creator_First_Name;
														$MID_Array[] = $MID;
														$Sender_Name_Array[] = $rows->Sender_Name;
													}
											}
										else
											{
												$sql_offer = 'SELECT AID FROM '.$Table_Offers.' WHERE Status = ? AND Ads_Sub_Cat = ?';
												$Execute_Offers = array('1',$Sub_Cat_ID);
												$results_offers = $Display->Display_Info($sql_offer,$Execute_Offers);
												$AID_Array = array();
												foreach($results_offers as $rows_offers)
													{
														$AID_Array[] = $rows_offers->AID;
													}
												$sql = 'SELECT Sender_Name,Country FROM users WHERE ID = ? AND (Starts_Date <= ? AND End_Date >= ?)';
												$Execute_Array = array($MID,$Starts_Date,$End_Date);
												$results = $Display->Display_Info($sql,$Execute_Array);
												foreach($results as $rows)
													{
														
														if(in_array($MID,$AID_Array))
															{
																$sql_country = 'SELECT Name FROM '.$Table.' WHERE ID = ?';
																$Execute_Country = array($rows->Country);
																$Country_Name = $Display->Display_Single_Info_Modified($sql_country,'Name',$Execute_Country);
																$Country_Name_Array[] = $Country_Name;
																
																$sql_account = 'SELECT Amount FROM merchant_accounts WHERE MID = ? AND Status = ?';
																$Execute_Account = array($MID,'1');
																$Amount = $Display->Display_Single_Info_Modified($sql_account,'Amount',$Execute_Account);
																$Amount_Array[] = sprintf('%.2f',$Amount);
																
																$sql_log = 'SELECT OID FROM logs WHERE Table_Name = ? AND Action = ? AND RID = ?';
																$Execute_log = array('users','1',$MID);
																$OID = $Display->Display_Single_Info_Modified($sql_log,'OID',$Execute_log);
																
																$sql_oid = 'SELECT First_Name FROM users WHERE ID = ?';
																$Execute_oid = array($OID);
																$Creator_First_Name = $Display->Display_Single_Info_Modified($sql_oid,'First_Name',$Execute_oid);
																
																$Log_Creator[] = $Creator_First_Name;
																$MID_Array[] = $MID;
																$Sender_Name_Array[] = $rows->Sender_Name;
															}
													}
											}
										
										$this->registry->template->MID_Array = $MID_Array;
										$this->registry->template->Sender_Name_Array = $Sender_Name_Array;
										$this->registry->template->Country_Name_Array = $Country_Name_Array;
										$this->registry->template->Amount_Array = $Amount_Array;
										$this->registry->template->Log_Creator = $Log_Creator;
									}
								else
									{
										$MID_Array = array();
										$Sender_Name_Array = array();
										$Country_Name_Array = array();
										$Amount_Array = array();
										$Log_Creator = array();
										if($Sub_Cat_ID == '999')
											{
												$sql = 'SELECT ID,Sender_Name,Country FROM users WHERE Status = ? AND Level = ? AND (Starts_Date <= ? AND End_Date >= ?)';
												$Execute_Array = array('1','2',$Starts_Date,$End_Date);
												$results = $Display->Display_Info($sql,$Execute_Array);
												foreach($results as $rows)
													{
														$sql_country = 'SELECT Name FROM '.$Table.' WHERE ID = ?';
														$Execute_Country = array($rows->Country);
														$Country_Name = $Display->Display_Single_Info_Modified($sql_country,'Name',$Execute_Country);
														$Country_Name_Array[] = $Country_Name;
														
														$sql_account = 'SELECT Amount FROM merchant_accounts WHERE MID = ? AND Status = ?';
														$Execute_Account = array($rows->ID,'1');
														$Amount = $Display->Display_Single_Info_Modified($sql_account,'Amount',$Execute_Account);
														$Amount_Array[] = sprintf('%.2f',$Amount);
														
														$sql_log = 'SELECT OID FROM logs WHERE Table_Name = ? AND Action = ? AND RID = ?';
														$Execute_log = array('users','1',$rows->ID);
														$OID = $Display->Display_Single_Info_Modified($sql_log,'OID',$Execute_log);
														
														$sql_oid = 'SELECT First_Name FROM users WHERE ID = ?';
														$Execute_oid = array($OID);
														$Creator_First_Name = $Display->Display_Single_Info_Modified($sql_oid,'First_Name',$Execute_oid);
														
														$Log_Creator[] = $Creator_First_Name;
														$MID_Array[] = $rows->ID;
														$Sender_Name_Array[] = $rows->Sender_Name;
													}
											}
										else
											{
												$sql_offer = 'SELECT AID FROM '.$Table_Offers.' WHERE Status = ? AND Ads_Sub_Cat = ?';
												$Execute_Offers = array('1',$Sub_Cat_ID);
												$results_offers = $Display->Display_Info($sql_offer,$Execute_Offers);
												$AID_Array = array();
												foreach($results_offers as $rows_offers)
													{
														$AID_Array[] = $rows_offers->AID;
													}
												$sql = 'SELECT ID,Sender_Name,Country FROM users WHERE Status = ? AND Level = ? AND (Starts_Date <= ? AND End_Date >= ?)';
												$Execute_Array = array('1','2',$Starts_Date,$End_Date);
												$results = $Display->Display_Info($sql,$Execute_Array);
												foreach($results as $rows)
													{
														
														if(in_array($rows->ID,$AID_Array))
															{
																$sql_country = 'SELECT Name FROM '.$Table.' WHERE ID = ?';
																$Execute_Country = array($rows->Country);
																$Country_Name = $Display->Display_Single_Info_Modified($sql_country,'Name',$Execute_Country);
																$Country_Name_Array[] = $Country_Name;
																
																$sql_account = 'SELECT Amount FROM merchant_accounts WHERE MID = ? AND Status = ?';
																$Execute_Account = array($rows->ID,'1');
																$Amount = $Display->Display_Single_Info_Modified($sql_account,'Amount',$Execute_Account);
																$Amount_Array[] = sprintf('%.2f',$Amount);
																
																$sql_log = 'SELECT OID FROM logs WHERE Table_Name = ? AND Action = ? AND RID = ?';
																$Execute_log = array('users','1',$rows->ID);
																$OID = $Display->Display_Single_Info_Modified($sql_log,'OID',$Execute_log);
																
																$sql_oid = 'SELECT First_Name FROM users WHERE ID = ?';
																$Execute_oid = array($OID);
																$Creator_First_Name = $Display->Display_Single_Info_Modified($sql_oid,'First_Name',$Execute_oid);
																
																$Log_Creator[] = $Creator_First_Name;
																$MID_Array[] = $rows->ID;
																$Sender_Name_Array[] = $rows->Sender_Name;
															}
													}
											}
										
										$this->registry->template->MID_Array = $MID_Array;
										$this->registry->template->Sender_Name_Array = $Sender_Name_Array;
										$this->registry->template->Country_Name_Array = $Country_Name_Array;
										$this->registry->template->Amount_Array = $Amount_Array;
										$this->registry->template->Log_Creator = $Log_Creator;
									}
								
							}
						if(count($MID_Array))
							{
								$this->registry->template->show('adminreports/display_sales_report');
							}
						else
							{
								$this->registry->template->show('admin_search/no_results');
							}
					}
			}
}

?>
