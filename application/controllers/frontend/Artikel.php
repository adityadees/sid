<?php
defined('BASEPATH') OR exit('No direct script allowed');
class Artikel extends MY_Controller{

	public function __construct(){
		parent::__construct();
		$this->module = 'frontend';
		$this->load->model('artikel_m');
		$this->data['postall_grab'] = $this->artikel_m->get_by_order_any_limit('artikel_tanggal', 'desc', 6);
		$this->data['popular_grab'] = $this->artikel_m->get_by_order_any_limit('artikel_views', 'desc', '6');
		$this->data['random_grab'] = $this->artikel_m->get_by_order_any_limit('rand()', 'desc', 6);
		$this->conpage['attributes'] = array('class' => 'page-link');
		$this->conpage['full_tag_open'] = "<ul class='pagination'>";
		$this->conpage['full_tag_close'] = '</ul>';
		$this->conpage['num_tag_open'] = '<li class="page-item">';
		$this->conpage['num_tag_close'] = '</li>';
		$this->conpage['cur_tag_open'] = '<li class="page-item active"><a href="#" class="page-link">';
		$this->conpage['cur_tag_close'] = '</a></li>';
		$this->conpage['first_tag_open'] = '<li class="page-item">';
		$this->conpage['first_tag_close'] = '</li>';
		$this->conpage['last_tag_open'] = '<li class="page-item">';
		$this->conpage['last_tag_close'] = '</li>';
		$this->conpage['prev_link'] = '<i class="fa fa-angle-left"></i>';
		$this->conpage['prev_tag_open'] = '<li class="page-item">';
		$this->conpage['prev_tag_close'] = '</li>';
		$this->conpage['next_link'] = '<i class="fa fa-angle-right"></i>';
		$this->conpage['next_tag_open'] = '<li class="page-item">';
		$this->conpage['next_tag_close'] = '</li>';
		
		$this->data['token'] = $this->session->userdata('token');
		
		if ($this->data['token']['role']!='mahasiswa') {
			$this->session->sess_destroy();
		}
	}



	public function news(){
		$this->data['xd'] = $this->artikel_m->get_by_order('artikel_tanggal', 'desc',['artikel_jenis' => 'news']);

		$page=$this->uri->segment(3);
		if(!$page):
			$offset = 0;
		else:
			$offset = $page;
		endif;
		$limit=5;
		$this->conpage['base_url'] = base_url() . 'News/p/';
		$this->conpage['first_url'] = base_url() . 'News';
		$this->conpage['total_rows'] = count($this->data['xd']);
		$this->conpage['per_page'] = $limit;
		$this->conpage['uri_segment'] = 3;
		$this->pagination->initialize($this->conpage);
		$this->data['page'] =$this->pagination->create_links();

		$this->data['news_grab']= $this->artikel_m->order_limit_page('artikel_tanggal','desc',$offset,$limit,['artikel_jenis' => 'news']);

		$this->data['title']    = 'Berita';
		$this->data['content']  = 'artikel/news/news';
		$this->template($this->data, $this->module);
	}

	public function info(){
		$this->data['xd'] = $this->artikel_m->get_by_order('artikel_tanggal', 'desc',['artikel_jenis' => 'info']);

		$page=$this->uri->segment(3);
		if(!$page):
			$offset = 0;
		else:
			$offset = $page;
		endif;
		$limit=5;
		$this->conpage['base_url'] = base_url() . 'Info/p/';
		$this->conpage['first_url'] = base_url() . 'Info';
		$this->conpage['total_rows'] = count($this->data['xd']);
		$this->conpage['per_page'] = $limit;
		$this->conpage['uri_segment'] = 3;
		$this->pagination->initialize($this->conpage);
		$this->data['page'] =$this->pagination->create_links();

		$this->data['info_grab']= $this->artikel_m->order_limit_page('artikel_tanggal','desc',$offset,$limit,['artikel_jenis' => 'info']);

		$this->data['title']    = 'Info';
		$this->data['content']  = 'artikel/info/info';
		$this->template($this->data, $this->module);
	}

	public function detail(){
		$param = array('artikel_slug' => $this->uri->segment(3));
		$this->data['artikel_grab'] =   $this->artikel_m->get(['artikel_slug' => htmlspecialchars($param['artikel_slug'],ENT_QUOTES)]);


		$data = [ 
			'artikel_views'	=> $this->data['artikel_grab'][0]->artikel_views+1,
		];

		$result = $this->artikel_m->update($this->data['artikel_grab'][0]->artikel_id,$data);
		$this->data['title']    = 'Artikel';
		$this->data['content']  = 'artikel/detail';
		$this->template($this->data, $this->module);
	}

}
?>