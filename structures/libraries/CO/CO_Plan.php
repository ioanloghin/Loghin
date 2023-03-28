<?php  if ( ! defined('ANTIHACK')) exit('No direct script access allowed');

class CO_Plan
{
	// identifiers
	private $id;		// (integer) id-ul planului
	// attributes
	private $type; 			 // (enum(1-standard)) tipul afisarii
	// dimensions
	private $width		= 0; // (integer) latimea containerului
	private $height		= 0; // (integer) inaltimea containerului
	// contained
	static $sections	= array(); // (array(id => instance,)) referinte catre obiectele sector
	//
	// ========================================================================
	public function __construct($id, $type = 1)
	{
		// salvam datele in variabilele obiectului
		$this->id		= $id;
		$this->type		= $type;
		
		// extragem datele din baza de date
		$records = SQL_DB::sql_select("co_sections", "`PlanID` = '1'", NULL, 0, 0, array('SectionID', 'SectionSuperior', 'Label', 'Border', 'Color'));
		$db_key = array(); $db_sup = array();
		foreach($records as $key => $record)
		{
			$db_key[$record['SectionID']] = $key;
			$db_sup[$record['SectionID']] = (int)$record['SectionSuperior'];
		}
		// ordonam sectiile dupa superioritate (0 - cel mai superior, n - cel mai inferior)
		$ordered_ids = $this->ordering_superior($db_sup);
		
		$max_width = 0;
		$coada = array();
		// initializam sectoarele
		foreach($ordered_ids as $section_id)
		{
			self::$sections[$this->id][$section_id] = new CO_Section($this->id, $section_id, $records[$db_key[$section_id]]['SectionSuperior'], $records[$db_key[$section_id]]['Label'], $records[$db_key[$section_id]]['Border'], $records[$db_key[$section_id]]['Color']);
			$max_width = (end(self::$sections[$this->id])->get('width') > $max_width) ? end(self::$sections[$this->id])->get('width') : $max_width;
			
			if(isset($coada[$records[$db_key[$section_id]]['SectionSuperior']]))
				end(self::$sections[$this->id])->section_left = $coada[$records[$db_key[$section_id]]['SectionSuperior']];
			
			$coada[$records[$db_key[$section_id]]['SectionSuperior']] = $section_id;
		}
		//print end(self::$sections[$this->id])->get('width', 'no');
		// stabilim si setam coordonatele fiecarei sectiuni
		// foarte imporant ca sectoarele sa fie ordonate
		foreach(self::$sections[$this->id] as $section)
			$section->setXY();
		// stabilim latimea planului
		$this->width += $max_width;
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
	// ordoneaza lista de elemente dupa gradul de superioritate
	// (0 - cel mai superior, n - cel mai inferior)
	protected function ordering_superior($db_sup)
	{
		$ordered_ids = array();// [order] => key section from self::$sections[$this->id]
		// creem lista cu elementele care corespund unui anumit id superior
		foreach($db_sup as $id => $sup)
			$array_sup[$sup][] = $id;
		// selectam cel mai superior element (apoi il eliminam din lista)
		$superlativ = 0;// cele mai superioare elemente au superlativ == 0; superlativ = cel mai superior
		$coada = array();// coada de asteptare
		// la fiecare iteratie selectam key cu superior == superlativ
		while(true)
		{
			if(isset($array_sup[$superlativ]))
			{
				foreach($array_sup[$superlativ] as $inferior)// selectam toate sectile care au superior == superlativ
				{
					if($superlativ != $inferior)
					{
						// setam noul superlativ
						$superlativ = $inferior;
						// il adaugam in lista ordonata
						$ordered_ids[] = $inferior;
					}
					else
					{
						// il adaugam in coada de asteptare
						array_push($coada, $inferior);
						// il adaugam in lista ordonata
						$ordered_ids[] = $inferior;
					}
				}
			}
			else
			if($coada)
				$superlativ = array_pop($coada); // scoatem ultimul element si continuam cu acesta
			else
				break;// terminam ciclul while
		}
		// returnam array-ul ordonat
		return $ordered_ids;
	}
	// ========================================================================
	//
	//
	// ========================================================================
	public function HTMLcode()
	{
		$html_code = '<div id="CO_Plan" style="width:'.$this->width.'px; height:'.$this->height.'px;"><!--<em style="color:#030;">(width = '.$this->width.', height = '.$this->height.')</em>--><br />';
		foreach(self::$sections[$this->id] as $section)
			$html_code .= $section->HTMLcode();
		$html_code .= '</div>';
		
		return $html_code;
	}
	// ========================================================================
}
//
//
// END CO_Plan class

/* End of file CO_Plan.php */
/* Location: ./libraries/CO_Plan.php */