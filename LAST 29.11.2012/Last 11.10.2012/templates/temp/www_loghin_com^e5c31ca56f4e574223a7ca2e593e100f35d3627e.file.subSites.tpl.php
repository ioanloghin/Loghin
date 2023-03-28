<?php /* Smarty version Smarty-3.1.7, created on 2012-09-26 10:12:35
         compiled from "/home/loghin/public_html/templates/subSites.tpl" */ ?>
<?php /*%%SmartyHeaderCode:12484899454e7b7d6a14d637-25605199%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e5c31ca56f4e574223a7ca2e593e100f35d3627e' => 
    array (
      0 => '/home/loghin/public_html/templates/subSites.tpl',
      1 => 1348573267,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '12484899454e7b7d6a14d637-25605199',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_4fa656ac67ba5',
  'variables' => 
  array (
    'hideContent' => 0,
    'msgBody' => 0,
    'siteName' => 0,
    'sites' => 0,
    '_data' => 0,
    'vir_pic_path' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4fa656ac67ba5')) {function content_4fa656ac67ba5($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_lang')) include '/home/loghin/sources/!core/plugins/modifier.lang.php';
?><?php if ($_smarty_tpl->tpl_vars['hideContent']->value==1){?><div class="msg error"><?php echo $_smarty_tpl->tpl_vars['msgBody']->value;?>
</div><?php }else{ ?><div id="subcats"><div class="cnt"><h2><?php echo $_smarty_tpl->tpl_vars['siteName']->value;?>
 <?php echo smarty_modifier_lang('sub-sites');?>
</h2><div class="items clear"><?php  $_smarty_tpl->tpl_vars['_data'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['_data']->_loop = false;
 $_smarty_tpl->tpl_vars['_id'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['sites']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['_data']->key => $_smarty_tpl->tpl_vars['_data']->value){
$_smarty_tpl->tpl_vars['_data']->_loop = true;
 $_smarty_tpl->tpl_vars['_id']->value = $_smarty_tpl->tpl_vars['_data']->key;
?><a href="<?php echo $_smarty_tpl->tpl_vars['_data']->value['url'];?>
" target="_blank"><img src="<?php echo $_smarty_tpl->tpl_vars['vir_pic_path']->value;?>
www/sites/<?php if ($_smarty_tpl->tpl_vars['_data']->value['image']){?><?php echo $_smarty_tpl->tpl_vars['_data']->value['image'];?>
<?php }else{ ?>default.png<?php }?>" alt="<?php echo $_smarty_tpl->tpl_vars['_data']->value['details'];?>
" /><br /><?php echo $_smarty_tpl->tpl_vars['_data']->value['name'];?>
</a><?php } ?></div></div><div class="info arial"></div></div><?php }?><?php }} ?>