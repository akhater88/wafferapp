<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<?php
if(isset($_SESSION['Arabic']))
	{
		$Dir = 'rtl';
	}
else
	{
		$Dir = 'ltr';
	}
?>
<style>
.Submit_Edit_Main{
width:80px;
height:25px;
background-color:#000066;
color:#FFFFFF;
cursor:pointer;
}
</style>
<div style="position:relative"><span><input name="textfield" type="text" size="30" dir="<?php echo $Dir;?>">
</span>&nbsp;<span><input type="button" id="<?php echo $rows->ID;?>" name="Sub_Menu_Btn" value="إرسـال" class="Submit_Edit_Main"></span></div>

