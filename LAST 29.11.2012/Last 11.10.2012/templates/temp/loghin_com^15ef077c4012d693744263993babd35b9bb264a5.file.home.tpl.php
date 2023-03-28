<?php /* Smarty version Smarty-3.1.7, created on 2012-09-18 03:58:03
         compiled from "/home/loghin/public_html/templates/home.tpl" */ ?>
<?php /*%%SmartyHeaderCode:20074797914e7b050e2f12e3-18071199%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '15ef077c4012d693744263993babd35b9bb264a5' => 
    array (
      0 => '/home/loghin/public_html/templates/home.tpl',
      1 => 1347958655,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '20074797914e7b050e2f12e3-18071199',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_4fa3931a69ced',
  'variables' => 
  array (
    'app_page' => 0,
    'app_title' => 0,
    'memberTypes' => 0,
    'item' => 0,
    '_item' => 0,
    'sites' => 0,
    'vir_pic_path' => 0,
    'siteData' => 0,
    'site_id' => 0,
    'favorites' => 0,
    '_fav' => 0,
    '_id' => 0,
    'vir_path' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4fa3931a69ced')) {function content_4fa3931a69ced($_smarty_tpl) {?><?php if (!is_callable('smarty_function_stylesheets')) include '/home/loghin/sources/!core/plugins/function.stylesheets.php';
if (!is_callable('smarty_modifier_lang')) include '/home/loghin/sources/!core/plugins/modifier.lang.php';
if (!is_callable('smarty_function_scripts')) include '/home/loghin/sources/!core/plugins/function.scripts.php';
?><!DOCTYPE HTML><html><head><meta charset="utf-8"><title><?php if (!empty($_smarty_tpl->tpl_vars['app_page']->value)){?><?php echo $_smarty_tpl->tpl_vars['app_page']->value;?>
 - <?php }?><?php echo $_smarty_tpl->tpl_vars['app_title']->value;?>
</title><?php echo smarty_function_stylesheets(array(),$_smarty_tpl);?>
</head><body><div id="header"><div class="width clear"><div class="left"><a href="#">Login In</a> |&nbsp;<select class="inputCombo" name="websites"><option value="">Loghin WebSites</option><option value="">Generale:</option><option value=""> &nbsp; &nbsp; .com</option><option value=""> &nbsp; &nbsp; .biz</option><option value=""> &nbsp; &nbsp; etc.</option><option value="">Nationale:</option><option value=""> &nbsp; &nbsp; .ro</option><option value=""> &nbsp; &nbsp; .it</option><option value=""> &nbsp; &nbsp; .md</option><option value=""> &nbsp; &nbsp; etc.</option><option value="">etc.</option></select> |&nbsp;<select class="inputCombo" name="memberType"><option value="">All Users</option><?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['memberTypes']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
?><option value="<?php echo $_smarty_tpl->tpl_vars['item']->key;?>
"><?php echo $_smarty_tpl->tpl_vars['item']->value['name'];?>
</option><?php  $_smarty_tpl->tpl_vars['_item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['_item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['item']->value['items']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['_item']->key => $_smarty_tpl->tpl_vars['_item']->value){
$_smarty_tpl->tpl_vars['_item']->_loop = true;
?><option value="<?php echo $_smarty_tpl->tpl_vars['_item']->key;?>
"> &nbsp; &nbsp; <?php echo $_smarty_tpl->tpl_vars['_item']->value;?>
</option><?php } ?><?php } ?></select></div><div class="right"><select class="inputCombo" name="country"><option value="">Country</option></select>&nbsp;|&nbsp;<select class="inputCombo" name="language"><option value="">Language</option></select></div><div class="middle clear"><a id="customize" href="javascript:void(0);" title="Customize Page"><strong>Customize Page</strong></a><div id="custBlock" class="hide"><div class="cnt clear"><div class="left"><h2>Sites</h2><div class="custItems"><ul class="clear-li"><?php if (!empty($_smarty_tpl->tpl_vars['sites']->value['site'])){?><?php  $_smarty_tpl->tpl_vars['siteData'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['siteData']->_loop = false;
 $_smarty_tpl->tpl_vars['site_id'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['sites']->value['site']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['siteData']->key => $_smarty_tpl->tpl_vars['siteData']->value){
$_smarty_tpl->tpl_vars['siteData']->_loop = true;
 $_smarty_tpl->tpl_vars['site_id']->value = $_smarty_tpl->tpl_vars['siteData']->key;
?><li><div class="left"><img src="<?php echo $_smarty_tpl->tpl_vars['vir_pic_path']->value;?>
www/sites/<?php if ($_smarty_tpl->tpl_vars['siteData']->value['image']){?><?php echo $_smarty_tpl->tpl_vars['siteData']->value['image'];?>
<?php }else{ ?>default.png<?php }?>" alt="" /></div><div class="right clear"><h3><?php echo $_smarty_tpl->tpl_vars['siteData']->value['name'];?>
</h3><input class="inputCheckbox" type="checkbox" name="items[]" value="<?php echo $_smarty_tpl->tpl_vars['site_id']->value;?>
"<?php if (array_key_exists($_smarty_tpl->tpl_vars['site_id']->value,$_smarty_tpl->tpl_vars['favorites']->value['site'])){?> checked="checked"<?php }elseif(count($_smarty_tpl->tpl_vars['favorites']->value['site'])==6){?> disabled="disabled"<?php }?> /><div class="cfix"></div><p class="arial"><?php echo $_smarty_tpl->tpl_vars['siteData']->value['details'];?>
</p></div></li><?php } ?><?php }?></ul></div></div><div class="right"><h2>Applications</h2><div class="custItems"><ul class="clear-li"><?php if (!empty($_smarty_tpl->tpl_vars['sites']->value['application'])){?><?php  $_smarty_tpl->tpl_vars['siteData'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['siteData']->_loop = false;
 $_smarty_tpl->tpl_vars['site_id'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['sites']->value['application']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['siteData']->key => $_smarty_tpl->tpl_vars['siteData']->value){
$_smarty_tpl->tpl_vars['siteData']->_loop = true;
 $_smarty_tpl->tpl_vars['site_id']->value = $_smarty_tpl->tpl_vars['siteData']->key;
?><li><div class="left"><img src="<?php echo $_smarty_tpl->tpl_vars['vir_pic_path']->value;?>
www/sites/<?php if ($_smarty_tpl->tpl_vars['siteData']->value['image']){?><?php echo $_smarty_tpl->tpl_vars['siteData']->value['image'];?>
<?php }else{ ?>default.png<?php }?>" alt="" /></div><div class="right clear"><h3><?php echo $_smarty_tpl->tpl_vars['siteData']->value['name'];?>
</h3><input class="inputCheckbox" type="checkbox" name="items[]" value="<?php echo $_smarty_tpl->tpl_vars['site_id']->value;?>
"<?php if (array_key_exists($_smarty_tpl->tpl_vars['site_id']->value,$_smarty_tpl->tpl_vars['favorites']->value['application'])){?> checked="checked"<?php }elseif(count($_smarty_tpl->tpl_vars['favorites']->value['application'])==6){?> disabled="disabled"<?php }?> /><div class="cfix"></div><p class="arial"><?php echo $_smarty_tpl->tpl_vars['siteData']->value['details'];?>
</p></div></li><?php } ?><?php }?></ul></div></div></div><div class="info arial<?php if ($_smarty_tpl->tpl_vars['_fav']->value&&(count($_smarty_tpl->tpl_vars['favorites']->value['site'])<6||count($_smarty_tpl->tpl_vars['favorites']->value['application'])<6)){?> error"><?php echo smarty_modifier_lang('customize_error');?>
<?php }else{ ?>"><?php echo smarty_modifier_lang('customize_info');?>
<?php }?></div></div><a class="arrow right" href="javascript:void(0);">&darr;</a><div id="layouts" class="hide"><dl class="clear"><dt><label><input type="checkbox" name="" value="" />Layout 1</label></dt><dd>Lorem Ipsum dolor sit amet</dd></dl><dl class="clear"><dt><label><input type="checkbox" name="" value="" />Layout 2</label></dt><dd>Lorem Ipsum dolor sit amet</dd></dl><dl class="clear"><dt><label><input type="checkbox" name="" value="" />Layout 3</label></dt><dd>Lorem Ipsum dolor sit amet</dd></dl><dl class="clear"><dt><label><input type="checkbox" name="" value="" />Layout 4</label></dt><dd>Lorem Ipsum dolor sit amet</dd></dl><dl class="clear"><dt><label><input type="checkbox" name="" value="" />Layout 5</label></dt><dd>Lorem Ipsum dolor sit amet</dd></dl><div class="buttons clear"><a class="button red right" href="javascript:void(0);"><span>Delete</span></a><a class="button green right" href="javascript:void(0);"><span>Modify</span></a></div></div></div>
				
           </div>
        </div>
		

		
		<div class="eyes" id="body">
			<div class="width clear">
				<ul class="left sites clear-li">
					<?php  $_smarty_tpl->tpl_vars['_var'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['_var']->_loop = false;
 $_smarty_tpl->tpl_vars['_id'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['favorites']->value['site']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['_var']->index=-1;
foreach ($_from as $_smarty_tpl->tpl_vars['_var']->key => $_smarty_tpl->tpl_vars['_var']->value){
$_smarty_tpl->tpl_vars['_var']->_loop = true;
 $_smarty_tpl->tpl_vars['_id']->value = $_smarty_tpl->tpl_vars['_var']->key;
 $_smarty_tpl->tpl_vars['_var']->index++;
 $_smarty_tpl->tpl_vars['_var']->first = $_smarty_tpl->tpl_vars['_var']->index === 0;
?>
					<li<?php if ($_smarty_tpl->tpl_vars['_var']->first||$_smarty_tpl->tpl_vars['_var']->index==5){?> class="first"<?php }elseif($_smarty_tpl->tpl_vars['_var']->index==1||$_smarty_tpl->tpl_vars['_var']->index==4){?> class="second"<?php }?> id="site<?php echo $_smarty_tpl->tpl_vars['_id']->value;?>
">
						<div class="icon"><a href="javascript:void(0);"><img src="<?php echo $_smarty_tpl->tpl_vars['vir_pic_path']->value;?>
www/sites/<?php echo $_smarty_tpl->tpl_vars['sites']->value['site'][$_smarty_tpl->tpl_vars['_id']->value]['image'];?>
" alt="<?php echo $_smarty_tpl->tpl_vars['sites']->value['site'][$_smarty_tpl->tpl_vars['_id']->value]['name'];?>
" /></a></div>
						<h2>
							<a href="<?php echo $_smarty_tpl->tpl_vars['sites']->value['site'][$_smarty_tpl->tpl_vars['_id']->value]['url'];?>
"><?php echo $_smarty_tpl->tpl_vars['sites']->value['site'][$_smarty_tpl->tpl_vars['_id']->value]['name'];?>
</a>
							<input type="hidden" name="searchIn[]" value="<?php echo $_smarty_tpl->tpl_vars['_id']->value;?>
" />
						</h2>
					</li>
					<?php } ?>
					<?php if (!$_smarty_tpl->tpl_vars['_fav']->value){?><li class="first">
						<div class="icon"><a href="javascript:void(0);"><img src="<?php echo $_smarty_tpl->tpl_vars['vir_pic_path']->value;?>
www/sites/default.png" alt="" /></a></div>
						<h2><a href="javascript:void(0);"><?php echo smarty_modifier_lang('select_more');?>
</a></h2>
					</li><?php }?>
				</ul>
				<ul class="right applications clear-li">
					<?php  $_smarty_tpl->tpl_vars['_var'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['_var']->_loop = false;
 $_smarty_tpl->tpl_vars['_id'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['favorites']->value['application']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['_var']->index=-1;
foreach ($_from as $_smarty_tpl->tpl_vars['_var']->key => $_smarty_tpl->tpl_vars['_var']->value){
$_smarty_tpl->tpl_vars['_var']->_loop = true;
 $_smarty_tpl->tpl_vars['_id']->value = $_smarty_tpl->tpl_vars['_var']->key;
 $_smarty_tpl->tpl_vars['_var']->index++;
 $_smarty_tpl->tpl_vars['_var']->first = $_smarty_tpl->tpl_vars['_var']->index === 0;
?>
					<li<?php if ($_smarty_tpl->tpl_vars['_var']->first||$_smarty_tpl->tpl_vars['_var']->index==5){?> class="first"<?php }elseif($_smarty_tpl->tpl_vars['_var']->index==1||$_smarty_tpl->tpl_vars['_var']->index==4){?> class="second"<?php }?> id="site<?php echo $_smarty_tpl->tpl_vars['_id']->value;?>
">
						<div class="icon"><a href="javascript:void(0);"><img src="<?php echo $_smarty_tpl->tpl_vars['vir_pic_path']->value;?>
www/sites/<?php echo $_smarty_tpl->tpl_vars['sites']->value['application'][$_smarty_tpl->tpl_vars['_id']->value]['image'];?>
" alt="<?php echo $_smarty_tpl->tpl_vars['sites']->value['application'][$_smarty_tpl->tpl_vars['_id']->value]['name'];?>
" /></a></div>
						<h2>
							<a href="<?php echo $_smarty_tpl->tpl_vars['sites']->value['application'][$_smarty_tpl->tpl_vars['_id']->value]['url'];?>
"><?php echo $_smarty_tpl->tpl_vars['sites']->value['application'][$_smarty_tpl->tpl_vars['_id']->value]['name'];?>
</a>
							<input type="hidden" name="searchIn[]" value="<?php echo $_smarty_tpl->tpl_vars['_id']->value;?>
" />
						</h2>
					</li>
					<?php } ?>
					<?php if (!$_smarty_tpl->tpl_vars['_fav']->value){?><li class="first">
						<div class="icon"><a href="javascript:void(0);"><img src="<?php echo $_smarty_tpl->tpl_vars['vir_pic_path']->value;?>
www/sites/default.png" alt="" /></a></div>
						<h2><a href="javascript:void(0);"><?php echo smarty_modifier_lang('select_more');?>
</a></h2>
					</li><?php }?>
				</ul>
				<div class="info"><a href="#"><span>all</span><br />System</a></div>
				<h1 class="logo">Loghin.com</h1>
				<div class="else"><a href="http://loghout.com/"><span>VS</span><br />Loghout</a></div>
			</div>
		</div>
		

		
		<div id="content">
			
			<a class="scrollArrow top" href="javascript:void(0);"></a>
			
			<div class="width">
				
				<div class="searchBox">
				<form action="" method="post">
					<div class="searchInput left">
						<div class="_left"></div>
						<input class="inputText" type="text" name="search" value="" />
						<div class="_right"></div>
					</div>
					<a class="inputSearch left" href="javascript:void(0);" rel="submit"><strong>Search<i></i></strong></a>
					<div class="cfix"></div>
				</form>
				</div>
				

				
				<ul class="resultsCats width clear"></ul>
				<div class="width hide" id="results">
					<div class="_left"><a href="javascript:void(0);" rel="-">&laquo;</a></div>
					<div class="content width">
						<div class="space">
							<div class="clear">
								<ul class="clear">
									<li>
										<div class="image"><img src="<?php echo $_smarty_tpl->tpl_vars['vir_pic_path']->value;?>
www/reveal_pic.jpg" alt="" /></div>
										<h2>Cars 1</h2>
										<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
									</li>
									<li>
										<div class="image"><img src="<?php echo $_smarty_tpl->tpl_vars['vir_pic_path']->value;?>
www/reveal_pic.jpg" alt="" /></div>
										<h2>Cars 2</h2>
										<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
									</li>
									<li>
										<div class="image"><img src="<?php echo $_smarty_tpl->tpl_vars['vir_pic_path']->value;?>
www/reveal_pic.jpg" alt="" /></div>
										<h2>Cars 3</h2>
										<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
									</li>
									<li>
										<div class="image"><img src="<?php echo $_smarty_tpl->tpl_vars['vir_pic_path']->value;?>
www/reveal_pic.jpg" alt="" /></div>
										<h2>Cars 4</h2>
										<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
									</li>
									<li>
										<div class="image"><img src="<?php echo $_smarty_tpl->tpl_vars['vir_pic_path']->value;?>
www/reveal_pic.jpg" alt="" /></div>
										<h2>Cars 5</h2>
										<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
									</li>
									<li>
										<div class="image"><img src="<?php echo $_smarty_tpl->tpl_vars['vir_pic_path']->value;?>
www/reveal_pic.jpg" alt="" /></div>
										<h2>Cars 6</h2>
										<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
									</li>
									<li>
										<div class="image"><img src="<?php echo $_smarty_tpl->tpl_vars['vir_pic_path']->value;?>
www/reveal_pic.jpg" alt="" /></div>
										<h2>Cars 7</h2>
										<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
									</li>
									<li>
										<div class="image"><img src="<?php echo $_smarty_tpl->tpl_vars['vir_pic_path']->value;?>
www/reveal_pic.jpg" alt="" /></div>
										<h2>Cars 8</h2>
										<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
									</li>
									<li>
										<div class="image"><img src="<?php echo $_smarty_tpl->tpl_vars['vir_pic_path']->value;?>
www/reveal_pic.jpg" alt="" /></div>
										<h2>Cars 9</h2>
										<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
									</li>
								</ul>
							</div>
						</div>
					</div>
					<div class="_right"><a href="javascript:void(0);" rel="+">&raquo;</a></div>
				</div>
				

				
				<div id="suggest" class="hide">
					<div class="head clear">
						<div class="_left"><a href="javascript:void(0);" rel="-">&laquo;</a></div>
						<div class="nav">
							<div>
								<div>
									<ul>
										<li class="first"><a href="#">Arhitectura</a></li>
										<li><a href="#">Constructii</a></li>
										<li><a href="#">Industrie</a></li>
										<li class="last"><a href="#">Navala</a></li>
									</ul>
								</div>
							</div>
						</div>
						<div class="_right"><a href="javascript:void(0);" rel="+">&raquo;</a></div>
					</div>
					<div class="body">
						<div class="bodySilver"></div>
						<div class="cnt clear">
							
							<div class="left">
								<ul class="top clear">
									<li>
										<label><input type="checkbox" name="" value="" /></label>
										<a class="button green left" href="javascript:void(0);"><span>Add</span></a>
										<p>
											<a href="#">data</a> |
											<a href="#">type</a>|
											<a href="#">title</a>
										</p>
										<h3>Sugestions</h3>
									</li>
								</ul>
								
								<div class="clear itemsOverflow">
									<div class="overflow">
										<ul>
											<li class="clear">
												<label><input type="checkbox" name="" value="" /></label>
												<div class="logo"><img src="uploads/suggest_logo.png" alt="" /></div>
												<div class="details">
													<div class="clear">
														<h3>Assasins Creed 2</h3>
														<span>10.07.2011</span>
													</div>
													<p>Nulla sit amet purus et mi commodo pulvinar vel eu quam...</p>
												</div>
											</li>
											<li>
												<label><input type="checkbox" name="" value="" /></label>
												<div class="logo"><img src="uploads/suggest_logo.png" alt="" /></div>
												<div class="details">
													<div class="clear">
														<h3>Assasins Creed 2</h3>
														<span>10.07.2011</span>
													</div>
													<p>Nulla sit amet purus et mi commodo pulvinar vel eu quam...</p>
												</div>
											</li>
											<li>
												<label><input type="checkbox" name="" value="" /></label>
												<div class="logo"><img src="uploads/suggest_logo.png" alt="" /></div>
												<div class="details">
													<div class="clear">
														<h3>Assasins Creed 2</h3>
														<span>10.07.2011</span>
													</div>
													<p>Nulla sit amet purus et mi commodo pulvinar vel eu quam...</p>
												</div>
											</li>
											<li>
												<label><input type="checkbox" name="" value="" /></label>
												<div class="logo"><img src="uploads/suggest_logo.png" alt="" /></div>
												<div class="details">
													<div class="clear">
														<h3>Assasins Creed 2</h3>
														<span>10.07.2011</span>
													</div>
													<p>Nulla sit amet purus et mi commodo pulvinar vel eu quam...</p>
												</div>
											</li>
											<li>
												<label><input type="checkbox" name="" value="" /></label>
												<div class="logo"><img src="uploads/suggest_logo.png" alt="" /></div>
												<div class="details">
													<div class="clear">
														<h3>Assasins Creed 2</h3>
														<span>10.07.2011</span>
													</div>
													<p>Nulla sit amet purus et mi commodo pulvinar vel eu quam...</p>
												</div>
											</li>
											<li>
												<label><input type="checkbox" name="" value="" /></label>
												<div class="logo"><img src="uploads/suggest_logo.png" alt="" /></div>
												<div class="details">
													<div class="clear">
														<h3>Assasins Creed 2</h3>
														<span>10.07.2011</span>
													</div>
													<p>Nulla sit amet purus et mi commodo pulvinar vel eu quam...</p>
												</div>
											</li>
											<li>
												<label><input type="checkbox" name="" value="" /></label>
												<div class="logo"><img src="uploads/suggest_logo.png" alt="" /></div>
												<div class="details">
													<div class="clear">
														<h3>Assasins Creed 2</h3>
														<span>10.07.2011</span>
													</div>
													<p>Nulla sit amet purus et mi commodo pulvinar vel eu quam...</p>
												</div>
											</li>
										</ul>
									</div>
								</div>
								
								<div class="bottomSpace"></div>
							</div>
							

							
							<div class="right">
								<div class="overlay"></div>
								<div class="optionsB">
									<div class="headB line clear">
										<label class="left">Setting:</label>
										<a class="button red right bold" href="javascript:void(0);"><span>X</span></a>
										<h3>Preferences</h3>
									</div>
									<div class="formFields line">
										<p>Seleziona le schede delle notizie da visualizzare:</p>
										<div class="clear">
											<div class="formLabel">
												<label for="visualTime">Visual Time:</label>
											</div>
											<div class="formField">
												<select class="inputCombo" id="visualTime" name="">
													<option value="">Days</option>
												</select>
											</div>
										</div>

										<div class="clear">
											<div class="formLabel">
												<label for="totalHits">Total Hits:</label>
											</div>
											<div class="formField">
												<select class="inputCombo" id="totalHits" name="">
													<option value="">Number</option>
												</select>
											</div>
										</div>

										<div class="clear">
											<div class="formLabel">
												<label for="visual">Visual:</label>
											</div>
											<div class="formField">
												<select class="inputCombo" id="visual" name="">
													<option value="">Type:</option>
												</select>
											</div>
										</div>
									</div>

									<div class="formFields line">
										<p>Processing System:</p>
										<div class="clear">
											<div class="formLabel">
												<label for="modul1Activation">Modul 1 Activation</label>
											</div>
											<div class="formField">
												<input class="inputCheckbox" id="modul1Activation" type="checkbox" name="" value="1" />
											</div>
										</div>

										<div class="clear">
											<div class="formLabel">
												<label for="modul2Activation">Modul 2 Activation</label>
											</div>
											<div class="formField">
												<input class="inputCheckbox" id="modul2Activation" type="checkbox" name="" value="1" />
											</div>
										</div>

										<div class="clear">
											<div class="formLabel">
												<label for="archive">Arhive:</label>
											</div>
											<div class="formField">
												<select class="inputCombo" id="archive" name="">
													<option value="">Select</option>
												</select>
											</div>
										</div>

										<div class="clear">
											<div class="formLabel">
												<label for="newsletter">Newsletter</label>
											</div>
											<div class="formField">
												<input class="inputCheckbox" id="newsletter" type="checkbox" name="" value="1" />
											</div>
										</div>
									</div>

									<div class="formFields line">
										<p>Form options:</p>
										<div class="clear">
											<div class="formOptions">
												<label><input type="checkbox" name="" value="1"> Link Button</label>
												<label><input type="checkbox" name="" value="1"> Link Button</label>
												<label><input type="checkbox" name="" value="1"> Link Button</label>
												<label><input type="checkbox" name="" value="1"> Link Button</label>
												<label><input type="checkbox" name="" value="1"> Link Button</label>
												<label><input type="checkbox" name="" value="1"> Link Button</label>
												<label><input type="checkbox" name="" value="1"> Link Button</label>
												<label><input type="checkbox" name="" value="1"> Link Button</label>
											</div>
										</div>
									</div>

									<div class="formFields">
										<div class="clear">
											<div class="formButton"><a class="button green bold" href="javascript:void(0);" rel="submit"><span>Save</span></a></div>
										</div>
									</div>
								</div>

								<ul class="top clear">
									<li>
										<label><input type="checkbox" name="" value="" /></label>
										<a class="button red left" href="javascript:void(0);"><span>Delete</span></a>
										<p>
											<a href="#">data</a> |
											<a href="#">type</a>|
											<a href="#">title</a>
										</p>
										<h3>Preferences</h3>
									</li>
								</ul>
								
								<div class="clear itemsOverflow">
									<div class="overflow">
										<ul>
											<li class="clear">
												<label><input type="checkbox" name="" value="" /></label>
												<div class="logo"><img src="uploads/suggest_logo.png" alt="" /></div>
												<div class="details">
													<div class="clear">
														<h3>Assasins Creed 2</h3>
														<span>10.07.2011</span>
													</div>
													<p>Nulla sit amet purus et mi commodo pulvinar vel eu quam...</p>
												</div>
											</li>
										</ul>
									</div>
								</div>
								
								<div class="bottomSpace"></div>
							</div>
							
							<div class="bottomOptions clear left">
								<a class="options" href="#">Select suggestion option</a>
								<a class="more" href="#">more...</a>
							</div>
							<div class="bottomOptions clear right">
								<a class="options" href="#">Select suggestion option</a>
								<a class="more" href="#">more...</a>
							</div>
							<div class="line"><div></div></div>
						</div>
					</div>

					
					<div class="footer clear">
						<p>
							<a href="#">Link Button</a> |
							<a href="#">Link Button</a> |
							<a href="#">Link Button</a> |
							<a href="#">Link Button</a> |
							<a href="#">Link Button</a> |
							<a href="#">Link Button</a> |
							<a href="#">Link Button</a> |
							<a href="#">Link Button</a>
						</p>
						<a href="javascript:void(0);" rel="OpenClose">Close</a>
					</div>
					
				</div>
				
			</div>
		</div>
		

		
		<div id="footer">
			<div class="width">
				<p class="left">
					<a href="#">Marketing / Advertise</a> &bull;
					<a href="#">Terms of service</a> &bull;
					<a href="#">Privacy</a> &bull;
					<a href="#">You opinion</a> &bull;
					<a href="#">Work with us</a>
				</p>
        		<p class="right">Copyright &copy; 2009 - 2011 Loghin. All rights reserved.</div> 
			</div>
		</div>
		

		<?php echo smarty_function_scripts(array(),$_smarty_tpl);?>

		<script type="text/javascript">
			$.conf = { 'path': "<?php echo $_smarty_tpl->tpl_vars['vir_path']->value;?>
", 'pic_path': "<?php echo $_smarty_tpl->tpl_vars['vir_pic_path']->value;?>
www/" };
		</script>
    </body>
</html><?php }} ?>