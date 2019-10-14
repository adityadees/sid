<?php 

class Penghuni_m extends MY_Model 
{
	public function __construct()
	{
		parent::__construct();
		$this->data['table_name']	= 'penghuni';
		$this->data['primary_key']	= 'penghuni_kpm';
	}
}