<?php 

class Registrasi_m extends MY_Model 
{
	public function __construct()
	{
		parent::__construct();
		$this->data['table_name']	= 'Registrasi';
		$this->data['primary_key']	= 'registrasi_id';
	}
}