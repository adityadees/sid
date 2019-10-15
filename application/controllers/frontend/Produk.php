<?php
defined('BASEPATH') OR exit('No direct script allowed');

class Produk extends MY_Controller{

	public function __construct(){
		parent::__construct();
		$this->module = 'frontend';
		$this->load->model('produk_m');
	}

	public function index(){
		$this->data['produk'] = $this->produk_m->get_by_order('produk_id','desc');
		$this->data['title']    = 'Produk';
		$this->data['content']  = 'produk/produk';
		$this->template($this->data, $this->module);
	}
	public function ajax_page(){
		$this->data['content']  = 'produk/produk_detail';
		$this->load->view('frontend/produk/produk_detail',$this->data);
	}
}
?> 