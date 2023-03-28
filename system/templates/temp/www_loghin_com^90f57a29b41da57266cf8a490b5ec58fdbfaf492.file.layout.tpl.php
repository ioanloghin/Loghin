<?php /* Smarty version Smarty-3.1.7, created on 2023-03-20 13:49:25
         compiled from "/home/loghin/public_html/system/templates/layout.tpl" */ ?>
<?php /*%%SmartyHeaderCode:19378965034fc01d82429339-51919439%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '90f57a29b41da57266cf8a490b5ec58fdbfaf492' => 
    array (
      0 => '/home/loghin/public_html/system/templates/layout.tpl',
      1 => 1679302565,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '19378965034fc01d82429339-51919439',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_4fc01d8258c3a',
  'variables' => 
  array (
    'vir_path' => 0,
    'center' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4fc01d8258c3a')) {function content_4fc01d8258c3a($_smarty_tpl) {?><?php if (!is_callable('smarty_function_stylesheets')) include '/home/loghin/sources/!core/plugins/function.stylesheets.php';
if (!is_callable('smarty_function_scripts')) include '/home/loghin/sources/!core/plugins/function.scripts.php';
?><!DOCTYPE html>
<html lang="en">
<head><meta charset="utf-8" /><title></title><meta name="description" content="" /><meta name="keywords" content="" /><?php echo smarty_function_stylesheets(array(),$_smarty_tpl);?>
<?php echo smarty_function_scripts(array(),$_smarty_tpl);?>
<!--[if lt IE 9]><script type="text/javascript">document.createElement('header');document.createElement('footer');</script><![endif]--><!-- /system/templates/layout.tpl --></head>
<body>
	<div id="container" class="min-width">
		<div id="head-line" class="clear bg">
			<div class="left">
				Welcome, <a class="arrow strong" href="#">Username</a> &nbsp;|&nbsp;
				<a href="/">Loghin.com</a> &nbsp;|&nbsp;
				<a href="#">Loghin.us</a> &nbsp;|&nbsp;
				<a href="<?php echo $_smarty_tpl->tpl_vars['vir_path']->value;?>
">System</a> &nbsp;|&nbsp;
				<a href="<?php echo $_smarty_tpl->tpl_vars['vir_path']->value;?>
search/">Search</a> &nbsp;|&nbsp;
				<a href="<?php echo $_smarty_tpl->tpl_vars['vir_path']->value;?>
image/">Image</a>
			</div><!-- #head-line .left -->
			<div class="right">
				<select class="inputCombo" name="lang">
					<option value="en">English</option>
				</select>
			</div><!-- #head-line .right -->
		</div><!-- #head-line -->

		<header>
			<ul id="menu" class="clear">
				<li>
					<a class="clear" href="#"><span>Tennagers</span> <i></i></a>
					<ul>
						<li><a href="#">Lorem Ipsum</a></li>
						<li><a href="#">Lorem Ipsum</a></li>
						<li><a href="#">Lorem Ipsum</a></li>
						<li><a href="#">Lorem Ipsum</a></li>
					</ul>
				</li>
				<li class="boll"></li>
				<li><a class="clear" href="#"><span>Adults</span> <i></i></a></li>
				<li class="boll"></li>
				<li class="selected"><a class="clear" href="#"><span>Business</span> <i></i></a></li>
				<li class="boll"></li>
				<li>
					<a class="clear" href="#"><span>Institutions</span> <i></i></a>
					<ul>
						<li><a href="#">Lorem Ipsum</a></li>
						<li><a href="#">Lorem Ipsum</a></li>
						<li><a href="#">Lorem Ipsum</a></li>
						<li><a href="#">Lorem Ipsum</a></li>
					</ul>
				</li>
				<li class="boll"></li>
				<li><a class="clear" href="#"><span>Games</span> <i></i></a></li>
				<li class="boll"></li>
				<li><a class="clear" href="#"><span>Community</span> <i></i></a></li>
				<li class="boll"></li>
				<li><a class="clear" href="#"><span>Web</span> <i></i></a></li>
				<li class="boll"></li>
				<li>
					<a class="clear" href="#"><span>More</span> <i></i></a>
					<ul>
						<li><a href="#">Lorem Ipsum</a></li>
						<li><a href="#">Lorem Ipsum</a></li>
						<li><a href="#">Lorem Ipsum</a></li>
						<li><a href="#">Lorem Ipsum</a></li>
						<li><a href="#">Lorem Ipsum</a></li>
						<li><a href="#">Lorem Ipsum</a></li>
						<li><a href="#">Lorem Ipsum</a></li>
						<li><a href="#">Lorem Ipsum</a></li>
					</ul>
				</li>
			</ul><!-- #menu -->

			<div class="bottom">
				<div class="left clear">
					<div class="back-next clear left">
						<a class="back left icon" href="#back"><< Back</a>
						<a class="next right icon" href="#next">Next >></a>
					</div>
					<div class="address-bar clear left">
	                    <ul>
	                        <li class="down">
	                            <a href="#">Account</a>
	                            <ul>
	                                <li><a href="#">Lorem Ipsum</a></li>
	                                <li><a href="#">Lorem Ipsum</a></li>
	                                <li><a href="#">Lorem Ipsum</a></li>
	                            </ul>
	                        </li>
	                        <li><a href="#">User</a></li>
	                        <li class="down">
	                            <a href="#">Nick Name</a>
	                            <ul>
	                                <li><a href="#">Lorem Ipsum</a></li>
	                                <li><a href="#">Lorem Ipsum</a></li>
	                                <li><a href="#">Lorem Ipsum</a></li>
	                            </ul>
	                        </li>
	                        <li><a href="#">Profil</a></li>
	                    </ul>
					</div>
					<div class="address-bar-submit clear left">
						<input class="inputSubmit" type="submit" value="" />
					</div>
					<div class="overflow clear left">
						<div class="view">
							<ul class="menu full left second">
								<li><a class="clear" href="#"><span class="icon small left home">Home</span><span class="down left">&nbsp;</span><i>&nbsp;</i></a></li>
								<li><a class="clear" href="#"><span class="icon small left print">Print</span><span class="down left">&nbsp;</span><i>&nbsp;</i></a></li>
								<li><a class="clear" href="#"><span class="icon small left fav">Favorites</span><i>&nbsp;</i></a></li>
								<li><a class="clear" href="#"><span class="icon small left file">File</span><i>&nbsp;</i></a></li>
							</ul>
						</div>
					</div>
					<ul class="menu first left">
						<li><a class="clear" href="#"><span class="icon small left home">Home</span><span class="down left">&nbsp;</span><i>&nbsp;</i></a></li>
						<li><a class="clear" href="#"><span class="icon small left print">Print</span><span class="down left">&nbsp;</span><i>&nbsp;</i></a></li>
						<li><a class="clear" href="#"><span class="icon small left fav">Favorites</span><i>&nbsp;</i></a></li>
						<li><a class="clear" href="#"><span class="icon small left file">File</span><i>&nbsp;</i></a></li>
					</ul>
				</div><!-- header .bottom .left -->

				<div class="search-bar right clear">
					<form action="" method="get" style="display:flex;">
						<input class="inputSubmit" type="submit" value="" />
						<input class="inputText" type="text" name="search" value="" placeholder="Search Bar" />
					</form><i></i>
				</div><!-- .search-bar -->
			</div><!-- header .bottom -->
		</header>

		<div id="body" class="clear">
			<div class="left">
				<?php echo $_smarty_tpl->getSubTemplate ('left/default.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

			</div><!-- #body .left -->

			<div class="right">
				<div id="a-search" class="block">
					<h2 class="bg">Advance Search <a class="icon" href="javascript:void(0);" name="search s-over">&raquo;</a></h2>
					<div class="padding">
						<?php echo $_smarty_tpl->getSubTemplate ('right/default.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

					</div>
				</div>
				<div class="closed">
					<span class="icon"></span>
					<span class="text">Advanced<br /><br />Search</span>
					<span class="icon center"></span>
				</div>
			</div><!-- #body .right -->

			<div class="middle">
				<div class="block">
					<h2 class="bg">Contents</h2>
					<div<?php if (false==empty($_smarty_tpl->tpl_vars['center']->value[2])){?> class="<?php echo $_smarty_tpl->tpl_vars['center']->value[2];?>
"<?php }?>>
						<?php if (false==empty($_smarty_tpl->tpl_vars['center']->value[1])){?><?php echo $_smarty_tpl->getSubTemplate ("center/".($_smarty_tpl->tpl_vars['center']->value[1]), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }?>
					</div>
				</div>
			</div><!-- #body .middle -->
		</div><!-- #body -->
		<footer></footer>
	</div>
</body>
</html><?php }} ?>