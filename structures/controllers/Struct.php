<?php  if ( ! defined('ANTIHACK')) exit('No direct script access allowed');

class Struct extends Controllers
{
	public function __construct()
	{
		
	}
	
	public function graph()
	{
		// variabila globala a utilizatorului logat
		global $MyUser;
		
		// include clasele necesare acestul controller
		$this->load_library('struct');
		$this->load_model('Struct_model');
		
		// preia parametri din get
		$projectID	= (defined('arg1') && (arg1 > 0)) ? intval(arg1) : 0;// id proiect
		$blockID	= (defined('arg2')) ? intval(arg2) : 0;// block-ul care se afla in prim-plan
		$deep		= (defined('arg3') && (arg3 > 0)) ? intval(arg3) : 1;// numarul de nivele afisate
		$direction	= (defined('arg4') && (arg4 > 0)) ? intval(arg4) : 1;// orientarea 1-orizontala, 2-verticala
		
		// required: $this->load_library('struct');
		// required: $this->load_model('Struct_model');
		$project = new ST_Project($projectID, $blockID, $deep, $direction);
		
		
		// trimite datele catre view
		$html_head = array('title' => 'Organigrama structura');
		$for_page = array('project' => $project, 'blockID' => $blockID, 'deep' => $deep, 'direction' => $direction, 'projectID' => $projectID);
	
		// include views
		$this->load_view('templates/harmony/head', $html_head);
		$this->load_view('struct/head_end');
		$this->load_view('struct/header', $for_page);
		$this->load_view('struct/p_index', $for_page);
		$this->load_view('templates/harmony/footer');
	}
	
	
	public function view()
	{
		// variabila globala a utilizatorului logat
		global $MyUser;
		
		// include clasele necesare acestul controller
		$this->load_library('struct');
		$this->load_model('Struct_model');
		$structModel = new Struct_model;
		
		// preia parametri din get
		$code = (defined('arg1')) ? arg1 : NULL;// cod Ateco
		$info = $structModel->about_code($code, lang);
		
		// trimite datele catre view
		$html_head = array('title' => 'Detalii despre '.$code);
		$for_page = array('code' => $code, 'info' => $info, 'projectID' => $info['project'], 'deep' => 6, 'isview' => 1);
		
		
		// include views
		$this->load_view('templates/harmony/head', $html_head);
		$this->load_view('struct/head_end');
		$this->load_view('struct/header', $for_page);
		$this->load_view('struct/p_view', $for_page);
		$this->load_view('templates/harmony/footer');
	}
	
	
	public function operations()
	{
		// variabila globala a utilizatorului logat
		global $MyUser;
		
		// include clasele necesare acestul controller
		$this->load_library('struct');
		$this->load_model('Struct_model');
		
		// preia parametri din get
		$projectID	= (defined('arg1') && (arg1 > 0)) ? intval(arg1) : 0;// id proiect
		
		// initializeaza clasa de lucru
		$operations = new ST_Operations($projectID);
		
		$ref = (isset($_POST['ref'])) ? $_POST['ref'] : 'it';
		
		// selecteaza inregistrarile Ateco din baza de date in limba specificata
		$operations->ateco($ref);
		
		if(isset($_POST['save']))
		{
			// salvam datele in structura
			if(!$operations->save())
				var_export($operations->errors());
		}
		
		// trimite datele catre view
		$html_head = array('title' => 'Organigrama Operatiuni (Administrare)');
		$for_page = array('operations' => $operations, 'ref' => $ref);
		
		// include views
		$this->load_view('templates/'.template.'/head', $html_head);
		$this->load_view('struct/head_end');
		$this->load_view('templates/'.template.'/header');
		$this->load_view('struct/p_operations', $for_page);
		$this->load_view('templates/'.template.'/footer');
	}
}



/* End of file Search.php */
/* Location: ./controllers/Search.php */