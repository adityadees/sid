<?php
defined('BASEPATH') OR exit('No direct script allowed');

class Contactus extends MY_Controller{

	public function __construct(){
		parent::__construct();
		$this->module = 'frontend';
		$this->data['token_mhs'] = $this->session->userdata('token_mhs');
	}

	public function index(){
		$this->data['title']    = 'Contact Us';
		$this->data['content']  = 'support/contactus/index';
		$this->template($this->data, $this->module);
	}
}
?> 