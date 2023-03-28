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
class Login
{
	// ========================================================================
	function Check($urls = array(), $fields = '', $corect = array(), $content_filter = array())
	{
		// $urls['auth'] = 'http://www.site.com/login.php';// adresa de autentificare
		// $fields = 'userfield=nume&passwordfield=parola&submit=logare';// valorile post trimise
		// $corect['tip'] = exact|fragment;// daca raspunsul este exact sau se cauta un fragment anume
		// $corect['value'] = 'succesful';// valoarea cautata
		// $content_filter['trim'] = 1; // elimina spatiul de la inceput si de la sfarsit
		// $content_filter['strip_tags'] = 0; // elimina tagurile
		//
		// DEFAULT
		if(!isset($urls['auth'])) $urls['auth'] = '';
		if(!isset($corect['tip'])) $corect['tip'] = 'exact';
		if(!isset($corect['value'])) $corect['value'] = '';
		if(!isset($content_filter['trim'])) $content_filter['trim'] = 1;
		if(!isset($content_filter['strip_tags'])) $content_filter['strip_tags'] = 0;
		//
		//  EXECUTIE
		$ch=curl_init();// initiere
		curl_setopt($ch, CURLOPT_URL, $urls['auth']);
		curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-GB; rv:1.8.1.6) Gecko/20070725 Firefox/2.0.0.6');// Simularea browser-ului web Mozilla Firefox. 
		curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);// Se seteaza pe fals verificatorul SSL a persoanei. 
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);// Se seteaza cu valoarea 2 verificatorul SSL a hostului. 
		curl_setopt($ch, CURLOPT_HEADER, false);// Se seteaza pe adevarat, pentru afisarea head-erului curent (la executare). 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, false);// Se seteaza pe true, pentru a nu afisa nimic dupa executare, doar la apelarea ei prin functie de afisare (print/echo); 
		curl_setopt($ch, CURLOPT_COOKIEFILE, 'cookies.txt');// Unde va salva el cookie-urile. 
		curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookie.txt');// Unde va salva el arhivele de cookie-uri. 
		curl_setopt($ch, CURLOPT_CAINFO, getcwd() . "/CAcerts/BuiltinObjectToken-EquifaxSecureCA.crt");
		curl_setopt($ch, CURLOPT_URL, $urls['auth']);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
		ob_start();// prevent any output
		curl_exec($ch); // executare comanda
		curl_close($ch);// inchidere
		$content = ob_get_contents();// stocare continut
		ob_end_clean();// stop preventing output
		unset($ch);// stergere
		//
		// FILTRAM CONTINUTUL
		if($content_filter['trim'] == 1)
			$content = trim($content);
		if($content_filter['strip_tags'] == 1)
			$content = strip_tags($content);
		//
		// INTERPRETARE RASPUNS PRIMIT
		$raspuns = FALSE;
		if($corect['tip'] == 'exact')
		{
			if($content == $corect['value'])
				$raspuns = TRUE;
		}
		else
		if($corect['tip'] == 'fragment')
		{
			$e = @explode($corect['value'], $content);
			if(count($e) > 1)
				$raspuns = TRUE;
		}
	}
	// ========================================================================
}
?>