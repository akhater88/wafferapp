<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
class advertisers_opController extends baseController {
			
		public function index() 
			{
				
			}
	function LogOff()
		{
			/*$Display = new sql();
			$OID = $_SESSION['User_ID'];
			$Action_Time = date('Y-m-d G:i:s');
			$Display->create_log($OID,'users','5',$Action_Time,$OID,'logged off');*/
			session_unset();
			session_destroy();
			?>
			<script language="javascript">
			window.location = '<?php echo __LINK_PATH;?>';
			</script>
			<?
		}
}

?>
