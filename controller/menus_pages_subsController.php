<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
$Allowed_Users = array('1');
validate_roles_new::validate($Allowed_Users);
class menus_pages_subsController extends baseController {
			
		public function index() 
			{
				
			}
		
		public function edit_main_menu_form()
			{
				$this->registry->template->show('menus_pages_subs/edit_main_menu_form');
			}
		public function change_sub_sub_menu_order()
			{
				$Display = new sql();
				if(isset($_SESSION['Arabic']))
					{
						$Table = 'sub_sub_menu';
					}
				else
					{
						$Table = 'sub_sub_menu_english';
					}
				$Counter = 1;
				$Order = $_POST['Order'];
				
				foreach ($Order as $Value) 
					{
						
						$sql = 'UPDATE '.$Table.' SET Sub_Menu_Order = ? WHERE ID = ?';
						$Execute_Array = array($Counter,$Value);
						$Display->Execute($sql,$Execute_Array);
						$Counter++;
					}
				$Path = __CACHE.$Table.'.txt';
				$Display->update_table_modified($Path);
				$this->edit_sub_menu();
				
			}
		public function change_main_menu_order()
			{
				$Display = new sql();
				if(isset($_SESSION['Arabic']))
					{
						$Table = 'menu_v2';
					}
				else
					{
						$Table = 'menu_v2_english';
					}
				$Counter = 1;
				$Order = $_POST['Order_Main'];
				
				foreach ($Order as $Value) 
					{
						
						$sql = 'UPDATE '.$Table.' SET Menu_Order = ? WHERE ID = ?';
						$Execute_Array = array($Counter,$Value);
						$Display->Execute($sql,$Execute_Array);
						$Counter++;
					}
				$Path = __CACHE.$Table.'.txt';
				$Display->update_table_modified($Path);
				$this->edit_sub_menu();
			}
		public function edit_main_menu_name()
			{
				$Display = new sql();
				$validate = new validate_new();
				$ID = $_POST['ID'];
				$Menu_Name = trim($_POST['Menu_Name']);
				if(isset($_SESSION['Arabic']))
					{
						$Table = 'menu_v2';
								
								
					}
				else
					{
						$Table = 'menu_v2_english';
								
					}
				$Item_Exists_Modified_JSON = $validate->Item_Exists_Edit_Modified_JSON('menu_v2','Menu_Name',$ID,$Menu_Name);
						if($Item_Exists_Modified_JSON)
							{
								$myTweets = array("flag" => '1');
								$Display->Write_JSON('Menu_V2_Exists',$myTweets);
							}
						else
							{
								$myTweets = array("flag" => '0');
								$Display->Write_JSON('Menu_V2_Exists',$myTweets);
								$sql = 'UPDATE '.$Table.' SET Menu_Name = ? WHERE ID = ?';
								$Execute_Array = array($Menu_Name,$ID);
								$Display->Execute($sql,$Execute_Array);
								
								$sql = 'SELECT Status FROM '.$Table.' WHERE ID = ?';
								$Execute_Array = array($ID);
								$Status = $Display->Display_Single_Info_Modified($sql,'Status',$Execute_Array);
								if($Status == '1')
									{
										$Path = __CACHE.$Table.'.txt';
										$Display->update_table_modified($Path);
									}
							}
				$this->edit_sub_menu();
			}
		public function submit_new_page_no_sub()
			{
				$Display = new sql();
				$ID = $_POST['ID'];
				$Title = $_POST['Title'];
				
				$Content = $_POST['Content'];
				
				$Content_Stripped = trim(strip_tags($Content));
				
				$Counter = 0;
				if($Title == NULL)
					{
						$Counter++;
					}
				elseif($Content_Stripped == NULL)
					{
						
						$Counter++;
					}
				else
					{
						if(isset($_SESSION['Arabic']))
							{
								$Table = 'pages_v2';
								
								
							}
						else
							{
								$Table = 'pages_v2_english';
								
							}
						
						$Content = htmlentities($Content,ENT_QUOTES,'UTF-8');
						$sql = 'INSERT INTO '.$Table.' (Menu_ID,Sub_Menu_ID,Title,Content,View,Status,Content_Stripped) VALUES (?,?,?,?,?,?,?)';
						$Execute_Array = array($ID,'0',$Title,$Content,'1','2',$Content_Stripped);
						$Display->Execute($sql,$Execute_Array);
					}
			}
		public function add_new_page_no_sub()
			{
				$Display = new sql();
				$URL = new url();
				$Member = $URL->getPar('Member');
				if(isset($_SESSION['Arabic']))
					{
						$Table = 'pages_v2';
						
					}
				else
					{
						$Table = 'pages_v2_english';
						
					}
				$this->registry->template->Member_ID = $Member;
				$this->registry->template->show('menus_pages_subs/add_new_page_no_sub');
			}
		public function delete_selected_sub_sub()
			{
				$Display = new sql();
				$ID = $_POST['ID'];
				if(isset($_SESSION['Arabic']))
					{
						$Table = 'sub_sub_menu';
					}
				else
					{
						$Table = 'sub_sub_menu_english';
					}
				$sql = 'UPDATE '.$Table.' SET Status = ? WHERE ID = ?';
				$Execute_Array = array('0',$ID);
				$Display->Execute($sql,$Execute_Array);
				$Path = __CACHE.$Table.'.txt';
				$Display->update_table_modified($Path);
				$this->edit_sub_menu();
			}
		public function delete_selected_sub()
			{
				$Display = new sql();
				$ID = $_POST['ID'];
				if(isset($_SESSION['Arabic']))
					{
						$Table = 'sub_menu_v2';
					}
				else
					{
						$Table = 'sub_menu_v2_english';
					}
				$sql = 'UPDATE '.$Table.' SET Status = ? WHERE ID = ?';
				$Execute_Array = array('0',$ID);
				$Display->Execute($sql,$Execute_Array);
				$Path = __CACHE.$Table.'.txt';
				$Display->update_table_modified($Path);
				$this->edit_sub_menu();
			}
		public function add_main_menu_name()
			{
				$Display = new sql();
				$validate = new validate_new();
				$Menu_Name = $_POST['ID'];
				
				if($Menu_Name != NULL)
					{
						if(isset($_SESSION['Arabic']))
							{
								$Table = 'menu_v2';
							}
						else
							{
								$Table = 'menu_v2_english';
							}
						
						$Item_Exists_Modified_JSON = $validate->Item_Exists_Modified_JSON('menu_v2','Menu_Name',$Menu_Name);
						if($Item_Exists_Modified_JSON)
							{
								$myTweets = array("flag" => '1');
								$Display->Write_JSON('Menu_V2_Exists',$myTweets);
							}
						else
							{
								$myTweets = array("flag" => '0');
								$Display->Write_JSON('Menu_V2_Exists',$myTweets);
								$sql = 'SELECT MAX(Menu_Order) AS Maximum FROM '.$Table.' WHERE Status != ?';
								$Execute_Array = array('0');
								$results = $Display->Display_Info($sql,$Execute_Array);
								foreach($results as $rows)
									{
										$MAX = $rows->Maximum;
									}
								$MAX++;
								$sql = 'INSERT INTO '.$Table.' (Menu_Name,Menu_Order,Remove,Status) VALUES (?,?,?,?)';
								$Execute_Array = array($Menu_Name,$MAX,'1','2');
								$Display->Execute($sql,$Execute_Array);
							}
						
					}
				$this->edit_sub_menu();
			}
		public function publish_selected_main()
			{
				$Display = new sql();
				$ID = $_POST['ID'];
				if(isset($_SESSION['Arabic']))
					{
						$Table = 'menu_v2';
					}
				else
					{
						$Table = 'menu_v2_english';
					}
				$sql = 'UPDATE '.$Table.' SET Status = ? WHERE ID = ?';
				$Execute_Array = array('1',$ID);
				$Display->Execute($sql,$Execute_Array);
				$Path = __CACHE.$Table.'.txt';
				$Display->update_table_modified($Path);
				$this->edit_sub_menu();
			}
		public function publish_selected_page()
			{
				$Display = new sql();
				$ID = $_POST['ID'];
				if(isset($_SESSION['Arabic']))
					{
						$Table = 'pages_v2';
					}
				else
					{
						$Table = 'pages_v2_english';
					}
				$sql = 'UPDATE '.$Table.' SET Status = ? WHERE ID = ?';
				$Execute_Array = array('1',$ID);
				$Display->Execute($sql,$Execute_Array);
				
				$sql = 'SELECT Menu_ID FROM '.$Table.' WHERE ID = ?';
				$Execute_Array = array($ID);
				$Menu_ID = $Display->Display_Single_Info_Modified($sql,'Menu_ID',$Execute_Array);
				
				$sql = 'SELECT Sub_Menu_ID FROM '.$Table.' WHERE ID = ?';
				$Execute_Array = array($ID);
				$Sub_Menu_ID = $Display->Display_Single_Info_Modified($sql,'Sub_Menu_ID',$Execute_Array);
				
				$sql = 'SELECT Sub_Sub_Menu_ID FROM '.$Table.' WHERE ID = ?';
				$Execute_Array = array($ID);
				$Sub_Sub_Menu_ID = $Display->Display_Single_Info_Modified($sql,'Sub_Sub_Menu_ID',$Execute_Array);
				
				$sql = 'UPDATE '.$Table.' SET Status = ? WHERE ID != ? AND Sub_Menu_ID = ? AND Menu_ID = ? AND Sub_Sub_Menu_ID = ? AND Status != ?';
				$Execute_Array = array('2',$ID,$Sub_Menu_ID,$Menu_ID,$Sub_Sub_Menu_ID,'0');
				$Display->Execute($sql,$Execute_Array);
				
				$Path = __CACHE.$Table.'.txt';
				$Display->update_table_modified($Path);
				$this->edit_sub_menu();
			}
		public function publish_selected_sub_sub()
			{
				$Display = new sql();
				$ID = $_POST['ID'];
				if(isset($_SESSION['Arabic']))
					{
						$Table = 'sub_sub_menu';
					}
				else
					{
						$Table = 'sub_sub_menu_english';
					}
				$sql = 'UPDATE '.$Table.' SET Status = ? WHERE ID = ?';
				$Execute_Array = array('1',$ID);
				$Display->Execute($sql,$Execute_Array);
				$Path = __CACHE.$Table.'.txt';
				$Display->update_table_modified($Path);
				$this->edit_sub_menu();
			}
		public function publish_selected_sub()
			{
				$Display = new sql();
				$ID = $_POST['ID'];
				if(isset($_SESSION['Arabic']))
					{
						$Table = 'sub_menu_v2';
					}
				else
					{
						$Table = 'sub_menu_v2_english';
					}
				$sql = 'UPDATE '.$Table.' SET Status = ? WHERE ID = ?';
				$Execute_Array = array('1',$ID);
				$Display->Execute($sql,$Execute_Array);
				$Path = __CACHE.$Table.'.txt';
				$Display->update_table_modified($Path);
				$this->edit_sub_menu();
			}
		public function block_selected_menu()
			{
				$Display = new sql();
				$ID = $_POST['ID'];
				if(isset($_SESSION['Arabic']))
					{
						$Table = 'menu_v2';
					}
				else
					{
						$Table = 'menu_v2_english';
					}
				$sql = 'UPDATE '.$Table.' SET Status = ? WHERE ID = ?';
				$Execute_Array = array('2',$ID);
				$Display->Execute($sql,$Execute_Array);
				$Path = __CACHE.$Table.'.txt';
				$Display->update_table_modified($Path);
				$this->edit_sub_menu();
			}
		public function block_selected_page()
			{
				$Display = new sql();
				$ID = $_POST['ID'];
				if(isset($_SESSION['Arabic']))
					{
						$Table = 'pages_v2';
					}
				else
					{
						$Table = 'pages_v2_english';
					}
				$sql = 'UPDATE '.$Table.' SET Status = ? WHERE ID = ?';
				$Execute_Array = array('2',$ID);
				$Display->Execute($sql,$Execute_Array);
				
				$Path = __CACHE.$Table.'.txt';
				$Display->update_table_modified($Path);
				$this->edit_sub_menu();
			}
		public function block_selected_sub_sub()
			{
				$Display = new sql();
				$ID = $_POST['ID'];
				if(isset($_SESSION['Arabic']))
					{
						$Table = 'sub_sub_menu';
					}
				else
					{
						$Table = 'sub_sub_menu_english';
					}
				$sql = 'UPDATE '.$Table.' SET Status = ? WHERE ID = ?';
				$Execute_Array = array('2',$ID);
				$Display->Execute($sql,$Execute_Array);
				$Path = __CACHE.$Table.'.txt';
				$Display->update_table_modified($Path);
				$this->edit_sub_menu();
			}
		public function block_selected_sub()
			{
				$Display = new sql();
				$ID = $_POST['ID'];
				if(isset($_SESSION['Arabic']))
					{
						$Table = 'sub_menu_v2';
					}
				else
					{
						$Table = 'sub_menu_v2_english';
					}
				$sql = 'UPDATE '.$Table.' SET Status = ? WHERE ID = ?';
				$Execute_Array = array('2',$ID);
				$Display->Execute($sql,$Execute_Array);
				$Path = __CACHE.$Table.'.txt';
				$Display->update_table_modified($Path);
				$this->edit_sub_menu();
			}
		public function add_new_sub_sub_menu()
			{
				$Display = new sql();
				$validate = new validate_new();
				$MID = $_POST['ID'];
				$Sub_Menu = trim($_POST['Sub_Menu']);
				$Counter = 0;
				if(isset($_SESSION['Arabic']))
					{
						$Table = 'sub_sub_menu';
						$Table_Sub = 'sub_menu_v2';
					}
				else
					{
						$Table = 'sub_sub_menu_english';
						$Table_Sub = 'sub_menu_v2_english';
					}
				if($Sub_Menu == NULL)
					{
						$Counter++;
					}
				else
					{
						$sql = 'SELECT MID FROM '.$Table_Sub.' WHERE ID = ? AND Status != ?';
						$Execute_Array = array($MID,'0');
						$Main_Menu_ID = $Display->Display_Single_Info_Modified($sql,'MID',$Execute_Array);
						
						$Item_Exists = $validate->Item_Exists_Sub_Sub_Menu('sub_sub_menu','Sub_Name',$Sub_Menu,$Main_Menu_ID,$MID);
						if($Item_Exists)
							{
								$myTweets = array("flag" => '1');
								$Display->Write_JSON('Sub_Sub_Exists',$myTweets);
							}
						else
							{
								$myTweets = array("flag" => '0');
								$Display->Write_JSON('Sub_Sub_Exists',$myTweets);
								$sql = 'SELECT MAX(Sub_Menu_Order) AS Maximum FROM '.$Table.' WHERE MID = ? AND SMID = ? AND Status != ?';
								$Execute_Array = array($Main_Menu_ID,$MID,'0');
								$results = $Display->Display_Info($sql,$Execute_Array);
								foreach($results as $rows)
									{
										$Maximum = $rows->Maximum;
									}
								$Maximum++;
								$sql = 'INSERT INTO '.$Table.' (MID,SMID,Sub_Name,Sub_Menu_Order,Status) VALUES (?,?,?,?,?)';
								$Execute_Array = array($Main_Menu_ID,$MID,$Sub_Menu,$Maximum,'2');
								$Display->Execute($sql,$Execute_Array);
							}
					}
				$this->edit_sub_menu();
			}
		public function add_new_sub_menu()
			{
				$Display = new sql();
				$validate = new validate_new();
				$MID = $_POST['ID'];
				$Sub_Menu = trim($_POST['Sub_Menu']);
				$Counter = 0;
				if(isset($_SESSION['Arabic']))
					{
						$Table = 'sub_menu_v2';
					}
				else
					{
						$Table = 'sub_menu_v2_english';
					}
				if($Sub_Menu == NULL)
					{
						$Counter++;
					}
				else
					{
						$Item_Exists = $validate->Item_Exists_Sub_Menu('sub_menu_v2','Sub_Name',$Sub_Menu,$MID);
						if($Item_Exists)
							{
								$myTweets = array("flag" => '1');
								$Display->Write_JSON('Sub_Exists',$myTweets);
							}
						else
							{
								$myTweets = array("flag" => '0');
								$Display->Write_JSON('Sub_Exists',$myTweets);
								$sql = 'SELECT MAX(Sub_Menu_Order) AS Maximum FROM '.$Table.' WHERE MID = ? AND Status != ?';
								$Execute_Array = array($MID,'0');
								$results = $Display->Display_Info($sql,$Execute_Array);
								foreach($results as $rows)
									{
										$Maximum = $rows->Maximum;
									}
								$Maximum++;
								$sql = 'INSERT INTO '.$Table.' (MID,Sub_Name,Sub_Menu_Order,Status) VALUES (?,?,?,?)';
								$Execute_Array = array($MID,$Sub_Menu,$Maximum,'2');
								$Display->Execute($sql,$Execute_Array);
							}
					}
				$this->edit_sub_menu();
			}
		public function change_menu_order()
			{
				$Display = new sql();
				if(isset($_SESSION['Arabic']))
					{
						$Table = 'sub_menu_v2';
					}
				else
					{
						$Table = 'sub_menu_v2_english';
					}
				$Counter = 1;
				$Order = $_POST['Order'];	
				foreach ($Order as $Value) 
					{
						$sql = 'UPDATE '.$Table.' SET Sub_Menu_Order = ? WHERE ID = ?';
						$Execute_Array = array($Counter,$Value);
						$Display->Execute($sql,$Execute_Array);
						$Counter++;
					}
				$Path = __CACHE.$Table.'.txt';
				$Display->update_table_modified($Path);
				$this->edit_sub_menu();
			}
		public function update_selected_page()
			{
				$Display = new sql();
				$ID = $_POST['ID'];
				$Title = $_POST['Title'];
				
				$Content = $_POST['Content'];
				
				$Content_Stripped = trim(strip_tags($Content));
				
				$Counter = 0;
				if($Title == NULL)
					{
						$Counter++;
					}
				elseif($Content_Stripped == NULL)
					{
						$Counter++;
					}
				else
					{
						if(isset($_SESSION['Arabic']))
							{
								$Table = 'pages_v2';
								
							}
						else
							{
								$Table = 'pages_v2_english';
								
							}
							
						$Content = htmlentities($Content,ENT_QUOTES,'UTF-8');
						$sql = 'UPDATE '.$Table.' SET Title = ?, Content = ?,Content_Stripped = ? WHERE ID = ?';
						$Execute_Array = array($Title,$Content,$Content_Stripped,$ID);
						$Display->Execute($sql,$Execute_Array);
						$Path = __CACHE.$Table.'.txt';
						$Display->update_table_modified($Path);
					}
			}
		public function add_new_page_sub_sub()
			{
				$Display = new sql();
				$URL = new url();
				$this->registry->template->Member = $URL->getPar('Member');
				$this->registry->template->show('menus_pages_subs/add_new_page_sub_sub');
			}
		public function add_new_sub_sub()
			{
				$URL = new url();
				$this->registry->template->Member = $URL->getPar('Member');
				$this->registry->template->show('menus_pages_subs/add_new_sub_sub');
			}
		public function submit_new_sub_sub_menu()
			{
				$validate = new validate_new();
				$Display = new sql();
				$SMID = $_POST['ID'];
				$Sub_Name = $_POST['Sub_Name'];
				if(isset($_SESSION['Arabic']))
					{
						$Table = 'sub_sub_menu';
						$Table_Sub = 'sub_menu_v2';
					}
				else
					{
						$Table = 'sub_sub_menu_english';
						$Table_Sub = 'sub_menu_v2_english';
					}
				$sql = 'SELECT MID FROM '.$Table_Sub.' WHERE ID = ? AND Status != ?';
				$Execute_Array = array($SMID,'0');
				$MID = $Display->Display_Single_Info_Modified($sql,'MID',$Execute_Array);
				$Item_Exists_Sub_Sub_Menu = $validate->Item_Exists_Sub_Sub_Menu('sub_sub_menu','Sub_Name',$Sub_Name,$MID,$SMID);
				if($Item_Exists_Sub_Sub_Menu)
					{
						$myTweets = array("flag" => '1');
						$Display->Write_JSON('Sub_Sub_Menu_Exists',$myTweets);
					}
				else
					{
						$myTweets = array("flag" => '0');
						$Display->Write_JSON('Sub_Sub_Menu_Exists',$myTweets);
						$sql = 'SELECT MAX(Sub_Menu_Order) AS MAX FROM '.$Table.' WHERE MID = ? AND SMID = ? AND Status != ?';
						$Execute_Array = array($MID,$SMID,'0');
						$results = $Display->Display_Info($sql,$Execute_Array);
						foreach($results as $rows)
							{
								$Max = $rows->MAX;
							}
						$Max++;
						
						$sql = 'INSERT INTO '.$Table.' (MID,SMID,Sub_Name,Sub_Menu_Order,Status) VALUES (?,?,?,?,?)';
						$Execute_Array = array($MID,$SMID,$Sub_Name,$Max,'2');
						$Display->Execute($sql,$Execute_Array);
					}
			}
		public function submit_new_page_sub_sub()
			{
				$Display = new sql();
				$ID = $_POST['ID'];
				$Title = $_POST['Title'];
				
				$Content = $_POST['Content'];
				
				$Content_Stripped = trim(strip_tags($Content));
				
				$Counter = 0;
				if($Title == NULL)
					{
						$Counter++;
					}
				elseif($Content_Stripped == NULL)
					{
						
						$Counter++;
					}
				else
					{
						if(isset($_SESSION['Arabic']))
							{
								$Table = 'pages_v2';
								$Table_Sub = 'sub_menu_v2';
								$Table_Sub_Sub = 'sub_sub_menu';
								
								
							}
						else
							{
								$Table = 'pages_v2_english';
								$Table_Sub = 'sub_menu_v2_english';
								$Table_Sub_Sub = 'sub_sub_menu_english';
							}
						
						$sql = 'SELECT MID,SMID FROM '.$Table_Sub_Sub.' WHERE ID = ? AND Status != ?';
						$Execute_Array = array($ID,'0');
						$results = $Display->Display_Info($sql,$Execute_Array);
						foreach($results as $rows)
							{
								$Menu_ID = $rows->MID;
								$Sub_Menu_ID = $rows->SMID;
							}
						$Content = htmlentities($Content,ENT_QUOTES,'UTF-8');
						$sql = 'INSERT INTO '.$Table.' (Menu_ID,Sub_Menu_ID,Sub_Sub_Menu_ID,Title,Content,View,Status,Content_Stripped) VALUES (?,?,?,?,?,?,?,?)';
						$Execute_Array = array($Menu_ID,$Sub_Menu_ID,$ID,$Title,$Content,'1','2',$Content_Stripped);
						$Display->Execute($sql,$Execute_Array);
						
					}
			}
		public function submit_new_page()
			{
				$Display = new sql();
				$ID = $_POST['ID'];
				$Title = $_POST['Title'];
				
				$Content = $_POST['Content'];
				
				$Content_Stripped = trim(strip_tags($Content));
				
				$Counter = 0;
				if($Title == NULL)
					{
						$Counter++;
					}
				elseif($Content_Stripped == NULL)
					{
						
						$Counter++;
					}
				else
					{
						if(isset($_SESSION['Arabic']))
							{
								$Table = 'pages_v2';
								$Table_Sub = 'sub_menu_v2';
								
								
							}
						else
							{
								$Table = 'pages_v2_english';
								$Table_Sub = 'sub_menu_v2_english';
								
							}
						
						$sql = 'SELECT MID FROM '.$Table_Sub.' WHERE ID = ? AND Status != ?';
						$Execute_Array = array($ID,'0');
						$Menu_ID = $Display->Display_Single_Info_Modified($sql,'MID',$Execute_Array);
						
						$Content = htmlentities($Content,ENT_QUOTES,'UTF-8');
						$sql = 'INSERT INTO '.$Table.' (Menu_ID,Sub_Menu_ID,Title,Content,View,Status,Content_Stripped) VALUES (?,?,?,?,?,?,?)';
						$Execute_Array = array($Menu_ID,$ID,$Title,$Content,'1','2',$Content_Stripped);
						$Display->Execute($sql,$Execute_Array);
						
					}
			}
		
