<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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
foreach($results as $rows)
	{
		
		$Title = stripslashes($rows->Title);
		$Content = html_entity_decode($rows->Content,ENT_QUOTES,'UTF-8');
		$Content = stripslashes($Content);
	}
?>
<style>
.Submit_BTN{
width:80px;
height:25px;
background-color:#000066;
color:#FFFFFF;
cursor:pointer;
}
</style>
<script type="text/javascript" src="<?php echo __SCRIPT_PATH;?>js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="<?php echo __SCRIPT_PATH;?>ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="<?php echo __SCRIPT_PATH;?>ckeditor/adapters/jquery.js"></script>
<div align="right" style="width:750px; line-height:25px">
<script type="text/javascript"> 
		$(document).ready(function() {
		$('.Submit_BTN').click(function(){
			var ID = '<?php echo $Member_ID;?>';
			var Title = $('#Title').val();
			var editor = $('#editor1').ckeditorGet();
			var Content = editor.getData();
			Content_Stripped = Content.replace(/<\/?[^>]+>/gi, ''); 
  			Content_Stripped = $.trim(Content_Stripped);
			var Title = $.trim(Title);
			if(Title == '')
				{
					alert('عـلـيـك إدراج عـنـوان الـصـفــحــة');
				}
			else if(Content_Stripped == '')
				{
					alert('عـلـيـك إدراج مـحـتـوى الـصـفــحــة');
				}
			else
				{
			$.post('<?php echo __LINK_PATH;?>menus_pages_subs/update_selected_page/AJAX/Y/',{ID:ID,Title:Title,Content:Content},function(data){
					$('#New_Page_Content').remove();
					alert('تـم الـتـعـديـل بـنـجـاح');
					window.location = '<?php echo __LINK_PATH;?>menus_pages_subs/edit_sub_menu/v/';
				});
				}
			
		});	
		//Initiate ckeditor :
			var config = {
            toolbar:
            [
                ['NewPage','Preview'],
				['Cut','Copy','Paste','PasteText','PasteFromWord','-','Scayt'],
				['Undo','Redo','-','Find','Replace','-','SelectAll','RemoveFormat'],
				['Image','Flash','Table','HorizontalRule','Smiley','SpecialChar','PageBreak'],
				'/',
				['Styles','Format','TextColor','BGColor'],
				['Bold','Italic','Strike'],
				['NumberedList','BulletedList','-','Outdent','Indent','Blockquote'],
				['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
				['Link','Unlink','Anchor'],
				['Maximize','-','About']
            ]
			
        }; 
		config.width = '600px';
		config.language = '<?php echo $Lang;?>';
		$('#editor1').ckeditor(config);
			
	});
	</script>
<div id="New_Page_Content">
<table width="100%" border="0">
<tr>
	<td colspan="2"><div id="Error_Catcher" align="right" style="color:#FF0000; font-family:'Times New Roman', Times, serif; font-size:15px; font-weight:bold"></div></td>
</tr>
  <tr>
    <td width="87%"><div align="right"><input name="Title" type="text" id="Title" size="40" dir="<?php echo $Dir;?>" value="<?php echo $Title;?>">
    </div></td>
    <td width="13%"><div align="right" style="font-family:'Times New Roman', Times, serif; font-size:15px; font-weight:bold">: عـنـوان الـصـفـحــة</div></td>
  </tr>
  <tr>
    <td colspan="2"><div align="right" style="font-family:'Times New Roman', Times, serif; font-size:15px; font-weight:bold">: الـمـحتـوى</div></td>
  </tr>
  <tr>
     <td colspan="2">
     <div align="right">
     <textarea id="editor1" name="Content">
		<?php
		echo $Content;
		?>
	</textarea>
     </div>
     </td>
  </tr>
  <tr>
  	<td>&nbsp;</td>
    <td><div align="right"><input type="submit" name="Submit" value="إرسـال" class="Submit_BTN"></div></td>
  </tr>
</table>
</div>
</div>