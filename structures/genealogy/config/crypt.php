<?php
// ANTIHACK verificare access din exterior ------------------------------------------------------------------------------- //
if(!defined('ANTIHACK'))
{
	header('HTTP/1.0 403 Forbidden');
	header('Status: 403 Forbidden');
	die(include("../module/e_403.php"));
}
//------------------------------------------------------------------------------------------------------------------------ //
//
// --- Default ----------------------------------------------------------------------------------------------------------- //
	if(!isset($_SESSION[SITE_ROOT])) $_SESSION[SITE_ROOT] = base64_encode("ADRYRO".rand(1000,9999));
	define("SESSION", base64_decode($_SESSION[SITE_ROOT]));
	//
	// se creaza key
	$d = base64_encode(date('mYd'));
	$u = 'o4g6h1ja6sd47bdf98';// cod unic specific fiecarul proiect in parte
	$i = base64_encode($_SERVER['REMOTE_ADDR']);
	$gen = md5($d.$u.$i);
	define('KEY', $gen);
//------------------------------------------------------------------------------------------------------------------------ //
?>