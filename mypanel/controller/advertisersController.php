 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
$Allowed_Users = array('2');
validate_roles_new::validate($Allowed_Users);
class advertisersController extends baseController {
			
		public function index() 
			{
				
			}
		public function home()
			{
				$Display = new sql();
				$OID = $_SESSION['User_ID'];
				if(isset($_SESSION['Arabic']))
					{
						$Table_Merchants = 'merchant_services';
						$Table_Cat = 'ads_cat';
						$Table_Sub_Cat = 'ads_sub_cat';
						$Table_Offers = 'offers';
					}
				else
					{
						$Table_Merchants = 'merchant_services_english';
						$Table_Cat = 'ads_cat_english';
						$Table_Sub_Cat = 'ads_sub_cat_english';
						$Table_Offers = 'offers_english';
					}
				$sql = 'SELECT Starts_Date,End_Date,Ads_Cat FROM users WHERE ID = ?';
				$Execute_Array = array($OID);
				$results = $Display->Display_Info($sql,$Execute_Array);
				foreach($results as $rows)
					{
						$this->registry->template->Starts_Date = date('d-m-Y',strtotime($rows->Starts_Date));
						$this->registry->template->End_Date = date('d-m-Y',strtotime($rows->End_Date));
						$sql = 'SELECT Cat_Name FROM '.$Table_Cat.' WHERE ID = ?';
						$Execute_Array = array($rows->Ads_Cat);
						$this->registry->template->Ads_Cat_Name = $Display->Display_Single_Info_Modified($sql,'Cat_Name',$Execute_Array);
					}
				$Sub_Cat_Services = array();
				$sql = 'SELECT SID FROM '.$Table_Merchants.' WHERE MID = ? AND Status = ?';
				$Execute_Array = array($OID,'1');
				$results = $Display->Display_Info($sql,$Execute_Array);
				foreach($results as $rows)
					{
						$sql_sub = 'SELECT Sub_Cat_Name FROM '.$Table_Sub_Cat.' WHERE ID = ?';
						$Execute_Array = array($rows->SID);
						$Sub_Cat_Services[] = $Display->Display_Single_Info_Modified($sql_sub,'Sub_Cat_Name',$Execute_Array);
					}
				$sql = 'SELECT ID FROM '.$Table_Offers.' WHERE AID = ? AND Status = ?';
				$Execute_Array = array($OID,'1');
				$this->registry->template->Total_Active_Messages = $Display->Total_Records($sql,$Execute_Array);
				
				$sql = 'SELECT ID FROM '.$Table_Offers.' WHERE AID = ? AND Status = ?';
				$Execute_Array = array($OID,'5');
				$this->registry->template->Total_Returned_Messages = $Display->Total_Records($sql,$Execute_Array);
				
				$sql = 'SELECT ID FROM '.$Table_Offers.' WHERE AID = ? AND Status = ?';
				$Execute_Array = array($OID,'3');
				$this->registry->template->Total_Expired_Messages = $Display->Total_Records($sql,$Execute_Array);
				
				$sql = 'SELECT ID FROM '.$Table_Offers.' WHERE AID = ? AND Status = ?';
				$Execute_Array = array($OID,'2');
				$this->registry->template->Total_Pending_Messages = $Display->Total_Records($sql,$Execute_Array);
				$this->registry->template->Sub_Cat_Services = $Sub_Cat_Services;
				$this->registry->template->show('advertisers/home');
			}
		public function edit_selected_offer_draft()
			{
				$Display = new sql();
				$URL = new url();
				$OID = $_SESSION['User_ID'];
				$ID = $URL->getPar('Member');
				$AID = $_SESSION['User_ID'];
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
				$this->registry->template->show('advertisers/edit_selected_offer_draft');
			}
		public function show_offer_details()
			{
				$Display = new sql();
				$URL = new url();
				$OID = $_SESSION['User_ID'];
				$ID = $URL->getPar('Member');
				$AID = $_SESSION['User_ID'];
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
				$City_Name_Array = array();
				$sql = 'SELECT CID FROM '.$Table_City_Relation.' WHERE OID = ?';
				$Execute_Array = array($ID);
				$results = $Display->Display_Info($sql,$Execute_Array);
				foreach($results as $rows)
					{
						$sql_city = 'SELECT City_Name FROM '.$Table_City.' WHERE ID = ? AND Status = ?';
						$Execute_Array = array($rows->CID,'1');
						$City_Name_Array[] = $Display->Display_Single_Info_Modified($sql_city,'City_Name',$Execute_Array);
					}
				$this->registry->template->City_Name_Array = $City_Name_Array;
				$sql = 'SELECT ID,Ads_Sub_Cat,Offer_Title,Offer_Content,Start_Date,End_Date FROM '.$Table.' WHERE ID = ?';
				$Execute_Array = array($ID);
				$this->registry->template->results = $Display->Display_Info($sql,$Execute_Array);
				$this->registry->template->show('advertisers/show_offer_details');
				
			}
		public function edit_selected_offer_from_pending()
			{
				$Display = new sql();
				$URL = new url();
				$OID = $_SESSION['User_ID'];
				$ID = $URL->getPar('Member');
				$AID = $_SESSION['User_ID'];
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
				$this->registry->template->show('advertisers/edit_selected_offer_from_pending');
			}
		public function draft_offer()
			{
				$Display = new sql();
				$OID = $_SESSION['User_ID'];
				if(isset($_SESSION['Arabic']))
					{
						$Table_Merchants = 'merchant_services';
						$Table_Cat = 'ads_cat';
						$Table_Sub_Cat = 'ads_sub_cat';
						$Table_Offers = 'offers';
					}
				else
					{
						$Table_Merchants = 'merchant_services_english';
						$Table_Cat = 'ads_cat_english';
						$Table_Sub_Cat = 'ads_sub_cat_english';
						$Table_Offers = 'offers_english';
					}
				$Offer_ID = array();
				$Offer_Sub_Cat_Name = array();
				$Offer_Title = array();
				$Offer_Start_Date = array();
				$Offer_End_Date = array();
				$sql = 'SELECT ID,Ads_Sub_Cat,Offer_Title,Start_Date,End_Date FROM '.$Table_Offers.' WHERE AID = ? AND Status = ?';
				$Execute_Array = array($OID,'4');
				$pagenum  = @$_POST['Page'];
				$paginate = new paginate($Table_Offers,'20',$pagenum,$sql,$Execute_Array);
				$Count = $paginate->Records($Table_Offers);
				$this->registry->template->Page = $pagenum;
				$this->registry->template->Count = $Count;
				$this->registry->template->Last = $paginate->Calculate_Last($Count);
				$results = $paginate->Paginate();
				if((count($results))&&(is_array($results)))
					{
						foreach($results as $rows)
							{
								$Offer_ID[] = $rows->ID;
								$sql_sub = 'SELECT Sub_Cat_Name FROM '.$Table_Sub_Cat.' WHERE ID = ?';
								$Execute_Array = array($rows->Ads_Sub_Cat);
								$Offer_Sub_Cat_Name[] = $Display->Display_Single_Info_Modified($sql_sub,'Sub_Cat_Name',$Execute_Array);
								$Offer_Title[] = stripslashes($rows->Offer_Title);
								$Offer_Start_Date[] = date('d-m-Y',strtotime($rows->Start_Date));
								$Offer_End_Date[] = date('d-m-Y',strtotime($rows->End_Date));
							}
						$this->registry->template->Offer_ID = $Offer_ID;
						$this->registry->template->Offer_Sub_Cat_Name = $Offer_Sub_Cat_Name;
						$this->registry->template->Offer_Title = $Offer_Title;
						$this->registry->template->Offer_Start_Date = $Offer_Start_Date;
						$this->registry->template->Offer_End_Date = $Offer_End_Date;
						$this->registry->template->show('advertisers/pending_offer');
					}
				else
					{
						$this->registry->template->show('admin_search/no_results');
					}
			}
		public function expired_offer()
			{
				$Display = new sql();
				$OID = $_SESSION['User_ID'];
				if(isset($_SESSION['Arabic']))
					{
						$Table_Merchants = 'merchant_services';
						$Table_Cat = 'ads_cat';
						$Table_Sub_Cat = 'ads_sub_cat';
						$Table_Offers = 'offers';
					}
				else
					{
						$Table_Merchants = 'merchant_services_english';
						$Table_Cat = 'ads_cat_english';
						$Table_Sub_Cat = 'ads_sub_cat_english';
						$Table_Offers = 'offers_english';
					}
				$Offer_ID = array();
				$Offer_Sub_Cat_Name = array();
				$Offer_Title = array();
				$Offer_Start_Date = array();
				$Offer_End_Date = array();
				$sql = 'SELECT ID,Ads_Sub_Cat,Offer_Title,Start_Date,End_Date FROM '.$Table_Offers.' WHERE AID = ? AND Status = ?';
				$Execute_Array = array($OID,'3');
				$pagenum  = @$_POST['Page'];
				$paginate = new paginate($Table_Offers,'20',$pagenum,$sql,$Execute_Array);
				$Count = $paginate->Records($Table_Offers);
				$this->registry->template->Page = $pagenum;
				$this->registry->template->Count = $Count;
				$this->registry->template->Last = $paginate->Calculate_Last($Count);
				$results = $paginate->Paginate();
				if((count($results))&&(is_array($results)))
					{
						foreach($results as $rows)
							{
								$Offer_ID[] = $rows->ID;
								$sql_sub = 'SELECT Sub_Cat_Name FROM '.$Table_Sub_Cat.' WHERE ID = ?';
								$Execute_Array = array($rows->Ads_Sub_Cat);
								$Offer_Sub_Cat_Name[] = $Display->Display_Single_Info_Modified($sql_sub,'Sub_Cat_Name',$Execute_Array);
								$Offer_Title[] = stripslashes($rows->Offer_Title);
								$Offer_Start_Date[] = date('d-m-Y',strtotime($rows->Start_Date));
								$Offer_End_Date[] = date('d-m-Y',strtotime($rows->End_Date));
							}
						$this->registry->template->Offer_ID = $Offer_ID;
						$this->registry->template->Offer_Sub_Cat_Name = $Offer_Sub_Cat_Name;
						$this->registry->template->Offer_Title = $Offer_Title;
						$this->registry->template->Offer_Start_Date = $Offer_Start_Date;
						$this->registry->template->Offer_End_Date = $Offer_End_Date;
						$this->registry->template->show('advertisers/pending_offer');
					}
				else
					{
						$this->registry->template->show('admin_search/no_results');
					}
			}
		public function returned_offer()
			{
				$Display = new sql();
				$OID = $_SESSION['User_ID'];
				if(isset($_SESSION['Arabic']))
					{
						$Table_Merchants = 'merchant_services';
						$Table_Cat = 'ads_cat';
						$Table_Sub_Cat = 'ads_sub_cat';
						$Table_Offers = 'offers';
					}
				else
					{
						$Table_Merchants = 'merchant_services_english';
						$Table_Cat = 'ads_cat_english';
						$Table_Sub_Cat = 'ads_sub_cat_english';
						$Table_Offers = 'offers_english';
					}
				$Offer_ID = array();
				$Offer_Sub_Cat_Name = array();
				$Offer_Title = array();
				$Offer_Start_Date = array();
				$Offer_End_Date = array();
				$sql = 'SELECT ID,Ads_Sub_Cat,Offer_Title,Start_Date,End_Date FROM '.$Table_Offers.' WHERE AID = ? AND Status = ?';
				$Execute_Array = array($OID,'5');
				$pagenum  = @$_POST['Page'];
				$paginate = new paginate($Table_Offers,'20',$pagenum,$sql,$Execute_Array);
				$Count = $paginate->Records($Table_Offers);
				$this->registry->template->Page = $pagenum;
				$this->registry->template->Count = $Count;
				$this->registry->template->Last = $paginate->Calculate_Last($Count);
				$results = $paginate->Paginate();
				if((count($results))&&(is_array($results)))
					{
						foreach($results as $rows)
							{
								$Offer_ID[] = $rows->ID;
								$sql_sub = 'SELECT Sub_Cat_Name FROM '.$Table_Sub_Cat.' WHERE ID = ?';
								$Execute_Array = array($rows->Ads_Sub_Cat);
								$Offer_Sub_Cat_Name[] = $Display->Display_Single_Info_Modified($sql_sub,'Sub_Cat_Name',$Execute_Array);
								$Offer_Title[] = stripslashes($rows->Offer_Title);
								$Offer_Start_Date[] = date('d-m-Y',strtotime($rows->Start_Date));
								$Offer_End_Date[] = date('d-m-Y',strtotime($rows->End_Date));
							}
						$this->registry->template->Offer_ID = $Offer_ID;
						$this->registry->template->Offer_Sub_Cat_Name = $Offer_Sub_Cat_Name;
						$this->registry->template->Offer_Title = $Offer_Title;
						$this->registry->template->Offer_Start_Date = $Offer_Start_Date;
						$this->registry->template->Offer_End_Date = $Offer_End_Date;
						$this->registry->template->show('advertisers/pending_offer');
					}
				else
					{
						$this->registry->template->show('admin_search/no_results');
					}
			}
		public function active_offer()
			{
				$Display = new sql();
				$OID = $_SESSION['User_ID'];
				if(isset($_SESSION['Arabic']))
					{
						$Table_Merchants = 'merchant_services';
						$Table_Cat = 'ads_cat';
						$Table_Sub_Cat = 'ads_sub_cat';
						$Table_Offers = 'offers';
					}
				else
					{
						$Table_Merchants = 'merchant_services_english';
						$Table_Cat = 'ads_cat_english';
						$Table_Sub_Cat = 'ads_sub_cat_english';
						$Table_Offers = 'offers_english';
					}
				$Offer_ID = array();
				$Offer_Sub_Cat_Name = array();
				$Offer_Title = array();
				$Offer_Start_Date = array();
				$Offer_End_Date = array();
				$sql = 'SELECT ID,Ads_Sub_Cat,Offer_Title,Start_Date,End_Date FROM '.$Table_Offers.' WHERE AID = ? AND Status = ?';
				$Execute_Array = array($OID,'1');
				$pagenum  = @$_POST['Page'];
				$paginate = new paginate($Table_Offers,'20',$pagenum,$sql,$Execute_Array);
				$Count = $paginate->Records($Table_Offers);
				$this->registry->template->Page = $pagenum;
				$this->registry->template->Count = $Count;
				$this->registry->template->Last = $paginate->Calculate_Last($Count);
				$results = $paginate->Paginate();
				if((count($results))&&(is_array($results)))
					{
						foreach($results as $rows)
							{
								$Offer_ID[] = $rows->ID;
								$sql_sub = 'SELECT Sub_Cat_Name FROM '.$Table_Sub_Cat.' WHERE ID = ?';
								$Execute_Array = array($rows->Ads_Sub_Cat);
								$Offer_Sub_Cat_Name[] = $Display->Display_Single_Info_Modified($sql_sub,'Sub_Cat_Name',$Execute_Array);
								$Offer_Title[] = stripslashes($rows->Offer_Title);
								$Offer_Start_Date[] = date('d-m-Y',strtotime($rows->Start_Date));
								$Offer_End_Date[] = date('d-m-Y',strtotime($rows->End_Date));
							}
						$this->registry->template->Offer_ID = $Offer_ID;
						$this->registry->template->Offer_Sub_Cat_Name = $Offer_Sub_Cat_Name;
						$this->registry->template->Offer_Title = $Offer_Title;
						$this->registry->template->Offer_Start_Date = $Offer_Start_Date;
						$this->registry->template->Offer_End_Date = $Offer_End_Date;
						$this->registry->template->show('advertisers/active_offer');
					}
				else
					{
						$this->registry->template->show('admin_search/no_results');
					}
			}
		public function pending_offer()
			{
				$Display = new sql();
				$OID = $_SESSION['User_ID'];
				if(isset($_SESSION['Arabic']))
					{
						$Table_Merchants = 'merchant_services';
						$Table_Cat = 'ads_cat';
						$Table_Sub_Cat = 'ads_sub_cat';
						$Table_Offers = 'offers';
					}
				else
					{
						$Table_Merchants = 'merchant_services_english';
						$Table_Cat = 'ads_cat_english';
						$Table_Sub_Cat = 'ads_sub_cat_english';
						$Table_Offers = 'offers_english';
					}
				$Offer_ID = array();
				$Offer_Sub_Cat_Name = array();
				$Offer_Title = array();
				$Offer_Start_Date = array();
				$Offer_End_Date = array();
				$sql = 'SELECT ID,Ads_Sub_Cat,Offer_Title,Start_Date,End_Date FROM '.$Table_Offers.' WHERE AID = ? AND Status = ?';
				$Execute_Array = array($OID,'2');
				$pagenum  = @$_POST['Page'];
				$paginate = new paginate($Table_Offers,'20',$pagenum,$sql,$Execute_Array);
				$Count = $paginate->Records($Table_Offers);
				$this->registry->template->Page = $pagenum;
				$this->registry->template->Count = $Count;
				$this->registry->template->Last = $paginate->Calculate_Last($Count);
				$results = $paginate->Paginate();
				if((count($results))&&(is_array($results)))
					{
						foreach($results as $rows)
							{
								$Offer_ID[] = $rows->ID;
								$sql_sub = 'SELECT Sub_Cat_Name FROM '.$Table_Sub_Cat.' WHERE ID = ?';
								$Execute_Array = array($rows->Ads_Sub_Cat);
								$Offer_Sub_Cat_Name[] = $Display->Display_Single_Info_Modified($sql_sub,'Sub_Cat_Name',$Execute_Array);
								$Offer_Title[] = stripslashes($rows->Offer_Title);
								$Offer_Start_Date[] = date('d-m-Y',strtotime($rows->Start_Date));
								$Offer_End_Date[] = date('d-m-Y',strtotime($rows->End_Date));
							}
						$this->registry->template->Offer_ID = $Offer_ID;
						$this->registry->template->Offer_Sub_Cat_Name = $Offer_Sub_Cat_Name;
						$this->registry->template->Offer_Title = $Offer_Title;
						$this->registry->template->Offer_Start_Date = $Offer_Start_Date;
						$this->registry->template->Offer_End_Date = $Offer_End_Date;
						$this->registry->template->show('advertisers/pending_offer');
					}
				else
					{
						$this->registry->template->show('admin_search/no_results');
					}
				
			}
		public function display_search_results()
			{
				$Display = new sql();
				$OID = $_SESSION['User_ID'];
				$Offer_Type = $_POST['Offer_Type'];
				$Start_Date = date('Y-m-d',strtotime($_POST['Start_Date']));
				$End_Date = date('Y-m-d',strtotime($_POST['End_Date']));
				$Time_Stamp = $_POST['Time_Stamp'];
				$City = $_POST['City'];
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
						if($City)
							{
								$sql = 'SELECT ID,Offer_Title,Offer_Content,Start_Date,End_Date,City,Status FROM '.$Table.' WHERE Status != ? AND Start_Date BETWEEN ? AND ? AND City = ?';
								$Execute_Array = array('0',$Start_Date,$End_Date,$City);
							}
						else
							{
								$sql = 'SELECT ID,Offer_Title,Offer_Content,Start_Date,End_Date,City,Status FROM '.$Table.' WHERE Status != ? AND Start_Date BETWEEN ? AND ?';
								$Execute_Array = array('0',$Start_Date,$End_Date);
							}
						
						$results = $Display->Display_Info($sql,$Execute_Array);
						break;
						
						case '1':
						if($City)
							{
								$sql = 'SELECT ID,Offer_Title,Offer_Content,Start_Date,End_Date,City,Status FROM '.$Table.' WHERE Status = ? AND Start_Date BETWEEN ? AND ? AND City = ?';
								$Execute_Array = array('1',$Start_Date,$End_Date,$City);
							}
						else
							{
								$sql = 'SELECT ID,Offer_Title,Offer_Content,Start_Date,End_Date,City,Status FROM '.$Table.' WHERE Status = ? AND Start_Date BETWEEN ? AND ?';
								$Execute_Array = array('1',$Start_Date,$End_Date);
							}
						$results = $Display->Display_Info($sql,$Execute_Array);
						break;
						
						case '2':
						if($City)
							{
								$sql = 'SELECT ID,Offer_Title,Offer_Content,Start_Date,End_Date,City,Status FROM '.$Table.' WHERE Status = ? AND Start_Date BETWEEN ? AND ? AND City = ?';
								$Execute_Array = array('2',$Start_Date,$End_Date,$City);
							}
						else
							{
								$sql = 'SELECT ID,Offer_Title,Offer_Content,Start_Date,End_Date,City,Status FROM '.$Table.' WHERE Status = ? AND Start_Date BETWEEN ? AND ?';
								$Execute_Array = array('2',$Start_Date,$End_Date);
							}
						$results = $Display->Display_Info($sql,$Execute_Array);
						break;
						
						case '3':
						if($City)
							{
								$sql = 'SELECT ID,Offer_Title,Offer_Content,Start_Date,End_Date,City,Status FROM '.$Table.' WHERE Status = ? AND Start_Date BETWEEN ? AND ? AND City = ?';
								$Execute_Array = array('3',$Start_Date,$End_Date,$City);
							}
						else
							{
								$sql = 'SELECT ID,Offer_Title,Offer_Content,Start_Date,End_Date,City,Status FROM '.$Table.' WHERE Status = ? AND Start_Date BETWEEN ? AND ?';
								$Execute_Array = array('3',$Start_Date,$End_Date);
							}
						$results = $Display->Display_Info($sql,$Execute_Array);
						break;
						
						default:
						$results = array();
					}
				
