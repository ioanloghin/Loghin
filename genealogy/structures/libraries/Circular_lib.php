<?php  if ( ! defined('ANTIHACK')) exit('No direct script access allowed');

class Circular_lib
{
	private $obj_key;	// (string) cheia unica a obiectului
	private $text;		// (string) textul ce urmeaza sa fie afisat
	private $wletters;	// (array) latimea fiecarei litere
	private $r;			// (integer) raza cercului (in px)
	private $side;		// (enum("top", "bottom"))
	private $font;		// (string) cheia fontului
	// variabile automate
	private $letters;	// (array) caracterele textului
	private $wtext = 0;	// (integer) lungimea textului (in px)
	private $begin;		// (integer) punctul de pornire al textului (in grade)
	private $diff;		// (integer) incrementarea unghiului de la un caracter la altul (in grade)
	private $css_font;	// (string) cod css pentru font
	// variabile suplimentare
	private $css_color;	// (string) cod css pentru culoarea fontului
	private $css_shadow;// (string) cod css pentru umbra fontului
	//
	// ========================================================================
	public function __construct($obj_key, $text, $r, $side, $font)
	{
		// salveaza datele
		$this->obj_key	= (string)$obj_key;
		$this->text	= (string)$text;
		$this->r	= (int)$r;
		$this->font	= (string)$font;
		$this->side	= (string)$side;
		
		// lista de caractere
		$this->letters = str_split($this->text);
		
		// inversarea caracterelor pentru textul de jos
		if($this->side == "bottom")
			$this->letters = array_reverse($this->letters);
		
		// initiaza fontul cu valorile default
		$this->set_font($this->font);
		
		$q = 2 * asin( $this->wtext/(2*$this->r) );// masura unghi (in grade)
		$arc = (int)($q * $this->r);// lungimea arcului de cerc (in grade)
		$this->begin = (int)(-$arc/2);// de unde incepe textul (in grade)
	}
	// ========================================================================
	//
	//
	// ========================================================================
	public function get_style()
	{
		$css_code = "<style>\n";
		
		$i=1;
		switch($this->side)
		{
			case"top":
				// cod css general
				$css_code .= ".circular-".$this->obj_key." {\n
						\tmargin:0 0 0 284px;\n
						\tposition: relative;\n
						\twidth: ".($this->r*2)."px;\n
						\theight: ".($this->r)."px;\n
						\tborder-radius: 50%;\n
						\t-webkit-transform: rotate(0deg);\n
						\t-moz-transform: rotate(0deg);\n
						\t-ms-transform: rotate(0deg);\n
						\t-o-transform: rotate(0deg);\n
						\ttransform: rotate(0deg);\n
					}\n
					\n
					.circular-".$this->obj_key." h1.".$this->obj_key." span {\n
						\t".$this->css_font."\n
						\tposition: absolute;\n
						\twidth: 10px;\n\theight: 164px;\n
						\tleft: 0;\n\ttop: 0;\n
						\tcolor:".$this->css_color."; text-shadow:".$this->css_shadow.";\n
						\t-webkit-transform-origin: bottom center;\n
						\t-moz-transform-origin: bottom center;\n
						\t-ms-transform-origin: bottom center;\n
						\t-o-transform-origin: bottom center;\n
						\ttransform-origin: bottom center;\n
					}\n
					\n";
				// cod css pentru fiecare caracter
				foreach($this->letters as $letter)
				{
					$css_code .= "h1.".$this->obj_key." .char".$i." {\n\t-webkit-transform: rotate(".($this->begin+$this->diff*$i)."deg);\n\t-moz-transform: rotate(".($this->begin+$this->diff*$i)."deg);\n\t-ms-transform: rotate(".($this->begin+$this->diff*$i)."deg);\n\t-o-transform: rotate(".($this->begin+$this->diff*$i)."deg);\n\ttransform: rotate(".($this->begin+$this->diff*$i)."deg);\n\r}\n";
					$i++;
				}
				break;
			case"bottom":
				// cod css general
				$css_code .= ".circular-".$this->obj_key." {\n
						\tmargin:21px 0 0 284px;\n
						\tposition: relative;\n
						\tborder-radius: 50%;\n
						\twidth: ".($this->r*2)."px;\n
						\theight: ".($this->r)."px;\n
						\t-webkit-transform: rotate(0deg);\n
						\t-moz-transform: rotate(0deg);\n
						\t-ms-transform: rotate(0deg);\n
						\t-o-transform: rotate(0deg);\n
						\ttransform: rotate(0deg);\n
					}\n
					\n
					.circular-".$this->obj_key." h1.".$this->obj_key." span {\n
					display:block;\tpadding-top: 136px;\n
						\t".$this->css_font."\n
						\tposition: absolute;\n
						\twidth: 10px;\n\theight: 14px;\n
						\tleft: 0;\n\ttop: 0;\n
						\tcolor:".$this->css_color."; text-shadow:".$this->css_shadow.";\n
						\t-webkit-transform-origin: top center;\n
						\t-moz-transform-origin: top center;\n
						\t-ms-transform-origin: top center;\n
						\t-o-transform-origin: top center;\n
						\ttransform-origin: top center;\n
					}\n
				\n";
				// cod css pentru fiecare caracter
				foreach($this->letters as $letter)
				{
					$css_code .= "h1.".$this->obj_key." .char".$i." {\n\t-webkit-transform: rotate(".($this->begin+$this->diff*$i)."deg);\n\t-moz-transform: rotate(".($this->begin+$this->diff*$i)."deg);\n\t-ms-transform: rotate(".($this->begin+$this->diff*$i)."deg);\n\t-o-transform: rotate(".($this->begin+$this->diff*$i)."deg);\n\ttransform: rotate(".($this->begin+$this->diff*$i)."deg);\n\r}\n";
					$i++;
				}
				break;
		}
		
		$css_code .= "</style>\n";
		
		return $css_code;
	}
	// ========================================================================
	//
	//
	// ========================================================================
	public function get_letters()
	{
		$html_code = "<div class=\"circular-".$this->obj_key."\">\n";
			$html_code .= "<h1 class=\"".$this->obj_key."\">\n";
			
			$i=1;
			foreach($this->letters as $letter)
				$html_code .= "<span class=\"char".($i++)."\">".$letter."</span>\n";
			
			$html_code .= "</h1>\n";
		$html_code .= "</div>\n";
		
		return $html_code;
	}
	// ========================================================================
	//
	//
	// ========================================================================
	public function set_font($font_key, $color = "#FFF", $shadow = "1px 1px 2px #376C88")
	{
		switch($font_key)
		{
			default:
			case "Monaco-22":
				$this->css_font		= "font: 22px Monaco, MonoSpace;";
				$this->css_color	= $color;
				$this->css_shadow	= $shadow;
				$this->diff			= 5;// in grade
				$wletter = array(
					'*' => 4.8,// default
					'l' => 6
				);// latime litera
				break;
		}
		
		foreach($this->letters as $letter)
			$this->wtext += (array_key_exists($letter, $wletter)) ? $wletter[$letter] : $wletter['*'];
			
	}
	// ========================================================================
	//
	//
	// ========================================================================
}
//
//
// END Circular class

/* End of file Circular.php */
/* Location: ./libraries/Circular.php */