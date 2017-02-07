 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
$Allowed_Users = array('4');
validate_roles_new::validate($Allowed_Users);
class operatorsController extends baseController {
			
		public function index() 
			{
				
			}
		public function show_client_offers()
			{
				$Display = new sql();
				$URL = new url();
				$AID = $URL->getPar('Member');
				$sql = 'SELECT First_Name,Last_Name FROM users WHERE ID = ?';
				$Execute_Array = array($AID);
				$results = $Display->Display_Info($sql,$Execute_Array);
				foreach($results as $rows)
					{
						$Full_Name = $rows->First_Name.' '.$rows->Last_Name;
					}
				$this->registry->template->Full_Name = $Full_Name;
				$this->registry->template->AID = $AID;
				if(isset($_SESSION['Arabic']))
					{
						$Table = 'offers';
					}
				else
					{
						$Table = 'offers_english';
					}
				$sql = 'SELECT ID,Offer_Title,Offer_Content,Start_Date,End_Date,Status FROM '.$Table.' WHERE Status != ? AND AID = ? ORDER BY Start_Date DESC';
				$Execute_Array = array('0',$AID);
				$pagenum  = @$_POST['Page'];
				$paginate = new paginate($Table,'20',$pagenum,$sql,$Execute_Array);
				$Count = $paginate->Records($Table);
				$this->registry->template->Page = $pagenum;
				$this->registry->template->Count = $Count;
				$this->registry->template->Last = $paginate->Calculate_Last($Count);
				$results = $paginate->Paginate();
				$this->registry->template->results = $results;
				$this->registry->template->show('operators/show_client_offers');
			}
		public function block_selected_offer()
			{
				$Display = new sql();
				$OID = $_SESSION['User_ID'];
				$ID = $_POST['ID'];
				if(isset($_SESSION['Arabic']))
					{
						$Table = 'offers';
					}
				else
					{
						$Table = 'offers_english';
					}
				$sql = 'SELECT AID FROM '.$Table.' WHERE ID = ?';
				$Execute_Array = array($ID);
				$AID = $Display->Display_Single_Info_Modified($sql,'AID',$Execute_Array);
				$sql = 'UPDATE '.$Table.' SET Status = ? WHERE ID = ?';
				$Execute_Array = array('2',$ID);
				$Display->Execute($sql,$Execute_Array);
				$Action_Time = date('Y-m-d G:i:s');
				$Display->create_log($ID,$Table,'2',$Action_Time,$OID,'Block a voucher');
				$this->show_client_offers_par($AID);
			}
		public function publish_selected_offer()
			{
				$Display = new sql();
				$OID = $_SESSION['User_ID'];
				$ID = $_POST['ID'];
				if(isset($_SESSION['Arabic']))
					{
						$Table = 'offers';
					}
				else
					{
						$Table = 'offers_english';
					}
				$sql = 'SELECT AID FROM '.$Table.' WHERE ID = ?';
				$Execute_Array = array($ID);
				$AID = $Display->Display_Single_Info_Modified($sql,'AID',$Execute_Array);
				$sql = 'UPDATE '.$Table.' SET Status = ? WHERE ID = ?';
				$Execute_Array = array('1',$ID);
				$Display->Execute($sql,$Execute_Array);
				$Action_Time = date('Y-m-d G:i:s');
				$Display->create_log($ID,$Table,'2',$Action_Time,$OID,'Publish a voucher');
				$this->show_client_offers_par($AID);
			}
		private function show_client_offers_par($AID)
			{
				$Display = new sql();
				$sql = 'SELECT First_Name,Last_Name FROM users WHERE ID = ?';
				$Execute_Array = array($AID);
				$results = $Display->Display_Info($sql,$Execute_Array);
				foreach($results as $rows)
					{
						$Full_Name = $rows->First_Name.' '.$rows->Last_Name;
					}
				$this->registry->template->Full_Name = $Full_Name;
				$this->registry->template->AID = $AID;
				if(isset($_SESSION['Arabic']))
					{
						$Table = 'offers';
					}
				else
					{
						$Table = 'offers_english';
					}
				$sql = 'SELECT ID,Offer_Title,Offer_Content,Start_Date,End_Date,Status FROM '.$Table.' WHERE Status != ? AND AID = ? ORDER BY Start_Date DESC';
				$Execute_Array = array('0',$AID);
				$pagenum  = @$_POST['Page'];
				$paginate = new paginate($Table,'20',$pagenum,$sql,$Execute_Array);
				$Count = $paginate->Records($Table);
				$this->registry->template->Page = $pagenum;
				$this->registry->template->Count = $Count;
				$this->registry->template->Last = $paginate->Calculate_Last($Count);
				$results = $paginate->Paginate();
				$this->registry->template->results = $results;
				$this->registry->template->show('operators/show_client_offers');
			}
		public function add_offer_start()
			{
				$Display = new sql();
				$Country = $_SESSION['Default_Country'];
				$sql = 'SELECT ID,First_Name,Last_Name,user_name FROM users WHERE Status = ? AND Level = ? AND Country = ? ORDER BY BINARY First_Name';
				$Execute_Array = array('1','2',$Country);
				$pagenum  = @$_POST['Page'];
				$paginate = new paginate('users','20',$pagenum,$sql,$Execute_Array);
				$Count = $paginate->Records('users');
				$this->registry->template->Page = $pagenum;
				$this->registry->template->Count = $Count;
				$this->registry->template->Last = $paginate->Calculate_Last($Count);
				$results = $paginate->Paginate();
				$this->registry->template->results = $results;
				$this->registry->template->show('operators/add_offer_start');
			}
	function LogOff()
		{
			
			$Display = new sql();
			$OID = $_SESSION['User_ID'];
			$Action_Time = date('Y-m-d G:i:s');
			$Display->create_log($OID,'users','5',$Action_Time,$OID,'logged off');
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
