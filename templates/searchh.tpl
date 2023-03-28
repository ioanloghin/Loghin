{strip}<!DOCTYPE HTML>
<html>
    <head>{strip}
	<meta charset="utf-8" />
	<title></title>
	<meta name="description" content="" />
	<meta name="keywords" content="" />
	<link rel="stylesheet" type="text/css" href="https://loghin.com/system/templates/media/style.css">
	<script type="text/javascript" src="https://loghin.com//js/jquery.js"></script>
	<script type="text/javascript" src="https://loghin.com/js/jquery.ui.js"></script>
	<script type="text/javascript" src="https://loghin.com/js/system/mouseWheel.js"></script>
	<script type="text/javascript" src="https://loghin.com/js/system/scroll.js"></script>
	<script type="text/javascript" src="https://loghin.com//js/system/misc.js"></script>
	{stylesheets}{scripts}
	<!--[if lt IE 9]><script type="text/javascript">document.createElement('header');document.createElement('footer');</script><![endif]-->
	<!-- /system/templates/layout.tpl -->
    {/strip}
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
            /*height: 952px;*/
            padding: 5px 5px;
        }
        .side-result-title{
            font: normal 24px/28px verdana;
            color: #032c53;
        }
        .side-result-body p {
            line-height: 26px;
            font-size: 14px;
        }
        .side-result-body button{
            padding: 8px 12px;
            margin: 5px 1px;
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
		/* .sidebar-navigation ul li ul li a:before {*/
		/*	 content: '';*/
		/*	 width: 10px;*/
		/*	 height: 1px;*/
		/*	 margin-right: 5px;*/
		/*	 display: inline-block;*/
		/*	 vertical-align: middle;*/
		/*	 background-color: #495d62;*/
		/*	 -webkit-transition: all 0.2s linear;*/
		/*	 -moz-transition: all 0.2s linear;*/
		/*	 -o-transition: all 0.2s linear;*/
		/*	 transition: all 0.2s linear;*/
		/*}*/
		 .sidebar-navigation ul li ul li:hover > a, .sidebar-navigation ul li ul li.select > a {
			 background-color:#3C80C6;
			 color: #fff;
		}
		/* .sidebar-navigation ul li ul li:hover > a:before, .sidebar-navigation ul li ul li.selected > a:before {*/
		/*	 margin-right: 10px;*/
		/*}*/
		 .sidebar-navigation ul li ul li.select.select--last > a {
			 background-color: #94aab0;
			 color: #fff;
		}
		/* .sidebar-navigation ul li ul li.selected.selected--last > a:before {*/
		/*	 background-color: #fff;*/
		/*}*/
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
		{* Header *}
    	<div id="container" class="min-width">
    		<div id="head-line" class="clear bg" style="background-image: linear-gradient(#E3E3E4, #FEFEFE);">
    			<div class="left">
    				Welcome, <a class="arrow strong" href="#">Username</a> &nbsp;|&nbsp;
    				<a href="/">Loghin.com</a> &nbsp;|&nbsp;
    				<a href="#">Loghin.us</a> &nbsp;|&nbsp;
    				<a href="{$vir_path}">System</a> &nbsp;|&nbsp;
    				<a href="{$vir_path}search/">Search</a> &nbsp;|&nbsp;
    				<a href="{$vir_path}image/">Image</a>
    			</div><!-- #head-line .left -->
    			
    			
    			
    			<div class="right">
				  
				<select class="inputCombo" name="country">
					      <option value="">Country</option>
					       {foreach $item1 AS $itemss}
					       
					    	 <option value="{$itemss.id}">{$itemss.name}</option>
							{/foreach}
					</select>
					
					&nbsp;|&nbsp;
					
					<select class="inputCombo" name="language">
					    	<option value="">Language</option>
					     {foreach $item AS $items}
					
						<option value="{$items.id}">{$items.language}</option>
						{/foreach}
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
    		