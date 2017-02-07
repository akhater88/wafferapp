<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
class special_forms
	{
		function __construct()
			{
				$this->db = db::getInstance();
			}
		public function Drop_Down_Edit_Table_Functions($Table,$DropDown,$Field,$Value, $Class='',$NoLang='')
			{
				$Status = '1';
				if($NoLang == NULL)
					{
						if(!isset($_SESSION['Arabic']))
							{
								$Table .= '_english';
							}
					}
			?>
			<select class="<?php echo $Class;?>" name="<?php echo $DropDown;?>" id="<?php echo $DropDown;?>" onChange="Show_Model('Model','<?php echo __LINK_PATH;?>cars/show_model/AJAX/Y/','POST','HTML','Brand')">
			<?php
			  
					if(!$Value)
						{
						?>
						<option value="0" selected>-- Select --</option>
						<?php
						}
					else
						{
						$sql = "SELECT ID,$Field FROM $Table WHERE ID = :ID AND Status = :Status ORDER BY BINARY $Field";
						$stmt = $this->db->prepare($sql);
						$stmt->setFetchMode(PDO::FETCH_OBJ);
						$stmt->bindParam(':ID',$Value);
						$stmt->bindParam(':Status',$Status);
						$stmt->execute();
						$results = $stmt->fetchAll();
						foreach($results as $rows)
							{
								$SessionName = $rows->$Field;
							}
						?>
						<option value="<?php echo $Value;?>" selected><?php echo $SessionName;?></option>
						<?php
						}
					$sql = "SELECT ID,$Field FROM $Table WHERE ID != :ID AND Status = :Status ORDER BY BINARY $Field";
					$stmt = $this->db->prepare($sql); 
					$stmt->setFetchMode(PDO::FETCH_OBJ);
					$stmt->bindParam(':ID',$Value);
					$stmt->bindParam(':Status',$Status);
					$stmt->execute();
					$results = $stmt->fetchAll();
					foreach($results as $row)
						{
							$VID = $row->ID;
							$VName = $row->$Field;
						?>
						<option value="<?php echo $VID;?>"><?php echo $VName;?></option>
						<?php
						}
					
				
			  ?>
			  </select>
			  <?php
			}
		public function Drop_Down_Menu_Functions_Search($Table,$DropDown,$Field,$Class='',$NoLang='')
			{
				$Status = '0';
				if($NoLang == NULL)
					{
						if(!isset($_SESSION['Arabic']))
							{
								$Table .= '_english';
							}
					}
			?>
			<select class="<?php echo $Class;?>" name="<?php echo $DropDown;?>" id="<?php echo $DropDown;?>"  onChange="CallMulti('Model','<?php echo __LINK_PATH;?>search/show_available_cars/AJAX/Y/','POST','HTML','Brand','Car_Country','<?php echo __LINK_PATH;?>search/show_car_country/AJAX/Y/','Brand')">
			<?php
			
			  if(isset($_SESSION[$DropDown]))
				{
					$SessionID = $_SESSION[$DropDown];
					$sql = "SELECT ID,$Field FROM $Table WHERE ID = :ID ORDER BY BINARY $Field";
					$stmt = $this->db->prepare($sql);
					$stmt->setFetchMode(PDO::FETCH_OBJ);
					$Bind_ID = $SessionID;
					$stmt->bindParam(':ID',$Bind_ID);
					$stmt->execute();
					$results = $stmt->fetch();
					$SessionName = $results->$Field;
					
					if($SessionID)
						{
						?>
						<option value="<?php echo $SessionID;?>" selected><?php echo $SessionName;?></option>
						<?php
						}
					else
						{
						?>
						 <option value="0" selected>--Select--</option>
						<?php
						}
					
					$sql = "SELECT ID,$Field FROM $Table WHERE ID != :ID AND Status != :Status ORDER BY BINARY $Field";
					$stmt = $this->db->prepare($sql);
					$stmt->setFetchMode(PDO::FETCH_OBJ);
					$Bind_ID = $SessionID;
					$stmt->bindParam(':ID',$Bind_ID);
					$stmt->bindParam(':Status',$Status);
					$stmt->execute();
					$results = $stmt->fetchAll();
					foreach($results as $row)
						{
							$VID = $row->ID;
							$VName = $row->$Field;
						?>
						<option value="<?php echo $VID;?>"><?php echo $VName;?></option>
						<?php
						}
					
				}
			else
				{
				?>
				 <option value="0" selected>--Select--</option>
				<?php
					  $sql = "SELECT ID,$Field FROM $Table WHERE Status != :Status ORDER BY BINARY $Field";
					  $stmt = $this->db->prepare($sql);
					  $stmt->setFetchMode(PDO::FETCH_OBJ);
					  $stmt->bindParam(':Status',$Status);
					  $stmt->execute();
					  $results = $stmt->fetchAll();
					  foreach($results as $row)
						{
							$VID = $row->ID;
							$VName = $row->$Field;
						?>
						<option value="<?php echo $VID;?>"><?php echo $VName;?></option>
						<?php
						}
				}
			  ?>
			  </select>
			  <?php
			}
		public function Drop_Down_Menu_Functions($Table,$DropDown,$Field,$Class='',$NoLang='')
			{
				$Status = '0';
				if($NoLang == NULL)
					{
						if(!isset($_SESSION['Arabic']))
							{
								$Table .= '_english';
							}
					}
			?>
			<select class="<?php echo $Class;?>" name="<?php echo $DropDown;?>" id="<?php echo $DropDown;?>" onChange="Show_Model('Model','<?php echo __LINK_PATH;?>cars/show_model/AJAX/Y/','POST','HTML','Brand')">
			<?php
			
			  if(isset($_SESSION[$DropDown]))
				{
					$SessionID = $_SESSION[$DropDown];
					$sql = "SELECT ID,$Field FROM $Table WHERE ID = :ID ORDER BY BINARY $Field";
					$stmt = $this->db->prepare($sql);
					$stmt->setFetchMode(PDO::FETCH_OBJ);
					$Bind_ID = $SessionID;
					$stmt->bindParam(':ID',$Bind_ID);
					$stmt->execute();
					$results = $stmt->fetch();
					$SessionName = $results->$Field;
					
					if($SessionID)
						{
						?>
						<option value="<?php echo $SessionID;?>" selected><?php echo $SessionName;?></option>
						<?php
						}
					else
						{
						?>
						 <option value="0" selected>--Select--</option>
						<?php
						}
					
					$sql = "SELECT ID,$Field FROM $Table WHERE ID != :ID AND Status != :Status ORDER BY BINARY $Field";
					$stmt = $this->db->prepare($sql);
					$stmt->setFetchMode(PDO::FETCH_OBJ);
					$Bind_ID = $SessionID;
					$stmt->bindParam(':ID',$Bind_ID);
					$stmt->bindParam(':Status',$Status);
					$stmt->execute();
					$results = $stmt->fetchAll();
					foreach($results as $row)
						{
							$VID = $row->ID;
							$VName = $row->$Field;
						?>
						<option value="<?php echo $VID;?>"><?php echo $VName;?></option>
						<?php
						}
					
				}
			else
				{
				?>
				 <option value="0" selected>--Select--</option>
				<?php
					  $sql = "SELECT ID,$Field FROM $Table WHERE Status != :Status ORDER BY BINARY $Field";
					  $stmt = $this->db->prepare($sql);
					  $stmt->setFetchMode(PDO::FETCH_OBJ);
					  $stmt->bindParam(':Status',$Status);
					  $stmt->execute();
					  $results = $stmt->fetchAll();
					  foreach($results as $row)
						{
							$VID = $row->ID;
							$VName = $row->$Field;
						?>
						<option value="<?php echo $VID;?>"><?php echo $VName;?></option>
						<?php
						}
				}
			  ?>
			  </select>
			  <?php
			}
		public function Drop_Down_Menu_Functions_Model($Table,$DropDown,$Field,$Class='',$Variable,$NoLang='')
			{
				$Status = '0';
				if($NoLang == NULL)
					{
						if(!isset($_SESSION['Arabic']))
							{
								$Table .= '_english';
							}
					}
			?>
			<select class="<?php echo $Class;?>" name="<?php echo $DropDown;?>" id="<?php echo $DropDown;?>">
			<?php
			
			  if(isset($_SESSION[$DropDown]))
				{
					$SessionID = $_SESSION[$DropDown];
					$sql = "SELECT ID,$Field FROM $Table WHERE ID = :ID ORDER BY BINARY $Field";
					$stmt = $this->db->prepare($sql);
					$stmt->setFetchMode(PDO::FETCH_OBJ);
					$Bind_ID = $SessionID;
					$stmt->bindParam(':ID',$Bind_ID);
					$stmt->execute();
					$results = $stmt->fetch();
					$SessionName = $results->$Field;
					
					if($SessionID)
						{
						?>
						 <option value="0">--Select--</option>
						<option value="<?php echo $SessionID;?>" selected><?php echo $SessionName;?></option>
						<?php
						}
					else
						{
						?>
						 <option value="0" selected>--Select--</option>
						<?php
						}
					
					$sql = "SELECT ID,$Field FROM $Table WHERE ID != :ID AND Status != :Status AND Brand = :Brand ORDER BY BINARY $Field";
					$stmt = $this->db->prepare($sql);
					$stmt->setFetchMode(PDO::FETCH_OBJ);
					$Bind_ID = $SessionID;
					$stmt->bindParam(':ID',$Bind_ID);
					$stmt->bindParam(':Status',$Status);
					$stmt->bindParam(':Brand',$Variable);
					$stmt->execute();
					$results = $stmt->fetchAll();
					foreach($results as $row)
						{
							$VID = $row->ID;
							$VName = $row->$Field;
						?>
						<option value="<?php echo $VID;?>"><?php echo $VName;?></option>
						<?php
						}
					
				}
			else
				{
				?>
				 <option value="0" selected>--Select--</option>
				<?php
					  $sql = "SELECT ID,$Field FROM $Table WHERE Status != :Status AND Brand = :Brand ORDER BY BINARY $Field";
					  $stmt = $this->db->prepare($sql);
					  $stmt->setFetchMode(PDO::FETCH_OBJ);
					  $stmt->bindParam(':Status',$Status);
					  $stmt->bindParam(':Brand',$Variable);
					  $stmt->execute();
					  $results = $stmt->fetchAll();
					  foreach($results as $row)
						{
							$VID = $row->ID;
							$VName = $row->$Field;
						?>
						<option value="<?php echo $VID;?>"><?php echo $VName;?></option>
						<?php
						}
				}
			  ?>
			  </select>
			  <?php
			}
		public function Drop_Down_Edit_Menu_Functions_Model($Table,$DropDown,$Field,$Value,$Class='',$Variable,$NoLang='')
			{
				$Status = '0';
				if($NoLang == NULL)
					{
						if(!isset($_SESSION['Arabic']))
							{
								$Table .= '_english';
							}
					}
			?>
			<select class="<?php echo $Class;?>" name="<?php echo $DropDown;?>" id="<?php echo $DropDown;?>">
			<?php
			
			  if(isset($Value))
				{
					$SessionID = $Value;
					$sql = "SELECT ID,$Field FROM $Table WHERE ID = :ID ORDER BY BINARY $Field";
					$stmt = $this->db->prepare($sql);
					$stmt->setFetchMode(PDO::FETCH_OBJ);
					$Bind_ID = $SessionID;
					$stmt->bindParam(':ID',$Bind_ID);
					$stmt->execute();
					$results = $stmt->fetch();
					$SessionName = $results->$Field;
					
					if($SessionID)
						{
						?>
						 <option value="0">--Select--</option>
						<option value="<?php echo $SessionID;?>" selected><?php echo $SessionName;?></option>
						<?php
						}
					else
						{
						?>
						 <option value="0" selected>--Select--</option>
						<?php
						}
					
					$sql = "SELECT ID,$Field FROM $Table WHERE ID != :ID AND Status != :Status AND Brand = :Brand ORDER BY BINARY $Field";
					$stmt = $this->db->prepare($sql);
					$stmt->setFetchMode(PDO::FETCH_OBJ);
					$Bind_ID = $SessionID;
					$stmt->bindParam(':ID',$Bind_ID);
					$stmt->bindParam(':Status',$Status);
					$stmt->bindParam(':Brand',$Variable);
					$stmt->execute();
					$results = $stmt->fetchAll();
					foreach($results as $row)
						{
							$VID = $row->ID;
							$VName = $row->$Field;
						?>
						<option value="<?php echo $VID;?>"><?php echo $VName;?></option>
						<?php
						}
					
				}
			else
				{
				?>
				 <option value="0" selected>--Select--</option>
				<?php
					  $sql = "SELECT ID,$Field FROM $Table WHERE Status != :Status AND Brand = :Brand ORDER BY BINARY $Field";
					  $stmt = $this->db->prepare($sql);
					  $stmt->setFetchMode(PDO::FETCH_OBJ);
					  $stmt->bindParam(':Status',$Status);
					  $stmt->bindParam(':Brand',$Variable);
					  $stmt->execute();
					  $results = $stmt->fetchAll();
					  foreach($results as $row)
						{
							$VID = $row->ID;
							$VName = $row->$Field;
						?>
						<option value="<?php echo $VID;?>"><?php echo $VName;?></option>
						<?php
						}
				}
			  ?>
			  </select>
			  <?php
			}
		function __destruct()
			{
				$this->db = NULL;
			}
	}
?>