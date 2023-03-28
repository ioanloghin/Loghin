<!DOCTYPE html>
<html lang="en">
<head>
<title><?php echo $title;?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="author" content="http://loghin.com" />
<meta name="robots" content="Index, Follow" />
<link rel="shortcut icon" href="<?php echo base_image(config_item('template'), 'browsericon.png');?>" />
<!-- Se includ fisierele css si javascript -->
<?php
echo style(config_item('template'), 'cssLoader.css')."\n";

echo script(config_item('template'), 'jquery_ui/jquery-1.7.1.js')."\n";
echo script(config_item('template'), 'general.js')."\n";
?>
<script>
var ROOT = '<?php echo config_item('base_url');?>';
var controller = '<?php echo controller;?>';
var page = '<?php echo page;?>';
var lang = '<?php echo lang;?>';
var CLIENT_BROWSER = whichBrs();
<!-- js config -->
var conf = {
	'PATH': "<?php echo base_url('');?>",
	'cssPath': "<?php echo base_url('views/templates/'.config_item('template').'/css');?>",
	'picPath': "<?php echo base_url('views/templates/'.config_item('template').'/images');?>",
	'loggedin': "0"
};
</script>