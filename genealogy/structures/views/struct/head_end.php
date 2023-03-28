<?php
echo style(template, 'pages/struct.css')."\n";
echo style(template, 'modules/advanced_search.css')."\n";

echo script(template, 'harmony/jquery.ui.js')."\n";
echo script(template, 'harmony/mouseWheel.js')."\n";
echo script(template, 'harmony/scroll.js')."\n";
echo script(template, 'fancybox/fancybox.js')."\n";
echo script(template, 'harmony/misc.js')."\n";
?>
<script type="text/javascript">$.conf = { 'path': "<?php echo SITE_ROOT;?>" };</script>
<?php
echo script('harmony', 'AG_Interaction.js')."\n";
echo script('harmony', 'jquery_ui/jquery.ui.core.js')."\n";
echo script('harmony', 'jquery_ui/jquery.ui.widget.js')."\n";
echo script('harmony', 'jquery_ui/jquery.ui.mouse.js')."\n";
echo script('harmony', 'jquery_ui/jquery.ui.draggable.js')."\n";
?>
<script type="text/javascript">
$(function() {
    //$( "#draggable" ).draggable({ handle: "p" });
    $( "#AGDynamic" ).draggable({ cancel: "div.ag_userbox, div.ag_tagbox" });
    //$( "div, p" ).disableSelection();
});

$(document).ready(function() {
	$('.down_bar').on('click', function() {
		$(this).parent().find('.extend').show();
	});
	$('.extend > .post_bar').on('click', function() {
		$(this).parent().hide();
	});
});
</script>
</head>

<body>