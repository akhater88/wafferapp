<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
$Allowed_Users = array('1','2');
validate_roles_new::validate($Allowed_Users);
class statisticsController extends baseController {
			
		public function index() 
			{
				
			}
		public function display_stats_merchant()
			{
				$Display = new sql();
				$Merchant_ID = $_SESSION['User_ID'];
				if(isset($_SESSION['Arabic']))
					{
						$Table = 'offers';
						$Table_Services = 'ads_sub_cat';
					}
				else
					{
						$Table = 'offers_english';
						$Table_Services = 'ads_sub_cat_english';
					}
				$sql = 'SELECT DISTINCT (Ads_Sub_Cat) FROM '.$Table.' WHERE AID = ? AND Status = ?';
				$Execute_Array = array($Merchant_ID,'1');
				$results =  $Display->Display_Info($sql,$Execute_Array);
				$Sub_Cat_ID_Array = array();
				$Sub_Cat_Name = array();
				foreach($results as $rows)
					{
						$Sub_Cat_ID_Array[] = $rows->Ads_Sub_Cat;
						$sql_sub = 'SELECT Sub_Cat_Name FROM '.$Table_Services.' WHERE ID = ?';
						$Execute_Array = array($rows->Ads_Sub_Cat);
						$Sub_Cat_Name[] = $Display->Display_Single_Info_Modified($sql_sub,'Sub_Cat_Name',$Execute_Array);
					}
				$this->registry->template->Sub_Cat_ID_Array = $Sub_Cat_ID_Array;
				$this->registry->template->Sub_Cat_Name = $Sub_Cat_Name;
				$this->registry->template->show('statistics/display_stats_merchant');
			}
		public function display_plot()
			{
				  $Display = new sql();
				  $Offer_ID = $_POST['Offer_ID'];
				  if($Offer_ID)
				  	{
						  $s1 = "[";
						  $ticks = "[";
						  if(isset($_SESSION['Arabic']))
							{
								$Table = 'offers';
							}
						else
							{
								$Table = 'offers_english';
							}
						  $Execute_Array = array($Offer_ID);
						  $sql = 'SELECT Start_Date,End_Date FROM '.$Table.' WHERE ID = ?';
						   $results =  $Display->Display_Info($sql,$Execute_Array);
							 foreach($results as $rows)
								{
									$Start_Date_Original = $rows->Start_Date;
									$End_Date_Original = $rows->End_Date;
									
									$Start_Date_Format_Year = date('Y',strtotime($rows->Start_Date));
									$Start_Date_Format_Month = date('M',strtotime($rows->Start_Date));
									$Start_Date_Format_Day = date('d',strtotime($rows->Start_Date));
									$Start_Date_Formatted = $Start_Date_Format_Month.'<BR />'.$Start_Date_Format_Day.'<BR />'.$Start_Date_Format_Year;
									
									$End_Date_Format_Year = date('Y',strtotime($rows->End_Date));
									$End_Date_Format_Month = date('M',strtotime($rows->End_Date));
									$End_Date_Format_Day = date('d',strtotime($rows->End_Date));
									$End_Date_Formatted = $End_Date_Format_Month.'<BR />'.$End_Date_Format_Day.'<br />'.$End_Date_Format_Year;
								}
						  $Times_Array = array();
						  $MSG_Counter = 0;
						  $sql = 'SELECT ID FROM statistics_english WHERE Time_Stamp = ? AND Message_ID = ?';
						  $Execute_Array = array($Start_Date_Original,$Offer_ID);
						  $Total_Records = $Display->Total_Records($sql,$Execute_Array);
						  $MSG_Counter += $Total_Records;
						  $s1 .= $Total_Records.',';
						  $ticks .= "'$Start_Date_Formatted'".',';
						  $Times_Array[] = $Start_Date_Original;
						  $Times_Array[] = $End_Date_Original;
						
							
						  $sql = 'SELECT DISTINCT (Time_Stamp) FROM statistics_english WHERE Message_ID = ?';
						   $Execute_Array = array($Offer_ID);
						  $Time_Stamp_Array = array();
						  $results =  $Display->Display_Info($sql,$Execute_Array);
						  foreach($results as $rows)
							{
								$Time_Stamp_Array[] = $rows->Time_Stamp;
							}
						  $Counter = 1;
						  $Array_Length = count($Time_Stamp_Array);
						
						
						 
						  foreach($Time_Stamp_Array as $value)
							{
								$sql = 'SELECT ID FROM statistics_english WHERE Time_Stamp = ? AND Message_ID = ?';
								if(!in_array($value,$Times_Array))
									{
										$Times_Array[] = $value;
										$Execute_Array = array($value,$Offer_ID);
										$Total_Records = $Display->Total_Records($sql,$Execute_Array);
										$MSG_Counter += $Total_Records;
										$s1 .= $Total_Records.',';
										$Date_Format_Year = date('Y',strtotime($value));
										$Date_Format_Month = date('M',strtotime($value));
										$Date_Format_Day = date('d',strtotime($value));
										$Date_Formatted = $Date_Format_Month.'<BR />'.$Date_Format_Day.'<BR />'.$Date_Format_Year;
										$ticks .= "'$Date_Formatted'".',';
									}
								$Counter++;
							}
						
						  $sql = 'SELECT ID FROM statistics_english WHERE Time_Stamp = ? AND Message_ID = ?';
						  $Execute_Array = array($End_Date_Original,$Offer_ID);
						  $Total_Records = $Display->Total_Records($sql,$Execute_Array);
						  $MSG_Counter += $Total_Records;
						  $s1 .= $Total_Records;
						  $ticks .= "'$End_Date_Formatted'";
						  
						  $s1 .= "]";
						  $ticks .= "]";
						 $this->registry->template->MSG_Counter = $MSG_Counter;
						  $this->registry->template->s1 = $s1;
						  $this->registry->template->ticks = $ticks;
						  $this->registry->template->show('statistics/display_plot');
					}
			}
		public function display_messages_merchant()
			{
				$Display = new sql();
				$Message_ID = $_POST['Message_ID'];
				$AID = $_SESSION['User_ID'];
				if(isset($_SESSION['Arabic']))
					{
						$Table = 'offers';
					}
				else
					{
						$Table = 'offers_english';
					}
				$sql = 'SELECT ID,Offer_Title FROM '.$Table.' WHERE Ads_Sub_Cat = ? AND Status = ? AND AID = ?';
				$Execute_Array = array($Message_ID,'1',$AID);
				$Offer_ID_Array = array();
				$Offer_Name = array();
				$results =  $Display->Display_Info($sql,$Execute_Array);
				foreach($results as $rows)
					{
						$Offer_ID_Array[] = $rows->ID;
						$Offer_Name[] = $rows->Offer_Title;
					}
				$this->registry->template->Offer_ID_Array = $Offer_ID_Array;
				$this->registry->template->Offer_Name = $Offer_Name;
				$this->registry->template->show('statistics/display_messages_merchant');
			}
		public function display_messages()
			{
				$Display = new sql();
				$Message_ID = $_POST['Message_ID'];
				$AID = $_POST['Merchants'];
				if(isset($_SESSION['Arabic']))
					{
						$Table = 'offers';
					}
				else
					{
						$Table = 'offers_english';
					}
				$sql = 'SELECT ID, Offer_Title FROM '.$Table.' WHERE Ads_Sub_Cat = ? AND Status = ? AND AID = ?';
				$Execute_Array = array($Message_ID,'1',$AID);
				$Offer_ID_Array = array();
				$Offer_Name = array();
				$results =  $Display->Display_Info($sql,$Execute_Array);
				foreach($results as $rows)
					{
						$Offer_ID_Array[] = $rows->ID;
						$Offer_Name[] = $rows->Offer_Title;
					}
				$this->registry->template->Offer_ID_Array = $Offer_ID_Array;
				$this->registry->template->Offer_Name = $Offer_Name;
				$this->registry->template->show('statistics/display_messages');
			}
		public function display_services()
			{
				$Display = new sql();
				$Merchant_ID = $_POST['Merchant_ID'];
				if(isset($_SESSION['Arabic']))
					{
						$Table = 'offers';
						$Table_Services = 'ads_sub_cat';
					}
				else
					{
						$Table = 'offers_english';
						$Table_Services = 'ads_sub_cat_english';
					}
				$sql = 'SELECT DISTINCT (Ads_Sub_Cat) FROM '.$Table.' WHERE AID = ? AND Status = ?';
				$Execute_Array = array($Merchant_ID,'1');
				$results =  $Display->Display_Info($sql,$Execute_Array);
				$Sub_Cat_ID_Array = array();
				$Sub_Cat_Name = array();
				foreach($results as $rows)
					{
						$Sub_Cat_ID_Array[] = $rows->Ads_Sub_Cat;
						$sql_sub = 'SELECT Sub_Cat_Name FROM '.$Table_Services.' WHERE ID = ?';
						$Execute_Array = array($rows->Ads_Sub_Cat);
						$Sub_Cat_Name[] = $Display->Display_Single_Info_Modified($sql_sub,'Sub_Cat_Name',$Execute_Array);
					}
				$this->registry->template->Sub_Cat_ID_Array = $Sub_Cat_ID_Array;
				$this->registry->template->Sub_Cat_Name = $Sub_Cat_Name;
				$this->registry->template->show('statistics/display_services');
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
				$this->registry->template->show('statistics/display_merchant');
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
				$this->registry->template->show('statistics/step_one');
			}
		
}

?>
