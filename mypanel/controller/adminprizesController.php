 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
$Allowed_Users = array('1');
validate_roles_new::validate($Allowed_Users);
class adminprizesController extends baseController {
			
		public function index() 
			{
				
			}
		public function add_prize()
			{
				$Display = new sql();
				if(isset($_SESSION['Arabic']))
					{
						$Table = 'prizes';
					}
				else
					{
						$Table = 'prizes_english';
					}
				$sql = 'SELECT ID,Prize_Name,Points FROM '.$Table.' WHERE Status = ?';
				$Execute_Array = array('1');
				$pagenum  = @$_POST['Page'];
				$paginate = new paginate($Table,'10',$pagenum,$sql,$Execute_Array);
				$Count = $paginate->Records($Table);
				$this->registry->template->Page = $pagenum;
				$this->registry->template->Count = $Count;
				$this->registry->template->Last = $paginate->Calculate_Last($Count);
				$results = $paginate->Paginate();
				$this->registry->template->results = $results;
				$this->registry->template->show('adminprizes/add_prize');
			}
		public function delete_selected_prize()
			{
				$Display = new sql();
				$ID = $_POST['ID'];
				$OID = $_SESSION['User_ID'];
				if(isset($_SESSION['Arabic']))
					{
						$Table = 'prizes';
					}
				else
					{
						$Table = 'prizes_english';
					}
				$sql = 'UPDATE '.$Table.' SET Status = ? WHERE ID = ?';
				$Execute_Array = array('0',$ID);
				$Display->Execute($sql,$Execute_Array);
				$Path = __CACHE.$Table.'.txt';
				$Display->update_table_modified($Path);
				$Action_Time = date('Y-m-d G:i:s');
				$Display->create_log($ID,$Table,'3',$Action_Time,$OID,'Deleted a prize');
				$this->add_prize();
			}
		public function submit_edit_prize()
			{
				$Display = new sql();
				$OID = $_SESSION['User_ID'];
				$validate = new validate_new();
				$ID = $_POST['ID'];
				$Prize_Name = trim($_POST['Prize_Name']);
				$Points = $_POST['Points'];
				$Time_Stamp = $_POST['Time_Stamp'];
				if(isset($_SESSION['Arabic']))
					{
						$Table = 'prizes';
					}
				else
					{
						$Table = 'prizes_english';
					}
				$Item_Exists_Modified_JSON = $validate->Item_Exists_Edit_Modified_JSON('prizes','Prize_Name',$ID,$Prize_Name);
				if($Prize_Name == NULL)
					{
						$myTweets = array("flag" => '1');
						$Display->Write_JSON($Time_Stamp,$myTweets);
					}
				elseif($Item_Exists_Modified_JSON)
					{
						$myTweets = array("flag" => '2');
						$Display->Write_JSON($Time_Stamp,$myTweets);
					}
				elseif(!is_numeric($Points))
					{
						$myTweets = array("flag" => '3');
						$Display->Write_JSON($Time_Stamp,$myTweets);
					}
				else
					{
						$myTweets = array("flag" => '0');
						$Display->Write_JSON($Time_Stamp,$myTweets);
						$sql = 'UPDATE '.$Table.' SET Prize_Name = ?,Points = ? WHERE ID = ?';
						$Execute_Array = array($Prize_Name,$Points,$ID);
						$Display->Execute($sql,$Execute_Array);
						$Action_Time = date('Y-m-d G:i:s');
						$Display->create_log($ID,$Table,'2',$Action_Time,$OID,'Edited a prize');
						$Path = __CACHE.$Table.'.txt';
						$Display->update_table_modified($Path);
						$this->add_prize();
					}
			}
		public function submit_new_prize()
			{
				$Display = new sql();
				$validate = new validate_new();
				$OID = $_SESSION['User_ID'];
				$Prize_Name = trim($_POST['Prize_Name']);
				$Points = $_POST['Points'];
				$Time_Stamp = $_POST['Time_Stamp'];
				if(isset($_SESSION['Arabic']))
					{
						$Table = 'prizes';
					}
				else
					{
						$Table = 'prizes_english';
					}
				$Item_Exists_Modified_JSON = $validate->Item_Exists_Modified_JSON('prizes','Prize_Name',$Prize_Name);
				if($Prize_Name == NULL)
					{
						$myTweets = array("flag" => '1');
						$Display->Write_JSON($Time_Stamp,$myTweets);
					}
				elseif($Item_Exists_Modified_JSON)
					{
						$myTweets = array("flag" => '2');
						$Display->Write_JSON($Time_Stamp,$myTweets);
					}
				elseif(!is_numeric($Points))
					{
						$myTweets = array("flag" => '3');
						$Display->Write_JSON($Time_Stamp,$myTweets);
					}
				else
					{
						$myTweets = array("flag" => '0');
						$Display->Write_JSON($Time_Stamp,$myTweets);
						$sql = 'INSERT INTO '.$Table.' (Prize_Name,Points,Status) VALUES (?,?,?)';
						$Execute_Array = array($Prize_Name,$Points,'1');
						$RID = $Display->Execute($sql,$Execute_Array,'1',$Table);
						$Action_Time = date('Y-m-d G:i:s');
						$Display->create_log($RID,$Table,'1',$Action_Time,$OID,'Added a prize');
						$Path = __CACHE.$Table.'.txt';
						$Display->update_table_modified($Path);
						$this->add_prize();
					}
			}
}

?>
