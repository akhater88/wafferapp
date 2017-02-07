<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
class cache
	{
		public function needs_Update($Path_To_Cache,$Path_To_File)
			{
				if(!file_exists($Path_To_File))
					{
						$Display = new sql();
						$Display->update_table_modified($Path_To_File);
					}
				if(file_exists($Path_To_Cache) && (filemtime($Path_To_File) < filemtime($Path_To_Cache)))
					{
						
						return false;
					}
				else
					{
						
						return true;
					}
			}
		// This function updates based on the updates table that contains a timestamp:
		public function needs_Update_timestamp($Path_To_Cache,$Path_To_File)
			{
				$Display = new sql();
				$sql = 'SELECT * FROM updates';
				$result = $Display->Display_Info($sql);
				foreach($result as $rows)
					{
						$TimeStamp = strtotime($rows->TimeStamp);
					}
				if(file_exists($Path_To_Cache) && ($TimeStamp < filemtime($Path_To_Cache)))
					{
						
						return false;
					}
				else
					{
						
						return true;
					}
			}
		
	}
?>