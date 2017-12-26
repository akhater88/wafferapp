<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
//validate_roles::validate();
class languageController extends baseController {
			
		public function index() 
			{
				
			}
		public function switch_english()
			{
				unset($_SESSION['Arabic_Visitors']);
				?>
				<script language="javascript">
				window.location ='<?php echo __LINK_PATH;?>';
				</script>
				<?php
			}
		public function switch_arabic()
			{
				$_SESSION['Arabic_Visitors'] = true;
				?>
				<script language="javascript">
				window.location ='<?php echo __LINK_PATH;?>';
				</script>'
				</script>
				<?php
			}
}

?>
