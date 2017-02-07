<?php
class url
	{
		//This function returns the URL of a web site.
		public function curPageURL() {
		 $pageURL = 'http';
		 //if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
		 $pageURL .= "://";
		 if ($_SERVER["SERVER_PORT"] != "80") {
		  $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
		 } else {
		  $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
		 }
		 return $pageURL;
		}
		
		//This function returns the current page name:
		public function curPageName(){
 		return substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1);
		}
		
		//This function returns a parameter value
		public function getPar($Par)
			{
				$curPageURL = $this->curPageURL();
				$Segments = explode('/',$curPageURL);
				$Counter = 0;
				$Index = 0;
				foreach($Segments as $Value)
					{
						 //$V .= $Value."<BR />";
						if($Value == $Par)
							{
								if(end($Segments) != $Value)
									{
										$Index = ++$Counter;
										return $Segments[$Index];
									}
								
								break;
							}
						else
							{
								$Counter++;
							}
							
					}
				
			}
		 public static function Domain_Name($CSS_URL='',$JS_URL='') 
		 	{
				if($CSS_URL)
					{
						return 'http://'.$_SERVER['HTTP_HOST'].$CSS_URL;
					}
				if($JS_URL)
					{
						return 'http://'.$_SERVER['HTTP_HOST'].$JS_URL;
					}
			}
		function __destruct()
			{
				$this->db = NULL;
			}
	}
?>