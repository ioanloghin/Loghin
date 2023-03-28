<meta charset="utf-8">
<meta name="description" content="">
<meta name="author" content="Scotch">

<title>{{ $title }}</title>
{{ HTML::script('assets/js/jquery-1.11.2.min.js'); }}
{{ HTML::style('assets/css/app.css'); }}
{{ HTML::style('assets/css/user_bar.css'); }}
<script type="text/javascript" src="http://structures.loghin.com/views/templates/harmony/js/jquery_ui/jquery-1.7.1.js"></script>
<script>
var ROOT = '/';
<!-- js config -->
var conf = {
	'PATH': "/",
	'cssPath': "/views/templates/harmony/css",
	'picPath': "/views/templates/harmony/images",
	'loggedin': "0"
};
</script>
<script type="text/javascript" src="http://structures.loghin.com/views/templates/harmony/js/harmony/jquery.ui.js"></script>
<script type="text/javascript" src="http://structures.loghin.com/views/templates/harmony/js/harmony/mouseWheel.js"></script>
<script type="text/javascript" src="http://structures.loghin.com/views/templates/harmony/js/harmony/scroll.js"></script>
<script type="text/javascript" src="http://structures.loghin.com/views/templates/harmony/js/fancybox/fancybox.js"></script>
<script type="text/javascript" src="http://structures.loghin.com/views/templates/harmony/js/harmony/misc.js"></script>
<script type="text/javascript">$.conf = { 'path': "http://structures.loghin.com/bara_useri/" };</script>
<style>
.animated { 
   -webkit-animation-duration: 1s; 
   animation-duration: 1s; 
   -webkit-animation-fill-mode: both; 
   animation-fill-mode: both; 
} 
@-webkit-keyframes fadeInDown { 
    0% { 
        opacity: 0; 
        -webkit-transform: translateY(-20px); 
    } 
    100% { 
        opacity: 1; 
        -webkit-transform: translateY(0); 
    } 
} 
@keyframes fadeInDown { 
    0% { 
        opacity: 0; 
        transform: translateY(-20px); 
    } 
    100% { 
        opacity: 1; 
        transform: translateY(0); 
    } 
} 
.fadeInDown { 
    -webkit-animation-name: fadeInDown; 
    animation-name: fadeInDown; 
}
@-webkit-keyframes fadeInUp { 
    0% { 
        opacity: 0; 
        -webkit-transform: translateY(20px); 
    } 
    100% { 
        opacity: 1; 
        -webkit-transform: translateY(0); 
    } 
} 

@keyframes fadeInUp { 
    0% { 
        opacity: 0; 
        transform: translateY(20px); 
    } 
    100% { 
        opacity: 1; 
        transform: translateY(0); 
    } 
} 

.fadeInUp { 
    -webkit-animation-name: fadeInUp; 
    animation-name: fadeInUp; 
}


@-webkit-keyframes bounceIn { 
    0% { 
        opacity: 0; 
        -webkit-transform: scale(.3); 
    } 

    50% { 
        opacity: 1; 
        -webkit-transform: scale(1.05); 
    } 

    70% { 
        -webkit-transform: scale(.9); 
    } 

    100% { 
         -webkit-transform: scale(1); 
    } 
} 

@keyframes bounceIn { 
    0% { 
        opacity: 0; 
        transform: scale(.3); 
    } 

    50% { 
        opacity: 1; 
        transform: scale(1.05); 
    } 

    70% { 
        transform: scale(.9); 
    } 

    100% { 
        transform: scale(1); 
    } 
} 

.bounceIn { 
    -webkit-animation-name: bounceIn; 
    animation-name: bounceIn; 
}

.anim_delay1p2 {-webkit-animation-delay: 0.5s; /* Chrome, Safari, Opera */animation-delay: 0.5s;	}
.boxs{background:#EEE;text-align:center;color:#999;font-size:3em;font-style:italic;z-index:-1;position:relative;}
</style>