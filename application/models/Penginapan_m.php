<?php 

class Penginapan_m extends MY_Model 
{
	public function __construct()
	{
		parent::__construct();
		$this->data['table_name']	= 'penginapan';
		$this->data['primary_key']	= 'penginapan_kode';
	}
}