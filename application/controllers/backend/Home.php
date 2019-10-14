<?php
defined('BASEPATH') OR exit('No direct script allowed');
class Home extends MY_Controller{

	public function __construct(){
		parent::__construct();
		$this->module = 'backend';
		$this->load->model('user_m');
		$this->load->model('artikel_m');
		$this->load->model('hits_m');

		$this->data['token'] = $this->session->userdata('token');
		if (!isset($this->data['token']))
		{
			$this->session->sess_destroy();
			$this->flashmsg('Anda harus login untuk mengakses halaman tersebut', 'warning');
			redirect('login');
			exit;
		} else {
			if ($this->data['token']['role']=='mahasiswa') {
				$this->session->sess_destroy();
				$this->flashmsg('Wrong Auth', 'warning');
				redirect('login');
				exit;
			}
		}
	}

	public function index(){

		$this->data['count_uniq'] = $this->db->query("SELECT COUNT(*) as uniq FROM nodupes")->result();
		$this->data['count_user'] = $this->user_m->get(['user_role' => 'mahasiswa']);
		$this->data['count_artikel'] = $this->artikel_m->get();
		$this->data['artikel_pop'] = $this->artikel_m->get_by_order_any_limit('artikel_views','desc','5');
		$this->data['hits_pop'] = $this->hits_m->get_by_order_any_limit('hitcount','desc','5',['isunique' => '1']);
		$arrayAsrama = [];
		$avg_total = 0;

		$this->data['count_asrama'] = $arrayAsrama;
		$this->data['title']    = 'Dashboard';
		$this->data['content']  = 'home';
		$this->template($this->data, $this->module);
	}

}
?>