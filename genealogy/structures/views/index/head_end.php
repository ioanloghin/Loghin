<?php
/* pentru calendar
detalii optiuni pe : http://jqueryui.com/demos/datepicker/ */
echo style('harmony', 'calendary.css')."\n";

// theme 1
if(isset($theme))
	echo style('harmony', 'themes/'.$theme.'.css')."\n";

echo script('harmony', 'index.js')."\n";
echo script('harmony', 'jquery_ui/jquery.ui.core.js')."\n";
echo script('harmony', 'jquery_ui/jquery.ui.datepicker.js')."\n";
?>
<script type="text/javascript">
$(function() {
    $("#datepicker").datepicker({
        showWeek: true,
        firstDay: 1,
        dayNamesMin: ['Du', 'Lu', 'Ma', 'Mi', 'Jo', 'Vi', 'Sa'],
        dayNamesShort: ['Dum', 'Lun', 'Mar', 'Mie', 'Joi', 'Vin', 'Sam'],
        dayNames: ['Duminica', 'Luni', 'Marti', 'Miercuri', 'Joi', 'Vineri', 'Sambata'],
        monthNamesShort: ['Ian','Feb','Mar','Apr','Mai','Iun','Iul','Aug','Sep','Oct','Noi','Dec'],
        monthNames: ['Januarie','Februarie','Martie','Aprilie','Mai','Iunie','Iulie','August','Septembrie','Octombrie','Noiembrie','Decembrie'],
        weekHeader: '&nbsp;',
        autoSize: false,
        nextText: '',
        prevText: '',
        changeYear: false
    });
});
</script>
</head>

<body>