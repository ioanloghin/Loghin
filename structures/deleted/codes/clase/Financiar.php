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
class Financiar
{
	// conversie din lei in valuta
	function lei_valuta($pret = 0, $cotatie = 0) {
		$lei = $pret / $cotatie;
		return round($lei);
	}
	// conversie din valuta in lei
	function valuta_lei($pret = 0, $cotatie = 0) {
		$valuta = $pret * $cotatie;
		return round($valuta);
	}
	// conversie din valuta 1 in valuta 1
	function valuta_valuta($pret = 0, $cotatie1 = 0, $cotatie2 = 0) {
		$lei = $pret / $cotatie1;
		$valuta = $lei * $cotatie2;
		return round($valuta);
	}
}
?>