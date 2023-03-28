<script type="text/javascript">
var disabled = new Array();
disabled[1] = false;
disabled[2] = false;

function add_box(type, this_but)
{
	// afisam iconul de loading
	$('#LoaderIcon').css({visibility: "visible"});
	
	// pastram continutul deja existent
	var current_content = $('#FamilyMembers').html();
	var new_content = current_content;
	
	// preluam prin ajax continutul suplimentar
	if(window.XMLHttpRequest) ajax = new XMLHttpRequest();
	else if(window.ActiveXObject) ajax = new ActiveXObject("Microsoft.XMLHTTP");
	
	var sURL = ROOT+'models/CreateTreeFamilyMembers.php?type=1';// se verifica userul
	
	ajax.open("GET", sURL, false);
	ajax.setRequestHeader("User-Agent", navigator.userAgent);
	ajax.send();
	
	if(ajax.status == 200) var ajaxReturn = ajax.responseText;
	else var ajaxReturn = null;
	
	// adaugam continutul suplimentar
	new_content += ajaxReturn;
	$('#FamilyMembers').html(new_content);
	
	// disable pentru butonul apelat
	this_but.addClass('opacity40 cDefault');
	this_but.find('button').attr('disabled', 'disabled').addClass('cDefault');
	disabled[type] = true;
	
	// ascundem iconul de loading
	$('#LoaderIcon').css({visibility: "hidden"});
}

$(document).ready(function() {
	$("#AddAsc").click(function () { if(!disabled[1]) add_box(1, $(this)); });
	$("#AddDesc").click(function () { if(!disabled[2]) add_box(2, $(this)); });
	
	// actiunea de extindere si afisare a submeniului
	$(".column_list .node").click(function() {
		// verificam daca este vizibil continutul extins si setam clasa pentru buton
		if($(this).find('.more').is(":visible"))
			$(this).removeClass('expanded');
		else
			$(this).addClass('expanded');
		// operam show/hide continut extins
		$(this).find('.more').toggle();
	});
	// end actiuni pentru continut extins
});
</script>
</head>

<body>
<div id="AG_PageMask" onclick="quickEditUser('close', 0)"></div>