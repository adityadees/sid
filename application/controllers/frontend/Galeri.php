<?php
defined('BASEPATH') OR exit('No direct script allowed');

class Galeri extends MY_Controller{

	public function __construct(){
		parent::__construct();
		$this->module = 'frontend';
		$this->load->model('galeri_m');
	}

	public function index(){
		$this->data['galeri'] = $this->galeri_m->get_by_order('galeri_id','desc');
		$this->data['title']    = 'Galeri';
		$this->data['content']  = 'galeri/galeri';
		$this->template($this->data, $this->module);
	}
}
?> 