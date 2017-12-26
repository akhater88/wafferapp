<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="<?php echo __SCRIPT_PATH;?>js/MyScript.js"></script>
<?php
class misc
	{  
		public function Sub_Exists($FID)
			{
				if(isset($_SESSION['Arabic']))
					{
						$Table_Sub = 'sub_files';
					}
				else
					{
						$Table_Sub = 'sub_files_english';
					}
				$Execute = new sql();
				$sql = 'SELECT ID FROM '.$Table_Sub.' WHERE FID = ? AND Status = ?';
				$Execute_Array = array($FID,'1');
				$Total_Records = $Execute->Total_Records($sql,$Execute_Array);
				if($Total_Records)
					{
						return true;
					}
				else
					{
						return false;
					}
			}
		private function page_exists_for_sub($PID)
			{
				if(isset($_SESSION['Arabic']))
					{
						$Table_Sub = 'pages';
					}
				else
					{
						$Table_Sub = 'pages_english';
					}
				$Execute = new sql();
				$sql = 'SELECT ID FROM '.$Table_Sub.' WHERE Sub_Menu_ID = ? AND Status != ?';
				$Execute_Array = array($PID,'0');
				$Total_Records = $Execute->Total_Records($sql,$Execute_Array);
				if($Total_Records)
					{
						return true;
					}
				else
					{
						return false;
					}
			}
		private function page_exists($PID)
			{
				if(isset($_SESSION['Arabic']))
					{
						$Table_Sub = 'pages';
					}
				else
					{
						$Table_Sub = 'pages_english';
					}
				$Execute = new sql();
				$sql = 'SELECT ID FROM '.$Table_Sub.' WHERE Menu_ID = ? AND Status != ?';
				$Execute_Array = array($PID,'0');
				$Total_Records = $Execute->Total_Records($sql,$Execute_Array);
				if($Total_Records)
					{
						return true;
					}
				else
					{
						return false;
					}
			}
		private function sub_menu_exists($MID)
			{
				if(isset($_SESSION['Arabic']))
					{
						$Table_Sub = 'sub_menu';
					}
				else
					{
						$Table_Sub = 'sub_menu_english';
					}
				$Execute = new sql();
				$sql = 'SELECT ID FROM '.$Table_Sub.' WHERE MID = ? AND Status != ?';
				$Execute_Array = array($MID,'0');
				$Total_Records = $Execute->Total_Records($sql,$Execute_Array);
				if($Total_Records)
					{
						return true;
					}
				else
					{
						return false;
					}
			}
		public function check_menu_relations($MID)
			{
				$sub_menu_exists = $this->sub_menu_exists($MID);
				$page_exists = $this->page_exists($MID);
				if(($sub_menu_exists) || ($page_exists))
					{
						return true;
					}
				else
					{
						return false;
					}
			}
		public function check_sub_menu_relations($Sub_Menu_ID)
			{
				$page_exists_for_sub = $this->page_exists_for_sub($Sub_Menu_ID);
				if($page_exists_for_sub)
					{
						return true;
					}
				else
					{
						return false;
					}
			}
		public function count_events($day,$month,$year) {

			$Display = new sql();
			if(isset($_SESSION['Arabic']))
				{
					$Table = 'calendar_event';
				}
			else
				{
					$Table = 'calendar_event_english';
				}
			$sql = 'SELECT * FROM '.$Table.' WHERE day = ? AND month = ? AND year = ?';
			$Execute_Array = array($day,$month,$year);
			$result = $Display->Display_Info($sql,$Execute_Array);
			
			if (count($result) ){
				
				if(count($result) > 0) { 
				
				if(count($result) > 1) { $event = "Events"; } else { $event = "Event"; }
				$counted = count($result).' '.$event;
				
				}
				return $counted;
			}	
		}

		public function list_events($day,$month,$year) {
			$Auth = true;
			$Display = new sql();
			if(isset($_SESSION['Arabic']))
				{
					$Table = 'calendar_event';
				}
			else
				{
					$Table = 'calendar_event_english';
				}
			$sql = 'SELECT * FROM '.$Table.' WHERE day = ? AND month =? AND year = ? ORDER BY start_time';
			$Execute_Array = array($day,$month,$year);
			$result = $Display->Display_Info($sql,$Execute_Array);
			
			if(count($result)) {
				echo "<div align='right'>";
				echo "<div class='list'>";
				
				if(count($result) == 0) { 
					
					echo "No events"; 
					
					} else {
					
					echo "<div id='event_row_last'><b>";
					if(isset($_SESSION['Arabic']))
						{
							if(count($result) > 1) { echo ".عـنـدك حـالـيــا ".count($result)." مـنـاسبـات مـسـجـلــة"; } else { echo "عـنـدك حـالـيـا مـنـاسـبـة واحـدة مسـجـلـة"; }
							echo "</b></div>";
						}
					else
						{
							if(count($result) > 1) { echo "There are currently ".count($result)." events scheduled."; } else { echo "There is currently ".count($result)." event scheduled."; }
							echo "</b></div>";
						}
					$Del = __SCRIPT_PATH.'images/delete_new.png';
					$Edit = __SCRIPT_PATH.'images/edit_new.png';
					foreach($result as $rows) {
					$Update_Link = __LINK_PATH.'my_cal/delete_selected_event_AJAX/Member/'.$rows->ID.'/AJAX/Y/';
					$Update_Link_2 = __LINK_PATH.'my_cal/edit_selected_event_cal/Member/'.$rows->ID.'/';
					$Click = "RedirectToDeleteModified('".$Update_Link."')";
					$Click_Edit = "RedirectModified('".$Update_Link_2."')";
					if($rows->start_time == '00:00:00')
						{
							
							if($Auth)
								{
									echo "<div style='position:relative'>";
									echo "<div style='position:absolute; right:310px; top:40px'><img src='$Del' onClick=".$Click." style='cursor:pointer'></div>";
									echo "<div style='position:absolute; right:360px; top:40px'><img src='$Edit' onClick=".$Click_Edit." style='cursor:pointer'></div>";
									echo "</div>";
								}
							
							echo "<div id='event_row'>";
							echo "<h2>" . stripslashes($rows->event) . "</h2>";
							if($rows->location == NULL)
								{
									echo "<p class='meta'> All day event ". "</p>";
								}
							else
								{
									echo "<p class='meta'>" . stripslashes($rows->location) . "</br /> All day event ". "</p>";
								}
							if(strip_tags($rows->description) != NULL)
								{
									echo "<p>" . stripslashes(html_entity_decode($rows->description,ENT_QUOTES,'UTF-8')) . "</p>";
								}
							
							echo "</div>";
						}
					else
						{
							if($Auth)
								{
									echo "<div style='position:relative'>";
									echo "<div style='position:absolute; right:310px; top:40px'><img src='$Del' onClick=".$Click." style='cursor:pointer'></div>";
									echo "<div style='position:absolute; right:360px; top:40px'><img src='$Edit' onClick=".$Click_Edit." style='cursor:pointer'></div>";
									echo "</div>";
								}
							echo "<div id='event_row'>";
					
							echo "<h2>" . stripslashes($rows->event) . "</h2>";
							if($rows->location == NULL)
								{
									echo "<p class='meta'> from " . $rows->start_time . " to " . $rows->end_time . "</p>";
								}
							else
								{
									echo "<p class='meta'>" . stripslashes($rows->location) . "</br /> from " . $rows->start_time . " to " . $rows->end_time . "</p>";
								}
							if(strip_tags($rows->description) != NULL)
								{
									echo "<p>" . stripslashes(html_entity_decode($rows->description,ENT_QUOTES,'UTF-8')) . "</p>";
								}
							
							echo "</div>";
						}
					
					
					}
				
				}
					
				echo "</div>"; 
				echo "</div>"; 
			}
		else
			{
				echo "<div align='right'>";
				echo "<div class='list'>";
				echo "<div id='event_row_last'><b>";
				if(isset($_SESSION['Arabic']))
					{
						echo "لا يـوجـد عـنـدك مـنـاسـبـات لـهـذا الـيــوم";
					}
				else
					{
						echo "You have no events for the selected date";
					}
				
				echo "</b></div>";
				echo "</div>"; 
				echo "</div>"; 
			}
		}
	}
?>