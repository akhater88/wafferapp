<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
class menusfunction
	{
		private function Display_Pages_Sub_Sub_Menu($Menu_ID,$Sub_Menu_ID,$Sub_Sub_Menu_ID)
			{
				$Display = new sql();
				if(isset($_SESSION['Arabic']))
					{
						$Table = ' pages_v2';
					}
				else
					{
						$Table = ' pages_v2_english';
					}
				$sql = 'SELECT ID,Title,Status FROM '.$Table.' WHERE Menu_ID = ? AND Sub_Menu_ID = ? AND Sub_Sub_Menu_ID = ? AND Status != ?';
				$Execute_Array = array($Menu_ID,$Sub_Menu_ID,$Sub_Sub_Menu_ID,'0');
				$results = $Display->Display_Info($sql,$Execute_Array);
				if(count($results))
					{
					?>
					<div style="line-height:10px ">&nbsp;</div>
					<div style=" position: absolute; left:280px">هـذه الـقـائـمـة تـحـتـوي عـلـى الـصـفـحـات الـتـالـيــة</div>
					<div style=" line-height:30px ">&nbsp;</div>
					<?php
					foreach($results as $rows)
						{
						?>
						<div style="position:relative ">
						<div style="position: absolute; left:420px "><?php echo stripslashes($rows->Title);?></div>
						
						<div style="position:absolute; left:390px; top:2px"><img style="cursor:pointer " src="<?php echo __SCRIPT_PATH;?>images/edit.png" width="20" height="20" onclick="createWindowWithCallBack('تـعــديــل الـصـفـحــة','<?php echo __LINK_PATH;?>menus_pages_subs/edit_selected_page/AJAX/Pop_Up/Member/<?php echo $rows->ID;?>',850,500)" /></div>
						<div class="Del_Btn" id="<?php echo $rows->ID;?>" style="position:absolute; left:360px; top:2px"><img style="cursor:pointer " src="<?php echo __SCRIPT_PATH;?>images/del.png" width="20" height="20"></div>
						<div style="line-height:10px ">&nbsp;</div>
					<?php
					if($rows->Status == '1')
						{
						?>
						<div class="check_mark_pages" id="<?php echo $rows->ID;?>" style="position:absolute; left:330px; top:2px"><img src="<?php echo __SCRIPT_PATH;?>images/Check_Mark.png" width="20" height="20"/></div>
						<?php
						}
					else
						{
						?>
						<div class="block_mark_pages" id="<?php echo $rows->ID;?>" style="position:absolute; left:330px; top:2px"><img src="<?php echo __SCRIPT_PATH;?>images/closed.png" width="20" height="20"/></div>
						<?php
						}
					?>
					</div>
					<div style=" line-height:30px ">&nbsp;</div>
						<?php
						}
						
					}
			}
		private function calculate_vertical_main_menu($Menu_ID,$Sub_Menu_ID)
			{
				$Display = new sql();
				if(isset($_SESSION['Arabic']))
					{
						$Table = ' pages_v2';
					}
				else
					{
						$Table = ' pages_v2_english';
					}
				$sql = 'SELECT ID,Title,Status FROM '.$Table.' WHERE Menu_ID = ? AND Sub_Menu_ID = ? AND Sub_Sub_Menu_ID = ? AND Status != ?';
				$Execute_Array = array($Menu_ID,$Sub_Menu_ID,'0','0');
				$results = $Display->Display_Info($sql,$Execute_Array);
				$Vertical_Distance = count($results) + 70;
				return $Vertical_Distance;
			}
		private function Display_Pages_Sub_Menu($Menu_ID,$Sub_Menu_ID)
			{
				$Display = new sql();
				if(isset($_SESSION['Arabic']))
					{
						$Table = ' pages_v2';
					}
				else
					{
						$Table = ' pages_v2_english';
					}
				$sql = 'SELECT ID,Title,Status FROM '.$Table.' WHERE Menu_ID = ? AND Sub_Menu_ID = ? AND Sub_Sub_Menu_ID = ? AND Status != ?';
				$Execute_Array = array($Menu_ID,$Sub_Menu_ID,'0','0');
				$results = $Display->Display_Info($sql,$Execute_Array);
				if(count($results))
					{
					?>
					<div style="line-height:10px ">&nbsp;</div>
					<div style=" position: absolute; left:180px">هـذه الـقـائـمـة تـحـتـوي عـلـى الـصـفـحـات الـتـالـيــة</div>
					<div style=" line-height:30px ">&nbsp;</div>
					<?php
					foreach($results as $rows)
						{
						?>
						<div style="position:relative ">
						<div style=" position: absolute; left:400px"><?php echo stripslashes($rows->Title);?></div>
						
						<div style="position:absolute; left:370px; top:2px"><img style="cursor:pointer " src="<?php echo __SCRIPT_PATH;?>images/edit.png" width="20" height="20" onclick="createWindowWithCallBack('تـعــديــل الـصـفـحــة','<?php echo __LINK_PATH;?>menus_pages_subs/edit_selected_page/AJAX/Pop_Up/Member/<?php echo $rows->ID;?>',850,500)" /></div>
						<div class="Del_Btn" id="<?php echo $rows->ID;?>" style="position:absolute; left:340px; top:2px"><img style="cursor:pointer " src="<?php echo __SCRIPT_PATH;?>images/del.png" width="20" height="20"></div>
						<div style="line-height:10px ">&nbsp;</div>
					<?php
					if($rows->Status == '1')
						{
						?>
						<div class="check_mark_pages" id="<?php echo $rows->ID;?>" style="position:absolute; left:310px; top:2px"><img src="<?php echo __SCRIPT_PATH;?>images/Check_Mark.png" width="20" height="20"/></div>
						<?php
						}
					else
						{
						?>
						<div class="block_mark_pages" id="<?php echo $rows->ID;?>" style="position:absolute; left:310px; top:2px"><img src="<?php echo __SCRIPT_PATH;?>images/closed.png" width="20" height="20"/></div>
						<?php
						}
					?>
					</div>
					<div style=" line-height:30px ">&nbsp;</div>
						<?php
						}
					}
			}
		private function Display_Pages_Main_Menu($ID)
			{
				$No_Permitted_Delete = array();
				$No_Permitted_Publish = array();
				$Display = new sql();
				if(isset($_SESSION['Arabic']))
					{
						$Table = ' pages_v2';
					}
				else
					{
						$Table = ' pages_v2_english';
					}
				$sql = 'SELECT ID,Title,Status FROM '.$Table.' WHERE Menu_ID = ? AND Sub_Menu_ID = ? AND Sub_Sub_Menu_ID = ? AND Status != ?';
				$Execute_Array = array($ID,'0','0','0');
				$results = $Display->Display_Info($sql,$Execute_Array);
				if(count($results))
					{
					?>
					<div style="line-height:10px ">&nbsp;</div>
					<div style=" position: absolute; left:30px">هـذه الـقـائـمـة تـحـتـوي عـلـى الـصـفـحـات الـتـالـيــة</div>
					<div style=" line-height:30px ">&nbsp;</div>
					<?php
					foreach($results as $rows)
						{
						?>
						<div style="position:relative ">
						
						<div style=" position: absolute; left:180px"><?php echo stripslashes($rows->Title);?></div>
						
						<div style="position:absolute; left:150px; top:2px"><img style="cursor:pointer " src="<?php echo __SCRIPT_PATH;?>images/edit.png" width="20" height="20" onclick="createWindowWithCallBack('تـعــديــل الـصـفـحــة','<?php echo __LINK_PATH;?>menus_pages_subs/edit_selected_page/AJAX/Pop_Up/Member/<?php echo $rows->ID;?>',850,500)" /></div>
						<?php
						if(!in_array($ID,$No_Permitted_Delete))
							{
							?>
							<div class="Del_Btn" id="<?php echo $rows->ID;?>" style="position:absolute; left:120px; top:2px"><img style="cursor:pointer " src="<?php echo __SCRIPT_PATH;?>images/del.png" width="20" height="20"></div>
							<?php
							}
					if(!in_array($ID,$No_Permitted_Publish))
						{
							if($rows->Status == '1')
								{
								?>
								<div class="check_mark_pages" id="<?php echo $rows->ID;?>" style="position:absolute; left:90px; top:2px"><img src="<?php echo __SCRIPT_PATH;?>images/Check_Mark.png" width="20" height="20"/></div>
								<?php
								}
							else
								{
								?>
								<div class="block_mark_pages" id="<?php echo $rows->ID;?>" style="position:absolute; left:90px; top:2px"><img src="<?php echo __SCRIPT_PATH;?>images/closed.png" width="20" height="20"/></div>
								<?php
								}
						}
					?>
					</div>
					<div style=" line-height:30px ">&nbsp;</div>
						<?php
						}
					}
			}
		private function Is_Sub_Parent($ID)
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
				$sql = 'SELECT ID FROM '.$Table.' WHERE SMID = ? AND Status != ?';
				$Execute_Array = array($ID,'0');
				$Total_Records = $Display->Total_Records($sql,$Execute_Array);
				if($Total_Records)
					{
						return true;
					}
				else
					{
						return false;
					}
			}
		private function Is_Main_Parent($ID)
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
				$sql = 'SELECT ID FROM '.$Table.' WHERE MID = ? AND Status != ?';
				$Execute_Array = array($ID,'0');
				$Total_Records = $Display->Total_Records($sql,$Execute_Array);
				if($Total_Records)
					{
						return true;
					}
				else
					{
						return false;
					}
			}
		private function IsPage_Sub_Sub($Menu_ID,$Sub_Menu_ID,$Sub_Sub_Menu_ID)
			{
				$Display = new sql();
				if(isset($_SESSION['Arabic']))
					{
						$Table = 'pages_v2';
					}
				else
					{
						$Table = 'pages_v2_english';
					}
				$sql = 'SELECT ID FROM '.$Table.' WHERE Menu_ID = ? AND Sub_Menu_ID = ? AND Sub_Sub_Menu_ID = ? AND Status != ?';
				$Execute_Array = array($Menu_ID,$Sub_Menu_ID,$Sub_Sub_Menu_ID,'0');
				$Total_Records = $Display->Total_Records($sql,$Execute_Array);
				if($Total_Records)
					{
						return true;
					}
				else
					{
						return false;
					}
				
			}
		private function IsPage_Sub($Menu_ID,$Sub_Menu_ID)
			{
				$Display = new sql();
				if(isset($_SESSION['Arabic']))
					{
						$Table = 'pages_v2';
					}
				else
					{
						$Table = 'pages_v2_english';
					}
				$sql = 'SELECT ID FROM '.$Table.' WHERE Menu_ID = ? AND Sub_Menu_ID = ? AND Sub_Sub_Menu_ID = ? AND Status != ?';
				$Execute_Array = array($Menu_ID,$Sub_Menu_ID,'0','0');
				$Total_Records = $Display->Total_Records($sql,$Execute_Array);
				if($Total_Records)
					{
						return true;
					}
				else
					{
						return false;
					}
				
			}
		private function IsPage($ID)
			{
				$Display = new sql();
				if(isset($_SESSION['Arabic']))
					{
						$Table = 'pages_v2';
					}
				else
					{
						$Table = 'pages_v2_english';
					}
				$sql = 'SELECT ID FROM '.$Table.' WHERE Menu_ID = ? AND Sub_Menu_ID = ? AND Sub_Sub_Menu_ID = ? AND Status != ?';
				$Execute_Array = array($ID,'0','0','0');
				$Total_Records = $Display->Total_Records($sql,$Execute_Array);
				if($Total_Records)
					{
						return true;
					}
				else
					{
						return false;
					}
				
			}
		public function draw_menu_diagram_modified($MID)
			{
				$No_Permitted_Pages = array();
				$No_Permitted_Deletes = array();
				$No_Permitted_Publish = array();
				$Display = new sql();
				if(isset($_SESSION['Arabic']))
					{
						$Table = 'menu_v2';
						$Table_Sub = 'sub_menu_v2';
						$Table_Sub_Sub = 'sub_sub_menu';
						$Dir = 'rtl';
					}
				else
					{
						$Table = 'menu_v2_english';
						$Table_Sub = 'sub_menu_v2_english';
						$Table_Sub_Sub = 'sub_sub_menu_english';
						$Dir = 'ltr';
					}
				$sql = 'SELECT ID,Menu_Name,Status FROM '.$Table.' WHERE ID = ? AND Status != ?';
				$Execute_Array = array($MID,'0');
				$results = $Display->Display_Info($sql,$Execute_Array);
				foreach($results as $rows)
					{
						$calculate_vertical_main_menu = 0;
						$Initial_Height = 25;
						$Increment = 27;
						$Initial_Sub_Height = 53;
						$Increment_Sub = 27;
						$Is_Main_Parent = $this->Is_Main_Parent($rows->ID);
						if(!$Is_Main_Parent)
							{
								$Enable_Page_For_Main = true;
								
							}
						else
							{
								$Enable_Page_For_Main = false;
								
							}
						$IsPage = $this->IsPage($rows->ID);
					?>
					<div style="position:relative; right:600px; width:200px; height:20px; top:-1px; background-color:#009900; color:#FFFF00; padding:3px "><div align="center"><?php echo $rows->Menu_Name;?></div>
					<?php
					if($Enable_Page_For_Main)
						{
							if(!in_array($rows->ID,$No_Permitted_Pages))
								{
								?>
								<div style="position:absolute; left:-120px; top:2px"><img style="cursor:pointer " src="<?php echo __SCRIPT_PATH;?>images/pages.png" width="20" height="20" onClick="createWindowWithCallBack('إضـافــة صـفــحــة','<?php echo __LINK_PATH;?>menus_pages_subs/add_new_page_no_sub/AJAX/Pop_Up/Member/<?php echo $rows->ID;?>/',850,500)"/></div>
								<?php
								}
						}
					?>
					<div class="Main_Menu_Class" id="<?php echo $rows->ID;?>" style="position:absolute; left:-30px; top:2px"><img style="cursor:pointer " src="<?php echo __SCRIPT_PATH;?>images/edit.png" width="20" height="20" /></div>
					<?php
					if(!in_array($rows->ID,$No_Permitted_Deletes))
						{
						?>
						<div class="Del_Btn_Main" id="<?php echo $rows->ID;?>" style="position:absolute; left:-60px; top:2px"><img style="cursor:pointer " src="<?php echo __SCRIPT_PATH;?>images/del.png" width="20" height="20"></div>
						<?php
						}
					if(!in_array($rows->ID,$No_Permitted_Publish))
						{
							if($rows->Status == '1')
								{
								?>
								<div class="check_mark_main" id="<?php echo $rows->ID;?>" style="position:absolute; left:-90px; top:2px"><img src="<?php echo __SCRIPT_PATH;?>images/Check_Mark.png" width="20" height="20"/></div>
								<?php
								}
							else
								{
								?>
								<div class="block_mark_main" id="<?php echo $rows->ID;?>" style="position:absolute; left:-90px; top:2px"><img src="<?php echo __SCRIPT_PATH;?>images/closed.png" width="20" height="20"/></div>
								<?php
								}
						}
					?>
					</div>
					<div class="Main_Menu_Field_Class" id="Main_Menu_Field_<?php echo $rows->ID;?>" style="position: relative; display:none ">
					<span><input id="Menu_Name_<?php echo $rows->ID;?>" name="Menu_Name_<?php echo $rows->ID;?>" type="text" size="34" dir="<?php echo $Dir;?>"></span>&nbsp;<span><input type="button" id="<?php echo $rows->ID;?>" name="Sub_Menu_Btn" value="إرسـال" class="Submit_Edit_Main"></span>
					&nbsp;<span style="position:absolute; right:-160px " class="main_menu_msg">&nbsp;</span>
					</div>
					<?php
					if($IsPage && $Enable_Page_For_Main)
						{
							?>
							<div align="left" style="position: relative">
							<?php
							$this->Display_Pages_Main_Menu($rows->ID);
							?>
							</div>
							<?php
						}
					?>
					
					<div class="Sub_Menu_Arrange">
					<?php
						
						$sql_sub = 'SELECT ID,Sub_Name,Status FROM '.$Table_Sub.' WHERE MID = ? AND Status != ? ORDER BY Sub_Menu_Order';
						$Execute_Array = array($MID,'0');
						$results_sub = $Display->Display_Info($sql_sub,$Execute_Array);
						
						foreach($results_sub as $rows_sub)
							{
								$Is_Sub_Parent = $this->Is_Sub_Parent($rows_sub->ID);
								if(!$Is_Sub_Parent)
									{
										$Enable_Page_For_Sub = true;
									}
								else
									{
										$Enable_Page_For_Sub = false;
									}
								$IsPage_Sub = $this->IsPage_Sub($rows->ID,$rows_sub->ID);
							?>
					<div id="Order_<?php echo $rows_sub->ID;?>" style="position:relative; right:450px; top:1px; width:200px; height:20px; background-color:#00CC00; color:#FFFF00; border:1px solid #009900; padding:2px "><div align="center"><?php echo $rows_sub->Sub_Name;?></div>
					<?php
					if($Enable_Page_For_Sub)
						{
						?>
						<div style="position:absolute; left:-150px; top:2px"><img style="cursor:pointer " src="<?php echo __SCRIPT_PATH;?>images/pages.png" width="20" height="20" onClick="createWindowWithCallBack('إضـافــة صـفــحــة','<?php echo __LINK_PATH;?>menus_pages_subs/add_new_page/AJAX/Pop_Up/Member/<?php echo $rows_sub->ID;?>/',850,500)"/></div>
						<?php
						}
					?>
					<div class="Sub_Menu_Class" id="<?php echo $rows_sub->ID;?>" style="position:absolute; left:-30px; top:2px"><img style="cursor:pointer " src="<?php echo __SCRIPT_PATH;?>images/edit.png" width="20" height="20" /></div>
					<div class="delete_sub" id="<?php echo $rows_sub->ID;?>" style="position:absolute; left:-60px; top:2px"><img style="cursor:pointer " src="<?php echo __SCRIPT_PATH;?>images/del.png" width="20" height="20"></div>
					<div style="position:absolute; left:-120px; top:2px"><img style="cursor:pointer " src="<?php echo __SCRIPT_PATH;?>images/add.png" width="20" height="20" onClick="createWindowWithCallBack('إضـافــة صـفــحــة','<?php echo __LINK_PATH;?>menus_pages_subs/add_new_sub_sub/AJAX/Pop_Up/Member/<?php echo $rows_sub->ID;?>/',500,200)"></div>
					<?php
					if($rows_sub->Status == '1')
						{
						?>
						<div class="check_mark" id="<?php echo $rows_sub->ID;?>" style="position:absolute; left:-90px; top:2px"><img src="<?php echo __SCRIPT_PATH;?>images/Check_Mark.png" width="20" height="20"/></div>
						<?php
						}
					else
						{
						?>
						<div class="block_mark" id="<?php echo $rows_sub->ID;?>" style="position:absolute; left:-90px; top:2px"><img src="<?php echo __SCRIPT_PATH;?>images/closed.png" width="20" height="20"/></div>
						<?php
						}
					?>
					</div>
					<div class="Sub_Menu_Field_Class" id="Sub_Menu_Field_<?php echo $rows_sub->ID;?>" style="position: relative;display:none ">
					<span><input id="Sub_Name_<?php echo $rows_sub->ID;?>" name="Sub_Name_<?php echo $rows_sub->ID;?>" type="text" size="35" dir="<?php echo $Dir;?>"></span>&nbsp;<span><input type="button" id="<?php echo $rows_sub->ID;?>" name="Sub_Menu_Btn" value="إرسـال" class="Submit_Edit_Sub"></span>
					
					</div>
					<?php
					if($IsPage_Sub && $Enable_Page_For_Sub)
						{
							?>
							<div align="left"  style="position: relative">
							<?php
							$this->Display_Pages_Sub_Menu($rows->ID,$rows_sub->ID);
							$calculate_vertical_main_menu += $this->calculate_vertical_main_menu($rows->ID,$rows_sub->ID);
							?>
							</div>
							<?php
						}
					
					
					$calculate_vertical_main_menu_final = $calculate_vertical_main_menu + $Initial_Height;
					?>
					
					
					<div class="Sub_Sub_Menu_Arrange">
							<?php
							$sql_sub_sub = 'SELECT ID,Sub_Name,Status FROM '.$Table_Sub_Sub.' WHERE MID = ? AND SMID = ? AND Status != ? ORDER BY Sub_Menu_Order';
							$Execute_Array = array($MID,$rows_sub->ID,'0');
							$results_sub_sub = $Display->Display_Info($sql_sub_sub,$Execute_Array);
							
							foreach($results_sub_sub as $rows_sub_sub)
								{
									$IsPage_Sub_Sub = $this->IsPage_Sub_Sub($rows->ID,$rows_sub->ID,$rows_sub_sub->ID);
								?>
								<div id="Order_<?php echo $rows_sub_sub->ID;?>" style="position:relative; right:345px; top:2px; width:200px; height:20px; background-color:#00FF66; color:#FFFF00; border:1px solid #009900; padding:2px "><div align="center"><?php echo $rows_sub_sub->Sub_Name;?></div>
								<div class="Sub_Sub_Menu_Class" id="<?php echo $rows_sub_sub->ID;?>" style="position:absolute; left:-30px; top:2px"><img style="cursor:pointer " src="<?php echo __SCRIPT_PATH;?>images/edit.png" width="20" height="20" /></div>
								<div class="delete_sub_sub" id="<?php echo $rows_sub_sub->ID;?>" style="position:absolute; left:-60px; top:2px"><img style="cursor:pointer " src="<?php echo __SCRIPT_PATH;?>images/del.png" width="20" height="20"></div>
								<div style="position:absolute; left:-120px; top:2px"><img style="cursor:pointer " src="<?php echo __SCRIPT_PATH;?>images/pages.png" width="20" height="20" onClick="createWindowWithCallBack('إضـافــة صـفــحــة','<?php echo __LINK_PATH;?>menus_pages_subs/add_new_page_sub_sub/AJAX/Pop_Up/Member/<?php echo $rows_sub_sub->ID;?>/',850,500)"/></div>
								<?php
								if($rows_sub_sub->Status == '1')
									{
									?>
									<div class="check_mark_sub_sub" id="<?php echo $rows_sub_sub->ID;?>" style="position:absolute; left:-90px; top:2px"><img src="<?php echo __SCRIPT_PATH;?>images/Check_Mark.png" width="20" height="20"/></div>
									<?php
									}
								else
									{
									?>
									<div class="block_mark_sub_sub" id="<?php echo $rows_sub_sub->ID;?>" style="position:absolute; left:-90px; top:2px"><img src="<?php echo __SCRIPT_PATH;?>images/closed.png" width="20" height="20"/></div>
									<?php
									}
								?>
								
								</div>
								<div class="Sub_Sub_Menu_Field_Class" id="Sub_Sub_Menu_Field_<?php echo $rows_sub_sub->ID;?>" style="position: relative; display:none ">
								<span><input id="Sub_Sub_Name_<?php echo $rows_sub_sub->ID;?>" name="Sub_Sub_Name_<?php echo $rows_sub_sub->ID;?>" type="text" size="34" dir="<?php echo $Dir;?>"></span>&nbsp;<span><input type="button" id="<?php echo $rows_sub_sub->ID;?>" name="Sub_Menu_Btn" value="إرسـال" class="Submit_Edit_Sub_Sub"></span>
								
								</div>
								<?php
								if($IsPage_Sub_Sub)
									{
										?>
										<div align="left" style="position: relative">
										<?php
										$this->Display_Pages_Sub_Sub_Menu($rows->ID,$rows_sub->ID,$rows_sub_sub->ID);
										?>
										</div>
										<?php
									}
								?>
								
								
								<div style="line-height:1px ">&nbsp;</div>
								<?php
								$Initial_Sub_Height += $Increment_Sub;
								$Initial_Height += $Increment+1;
								}
								?>
								<div style="line-height:1px ">&nbsp;</div>
								</div>
								<?php
								$Initial_Height += $Increment;
								$Initial_Sub_Height += $Increment_Sub;
							}
							?>
							</div>
							<?php
					}
			}
		public function draw_menu_diagram($MID)
			{
				$Display = new sql();
				if(isset($_SESSION['Arabic']))
					{
						$Table = 'menu_v2';
						$Table_Sub = 'sub_menu_v2';
						$Table_Sub_Sub = 'sub_sub_menu';
						$Dir = 'rtl';
					}
				else
					{
						$Table = 'menu_v2_english';
						$Table_Sub = 'sub_menu_v2_english';
						$Table_Sub_Sub = 'sub_sub_menu_english';
						$Dir = 'ltr';
					}
				$sql = 'SELECT Menu_Name FROM '.$Table.' WHERE ID = ? AND Status != ?';
				$Execute_Array = array($MID,'0');
				$results = $Display->Display_Info($sql,$Execute_Array);
				foreach($results as $rows)
					{
					?>
					<div style="position:absolute; right:700px; width:100px; height:20px; background-color:#009900; color:#FFFF00 "><div align="center"><?php echo $rows->Menu_Name;?></div></div>
					<?php
						$sql_sub = 'SELECT ID,Sub_Name FROM '.$Table_Sub.' WHERE MID = ? AND Status != ? ORDER BY Sub_Menu_Order';
						$Execute_Array = array($MID,'0');
						$results_sub = $Display->Display_Info($sql_sub,$Execute_Array);
						$Initial_Top = 22;
						$Increment = 25;
						
						$Initial_Top_Sub_Sub = 22;
						$Increment_Sub_Sub = 25;
						foreach($results_sub as $rows_sub)
							{
							?>
							<div style="position:absolute; right:650px; top:<?php echo $Initial_Top;?>px; width:100px; height:20px; background-color:#00CC00; color:#FFFF00; border:1px solid #009900; padding:2px "><div align="center"><?php echo $rows_sub->Sub_Name;?></div></div>
							<?php
							$Initial_Top += $Increment;
							$sql_sub_sub = 'SELECT Sub_Name FROM '.$Table_Sub_Sub.' WHERE MID = ? AND SMID = ? AND Status != ? ORDER BY Sub_Menu_Order';
							$Execute_Array = array($MID,$rows_sub->ID,'0');
							$results_sub_sub = $Display->Display_Info($sql_sub_sub,$Execute_Array);
							foreach($results_sub_sub as $rows_sub_sub)
								{
								?>
								<div style="position:absolute; right:545px; top:<?php echo $Initial_Top;?>px; width:100px; height:20px; background-color:#00FF66; color:#FFFF00; border:1px solid #009900; padding:2px "><div align="center"><?php echo $rows_sub_sub->Sub_Name;?></div></div>
								<?php
								$Initial_Top += $Increment;
								}
							}
							
					}
			}
		public function IsSub_Sub($SMID)
			{
				$Display = new sql();
				if(isset($_SESSION['Arabic']))
					{
						$Table = 'sub_sub_menu';
						$Dir = 'rtl';
					}
				else
					{
						$Table = 'sub_sub_menu_english';
						$Dir = 'ltr';
					}
				$sql = 'SELECT ID FROM '.$Table.' WHERE SMID = ? AND Status != ?';
				$Execute_Array = array($SMID,'0');
				$Total_Records = $Display->Total_Records($sql,$Execute_Array);
				if($Total_Records)
					{
						?>
						<div class="Sub_Sub_Menu_Arrange">
						<?php
						$sql = 'SELECT * FROM '.$Table.' WHERE SMID = ? AND Status != ? ORDER BY Sub_Menu_Order';
						$Execute_Array = array($SMID,'0');
						$results = $Display->Display_Info($sql,$Execute_Array);
						foreach($results as $rows)
							{
							?>
							<div id="Order_<?php echo $rows->ID;?>">
							<div style="position:relative; right:30px; color:#009933 "><?php echo $rows->Sub_Name;?></div>
							</div>
							<?php
							}
							?>
							</div>
							<div dir="rtl" style="position:relative; right:30px "><span class="Sub_Sub_Menu" id="<?php echo $SMID;?>" style="cursor:pointer "><img src="<?php echo __SCRIPT_PATH;?>images/add.png" /></span>&nbsp;<span>أضــف قـائـمــة تـشـعـبـيــة </span></div>
							<div style="position:relative ">
							<div dir="rtl" class="Sub_Sub_Menu_Field" id="Sub_Sub_Menu_Field_<?php echo $SMID;?>" style="display:none; position: absolute; right:190px; top:-30px "><input id="Sub_Sub_Name_<?php echo $SMID;?>" name="Sub_Sub_Name_<?php echo $SMID;?>" type="text"  dir="<?php echo $Dir;?>" size="30" /><input type="button" id="<?php echo $SMID;?>" name="Sub_Menu_Btn" value="إرسـال" class="Submit_Sub_Sub">&nbsp;<span class="sub_sub_menu_msg"></span></div>
							</div>
							<?php
							
					}
				else
					{
					?>
					<div dir="rtl" style="position:relative; right:30px "><span class="Sub_Sub_Menu" id="<?php echo $SMID;?>" style="cursor:pointer "><img src="<?php echo __SCRIPT_PATH;?>images/add.png" /></span>&nbsp;<span>أضــف قـائـمــة تـشـعـبـيــة </span></div>
					<div style="position:relative ">
					<div dir="rtl" class="Sub_Sub_Menu_Field" id="Sub_Sub_Menu_Field_<?php echo $SMID;?>" style="display:none; position: absolute; right:190px; top:-30px "><input id="Sub_Sub_Name_<?php echo $SMID;?>" name="Sub_Sub_Name_<?php echo $SMID;?>" type="text"  dir="<?php echo $Dir;?>" size="30" /><input type="button" id="<?php echo $SMID;?>" name="Sub_Menu_Btn" value="إرسـال" class="Submit_Sub_Sub">&nbsp;<span class="sub_sub_menu_msg"></span></div>
					</div>
					<?php
					}
			}
		public function IsSub($MID)
			{
				$Display = new sql();
				if(isset($_SESSION['Arabic']))
					{
						$Table = 'sub_menu_v2';
						$Dir = 'rtl';
					}
				else
					{
						$Table = 'sub_menu_v2_english';
						$Dir = 'ltr';
					}
				$sql = 'SELECT ID FROM '.$Table.' WHERE MID = ? AND Status != ?';
				$Execute_Array = array($MID,'0');
				$Total_Records = $Display->Total_Records($sql,$Execute_Array);
				if($Total_Records)
					{
						?>
						<div class="Sub_Menu_Arrange">
						<?php
						$sql = 'SELECT * FROM '.$Table.' WHERE MID = ? AND Status != ? ORDER BY Sub_Menu_Order';
						$Execute_Array = array($MID,'0');
						$results = $Display->Display_Info($sql,$Execute_Array);
						foreach($results as $rows)
							{
							?>
							<div id="Order_<?php echo $rows->ID;?>">
							<div dir="rtl" style=" color:#FF6600 "><?php echo $rows->Sub_Name;?></div>
							<?php
							$this->IsSub_Sub($rows->ID);
							?>
							</div>
							<?php
							}
							?>
							</div>
							<div dir="rtl"><span class="Sub_Menu" id="<?php echo $MID;?>" style="cursor:pointer "><img src="<?php echo __SCRIPT_PATH;?>images/add.png" />&nbsp;<span>أضـف قـائـمـة فـرعـيــة </span></div>
							<div style="position:relative ">
							<div class="Sub_Menu_Field" id="Sub_Menu_Field_<?php echo $MID;?>" style="display:none; position:absolute; right:170px; top:-30px " dir="rtl"><input id="Sub_Name_<?php echo $MID;?>" name="Sub_Name_<?php echo $MID;?>" type="text"  dir="<?php echo $Dir;?>" size="30" /><input type="button" id="<?php echo $MID;?>" name="Sub_Menu_Btn" value="إرسـال" class="Submit_Sub">&nbsp;<span class="sub_menu_msg"></div>
							</div>
					<?php
					}
				else
					{
					?>
					<div dir="rtl"><span class="Sub_Menu" id="<?php echo $MID;?>" style="cursor:pointer "><img src="<?php echo __SCRIPT_PATH;?>images/add.png" /></span>&nbsp;<span>أضـف قـائـمـة فـرعـيــة </span>
					<span class="Sub_Menu_Field" id="Sub_Menu_Field_<?php echo $MID;?>" style="display:none; position:relative; right:20px; top:-5px "><input id="Sub_Name" name="Sub_Name" type="text"  dir="<?php echo $Dir;?>" size="30" /><input type="button" id="<?php echo $MID;?>" name="Sub_Menu_Btn" value="إرسـال" class="Submit_Sub">&nbsp;<span class="sub_menu_msg"></span>
					</div>
					<?php
					}
			}
	}
?>