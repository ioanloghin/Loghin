<?php  if ( ! defined('ANTIHACK')) exit('No direct script access allowed');

class CO_Job extends CO_Division
{
	// identifiers
	private $division;		 // (integer) id-ul diviziei de care apartine
	private $id;	 		 // (integer) id-ul al jobului curent
	private $index;			 // (integer) numarul de ordine al jobului in divizie
	public  $index_max	= 0; // (integer) numarul de joburi din divizie
	// attributes
	private $fid;			 // (integer) id-ul functiei (ex. 1 => Director, 3 => Prodecan)
	private $label;			 // (string) o denumire personalizata pentru functie. Daca nu e suficient 'Director' si se doreste 'Director Vanzari'
							 // mai este folosita si pentru tipul 2 de job (reprezentarea unei alte organigrame) ca si eticheta
	private $type;	 		 // (enum(1,2)) 1 - job normal, 2 - shortcut catre alta organigrama
	private $zoom;	 		 // (enum(1,2)) 1 - minim, 2 - compact
	// dimensions
	public $width		= 0; // (integer) latimea containerului
	public $height		= 0; // (integer) inaltimea containerului
	public $left		= 0; // (integer) coordonata X
	public $top 		= 0; // (integer) coordonata Y
	// contained
	private $worker_width;	 // (integer) inaltimea containerului
	private $worker_height;	 // (integer) inaltimea containerului
	private $workers;		 // (array(UserID, UserID)) lista cu ocupantii postului
	//
	// ========================================================================
	public function __construct($division, $id, $function_info, $type = 1, $index = 0, $zoom = 1)
	{
		$this->zoom = (int)$zoom;
		// zoom (dimensiunea si datele afisate)
		switch($this->zoom)
		{
			case 1:// cel mai mic format (minim)
				$this->worker_width  = 80;
				$this->worker_height = 40;
				break;
			case 2:// compact
				$this->worker_width  = 70;
				$this->worker_height = 60;
				break;
		}
		
		$this->division	= $division;
		$this->id		= $id;
		$this->fid		= (isset($function_info[0]) && is_numeric($function_info[0])) ? intval($function_info[0]) : 0;
		$this->label 	= (isset($function_info[1]) && is_string($function_info[1])) ? $function_info[1] : NULL;
		$this->type		= $type;
		$this->index	= $index;
		
		switch($this->type)
		{
			case 1:
				$this->add_worker(4, NULL, "True Hoper");
				$this->width = $this->worker_width;// worker margin-left
				if($this->zoom == 2)
					$this->width += 10;// worker margin-left
				
				$this->height += $this->worker_height;
				if($this->zoom == 2)
				{
					$this->height += 18;// adaugam inaltimea etichetei cu titlul functiei
					$this->height += 10;// adaugam padding-top 5px si padding-bottom 5px
				}
				break;
			case 2:
				$this->width = 80;
				$this->height = 40;
				break;
		}
	}
	// ========================================================================
	//
	//
	// ========================================================================
	public function formatting($aspect)
	{
		switch($aspect)
		{
			case 1:
				// calculam margin-left
				$this->left = $this->width * $this->index;
				// daca nu este primul box ii adaugam margine
				$this->left += $this->index * 10;
				break;
			case 2:
			case 3:
				// calculam margin-top
				$this->top = $this->height * $this->index;
				// daca nu este primul box ii adaugam margine
				$this->top += $this->index * 10;
				break;
		}
	}
	// ========================================================================
	//
	//
	// ========================================================================
	public function add_worker($UserID, $UserImage, $UserFullname)
	{
		$this->workers[] = array(
			'id'		=> $UserID,
			'image'		=> $UserImage,
			'fullname'	=> $UserFullname,
		);
	}
	// ========================================================================
	//
	//
	// ========================================================================
	public function get($key, $default = NULL)
	{
		return (isset($this->$key)) ? $this->$key : $default;
	}
	// ========================================================================
	//
	//
	// ========================================================================
	public function align()
	{
		
	}
	// ========================================================================
	//
	//
	// ========================================================================
	public function HTMLcode()
	{
		switch($this->type)
		{
			case 1:
				$html_code = NULL;
				switch($this->zoom)
				{
					case 1:
						// ($this->height-2) in cazul in care are border
						$html_code .= '<div class="jobs zoom1 gradWhiteGloss" style="width:'.$this->width.'px; height:'.($this->height-2).'px; margin-left:'.$this->left.'px; margin-top:'.$this->top.'px;">';
						$html_code .= '<div class="job_name" style="width:'.$this->width.'px; height:'.($this->height-2).'px;">'.$this->label.'</div>';
						$html_code .= '</div>';
						break;
					case 2:
						$aar = array('calificat', 'specialist', 'expert', 'necalificat', 'in probe');
						$html_code .= '<div class="jobs zoom2 rad5" style="width:'.$this->width.'px; height:'.($this->height-2).'px; margin-left:'.$this->left.'px; margin-top:'.$this->top.'px;">';
						$html_code .= '<div class="job_name rad5-bottom">'.$this->label.'</div>';
						$html_code .= '<ul>';
						$cnt_workers = count($this->workers);
						foreach($this->workers as $worker)
						{
							$html_code .= '<li class="workers'.(($cnt_workers == 1) ? ' rad5' : '').'" style="width:'.$this->worker_width.'px; height:'.$this->worker_height.'px;">';
							$html_code .= '<div class="image"><img src="'.ROOT.'content/profile/thumbs/men_17.jpg" alt="" /></div>';
							$html_code .= '<div class="info">';
									$html_code .= '<div class="fullname">'.$worker['fullname'].'</div>';
									//$html_code .= '<div class="other">23 ani</div>';
							$html_code .= '</div>';
							$html_code .= '</li>';
						}
						$html_code .= '</ul>';
						$html_code .= '</div>';
						break;
				}
				
				break;
			case 2:
				$html_code = '<div class="shortcut gradientGreyGloss" style="width:'.$this->width.'px; height:'.($this->height-2).'px; margin-left:'.$this->left.'px; margin-top:'.$this->top.'px;">';
				$html_code .= '<span style="width:'.$this->width.'px; height:'.($this->height-2).'px;">'.$this->label.'</span>';
				$html_code .= '</div>';
				break;
		}
		
		return $html_code;
	}
	// ========================================================================
}
//
//
// END CO_Job class

/* End of file CO_Job.php */
/* Location: ./libraries/CO_Job.php */