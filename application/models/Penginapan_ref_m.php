<?php 

class Penginapan_ref_m extends MY_Model 
{
	public function __construct()
	{
		parent::__construct();
		$this->data['table_name']	= 'penginapan_ref';
		$this->data['primary_key']	= 'pr_kode';
	}
}