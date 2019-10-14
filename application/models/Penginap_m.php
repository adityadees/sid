<?php 

class Penginap_m extends MY_Model 
{
	public function __construct()
	{
		parent::__construct();
		$this->data['table_name']	= 'penginap';
		$this->data['primary_key']	= 'penginap_id';
	}
}