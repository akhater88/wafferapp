 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
//$Allowed_Users = array('1');
//validate_roles_new::validate($Allowed_Users);
class mobile_usersController extends baseController {
			
		public function index() 
			{
				
			}
		
		public function edit_selected_mobile_user()
			{
				$Allowed_Users = array('1');
				validate_roles_new::validate($Allowed_Users);
				$URL = new url();
				$Display = new sql();
				if(isset($_SESSION['Arabic']))
					{
						$Table = 'country';
					}
				else
					{
						$Table = 'country_english';
					}
				$Member = $URL->getPar('Member');
				$sql = 'SELECT Email,Country_ID FROM mobile_users WHERE ID = ?';
				$Execute_Array = array($Member);
				$results = $Display->Display_Info($sql,$Execute_Array);
				foreach($results as $rows)
					{
						$sql_country = 'SELECT Name FROM '.$Table.' WHERE ID = ?';
						$Execute_Array = array($rows->Country_ID);
						$Country_Name = $Display->Display_Single_Info_Modified($sql_country,'Name',$Execute_Array);
						$MyData['Email'] = $rows->Email;
						$MyData['Country_ID'] = $rows->Country_ID;
						$MyData['Country_Name'] = $Country_Name;
					}
				$this->registry->template->MyData = $MyData;
				$sql = 'SELECT DISTINCT(Country_ID) FROM mobile_users WHERE Status = ?';
				$Execute_Array = array('1');
				$results_country = $Display->Display_Info($sql,$Execute_Array);
				foreach($results_country as $rows)
					{
						$sql_country = 'SELECT Name FROM '.$Table.' WHERE ID = ?';
						$Execute_Array = array($rows->Country_ID);
						$Country_Name = $Display->Display_Single_Info_Modified($sql_country,'Name',$Execute_Array);
						$MyData_Country[$rows->Country_ID] = $Country_Name;
					}
				$this->registry->template->MyData_Country = $MyData_Country;
				$this->registry->template->Member = $Member;
				$this->registry->template->show('mobile_users/edit_selected_mobile_user');
			}
		public function mobile_user_account()
			{
				$this->registry->template->show('mobile_users/mobile_user_account');
			}
		public function submit_log_in()
			{
				$Display = new sql();
				$Email = trim($_POST['Email']);
				$PW = trim($_POST['PW']);
				$Time_Stamp = $_POST['Time_Stamp'];
				$verify_mobile_user = new verify_mobile_user();
				$verify_mobile_user->verify_pw($Email,$PW,$Time_Stamp);
				
			}
		public function create_account()
			{
				$this->registry->template->show('mobile_users/create_account');
			}
		public function activate_account()
			{
				$Display = new sql();
				$URL = new url();
				$Email = urldecode($URL->getPar('Email'));
				$sql = 'UPDATE mobile_users SET Status = ? WHERE Email = ?';
				$Execute_Array = array('1',$Email);
				$Display->Execute($sql,$Execute_Array);
				?>
				<div align="right" style="font-size:18px ">تـم تفـعـيـل حـسـابك بـنـجــاح</div>
				<div style="line-height:15px ">&nbsp;</div>
				<div align="right" style="font-size:18px; color:#0066CC "><span style="cursor:pointer " onClick="RedirectModified('<?php echo __LINK_PATH;?>mobile_users/mobile_user_account')">إضـغـط هـنــا لـتـسـجـيـل الـدخــول</span></div>
				<?php
			}
		public function submit_edit_account()
			{
				$Display = new sql();
				$ID = $_POST['ID'];
				$Email = trim($_POST['Email']);
				$PW = trim($_POST['PW']);
				$PW2 = trim($_POST['PW2']);
				$Country_Menu = $_POST['Country_Menu'];
				$Time_Stamp = $_POST['Time_Stamp'];
				/*$sql = 'SELECT ID FROM mobile_users WHERE Email = ? AND Status != ?';
				$Execute_Array = array($Email,'0');
				$Total_Records = $Display->Total_Records($sql,$Execute_Array);*/
				
				if(($PW != NULL) && ($PW != $PW2))
					{
						$myTweets = array("flag" => '2');
						$Display->Write_JSON($Time_Stamp,$myTweets);
					}
				elseif(($PW != NULL) &&(strlen($PW) < 6))
					{
						$myTweets = array("flag" => '3');
						$Display->Write_JSON($Time_Stamp,$myTweets);
					}
				/*elseif(!$Total_Records)
					{
						$myTweets = array("flag" => '4');
						$Display->Write_JSON($Time_Stamp,$myTweets);
					}*/
				else
					{
						$myTweets = array("flag" => '0');
						$Display->Write_JSON($Time_Stamp,$myTweets);
						if($PW != NULL)
							{
								$create_member = new create_mobile_member();
								$Salt = $create_member->getPasswordSalt();
								$Enc_PW = $create_member->getPasswordHash($Salt,$PW);
								$sql = 'UPDATE mobile_users SET Email = ?,Country_ID = ?,PW = ?, Salt = ? WHERE ID = ?';
								$Execute_Array = array($Email,$Country_Menu,$Enc_PW,$Salt,$ID);
							}
						else
							{
								$sql = 'UPDATE mobile_users SET Email = ?,Country_ID = ? WHERE ID = ?';
								$Execute_Array = array($Email,$Country_Menu,$ID);
							}
						$Display->Execute($sql,$Execute_Array);
						$OID = $_SESSION['User_ID'];
						$Action_Time = date('Y-m-d G:i:s');
						$Display->create_log($ID,'mobile_users','2',$Action_Time,$OID,'mobile user edited');
						
						/*
						$Link = __LINK_PATH.'mobile_users/activate_account/Email/'.urlencode($Email);
						$Body = '<div>
						Dear Subscriber:'.'<BR />';
						$Body .= 'Thank you for your subscription'.'<BR />';
						$Body .= 'Your user name is: '.$Email.'<BR />';
						$Body .= 'Your password is: '.$PW.'<BR />';
						$Body .= 'Please activate your subscription by clicking on the following link :'.'<BR />';
						$Body .= '<a href="'.$Link.'" target="_blank">Account Activation</a>'.'<BR />';
						$Body .= '</div>';
						$my_mail = new my_mail();
						$my_mail->Send_SMTP($Body,'mail.softiletest.com','test@softiletest.com','tr8$@JN5oi','test@softiletest.com','Admin','Subscription',$Email,'Subscriber');
						*/
					}
			}
		public function submit_new_account()
			{
				$Display = new sql();
				$Email = trim($_POST['Email']);
				$PW = trim($_POST['PW']);
				$PW2 = trim($_POST['PW2']);
				$Time_Stamp = $_POST['Time_Stamp'];
				$sql = 'SELECT ID FROM mobile_users WHERE Email = ? AND Status != ?';
				$Execute_Array = array($Email,'0');
				$Total_Records = $Display->Total_Records($sql,$Execute_Array);
				if($PW == NULL)
					{
						$myTweets = array("flag" => '1');
						$Display->Write_JSON($Time_Stamp,$myTweets);
					}
				elseif($PW != $PW2)
					{
						$myTweets = array("flag" => '2');
						$Display->Write_JSON($Time_Stamp,$myTweets);
					}
				elseif(strlen($PW) < 6)
					{
						$myTweets = array("flag" => '3');
						$Display->Write_JSON($Time_Stamp,$myTweets);
					}
				elseif(!$Total_Records)
					{
						$myTweets = array("flag" => '4');
						$Display->Write_JSON($Time_Stamp,$myTweets);
					}
				else
					{
						$myTweets = array("flag" => '0');
						$Display->Write_JSON($Time_Stamp,$myTweets);
						$create_member = new create_mobile_member();
						$Salt = $create_member->getPasswordSalt();
						$Enc_PW = $create_member->getPasswordHash($Salt,$PW);
						$sql = 'UPDATE mobile_users SET PW = ?, Salt = ?, Status = ? WHERE Email = ?';
						$Execute_Array = array($Enc_PW,$Salt,'2',$Email);
						$Display->Execute($sql,$Execute_Array);
						$Link = __LINK_PATH.'mobile_users/activate_account/Email/'.urlencode($Email);
						$Body = '<div>
						Dear Subscriber:'.'<BR />';
						$Body .= 'Thank you for your subscription'.'<BR />';
						$Body .= 'Your user name is: '.$Email.'<BR />';
						$Body .= 'Your password is: '.$PW.'<BR />';
						$Body .= 'Please activate your subscription by clicking on the following link :'.'<BR />';
						$Body .= '<a href="'.$Link.'" target="_blank">Account Activation</a>'.'<BR />';
						$Body .= '</div>';
						$my_mail = new my_mail();
						$my_mail->Send_SMTP($Body,'mail.softiletest.com','test@softiletest.com','tr8$@JN5oi','test@softiletest.com','Admin','Subscription',$Email,'Subscriber');
					}
			}
}

?>
