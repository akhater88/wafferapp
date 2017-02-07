<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
class my_mail
	{
		function __construct()
			{
				$this->db = db::getInstance();
				date_default_timezone_set('Asia/Amman');
			}
		public function Send_SMTP($body,$Host,$User_Name,$PassWord,$Sender_Email,$Sender_Name,$Subject,$Recipient,$Recipient_Name)
			{
				$mail             = new PHPMailer();
				//$body             = file_get_contents('contents.html');
				$body             = eregi_replace("[\]",'',$body);
				$mail->IsSMTP(); // telling the class to use SMTP
				$mail->Host       = $Host; // SMTP server
				$mail->SMTPDebug  = 1;                     // enables SMTP debug information (for testing)
														   // 1 = errors and messages
														   // 2 = messages only
				$mail->SMTPAuth   = true;                  // enable SMTP authentication
				$mail->Host       = $Host; // sets the SMTP server
				$mail->Port       = 25;                    // set the SMTP port for the GMAIL server
				$mail->Username   = $User_Name;//"info@mmbydesign.com"; // SMTP account username
				$mail->Password   = $PassWord; //"a1234";        // SMTP account password
				
				$mail->SetFrom($Sender_Email,$Sender_Name);
				
				$mail->AddReplyTo($Sender_Email,$Sender_Name);
				
				$mail->Subject    = $Subject;
				
				//$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
				
				$mail->MsgHTML($body);
				
				//$address = $Recipient;
				//$Path = '././includes/images/Umrati.jpg';
				$mail->AddAddress($Recipient,$Recipient_Name);
				//$mail->AddCC("fadi_adawi@hotmail.com", "Fadi Adawi"); //To send "cc".
				//$mail->AddAttachment($Path);      // attachment
				//$mail->AddAttachment("images/phpmailer_mini.gif"); // attachment  
				//$mail->AddAttachment("Docs/Contract_Tareq.doc");
				if(!$mail->Send()) {
				 $_SESSION['Email_MSG'] = 'لـم نـتمكـن مـن إرسـال مـعـلـوماتـك عـبـر الـبـريـد الإلكتـروني الـرجـاء مـراجـعـة إدارتـنـا';
				} else {
				$MSG = 'لـقـد تـم إرسـال مـعـلـومـات عـضـويـتـك بـنـجـاح'.'<BR />';
				$MSG .= 'الـرجـاء الـتـحقـق مـن صـندوق البريد الغير المرغوب فيه';
				$_SESSION['Email_MSG'] = $MSG;
				 
				}
				
			}
	}
?>