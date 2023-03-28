<?php  if ( ! defined('ANTIHACK')) exit('No direct script access allowed');

class CO_Section extends CO_Plan
{
	// identifiers
	private $plan;		// (integer) id-ul planului
	private $id;		// (integer) id-ul sectiei curente
	private $superior;	// (integer) id-ul sectiei superioare
	public  $section_left; // (integer) id-ul sectiei paralele cu aceasta (cea din stanga)
	// attributes
	private $label;		// (string) titlul sectorului
	private $border;	// (boolean) TRUE - va avea bordura
	private $color = 0; // (enum(0, 1, 2, 3, 4, 5)) culoarea de fundal, 0 = fara culoare
	// dimensions
	public  $width		= 0; // (integer) latimea containerului
	public  $height		= 0; // (integer) inaltimea containerului
	public  $left		= 0; // (integer) coordonata X in raport cu box-ul familiei
	public  $top		= 0; // (integer) coordonata Y in raport cu box-ul familiei
	private $lr_padd	= 40; // (integer) padding lateral (padding left + padding right)
	private $full_width	= 0; // (integer) latimea + padding + border
	// contained
	static $divisions	= array(); // (array(id => instance,)) referinte catre obiectele divizie
	//
	// ========================================================================
	public function __construct($plan, $id, $superior = 0, $label = NULL, $border = FALSE, $color = 0)
	{
		// ne asiguram ca $id este numar intreg
		$id = (int)$id;
		// verificam daca este diferit de zero
		if(!$id)
			die('ID-ul nu poate fi zero. (Eroare la crearea unei sectiuni)');
		// verificam unicitatea
		elseif(isset(parent::$sections[$id]))
			die('Sectia cu id = '.$id.' mai exista o data.');
		
		// salvam datele in variabilele obiectului
		$this->plan			= (int)$plan;
		$this->id			= (int)$id;
		$this->superior		= (int)$superior;
		$this->label		= $label;
		$this->border		= $border;
		$this->color		= (int)$color;
		$this->section_left = NULL;
		// modificam formatul datelor
		settype($this->border, 'bool');
		
		// extragem datele din baza de date
		$records = SQL_DB::sql_select("co_divisions", "`SectionID` = '".$this->id."'", NULL, 0, 0, array('DivisionID', 'DivisionSuperior', 'Aspect'));
		$db_key = array(); $db_sup = array(); $db_inf = array();
		foreach($records as $key => $record)
		{
			$db_key[$record['DivisionID']] = $key;
			$db_sup[$record['DivisionID']] = (int)$record['DivisionSuperior'];
			$db_inf[$record['DivisionSuperior']][] = $record['DivisionID'];
		}
		
		// ordonam sectiile dupa superioritate (0 - cel mai superior, n - cel mai inferior)
		$ordered_ids = $this->ordering_superior($db_sup);
		
		$max_width = 0;
		foreach($ordered_ids as $division_id)
		{
			// initializam divizile
			self::$divisions[$this->id][$division_id] = new CO_Division($this->plan, $this->id, $division_id, $records[$db_key[$division_id]]['DivisionSuperior'], $records[$db_key[$division_id]]['Aspect']);
			// determinam aspectul
			if($records[$db_key[$division_id]]['DivisionSuperior'] || $superior)
			{
				//end(self::$divisions[$this->id])->aspect = 1;
				end(self::$divisions[$this->id])->p_top  = 20;
			}
			
			// stabilim latimea maxima a unei divizi
			$max_width = (end(self::$divisions[$this->id])->get('width') > $max_width) ? end(self::$divisions[$this->id])->get('width') : $max_width;
		}
		// stabilim inaltimea sectiei in functie de inaltimile divizilor
		foreach($db_inf as $inferiors)
		{
			// prin max_height determinam inaltimea maxima a unor divizi paralele (aflate pe acelasi rand)
			$max_height = 0;
			foreach($inferiors as $inferior)
			{
				$current_height = self::$divisions[$id][$inferior]->get('height') + self::$divisions[$id][$inferior]->get('p_top');
				if($max_height < $current_height)
					$max_height = $current_height;
			}
			// adunam inaltimea fiecarei divizii
			$this->height += $max_height;
		}
		// TODO: trebuie luat in calcul situatia cu divizi paralele
		// iar divizile nu vor avea latimea maxima daca sunt paralele
		foreach(self::$divisions[$this->id] as $division)
		{
			// setam fiecare divizie la latimea maxima
			$division->width = $max_width;
			// aranjam joburile in toate divizile
			$division->jobs_formatting();
		}
		// setam latimea pentru sectie
		$this->width = $max_width;
		// calculam latimea totala
		$this->full_width = $this->width + $this->lr_padd + (($this->border) ? 2 : 0);
	}
	// ========================================================================
	//
	//
	// ========================================================================
	public function setXY()
	{
		// setY
		if(isset(parent::$sections[$this->plan][$this->superior]))
			$this->top = /* inaltime box */ parent::$sections[$this->plan][$this->superior]->get('height') +
						 /* margin top */ parent::$sections[$this->plan][$this->superior]->get('top') +
						 /* padding box */ 20 +
						 /* border box */ ((parent::$sections[$this->plan][$this->superior]->get('border')) ? 2 : 0) +
						 /* spatiu distanta */ 20;
		// setX
		if($this->section_left)
			$this->left += /* margin left */ parent::$sections[$this->plan][$this->section_left]->get('left') +
						   /* latimea totala */ parent::$sections[$this->plan][$this->section_left]->get('full_width') +
						   /* spatiu distanta */ 10;
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
	private function subordinated()
	{
		$subordinated = array();
		$subLefts = array();// lista cu margin left a tuturor sectilor subordonate
		// vom rula toate sectile pentru a putea extrage sectile subordonate
		foreach(parent::$sections[$this->plan] as $section)
		{
			// important: $subordinated[0] este rezervat pentru sectia curenta
			// daca vreuna din sectile subordonate au id = 0 atunci aceasta va fi suprascris mai jos (ceea ce nu este corect)
			// oricum, id-ul este verificat la crearea obiectului si trebuie sa fie diferit de zero
			if($section->get('superior') == $this->id)
			{
				$subordinated[$section->get('id')] = intval($section->get('full_width')/2) + $section->get('left');
				$subLefts[$section->get('id')] = $section->get('left');
			}
		}
		// daca sectia curenta are sectii subordonate 
		if($subordinated)
		{
			// ordonam crescator margine left al sectilor subordonate pentru a putea extrage valoarea minima si maxima
			asort($subLefts);
			$min = current($subLefts);// TODO sa luam in calcul si cazul in care margin left a sectiei curente e mai mica decat asta
			$min_id = key($subLefts);
			$max = end($subLefts);
			$max_id = key($subLefts);
			// calculam latimea box-ului de legaturi
			$subWidth = (
						/* latimea totala a sectiei "max" */parent::$sections[$this->plan][$max_id]->get('full_width') +
						/* margin left a sectiei "max" */$max
						) -
						/* cea mai mica margin left */$min;
			// nu poate fi mai mica decat latimea sectiei curente
			if($subWidth < $this->width)
				$subWidth = $this->width;
			else
			// daca box-ul de legaturi este mai mare
			// centram sectia curenta dupa box-ul de legaturi
				$this->left = $min + intval( $subWidth / 2 ) - intval( $this->width / 2 );
			
			// adaugam si linia pentru sectia curenta
			$subordinated[0] = intval( $this->full_width / 2 ) + $this->left;
			
			// margin top pentru box-ul de legaturi
			$subTop = /* margin top a sectiei curente */ $this->top +
					  /* inaltimea sectiei curente */ $this->height +
					  /* bordura sectiei curente */ (($this->border) ? 2 : 0) +
					  /* inaltimea box-ului de legaturi */ 20;
			
			// vom afisa un box ce contine linile (legaturile grafice) catre acestea
			//print '<pre>'; print_r($subWidth); print '</pre>';
			
			// linile pentru legaturile dintre sectiuni
			$lines_up = $subordinated[0];// valoarea pe axa OX
			unset($subordinated[0]);
			$lines_down = implode(',', $subordinated);// valoarea pe axa OX
			
			$background = ROOT.'models/gd2_co_section_links.php?w='.$subWidth;
			$background .= '&amp;h=20';
			$background .= '&amp;up='.$lines_up;
			$background .= '&amp;down='.$lines_down;
			
			return '<div class="subordinated" style="width:'.$subWidth.'px; margin-top:'.$subTop.'px; margin-left:'.$min.'px; background-image:url('.$background.');"></div>';
		}
	}
	// ========================================================================
	//
	//
	// ========================================================================
	public function HTMLcode()
	{
		// selectam id-ul sectiei din stanga (pentru sectile paralele)
		$left_id = ($this->section_left) ? $this->section_left : 0;
		// sectii subordonate
		$subHTML = $this->subordinated();
		// style
		$style = 'margin-top:'.$this->top.'px;';
		$style .= 'margin-left:'.$this->left.'px;';
		$style .= 'border-width:'.($this->border ? 1 : 0).'px;';
		$style .= 'background-color:'.($this->color ? '#C9D89C' : 'none').';';
		
		// descridem sectia curenta (cod HTML)
		$html_code = '<div class="sections rad5'.($this->color ? ' color' : '').'" style="'.$style.'">';
		// adaugam codul HTML pentru fiecare divizie continuta de sectia curenta
		foreach(self::$divisions[$this->id] as $division)
			if($division->get('section') == $this->id)
				$html_code .= $division->HTMLcode();
		
		// inchidem sectia curenta (cod HTML)
		$html_code .= '</div>';
		// adaugam continutul HTML al box-ului de legaturi
		$html_code .= $subHTML;
		
		// daca nu are sectie superioara (daca este prima)
		if(!$this->superior)
			$html_code .= '<div class="cboth"></div>';
		
		
		return $html_code;
	}
	// ========================================================================
	//
	//
	// ========================================================================
	public function timeline($blockID)
	{
		// selectam id-ul sectiei din stanga (pentru sectile paralele)
		$left_id = ($this->section_left) ? $this->section_left : 0;
		// sectii subordonate
		$subHTML = $this->subordinated();
		// style
		$style = 'margin-top:'.$this->top.'px;';
		$style .= 'margin-left:'.$this->left.'px;';
		$style .= 'border-width:'.($this->border ? 1 : 0).'px;';
		$style .= 'background-color:'.($this->color ? '#C9D89C' : 'none').';';
		
		// descridem sectia curenta (cod HTML)
		$html_code = '<div class="sections rad5'.($this->color ? ' color' : '').'" style="'.$style.'">';
		// adaugam codul HTML pentru fiecare divizie continuta de sectia curenta
		foreach(self::$divisions[$this->id] as $division)
			if($division->get('section') == $this->id)
			{
				$html_code .= $division->timeline($blockID);
				break;
			}
		
		// inchidem sectia curenta (cod HTML)
		$html_code .= '</div>';
		// adaugam continutul HTML al box-ului de legaturi
		$html_code .= $subHTML;
		
		// daca nu are sectie superioara (daca este prima)
		if(!$this->superior)
			$html_code .= '<div class="cboth"></div>';
		
		
		return $html_code;
	}
	// ========================================================================
}
//
//
// END CO_Section class

/* End of file CO_Section.php */
/* Location: ./libraries/CO_Section.php */
?>