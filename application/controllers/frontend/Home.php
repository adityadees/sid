<?php
defined('BASEPATH') OR exit('No direct script allowed');

class Home extends MY_Controller{

	public function __construct(){
		parent::__construct();
		$this->module = 'frontend';
		$this->load->model('artikel_m');
		$this->load->model('slider_m');
		$this->data['token_mhs'] = $this->session->userdata('token_mhs');
	}

	public function index(){
		$this->data['title']    = 'Home';
		$this->data['content']  = 'home';
		$this->data['news_limit_grab'] 	 = 	$this->artikel_m->get_by_order_any_limit('artikel_tanggal', 'desc', '3',['artikel_jenis' => 'news']);
		$this->data['info_limit_grab'] 	 = 	$this->artikel_m->get_by_order_any_limit('artikel_tanggal', 'desc', '3',['artikel_jenis' => 'info']);
		$this->data['artikel_random_grab'] 	 = 	$this->artikel_m->get_by_order_any_limit('artikel_tanggal', 'ran()', '6');
		$this->data['slide'] = $this->slider_m->get();
		$this->template($this->data, $this->module);
	}
}
?> 