<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<textarea id="content" name="content">cccc</textarea>
<?php
 
 // Make sure you're using correct paths here
 include_once 'ckeditor.php';
// include_once 'ckfinder2/ckfinder.php';
$ckeditor = new CKEditor();
$ckeditor->basePath = './';
$ckeditor->replace("content");
 ?>
 
</body>
</html>
