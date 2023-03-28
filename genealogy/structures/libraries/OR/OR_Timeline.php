<?php  if ( ! defined('ANTIHACK')) exit('No direct script access allowed');

class OR_Timeline
{
	// identifiers
	private $projectID;		// (integer) id-ul planului
	private $blockID;		// (integer) id-ul blocuui
	// attributes
	private $label; 		// denumirea postului
	// dimensions
	private $width		= 0; // (integer) latimea containerului
	private $height		= 0; // (integer) inaltimea containerului
	// contained
	private $workers	= array(); // (INDEX => array(ID, DATA_START, DATA_END)) 
	//
	// ========================================================================
	public function __construct($projectID, $blockID)
	{
		// salvam datele in variabilele obiectului
		$this->projectID = (int)$projectID;
		$this->blockID	 = (int)$blockID;
		
		// extragem datele din baza de date despre acest block
		$temp = SQL_DB::sql_select("co_jobs", "`JobID` = '".$this->blockID."'", NULL, 0, 1);
		$this->label	 = (isset($temp[1]['FunctionName'])) ? $temp[1]['FunctionName'] : NULL;
		
		// genereaza intreg lantul de persoane
		$this->workers[] = array(27,  '2003-05-23', '2005-01-22');
		$this->workers[] = array(28,  '2002-05-23', '2003-01-22');
		$this->workers[] = array(29, '2001-01-23', '2002-01-22');
		$this->workers[] = array(78,  '2000-08-11', '2001-01-22');
		
		$this->width	 = 400;
		$this->height	 = 1000;
	}
	// ========================================================================
	//
	//
	// ========================================================================
	public function HTMLcode()
	{
		$html_code = '<div id="CO_Plan" style="width:'.$this->width.'px; height:'.$this->height.'px;">';
		$html_code .= '<h1 style="font-size:24px; margin-left:0">'.$this->label.' <span style="color:#999; font-size:14px; line-height:14px;">(2001-2003)</span></h1>';
		$html_code .= '<div class="timeline-period"><span class="point">23 mai 2003</span><span style="margin-top:176px;" class="point">23 mai 2002</span><span style="margin-top:178px;" class="point">23 ian 2001</span><span style="margin-top:177px;" class="point">11 aug 2000</span></div>';
		
			foreach($this->workers as $index => $worker)
				$html_code .= $this->html_worker($index, $worker[0], $worker[1], $worker[2]);
		
		$html_code .= '</div>';
		return $html_code;
	}
	// ========================================================================
	//
	//
	// ========================================================================
	function html_worker($index, $id, $data_start, $data_end)
	{
		$temp = SQL_DB::sql_select("gen_users_details", "`UserID` = '$id'", NULL, 0, 1);
		$html_code = NULL;
		if(isset($temp[1]))
		{
			$html_code = '<div id="personal'.$id.'" class="personal" style="width:340px; height:160px; margin-top:'.($index*160+$index*20+20).'px;">';
			$html_code .= '<header>'.$data_start.' - '.$data_end.'</header>';
			$html_code .= '<div class="content">';
			$html_code .= '<div class="image"><img src="'.base_url($temp[1]['image']).'" alt="" /></div>';
			$html_code .= '<div class="info"><span class="name">'.$temp[1]['firstname'].' '.$temp[1]['lastname'].'</span><dl class="clear"><dt>Email</dt><dd>ioan'.($index+1).'@gmail.com</dd><dt>Phone</dt><dd>074'.($index+1).'******</dd><dt>Substitute</dt><dd>Marian Mic'.($index+1).'</dd></dl></div>';
			$html_code .= '</div>';
			$html_code .= '<div class="down click-extend">';
			$html_code .= '<div class="extend"><div class="post_bar">Fisa posturilor</div><ul><li><a href="">Ing. Sef Serviciul Proiectare</a></li><li><a href="">Ing. Sef Serviciul Proiectare</a></li><li><a href="">Ing. Sef Serviciul Proiectare</a></li></ul></div>';
			$html_code .= '<a class="down_bar" href="#" onclick="return false;"><span class="icon">&nbsp;</span></a>';
			$html_code .= '</div>';
			$html_code .= '</div>';
		}
		return $html_code;
	}
	// ========================================================================
}
//
//
// END OR_Timeline class

/* End of file OR_Timeline.php */
/* Location: ./libraries/OR/OR_Timeline.php */