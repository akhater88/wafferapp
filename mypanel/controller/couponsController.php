 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
$Allowed_Users = array('1','2');
validate_roles_new::validate($Allowed_Users);
class couponsController extends baseController {
			
		public function index() 
			{
				
			}
		public function display_search_results()
			{
				$Display = new sql();
				$Coupon_Number = trim($_POST['Coupon_Number']);
				$sql = 'SELECT MSG_ID FROM coupons WHERE Coupon = ? AND Status = ?';
				$Execute_Array = array($Coupon_Number,'1');
				$MSG_ID =  $Display->Display_Single_Info_Modified($sql,'MSG_ID',$Execute_Array);
				if(isset($_SESSION['Arabic']))
					{
						$Table = 'offers';
					}
				else
					{
						$Table = 'offers_english';
					}
				
				$sql = 'SELECT Offer_Title,Offer_Content,Start_Date,End_Date FROM '.$Table.' WHERE ID = ?';
				$Execute_Array = array($MSG_ID);
				$results =  $Display->Display_Info($sql,$Execute_Array);
				if(count($results) && (is_array($results)))
					{
						foreach($results as $rows)
							{
								$this->registry->template->Title = stripslashes($rows->Offer_Title);
								$this->registry->template->Offer_Content = stripslashes($rows->Offer_Content);
							}
							
						$this->registry->template->show('coupons/display_search_results');
					}
				else
					{
						$this->registry->template->show('admin_search/no_results');
					}
			}
		public function search_merchants_coupon()
			{
				$this->registry->template->show('coupons/search_merchants_coupon');
			}
		public function search()
			{
				$this->registry->template->show('coupons/search');
			}
		public function display_search_results_merchant()
			{
				$Display = new sql();
				$Coupon_Number = trim($_POST['Coupon_Number']);
				$Merchant_ID = $_SESSION['User_ID'];
				$sql = 'SELECT MSG_ID FROM coupons WHERE Coupon = ? AND Status = ?';
				$Execute_Array = array($Coupon_Number,'1');
				$MSG_ID =  $Display->Display_Single_Info_Modified($sql,'MSG_ID',$Execute_Array);
				if(isset($_SESSION['Arabic']))
					{
						$Table = 'offers';
					}
				else
					{
						$Table = 'offers_english';
					}
				
				$sql = 'SELECT Offer_Title,Offer_Content,Start_Date,End_Date FROM '.$Table.' WHERE ID = ? AND AID = ?';
				$Execute_Array = array($MSG_ID,$Merchant_ID);
				$results =  $Display->Display_Info($sql,$Execute_Array);
				if(count($results) && (is_array($results)))
					{
						foreach($results as $rows)
							{
								$this->registry->template->Title = stripslashes($rows->Offer_Title);
								$this->registry->template->Offer_Content = stripslashes($rows->Offer_Content);
							}
							
						$this->registry->template->show('coupons/display_search_results');
					}
				else
					{
						$this->registry->template->show('admin_search/no_results');
					}
			}
		public function display_coupon_number()
			{
				$Display = new sql();
				$Offer_ID = $_POST['Offer_ID'];
				$this->registry->template->Offer_ID = $Offer_ID;
				$results = array();
				$sql = 'SELECT Coupon FROM coupons WHERE MSG_ID = ? AND Status = ?';
				$Execute_Array = array($Offer_ID,'1');
				$Coupon_Array = array();
				$results =  $Display->Display_Info($sql,$Execute_Array);
				
				$pagenum  = @$_POST['Page'];
				$paginate = new paginate_array($results,'3000',$pagenum);
				$Count = $paginate->Records();
				
				$this->registry->template->Page = $pagenum;
				$this->registry->template->Count = $Count;
				$this->registry->template->Last = $paginate->Calculate_Last($Count);
				$results = $paginate->Paginate();
				if(count($results) && (is_array($results)))
					{
						foreach($results as $rows)
							{
								$Coupon_Array[] = $rows->Coupon;
							}
						$_SESSION['My_Data'] = $Coupon_Array;
						$this->registry->template->Coupon_Array = $Coupon_Array;
						$this->registry->template->show('coupons/display_coupon_number');
					}
				else
					{
						$this->registry->template->show('admin_search/no_results');
					}
				
			}
		public function merchants_coupon()
			{
				$Display = new sql();
				$Merchant_ID = $_SESSION['User_ID'];
				if(isset($_SESSION['Arabic']))
					{
						
						$Table_Offers = 'offers';
					}
				else
					{
						
						$Table_Offers = 'offers_english';
					}
				$sql = 'SELECT ID,Offer_Title FROM '.$Table_Offers.' WHERE Ads_Sub_Cat = ? AND Status = ? AND AID = ?';
				$Execute_Array = array('4','1',$Merchant_ID);
				$results =  $Display->Display_Info($sql,$Execute_Array,$Merchant_ID);
				$OID_Array = array();
				$OID_Title_Array = array();
				foreach($results as $rows)
					{
						$OID_Array[] = $rows->ID;
						$OID_Title_Array[] = stripslashes($rows->Offer_Title);
					}
				$this->registry->template->OID_Array = $OID_Array;
				$this->registry->template->OID_Title_Array = $OID_Title_Array;
				$this->registry->template->show('coupons/merchants_coupon');
			}
		public function step_one()
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
				$Country_ID_Array = array();
				$Country_Name = array();
				$sql_country = 'SELECT ID,Name FROM '.$Table.' WHERE Status = ?';
				$Execute_Array = array('1');
				$results =  $Display->Display_Info($sql_country,$Execute_Array);
				foreach($results as $rows)
					{
						$Country_ID_Array[] = $rows->ID;
						$Country_Name[] = $rows->Name;
					}
				$this->registry->template->Country_ID_Array = $Country_ID_Array;
				$this->registry->template->Country_Name = $Country_Name;
				$this->registry->template->show('coupons/step_one');
			}
		public function display_merchant()
			{
				$Display = new sql();
				$Country_ID = $_POST['Country_ID'];
				if(isset($_SESSION['Arabic']))
					{
						$Table = 'offers';
					}
				else
					{
						$Table = 'offers_english';
					}
				if($Country_ID == '999')
					{
						$sql = 'SELECT ID, Sender_Name FROM users WHERE Level = ? AND Status = ?';
						$Execute_Array = array('2','1');
					}
				else
					{
						$sql = 'SELECT ID, Sender_Name FROM users WHERE Level = ? AND Status = ? AND Country = ?';
						$Execute_Array = array('2','1',$Country_ID);
					}
				$Merchant_ID_Array = array();
				$Merchant_Sender_Name = array();
				$results =  $Display->Display_Info($sql,$Execute_Array);
				foreach($results as $rows)
					{
						$Merchant_ID_Array[] = $rows->ID;
						$Merchant_Sender_Name[] = $rows->Sender_Name;
					}
				$this->registry->template->Merchant_ID_Array = $Merchant_ID_Array;
				$this->registry->template->Merchant_Sender_Name = $Merchant_Sender_Name;
				$this->registry->template->show('coupons/display_merchant');
			}
		public function display_msgs()
			{
				$Display = new sql();
				$Merchant_ID = $_POST['Merchant_ID'];
				if(isset($_SESSION['Arabic']))
					{
						
						$Table_Offers = 'offers';
					}
				else
					{
						
						$Table_Offers = 'offers_english';
					}
				$sql = 'SELECT ID,Offer_Title FROM '.$Table_Offers.' WHERE Ads_Sub_Cat = ? AND Status = ? AND AID = ?';
				$Execute_Array = array('4','1',$Merchant_ID);
				$results =  $Display->Display_Info($sql,$Execute_Array);
				$OID_Array = array();
				$OID_Title_Array = array();
				foreach($results as $rows)
					{
						$OID_Array[] = $rows->ID;
						$OID_Title_Array[] = stripslashes($rows->Offer_Title);
					}
				$this->registry->template->OID_Array = $OID_Array;
				$this->registry->template->OID_Title_Array = $OID_Title_Array;
				$this->registry->template->show('coupons/display_msgs');
			}
}

?>
