<?php 

class Galeri_m extends MY_Model 
{
	public function __construct()
	{
		parent::__construct();
		$this->data['table_name']	= 'galeri';
		$this->data['primary_key']	= 'galeri_id';
	}
}