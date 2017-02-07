<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
validate_roles::validate();
class my_plain_images_bannerController extends baseController {
			
		public function index() 
			{
				?>
				<script language="javascript">
				window.location ='<?php echo __LINK_PATH;?>';
				</script>
				<?php
			}
		public function add_new_images()
			{
				$Display = new sql();
				$validate = new validate_new();
				$Table = $_POST['Table'];
				$Folder_Name = $_POST['Folder_Name'];
				$newwidth = '571';
				$newheight = '251';
				if($_FILES['Filedata']['name']!= '')
					{
						$Valid_Types = array('jpg','jpeg','gif','png');
						$Allowed_Images = $validate->Allowed_Images('Filedata',$Valid_Types);
						$ImageSize = $validate->ImageSize('Filedata');
						$Is_Image = $validate->Is_Image('Filedata');
						if(($Allowed_Images)||($ImageSize)||($Is_Image))
							{
								$myTweets = array("flag" => '1');
								$Display->Write_JSON('Image_Error',$myTweets);
							}
						else
							{
								$myTweets = array("flag" => '0');
								$Display->Write_JSON('Image_Error',$myTweets);
								$Path = __INNER_PATH.'includes/'.$Folder_Name.'/';
								$uploads = new uploads();
								$Image_Path = $uploads->UploadBrandImageFixedHeight('Filedata',$Path,$newwidth,$newheight);
								$sql = 'INSERT INTO '.$Table.' (Image_Path,Status) VALUES (?,?)';
								$Execute_Array = array($Image_Path,'1');
								$Display->Execute($sql,$Execute_Array);
								$Path = __CACHE.$Table.'.txt';
								$Display->update_table_modified($Path);
							}
						
					}
				else
					{
						$myTweets = array("flag" => '2');
						$Display->Write_JSON('Image_Error',$myTweets);
					}
			}
		
		public function delete_selected_image()
			{
				$Display = new sql();
				$ID = $_POST['ID'];
				if(isset($_SESSION['Arabic']))
					{
						$Table = 'plain_images_banner';
					}
				else
					{
						$Table = 'plain_images_banner_english';
					}
				$sql = 'SELECT Image_Path FROM '.$Table.' WHERE ID = ?';
				$Execute_Array = array($ID);
				$Image_Path = $Display->Display_Single_Info_Modified($sql,'Image_Path',$Execute_Array);
				
				$Path = __INNER_PATH.'includes/Plain_Image_Gallery/'.$Image_Path;
				@unlink($Path);
				
				$sql = 'DELETE FROM '.$Table.' WHERE ID = ?';
				$Execute_Array = array($ID);
				$Display->Execute($sql,$Execute_Array);
				$Path = __CACHE.$Table.'.txt';
				$Display->update_table_modified($Path);
				$this->add_image_to_gallery();
			}
		
		public function add_image_to_gallery()
			{
				$Display = new sql();
				if(isset($_SESSION['Arabic']))
					{
						$Table = 'plain_images_banner';
					}
				else
					{
						$Table = 'plain_images_banner_english';
					}
				$sql = 'SELECT * FROM '.$Table.' WHERE Status = ?';
				$Execute_Array = array('1');
				$pagenum  = @$_POST['Page'];
				$paginate = new paginate($Table,'12',$pagenum,$sql,$Execute_Array);
				$Count = $paginate->Records($Table);
				$this->registry->template->Page = $pagenum;
				$this->registry->template->Count = $Count;
				$this->registry->template->Last = $paginate->Calculate_Last($Count);
				$results = $paginate->Paginate();
				$this->registry->template->results = $results;
				$this->registry->template->show('my_plain_images_banner/add_image_to_gallery');
			}
		
}

?>
