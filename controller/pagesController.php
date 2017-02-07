<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
class pagesController extends baseController {
			
		public function index() 
			{
				?>
				<script language="javascript">
				window.location ='<?php echo __LINK_PATH;?>';
				</script>
				<?php	
			}
	    public function contact_us()
			{
				$this->registry->template->show('pages/contact_us');
			}
		public function submit_request_form()
			{
				$Display = new sql();
				$Name = strip_tags($_POST['Name']);
				$Email = $_POST['Email'];
				$Country = $_POST['Country'];
				$MSG = strip_tags($_POST['MSG']);
				$Time_Stamp = $_POST['Time_Stamp'];
				$validate = new validate_new();
				$Validate_Email = $validate->Validate_Email($Email);
				if($Name == NULL)
					{
						$myTweets = array("flag" => '1');
						$Display->Write_JSON($Time_Stamp,$myTweets);
					}
				elseif($Email == NULL)
					{
						$myTweets = array("flag" => '2');
						$Display->Write_JSON($Time_Stamp,$myTweets);
					}
				elseif(!$Validate_Email)
					{
						$myTweets = array("flag" => '3');
						$Display->Write_JSON($Time_Stamp,$myTweets);
					}
				elseif(!$Country)
					{
						$myTweets = array("flag" => '4');
						$Display->Write_JSON($Time_Stamp,$myTweets);
					}
				elseif($MSG == NULL)
					{
						$myTweets = array("flag" => '5');
						$Display->Write_JSON($Time_Stamp,$myTweets);
					}
				else
					{
						$myTweets = array("flag" => '0');
						$Display->Write_JSON($Time_Stamp,$myTweets);
						
						$Body = '<table width="100%"  border="0" cellpadding="5">
						  <tr>
							<td width="17%">Company/Name :</td>
							<td width="83%">'.$Name.'</td>
						  </tr>
						  <tr>
							<td>Message : </td>
							<td>'.$MSG.'</td>
						  </tr>
						</table>';
						$my_mail = new my_mail();
						if($Country == '1')
							{
								
								$my_mail->Send_SMTP($Body,'mail.wafferapp.com','jor@wafferapp.com','softilejor',$Email,$Name,'إسـتـفـســار','jor@wafferapp.com','Waffer Team');
							}
						else
							{
								$my_mail->Send_SMTP($Body,'mail.wafferapp.com','ksa@wafferapp.com','softileksa',$Email,$Name,'إسـتـفـســار','ksa@wafferapp.com','Waffer Team');
							}
					}
			}
		public function display_all_news()
			{
				$Display = new sql();
				$pagenum  = @$_POST['Page'];
				if(isset($_SESSION['Arabic_Visitors']))
					{
						$Table_News = 'news';
								
					}
				else
					{
						$Table_News = 'news_english';
							
					}
				$cache = new cache();
				$Path_To_File = __CACHE.$Table_News.'.txt';
				if(!isset($pagenum))
					{
						$Cached_File = __CACHE.base64_encode($_SERVER['REQUEST_URI']).'.html';
					}
				else
					{
						$Cached_File = __CACHE.base64_encode($_SERVER['REQUEST_URI'].$pagenum).'.html';
					}
				$needs_Update = $cache->needs_Update($Cached_File,$Path_To_File);
				if($needs_Update)
					{
						ob_start();
						$sql = 'SELECT ID,News_Title,Newsletter_Intro FROM '.$Table_News.' WHERE Status = ? ORDER BY ID DESC';
						$Execute_Array = array('1');
						$paginate = new paginate($Table_News,'10',$pagenum,$sql,$Execute_Array);
						$Count = $paginate->Records($Table_News);
						$this->registry->template->Page = $pagenum;
						$this->registry->template->Count = $Count;
						$this->registry->template->Last = $paginate->Calculate_Last($Count);
						$results = $paginate->Paginate();
						$this->registry->template->results = $results;
						$this->registry->template->show('news/display_all_news');
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
		public function display_page()
			{
				$URL = new url();
				$cache = new cache();
				$Member = $URL->getPar('Member');
				if((isset($Member)) && ($Member != NULL))
					{
						if($Member == 'news')
							{
								$this->display_all_news();
							}
						else
							{
								$this->registry->template->Member = $Member;
								$Display = new sql();
								if(isset($_SESSION['Arabic_Visitors']))
									{
										$Table_Pages = 'pages_v2';
										$Path_To_File = __CACHE.$Table_Pages.'.txt';
										$Cached_File = __CACHE.base64_encode($_SERVER['REQUEST_URI']).'.html';
										$needs_Update = $cache->needs_Update($Cached_File,$Path_To_File);
										if($needs_Update)
											{
												ob_start();
												$sql = 'SELECT Title,Content FROM '.$Table_Pages.' WHERE ID = ?';
												$Execute_Array = array($Member);
												$results = $Display->Display_Info($sql,$Execute_Array);
												if(count($results))
													{
														$this->registry->template->results = $results;
														switch($Member)
															{
																case '1':
																$Image_Source = 'keef-off';
																break;
																
																case '2':
																$Image_Source = 'a3len-ma3na';
																break;
																
																default:
																$Image_Source = 'title-home';
															}
														$this->registry->template->Image_Source = $Image_Source;
														$this->registry->template->show('pages/display_page');
													}
												else
													{
														$this->registry->template->show('pages/display_home_page_empty');
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
								else
									{
										$Table_Pages = 'pages_v2_english';
										$Path_To_File = __CACHE.$Table_Pages.'.txt';
										$Cached_File = __CACHE.base64_encode($_SERVER['REQUEST_URI']).'.html';
										$needs_Update = $cache->needs_Update($Cached_File,$Path_To_File);
										if($needs_Update)
											{
												ob_start();
												$sql = 'SELECT Title,Content FROM '.$Table_Pages.' WHERE ID = ?';
												$Execute_Array = array($Member);
												$results = $Display->Display_Info($sql,$Execute_Array);
												if(count($results))
													{
														$this->registry->template->results = $results;
														switch($Member)
															{
																case '1':
																$Image_Source = 'keef-off';
																break;
																
																case '2':
																$Image_Source = 'a3len-ma3na';
																break;
																
																default:
																$Image_Source = 'title-home';
															}
														$this->registry->template->Image_Source = $Image_Source;
														$this->registry->template->show('pages/display_page');
													}
												else
													{
														$this->registry->template->show('pages/display_home_page_empty');
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
							}
						}
					else
						{
							$this->registry->template->show('pages/display_home_page_empty');
						}
			}
}

?>
