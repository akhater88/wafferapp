 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
validate_mobile_user_role::validate();
class mobile_users_functionsController extends baseController {
			
		public function index() 
			{
				
			}
		/*public function insert_email()
			{
				$Display = new sql_modified();
				$Email = 'fadi_adawi@hotmail.com'; //@$_POST['Email'];
				//$Key = @$_POST['Key'];
				$Country_ID ='15';
				$sql = 'INSERT INTO mobile_users (Email,Country_ID,Status) VALUES (?,?,?)';
				$Execute_Array = array($Email,$Country_ID,'1');
				$Inserted = $Display->Execute($sql,$Execute_Array,'1','mobile_users');
				if($Inserted)
						{
										echo '0';
										$Table = 'potential_mobile_users_english';
										$Table_Points = 'my_claimed_prizes_english';
										$sql = 'SELECT UID FROM '.$Table.' WHERE Email = ? AND Status = ? ORDER BY Time_STAMP LIMIT 0,1';
										echo $sql;
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
														$Display->Execute($sql,$Execute_Array);
													}
											}
							}
			}*/
		public function submit_invitations()
			{
				$Display = new sql();
				$validate = new validate_new();
				$Emails = trim(strip_tags($_POST['Emails']));
				$Emails = str_replace(' ','',$Emails);
				$MSG = trim(strip_tags($_POST['MSG']));
				$Time_Stamp = $_POST['Time_Stamp'];
				$Emails_List = explode(',',$Emails);
				$Email_Array = array();
				$Email_Users = array();
				$Email_Array_Used = array();
				if(isset($_SESSION['Arabic']))
					{
						$Table = 'potential_mobile_users';
					}
				else
					{
						$Table = 'potential_mobile_users_english';
					}
				$sql = 'SELECT Email FROM mobile_users WHERE Status = ?';
				$Execute_Array = array('1');
				$results = $Display->Display_Info($sql,$Execute_Array);
				foreach($results as $rows)
					{
						$Email_Users[] = $rows->Email;
						$Email_Users_2[] = $rows->Email;
					}
				if($Emails == NULL)
					{
						$myTweets = array("flag" => '1');
						$Display->Write_JSON($Time_Stamp,$myTweets);
					}
				else
					{
						$my_mail = new my_mail();
						foreach($Emails_List as $value)
							{
								if($value != NULL)
									{
										$Validate_Email = $validate->Validate_Email($value);
										if(($Validate_Email)&&(!in_array($value,$Email_Users)))
											{
												$Email_Array[] = $value;
											}
										if(($Validate_Email)&&(in_array($value,$Email_Users_2)))
											{
												$Email_Array_Used[] = $value;
											}
										if(!$Validate_Email)
											{
												$Email_Array_Invalid[] = $value;
											}
									}
							}
						
						if(count($Email_Array))
							{
								$Time_Stamp_New = 'Valid_'.$Time_Stamp;
								$Time_Stamp_Invalid = 'Invalid_'.$Time_Stamp;
								$Time_Stamp_Invalid_Email = 'Invalid_Email_'.$Time_Stamp;
								$Time_Stamp_New_Message = 'Valid_MSG_'.$Time_Stamp;
								$UID = $_SESSION['Mobile_User_ID'];
								$myTweets = array("flag" => '0');
								$Display->Write_JSON($Time_Stamp,$myTweets);
								$Link = __LINK_PATH;
								if($MSG == NULL)
									{
										$MSG = 'You have been invited to subscribe to our mobile application';
									}
										$Body = '<div>';
										$Body .= '<div>'.$MSG.'</div>';
										$Body .= '<div>Please click on the following link from your mobile to download our application:</div>';
										$Body .= '<div><a href="'.$Link.'" target="_blank">Application</a></div>';
										$Body .= '</div>';
										if(count($Email_Array))
											{
												$Div = '<div class="MSG"><div>لــقــد تـم إرســال الـدعــوة إلــى الـحـســابـات الـتـالـيــة</div></div>';
												$Valid_Message = array("MSG"=>$Div);
												$Display->Write_JSON($Time_Stamp_New_Message,$Valid_Message);
											}
										foreach($Email_Array as $value)
											{
												$Div = '<div class="MyList_Inner" style="color:#000000 ">'.$value.'</div>';
												$myTweets_valid[] = array("Email"=>$Div);
												$sql = 'INSERT INTO '.$Table.' (UID,Email,Status) VALUES (?,?,?)';
												$Execute_Array = array($UID,$value,'2');
												$Display->Execute($sql,$Execute_Array);
												
												//$my_mail->Send_SMTP($Body,'mail.softiletest.com','test@softiletest.com','tr8$@JN5oi','test@softiletest.com','Admin','Subscription',$value,'Subscriber');
											}
									
								$Display->Write_JSON($Time_Stamp_New,$myTweets_valid);
								//Display Emails that are already reserved for members:
								if(count($Email_Array_Used))
									{
										$Time_Stamp_New_Message_2 = 'MSG_2_'.$Time_Stamp;
										$Div = '<div><div>الـحـسـابـات الـتـالـيــة فـعــالــة و لـم يـتـم إرســال دعــوة لــهــا</div></div>';
										$Valid_Message_2 = array("MSG_2"=>$Div);
										$Display->Write_JSON($Time_Stamp_New_Message_2,$Valid_Message_2);
									}
								foreach($Email_Array_Used as $value)
									{
										$Div = '<div class="MyList_Inner_Used" style="color:#000000 ">'.$value.'</div>';
										$myTweets_invalid[] = array("Email"=>$Div);
									}
								$Display->Write_JSON($Time_Stamp_Invalid,$myTweets_invalid);
								
								if(count($Email_Array_Invalid))
									{
										$Time_Stamp_New_Message_3 = 'MSG_3_'.$Time_Stamp;
										$Div = '<div><div>الـحـســابـات الـتـالـيــة لـم تـضـف لعـدم صـلاحـيـتـهــا</div></div>';
										$Valid_Message_3 = array("MSG_3"=>$Div);
										$Display->Write_JSON($Time_Stamp_New_Message_3,$Valid_Message_3);
									}
									
								foreach($Email_Array_Invalid as $value)
									{
										$Div = '<div class="MyList_Inner_Used_Invalid" style="color:#000000 ">'.$value.'</div>';
										$myTweets_invalid_email[] = array("Email"=>$Div);
									}
								$Display->Write_JSON($Time_Stamp_Invalid_Email,$myTweets_invalid_email);
								
							}
						else
							{
								$myTweets = array("flag" => '2');
								$Display->Write_JSON($Time_Stamp,$myTweets);
							}
					}
			}
		public function invite_friends()
			{
				$this->registry->template->show('mobile_users_functions/invite_friends');
			}
		public function show_prizes()
			{
				$Display = new sql();
				$UID = $_SESSION['Mobile_User_ID'];
				if(isset($_SESSION['Arabic']))
					{
						$Table = 'prizes';
						$Table_Points = 'my_claimed_prizes';
					}
				else
					{
						$Table = 'prizes_english';
						$Table_Points = 'my_claimed_prizes_english';
					}
				$sql = 'SELECT Accum_Points FROM '.$Table_Points.' WHERE UID = ? AND Status = ?';
				$Execute_Array = array($UID,'1');
				$this->registry->template->Accum_Points = $Display->Display_Single_Info_Modified($sql,'Accum_Points',$Execute_Array);
				
				$sql = 'SELECT ID,Prize_Name,Points FROM '.$Table.' WHERE Status = ? ORDER BY Points';
				$Execute_Array = array('1');
				$pagenum  = @$_POST['Page'];
				$paginate = new paginate($Table,'10',$pagenum,$sql,$Execute_Array);
				$Count = $paginate->Records($Table);
				$this->registry->template->Page = $pagenum;
				$this->registry->template->Count = $Count;
				$this->registry->template->Last = $paginate->Calculate_Last($Count);
				$results = $paginate->Paginate();
				$this->registry->template->results = $results;
				$this->registry->template->show('mobile_users_functions/show_prizes');
			}
}

?>
