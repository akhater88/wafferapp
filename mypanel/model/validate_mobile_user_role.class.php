<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
class validate_mobile_user_role {

	public static function validate()
		{
			if(isset($_SESSION['Mobile_User_Auth']))
				{
					$My_Mobile_User_Auth = $_SESSION['Mobile_User_Auth'];
				}
			else
				{
					$My_Mobile_User_Auth = 0;
				}
			if($My_Mobile_User_Auth)
				{
					
					$myfunctions = new myfunctions();
					$Is_Laget = $myfunctions->Is_Laget();
					if(!$Is_Laget)
						{
						?>
						<script language="javascript">
						window.location = '<?php echo __LINK_PATH;?>mobile_users/mobile_user_account';
						</script>
						<?php
						}
				}
			else
				{
					?>
					<script language="javascript">
					window.location = '<?php echo __LINK_PATH;?>mobile_users/mobile_user_account';
					</script>
					<?php
				}
		}
}

?>
