<?php  if ( ! defined('ANTIHACK')) exit('No direct script access allowed');

class Circular_lib
{
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
	//
	// ========================================================================
	public function __construct($text, $r, $side, $font)
	{
		$this->text	= (string)$text;
		$this->r	= (int)$r;
		$this->font	= (string)$font;
		
		$this->letters = str_split($this->text);
		
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
		
		$css_code .= ".circular-up {\n
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
			h1 span {\n
				\tfont: 22px Monaco, MonoSpace;\n
				\theight: 164px;\n
				\tposition: absolute;\n
				\twidth: 10px;\n
				\tleft: 0;\n
				\ttop: 0;\n
				\tcolor:#FFF; text-shadow:1px 1px 2px #376C88;\n
				\t-webkit-transform-origin: bottom center;\n
				\t-moz-transform-origin: bottom center;\n
				\t-ms-transform-origin: bottom center;\n
				\t-o-transform-origin: bottom center;\n
				\ttransform-origin: bottom center;\n
			}\n
		\n";
		
		$i=1;
		foreach($this->letters as $letter)
		{
			$css_code .= ".char".$i." {\n\t-webkit-transform: rotate(".($this->begin+$this->diff*$i)."deg);\n\t-moz-transform: rotate(".($this->begin+$this->diff*$i)."deg);\n\t-ms-transform: rotate(".($this->begin+$this->diff*$i)."deg);\n\t-o-transform: rotate(".($this->begin+$this->diff*$i)."deg);\n\ttransform: rotate(".($this->begin+$this->diff*$i)."deg);\n\r}\n";
			$i++;
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
		$html_code = "<div class=\"circular-up\">\n";
			$html_code .= "<h1>\n";
		
			foreach($this->letters as $letter)
			{
				$html_code .= "<span class=\"char".$i."\">".$letter."</span>\n";
				$i++;
			}
			
			$html_code .= "</h1>\n";
		$html_code .= "</div>\n";
		
		return $html_code;
	}
	// ========================================================================
	//
	//
	// ========================================================================
	public function set_font($font_key)
	{
		switch($font_key)
		{
			default:
			case "Monaco-22":
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