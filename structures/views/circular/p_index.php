<?php
// initiaza obiectele
$Circular = new Circular_lib("circ01", $text, 145, "top", "Monaco-22");
$Circular2 = new Circular_lib("circ02", "World Wide Web", 160, "bottom", "Monaco-22");

// $Circular2->set_font("Monaco-22", "red", "1px 1px 2px #FFF");// optiuni avansate pentru text

// afiseaza codul css
echo $Circular->get_style();
echo $Circular2->get_style();
?>
<div id="Header">
	<div id="Logo">
		<?php
		// afiseaza codul html
		echo $Circular->get_letters();
        echo $Circular2->get_letters();
		?>
	</div>
</div>