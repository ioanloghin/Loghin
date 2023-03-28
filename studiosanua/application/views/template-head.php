<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title><?php echo $meta_title; ?></title>
    
    <link rel="stylesheet" href="<?php echo base_url('assets/js/fancybox/fancybox.css');?>" />
	<script src="<?php echo base_url('assets/js/jquery.js');?>"></script>
	<script src="<?php echo base_url('assets/js/jquery.ui.js');?>"></script>
	<script src="<?php echo base_url('assets/js/mouseWheel.js');?>"></script>
	<script src="<?php echo base_url('assets/js/scroll.js');?>"></script>
	<script src="<?php echo base_url('assets/js/fancybox/fancybox.js');?>"></script>
	<script src="<?php echo base_url('assets/js/misc.js');?>"></script>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/site-layout.css');?>">
    
    <link rel="stylesheet" href="<?php echo base_url('assets/css/style.css');?>" />
    <script>
    var ROOT = '/';
    <!-- js config -->
    var conf = {
        'PATH': "/",
        'cssPath': "<?php echo base_url('assets/css/');?>",
        'picPath': "<?php echo base_url('assets/img/harmony/');?>",
        'loggedin': "0"
    };
    </script>
    <script>$.conf = { 'path': "<?php echo base_url('');?>" };</script>
</head>

<body>
	<!-- autologin script -->
	<?php
	$login_server_url = 'http://structures.loghin.com/crossdomain/login/';
	$callback_url = 'http://studiosanua.com/autologin/received';
	?>
	<iframe style="position:absolute;" src="<?php echo $login_server_url;?>?ref=<?php echo rawurlencode($callback_url);?>" width="0" height="0" frameborder="0"></iframe>