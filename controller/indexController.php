<?php

class indexController extends baseController {

public function index() 
	{
				$Display = new sql();
				$cache = new cache();
				$Path_To_File = __CACHE.'myindexpage.txt';
				$Cached_File = __CACHE.base64_encode($_SERVER['REQUEST_URI']).'.html';
				$needs_Update = true;//$cache->needs_Update($Cached_File,$Path_To_File);
				
				if($needs_Update)
					{
						ob_start();
						$this->registry->template->show('pages/display_home_page');
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

?>
