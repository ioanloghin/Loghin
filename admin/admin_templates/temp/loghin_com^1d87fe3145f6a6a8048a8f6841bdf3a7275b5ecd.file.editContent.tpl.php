<?php /* Smarty version Smarty-3.1.7, created on 2023-02-06 14:35:51
         compiled from "/home/loghin/public_html/admin/templates/editContent.tpl" */ ?>
<?php /*%%SmartyHeaderCode:4758482686391c523a6f515-63415051%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1d87fe3145f6a6a8048a8f6841bdf3a7275b5ecd' => 
    array (
      0 => '/home/loghin/public_html/admin/templates/editContent.tpl',
      1 => 1675694091,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '4758482686391c523a6f515-63415051',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_6391c523aca08',
  'variables' => 
  array (
    'lang' => 0,
    'item2' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_6391c523aca08')) {function content_6391c523aca08($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_lang')) include '/home/loghin/sources/!core/plugins/modifier.lang.php';
?><?php echo $_smarty_tpl->getSubTemplate ('header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>


 <?php  $_smarty_tpl->tpl_vars['item2'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item2']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['lang']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item2']->key => $_smarty_tpl->tpl_vars['item2']->value){
$_smarty_tpl->tpl_vars['item2']->_loop = true;
?>
    <h2>Add page in <?php echo $_smarty_tpl->tpl_vars['item2']->value['language'];?>
</h2>
 
 <?php } ?> 
 
    <form action="" method="post" enctype="multipart/form-data">
        
 
        <h2 style="margin:0px;font-size:12px;">Parent</h2>
       <input class="inputText" type="text" name="item1" style="width:50%;border-radius:3px; margin-bottom:10px;"/>
       
        <h2 style="margin:0px;font-size:12px;">Title</h2>
       <input class="inputText" type="text" name="item2" style="width:50%;border-radius:3px;margin-bottom:10px;"/>
       
        <h2 style="margin:0px;font-size:12px;">Short Title</h2>
       <input class="inputText" type="text" name="item3" style="width:50%;border-radius:3px;margin-bottom:10px;"/>
       
        <h2 style="margin:0px;font-size:12px;">Page Title</h2>
       <input class="inputText" type="text" name="item4" style="width:50%;border-radius:3px;margin-bottom:10px;"/>
       
        <h2 style="margin:0px;font-size:12px;">Content</h2>
        <div class="form-group">
          
          <textarea class="form-control" name="item5" cols="40" rows="10" ></textarea>
        </div>
       
      
       <input class="form-control" type="hidden" name="language_id" value="<?php echo $_smarty_tpl->tpl_vars['item2']->value['language'];?>
" />
       
       <br>
     	<input class="inputSubmit" type="submit" name="submit" value="<?php echo smarty_modifier_lang('submit');?>
" style="margin-bottom:10px;"/>
       <input type="hidden" name="isitem" value="1" />
    </form>


<?php echo $_smarty_tpl->getSubTemplate ('footer.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }} ?>