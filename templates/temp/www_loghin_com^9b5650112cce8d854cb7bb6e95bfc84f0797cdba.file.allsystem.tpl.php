<?php /* Smarty version Smarty-3.1.7, created on 2023-03-04 23:13:45
         compiled from "/home/loghin/public_html/templates/allsystem.tpl" */ ?>
<?php /*%%SmartyHeaderCode:71015295633aa5e7a6e9d1-89511055%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9b5650112cce8d854cb7bb6e95bfc84f0797cdba' => 
    array (
      0 => '/home/loghin/public_html/templates/allsystem.tpl',
      1 => 1677930485,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '71015295633aa5e7a6e9d1-89511055',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_633aa5e7b0940',
  'variables' => 
  array (
    'vir_path' => 0,
    'itemss' => 0,
    'Country_Name' => 0,
    'item1' => 0,
    'ip_lang' => 0,
    'lPs' => 0,
    'v' => 0,
    'systemMenus' => 0,
    'menu' => 0,
    '_menu' => 0,
    'group_items' => 0,
    'layout' => 0,
    'group_level' => 0,
    '_layout' => 0,
    'showRightInfo' => 0,
    'center' => 0,
    'vir_pic_path' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_633aa5e7b0940')) {function content_633aa5e7b0940($_smarty_tpl) {?><?php if (!is_callable('smarty_function_stylesheets')) include '/home/loghin/sources/!core/plugins/function.stylesheets.php';
if (!is_callable('smarty_function_scripts')) include '/home/loghin/sources/!core/plugins/function.scripts.php';
?><!DOCTYPE HTML><html><head><meta charset="utf-8" /><title></title><meta name="description" content="" /><meta name="keywords" content="" /><link rel="stylesheet" type="text/css" href="https://loghin.com/system/templates/media/style.css"><script type="text/javascript" src="https://loghin.com//js/jquery.js"></script><script type="text/javascript" src="https://loghin.com/js/jquery.ui.js"></script><script type="text/javascript" src="https://loghin.com/js/system/mouseWheel.js"></script><script type="text/javascript" src="https://loghin.com/js/system/scroll.js"></script><script type="text/javascript" src="https://loghin.com//js/system/misc.js"></script><?php echo smarty_function_stylesheets(array(),$_smarty_tpl);?>
<?php echo smarty_function_scripts(array(),$_smarty_tpl);?>
<!--[if lt IE 9]><script type="text/javascript">document.createElement('header');document.createElement('footer');</script><![endif]--><!-- /system/templates/layout.tpl -->
    <style>
        .icon {
            display: block;
            background: url(https://loghin.com/system/templates/media/icons.png) no-repeat transparent;
        }
        html, body, div, h1, h2, h3, h4, h5, h6, p, em, img, strong, b, u, i, center, dl, dt, dd, ol, ul, li, fieldset, form, label, a {
            font-family: arial;
        }
        #body > .left .nav li ,
        #body > .left .menu > li ,
        #body > .left .menu > li > ul > li , 
        #body > .left .menu > li > ul > li > ul > li{
            height: auto;
            padding-top: 0;
        }
        #body ul li .icon {
            background: url(https://loghin.com/system/templates/media/icons.png) right -5px no-repeat;
            padding-right: 0px;
        }
        #body{
            height: auto;
            background: url(https://loghin.com/system/templates/media/body-bg.png) 0 0 repeat-x #f5f5f5;
            padding: 5px;
            position: relative;
        }
        #body > .left{
            position: relative;
            
        }
        .button.s-blue{
            background-image: none;
            display: inline-block;
        }
        ul.branches li {
            height: auto !important;
            padding: 0px !important;
        }
        #body > .left{
            top: 0px;
            left: 0px;
        }
        #body > .left .menu > li > ul{
            margin: 0 0px;
        }
        .middle h2.bg, .right h2.bg, .left .block .bg {
            background: url(https://loghin.com/system/templates/media/bg.png) 0 -61px repeat-x;
        }
        ul li.home span.icon {
            background-position: -122px 0 !important;
        }
        #body > .left .menu > li > ul > li > ul > li > ul > li {
            height: auto;
            padding-top: 0;
        }
        
        
        
        .results{
            width:80%;
            float:left;
        }
        .side-result{
            width:20%;
            float:left;
        }
        .side-result img{
            width:100%;
        }
        .sResRigInfo.clear:after, 
        .sResInfoFooter.clear:after, 
        .brd-md.brd-blue.clear:after,
        .pagination.clear:after
        {
            content: none;
        }
        
        .search-bar {
            width: 450px;
            margin-right: 15px;
            position: relative;
            background: url('https://loghin.com/system/templates/media/search-bar.png') left 0 no-repeat;
            height: 25px;
        }
        .search-bar form{
            height:25px;
        }
        .search-bar .inputSubmit {
            background: transparent;
            width: 22px;
            margin: 0 10px 0 5px;
            cursor: pointer;
            border: 0;
        }
        .search-bar .inputText {
            background: transparent;
            width: 400px;
            margin-top: 4px;
            border: 0;
        }
        .searchBox{
            width:755px;
            margin: 0 auto;
            padding: 0 20px 0 20px;
            position: absolute;
        }
        .searchInput{
            background: url('https://loghin.com/templates/media/search_box_bg.png') 0 -120px repeat-x;
            width: 603px;
            height: 58px;
            margin: 0 1em;
            position: relative;
        }
        .searchInput ._left{
            background: url(https://loghin.com/templates/media/search_box_bg.png) 0 0 no-repeat;
            width: 22px;
            height: 58px;
            position: absolute;
            top: 0;
            left: -22px;
        }
        .searchInput .inputText {
            background-color: transparent;
            border-radius: 8px;
            width: 618px;
            height: 32px;
            padding-top: 5px;
            position: absolute;
            top: 8px;
            padding-left: 8px;
            left: -14px;
            z-index: 99;
            font-size: 20px;
            font-family: Verdana, Geneva, sans-serif;
            color: #333;
            border: 0;
        }
        .searchInput ._right{
            background: url(https://loghin.com/templates/media/search_box_bg.png) 0 -60px repeat-x;
            width: 22px;
            height: 58px;
            position: absolute;
            top: 0;
            right: -22px;
        }
        .inputSearch{
            margin-left: 14px;
            position: relative;
            z-index: 99;
        }
        .inputSearch:hover {
            text-decoration: none;
        }
        .inputSearch:hover strong {
            background-position: left -60px;
        }
        .inputSearch:hover strong i {
            background-position: right -60px;
        }
        .inputSearch strong{
            background-image: url(https://loghin.com/templates/media/loghin/search_bg.png);
            background-position: left 0;
            height: 44px;
            padding: 14px 0 0 20px;
            position: relative;
            font-size: 21px;
            font-family: 'Bisque', Verdana;
            font-weight: normal;
            text-shadow: #000000 1px 1px 1px;
            color: #ffffff;
            background-repeat: no-repeat;
            display: block;
        }
        .inputSearch strong i{
            background-image: url(https://loghin.com/templates/media/loghin/search_bg.png);
            background-position: right 0;
            width: 24px;
            height: 58px;
            position: absolute;
            top: 0;
            right: -24px;
        }
        
        .searchcont{
            max-width:650px;
            width:100%;
            margin:auto;
            text-align:center;
            min-height: 60vh;
            padding-top: 15vh;
        }
        .searchcont img{
            width:100%;
            max-width:350px;
        }
        .search_Input{
            border-radius: 9px;
            height: 38px;
            width: 100%;
            max-width:601px;
            padding: 0;
            margin: 0;
            padding-left: 52px;
            border: 3px solid #B5B6B6;
            box-shadow: 0px 5px 8px 0px #7a7a7a;
            margin-top: 30px;
        }
        .searchicn{
            background: url(https://loghin.com/system/templates/media/icons.png) right -5px no-repeat;
            position: absolute;
            display: block;
            width: 18px;
            height: 20px;
            margin-top: -32px;
            margin-left: 12px;
            background-position: -122px 0 !important;
        }
        #body.search > .right{
                z-index: 100;
        }
        .m-search{
            font-size: 18px;
            color:#343434;
            font-family: 'Bisque', Verdana;
            border: 2px solid #a7a7a7;
            outline: none;
            padding: 5px 18px;
            border-radius: 6px;
            /*background: url('https://loghin.com/system/templates/media/bg.png') 0 -29px repeat-x;*/
            /*background-image: linear-gradient(#4287cf, #115090);*/
        }
        .m-search:hover{
            /*background-image: linear-gradient(#115090, #4287cf);*/
            box-shadow: 0px 0px 7px 0px #ababab;
        }
        .icon {
            background: url('https://loghin.com/templates/images/application/icons.png') no-repeat transparent;
        }
        .nav100 ul.buttons > li > a > span.down{
            background-position:-54px -18px;
        }
        .nav100 .icon.home{
            background-position: -69px -1px;
        }
        .nav100 .icon.print{
            background-position: -86px -1px;
        }
        .right .closed .icon{
            background: url('https://loghin.com/system/templates/media/icons.png') no-repeat transparent;
        }
        #a-search .bg .icon, .close.icon.right{
            background: url('https://loghin.com/system/templates/media/icons.png') no-repeat transparent;
        }
        header {
            background: url(https://loghin.com/templates/media/loghin/header_bg.png) repeat-x;
            padding: 6px 10px 0px;
        }
        .nav100 > .gradient{
            border-top:0px;
            padding-top:1px;
        }
        #menu > li.boll{
            margin: 0px 5px 0px 5px;
        }
        #menu > li:hover > a > span, #menu > li.selected > a > span{
            border-radius: 5px;
        }
        #menu > li:hover > a > span, #menu > li > a:focus > span{
            color: #ffffff;
            background: none;
            text-shadow: none;
        }
        #menu > li > ul > li:hover {
            background-color: #BFC6CD;
        }
        #menu > li > ul > li:hover > a{
            color:#fff;
        }
        .search_filter{
            text-align: center;
        }
        .search_filter input{
            display:none;
        }
        .search_filter .boll{
            background: url('https://loghin.com/system/templates/media/menu-separator.png') 6px 9px no-repeat;
            width: 11px;
            height: 11px;
            padding: 9px 9px 5px 10px;
            margin: 0px 4px 0px 4px;
            background-position: center;
        }
        .search_filter label{
            padding: 0 7px 2px;
            font: normal 14px/28px Verdana;
            text-shadow: 1px 0 0 #4d95db;
            color: #01172d;
            cursor: pointer;
            display: inline-block;
        }
        .search_filter label:hover{
            color:#fff;
        }
        .search_filter input:checked+label{
            color:#fff;
        }
        .search_filter label ul{
            background: #f5f5f5;
            width: 150px;
            position: absolute;
            box-shadow: 1px 0 2px #81878a;
            border-radius: 3px;
            display:none;
        }
            .search_filter label ul li{
                padding: 0px 15px;
                border-bottom: 1px solid #dddddd;
            }
            .search_filter label ul li:hover {
                background-color: #BFC6CD;
            }
            .search_filter label ul li:hover > a{
                color:#fff;
            }
            .search_filter label ul li a{
                font: normal 13px/18px verdana;
                color: #012442;
                text-shadow: 0px 0 0 #000000;
            }
        .search_filter label:hover > ul {
            display: block;
            z-index: 101;
        }
        
        
        #body > .left .menu > li > ul > li > ul > li > ul > li > ul {
            display: none;
        }
        /*#body > .left .menu > li > ul > li > ul > li:hover > ul, 
        #body > .left .menu > li > ul > li > ul > li > ul > li:hover > ul{
            display: block;
        }*/
        #body > .left .menu > li > ul > li > ul > li > ul > li.opened > ul {
            display: block;
        }
        #body > .left .menu > li > ul > li > ul > li > ul > li > ul > li {
            height: unset;
            padding: unset;
        }
    </style>
    
    
    <style type="text/css">
		/*.sidebar-navigation {
			width: 400px;
			height: auto;
			background-color: #fff;
			margin: 50px auto;
			webkit-box-shadow: 3px 5px 10px 0px rgba(0, 0, 0, 0.16);
			-moz-box-shadow: 3px 5px 10px 0px rgba(0, 0, 0, 0.16);
			box-shadow: 3px 5px 10px 0px rgba(0, 0, 0, 0.16);
		}*/
		 .sidebar-navigation > ul > li > a {
			 text-transform: uppercase;
		}
		 .sidebar-navigation ul {
			 margin: 0;
			 padding: 0;
		}
		 .sidebar-navigation ul li {
			 display: block;
		}
		 .sidebar-navigation ul li a {
			 position: relative;
			 display: block;
			 font-size: 1em;
			 font-weight: 600;
			 padding:10px 20px;
			 text-decoration: none;
			 color: #2e2e2e;
			 letter-spacing: 0.02em;
			 border-bottom: 1px solid #cfcfcf;
			 -webkit-transition: all 0.3s linear;
			 -moz-transition: all 0.3s linear;
			 -o-transition: all 0.3s linear;
			 transition: all 0.3s linear;
		}
		.sidebar-navigation ul li ul li a {
            border-bottom: 1px solid #cfcfcf;
        }
		 .sidebar-navigation ul li a em {
			 font-size: 24px;
			 position: absolute;
			 right: 20px;
			 top: 0px;
/*			 transform: translateY(-50%);*/
			 transform: rotate(0deg);
			 transition: .3s;
			 padding: 0px;
			 border-radius: 50%;
		}
		.mdi-flip-v{
			transform: rotate(90deg) !important;
			transition: .3s;
		}
		li.select > a > em {
		   transform: rotate(90deg) !important;
		   transition: .3s;
		}
		 .sidebar-navigation ul li:hover > a, .sidebar-navigation ul li.select > a {
			 background-color: #3069a3;
			 color: #fff;
			 /*border-color: rgba(255, 255, 255, .1);*/
		}
		 .sidebar-navigation ul li ul {
			 display: none;
		}
		 .sidebar-navigation ul li ul.open {
			 display: block;
		}
		 .sidebar-navigation ul li ul li a {
			 color:#313f42;
			 /*border-color: rgba(255, 255, 255, .1);*/
		}
		/* .sidebar-navigation ul li ul li a:before */
		 .sidebar-navigation ul li ul li:hover > a, .sidebar-navigation ul li ul li.select > a {
			 background-color:#3C80C6;
			 color: #fff;
		}
		/* .sidebar-navigation ul li ul li:hover > a:before, .sidebar-navigation ul li ul li.selected > a:before */
		 .sidebar-navigation ul li ul li.select.select--last > a {
			 background-color: #94aab0;
			 color: #fff;
		}
		/* .sidebar-navigation ul li ul li.selected.selected--last > a:before */
		li.select > ul {
		   display: block !important;
		}
		
		.sidebar-navigation ul li {
		   height: unset !important;
		   padding-top: 0px !important;
		}
		
		li.opened > .sidebar-navigation > ul {
            display: block;
        }
        li > .sidebar-navigation > ul {
            display: none;
        }
        ul.lavel2{
            background-color: #eaeaea;
        }
        ul.lavel3 {
            background-color: #c5c5c5;
        }
        ul.lavel4 {
            background-color: #b7b7b7;
        }
	</style>
    
    
    
    </head>
    
    <body>
		
    	<div id="container" class="min-width">
    		<div id="head-line" class="clear bg" style="background-image: linear-gradient(#E3E3E4, #FEFEFE);margin-bottom: 30px;">
    			<div class="left" style="font-size:13px;margin-top:16px;">
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
				  
					<select class="inputCombo" id="country"  name="country" style=" margin-left: 70px;">
					    <option  value="<?php echo $_smarty_tpl->tpl_vars['itemss']->value['name'];?>
