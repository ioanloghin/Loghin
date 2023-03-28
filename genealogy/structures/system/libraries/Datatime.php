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
class DataTime
{
	// ========================================================================
	function add_day($data, $nr_add)
	{
		return date('Y-m-d', strtotime($data)+(1*60*60*24*$nr_add));
	}
	// ========================================================================
	//
	//
	// ========================================================================
	function date_dif($iniDate, $endDate) 
    {
		$iniDate = explode("-",$iniDate);
		$endDate = explode("-",$endDate);
		$start_date = gregoriantojd($iniDate[1], $iniDate[2], $iniDate[0]);
		$end_date = gregoriantojd($endDate[1], $endDate[2], $endDate[0]);
		$dif = $end_date - $start_date;
		return $dif;
    }
	// ========================================================================
	//
	//
	// ========================================================================
	function ago($data = 'Y-m-d')
	{
		$print = NULL;
		
		// cate zile sunt intre 2 date
		$data_1 = date('Y-m-d', time());
		$data_2 = $data;
		$dif = DataTime::date_dif($data_1, $data_2);
		$zile = str_replace('-', '', $dif);
		
		
		// in urma cu ....
		if ($dif <= -365)
		{
			$ani = floor($zile / 365);
			$print = ($ani > 1) ? $ani.' ani' : 'un an';
			$rest = floor(($zile - ($ani*365)) / 30);
			if ($rest > 0)
			    $print .= ' &#351;i '.$rest.' luni';
		}
		elseif ($dif <= -30)
		{
			$luni = floor(($zile)/30);
			$print = ($luni > 1) ? $luni.' luni' : 'o lun&#259;';
			$rest = $zile - ($luni * 30);
			if ($rest > 0)
			    $print .= ' &#351;i '.$rest.' zile';
		}
		elseif ($dif <= -2)
		{
			$print = ($zile > 1) ? $zile.' zile' : 'o zi';
		}
		
		return $print;
	}
	// ========================================================================
	//
	//
	// ========================================================================
	function format($data = '0000-00-00', $format = 'Y-m-d')
	{
		if ($data != NULL)
			return date($format, strtotime($data));
		else
			return NULL;
	}
	// ========================================================================
	//
	//
	// ========================================================================
	function nume_zi($numar_zi) // date('w')
	{
		$print = NULL;
		switch ($numar_zi)
		{
			case 1: $print = 'Luni'; break;
			case 2: $print = 'Marti'; break;
			case 3: $print = 'Miercuri'; break;
			case 4: $print = 'Joi'; break;
			case 5: $print = 'Vineri'; break;
			case 6: $print = 'Sambata'; break;
			case 7: $print = 'Duminica'; break;
		}
		return $print;
	}
	// ========================================================================
	//
	//
	// ========================================================================
	function nume_luna($numar_luna) // date('N')
	{
		$print = NULL;
		switch ($numar_luna)
		{
			case '01': $print = 'Ianuarie'; break;
			case '02': $print = 'Februarie'; break;
			case '03': $print = 'Martie'; break;
			case '04': $print = 'Aprilie'; break;
			case '05': $print = 'Mai'; break;
			case '06': $print = 'Iunie'; break;
			case '07': $print = 'Iulie'; break;
			case '08': $print = 'August'; break;
			case '09': $print = 'Septembrie'; break;
			case '10': $print = 'Octombrie'; break;
			case '11': $print = 'Noiembrie'; break;
			case '12': $print = 'Decembrie'; break;
		}
		return $print;
	}
	// ========================================================================
	//
	//
	// ========================================================================
	function age($data)
	{
		$zile = DataTime::date_dif($data, date('Y-m-d'));
		$age = floor($zile/365.25);
		return $age;
	}
	// ========================================================================
}
?>