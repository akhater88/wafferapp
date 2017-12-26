 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
$Allowed_Users = array('2');
validate_roles_new::validate($Allowed_Users);
class advertisersController extends baseController {
			
		public function index() 
			{
				
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
				
				if(count($results))
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
				$this->registry->template->ID = $ID;
				if(isset($_SESSION['Arabic']))
					{
						$Table = 'offers';
						
						$Table_City = 'city';
						$Table_Services = 'merchant_services';
					}
				else
					{
						$Table = 'offers_english';
						
						$Table_City = 'city_english';
						$Table_Services = 'merchant_services_english';
					}
				$sql = 'SELECT Country FROM users WHERE ID = ?';
				$Execute_Array = array($OID);
				$CID = $Display->Display_Single_Info_Modified($sql,'Country',$Execute_Array);
				
				$sql_city = 'SELECT ID,City_Name FROM '.$Table_City.' WHERE CID = ? AND Status = ?';
				$Execute_Array = array($CID,'1');
				$this->registry->template->results_city = $Display->Display_Info($sql_city,$Execute_Array);
				
				
				
				$sql = 'SELECT ID,Ads_Sub_Cat,Offer_Title,Offer_Content,Start_Date,End_Date,City FROM '.$Table.' WHERE ID = ?';
				$Execute_Array = array($ID);
				$this->registry->template->results = $Display->Display_Info($sql,$Execute_Array);
				
				$sql = 'SELECT ID,SID FROM '.$Table_Services.' WHERE MID = ? AND Status = ?';
				$Execute_Array = array($OID,'1');
				$this->registry->template->results_services = $Display->Display_Info($sql,$Execute_Array);
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
						
						$Table_City = 'city';
						$Table_Services = 'merchant_services';
					}
				else
					{
						
						$Table_City = 'city_english';
						$Table_Services = 'merchant_services_english';
					}
				$sql = 'SELECT Country FROM users WHERE ID = ?';
				$Execute_Array = array($OID);
				$CID = $Display->Display_Single_Info_Modified($sql,'Country',$Execute_Array);
				
				$sql_city = 'SELECT ID,City_Name FROM '.$Table_City.' WHERE CID = ? AND Status = ?';
				$Execute_Array = array($CID,'1');
				$this->registry->template->results_city = $Display->Display_Info($sql_city,$Execute_Array);
				
