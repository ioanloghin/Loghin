<?php /* Smarty version Smarty-3.1.7, created on 2012-05-26 23:40:00
         compiled from "/home/loghin/public_html/system/templates/center/search/plugins/head.tpl" */ ?>
<?php /*%%SmartyHeaderCode:19508966104fc1b0205db759-85175451%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e80ade83ddef18388d6e02fc1d1e7027d8017ff6' => 
    array (
      0 => '/home/loghin/public_html/system/templates/center/search/plugins/head.tpl',
      1 => 1338025936,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '19508966104fc1b0205db759-85175451',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'activeAction' => 0,
    'vir_path' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_4fc1b0206d33a',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4fc1b0206d33a')) {function content_4fc1b0206d33a($_smarty_tpl) {?><div id="search" class="head">
	<div class="navigation clear">
		<h3 class="left">Results 1 - 25 of 2,500 Items</h3>
		<ul class="control right clear">
			<li><a class="back button" href="#back"><strong>Back</strong><i></i></a></li>
			<li><a class="prev button" href="#prev"><span>Preview</span></a></li>
			<li class="last"><a class="next button" href="#next"><span>Next</span></a></li>
		</ul>
	</div><!-- #search .navigation -->

	<div class="tabs clear">
		<ul class="clear left">
			<li<?php if ($_smarty_tpl->tpl_vars['activeAction']->value=='loghin'){?> class="selected"<?php }?>><a href="<?php echo $_smarty_tpl->tpl_vars['vir_path']->value;?>
search/">Loghin</a></li>
			<li<?php if ($_smarty_tpl->tpl_vars['activeAction']->value!='loghin'){?> class="selected"<?php }?>><a href="<?php echo $_smarty_tpl->tpl_vars['vir_path']->value;?>
search/images/">Web</a></li>
		</ul><!-- #search .tabs .left -->

		<select class="inputCombo right">
			<option>Select Category</option>
		</select><!-- #search .tabs .right -->
		<ul class="clear right">
			<li class="has">
				<a href="#">Other <span class="icon"></span></a>
				<ul>
					<li<?php if ($_smarty_tpl->tpl_vars['activeAction']->value=='images'){?> class="selected"<?php }?>><a href="<?php echo $_smarty_tpl->tpl_vars['vir_path']->value;?>
search/images/">Images</a></li>
					<li<?php if ($_smarty_tpl->tpl_vars['activeAction']->value=='videos'){?> class="selected"<?php }?>><a href="<?php echo $_smarty_tpl->tpl_vars['vir_path']->value;?>
search/videos/">Videos</a></li>
					<li<?php if ($_smarty_tpl->tpl_vars['activeAction']->value=='text'){?> class="selected"<?php }?>><a href="<?php echo $_smarty_tpl->tpl_vars['vir_path']->value;?>
search/text/">Text</a></li>
				</ul>
			</li>
		</ul><!-- #search .tabs .right -->
	</div>
</div><!-- #search .head --><?php }} ?>