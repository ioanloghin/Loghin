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
/* --- start --- Afisare in acelasi format --------------------------------------- */
function format_text($string) {
    $ret = '';
    for ($i = 0, $l = strlen($string); $i < $l; ++$i) {
        $o = ord($string[$i]);
        if ($o < 31 || $o > 126) {
            switch ($o) {
                case 9: $ret .= '\t'; break;
                case 10: $ret .= '<br />'; break; // BR
                case 11: $ret .= '\v'; break;
                case 12: $ret .= '\f'; break;
                case 13: $ret .= ''; break; // BR
                default: $ret .= '\x' . str_pad(dechex($o), 2, '0', STR_PAD_LEFT);
            }
        } else {
            switch ($o) {
                case 36: $ret .= '\$'; break;
                case 34: $ret .= ''; break; // La inceput si la sfarsit
                case 92: $ret .= '\\\\'; break;
                default: $ret .= $string[$i];
            }
        }
    }
    return $ret . '';
}
/* --- end ----- Afisare in acelasi format --------------------------------------- */
?>