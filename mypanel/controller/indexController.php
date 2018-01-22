<?php

class indexController extends baseController {

public function index() {
	$myfunctions = new myfunctions();
	$Is_Laget = $myfunctions->Is_Laget();
	$Is_Level_Set = $myfunctions->Is_Level_Set();
	if(($Is_Laget)&&($Is_Level_Set))
		{
			$this->registry->template->show('index_user');
		}
	else
		{
			$this->registry->template->show('home_page');
		}
}

public function login() {
	/*** set a template variable ***/
        $User_Name = $_POST['User_Name'];
		$PW = $_POST['PW'];
		$LogIn = new verify_login();
		$LogIn->verify_pw($User_Name,$PW);
}
public function welcome()
	{
		$Display = new sql();
		$Today = date('Y-m-d');
		$OID = $_SESSION['User_ID'];
		$Action_Time = date('Y-m-d G:i:s');
		$Display->create_log($OID,'users','4',$Action_Time,$OID,'logged in');
		
		$sql = 'SELECT ID FROM mobile_users WHERE Country_ID = ? AND Status = ?';
		$Execute_Array = array('18','1'); //Jordan
		$Jordan_Users = $Display->Total_Records($sql,$Execute_Array);
		$this->registry->template->Jordan_Users = $Jordan_Users;
		
		$sql = 'SELECT ID FROM mobile_users WHERE Country_ID = ? AND Status = ?';
		$Execute_Array = array('19','1'); //KSA
		$KSA_Users = $Display->Total_Records($sql,$Execute_Array);
		$this->registry->template->KSA_Users = $KSA_Users;
		//Array assignments:
		//##########################################################
		$MID_Array = array();
		$SID_Array = array();
		$Service_Name_Array = array();
		$Cat_ID_Array = array();
		//##########################################################
		
			
		$sql_jor = 'SELECT ID FROM users WHERE Country = ? AND Status = ? AND Level = ? AND End_Date > ?';
		$Execute_Array = array('18','1','2',$Today); //Jordan
		$Jordan_Merchants = $Display->Total_Records($sql_jor,$Execute_Array);
		$this->registry->template->Jordan_Merchants = $Jordan_Merchants;
		
		$sql_jor = 'SELECT ID FROM users WHERE Country = ? AND Status = ? AND Level = ? AND End_Date > ?';
		$Execute_Array = array('19','1','2',$Today); //KSA
		$KSA_Merchants = $Display->Total_Records($sql_jor,$Execute_Array);
		$this->registry->template->KSA_Merchants = $KSA_Merchants;
		
		$Grand_Total_Mobile = $Jordan_Users + $KSA_Users;
		$this->registry->template->Grand_Total_Mobile = $Grand_Total_Mobile;
		$Grand_Total_Merchants = $KSA_Merchants + $Jordan_Merchants;
		$this->registry->template->Grand_Total_Merchants = $Grand_Total_Merchants;
		$this->registry->template->Jordan_Users = $Jordan_Users;
		$this->registry->template->KSA_Users = $KSA_Users;
		$this->registry->template->Jordan_Merchants = $Jordan_Merchants;
		$this->registry->template->KSA_Merchants = $KSA_Merchants;
		$this->registry->template->Grand_Total_Mobile = $Grand_Total_Mobile;
		$this->registry->template->Grand_Total_Merchants = $Grand_Total_Merchants;
		$Restaurant_Discount_Card = 0;
		$Restaurant_Sales = 0;
		$Restaurant_Offers = 0;
		$Restaurant_New_Arrivals = 0;
		$Coffee_Shop_Discount_Card = 0;
		$Coffee_Shop_Sales = 0;
		$Coffee_Shop_Offers = 0;
		$Coffee_Shop_New_Arrivals = 0;
		$Electronics_Discount_Card = 0;
		$Electronics_Sales = 0;
		$Electronics_Offers = 0;
		$Electronics_New_Arrivals = 0;
		$Tourism_Discount_Card = 0;
		$Tourism_Sales = 0;
		$Tourism_Offers = 0;
		$Tourism_New_Arrivals = 0;
		$Hajj_Discount_Card = 0;
		$Hajj_Sales = 0;
		$Hajj_Offers = 0;
		$Hajj_New_Arrivals = 0;
		$Sport_Discount_Card = 0;
		$Sport_Sales = 0;
		$Sport_Offers = 0;
		$Sport_New_Arrivals = 0;
		$Entertainment_Discount_Card = 0;
		$Entertainment_Sales = 0;
		$Entertainment_Offers = 0;
		$Entertainment_New_Arrivals = 0;
		$Gifts_Discount_Card = 0;
		$Gifts_Sales = 0;
		$Gifts_Offers = 0;
		$Gifts_New_Arrivals = 0;
		$Clothes_Discount_Card = 0;
		$Clothes_Sales = 0;
		$Clothes_Offers = 0;
		$Clothes_New_Arrivals = 0;
		$Furniture_Discount_Card = 0;
		$Furniture_Sales = 0;
		$Furniture_Offers = 0;
		$Furniture_New_Arrivals = 0;
		$Access_Discount_Card = 0;
		$Access_Sales = 0;
		$Access_Offers = 0;
		$Access_New_Arrivals = 0;
		$Daily_Discount_Card = 0;
		$Daily_Sales = 0;
		$Daily_Offers = 0;
		$Daily_New_Arrivals = 0;
									
										
		$KSA_Restaurant_Discount_Card = 0;
		$KSA_Restaurant_Sales = 0;
		$KSA_Restaurant_Offers = 0;
		$KSA_Restaurant_New_Arrivals = 0;
		$KSA_Coffee_Shop_Discount_Card = 0;
		$KSA_Coffee_Shop_Sales = 0;
		$KSA_Coffee_Shop_Offers = 0;
		$KSA_Coffee_Shop_New_Arrivals = 0;
		$KSA_Electronics_Discount_Card = 0;
		$KSA_Electronics_Sales = 0;
		$KSA_Electronics_Offers = 0;
		$KSA_Electronics_New_Arrivals = 0;
		$KSA_Tourism_Discount_Card = 0;
		$KSA_Tourism_Sales = 0;
		$KSA_Tourism_Offers = 0;
		$KSA_Tourism_New_Arrivals = 0;
		$KSA_Hajj_Discount_Card = 0;
		$KSA_Hajj_Sales = 0;
		$KSA_Hajj_Offers = 0;
		$KSA_Hajj_New_Arrivals = 0;
		$KSA_Sport_Discount_Card = 0;
		$KSA_Sport_Sales = 0;
		$KSA_Sport_Offers = 0;
		$KSA_Sport_New_Arrivals = 0;
		$KSA_Entertainment_Discount_Card = 0;
		$KSA_Entertainment_Sales = 0;
		$KSA_Entertainment_Offers = 0;
		$KSA_Entertainment_New_Arrivals = 0;
		$KSA_Gifts_Discount_Card = 0;
		$KSA_Gifts_Sales = 0;
		$KSA_Gifts_Offers = 0;
		$KSA_Gifts_New_Arrivals = 0;
		$KSA_Clothes_Discount_Card = 0;
		$KSA_Clothes_Sales = 0;
		$KSA_Clothes_Offers = 0;
		$KSA_Clothes_New_Arrivals = 0;
		$KSA_Furniture_Discount_Card = 0;
		$KSA_Furniture_Sales = 0;
		$KSA_Furniture_Offers = 0;
		$KSA_Furniture_New_Arrivals = 0;
		$KSA_Access_Discount_Card = 0;
		$KSA_Access_Sales = 0;
		$KSA_Access_Offers = 0;
		$KSA_Access_New_Arrivals = 0;
		$KSA_Daily_Discount_Card = 0;
		$KSA_Daily_Sales = 0;
		$KSA_Daily_Offers = 0;
		$KSA_Daily_New_Arrivals = 0;
									
		
		
		
		$sql = 'SELECT offers_english.AID,offers_english.Ads_Sub_Cat FROM offers_english WHERE offers_english.Status = ? ORDER BY offers_english.Ads_Sub_Cat';
		$Execute_Array = array('1');
		$results = $Display->Display_Info($sql,$Execute_Array);
		foreach($results as $rows)
			{
				$sql_users = 'SELECT Ads_Cat FROM users WHERE ID = ? AND Status = ? AND Country = ?';
				$Execute_Array = array($rows->AID,'1','18');
				$results_users = $Display->Display_Info($sql_users,$Execute_Array);
				foreach($results_users as $rows_users)
					{
						switch($rows_users->Ads_Cat)
							{
								case '3':
								if($rows->Ads_Sub_Cat == '4')
									{
										$Restaurant_Discount_Card++;
									}
								elseif($rows->Ads_Sub_Cat == '5')
									{
										$Restaurant_Sales++;
									}
								elseif($rows->Ads_Sub_Cat == '7')
									{
										$Restaurant_Offers++;
									}
								else
									{
										$Restaurant_New_Arrivals++;
									}
								break;
								
								case '8':
								if($rows->Ads_Sub_Cat == '4')
									{
										$Coffee_Shop_Discount_Card++;
									}
								elseif($rows->Ads_Sub_Cat == '5')
									{
										$Coffee_Shop_Sales++;
									}
								elseif($rows->Ads_Sub_Cat == '7')
									{
										$Coffee_Shop_Offers++;
									}
								else
									{
										$Coffee_Shop_New_Arrivals++;
									}
								break; 
								
								case '9': //Electronics
								if($rows->Ads_Sub_Cat == '4')
									{
										$Electronics_Discount_Card++;
									}
								elseif($rows->Ads_Sub_Cat == '5')
									{
										$Electronics_Sales++;
									}
								elseif($rows->Ads_Sub_Cat == '7')
									{
										$Electronics_Offers++;
									}
								else
									{
										$Electronics_New_Arrivals++;
									}
								break; 
								
								case '11': //Tourism
								if($rows->Ads_Sub_Cat == '4')
									{
										$Tourism_Discount_Card++;
									}
								elseif($rows->Ads_Sub_Cat == '5')
									{
										$Tourism_Sales++;
									}
								elseif($rows->Ads_Sub_Cat == '7')
									{
										$Tourism_Offers++;
									}
								else
									{
										$Tourism_New_Arrivals++;
									}
								break; 
								
								case '12': //Hajj
								if($rows->Ads_Sub_Cat == '4')
									{
										$Hajj_Discount_Card++;
									}
								elseif($rows->Ads_Sub_Cat == '5')
									{
										$Hajj_Sales++;
									}
								elseif($rows->Ads_Sub_Cat == '7')
									{
										$Hajj_Offers++;
									}
								else
									{
										$Hajj_New_Arrivals++;
									}
								break; 
								
								case '15': //Sport
								if($rows->Ads_Sub_Cat == '4')
									{
										$Sport_Discount_Card++;
									}
								elseif($rows->Ads_Sub_Cat == '5')
									{
										$Sport_Sales++;
									}
								elseif($rows->Ads_Sub_Cat == '7')
									{
										$Sport_Offers++;
									}
								else
									{
										$Sport_New_Arrivals++;
									}
								break; 
								
								case '16': //Entertainment
								if($rows->Ads_Sub_Cat == '4')
									{
										$Entertainment_Discount_Card++;
									}
								elseif($rows->Ads_Sub_Cat == '5')
									{
										$Entertainment_Sales++;
									}
								elseif($rows->Ads_Sub_Cat == '7')
									{
										$Entertainment_Offers++;
									}
								else
									{
										$Entertainment_New_Arrivals++;
									}
								break; 
								
								case '17': //Gifts
								if($rows->Ads_Sub_Cat == '4')
									{
										$Gifts_Discount_Card++;
									}
								elseif($rows->Ads_Sub_Cat == '5')
									{
										$Gifts_Sales++;
									}
								elseif($rows->Ads_Sub_Cat == '7')
									{
										$Gifts_Offers++;
									}
								else
									{
										$Gifts_New_Arrivals++;
									}
								break; 
								
								case '13': //Clothes
								if($rows->Ads_Sub_Cat == '4')
									{
										$Clothes_Discount_Card++;
									}
								elseif($rows->Ads_Sub_Cat == '5')
									{
										$Clothes_Sales++;
									}
								elseif($rows->Ads_Sub_Cat == '7')
									{
										$Clothes_Offers++;
									}
								else
									{
										$Clothes_New_Arrivals++;
									}
								break; 
								
								case '18': //Furniture
								if($rows->Ads_Sub_Cat == '4')
									{
										$Furniture_Discount_Card++;
									}
								elseif($rows->Ads_Sub_Cat == '5')
									{
										$Furniture_Sales++;
									}
								elseif($rows->Ads_Sub_Cat == '7')
									{
										$Furniture_Offers++;
									}
								else
									{
										$Furniture_New_Arrivals++;
									}
								break; 
								
								case '14': //Access
								if($rows->Ads_Sub_Cat == '4')
									{
										$Access_Discount_Card++;
									}
								elseif($rows->Ads_Sub_Cat == '5')
									{
										$Access_Sales++;
									}
								elseif($rows->Ads_Sub_Cat == '7')
									{
										$Access_Offers++;
									}
								else
									{
										$Access_New_Arrivals++;
									}
								break; 
								
								case '10': //Access
								if($rows->Ads_Sub_Cat == '4')
									{
										$Daily_Discount_Card++;
									}
								elseif($rows->Ads_Sub_Cat == '5')
									{
										$Daily_Sales++;
									}
								elseif($rows->Ads_Sub_Cat == '7')
									{
										$Daily_Offers++;
									}
								else
									{
										$Daily_New_Arrivals++;
									}
								break; 
								
								default:
								echo 'No record found';
								
							}
					}
				
				$sql_users_KSA = 'SELECT Ads_Cat FROM users WHERE ID = ? AND Status = ? AND Country = ?';
				$Execute_Array = array($rows->AID,'1','19');
				$results_users_KSA = $Display->Display_Info($sql_users_KSA,$Execute_Array);
				foreach($results_users_KSA as $rows_users_KSA)
					{
						switch($rows_users_KSA->Ads_Cat)
							{
								case '3':
								if($rows->Ads_Sub_Cat == '4')
									{
										$KSA_Restaurant_Discount_Card++;
									}
								elseif($rows->Ads_Sub_Cat == '5')
									{
										$KSA_Restaurant_Sales++;
									}
								elseif($rows->Ads_Sub_Cat == '7')
									{
										$KSA_Restaurant_Offers++;
									}
								else
									{
										$KSA_Restaurant_New_Arrivals++;
									}
								break;
								
								case '8':
								if($rows->Ads_Sub_Cat == '4')
									{
										$KSA_Coffee_Shop_Discount_Card++;
									}
								elseif($rows->Ads_Sub_Cat == '5')
									{
										$KSA_Coffee_Shop_Sales++;
									}
								elseif($rows->Ads_Sub_Cat == '7')
									{
										$KSA_Coffee_Shop_Offers++;
									}
								else
									{
										$KSA_Coffee_Shop_New_Arrivals++;
									}
								break; 
								
								case '9': //Electronics
								if($rows->Ads_Sub_Cat == '4')
									{
										$KSA_Electronics_Discount_Card++;
									}
								elseif($rows->Ads_Sub_Cat == '5')
									{
										$KSA_Electronics_Sales++;
									}
								elseif($rows->Ads_Sub_Cat == '7')
									{
										$KSA_Electronics_Offers++;
									}
								else
									{
										$KSA_Electronics_New_Arrivals++;
									}
								break; 
								
								case '11': //Tourism
								if($rows->Ads_Sub_Cat == '4')
									{
										$KSA_Tourism_Discount_Card++;
									}
								elseif($rows->Ads_Sub_Cat == '5')
									{
										$KSA_Tourism_Sales++;
									}
								elseif($rows->Ads_Sub_Cat == '7')
									{
										$KSA_Tourism_Offers++;
									}
								else
									{
										$KSA_Tourism_New_Arrivals++;
									}
								break; 
								
								case '12': //Hajj
								if($rows->Ads_Sub_Cat == '4')
									{
										$KSA_Hajj_Discount_Card++;
									}
								elseif($rows->Ads_Sub_Cat == '5')
									{
										$KSA_Hajj_Sales++;
									}
								elseif($rows->Ads_Sub_Cat == '7')
									{
										$KSA_Hajj_Offers++;
									}
								else
									{
										$KSA_Hajj_New_Arrivals++;
									}
								break; 
								
								case '15': //Sport
								if($rows->Ads_Sub_Cat == '4')
									{
										$KSA_Sport_Discount_Card++;
									}
								elseif($rows->Ads_Sub_Cat == '5')
									{
										$KSA_Sport_Sales++;
									}
								elseif($rows->Ads_Sub_Cat == '7')
									{
										$KSA_Sport_Offers++;
									}
								else
									{
										$KSA_Sport_New_Arrivals++;
									}
								break; 
								
								case '16': //Entertainment
								if($rows->Ads_Sub_Cat == '4')
									{
										$KSA_Entertainment_Discount_Card++;
									}
								elseif($rows->Ads_Sub_Cat == '5')
									{
										$KSA_Entertainment_Sales++;
									}
								elseif($rows->Ads_Sub_Cat == '7')
									{
										$KSA_Entertainment_Offers++;
									}
								else
									{
										$KSA_Entertainment_New_Arrivals++;
									}
								break; 
								
								case '17': //Gifts
								if($rows->Ads_Sub_Cat == '4')
									{
										$KSA_Gifts_Discount_Card++;
									}
								elseif($rows->Ads_Sub_Cat == '5')
									{
										$KSA_Gifts_Sales++;
									}
								elseif($rows->Ads_Sub_Cat == '7')
									{
										$KSA_Gifts_Offers++;
									}
								else
									{
										$KSA_Gifts_New_Arrivals++;
									}
								break; 
								
								case '13': //Clothes
								if($rows->Ads_Sub_Cat == '4')
									{
										$KSA_Clothes_Discount_Card++;
									}
								elseif($rows->Ads_Sub_Cat == '5')
									{
										$KSA_Clothes_Sales++;
									}
								elseif($rows->Ads_Sub_Cat == '7')
									{
										$KSA_Clothes_Offers++;
									}
								else
									{
										$KSA_Clothes_New_Arrivals++;
									}
								break; 
								
								case '18': //Furniture
								if($rows->Ads_Sub_Cat == '4')
									{
										$KSA_Furniture_Discount_Card++;
									}
								elseif($rows->Ads_Sub_Cat == '5')
									{
										$KSA_Furniture_Sales++;
									}
								elseif($rows->Ads_Sub_Cat == '7')
									{
										$KSA_Furniture_Offers++;
									}
								else
									{
										$KSA_Furniture_New_Arrivals++;
									}
								break; 
								
								case '14': //Access
								if($rows->Ads_Sub_Cat == '4')
									{
										$KSA_Access_Discount_Card++;
									}
								elseif($rows->Ads_Sub_Cat == '5')
									{
										$KSA_Access_Sales++;
									}
								elseif($rows->Ads_Sub_Cat == '7')
									{
										$KSA_Access_Offers++;
									}
								else
									{
										$KSA_Access_New_Arrivals++;
									}
								break; 
								
								case '10': //Daily
								if($rows->Ads_Sub_Cat == '4')
									{
										$KSA_Daily_Discount_Card++;
									}
								elseif($rows->Ads_Sub_Cat == '5')
									{
										$KSA_Daily_Sales++;
									}
								elseif($rows->Ads_Sub_Cat == '7')
									{
										$KSA_Daily_Offers++;
									}
								else
									{
										$KSA_Daily_New_Arrivals++;
									}
								break; 
								default:
								echo 'No record found';
								
							}
					}
			}
		$this->registry->template->Restaurant_Discount_Card = $Restaurant_Discount_Card;
		$this->registry->template->Restaurant_Sales = $Restaurant_Sales;
		$this->registry->template->Restaurant_Offers = $Restaurant_Offers;
		$this->registry->template->Restaurant_New_Arrivals = $Restaurant_New_Arrivals;
		$this->registry->template->Coffee_Shop_Discount_Card = $Coffee_Shop_Discount_Card;
		$this->registry->template->Coffee_Shop_Sales = $Coffee_Shop_Sales;
		$this->registry->template->Coffee_Shop_Offers = $Coffee_Shop_Offers;
		$this->registry->template->Coffee_Shop_New_Arrivals = $Coffee_Shop_New_Arrivals;
		$this->registry->template->Electronics_Discount_Card = $Electronics_Discount_Card;
		$this->registry->template->Electronics_Sales = $Electronics_Sales;
		$this->registry->template->Electronics_Offers = $Electronics_Offers;
		$this->registry->template->Electronics_New_Arrivals = $Electronics_New_Arrivals;
		$this->registry->template->Tourism_Discount_Card = $Tourism_Discount_Card;
		$this->registry->template->Tourism_Sales = $Tourism_Sales;
		$this->registry->template->Tourism_Offers = $Tourism_Offers;
		$this->registry->template->Tourism_New_Arrivals = $Tourism_New_Arrivals;
		$this->registry->template->Hajj_Discount_Card = $Hajj_Discount_Card;
		$this->registry->template->Hajj_Sales = $Hajj_Sales;
		$this->registry->template->Hajj_Offers = $Hajj_Offers;
		$this->registry->template->Hajj_New_Arrivals = $Hajj_New_Arrivals;
		$this->registry->template->Sport_Discount_Card = $Sport_Discount_Card;
		$this->registry->template->Sport_Sales = $Sport_Sales;
		$this->registry->template->Sport_Offers = $Sport_Offers;
		$this->registry->template->Sport_New_Arrivals = $Sport_New_Arrivals;
		$this->registry->template->Entertainment_Discount_Card = $Entertainment_Discount_Card;
		$this->registry->template->Entertainment_Sales = $Entertainment_Sales;
		$this->registry->template->Entertainment_Offers = $Entertainment_Offers;
		$this->registry->template->Entertainment_New_Arrivals = $Entertainment_New_Arrivals;
		$this->registry->template->Gifts_Discount_Card = $Gifts_Discount_Card;
		$this->registry->template->Gifts_Sales = $Gifts_Sales;
		$this->registry->template->Gifts_Offers = $Gifts_Offers;
		$this->registry->template->Gifts_New_Arrivals = $Gifts_New_Arrivals;
		$this->registry->template->Clothes_Discount_Card = $Clothes_Discount_Card;
		$this->registry->template->Clothes_Sales = $Clothes_Sales;
		$this->registry->template->Clothes_Offers = $Clothes_Offers;
		$this->registry->template->Clothes_New_Arrivals = $Clothes_New_Arrivals;
		$this->registry->template->Furniture_Discount_Card = $Furniture_Discount_Card;
		$this->registry->template->Furniture_Sales = $Furniture_Sales;
		$this->registry->template->Furniture_Offers = $Furniture_Offers;
		$this->registry->template->Furniture_New_Arrivals = $Furniture_New_Arrivals;
		$this->registry->template->Access_Discount_Card = $Access_Discount_Card;
		$this->registry->template->Access_Sales = $Access_Sales;
		$this->registry->template->Access_Offers = $Access_Offers;
		$this->registry->template->Access_New_Arrivals = $Access_New_Arrivals;
		$this->registry->template->Daily_Discount_Card = $Daily_Discount_Card;
		$this->registry->template->Daily_Sales = $Daily_Sales;
		$this->registry->template->Daily_Offers = $Daily_Offers;
		$this->registry->template->Daily_New_Arrivals = $Daily_New_Arrivals;
		
		$this->registry->template->KSA_Restaurant_Discount_Card = $KSA_Restaurant_Discount_Card;
		$this->registry->template->KSA_Restaurant_Sales = $KSA_Restaurant_Sales;
		$this->registry->template->KSA_Restaurant_Offers = $KSA_Restaurant_Offers;
		$this->registry->template->KSA_Restaurant_New_Arrivals = $KSA_Restaurant_New_Arrivals;
		$this->registry->template->KSA_Coffee_Shop_Discount_Card = $KSA_Coffee_Shop_Discount_Card;
		$this->registry->template->KSA_Coffee_Shop_Sales = $KSA_Coffee_Shop_Sales;
		$this->registry->template->KSA_Coffee_Shop_Offers = $KSA_Coffee_Shop_Offers;
		$this->registry->template->KSA_Coffee_Shop_New_Arrivals = $KSA_Coffee_Shop_New_Arrivals;
		$this->registry->template->KSA_Electronics_Discount_Card = $KSA_Electronics_Discount_Card;
		$this->registry->template->KSA_Electronics_Sales = $KSA_Electronics_Sales;
		$this->registry->template->KSA_Electronics_Offers = $KSA_Electronics_Offers;
		$this->registry->template->KSA_Electronics_New_Arrivals = $KSA_Electronics_New_Arrivals;
		$this->registry->template->KSA_Tourism_Discount_Card = $KSA_Tourism_Discount_Card;
		$this->registry->template->KSA_Tourism_Sales = $KSA_Tourism_Sales;
		$this->registry->template->KSA_Tourism_Offers = $KSA_Tourism_Offers;
		$this->registry->template->KSA_Tourism_New_Arrivals = $KSA_Tourism_New_Arrivals;
		$this->registry->template->KSA_Hajj_Discount_Card = $KSA_Hajj_Discount_Card;
		$this->registry->template->KSA_Hajj_Sales = $KSA_Hajj_Sales;
		$this->registry->template->KSA_Hajj_Offers = $KSA_Hajj_Offers;
		$this->registry->template->KSA_Hajj_New_Arrivals = $KSA_Hajj_New_Arrivals;
		$this->registry->template->KSA_Sport_Discount_Card = $KSA_Sport_Discount_Card;
		$this->registry->template->KSA_Sport_Sales = $KSA_Sport_Sales;
		$this->registry->template->KSA_Sport_Offers = $KSA_Sport_Offers;
		$this->registry->template->KSA_Sport_New_Arrivals = $KSA_Sport_New_Arrivals;
		$this->registry->template->KSA_Entertainment_Discount_Card = $KSA_Entertainment_Discount_Card;
		$this->registry->template->KSA_Entertainment_Sales = $KSA_Entertainment_Sales;
		$this->registry->template->KSA_Entertainment_Offers = $KSA_Entertainment_Offers;
		$this->registry->template->KSA_Entertainment_New_Arrivals = $KSA_Entertainment_New_Arrivals;
		$this->registry->template->KSA_Gifts_Discount_Card = $KSA_Gifts_Discount_Card;
		$this->registry->template->KSA_Gifts_Sales = $KSA_Gifts_Sales;
		$this->registry->template->KSA_Gifts_Offers = $KSA_Gifts_Offers;
		$this->registry->template->KSA_Gifts_New_Arrivals = $KSA_Gifts_New_Arrivals;
		$this->registry->template->KSA_Clothes_Discount_Card = $KSA_Clothes_Discount_Card;
		$this->registry->template->KSA_Clothes_Sales = $KSA_Clothes_Sales;
		$this->registry->template->KSA_Clothes_Offers = $KSA_Clothes_Offers;
		$this->registry->template->KSA_Clothes_New_Arrivals = $KSA_Clothes_New_Arrivals;
		$this->registry->template->KSA_Furniture_Discount_Card = $KSA_Furniture_Discount_Card;
		$this->registry->template->KSA_Furniture_Sales = $KSA_Furniture_Sales;
		$this->registry->template->KSA_Furniture_Offers = $KSA_Furniture_Offers;
		$this->registry->template->KSA_Furniture_New_Arrivals = $KSA_Furniture_New_Arrivals;
		$this->registry->template->KSA_Access_Discount_Card = $KSA_Access_Discount_Card;
		$this->registry->template->KSA_Access_Sales = $KSA_Access_Sales;
		$this->registry->template->KSA_Access_Offers = $KSA_Access_Offers;
		$this->registry->template->KSA_Access_New_Arrivals = $KSA_Access_New_Arrivals;
		$this->registry->template->KSA_Daily_Discount_Card = $KSA_Daily_Discount_Card;
		$this->registry->template->KSA_Daily_Sales = $KSA_Daily_Sales;
		$this->registry->template->KSA_Daily_Offers = $KSA_Daily_Offers;
		$this->registry->template->KSA_Daily_New_Arrivals = $KSA_Daily_New_Arrivals;
		$this->registry->template->show('welcome');
	}
public function expired_member()
	{
		if(isset($_SESSION['Expired_Info']))
			{
				if($_SESSION['Expired_Info'])
					{
					?>
					<div align="center" style="font-family:'Times New Roman', Times, serif; font-size:18px; color:#FF0000 ">
					<div>لــقــد إنـتـهــى إشـتـراكـك بـتـاريــخ</div>
					<div><?php echo $_SESSION['Expiration_Date'];?></div>
					<div>الــرجــاء تـجـديـد الإشـتـراك</div>
					</div>
					<?php
					}
			}
	}
}

?>
