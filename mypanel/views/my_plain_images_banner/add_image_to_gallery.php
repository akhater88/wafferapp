<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<div class="Image_Container">
<div>&nbsp;</div>
<?php
if(isset($_SESSION['Arabic']))
	{
		$Dir = 'rtl';
		$Lang = 'ar';
		$Table_Images = 'plain_images_banner';
	}
else
	{
		$Dir = 'ltr';
		$Lang = 'eng';
		$Table_Images = 'plain_images_banner_english';
	}

?>
<link href="<?php echo __SCRIPT_PATH;?>css/uploadify.css" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="<?php echo __SCRIPT_PATH;?>js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="<?php echo __SCRIPT_PATH;?>js/swfobject.js"></script>
<script type="text/javascript" src="<?php echo __SCRIPT_PATH;?>js/jquery.uploadify.v2.1.4.min.js"></script>
<script src="<?php echo __SCRIPT_PATH;?>js/jquery.easing.1.3.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function() {
		$('.Paginate').click(function(){
			var Page = $(this).attr('id'); 
			$.post('<?php echo __LINK_PATH;?>my_plain_images_banner/add_image_to_gallery/AJAX/Y',{Page:Page},function(data){
				$('.Image_Container').html(data);
				$('#Product_Container').delay(300).fadeIn();
				});
			});	
			
  $('#file_upload').uploadify({
    'uploader'  : '<?php echo __SCRIPT_PATH;?>images/uploadify.swf',
    'script'    : '<?php echo __LINK_PATH;?>my_plain_images_banner/add_new_images/AJAX/Y/',
    'cancelImg' : '<?php echo __SCRIPT_PATH;?>images/cancel.png',
    'folder'    : 'Plain_Image_Gallery', //Name of folder where images will be uploaded to.
	'fileExt'     : '*.jpg;*.gif;*.png',
	'fileDesc'    : 'Image Files',
	'sizeLimit'   : 2000000,
	'scriptData'  : {'Table':'<?php echo $Table_Images;?>','Folder_Name':'Plain_Image_Gallery'},
    'auto'      : true,
	'onAllComplete' : function(event,data) {
		//window.location = '<?php echo __LINK_PATH;?>my_plain_images_banner/add_image_to_gallery';
		setTimeout('$.fn.myFunction()',100);
		$.fn.myFunction = function() { 
		$.getJSON('<?php echo __SCRIPT_PATH;?>json/Image_Error.json',function(json){
		var Flag = json.flag;
		if(Flag == '1')
			{
				alert('خـطـأ فـي الـصــورة');
				//$('<span class="JSErrors">الإسـم الـذي إخـتـرتـه مـوجــود</span>').appendTo('.sub_menu_msg');
			}
		else if(Flag == '2')
			{
				alert('You must select an image for upload');
			}
		else
			{
				window.location = '<?php echo __LINK_PATH;?>my_plain_images_banner/add_image_to_gallery';
			}
								
			});
		}
	  }
  });
 
 $('.Del_Img_Btn').click(function(){
		var ID = $(this).attr('id'); 
		if (confirm("هــل تـريـد الإسـتـمـرار فـي عـمـلــيـة الـمـسسـح؟")) {
		$.post('<?php echo __LINK_PATH;?>my_plain_images_banner/delete_selected_image/AJAX/Y/',{ID:ID},function(data){
			$('.Image_Container').html(data);
			});
		}
	}); 

});
</script>
<style>
.Paginate{
margin-right:5px;
cursor:pointer;
color:#0099FF;
}
</style>
<div style="line-height:5px ">&nbsp;</div>
<?php
if((is_array($results)) && (count($results)))
	{
		if(count($results) > 6)
			{
				$Table_Width = 612;
			}
		else
			{
				$Table_Width = count($results) * 100;
				$Table_Width += count($results) * 2;
			}
		$Counter = 1;
		?>
		<div id="Product_Container" align="right">
		<table width="<?php echo $Table_Width;?>px"  border="0">
		<?php
		foreach($results as $rows)
			{
				$Image_Path = __SCRIPT_PATH.'Plain_Image_Gallery/'.$rows->Image_Path;
				if($Counter == 1)
					{
					?>
					 <tr>
					<?php
					}
				?>
				<td width="100px"  id="TD_<?php echo $rows->ID;?>">
				<div align="center"><img src="<?php echo $Image_Path;?>" width="100" height="100"></div>
				<div align="right"><img class="Del_Img_Btn" id="<?php echo $rows->ID;?>" style="cursor:pointer; margin-right:2px " src="<?php echo __SCRIPT_PATH;?>images/del.gif" width="20" height="20"></div>
				</td>
				<?php
				$Counter++;
				if($Counter > 6)
					{
						$Counter = 1;
						?>
						</tr>
						<?php
					}
			}
		?>
		</table>
		</div>
		<?php
	}
?>
<div style="line-height:15px ">&nbsp;</div>
<div align="right">
<input id="file_upload" name="file_upload" type="file" />
</div>
<div style="line-height:12px ">&nbsp;</div>
<?php
//Footer paginations 

if ($Page < 1) 
	{ 
		$Page = 1; 
	} 
elseif ($Page > $Last) 
	{ 
		$Page = $Last; 
	}
if($Last > 1)
	{
		?>
		<div dir="rtl" style="background-color:#CCDAE3 ">
		<?php
		for($i = 0; $i<$Last; $i++)
			{
				$next = $i+1;
				if($Page != $i+1)
				{
				?>
				<span class="Paginate" id="<?php echo $next;?>"><?php echo $i+1;?></span>
				<?php
				}
			else
				{
				?>
				<span style="margin-right:5px "><?php echo $i+1;?></span>
				<?php
				}
				
			}
			?>
			</div>
			<?php
	}			
?>
</div>