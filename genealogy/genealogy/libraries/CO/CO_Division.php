<?php  if ( ! defined('ANTIHACK')) exit('No direct script access allowed');

class CO_Division extends CO_Section
{
	// identifiers
	private $plan;		// (integer) id-ul sectiunii de care apartine
	private $section;	// (integer) id-ul sectiunii de care apartine
	private $id;		// (integer) id-ul diviziei curente
	private $superior;	// (integer) id-ul diviziei superioare
	private $parallels;	// (array(id => instanta,)) id-urile si instantele divizilor paralele cu aceasta
	// dimensions
	public $width		= 0; // (integer) latimea containerului
	public $height		= 0; // (integer) inaltimea containerului
	public $left		= 0; // (integer) margin left
	public $top		    = 0; // (integer) margin top
	public $p_top		= 0; // (integer) padding top
	// contained
	public  $aspect;		// enum(0-no lines,1-ierarhie,2-asistent,3-agatare la dreapta) modul de aranjare al joburilor
	public $jobs = array(); // (array(id => instance,)) referinte catre obiectele job
	//
	// ========================================================================
	public function __construct($plan, $section, $id, $superior, $aspect)
	{
		// verificam unicitatea
		if(isset(parent::$divisions[$section][$id]))
			die('Divizia cu id = '.$id.' mai exista o data.');
		
		// salvam datele in variabilele obiectului
		$this->plan		= (int)$plan;
		$this->section	= (int)$section;
		$this->id		= (int)$id;
		$this->superior	= (int)$superior;
		$this->aspect	= (int)$aspect;
		
		// extragem datele din baza de date
		$jobs = SQL_DB::sql_select("co_jobs", "`DivisionID` = '".$this->id."'", NULL, 0, 0, array('JobID', 'FunctionName', 'Type'));
		
		// initializam joburile
		$job_index = 0;
		$job_max_width = 0;
		$job_max_height = 0;
		$jobs_count = count($jobs);
		foreach($jobs as $job)
		{
			// creem obiectul jobului
			$this->jobs[$job['JobID']] = new CO_Job($this->id, $job['JobID'], array(000, $job['FunctionName']), $job['Type'], $job_index++);
			// adaugam latimea jobului la latimea diviziei
			if($this->aspect == 1)
				$this->width += end($this->jobs)->width;
			if(($this->aspect == 2) || ($this->aspect == 3))
				$this->height += end($this->jobs)->height;
			
			// ii adaugam numarul maxim de joburi din divizie
			end($this->jobs)->index_max = $jobs_count;
			// stabilim latimea si inaltimea maxima a unui job
			$job_max_width = (end($this->jobs)->width > $job_max_width) ? end($this->jobs)->width : $job_max_width;
			$job_max_height = (end($this->jobs)->height > $job_max_height) ? end($this->jobs)->height : $job_max_height;
		}
		// adaugam marginile dintre joburi
		if($this->aspect == 1)
			$this->width += ($jobs_count-1)*10;
		if(($this->aspect == 2) || ($this->aspect == 3))
			$this->height += ($jobs_count-1)*10;
		
		// setam latimea si inaltimea diviziei
		if($this->aspect == 1)
			$this->height = $job_max_height;
		if(($this->aspect == 2) || ($this->aspect == 3))
			$this->width = $job_max_width /* ca sa fie pe centru linia */ * 2 /* spatiu pentru linie */ + 30;
	}
	// ========================================================================
	//
	//
	// ========================================================================
	public function parallel_add($id, $instance)
	{
		if(!isset($this->parallels[$id]))
		{
			$this->parallels[$id] = $instance;
			return true;
		}
		else
			return false;
			
	}
	// ========================================================================
	//
	//
	// ========================================================================
	public function parallel_remove($id)
	{
		if(isset($this->parallels[$id]))
		{
			unset($this->parallels[$id]);
			return true;
		}
		else
			return false;
	}
	// ========================================================================
	//
	//
	// ========================================================================
	public function jobs_formatting()
	{
		// aranjam joburile intr-un format in functie de $aspect
		foreach($this->jobs as $job)
			$job->formatting($this->aspect);
		
		// centram joburile (doar pentru $aspect == 1)
		switch($this->aspect)
		{
			case 1:
				$width_jobs = end($this->jobs)->left + end($this->jobs)->width;
				$mLeft = (int)(($this->width - $width_jobs)/2);
				foreach($this->jobs as $job)
					$job->left += $mLeft;
				break;
			case 2:
				$center = (int)($this->width/2);
				foreach($this->jobs as $job)
					$job->left += $center /* jumate din latimea totala a diviziei */ - $job->get('width') /* latimea jobului */ - 15 /* jumatate din spatiul pentru linie */;
				break;
			case 3:
				$center = (int)($this->width/2);
				foreach($this->jobs as $job)
					$job->left += $center /* latimea jobului */ + 15 /* jumatate din spatiul pentru linie */;
				break;
		}
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
	public function HTMLcode()
	{
		// numarul de joburi din divizia superioara
		$j_sup = (isset(parent::$divisions[$this->section][$this->superior])) ? count(parent::$divisions[$this->section][$this->superior]->jobs) : 0;
		// dimensiunile pentru joburile din divizia superioara
		$j_sup_dims = NULL;
		if($j_sup)
		{
			foreach(parent::$divisions[$this->section][$this->superior]->jobs as $job)
			{
				if($j_sup_dims) $j_sup_dims .= ',';
				$j_sup_dims .= $job->get('width');
			}
		}
		// daca nu are divizie superioare dar sectia are sectie superioara
		if(!$j_sup && $this->aspect) $j_sup = 1;
		
		// verificam daca este ultima divizie
		$is_last = true;
		foreach(parent::$divisions[$this->section] as $division)
		{
			if($division->get('superior') == $this->id)
			{
				$is_last = false;
				break;
			}
		}
		
		if($is_last)
		{
			// daca nu are divizii inferioare dar sectia are sectii subordonate
			// vom rula toate sectile pentru a vedea daca are sectii subordonate
			$subExists = false;
			foreach(parent::$sections[$this->plan] as $section)
			{
				if($section->get('superior') == $this->section)
				{
					$subExists = true;
					break;
				}
			}
		}
		
		// dimensiunile pentru joburile din divizia curenta
		$j_this_dims = NULL;
		foreach($this->jobs as $job)
		{
			if($j_this_dims) $j_this_dims .= ',';
			// pentru aspect 1 avem nevoie de latimile joburilor
			if($this->aspect == 1)
				$j_this_dims .= $job->get('width');
			// pentru aspect 2 si 3 avem nevoie de inaltimile joburilor
			elseif(($this->aspect == 2) || ($this->aspect == 3))
				$j_this_dims .= $job->get('height');
		}
		// linile pentru ierarhia din divizia curenta
		$background = ROOT.'models/gd2_co_division.php?w='.$this->width;
		$background .= '&amp;h='.$this->height;
		$background .= '&amp;a='.$this->aspect;
		$background .= '&amp;end_sup='.$j_sup_dims;
		$background .= '&amp;this='.$j_this_dims;
		if(!$is_last || $subExists)
			$background .= '&amp;sub=1';
		
		// codul HTML ce trebuie returnat
		$html_code = '<div class="divisions" style="width:'.$this->width.'px; height:'.$this->height.'px; background-image:url('.$background.'); padding-top:'.$this->p_top.'px;">';
		// adaugam codul HTML al joburilor
		foreach($this->jobs as $job)
			$html_code .= $job->HTMLcode();
		
		// daca este ultima divizie iar sectia are sectii subordonate afisam box-ul cu lini de sfarsit
		if($is_last && $subExists)
		{
			$background = ROOT.'models/gd2_co_division.php?w='.$this->width;
			$background .= '&amp;h=20';
			$background .= '&amp;a=1';
			$background .= '&amp;end_sup='.$j_this_dims;
			$background .= '&amp;this='.((int)($this->width/2));
			
			$html_code .= '<div class="bottom_box" style="width:'.$this->width.'px; margin-top:'.$this->height.'px; background-image:url('.$background.');"></div>';
		}
		
		// inchidem divizia
		$html_code .= '</div>';
		
		return $html_code;
	}
	// ========================================================================
}
//
//
// END CO_Division class

/* End of file CO_Division.php */
/* Location: ./libraries/CO_Division.php */