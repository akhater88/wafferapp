CKEDITOR.editorConfig = function( config )
									{
										// Define changes to default configuration here. For example:
										// config.language = 'fr';
										// config.uiColor = '#AADC6E';
									};
									
									CKEDITOR.editorConfig = function(config) {
										
										config.language = 'ar';
										config.toolbar = 'MyToolbar';
										config.toolbar_MyToolbar =
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
										];
										
										config.toolbar_Simple =
										[
											
											['Styles','Format'],
											['Bold','Italic','Strike'],
											['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
											['Link','Unlink','Anchor'],
											['Maximize','-','About']
										];
										config.resize_enabled = false;
										config.width = '600px';
									   config.filebrowserBrowseUrl = 'http://www.softiletest.com/waffer/mypanel/includes/ckeditor/kcfinder/browse.php?type=files';
									   config.filebrowserImageBrowseUrl = 'http://www.softiletest.com/waffer/mypanel/includes/ckeditor/kcfinder/browse.php?type=images';
									   config.filebrowserFlashBrowseUrl = 'http://www.softiletest.com/waffer/mypanel/includes/ckeditor/kcfinder/browse.php?type=flash';
									   config.filebrowserUploadUrl = 'http://www.softiletest.com/waffer/mypanel/includes/ckeditor/kcfinder/upload.php?type=files';
									   config.filebrowserImageUploadUrl = 'http://www.softiletest.com/waffer/mypanel/includes/ckeditor/kcfinder/upload.php?type=images';
									   config.filebrowserFlashUploadUrl = 'http://www.softiletest.com/waffer/mypanel/includes/ckeditor/kcfinder/upload.php?type=flash';
									};