				if((count($results))&&(is_array($results)))
					{
						$myTweets = array("flag" => '0');
						$Display->Write_JSON($Time_Stamp,$myTweets);
						$results = $Display->Display_Info($sql,$Execute_Array);
						$this->registry->template->results = $results;
						$this->registry->template->show('advertisers/display_search_results');
					}
				else
					{
						$myTweets = array("flag" => '1');
						$Display->Write_JSON($Time_Stamp,$myTweets);
					}
				
			}
		public function search_offer()
			{
				$Display = new sql();
				$OID = $_SESSION['User_ID'];
				if(isset($_SESSION['Arabic']))
					{
						$Table_City = 'city';
					}
				else
					{
						$Table_City = 'city_english';
					}
				$sql = 'SELECT Country FROM users WHERE ID = ?';
				$Execute_Array = array($OID);
				$CID = $Display->Display_Single_Info_Modified($sql,'Country',$Execute_Array);
				
				$sql_city = 'SELECT ID,City_Name FROM '.$Table_City.' WHERE CID = ? AND Status = ?';
				$Execute_Array = array($CID,'1');
				$this->registry->template->results_city = $Display->Display_Info($sql_city,$Execute_Array);
				
				$this->registry->template->show('advertisers/search_offer');
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
				$sql = 'UPDATE '.$Table.' SET Status = ? WHERE ID = ?';
				$Execute_Array = array('0',$ID);
				$Display->Execute($sql,$Execute_Array);
				$Action_Time = date('Y-m-d G:i:s');
				$Display->create_log($ID,$Table,'3',$Action_Time,$OID,'Deleted a voucher');
				$this->edit_offer();
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
				$this->registry->template->show('advertisers/edit_selected_expired_offer');
			}
		public function edit_selected_offer()
			{
				
				$Display = new sql();
				$URL = new url();
				$OID = $_SESSION['User_ID'];
				$ID = $URL->getPar('Member');
				$AID = $_SESSION['User_ID'];
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
				$this->registry->template->show('advertisers/edit_selected_offer');
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
				$this->registry->template->show('advertisers/edit_expired_offer');
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
				$sql = 'SELECT ID,Offer_Title,Start_Date,End_Date,Status FROM '.$Table.' WHERE Status != ? AND AID = ? ORDER BY Start_Date DESC';
				$Execute_Array = array('0',$OID);
				$pagenum  = @$_POST['Page'];
				$paginate = new paginate($Table,'10',$pagenum,$sql,$Execute_Array);
				$Count = $paginate->Records($Table);
				$this->registry->template->Page = $pagenum;
				$this->registry->template->Count = $Count;
				$this->registry->template->Last = $paginate->Calculate_Last($Count);
				$results = $paginate->Paginate();
				$this->registry->template->results = $results;
				$this->registry->template->show('advertisers/edit_offer');
			}
		public function add_offer()
			{
				$Display = new sql();
				$OID = $_SESSION['User_ID'];
				if(isset($_SESSION['Arabic']))
					{
						
						$Table = 'ads_sub_cat';
						$Table_City = 'city';
						$Table_Services = 'merchant_services';
					}
				else
					{
						$Table = 'ads_sub_cat_english';
						$Table_City = 'city_english';
						$Table_Services = 'merchant_services_english';
					}
				$sql = 'SELECT Country FROM users WHERE ID = ?';
				$Execute_Array = array($OID);
				$CID = $Display->Display_Single_Info_Modified($sql,'Country',$Execute_Array);
				
				$sql_city = 'SELECT ID,City_Name FROM '.$Table_City.' WHERE CID = ? AND Status = ?';
				$Execute_Array = array($CID,'1');
				$this->registry->template->results_city = $Display->Display_Info($sql_city,$Execute_Array);
				
				$sql = 'SELECT ID,Sub_Cat_Name FROM '.$Table.' WHERE Status = ?';
				$Execute_Array = array('1');
				$this->registry->template->results = $Display->Display_Info($sql,$Execute_Array);
				
				$sql = 'SELECT ID,SID FROM '.$Table_Services.' WHERE MID = ? AND Status = ?';
				$Execute_Array = array($OID,'1');
				$results =  $Display->Display_Info($sql,$Execute_Array);
				$Merchant_Services = array();
				foreach($results as $rows)
					{
						$Merchant_Services[] = $rows->SID;
					}
				$this->registry->template->Merchant_Services = $Merchant_Services;
				$this->registry->template->show('advertisers/add_offer');
			}
		public function submit_edit_offer_activate()
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
				$Offer_Content_Stripped = trim(strip_tags($Offer_Content));
				$Offer_Content_Stripped_Length = strlen($Offer_Content_Stripped);
				$Item_Exists_Modified_JSON = false;//$validate->Item_Exists_Edit_Modified_JSON_Edit('offers','Offer_Title',$ID,$Offer_Title,$OID);
				$Start_Date_Formatted = strtotime($Start_Date);
				$End_Date_Formatted = strtotime($End_Date);
				$sql = 'SELECT Starts_Date,End_Date FROM users WHERE ID = ?';
				$Execute_Array = array($OID);
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
						
						$sql = 'UPDATE '.$Table.' SET Ads_Sub_Cat=?,Offer_Title = ?,Offer_Content = ?,Start_Date = ?,End_Date = ?,Status = ? WHERE ID = ?';
						$Execute_Array = array($Ads_Sub_Cat,$Offer_Title,$Offer_Content,$Start_Date,$End_Date,'2',$ID);
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
				$Offer_Content_Stripped = trim(strip_tags($Offer_Content));
				$Offer_Content_Stripped_Length = strlen($Offer_Content_Stripped);
				$Item_Exists_Modified_JSON = $false; //validate->Item_Exists_Edit_Modified_JSON_Edit('offers','Offer_Title',$ID,$Offer_Title,$OID);
				$Start_Date_Formatted = strtotime($Start_Date);
				$End_Date_Formatted = strtotime($End_Date);
				$sql = 'SELECT Starts_Date,End_Date FROM users WHERE ID = ?';
				$Execute_Array = array($OID);
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
						
						$sql = 'UPDATE '.$Table.' SET Ads_Sub_Cat=?,Offer_Title = ?,Offer_Content = ?,Start_Date = ?,End_Date = ? WHERE ID = ?';
						$Execute_Array = array($Ads_Sub_Cat,$Offer_Title,$Offer_Content,$Start_Date,$End_Date,$ID);
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
		public function submit_edit_offer()
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
				$Offer_Content_Stripped = trim(strip_tags($Offer_Content));
				$Offer_Content_Stripped_Length = strlen($Offer_Content_Stripped);
				$Item_Exists_Modified_JSON = false; //$validate->Item_Exists_Edit_Modified_JSON_Edit('offers','Offer_Title',$ID,$Offer_Title,$OID);
				$Start_Date_Formatted = strtotime($Start_Date);
				$End_Date_Formatted = strtotime($End_Date);
				$sql = 'SELECT Starts_Date,End_Date FROM users WHERE ID = ?';
				$Execute_Array = array($OID);
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
						$sql = 'UPDATE '.$Table.' SET Ads_Sub_Cat=?,Offer_Title = ?,Offer_Content = ?,Start_Date = ?,End_Date = ? WHERE ID = ?';
						$Execute_Array = array($Ads_Sub_Cat,$Offer_Title,$Offer_Content,$Start_Date,$End_Date,$ID);
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
				$AID =  $_SESSION['User_ID'];
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
				$Offer_Content_Stripped = trim(strip_tags($Offer_Content));
				$Offer_Content_Stripped_Length = strlen($Offer_Content_Stripped);
				$Item_Exists_Modified_JSON = false; //$validate->Item_Exists_Modified_JSON('offers','Offer_Title',$Offer_Title);
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
						
						$sql = 'INSERT INTO '.$Table.' (AID,Ads_Sub_Cat,Offer_Title,Offer_Content,Start_Date,End_Date,Status) VALUES (?,?,?,?,?,?,?)';
						$Execute_Array = array($AID,$Ads_Sub_Cat,$Offer_Title,$Offer_Content,$Start_Date,$End_Date,'4');
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
				$AID =  $_SESSION['User_ID'];
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
				$Offer_Content_Stripped = trim(strip_tags($Offer_Content));
				$Offer_Content_Stripped_Length = strlen($Offer_Content_Stripped);
				$Item_Exists_Modified_JSON = false; //$validate->Item_Exists_Modified_JSON('offers','Offer_Title',$Offer_Title);
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
						
						$sql = 'INSERT INTO '.$Table.' (AID,Ads_Sub_Cat,Offer_Title,Offer_Content,Start_Date,End_Date,Status) VALUES (?,?,?,?,?,?,?)';
						$Execute_Array = array($AID,$Ads_Sub_Cat,$Offer_Title,$Offer_Content,$Start_Date,$End_Date,'2');
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
					}
			}
		public function edit_pw()
			{
				$this->registry->template->ID =  $_SESSION['User_ID'];
				$this->registry->template->show('advertisers/edit_pw');
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
				$sql = 'SELECT First_Name,user_name,Company_Name,Phone_Number,Cell_Phone,Contact_Email FROM users WHERE ID = ?';
				$Execute_Array = array($OID);
				$this->registry->template->Member_ID = $OID;
				$this->registry->template->results = $Display->Display_Info($sql,$Execute_Array);
				$this->registry->template->show('advertisers/show_account');
			}
		public function submit_members_edit()
			{
				$Display = new sql();
				$validate = new validate_new();
				$OID = $_SESSION['User_ID'];
				$ID = $_POST['ID'];
				$First_Name = $_POST['First_Name'];
				$user_name = $_POST['user_name'];
				$Company_Name = $_POST['Company_Name'];
				$Phone_Number = $_POST['Phone_Number'];
				$Cell_Phone = $_POST['Cell_Phone'];
				$Time_Stamp = $_POST['Time_Stamp'];
				$Contact_Email = $_POST['Contact_Email'];
				$Display->Delete_JSON($Time_Stamp);
				$Validate_Email = $validate->Validate_Email($user_name);
				$Validate_Contact_Email = $validate->Validate_Email($Contact_Email);
				if($First_Name == NULL)
					{
						$myTweets = array("flag" => '1');
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
				elseif(($Contact_Email != NULL) && (!$Validate_Contact_Email))
					{
						$myTweets = array("flag" => '14');
						$Display->Write_JSON($Time_Stamp,$myTweets);
					}
				else
					{
						$myTweets = array("flag" => '0');
						$Display->Write_JSON($Time_Stamp,$myTweets);
						$Starts_Date = date('Y-m-d',strtotime($Starts_Date));
						$End_Date = date('Y-m-d',strtotime($End_Date));
						$sql = 'UPDATE users SET First_Name = ?,user_name = ?,Company_Name = ?,Phone_Number = ?,Cell_Phone = ?,Contact_Email = ? WHERE ID = ?';
						$Execute_Array = array($First_Name,$user_name,$Company_Name,$Phone_Number,$Cell_Phone,$Contact_Email,$ID);
						$Display->Execute($sql,$Execute_Array);
						$Action_Time = date('Y-m-d G:i:s');
						$Display->create_log($ID,'users','2',$Action_Time,$OID,'user edited');
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
