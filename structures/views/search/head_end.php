<?php
echo style(template, 'pages/search.css')."\n";

echo script(template, 'harmony/jquery.js')."\n";
echo script(template, 'harmony/jquery.ui.js')."\n";
echo script(template, 'harmony/mouseWheel.js')."\n";
echo script(template, 'harmony/scroll.js')."\n";
echo script(template, 'fancybox/fancybox.js')."\n";
echo script(template, 'harmony/misc.js')."\n";
?>
<script type="text/javascript">$.conf = { 'path': "<?php echo SITE_ROOT;?>" };</script>
</head>

<body>
<div id="AG_PageMask" onclick="quickEditUser('close', 0)"></div>