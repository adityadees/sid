<?php
defined('BASEPATH') OR exit('No direct script allowed');

class Faq extends MY_Controller{

	public function __construct(){
		parent::__construct();
		$this->module = 'frontend';
		$this->data['token_mhs'] = $this->session->userdata('token_mhs');
	}

	public function index(){
		$this->data['title']    = 'FAQ';
		$this->data['content']  = 'support/faq/index';
		$this->template($this->data, $this->module);
	}
	public function asrama(){
		$this->data['title']    = 'FAQ - Asrama';
		$this->data['content']  = 'support/faq/asrama';
		$this->template($this->data, $this->module);
	}
}
?> 