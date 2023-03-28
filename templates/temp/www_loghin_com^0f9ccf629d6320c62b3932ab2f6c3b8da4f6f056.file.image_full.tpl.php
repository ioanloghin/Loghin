<?php /* Smarty version Smarty-3.1.7, created on 2022-11-25 17:31:58
         compiled from "/home/loghin/public_html/templates/image_full.tpl" */ ?>
<?php /*%%SmartyHeaderCode:16129397246380fc0eaaa533-73438074%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0f9ccf629d6320c62b3932ab2f6c3b8da4f6f056' => 
    array (
      0 => '/home/loghin/public_html/templates/image_full.tpl',
      1 => 1668425890,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '16129397246380fc0eaaa533-73438074',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'vir_path' => 0,
    'vir_pic_path' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_6380fc0eb18fa',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_6380fc0eb18fa')) {function content_6380fc0eb18fa($_smarty_tpl) {?><?php if (!is_callable('smarty_function_stylesheets')) include '/home/loghin/sources/!core/plugins/function.stylesheets.php';
if (!is_callable('smarty_function_scripts')) include '/home/loghin/sources/!core/plugins/function.scripts.php';
?><!DOCTYPE HTML><html><head><meta charset="utf-8" /><meta name="viewport" content="width=device-width, initial-scale=1"><title></title><meta name="description" content="" /><meta name="keywords" content="" /><link rel="stylesheet" type="text/css" href="https://loghin.com/system/templates/media/style.css"><script type="text/javascript" src="https://loghin.com//js/jquery.js"></script><script type="text/javascript" src="https://loghin.com/js/jquery.ui.js"></script><!--<script type="text/javascript" src="https://loghin.com/js/system/mouseWheel.js"></script><script type="text/javascript" src="https://loghin.com/js/system/scroll.js"></script><script type="text/javascript" src="https://loghin.com//js/system/misc.js"></script>--><?php echo smarty_function_stylesheets(array(),$_smarty_tpl);?>
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
            
            .search-bar {
                width: 275px;
                margin-right: 15px;
                position: relative;
            }
            .nav100 .search-bar {
                background: url(https://loghin.com/system/templates/media/search-bar.png) left 0 no-repeat;
                height: 25px;
                margin-top: 2px;
            }
            .search-bar .inputSubmit{
                background: transparent;
                width: 22px;
                margin: 0 5px 0 5px;
                cursor: pointer;
                border: 0;
                height:23px;
            }
            .search-bar .inputText {
                background: transparent;
                width:254px;
                margin-top: 4px;
                border: 0;
                border-radius:10px;
                z-index: 2;
                padding-left: 5px;
            }
            .nav100 .search-bar i{
                background-position: right;
                display: block;
                width: 15px;
                position: absolute;
                top: 0;
                right: -15px;
                background: url(https://loghin.com/system/templates/media/search-bar.png) right 0 no-repeat;
                height: 25px;
                z-index:1;
            }
            .user-bar-menu > .refresh{
                background: url(https://loghin.com/templates/media/user-menu.png) right top no-repeat;
                height: 19px;
                padding: 6px 4px 2px;
                float: right;
            }
            .user-bar-menu > .refresh a {
                background: transparent;
                display: block;
                width: 12px;
                height: 14px;
                text-indent: -9999em;
                border: 0;
            }
            .rightNav li{
                float: unset;
                display: inline-block;
            }
            .nav100 > .gradient > .center {
                width: 1270px;
            }
            .backButton {
                background: url(https://accounts.loghin.com/templates/media/backButton.png) no-repeat;
                display: block;
                width: 73px;
                height: 28px;
                float: left;
                color: transparent;
            }
            .prevNext {
                background: url(https://accounts.loghin.com/templates/media/prevNextButton.png) no-repeat;
                width: 149px;
                height: 28px;
                margin-left: 5px;
            }
            .prevNext .left {
                width: 89px;
            }
            .prevNext a {
                display: block;
                height: 28px;
                color: transparent;
            }
            .prevNext .right {
                width: 59px;
            }
            .prevNext a {
                display: block;
                height: 28px;
                color: transparent;
            }
            #body{
                padding: 0px 0;
            }
            #body > .middle{
                margin: 0 0px 0 0px;
                padding: 0 0px;
            }
        </style>
        <style type="text/css">
            .image_container{
            	width: 100%;
            	display: flex;
            }
            .fullimage_grid{
            	display: flex;
            	width: 59%;
            	flex-wrap: wrap;
            	height: 82vh;
                overflow: scroll;
            }
            .fullimage_col{
            	float: left;
            	width:22.4%;
                padding:1.3%;
            }
            .fullimage-box .fullimage_col{
                width:22.1%;
            }
            .fullimage_col img{
                width: 100%;
                object-fit: cover;
                height: 100%;
                max-height:150px;
                object-position: center;
                border: 5px solid #fff;
                border-radius: 5px;
                box-shadow: 0px 0px 5px 0px #ababab;
                cursor: pointer;
                transition: .3s;
            }
            .fullimage_col img:hover {
                border: 5px solid #3D93E5;
                transition: .3s;
                box-shadow: 0px 0px 5px 0px #3D93E5;
            }
            .fullimage_col p{
                padding-top: 5px;
                padding-left: 5px;
            }
            .pagination{
                font-size: 13px;
                font-style: italic;
                font-weight: 600;
                float:left;
                width:98%;
            }
            .pagination a {
                color: #095ba6;
            }
            .fullimage-box{
                float: left;
                width: 40.5%;
                margin-left:0.5%;
                background-image: linear-gradient(#636678, #303139);
                height: 82vh;
                overflow: scroll;
            }
            .fullimage-box::-webkit-scrollbar, .fullimage_grid::-webkit-scrollbar {
                display: none;
            }
            
            .fullimage{
                width:100%;
                text-align:center;
            }
            .fullimage img{
                width: 96%;
                /*max-height: 500px;*/
                /*height: 100%;*/
                border: 5px solid #fff;
                border-radius: 5px;
                box-shadow: 0px 0px 5px 0px #ababab;
                margin: 5px;
            }
            .fullimage h2{
                font-size:16px;
                font-weight:500;
                color: #fff;
                line-height: 20px;
                padding: 5px 6px;
            }
            .fullimage h3{
                color: #fff;
                line-height: 20px;
                padding: 5px 6px 10px;
                font-size: 14px;
            }
        </style>
    </head>
    
    <body>
		
    	<div id="container" class="min-width">
    		<div id="head-line" class="clear bg" style="background-image: linear-gradient(#E3E3E4, #FEFEFE);">
    			<div class="left">
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
    			    <select class="inputCombo" name="country">
    					<option value="co">Country</option>
    				</select> &nbsp; | &nbsp; 
    				
    				<select class="inputCombo" name="lang">
    					<option value="en">English</option>
    				</select>
    			</div><!-- #head-line .right -->
    		</div><!-- #head-line -->
    		<!-- Old header -->

    		
    		<header style="height:32px;text-align:center;">
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
    						<ul class="clear">
    							<li class="down">
    								<a href="#">Account</a>
                                    <ul></ul>
    							</li>
    							<li><a href="#">User&nbsp;</a></li>
    							<li class="down">
    								<a href="#">Nick Name&nbsp;</a>
    								<ul></ul>
    							</li>
    							<li><a href="#">Profil</a></li>
    						</ul>
    						<div class="refresh"><a href="#refresh"></a></div>
    						<div class="options">
    							<div class="overflow"></div>
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
    					</div>
    					<!-- options -->
    					<ul class="buttons">
    						<li><a><span class="icon home left">&nbsp;</span><span class="rline">&nbsp;</span><span class="icon down">&nbsp;</span></a></li>
    						<li><a><span class="icon home">&nbsp;</span></a></li>
    						<li><a><span class="icon print">&nbsp;</span></a></li>
    						<li><a><span class="icon star">&nbsp;</span></a></li>
    					</ul>
    					<div style="display: flex;width:auto;padding-left:5px;">
                            <div class="search-bar">
                            	<form action="" method="get" style="display:flex;width: 289px;">
                            		<input class="inputSubmit" type="submit" value="">
                            		<input class="inputText" type="text" name="search" value="" placeholder="Search Bar">
                            	</form><i></i>
                            </div>
                        </div>
    				</div>
    			</div>
    		</div>
    		
    	</div>
		



		
		<div id="body" class="clear">
            <!-- #body .middle -->
			<div class="middle">
				<div class="block">
					<h2 class="bg">Image</h2>
					<div style="padding:px 0px 0px 8px;">
        				<div style="margin:auto;display:block;">
        				    <!--   <img src="https://loghin.com/logo.png" style="max-width: 400px;width: 100%;margin-left:138px;"> -->
        				    <div class="image_container">
                        	    <div class="fullimage_grid">
                            		<div class="fullimage_col">
                            			<img src="./templates/images/Tavola-disegno-2-100.jpg">
                            			<p>Lorem Ipsum este pur şi simplu...</p>
                            		</div>
                            		<div class="fullimage_col">
                            			<img src="./templates/images/Tavola-disegno-4-100.jpg">
                            			<p>Lorem Ipsum este pur şi simplu...</p>
                            		</div>
                            		<div class="fullimage_col">
                            			<img src="./templates/images/Tavola-disegno-5-100.jpg">
                            			<p>Lorem Ipsum este pur şi simplu...</p>
                            		</div>
                            		<div class="fullimage_col">
                            			<img src="./templates/images/Tavola-disegno-6-100.jpg">
                            			<p>Lorem Ipsum este pur şi simplu...</p>
                            		</div>
                            		<div class="fullimage_col">
                            			<img src="./templates/images/Tavola-disegno-7-100.jpg">
                            			<p>Lorem Ipsum este pur şi simplu...</p>
                            		</div>
                            		<div class="fullimage_col">
                            			<img src="./templates/images/Tavola-disegno-11-100.jpg">
                            			<p>Lorem Ipsum este pur şi simplu...</p>
                            		</div>
                            		<div class="fullimage_col">
                            			<img src="./templates/images/Tavola-disegno-2-100.jpg">
                            			<p>Lorem Ipsum este pur şi simplu...</p>
                            		</div>
                            		<div class="fullimage_col">
                            			<img src="./templates/images/Tavola-disegno-4-100.jpg">
                            			<p>Lorem Ipsum este pur şi simplu...</p>
                            		</div>
                            		<div class="fullimage_col">
                            			<img src="./templates/images/Tavola-disegno-2-100.jpg">
                            			<p>Lorem Ipsum este pur şi simplu...</p>
                            		</div>
                            		<div class="fullimage_col">
                            			<img src="./templates/images/Tavola-disegno-4-100.jpg">
                            			<p>Lorem Ipsum este pur şi simplu...</p>
                            		</div>
                            		<div class="fullimage_col">
                            			<img src="./templates/images/Tavola-disegno-5-100.jpg">
                            			<p>Lorem Ipsum este pur şi simplu...</p>
                            		</div>
                            		<div class="fullimage_col">
                            			<img src="./templates/images/Tavola-disegno-6-100.jpg">
                            			<p>Lorem Ipsum este pur şi simplu...</p>
                            		</div>
                            		
                            		<div class="fullimage_col">
                            			<img src="./templates/images/Tavola-disegno-7-100.jpg">
                            			<p>Lorem Ipsum este pur şi simplu...</p>
                            		</div>
                            		<div class="fullimage_col">
                            			<img src="./templates/images/Tavola-disegno-11-100.jpg">
                            			<p>Lorem Ipsum este pur şi simplu...</p>
                            		</div>
                            		<div class="fullimage_col">
                            			<img src="./templates/images/Tavola-disegno-2-100.jpg">
                            			<p>Lorem Ipsum este pur şi simplu...</p>
                            		</div>
                            		<div class="fullimage_col">
                            			<img src="./templates/images/Tavola-disegno-4-100.jpg">
                            			<p>Lorem Ipsum este pur şi simplu...</p>
                            		</div>
                            		<div class="fullimage_col">
                            			<img src="./templates/images/Tavola-disegno-2-100.jpg">
                            			<p>Lorem Ipsum este pur şi simplu...</p>
                            		</div>
                            		<div class="fullimage_col">
                            			<img src="./templates/images/Tavola-disegno-4-100.jpg">
                            			<p>Lorem Ipsum este pur şi simplu...</p>
                            		</div>
                            		<div class="fullimage_col">
                            			<img src="./templates/images/Tavola-disegno-5-100.jpg">
                            			<p>Lorem Ipsum este pur şi simplu...</p>
                            		</div>
                            		<div class="fullimage_col">
                            			<img src="./templates/images/Tavola-disegno-6-100.jpg">
                            			<p>Lorem Ipsum este pur şi simplu...</p>
                            		</div>
                            	</div>
                            	
                            	<div class="fullimage-box">
                            	    <div class="fullimage">
                            	        <div class="clear" style="text-align:right;display: flex;justify-content: flex-end;padding-top:5px;padding-bottom:2px;border-bottom: 0px;padding-right: 1.5%;">
                    					   <a class="backButton" href="#">Back</a>
                    					   <div class="prevNext clear">
                        						<a class="left" href="#">Previous</a>
                        						<a class="right" href="#">Next</a>
                        					</div>
                    					</div>
                            	        <img src="./templates/images/Tavola-disegno-11-100.jpg">
                            	        <div style="display: flex;align-items: center;">
                                            <div style="width: 80%;float: left;">
                                                <h2>Lorem Ipsum je demonstrativní výplňový text používaný v tiskařském a knihařském průmyslu. Lorem Ipsum je považováno za standard v této oblasti už od začátku 16...</h2>
                                            </div>
                                            <button style="width: 20%;float: left;display: block;height: 35px;    max-width: 105px;">VISIT</button>
                                        </div>
                                	    <h3>
                                	        Lorem Ipsum je demonstrativní | výplňový text používaný v | tiskařském a knihařském průmyslu | Lorem Ipsum je považováno za...
                                	    </h3>
                            	    </div>
                            	    
                            	    <div class="fullimage_col">
                            			<img src="./templates/images/Tavola-disegno-2-100.jpg">
                            			<p style="color:#fff;">Lorem Ipsum este pur şi simplu...</p>
                            		</div>
                            		<div class="fullimage_col">
                            			<img src="./templates/images/Tavola-disegno-4-100.jpg">
                            			<p style="color:#fff;">Lorem Ipsum este pur şi simplu...</p>
                            		</div>
                            		<div class="fullimage_col">
                            			<img src="./templates/images/Tavola-disegno-5-100.jpg">
                            			<p style="color:#fff;">Lorem Ipsum este pur şi simplu...</p>
                            		</div>
                            		<div class="fullimage_col">
                            			<img src="./templates/images/Tavola-disegno-6-100.jpg">
                            			<p style="color:#fff;">Lorem Ipsum este pur şi simplu...</p>
                            		</div>
                            	</div>
                            </div>
            			</div>
					</div>
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