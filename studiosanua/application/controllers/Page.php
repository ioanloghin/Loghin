<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Page extends MY_Publiczone {

	public $global_data = array();
	public $current_lang;

	public function __construct()
	{
		parent::__construct();
		
		$this->load->model('Languages_model', 'LangModel');
		$this->load->model('Header_model', 'Header');
		$this->load->model('Traffic_model', 'Traffic');
		$this->load->library('Autologin');
		
		$this->current_lang = $this->session->userdata('lang');
		$this->current_lang = $this->current_lang ? $this->current_lang : $this->LangModel->get_primary()['lang'];
		$this->global_data['current_lang'] = $this->current_lang;
		
		$this->global_data['languages']=$this->LangModel->get();
		
		for ($i=1; $i<=5; ++$i) {
			$this->global_data['topmenu_item_'.$i] = $this->LangModel->get_content('topmenu-item-'.$i, $this->current_lang);
		}
		
		$this->global_data['footer_content'] 	= $this->LangModel->get_content('pagecontent-footer', $this->current_lang);
		$this->global_data['footer_copyright'] 	= $this->LangModel->get_content('pagecontent-copyright', $this->current_lang);
		$this->global_data['header_content'] 	= $this->LangModel->get_content('pagecontent-header', $this->current_lang);
		
		$this->global_data['logo_img']=$this->Header->get_logo_img();
		$this->global_data['company_name'] 		= $this->LangModel->get_content('company-name', $this->current_lang);
		$this->global_data['company_domain'] 	= $this->LangModel->get_content('company-domain', $this->current_lang);
		$this->global_data['company_register'] 	= $this->LangModel->get_content('company-register', $this->current_lang);
		
		
		// AUTOLOGIN
		$alogin = $this->autologin->autologin();
		$this->global_data['logged'] = ($alogin>0);
		
		// OPENID
		//$this->lang->load('openid', 'english');
        //$this->load->library('openid');
        //$this->load->helper('url');
        //$this->output->enable_profiler(TRUE);
		
		$this->Traffic->insertVisit($_SERVER['REMOTE_ADDR'], date('Y-m-d'));
		
		$this->global_data['trafficTotal'] = $this->Traffic->countTotal();
	}
	
	public function autologin($rawtoken) {
		$token = rawurldecode($rawtoken);
		$this->session->set_userdata("autologin_token", $token);
	}
	
	
	public function auth() {
		
		echo "SESSION TOKEN: ";
		var_export($this->session->userdata('autologin_token'));
		
		?>
        <iframe src="http://structures.loghin.com/crossdomain/login/?ref=<?php echo rawurlencode('http://studiosanua.com/autologin/received');?>" width="0" height="0" frameborder="0"></iframe>
        <?php
		exit;
		
		
		
		if ($this->input->post('action') == 'verify')
		{
			$user_id = $this->input->post('openid_identifier');
			$pape_policy_uris = $this->input->post('policies');
			
			if (!$pape_policy_uris)
			{
				$pape_policy_uris = array();
			}
			
			$this->config->load('openid');      
			$req = $this->config->item('openid_required');
			$opt = $this->config->item('openid_optional');
			$policy = site_url($this->config->item('openid_policy'));
			$request_to = site_url($this->config->item('openid_request_to'));
			
			$this->openid->set_request_to($request_to);
			$this->openid->set_trust_root(base_url());
			$this->openid->set_args(null);
			$this->openid->set_sreg(true, $req, $opt, $policy);
			$this->openid->set_pape(true, $pape_policy_uris);
			$this->openid->authenticate($user_id);
		} 
		
		$data['pape_policy_uris'] = array(
			PAPE_AUTH_MULTI_FACTOR_PHYSICAL,
			PAPE_AUTH_MULTI_FACTOR,
			PAPE_AUTH_PHISHING_RESISTANT
        );
        
    	$this->load->view('view_openid', $data);
	}

	public function home()
	{
		$this->load->model('Languages_model', 'LangModel');
		$this->load->model('Menu_model', 'Menu');
		$this->load->model('Homegallery_model', 'Gallery');
		$this->load->model('Article_model', 'Article');
		$this->load->model('Pagelayout_model', 'Layout');
		
		$this->session->set_userdata('url_path', 'home');
	
		$this->global_data['controller'] = 'page';
		$this->global_data['page'] 		 = 'home';
		
		$this->global_data['meta_title'] 		= $this->LangModel->get_content('metainfo-home-title', $this->current_lang);
		$this->global_data['meta_description'] 	= $this->LangModel->get_content('metainfo-home-description', $this->current_lang);
		$this->global_data['meta_keywords'] 	= $this->LangModel->get_content('metainfo-home-keywords', $this->current_lang);
		
		$this->global_data['page_content'] = $this->LangModel->get_content('pagecontent-home', $this->current_lang);
		
		$gallery_items=$this->Gallery->get_items();
		foreach($gallery_items as $k => $v)
		{
			$gallery_items[$k]['title'] = $this->LangModel->get_content($this->Gallery->gallery_item_field_mask($v['category_id'], 'title'), $this->current_lang);
			$subitems=array();
			foreach($this->Gallery->get_subitems($v['category_id']) as $v2)
			{
				$v2['title']=$this->LangModel->get_content($this->Gallery->gallery_subitem_field_mask($v2['slideshow_id'], 'title'), $this->current_lang);
				$v2['desc']=$this->LangModel->get_content($this->Gallery->gallery_subitem_field_mask($v2['slideshow_id'], 'desc'), $this->current_lang);
				$subitems[]=$v2;
			}
			$gallery_items[$k]['subitems']=$subitems;
		}
		$this->global_data['gallery_items']=$gallery_items;
		
		$this->global_data['button_prev'] = $this->LangModel->get_content('homegallery-buttons-prev', $this->current_lang);
		$this->global_data['button_next'] = $this->LangModel->get_content('homegallery-buttons-next', $this->current_lang);
		$this->global_data['button_more'] = $this->LangModel->get_content('homegallery-buttons-more', $this->current_lang);
		
		$this->global_data['newssection_title'] = $this->LangModel->get_content('newssection-title', $this->current_lang);
		$this->global_data['newssection_button_more'] = $this->LangModel->get_content('newssection-buttons-more', $this->current_lang);
		
		$this->global_data['testimonialssection_title'] = $this->LangModel->get_content('testimonialssection-title', $this->current_lang);
		$this->global_data['testimonialssection_button_viewall'] = $this->LangModel->get_content('testimonialssection-buttons-viewall', $this->current_lang);
		
		// LEFT_MENU -------------------
		$menu_items=$this->Menu->get_items('home');
		foreach($menu_items as $k => $v)
		{
			$menu_items[$k]['label'] = $this->LangModel->get_content($this->Menu->menu_item_field_mask('home', $v['item_id'], 'label'), $this->current_lang);
			$subitems=array();
			foreach($this->Menu->get_subitems($v['item_id']) as $v2)
			{
				$v2['label']=$this->LangModel->get_content($this->Menu->menu_subitem_field_mask('home', $v2['subitem_id'], 'label'), $this->current_lang);
				$subitems[]=$v2;
			}
			$menu_items[$k]['subitems']=$subitems;
		}
		$this->global_data['content_lists']=$menu_items;
		
		
		// ARTICLES -------------------
		$news=$this->Article->get_items('news');
		foreach($news as $k => $v)
		{
			$news[$k]['title'] 	 		= $this->LangModel->get_content($this->Article->article_item_field_mask('news', $v['article_id'], 'title'), $this->current_lang);
			$news[$k]['description']	= $this->LangModel->get_content($this->Article->article_item_field_mask('news', $v['article_id'], 'description'), $this->current_lang);
			$news[$k]['content'] 		= $this->LangModel->get_content($this->Article->article_item_field_mask('news', $v['article_id'], 'content'), $this->current_lang);
		}
		$this->global_data['news']=array_slice($news, 0, 2);
		
		// ARTICLES -------------------
		$testimonials=$this->Article->get_items('testimonials');
		foreach($testimonials as $k => $v)
		{
			$testimonials[$k]['title'] 	 		= $this->LangModel->get_content($this->Article->article_item_field_mask('testimonials', $v['article_id'], 'title'), $this->current_lang);
			$testimonials[$k]['description']	= $this->LangModel->get_content($this->Article->article_item_field_mask('testimonials', $v['article_id'], 'description'), $this->current_lang);
			$testimonials[$k]['content'] 		= $this->LangModel->get_content($this->Article->article_item_field_mask('testimonials', $v['article_id'], 'content'), $this->current_lang);
		}
		$this->global_data['testimonials']=array_slice($testimonials, 0, 2);
		
		
		$this->global_data['visible_gallery'] = $this->Layout->get_visible('home', 'gallery');
		$this->global_data['visible_content'] = $this->Layout->get_visible('home', 'content');
		$this->global_data['visible_pagelists'] = $this->Layout->get_visible('home', 'pagelists');
		$this->global_data['visible_news'] = $this->Layout->get_visible('home', 'news');
		$this->global_data['visible_testimonials'] = $this->Layout->get_visible('home', 'testimonials');
		
		$this->load->view('page-home', $this->global_data);
	}
	
	public function practice($menu1_id=0,$menu2_id=0)
	{
		$this->load->model('Languages_model', 'LangModel');
		$this->load->model('Menu_model', 'Menu');
		$this->load->model('Pagelayout_model', 'Layout');
		$this->load->model('Article_model', 'Article');
	
		$this->session->set_userdata('url_path', 'practice');
		
		$this->global_data['controller'] = 'page';
		$this->global_data['page'] 		 = 'practice';
		
		$this->global_data['meta_title'] 		= $this->LangModel->get_content('metainfo-practice-title', $this->current_lang);
		$this->global_data['meta_description'] 	= $this->LangModel->get_content('metainfo-practice-description', $this->current_lang);
		$this->global_data['meta_keywords'] 	= $this->LangModel->get_content('metainfo-practice-keywords', $this->current_lang);
		
		$this->global_data['page_left_content'] = $this->LangModel->get_content('pagecontent-practice2', $this->current_lang);
		
		$menu_items=$this->Menu->get_items('practice');
		foreach($menu_items as $k => $v)
		{
			$menu_items[$k]['label'] = $this->LangModel->get_content($this->Menu->menu_item_field_mask('practice', $v['item_id'], 'label'), $this->current_lang);
			$subitems=array();
			foreach($this->Menu->get_subitems($v['item_id']) as $v2)
			{
				if($menu1_id==0&&$menu2_id==0) {
					//$menu2_id=$v2['subitem_id'];
				}
				$v2['label']=$this->LangModel->get_content($this->Menu->menu_subitem_field_mask('practice', $v2['subitem_id'], 'label'), $this->current_lang);
				$subitems[]=$v2;
			}
			$menu_items[$k]['subitems']=$subitems;
			if($menu1_id==0) {
				//$menu1_id=$v['item_id'];
			}
		}
		$this->global_data['content_menu']=$menu_items;
		
		$this->global_data['menu1_id']=$menu1_id;
		$this->global_data['menu2_id']=$menu2_id;
		$content_key=$this->LangModel->content_item_field_mask('practice', $menu1_id, $menu2_id);
		$this->global_data['page_content'] = $this->LangModel->get_content($content_key, $this->current_lang);
		
		$this->global_data['leftmenu_title'] = $this->LangModel->get_content('practice-leftmenu-title', $this->current_lang);
		$this->global_data['visible_leftmenu'] = $this->Layout->get_visible('practice', 'leftmenu');
		$this->global_data['visible_content'] = $this->Layout->get_visible('practice', 'content');
		
		$this->load->view('page-practice', $this->global_data);
	}
	
	public function service($menu1_id=0,$menu2_id=0)
	{
		$this->load->model('Languages_model', 'LangModel');
		$this->load->model('Menu_model', 'Menu');
		$this->load->model('Pagelayout_model', 'Layout');
		$this->load->model('Article_model', 'Article');
	
		$this->session->set_userdata('url_path', 'service');
	
		$this->global_data['controller'] = 'page';
		$this->global_data['page'] 		 = 'service';
		
		$this->global_data['meta_title'] 		= $this->LangModel->get_content('metainfo-service-title', $this->current_lang);
		$this->global_data['meta_description'] 	= $this->LangModel->get_content('metainfo-service-description', $this->current_lang);
		$this->global_data['meta_keywords'] 	= $this->LangModel->get_content('metainfo-service-keywords', $this->current_lang);
		
		// LEFT_MENU -------------------
		$menu_items=$this->Menu->get_items('service');
		foreach($menu_items as $k => $v)
		{
			$menu_items[$k]['label'] = $this->LangModel->get_content($this->Menu->menu_item_field_mask('service', $v['item_id'], 'label'), $this->current_lang);
			$subitems=array();
			foreach($this->Menu->get_subitems($v['item_id']) as $v2)
			{
				if($menu1_id==0&&$menu2_id==0) {
					//$menu2_id=$v2['subitem_id'];
				}
				$v2['label']=$this->LangModel->get_content($this->Menu->menu_subitem_field_mask('service', $v2['subitem_id'], 'label'), $this->current_lang);
				$subitems[]=$v2;
			}
			$menu_items[$k]['subitems']=$subitems;
			if($menu1_id==0) {
				//$menu1_id=$v['item_id'];
			}
		}
		$this->global_data['content_menu']=$menu_items;
		
		$this->global_data['menu1_id']=$menu1_id;
		$this->global_data['menu2_id']=$menu2_id;
		$content_key=$this->LangModel->content_item_field_mask('service', $menu1_id, $menu2_id);
		$this->global_data['page_content'] = $this->LangModel->get_content($content_key, $this->current_lang);
		
		// ARTICLES -------------------
		$events=$this->Article->get_items('events');
		foreach($events as $k => $v)
		{
			$events[$k]['title'] 	 	= $this->LangModel->get_content($this->Article->article_item_field_mask('events', $v['article_id'], 'title'), $this->current_lang);
			$events[$k]['description']	= $this->LangModel->get_content($this->Article->article_item_field_mask('events', $v['article_id'], 'description'), $this->current_lang);
			$events[$k]['content'] 		= $this->LangModel->get_content($this->Article->article_item_field_mask('events', $v['article_id'], 'content'), $this->current_lang);
		}
		$this->global_data['events']=array_slice($events, 0, 2);
		
		$this->global_data['leftmenu_title'] = $this->LangModel->get_content('service-leftmenu-title', $this->current_lang);
		$this->global_data['publications_title'] = $this->LangModel->get_content('service-publications-title', $this->current_lang);
		$this->global_data['visible_leftmenu'] = $this->Layout->get_visible('service', 'leftmenu');
		$this->global_data['visible_content'] = $this->Layout->get_visible('service', 'content');
		$this->global_data['visible_publications'] = $this->Layout->get_visible('service', 'publications');
		
		$this->load->view('page-service', $this->global_data);
	}
	
	public function resources($menu1_id=0,$menu2_id=0)
	{
		$this->load->model('Languages_model', 'LangModel');
		$this->load->model('Menu_model', 'Menu');
		$this->load->model('Pagelayout_model', 'Layout');
	
		$this->session->set_userdata('url_path', 'resources');
	
		$this->global_data['controller'] = 'page';
		$this->global_data['page'] 		 = 'resources';
		
		$this->global_data['meta_title'] 		= $this->LangModel->get_content('metainfo-resources-title', $this->current_lang);
		$this->global_data['meta_description'] 	= $this->LangModel->get_content('metainfo-resources-description', $this->current_lang);
		$this->global_data['meta_keywords'] 	= $this->LangModel->get_content('metainfo-resources-keywords', $this->current_lang);
		
		$menu_items=$this->Menu->get_items('resources');
		foreach($menu_items as $k => $v)
		{
			$menu_items[$k]['label'] = $this->LangModel->get_content($this->Menu->menu_item_field_mask('resources', $v['item_id'], 'label'), $this->current_lang);
			$subitems=array();
			foreach($this->Menu->get_subitems($v['item_id']) as $v2)
			{
				if($menu1_id==0&&$menu2_id==0) {
					//$menu2_id=$v2['subitem_id'];
				}
				$v2['label']=$this->LangModel->get_content($this->Menu->menu_subitem_field_mask('resources', $v2['subitem_id'], 'label'), $this->current_lang);
				$subitems[]=$v2;
			}
			$menu_items[$k]['subitems']=$subitems;
			if($menu1_id==0) {
				//$menu1_id=$v['item_id'];
			}
		}
		$this->global_data['content_menu']=$menu_items;
		
		$this->global_data['menu1_id']=$menu1_id;
		$this->global_data['menu2_id']=$menu2_id;
		$content_key=$this->LangModel->content_item_field_mask('resources', $menu1_id, $menu2_id);
		$this->global_data['page_content'] = $this->LangModel->get_content($content_key, $this->current_lang);
		
		$this->global_data['leftmenu_title'] = $this->LangModel->get_content('resources-leftmenu-title', $this->current_lang);
		$this->global_data['visible_leftmenu'] = $this->Layout->get_visible('resources', 'leftmenu');
		$this->global_data['visible_content'] = $this->Layout->get_visible('resources', 'content');
		
		$this->load->view('page-resources', $this->global_data);
	}
	
	public function contact()
	{
		$this->load->model('Languages_model', 'LangModel');
		$this->load->model('Contact_model', 'ContactModel');
		$this->load->model('Logs_model', 'Logs');
	
		$this->session->set_userdata('url_path', 'contact');
	
		$this->global_data['controller'] = 'page';
		$this->global_data['page'] 		 = 'contact';
		
		$this->global_data['meta_title'] 		= $this->LangModel->get_content('metainfo-contact-title', $this->current_lang);
		$this->global_data['meta_description'] 	= $this->LangModel->get_content('metainfo-contact-description', $this->current_lang);
		$this->global_data['meta_keywords'] 	= $this->LangModel->get_content('metainfo-contact-keywords', $this->current_lang);
		
		$this->global_data['section1_title']   = $this->LangModel->get_content('contactinfo-section-title1', $this->current_lang);
		$this->global_data['section2_title']   = $this->LangModel->get_content('contactinfo-section-title2', $this->current_lang);
		$this->global_data['section3_title']   = $this->LangModel->get_content('contactinfo-section-title3', $this->current_lang);
		$this->global_data['section4_title']   = $this->LangModel->get_content('contactinfo-section-title4', $this->current_lang);
		$this->global_data['section1_content'] = $this->ContactModel->get_map();
		$this->global_data['section2_content'] = $this->LangModel->get_content('contactinfo-section-content2', $this->current_lang);
		$this->global_data['section3_content'] = $this->LangModel->get_content('contactinfo-section-content3', $this->current_lang);
		$this->global_data['contact_placeholder_fullname'] = $this->LangModel->get_content('contactinfo-placeholder-fullname', $this->current_lang);
		$this->global_data['contact_placeholder_phone'] = $this->LangModel->get_content('contactinfo-placeholder-phone', $this->current_lang);
		$this->global_data['contact_placeholder_email'] = $this->LangModel->get_content('contactinfo-placeholder-email', $this->current_lang);
		$this->global_data['contact_placeholder_message'] = $this->LangModel->get_content('contactinfo-placeholder-message', $this->current_lang);
		$this->global_data['contact_button_send'] = $this->LangModel->get_content('contactinfo-button-send', $this->current_lang);
		
		$this->form_validation->set_rules('name', $this->global_data['contact_placeholder_fullname'], 'required');
		$this->form_validation->set_rules('phone', $this->global_data['contact_placeholder_phone'], 'required');
		$this->form_validation->set_rules('email', $this->global_data['contact_placeholder_email'], 'required');
		$this->form_validation->set_rules('message', $this->global_data['contact_placeholder_message'], 'required');
			
		$this->global_data['successful'] = false;
		if ($this->form_validation->run() !== FALSE)
		{
			$this->load->library('email');

			$message = '<strong>Name:</strong> '.$this->input->post('name').'<br>'.
			'<strong>Phone:</strong> '.$this->input->post('phone').'<br>'.
			'<strong>Email:</strong> '.$this->input->post('email').'<br>'.
			'<strong>message:</strong><br>'.$this->input->post('message').'<br><br>'.
			'Was sent at '.date('H:i d-m-Y');
			$from = 'no-reply@loghin.com';
			$to = $this->ContactModel->get_email();
			$cc = $this->ContactModel->get_email_cc();
			$sbj = 'Contact form';

			$this->email->initialize(array(
			  'protocol' => 'smtp',
			  'smtp_host' => 'mail.loghin.com',
			  'smtp_user' => 'no-reply@loghin.com',
			  'smtp_pass' => '12wq!@WQ',
			  'smtp_port' => 25,
			  'crlf' => "\r\n",
			  'newline' => "\r\n"
			));
			
			$this->email->set_mailtype("html");
			$this->email->from($from);
			$this->email->to($to);
			$this->email->cc($cc);
			//$this->email->bcc('them@their-example.com');
			$this->email->subject($sbj);
			$this->email->message($message);
			$sent = $this->email->send();
			
			$log = "Try to send contact email.\n".
				"From: $from\n".
				"To: $to\n".
				"CC: $cc\n".
				"Subject: $sbj\n".
				"Message: ".$message."\n".
				"\n".
				"Send return ".($sent?'true':'false');
			
			if ($sent) {
				$this->global_data['successful'] = true;
			}
			else {
				 $log .= "\n\nError: \n".$this->email->print_debugger();
			}
			
			$this->Logs->addLog(1, $log);
		}
		
		$this->load->view('page-contact', $this->global_data);
	}
	
	// =====================================
	
	// Policy
    function policy()
    {
		$this->load->view('view_policy');
    }
    
    // set message
    function _set_message($msg, $val = '', $sub = '%s')
    {
        return str_replace($sub, $val, $this->lang->line($msg));
    }
    
    // Check
    function check()
    {    
		$this->config->load('openid');
		$request_to = site_url($this->config->item('openid_request_to'));
		
		$this->openid->set_request_to($request_to);
		$response = $this->openid->getResponse();
		
		switch ($response->status)
		{
			case Auth_OpenID_CANCEL:
				$data['msg'] = $this->lang->line('openid_cancel');
			break;
				
			case Auth_OpenID_FAILURE:
				$data['error'] = $this->_set_message('openid_failure', $response->message);
			break;
				
			case Auth_OpenID_SUCCESS:
				$openid = $response->getDisplayIdentifier();
				$esc_identity = htmlspecialchars($openid, ENT_QUOTES);
		
				$data['success'] = $this->_set_message('openid_success', array($esc_identity, $esc_identity), array('%s','%t'));
		
				if ($response->endpoint->canonicalID) {
					$data['success'] .= $this->_set_message('openid_canonical', $response->endpoint->canonicalID);
				}
		
				$sreg_resp = Auth_OpenID_SRegResponse::fromSuccessResponse($response);
				$sreg = $sreg_resp->contents();
				
				foreach ($sreg as $key => $value)
				{
					$data['success'] .= $this->_set_message('openid_content', array($key, $value), array('%s','%t'));
				}
		
				$pape_resp = Auth_OpenID_PAPE_Response::fromSuccessResponse($response);
				
				if ($pape_resp)
				{
					if ($pape_resp->auth_policies)
					{
						$data['success'] .= $this->lang->line('openid_pape_policies_affected');
					
						foreach ($pape_resp->auth_policies as $uri)
						{
							$data['success'] .= "<li><tt>$uri</tt></li>";
						}
		
						$data['success'] .= "</ul>";
					}
					else
					{
						$data['success'] .= $this->lang->line('openid_pape_not_affected');
					}
		
					if ($pape_resp->auth_age)
					{
						$data['success'] .= $this->_set_message('openid_auth_age', $pape_resp->auth_age);
					}
		
					if ($pape_resp->nist_auth_level)
					{
						$data['success'] .= $this->_set_message('openid_nist_level', $pape_resp->nist_auth_level);
					}
				}
				else
				{
					$data['success'] .= $this->lang->line('openid_pape_noresponse');
				}
			break;
		}
		
		$data['pape_policy_uris'] = array(
			PAPE_AUTH_MULTI_FACTOR_PHYSICAL,
			PAPE_AUTH_MULTI_FACTOR,
			PAPE_AUTH_PHISHING_RESISTANT
		);
		
		$this->load->view('view_openid', $data);   
    }
	
}
