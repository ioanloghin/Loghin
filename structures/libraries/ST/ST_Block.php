<?php  if ( ! defined('ANTIHACK')) exit('No direct script access allowed');

class ST_Block
{
	// identifiers
	private $group;		 	 // (integer) id-ul grupului de care apartine
	private $id;	 		 // (integer) id-ul blocului curent
	public  $index;			 // (integer) numarul de ordin (in cazul blocurilor paralele)
	// attributes
	private $code;			 // (string) codul Ateco
	private $label;			 // (string) denumirea blocului
	private $type;	 		 // (enum(1,2)) 1 - job normal, 2 - shortcut catre alta organigrama
	// dimensions
	public $width		= 60;  // (integer) latimea containerului
	public $height		= 100; // (integer) inaltimea containerului
	public $left		= 0;   // (integer) coordonata X
	public $top 		= 0;   // (integer) coordonata Y
	private $outside_x	= 10;  // (integer) spatiul de la block-ul din stanga (pentru asezarea pe orizontala)
	private $outside_y	= 10;  // (integer) spatiul de la block-ul de sus (pentru asezarea pe verticala)
	//
	// ========================================================================
	public function __construct($id, $code = NULL, $label = NULL, $type = 1)
	{
		$this->id		= (int)$id;
		$this->code		= $code;
		$this->label 	= $label;
		$this->type		= $type;
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
	public function get($key, $default = NULL)
	{
		return (isset($this->$key)) ? $this->$key : $default;
	}
	// ========================================================================
	//
	//
	// ========================================================================
	// returneaza intreaga latimea a grupului (impreuna cu padding si border)
	public function full_width()
	{
		return $this->width /* latime */ + 2/* border */ + 0/* padding lateral */;
	}
	// ------------------------------------------------------------------------
	// returneaza intreaga inaltime a grupului (impreuna cu padding si border)
	public function full_height()
	{
		return $this->height /* inaltime */ + 2/* border */ + 0/* padding sus si jos */;
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
		$html_code = '<div id="StructBlock-'.$this->code.'" class="block opacity90" style="width:'.$this->width.'px; height:'.$this->height.'px; margin-top:-'.intval($this->height/2).'px;">';
		$html_code .= '<span ondblclick="return false;" style="width:'.$this->width.'px; height:'.$this->height.'px;">'.$this->label.'</span>';
		$html_code .= '</div>';
		
		return $html_code;
	}
	// ========================================================================
}
//
//
// END ST_Block class

/* End of file ST_Block.php */
/* Location: ./libraries/ST/ST_Block.php */