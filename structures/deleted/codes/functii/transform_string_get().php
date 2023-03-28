<?php
// ANTIHACK verificare access din exterior
if(!defined('ANTIHACK'))
{
	header('HTTP/1.0 403 Forbidden');
	header('Status: 403 Forbidden');
	die(include_once("../../module/e_403.php"));
}
//
//
//
/* --- start --- Transformare string pentru get ---------------------------------- */
function transform_string_get($nume) // date('N')
   {
   // lista cu caractere care se inlocuiesc
   $lista_car = array(
        '&#259;' => 'a',
        '&icirc;' => 'i',
        '&acirc;' => 'a',
        '&#351;' => 's',
        '&#355;' => 't',
        '&#258;' => 'A',
        '&Icirc;' => 'I',
        '&Acirc;' => 'A',
        '&#350;' => 'S',
        '&#354;' => 'T',
        ',' => '',
        '- ' => '', // situatie 'test - test'
        '.' => '',
        '  ' => '', // situatie 'test  test'
        '?' => '',
        '!' => '',
        '[' => '',
        ']' => '',
        '(' => '',
		'%' => '',
        ')' => '',
        '{' => '',
        '}' => '',
        '|' => '',
        '#' => '',
		"'" => '',
		"%" => '',
        '&nbsp;' => '',
        );
    // se inlocuiesc caracterele nepermise
    foreach ($lista_car as $litera=>$inlocuire)
        $nume = str_replace($litera, $inlocuire, $nume);
    // se converteste numele in litere mici si se scot spatiile de la inceput si sfarsit
        $nume = trim(strtolower($nume));
    // se convertesc spatiile in -
        $nume = str_replace(' ', '-', $nume);
    // se convertesc eventualele caractere speciale
        $nume = rawurlencode($nume);
    // se returneaza gata aranjat pentru a fi introdus in link
	$nume = str_replace('%', '', $nume);
	
    return strtolower($nume);
   }
/* --- end ----- Transformare string pentru get ---------------------------------- */
?>