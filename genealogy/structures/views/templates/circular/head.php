<!DOCTYPE html>
<html lang="en">
<head>
<title><?php echo $title;?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="author" content="http://loghin.com" />
<meta name="robots" content="Index, Follow" />
<link rel="shortcut icon" href="<?php echo base_image(template, 'browsericon.png');?>" />
<!-- Se includ fisierele css si javascript -->
<?php
echo style('circular', 'cssLoader.css')."\n";
?>