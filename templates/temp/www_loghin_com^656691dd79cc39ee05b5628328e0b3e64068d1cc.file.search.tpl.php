<?php /* Smarty version Smarty-3.1.7, created on 2022-12-26 18:20:40
         compiled from "/home/loghin/public_html/templates/search.tpl" */ ?>
<?php /*%%SmartyHeaderCode:11035955126320a7da40ac89-73017903%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '656691dd79cc39ee05b5628328e0b3e64068d1cc' => 
    array (
      0 => '/home/loghin/public_html/templates/search.tpl',
      1 => 1669990527,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '11035955126320a7da40ac89-73017903',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_6320a7da4a0cb',
  'variables' => 
  array (
    'vir_path' => 0,
    'item1' => 0,
    'itemss' => 0,
    'item' => 0,
    'items' => 0,
    'systemMenus' => 0,
    'menu' => 0,
    '_menu' => 0,
    'item_group' => 0,
    'group' => 0,
    'showRightInfo' => 0,
    'center' => 0,
    'vir_pic_path' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_6320a7da4a0cb')) {function content_6320a7da4a0cb($_smarty_tpl) {?><?php if (!is_callable('smarty_function_stylesheets')) include '/home/loghin/sources/!core/plugins/function.stylesheets.php';
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
        
        
        /* SEARCH PAGE */
        #sResLeft {}
        #sResLeft h3 {
          padding: 0 5px;
          position: relative;
          font-family: Tahoma, Geneva, sans-serif;
          font-size: 13px;
          color: #333333;
        }
        #sResLeft h3 a {
          background: url(lColPlusMinus.png) no-repeat 0 0;
          display: block;
          width: 9px;
          height: 10px;
          position: absolute;
          top: 5px;
          right: 5px;
          text-indent: -999em;
        }
        #sResLeft .opened h3 a {
          background-position: -11px 0;
        }
        #sResLeft ul {
          padding: 7px 10px 0 10px;
        }
        #sResLeft li {
          background: url(sResLeftBool.png) no-repeat left center;
          padding: 1px 0 4px 13px;
        }
        #sResLeft li a {
          font-family: Tahoma, Geneva, sans-serif;
          font-size: 11px;
          color: #333333;
        }
        #sResLeft li a:hover {
          text-decoration: underline;
          color: #1c63b3;
        }
        #sResLeft .select {
          padding: 10px 10px 0 12px;
        }
        #sResLeft .select .inputCombo {
          width: 160px;
          height: 20px;
          font-family: Tahoma, Geneva, sans-serif;
          font-size: 11px;
          color: #808080;
          border: 1px solid #d4d4d4;
        }
        #sResLeft .radio {
        }
        #sResLeft .radio h4 {
          padding: 5px;
          font-family: Tahoma, Geneva, sans-serif;
          font-size: 11px;
          font-weight: bold;
          color: #1d62a4;
        }
        #sResLeft .radio .inputRadio {
          display: block;
          float: left;
        }
        #sResLeft .radio label {
          display: block;
          padding: 3px 0 2px 4px;
          float: left;
          font-family: Tahoma, Geneva, sans-serif;
          font-size: 11px;
          color: #1d62a4;
        }
        #sResLeft .inputGo {
          background: url(inputSearchGo.png) no-repeat;
          display: block;
          width: 29px;
          height: 21px;
          margin: 10px 0 0 3px;
          cursor: pointer;
          border: 0;
        }
        #sResRight {
        }
        #sResRight h2 a {
          color: #095ba6 !important;
        }
        .sResRigInfo {
          padding: 10px 0;
        }
        .sResRigInfo p {
          font-size: 11px;
          color: #333333;
        }
        .sResRigOptions {
          background: #ecf7ff;
          height: 24px;
          margin-top: 5px;
          margin-bottom: 10px;
          padding: 2px 1px;
          border: 1px solid #91c0e2;
          border-width: 1px 0;
        }
        .sResRigOptions ul {
        }
        .sResRigOptions li {
          padding-right: 5px;
          float: left;
          height: unset !important;
          padding-top: unset !important;
        }
        .sResRigOptions li a,
        .sResRigOptions li a i {
          background: url("https://accounts.loghin.com/templates/media/sResRigOptionsBg.png") no-repeat;
          display: block;
        }
        .sResRigOptions li a {
          background-position: 0 0;
          height: 17px;
          padding: 7px 10px 2px;
          position: relative;
          font-size: 11px;
          font-weight: bold;
          color: #333333;
        }
        .sResRigOptions li a i {
          background-position: top right;
          width: 5px;
          height: 26px;
          position: absolute;
          top: 0;
          right: 0;
        }
        .sResRigOptions li a:hover {
          text-decoration: none;
          color: #1c63b3;
        }
        .sResRigOptions li.selected a {
          background-position: 0 -34px;
          color: #1c63b3;
        }
        .sResRigOptions li.selected a i {
          background-position: right -34px;
        }
        .sResRigOptions .inputText {
          width: 120px;
          height: 20px;
          margin-right: 5px;
          float: right;
        }
        .sResRigOptions .inputCombo {
          width: 95px;
          height: 24px;
          margin-right: 5px;
          float: right;
        }
        .sResRigOptions .inputSearch {
          background: url("https://accounts.loghin.com/templates/media/sInputSearch.png") no-repeat;
          display: block;
          width: 53px;
          height: 23px;
          float: right;
          cursor: pointer;
          border: 0;
        }
        .sResOrders {
          padding: 0 0 5px;
        }
        .sResOrders li {
          width: 140px;
          padding: 0 10px;
          float: left;
        }
        .sResOrders .sResOrdLeft {
          width: 420px;
        }
        .sResOrders li a {
          font-size: 11px;
          color: #262626;
        }
        
        .sResRigFeatured,
        .sResRigFeatured i {
          background: url(sResFeatured.png) no-repeat;
        }
        .sResRigFeatured {
          background-position: 0 0;
          height: 14px;
          margin-left: 5px;
          padding: 3px 10px 0 !important;
          position: relative;
          z-index: 2;
          float: left;
          font-family: Arial, Helvetica, sans-serif;
          font-size: 10px !important;
          font-weight: bold;
          text-transform: uppercase;
          color: #ffffff !important;
        }
        .sResRigFeatured i {
          background-position: right top;
          display: block;
          width: 5px;
          height: 17px;
          position: absolute;
          top: 0;
          right: 0;
        }
        .sResRigBlock {
          margin-bottom: 5px;
        }
        .sResRigBlock .brd-md {
          background-color: #ffffff;
          padding: 0;
          position: relative; /*;z-index:2*/
        }
        .sResRigBlock .brd-blue {
          border: 1px solid #91c0e2;
        }
        .sResRigBlock .brd-orange {
          border: 1px solid #e98f09;
        }
        .sResRigBlock .brd-tp,
        .sResRigBlock .brd-bt {
          height: 4px;
          margin-bottom: -4px;
          position: relative;
          z-index: 3;
        }
        .sResRigBlock .brd-l {
          width: 3px;
          height: 3px;
          position: relative;
        }
        .sResRigBlock .brd-r {
          width: 3px;
          height: 3px;
          position: relative;
          float: right;
        }
        .sResRigBlock .brd-tp {
        }
        /* Blue */
        .sResRigBlock .brd-tp .brdB-l {
          background-position: -53px 0;
        }
        .sResRigBlock .brd-tp .brdB-r {
          background-position: -57px 0;
        }
        /* Orange */
        .sResRigBlock .brd-tp .brdO-l {
          background-position: -62px 0;
        }
        .sResRigBlock .brd-tp .brdO-r {
          background-position: -66px 0;
        }
        .sResRigBlock .brd-bt {
          top: -3px;
        }
        /* Blue */
        .sResRigBlock .brd-bt .brdB-l {
          background-position: -53px -4px;
        }
        .sResRigBlock .brd-bt .brdB-r {
          background-position: -57px -4px;
        }
        .sResRigBlock .brd-bt .brdBs-l {
          background-position: -53px -8px;
        }
        .sResRigBlock .brd-bt .brdBs-r {
          background-position: -57px -8px;
        }
        /* Orange */
        .sResRigBlock .brd-bt .brdO-l {
          background-position: -62px -4px;
        }
        .sResRigBlock .brd-bt .brdO-r {
          background-position: -66px -4px;
        }
        .sResRigBlock .brd-bt .brdOs-l {
          background-position: -62px -8px;
        }
        .sResRigBlock .brd-bt .brdOs-r {
          background-position: -66px -8px;
        }
        .sResInfo{
            display:flex !important;
        }
        .sResInfoLeft {
          width: 40%;
          border-right: 1px solid #d7ebf9;
        }
        .brd-blue .sResInfoLeft {
          border-right: 1px solid #d7ebf9;
        }
        .brd-orange .sResInfoLeft {
          border-right: 1px solid #f7ebc1;
        }
        .sResInfoLeft .left {
          width: 60px;
        }
        .sResInfoLeft .left img {
          display: block;
          margin: 0 auto;
        }
        .sResInfoLeft .left input {
          display: block;
          margin: 10px auto 0;
        }
        .sResInfoLeft .right {
          width: 100%;
        }
        .sResInfoLeft .right h2 {
          padding: 2px 0 10px;
          font-weight:bold;
          font-style: italic;
          font-size:16px;
        }
        .sResInfoLeft .right h2 a {
          font-family: Arial, Helvetica, sans-serif;
          font-size: 15px;
          color: #1c63b3;
        }
        .sResInfoLeft .right p,
        .sResInfoLeft .right p a {
          font-size: 11px;
          color: #333333;
          font-style: italic;
          font-weight: bold;
        }
        .sResInfoCenter {
          width: 30%;
        }
        .brd-blue .sResInfoCenter {
          border-right: 1px solid #d7ebf9;
          font-style: italic;
          font-weight: bold;
        }
        .brd-orange .sResInfoCenter {
          border-right: 1px solid #f7ebc1;
        }
        .sResInfoCenter li {
          padding: 5px 10px;
          font-size: 11px;
          color: #222222;
          height: auto !important;
          padding-top: unset !important;
        }
        .sResInfoRight {
          width: 140px;
        }
        .sResInfoRight dt,
        .sResInfoRight dd {
          padding: 5px 0;
          font-size: 11px;
        }
        .sResInfoRight dt {
          width: 54px;
          float: left;
          color: #222222;
        }
        .sResInfoRight dd {
          width: 85px;
          float: left;
          font-weight: bold;
          color: #1c63b3;
        }
        .sResInfoRight dd b.left {
          margin-top: 3px;
        }
        .sResInfoRight dd span.left {
          padding: 1px 0 0 5px;
        }
        .sResInfoLeft,
        .sResInfoCenter,
        .sResInfoRight {
          padding: 10px;
          float: left;
          height: 70px;
        }
        
        .sResInfoFooter {
          height: 20px;
          padding: 4px 10px 0;
          position: relative;
        }
        .brd-blue .sResInfoFooter {
          background: url("https://accounts.loghin.com/templates/media/sResInfoFooter.png") repeat-x;
          border-top: 1px solid #91c0e2;
        }
        .brd-orange .sResInfoFooter {
          background: url("https://accounts.loghin.com/templates/media/sResInfoFooterFeat.png") repeat-x;
          border-top: 1px solid #e98f09;
        }
        .sResInfoFooter ul {
          padding: 0 0 0 40px;
        }
        .sResInfoFooter li,
        .footTextInfo li {
          float: left;
        }
        .sResInfoFooter li.line,
        .footTextInfo li.line {
          padding: 3px 0 3px;
          font-size: 11px;
          font-weight: bold;
        }
        .sResInfoFooter li a,
        .footTextInfo li a {
          display: block;
          padding: 4px 6px 3px;
          font-size: 11px;
          font-weight: bold;
        }
        .sResInfoFooter li a.selected,
        .footTextInfo li a.selected,
        .footTextInfo li:hover a.sub,
        .footTextInfo li a.sub:hover {
          background-color: #ffffff;
          margin-bottom: -1px;
          position: relative;
          z-index: 9;
        }
        .sResInfoFooter li a.selected b,
        .sResInfoFooter li a.selected i,
        .footTextInfo li a.selected b,
        .footTextInfo li a.selected i,
        .footTextInfo li:hover a.sub b,
        .footTextInfo li:hover a.sub i,
        .footTextInfo li a.sub:hover b,
        .footTextInfo li a.sub:hover i {
          display: block;
          width: 4px;
          height: 4px;
          top: -1px;
        }
        .sResInfoFooter li a.selected b,
        .footTextInfo li a.selected b,
        .footTextInfo li:hover a.sub b,
        .footTextInfo li a.sub:hover b {
          left: -1px;
        }
        .sResInfoFooter li a.selected i,
        .footTextInfo li a.selected i,
        .footTextInfo li:hover a.sub i,
        .footTextInfo li a.sub:hover i {
          right: -1px;
        }
        .brd-blue .sResInfoFooter li a.selected b,
        .footTextInfo li a.selected b,
        .footTextInfo li:hover a.sub b,
        .footTextInfo li a.sub:hover b {
          background-position: -71px 0;
        }
        .brd-blue .sResInfoFooter li a.selected i,
        .footTextInfo li a.selected i,
        .footTextInfo li:hover a.sub i,
        .footTextInfo li a.sub:hover i {
          background-position: -76px 0;
        }
        .brd-orange .sResInfoFooter li a.selected b {
          background-position: -71px -5px;
        }
        .brd-orange .sResInfoFooter li a.selected i {
          background-position: -76px -5px;
        }
        .brd-blue .sResInfoFooter li a.selected,
        .footTextInfo li a.selected,
        .footTextInfo li:hover a.sub,
        .footTextInfo li a.sub:hover {
          padding: 3px 5px 4px;
          border: 1px solid #91c0e2;
          border-width: 1px 1px 0 1px;
        }
        .brd-orange .sResInfoFooter li a.selected {
          border: 1px solid #e98f09;
          border-width: 1px 1px 0 1px;
        }
        .brd-blue .sResInfoFooter li.line,
        .footTextInfo li.line,
        .brd-blue .sResInfoFooter li a,
        .footTextInfo li a {
          color: #1c63b3;
        }
        .brd-orange .sResInfoFooter li.line,
        .brd-orange .sResInfoFooter li a {
          color: #e98f09;
        }
        .pagination{
            font-size: 13px;
            font-style: italic;
            font-weight: 600;
            float:left;
            width:100%;
        }
        .pagination a {
            color: #095ba6;
        }
        .middle .block{
            width:65%;
            float:left;
        }
        .side-result{
            width:35%;
            float:left;
        }
        .side-result-body{
            background: #f9f9f9;
            position: relative;
            border-radius: 0 0 3px 3px;
            border-width: 0 1px 1px;
            border-style: solid;
            border-color: #93a4b3;
            margin-left:2px;
            margin-bottom: 5px;
            height: 952px;
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
        
        /*search_filter*/
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
        header {
            background: url(https://loghin.com/templates/media/loghin/header_bg.png) repeat-x;
            padding: 6px 10px 0px;
        }
        .nav100 .icon {
            background: url(https://loghin.com/templates/images/application/icons.png) no-repeat transparent;
        }
        .nav100 > .gradient {
            border-top: 0px;
            padding-top: 1px;
        }
        
        /*loghin system menu*/
        #body > .left .menu > li > ul > li > ul > li > ul{
            padding-left:25px;
        }
        #body > .left .menu > li > ul > li > ul > li:focus > ul{
            display: block;
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
        .side-result h2.bg{
            background-position: 0 -27px !important;
            height: 33px;
            padding: 1px 10px 0;
            position: relative;
            font: italic bold 14px/33px verdana;
            color: #ffffff;
            border-radius: 3px 3px 0 0;
            border-width: 0 1px;
            border-style: solid;
            border-color: #3267a3;
        }
        .backButton {
            background: url('https://accounts.loghin.com/templates/media/backButton.png') no-repeat;
            display: block;
            width: 73px;
            height: 28px;
            float: left;
            color: transparent;
        }
        .prevNext {
            background: url('https://accounts.loghin.com/templates/media/prevNextButton.png') no-repeat;
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
					      <option value="">Country</option>
					       <?php  $_smarty_tpl->tpl_vars['itemss'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['itemss']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['item1']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['itemss']->key => $_smarty_tpl->tpl_vars['itemss']->value){
$_smarty_tpl->tpl_vars['itemss']->_loop = true;
?>
					       
					    	 <option value="<?php echo $_smarty_tpl->tpl_vars['itemss']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['itemss']->value['name'];?>
</option>
							<?php } ?>
					</select>
					
					&nbsp;|&nbsp;
					
					<select class="inputCombo" name="language">
					    	<option value="">Language</option>
					     <?php  $_smarty_tpl->tpl_vars['items'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['items']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['item']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['items']->key => $_smarty_tpl->tpl_vars['items']->value){
$_smarty_tpl->tpl_vars['items']->_loop = true;
?>
					
						<option value="<?php echo $_smarty_tpl->tpl_vars['items']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['items']->value['language'];?>
</option>
						<?php } ?>
					</select>
					
				</div>
    			
    			<div class="right">
    			  
    			</div><!-- #head-line .right -->
    		</div><!-- #head-line -->
    		
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
    					<div style="display: flex;width:auto;padding-left:5px;">
                            <!--<ul class="rightNav">
                                <li><a href="http://register.loghin.com/teenagers/"><strong>Teenagers</strong></a></li>
                                <li><a href="http://register.loghin.com/adults/"><strong>Adults</strong></a></li>
                                <li><a href="http://register.loghin.com/business/"><strong>Business</strong></a></li>
                                <li><a href="http://register.loghin.com/institutions/"><strong>Institutions</strong></a></li>
                            </ul>-->
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
		



		
		<div id="body" class="clear search s-over">
		<div class="left">
		    	<ul class="menu">
					<li class="selected opened">
						<a href="#">Loghin System</a>
						<ul>
						    	<?php  $_smarty_tpl->tpl_vars['menu'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['menu']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['systemMenus']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['menu']->key => $_smarty_tpl->tpl_vars['menu']->value){
$_smarty_tpl->tpl_vars['menu']->_loop = true;
?>
						    	    	<?php if ($_smarty_tpl->tpl_vars['menu']->value['type']!='left'){?>
						    <li class="home">
						        
								<a href="#"><span class="icon"> </span><?php echo $_smarty_tpl->tpl_vars['menu']->value['name'];?>
</a>
									<?php if ($_smarty_tpl->tpl_vars['menu']->value['items']){?>
                    				<ul>
                    					<?php  $_smarty_tpl->tpl_vars['_menu'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['_menu']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['menu']->value['items']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['_menu']->key => $_smarty_tpl->tpl_vars['_menu']->value){
$_smarty_tpl->tpl_vars['_menu']->_loop = true;
?>
                    						<li>
                    						    <a data-id="<?php echo $_smarty_tpl->tpl_vars['_menu']->key;?>
" href="#"><?php echo $_smarty_tpl->tpl_vars['_menu']->value;?>
</a>
                    						        <?php  $_smarty_tpl->tpl_vars['group'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['group']->_loop = false;
 $_smarty_tpl->tpl_vars['group_id'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['item_group']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['group']->key => $_smarty_tpl->tpl_vars['group']->value){
$_smarty_tpl->tpl_vars['group']->_loop = true;
 $_smarty_tpl->tpl_vars['group_id']->value = $_smarty_tpl->tpl_vars['group']->key;
?>
                    						           <?php if ($_smarty_tpl->tpl_vars['group']->value['menu_id']==$_smarty_tpl->tpl_vars['_menu']->key){?>
                                                        <li>
                                                            <a data-id="<?php echo $_smarty_tpl->tpl_vars['group']->key;?>
" href="#" style="color:black;margin-left:20px;"><?php echo $_smarty_tpl->tpl_vars['group']->value['name'];?>
</a>
                                                                
                                                          </li>
                                                        <?php }?>
                                                    <?php } ?>
                    						    
                    						  </li>
                    					<?php } ?>
                    				</ul>
                    				<?php }?>
								<span class="has icon"> </span>
							</li>
						<?php }?>
							<?php } ?>
						</ul>
						<span class="has icon"> </span>
					</li>
					
					<li class="selected">
						<a href="#">Loghin Users</a>
						<ul>
						    <?php  $_smarty_tpl->tpl_vars['menu'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['menu']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['systemMenus']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['menu']->key => $_smarty_tpl->tpl_vars['menu']->value){
$_smarty_tpl->tpl_vars['menu']->_loop = true;
?>
						    	<?php if ($_smarty_tpl->tpl_vars['menu']->value['type']=='left'){?>
						    <li class="home">
								<a href="#"><span class="icon"> </span><?php echo $_smarty_tpl->tpl_vars['menu']->value['name'];?>
</a>
									<?php if ($_smarty_tpl->tpl_vars['menu']->value['items']){?>
								<ul>
                    					<?php  $_smarty_tpl->tpl_vars['_menu'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['_menu']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['menu']->value['items']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['_menu']->key => $_smarty_tpl->tpl_vars['_menu']->value){
$_smarty_tpl->tpl_vars['_menu']->_loop = true;
?>
                    						<li>
                    						    <a data-id="<?php echo $_smarty_tpl->tpl_vars['_menu']->key;?>
" href="#"><?php echo $_smarty_tpl->tpl_vars['_menu']->value;?>
</a>
                    						        <?php  $_smarty_tpl->tpl_vars['group'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['group']->_loop = false;
 $_smarty_tpl->tpl_vars['group_id'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['item_group']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['group']->key => $_smarty_tpl->tpl_vars['group']->value){
$_smarty_tpl->tpl_vars['group']->_loop = true;
 $_smarty_tpl->tpl_vars['group_id']->value = $_smarty_tpl->tpl_vars['group']->key;
?>
                    						           <?php if ($_smarty_tpl->tpl_vars['group']->value['menu_id']==$_smarty_tpl->tpl_vars['_menu']->key){?>
                                                        <li>
                                                            <a data-id="<?php echo $_smarty_tpl->tpl_vars['group']->key;?>
" href="#" style="color:black;margin-left:20px;"><?php echo $_smarty_tpl->tpl_vars['group']->value['name'];?>
</a>
                                                                
                                                          </li>
                                                        <?php }?>
                                                    <?php } ?>
                    						    
                    						 </li>
                    					<?php } ?>
                    				</ul>
								<?php }?>
								<span class="has icon"> </span>
							</li>
								<?php }?>
							<?php } ?>
						</ul>
						<span class="has icon"> </span>
					</li>
					
					<!--<div id="header" style="background: none;display: inline-block;height: auto;padding: 0;">-->
                  <!-- <div class="width clear" style="padding: 0;width: auto;">-->
                		
                            <!--<a class="_button_" href="javascript:void(0);">System Window<i></i></a>-->
                        	<?php echo $_smarty_tpl->getSubTemplate ("plugins/system.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

                        
              <!--  		</div>-->
            		<!--</div>-->
					
					<li>
						<a href="#">Aplications</a>
						<ul>
							<li class="tag"><a href="#"><span class="icon"> </span> Lorem ipsum dolor sitamet</a></li>
							<li class="user"><a href="#"><span class="icon"> </span> Lorem ipsum dolor sitamet</a></li>
							<li class="stats last"><a href="#"><span class="icon"> </span> Lorem ipsum dolor sitamet</a></li>
						</ul>
						<span class="has icon"> </span>
					</li>
					<li><a href="#">Solutions</a></li>
				</ul><!-- #body .left .menu -->

				<div class="block">
					<h2 class="bg">Search System Options</h2>
					<div>
						<ul class="nav">
							<li>
								<h3>Category <span class="icon"> </span></h3>
								<ul>
									<li><label><input class="inputCheck" type="checkbox" name="" value="" /> Lorem ipsum dolor sitamet</label></li>
									<li><label><input class="inputCheck" type="checkbox" name="" value="" /> Lorem ipsum dolor sitamet</label></li>
									<li><label><input class="inputCheck" type="checkbox" name="" value="" /> Lorem ipsum dolor sitamet</label></li>
								</ul>
							</li>
							<li>
								<h3>Category <span class="icon"> </span></h3>
								<ul>
									<li><select class="inputCombo" name="">
										<option value="">Text</option>
									</select></li>
								</ul>
							</li>
								<li>
									<h3>Category <span class="icon"> </span></h3>
								<ul>
									<li><label><input class="inputCheck" type="radio" name="" value="" /> Lorem ipsum dolor sitamet</label></li>
									<li><label><input class="inputCheck" type="radio" name="" value="" /> Lorem ipsum dolor sitamet</label></li>
									<li><label><input class="inputCheck" type="radio" name="" value="" /> Lorem ipsum dolor sitamet</label></li>
								</ul>
							</li>
						</ul>
						<div class="buttons">
							<a class="button s-blue"><strong>Open Results</strong><i></i></a>
						</div>
					</div>
				</div><!-- #body .left .block  -->

				<div class="block-branches">
					<div class="block-nav">
						<a href="#">Library</a> &nbsp;|&nbsp;
						<a class="selected" href="#">Events</a>
					</div>
					<ul class="branches">
						<li class="opened">
							<div class="clear">
								<div class="left"><a class="icon" href="javascript:void(0);">+</a> Ramura 1</div>
								<div class="right"><a href="#">9.250 Items</a></div>
							</div>
							<ul>
								<li>
									<span class="left">Subramura:</span>
									<span class="right"><a href="#">3.250 Items</a></span>
								</li>
								<li>
									<span class="left">Subramura:</span>
									<span class="right"><a href="#">3.250 Items</a></span>
								</li>
								<li>
									<span class="left">Subramura:</span>
									<span class="right"><a href="#">3.250 Items</a></span>
								</li>
							</ul>
						</li>
						<li>
							<div class="clear">
								<div class="left"><a class="icon" href="javascript:void(0);">+</a> Ramura 1</div>
								<div class="right"><a href="#">9.250 Items</a></div>
							</div>
							<ul>
								<li>
									<span class="left">Subramura:</span>
									<span class="right"><a href="#">3.250 Items</a></span>
								</li>
								<li>
									<span class="left">Subramura:</span>
									<span class="right"><a href="#">3.250 Items</a></span>
								</li>
								<li>
									<span class="left">Subramura:</span>
									<span class="right"><a href="#">3.250 Items</a></span>
								</li>
							</ul>
						</li>
						<li>
							<div class="clear">
								<div class="left"><a class="icon" href="javascript:void(0);">+</a> Ramura 1</div>
								<div class="right"><a href="#">9.250 Items</a></div>
							</div>
							<ul>
								<li>
									<span class="left">Subramura:</span>
									<span class="right"><a href="#">3.250 Items</a></span>
								</li>
								<li>
									<span class="left">Subramura:</span>
									<span class="right"><a href="#">3.250 Items</a></span>
								</li>
								<li>
									<span class="left">Subramura:</span>
									<span class="right"><a href="#">3.250 Items</a></span>
								</li>
							</ul>
						</li>
						<li>
							<div class="clear">
								<div class="left"><a class="icon" href="javascript:void(0);">+</a> Ramura 1</div>
								<div class="right"><a href="#">9.250 Items</a></div>
							</div>
							<ul>
								<li>
									<span class="left">Subramura:</span>
									<span class="right"><a href="#">3.250 Items</a></span>
								</li>
								<li>
									<span class="left">Subramura:</span>
									<span class="right"><a href="#">3.250 Items</a></span>
								</li>
								<li>
									<span class="left">Subramura:</span>
									<span class="right"><a href="#">3.250 Items</a></span>
								</li>
							</ul>
						</li>
						<li>
							<div class="clear">
								<div class="left"><a class="icon" href="javascript:void(0);">+</a> Ramura 1</div>
								<div class="right"><a href="#">9.250 Items</a></div>
							</div>
							<ul>
								<li>
									<span class="left">Subramura:</span>
									<span class="right"><a href="#">3.250 Items</a></span>
								</li>
								<li>
									<span class="left">Subramura:</span>
									<span class="right"><a href="#">3.250 Items</a></span>
								</li>
								<li>
									<span class="left">Subramura:</span>
									<span class="right"><a href="#">3.250 Items</a></span>
								</li>
							</ul>
						</li>
						<li>
							<div class="clear">
								<div class="left"><a class="icon" href="javascript:void(0);">+</a> Ramura 1</div>
								<div class="right"><a href="#">9.250 Items</a></div>
							</div>
							<ul>
								<li>
									<span class="left">Subramura:</span>
									<span class="right"><a href="#">3.250 Items</a></span>
								</li>
								<li>
									<span class="left">Subramura:</span>
									<span class="right"><a href="#">3.250 Items</a></span>
								</li>
								<li>
									<span class="left">Subramura:</span>
									<span class="right"><a href="#">3.250 Items</a></span>
								</li>
							</ul>
						</li>
					</ul>
					<div class="buttons">
						<a class="button s-blue"><strong>Open Selected</strong><i></i></a>
					</div>
				</div>
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
					<h2 class="bg" style="border-right: 0px;border-radius: 3px 0px 0px 0;">Search Result</h2>
					<div style="height: 785px;padding:8px;">
					    <div class="clear" style="text-align:right;display: flex;justify-content: flex-end;">
					        <a class="backButton" href="#">Back</a>
					        <div class="prevNext clear">
								<a class="left" href="#">Previous</a>
								<a class="right" href="#">Next</a>
							</div>
					    </div>
					    <div class="sResRigInfo clear">
                    		<p class="left" style="font-weight: 600;font-style: italic;">Name By Layout</p>
                    		<p class="right" style="font-weight: 600;font-style: italic;">Total Results XX79 </p>
                    	</div>
                    	<div class="sResRigOptions clear">
                    		<ul class="left">
                    			<li><a href="#">Privat<i></i></a></li>
                    			<li class="selected"><a href="#">Profesional<i></i></a></li>
                    			<li><a href="#">Diverse<i></i></a></li>
                    		</ul>
                    		<div class="right clear">
                    			<input class="inputSearch" type="submit" value="">
                    			<select class="inputCombo" name="company">
                    				<option>Company</option>
                    			</select>
                    			<input class="inputText" type="text" name="keyword" value="Enter search keyword">
                    		</div>
                    	</div>
                    	<!-- Results -->
                    	<div>
                        	<div class="sResRigBlock"> 
                        		<div class="brd-tp"> 
                        			<div class="brd-r brdB-r crn"></div> 
                        			<div class="brd-l brdB-l crn"></div> 
                        		</div> 
                        		<div class="brd-md brd-blue clear"> 
                        			<div class="sResInfo clear">
                        				<div class="sResInfoLeft clear">
                        					<div class="right">
                        						<h2><a href="http://accounts.loghin.com/business/profile/"> Annalisa ABATE</a></h2>
                        						<h2>BTANLS86E49L628F</h2>
                        						<p class="keywords">
                        							<a href="#">Esperto Contabile</a>&nbsp;|
                        							<a href="#"></a>
                        						</p>
                        					</div>
                        				</div>
                        				<ul class="sResInfoCenter">
                        					<li>Corso Rosselli,  4</li>
                        					<li>Collegno  10128</li>
                        				</ul>
                        				<ul class="sResInfoCenter clear">
                        					<li>Telefon: 011 304.21.32</li>
                        					<li>Mobile: </li>
                        					<li>Mail: annalisa_abate@libero.it</li>
                        				</ul>
                        			</div>
                        			<div class="sResInfoFooter clear">
                        				<ul class="left">
                        				</ul>
                        			</div>
                        		</div> 
                        		<div class="brd-bt"> 
                        			<div class="brd-r brdBs-r crn"></div> 
                        			<div class="brd-l brdBs-l crn"></div> 
                        		</div> 
                        	</div>
                        	<div class="sResRigBlock"> 
                        		<div class="brd-tp"> 
                        			<div class="brd-r brdB-r crn"></div> 
                        			<div class="brd-l brdB-l crn"></div> 
                        		</div> 
                        		<div class="brd-md brd-blue clear"> 
                        			<div class="sResInfo clear">
                        				<div class="sResInfoLeft clear">
                        					<div class="right">
                        						<h2><a href="http://accounts.loghin.com/business/profile/"> Annalisa ABATE</a></h2>
                        						<h2>BTANLS86E49L628F</h2>
                        						<p class="keywords">
                        							<a href="#">Esperto Contabile</a>&nbsp;|
                        							<a href="#"></a>
                        						</p>
                        					</div>
                        				</div>
                        				<ul class="sResInfoCenter">
                        					<li>Corso Rosselli,  4</li>
                        					<li>Collegno  10128</li>
                        				</ul>
                        				<ul class="sResInfoCenter clear">
                        					<li>Telefon: 011 304.21.32</li>
                        					<li>Mobile: </li>
                        					<li>Mail: annalisa_abate@libero.it</li>
                        				</ul>
                        			</div>
                        			<div class="sResInfoFooter clear">
                        				<ul class="left">
                        				</ul>
                        			</div>
                        		</div> 
                        		<div class="brd-bt"> 
                        			<div class="brd-r brdBs-r crn"></div> 
                        			<div class="brd-l brdBs-l crn"></div> 
                        		</div> 
                        	</div>
                        	<div class="sResRigBlock"> 
                        		<div class="brd-tp"> 
                        			<div class="brd-r brdB-r crn"></div> 
                        			<div class="brd-l brdB-l crn"></div> 
                        		</div> 
                        		<div class="brd-md brd-blue clear"> 
                        			<div class="sResInfo clear">
                        				<div class="sResInfoLeft clear">
                        					<div class="right">
                        						<h2><a href="http://accounts.loghin.com/business/profile/"> Annalisa ABATE</a></h2>
                        						<h2>BTANLS86E49L628F</h2>
                        						<p class="keywords">
                        							<a href="#">Esperto Contabile</a>&nbsp;|
                        							<a href="#"></a>
                        						</p>
                        					</div>
                        				</div>
                        				<ul class="sResInfoCenter">
                        					<li>Corso Rosselli,  4</li>
                        					<li>Collegno  10128</li>
                        				</ul>
                        				<ul class="sResInfoCenter clear">
                        					<li>Telefon: 011 304.21.32</li>
                        					<li>Mobile: </li>
                        					<li>Mail: annalisa_abate@libero.it</li>
                        				</ul>
                        			</div>
                        			<div class="sResInfoFooter clear">
                        				<ul class="left">
                        				</ul>
                        			</div>
                        		</div> 
                        		<div class="brd-bt"> 
                        			<div class="brd-r brdBs-r crn"></div> 
                        			<div class="brd-l brdBs-l crn"></div> 
                        		</div> 
                        	</div>
                        	<div class="sResRigBlock"> 
                        		<div class="brd-tp"> 
                        			<div class="brd-r brdB-r crn"></div> 
                        			<div class="brd-l brdB-l crn"></div> 
                        		</div> 
                        		<div class="brd-md brd-blue clear"> 
                        			<div class="sResInfo clear">
                        				<div class="sResInfoLeft clear">
                        					<div class="right">
                        						<h2><a href="http://accounts.loghin.com/business/profile/"> Annalisa ABATE</a></h2>
                        						<h2>BTANLS86E49L628F</h2>
                        						<p class="keywords">
                        							<a href="#">Esperto Contabile</a>&nbsp;|
                        							<a href="#"></a>
                        						</p>
                        					</div>
                        				</div>
                        				<ul class="sResInfoCenter">
                        					<li>Corso Rosselli,  4</li>
                        					<li>Collegno  10128</li>
                        				</ul>
                        				<ul class="sResInfoCenter clear">
                        					<li>Telefon: 011 304.21.32</li>
                        					<li>Mobile: </li>
                        					<li>Mail: annalisa_abate@libero.it</li>
                        				</ul>
                        			</div>
                        			<div class="sResInfoFooter clear">
                        				<ul class="left">
                        				</ul>
                        			</div>
                        		</div> 
                        		<div class="brd-bt"> 
                        			<div class="brd-r brdBs-r crn"></div> 
                        			<div class="brd-l brdBs-l crn"></div> 
                        		</div> 
                        	</div>
                        	<div class="sResRigBlock"> 
                        		<div class="brd-tp"> 
                        			<div class="brd-r brdB-r crn"></div> 
                        			<div class="brd-l brdB-l crn"></div> 
                        		</div> 
                        		<div class="brd-md brd-blue clear"> 
                        			<div class="sResInfo clear">
                        				<div class="sResInfoLeft clear">
                        					<div class="right">
                        						<h2><a href="http://accounts.loghin.com/business/profile/"> Annalisa ABATE</a></h2>
                        						<h2>BTANLS86E49L628F</h2>
                        						<p class="keywords">
                        							<a href="#">Esperto Contabile</a>&nbsp;|
                        							<a href="#"></a>
                        						</p>
                        					</div>
                        				</div>
                        				<ul class="sResInfoCenter">
                        					<li>Corso Rosselli,  4</li>
                        					<li>Collegno  10128</li>
                        				</ul>
                        				<ul class="sResInfoCenter clear">
                        					<li>Telefon: 011 304.21.32</li>
                        					<li>Mobile: </li>
                        					<li>Mail: annalisa_abate@libero.it</li>
                        				</ul>
                        			</div>
                        			<div class="sResInfoFooter clear">
                        				<ul class="left">
                        				</ul>
                        			</div>
                        		</div> 
                        		<div class="brd-bt"> 
                        			<div class="brd-r brdBs-r crn"></div> 
                        			<div class="brd-l brdBs-l crn"></div> 
                        		</div> 
                        	</div>
                        </div>
                    	<!-- End Results -->
                    	
                    	<!-- PAGINATION -->
                    	<div class="pagination clear">
                    		<div class="left clear">
                    			Show results per page 
                    				<a href="#">10</a> / 
                    				<a href="#">20</a> / 
                    				<a href="#">50</a> 
                    		</div>
                    		<div class="right clear">
                    			<a href="#">INDEX...</a>PREV &nbsp;<strong>1</strong> &nbsp;<a href="#">2</a> &nbsp;<a href="#">NEXT</a> &nbsp;...<a href="">END</a>
                    		</div>
                    	</div>
                    	<!-- END PAGINATION -->
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
				
				<div class="side-result" style="text-align:center;">
				    <h2 class="bg" style="border-left: 0;border-radius: 0px 3px 0 0;">Detalii rezultat</h2>
                    <div class="side-result-body">
                        <img src="/loghin-di-ioa-chis.JPG">
                    </div>
                   <!-- <div class="side-result-body" style="height:300px;border-width: 1px 1px 1px;">
                    </div>
                    <div class="side-result-body" style="height:300px;border-width: 1px 1px 1px;">
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