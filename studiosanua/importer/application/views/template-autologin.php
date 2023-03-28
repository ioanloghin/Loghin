<!-- autologin script -->
<?php
$login_server_url = 'http://structures.loghin.com/crossdomain/login/';
$callback_url = 'http://studiosanua.com/importer/autologin/received';
?>
<iframe style="position:absolute;" src="<?php echo $login_server_url;?>?ref=<?php echo rawurlencode($callback_url);?>" width="0" height="0" frameborder="0"></iframe>