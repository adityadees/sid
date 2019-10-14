<?php 

class Penginapan_bayar_m extends MY_Model 
{
	public function __construct()
	{
		parent::__construct();
		$this->data['table_name']	= 'penginapan_bayar';
		$this->data['primary_key']	= 'pb_id';
	}
}