"><?php echo $_smarty_tpl->tpl_vars['Country_Name']->value;?>
</option>
					       <?php  $_smarty_tpl->tpl_vars['itemss'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['itemss']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['item1']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['itemss']->key => $_smarty_tpl->tpl_vars['itemss']->value){
$_smarty_tpl->tpl_vars['itemss']->_loop = true;
?>
					        
					    	 <option  value="<?php echo $_smarty_tpl->tpl_vars['itemss']->value['name'];?>
"><?php echo $_smarty_tpl->tpl_vars['itemss']->value['name'];?>
</option>
					    
							<?php } ?>
					</select>
					
					&nbsp;|&nbsp;
					
					<select class="inputCombo" name="language">
					    <?php  $_smarty_tpl->tpl_vars['lPs'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['lPs']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['ip_lang']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['lPs']->key => $_smarty_tpl->tpl_vars['lPs']->value){
$_smarty_tpl->tpl_vars['lPs']->_loop = true;
?>
					       <?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['v']->_loop = false;
 $_from = explode(',',$_smarty_tpl->tpl_vars['lPs']->value['IP_lang']); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value){
$_smarty_tpl->tpl_vars['v']->_loop = true;
?>
					  
					     	<option  value="" id="lang"><?php echo $_smarty_tpl->tpl_vars['v']->value;?>
</option>
					  
			               <?php } ?>
					   	<?php } ?>
					
						
					</select>
					<br>
				
					 <div class="right">
    			    <h3 id="states" name="state" class="form-control input-style" style="float: right;font-size: 13px;margin-left:5px;">
                         
                         
                           
                        </h3><br>
                        <span style="float: right;font-size: 13px;font-weight: 700;">Ioan Chis</span><span id="code" style="float: right;
    margin-top: 26px;
    font-size: 15px;
    margin-right: -64px;"></span>
                       
    			</div>
    			
				</div>
    		  
    
    			 
    			
    			<!-- #head-line .right -->
    		</div>
    		<!-- #head-line -->
    		
          
    			
    		<header style="height:32px;text-align:center;">
    		    
    		     <a href = ""><span id="code" style="float:right;padding-top: 10px;font-size: 15px;"></span></a> 
    		      
    		    <form action="#" class="search_filter">
                  <input type="checkbox" id="Adolescenti" name="Adolescenti" value="Adolescenti">
                  <label for="Adolescenti"> Adolescenti</label>
                  
                  <span class="boll"></span>
                  <input type="checkbox" id="Adulti" name="Adulti" value="Adulti">
                  <label for="Adulti"> Adulti</label>
                  
                  <span class="boll"></span>
                  <input type="checkbox" id="Business" name="Business" value="Business">
                  <label for="Business"> Business</label>
                  
                  <span class="boll"></span>
                  <input type="checkbox" id="Institutii" name="Institutii" value="Institutii">
                  <label for="Institutii"> Institutii</label>
                  
                  <span class="boll"></span>
                  <input type="checkbox" id="Imagini" name="Imagini" value="Imagini">
                  <label for="Imagini"> Imagini</label>
                  
                  <span class="boll"></span>
                  <input type="checkbox" id="Video" name="Video" value="Video">
                  <label for="Video"> Video</label>
                  
                  <span class="boll"></span>
                  <input type="checkbox" id="Stiri" name="Stiri" value="Stiri">
                  <label for="Stiri"> Stiri</label>
                  
                  <span class="boll"></span>
                  <input type="checkbox" id="Web" name="Web" value="Web">
                  <label for="Web"> Web</label>
                  
                  <span class="boll"></span>
                  <input type="checkbox" id="Altele" name="Altele" value="Altele">
                  <label for="Altele"> Altele 
                        <ul>
    						<li><a href="#">Joburi</a></li>
    						<li><a href="#">Finante</a></li>
    						<li><a href="#">Intilniri-Escort</a></li>
    						<li><a href="#">Shop</a></li>
    					</ul>
    			   </label>
    			   	
                </form>
    		</header>
    	
    		<div class="nav100 clear">
    			<div class="gradient">
    				<div class="center">
                    	<div class="right">
                            <ul class="rightNav">
                                <li><a href="http://register.loghin.com/teenagers/"><strong>Teenagers</strong></a></li>
                                <li><a href="http://register.loghin.com/adults/"><strong>Adults</strong></a></li>
                                <li><a href="http://register.loghin.com/business/"><strong>Business</strong></a></li>
                                <li><a href="http://register.loghin.com/institutions/"><strong>Institutions</strong></a></li>
                            </ul>
                        </div>
    					<!-- changer -->
    					<ul class="changer profile-switch">
    						<li class="left"><span class="icon">&nbsp;</span></li>
    						<li class="right"><span class="icon">&nbsp;</span></li>
    						<div id="profile-switch">
    							<div class="connector left"></div>
    							<div class="cfix"></div>
    							<div class="block">
    								<div class="gray-block bg">
    									<a href="#">Personal</a>
    									<a class="blue" href="#">Group</a>
    									<a class="black" href="#">Business</a>
    									<a href="#">Private</a>
    								</div>
    								<div class="image">
    									<img src="https://files.loghin.com/quick-view-image.png" alt="">
    								</div>
    								<ul class="items toggle">
    									<li class="opened">
    										<a href="#">Gestiune Profil</a>
    										<ul>
    											<li><a href="#">Meniu 1</a></li>
    											<li><a href="#">Meniu 2</a></li>
    											<li><a href="#">Meniu 3</a></li>
    										</ul>
    										<span class="icon target"> </span>
    									</li>
    									<li>
    										<a href="#">Gestiune Aplicatii</a>
    										<ul>
    											<li><a href="#">Meniu 1</a></li>
    											<li><a href="#">Meniu 2</a></li>
    											<li><a href="#">Meniu 3</a></li>
    										</ul>
    										<span class="icon target"> </span>
    									</li>
    								</ul>
    								<div class="bottom">
    									<a class="fancy bg" href="#">Quick Profile View</a>
    								</div>
    							</div>
    						</div>
    					</ul>
    
    					<!-- drop_down -->
    					<div class="user-bar-menu clear left">
    						<a class="left" href="javascript:void(0);"><span class="online icon"></span></a>
    						<div class="right"><a href="#refresh">Refresh</a></div>
    						<ul class="clear">
    							<li class="down">
    								<a href="#">Account</a>
                                    <ul>
    								                                </ul>
    							</li>
    							<li><a href="#">User&nbsp;</a></li>
    							<li class="down">
    								<a href="#">Nick Name&nbsp;</a>
    								<ul>
                                    									</ul>
    							</li>
    							<li><a href="#">Profil</a></li>
    						</ul>
    
    						<div class="options">
    							<div class="overflow">
                                								</div>
    							<div class="bottom bg clear">
    								<div class="left"><span class="icon">&nbsp;</span></div>
    								<div class="right refresh"><a class="icon reload" href="#">&nbsp;</a></div>
    								<ul class="btn">
    									<li><a href="#">Button 1</a></li>
    									<li><a href="#">Button 2</a></li>
    									<li><a href="#">Button 3</a></li>
    									<li><a href="#">Button 4</a></li>
    								</ul>
    							</div>
    						</div>
                            <script>
    						/* User Accounts */
    						var userBarMenuTh = ['Account','User','Nick Name','Profile'];
    						var userBarMenuTh_active = ['currentAccount','currentUser','currentNickname','currentProfile'];
    						
    						// Action
    						$('.user-bar-menu > a.left').on('click', function() {
    							var $userbar = $(this).parent();
    							var $this    = $userbar.find('.options');
    					
    							if ($this.is(':visible')) {
    								return false;
    							}
    					
    							$this.slideDown(function() {
    								/* Check if scroll has been setted */
    								if ($this.find('.scrollWrap').length <= 0) {
    									/* Set scroll */
    									$('.user-bar-menu .options .overflow').customScroll({ width: '12px', distance: '4px', paddingRight: '21px' });
    									$userbar.find('.th > li').each(function(index, element) {
    										$(element).children('.label').html(userBarMenuTh[index]);
    									});
    								}
    					
    								/* Set event for close block */
    								$('body').on('click.options', function(e) {
    									if ($(e.target).closest($this).length <= 0) {
    										$this.slideUp(function () {
    											// Put current user
    											$userbar.find('.th > li').each(function(index, element) {
    												$(element).children('.label').html(userBarMenuTh_active[index]);
    											});
    										});
    										$('body').off('click.options');
    									}
    								});
    							});
    						});
    						</script>
    					</div>
    					<!-- options -->
    					<ul class="buttons">
    						<li><a><span class="icon home left">&nbsp;</span><span class="rline">&nbsp;</span><span class="icon down">&nbsp;</span></a></li>
    						<li><a><span class="icon home">&nbsp;</span></a></li>
    						<li><a><span class="icon print">&nbsp;</span></a></li>
    						<li><a><span class="icon star">&nbsp;</span></a></li>
    					</ul>
    					<!-- search box -->
    					<!--<form method="get" class="search_box clear" action="">
    						<fieldset class="gradient">
    							<button class="icon" type="submit">&nbsp;</button>
    							<input id="struct_search" class="field" type="search" autocomplete="off" placeholder="Cod Ateco sau Denumirea" />
    						</fieldset>
    						<div id="AGH_searchRecom"><div id="AGH_searchRecom_fix"></div></div>
    					</form>-->
    				</div>
    			</div>
    		</div>
    	</div>
		



		
		<div id="body" class="clear search s-over">
		    
			<div class="left">
		    	<ul class="menu">
		    	    
					<li class="selected">
						<a href="#">Loghin System</a>
						<ul>
						    <?php  $_smarty_tpl->tpl_vars['menu'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['menu']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['systemMenus']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['menu']->key => $_smarty_tpl->tpl_vars['menu']->value){
$_smarty_tpl->tpl_vars['menu']->_loop = true;
?>
						    	<?php if ($_smarty_tpl->tpl_vars['menu']->value['type']=='left'){?>
						    <li class="home">
								<a href="#" class="lavel1"><span class="icon"> </span><?php echo $_smarty_tpl->tpl_vars['menu']->value['name'];?>
</a>
									<?php if ($_smarty_tpl->tpl_vars['menu']->value['items']){?>
									<div class="sidebar-navigation">
								     <ul class="lavel2">
                    					<?php  $_smarty_tpl->tpl_vars['_menu'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['_menu']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['menu']->value['items']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['_menu']->key => $_smarty_tpl->tpl_vars['_menu']->value){
$_smarty_tpl->tpl_vars['_menu']->_loop = true;
?>
                    						<li>
                    						    <a data-id="<?php echo $_smarty_tpl->tpl_vars['_menu']->key;?>
" href="#"><?php echo $_smarty_tpl->tpl_vars['_menu']->value;?>
</a>
                    						    <ul class="lavel3">
                    						    <?php  $_smarty_tpl->tpl_vars['layout'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['layout']->_loop = false;
 $_smarty_tpl->tpl_vars['group_id'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['group_items']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['layout']->key => $_smarty_tpl->tpl_vars['layout']->value){
$_smarty_tpl->tpl_vars['layout']->_loop = true;
 $_smarty_tpl->tpl_vars['group_id']->value = $_smarty_tpl->tpl_vars['layout']->key;
?>
                    						        <?php if ($_smarty_tpl->tpl_vars['layout']->value['menu_id']==$_smarty_tpl->tpl_vars['_menu']->key){?>
                        						        <li>
                        						            <a data-id="<?php echo $_smarty_tpl->tpl_vars['layout']->key;?>
" href="#"><?php echo $_smarty_tpl->tpl_vars['layout']->value['name'];?>
</a> 
                        						            <ul class="lavel4">
                            						            <?php  $_smarty_tpl->tpl_vars['_layout'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['_layout']->_loop = false;
 $_smarty_tpl->tpl_vars['parent_id'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['group_level']->value[$_smarty_tpl->tpl_vars['layout']->value['id']]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['_layout']->key => $_smarty_tpl->tpl_vars['_layout']->value){
$_smarty_tpl->tpl_vars['_layout']->_loop = true;
 $_smarty_tpl->tpl_vars['parent_id']->value = $_smarty_tpl->tpl_vars['_layout']->key;
?>
                                                                    <li>
                                                                        <a><?php echo $_smarty_tpl->tpl_vars['_layout']->value['name'];?>
</a>                                                         						                 
                                                                    </li>    
                                                                <?php } ?>   
                            						        </ul>
                        						        </li>
                    						        <?php }?>
                                                <?php } ?> 
                    						    </ul> 
                    						</li>
                    					<?php } ?>
                    				</ul>
                    				</div>
								<?php }?>
								<span class="has icon"> </span>
							</li>
								<?php }?>
							<?php } ?>
						</ul>
						<span class="has icon"> </span>
					</li>
				    
				    <li class="selected opened">
						<a href="#">Loghin Users</a>
						<ul>
						    <?php  $_smarty_tpl->tpl_vars['menu'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['menu']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['systemMenus']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['menu']->key => $_smarty_tpl->tpl_vars['menu']->value){
$_smarty_tpl->tpl_vars['menu']->_loop = true;
?>
						    	   <?php if ($_smarty_tpl->tpl_vars['menu']->value['type']!='left'){?>
						      <li class="home">
								<a href="#" class="lavel1"><span class="icon"> </span><?php echo $_smarty_tpl->tpl_vars['menu']->value['name'];?>
</a>
									<?php if ($_smarty_tpl->tpl_vars['menu']->value['items']){?>
									<div class="sidebar-navigation">
                        				<ul class="lavel2">
                        					<?php  $_smarty_tpl->tpl_vars['_menu'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['_menu']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['menu']->value['items']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['_menu']->key => $_smarty_tpl->tpl_vars['_menu']->value){
$_smarty_tpl->tpl_vars['_menu']->_loop = true;
?>
                        						<li>
                        						  <a data-id="<?php echo $_smarty_tpl->tpl_vars['_menu']->key;?>
" href="#"><?php echo $_smarty_tpl->tpl_vars['_menu']->value;?>
</a>
                        						    <ul class="lavel3">
                        						        <?php  $_smarty_tpl->tpl_vars['layout'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['layout']->_loop = false;
 $_smarty_tpl->tpl_vars['group_id'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['group_items']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['layout']->key => $_smarty_tpl->tpl_vars['layout']->value){
$_smarty_tpl->tpl_vars['layout']->_loop = true;
 $_smarty_tpl->tpl_vars['group_id']->value = $_smarty_tpl->tpl_vars['layout']->key;
?>
                        						            <?php if ($_smarty_tpl->tpl_vars['layout']->value['menu_id']==$_smarty_tpl->tpl_vars['_menu']->key){?>
                            						            <li>
                            						                <a data-id="<?php echo $_smarty_tpl->tpl_vars['layout']->key;?>
" href="#"><?php echo $_smarty_tpl->tpl_vars['layout']->value['name'];?>
</a>
                            						                <ul class="lavel4">
                            						                   <?php  $_smarty_tpl->tpl_vars['_layout'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['_layout']->_loop = false;
 $_smarty_tpl->tpl_vars['parent_id'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['group_level']->value[$_smarty_tpl->tpl_vars['layout']->value['id']]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['_layout']->key => $_smarty_tpl->tpl_vars['_layout']->value){
$_smarty_tpl->tpl_vars['_layout']->_loop = true;
 $_smarty_tpl->tpl_vars['parent_id']->value = $_smarty_tpl->tpl_vars['_layout']->key;
?>
                                                                        <li>
                                                                            <a><?php echo $_smarty_tpl->tpl_vars['_layout']->value['name'];?>
</a>                                                         						                 
                                                                        </li>    
                                                                        <?php } ?>   
                            						                </ul>     
                            						            </li>
                        						            <?php }?>
                                                        <?php } ?>                    						        
                        						    </ul>   
                        					    </li>
                        					<?php } ?>
                        				</ul>
                    				</div>
                    				<?php }?>
								<span class="has icon"> </span>
							</li>
    						<?php }?>
    					<?php } ?>
			         </ul>
						<span class="has icon"> </span>
					</li>
                    		
                    				                                                                             
					
					<li>
						<a href="#">Websites</a>
						<ul>
							<li class="tag">
							    <a href="#"><span class="icon"> </span> Lorem ipsum dolor sitamet</a>
							</li>
							<li class="user">
							    <a href="#"><span class="icon"> </span> Lorem ipsum dolor sitamet</a>
							</li>
							<li class="stats last">
							    <a href="#"><span class="icon"> </span> Lorem ipsum dolor sitamet</a>
							    
							    <ul>
							        <li>
							            <div class="sidebar-navigation">
                                    	  <ul>
                                    	      <li><a href="#">Application <em class="mdi mdi-chevron-down"></em></a>
                                    	          <ul>
                                    	              <li><a href="#">Mobile <em class="mdi mdi-chevron-down"></em></a>
                                    	              <ul>
                                    	                  <li><a href="#">Activity <em class="mdi mdi-chevron-down"></em></a>
                                    	                      <ul>
                                    	                          <li><a href="#">Social media</a></li>
                                    	                      </ul>
                                    	                  </li>
                                    	              </ul>
                                    	              </li>
                                    	          </ul>
                                    	      </li>
                                    	  </ul>
                                    	</div>
							        </li>
							    </ul>
							    
							    <span class="has icon"> </span>
							</li>
                        	
                        	<script type="text/javascript">
                        		$(function(){
                        		  	var $ul   =   $('.sidebar-navigation > ul');
                        		  	$ul.find('li a').click(function(e){
                        		   	var $li = $(this).parent();
                        		    
                        		    	if($li.find('ul').length > 0){
                        		      	e.preventDefault();
                        		      
                        			      if($li.hasClass('select')){
                        			        	$li.removeClass('select').find('li').removeClass('selected');
                        			      //  	$li.find('ul').slideUp(300);
                        			        	$li.find('a em').removeClass('mdi-flip-v');
                        			      }else{
                        				      if($li.parents('li.select').length == 0){
                        				         $ul.find('li').removeClass('select');
                        				      //   $ul.find('ul').slideUp(300);
                        				         $ul.find('li a em').removeClass('mdi-flip-v');
                        				      }else{
                        				         $li.parent().find('li').removeClass('select');
                        				      //   $li.parent().find('> li ul').slideUp(300);
                        				         $li.parent().find('> li a em').removeClass('mdi-flip-v');
                        				      }
                        			        	$li.addClass('select');
                        			      //  	$li.find('>ul').slideDown(300);
                        			        	$li.find('>a>em').addClass('mdi-flip-v');
                        			      }
                        			   }
                        		  	});
                        		  
                        		  	$('.sidebar-navigation > ul ul').each(function(i){
                        		    	if($(this).find('>li>ul').length > 0){
                        		      	var paddingLeft = $(this).parent().parent().find('>li>a').css('padding-left');
                        		      	var pIntPLeft   = parseInt(paddingLeft);
                        		      	var result      = pIntPLeft + 20;
                        		      
                        		      	$(this).find('>li>a').css('padding-left',result);
                        		    	}else{
                        		      	var paddingLeft = $(this).parent().parent().find('>li>a').css('padding-left');
                        		      	var pIntPLeft   = parseInt(paddingLeft);
                        		      	var result      = pIntPLeft + 20;
                        		      
                        		      	$(this).find('>li>a').css('padding-left',result).parent().addClass('select--last');
                        		    	}
                        		  	});
                        		  
                        		  	var t = ' li > ul ';
                        		  	for(var i=1;i<=10;i++){
                        		    	$('.sidebar-navigation > ul > ' + t.repeat(i)).addClass('subMenuColor' + i);
                        		  	}
                        		  
                        		  	var activeLi = $('li.select');
                        		  	if(activeLi.length){
                        		    	opener(activeLi);
                        		  	}
                        		  
                        		  	function opener(li){
                        		    	var ul = li.closest('ul');
                        		    	if(ul.length){
                        		        	li.addClass('select');
                        		        	ul.addClass('open');
                        		        	li.find('>a>em').addClass('mdi-flip-v');
                        		      
                        		      	if(ul.closest('li').length){
                        		        		opener(ul.closest('li'));
                        		      	}else{
                        		        		return false;
                        		      	}
                        		    	}
                        		  	}
                        		});
                        	</script>
                        	
						</ul>
						<span class="has icon"> </span>
					</li>
					<li>
						<a href="#">Aplications</a>
						<ul>
							<li class="tag"><a href="#"><span class="icon"> </span> Lorem ipsum dolor sitamet</a></li>
							<li class="user"><a href="#"><span class="icon"> </span> Lorem ipsum dolor sitamet</a></li>
							<li class="stats last"><a href="#"><span class="icon"> </span> Lorem ipsum dolor sitamet</a></li>
						</ul>
						<span class="has icon"> </span>
					</li>
				</ul><!-- #body .left .menu -->

				<!-- #body .left .block  -->

				
			</div>
			
			<!-- #body .right -->
			<div class="right">
				<div id="a-search" class="block">
					<h2 class="bg">Advance Search <a class="icon" href="javascript:void(0);" name="search s-over">&raquo;</a></h2>
					<div class="padding">
						<div class="block-nav">
                        	<a class="selected" href="#">Source</a> &nbsp;|&nbsp;
                        	<a href="#">Structure</a> &nbsp;|&nbsp;
                        	<a href="#">Information</a>
                        </div>
                        
                        <?php if (false===empty($_smarty_tpl->tpl_vars['showRightInfo']->value)){?><dl class="info">
                        	<dt>Model</dt>
                        	<dd>
                        		<div class="clear">
                        			<span class="left">Name:</span>
                        			<span class="right">Lorem Ipsum</span>
                        		</div>
                        	</dd>
                        
                        	<dt>Author</dt>
                        	<dd>
                        		<div class="clear">
                        			<span class="left">Name:</span>
                        			<span class="right">Lorem Ipsum</span>
                        		</div>
                        	</dd>
                        
                        	<dt>Albums</dt>
                        	<dd>
                        		<div class="clear">
                        			<span class="left">Lorem Ipsum:</span>
                        			<span class="right">02/05/2012</span>
                        		</div>
                        		<div class="clear">
                        			<span class="left">Gallery:</span>
                        			<span class="right">5.260 Items</span>
                        		</div>
                        	</dd>
                        
                        	<dt>Details</dt>
                        	<dd>
                        		<div class="clear">
                        			<span class="left">Submitted:</span>
                        			<span class="right">02/05/2012</span>
                        		</div>
                        		<div class="clear">
                        			<span class="left">Image Size:</span>
                        			<span class="right">4.1 MB</span>
                        		</div>
                        		<div class="clear">
                        			<span class="left">Resolution:</span>
                        			<span class="right">3750x3000</span>
                        		</div>
                        	</dd>
                        
                        	<dt>Device data</dt>
                        	<dd>
                        		<div class="clear">
                        			<span class="left">Make:</span>
                        			<span class="right">Canon</span>
                        		</div>
                        		<div class="clear">
                        			<span class="left">Model:</span>
                        			<span class="right">Canon EOS 60 D</span>
                        		</div>
                        	</dd>
                        </dl><?php }?>
                        
                        <div class="block-nav">
                        	<a class="selected" href="#">Preference</a> &nbsp;|&nbsp;
                        	<a href="#">Statistics</a> &nbsp;|&nbsp;
                        	<a href="#">In / Out</a>
                        </div>
                        <div class="pref">
                        	<div class="head clear">
                        		<h3 class="left">Preference</h3>
                        		<a class="close icon right" href="#">x</a>
                        	</div>
                        	<div class="line">
                        		<p>Seleziona le schede delle notizie da visualizzare:</p>
                        		<div class="clear">
                        			<div class="formLabel">
                        				<label>Visual Time:</label>
                        			</div>
                        			<div class="formField">
                        				<select class="inputCombo" name="">
                        					<option value="">Days</option>
                        				</select>
                        			</div>
                        		</div>
                        		<div class="clear">
                        			<div class="formLabel">
                        				<label>Total Hits:</label>
                        			</div>
                        			<div class="formField">
                        				<select class="inputCombo" name="">
                        					<option value="">Number</option>
                        				</select>
                        			</div>
                        		</div>
                        		<div class="clear">
                        			<div class="formLabel">
                        				<label>Visual:</label>
                        			</div>
                        			<div class="formField">
                        				<select class="inputCombo" name="">
                        					<option value="">Type</option>
                        				</select>
                        			</div>
                        		</div>
                        	</div>
                        	<div class="line">
                        		<p>Processing System:</p>
                        		<div class="clear">
                        			<div class="formLabel">
                        				<label>Modul 1 Activation:</label>
                        			</div>
                        			<div class="formField">
                        				<input class="inputCheckbox" type="checkbox" name="" value="" />
                        			</div>
                        		</div>
                        		<div class="clear">
                        			<div class="formLabel">
                        				<label>Modul 2 Activation:</label>
                        			</div>
                        			<div class="formField">
                        				<input class="inputCheckbox" type="checkbox" name="" value="" />
                        			</div>
                        		</div>
                        		<div class="clear">
                        			<div class="formLabel">
                        				<label>Arhive:</label>
                        			</div>
                        			<div class="formField">
                        				<select class="inputCombo" name="">
                        					<option value="">Select</option>
                        				</select>
                        			</div>
                        		</div>
                        		<div class="clear">
                        			<div class="formLabel">
                        				<label>Newsletter:</label>
                        			</div>
                        			<div class="formField">
                        				<input class="inputCheckbox" type="checkbox" name="" value="" />
                        			</div>
                        		</div>
                        		<div class="formButton">
                        			<a href="#submit">Save<i></i></a>
                        		</div>
                        	</div>
                        </div>
					</div>
				</div>
				<div class="closed">
					<span class="icon"></span>
					<span class="text">Advanced<br /><br />Search</span>
					<span class="icon center"></span>
				</div>
			</div><!-- #body .right -->

            <!-- #body .middle -->
			<div class="middle">
				<div class="block">
					<h2 class="bg">Search All</h2>
					<div style="padding:8px;min-height:61vh;padding-top:14vh;">
					    
					    <!--<div class="search-bar" style="margin:auto;">
        					<form action="" method="get" style="display:flex;">
        						<input class="inputSubmit" type="submit" value="">
        						<input class="inputText" type="text" name="search" value="" placeholder="Search Bar">
        					</form><i></i>
        				</div>-->
        			<!-- 	<div class="searchcont">
        				    <img src="https://loghin.com/Loghin_logo.png">
        				    <form>
        				        <input type="text" class="search_Input">
        				        <span class="searchicn"></span>
        				    </form>
        				</div>-->
        				<div style="max-width:755px;margin:auto;">
        				    <img src="https://loghin.com/logo.png" style="max-width: 400px;width: 100%;margin-left:138px;">
            				<div class="searchBox">
                				<form action="/search" method="post">
                					<div class="searchInput left">
                						<div class="_left"></div>
                						<input class="inputText" type="text" name="search" value="">
                						<div class="_right"></div>
                					</div>
                					<a class="inputSearch left" href="/search" rel="submit"><strong>Search<i></i></strong></a>
                					<div class="cfix"></div>
                				</form>
            				</div>
            				<div style="padding-top: 75px;margin-left: 180px;">
            				    <button class="m-search">Loghin System</button>
            				    <button class="m-search" style="margin-left:10px;">Loghin Store</button>
            				</div>
        				</div>
                    	
                   <!-- 	<div class="sResRigOptions clear">
                    		<ul class="left">
                    			<li><a href="#">Menu<i></i></a></li>
                    			<li class="selected"><a href="#">Selected<i></i></a></li>
                    			<li><a href="#">Menu<i></i></a></li>
                    		</ul>
                    		<div class="right clear">
                    			<input class="inputSearch" type="submit" value="">
                    			<select class="inputCombo" name="company">
                    				<option>Company</option>
                    			</select>
                    			<input class="inputText" type="text" name="keyword" value="Enter search keyword">
                    		</div>
                    	</div> -->
					
					</div>
					
					
				<!--	<div<?php if (false==empty($_smarty_tpl->tpl_vars['center']->value[2])){?> class="<?php echo $_smarty_tpl->tpl_vars['center']->value[2];?>
"<?php }?>>
						<?php if (false==empty($_smarty_tpl->tpl_vars['center']->value[1])){?><?php echo $_smarty_tpl->getSubTemplate ("center/".($_smarty_tpl->tpl_vars['center']->value[1]), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }?>
					</div> -->
				</div>
			</div><!-- #body .middle -->
			
			
			
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
        		<p class="right">Copyright &copy; 2020 Loghin. All rights reserved...</div> 
			</div>
		</div>
		


<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>

  <script>
 
     
      $('#country').on("change",function(){
          var selectedCountry = $("#country option:selected").val();
          
          $.ajax({
              type: "POST",
              url: "states",
              data: { country : selectedCountry },
              success: function(dataResult){
              var dataResult = JSON.parse(dataResult);
              
               if(dataResult.statusCode==200){
                    var content = dataResult.value;
                    var lang = dataResult.value1;
                    var code = dataResult.value2;
                 
                    
                    $("#states").html(content);
                    $("#lang").html(lang);
                   
                    $("#code").html(code);
               }
               
          }
        
        }); 
         console.log(selectedCountry);
        
         
      });
     


  </script>
	

        
			<?php echo smarty_function_scripts(array(),$_smarty_tpl);?>

		<script type="text/javascript">
			$.conf = { 'path': "<?php echo $_smarty_tpl->tpl_vars['vir_path']->value;?>
", 'pic_path': "<?php echo $_smarty_tpl->tpl_vars['vir_pic_path']->value;?>
www/" };
		</script>
		<script>
		// compact/extends accounts
		function userBar_compactAll(ref) {
			if(ref == null) {
				var rows = $('.options > .overflow > .row');
				rows.each(function(index, element) {
					$(element).children('ul').each(function(index, element) {
						if(index > 0) {
							$(element).hide();
						}
					}); 
				}); 
				
			}
			else {
				ref.children('.left').children('a').html('+');
				
				ref.children('ul').each(function(index, element) {
					if(index > 0) {
						$(element).hide();
					}
				}); 
			}
		}
		userBar_compactAll(null);
		$('.options > .overflow > .row > .left').on('click', 'a', function(){
			var compacted = ($(this).html() == '+');
		
			// reset all
			userBar_compactAll($(this).parent().parent());
			
			if(compacted)
			{
				$(this).html('-');
				$(this).parent().parent().find('ul').show();
				$(this).parent().parent().css('border-bottom-width', '1px');
			}
		});
		</script>
		
		
    </body>
</html><?php }} ?>