				$sql = 'SELECT ID,SID FROM '.$Table_Services.' WHERE MID = ? AND Status = ?';
				$Execute_Array = array($OID,'1');
				$this->registry->template->results_services = $Display->Display_Info($sql,$Execute_Array);
				$this->registry->template->show('advertisers/add_offer');
			}
		public function submit_edit_offer()
			{
				$Display = new sql();
				$validate = new validate_new();
				if(isset($_SESSION['Arabic']))
					{
						$Table = 'offers';
					}
				else
					{
						$Table = 'offers_english';
					}
				$MY_ID = $_SESSION['User_ID'];
				$sql = 'SELECT End_Date FROM users WHERE ID = ?';
				$Execute_Array = array($MY_ID);
				$End_Date_Membership = $Display->Display_Single_Info_Modified($sql,'End_Date',$Execute_Array);
				$End_Date_Membership_String = strtotime($End_Date_Membership);
				$OID = $_SESSION['User_ID'];
				$ID = $_POST['ID'];
				$Offer_Title = trim(strip_tags($_POST['Offer_Title']));
				$Offer_Content = $_POST['Offer_Content'];
				$Time_Stamp = $_POST['Time_Stamp'];
				$Start_Date = $_POST['Start_Date'];
				$End_Date = $_POST['End_Date'];
				$End_Date_String = strtotime($End_Date);
				$Ads_Sub_Cat = $_POST['Ads_Sub_Cat'];
				$City = $_POST['City'];
				$Starts_Date_String = strtotime($Start_Date);
				$End_Date_String = strtotime($End_Date);
				$Offer_Content_Stripped = trim(strip_tags($Offer_Content));
				$Offer_Content_Stripped_Length = strlen($Offer_Content_Stripped);
				$Item_Exists_Modified_JSON = $validate->Item_Exists_Edit_Modified_JSON_Edit('offers','Offer_Title',$ID,$Offer_Title,$OID);
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
				elseif($Offer_Content_Stripped_Length > 100)
					{
						$myTweets = array("flag" => '5');
						$Display->Write_JSON($Time_Stamp,$myTweets);
					}
				elseif(!$Ads_Sub_Cat)
					{
						$myTweets = array("flag" => '6');
						$Display->Write_JSON($Time_Stamp,$myTweets);
					}
				elseif(!$City)
					{
						$myTweets = array("flag" => '7');
						$Display->Write_JSON($Time_Stamp,$myTweets);
					}
				elseif($End_Date_String > $End_Date_Membership_String)
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
						$Offer_Content = htmlentities($Offer_Content,ENT_QUOTES,'UTF-8');
						$sql = 'UPDATE '.$Table.' SET Ads_Sub_Cat=?,Offer_Title = ?,Offer_Content = ?,Start_Date = ?,End_Date = ?, City = ? WHERE ID = ?';
						$Execute_Array = array($Ads_Sub_Cat,$Offer_Title,$Offer_Content,$Start_Date,$End_Date,$City,$ID);
						$Display->Execute($sql,$Execute_Array);
						$Action_Time = date('Y-m-d G:i:s');
						$Display->create_log($ID,$Table,'2',$Action_Time,$OID,'Edited a voucher');
					}
			}
		public function submit_new_offer()
			{
				$Display = new sql();
				$validate = new validate_new();
				if(isset($_SESSION['Arabic']))
					{
						$Table = 'offers';
					}
				else
					{
						$Table = 'offers_english';
					}
				$MY_ID = $_SESSION['User_ID'];
				$sql = 'SELECT End_Date FROM users WHERE ID = ?';
				$Execute_Array = array($MY_ID);
				$End_Date_Membership = $Display->Display_Single_Info_Modified($sql,'End_Date',$Execute_Array);
				$End_Date_Membership_String = strtotime($End_Date_Membership);
				//Continue with code to make sure that end date for membership doesn't expire before the end date of ad's expiration date
				$OID = $_SESSION['User_ID'];
				$Offer_Title = trim(strip_tags($_POST['Offer_Title']));
				$Offer_Content = $_POST['Offer_Content'];
				$Time_Stamp = $_POST['Time_Stamp'];
				$Start_Date = $_POST['Start_Date'];
				$End_Date = $_POST['End_Date'];
				$End_Date_String = strtotime($End_Date);
				$Ads_Sub_Cat = $_POST['Ads_Sub_Cat'];
				$City = $_POST['City'];
				$Starts_Date_String = strtotime($Start_Date);
				$End_Date_String = strtotime($End_Date);
				$Offer_Content_Stripped = trim(strip_tags($Offer_Content));
				$Offer_Content_Stripped_Length = strlen($Offer_Content_Stripped);
				$Item_Exists_Modified_JSON = $validate->Item_Exists_Modified_JSON('offers','Offer_Title',$Offer_Title);
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
				elseif($Offer_Content_Stripped_Length > 100)
					{
						$myTweets = array("flag" => '5');
						$Display->Write_JSON($Time_Stamp,$myTweets);
					}
				elseif(!$Ads_Sub_Cat)
					{
						$myTweets = array("flag" => '6');
						$Display->Write_JSON($Time_Stamp,$myTweets);
					}
				elseif(!$City)
					{
						$myTweets = array("flag" => '7');
						$Display->Write_JSON($Time_Stamp,$myTweets);
					}
				elseif($End_Date_String > $End_Date_Membership_String)
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
						$Offer_Content = htmlentities($Offer_Content,ENT_QUOTES,'UTF-8');
						$sql = 'INSERT INTO '.$Table.' (AID,Ads_Sub_Cat,Offer_Title,Offer_Content,Start_Date,End_Date,City,Status) VALUES (?,?,?,?,?,?,?,?)';
						$Execute_Array = array($OID,$Ads_Sub_Cat,$Offer_Title,$Offer_Content,$Start_Date,$End_Date,$City,'2');
						$RID = $Display->Execute($sql,$Execute_Array,'1',$Table);
						$Action_Time = date('Y-m-d G:i:s');
						$Display->create_log($RID,$Table,'1',$Action_Time,$OID,'added new voucher');
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
				$sql = 'SELECT First_Name,user_name,Company_Name,Phone_Number,Cell_Phone FROM users WHERE ID = ?';
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
				$Display->Delete_JSON($Time_Stamp);
				$Validate_Email = $validate->Validate_Email($user_name);
				
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
				else
					{
						$myTweets = array("flag" => '0');
						$Display->Write_JSON($Time_Stamp,$myTweets);
						$Starts_Date = date('Y-m-d',strtotime($Starts_Date));
						$End_Date = date('Y-m-d',strtotime($End_Date));
						$sql = 'UPDATE users SET First_Name = ?,user_name = ?,Company_Name = ?,Phone_Number = ?,Cell_Phone = ? WHERE ID = ?';
						$Execute_Array = array($First_Name,$user_name,$Company_Name,$Phone_Number,$Cell_Phone,$ID);
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
			window.location = '<?php echo __LINK_PATH;?>';
			</script>
			<?
		}
}

?>
