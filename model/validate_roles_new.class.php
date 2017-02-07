<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
class validate_roles_new {

	public static function validate($Allowed_Levels)
		{
			$_SESSION['Expired_Info'] = false;
			$My_Level = $_SESSION['User_level_Session'];
			if($My_Level == '2')
				{
					$MY_ID = $_SESSION['User_ID'];
					$Current_Date = date('Y-m-d');
					$Current_Date_String = strtotime($Current_Date);
					$Display = new sql();
					$sql = 'SELECT End_Date FROM users WHERE ID = ?';
					$Execute_Array = array($MY_ID);
					$End_Date = $Display->Display_Single_Info_Modified($sql,'End_Date',$Execute_Array);
					$End_Date_String = strtotime($End_Date);
					if($Current_Date_String > $End_Date_String)
						{
						$End_Date = date('d-m-Y',strtotime($End_Date));
						$_SESSION['Expiration_Date'] = $End_Date;
						$_SESSION['Expired_Info'] = true;
						?>
						<script language="javascript">
						window.location = '<?php echo __LINK_PATH;?>index/expired_member/';
						</script>
						<?
						}
					else
						{
							$myfunctions = new myfunctions();
							$Is_Laget = $myfunctions->Is_Laget();
							$Is_Level_Set = $myfunctions->Is_Level_Set();
							$Is_Level_One = $myfunctions->Is_Level_One($Allowed_Levels);
							
							if((!$Is_Laget)||(!$Is_Level_Set)||(!$Is_Level_One))
								{
									?>
									<script language="javascript">
									window.location = '<?php echo __LINK_PATH;?>index/';
									</script>
									<?
								}
						}
				}
			else
				{
					$myfunctions = new myfunctions();
					$Is_Laget = $myfunctions->Is_Laget();
					$Is_Level_Set = $myfunctions->Is_Level_Set();
					$Is_Level_One = $myfunctions->Is_Level_One($Allowed_Levels);
					
					if((!$Is_Laget)||(!$Is_Level_Set)||(!$Is_Level_One))
						{
							?>
							<script language="javascript">
							window.location = '<?php echo __LINK_PATH;?>index/';
							</script>
							<?
						}
				}
		}
}

?>
