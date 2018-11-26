 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
//$Allowed_Users = array('1');
//validate_roles_new::validate($Allowed_Users);
class mobile_usersController extends baseController {
			
		public function index() 
			{
				
			}
		public function mobile_user_account()
			{
				$this->registry->template->show('mobile_users/mobile_user_account');
			}
		public function submit_log_in()
			{
				$Display = new sql();
				$Email = trim($_POST['Email']);
				$PW = trim($_POST['PW1']);
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
				<div id="text-titles">
				<table style="width: 100%" cellspacing="0" cellpadding="0">
					<tr>
						<td align="center" valign="middle">
								<img alt="" src="<?php echo __SCRIPT_PATH?>images/my-account.png" width="64" height="26" />
						</td>
					</tr>
				</table>
				</div>
				<div id="text-middle">
				<div align="right" style="font-size:18px ">تـم تفـعـيـل حـسـابك بـنـجــاح</div>
				<div style="line-height:15px ">&nbsp;</div>
				<div align="right" style="font-size:18px; color:#0066CC "><span style="cursor:pointer " onClick="RedirectModified('<?php echo __LINK_PATH;?>mobile_users/mobile_user_account')">إضـغـط هـنــا لـتـسـجـيـل الـدخــول</span></div>
				</div>
				<?php
			}
		public function submit_new_account()
			{
				$Display = new sql();
				$Email = trim($_POST['Email']);
				$PW = trim($_POST['PW1']);
				$PW2 = trim($_POST['PW2']);
				$name = trim($_POST['name']);
				$Time_Stamp = $_POST['Time_Stamp'];
				$sql = 'SELECT ID FROM mobile_users WHERE Email = ? AND Status != ? AND Name = ?';
				$Execute_Array = array($Email,'0','null');
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
				elseif($name == NULL)
					{
						$myTweets = array("flag" => '5');
						$Display->Write_JSON($Time_Stamp,$myTweets);
					}
				elseif(strlen($PW) < 6)
					{
						$myTweets = array("flag" => '3');
						$Display->Write_JSON($Time_Stamp,$myTweets);
					}
				elseif(!$Total_Records)
					{
						$sql = 'SELECT * FROM mobile_users WHERE Email = ? AND Status != ?';
						$Execute_Array = array($Email,'0');
						$Total_Records = $Display->Total_Records($sql,$Execute_Array);
						
						if (!$Total_Records)
						{
							$myTweets = array("flag" => '4');
							$Display->Write_JSON($Time_Stamp,$myTweets);
						}
						elseif($Total_Records) 
						{
							
							
							$myTweets = array("flag" => '6');
							$Display->Write_JSON($Time_Stamp,$myTweets);
							$create_member = new create_mobile_member();
							$Salt = $create_member->getPasswordSalt();
							$Enc_PW = $create_member->getPasswordHash($Salt,$PW);
							$sql = 'UPDATE mobile_users SET Name = ?,PW = ?, Salt = ? WHERE Email = ?';
							$Execute_Array = array($name,$Enc_PW,$Salt,$Email);
							$Display->Execute($sql,$Execute_Array);
							$Body = '<div>
							Dear Subscriber:'.'<BR />';
							$Body .= 'Your Login Information'.'<BR />';
							$Body .= 'Your user name is: '.$Email.'<BR />';
							$Body .= 'Your password is: '.$PW.'<BR />';
							$Body .= '</div>';
							$my_mail = new my_mail();
							$my_mail->Send_SMTP($Body,'mail.wafferapp.com','info@wafferapp.com','xdqh96Tq','info@wafferapp.com','Waffer','Login Information',$Email,'Subscriber');
						}
					}
				else
					{
						$myTweets = array("flag" => '0');
						$Display->Write_JSON($Time_Stamp,$myTweets);
						$create_member = new create_mobile_member();
						$Salt = $create_member->getPasswordSalt();
						$Enc_PW = $create_member->getPasswordHash($Salt,$PW);
						$sql = 'UPDATE mobile_users SET Name = ?,PW = ?, Salt = ?, Status = ? WHERE Email = ?';
						$Execute_Array = array($name,$Enc_PW,$Salt,'2',$Email);
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
						$my_mail->Send_SMTP($Body,'mail.wafferapp.com','info@wafferapp.com','xdqh96Tq','info@wafferapp.com','Waffer','Login Information',$Email,'Subscriber');
					}
			}
	function LogOff()
	{
		
		$Display = new sql();
		$OID = $_SESSION['Mobile_User_ID'];
		$Action_Time = date('Y-m-d G:i:s');
		$Display->create_log($OID,'mobile_users','5',$Action_Time,$OID,'logged off');
		session_unset();
		session_destroy();
		?>
		<script language="javascript">
		window.location = '<?php echo __LINK_PATH;?>';
		</script>
		<?php
	}
}

?>
