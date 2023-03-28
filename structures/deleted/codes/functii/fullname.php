<?php
function fullname($firstname, $lastname, $limit)
{
	$fullname_maxleght = $limit;
	$db_nume = $firstname;
	$db_prenume = $lastname;
	$fullname = $db_nume.' '.$db_prenume;
	$strlen_fullname = strlen($fullname);
	if($strlen_fullname > $fullname_maxleght) $fullname = substr($db_nume, 0, 1).'. '.$db_prenume;
	$strlen_fullname = strlen($fullname);
	if($strlen_fullname > $fullname_maxleght)
	{
		$e = explode(" ", $db_prenume);
		if(count($e) > 1)
		{
			$first_prenume = $e[0];
			$rest_prenume = str_replace($first_prenume." ", '', $db_prenume);
			$fullname = substr($db_nume, 0, 1).'. '.substr($first_prenume, 0, 1).'. '.$rest_prenume;
		}
		else
		{
			$diff = $strlen_fullname - $fullname_maxleght;
			$fullname = substr($db_nume, 0, 1).'. '.substr($db_prenume, 0, $diff).'.';
		}
	}
	$strlen_fullname = strlen($fullname);
	
	return $fullname;
}
?>