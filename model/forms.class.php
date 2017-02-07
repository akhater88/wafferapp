<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
class forms
	{
		function __construct()
			{
				$this->db = db::getInstance();
			}
		public function create_token()
			{
				$Token = md5(uniqid(rand(), TRUE));
				$_SESSION['Token'] = $Token;
    			$_SESSION['Token_Time'] = time();
				return $Token;
			}
		public function hidden_token($token)
			{
			?>
			 <input type="hidden" id="My_Token" name="My_Token" value="<?php echo $token; ?>" />
			<?php
			}
		public function Show_Error($Tag,$Session_Name)
			{
				if(isset($_SESSION['Errors'][$Session_Name]))
					{
						if($Tag == 'div')
							{
								$String = '<div class="Errors">'.$_SESSION['Errors'][$Session_Name].'</div>';
							}
						else
							{
								$String = '&nbsp;<span class="Errors">'.$_SESSION['Errors'][$Session_Name].'</span>';
							}
						echo $String;
					}
			}
		//This function create a dropdown menu with an action enabled:
		public function Drop_Down_Action($Table,$DropDown,$Field, $Class='',$Pos='',$Location)
			{
			?>
			<select class="<?php echo $Class;?>" name="<?php echo $DropDown;?>" id="<?php echo $DropDown;?>" onChange="NavigateDroDown($DropDown,$Location)">
			<?php
			  if(isset($_SESSION[$DropDown]))
				{
					$SessionID = $_SESSION[$DropDown];
					$sql = "SELECT ID,$Field FROM $Table WHERE ID = :ID ORDER BY $Field";
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
					
					$sql = "SELECT ID,$Field FROM $Table WHERE ID != :ID ORDER BY $Field";
					$stmt = $this->db->prepare($sql);
					$stmt->setFetchMode(PDO::FETCH_OBJ);
					$Bind_ID = $SessionID;
					$stmt->bindParam(':ID',$Bind_ID);
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
					  $sql = "SELECT ID,$Field FROM $Table ORDER BY $Field";
					  $stmt = $this->db->prepare($sql);
					  $stmt->setFetchMode(PDO::FETCH_OBJ);
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
			  if(isset($_SESSION['Errors'][$DropDown]))
			  	{
					if($Pos == NULL)
						{
						?>
						&nbsp;<span class="Errors" style=" position:absolute; right:440px"><?php echo $_SESSION['Errors'][$DropDown];?></span>
						<?php
						}
					else
						{
						?>
						&nbsp;<span class="Errors" style=" position:absolute; right:<?php echo $Pos;?>px"><?php echo $_SESSION['Errors'][$DropDown];?></span>
						<?php
						}
				
				}
			}
		
		//This function create a dropdown menu it ammends the functions above it:
		public function Drop_Down($Table,$DropDown,$Field, $Class='',$Pos='')
			{
			if(!isset($_SESSION['Arabic']))
				{
					$Table .= '_english';
					$Class = 'English';
				}
			else
				{
					$Class = 'Arabic';
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
						<option value="<?php echo $SessionID;?>" selected><?php echo $SessionName;?></option>
						<?php
						}
					else
						{
						?>
						 <option value="0" selected>--Select--</option>
						<?php
						}
					
					$sql = "SELECT ID,$Field FROM $Table WHERE ID != :ID ORDER BY BINARY $Field";
					$stmt = $this->db->prepare($sql);
					$stmt->setFetchMode(PDO::FETCH_OBJ);
					$Bind_ID = $SessionID;
					$stmt->bindParam(':ID',$Bind_ID);
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
					  $sql = "SELECT ID,$Field FROM $Table ORDER BY BINARY $Field";
					  $stmt = $this->db->prepare($sql);
					  $stmt->setFetchMode(PDO::FETCH_OBJ);
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
			  if(isset($_SESSION['Errors'][$DropDown]))
			  	{
					if($Pos == NULL)
						{
						?>
						&nbsp;<span class="Errors" style=" position:absolute; right:440px"><?php echo $_SESSION['Errors'][$DropDown];?></span>
						<?php
						}
					else
						{
						?>
						&nbsp;<span class="Errors" style=" position:absolute; right:<?php echo $Pos;?>px"><?php echo $_SESSION['Errors'][$DropDown];?></span>
						<?php
						}
				
				}
			}
		//This function create a dropdown menu it ammends the functions above it:
		public function Drop_Down_Table_Par($Table,$DropDown,$Field,$Class='',$NoLang='')
			{
				$Status = '0';
				if($NoLang == NULL)
					{
						if(!isset($_SESSION['Arabic']))
							{
								$Table .= '_english';
								$Class = 'English';
							}
						else
							{
								$Class = 'Arabic';
							}
					}
			
			?>
			<select class="<?php echo $Class;?>" name="<?php echo $DropDown;?>" id="<?php echo $DropDown;?>" >
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
		//This function create a dropdown menu it ammends the functions above it:
		public function Drop_Down_Table($Table,$DropDown,$Field,$Class='',$NoLang='')
			{
				if($NoLang == NULL)
					{
						if(!isset($_SESSION['Arabic']))
							{
								$Table .= '_english';
								$Class = 'English';
							}
						else
							{
								$Class = 'Arabic';
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
						<option value="<?php echo $SessionID;?>" selected><?php echo $SessionName;?></option>
						<?php
						}
					else
						{
						?>
						 <option value="0" selected>--Select--</option>
						<?php
						}
					
					$sql = "SELECT ID,$Field FROM $Table WHERE ID != :ID ORDER BY BINARY $Field";
					$stmt = $this->db->prepare($sql);
					$stmt->setFetchMode(PDO::FETCH_OBJ);
					$Bind_ID = $SessionID;
					$stmt->bindParam(':ID',$Bind_ID);
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
					  $sql = "SELECT ID,$Field FROM $Table ORDER BY BINARY $Field";
					  $stmt = $this->db->prepare($sql);
					  $stmt->setFetchMode(PDO::FETCH_OBJ);
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
		
		//This function create a dropdown menu to be used in the edit scripts:
		public function Drop_Down_Edit($Table,$DropDown,$Field,$Value, $Class='',$Pos='')
			{
			if(!isset($_SESSION['Arabic']))
				{
					$Table .= '_english';
					$Class = 'English';
				}
			else
				{
					$Class = 'Arabic';
				}
			?>
			<select class="<?php echo $Class;?>" name="<?php echo $DropDown;?>" id="<?php echo $DropDown;?>">
			<?php
			  
					if(!$Value)
						{
						?>
						<option value="0" selected>-- Select --</option>
						<?php
						}
					else
						{
						$sql = "SELECT ID,$Field FROM $Table WHERE ID = :ID ORDER BY BINARY $Field";
						$stmt = $this->db->prepare($sql);
						$stmt->setFetchMode(PDO::FETCH_OBJ);
						$stmt->bindParam(':ID',$Value);
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
					$sql = "SELECT ID,$Field FROM $Table WHERE ID != :ID ORDER BY BINARY $Field";
					$stmt = $this->db->prepare($sql);
					$stmt->setFetchMode(PDO::FETCH_OBJ);
					$stmt->bindParam(':ID',$Value);
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
			  if(isset($_SESSION['Errors'][$DropDown]))
			  	{
					if($Pos == NULL)
						{
						?>
						&nbsp;<span class="Errors" style=" position:absolute; right:440px"><?php echo $_SESSION['Errors'][$DropDown];?></span>
						<?php
						}
					else
						{
						?>
						&nbsp;<span class="Errors" style=" position:absolute; right:<?php echo $Pos;?>px"><?php echo $_SESSION['Errors'][$DropDown];?></span>
						<?php
						}
				
				}
			}
		//This function create a dropdown menu to be used in the edit scripts:
		public function Drop_Down_Edit_Table($Table,$DropDown,$Field,$Value, $Class='',$NoLang='')
			{
				if($NoLang == NULL)
					{
						if(!isset($_SESSION['Arabic']))
							{
								$Table .= '_english';
								$Class = 'English';
							}
						else
							{
								$Class = 'Arabic';
							}
					}
			?>
			<select class="<?php echo $Class;?>" name="<?php echo $DropDown;?>" id="<?php echo $DropDown;?>">
			<?php
			  
					if(!$Value)
						{
						?>
						<option value="0" selected>-- Select --</option>
						<?php
						}
					else
						{
						$sql = "SELECT ID,$Field FROM $Table WHERE ID = :ID ORDER BY BINARY $Field";
						$stmt = $this->db->prepare($sql);
						$stmt->setFetchMode(PDO::FETCH_OBJ);
						$stmt->bindParam(':ID',$Value);
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
					$sql = "SELECT ID,$Field FROM $Table WHERE ID != :ID ORDER BY BINARY $Field";
					$stmt = $this->db->prepare($sql);
					$stmt->setFetchMode(PDO::FETCH_OBJ);
					$stmt->bindParam(':ID',$Value);
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
		//This function create a dropdown menu. It uses a ststua != 0
		public function Drop_Down_Edit_Table_Par($Table,$DropDown,$Field,$Value, $Class='',$NoLang='')
			{
				$Status = '0';
				if($NoLang == NULL)
					{
						if(!isset($_SESSION['Arabic']))
							{
								$Table .= '_english';
								$Class = 'English';
							}
						else
							{
								$Class = 'Arabic';
							}
					}
			?>
			<select class="<?php echo $Class;?>" name="<?php echo $DropDown;?>" id="<?php echo $DropDown;?>">
			<?php
			  
					if(!$Value)
						{
						?>
						<option value="0" selected>-- Select --</option>
						<?php
						}
					else
						{
						$sql = "SELECT ID,$Field FROM $Table WHERE ID = :ID AND Status != :Status ORDER BY BINARY $Field";
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
					$sql = "SELECT ID,$Field FROM $Table WHERE ID != :ID AND Status != :Status ORDER BY BINARY $Field";
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
		//This function creates a text field:
		public function Text_Field($Text_Field,$Class='',$Length='',$Type='',$Att='',$Pos='')
			{
				if($Length == NULL)
					{
						$Length= "30";
					}
				if($Type == NULL)
					{
						$Type= "text";
					}
				if(!isset($_SESSION['Arabic']))
					{
						$Class = 'English';
					}
				else
					{
						$Class = 'Arabic';
					}
				 if(isset($_SESSION[$Text_Field]))
					{
					
						if(isset($_SESSION['Errors'][$Text_Field]))
							{
								$BG = '#FFCC00';
							}
						if($Att == NULL)
							{
								if($Type == 'textarea')
									{
									?>
									<textarea id="<?php echo $Text_Field;?>" name="<?php echo $Text_Field;?>" class="<?php echo $Class;?>" cols="40" rows="5"><?php if(isset($_SESSION[$Text_Field]))
										{
										 echo $_SESSION[$Text_Field];
										}
										 ?>
										 </textarea>
									<?php
									}
								else
									{
									?>
									<input  style="background-color:<?php echo $BG;?> " name="<?php echo $Text_Field;?>" type="<?php echo $Type;?>" class="<?php echo $Class;?>" value="<?php echo $_SESSION[$Text_Field];?>" size="<?php echo $Length;?>">
									<?php
									}
							}
						else
							{
								if($Type == 'textarea')
									{
									?>
									<textarea id="<?php echo $Text_Field;?>" name="<?php echo $Text_Field;?>" class="<?php echo $Class;?>" cols="40" rows="5"><?php if(isset($_SESSION[$Text_Field])) echo $_SESSION[$Text_Field];?></textarea>
									<?php
									}
								else
									{
									?>
									<input readonly style="background-color:<?php echo $BG;?> " name="<?php echo $Text_Field;?>" type="<?php echo $Type;?>" class="<?php echo $Class;?>" value="<?php echo $_SESSION[$Text_Field];?>" size="<?php echo $Length;?>">
									<?php
									}
							}
					
					}
				else
					{
						if($Att == NULL)
							{
								if($Type == 'textarea')
									{
									?>
									<textarea id="<?php echo $Text_Field;?>" name="<?php echo $Text_Field;?>" class="<?php echo $Class;?>" cols="40" rows="5"><?php if(isset($_SESSION[$Text_Field])) echo $_SESSION[$Text_Field];?></textarea>
									<?php
									}
								else
									{
									?>
									<input name="<?php echo $Text_Field;?>" type="<?php echo $Type;?>" class="<?php echo $Class;?>" size="<?php echo $Length;?>">
									<?php
									}
							}
						else
							{
								if($Type == 'textarea')
									{
									?>
									<textarea id="<?php echo $Text_Field;?>" name="<?php echo $Text_Field;?>" class="<?php echo $Class;?>" cols="40" rows="5"><?php if(isset($_SESSION[$Text_Field])) echo $_SESSION[$Text_Field];?></textarea>
									<?php
									}
								else
									{
									?>
									<input readonly name="<?php echo $Text_Field;?>" type="<?php echo $Type;?>" class="<?php echo $Class;?>" size="<?php echo $Length;?>">
									<?php
									}
							}
					
					}
					
				if(isset($_SESSION['Errors'][$Text_Field]))
					{
						if($Att == NULL)
							{
								if($Pos == NULL)
									{
									?>
									&nbsp;<span class="Errors" style=" position:absolute; right:440px"><?php echo $_SESSION['Errors'][$Text_Field];?></span>
									<?php
									}
								else
									{
									?>
									&nbsp;<span class="Errors" style=" position:absolute; right:<?php echo $Pos;?>px"><?php echo $_SESSION['Errors'][$Text_Field];?></span>
									<?php
									}
							
							}
						else
							{
								if($Pos == NULL)
									{
									?>
									&nbsp;<span class="Errors" style=" position:absolute; right:250px"><?php echo $_SESSION['Errors'][$Text_Field];?></span>
									<?php
									}
								else
									{
									?>
									&nbsp;<span class="Errors" style=" position:absolute; right:<?php echo $Pos;?>px"><?php echo $_SESSION['Errors'][$Text_Field];?></span>
									<?php
									}
							
							}
					}
			}
		//This function creates a text field:
		public function Text_Field_Table($Text_Field,$Class='',$Length='',$Type='',$Att='')
			{
				if($Length == NULL)
					{
						$Length= "30";
					}
				if($Type == NULL)
					{
						$Type= "text";
					}
				if(!isset($_SESSION['Arabic']))
					{
						$Class = 'English';
					}
				else
					{
						$Class = 'Arabic';
					}
				 if(isset($_SESSION[$Text_Field]))
					{
						if(isset($_SESSION['Errors'][$Text_Field]))
							{
								$BG = '#FFCC00';
							}
						if($Att == NULL)
							{
								if($Type == 'textarea')
									{
									?>
									<textarea id="<?php echo $Text_Field;?>" name="<?php echo $Text_Field;?>" class="<?php echo $Class;?>" cols="40" rows="5"><?php if(isset($_SESSION[$Text_Field]))
										{
										 echo $_SESSION[$Text_Field];
										}
										 ?>
										 </textarea>
									<?php
									}
								else
									{
									?>
									<input  style="background-color:<?php echo $BG;?> " name="<?php echo $Text_Field;?>" type="<?php echo $Type;?>" class="<?php echo $Class;?>" value="<?php echo $_SESSION[$Text_Field];?>" size="<?php echo $Length;?>">
									<?php
									}
							}
						else
							{
								if($Type == 'textarea')
									{
									?>
									<textarea id="<?php echo $Text_Field;?>" name="<?php echo $Text_Field;?>" class="<?php echo $Class;?>" cols="40" rows="5"><?php if(isset($_SESSION[$Text_Field])) echo $_SESSION[$Text_Field];?></textarea>
									<?php
									}
								else
									{
									?>
									<input readonly style="background-color:<?php echo $BG;?> " name="<?php echo $Text_Field;?>" type="<?php echo $Type;?>" class="<?php echo $Class;?>" value="<?php echo $_SESSION[$Text_Field];?>" size="<?php echo $Length;?>">
									<?php
									}
							}
					
					}
				else
					{
						if($Att == NULL)
							{
								if($Type == 'textarea')
									{
									?>
									<textarea id="<?php echo $Text_Field;?>" name="<?php echo $Text_Field;?>" class="<?php echo $Class;?>" cols="40" rows="5"><?php if(isset($_SESSION[$Text_Field])) echo $_SESSION[$Text_Field];?></textarea>
									<?php
									}
								else
									{
									?>
									<input name="<?php echo $Text_Field;?>" type="<?php echo $Type;?>" class="<?php echo $Class;?>" size="<?php echo $Length;?>">
									<?php
									}
							}
						else
							{
								if($Type == 'textarea')
									{
									?>
									<textarea id="<?php echo $Text_Field;?>" name="<?php echo $Text_Field;?>" class="<?php echo $Class;?>" cols="40" rows="5"><?php if(isset($_SESSION[$Text_Field])) echo $_SESSION[$Text_Field];?></textarea>
									<?php
									}
								else
									{
									?>
									<input readonly name="<?php echo $Text_Field;?>" type="<?php echo $Type;?>" class="<?php echo $Class;?>" size="<?php echo $Length;?>">
									<?php
									}
							}
					
					}
					
			}
		public function Text_Field_Edit($Text_Field,$Value,$Class='',$Length='',$Type='',$Att='',$Pos='')
			{
				if($Length == NULL)
					{
						$Length= "30";
					}
				if($Type == NULL)
					{
						$Type= "text";
					}
				 if(!isset($_SESSION['Arabic']))
					{
						$Class = 'English';
					}
				else
					{
						$Class = 'Arabic';
					}
						if(isset($_SESSION['Errors'][$Text_Field]))
							{
								$BG = '#FFCC00';
							}
						if($Att == NULL)
							{
								if($Type == 'textarea')
									{
									?>
									<textarea name="<?php echo $Text_Field;?>" class="<?php echo $Class;?>" cols="40" rows="5"><?php echo $Value;?></textarea>
									<?php
									}
								else
									{
									?>
									<input style="background-color:<?php echo $BG;?> " name="<?php echo $Text_Field;?>" type="<?php echo $Type;?>" class="<?php echo $Class;?>" value="<?php echo $Value;?>" size="<?php echo $Length;?>">
									<?php
									}
							
							}
						else
							{
								if($Type == 'textarea')
									{
									?>
									<textarea name="<?php echo $Text_Field;?>" class="<?php echo $Class;?>" cols="40" rows="5"><?php echo $Value;?></textarea>
									<?php
									}
								else
									{
									?>
									<input readonly style="background-color:<?php echo $BG;?> " name="<?php echo $Text_Field;?>" type="<?php echo $Type;?>" class="<?php echo $Class;?>" value="<?php echo $Value;?>" size="<?php echo $Length;?>">
									<?php
									}
							
							}
					
					
				if(isset($_SESSION['Errors'][$Text_Field]))
					{
						if($Att == NULL)
							{
								if($Pos == NULL)
									{
									?>
									&nbsp;<span class="Errors" style=" position:absolute; right:440px"><?php echo $_SESSION['Errors'][$Text_Field];?></span>
									<?php
									}
								else
									{
									?>
									&nbsp;<span class="Errors" style=" position:absolute; right:<?php echo $Pos;?>px"><?php echo $_SESSION['Errors'][$Text_Field];?></span>
									<?php
									}
							
							}
						else
							{
								if($Pos == NULL)
									{
									?>
									&nbsp;<span class="Errors" style=" position:absolute; right:250px"><?php echo $_SESSION['Errors'][$Text_Field];?></span>
									<?php
									}
								else
									{
									?>
									&nbsp;<span class="Errors" style=" position:absolute; right:<?php echo $Pos;?>px"><?php echo $_SESSION['Errors'][$Text_Field];?></span>
									<?php
									}
							
							}
					}
			}
		public function Text_Field_Edit_Table($Text_Field,$Value,$Class='',$Length='',$Type='',$Att='')
			{
				if($Length == NULL)
					{
						$Length= "30";
					}
				if($Type == NULL)
					{
						$Type= "text";
					}
				 if(!isset($_SESSION['Arabic']))
					{
						$Class = 'English';
					}
				else
					{
						$Class = 'Arabic';
					}
						if(isset($_SESSION['Errors'][$Text_Field]))
							{
								$BG = '#FFCC00';
							}
						if($Att == NULL)
							{
								if($Type == 'textarea')
									{
									?>
									<textarea name="<?php echo $Text_Field;?>" class="<?php echo $Class;?>" cols="40" rows="5"><?php echo $Value;?></textarea>
									<?php
									}
								else
									{
									?>
									<input style="background-color:<?php echo $BG;?> " name="<?php echo $Text_Field;?>" type="<?php echo $Type;?>" class="<?php echo $Class;?>" value="<?php echo $Value;?>" size="<?php echo $Length;?>">
									<?php
									}
							
							}
						else
							{
								if($Type == 'textarea')
									{
									?>
									<textarea name="<?php echo $Text_Field;?>" class="<?php echo $Class;?>" cols="40" rows="5"><?php echo $Value;?></textarea>
									<?php
									}
								else
									{
									?>
									<input readonly style="background-color:<?php echo $BG;?> " name="<?php echo $Text_Field;?>" type="<?php echo $Type;?>" class="<?php echo $Class;?>" value="<?php echo $Value;?>" size="<?php echo $Length;?>">
									<?php
									}
							
							}
					
			}
		function __destruct()
			{
				$this->db = NULL;
			}
	}
?>