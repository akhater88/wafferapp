<?php
class myfunctions
	{
		public function checkpoint($point,$userID)
		{
			$Display = new sql();
			$sql = "SELECT 	Accum_Points FROM my_claimed_prizes_english WHERE UID = ? AND Status = ?";
			$Execute_array = array($userID,'1');
			$point_accum = $Display->Display_Single_Info($sql,'Accum_Points',$Execute_array);
			if ($point <= $point_accum)
			return true;
			else 
			return false;
			
			
		}
		public function display_mobile_menu($active)
			{
				$menu1 ="";
				$menu2 ="";
				$menu3 ="";
				$menu4 ="";
				$menu5 ="";
				switch ($active) {
					case '1':
						$menu1 = 'id="active1"';
					break;
					case '2':
						$menu2 = 'id="active2"';
					break;
					case '3':
						$menu3 = 'id="active3"';
					break;
					case '4':
						$menu4 = 'id="active4"';
					break;
					case '5':
						$menu5 = 'id="active5"';
					break;
					default:
						$menu1 = 'id="active1"';
					break;
				}
				?>
				<ul class="tab-nav">
			       <li class="menu1" <?php echo $menu1?>  style="text-align:center"><a href="<?php echo __LINK_PATH;?>mobile_users_functions/show_account" class="menu-link">الرئيسية</a></li>
			       <li class="menu2" <?php echo $menu2?>  style="text-align:center"><a href="<?php echo __LINK_PATH;?>mobile_users_functions/invite_friends" class="menu-link">دعوة أصدقاء</a></li>
			       <li class="menu3" <?php echo $menu3?>  style="text-align:center"><a href="<?php echo __LINK_PATH;?>mobile_users_functions/show_prizes" class="menu-link">طلب جوائز</a></li>
			       <li class="menu4" <?php echo $menu4?>  style="text-align:center"><a href="<?php echo __LINK_PATH;?>mobile_users_functions/show_arrived_prizes" class="menu-link">جوائز مستلمة</a></li>
			       <li class="menu5" <?php echo $menu5?>  style="text-align:center"><a href="<?php echo __LINK_PATH;?>mobile_users_functions/edit_pw" class="menu-link">تغيير كلمة السر</a></li>
			       <li class="menu6" style="text-align:center"><a href="<?php echo __LINK_PATH;?>mobile_users/LogOff" class="menu-link">خروج</a></li>
			     </ul>
				<?php
				
			}
		public function display_banner()
			{
				$Display = new sql();
				$cache = new cache();
				if(isset($_SESSION['Arabic_Visitors']))
					{
						$Table = 'plain_images_banner';
					}
				else
					{
						$Table = 'plain_images_banner_english';
					}
				$Path_To_File = __CACHE.$Table.'.txt';
				$Cached_File = __CACHE.base64_encode('bannertgFr').'.html';
				$needs_Update = $cache->needs_Update($Cached_File,$Path_To_File);
				if($needs_Update)
					{
						ob_start();
						$sql = 'SELECT Image_Path FROM '.$Table.' WHERE Status = ?';
						$Execute_Array = array('1');
						$results = $Display->Display_Info($sql,$Execute_Array);
						$counter = 0;
						foreach($results as $rows)
							{
							    $active = '';
							    if($counter == 0){
							        $active = 'active';
							    }
							    $counter++;
							?>
							 <div class="item <?php echo $active?>">
                                           <img src="<?php echo __IMAGE_PATH;?>Plain_Image_Gallery/<?php echo $rows->Image_Path;?>" />
                              </div>
							
							<?php
							}
						$fp = fopen($Cached_File,'w');
						fwrite($fp, ob_get_contents()); 
						fclose($fp);
						ob_end_flush();
					}
				else
					{
						require_once($Cached_File);
					}
			}
		public function Is_Laget()
			{
				if((isset($_SESSION['Location_Indicator'])) && ($_SESSION['Location_Indicator'] == __LINK_PATH))
					{
						return true;
					}
				else
					{
						unset($_SESSION['User_ID']);
						unset($_SESSION['User_level_Session']);
						$_SESSION['Mobile_User_Auth'] =  false;
						return false;
					}
			}
		public function Is_Level_Set()
			{
				if(isset($_SESSION['User_level_Session']))
					{
						if(isset($_SESSION['User_level_Session']))
							{
								return true;
							}
						else
							{
								return false;
							}
					}
				else
					{
						return false;
					}
			}
		public function Is_Level_One($Level)
			{
				if(isset($_SESSION['User_level_Session']))
					{
						if(in_array($_SESSION['User_level_Session'],$Level))
							{
								return true;
							}
						else
							{
								return false;
							}
					}
				else
					{
						return false;
					}
			}
		public function check_credentials($Lang='',$Copy='',$SID='')
			{
				$Is_Level_Set = $this->Is_Level_Set();
				$Allowed_Levels = array('1','2','3','4','5');
				$Is_Level_One = $this->Is_Level_One($Allowed_Levels);
				if(($Is_Level_Set) && ($Is_Level_One))
					{
						if($Lang == NULL)
							{
								if($Copy == NULL)
									{
										$this->display_cms_menu_copy('',$SID);
									}
								else
									{
										$this->display_cms_menu();
									}
							}
						else
							{
								if($Copy == NULL)
									{
										$this->display_cms_menu($Lang);
									}
								else
									{
										$this->display_cms_menu_copy($Lang,$SID);
									}
							}
					}
			}
		private function Does_Sub_Sub_Menu_Exist($MID,$Table)
			{
				$Display = new sql();
				$sql = 'SELECT ID FROM '.$Table.' WHERE Status = ? and SMID = ?';
				$Execute_Array = array('1',$MID);
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
		private function Does_Sub_Menu_Exist($MID,$Table)
			{
				$Display = new sql();
				$sql = 'SELECT ID FROM '.$Table.' WHERE Status = ? and MID = ?';
				$Execute_Array = array('1',$MID);
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
		private function display_cms_menu_copy($Lang='',$SID)
			{
				$Display = new sql();
				if(isset($_SESSION['Arabic']))
					{
						$Table_Menu = 'master_menu';
						$Table_Sub = 'master_submenu';
						$Table_Sub_Sub = 'master_sub_sub';
					}
				else
					{
						$Table_Menu = 'master_menu_english';
						$Table_Sub = 'master_submenu_english';
						$Table_Sub_Sub = 'master_sub_sub_english';
					}
				$sql = 'SELECT ID,Menu_Name FROM '.$Table_Menu.' WHERE Status = ? and SID = ? ORDER BY Menu_Order';
				$Execute_Array = array('1',$SID);
				$results = $Display->Display_Info($sql,$Execute_Array);
				?>
                <ul class="art-menu">
                <?php
				foreach($results as $rows)
					{
						$Does_Sub_Menu_Exist = $this->Does_Sub_Menu_Exist($rows->ID,$Table_Sub);
						if($Does_Sub_Menu_Exist)
							{
								?>
                                <li>
                        <a href="#"><span class="l"></span><span class="r"></span><span class="t" style="font-size:16px; font-weight:bold "><?php echo $rows->Menu_Name;?></span></a>
                                <ul>
                                <div style="position:relative; right:22px">
                                <?php
								$sql_sub = 'SELECT ID,Sub_Name,Parent,Page_Link FROM '.$Table_Sub.' WHERE Status = ? AND MID = ?';
								$Execute_Array_Sub = array('1',$rows->ID);
								$results_sub = $Display->Display_Info($sql_sub,$Execute_Array_Sub);
								foreach($results_sub as $rows_sub)
									{
										
										$Does_Sub_Sub_Menu_Exist = $this->Does_Sub_Sub_Menu_Exist($rows_sub->ID,$Table_Sub_Sub);
										if($Does_Sub_Sub_Menu_Exist)
											{
												?>
                                                <li><a href="#"><span style="font-size:15px; margin-right:6px "><?php echo $rows_sub->Sub_Name;?></span></a>
                                                <ul>
                                                <?php
												$sql_sub_sub = 'SELECT ID,Sub_Sub_Name,Page_Link FROM '.$Table_Sub_Sub.' WHERE Status = ? AND SMID = ?';
												$Execute_Array_Sub_Sub = array('1',$rows_sub->ID);
												$results_sub_sub = $Display->Display_Info($sql_sub_sub,$Execute_Array_Sub_Sub);
												foreach($results_sub_sub as $rows_sub_sub)
													{
														?>
                                                        <li><a href="<?php echo __LINK_PATH.$rows_sub_sub->Page_Link;?>"><span style="font-size:15px; margin-right:6px "><?php echo $rows_sub_sub->Sub_Sub_Name;?></span></a></li>
                                                        <?php
														
													}
													?>
                                                    </ul>
                                                    </li>
                                                    <?php
											}
										else
											{
											?>
                                            <li><a href="<?php echo __LINK_PATH.$rows_sub->Page_Link;?>"><span style="font-size:15px; margin-right:6px "><?php echo $rows_sub->Sub_Name;?></span></a>
                                            </li>
                                            <?php
											}
									}
								?>
                                </div>
                                </ul>
                                <?php
									
							}
						else
							{
							?>
                            <li>
                        <a href="#"><span class="l"></span><span class="r"></span><span class="t" style="font-size:16px; font-weight:bold "><?php echo $rows->Menu_Name;?></span></a>
                            </li>
                            <?php
							}
						?>
                        </li>
                        <?php
					}
					?>
                    <li>
				<a href="<?php echo __LINK_PATH;?>members/LogOff"><span class="l"></span><span class="r"></span><span class="t" style="font-size:16px; font-weight:bold">مـغـادرة</span></a>
			</li>
                    </ul>
                    <?php
				
			}	
		private function super_admin_menu()
			{
			?>
			<div class="menu-inner">
			<img alt="" src="<?php echo __SCRIPT_PATH;?>images/arrow-inner.jpg" width="10" height="8" />&nbsp;<a href="#z" class="inner" id="Item_1_Main">الإداريــون</a>
			<div class="Item_1" id="Item_1" style="display:none ">
				<ul>
					<li><a href="<?php echo __LINK_PATH;?>members/verify_type" class="inner">إضــافــة</a></li> 
					<li><a href="<?php echo __LINK_PATH;?>members/edit_member" class="inner">تـعـديــل / مـسـح</a></li>
				</ul>
			</div>
			</div >
			<div class="line-inner">
			<img alt="" src="<?php echo __SCRIPT_PATH;?>images/inner-menu-line.jpg" width="258" height="2" /></div>
			<div class="menu-inner">
			<img alt="" src="<?php echo __SCRIPT_PATH;?>images/arrow-inner.jpg" width="10" height="8" />&nbsp;<a href="#z" class="inner">رابط للقائمة الرئيسية هنا</a></div >
			<div class="line-inner">
			<img alt="" src="<?php echo __SCRIPT_PATH;?>images/inner-menu-line.jpg" width="258" height="2" /></div>
			<div class="menu-inner">
			<img alt="" src="<?php echo __SCRIPT_PATH;?>images/arrow-inner.jpg" width="10" height="8" />&nbsp;<a href="#z" class="inner">رابط للقائمة هنا</a></div >
			<div class="line-inner">
			<img alt="" src="<?php echo __SCRIPT_PATH;?>images/inner-menu-line.jpg" width="258" height="2" /></div>
			<div class="menu-inner">
			<img alt="" src="<?php echo __SCRIPT_PATH;?>images/arrow-inner.jpg" width="10" height="8" />&nbsp;<a href="#z" class="inner">رابط للقائمة الرئيسية هنا</a></div >
			<div class="line-inner">
			<img alt="" src="<?php echo __SCRIPT_PATH;?>images/inner-menu-line.jpg" width="258" height="2" /></div>
			<div class="menu-inner">
			<img alt="" src="<?php echo __SCRIPT_PATH;?>images/arrow-inner.jpg" width="10" height="8" />&nbsp;<a href="#z" class="inner">رابط للقائمة هنا</a></div >
			<div class="line-inner">
			<img alt="" src="<?php echo __SCRIPT_PATH;?>images/inner-menu-line.jpg" width="258" height="2" /></div>
			<!--
			<ul class="art-menu">
			<li>
				<a href="#"><span class="l"></span><span class="r"></span><span class="t" style="font-size:16px; font-weight:bold ">تـحـكـم إداري</span></a>
					<ul>
					<div style="position:relative; left:10px ">
						<li><a href=""><span style="font-size:15px; margin-right:6px ">الإداريــون</span></a>
						<ul>
							<li><a href="<?php echo __LINK_PATH;?>members/verify_type"><span style="font-size:15px; margin-right:6px ">إضــافــة</span></a></li> 
							<li><a href="<?php echo __LINK_PATH;?>members/edit_member"><span style="font-size:15px; margin-right:6px ">تـعـديــل / مـسـح</span></a></li>
						</ul>
						</li>
						<li><a href="<?php echo __LINK_PATH;?>menus_pages_subs/edit_sub_menu"><span style="font-size:15px; margin-right:6px ">الـقـوائـم و الـصـفـحـات</span></a></li>
						<li><a href="<?php echo __LINK_PATH;?>ads/ads_cat"><span style="font-size:15px; margin-right:6px ">الـتـصـنـيـف الـدعـائـي</span></a></li>
						<li><a href="<?php echo __LINK_PATH;?>ads/ads_sub_cat"><span style="font-size:15px; margin-right:6px ">الـتـصـنـيـف الـدعـائـي الـفـرعـي</span></a></li>
						<li><a href="<?php echo __LINK_PATH;?>countries/add_country"><span style="font-size:15px; margin-right:6px ">الـبـلـدان</span></a></li>
						<li><a href="<?php echo __LINK_PATH;?>adminprizes/add_prize"><span style="font-size:15px; margin-right:6px ">الـجـوائـز</span></a></li>
					</div>
					</ul>
				</li>
				<li>
				<a href="#"><span class="l"></span><span class="r"></span><span class="t" style="font-size:16px; font-weight:bold ">الـعـروض</span></a>
					<ul>
					<div style="position:relative; right:10px ">
						<li><a href="<?php echo __LINK_PATH;?>adminadvertisers/add_offer_start"><span style="font-size:15px; margin-right:6px ">قـائـمـة الـعـروض</span></a></li>
						<li><a href="<?php echo __LINK_PATH;?>adminadvertisers/search_offer"><span style="font-size:15px; margin-right:6px ">بـحـث الـعـروض</span></a></li>
					</div>
					</ul>
				</li>
				<li>
				<a href="<?php echo __LINK_PATH;?>adminadvertisers/serach_log"><span class="l"></span><span class="r"></span><span class="t" style="font-size:16px; font-weight:bold">الـسـجـلات</span></a>
				</li>
				<li>
				<a href="<?php echo __LINK_PATH;?>admin_search/serach_users"><span class="l"></span><span class="r"></span><span class="t" style="font-size:16px; font-weight:bold">بـحـث الـمـسـتـخـدمـيـن</span></a>
				</li>
				<li>
				<a href="#"><span class="l"></span><span class="r"></span><span class="t" style="font-size:16px; font-weight:bold">الـمـشـتـركـون</span></a>
					<ul>
					<div style="position:relative; right:-12px ">
						<li><a href="<?php echo __LINK_PATH;?>mobile_users_functions/show_prizes"><span style="font-size:15px; margin-right:6px ">الـجـوائـز</span></a></li>
						<li><a href="<?php echo __LINK_PATH;?>mobile_users_functions/invite_friends"><span style="font-size:15px; margin-right:6px ">دعـوة صـديـق</span></a></li>
					</div>
					</ul>
				</li>
				<li>
				<a href="<?php echo __LINK_PATH;?>members/LogOff"><span class="l"></span><span class="r"></span><span class="t" style="font-size:16px; font-weight:bold">مـغـادرة</span></a>
				</li>
			</ul> <!-- End of menu group !-->
			<?php
			}
		private function advertiser_menu()
			{
			?>
			<ul class="art-menu">
			<li>
				<a href="#"><span class="l"></span><span class="r"></span><span class="t" style="font-size:16px; font-weight:bold ">حـسـايــي</span></a>
					<ul>
					<div style="position:relative; right:10px ">
						<li><a href="<?php echo __LINK_PATH;?>advertisers/show_account"><span style="font-size:15px; margin-right:6px ">تـغـيــيـر الـمـعـلـومـات الـعـامــة</span></a></li>
						<li><a href="<?php echo __LINK_PATH;?>advertisers/edit_pw"><span style="font-size:15px; margin-right:6px ">تـغـيـيـر كـلـمــة الـسـر</span></a></li>
					</div>
					</ul>
				</li>
			<li>
				<a href="#"><span class="l"></span><span class="r"></span><span class="t" style="font-size:16px; font-weight:bold ">الـعـروض</span></a>
					<ul>
					<div style="position:relative; right:10px ">
						<li><a href="<?php echo __LINK_PATH;?>advertisers/add_offer"><span style="font-size:15px; margin-right:6px ">إضـافـة عـرض</span></a></li>
						<li><a href="<?php echo __LINK_PATH;?>advertisers/edit_offer"><span style="font-size:15px; margin-right:6px ">تـعـديـل عـرض</span></a></li>
						
						<li><a href="<?php echo __LINK_PATH;?>advertisers/search_offer"><span style="font-size:15px; margin-right:6px ">بـحـث الـعـروض</span></a></li>
					</div>
					</ul>
				</li>
			<li>
				<a href="<?php echo __LINK_PATH;?>advertisers_op/LogOff"><span class="l"></span><span class="r"></span><span class="t" style="font-size:16px; font-weight:bold">مـغـادرة</span></a>
			</li>
			</ul> <!-- End of menu group !-->
			<?php
			}
		private function operators_menu()
			{
			?>
			<ul class="art-menu">
			<li>
				<a href="#"><span class="l"></span><span class="r"></span><span class="t" style="font-size:16px; font-weight:bold ">الـعـروض</span></a>
					<ul>
					<div style="position:relative; right:10px ">
						<li><a href="<?php echo __LINK_PATH;?>operators/add_offer_start"><span style="font-size:15px; margin-right:6px ">قـائـمـة الـعـروض</span></a></li>
					</div>
					</ul>
				</li>
				
				<li>
				<a href="<?php echo __LINK_PATH;?>operators/LogOff"><span class="l"></span><span class="r"></span><span class="t" style="font-size:16px; font-weight:bold">مـغـادرة</span></a>
				</li>
			</ul> <!-- End of menu group !-->
			<?php
			}
		public function sales_menu()
			{
			?>
			<ul class="art-menu">
			<li>
				<a href="#"><span class="l"></span><span class="r"></span><span class="t" style="font-size:16px; font-weight:bold ">تـحـكـم إداري</span></a>
					<ul>
					<div style="position:relative; left:10px ">
						<li><a href=""><span style="font-size:15px; margin-right:6px ">الإداريــون</span></a>
						<ul>
							<li><a href="<?php echo __LINK_PATH;?>sales/verify_type"><span style="font-size:15px; margin-right:6px ">إضــافــة</span></a></li> 
							<li><a href="<?php echo __LINK_PATH;?>sales/edit_member"><span style="font-size:15px; margin-right:6px ">تـعـديــل / مـسـح</span></a></li>
						</ul>
						</li>
					</div>
					</ul>
				</li>
				
				<li>
				<a href="<?php echo __LINK_PATH;?>sales/LogOff"><span class="l"></span><span class="r"></span><span class="t" style="font-size:16px; font-weight:bold">مـغـادرة</span></a>
				</li>
			</ul> <!-- End of menu group !-->
			<?php
			}
		private function display_cms_menu($Lang='')
			{
				switch($_SESSION['User_level_Session'])
					{
						case '1':
						$this->super_admin_menu();
						break;
						
						case '2':
						$this->advertiser_menu();
						break;
						
						case '3':
						$this->sales_menu();
						break;
						
						case '4':
						$this->operators_menu();
						break;
						
						default:
						echo '';
					}
			
			}
	}
?>