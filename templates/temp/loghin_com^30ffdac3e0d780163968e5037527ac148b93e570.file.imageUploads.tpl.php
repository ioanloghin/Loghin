<?php /* Smarty version Smarty-3.1.7, created on 2023-03-23 11:34:34
         compiled from "/home/loghin/public_html/templates/imageUploads.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1549446905641c37cef0ca59-35247701%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '30ffdac3e0d780163968e5037527ac148b93e570' => 
    array (
      0 => '/home/loghin/public_html/templates/imageUploads.tpl',
      1 => 1679571272,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1549446905641c37cef0ca59-35247701',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_641c37cf04c46',
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_641c37cf04c46')) {function content_641c37cf04c46($_smarty_tpl) {?><?php if (!is_callable('smarty_function_stylesheets')) include '/home/loghin/sources/!core/plugins/function.stylesheets.php';
if (!is_callable('smarty_function_scripts')) include '/home/loghin/sources/!core/plugins/function.scripts.php';
?><!DOCTYPE HTML>
<html>
    <head><meta charset="utf-8" /><title></title><meta name="description" content="" /><meta name="keywords" content="" /><?php echo smarty_function_stylesheets(array(),$_smarty_tpl);?>
<?php echo smarty_function_scripts(array(),$_smarty_tpl);?>

   
   
    </head>
    <style>

body{
    margin-left: 365px;
    font-family: Verdana, Geneva, sans-serif;
    background-image: url(results_cats_bg.png)

}  

input[type=text], select, textarea {
  width: 50%;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
  margin-top: 6px;
  margin-bottom: 16px;
}

input[type=submit] {

  background-color: #45a049;
  color: white;
  padding: 12px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
   margin-left:258px;

}

input[type=submit]:hover {
  background-color: #04AA6D;
    
}


.main{
    background-image: url(templates/media/loghin/results_cats_bg.png);
    font-weight: 600;
    color: #ffffff;
    font-size:13px;
    border-radius: 5px;
    display: inline-block;
    width:120px;
    padding-left:30px;
    padding-right:7px;
    padding-top:7px;
    padding-bottom:7px;


}
#addData{
    background-image: url(templates/media/loghin/footer_bg.jpg);
    margin-top:100px;
    font-size:20px;
    color: #ffffff;
    border-radius: 5px;
    display: inline-block;
    padding-left:205px;
    padding-top:7px;
    padding-right:205px;
    padding-bottom:7px;

}

#discription{
   height:150px;
  

}
</style>
<center>
    <body>
	

<span id="addData"> Add Data </span>

  <form action="#" method="post" enctype='multipart/form-data' >
    <br><br>
    <label for="" class="main">Title</label>
    <br><br>
    <input type="text" id="title" name="title" placeholder="Add Title..">
    <br><br>
 <label for="" class="main">Add Url</label>
    <br><br>
  <input type="text" id="url" name="url" placeholder="Add Url..">
<br><br>

 <label for="" class="main">Image Upload</label>
    <br><br>
 <input type="file" name="image" >
 
 <br><br>
    <input type="submit" value="Submit" name="submit">
    
  </form>

    </body>
    </center>
</html><?php }} ?>