		public function add_new_page()
			{
				$Display = new sql();
				$URL = new url();
				$Member = $URL->getPar('Member');
				$this->registry->template->Member_ID = $Member;
				$this->registry->template->show('menus_pages_subs/add_new_page');
			}
		public function edit_selected_page()
			{
				$Display = new sql();
				$URL = new url();
				$Member = $URL->getPar('Member');
				if(isset($_SESSION['Arabic']))
					{
						$Table = 'pages_v2';
						
					}
				else
					{
						$Table = 'pages_v2_english';
						
					}
				$sql = 'SELECT * FROM '.$Table.' WHERE ID = ?';
				$Execute_Array = array($Member);
				$this->registry->template->Member_ID = $Member;
				$this->registry->template->results = $Display->Display_Info($sql,$Execute_Array);
				$this->registry->template->show('menus_pages_subs/edit_selected_page');
				
			}
		public function delete_selected_main_menu_item()
			{
				$Display = new sql();
				$ID = $_POST['ID'];
				if(isset($_SESSION['Arabic']))
					{
						$Table = 'menu_v2';
						$Table_Pages = 'pages_v2';
						$Table_Sub = 'sub_menu_v2';
						
					}
				else
					{
						$Table = 'menu_v2_english';
						$Table_Pages = 'pages_v2_english';
						$Table_Sub = 'sub_menu_v2_english';
					}
				$sql = 'UPDATE '.$Table_Sub.' SET Status = ? WHERE MID = ?';
				$Execute_Array = array('0',$ID);
				$Display->Execute($sql,$Execute_Array);
				
				$sql = 'UPDATE '.$Table_Pages.' SET Status = ? WHERE Menu_ID = ?';
				$Execute_Array = array('0',$ID);
				$Display->Execute($sql,$Execute_Array);
				
				$sql = 'UPDATE '.$Table.' SET Status = ? WHERE ID = ?';
				$Execute_Array = array('0',$ID);
				$Display->Execute($sql,$Execute_Array);
				$Path = __CACHE.$Table.'.txt';
				$Display->update_table_modified($Path);
				$this->edit_sub_menu();
			}
		public function delete_selected_page()
			{
				$Display = new sql();
				$ID = $_POST['ID'];
				if(isset($_SESSION['Arabic']))
					{
						$Table = 'pages_v2';
						
					}
				else
					{
						$Table = 'pages_v2_english';
						
					}
				$sql = 'SELECT Menu_ID FROM '.$Table.' WHERE ID = ?';
				$Execute_Array = array($ID);
				$Menu_ID = $Display->Display_Single_Info_Modified($sql,'Menu_ID',$Execute_Array);
				
				$sql = 'UPDATE '.$Table.' SET Status = ? WHERE ID = ?';
				$Execute_Array = array('0',$ID);
				$Display->Execute($sql,$Execute_Array);
				$Path = __CACHE.$Table.'.txt';
				$Display->update_table_modified($Path);
				$this->edit_sub_menu();
			}
		public function submit_edit_sub_sub_menu()
			{
				$validate = new validate_new();
				if(isset($_SESSION['Arabic']))
					{
						$Table = 'sub_sub_menu';
						
					}
				else
					{
						$Table = 'sub_sub_menu_english';
						
					}
				$ID = $_POST['ID'];
				$Sub_Name = trim($_POST['Menu_Name']);
				$Counter = 0;
				if($Sub_Name == NULL)
					{
						$Counter++;
					}
				$Execute = new sql();
				
				if(!$Counter)
					{
						$sql = 'SELECT MID FROM '.$Table.' WHERE ID = ? ';
						$Execute_Array = array($ID);
						$MID = $Execute->Display_Single_Info_Modified($sql,'MID',$Execute_Array);
						
						$sql = 'SELECT SMID FROM '.$Table.' WHERE ID = ? ';
						$Execute_Array = array($ID);
						$SMID = $Execute->Display_Single_Info_Modified($sql,'SMID',$Execute_Array);
						
						$Item_Exists_Edit_Modified_JSON = $validate->Item_Exists_Edit_Sub_Sub_Menu('sub_sub_menu','Sub_Name',$ID,$Sub_Name,$MID,$SMID);
						if($Item_Exists_Edit_Modified_JSON)
							{
								$myTweets = array("flag" => '1');
								$Execute->Write_JSON('Sub_Sub_Menu_Exists',$myTweets);
							}
						else
							{
								$myTweets = array("flag" => '0');
								$Execute->Write_JSON('Sub_Sub_Menu_Exists',$myTweets);
								
								$sql = 'UPDATE '.$Table.' SET Sub_Name = ? WHERE ID = ?';
								$Execute_Array = array($Sub_Name,$ID);
								$Execute->Execute($sql,$Execute_Array);
								$Path = __CACHE.$Table.'.txt';
								$Execute->update_table_modified($Path);
							}
					}
				$this->edit_sub_menu();
			}
		public function submit_edit_sub_menu()
			{
				$validate = new validate_new();
				if(isset($_SESSION['Arabic']))
					{
						$Table = 'sub_menu_v2';
						
					}
				else
					{
						$Table = 'sub_menu_v2_english';
						
					}
				$ID = $_POST['ID'];
				$Sub_Name = trim($_POST['Menu_Name']);
				$Counter = 0;
				if($Sub_Name == NULL)
					{
						$Counter++;
					}
				$Execute = new sql();
				
				if(!$Counter)
					{
						$sql = 'SELECT MID FROM '.$Table.' WHERE ID = ? ';
						$Execute_Array = array($ID);
						$MID = $Execute->Display_Single_Info_Modified($sql,'MID',$Execute_Array);
						
						$Item_Exists_Edit_Modified_JSON = $validate->Item_Exists_Edit_Sub_Menu('sub_menu_v2','Sub_Name',$ID,$Sub_Name,$MID);
						if($Item_Exists_Edit_Modified_JSON)
							{
								$myTweets = array("flag" => '1');
								$Execute->Write_JSON('Sub_Menu_Exists',$myTweets);
							}
						else
							{
								$myTweets = array("flag" => '0');
								$Execute->Write_JSON('Sub_Menu_Exists',$myTweets);
								
								$sql = 'UPDATE '.$Table.' SET Sub_Name = ? WHERE ID = ?';
								$Execute_Array = array($Sub_Name,$ID);
								$Execute->Execute($sql,$Execute_Array);
								$Path = __CACHE.$Table.'.txt';
								$Execute->update_table_modified($Path);
							}
					}
				$this->edit_sub_menu();
			}
		public function edit_sub_menu()
			{
				$Display = new sql();
				if(isset($_SESSION['Arabic']))
					{
						$Table = 'menu_v2';
						$this->registry->template->Table_Sub = 'sub_menu_v2';
						$this->registry->template->Table_Pages = 'pages_v2';
						$this->registry->template->Table_Sub_Sub = 'sub_sub_menu';
					}
				else
					{
						$Table = 'menu_v2_english';
						$this->registry->template->Table_Sub = 'sub_menu_v2_english';
						$this->registry->template->Table_Pages = 'pages_v2_english';
						$this->registry->template->Table_Sub_Sub = 'sub_sub_menu_english';
					}
				$sql = 'SELECT ID,Menu_Name,Menu_Order,Status FROM '.$Table.' WHERE Status != ? ORDER BY Menu_Order';
				$Execute_Array = array('0');
				$this->registry->template->results = $Display->Display_Info($sql,$Execute_Array);
				$this->registry->template->show('menus_pages_subs/edit_sub_menu');
			}
}

?>
