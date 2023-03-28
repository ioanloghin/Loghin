<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Article
	extends CI_Controller {

	public $global_data = array();
	public $current_lang;

	public function __construct()
	{
		parent::__construct();
		
		$this->load->model('Languages_model', 'LangModel');
		$this->load->model('Header_model', 'Header');
		
		$this->current_lang = $this->session->userdata('lang');
		$this->current_lang = $this->current_lang ? $this->current_lang : $this->LangModel->get_primary()['lang'];
		$this->global_data['current_lang'] = $this->current_lang;
		
		$this->global_data['languages']=$this->LangModel->get();
		
		for ($i=1; $i<=5; ++$i) {
			$this->global_data['topmenu_item_'.$i] = $this->LangModel->get_content('topmenu-item-'.$i, $this->current_lang);
		}
		
		$this->global_data['footer_content'] = $this->LangModel->get_content('pagecontent-footer', $this->current_lang);
		$this->global_data['footer_copyright'] = $this->LangModel->get_content('pagecontent-copyright', $this->current_lang);
		$this->global_data['header_content'] = $this->LangModel->get_content('pagecontent-header', $this->current_lang);
		
		$this->global_data['logo_img']=$this->Header->get_logo_img();
		$this->global_data['company_name'] = $this->LangModel->get_content('company-name', $this->current_lang);
		$this->global_data['company_domain'] = $this->LangModel->get_content('company-domain', $this->current_lang);
		$this->global_data['company_register'] = $this->LangModel->get_content('company-register', $this->current_lang);
	}

	public function show($page_name, $article_id=0, $page_index = 0)
	{
		$this->load->model('Languages_model', 'LangModel');
		$this->load->model('Article_model', 'Article');
		
		$this->session->set_userdata('url_path', 'article/show/'.$page_name.'/'.$article_id);
	
		$this->global_data['page_name'] = $page_name;
	
		$this->global_data['controller'] = 'article';
		$this->global_data['page'] 		 = 'show';
		
		$this->global_data['meta_title'] 		= $this->LangModel->get_content('metainfo-home-title', $this->current_lang);
		$this->global_data['meta_description'] 	= $this->LangModel->get_content('metainfo-home-description', $this->current_lang);
		$this->global_data['meta_keywords'] 	= $this->LangModel->get_content('metainfo-home-keywords', $this->current_lang);
		
		$keyword = isset($_GET['keyword']) ? preg_replace('/([^a-zA-Z0-9 \-\_\,\.])/', "\\\\$1", trim($_GET['keyword'])) : NULL;
		$this->global_data['search_word']=$keyword;
		
		// ARTICLES -------------------
		if ($article_id == 0) {
			$filter=$page_name;
			if ($page_name=='all') {
				$filter=NULL;
			}
			$articles=$this->Article->get_items($filter, $keyword, $this->current_lang);
			
			// PAGINATION
			$this->load->library('pagination');
			$config['base_url'] = base_url('article/show/'.$page_name.'/0/');
			$config['total_rows'] = count($articles);
			$config['per_page'] = 5;
			$config['attributes'] = array('class' => 'page-link');
			$config['full_tag_open'] = '<ul class="pagination">';
			$config['full_tag_close'] = '</ul>';
			$config['first_tag_open'] = '<li class="page-item">';
			$config['first_tag_close'] = '</li>';
			$config['last_tag_open'] = '<li class="page-item">';
			$config['last_tag_close'] = '</li>';
			$config['prev_tag_open'] = '<li class="page-item">';
			$config['prev_tag_close'] = '</li>';
			$config['next_tag_open'] = '<li class="page-item">';
			$config['next_tag_close'] = '</li>';
			$config['cur_tag_open'] = '<li class="page-item active"><a class="page-link">';
			$config['cur_tag_close'] = '</a></li>';
			$config['num_tag_open'] = '<li class="page-item">';
			$config['num_tag_close'] = '</li>';
			$this->pagination->initialize($config);
			
			$articles=$this->Article->get_items($filter, $keyword, $this->current_lang, '1', $page_index, 5);
			
			foreach($articles as $k => $v)
			{
				$articles[$k]['title'] 	 		= $this->LangModel->get_content($this->Article->article_item_field_mask($v['identifier'], $v['article_id'], 'title'), $this->current_lang);
				$articles[$k]['description']	= $this->LangModel->get_content($this->Article->article_item_field_mask($v['identifier'], $v['article_id'], 'description'), $this->current_lang);
				$articles[$k]['content'] 		= $this->LangModel->get_content($this->Article->article_item_field_mask($v['identifier'], $v['article_id'], 'content'), $this->current_lang);
			}
			$this->global_data['page_index']=$page_index;
			$this->global_data['articles']=$articles;
			
			$this->load->view('page-articles', $this->global_data);
		}
		else {
			$article=$this->Article->get_item($article_id);
			
			$this->global_data['article_title'] 	  = $this->LangModel->get_content($this->Article->article_item_field_mask($article['identifier'], $article_id, 'title'), $this->current_lang);
			$this->global_data['article_description'] = $this->LangModel->get_content($this->Article->article_item_field_mask($article['identifier'], $article_id, 'description'), $this->current_lang);
			$this->global_data['article_content'] 	  = $this->LangModel->get_content($this->Article->article_item_field_mask($article['identifier'], $article_id, 'content'), $this->current_lang);
			
			$this->load->view('page-article', $this->global_data);
		}
		
		
	}

	public function getCalendarDays($month, $year) {
		
		$date = new DateTime("$year-$month-01");
		$N=(int)$date->format('N');//1-7. day of week
		$max=(int)$date->format('t');
		$day=1;
		$cmonth=(int)$date->format('m');
		$cyear=(int)$date->format('Y');
		$cday=((int)date('m')==(int)$month&&(int)date('Y')==(int)$year) ? (int)date('d') : 0;
		$week=(int)$date->format('W');
		$week=$week==1?($cmonth==12?53:1):($week>=51?($cmonth==1?0:$week):$week);
		$prevWeek=false;
		if ($week==0) {
			$prevYear = new DateTime(($year-1)."-12-31");
			$week=(int)$prevYear->format('W');
			$prevWeek=true;
		}
		$pos=1;
		while($day<=$max) {
			if (($pos-1)%7==0) {
				echo '<li class="week">'.$week.'</li>';
				if (!$prevWeek) {
					$week++;
				}
				else {
					$week=1;
					$prevWeek=false;
				}
			}
			
			if ($pos<$N) {
				echo '<li class="no"></li>';
			}
			else {
				echo '<li class="'.($cday==$day?'current':'').'">'.$day.'</li>';
				$day++;
			}
			$pos++;
		}
		
	}
}
