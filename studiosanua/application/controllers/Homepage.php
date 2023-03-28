<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Homepage extends MY_Restrictedzone {
	
	public function layout($item_key = NULL, $form_lang = NULL)
	{
		$this->load->model('Languages_model', 'LangModel');
		$this->load->model('Pagelayout_model', 'Layout');
		
		$data = array(
			'controller' => 'homepage',
			'page' => 'layout',
			'title' => 'Home - Layout',
		);
		
		$form_lang = ($form_lang == NULL) ? $this->LangModel->get_primary()['lang'] : $form_lang;
		$data['form_lang'] = $form_lang;
		$data['content_langs'] = $this->LangModel->get();
		$data['item_key']=$item_key;
		$data['successful'] = false;
		
		$this->form_validation->set_rules('save', 'Save button', '');
		$this->form_validation->set_rules('field_visible', 'Visible', 'numeric');
			
		if ($this->form_validation->run() !== FALSE)
		{
			$this->Layout->update_visible('home', $item_key, $this->input->post('field_visible')=='1'?'1':'0');
			
			switch($item_key)
			{
				case 'gallery':
				{
					$this->LangModel->save_content('homegallery-buttons-prev', $form_lang, $this->input->post('field_prev'));
					$this->LangModel->save_content('homegallery-buttons-next', $form_lang, $this->input->post('field_next'));
					$this->LangModel->save_content('homegallery-buttons-more', $form_lang, $this->input->post('field_more'));
					break;
				}
				case 'content':
				{
					
					break;
				}
				case 'pagelists':
				{
					
					break;
				}
				case 'news':
				{
					$this->LangModel->save_content('newssection-title', $form_lang, $this->input->post('field_title'));
					$this->LangModel->save_content('newssection-buttons-more', $form_lang, $this->input->post('field_more'));
					break;
				}
				case 'testimonials':
				{
					$this->LangModel->save_content('testimonialssection-title', $form_lang, $this->input->post('field_title'));
					$this->LangModel->save_content('testimonialssection-buttons-viewall', $form_lang, $this->input->post('field_viewall'));
					break;
				}
			}
			
			$data['successful'] = true;
		}
		
		$data['field_visible'] = isset($_POST['field_visible'])
							? $this->input->post('field_visible')
							: $this->Layout->get_visible('home', $item_key);
		switch($item_key)
		{
			case 'gallery':
			{
				$data['field_prev'] = isset($_POST['field_prev'])
							? $this->input->post('field_prev')
							: $this->LangModel->get_content('homegallery-buttons-prev', $form_lang);
				$data['field_next'] = isset($_POST['field_next'])
									? $this->input->post('field_next')
									: $this->LangModel->get_content('homegallery-buttons-next', $form_lang);
				$data['field_more'] = isset($_POST['field_more'])
									? $this->input->post('field_more')
									: $this->LangModel->get_content('homegallery-buttons-more', $form_lang);
				break;
			}
			case 'content':
			{
				
				break;
			}
			case 'pagelists':
			{
				
				break;
			}
			case 'news':
			{
				$data['field_title'] = isset($_POST['field_title'])
							? $this->input->post('field_title')
							: $this->LangModel->get_content('newssection-title', $form_lang);
				$data['field_more'] = isset($_POST['field_more'])
							? $this->input->post('field_more')
							: $this->LangModel->get_content('newssection-buttons-more', $form_lang);
				break;
			}
			case 'testimonials':
			{
				$data['field_title'] = isset($_POST['field_title'])
							? $this->input->post('field_title')
							: $this->LangModel->get_content('testimonialssection-title', $form_lang);
				$data['field_viewall'] = isset($_POST['field_viewall'])
							? $this->input->post('field_viewall')
							: $this->LangModel->get_content('testimonialssection-buttons-viewall', $form_lang);
				break;
			}
		}
		
		$data['visible_gallery'] = $this->Layout->get_visible('home', 'gallery');
		$data['visible_content'] = $this->Layout->get_visible('home', 'content');
		$data['visible_pagelists'] = $this->Layout->get_visible('home', 'pagelists');
		$data['visible_news'] = $this->Layout->get_visible('home', 'news');
		$data['visible_testimonials'] = $this->Layout->get_visible('home', 'testimonials');
		
		$this->load->view('admin/page-home-layout', $data);
	}
	
	public function gallery($item_id = 0, $form_lang = NULL)
	{
		$this->load->model('Languages_model', 'LangModel');
		$this->load->model('Homegallery_model', 'Gallery');
		
		$data = array(
			'controller' => 'homepage',
			'page' => 'gallery',
			'title' => 'Home - Image gallery',
		);
		
		$form_lang = ($form_lang == NULL) ? $this->LangModel->get_primary()['lang'] : $form_lang;
		$data['form_lang'] = $form_lang;
		$data['content_langs'] = $this->LangModel->get();
		$data['item_id']=$item_id;
		$data['successful'] = false;

		if (isset($_POST['save2']))
		{
			$this->form_validation->set_rules('save2', 'Save button', 'required');
			$this->form_validation->set_rules('field_title', 'Title', '');
			$this->form_validation->set_rules('field_url', 'Url', '');
				
			if ($this->form_validation->run() !== FALSE)
			{
				$this->LangModel->save_content($this->Gallery->gallery_item_field_mask($item_id, 'title'), $form_lang, $this->input->post('field_title'));
				$this->Gallery->update_item_link($item_id, $this->input->post('field_url'));
				
				if ($this->input->post('subitems[]'))
				{
					$config=array();
					$config['upload_path']   = './assets/img/homegallery/'; 
					$config['allowed_types'] = 'gif|jpg|png'; 
					$config['max_size']      = 3000; 
					$config['max_width']     = 6000; 
					$config['max_height']    = 6000;  
					$config['encrypt_name']  = TRUE;
					$this->load->library('upload', $config);
					
					foreach($this->input->post('subitems[]') as $sr_id)
					{
						$this->LangModel->save_content($this->Gallery->gallery_subitem_field_mask($sr_id, 'title'), $form_lang, $this->input->post('subitem-field-'.$sr_id.'-title'));
						$this->LangModel->save_content($this->Gallery->gallery_subitem_field_mask($sr_id, 'desc'), $form_lang, $this->input->post('subitem-field-'.$sr_id.'-desc'));
						$this->Gallery->update_subitem_link($sr_id, $this->input->post('subitem-field-'.$sr_id.'-url'));
						
						$upload_image=NULL;
						if(isset($_FILES['subitem-field-'.$sr_id.'-image']) && !empty($_FILES['subitem-field-'.$sr_id.'-image']['name']))
						{
							if ($this->upload->do_upload('subitem-field-'.$sr_id.'-image'))
							{
								$upload_info=$this->upload->data();
								
								//resize:
								$config['image_library'] 	= 'gd2';
								$config['source_image'] 	= $upload_info['full_path'];
								$config['maintain_ratio'] 	= false;
								$config['width']     		= 644;
								$config['height']    		= 375;
								$this->load->library('image_lib', $config); 
								$this->image_lib->resize();
								
								$upload_image = base_url('assets/img/homegallery/'.$upload_info['file_name']);
								$this->Gallery->update_subitem_image($sr_id, $upload_image);
							}
							else
							{
								echo $this->upload->display_errors();
								$this->form_validation->set_message('upload_image', $this->upload->display_errors());
							}
						}
					}
				}
				
				$data['successful'] = true;
			}
		}
		
		$data['field_title'] = isset($_POST['field_title'])
							? $this->input->post('field_title')
							: $this->LangModel->get_content($this->Gallery->gallery_item_field_mask($item_id, 'title'), $form_lang);
		
		
		$item=($item_id>0)?$this->Gallery->get_item($item_id):array();
		$data['field_url'] = $item_id>0
							? $item['url']
							: NULL;
		
		$gallery_items=$this->Gallery->get_items();
		foreach($gallery_items as $k => $v)
		{
			$gallery_items[$k]['title'] = $this->LangModel->get_content($this->Gallery->gallery_item_field_mask($v['category_id'], 'title'), $form_lang);
		}
		$data['gallery_items']=$gallery_items;
		
		$subitems=array();
		if ($item_id>0)
		{
			foreach($this->Gallery->get_subitems($item_id) as $v)
			{
				$v['title']=$this->LangModel->get_content($this->Gallery->gallery_subitem_field_mask($v['slideshow_id'], 'title'), $form_lang);
				$v['desc']=$this->LangModel->get_content($this->Gallery->gallery_subitem_field_mask($v['slideshow_id'], 'desc'), $form_lang);
				$subitems[]=$v;
			}
		}
		$data['gallery_subitems']=$subitems;
		
		$this->load->view('admin/page-home-gallery', $data);
	}
	
	public function gallery_add_item($form_lang)
	{
		$this->load->model('Homegallery_model', 'Gallery');
		$item_id = $this->Gallery->insert_item();
		
		if ($this->input->is_ajax_request()) {
			$item=$this->Gallery->get_item($item_id);
			echo '<tr id="item-id-'.$item['category_id'].'">';
				echo '<td> </td>';
				echo '<td style="text-align:right;">
                    	<a class="btn btn-xs btn-default" href="'.base_url('homepage/gallery/'.$item['category_id'].'/'.$form_lang).'"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                        <a class="btn btn-xs btn-default linkRemoveItemAjax" href="'.base_url('homepage/gallery_del_item/'.$item['category_id'].'/'.$form_lang).'"><i class="fa fa-times" aria-hidden="true"></i></a>
                      </td>';
			echo '</tr>';
		}
		else {
			redirect('homepage/gallery/'.$item_id.'/'.$form_lang, 'refresh');
		}
	}
	
	public function gallery_add_subitem($item_id, $form_lang)
	{
		$this->load->model('Homegallery_model', 'Gallery');
		$subitem_id = $this->Gallery->insert_subitem($item_id);
		
		if ($this->input->is_ajax_request()) {
			$item=$this->Gallery->get_item($item_id);
			echo '<tr id="subitem-id-'.$subitem_id.'">';
				echo '<td>
						<span style="color:#AAA;"><i class="fa fa-picture-o fa-lg"></i></span>
						<br>
						<input type="file" name="subitem-field-'.$subitem_id.'-image" class="form-control input-sm" style="margin-top:5px;">
				</td>';
				echo '<td>
					<input type="hidden" name="subitems[]" value="'.$subitem_id.'">
                	<input type="text" name="subitem-field-'.$subitem_id.'-title" class="form-control input-sm" placeholder="Enter title" title="Title" value="">
					<input style="margin-top:5px;" type="text" name="subitem-field-'.$subitem_id.'-url" class="form-control input-sm" placeholder="Enter link" title="Link" value="">
				</td>';
                echo '<td><textarea rows="3" name="subitem-field-'.$subitem_id.'-desc" class="form-control input-sm"></textarea></td>';
                echo '<td style="text-align:right;">
                    <a class="btn btn-xs btn-default linkRemoveSubItemAjax" href="'.base_url('homepage/gallery_del_subitem/'.$subitem_id.'/'.$form_lang).'"><i class="fa fa-times" aria-hidden="true"></i></a>
                </td>';
			echo '</tr>';
		}
		else {
			redirect('homepage/gallery/'.$item_id.'/'.$form_lang, 'refresh');
		}
	}
	
	public function gallery_del_item($item_id, $form_lang)
	{
		$this->load->model('Languages_model', 'LangModel');
		$this->load->model('Homegallery_model', 'Gallery');
		
		$this->Gallery->remove_item($item_id);
		$this->LangModel->remove_content($this->Gallery->gallery_item_field_mask($item_id, 'title'));
		$this->LangModel->remove_content($this->Gallery->gallery_item_field_mask($item_id, 'desc'));
		$this->LangModel->remove_content($this->Gallery->gallery_item_field_mask($item_id, 'title-right'));
		
		if ($this->input->is_ajax_request()) {
			echo $item_id;
		}
		else {
			redirect('homepage/gallery/0/'.$form_lang, 'refresh');
		}
	}
	
	public function gallery_del_subitem($subitem_id, $form_lang)
	{
		$this->load->model('Languages_model', 'LangModel');
		$this->load->model('Homegallery_model', 'Gallery');
		
		$subitem=$this->Gallery->get_subitem($subitem_id);
		$this->Gallery->remove_subitem($subitem_id);
		$this->LangModel->remove_content($this->Gallery->gallery_subitem_field_mask($subitem['slideshow_id'], 'title'));
		
		if ($this->input->is_ajax_request()) {
			echo $subitem_id;
		}
		else {
			redirect('homepage/gallery/'.$subitem['category_id'].'/'.$form_lang, 'refresh');
		}
	}
	
	public function gallery_up_item($item_id, $form_lang)
	{
		$this->load->model('Homegallery_model', 'Gallery');
		$this->Gallery->item_orderid_up($item_id);
		redirect('homepage/gallery/0/'.$form_lang, 'refresh');
	}
	
	public function gallery_down_item($item_id, $form_lang)
	{
		$this->load->model('Homegallery_model', 'Gallery');
		$this->Gallery->item_orderid_down($item_id);
		redirect('homepage/gallery/0/'.$form_lang, 'refresh');
	}
	
	public function gallery_up_subitem($item_id, $subitem_id, $form_lang)
	{
		$this->load->model('Homegallery_model', 'Gallery');
		$this->Gallery->subitem_orderid_up($subitem_id);
		redirect('homepage/gallery/'.$item_id.'/'.$form_lang, 'refresh');
	}
	
	public function gallery_down_subitem($item_id, $subitem_id, $form_lang)
	{
		$this->load->model('Homegallery_model', 'Gallery');
		$this->Gallery->subitem_orderid_down($subitem_id);
		redirect('homepage/gallery/'.$item_id.'/'.$form_lang, 'refresh');
	}
}
