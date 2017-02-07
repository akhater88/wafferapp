<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
class myfunctions
	{
		public function Is_Laget()
			{
				$_SESSION['Location_Indicator'] = __LINK_PATH;
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
				$Is_Laget = $this->Is_Laget();
				$Is_Level_Set = $this->Is_Level_Set();
				$Allowed_Levels = array('1','2','3','4','5');
				$Is_Level_One = $this->Is_Level_One($Allowed_Levels);
				if(($Is_Laget) && ($Is_Level_Set) && ($Is_Level_One))
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
			<ul id="nav">
			<li>
				<a href="<?php echo __LINK_PATH;?>index/welcome/">الـصـفـحـة الـرئـيـســيــة</a>
			</li>
			<li>
				<a href="#">تـحـكـم إداري</a>
					<ul>
					
						<li><a href="">الإداريــون</a>
						<ul>
							<li><a href="<?php echo __LINK_PATH;?>members/verify_type">إضــافــة</a></li> 
						</ul>
						</li>
						
						<li><a href="<?php echo __LINK_PATH;?>ads/ads_cat">الـتـصـنـيـف الـدعـائـي</a></li>
						<li><a href="<?php echo __LINK_PATH;?>ads/ads_sub_cat">الـتـصـنـيـف الـدعـائـي الـفـرعـي</a></li>
						<li><a href="<?php echo __LINK_PATH;?>countries/add_country">الـبـلـدان</a></li>
						<li><a href="<?php echo __LINK_PATH;?>adminprizes/add_prize">الـجـوائـز</a></li>
						<li><a href="<?php echo __LINK_PATH;?>my_plain_images_banner/add_image_to_gallery">صـور الـبـانــر</a>
					
					</ul>
				</li>
				<li>
				<a href="#">الـعـروض</a>
					<ul>
					
						<li><a href="<?php echo __LINK_PATH;?>adminadvertisers/pending_offer">قــيـد الـمـوافـقــة</a></li>
						<li><a href="<?php echo __LINK_PATH;?>adminadvertisers/search_my_offer">بـحـث الـعـروض</a></li>
					
					</ul>
				</li>
				
				<li>
				<a href="<?php echo __LINK_PATH;?>admin_search/serach_users">بـحـث الـمـسـتـخـدمـيـن</a>
				</li>
				<li>
				<a href="#">الـمـشـتـركـون</a>
					<ul>
					
						<li><a href="<?php echo __LINK_PATH;?>mobile_users_functions/show_prizes">الـجـوائـز</a></li>
						<li><a href="<?php echo __LINK_PATH;?>mobile_users_functions/invite_friends">دعـوة صـديـق</a></li>
					
					</ul>
				</li>
				<li>
				<a href="#">الـتـقـاريــر</a>
					<ul>
					
						<li><a href="<?php echo __LINK_PATH;?>adminreports/admin_reports">تـقـاريـر الـمـبـيـعــات</a></li>
						<li><a href="<?php echo __LINK_PATH;?>statistics/step_one">الإحـصـائـيــات</a></li>
						<li><a href="">كـوبـونـات الـخـصـم</a>
						<ul>
							<li><a href="<?php echo __LINK_PATH;?>coupons/step_one">عــرض</a></li> 
							<li><a href="<?php echo __LINK_PATH;?>coupons/search">بـحـث</a></li>
						</ul>
						</li>
					
					</ul>
				</li>
			</ul> <!-- End of menu group !-->
			<?php
			}
		private function advertiser_menu()
			{
			?>
			<ul id="nav">
			<li><a href="<?php echo __LINK_PATH;?>advertisers/home/">الـصـفـحـة الـرئـيـسـيـة</a></li>
			<li>
				<a href="#">حـســابـي</a>
					<ul>
					
						<li><a href="<?php echo __LINK_PATH;?>advertisers/show_account">تـغـيــيـر الـمـعـلـومـات الـعـامــة</a></li>
						<li><a href="<?php echo __LINK_PATH;?>advertisers/edit_pw">تـغـيـيـر كـلـمــة الـسـر</a></li>
					
					</ul>
				</li>
			<li>
				<a href="#">الـعـروض</a>
					<ul>
					
						<li><a href="<?php echo __LINK_PATH;?>advertisers/add_offer">إضـافـة عـرض</a></li>
						<li><a href="<?php echo __LINK_PATH;?>advertisers/edit_offer">تـعـديـل عـرض</a></li>
						<li><a href="<?php echo __LINK_PATH;?>advertisers/active_offer">عـروض مـفـعــلة</a></li>
						<li><a href="<?php echo __LINK_PATH;?>advertisers/pending_offer">قـيـد الإنجـاز</a></li>
						<li><a href="<?php echo __LINK_PATH;?>advertisers/returned_offer">عـروض مـرجـعــة</a></li>
						<li><a href="<?php echo __LINK_PATH;?>advertisers/expired_offer">عـروض مـنـتـهـيــة</a></li>
						<li><a href="<?php echo __LINK_PATH;?>advertisers/draft_offer">مـسودة الـعـروض</a></li>
						
					</ul>
				</li>
			<li><a href="<?php echo __LINK_PATH;?>statistics/display_stats_merchant/">الإحصـائـيــات</a></li>
			<li>
				<a href="#">كـوبـونـات الـخـصـم</a>
					<ul>
					
						<li><a href="<?php echo __LINK_PATH;?>coupons/merchants_coupon">عــرض</a></li> 
						<li><a href="<?php echo __LINK_PATH;?>coupons/search_merchants_coupon">بـحـث</a></li>
					
					</ul>
				</li>
			
			</ul> <!-- End of menu group !-->
			<?php
			}
		private function operators_menu()
			{
			?>
			<ul id="nav">
			<li>
				<a href="#">الـعـروض</a>
					<ul>
					
						<li><a href="<?php echo __LINK_PATH;?>operators/add_offer_step_one">إضــافــة</a></li> 
						<li><a href="<?php echo __LINK_PATH;?>operators/pending_offer">قــيـد الـمـوافـقــة</a></li>
						<li><a href="<?php echo __LINK_PATH;?>operators/search_my_offer">بـحـث الـعـروض</a></li>
					
					</ul>
				</li>
				
				
			</ul> <!-- End of menu group !-->
			<?php
			}
		public function sales_menu()
			{
			?>
			<ul id="nav">
			<li>
				<a href="#">تـحـكـم إداري</a>
					<ul>
					
						<li><a href="">الإداريــون</a>
						<ul>
							<li><a href="<?php echo __LINK_PATH;?>sales/verify_type">إضــافــة</a></li> 
							<li><a href="<?php echo __LINK_PATH;?>sales/edit_member">تـعـديــل / مـسـح</a></li>
						</ul>
						</li>
					
					</ul>
				</li>
				
				
			</ul> <!-- End of menu group !-->
			<?php
			}
		private function country_menu()
			{
			?>
			<ul id="nav">
			<li>
				<a href="<?php echo __LINK_PATH;?>country_admin/sales_offer/">الـصـفـحـة الـرئـيـســيـة</a>
			</li>
			<li>
				<a href="#">حـســابـي</a>
					<ul>
					
						<li><a href="<?php echo __LINK_PATH;?>country_admin/show_account">تـغـيــيـر الـمـعـلـومـات الـعـامــة</a></li>
						<li><a href="<?php echo __LINK_PATH;?>country_admin/edit_pw">تـغـيـيـر كـلـمــة الـسـر</a></li>
					
					</ul>
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
						
						case '5':
						$this->country_menu();
						break;
						
						default:
						echo '';
					}
			
				if($Lang != NULL)
					{
						
					}
			}
	}
?>