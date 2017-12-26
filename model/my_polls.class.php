<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
class my_polls
	{
		public function start_poll()
			{
				$this->getPoll(1);
			}
		public function submit_poll()
			{
				$action = @$_POST['action'];
				$pollAnswerID = @$_POST['pollAnswerID'];
				
				//if($action == "vote")
					//{
						//if(isset($_COOKIE["poll".$this->getPollID($pollAnswerID)]))
							//{
								//echo "voted";
							//} 
						//else 
							//{
								$Display = new sql();
								if(isset($_SESSION['Arabic']))
									{
										$sql  = 'UPDATE pollanswers SET pollAnswerPoints = pollAnswerPoints + 1 WHERE pollAnswerID = ?';
									}
								else
									{
										$sql  = 'UPDATE pollanswers_english SET pollAnswerPoints = pollAnswerPoints + 1 WHERE pollAnswerID = ?';
									}
								$Execute_Array = array($pollAnswerID);
								$Display->Execute($sql,$Execute_Array);
								
								
								setcookie("poll" .$this->getPollID($pollAnswerID), 1, time()+259200, "/", ".webresourcesdepot.com");
								if(isset($_SESSION['Arabic']))
									{
										$sql  = 'SELECT pollID FROM pollanswers WHERE pollAnswerID = ?';
									}
								else
									{
										$sql  = 'SELECT pollID FROM pollanswers_english WHERE pollAnswerID = ?';
									}
								$Execute_Array = array($pollAnswerID);
								$result = $Display->Display_Info($sql,$Execute_Array);
								foreach($result as $rows)
									{
										$pollID = $rows->pollID;
									}
								
								$My_String = $this->getPollResults($pollID);
								//$My_String = explode('Start_Here',$My_String);
								//$My_String_Array = explode('<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />',$My_String);
								//$My_String_Count = count($My_String_Array);
								//$My_String = str_replace('<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />','',$My_String);
								
								echo $My_String;
							//}
					//}
			}
		public function getPoll($pollID)
			{
				$Display = new sql();
				if(isset($_SESSION['Arabic']))
					{
						$sql  = 'SELECT * FROM polls LEFT JOIN pollanswers ON polls.pollID = pollanswers.pollID WHERE polls.pollID = ? ORDER By pollAnswerListing ASC';
					}
				else
					{
						$sql  = 'SELECT * FROM polls_english LEFT JOIN pollanswers_english ON polls_english.pollID = pollanswers_english.pollID WHERE polls_english.pollID = ? ORDER By pollAnswerListing ASC';
					}
				$Execute_Array = array($pollID);
				$result = $Display->Display_Info($sql,$Execute_Array);
				
				$pollStartHtml = '';
				$pollAnswersHtml = '';
				$Destination = __LINK_PATH.'polls/submit_poll/AJAX/Y/';
				foreach($result as $rows)
					{
						$pollQuestion 	= $rows->pollQuestion;	
						$pollAnswerID 	= $rows->pollAnswerID;	
						$pollAnswerValue = $rows->pollAnswerValue;
						
						if ($pollStartHtml == '') {
							$pollStartHtml 	= '<div id="pollWrap"><form name="pollForm" method="post" action='.$Destination.'><h3>' . $pollQuestion .'</h3><ul>';
							$pollEndHtml 	= '</ul><input type="submit" name="pollSubmit" id="pollSubmit" value="Vote" /> <span id="pollMessage"></span><img src="ajaxLoader.gif" alt="Ajax Loader" id="pollAjaxLoader" /></form></div>';	
						}
						$pollAnswersHtml	= $pollAnswersHtml . '<li><input name="pollAnswerID" id="pollRadioButton' . $pollAnswerID . '" type="radio" value="' . $pollAnswerID . '" /> ' . $pollAnswerValue .'<span id="pollAnswer' . $pollAnswerID . '"></span></li>';
						$pollAnswersHtml	= $pollAnswersHtml . '<li class="pollChart pollChart' . $pollAnswerID . '"></li>';
					}
				echo $pollStartHtml . $pollAnswersHtml . $pollEndHtml;
			}

		public function getPollID($pollAnswerID)
			{
				$Display = new sql();
				if(isset($_SESSION['Arabic']))
					{
						$sql  = 'SELECT pollID FROM pollanswers WHERE pollAnswerID = ? LIMIT 1';
					}
				else
					{
						$sql  = 'SELECT pollID FROM pollanswers_english WHERE pollAnswerID = ? LIMIT 1';
					}
				$Execute_Array = array($pollAnswerID);
				$result = $Display->Display_Info($sql,$Execute_Array);
				foreach($result as $rows)
					{
						return $rows->pollID;	
					}
			}

		public function getPollResults($pollID)
			{
				$Display = new sql();
				$pollResults = '';
				$colorArray = array(1 => "#ffcc00", "#00ff00", "#cc0000", "#0066cc", "#ff0099", "#ffcc00", "#00ff00", "#cc0000", "#0066cc", "#ff0099");
				$colorCounter = 1;
				if(isset($_SESSION['Arabic']))
					{
						$sql  = 'SELECT pollAnswerID, pollAnswerPoints FROM pollanswers WHERE pollID = ?';
					}
				else
					{
						$sql  = 'SELECT pollAnswerID, pollAnswerPoints FROM pollanswers_english WHERE pollID = ?';
					}
				$Execute_Array = array($pollID);
				$result = $Display->Display_Info($sql,$Execute_Array);
				foreach($result as $rows)
					{
						if ($pollResults == "") {
						$pollResults = $rows->pollAnswerID . "|" . $rows->pollAnswerPoints . "|" . $colorArray[$colorCounter];
						} else {
							$pollResults = $pollResults . "-" . $rows->pollAnswerID . "|" . $rows->pollAnswerPoints . "|" . $colorArray[$colorCounter];
						}
						$colorCounter = $colorCounter + 1;
					}
				$Num = 0;
				if(isset($_SESSION['Arabic']))
					{
						$sql  = 'SELECT pollAnswerPoints FROM pollanswers WHERE pollID = ?';
					}
				else
					{
						$sql  = 'SELECT pollAnswerPoints FROM pollanswers_english WHERE pollID = ?';
					}
				$Execute_Array = array($pollID);
				$result = $Display->Display_Info($sql,$Execute_Array);
				foreach($result as $rows)
					{
						$Num += $rows->pollAnswerPoints;
					}
				$pollResults = $pollResults . "-".$Num;
				$this->start_poll($pollResults);
				return $pollResults;	
			}
	}
?>