<?php /* Smarty version Smarty-3.0.8, created on 2011-09-14 08:32:44
         compiled from "A:/loghin/www/templates/home.tpl" */ ?>
<?php /*%%SmartyHeaderCode:59414e703c7c3b1ac2-23252152%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '71e2ce9f72ed41364bafe4868a9aff037df1824c' => 
    array (
      0 => 'A:/loghin/www/templates/home.tpl',
      1 => 1315908366,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '59414e703c7c3b1ac2-23252152',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_function_stylesheets')) include 'A:/loghin/CORE/plugins\function.stylesheets.php';
if (!is_callable('smarty_modifier_lang')) include 'A:/loghin/CORE/plugins\modifier.lang.php';
?><!DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8">
        <title><?php if (!empty($_smarty_tpl->getVariable('app_page',null,true,false)->value)){?><?php echo $_smarty_tpl->getVariable('app_page')->value;?>
 - <?php }?><?php echo $_smarty_tpl->getVariable('app_title')->value;?>
</title>
<?php echo smarty_function_stylesheets(array(),$_smarty_tpl);?>

    </head>
    
    <body>
    	<div id="header">
        	<div class="width clear">
            	<div class="left">
                	<a href="#">Login In</a> &nbsp;|&nbsp;
                    <a href="#">Loghin WebSites</a>
				</div>
				<div class="right">
					<select class="inputCombo" name="country">
						<option value="">Country</option>
					</select>
					&nbsp;|&nbsp;
					<select class="inputCombo" name="language">
						<option value="">Language</option>
					</select>
				</div>
           </div>
        </div>
		<div class="eyes" id="body">
			<div class="width clear">
				<ul class="left sites clear-li">
					<?php  $_smarty_tpl->tpl_vars['_var'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['_id'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('favorites')->value['site']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['_var']->index=-1;
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['_var']->key => $_smarty_tpl->tpl_vars['_var']->value){
 $_smarty_tpl->tpl_vars['_id']->value = $_smarty_tpl->tpl_vars['_var']->key;
 $_smarty_tpl->tpl_vars['_var']->index++;
 $_smarty_tpl->tpl_vars['_var']->first = $_smarty_tpl->tpl_vars['_var']->index === 0;
?>
					<li<?php if ($_smarty_tpl->tpl_vars['_var']->first||$_smarty_tpl->tpl_vars['_var']->index==5){?> class="first"<?php }elseif($_smarty_tpl->tpl_vars['_var']->index==1||$_smarty_tpl->tpl_vars['_var']->index==4){?> class="second"<?php }?> id="site<?php echo $_smarty_tpl->tpl_vars['_id']->value;?>
">
						<div class="icon"><a href="javascript:void(0);"><img src="<?php echo $_smarty_tpl->getVariable('vir_pic_path')->value;?>
www/sites/<?php echo $_smarty_tpl->getVariable('sites')->value['site'][$_smarty_tpl->tpl_vars['_id']->value]['image'];?>
" alt="<?php echo $_smarty_tpl->getVariable('sites')->value['site'][$_smarty_tpl->tpl_vars['_id']->value]['name'];?>
" /></a></div>
						<h2><a href="<?php echo $_smarty_tpl->getVariable('sites')->value['site'][$_smarty_tpl->tpl_vars['_id']->value]['url'];?>
"><?php echo $_smarty_tpl->getVariable('sites')->value['site'][$_smarty_tpl->tpl_vars['_id']->value]['name'];?>
</a></h2>
					</li>
					<?php }} ?>
					<?php if (!$_smarty_tpl->getVariable('_fav')->value){?><li class="first">
						<div class="icon"><a href="javascript:void(0);"><img src="<?php echo $_smarty_tpl->getVariable('vir_pic_path')->value;?>
www/sites/default.png" alt="" /></a></div>
						<h2><a href="javascript:void(0);"><?php echo smarty_modifier_lang('select_more');?>
</a></h2>
					</li><?php }?>
				</ul>
				<ul class="right applications clear-li">
					<?php  $_smarty_tpl->tpl_vars['_var'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['_id'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('favorites')->value['application']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['_var']->index=-1;
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['_var']->key => $_smarty_tpl->tpl_vars['_var']->value){
 $_smarty_tpl->tpl_vars['_id']->value = $_smarty_tpl->tpl_vars['_var']->key;
 $_smarty_tpl->tpl_vars['_var']->index++;
 $_smarty_tpl->tpl_vars['_var']->first = $_smarty_tpl->tpl_vars['_var']->index === 0;
?>
					<li<?php if ($_smarty_tpl->tpl_vars['_var']->first||$_smarty_tpl->tpl_vars['_var']->index==5){?> class="first"<?php }elseif($_smarty_tpl->tpl_vars['_var']->index==1||$_smarty_tpl->tpl_vars['_var']->index==4){?> class="second"<?php }?> id="site<?php echo $_smarty_tpl->tpl_vars['_id']->value;?>
">
						<div class="icon"><a href="javascript:void(0);"><img src="<?php echo $_smarty_tpl->getVariable('vir_pic_path')->value;?>
www/sites/<?php echo $_smarty_tpl->getVariable('sites')->value['application'][$_smarty_tpl->tpl_vars['_id']->value]['image'];?>
" alt="<?php echo $_smarty_tpl->getVariable('sites')->value['application'][$_smarty_tpl->tpl_vars['_id']->value]['name'];?>
" /></a></div>
						<h2><a href="<?php echo $_smarty_tpl->getVariable('sites')->value['application'][$_smarty_tpl->tpl_vars['_id']->value]['url'];?>
"><?php echo $_smarty_tpl->getVariable('sites')->value['application'][$_smarty_tpl->tpl_vars['_id']->value]['name'];?>
</a></h2>
					</li>
					<?php }} ?>
					<?php if (!$_smarty_tpl->getVariable('_fav')->value){?><li class="first">
						<div class="icon"><a href="javascript:void(0);"><img src="<?php echo $_smarty_tpl->getVariable('vir_pic_path')->value;?>
www/sites/default.png" alt="" /></a></div>
						<h2><a href="javascript:void(0);"><?php echo smarty_modifier_lang('select_more');?>
</a></h2>
					</li><?php }?>
				</ul>
				<h1 class="logo">Loghin.com</h1>
				<div class="else"><a href="http://loghout.com/"><span>VS</span><br />Loghout</a></div>
			</div>
		</div>
		<div id="content">
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
										<div class="image"><img src="<?php echo $_smarty_tpl->getVariable('vir_pic_path')->value;?>
www/reveal_pic.jpg" alt="" /></div>
										<h2>Cars 1</h2>
										<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
									</li>
									<li>
										<div class="image"><img src="<?php echo $_smarty_tpl->getVariable('vir_pic_path')->value;?>
www/reveal_pic.jpg" alt="" /></div>
										<h2>Cars 2</h2>
										<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
									</li>
									<li>
										<div class="image"><img src="<?php echo $_smarty_tpl->getVariable('vir_pic_path')->value;?>
www/reveal_pic.jpg" alt="" /></div>
										<h2>Cars 3</h2>
										<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
									</li>
									<li>
										<div class="image"><img src="<?php echo $_smarty_tpl->getVariable('vir_pic_path')->value;?>
www/reveal_pic.jpg" alt="" /></div>
										<h2>Cars 4</h2>
										<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
									</li>
									<li>
										<div class="image"><img src="<?php echo $_smarty_tpl->getVariable('vir_pic_path')->value;?>
www/reveal_pic.jpg" alt="" /></div>
										<h2>Cars 5</h2>
										<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
									</li>
									<li>
										<div class="image"><img src="<?php echo $_smarty_tpl->getVariable('vir_pic_path')->value;?>
www/reveal_pic.jpg" alt="" /></div>
										<h2>Cars 6</h2>
										<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
									</li>
									<li>
										<div class="image"><img src="<?php echo $_smarty_tpl->getVariable('vir_pic_path')->value;?>
www/reveal_pic.jpg" alt="" /></div>
										<h2>Cars 7</h2>
										<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
									</li>
									<li>
										<div class="image"><img src="<?php echo $_smarty_tpl->getVariable('vir_pic_path')->value;?>
www/reveal_pic.jpg" alt="" /></div>
										<h2>Cars 8</h2>
										<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
									</li>
									<li>
										<div class="image"><img src="<?php echo $_smarty_tpl->getVariable('vir_pic_path')->value;?>
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
		<a class="scrollArrow top" href="javascript:void(0);"></a>
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
		<a id="customize" href="javascript:void(0);"><strong>Customize Page</strong></a><div id="custBlock"><div class="cnt clear"><div class="left"><h2>Sites</h2><div class="custItems"><ul class="clear-li"><?php if (!empty($_smarty_tpl->getVariable('sites',null,true,false)->value['site'])){?><?php  $_smarty_tpl->tpl_vars['siteData'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['site_id'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('sites')->value['site']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['siteData']->key => $_smarty_tpl->tpl_vars['siteData']->value){
 $_smarty_tpl->tpl_vars['site_id']->value = $_smarty_tpl->tpl_vars['siteData']->key;
?><li><div class="left"><img src="<?php echo $_smarty_tpl->getVariable('vir_pic_path')->value;?>
www/sites/<?php if ($_smarty_tpl->tpl_vars['siteData']->value['image']){?><?php echo $_smarty_tpl->tpl_vars['siteData']->value['image'];?>
<?php }else{ ?>default.png<?php }?>" alt="" /></div><div class="right clear"><h3><?php echo $_smarty_tpl->tpl_vars['siteData']->value['name'];?>
</h3><input class="inputCheckbox" type="checkbox" name="site[]" value="<?php echo $_smarty_tpl->tpl_vars['site_id']->value;?>
"<?php if (array_key_exists($_smarty_tpl->tpl_vars['site_id']->value,$_smarty_tpl->getVariable('favorites')->value['site'])){?> checked="checked"<?php }elseif(count($_smarty_tpl->getVariable('favorites')->value['site'])==6){?> disabled="disabled"<?php }?> /><div class="cfix"></div><p class="arial"><?php echo $_smarty_tpl->tpl_vars['siteData']->value['details'];?>
</p></div></li><?php }} ?><?php }?></ul></div></div><div class="right"><h2>Applications</h2><div class="custItems"><ul class="clear-li"><?php if (!empty($_smarty_tpl->getVariable('sites',null,true,false)->value['application'])){?><?php  $_smarty_tpl->tpl_vars['siteData'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['site_id'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('sites')->value['application']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['siteData']->key => $_smarty_tpl->tpl_vars['siteData']->value){
 $_smarty_tpl->tpl_vars['site_id']->value = $_smarty_tpl->tpl_vars['siteData']->key;
?><li><div class="left"><img src="<?php echo $_smarty_tpl->getVariable('vir_pic_path')->value;?>
www/sites/<?php if ($_smarty_tpl->tpl_vars['siteData']->value['image']){?><?php echo $_smarty_tpl->tpl_vars['siteData']->value['image'];?>
<?php }else{ ?>default.png<?php }?>" alt="" /></div><div class="right clear"><h3><?php echo $_smarty_tpl->tpl_vars['siteData']->value['name'];?>
</h3><input class="inputCheckbox" type="checkbox" name="application[]" value="<?php echo $_smarty_tpl->tpl_vars['site_id']->value;?>
"<?php if (array_key_exists($_smarty_tpl->tpl_vars['site_id']->value,$_smarty_tpl->getVariable('favorites')->value['application'])){?> checked="checked"<?php }elseif(count($_smarty_tpl->getVariable('favorites')->value['application'])==6){?> disabled="disabled"<?php }?> /><div class="cfix"></div><p class="arial"><?php echo $_smarty_tpl->tpl_vars['siteData']->value['details'];?>
</p></div></li><?php }} ?><?php }?></ul></div></div></div><div class="info arial<?php if ($_smarty_tpl->getVariable('_fav')->value&&(count($_smarty_tpl->getVariable('favorites')->value['site'])<6||count($_smarty_tpl->getVariable('favorites')->value['application'])<6)){?> error"><?php echo smarty_modifier_lang('customize_error');?>
<?php }else{ ?>"><?php echo smarty_modifier_lang('customize_info');?>
<?php }?></div></div>
		<script type="text/javascript" src="/js/jquery.js"></script>
		<script type="text/javascript">
			$.conf = { 'path': "<?php echo $_smarty_tpl->getVariable('vir_path')->value;?>
", 'pic_path': "<?php echo $_smarty_tpl->getVariable('vir_pic_path')->value;?>
www/" };
		</script>
		<script type="text/javascript" src="/js/fancybox/fancybox.js"></script>
		<script type="text/javascript" src="/js/jquery.scrollTo.js"></script>
		<script type="text/javascript" src="/js/mousewheel.js"></script>
		<script type="text/javascript" src="/js/scrollpane.js"></script>
		<script type="text/javascript" src="/js/misc.js"></script>
    </body>
</html>