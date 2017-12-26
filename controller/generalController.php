<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
class generalController extends baseController {
			
		public function index() 
			{
				
			}
		public function pw_recovery()
			{
				$Display = new sql();
				$EmailPW = $_POST['EmailPW'];
				$Time_Stamp = $_POST['Time_Stamp'];
				$sql = 'SELECT ID FROM users WHERE user_name = ? AND Status = ?';
				$Execute_Array = array($EmailPW,'1');
				$Total_Records = $Display->Total_Records($sql,$Execute_Array);
				if($Total_Records)
					{
						$myTweets = array("flag" => '0');
						$Display->Write_JSON($Time_Stamp,$myTweets);
						$sql = 'SELECT First_Name FROM users WHERE user_name = ? AND Status = ?';
						$Execute_Array = array($EmailPW,'1');
						$Name = $Display->Display_Single_Info_Modified($sql,'First_Name',$Execute_Array);
						$Time_Stamp_Length = strlen($Time_Stamp);
						$password = rand(100,100000).$Time_Stamp[$Time_Stamp_Length-1];
						$create_member = new create_member();
						$Salt = $create_member->getPasswordSalt();
						$Enc_PW = $create_member->getPasswordHash($Salt,$password);
						$sql = 'UPDATE users SET password = ?,Salt = ? WHERE user_name = ? AND Status = ?';
						$Execute_Array = array($Enc_PW,$Salt,$EmailPW,'1');
						$Display->Execute($sql,$Execute_Array);
						
						$Body = '<table width="100%"  border="0" cellpadding="5">
						  <tr>
							<td width="17%">Dear :</td>
							<td width="83%">'.$Name.'</td>
						  </tr>
						  <tr>
							<td colspan = "2">This is to inform you that your password has been reset as follows : </td>
						  </tr>
						  <tr>
							<td width="17%">User name :</td>
							<td width="83%">'.$EmailPW.'</td>
						  </tr>
						  <tr>
							<td width="17%">Passport :</td>
							<td width="83%">'.$password.'</td>
						  </tr>
						</table>';
						$my_mail = new my_mail();
						$my_mail->Send_SMTP($Body,'mail.wafferapp.com','info@wafferapp.com','2fTxWw~mItW&','info@wafferapp.com','Waffer Team','مـعـلـومـات الـتـسـجـيــل',$EmailPW,$Name);
					}
				else
					{
						$myTweets = array("flag" => '1');
						$Display->Write_JSON($Time_Stamp,$myTweets);
					}
			}
}

?>
