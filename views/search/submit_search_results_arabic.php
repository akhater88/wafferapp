<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo __SCRIPT_PATH;?>js/jquery.highlight-search-terms.js"></script>
    <script type="text/javascript">
      $(function () {
        $("div#inner-text").highlightSearchTerms({
          referrer: "http://www.google.com/search?q=<?php echo $Target;?>"
        });
      });
    </script>
<style type="text/css">
      em.highlight {
        color: #000;
        background-color: #ff0;
      }
 </style>
<div class="inner-tit">نـتـائـج الـبـحـث</div>
<div class="inner-line"><img alt="" src="<?php echo __SCRIPT_PATH;?>images/line-tit.gif" width="322" height="2" /></div>
<div id="inner-text">
<table width="100%" border="0">
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>

<?php
$Page_Counter = 1;
$result_Count = count($results);
if((count($results))||(count($results_news)))
	{
	?>
    <div style="font-size:20px; font-weight:bold; text-decoration:underline">تـم الـعـثـور عـلـى الـنـتـائـج الـتـالـيــة :</div>
    <div>&nbsp;</div>
    <?php
	}
if(count($results))
	{
	?>
    
    <table width="100%" border="0">
    <?php
		foreach($results as $rows)
			{
				$Content = stripslashes(html_entity_decode($rows->Content,ENT_QUOTES,'UTF-8'));
				?>
				<tr>
					<td width="15%"><span style="font-size:16px; font-weight:bold">عـنـوان الـصـفـحــة :</span></td>
					<td width="85%"><?php echo stripslashes($rows->Title);?></td>
	  </tr>
                <tr>
					<td colspan="2"><span style="font-size:16px; font-weight:bold">محـتـوى الـصـفـحـة :</span></td>
				</tr>
                <tr>
					<td colspan="2"><div style="position:relative; top:-8px"><?php echo $Content;?></div></td>
				</tr>
				<?php
				if($Page_Counter != $result_Count)
					{
					?>
                    <tr>
					<td colspan="2"><hr /></td>
					</tr>
                    <?php
					}
				$Page_Counter++;	
			}
	?>
    </table>
    <?php
	}
$Page_Counter = 1;
$result_Count = count($results_news);
if(count($results_news))
	{
	?>
    <HR />
    <table width="100%" border="0">
    <?php
		foreach($results_news as $rows)
			{
				$Newsletter_Intro = stripslashes(html_entity_decode($rows->Newsletter_Intro,ENT_QUOTES,'UTF-8'));
				$Newsletter_Content = stripslashes(html_entity_decode($rows->Newsletter_Content,ENT_QUOTES,'UTF-8'));
				$Article = $Newsletter_Intro.$Newsletter_Content;
				?>
				<tr>
					<td width="15%"><span style="font-size:16px; font-weight:bold">عـنـوان الـخـبـر :</span></td>
					<td width="85%"><?php echo stripslashes($rows->News_Title);?></td>
	  </tr>
                <tr>
					<td colspan="2"><span style="font-size:16px; font-weight:bold"> محـتـوى الـخـبـر :</span></td>
				</tr>
                <tr>
					<td colspan="2"><div style="position:relative; top:-8px"><?php echo $Article;?></div></td>
				</tr>
				<?php	
				if($Page_Counter != $result_Count)
					{
					?>
                    <tr>
						<td colspan="2"><hr /></td>
					</tr>
                    <?php
					}
				$Page_Counter++;
			}
	?>
    </table>
    <?php
	}
?>
</div>
