<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
class validate_roles {

	public static function validate()
		{
			$myfunctions = new myfunctions();
			$Is_Laget = $myfunctions->Is_Laget();
			$Allowed_Levels = array('1','2');
			$Is_Level_Set = $myfunctions->Is_Level_Set();
			$Is_Level_One = $myfunctions->Is_Level_One($Allowed_Levels);
			
			if((!$Is_Laget)||(!$Is_Level_Set)||(!$Is_Level_One))
				{
					?>
					<script language="javascript">
					window.location = '<?php echo __LINK_PATH;?>index/';
					</script>
					<?php
				}
		}
}

?>
