<?php
//$Allowed_Users = array('1');
//validate_roles_new::validate($Allowed_Users);
class curl_ccessController extends baseController {
			
		public function index() 
			{
				
			}
		private function key_length($Key)
			{
				$Key_length = strlen($Key);
				if($Key_length == 120)
					{
						return true;
					}
				else
					{
						return false;
					}
					
			}
		private function Export_JSON($myTweets)
			{
				$myJSONTweets = json_encode($myTweets);
				echo urldecode($myJSONTweets);
			}
		public function json_input()
			{
				$x = urlencode('عـمــان');
				$y = urlencode('ملابــس');
				$myTweets = array("City" => $x,"Cat" => $y);
				$this->Export_JSON($myTweets);
			}
		private function verify_day($Key)
			{
				$Day_Number = date('d');
				$Key_Segment = $Key[8].$Key[9];
				
				if($Key_Segment == $Day_Number)
					{
						return true;
					}
				else
					{
						return false;
					}
			}
		private function verify_month($Key)
			{
				$Month_Number = date('m');
				$Key_Segment = $Key[66].$Key[67];
				if($Key_Segment == $Month_Number)
					{
						return true;
					}
				else
					{
						return false;
					}
			}
		public function verify_key()
			{
				$Key = $_POST['Key'];
				$key_length = $this->key_length($Key);
				if($key_length)
					{
						$verify_day = $this->verify_day($Key);
						if($verify_day)
							{
								$verify_month = $this->verify_month($Key);
								if($verify_month)
									{
										echo 'Good';
									}
								else
									{
										echo 'Bad';
									}
							}
						else
							{
								return false;
							}
					}
				else
					{
						return false;
					}
			}
		private function verify_key_modified($Key)
			{
				$key_length = $this->key_length($Key);
				if($key_length)
					{
						$verify_day = $this->verify_day($Key);
						if($verify_day)
							{
								$verify_month = $this->verify_month($Key);
								if($verify_month)
									{
										return true;
									}
								else
									{
										echo 'Invalid Key';
										return false;
									}
							}
						else
							{
								echo 'Invalid Key';
								return false;
							}
					}
				else
					{
						echo 'Invalid Key';
						return false;
					}
			}
		private function create_coupon($MSG_ID)
			{
				$Display = new sql_modified();
				$Coupon = (string)time();
				$Length = strlen($Coupon);
				$Coupon_Number = rand(1,1000000);
				$Coupon_Number = $Coupon_Number.$Coupon[$Length-1]; 
				$sql = 'SELECT ID FROM coupons WHERE Coupon = ?';
				$Execute_Array = array($Coupon_Number);
				$Total_Records = $Display->Total_Records($sql,$Execute_Array);
				
				if($Total_Records)
					{
						$Coupon = (string)time();
						$Length = strlen($Coupon);
						$Coupon_Number = rand(10000,2000000);
						$Coupon_Number = $Coupon_Number.$Coupon[$Length-2];
					}
				
				$sql = 'INSERT INTO coupons (MSG_ID,Coupon,Status) VALUES (?,?,?)';
				$Execute_Array = array($MSG_ID,$Coupon_Number,'1');
				$Display->Execute($sql,$Execute_Array);
				return $Coupon_Number; 
			}
		public function display_messages_by_cat_city()
			{
				$Display = new sql_modified();
				$Ads_Cat = @$_POST['Ads_Cat'];//'3'; //$_POST['Ads_Cat'];
				$City = @$_POST['City']; //'4'; //$_POST['City'];
				$Key = @$_POST['Key'];
				$verify_key_modified = $this->verify_key_modified($Key);
				if($verify_key_modified)
					{
						$sql = 'SELECT ID,Sender_Name FROM users WHERE Ads_Cat = ? AND Status = ?';
						$Execute_Array = array($Ads_Cat,'1');
						$results = $Display->Display_Info($sql,$Execute_Array);
						$myTweets = array();
						foreach($results as $rows)
							{
								$AID = $rows->ID;
								$user_name = $rows->Sender_Name;
								$user_name_encoded = urlencode($user_name);
								$sql_city = 'SELECT OID FROM city_offers_english WHERE CID = ?';
								$Execute_Array = array($City);
								$results_city = $Display->Display_Info($sql_city,$Execute_Array);
								foreach($results_city as $rows_city)
									{
										$sql_offers = 'SELECT Ads_Sub_Cat,Offer_Content,Start_Date,End_Date FROM offers_english WHERE AID = ? AND ID = ? AND Status = ?';
										$Execute_Array = array($AID,$rows_city->OID,'1');
										$results_offers = $Display->Display_Info($sql_offers,$Execute_Array);
										
										foreach($results_offers as $rows_offers)
											{
												$Offer_Content = trim(stripslashes($rows_offers->Offer_Content));
												$Offer_Content = urlencode($Offer_Content);
												$Start_Date = date('d-m-Y',strtotime($rows_offers->Start_Date));
												$End_Date = date('d-m-Y',strtotime($rows_offers->End_Date));
												$Today = date('Y-m-d');
												$sql_statistics = 'INSERT INTO statistics_english (Message_ID,Time_Stamp,Ads_sub_Cat) VALUES (?,?,?)';
												$Execute_Array = array($rows_city->OID,$Today,$rows_offers->Ads_Sub_Cat);
												$Display->Execute($sql_statistics,$Execute_Array);
												switch($rows_offers->Ads_Sub_Cat)
													{
														case '4':
														$MSG = urlencode('هــذه الـبـطـاقــة صـالـحــة لـغــايــة').' '.$End_Date;
														$Coupon = $this->create_coupon($rows_city->OID);
														$Offer_Content .= ' رقـم الـكـوبـون : '.$Coupon;
														$myTweets['Messages'][] = array('Offer_ID'=>$rows_city->OID,'SenderName'=>$user_name_encoded,'Ads_sub_Cat'=>$rows_offers->Ads_Sub_Cat,'Offer_Content'=>$Offer_Content,'MSG'=>$MSG);
														break;
														
														case '5':
														$MSG = urlencode('الـتـنـزيـلات حـتـى تـاريــخ').' '.$End_Date;
														$myTweets['Messages'][] = array('Offer_ID'=>$rows_city->OID,'SenderName'=>$user_name_encoded,'Ads_sub_Cat'=>$rows_offers->Ads_Sub_Cat,'Offer_Content'=>$Offer_Content,'MSG'=>$MSG);
														//$myTweets[$user_name_encoded]['Offer'][] = array('Offer'=>$Offer_Content,'MSG'=>$MSG,'Expired'=>$End_Date);
														break;
														
														case '6':
														$myTweets['Messages'][] = array('Offer_ID'=>$rows_city->OID,'SenderName'=>$user_name_encoded,'Ads_sub_Cat'=>$rows_offers->Ads_Sub_Cat,'Offer_Content'=>$Offer_Content);
														//$myTweets[$user_name_encoded]['Offer'][] = array('Offer'=>$Offer_Content);
														break;
														
														case '7':
														$MSG = urlencode('هــذا الـعــرض صـالـح لـغــايــة').' '.$End_Date;
														$myTweets['Messages'][] = array('Offer_ID'=>$rows_city->OID,'SenderName'=>$user_name_encoded,'Ads_sub_Cat'=>$rows_offers->Ads_Sub_Cat,'Offer_Content'=>$Offer_Content,'MSG'=>$MSG);
														//$myTweets[$user_name_encoded]['Offer'][] = array('Offer'=>$Offer_Content,'MSG'=>$MSG,'Expired'=>$End_Date);
														break;
														
														default:
														$myTweets['Messages'][] = array('Offer_ID'=>$rows_city->OID,'SenderName'=>$user_name_encoded,'Ads_sub_Cat'=>$rows_offers->Ads_Sub_Cat,'Offer_Content'=>$Offer_Content);
														//$myTweets[$user_name_encoded]['Offer'][] = array('Offer'=>$Offer_Content);
													}
												
											}
									}
								
								
							}
						
						$this->Export_JSON($myTweets);
					}
			}
		private function send_email_to_admin_mobile($Email,$Country_ID)
			{
				$Display = new sql_modified();
				$sql = 'SELECT Name FROM country_english WHERE ID = ?';
				$Execute_Array = array($Country_ID);
				$Country_Name = $Display->Display_Single_Info_Modified($sql,'Name',$Execute_Array);
				
				$sql = 'SELECT ID FROM mobile_users WHERE Country_ID = ? AND Status = ?';
				$Execute_Array = array('18','1'); //Jordan
				$Jordan_Users = $Display->Total_Records($sql,$Execute_Array);
				
				$sql = 'SELECT ID FROM mobile_users WHERE Country_ID = ? AND Status = ?';
				$Execute_Array = array('19','1'); //Jordan
				$KSA_Users = $Display->Total_Records($sql,$Execute_Array);
				
				$Grand_Total = $Jordan_Users + $KSA_Users;
				$my_mail = new my_mail();
				$body = '<div>This is to notify you that a new mobile user was registered.</div>';
				$body .= '<div>Mobile user Email address: '.$Email.'</div>';
				$body .= '<div>Country : '.$Country_Name.'</div>';
				$body .= '<div>Total mobile users in Jordan : '.$Jordan_Users.'</div>';
				$body .= '<div>Total mobile users in KSA : '.$KSA_Users.'</div>';
				$body .= '<div>Total mobile users : '.$Grand_Total.'</div>';

				$my_mail->Send_SMTP($body,'mail.wafferapp.com','jor@wafferapp.com','FU{t?uMe7XaT','jor@wafferapp.com','Waffer Team','Waffer','hazem.a@softilesolutions.com','MR. Hazem');
				
			}
		public function insert_email()
			{
				$Display = new sql_modified();
				$Email = @$_POST['Email'];
				$Key = @$_POST['Key'];
				$Country_ID = @$_POST['Country_ID'];
				$verify_key_modified = $this->verify_key_modified($Key);
				if($verify_key_modified)
					{
						$sql = 'SELECT Email FROM mobile_users WHERE Email = ?';
						$Execute_Array = array($Email);
						$results = $Display->Display_Info($sql,$Execute_Array);
						if(count($results))
							{
								echo '0';
							}
						else
							{
								$sql = 'INSERT INTO mobile_users (Email,Country_ID,Status) VALUES (?,?,?)';
								$Execute_Array = array($Email,$Country_ID,'1');
								$Inserted = $Display->Execute($sql,$Execute_Array,'1','mobile_users');
								if($Inserted)
									{
										$this->send_email_to_admin_mobile($Email,$Country_ID);
										echo '0';
										$Table = 'potential_mobile_users_english';
										$Table_Points = 'my_claimed_prizes_english';
										$sql = 'SELECT UID FROM '.$Table.' WHERE Email = ? AND Status = ? ORDER BY Time_STAMP LIMIT 0,1';
										$Execute_Array = array($Email,'2');
										$Total_Records = $Display->Total_Records($sql,$Execute_Array);
										if($Total_Records)
											{
												$UID = $Display->Display_Single_Info_Modified($sql,'UID',$Execute_Array);
												$sql = 'SELECT Accum_Points FROM '.$Table_Points.' WHERE UID = ? AND Status = ?';
												$Execute_Array = array($UID,'1');
												$Total_Records_Points = $Display->Total_Records($sql,$Execute_Array);
												if($Total_Records_Points)
													{
														$Accum_Points = $Display->Display_Single_Info_Modified($sql,'Accum_Points',$Execute_Array);
														$Accum_Points++;
														$sql = 'UPDATE '.$Table_Points.' SET Accum_Points = ? WHERE UID = ?';
														$Execute_Array = array($Accum_Points,$UID);
														$Display->Execute($sql,$Execute_Array);
													}
												else
													{
														$sql = 'INSERT INTO '.$Table_Points.' (UID,Accum_Points,Status) VALUES (?,?,?)';
														$Execute_Array = array($UID,'1','1');
														$RID = $Display->Execute($sql,$Execute_Array,'1',$Table);
														$Action_Time = date('Y-m-d G:i:s');
														$Display->create_log($RID,$Table,'1',$Action_Time,$RID,'Added a new mobile user');
													}
											}
									}
								else
									{
										echo '1';
									}
							}
					}
			}
		public function curl_it()
			{
				$Display = new sql_modified();
				$sql = 'SELECT My_Key FROM application';
				$Key = $Display->Display_Single_Info_Modified($sql,'My_Key');
				$Member = $_POST['ID'];
				$sql = 'SELECT URL FROM restaurant_list WHERE ID = ?';
				$Execute_Array = array($Member);
				$URL = $Display->Display_Single_Info_Modified($sql,'URL',$Execute_Array);
				$URL = $URL.'/mypanel/API/display_branches_detailed_report/AJAX/Y/';
				$params = array('ID'=>$Member,'Key'=>$Key);
				$RestRequest = new restrequest($URL,'POST',$params);
				//$RestRequest = new restrequest('http://www.softiletest.com/API/adminadvertisers/Test/AJAX/Y/');
				$RestRequest->execute(); 
			}
}

?>
