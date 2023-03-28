<?php /* Smarty version Smarty-3.1.7, created on 2012-05-22 12:53:33
         compiled from "A:\loghin\www\system\templates\center\plugins\search-head.tpl" */ ?>
<?php /*%%SmartyHeaderCode:46744fbb39533c9837-49652727%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4ed8ebefb82439c896c6c819e75608608f44e09c' => 
    array (
      0 => 'A:\\loghin\\www\\system\\templates\\center\\plugins\\search-head.tpl',
      1 => 1337680413,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '46744fbb39533c9837-49652727',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_4fbb39533f53e',
  'variables' => 
  array (
    'activeAction' => 0,
    'vir_path' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4fbb39533f53e')) {function content_4fbb39533f53e($_smarty_tpl) {?><div class="head">
	<div class="navigation clear">
		<h3 class="left">Results 1 - 25 of 2,500 Items</h3>
		<ul class="control right clear">
			<li><a class="back" href="#">Back<i></i></a></li>
			<li><a class="prev" href="#"><span>Preview</span></a></li>
			<li class="last"><a class="next" href="#"><span>Next</span></a></li>
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