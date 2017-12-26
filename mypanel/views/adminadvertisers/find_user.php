<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<div align="right" style="width:900px; font-size:15px; font-weight:bold ">
<div>&nbsp;</div>
<?php
if(isset($_SESSION['Arabic']))
	{
		$Dir = 'rtl';
		$Lang = 'ar';
	}
else
	{
		$Dir = 'ltr';
		$Lang = 'eng';
	}
$Today = date('d-m-Y');
$Time_Stamp = date('m_d_Y').time();
?>
<script type="text/javascript" src="<?php echo __SCRIPT_PATH;?>js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="<?php echo __SCRIPT_PATH;?>js/datepicker.js"></script>
<link rel="stylesheet" href="<?php echo __SCRIPT_PATH;?>css/datepicker.css" type="text/css" />
<script type="text/javascript"> 
	$(document).ready(function() {
	 $('#Start_Date').DatePicker({
		format:'d-m-Y',
		date: $('#Start_Date').val(),
		current: $('#Start_Date').val(),
		starts: 7,
		position: 'left',
		onBeforeShow: function(){
			$('#Start_Date').DatePickerSetDate($('#Start_Date').val(), true);
		},
		onChange: function(formated, dates){
			$('#Start_Date').val(formated);
		}
	});
	
			
	$('#End_Date').DatePicker({
		format:'d-m-Y',
		date: $('#End_Date').val(),
		current: $('#End_Date').val(),
		starts: 7,
		position: 'left',
		onBeforeShow: function(){
			$('#inputDate_2').DatePickerSetDate($('#End_Date').val(), true);
		},
		onChange: function(formated, dates){
			$('#End_Date').val(formated);
		}
	});
		jQuery.saveData = function(Target,ID){
			$('#Target').val(Target);
			$('#Target').attr('id',ID);
			};	
			
		$('.Selected_Item').hover(
		  function () {
			$(this).css({'background-color':'#CCDAE3','cursor':'pointer'});
		  },
		  function () {
			$(this).css({'background-color':'#F5F5F5'});
		  }
		);
	});
</script>

<?php
if(count($results))
	{
	?>
	<div id="Results_Div" style="z-index:10; background-color:#F5F5F5; padding:5px; width:220px " >
	<?php
	foreach($results as $rows)
		{
			$ID = $rows->ID;
			$Full_Name = $rows->First_Name.' '. $rows->Last_Name;
			?>
			<div class="Selected_Item" onClick="$.saveData('<?php echo $Full_Name;?>','<?php echo $ID;?>')"><?php echo $Full_Name;?></div>
			<?php
		}
		?>
	</div>
	<?php
	}
?>
