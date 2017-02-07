<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
$Allowed_Users = array('1');
validate_roles_new::validate($Allowed_Users);
class clientsController extends baseController {
			
		public function index() 
			{
				
			}
			
		public function add_client()
			{
				if(isset($_SESSION['Arabic']))
					{
						$Table = 'ads_cat';
					}
				else
					{
						$Table = 'ads_cat_english';
					}
				$sql = 'SELECT * FROM '.$Table.' WHERE Status = ?';
				$Execute_Array = array('1');
				$pagenum  = @$_POST['Page'];
				$paginate = new paginate($Table,'15',$pagenum,$sql,$Execute_Array);
				$Count = $paginate->Records($Table);
				$this->registry->template->Page = $pagenum;
				$this->registry->template->Count = $Count;
				$this->registry->template->Last = $paginate->Calculate_Last($Count);
				$results = $paginate->Paginate();
				$this->registry->template->results = $results;
				$this->registry->template->show('ads/ads_cat');
			}
		
}

?>
