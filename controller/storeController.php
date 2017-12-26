<?php
class storeController extends baseController {
			
		public function index() 
			{
				
			}
		private function update_offer_counter($Ads_Cat,$City)
			{
				$Display = new sql();
				$sql = 'SELECT ID FROM users WHERE Ads_Cat = ? AND Status = ?';
				$Execute_Array = array($Ads_Cat,'1');
				$results = $Display->Display_Info($sql,$Execute_Array);
				foreach($results as $rows)
					{
						$AID = $rows->ID;
						$sql_city = 'SELECT OID FROM city_offers_english WHERE CID = ?';
						$Execute_Array = array($City);
						$results_city = $Display->Display_Info($sql_city,$Execute_Array);
						foreach($results_city as $rows_city)
							{
									$sql_offers = 'SELECT Ads_Sub_Cat FROM offers_english WHERE AID = ? AND ID = ? AND Status = ?';
									$Execute_Array = array($AID,$rows_city->OID,'1');
									$results_offers = $Display->Display_Info($sql_offers,$Execute_Array);
									foreach($results_offers as $rows_offers)
										{
												$Today = date('Y-m-d');
												$sql_statistics = 'INSERT INTO statistics_english (Message_ID,Time_Stamp,Ads_sub_Cat) VALUES (?,?,?)';
												$Execute_Array = array($rows_city->OID,$Today,$rows_offers->Ads_Sub_Cat);
												$Display->Execute($sql_statistics,$Execute_Array);
										}
							}
					}
			}
		public function display_offer()
			{
				$Display = new sql();
				$URL = new url();
				$cache = new cache();
				$Member = $URL->getPar('Member');
				switch($Member)
					{
						case '3':
						$Image_Name = 'restaurants';
						break;
						
						case '8':
						$Image_Name = 'coffeeshop';
						break;
						
						case '15':
						$Image_Name = 'gym';
						break;
						
						case '16':
						$Image_Name = 'fun';
						break;
						
						case '10':
						$Image_Name = 'daily';
						break;
						
						case '9':
						$Image_Name = 'electronic';
						break;
						
						case '17':
						$Image_Name = 'giftsToys';
						break;
						
						case '13':
						$Image_Name = 'clothes';
						break;
						
						case '11':
						$Image_Name = 'travel';
						break;
						
						case '12':
						$Image_Name = 'umrah';
						break;
						
						case '18':
						$Image_Name = 'furniture';
						break;
						
						case '14':
						$Image_Name = 'accessories';
						break;
						
						default:
						$Image_Name = 'services-waffer-tit';
					}
				$this->registry->template->Image_Name = $Image_Name;
				$this->registry->template->Member = $Member;
				$this->registry->template->show('store/display_offer');
			}
		public function display_offer_post_new()
			{
				$Display = new sql();
				$Member = $_POST['Member'];
				$this->registry->template->Member = $Member;
				$this->registry->template->show('store/display_offer_post_new');
			}
		public function display_offer_post_offer()
			{
				$Display = new sql();
				$Member = $_POST['Member'];
				$this->registry->template->Member = $Member;
				$this->registry->template->show('store/display_offer_post_offer');
			}
		public function display_offer_post_discount_card()
			{
				$Display = new sql();
				$Member = $_POST['Member'];
				$this->registry->template->Member = $Member;
				$this->registry->template->show('store/display_offer_post_discount_card');
			}
		public function display_offer_post()
			{
				$Display = new sql();
				$Member = $_POST['Member'];
				$this->registry->template->Member = $Member;
				$this->registry->template->show('store/display_offer_post');
			}
		public function display_country()
			{
				$this->registry->template->show('store/display_country');
			}
		public function display_merchants_offers_new()
			{
				$Display = new sql();
				$MID = $_POST['MID'];
				$sql = 'SELECT Sender_Name FROM users WHERE ID = ?';
				$Execute_Array = array($MID);
				$this->registry->template->Sender_Name = $Display->Display_Single_Info_Modified($sql,'Sender_Name',$Execute_Array);
				$City_ID = $_POST['City_ID'];
				$Country_ID = $_POST['Country_ID'];
				$Sub_Cat = $_POST['Sub_Cat'];
				$Member = $_POST['Member'];
				$this->registry->template->Country_ID = $Country_ID;
				$this->registry->template->City_ID = $City_ID;
				$this->registry->template->Member = $Member;
				$OID_Array = array();
				$Offers_Array = array();
				$sql = 'SELECT OID FROM city_offers_english WHERE CID = ?';
				$Execute_Array = array($City_ID);
				$results = $Display->Display_Info($sql,$Execute_Array);
				foreach($results as $rows)
					{
						$OID_Array[] = $rows->OID;
					}
				foreach($OID_Array as $Value)
					{
						$sql = 'SELECT Offer_Content FROM offers_english WHERE ID = ? AND Status = ? AND AID = ? AND Ads_Sub_Cat = ?';
						$Execute_Array = array($Value,'1',$MID,$Sub_Cat);
						$results = $Display->Display_Info($sql,$Execute_Array); 
						foreach($results as $rows)
							{
								$Offers_Array[] = stripslashes($rows->Offer_Content);
							}
					}
				$this->registry->template->Offers_Array = $Offers_Array;
				$this->registry->template->show('store/display_merchants_offers_new');
			}
		public function display_merchants_offers_offer()
			{
				$Display = new sql();
				$MID = $_POST['MID'];
				$sql = 'SELECT Sender_Name FROM users WHERE ID = ?';
				$Execute_Array = array($MID);
				$this->registry->template->Sender_Name = $Display->Display_Single_Info_Modified($sql,'Sender_Name',$Execute_Array);
				$City_ID = $_POST['City_ID'];
				$Country_ID = $_POST['Country_ID'];
				$Sub_Cat = $_POST['Sub_Cat'];
				$Member = $_POST['Member'];
				$this->registry->template->Country_ID = $Country_ID;
				$this->registry->template->City_ID = $City_ID;
				$this->registry->template->Member = $Member;
				$OID_Array = array();
				$Offers_Array = array();
				$sql = 'SELECT OID FROM city_offers_english WHERE CID = ?';
				$Execute_Array = array($City_ID);
				$results = $Display->Display_Info($sql,$Execute_Array);
				foreach($results as $rows)
					{
						$OID_Array[] = $rows->OID;
					}
				foreach($OID_Array as $Value)
					{
						$sql = 'SELECT Offer_Content FROM offers_english WHERE ID = ? AND Status = ? AND AID = ? AND Ads_Sub_Cat = ?';
						$Execute_Array = array($Value,'1',$MID,$Sub_Cat);
						$results = $Display->Display_Info($sql,$Execute_Array); 
						foreach($results as $rows)
							{
								$Offers_Array[] = stripslashes($rows->Offer_Content);
							}
					}
				$this->registry->template->Offers_Array = $Offers_Array;
				$this->registry->template->show('store/display_merchants_offers_offer');
			}
		public function display_merchants_offers_discounts_card()
			{
				$Display = new sql();
				$MID = $_POST['MID'];
				$sql = 'SELECT Sender_Name FROM users WHERE ID = ?';
				$Execute_Array = array($MID);
				$this->registry->template->Sender_Name = $Display->Display_Single_Info_Modified($sql,'Sender_Name',$Execute_Array);
				$City_ID = $_POST['City_ID'];
				$Country_ID = $_POST['Country_ID'];
				$Sub_Cat = $_POST['Sub_Cat'];
				$Member = $_POST['Member'];
				$this->registry->template->Country_ID = $Country_ID;
				$this->registry->template->City_ID = $City_ID;
				$this->registry->template->Member = $Member;
				$OID_Array = array();
				$Offers_Array = array();
				$sql = 'SELECT OID FROM city_offers_english WHERE CID = ?';
				$Execute_Array = array($City_ID);
				$results = $Display->Display_Info($sql,$Execute_Array);
				foreach($results as $rows)
					{
						$OID_Array[] = $rows->OID;
					}
				foreach($OID_Array as $Value)
					{
						$sql = 'SELECT Offer_Content FROM offers_english WHERE ID = ? AND Status = ? AND AID = ? AND Ads_Sub_Cat = ?';
						$Execute_Array = array($Value,'1',$MID,$Sub_Cat);
						$results = $Display->Display_Info($sql,$Execute_Array); 
						foreach($results as $rows)
							{
								$Offers_Array[] = stripslashes($rows->Offer_Content);
							}
					}
				$this->registry->template->Offers_Array = $Offers_Array;
				$this->registry->template->show('store/display_merchants_offers_discounts_card');
			}
		public function display_merchants_offers_discounts()
			{
				$Display = new sql();
				$MID = $_POST['MID'];
				$sql = 'SELECT Sender_Name FROM users WHERE ID = ?';
				$Execute_Array = array($MID);
				$this->registry->template->Sender_Name = $Display->Display_Single_Info_Modified($sql,'Sender_Name',$Execute_Array);
				$City_ID = $_POST['City_ID'];
				$Country_ID = $_POST['Country_ID'];
				$Member = $_POST['Member'];
				$this->update_offer_counter($Member,$City_ID);
				$Sub_Cat = $_POST['Sub_Cat'];
				$this->registry->template->Country_ID = $Country_ID;
				$this->registry->template->City_ID = $City_ID;
				$this->registry->template->Member = $Member;
				$OID_Array = array();
				$Offers_Array = array();
				$sql = 'SELECT OID FROM city_offers_english WHERE CID = ?';
				$Execute_Array = array($City_ID);
				$results = $Display->Display_Info($sql,$Execute_Array);
				foreach($results as $rows)
					{
						$OID_Array[] = $rows->OID;
					}
				foreach($OID_Array as $Value)
					{
						$sql = 'SELECT Offer_Content FROM offers_english WHERE ID = ? AND Status = ? AND AID = ? AND Ads_Sub_Cat = ?';
						$Execute_Array = array($Value,'1',$MID,$Sub_Cat);
						$results = $Display->Display_Info($sql,$Execute_Array); 
						foreach($results as $rows)
							{
								$Offers_Array[] = stripslashes($rows->Offer_Content);
							}
					}
				$this->registry->template->Offers_Array = $Offers_Array;
				$this->registry->template->show('store/display_merchants_offers_discounts');
			}
		public function display_offers_by_city_new()
			{
				$Display = new sql();
				$City_ID = $_POST['City_ID'];
				$Country_ID = $_POST['Country_ID'];
				$Member = $_POST['Member'];
				$this->update_offer_counter($Member,$City_ID);
				$this->registry->template->Country_ID = $Country_ID;
				$this->registry->template->City_ID = $City_ID;
				$this->registry->template->Member = $Member;
				$this->registry->template->Sub_Cat = '6';
				$sql = 'SELECT OID FROM city_offers_english WHERE CID = ?';
				$Execute_Array = array($City_ID);
				$results = $Display->Display_Info($sql,$Execute_Array);
				$AID_Array = array();
				$MID_Array = array();
				$Sender_Name_Array = array();
				$Sender_Name_ID = array();
				$Final_AID = array();
				foreach($results as $rows)
					{
						$sql = 'SELECT AID FROM offers_english WHERE ID = ? AND Status = ?';
						$Execute_Array = array($rows->OID,'1');
						$results_offers = $Display->Display_Info($sql,$Execute_Array);
						foreach($results_offers as $rows_offers)
							{
								if(!in_array($rows_offers->AID,$AID_Array))
									{
										$AID_Array[] = $rows_offers->AID;
									}
							}
					}
				$sql = 'SELECT MID FROM merchant_services_english WHERE SID = ? AND Status = ?';
				$Execute_Array = array('6','1');
				$results_offers = $Display->Display_Info($sql,$Execute_Array);
				foreach($results_offers as $rows_offers)
					{
						if(!in_array($rows_offers->MID,$MID_Array))
							{
								$MID_Array[] = $rows_offers->MID;
							}
					}
					
				$Final_AID = array_intersect($MID_Array,$AID_Array);
				foreach($Final_AID as $Value)
					{
						$sql = 'SELECT Sender_Name FROM users WHERE ID = ? AND Status = ? AND Ads_Cat = ?';
						$Execute_Array = array($Value,'1',$Member);
						$results = $Display->Display_Info($sql,$Execute_Array);
						foreach($results as $rows)
							{
								$Sender_Name_Array[] = $rows->Sender_Name;
								$Sender_Name_ID[] = $Value;
							}
					}
				$this->registry->template->Sender_Name_Array = $Sender_Name_Array;
				$this->registry->template->Sender_Name_ID = $Sender_Name_ID;
				$this->registry->template->show('store/display_offers_by_city_new');
			}
		public function display_offers_by_city_offer()
			{
				$Display = new sql();
				$City_ID = $_POST['City_ID'];
				$Country_ID = $_POST['Country_ID'];
				$Member = $_POST['Member'];
				$this->update_offer_counter($Member,$City_ID);
				$this->registry->template->Country_ID = $Country_ID;
				$this->registry->template->City_ID = $City_ID;
				$this->registry->template->Member = $Member;
				$this->registry->template->Sub_Cat = '7';
				$sql = 'SELECT OID FROM city_offers_english WHERE CID = ?';
				$Execute_Array = array($City_ID);
				$results = $Display->Display_Info($sql,$Execute_Array);
				$AID_Array = array();
				$MID_Array = array();
				$Sender_Name_Array = array();
				$Sender_Name_ID = array();
				$Final_AID = array();
				foreach($results as $rows)
					{
						$sql = 'SELECT AID FROM offers_english WHERE ID = ? AND Status = ?';
						$Execute_Array = array($rows->OID,'1');
						$results_offers = $Display->Display_Info($sql,$Execute_Array);
						foreach($results_offers as $rows_offers)
							{
								if(!in_array($rows_offers->AID,$AID_Array))
									{
										$AID_Array[] = $rows_offers->AID;
									}
							}
					}
				$sql = 'SELECT MID FROM merchant_services_english WHERE SID = ? AND Status = ?';
				$Execute_Array = array('7','1');
				$results_offers = $Display->Display_Info($sql,$Execute_Array);
				foreach($results_offers as $rows_offers)
					{
						if(!in_array($rows_offers->MID,$MID_Array))
							{
								$MID_Array[] = $rows_offers->MID;
							}
					}
					
				$Final_AID = array_intersect($MID_Array,$AID_Array);
				foreach($Final_AID as $Value)
					{
						$sql = 'SELECT Sender_Name FROM users WHERE ID = ? AND Status = ? AND Ads_Cat = ?';
						$Execute_Array = array($Value,'1',$Member);
						$results = $Display->Display_Info($sql,$Execute_Array);
						foreach($results as $rows)
							{
								$Sender_Name_Array[] = $rows->Sender_Name;
								$Sender_Name_ID[] = $Value;
							}
					}
				$this->registry->template->Sender_Name_Array = $Sender_Name_Array;
				$this->registry->template->Sender_Name_ID = $Sender_Name_ID;
				$this->registry->template->show('store/display_offers_by_city_offer');
			}
		public function display_offers_by_city_discount_card()
			{
				$Display = new sql();
				$City_ID = $_POST['City_ID'];
				$Country_ID = $_POST['Country_ID'];
				$Member = $_POST['Member'];
				$this->update_offer_counter($Member,$City_ID);
				$this->registry->template->Country_ID = $Country_ID;
				$this->registry->template->City_ID = $City_ID;
				$this->registry->template->Member = $Member;
				$this->registry->template->Sub_Cat = '4';
				$sql = 'SELECT OID FROM city_offers_english WHERE CID = ?';
				$Execute_Array = array($City_ID);
				$results = $Display->Display_Info($sql,$Execute_Array);
				$AID_Array = array();
				$MID_Array = array();
				$Sender_Name_Array = array();
				$Sender_Name_ID = array();
				$Final_AID = array();
				foreach($results as $rows)
					{
						$sql = 'SELECT AID FROM offers_english WHERE ID = ? AND Status = ?';
						$Execute_Array = array($rows->OID,'1');
						$results_offers = $Display->Display_Info($sql,$Execute_Array);
						foreach($results_offers as $rows_offers)
							{
								if(!in_array($rows_offers->AID,$AID_Array))
									{
										$AID_Array[] = $rows_offers->AID;
									}
							}
					}
				$sql = 'SELECT MID FROM merchant_services_english WHERE SID = ? AND Status = ?';
				$Execute_Array = array('4','1');
				$results_offers = $Display->Display_Info($sql,$Execute_Array);
				foreach($results_offers as $rows_offers)
					{
						if(!in_array($rows_offers->MID,$MID_Array))
							{
								$MID_Array[] = $rows_offers->MID;
							}
					}
					
				$Final_AID = array_intersect($MID_Array,$AID_Array);
				foreach($Final_AID as $Value)
					{
						$sql = 'SELECT Sender_Name FROM users WHERE ID = ? AND Status = ? AND Ads_Cat = ?';
						$Execute_Array = array($Value,'1',$Member);
						$results = $Display->Display_Info($sql,$Execute_Array);
						foreach($results as $rows)
							{
								$Sender_Name_Array[] = $rows->Sender_Name;
								$Sender_Name_ID[] = $Value;
							}
					}
				$this->registry->template->Sender_Name_Array = $Sender_Name_Array;
				$this->registry->template->Sender_Name_ID = $Sender_Name_ID;
				$this->registry->template->show('store/display_offers_by_city_discount_card');
			}
		public function display_offers_by_city()
			{
				$Display = new sql();
				$City_ID = $_POST['City_ID'];
				$Country_ID = $_POST['Country_ID'];
				$Member = $_POST['Member'];
				$this->update_offer_counter($Member,$City_ID);
				$this->registry->template->Country_ID = $Country_ID;
				$this->registry->template->City_ID = $City_ID;
				$this->registry->template->Member = $Member;
				$this->registry->template->Sub_Cat = '5';
				$sql = 'SELECT OID FROM city_offers_english WHERE CID = ?';
				$Execute_Array = array($City_ID);
				$results = $Display->Display_Info($sql,$Execute_Array);
				$AID_Array = array();
				$MID_Array = array();
				$Sender_Name_Array = array();
				$Sender_Name_ID = array();
				$Final_AID = array();
				foreach($results as $rows)
					{
						$sql = 'SELECT AID FROM offers_english WHERE ID = ? AND Status = ?';
						$Execute_Array = array($rows->OID,'1');
						$results_offers = $Display->Display_Info($sql,$Execute_Array);
						foreach($results_offers as $rows_offers)
							{
								if(!in_array($rows_offers->AID,$AID_Array))
									{
										$AID_Array[] = $rows_offers->AID;
									}
							}
					}
				$sql = 'SELECT MID FROM merchant_services_english WHERE SID = ? AND Status = ?';
				$Execute_Array = array('5','1');
				$results_offers = $Display->Display_Info($sql,$Execute_Array);
				foreach($results_offers as $rows_offers)
					{
						if(!in_array($rows_offers->MID,$MID_Array))
							{
								$MID_Array[] = $rows_offers->MID;
							}
					}
					
				$Final_AID = array_intersect($MID_Array,$AID_Array);
				foreach($Final_AID as $Value)
					{
						$sql = 'SELECT Sender_Name FROM users WHERE ID = ? AND Status = ? AND Ads_Cat = ?';
						$Execute_Array = array($Value,'1',$Member);
						$results = $Display->Display_Info($sql,$Execute_Array);
						foreach($results as $rows)
							{
								$Sender_Name_Array[] = $rows->Sender_Name;
								$Sender_Name_ID[] = $Value;
							}
					}
				$this->registry->template->Sender_Name_Array = $Sender_Name_Array;
				$this->registry->template->Sender_Name_ID = $Sender_Name_ID;
				$this->registry->template->show('store/display_offers_by_city');
			}
		public function display_cities_discount_card()
			{
				$Display = new sql();
				$Country_ID = $_POST['Country_ID'];
				$Member = $_POST['Member'];
				$this->registry->template->Country_ID = $Country_ID;
				$this->registry->template->Member = $Member;
				$sql = 'SELECT ID,City_Name FROM city_english WHERE CID = ? AND Status = ?';
				$Execute_Array = array($Country_ID,'1');
				$results = $Display->Display_Info($sql,$Execute_Array);
				$City_ID_Array = array();
				$City_Name_Array = array();
				foreach($results as $rows)
					{
						$City_ID_Array[] = $rows->ID;
						$City_Name_Array[] = $rows->City_Name;
					}
				$this->registry->template->City_ID_Array = $City_ID_Array;
				$this->registry->template->City_Name_Array = $City_Name_Array;
				$this->registry->template->show('store/display_cities_discount_card');
			}
		public function display_cities_new()
			{
				$Display = new sql();
				$Country_ID = $_POST['Country_ID'];
				$Member = $_POST['Member'];
				$this->registry->template->Country_ID = $Country_ID;
				$this->registry->template->Member = $Member;
				$sql = 'SELECT ID,City_Name FROM city_english WHERE CID = ? AND Status = ?';
				$Execute_Array = array($Country_ID,'1');
				$results = $Display->Display_Info($sql,$Execute_Array);
				$City_ID_Array = array();
				$City_Name_Array = array();
				foreach($results as $rows)
					{
						$City_ID_Array[] = $rows->ID;
						$City_Name_Array[] = $rows->City_Name;
					}
				$this->registry->template->City_ID_Array = $City_ID_Array;
				$this->registry->template->City_Name_Array = $City_Name_Array;
				$this->registry->template->show('store/display_cities_new');
			}
		public function display_cities_offer()
			{
				$Display = new sql();
				$Country_ID = $_POST['Country_ID'];
				$Member = $_POST['Member'];
				$this->registry->template->Country_ID = $Country_ID;
				$this->registry->template->Member = $Member;
				$sql = 'SELECT ID,City_Name FROM city_english WHERE CID = ? AND Status = ?';
				$Execute_Array = array($Country_ID,'1');
				$results = $Display->Display_Info($sql,$Execute_Array);
				$City_ID_Array = array();
				$City_Name_Array = array();
				foreach($results as $rows)
					{
						$City_ID_Array[] = $rows->ID;
						$City_Name_Array[] = $rows->City_Name;
					}
				$this->registry->template->City_ID_Array = $City_ID_Array;
				$this->registry->template->City_Name_Array = $City_Name_Array;
				$this->registry->template->show('store/display_cities_offer');
			}
		public function display_cities()
			{
				$Display = new sql();
				$Country_ID = $_POST['Country_ID'];
				$Member = $_POST['Member'];
				$this->registry->template->Country_ID = $Country_ID;
				$this->registry->template->Member = $Member;
				$sql = 'SELECT ID,City_Name FROM city_english WHERE CID = ? AND Status = ?';
				$Execute_Array = array($Country_ID,'1');
				$results = $Display->Display_Info($sql,$Execute_Array);
				$City_ID_Array = array();
				$City_Name_Array = array();
				foreach($results as $rows)
					{
						$City_ID_Array[] = $rows->ID;
						$City_Name_Array[] = $rows->City_Name;
					}
				$this->registry->template->City_ID_Array = $City_ID_Array;
				$this->registry->template->City_Name_Array = $City_Name_Array;
				$this->registry->template->show('store/display_cities');
			}
		public function display_offer_2()
			{
				$Display = new sql();
				$URL = new url();
				$cache = new cache();
				$Member = $URL->getPar('Member');
				if((isset($Member)) && ($Member != NULL))
					{
						$AID_Array = array();
						$sql = 'SELECT ID FROM users WHERE Ads_Cat = ? AND Status = ?';
						$Execute_Array = array($Member,'1');
						$results = $Display->Display_Info($sql,$Execute_Array);
						foreach($results as $rows)
							{
								$AID_Array[] = $rows->ID;
							}
						$Table = 'offers_english';
						$Path_To_File = __CACHE.$Table.'.txt';
						$Cached_File = __CACHE.base64_encode($_SERVER['REQUEST_URI']).'.html';
						$needs_Update = true;//$cache->needs_Update($Cached_File,$Path_To_File);
						if($needs_Update)
							{
								ob_start();
								foreach($AID_Array as $value)
									{
										$sql = 'SELECT ID,News_Title,Newsletter_Intro,Newsletter_Content FROM '.$Table_News.' WHERE Status = ? AND ID = ?';
										$Execute_Array = array('1',$Member);
										$results = $Display->Display_Info($sql,$Execute_Array);
										if(count($results))
											{
												$this->registry->template->results = $results;
												$this->registry->template->show('news/display_detailed_news');
											}
										else
											{
												$this->registry->template->show('pages/display_home_page_empty');
											}
									}
								$fp = fopen($Cached_File,'w');
								fwrite($fp, ob_get_contents()); 
								fclose($fp);
								ob_end_flush();
							}
						else
							{
								require_once($Cached_File);
							}
					}
				else
					{
						$this->registry->template->show('pages/display_home_page_empty');
					}
				
			}
}

?>
