<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
class uploads
	{
		function __construct()
			{
				$this->db = db::getInstance();
			}
		public function Upload_File($x,$Directory)
			{
				$FileNameStamp = date('y_m_d').time();
				$FileNameStamp = (string)$FileNameStamp;
				$uploadfile = $Directory.$FileNameStamp. basename($_FILES[$x]['name']);
				$path_info = pathinfo($uploadfile);
    			$FileExtention = strtolower($path_info['extension']);
				$temp=$_FILES[$x]['tmp_name'];
				$uploadfile = $Directory.$FileNameStamp.'.'.$FileExtention;
				move_uploaded_file ($temp,$uploadfile);
				$fname = date('y_m_d').time().'.'.$FileExtention;
				return $fname;
			}
		public function UploadBrandImageFixedHeight($x,$Directory,$newwidth,$newheight)
			{
				$ImageNameStamp = date('y_m_d').time();
				$ImageNameStamp = (string)$ImageNameStamp;
				$uploadfile = $Directory.$ImageNameStamp. basename($_FILES[$x]['name']);
				$path_info = pathinfo($uploadfile);
    			$FileExtention = strtolower($path_info['extension']);
				$temp=$_FILES[$x]['tmp_name'];
				$FileName = $uploadfile;
				move_uploaded_file ($temp,$uploadfile);
				if(($FileExtention == "jpg")||($FileExtention == "jpeg"))
					{
						@header('Content-type: image/jpeg');
						list($width, $height) = getimagesize($FileName);
						$Percent = $width/$height; 
								
						//$newheight = $newwidth/$Percent;
								
						$thumb = imagecreatetruecolor($newwidth, $newheight);
						
						$source = imagecreatefromjpeg($FileName);
										
						//resize
						imagecopyresampled($thumb,$source,0,0,0,0,$newwidth,$newheight,$width,$height);
						
						// Choose a name for your new image (must have jpg extensions):
						$fname = rand(1,1000000).date('y_m_d').time().".jpg";
								
						imagejpeg($thumb, "{$Directory}{$fname}");
						$UploadThumb = $Directory.$fname; 
						@unlink($uploadfile);
						return $fname;
						
					}
				if($FileExtention == "gif")
					{
						@header('Content-type: image/gif');
						list($width, $height) = getimagesize($FileName);
						$Percent = $width/$height; 
								
						//$newheight = $newwidth/$Percent;
						
								
						$thumb = imagecreatetruecolor($newwidth, $newheight);
						$source = imagecreatefromgif($FileName);
										
								
						//resize
						imagecopyresampled($thumb,$source,0,0,0,0,$newwidth,$newheight,$width,$height);
						
						$fname = rand(1,1000000).date('y_m_d').time().".gif";
						
						imagegif($thumb, "{$Directory}{$fname}");
						$UploadThumb = $Directory.$fname; 
						
						@unlink($uploadfile);
						return $fname;
					}
				if($FileExtention == "png")
					{
						@header('Content-type: image/png');
						list($width, $height) = getimagesize($FileName);
						$Percent = $width/$height; 
								
						//$newheight = $newwidth/$Percent;
						
								
						$thumb = imagecreatetruecolor($newwidth, $newheight);
						$source = imagecreatefrompng($FileName);
										
								
						//resize
						imagecopyresampled($thumb,$source,0,0,0,0,$newwidth,$newheight,$width,$height);
						
						$fname = rand(1,1000000).date('y_m_d').time().".png";
						
						imagepng($thumb, "{$Directory}{$fname}");
						$UploadThumb = $Directory.$fname; 
						
						@unlink($uploadfile);
						return $fname;
					}
						
			}
		public function UploadBrandImage($x,$Directory,$newwidth,$EnlargedW='')
			{
				$ImageNameStamp = date('y_m_d').time();
				$ImageNameStamp = (string)$ImageNameStamp;
				$uploadfile = $Directory.$ImageNameStamp. basename($_FILES[$x]['name']);
				$path_info = pathinfo($uploadfile);
    			$FileExtention = strtolower($path_info['extension']);
				$temp=$_FILES[$x]['tmp_name'];
				$FileName = $uploadfile;
				move_uploaded_file ($temp,$uploadfile);
				if(($FileExtention == "jpg")||($FileExtention == "jpeg"))
					{
						@header('Content-type: image/jpeg');
						list($width, $height) = getimagesize($FileName);
						$Percent = $width/$height; 
								
						$newheight = $newwidth/$Percent;
								
						$thumb = imagecreatetruecolor($newwidth, $newheight);
						
						$source = imagecreatefromjpeg($FileName);
										
						//resize
						imagecopyresampled($thumb,$source,0,0,0,0,$newwidth,$newheight,$width,$height);
						
						// Choose a name for your new image (must have jpg extensions):
						$fname = rand(1,1000000).date('y_m_d').time().".jpg";
								
						imagejpeg($thumb, "{$Directory}{$fname}");
						$UploadThumb = $Directory.$fname; 
						@unlink($uploadfile);
						return $fname;
						
					}
				if($FileExtention == "gif")
					{
						@header('Content-type: image/gif');
						list($width, $height) = getimagesize($FileName);
						$Percent = $width/$height; 
								
						$newheight = $newwidth/$Percent;
						
								
						$thumb = imagecreatetruecolor($newwidth, $newheight);
						$source = imagecreatefromgif($FileName);
										
								
						//resize
						imagecopyresampled($thumb,$source,0,0,0,0,$newwidth,$newheight,$width,$height);
						
						$fname = rand(1,1000000).date('y_m_d').time().".gif";
						
						imagegif($thumb, "{$Directory}{$fname}");
						$UploadThumb = $Directory.$fname; 
						
						@unlink($uploadfile);
						return $fname;
					}
				if($FileExtention == "png")
					{
						@header('Content-type: image/png');
						list($width, $height) = getimagesize($FileName);
						$Percent = $width/$height; 
								
						$newheight = $newwidth/$Percent;
						
								
						$thumb = imagecreatetruecolor($newwidth, $newheight);
						$source = imagecreatefrompng($FileName);
										
								
						//resize
						imagecopyresampled($thumb,$source,0,0,0,0,$newwidth,$newheight,$width,$height);
						
						$fname = rand(1,1000000).date('y_m_d').time().".png";
						
						imagepng($thumb, "{$Directory}{$fname}");
						$UploadThumb = $Directory.$fname; 
						
						@unlink($uploadfile);
						return $fname;
					}
						
			}
		function __destruct()
			{
				$this->db = NULL;
			}
	}
?>