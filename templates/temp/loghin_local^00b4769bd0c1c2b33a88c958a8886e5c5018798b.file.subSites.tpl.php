<?php /* Smarty version Smarty-3.1.11, created on 2012-09-25 12:35:22
         compiled from "A:\loghin\www\templates\subSites.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1913450617adaa847e4-44008839%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '00b4769bd0c1c2b33a88c958a8886e5c5018798b' => 
    array (
      0 => 'A:\\loghin\\www\\templates\\subSites.tpl',
      1 => 1316682261,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1913450617adaa847e4-44008839',
  'function' => 
  array (
  ),
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
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_50617adaaf2e72_60944198',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_50617adaaf2e72_60944198')) {function content_50617adaaf2e72_60944198($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_lang')) include 'A:/loghin/CORE/plugins/modifier.lang.php';
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