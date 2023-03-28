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
// DEZORDONATA CLASA ASTA
// -> TREBUIE ARANJATA PUTIN
class Files
{
	private $FILES;// Variabila globala $_FILES
	private $config;// setarile precum numele fisierului, patch, extensii, dimensiune etc.
	private $results;// fisierele rezultate
	// pentru stocarea erorilor
	private $errno = 0;
	//
	//
	// ========================================================================
	public function __construct($file_key)
	{
		if(isset($_FILES[$file_key]))
			$this->FILES = $_FILES[$file_key];
		
		$this->results = array();
		$this->results['filesrc'] = NULL;
		$this->results['filename'] = NULL;
		$this->results['fileext'] = NULL;
	}
	// ========================================================================
	//
	//
	// ========================================================================
	public function __destruct()
	{
         foreach ($this as $key => $value)
             unset($this->$key);
    }
	// ========================================================================
	//
	//
	// ========================================================================
	public function config($config)
	{
		// $config['backs'] = '../';
		// $config['patch'] = 'continut/profile/';
		// $config['filename'] = date('YmdHis').rand(1,99);
		// $config['extensions'] = array('jpg', 'png');
		// $config['size'] = 30000;// 30k
		$this->config['backs']		= (isset($config['backs']))		? $config['backs']		: NULL;
		$this->config['patch']		= (isset($config['patch']))		? $config['patch']		: NULL;
		$this->config['filename']	= (isset($config['filename']))	? $config['filename']	: NULL;
		$this->config['extensions'] = (isset($config['extensions']))? $config['extensions'] : NULL;
		$this->config['size']		= (isset($config['size']))		? $config['size']		: NULL;
	}
	// ========================================================================
	public function upload()
	{
		if(!isset($this->FILES['name']) || !isset($this->FILES['size']) || !isset($this->FILES['tmp_name']) || !isset($this->FILES['type']) || !isset($this->FILES['error']))
			$this->errno = 1;
		
		if(!$this->errno)
		{
			$this->results['filename'] = $this->config['filename'];
			$this->results['fileext'] = $this->extension($this->FILES['name']);
		    if(!in_array($this->results['fileext'], $this->config['extensions']))
				$this->errno = 2;
			
			if($this->FILES['size'] > $this->config['size'] && $this->errno)
				$this->errno = 3;
			
			$fis_nou = $this->config['backs'].$this->config['patch'].$this->config['filename'].".".$this->results['fileext'];
			
			if(!$this->errno)
			{
				if (is_uploaded_file($this->FILES['tmp_name']))  
				{
					if (move_uploaded_file($this->FILES['tmp_name'], $fis_nou))  
						$this->results['filesrc'] = ($this->config['backs']) ? str_replace($this->config['backs'], '', $fis_nou) : $fis_nou;
					else
						$this->errno = 4;
				}
			    else
					$this->errno = 5;
			}
		
		}// end $error['value'] == 0
	}
	// ========================================================================
	//
	//
	// ========================================================================
	public function create_thumb($destination, $max_width, $max_height, $proportional = TRUE, $filling = FALSE, $culoare = array(255, 255, 255))
	{
		if($this->results['filesrc'] && @file_exists($this->config['backs'].$this->results['filesrc']))
			$this->resize_image($this->config['backs'].$this->results['filesrc'], $destination, $max_width, $max_height, $proportional, $filling, $culoare);
	}
	// ========================================================================
	//
	//
	// ========================================================================
	static private function resize_image($source, $destination, $max_width, $max_height, $proportional = TRUE, $filling = FALSE, $culoare = array(255, 255, 255))
	{
		// $source = ''; // adresa imagini originale
		// $destination = ''; // adresa imagini destinatie (daca este aceasi cu sursa se va inlocui)
		
		list($latime_poza_originala, $inaltime_poza_originala) = getimagesize($source);
		
		if(!$proportional)
		{
			$latime_poza = $max_width;
			$inaltime_poza = $max_height;
		}
		else
		{
			$raport_original = $latime_poza_originala / $inaltime_poza_originala;
			$raport_maxim = $max_width / $max_height;
			
			if ($raport_maxim > $raport_original)
			{
				$latime_poza = $max_height * $raport_original;
				$inaltime_poza = $max_height;
			}
			else
			{
				$latime_poza = $max_width;
				$inaltime_poza = $max_width / $raport_original;
			}
		}
		
		if($filling) 
		{
			$spatiu_sus = ceil (($max_height - ($inaltime_poza + 1)) / 2); 
			$spatiu_stanga = ceil (($max_width - ($latime_poza + 1)) / 2); 
			$latime_poza_returnata = $max_width; 
			$inaltime_poza_returnata = $max_height; 
		}
		else 
		{
			$spatiu_sus = 0;
			$spatiu_stanga = 0;
			$latime_poza_returnata = $latime_poza;
			$inaltime_poza_returnata = $inaltime_poza;
		}
		
		$pathinfo = pathinfo($source);
		$pathinfo['extension'] = strtolower($pathinfo['extension']);
		switch($pathinfo['extension'])
		{
			case'jpeg':
			case'jpg':
				$imagine_originala = imagecreatefromjpeg($source);
				break;
			case'png':
				$imagine_originala = imagecreatefrompng($source);
				break;
			case'gif':
				$imagine_originala = imagecreatefromgif($source);
				break;
		}
		
		$imagine_redimensionata = imagecreatetruecolor($latime_poza_returnata, $inaltime_poza_returnata);
		if ((is_array($culoare)) && (count($culoare) == 3) && ($culoare[0] <= 255) && ($culoare[1] <= 255) && ($culoare[2] <= 255)) 
			$culoare_fundal = imagecolorallocate($imagine_redimensionata, $culoare[0], $culoare[1], $culoare[2]);       
		else 
			$culoare_fundal = imagecolorallocate($imagine_redimensionata, 255, 255, 255);             
		
		imagefill($imagine_redimensionata, 0, 0, $culoare_fundal); 
		
		imagecopyresampled($imagine_redimensionata, $imagine_originala, $spatiu_stanga, $spatiu_sus, 0, 0, $latime_poza, $inaltime_poza, $latime_poza_originala, $inaltime_poza_originala);
		
		switch($pathinfo['extension'])
		{
			case'jpeg':
			case'jpg':
				imagejpeg($imagine_redimensionata, $destination, 100); 
				break;
			case'png':
				imagepng($imagine_redimensionata, $destination, 1); 
				break;
			case'gif':
				imagegif($imagine_redimensionata, $destination); 
				break;
		}
	}
	// ========================================================================
	//
	//
	// ========================================================================
	public function get_info($key = NULL)
	{
		if($key)
			return (isset($this->results[$key])) ? $this->results[$key] : NULL;
		else
			return $this->results;
	}
	// ========================================================================
	//
	//
	// ========================================================================
	static function extension($filename) 
	{
		$exts = explode(".", $filename); 
		$n = count($exts)-1; 
		$exts = $exts[$n]; 
		return $exts; 
	}
	// ========================================================================
	public function errno()
	{
		return $this->errno;
	}
	// ========================================================================
	//
	//
	// ========================================================================
	public function strerror()
	{
		$strerror = array();
		$strerror[0] = NULL; // nu sunt erori
		$strerror[1] = "Fisierul nu contine toate informatiile necesare acestei operatiuni.";
		$strerror[2] = 'Formatul fisierului nu este permis.';
		$strerror[3] = 'Fisierul tau are <strong>'.round(($this->FILES['size']/1024)).'k</strong> iar dimensiunea maxima este de <strong>'.round(($this->config['size']/1024)).'k</strong>.';
		$strerror[4] = 'Eroare la mutare.';
		$strerror[5] = 'Eroare la transfer.';
		$strerror[6] = 'xxxxx';
		
		if(isset($strerror[$this->errno]))
			return $strerror[$this->errno];
	}
	// ========================================================================
}
//:::UPDATE[2012-01-26]::: A nu se indeparta!
?>