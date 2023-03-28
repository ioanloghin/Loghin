<?php /* Smarty version Smarty-3.1.7, created on 2012-05-22 13:13:48
         compiled from "A:\loghin\www\system\templates\center\search\plugins\head.tpl" */ ?>
<?php /*%%SmartyHeaderCode:280524fbb648b968ae6-52720089%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a823b59d435b8155d20adbf1fb8e7c0ad9e3a693' => 
    array (
      0 => 'A:\\loghin\\www\\system\\templates\\center\\search\\plugins\\head.tpl',
      1 => 1337681627,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '280524fbb648b968ae6-52720089',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_4fbb648b99780',
  'variables' => 
  array (
    'activeAction' => 0,
    'vir_path' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4fbb648b99780')) {function content_4fbb648b99780($_smarty_tpl) {?><div id="search" class="head">
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