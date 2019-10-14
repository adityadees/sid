<?php 

class Penginapan_detail_m extends MY_Model 
{
	public function __construct()
	{
		parent::__construct();
		$this->data['table_name']	= 'penginapan_detail';
		$this->data['primary_key']	= 'pd_id';
	}
}