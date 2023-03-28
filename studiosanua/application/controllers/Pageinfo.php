<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pageinfo extends MY_Restrictedzone {

	public function meta($page_name, $form_lang = NULL)
	{
		$this->load->model('Languages_model', 'LangModel');
	
		$data = array(
			'controller' => 'pageinfo',
			'page' => 'meta',
			'title' => ucfirst($page_name).' - Page info',
		);
		
		// Override data about controller and page
		$data['controller'] = $page_name.'page';
		$data['page'] = 'pageinfo';
		
		$data['page_name'] = $page_name;
		$form_lang = ($form_lang == NULL) ? $this->LangModel->get_primary()['lang'] : $form_lang;
		$data['form_lang'] = $form_lang;
		
		$data['successful'] = false;
		$data['meta_lang'] = isset($_POST['meta_lang'])
							? $this->input->post('meta_lang')
							: $form_lang;
		$data['meta_title'] = isset($_POST['meta_title'])
							? $this->input->post('meta_title')
							: $this->LangModel->get_content('metainfo-'.$page_name.'-title', $form_lang);
		$data['meta_description'] = isset($_POST['meta_description'])
							? $this->input->post('meta_description')
							: $this->LangModel->get_content('metainfo-'.$page_name.'-description', $form_lang);
		$data['meta_keywords'] = isset($_POST['meta_keywords'])
							? $this->input->post('meta_keywords')
							: $this->LangModel->get_content('metainfo-'.$page_name.'-keywords', $form_lang);
		
		$this->form_validation->set_rules('meta_lang', 'Meta lang', 'required');
		$this->form_validation->set_rules('meta_title', 'Title', 'required');
		$this->form_validation->set_rules('meta_description', 'Description', '');
		$this->form_validation->set_rules('meta_keywords', 'Keywords', '');
		
		if ($this->form_validation->run() !== FALSE)
		{
			$this->LangModel->save_content('metainfo-'.$page_name.'-title', $form_lang, $this->input->post('meta_title'));
			$this->LangModel->save_content('metainfo-'.$page_name.'-description', $form_lang, $this->input->post('meta_description'));
			$this->LangModel->save_content('metainfo-'.$page_name.'-keywords', $form_lang, $this->input->post('meta_keywords'));
			$data['successful'] = true;
		}
		
		$data['content_langs']=$this->LangModel->get();
		
		$this->load->view('admin/page-generic-pageinfo', $data);
	}
	
	public function pagecontent($page_name, $form_lang = NULL, $menu1_id=0, $menu2_id=0)
	{
		$this->load->model('Languages_model', 'LangModel');
		$this->load->model('Menu_model', 'Menu');
	
		$data = array(
			'controller' => 'pageinfo',
			'page' => 'pagecontent',
			'title' => ucfirst($page_name).' - Page content',
		);
		
		// Override data about controller and page
		$data['controller'] = $page_name.'page';
		if ($page_name == 'footer')
		{
			$data['controller'] = 'template';
			$data['page'] = $page_name;
		}
		
		$data['page_name'] = $page_name;
		$form_lang = ($form_lang == NULL) ? $this->LangModel->get_primary()['lang'] : $form_lang;
		$data['form_lang'] = $form_lang;
		
		$data['dark'] = $page_name=='footer';
		$data['successful'] = false;
		
		if (in_array($page_name, array('practice','service','resources')))
		{
			$menu_items=$this->Menu->get_items($page_name);
			foreach($menu_items as $k => $v)
			{
				$menu_items[$k]['label'] = $this->LangModel->get_content($this->Menu->menu_item_field_mask($page_name, $v['item_id'], 'label'), $form_lang);
				$subitems=array();
				foreach($this->Menu->get_subitems($v['item_id']) as $v2)
				{
					if($menu1_id==0&&$menu2_id==0) {
						//$menu2_id=$v2['subitem_id'];
					}
					$v2['label']=$this->LangModel->get_content($this->Menu->menu_subitem_field_mask($page_name, $v2['subitem_id'], 'label'), $form_lang);
					$subitems[]=$v2;
				}
				$menu_items[$k]['subitems']=$subitems;
				if($menu1_id==0) {
					//$menu1_id=$v['item_id'];
				}
			}
			$data['content_lists']=$menu_items;
			
			$data['menu1_id']=$menu1_id;
			$data['menu2_id']=$menu2_id;
		}
		
		$content_key=$this->LangModel->content_item_field_mask($page_name, $menu1_id, $menu2_id);
		$this->form_validation->set_rules('content', 'Content', 'required');
		if ($this->form_validation->run() !== FALSE)
		{
			$menu1_id=$this->input->post('menu1_id');
			$menu2_id=$this->input->post('menu2_id');
			$content_key=$this->LangModel->content_item_field_mask($page_name, $menu1_id, $menu2_id);
			$this->LangModel->save_content($content_key, $form_lang, $this->input->post('content'));
			$data['successful'] = true;
		}
		$data['content'] = isset($_POST['content'])
							? $this->input->post('content')
							: $this->LangModel->get_content($content_key, $form_lang);
		
		$data['content_langs']=$this->LangModel->get();
		
		$this->load->view('admin/page-generic-pagecontent', $data);
	}
	
	public function pagemenu($page_name, $item_id = 0, $form_lang = NULL)
	{
		$this->load->model('Languages_model', 'LangModel');
		$this->load->model('Menu_model', 'Menu');
	
		$data = array(
			'controller' => 'pageinfo',
			'page' => 'pagemenu',
			'title' => ucfirst($page_name).' - Left menu',
		);
		
		// Override data about controller and page
		$data['controller'] = $page_name.'page';
		$data['page'] = 'pagemenu';
		
		$_menu_config=array(
			'show_item_icon' => false,
			'show_subitems' => true,
			'show_subitem_icon' => false,
		);
		if ($page_name=='service')
		{
			$_menu_config['show_item_icon']=true;
			$_menu_config['show_subitems']=false;
		}
		if ($page_name=='resources')
		{
			$_menu_config['show_subitem_icon']=true;
		}
		
		$data['page_name'] = $page_name;
		$form_lang = ($form_lang == NULL) ? $this->LangModel->get_primary()['lang'] : $form_lang;
		$data['form_lang'] = $form_lang;
		$data['content_langs'] = $this->LangModel->get();
		$data['item_id']=$item_id;
		$data['page_name'] = $page_name;
		$data['menu_config'] = $_menu_config;
		$data['successful'] = false;
		
		$this->form_validation->set_rules('save', 'Save button', 'required');
		$this->form_validation->set_rules('field_label', 'Label', '');
		$this->form_validation->set_rules('field_link', 'Link', '');
		if ($_menu_config['show_item_icon']) {
			$this->form_validation->set_rules('field_icon', 'Icon', '');
		}
		
		if ($this->form_validation->run() !== FALSE)
		{
			$this->LangModel->save_content($this->Menu->menu_item_field_mask($page_name, $item_id, 'label'), $form_lang, $this->input->post('field_label'));
			$this->Menu->update_item_link($item_id, $this->input->post('field_link'));
			if ($_menu_config['show_item_icon']) {
				$this->Menu->update_item_icon($item_id, $this->input->post('field_icon'));
			}
			
			if ($this->input->post('subitems[]'))
			{
				foreach($this->input->post('subitems[]') as $sr_id)
				{
					$this->LangModel->save_content($this->Menu->menu_subitem_field_mask($page_name, $sr_id, 'label'), $form_lang, $this->input->post('subitem-field-'.$sr_id.'-label'));
					$this->Menu->update_subitem_link($sr_id, $this->input->post('subitem-field-'.$sr_id.'-link'));
					if ($_menu_config['show_subitem_icon']) {
						$this->Menu->update_subitem_icon($sr_id, $this->input->post('subitem-field-'.$sr_id.'-icon'));
					}
				}
			}
			
			$data['successful'] = true;
		}
		
		$data['field_label'] = isset($_POST['field_label'])
							? $this->input->post('field_label')
							: $this->LangModel->get_content($this->Menu->menu_item_field_mask($page_name, $item_id, 'label'), $form_lang);
		
		$item=($item_id>0)?$this->Menu->get_item($item_id):array();
		$data['field_link'] = $item_id>0
							? $item['link']
							: NULL;
		if ($_menu_config['show_item_icon']) {
			$data['field_icon'] = $item_id>0
							? $item['icon']
							: NULL;
		}
		
		$menu_items=$this->Menu->get_items($page_name);
		foreach($menu_items as $k => $v)
		{
			$menu_items[$k]['label'] = $this->LangModel->get_content($this->Menu->menu_item_field_mask($page_name, $v['item_id'], 'label'), $form_lang);
		}
		$data['menu_items']=$menu_items;
		
		
		$subitems=array();
		if ($item_id>0)
		{
			foreach($this->Menu->get_subitems($item_id) as $v)
			{
				$v['label']=$this->LangModel->get_content($this->Menu->menu_subitem_field_mask($page_name, $v['subitem_id'], 'label'), $form_lang);
				$subitems[]=$v;
			}
		}
		$data['menu_subitems']=$subitems;
		
		$this->load->view('admin/page-generic-pagemenu', $data);
	}
	
	public function menu_add_item($page_name, $form_lang)
	{
		$this->load->model('Menu_model', 'Menu');
		$item_id = $this->Menu->insert_item($page_name);
		
		if ($this->input->is_ajax_request()) {
			$item=$this->Menu->get_item($item_id);
			echo '<tr id="item-id-'.$item['item_id'].'">';
				echo '<td> </td>';
				echo '<td> </td>';
				echo '<td style="text-align:right;">
                    	<a class="btn btn-xs btn-default" href="'.base_url('pageinfo/pagemenu/'.$page_name.'/'.$item['item_id'].'/'.$form_lang).'"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                        <a class="btn btn-xs btn-default linkRemoveItemAjax" href="'.base_url('pageinfo/menu_del_item/'.$page_name.'/'.$item['item_id'].'/'.$form_lang).'"><i class="fa fa-times" aria-hidden="true"></i></a>
                      </td>';
			echo '</tr>';
		}
		else {
			redirect('pageinfo/pagemenu/'.$page_name.'/'.$item_id.'/'.$form_lang, 'refresh');
		}
	}
	
	public function menu_add_subitem($page_name, $item_id, $form_lang)
	{
		$this->load->model('Menu_model', 'Menu');
		$subitem_id = $this->Menu->insert_subitem($item_id);
		
		if ($this->input->is_ajax_request()) {
			$item=$this->Menu->get_item($item_id);
			echo '<tr id="subitem-id-'.$subitem_id.'">';
				echo '<td><input type="hidden" name="subitems[]" value="'.$subitem_id.'">
                    <input type="text" name="subitem-field-'.$subitem_id.'-label" class="form-control input-sm" value=""></td>';
                echo '<td><input type="text" name="subitem-field-'.$subitem_id.'-link" class="form-control input-sm" value=""></td>';
                echo '<td style="text-align:right;">
                    <a class="btn btn-xs btn-default linkRemoveSubItemAjax" href="'.base_url('pageinfo/menu_del_subitem/'.$page_name.'/'.$subitem_id.'/'.$form_lang).'"><i class="fa fa-times" aria-hidden="true"></i></a>
                </td>';
			echo '</tr>';
		}
		else {
			redirect('pageinfo/pagemenu/'.$page_name.'/'.$item_id.'/'.$form_lang, 'refresh');
		}
	}
	
	public function menu_del_item($page_name, $item_id, $form_lang)
	{
		$this->load->model('Languages_model', 'LangModel');
		$this->load->model('Menu_model', 'Menu');
		
		$this->Menu->remove_item($item_id);
		$this->LangModel->remove_content($this->Menu->menu_item_field_mask($page_name, $item_id, 'title'));
		$this->LangModel->remove_content($this->Menu->menu_item_field_mask($page_name, $item_id, 'desc'));
		$this->LangModel->remove_content($this->Menu->menu_item_field_mask($page_name, $item_id, 'title-right'));
		
		if ($this->input->is_ajax_request()) {
			echo $item_id;
		}
		else {
			redirect('pageinfo/pagemenu/'.$page_name.'/0/'.$form_lang, 'refresh');
		}
	}
	
	public function menu_del_subitem($page_name, $subitem_id, $form_lang)
	{
		$this->load->model('Languages_model', 'LangModel');
		$this->load->model('Menu_model', 'Menu');
		
		$subitem=$this->Menu->get_subitem($subitem_id);
		$this->Menu->remove_subitem($subitem_id);
		$this->LangModel->remove_content($this->Menu->menu_subitem_field_mask($page_name, $subitem['subitem_id'], 'title'));
		
		if ($this->input->is_ajax_request()) {
			echo $subitem_id;
		}
		else {
			redirect('pageinfo/pagemenu/'.$page_name.'/'.$subitem['item_id'].'/'.$form_lang, 'refresh');
		}
	}
	
	public function menu_up_item($identifier, $item_id, $form_lang)
	{
		$this->load->model('Menu_model', 'Menu');
		$this->Menu->item_priority_up($identifier, $item_id);
		redirect('pageinfo/pagemenu/'.$identifier.'/0/'.$form_lang, 'refresh');
	}
	
	public function menu_down_item($identifier, $item_id, $form_lang)
	{
		$this->load->model('Menu_model', 'Menu');
		$this->Menu->item_priority_down($identifier, $item_id);
		redirect('pageinfo/pagemenu/'.$identifier.'/0/'.$form_lang, 'refresh');
	}
	
	public function publications($page_name = NULL, $item_id = 0, $form_lang = NULL, $page_index = 0)
	{
		$this->load->model('Languages_model', 'LangModel');
		$this->load->model('Article_model', 'Article');
	
		$data = array(
			'controller' => 'pageinfo',
			'page' => 'publications',
			'title' => 'Articles - '. ($page_name=='all'?ucfirst($page_name):'All'),
		);
		
		$data['page_name'] = $page_name;
		$form_lang = ($form_lang == NULL) ? $this->LangModel->get_primary()['lang'] : $form_lang;
		$data['form_lang'] = $form_lang;
		$data['content_langs'] = $this->LangModel->get();
		$data['item_id']=$item_id;
		$data['page_name'] = $page_name;
		$data['successful'] = false;
		
		$this->form_validation->set_rules('field_title', 'Title', 'required');
		$this->form_validation->set_rules('field_desc', 'Short description', '');
		$this->form_validation->set_rules('field_content', 'Content', '');
		$this->form_validation->set_rules('field_public', 'Public', 'numeric');
		
		if ($this->form_validation->run() !== FALSE)
		{
			$item=$this->Article->get_item($item_id);
			
			$this->LangModel->save_content($this->Article->article_item_field_mask($item['identifier'], $item_id, 'title'), $form_lang, $this->input->post('field_title'));
			$this->LangModel->save_content($this->Article->article_item_field_mask($item['identifier'], $item_id, 'description'), $form_lang, $this->input->post('field_desc'));
			$this->LangModel->save_content($this->Article->article_item_field_mask($item['identifier'], $item_id, 'content'), $form_lang, $this->input->post('field_content'));
			$this->Article->update_item_public($item_id, $this->input->post('field_public')=='1'?'1':'0');
			$this->Article->update_item_identifier($item_id, $this->input->post('field_identifier'));
			$this->Article->update_item_date($item_id, $this->input->post('field_date'));
			
			$data['successful'] = true;
		}
		
		
		$item=($item_id>0)?$this->Article->get_item($item_id):array();
		
		$data['field_title'] = isset($_POST['field_title'])
							? $this->input->post('field_title')
							: $item_id>0 ? $this->LangModel->get_content($this->Article->article_item_field_mask($item['identifier'], $item_id, 'title'), $form_lang) : NULL;
		$data['field_desc'] = isset($_POST['field_desc'])
							? $this->input->post('field_desc')
							: $item_id>0 ? $this->LangModel->get_content($this->Article->article_item_field_mask($item['identifier'], $item_id, 'description'), $form_lang) : NULL;
		$data['field_content'] = isset($_POST['field_content'])
							? $this->input->post('field_content')
							: $item_id>0 ? $this->LangModel->get_content($this->Article->article_item_field_mask($item['identifier'], $item_id, 'content'), $form_lang) : NULL;
		
		$data['field_public'] = $item_id>0
							? $item['public']
							: NULL;
		$data['field_identifier'] = $item_id>0
							? $item['identifier']
							: NULL;
		$data['field_date'] = $item_id>0
							? $item['dateinsert']
							: NULL;
		
		// ARTICLES
		$filter=$page_name;
		if ($page_name=='all') {
			$filter=NULL;
		}
		$articles=$this->Article->get_items($filter, NULL, $form_lang, NULL);
		
		// PAGINATION
		$this->load->library('pagination');
		$config['base_url'] = base_url('pageinfo/publications/'.$page_name.'/0/'.$form_lang.'/');
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
		
		$articles=$this->Article->get_items($filter, NULL, $form_lang, NULL, $page_index, 5);
		foreach($articles as $k => $v)
		{
			$articles[$k]['title'] = $this->LangModel->get_content($this->Article->article_item_field_mask($v['identifier'], $v['article_id'], 'title'), $form_lang);
			$articles[$k]['description'] = $this->LangModel->get_content($this->Article->article_item_field_mask($v['identifier'], $v['article_id'], 'description'), $form_lang);
			$articles[$k]['content'] = $this->LangModel->get_content($this->Article->article_item_field_mask($v['identifier'], $v['article_id'], 'content'), $form_lang);
		}
		
		$data['page_index']=$page_index;
		$data['articles']=$articles;
		
		$this->load->view('admin/page-generic-pagearticles', $data);
	}
	
	public function article_add_item($page_name, $form_lang, $page_index=0)
	{
		$this->load->model('Article_model', 'Article');
		
		$identifier = 'all';
		if ($page_name == 'all') {
			$identifier = 'news';
		}
		
		$item_id = $this->Article->insert_item($identifier);
		
		if ($this->input->is_ajax_request()) {
			$item=$this->Article->get_item($item_id);
			echo '<tr id="item-id-'.$item_id.'">';
				echo '<td> </td>';
				echo '<td> </td>';
				echo '<td> </td>';
				echo '<td style="text-align:right;">
                    	<a class="btn btn-xs btn-default" href="'.base_url('pageinfo/publications/'.$page_name.'/'.$item['item_id'].'/'.$form_lang.'/'.$page_index).'"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                        <a class="btn btn-xs btn-default linkRemoveItemAjax" href="'.base_url('pageinfo/articles_del_item/'.$page_name.'/'.$item['item_id'].'/'.$form_lang.'/'.$page_index).'"><i class="fa fa-times" aria-hidden="true"></i></a>
                      </td>';
			echo '</tr>';
		}
		else {
			redirect('pageinfo/publications/'.$page_name.'/'.$item_id.'/'.$form_lang.'/'.$page_index, 'refresh');
		}
	}
	
	public function article_del_item($page_name, $item_id, $form_lang, $page_index=0)
	{
		$this->load->model('Languages_model', 'LangModel');
		$this->load->model('Article_model', 'Article');
		
		$item=$this->Article->get_item($item_id);
		$this->Article->remove_item($item_id);
		$this->LangModel->remove_content($this->Article->article_item_field_mask($item['identifier'], $item_id, 'title'));
		$this->LangModel->remove_content($this->Article->article_item_field_mask($item['identifier'], $item_id, 'desc'));
		$this->LangModel->remove_content($this->Article->article_item_field_mask($item['identifier'], $item_id, 'title-right'));
		
		if ($this->input->is_ajax_request()) {
			echo $item_id;
		}
		else {
			redirect('pageinfo/publications/'.$page_name.'/0/'.$form_lang.'/'.$page_index, 'refresh');
		}
	}
}
