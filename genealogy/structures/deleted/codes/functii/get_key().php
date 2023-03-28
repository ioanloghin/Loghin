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
/* ----------------------------------------------------------------------------------------------------------------------- */
function get_key($string) // date('N')
{
	// lista cu caractere care se inlocuiesc
	$replace_array = array(
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
    foreach($replace_array as $litera => $inlocuire)
		$string = str_replace($litera, $inlocuire, $string);
    // se converteste numele in litere mici si se scot spatiile de la inceput si sfarsit
	$string = trim(strtolower($string));
    // se convertesc spatiile in -
	$string = str_replace(' ', '-', $string);
    // se convertesc eventualele caractere speciale
	$string = rawurlencode($string);
    // se returneaza gata aranjat pentru a fi introdus in link
	$string = str_replace('%', '', $string);
	
	return strtolower($string);
}
/* ----------------------------------------------------------------------------------------------------------------------- */
?>