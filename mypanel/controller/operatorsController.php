 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
$Allowed_Users = array('4');
validate_roles_new::validate($Allowed_Users);
class operatorsController extends baseController {
			
		public function index() 
			{
				
			}
		public function submit_offer_search_results()
			{
				$Display = new sql();
				$Today = date('d-m-Y');
				$Status = $_POST['Status'];
				$Country_ID = $_POST['Country_ID'];
				$Merchants_ID = $_POST['Merchants_ID'];
				$City_ID = $_POST['City_ID'];
				$Category_ID = $_POST['Category_ID'];
				$Services_ID = $_POST['Services_ID'];
				$Creation_Start_Date = $_POST['Creation_Start_Date'];
				$Creation_End_Date = $_POST['Creation_End_Date'];
				$Start_Date = $_POST['Start_Date'];
				$End_Date = $_POST['End_Date'];
				
				$this->registry->template->Status = $Status;
				$this->registry->template->Country_ID = $Country_ID;
				$this->registry->template->Merchants_ID = $Merchants_ID;
				$this->registry->template->City_ID = $City_ID;
				$this->registry->template->Category_ID = $Category_ID;
				$this->registry->template->Services_ID = $Services_ID;
				$this->registry->template->Creation_Start_Date = $Creation_Start_Date;
				$this->registry->template->Creation_End_Date = $Creation_End_Date;
				$this->registry->template->Start_Date = $Start_Date;
				$this->registry->template->End_Date = $End_Date;
				
				$MyOID = array();
				$MyOID_2 = array();
				$MyOID_3 = array();
				$MyOID_4 = array();
				
				if(isset($_SESSION['Arabic']))
					{
						$Table_Offers = 'offers';
						$Table_City_Offers = 'city_offers';
						$Table_Services = 'merchant_services';
						$Table_Country = 'country';
					}
				else
					{
						$Table_Offers = 'offers_english';
						$Table_City_Offers = 'city_offers_english';
						$Table_Services = 'merchant_services_english';
						$Table_Country = 'country_english';
					}
					
				//Select offer ID based on dropdown menu selection :
				if($Merchants_ID == '999')
					{
						$sql = 'SELECT ID FROM '.$Table_Offers.' WHERE AID != ? AND Status != ?';
						$Execute_Array = array('ABC','0');
					}
				else
					{
						$sql = 'SELECT ID FROM '.$Table_Offers.' WHERE AID = ?';
						$Execute_Array = array($Merchants_ID);
					}
				$results = $Display->Display_Info($sql,$Execute_Array);
				foreach($results as $rows)
					{
						$MyOID[] = $rows->ID; // Offer IDs
					}
				//Filter offer ID based on citt selection:
				foreach($MyOID as $Value)
					{
						if($City_ID != '999')
							{
								$sql = 'SELECT OID FROM '.$Table_City_Offers.' WHERE CID = ?';
								$Execute_Array = array($City_ID);
								$results = $Display->Display_Info($sql,$Execute_Array);
								foreach($results as $rows)
									{
										if($rows->OID == $Value)
											{
												$MyOID_2[] = $rows->OID;
											}
									}
							}
						else
							{
								$MyOID_2[] = $Value;
							}
					}
				//Select merchant ID based on the filtered offer IDs
				foreach($MyOID_2 as $Value)
					{
						$sql = 'SELECT AID FROM '.$Table_Offers.' WHERE ID = ? AND Status != ?';
						$Execute_Array = array($Value,'0');
						$results = $Display->Display_Info($sql,$Execute_Array);
						foreach($results as $rows)
							{
								$MyOID_3[] = $rows->AID; //Merchant IDs filtered
							}
					}
				//Search to match merchant ID with category ID:
				foreach($MyOID_3 as $Value)
					{
						if($Category_ID == '999')
							{
								$MyOID_4[] = $Value;
								
							}
						else
							{
								$sql = 'SELECT ID FROM users WHERE Ads_Cat = ? AND Status = ?';
								$Execute_Array = array($Category_ID,'1');
								$results = $Display->Display_Info($sql,$Execute_Array);
								foreach($results as $rows)
									{
										if($Value == $rows->ID)
											{
												$MyOID_4[] = $rows->ID;
											}
									}
							}
					}
				//Search to match merchant ID with sub category ID:
				$MyOID_5 = array();
				foreach($MyOID_4 as $Value)
					{
						if($Services_ID == '999')
							{
								$sql = 'SELECT ID FROM '.$Table_Offers.' WHERE AID = ?';
								$Execute_Array = array($Value);
								$results = $Display->Display_Info($sql,$Execute_Array);
								foreach($results as $rows)
									{
										$MyOID_5[] = $rows->ID; //Offer ID filtered
									}
							}
						else
							{
								$sql = 'SELECT ID FROM '.$Table_Offers.' WHERE Ads_Sub_Cat = ? AND AID = ?';
								$Execute_Array = array($Services_ID,$Value);
								$results = $Display->Display_Info($sql,$Execute_Array);
								foreach($results as $rows)
									{
										$MyOID_5[] = $rows->ID; //Offer ID filtered
									}
							}
					}
					
				//Search to match merchant message type:
				$MyOID_6 = array();
				foreach($MyOID_5 as $Value)
					{
						if($Status == '10')
							{
								$Status = '0';
							}
						if($Status == '999')
							{
								$MyOID_6[] = $Value; //Offer IDs filtered
							}
						else
							{
								$sql = 'SELECT ID FROM '.$Table_Offers.' WHERE Status = ?';
								$Execute_Array = array($Status);
								$results = $Display->Display_Info($sql,$Execute_Array);
								foreach($results as $rows)
									{
										if($rows->ID == $Value)
											{
												$MyOID_6[] = $rows->ID; //Offer IDs filtered
											}
									}
							}
					}
				$Offers_ID_Array = array();
				$MyOID_7 = array();
				
				$MyOID_8 = array();
				$MyOID_9 = array();
				$MyOID_10 = array();
				$MyOID_11 = array();
				foreach($MyOID_6 as $Value)
					{
						if(!in_array($Value,$Offers_ID_Array))
							{
								$MyOID_7[] = $Value;
							}
						
					}
				if(($Creation_Start_Date != NULL) && ($Creation_End_Date != NULL))
					{
						$Creation_Start_Date = date('Y-m-d',strtotime($Creation_Start_Date));
						$Creation_End_Date = date('Y-m-d',strtotime($Creation_End_Date));
						foreach($MyOID_7 as $Value)
							{
								$sql = 'SELECT RID FROM logs WHERE Time_Stamp BETWEEN ? AND ? AND Action = ?';
								$Execute_Array = array($Creation_Start_Date,$Creation_End_Date,'1');
								$results = $Display->Display_Info($sql,$Execute_Array);
								foreach($results as $rows)
									{
										if($rows->RID == $Value)
											{
												$MyOID_8[] = $rows->RID; //Offer IDs filtered
											}
									}
							}
					}
				if($Start_Date != NULL)
					{
						$Start_Date = date('Y-m-d',strtotime($Start_Date));
						foreach($MyOID_7 as $Value)
							{
								$sql = 'SELECT ID FROM '.$Table_Offers.' WHERE Start_Date = ?';
								$Execute_Array = array($Start_Date);
								$results = $Display->Display_Info($sql,$Execute_Array);
								foreach($results as $rows)
									{
										if($rows->ID == $Value)
											{
												$MyOID_9[] = $rows->ID; //Offer IDs filtered
											}
									}
							}
					}
				if($End_Date != NULL)
					{
						$End_Date = date('Y-m-d',strtotime($End_Date));
						foreach($MyOID_7 as $Value)
							{
								$sql = 'SELECT ID FROM '.$Table_Offers.' WHERE End_Date = ?';
								$Execute_Array = array($End_Date);
								$results = $Display->Display_Info($sql,$Execute_Array);
								foreach($results as $rows)
									{
										if($rows->ID == $Value)
											{
												$MyOID_10[] = $rows->ID; //Offer IDs filtered
											}
									}
							}
					}
				if(($Creation_Start_Date == NULL) && ($Creation_End_Date == NULL) && ($Start_Date == NULL) && ($End_Date == NULL))
					{
						foreach($MyOID_7 as $Value)
							{
								if(!in_array($Value,$Offers_ID_Array))
									{
										$Offers_ID_Array[] = $Value;
									}
							}
					}
				else
					{
						$MyOID_11 = array_merge($MyOID_8,$MyOID_9,$MyOID_10);//array_intersect($MyOID_8,$MyOID_9);
						foreach($MyOID_11 as $Value)
							{
								if(!in_array($Value,$Offers_ID_Array))
									{
										$Offers_ID_Array[] = $Value;
									}
							}
						//$Offers_ID_Array = array_unique($MyOID_10);
					}
				if(count($Offers_ID_Array))
					{
						$Company_Name_Array = array();
						$Country_Name_Array = array();
						$Start_Date_Array = array();
						$End_Date_Array = array();
						$Status_Array = array();
						$Sender_Name_Array = array();
						$Test_Array = array();
						
						$pagenum  = @$_POST['Page'];
						$paginate = new paginate_array($Offers_ID_Array,'10',$pagenum);
						$Count = $paginate->Records();
						$this->registry->template->Page = $pagenum;
						$this->registry->template->Count = $Count;
						$this->registry->template->Last = $paginate->Calculate_Last($Count);
						$Final_OID = $paginate->Paginate();
						$AID_Array = array();
						
						foreach($Final_OID as $value)
							{
								
								$sql = 'SELECT AID,Start_Date,End_Date,Status FROM '.$Table_Offers.' WHERE ID = ?';
								$Execute_Array = array($value);
								$results = $Display->Display_Info($sql,$Execute_Array);
								foreach($results as $rows)
									{
										$AID = $rows->AID;
										$AID_Array[] = $AID;
										$Test_Array[] = $AID;
										$sql_sender = 'SELECT Sender_Name,Country FROM users WHERE ID = ?';
										$Execute_Array = array($AID);
										$results_sender = $Display->Display_Info($sql_sender,$Execute_Array);
										foreach($results_sender as $rows_sender)
											{
												$Sender_Name_Array[] = $rows_sender->Sender_Name;
												$sql_country = 'SELECT Name FROM '.$Table_Country.' WHERE ID = ?';
												$Execute_Array = array($rows_sender->Country);
												$Country_Name_Array[] = $Display->Display_Single_Info_Modified($sql_country,'Name',$Execute_Array);
											}
										$Start_Date_Array[] = date('d-m-Y',strtotime($rows->Start_Date));
										$End_Date_Array[] = date('d-m-Y',strtotime($rows->End_Date));
										switch($rows->Status)
											{
												case '0':
												$Status_Array[] = 'مـمـسـوح';
												break;
												
												case '1':
												$Status_Array[] = 'مـنـشــور';
												break;
												
												case '2':
												$Status_Array[] = 'قـيـد الإنـجــاز';
												break;
												
												case '3':
												$Status_Array[] = 'مـنـتـهــي';
												break;
												
												case '4':
												$Status_Array[] = 'مـسـودة';
												break;
												
												case '5':
												$Status_Array[] = 'مـرجــع';
												break;
											}
									}
								
							}
						
						$this->registry->template->Final_OID = $Final_OID;
						$this->registry->template->AID_Array = $AID_Array;
						$this->registry->template->Country_Name_Array = $Country_Name_Array;
						$this->registry->template->Start_Date_Array = $Start_Date_Array;
						$this->registry->template->End_Date_Array = $End_Date_Array;
						$this->registry->template->Status_Array = $Status_Array;
						$this->registry->template->Sender_Name_Array = $Sender_Name_Array;
						$this->registry->template->show('operators/submit_offer_search_results');
						
					}
				else
					{
						$this->registry->template->show('admin_search/no_results');
					}
			}
		public function pending_offer()
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
				$Country_Name = array();
				$Country_ID = array();
				$sql = 'SELECT ID,Name FROM '.$Table.' WHERE Status = ? ORDER BY BINARY Name';
				$Execute_Array = array('1');
				$results = $Display->Display_Info($sql,$Execute_Array);
				foreach($results as $rows)
					{
						$Country_ID[] = $rows->ID;
						$Country_Name[] = $rows->Name;
					}
				$this->registry->template->Country_ID = $Country_ID;
				$this->registry->template->Country_Name = $Country_Name;
				$this->registry->template->show('operators/pending_offer');
			}
		public function show_pending_offers()
			{
				$Display = new sql();
				$Country = $_POST['Country'];
				$this->registry->template->Country_ID = $Country;
				if(isset($_SESSION['Arabic']))
					{
						$Table = 'offers';
						$Table_Country = 'country';
					}
				else
					{
						$Table = 'offers_english';
						$Table_Country = 'country_english';
					}
				$Users_ID = array();
				if($Country == '999')
					{
						$sql = 'SELECT ID FROM users WHERE Status = ? AND Level = ?';
						$Execute_Array = array('1','2');
						$results = $Display->Display_Info($sql,$Execute_Array);
						foreach($results as $rows)
							{
								$Users_ID[] = $rows->ID;
							}
					}
				else
					{
						$sql = 'SELECT ID FROM users WHERE Status = ? AND Level = ? AND Country = ?';
						$Execute_Array = array('1','2',$Country);
						$results = $Display->Display_Info($sql,$Execute_Array);
						foreach($results as $rows)
							{
								$Users_ID[] = $rows->ID;
							}
					}
				
				$AID_Array = array();
				$sql = 'SELECT AID FROM '.$Table.' WHERE Status = ?';
				$Execute_Array = array('2');
				$results = $Display->Display_Info($sql,$Execute_Array);
				foreach($results as $rows)
					{
						if(in_array($rows->AID,$Users_ID))
							{
								$AID_Array[] = $rows->AID;
							}
					}
				if(count($AID_Array))
					{
						$sql = 'SELECT * FROM '.$Table.' WHERE ( ';
						$Counter = 1;
						$Execute_String = '';
						foreach($AID_Array as $value)
							{
								if($Counter == count($AID_Array))
									{
										$sql .= ' AID = ? ';
										$Execute_String .= $value;
									}
								else
									{
										$sql .= ' AID = ? OR ';
										$Execute_String .= $value.',';
									}
								$Counter++;
							}
						$sql .= ' ) AND Status = ?';
						$Execute_Array = array();
						$Execute_String_Array = explode(',',$Execute_String);
						$Counter = 1;
						foreach($Execute_String_Array as $value)
							{
								if($value != NULL)
									{
										$Execute_Array[] = $value;
									}
								$Counter++;
							}
						$Execute_Array[] = '2';
						$pagenum  = @$_POST['Page'];
						$paginate = new paginate($Table,'20',$pagenum,$sql,$Execute_Array);
						$Count = $paginate->Records($Table);
						$this->registry->template->Page = $pagenum;
						$this->registry->template->Count = $Count;
						$this->registry->template->Last = $paginate->Calculate_Last($Count);
						$results = $paginate->Paginate();
						$Offer_ID_Array = array();
						$Details_Array = array();
						$First_Name_Array = array();
						$Creation_Date_Array = array();
						$Country_Array = array();
						$Start_Date_Array = array();
						
						foreach($results as $rows)
							{
								$Offer_ID_Array[] = $rows->ID;
								
								$sql_users = 'SELECT First_Name,Country FROM users WHERE ID = ?';
								$Execute_Array = array($rows->AID);
								$result_users = $Display->Display_Info($sql_users,$Execute_Array);
								foreach($result_users as $rows_users)
									{
										$First_Name_Array[] = $rows_users->First_Name;
										$sql_country = 'SELECT Name FROM '.$Table_Country.' WHERE ID = ?';
										$Execute_Array = array($rows_users->Country);
										$Country_Array[] = $Display->Display_Single_Info_Modified($sql_country,'Name',$Execute_Array);
									}
								
								$Details_Array[] = trim(strip_tags(str_replace('&quot','&#39',$rows->Offer_Content)));
								$Start_Date_Array[] = date('d-m-Y',strtotime($rows->Start_Date));
								$sql_logs = 'SELECT Time_Stamp FROM logs WHERE RID = ? AND Action = ? AND Table_Name = ?';
								$Execute_Array = array($rows->ID,'1',$Table);
								$Creation_Date = $Display->Display_Single_Info_Modified($sql_logs,'Time_Stamp',$Execute_Array);
								$Creation_Date = date('d-m-Y',strtotime($Creation_Date));
								$Creation_Date_Array[] = $Creation_Date;
							}
						$this->registry->template->Offer_ID_Array = $Offer_ID_Array;
						$this->registry->template->Details_Array = $Details_Array;
						$this->registry->template->First_Name_Array = $First_Name_Array;
						$this->registry->template->Creation_Date_Array = $Creation_Date_Array;
						$this->registry->template->Country_Array = $Country_Array;
						$this->registry->template->Start_Date_Array = $Start_Date_Array;
						$this->registry->template->show('operators/show_pending_offers');
					}
				else
					{
						$this->registry->template->show('admin_search/no_results');
					}
			}
		public function edit_selected_offer_from_pending()
			{
				$Display = new sql();
				$URL = new url();
				$OID = $_SESSION['User_ID'];
				$ID = $URL->getPar('Member');
				
				$this->registry->template->ID = $ID;
				if(isset($_SESSION['Arabic']))
					{
						$Table = 'offers';
						$Table_Cat = 'ads_sub_cat';
						$Table_City = 'city';
						$Table_Merchant_Services = 'merchant_services';
						$Table_City_Relation = 'city_offers';
					}
				else
					{
						$Table = 'offers_english';
						$Table_Cat = 'ads_sub_cat_english';
						$Table_City = 'city_english';
						$Table_Merchant_Services = 'merchant_services_english';
						$Table_City_Relation = 'city_offers_english';
					}
				$sql = 'SELECT AID FROM '.$Table.' WHERE ID = ?';
				$Execute_Array = array($ID);
				$AID = $Display->Display_Single_Info_Modified($sql,'AID',$Execute_Array);
				$this->registry->template->AID = $AID;
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
				$City_Array = array();
				$sql = 'SELECT CID FROM '.$Table_City_Relation.' WHERE OID = ?';
				$Execute_Array = array($ID);
				$results = $Display->Display_Info($sql,$Execute_Array);
				foreach($results as $rows)
					{
						$City_Array[] = $rows->CID;
					}
				$this->registry->template->City_Array = $City_Array;
				$sql = 'SELECT ID,Ads_Sub_Cat,Offer_Title,Offer_Content,Start_Date,End_Date FROM '.$Table.' WHERE ID = ?';
				$Execute_Array = array($ID);
				$this->registry->template->results = $Display->Display_Info($sql,$Execute_Array);
				$this->registry->template->show('operators/edit_selected_offer_from_pending');
			}
		public function submit_returned_email()
			{
				$Display = new sql();
				$Comments = strip_tags($_POST['MSGComments']);
				$Time_Stamp = $_POST['Time_Stamp'];
				$Offer_ID = $_POST['Offer_ID'];
				if(isset($_SESSION['Arabic']))
					{
						$Table = 'offers';
					}
				else
					{
						$Table = 'offers_english';
					}
					
				if($Comments == NULL)
					{
						$myTweets = array("flag" => '1');
						$Display->Write_JSON($Time_Stamp,$myTweets);
					}
				else
					{
						$myTweets = array("flag" => '0');
						$Display->Write_JSON($Time_Stamp,$myTweets);
						$sql = 'SELECT First_Name FROM users WHERE ID = ?';
						$Execute_Array = array($AID);
						$First_Name = $Display->Display_Single_Info_Modified($sql,'First_Name',$Execute_Array);
						
						$sql = 'SELECT Contact_Email FROM users WHERE ID = ?';
						$Execute_Array = array($AID);
						$Recipient = $Display->Display_Single_Info_Modified($sql,'Contact_Email',$Execute_Array);
						
						$sql = 'UPDATE '.$Table.' SET Status = ? WHERE ID = ?';
						$Execute_Array = array('5',$Offer_ID);
						$Display->Execute($sql,$Execute_Array);
						?>
						
						<div dir="rtl"><span>عـزيـزي / عـزيـزتـي </span>&nbsp;<span></span></div>
						<?php
						$body = '<div dir="rtl"><span>عـزيـزي / عـزيـزتـي </span>&nbsp;<span>'.$First_Name.'</span></div>';
						$body .= '<div>لــقــد تـم إرجــاع رســالـتـك الأخـيــرة للأسـبــاب الـتـالـيــة</div>';
						$body .= '<div>'.$Comments.'</div>';
						$body .= '<div>الـرجــاء الـدخــول إلـى حـســابــك مـع وفــر و تـعـديـل الرســالــة ثـم إعــادة إرســالــهــا</div>';
						$body .= '<div>&nbsp;</div>';
						$body .= '<div>مــع جـزيــل الـشـكـر</div>';
						$body .= '<div>فـريـق وفــر</div>';
						$body .= '<div><a href="http://www.wafferapp.com" target="_blank">www.wafferapp.com</a></div>';
						
						$my_mail = new my_mail();
						$my_mail->Send_SMTP($body,'mail.wafferapp.com','jor@wafferapp.com','softilejor','jor@wafferapp.com','Waffer Team','رســالــة مـرجــعــة',$Recipient,$First_Name);
						$my_mail->Send_SMTP($body,'mail.wafferapp.com','jor@wafferapp.com','softilejor','jor@wafferapp.com','Waffer Team','رســالــة مـرجــعــة','msgs@wafferapp.com','Waffer Team');
						
					}
			}
		public function submit_edit_offer_save()
			{
				$Display = new sql();
				$validate = new validate_new();
				if(isset($_SESSION['Arabic']))
					{
						$Table = 'offers';
						$Table_City = 'city_offers';
					}
				else
					{
						$Table = 'offers_english';
						$Table_City = 'city_offers_english';
					}
				$OID = $_SESSION['User_ID'];
				$ID = $_POST['ID'];
				$Offer_Title = trim(strip_tags(str_replace('"','\'',$_POST['Offer_Title'])));
				$Offer_Content =  trim(str_replace('"','\'',$_POST['Offer_Content']));
				$City_String = trim($_POST['SID_Values']);
				$Time_Stamp = $_POST['Time_Stamp'];
				$Start_Date = $_POST['Start_Date'];
				$End_Date = $_POST['End_Date'];
				$Ads_Sub_Cat = $_POST['Ads_Sub_Cat'];
				$Starts_Date_String = strtotime($Start_Date);
				$End_Date_String = strtotime($End_Date);
				$Offer_Content_Stripped = $Offer_Content;
				$Offer_Content_Stripped_Length = strlen($Offer_Content_Stripped);
				$Item_Exists_Modified_JSON = $validate->Item_Exists_Edit_Modified_JSON_Edit('offers','Offer_Title',$ID,$Offer_Title,$OID);
				$Start_Date_Formatted = strtotime($Start_Date);
				$End_Date_Formatted = strtotime($End_Date);
				
				$sql = 'SELECT AID FROM '.$Table.' WHERE ID = ?';
				$Execute_Array = array($ID);
				$AID = $Display->Display_Single_Info_Modified($sql,'AID',$Execute_Array);
				
				$sql = 'SELECT Starts_Date,End_Date FROM users WHERE ID = ?';
				$Execute_Array = array($AID);
				$results = $Display->Display_Info($sql,$Execute_Array);
				$Invalid_Date = false;
				foreach($results as $rows)
					{
						$Starts_Date_Membership = strtotime($rows->Starts_Date);
						$End_Date_Membership = strtotime($rows->End_Date);
						if(($Starts_Date_Membership > $Start_Date_Formatted) || ($End_Date_Membership < $Start_Date_Formatted ) || ($Starts_Date_Membership > $End_Date_Formatted) || ($End_Date_Membership < $End_Date_Formatted ))
							{
								$Invalid_Date = true;
							}
					}
				$City_Array = explode(',',$City_String);
				$City = array();
				foreach($City_Array as $value)
					{
						if($value != NULL)
							{
								$City[] = $value;
							}
					}
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
				elseif(!$Ads_Sub_Cat)
					{
						$myTweets = array("flag" => '6');
						$Display->Write_JSON($Time_Stamp,$myTweets);
					}
				elseif(!count($City))
					{
						$myTweets = array("flag" => '7');
						$Display->Write_JSON($Time_Stamp,$myTweets);
					}
				elseif($Invalid_Date)
					{
						$myTweets = array("flag" => '8');
						$Display->Write_JSON($Time_Stamp,$myTweets);
					}
				else
					{
						$myTweets = array("flag" => '0');
						$Display->Write_JSON($Time_Stamp,$myTweets);
						$Start_Date = date('Y-m-d',strtotime($Start_Date));
						$End_Date = date('Y-m-d',strtotime($End_Date));
						//$Offer_Content = htmlentities($Offer_Content,ENT_QUOTES,'UTF-8');
						//$Offer_Content_Stripped = trim(str_replace('&quot','&#39',$Offer_Content_Stripped));
						$sql = 'UPDATE '.$Table.' SET Ads_Sub_Cat=?,Offer_Title = ?,Offer_Content = ?,Start_Date = ?,End_Date = ?,Status = ? WHERE ID = ?';
						$Execute_Array = array($Ads_Sub_Cat,$Offer_Title,$Offer_Content_Stripped,$Start_Date,$End_Date,'1',$ID);
						$Display->Execute($sql,$Execute_Array);
						$Action_Time = date('Y-m-d G:i:s');
						$Display->create_log($ID,$Table,'2',$Action_Time,$OID,'Edited a voucher');
						$sql = 'DELETE FROM '.$Table_City.' WHERE OID = ?';
						$Execute_Array = array($ID);
						$Display->Execute($sql,$Execute_Array);
						foreach($City as $value)
							{
								$sql = 'INSERT INTO '.$Table_City.' (OID,CID) VALUES (?,?)';
								$Execute_Array = array($ID,$value);
								$RID2 = $Display->Execute($sql,$Execute_Array,'1',$Table_City);
								$Action_Time = date('Y-m-d G:i:s');
								$Display->create_log($RID2,$Table_City,'1',$Action_Time,$OID,'added new city-offer relationship');
							}
					}
			}
		public function submit_edit_offer_draft()
			{
				$Display = new sql();
				$validate = new validate_new();
				if(isset($_SESSION['Arabic']))
					{
						$Table = 'offers';
						$Table_City = 'city_offers';
					}
				else
					{
						$Table = 'offers_english';
						$Table_City = 'city_offers_english';
					}
				$OID = $_SESSION['User_ID'];
				$ID = $_POST['ID'];
				$Offer_Title = trim(strip_tags(str_replace('"','\'',$_POST['Offer_Title'])));
				$Offer_Content =  trim(str_replace('"','\'',$_POST['Offer_Content']));
				$City_String = trim($_POST['SID_Values']);
				$Time_Stamp = $_POST['Time_Stamp'];
				$Start_Date = $_POST['Start_Date'];
				$End_Date = $_POST['End_Date'];
				$Ads_Sub_Cat = $_POST['Ads_Sub_Cat'];
				$Starts_Date_String = strtotime($Start_Date);
				$End_Date_String = strtotime($End_Date);
				$Offer_Content_Stripped = $Offer_Content;
				$Offer_Content_Stripped_Length = strlen($Offer_Content_Stripped);
				$Item_Exists_Modified_JSON = $validate->Item_Exists_Edit_Modified_JSON_Edit('offers','Offer_Title',$ID,$Offer_Title,$OID);
				$Start_Date_Formatted = strtotime($Start_Date);
				$End_Date_Formatted = strtotime($End_Date);
				
				$sql = 'SELECT AID FROM '.$Table.' WHERE ID = ?';
				$Execute_Array = array($ID);
				$AID = $Display->Display_Single_Info_Modified($sql,'AID',$Execute_Array);
				
				$sql = 'SELECT Starts_Date,End_Date FROM users WHERE ID = ?';
				$Execute_Array = array($AID);
				$results = $Display->Display_Info($sql,$Execute_Array);
				$Invalid_Date = false;
				foreach($results as $rows)
					{
						$Starts_Date_Membership = strtotime($rows->Starts_Date);
						$End_Date_Membership = strtotime($rows->End_Date);
						if(($Starts_Date_Membership > $Start_Date_Formatted) || ($End_Date_Membership < $Start_Date_Formatted ) || ($Starts_Date_Membership > $End_Date_Formatted) || ($End_Date_Membership < $End_Date_Formatted ))
							{
								$Invalid_Date = true;
							}
					}
				$City_Array = explode(',',$City_String);
				$City = array();
				foreach($City_Array as $value)
					{
						if($value != NULL)
							{
								$City[] = $value;
							}
					}
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
				elseif(!$Ads_Sub_Cat)
					{
						$myTweets = array("flag" => '6');
						$Display->Write_JSON($Time_Stamp,$myTweets);
					}
				elseif(!count($City))
					{
						$myTweets = array("flag" => '7');
						$Display->Write_JSON($Time_Stamp,$myTweets);
					}
				elseif($Invalid_Date)
					{
						$myTweets = array("flag" => '8');
						$Display->Write_JSON($Time_Stamp,$myTweets);
					}
				else
					{
						$myTweets = array("flag" => '0');
						$Display->Write_JSON($Time_Stamp,$myTweets);
						$Start_Date = date('Y-m-d',strtotime($Start_Date));
						$End_Date = date('Y-m-d',strtotime($End_Date));
						//$Offer_Content = htmlentities($Offer_Content,ENT_QUOTES,'UTF-8');
						//$Offer_Content_Stripped = trim(str_replace('&quot','&#39',$Offer_Content_Stripped));
						$sql = 'UPDATE '.$Table.' SET Ads_Sub_Cat=?,Offer_Title = ?,Offer_Content = ?,Start_Date = ?,End_Date = ?,Status = ? WHERE ID = ?';
						$Execute_Array = array($Ads_Sub_Cat,$Offer_Title,$Offer_Content_Stripped,$Start_Date,$End_Date,'4',$ID);
						$Display->Execute($sql,$Execute_Array);
						$Action_Time = date('Y-m-d G:i:s');
						$Display->create_log($ID,$Table,'2',$Action_Time,$OID,'Edited a voucher');
						$sql = 'DELETE FROM '.$Table_City.' WHERE OID = ?';
						$Execute_Array = array($ID);
						$Display->Execute($sql,$Execute_Array);
						foreach($City as $value)
							{
								$sql = 'INSERT INTO '.$Table_City.' (OID,CID) VALUES (?,?)';
								$Execute_Array = array($ID,$value);
								$RID2 = $Display->Execute($sql,$Execute_Array,'1',$Table_City);
								$Action_Time = date('Y-m-d G:i:s');
								$Display->create_log($RID2,$Table_City,'1',$Action_Time,$OID,'added new city-offer relationship');
							}
					}
			}
		public function search_my_offer()
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
				$Country_IDs = array();
				$Country_Names = array();
				$sql = 'SELECT ID,Name FROM '.$Table.' WHERE Status = ?';
				$Execute_Array = array('1');
				$results = $Display->Display_Info($sql,$Execute_Array);
				foreach($results as $rows)
					{
						$Country_IDs[] = $rows->ID;
						$Country_Names[] = $rows->Name;
					}
					
				$this->registry->template->Country_IDs = $Country_IDs;
				$this->registry->template->Country_Names = $Country_Names;
				$this->registry->template->show('operators/search_my_offer');
			}
		public function submit_country_name()
			{
				$Display = new sql();
				$CID = $_POST['CID'];
				if($CID == '999')
					{
						$sql = 'SELECT ID,Sender_Name FROM users WHERE Level = ? AND Status = ?';
						$Execute_Array = array('2','1');
					}
				else
					{
						$sql = 'SELECT ID,Sender_Name FROM users WHERE Level = ? AND Status = ? AND Country = ?';
						$Execute_Array = array('2','1',$CID);
					}
				$Merchant_IDs = array();
				$Merchant_User_Name = array();
				
				$results = $Display->Display_Info($sql,$Execute_Array);
				foreach($results as $rows)
					{
						$Merchant_IDs[] = $rows->ID;
						$Merchant_User_Name[] = $rows->Sender_Name;
					}
				$this->registry->template->Merchant_IDs = $Merchant_IDs;
				$this->registry->template->Merchant_User_Name = $Merchant_User_Name;
				$this->registry->template->show('operators/submit_country_name');
			}
		public function submit_city_name()
			{
				$Display = new sql();
				$MID = $_POST['MID'];
				$CID = $_POST['CID'];
				$City_IDs = array();
				$City_Names = array();
				
				if(isset($_SESSION['Arabic']))
					{
						$Table = 'city';
						$Table_City_Offer = 'city_offers';
						$Table_Offers = 'offers';
						$Table_City = 'city';
					}
				else
					{
						$Table = 'city_english';
						$Table_City_Offer = 'city_offers_english';
						$Table_Offers = 'offers_english';
						$Table_City = 'city_english';
					}
				if($MID == '999')
					{
						if($CID == '999')
							{
								$sql = 'SELECT ID,City_Name FROM '.$Table_City.' WHERE Status = ?';
								$Execute_Array = array('1');
								$results = $Display->Display_Info($sql,$Execute_Array);
								foreach($results as $rows)
									{
										$City_IDs[] = $rows->ID;
										$City_Names[] = $rows->City_Name;
									}
							}
						else
							{
								$sql = 'SELECT ID,City_Name FROM '.$Table_City.' WHERE Status = ? AND CID = ?';
								$Execute_Array = array('1',$CID);
								$results = $Display->Display_Info($sql,$Execute_Array);
								foreach($results as $rows)
									{
										$City_IDs[] = $rows->ID;
										$City_Names[] = $rows->City_Name;
									}
							}
					}
				else
					{
						$Offer_ID_Array = array();
						$sql = 'SELECT ID FROM '.$Table_Offers.' WHERE AID = ?';
						$Execute_Array = array($MID);
						$results = $Display->Display_Info($sql,$Execute_Array);
						foreach($results as $rows)
							{
								$Offer_ID_Array[] = $rows->ID;
							}
						foreach($Offer_ID_Array as $value)
							{
								$sql = 'SELECT DISTINCT (CID) AS CID FROM '.$Table_City_Offer.' WHERE OID = ?';
								$Execute_Array = array($value);
								$results = $Display->Display_Info($sql,$Execute_Array);
								foreach($results as $rows)
									{
										if(!in_array($rows->CID,$City_IDs))
											{
												$City_IDs[] = $rows->CID;
												$sql_city = 'SELECT City_Name FROM '.$Table_City.' WHERE ID = ?';
												$Execute_Array = array($rows->CID);
												$City_Name = $Display->Display_Single_Info_Modified($sql_city,'City_Name',$Execute_Array);
												$City_Names[] = $City_Name;
											}
									}
							}
					}
				$this->registry->template->City_IDs = $City_IDs;
				$this->registry->template->City_Names = $City_Names;
				$this->registry->template->show('operators/submit_city_name');
			}
		public function submit_category_name()
			{
				$Display = new sql();
				$City_ID = $_POST['City_ID'];
				$Merchant_ID = $_POST['Merchant_ID'];
				$Cat_IDs = array();
				$Cat_Names = array();
				
				if(isset($_SESSION['Arabic']))
					{
						$Table = 'ads_cat';
					}
				else
					{
						$Table = 'ads_cat_english';
					}
					
				if($Merchant_ID == '999')
					{
						$sql = 'SELECT ID,Cat_Name FROM '.$Table.' WHERE Status = ?';
						$Execute_Array = array('1');
						$results = $Display->Display_Info($sql,$Execute_Array);
						foreach($results as $rows)
							{
								$Cat_IDs[] = $rows->ID;
								$Cat_Names[] = $rows->Cat_Name;
							}
					}
				else
					{
						$sql = 'SELECT Ads_Cat FROM users WHERE ID = ?';
						$Execute_Array = array($Merchant_ID);
						$results = $Display->Display_Info($sql,$Execute_Array);
						foreach($results as $rows)
							{
								$sql_cat = 'SELECT Cat_Name FROM '.$Table.' WHERE ID = ?';
								$Execute_Array = array($rows->Ads_Cat);
								$Cat_Name = $Display->Display_Single_Info_Modified($sql_cat,'Cat_Name',$Execute_Array);
								$Cat_IDs[] = $rows->Ads_Cat;
								$Cat_Names[] = $Cat_Name;
							}
					}
				$this->registry->template->Cat_IDs = $Cat_IDs;
				$this->registry->template->Cat_Names = $Cat_Names;
				$this->registry->template->show('operators/submit_category_name');
			}
		public function submit_service_name()
			{
				$Display = new sql();
				$Cat_ID = $_POST['Cat_ID'];
				$Merchant_ID = $_POST['Merchant_ID'];
				
				$Sub_Cat_IDs = array();
				$Sub_Cat_Names = array();
				if(isset($_SESSION['Arabic']))
					{
						$Table = 'ads_sub_cat';
						$Table_Services = 'merchant_services';
					}
				else
					{
						$Table = 'ads_sub_cat_english';
						$Table_Services = 'merchant_services_english';
					}
				if($Merchant_ID == '999')
					{
						$sql = 'SELECT ID,Sub_Cat_Name FROM '.$Table.' WHERE Status = ?';
						$Execute_Array = array('1');
						$results = $Display->Display_Info($sql,$Execute_Array);
						foreach($results as $rows)
							{
								$Sub_Cat_IDs[] = $rows->ID;
								$Sub_Cat_Names[] = $rows->Sub_Cat_Name;
							}
					}
				else
					{
						$sql = 'SELECT SID FROM '.$Table_Services.' WHERE MID = ? AND Status = ?';
						$Execute_Array = array($Merchant_ID,'1');
						$results = $Display->Display_Info($sql,$Execute_Array);
						foreach($results as $rows)
							{
								$Sub_Cat_IDs[] = $rows->SID;
								$sql_sub_cat = 'SELECT Sub_Cat_Name FROM '.$Table.' WHERE ID = ?';
								$Execute_Array = array($rows->SID);
								$results = $Display->Display_Info($sql_sub_cat,$Execute_Array);
								$Sub_Cat_Name = $Display->Display_Single_Info_Modified($sql_sub_cat,'Sub_Cat_Name',$Execute_Array);
								$Sub_Cat_Names[] = $Sub_Cat_Name;
							}
					}
				$this->registry->template->Sub_Cat_IDs = $Sub_Cat_IDs;
				$this->registry->template->Sub_Cat_Names = $Sub_Cat_Names;
				$this->registry->template->show('operators/submit_service_name');
			}
		public function submit_status_name()
			{
				$Display = new sql();
				$Service_ID = $_POST['Service_ID'];
				$Merchant_ID = $_POST['Merchant_ID'];
				$this->registry->template->Merchant_ID = $Merchant_ID;
				$this->registry->template->show('operators/submit_status_name');
			}
		public function add_offer_step_two()
			{
				$Display = new sql();
				$ID = $_POST['ID'];
				if($ID == '999')
					{
						$sql = 'SELECT ID,Sender_Name FROM users WHERE Level = ? AND Status = ?';
						$Execute_Array = array('2','1');
					}
				else
					{
						$sql = 'SELECT ID,Sender_Name FROM users WHERE Level = ? AND Status = ? AND Country = ?';
						$Execute_Array = array('2','1',$ID);
					}
				
				$results = $Display->Display_Info($sql,$Execute_Array);
				$Merchant_ID_Array = array();
				$Merchant_Name_Array = array();
				
				foreach($results as $rows)
					{
						$Merchant_ID_Array[] = $rows->ID;
						$Merchant_Name_Array[] = $rows->Sender_Name;
					}
				$this->registry->template->Merchant_ID_Array = $Merchant_ID_Array;
				$this->registry->template->Merchant_Name_Array = $Merchant_Name_Array;
				$this->registry->template->show('operators/add_offer_step_two');
			}
		public function add_offer_step_one()
			{
				$Display = new sql();
				if(isset($_SESSION['Arabic']))
					{
						$Table = 'offers';
						$Table_Country = 'country';
					}
				else
					{
						$Table = 'offers_english';
						$Table_Country = 'country_english';
					}
				$sql = 'SELECT DISTINCT (Country) FROM users WHERE Level = ? AND Status = ?';
				$Execute_Array = array('2','1');
				$results = $Display->Display_Info($sql,$Execute_Array);
				$Country_ID_Array = array();
				$Country_Name_Array = array();
				
				foreach($results as $rows)
					{
						$Country_ID_Array[] = $rows->Country;
						$sql_country = 'SELECT Name FROM '.$Table_Country.' WHERE ID = ?';
						$Execute_Array = array($rows->Country);
						$Country_Name_Array[] = $Display->Display_Single_Info_Modified($sql_country,'Name',$Execute_Array);
					}
				$this->registry->template->Country_ID_Array = $Country_ID_Array;
				$this->registry->template->Country_Name_Array = $Country_Name_Array;
				$this->registry->template->show('operators/add_offer_step_one');
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
				$this->registry->template->show('operators/show_client_offers');
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
				$this->registry->template->show('operators/show_client_offers');
			}
		public function add_offer_par($ID)
			{
				$Display = new sql();
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
				$sql = 'SELECT SID FROM '.$Table_Merchant_Services.' WHERE MID = ? AND Status = ?';
				$Execute_Array = array($ID,'1');
				$results =  $Display->Display_Info($sql,$Execute_Array);
				$Merchant_Services = array();
				foreach($results as $rows)
					{
						$Merchant_Services[] = $rows->SID;
					}
				$this->registry->template->Merchant_Services = $Merchant_Services;
				$this->registry->template->show('operators/add_offer');
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
				$sql = 'SELECT SID FROM '.$Table_Merchant_Services.' WHERE MID = ? AND Status = ?';
				$Execute_Array = array($ID,'1');
				$results =  $Display->Display_Info($sql,$Execute_Array);
				$Merchant_Services = array();
				foreach($results as $rows)
					{
						$Merchant_Services[] = $rows->SID;
					}
				$this->registry->template->Merchant_Services = $Merchant_Services;
				$this->registry->template->show('operators/add_offer');
			}
	public function submit_new_offer_draft()
			{
				$Display = new sql();
				$validate = new validate_new();
				if(isset($_SESSION['Arabic']))
					{
						$Table = 'offers';
						$Table_City = 'city_offers';
					}
				else
					{
						$Table = 'offers_english';
						$Table_City = 'city_offers_english';
					}
				$AID = $_POST['ID'];
				$OID = $_SESSION['User_ID'];
				$Offer_Title = trim(strip_tags(str_replace('"','\'',$_POST['Offer_Title'])));
				$Offer_Content =  trim(str_replace('"','\'',$_POST['Offer_Content']));
				$Ads_Sub_Cat = $_POST['Ads_Sub_Cat'];
				$City_String =trim( $_POST['SID_Values']);
				$Time_Stamp = $_POST['Time_Stamp'];
				$Start_Date = $_POST['Start_Date'];
				$End_Date = $_POST['End_Date'];
				$Starts_Date_String = strtotime($Start_Date);
				$End_Date_String = strtotime($End_Date);
				$Offer_Content_Stripped = $Offer_Content;
				$Offer_Content_Stripped_Length = strlen($Offer_Content_Stripped);
				$Item_Exists_Modified_JSON = $validate->Item_Exists_Modified_JSON('offers','Offer_Title',$Offer_Title);
				$Start_Date_Formatted = strtotime($Start_Date);
				$End_Date_Formatted = strtotime($End_Date);
				$sql = 'SELECT Starts_Date,End_Date FROM users WHERE ID = ?';
				$Execute_Array = array($AID);
				$results = $Display->Display_Info($sql,$Execute_Array);
				$Invalid_Date = false;
				foreach($results as $rows)
					{
						$Starts_Date_Membership = strtotime($rows->Starts_Date);
						$End_Date_Membership = strtotime($rows->End_Date);
						if(($Starts_Date_Membership > $Start_Date_Formatted) || ($End_Date_Membership < $Start_Date_Formatted ) || ($Starts_Date_Membership > $End_Date_Formatted) || ($End_Date_Membership < $End_Date_Formatted ))
							{
								$Invalid_Date = true;
							}
					}
				$City_Array = explode(',',$City_String);
				$City = array();
				foreach($City_Array as $value)
					{
						if($value != NULL)
							{
								$City[] = $value;
							}
					}
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
				elseif(!count($City))
					{
						$myTweets = array("flag" => '7');
						$Display->Write_JSON($Time_Stamp,$myTweets);
					}
				elseif($Invalid_Date)
					{
						$myTweets = array("flag" => '8');
						$Display->Write_JSON($Time_Stamp,$myTweets);
					}
				else
					{
						$myTweets = array("flag" => '0');
						$Display->Write_JSON($Time_Stamp,$myTweets);
						$Start_Date = date('Y-m-d',strtotime($Start_Date));
						$End_Date = date('Y-m-d',strtotime($End_Date));
						
						//$Offer_Content_Stripped = trim(str_replace('&quot','&#39',$Offer_Content_Stripped));
						$sql = 'INSERT INTO '.$Table.' (AID,Ads_Sub_Cat,Offer_Title,Offer_Content,Start_Date,End_Date,Status) VALUES (?,?,?,?,?,?,?)';
						$Execute_Array = array($AID,$Ads_Sub_Cat,$Offer_Title,$Offer_Content_Stripped,$Start_Date,$End_Date,'4');
						$RID = $Display->Execute($sql,$Execute_Array,'1',$Table);
						$Action_Time = date('Y-m-d G:i:s');
						$Display->create_log($RID,$Table,'1',$Action_Time,$OID,'added new voucher');
						foreach($City as $value)
							{
								$sql = 'INSERT INTO '.$Table_City.' (OID,CID) VALUES (?,?)';
								$Execute_Array = array($RID,$value);
								$RID2 = $Display->Execute($sql,$Execute_Array,'1',$Table_City);
								$Action_Time = date('Y-m-d G:i:s');
								$Display->create_log($RID2,$Table_City,'1',$Action_Time,$OID,'added new city-offer relationship');
							}
						$this->add_offer_par($AID);
					}
			}
	public function submit_new_offer()
			{
				$Display = new sql();
				$validate = new validate_new();
				if(isset($_SESSION['Arabic']))
					{
						$Table = 'offers';
						$Table_City = 'city_offers';
					}
				else
					{
						$Table = 'offers_english';
						$Table_City = 'city_offers_english';
					}
				$AID = $_POST['ID'];
				$OID = $_SESSION['User_ID'];
				$Offer_Title = trim(strip_tags(str_replace('"','\'',$_POST['Offer_Title'])));
				$Offer_Content =  trim(str_replace('"','\'',$_POST['Offer_Content']));
				$Ads_Sub_Cat = $_POST['Ads_Sub_Cat'];
				$City_String =trim( $_POST['SID_Values']);
				$Time_Stamp = $_POST['Time_Stamp'];
				$Start_Date = $_POST['Start_Date'];
				$End_Date = $_POST['End_Date'];
				$Starts_Date_String = strtotime($Start_Date);
				$End_Date_String = strtotime($End_Date);
				$Offer_Content_Stripped = $Offer_Content;
				$Offer_Content_Stripped_Length = strlen($Offer_Content_Stripped);
				$Item_Exists_Modified_JSON = $validate->Item_Exists_Modified_JSON('offers','Offer_Title',$Offer_Title);
				$Start_Date_Formatted = strtotime($Start_Date);
				$End_Date_Formatted = strtotime($End_Date);
				$sql = 'SELECT Starts_Date,End_Date FROM users WHERE ID = ?';
				$Execute_Array = array($AID);
				$results = $Display->Display_Info($sql,$Execute_Array);
				$Invalid_Date = false;
				foreach($results as $rows)
					{
						$Starts_Date_Membership = strtotime($rows->Starts_Date);
						$End_Date_Membership = strtotime($rows->End_Date);
						if(($Starts_Date_Membership > $Start_Date_Formatted) || ($End_Date_Membership < $Start_Date_Formatted ) || ($Starts_Date_Membership > $End_Date_Formatted) || ($End_Date_Membership < $End_Date_Formatted ))
							{
								$Invalid_Date = true;
							}
					}
				$City_Array = explode(',',$City_String);
				$City = array();
				foreach($City_Array as $value)
					{
						if($value != NULL)
							{
								$City[] = $value;
							}
					}
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
				elseif(!count($City))
					{
						$myTweets = array("flag" => '7');
						$Display->Write_JSON($Time_Stamp,$myTweets);
					}
				elseif($Invalid_Date)
					{
						$myTweets = array("flag" => '8');
						$Display->Write_JSON($Time_Stamp,$myTweets);
					}
				else
					{
						$myTweets = array("flag" => '0');
						$Display->Write_JSON($Time_Stamp,$myTweets);
						$Start_Date = date('Y-m-d',strtotime($Start_Date));
						$End_Date = date('Y-m-d',strtotime($End_Date));
						//$Offer_Content = htmlentities($Offer_Content,ENT_QUOTES,'UTF-8');
						//$Offer_Content_Stripped = trim(str_replace('&quot','&#39',$Offer_Content_Stripped));
						$sql = 'INSERT INTO '.$Table.' (AID,Ads_Sub_Cat,Offer_Title,Offer_Content,Start_Date,End_Date,Status) VALUES (?,?,?,?,?,?,?)';
						$Execute_Array = array($AID,$Ads_Sub_Cat,$Offer_Title,$Offer_Content_Stripped,$Start_Date,$End_Date,'1');
						$RID = $Display->Execute($sql,$Execute_Array,'1',$Table);
						$Action_Time = date('Y-m-d G:i:s');
						$Display->create_log($RID,$Table,'1',$Action_Time,$OID,'added new voucher');
						foreach($City as $value)
							{
								$sql = 'INSERT INTO '.$Table_City.' (OID,CID) VALUES (?,?)';
								$Execute_Array = array($RID,$value);
								$RID2 = $Display->Execute($sql,$Execute_Array,'1',$Table_City);
								$Action_Time = date('Y-m-d G:i:s');
								$Display->create_log($RID2,$Table_City,'1',$Action_Time,$OID,'added new city-offer relationship');
							}
						$this->add_offer_par($AID);
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
			window.location = '<?php echo __VISITOR_PATH;?>';
			</script>
			<?
		}
}

?>
